<template>
    <div class="row ml-4 mr-4 pt-2 pb-2 border-bottom d-flex align-items-center">
        <div class="col-2 pt-2 pb-2">
            <span class="font-weight-bold text-left">Name</span>
        </div>

        <div class="col-8 pt-2 pb-2">
            <span class="text-left d-block text-muted text-break">{{this.display}}</span>
        </div>
        <div class="pt-2 pb-2 col-1 text-right">
            <span class="text-primary btn border-0 bg-light">Edit</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "settingElement",
        props:[
            'data'
        ],
        data:function(){
            return{
                display:null
            }
        },
        methods:{
        },
        mounted(){
            this.display = this.data
        }
    }
</script>

<style scoped>

</style>
