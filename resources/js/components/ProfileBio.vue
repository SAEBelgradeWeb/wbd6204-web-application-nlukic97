<template>
    <div class="row d-flex justify-content-center mb-4">
        <div class="col-lg-8 col-md-8 col-10 text-center">

            <!--Displayed if the bio passed as a prop is not null or '' -->
            <div
                class="text-center"
                :class="{'d-none': !this.hideBio}"
            >
                <i>{{this.userBio}}</i>
                <div>
                    <span class="btn text-primary">Edit bio</span>
                </div>
            </div>

            <!--Displayed 'add bio' btn if no bio is present in passed prop -->
            <button
                class="text-primary btn"
                :class="{'d-none': this.hideAddButton}"
                @click="alterBio"
            >
                Add bio
            </button>

            <!-- The editing section for adding/ editing the bio-->
            <div :class="{'d-none': this.hideTextArea}">
                <textarea  ref="textareaObj" maxlength="255" placeholder="Enter you bio...">{{this.userBio}}</textarea>
                <div class="text-right">
                    <span class="btn btn-secondary" @click="toggleElementsDisplay">Cancel</span>
                    <span class="btn btn-primary" @click="saveBio">Save</span>
                </div>
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
                userBio:'',
                hideBio:null, //checkBioPresent() - will or will not show the bio text
                hideAddButton:false, //checkBioPresent() - class binding: show or hide the 'add bio' btn
                hideTextArea:true, //checkBioPresent() - hide or show the bio editing text area,
                submitData:{
                    bio:null
                }
            }
        },
        methods:{
            checkBioPresence(){
                if(this.userBio === '' || this.userBio === null || !this.userBio){
                    this.hideBio = false;
                    this.hideAddButton = false;
                } else {
                    this.hideBio = true;
                    this.hideAddButton = true;
                }
                    this.hideTextArea = true;
            },
            toggleElementsDisplay(){ //you will have to alter this depending on whether you are editing a bio, deleting a bio, or inserting one
                // this.hideBio = !this.hideBio //this causes a problem. You must handle this with a different function
                this.hideAddButton = !this.hideAddButton;
                this.hideTextArea = !this.hideTextArea;
            },
            alterBio(){ //I might be able to remove this, not sure why I added it
              this.toggleElementsDisplay()
            },
            postRequest(){
                axios({
                    method: 'post',
                    url: 'http://wbd6204-final.test/api/updateBio',
                    data: this.submitData
                })
                    .then(res=>{
                        this.userBio = res.data //add the updated data (sent from backend after update)
                        this.checkBioPresence() //if the user added
                    })
            },
            saveBio(){
                this.submitData.bio = this.$refs.textareaObj.value
                console.log(this.submitData)
                this.postRequest()

                this.toggleElementsDisplay()
            }
        },
        mounted() {
            this.userBio = this.bio;
            this.checkBioPresence()
        }
    }
</script>

<style scoped>
    textarea {
        resize: none;
        width: 100%;
        height:120px;
        overflow: hidden;
    }

   @media only screen and (max-width: 519px) {
        textarea {
            height:160px;
        }
    }

    @media only screen and (max-width: 430px) {
        textarea {
            height:200px;
        }
    }

    @media only screen and (max-width: 359px) {
        textarea {
            height:230px;
        }
    }
    @media only screen and (max-width: 301px) {
        textarea {
            height:250px;
        }
    }


</style>
