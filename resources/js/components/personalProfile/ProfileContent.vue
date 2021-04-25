<template>
    <div>
        <about-profile-modal
            :viewModal="modalOpen"
            @closeAboutModal="modalOpen = $event"
            :age="age"
            :sex="sex"
            :city="city"
        />

        <div class="row">
            <div class="col-lg-1 col-md-1 col-1"></div> <!--phantom div -->
            <div class=" col-lg-4 col-md-10 col-10">

                <!--About area-->
                <h4 class="pl-2">About</h4>
                <ul class="list-group position-relative">
                    <li class="position-absolute">
                        <span @click='aboutModal' class="btn btn-secondary rounded-circle"><i class="fas fa-pen"></i></span>
                    </li>  <!--button to open popup adn edit data-->
                    <li class="list-group-item">Age: {{this.age}}</li>
                    <li class="list-group-item">Sex: {{this.sex}}</li>
                    <li class="list-group-item">From: {{this.city}}</li>
                </ul>

                <!--Friends area -->
                <div class="d-flex justify-content-between pt-3">
                    <h4 class="pl-2">Friends</h4>
                    <p class="d-inline-block pr-2"><a :href="getFriendsUri()">See all</a></p>
                </div>
                <div class="card pl-3 pr-3">
                    <div class="row">
                        <div class="col-4 text-center pb-2 pt-3" v-for="friend in previewFriends">
                            <div>
                                <img :src="getFriendAvatar(friend)" alt=""> <!--For some reason, I am not able to make this into a constant square-->
                            </div>
                            <a :href="makeFriendUrl(friend)"><span>{{friend.name}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-1"></div> <!--Phantom div to keep the content centered-->


           <!--  Content - could be reserved for past activities (played games and such)           -->
            <div class="col-lg-7 col-md-12 col-12">
                <ul class="list-group">
                    <li><h4 class="text-center">Events</h4></li>

                    <li class="list-group-item mb-4" v-for="event in parsedEvents">
                        <a :href="makeEventUrl(event)"><h4>{{event.title}}</h4></a>
                        <p>{{event.date}} at {{event.time}}</p>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import AboutProfileModal from './AboutProfileModal.vue';

    export default {
        name: "ProfileContent",
        props:[
            'age',
            'sex',
            'city',
            'events',
            'friends_prop',
            'id_prop'
        ],
        components:{
          AboutProfileModal
        },
        data:function(){
            return {
                modalOpen:false,
                parsedEvents:null,
                previewFriends:[],
                defaultPicture:{
                    male:'/images/male.jpg',
                    female:'/images/female.jpg'
                }
            }
        },
        methods:{
            aboutModal(){
                if(this.modalOpen === true){
                    this.modalOpen = false //this is necessary, since the modal will remain true once we exit it.
                } else {
                    this.modalOpen = true
                }
            },
            makeEventUrl(event){
                return '/event/' + event.id
            },
            makeFriendUrl(friend){
                return '/user/' + friend.id
            },
            getFriendsUri(){
                return '/friends/'+this.id_prop;
            },
            getFriendAvatar(friend){
                if(friend.image_url === ''){
                    if(friend.sex === 'male'){
                        return this.defaultPicture.male
                    } else {
                        return this.defaultPicture.male
                    }
                } else {
                    return "/storage/avatars/"+friend.image_url //this should be changed. The user in the links messes up the entire thing
                }
            }
        },
        mounted() {
            if(this.events != null && this.events != '' && this.events != []){
                this.parsedEvents = JSON.parse(this.events)

                //sorting the event based on the timestamp (when it was added)
                this.parsedEvents.sort(function(a,b){
                    return b.timestamp - a.timestamp;
                })
            }

            this.previewFriends = (JSON.parse(this.friends_prop)).slice(0,9)
        }
    }
</script>

<style scoped>
    ul {
        list-style-type:none;

    }

    ul.position-relative li:first-child{
        z-index: 1;
        right:-10px;
        top:-15px;
    }

    .col-4 div {
        overflow: hidden;
    }

    .col-4 img {
        width: 100%;
        border-radius: 10px;
    }

</style>
