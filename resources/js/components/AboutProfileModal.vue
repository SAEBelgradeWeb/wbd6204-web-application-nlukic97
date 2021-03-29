<template>
    <div>
         <div id="modal" :class="this.viewModal.toString()"> <!--You had 'viewModal' here.-->
             <div class="row d-flex justify-content-center">
                 <div id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3">

                     <!-- Age updating field -->
                     <div class="input-group mb-3">
                         <div class="input-group-prepend">
                             <span class="input-group-text">Age</span>
                         </div>
                         <input type="number" class="form-control" min="0" max="130" :value="currentAge" @input="processAge($event)">
                     </div>

                     <!-- Sex update field -->
                     <div class="input-group mb-3">
                         <div class="input-group-prepend">
                             <span class="input-group-text">Sex</span>
                         </div>
                         <select name="sex" id="sex" class="form-control" @input="processSex($event)">
                             <option value="male" :selected="this.currentSex === 'male'">male</option>
                             <option value="female" :selected="this.currentSex === 'female'">female</option>
                         </select>
                     </div>

                     <!--city updating field -->
                     <div class="input-group mb-3">
                         <div class="input-group-prepend">
                             <span class="input-group-text">City</span>
                         </div>
                         <select name="location_id" id="location_id" class="form-control" @input="processCity($event)">
                             <option  v-for="item in cities" :key="item.id" :value="item.id" :selected="item.city === currentCity">{{item.city}}</option>
                         </select>
                     </div>

                     <div class="text-center">
                         <span @click='submitChanges' class="btn btn-primary mb-3">Save</span>
                     </div>
                 </div>
             </div>
         </div>
    </div>
</template>

<script>
    export default {
        name: "AboutProfileModal",
        props:[
            'viewModal',
            'age',
            'sex',
            'city'
        ],
        data:function(){
            return {
                cities:[],
                currentAge:null,
                currentSex:null, //for the sex selected option
                currentCity: null, //for the city selected option,
                newData:{
                    age:null,
                    sex:null,
                    location_id:null
                }
            }
        },
        methods:{
            async getLocations(){
                  try {
                      let result = await axios.get('http://wbd6204-final.test/api/getLocations')
                      this.cities = result.data

                      this.addPropData()
                  } catch (e) {
                      console.log(e)
                  }
            },
            addPropData(){ //getting data from props into their own data elements to be referenced upon opening modal
                this.currentAge = this.age
                this.currentSex = this.sex
                this.currentCity = this.city

                //adding data that might be submitted (if the user clicks submit without changing anything)
                    this.newData = {
                        age: parseInt(this.age),
                        sex: this.sex

                    }

                    //check which city in cities matches the city prop, and assigning its id to newData.city
                    for(let i = 0; i < this.cities.length; i++){
                        if(this.cities[i].city === this.city){
                            this.newData.location_id = this.cities[i].id;
                            break; //once city is found, end loop
                        }
                    }
            },

            // Upon changing any of the data elements, the three methods underneath will be fired, updating this field (unable to use v-model for sex and city)
            processAge(event){
                this.newData.age = parseInt(event.target.value)
            },
            processCity(event){
                this.newData.location_id = parseInt(event.target.value)
            },
            processSex(event){
                this.newData.sex = event.target.value
            },
            /*Telling the parent component (ProfileContent) that to change the viewModal prop to false.*/
            closeModal(){
                this.$emit('closeAboutModal',false)
            },
            //axios post request to update the users table
            submitChanges(){
                console.log(this.newData)
                try {
                    axios({
                        method: 'post',
                        url: 'http://wbd6204-final.test/api/updateAboutInfo',
                        data: this.newData
                    })
                    .then(response=>{
                        console.log(response)
                        this.closeModal()
                        //location.reload() //if the response is successful, reload the page to display the updated data.
                    });
                } catch(e){
                    console.log(e)
                }
            }
        },
        mounted(){
            this.getLocations()

        }

    }
</script>

<style scoped>
    #modal.true {
        background-color: rgba(0, 0, 0, 0.65);
        width:100%;
        height:100%;
        position: fixed;
        left:0;
        top:0;
        bottom:10px;
        z-index:3;
        padding-top: 20vh;
    }

    #modal.false {
        display:none;
    }

    ul {
        padding:20px;
    }
</style>
