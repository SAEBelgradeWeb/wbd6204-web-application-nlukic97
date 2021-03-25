<template>
    <div>
         <div id="modal" :class="toggleModal()">
             <div class="row d-flex justify-content-center">
                 <div id="box" class="col-lg-6 col-md-8 col-10">
                     <ul @click='closeModal' class="list-group"> <!-- add a button here -->
                         <li class="list-group-item">Age: {{this.age}}</li>
                         <li class="list-group-item">Sex: {{this.sex}}</li>
                         <li class="list-group-item">From: {{this.city}}</li>
                     </ul>
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
                viewable: false
            }
        },
        methods:{
            toggleModal(){
                return this.viewModal.toString()
            },
            closeModal(){
                this.viewModal = 'false' //Do not mutate a prop directly
            }
        },
        mounted(){
            console.log(this.viewModal)
        }

    }
</script>

<style scoped>
    #modal.true {
        background-color: rgba(0, 0, 0, 0.45);
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
</style>
