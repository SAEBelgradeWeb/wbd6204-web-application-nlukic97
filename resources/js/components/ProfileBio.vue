<template>
    <div class="row d-flex justify-content-center mb-4">
        <div class="col-lg-8 col-md-10 col-10">

            <div class="text-center">
                <span id="bioContent" class="position-relative">
                    <i class="pr-5">{{this.userBio}}</i>
                    <span v-on:click="this.editBio" class="btn btn-secondary rounded-circle position-absolute" id="editBioBtn"><i class="fas fa-pen"></i></span>
                </span>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfileBio",
        props:[
            'bio'
        ],
        data:function(){
            return {
                // newBio:null,
                // contentEditable:false,
                // boxEditable:''
                userBio:null
            }
        },
        methods:{
            editBio(){
                console.log('edit bio')
                // this.contentEditable = !this.contentEditable //true to false, false to true
                // if(this.contentEditable === true){
                //     this.editClass = 'boxEditable'
                // } else {
                //     this.editClass = ''
                // }
                // console.log(this.contentEditable)
            },
            saveBio(){
                // console.log(newBio)
                // this.contentEditable = false
            }
        },
        mounted() {
            if(this.bio === ''){
                this.userBio = 'Enter you bio...'
            } else {
                this.userBio = this.bio
            }
        }
    }
</script>

<style scoped>
    #editBioBtn {
        right:0;
        top:-5px;
        font-size: 10px;
    }


</style>
