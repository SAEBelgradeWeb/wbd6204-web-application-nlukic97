<template>
    <div class="row d-flex justify-content-center mb-4">
        <div class="col-lg-8 col-md-8 col-10 text-center">

            <!--Displayed if the bio passed as a prop is not null or '' -->
            <div
                class="text-center"
                :class="{'d-none': !this.hideBio}"
            >
                <span class="text-break">{{this.userBio}}</span>
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
                hideBio:null
            }
        },
        methods:{
            checkBioPresence(){
                if(this.userBio === '' || this.userBio === null || !this.userBio){
                    this.hideBio = false;
                } else {
                    this.hideBio = true;
                }
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
