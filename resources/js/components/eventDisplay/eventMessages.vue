<template>
    <div>
        <h3>Messages</h3>

        <div>
            <!-- v-if - option 1 ->>> when a user who wrote a message is still a member of the event-->
            <div v-for="(message,index) in messages"
                 :key="index"
                 v-if="getUsersName(message.user_id)"
                 class="d-flex justify-content"
            >
                <img :src="getUsersImage(message.user_id)" alt="">
                <div>
                    <a :href="getUserUrl(message.user_id)">
                        <h5>{{getUsersName(message.user_id)}}</h5>
                    </a>
                    <div>{{message.message}}</div>
                </div>

            </div>
            <!--v-if - option 2 ->>> when a user who wrote a message is not a member of the event-->
            <ul v-else class="text-muted">
                <li><h5>Former member</h5></li>
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
                users:null,
                defaultPicture:{
                    male:'/images/male.jpg',
                    female:'/images/female.jpg'
                }
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
                return null;

            },
            getUsersImage(id){
                let found = false;
                let i = 0;

                while(i < this.users.length && found == false){
                    if(this.users[i].id == id){
                        found = true
                        if(this.users[i].image_url != ''){
                            return "/storage/avatars/"+ this.users[i].image_url
                        } else {
                            if(this.users[i].sex == 'male'){
                                return this.defaultPicture.male
                            } else {
                                return this.defaultPicture.female
                            }
                        }
                    }

                    i++;
                }
                return null;
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
    ul {
        list-style-type: none;
    }

    img {
        width:60px;
        border-radius: 50%;
    }
</style>
