<template>
    <div> <!--You had 'viewModal' here.-->
        <div class="row d-flex justify-content-center">

                <form action='/upload-image' method="POST" enctype="multipart/form-data"
                      id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3"
                >
                    <input type="hidden" name="_token" :value="csrf">
                    <!-- image updating field -->
                    <div class="input-group mb-3">
                        <input type="file" name='avatar' id="avatar" class="form-control d-inline-block" @click='clearAll' @change="onFileSelected()">
                    </div>
                    <div class="text-center">
                        <img :src="this.loadedImage" alt="">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mb-3">Save</button>
                        <a :href="getUserLink()"><span class="btn btn-secondary mb-3">Cancel</span></a>
                    </div>

                </form>

        </div>
    </div>
</template>

<script>
    export default {
        name: "UploadImage",
        props:[
            'csrf',
            'userId'
        ],
        data:function(){
            return{
                inputFile:null,
                loadedImage:null
            }
        },
        methods:{
            getUserLink(){
              return `/user/${this.userId}`
            },
            onFileSelected(){
                this.inputFile = event.target.files[0]

                if ( /\.(jpe?g|png)$/i.test(this.inputFile.name) ){
                    const reader = new FileReader();

                    reader.addEventListener('load',()=>{
                        this.loadedImage = reader.result
                    },false)

                    reader.readAsDataURL(this.inputFile)
                } else {
                    this.clearAll()
                }
            },
            clearAll(){
                document.getElementById('avatar').value = ''
                this.loadedImage = ''
            }
        }
    }
</script>

<style scoped>
    img {
        max-width: 50%;
        min-width: 50%;
    }
</style>
