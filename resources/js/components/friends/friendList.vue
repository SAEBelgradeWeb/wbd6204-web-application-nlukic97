<template>
    <div class="row d-flex justify-content-around">
        <div v-for="friend in friends" class="card mb-2 col-lg-8 col-md-7 col-sm-9 col-10">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div><img :src="getImageUrl(friend)" alt=""></div>
                <a :href="getFriendUrl(friend.id)"><h3 class="pl-4">{{friend.name}}</h3></a>
            </div>
        </div>

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
    div.card-body {
        height:122px;
    }
    img {
        border-radius: 50%;
        height: 80px;
        width: 80px;

    }

</style>
