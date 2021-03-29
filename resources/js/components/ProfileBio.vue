<template>
    <div class="row d-flex justify-content-center mb-4">
        <div class="col-lg-8 col-md-8 col-10 text-center">

            <!--Displayed if the bio passed as a prop is not null or '' -->
            <div
                class="text-center"
                :class="{'d-none': !this.bioPresent}"
            >
                <i>{{this.userBio}}</i>
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
                bioPresent:null, //will or will not show the bio
                hideAddButton:false, //class binding: show or hide the 'add bio' btn
                hideTextArea:true, //hide or show the bio editing text area,
                submitData:{
                    bio:null
                }
            }
        },
        methods:{
            toggleElementsDisplay(){
                this.hideAddButton = !this.hideAddButton;
                this.hideTextArea = !this.hideTextArea;
            },
            alterBio(){
              this.toggleElementsDisplay()
            },
            postRequest(){
                axios({
                    method: 'post',
                    url: 'http://wbd6204-final.test/api/updateBio',
                    data: this.submitData
                })
                    .then(res=>{
                        console.log(res)
                    })
            },
            saveBio(){
                this.submitData.bio = this.$refs.textareaObj.value
                console.log(this.submitData)
                this.postRequest()



                this.toggleElementsDisplay()
                // this.contentEditable = false
            }
        },
        mounted() {
            if(this.bio === '' || this.bio === null || !this.bio){
                this.bioPresent = false;
                this.hideAddButton = false;
                this.hideTextArea = true;
                console.log('not there')
            } else {
                this.userBio = this.bio

                this.bioPresent = true;
                this.hideAddButton = true;
                this.hideTextArea = true;
            }

            // this.alterBio()
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
