<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="form-row">
                <select name="location_id" id="location_id" class="form-control" @input="handleSelectChange($event)">
                    <option value="0" selected>All</option>
                    <option v-for="location in locations" :value="location.id">{{location.city}}</option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6" v-for="event in events">
                <ul class="m-3 p-0 card d-flex justify-content-center pl-3 pr-3 pt-3 pb-2">
                    <li>
                        <div class="d-flex justify-content-between">
                            <h4><a :href="getEventURI(event.id)">{{event.title}}</a></h4>
                            <p class="d-inline-block">{{event.location.city}}</p>
                        </div>
                    </li>
                    <li><span>Players:</span> {{event.player_num}}.</li>
                    <li><span>Court:</span> "{{event.court.title}}"</li>
                    <li><span>Address:</span> {{event.court.address}}, {{event.location.city}}.</li>
                    <li><span>Time:</span> {{event.date}} at {{event.time}}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "eventSearch",
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
    ul {
        list-style-type:none;
        margin:0;
        /*padding:0!important;*/
    }

    span {
        font-weight: bold;
    }
</style>
