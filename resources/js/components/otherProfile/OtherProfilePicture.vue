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
                    <a :href="getRemoveUrl()" class="btn btn-primary"><i class="fas fa-user-times"></i> Remove friend</a>
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
                }
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
            getRemoveUrl()
            {
                return `/removeFriend/${this.id}`;
            }
        },
        mounted() {
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


</style>
