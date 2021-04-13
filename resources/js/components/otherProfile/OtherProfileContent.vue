<template>
    <div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-1"></div> <!--phantom div -->
            <div class=" col-lg-4 col-md-10 col-10">

                <!--About area-->
                <span>About:</span>
                <ul class="list-group">
                    <li class="list-group-item">Age: {{this.age}}</li>
                    <li class="list-group-item">sex: {{this.sex}}</li>
                    <li class="list-group-item">From: {{this.city}}</li>
                </ul>

                <!--Friends area -->
                <span>Friends:</span>
                <ul class="list-group">
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
    export default {
        name: "ProfileContent",
        props:[
            'age',
            'sex',
            'city',
            'events'
        ],
        data:function(){
            return {
                parsedEvents:null
            }
        },
        methods:{
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

</style>
