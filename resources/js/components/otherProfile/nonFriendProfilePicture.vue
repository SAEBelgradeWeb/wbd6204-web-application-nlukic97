<template>
    <div>
        <div class="row">
            <div class="ml-auto mr-auto">
                <div class=" rounded-circle overflow-hidden" :style="getProfilePic"></div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col pt-2">
                <h3 class="d-inline-block">
                    <span class="font-weight-bold">{{this.name}}</span>
                    <span>({{this.username}})</span>
                </h3>

                <!--Buttons - 1st span is hidden if request has been sent. The 2nd span is hidden if request has not been sent-->
                <span @click="addFriend" class="btn btn-primary" :class="{'d-none':this.btn != 'add'}"><i class="fas fa-user-plus"></i> Add friend</span>
                <span class="btn btn-secondary" :class="{'d-none':this.btn != 'addSpinner'}"><i class="loadIcon fas fa-spinner"></i> Add friend</span>

                <span @click="cancelRequest" class="btn btn-secondary" :class="{'d-none':this.btn != 'cancel'}"><i class="fas fa-user-times"></i> Cancel request</span>
                <span class="btn btn-secondary" :class="{'d-none':this.btn != 'cancelSpinner'}"><i class="loadIcon fas fa-spinner"></i> Cancel request</span>

                <span @click="acceptRequest" class="btn btn-primary" :class="{'d-none':this.btn != 'accept'}"><i class="fas fa-user-check"></i> Accept friend</span>
                <span class="btn btn-secondary" :class="{'d-none':this.btn != 'acceptSpinner'}"><i class="loadIcon fas fa-spinner"></i> Accept friend</span>

                <span @click="rejectRequest" class="btn btn-danger" :class="{'d-none':this.btn != 'accept'}"><i class="fas fa-user-times"></i> Reject friend</span>
                <span class="btn btn-secondary" :class="{'d-none':this.btn != 'rejectSpinner'}"><i class="loadIcon fas fa-spinner"></i> Reject friend</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "profile-picture",
        props:[
            'imageurl',
            'name',
            'username',
            'sex',
            'id'
        ],
        components:{
        },
        data:function(){
            return{
                defaultPicture:{
                    male:'/images/male.jpg',
                    female:'/images/female.jpg'
                },
                btn:null
            }
        },
        computed:{
            getProfilePic(){
                if(this.imageurl != null && this.imageurl.length <= 0 ){
                    if(this.sex === 'male'){
                        return "background-image:url("+this.defaultPicture.male+");"
                    } else if(this.sex === 'female') {
                        return "background-image:url("+this.defaultPicture.female+");"
                    }
                } else {
                    return "background-image:url(/storage/avatars/"+this.imageurl+");" //this should be changed. The user in the links messes up the entire thing
                }
            }
        },
        methods:{
            async checkRelationship(){
                try {
                    const response = await axios.get(`/api/checkNonFriendStatus/${this.id}`)
                    this.btn = response.data.button
                } catch(e){
                    console.log(e)
                }
            },
            addFriend(){
                this.btn ='addSpinner'
                this.axiosRequest('/api/addFriend','cancel');
            },
            cancelRequest(){
                this.btn = 'cancelSpinner'
                this.axiosRequest('/api/cancelFriendRequest','add');
            },
            acceptRequest(){
                this.btn = 'acceptSpinner';
                this.axiosRequest('/api/acceptFriendRequest',null);
            },
            rejectRequest(){
                //still need to add this and the button for this
                this.btn = 'rejectSpinner';
                this.axiosRequest('/api/rejectFriendRequest','add');
            },
            async axiosRequest(url,returnBtn){
                try {
                    await axios.post(url,{userId: this.id})
                    if(returnBtn === null){
                        location.reload();
                    } else {
                        this.btn = returnBtn
                    }
                } catch(e){
                    console.log(e)
                }
            }
        },
        mounted() {
            this.checkRelationship();
        }
    }
</script>

<style scoped>
    /* This underneath was a mistake but I kinda like it */
    /*div.row, div.rounded-circle {
        border:3px solid #fff;
        background-image:url('/images/profilepic.png');
        background-size: 80%; background-repeat: no-repeat;
        background-position: center center;
        background-color: #fff;
    }*/

    div.rounded-circle {
        height:160px;
        width:160px;
        border:3px solid #fff;
        background-size: 100%;
        background-repeat: no-repeat;
        background-position: center center;
        background-color: #fff;
    }

    .loadIcon {
        animation: 1s spin infinite linear;
    }

    @keyframes spin {
        0% {transform: rotate(0deg);}
        30% {transform: rotate(-300deg);}
        100% {transform: rotate(-360deg);}
    }


</style>
