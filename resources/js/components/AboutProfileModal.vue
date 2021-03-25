<template>
    <div>
         <div id="modal" :class="this.viewModal.toString()"> <!--You had 'viewModal' here.-->
             <div class="row d-flex justify-content-center">
                 <div id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3">
                     <ul class="list-group bg-white"> <!-- add a button here -->
                         <li class="list-group-item">Age: {{this.age}}</li>
                         <li class="list-group-item">Sex: {{this.sex}}</li>
                         <li class="list-group-item">From: {{this.city}}</li>
                     </ul>
                     <div class="text-center">
                         <span @click='closeModal' class="btn btn-primary mb-3">Save</span>
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
        methods:{
            closeModal(){ /*Telling the parent component (ProfileContent) that to change the viewModal prop to false.*/
                this.$emit('closeAboutModal',false)
            }
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
