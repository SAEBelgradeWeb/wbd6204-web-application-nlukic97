<template>
    <div>
        <h3>Info</h3>
        <ul>
            <li>Players: {{(this.parsedEvent.users).length}} / {{this.parsedEvent.player_num}}</li>
            <li>Host: <a :href="getUserUrl(this.parsedHost.id)">{{this.parsedHost.name}}</a></li>
            <li>"{{this.parsedCourt.title}}", {{this.parsedCourt.address}}, {{this.city}}</li>
        </ul>

        <h3>Participants</h3>
        <ul>
            <a v-for="participant in parsedEvent.users" :href="getUserUrl(participant.id)"><li>{{participant.name}}</li></a>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "eventInfo",
        props:[
            'event',
            'court',
            'city',
            'host'
        ],
        data:function(){
            return{
                parsedEvent:null,
                parsedCourt:null,
                parsedHost:null
            }
        },
        methods:{
            getUserUrl(id){
                return `/user/${id}`
            }
        },
        beforeMount() {
            this.parsedEvent = JSON.parse(this.event)
            this.parsedHost = JSON.parse(this.host)
            this.parsedCourt = JSON.parse(this.court)

        }
    }
</script>

<style scoped>
    ul {
        list-style-type: none;
    }
</style>
