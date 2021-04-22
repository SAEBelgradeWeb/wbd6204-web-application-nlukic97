<template>
    <div>
        <h1>this is the event search vue</h1>
        <div>
            <label for="query">Search</label>
            <input type="text" name="query" id="query">
        </div>

        <div>
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id">
                <option value="" selected>All</option>
                <option v-for="location in locations" :value="location.id">{{location.city}}</option>
            </select>
        </div>

    </div>
</template>

<script>
    export default {
        name: "userSearch",
        data:function(){
            return{
                locations:null,
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
        },
        beforeMount() {
            this.getLocations()
        }
    }
</script>

<style scoped>

</style>
