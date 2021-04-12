<template>
    <div>
        <div id="modal" :class="this.viewable.toString()"> <!--You had 'viewModal' here.-->
            <div class="row d-flex justify-content-center">
                <div id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3">

                    <!-- image updating field -->
                    <div class="input-group mb-3">
                        <input type="file" class="form-control d-inline-block">
                    </div>

                    <div class="text-center">
                        <span @click="saveChanges" class="btn btn-primary mb-3">Save</span>
                        <span @click="closeModal" class="btn btn-secondary mb-3">Cancel</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AvatarFormModal",
        data:function(){
            return {
            }
        },
        props:[
          'viewable'
        ],
        methods:{
            closeModal(){
                console.log('closeModal')
                this.$emit('closeAvatarModal',false)
            },
            saveChanges(){
                console.log('saveChanges')
                this.closeModal() //for now
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
        z-index:4;
        padding-top: 20vh;
    }

    #modal.false {
        display:none;
    }

    ul {
        padding:20px;
    }
</style>
