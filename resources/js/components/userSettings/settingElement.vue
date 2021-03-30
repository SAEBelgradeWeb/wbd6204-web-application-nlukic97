<template>
    <div class="row ml-4 mr-4 pt-2 pb-2 border-bottom d-flex align-items-center">
        <div class="col-3 pt-2 pb-2">
            <span class="font-weight-bold text-left">{{this.columnLabel}}</span>
        </div>

        <div class="col-4 pt-2 pb-2">
            <span class="text-left text-muted text-break" :class="{'d-none': editing}">{{this.dataObj.data}}</span>
            <input :class="{'d-none': !editing}" type="text" v-model="dataObj.data">
            <span class="text-primary btn border-0 bg-light" @click="save" :class="{'d-none': !editing}">Save</span>
        </div>
        <div class="col-4 pt-2 pb-2 text-right">
            <span class="text-primary btn border-0 bg-light" @click="edit" :class="{'d-none': editing}">Edit</span>
            <span class="text-primary btn border-0 bg-light" @click="close" :class="{'d-none': !editing}">Cancel</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "settingElement",
        props:[
            'data',
            'column_name'
        ],
        data:function(){
            return{
                editing:false,
                columnLabel:null,
                dataObj:{
                    data:null,
                    column:null
                }
            }
        },
        methods:{
            edit: function () {
                this.editing = true
            },
            close: function () {
                this.editing = false
            },
            save: async function () {

                let items = {}
                items[this.dataObj.column] = this.dataObj.data
                console.log(items)

                try {
                    const resp = await axios.post('http://wbd6204-final.test/api/accountSettings',items)
                    this.close()
                    console.log(resp.data)
                } catch(e){
                    console.log(e)
                }
            },
        },
        mounted(){
            this.dataObj.data = this.data
            this.dataObj.column = this.column_name

            this.columnLabel = this.column_name[0].toUpperCase() + this.column_name.slice(1);
        }
    }
</script>

<style scoped>

</style>
