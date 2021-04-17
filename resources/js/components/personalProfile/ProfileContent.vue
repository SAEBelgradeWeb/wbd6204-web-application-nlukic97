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
                <span>About:</span>
                <ul class="list-group position-relative">
                    <li class="position-absolute">
                        <span @click='aboutModal' class="btn btn-secondary rounded-circle"><i class="fas fa-pen"></i></span>
                    </li>  <!--button to open popup adn edit data-->
                    <li class="list-group-item">Age: {{this.age}}</li>
                    <li class="list-group-item">Sex: {{this.sex}}</li>
                    <li class="list-group-item">From: {{this.city}}</li>
                </ul>

                <!--Friends area -->
                <!--<span>Friends:</span>
                <ul class="row pl-3 pr-3">
                    <li class="col-4 text-center pb-3 list-group-item" v-for="friend in userFriends">
                        <img :src="friend.url" alt="">
                        <a href="#"><span>{{friend.name}}</span></a>
                    </li>
                </ul>-->


                <span>Friends:</span>
                <div class="card pl-3 pr-3">
                    <div class="row">
                        <div class="col-4 text-center pb-2 pt-3" v-for="friend in userFriends">
                            <div>
                                <img :src="friend.url" alt="">
                            </div>
                                <a href="#"><span>{{friend.name}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-1"></div> <!--Phantom div to keep the content centered-->


           <!--  Content - could be reserved for past activities (played games and such)           -->
            <div class="col-lg-7 col-md-12 col-12">
                <ul class="list-group">
                    <li><span>Activity</span></li>

                    <li class="list-group-item mb-4" v-for="event in parsedEvents">
                        <a :href="makeEventUrl(event)"><h3>{{event.title}}</h3></a>
                        <p>Time: {{event.time}}</p>
                        <p>Date: {{event.date}}</p>
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
            'events'
        ],
        components:{
          AboutProfileModal
        },
        data:function(){
            return {
                modalOpen:false,
                parsedEvents:null,
                userFriends:[
                    {
                        name:'Marco Pollo',
                        url: 'https://scontent.fbeg2-1.fna.fbcdn.net/v/t1.18169-9/18700068_1883259148600429_2031035661274321606_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=8bfeb9&_nc_ohc=XBwY_jbiH9AAX90wEg7&_nc_ht=scontent.fbeg2-1.fna&oh=d33cc7bc7fa09d5c058fcbcd11f927c3&oe=609F67F0'
                    },
                    {
                        name:'Marko Rajicic',
                        url:"https://scontent.fbeg2-1.fna.fbcdn.net/v/t1.6435-9/119250782_421238228850852_8999155532724420407_n.jpg?_nc_cat=107&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=FK7XXrhaGU8AX-TzT5j&_nc_ht=scontent.fbeg2-1.fna&oh=046856ea71cb6739d15c9a3b34b46c09&oe=60A0F501"
                    },
                    {
                        name:'Oleg Marcus',
                        url: 'data:image/png;base64,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'
                    },
                    {
                        name:'Oleg Marcus',
                        url: 'https://scontent.fbeg2-1.fna.fbcdn.net/v/t1.6435-9/47575275_2188901058036235_6455482209783513088_n.jpg?_nc_cat=106&ccb=1-3&_nc_sid=a4a2d7&_nc_ohc=oDBzvZY-59wAX8TxIgF&_nc_ht=scontent.fbeg2-1.fna&oh=908024210e5319e12cd5ad5f81bbca44&oe=60A07A0B'
                    },
                    {
                        name:'Oleg Marcus',
                        url: 'data:image/png;base64,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'
                    },
                    {
                        name:'Oleg Marcus',
                        url: 'https://play-lh.googleusercontent.com/IeNJWoKYx1waOhfWF6TiuSiWBLfqLb18lmZYXSgsH1fvb8v1IYiZr5aYWe0Gxu-pVZX3'
                    },
                    {
                        name:'Oleg Marcus',
                        url: 'https://play-lh.googleusercontent.com/IeNJWoKYx1waOhfWF6TiuSiWBLfqLb18lmZYXSgsH1fvb8v1IYiZr5aYWe0Gxu-pVZX3'
                    },
                    {
                        name:'Oleg Marcus',
                        url: 'data:image/png;base64,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'
                    },
                    {
                        name:'Oleg Marcus',
                        url: 'https://play-lh.googleusercontent.com/IeNJWoKYx1waOhfWF6TiuSiWBLfqLb18lmZYXSgsH1fvb8v1IYiZr5aYWe0Gxu-pVZX3'
                    }
                ]
            }
        },
        methods:{
            aboutModal(){
                if(this.modalOpen === true){
                    this.modalOpen = false //this is necessary, since the modal will remain true once we exit it.
                    // this.modalOpen = true
                } else {
                    this.modalOpen = true
                }
            },
            makeEventUrl(event){
                return '/event/' + event.id
            }
        },
        mounted() {
            if(this.events != null && this.events != '' && this.events != []){
                this.parsedEvents = JSON.parse(this.events)
                this.parsedEvents.sort(function(a,b){
                    return b.timestamp - a.timestamp;
                })
            }
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
        /*border: 1px solid red;*/
        overflow: hidden;
    }

    .col-4 img {
        max-width: 100%;
    }

</style>
