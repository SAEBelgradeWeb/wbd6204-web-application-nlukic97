<template>
    <div class="row d-flex justify-content-center mb-3">
        <div class="d-flex justify-content-start align-items-center col-6">
            <div><img :src="getImageUrl()" alt=""></div>
            <a :href="getFriendUrl()"><h3 class="pl-4">{{this.user.name}}</h3></a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "individualUserResult",
        props:[
            'user_prop',
            'city_prop'
        ],
        data:function(){
            return{
                user:null,
                city:null,
                defaultPicture:{
                    male:'/images/male.jpg',
                    female:'/images/female.jpg'
                }
            }
        },
        methods:{
            transferProps(){
                this.user = JSON.parse(this.user_prop)
                this.city = this.city_prop;
            },
            getFriendUrl(){
                return '/user/'+this.user.id;
            },
            getImageUrl(){
                if(this.user.image_url == ''){
                    if(this.user.sex == 'male'){
                        return this.defaultPicture.male
                    } else {
                        return this.defaultPicture.female
                    }
                } else {
                    return '/storage/avatars/'+this.user.image_url
                }
            }

        },
        beforeMount(){
            this.transferProps()

        },
        mounted() {
        }
    }
</script>

<style scoped>
    div.card-body {
        height:122px;
    }
    img {
        border-radius: 10px;
        width: 100px;
        height: 100px;
    }

</style>
