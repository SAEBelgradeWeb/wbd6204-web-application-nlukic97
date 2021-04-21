<template>
    <div>
        <h3>Messages</h3>

        <div>
            <ul v-for="(message,index) in messages" :key="index">
<!--                <li><a :href="getUserUrl(message.user_id)">{{users[index].name}}</a></li> &lt;!&ndash; the index of a user is their id. So, we can get their name &ndash;&gt;-->
                <li><a :href="getUserUrl(message.user_id)">{{getUsersName(message.user_id)}}</a></li> <!-- the index of a user is their id. So, we can get their name -->
                <li>The users id: {{message.user_id}}</li>
                <li>{{message.message}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "eventMessages",
        props:[
            'prop_messages',
            'prop_users'
        ],
        data:function(){
            return{
                messages:null,
                users:null
            }
        },
        methods:{
            getUserUrl(id){
                return '/user/'+id;
            },
            getUsersName(id){
                let found = false;
                let i = 0;

                while(i < this.users.length && found == false){
                    if(this.users[i].id == id){
                        found = true
                        return this.users[i].name
                    }

                    i++;
                }

            },
            parseProps(){
                this.messages = JSON.parse(this.prop_messages)
                this.users = JSON.parse(this.prop_users)
            }
        },
        beforeMount() {
            this.parseProps()
        }
    }
</script>

<style scoped>

</style>
