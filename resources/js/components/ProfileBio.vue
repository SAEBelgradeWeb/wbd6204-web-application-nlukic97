<template>
    <div class="row d-flex justify-content-center mb-4">
        <div class="col-lg-8 col-md-8 col-10 text-center">

            <!--Displayed if the bio passed as a prop is not null or '' -->
            <div
                class="text-center"
                :class="{'d-none': !this.hideBio}"
            >
                <span class="text-break">{{this.userBio}}</span>
                <div>
                    <span class="btn text-primary" @click="toggleEditOptions">Edit bio</span>
                </div>
            </div>

            <!--Displayed 'add bio' btn if no bio is present in passed prop -->
            <button
                class="text-primary btn"
                :class="{'d-none': this.hideAddButton}"
                @click="toggleAddOptions"
            >
                Add bio
            </button>

            <!-- The editing section for adding/ editing the bio-->
            <div :class="{'d-none': this.hideEditBox}">
                <textarea
                    ref="textareaObj"
                    maxlength="255"
                    placeholder="Enter you bio..."
                    class="p-2 pl-3"
                >{{this.userBio}}
                </textarea>

                <div class="text-right">
                    <span class="btn btn-secondary" @click="cancelBtn">Cancel</span>
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
                mode:null,
                hideBio:null, //checkBioPresent() - will or will not show the bio text
                hideAddButton:false, //checkBioPresent() - class binding: show or hide the 'add bio' btn
                hideEditBox:true, //checkBioPresent() - hide or show the bio editing text area,
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
                    this.hideEditBox = true;
            },
            focusTextArea(){
                setTimeout(()=>{
                    this.$refs.textareaObj.focus() //it wont focus
                },100)
            },
            toggleAddOptions(){
                this.mode = 'add';

                this.hideAddButton = !this.hideAddButton;
                this.hideEditBox = !this.hideEditBox;

                this.focusTextArea()

            },
            toggleEditOptions(){
                this.mode = 'edit';

                this.hideBio = !this.hideBio
                this.hideEditBox = !this.hideEditBox;

                this.focusTextArea()
            },
            cancelBtn(){
                console.log()
                if(this.mode === 'add'){
                    this.toggleAddOptions()
                } else if(this.mode === 'edit'){
                    this.toggleEditOptions()
                }

                this.mode = null
            },
            postRequest(){
                axios({
                    method: 'post',
                    url: 'http://wbd6204-final.test/api/updateBio',
                    data: this.submitData
                })
                    .then(res=>{
                        this.userBio = res.data //add the updated data (sent from backend after update)
                        this.checkBioPresence()
                    })
            },
            saveBio(){
                this.submitData.bio = this.$refs.textareaObj.value
                console.log(this.submitData)
                this.postRequest()
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
            height:220px;
        }
    }

    @media only screen and (max-width: 359px) {
        textarea {
            height:240px;
        }
    }
    @media only screen and (max-width: 301px) {
        textarea {
            height:265px;
        }
    }


</style>
