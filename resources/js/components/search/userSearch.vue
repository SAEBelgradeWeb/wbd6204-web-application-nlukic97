<template>
    <div class="row d-flex justify-content-center">
        <div class="form-group col-md-3 col-10">
            <label for="query">Search</label>
            <input class='form-control' type="text" name="query" id="query" :value="this.getRequestData.query">
        </div>

        <div class="form-group col-md-3 col-10">
            <label for="location_id">Location</label>
            <select class='form-control' name="location_id" id="location_id">
                <option value="" :selected="this.getRequestData.location_id === '' ">All</option>

                <option
                    :selected="location.id == getRequestData.location_id"
                    v-for="location in locations"
                    :value="location.id"
                >{{location.city}}
                </option>

            </select>
        </div>
        <div class="form-group col-md-2 col-10 text-center">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "userSearch",
        props:[
            'query_prop',
            'location_id_prop'
        ],
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
            assignParams(){ //return the get parameters of a search query.
                let obj = {}
                this.getRequestData = {
                    location_id: this.location_id_prop,
                    query: this.query_prop,
                }

            }
        },
        beforeMount() {
            this.getLocations()
            this.assignParams()
        }
    }
</script>

<style scoped>
    button {
        margin-top:31px;
    }

</style>
