<template>
    <div class="row">
        <div class="col-12 text-center">
            <h3>FriendsList</h3>
        </div>

        <ul v-for="friend in friends" class="col-12">
            <li><img :src="getImageUrl(friend)" alt=""></li>
            <a :href="getFriendUrl(friend.id)"><li>{{friend.name}}</li></a>
        </ul>

    </div>
</template>

<script>
    export default {
        name: "friendDisplay",
        props:[
            'friends_prop'
        ],
        data:function () {
            return{
                friends:null,
                defaultPicture:{
                    male:'/images/male.jpg',
                    female:'/images/female.jpg'
                }
            }
        },
        methods:{
            getFriendUrl(id){
                return '/user/'+id;
            },
            getImageUrl(friend){
                if(friend.image_url == ''){
                    if(friend.sex == 'male'){
                        return this.defaultPicture.male
                    } else {
                        return this.defaultPicture.female
                    }
                } else {
                    return '/storage/avatars/'+friend.image_url
                }
            }

        },
        beforeMount() {
            this.friends = JSON.parse(this.friends_prop);
        }
    }
</script>

<style scoped>

</style>
