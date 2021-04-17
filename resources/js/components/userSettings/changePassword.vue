<template>
    <div class="row ml-4 mr-4 pt-2 pb-2 border-bottom d-flex align-items-center">
        <!--label-->
        <div class="col-3 pt-2 pb-2">
            <span class="font-weight-bold text-left">Password</span>
        </div>

        <!-- the inputs -->
        <div class="col-5 pt-2 pb-2">
            <div>
                <div :class="{'d-none': !editing}">
                    <label class="d-block">Current password</label>
                    <input type="password" v-model="dataObj.oldPass">
                </div>
                <div :class="{'d-none': !editing}">
                    <label class="d-block">New password</label>
                    <input type="password" v-model="dataObj.password">
                </div>
                <div :class="{'d-none': !editing}">
                    <label class="d-block">Confirm new password</label>
                    <input type="password" v-model="dataObj.password_confirmation">
                </div>
                <div>
                    <span class="text-primary btn border-0 bg-light" @click="save" :class="{'d-none': !editing}">Save</span>
                </div>
            </div>
        </div>

        <!--Buttons change | save-->
        <div class="col-4 pt-2 pb-2 text-right">
            <span class="text-primary btn border-0 bg-light" @click="edit" :class="{'d-none': editing}">Change</span>
            <span class="text-primary btn border-0 bg-light" @click="close" :class="{'d-none': !editing}">Cancel</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "settingElement",
        data:function(){
            return{
                editing:false,
                dataObj:{
                    oldPass:null,
                    password:null,
                    password_confirmation:null
                }
            }
        },
        methods:{
            edit: function () {
                this.editing = true
            },
            close: function () {
                this.editing = false
            },
            checkPasswordsMatch(){
              if(this.dataObj.password === this.dataObj.password_confirmation){
                  return true;
              } else {
                  return false;
              }
            },
            makePostRequest: async function(){
                // await console.log(this.dataObj)
                try {
                    const resp = await axios.post('/api/changePassword',this.dataObj)
                    this.close()
                    console.log(resp.data)

                    //reseting the input fields
                    this.dataObj.oldPass = null
                    this.dataObj.password = null
                    this.dataObj.password_confirmation = null
                } catch(e){
                    console.log(e.response.data.errors) //this is what you will use to display all the errors
                }
            },
            save: async function () {

                this.makePostRequest()
                /*if(this.checkPasswordsMatch() === false){
                    console.log('passwords don\'t match');
                    console.log(this.checkPasswordsMatch())
                } else {
                    this.makePostRequest() //the post request
                }*/
            },
        },
        mounted(){
        }
    }
</script>

<style scoped>

</style>
