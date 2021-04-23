<template>
    <div>
        <h1>this is the event search vue</h1>
        <div>
            <label for="query">Search</label>
            <input type="text" name="query" id="query" :value="this.getRequestData.query">
        </div>

        <div>
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id">
                <option value="" :selected="this.getRequestData.location_id === '' ">All</option>

                <option
                    :selected="location.id == getRequestData.location_id"
                    v-for="location in locations"
                    :value="location.id"
                >{{location.city}}
                </option>

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
                getRequestData: {
                    location_id:'',
                    query:''
                }
            }
        },
        methods:{
            async getLocations(val){ //get locations to be displayed in dropdown
                try {
                    let result = await axios.get('/api/getLocations')
                    this.locations = result.data
                } catch(e){
                    console.log(e)
                }
            },
            getParams(){ //return the get parameters of a search query.
                let obj = {}
                let paramsString = location.search.substr(1).split('&');

                //so only if there are get parameters in the search
                if(paramsString !== '' && paramsString != null){ //if there is no parameters
                    paramsString.forEach((param)=>{
                        let tmp = param.split('=')
                        obj[tmp[0]] = tmp[1]
                    })
                    this.getRequestData = obj;
                    console.log(this.getRequestData)
                }

            }
        },
        beforeMount() {
            this.getLocations()
            this.getParams()
        }
    }
</script>

<style scoped>

</style>
