<template>
    <div>
        <div class="form-group">
        <label for="message" class="font-weight-bold">Send message</label>
            <textarea v-model="sendData.message" name="message" id="message" class="form-control"></textarea>
            <span @click="sendMsg" class="btn btn-primary float-right">Send</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "sendMessageBox",
        props:[
            'event_id_prop'
        ],
        data:function () {
            return{
                sendData:{
                    message:null,
                    event_id:null
                }
            }
        },
        methods:{
            updateMsg(event){
                this.sendData.message = event.data
            },
            sendMsg(){
                if(this.sendData.message != null && this.sendData.message != ''){
                    console.log(this.sendData)
                    this.axiosMsgPost()
                }
            },
            async axiosMsgPost(){
                try {
                    let response = await axios.post('/api/sendMessage',this.sendData);
                    console.log(response.data)
                } catch(e){

                }
            }
        },
        beforeMount() {
            this.sendData.event_id = parseInt(this.event_id_prop)
        }
    }
</script>

<style scoped>

</style>
