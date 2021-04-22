<template>
    <div>
        <h1>this is the event search vue</h1>
        <div>
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id" @input="handleSelectChange($event)">
                <option value="0" selected>All</option>
                <option v-for="location in locations" :value="location.id">{{location.city}}</option>
            </select>

            <ul v-for="event in events">
                <li><a :href="getEventURI(event.id)">{{event.title}}</a></li>
                <li>{{event.date}} {{event.time}}</li>
                <li>{{event.location.city}}</li>
                <li>Max players: {{event.player_num}}</li>
                <li>Court name: {{event.court.title}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "userSearch",
        data:function(){
            return{
                locations:null,
                selectedValue:0,
                events:null
            }
        },
        methods:{
            async getLocations(val){
                try {
                    let result = await axios.get('/api/getLocations')
                    this.locations = result.data
                } catch(e){
                    console.log(e)
                }
            },
            handleSelectChange(event){ //v-model does not work with this
                this.selectedValue = parseInt(event.target.value)
                this.eventSearch(this.selectedValue)
            },
            async eventSearch(data){
                try {
                    let response = await axios.post('/api/event-search',{id:data})
                    this.events = response.data
                    console.log(this.events)
                } catch(e){
                    console.log(e)
                }
            },
            getEventURI(id){
                return `/event/${id}`
            }
        },
        beforeMount() {
            this.selectedValue = 0;
            this.getLocations()
            this.eventSearch(this.selectedValue)
        }
    }
</script>

<style scoped>

</style>
