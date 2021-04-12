<template>
    <div>
        <div id="modal" :class="this.viewable.toString()"> <!--You had 'viewModal' here.-->
            <div class="row d-flex justify-content-center">

            <div id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3">
               <!-- <form
                    @submit="uploadFile" enctype="multipart/form-data"
                    id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3"
                >-->
                    <!-- image updating field -->
                    <div class="input-group mb-3">
                        <input type="file" name='avatar' id="avatar" class="form-control d-inline-block" @change="onFileSelected()">
                    </div>

                    <div class="text-center">
                        <img :src="this.loadedImage" alt="">
                    </div>

                    <div class="text-center">
<!--                        <button type="submit" class="btn btn-primary mb-3">Save</button>-->
                        <button @click="uploadFile" class="btn btn-primary mb-3">Save</button>
                        <span @click="closeModal" class="btn btn-secondary mb-3">Cancel</span>
                    </div>
<!--                </form>-->
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AvatarFormModal",
        data:function(){
            return {
                loadedImage:null,
                inputFile:null
            }
        },
        props:[
          'viewable'
        ],
        methods:{
            //displaying the image - for further cropping
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
                this.loadedImage = '' //  if user clicks 'cancel', the image is removed...
                                    //   ... and the input is cleared.
                this.file = ''
            },
            closeModal(){
                this.clearAll()
                this.$emit('closeAvatarModal',false)
            },

            //not working for some reason, the server receives the request but no file is sent
            uploadFile(){
                const fd = new FormData();
                fd.append('image',this.inputFile, this.inputFile.name)

                axios.post('http://wbd6204-final.test/api/uploadImage', fd,{
                    onUploadProgress: (uploadEvent) => {
                        console.log('Progress:' + Math.round(uploadEvent.loaded / uploadEvent.total * 100))
                    }
                })
                    .then(function (res) {
                        console.log(res)
                    })
                    .catch(function (err) {
                        console.log(err)
                    });

            },
            saveChanges(){
                this.uploadFile()
            }
        }
    }
</script>

<style scoped>
    #modal.true {
        background-color: rgba(0, 0, 0, 0.65);
        width:100%;
        height:100%;
        position: fixed;
        left:0;
        top:0;
        bottom:10px;
        z-index:4;
        padding-top: 10vh;
    }

    #modal.false {
        display:none;
    }

    ul {
        padding:20px;
    }

    img {
        max-width: 80%;
    }
</style>
