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
                    <li class="list-group-item">sex: {{this.sex}}</li>
                    <li class="list-group-item">From: {{this.city}}</li>
                </ul>

                <!--Friends area -->
                <span>Friends:</span>
                <ul class="list-group position-relative">
                    <li class="position-absolute">
                        <a href="#" class="btn btn-secondary rounded-circle"><i class="fas fa-pen"></i></a>
                    </li>  <!--button to open popup adn edit data-->
                    <li class="list-group-item">Age: {{this.age}}</li>
                    <li class="list-group-item">sex: {{this.sex}}</li>
                    <li class="list-group-item">From: {{this.city}}</li>
                </ul>
            </div>
            <div class="col-xs-1"></div> <!--Phantom div to keep the content centered-->


           <!--  Content - could be reserved for past activities (played games and such)           -->
            <div class="col-lg-7 col-md-12 col-12">
                <ul class="list-group">
                    <li><span>Activity</span></li>

                    <li class="list-group-item mb-4" v-for="event in parsedEvents">
                        <h3>{{event.title}}</h3>
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
                parsedEvents:null
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

ul li:first-child{
    z-index: 1;
    right:-10px;
    top:-15px;
}

</style>
