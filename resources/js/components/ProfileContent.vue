<template>
    <div>
<!--        <profile-modal></profile-modal>-->
        <div class="row">
            <div class="col-lg-1 col-md-1 col-1"></div> <!--phantom div -->
            <div class=" col-lg-4 col-md-10 col-10">

                <!--About area-->
                <span>About:</span>
                <ul class="list-group position-relative">
                    <li class="position-absolute">
                        <span @click='aboutModal' class="btn btn-secondary rounded-circle"><i class="fas fa-pen"></i></span>
                    </li>  <!--button to open popup adn edit data-->
                    <li class="list-group-item">Age: {{this.age}}</li>
                    <li class="list-group-item">sex: {{this.sex}}</li>
                    <li class="list-group-item">From: {{this.city}}</li>
                </ul>

                <!--Friends area -->
                <span>Friends:</span>
                <ul class="list-group position-relative">
                    <li class="position-absolute">
                        <a href="#" class="btn btn-secondary rounded-circle"><i class="fas fa-pen"></i></a>
                    </li>  <!--button to open popup adn edit data-->
                    <li class="list-group-item">Age: {{this.age}}</li>
                    <li class="list-group-item">sex: {{this.sex}}</li>
                    <li class="list-group-item">From: {{this.city}}</li>
                </ul>
            </div>
            <div class="col-xs-1"></div> <!--Phantom div to keep the content centered-->


           <!--  Content - could be reserved for past activities (played games and such)           -->
            <div class="col-lg-7 col-md-12 col-12">
                <ul class="list-group">
                    <li><span>Activity</span></li>

                    <li class="list-group-item">
                        <h3>Dummy title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ipsum non quos reprehenderit sit. Eius placeat qui quod recusandae! Assumenda dolore dolorem eaque eligendi eum exercitationem, facilis harum id maiores, non quibusdam repellat saepe sint veniam voluptatem! Debitis, fugiat mollitia.</p>
                    </li>

                    <li class="list-group-item">
                        <h3>Dummy title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ipsum non quos reprehenderit sit. Eius placeat qui quod recusandae! Assumenda dolore dolorem eaque eligendi eum exercitationem, facilis harum id maiores, non quibusdam repellat saepe sint veniam voluptatem! Debitis, fugiat mollitia.</p>
                    </li>

                    <li class="list-group-item">
                        <h3>Dummy title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ipsum non quos reprehenderit sit. Eius placeat qui quod recusandae! Assumenda dolore dolorem eaque eligendi eum exercitationem, facilis harum id maiores, non quibusdam repellat saepe sint veniam voluptatem! Debitis, fugiat mollitia.</p>
                    </li>

                    <li class="list-group-item">
                        <h3>Dummy title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ipsum non quos reprehenderit sit. Eius placeat qui quod recusandae! Assumenda dolore dolorem eaque eligendi eum exercitationem, facilis harum id maiores, non quibusdam repellat saepe sint veniam voluptatem! Debitis, fugiat mollitia.</p>
                    </li>

                    <li class="list-group-item">
                        <h3>Dummy title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ipsum non quos reprehenderit sit. Eius placeat qui quod recusandae! Assumenda dolore dolorem eaque eligendi eum exercitationem, facilis harum id maiores, non quibusdam repellat saepe sint veniam voluptatem! Debitis, fugiat mollitia.</p>
                    </li>

                    <li class="list-group-item">
                        <h3>Dummy title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ipsum non quos reprehenderit sit. Eius placeat qui quod recusandae! Assumenda dolore dolorem eaque eligendi eum exercitationem, facilis harum id maiores, non quibusdam repellat saepe sint veniam voluptatem! Debitis, fugiat mollitia.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    // import ProfileModal from './ProfileModal.vue';

    export default {
        name: "ProfileContent",
        props:[
            'age',
            'sex',
            'city'
        ],
        // components:{
        //   ProfileModal
        // },
        data:function(){
            return {
                modalOpen:false
            }
        },
        methods:{
            aboutModal(){
                console.log('about model open: '+ this.modalOpen)
                if(this.modalOpen === false){
                    this.modalOpen = true
                } else {
                    this.modalOpen = false
                }
            }
        }
    }
</script>

<style scoped>
ul {
    list-style-type:none;

}

ul li:first-child{
    z-index: 1;
    right:-10px;
    top:-15px;
}
</style>
