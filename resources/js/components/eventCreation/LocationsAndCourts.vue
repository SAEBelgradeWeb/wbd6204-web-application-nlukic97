<template>
    <div>
        <div class="form-group row">
            <label for="cities" class="form-text m-0">City</label>
            <select class="form-control" name="cities" id="cities" @change="addCourts">
                <option value=""></option>
                <option v-for="city in cities" :value="city.id">{{city.city}}</option>
            </select>
        </div>

        <div class="form-group row">
            <label for="court_id" class="form-text m-0">Court</label>
            <select class="form-control" name="court_id" id="court_id" :class="{'d-none' : this.displayCourtSelect === false}">
                <option value=""></option>
                <option v-for="court in courts" :value="court.id">{{court.title}} - {{court.price}} $</option>
            </select>
            <span :class="{'d-none' : this.displayCourtSelect === true, 'text-danger form-control bg-light' : 1 == 1}">Please select a city</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LocationsAndCourts",
        data:function(){
            return {
                cities:null,
                courts:{},
                displayCourtSelect:false
            }
        },
        methods:{
            courtDisplay(){
              if(this.courts === null || this.courts.length <= 0){
                  this.displayCourtSelect = false
              } else {
                  this.displayCourtSelect = true
              }
            },
            async getLocations(){
                try {
                    let result = await axios.get('/api/getLocations')
                    this.cities = result.data
                } catch (e) {
                    console.log(e)
                }
            },
            async addCourts(){
                let location_id = event.target.value
                if(location_id != '' && location_id != null){
                    try {
                        let result = await axios.get(`/api/getCourts/${location_id}`)
                        this.courts = result.data
                        console.log(this.courts.length)
                    } catch (e) {
                        console.log(e)
                    }
                } else {
                    this.courts = null
                }

                this.courtDisplay()

            }
        },
        beforeMount() {
            this.getLocations()
        }
    }
</script>

<style scoped>

</style>
