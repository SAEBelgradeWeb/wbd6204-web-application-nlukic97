<template>
    <div>
        <div class="row">
            <div class="position-relative col-lg-3 col-md-11 col-10">
                <div class="position-absolute" style="z-index: 1; right:-10px; top:-10px"><a href="#" class="btn btn-secondary">...</a></div>  <!--button to open popup adn edit data-->
                    <ul class="list-group">
                        <li class="list-group-item">Age: {{this.age}}</li>
                        <li class="list-group-item">sex: {{this.sex}}</li>
                        <li class="list-group-item">From: {{this.city}}</li>
                    </ul>
                </div>

                <!--  Content - could be reserved for past activities (played games and such)           -->
                <div class="col-lg-9 col-md-12 col-12">
                    <h1>some content</h1>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfileContent",
        props:[
            'age',
            'sex',
            'city'
        ]
    }
</script>

<style scoped>

</style>
