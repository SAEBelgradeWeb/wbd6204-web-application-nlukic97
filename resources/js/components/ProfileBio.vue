<template>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-md-10 col-10 position-relative">
            <span v-on:click="this.editBio" class="btn btn-secondary rounded-circle position-absolute" id="editBioBtn"><i class="fas fa-pen"></i></span>
            <div class="text-center"><span id="bioContent">{{this.bio}}</span></div>
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
        }
    }
</script>

<style scoped>
    #editBioBtn {
        right:5px;
        top:-35px;
    }


</style>
