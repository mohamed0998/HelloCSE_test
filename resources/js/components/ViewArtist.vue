<template>
   <div class="container">
    <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">View Artist</h5>
                <div>
                <router-link :to="{name: 'artists'}" class="btn btn-success">go back</router-link>
                </div>
    </div>

    <div class="row d-flex justify-content-between">
        <div class="col-lg-4 card border-0  shadow">
            
                <img v-bind:src="imgPreview" alt="..." class="rounded-circle p-3">
                <div class="card-body p-1-9 p-xl-5">
                    <div class="d-flex justify-content-center">
                        <h3 class="h4">{{name}}</h3>
                    </div>
                </div>
           
        </div>
        <div class="col-lg-7 card border-0  shadow mt-4 mt-lg-0">
           
                <div class=" card-body mb-5">
                    <div class="text-center mb-1-6 ">
                        <h2 class="h1 m-4">Description</h2>
                    </div>
                    <p>{{ description }}</p>
                   </div>
        
        </div>
    </div>
</div>
</template>


<script>
export default{
    data() {
        return {
            id:'',
            name: '',
            description: '',
            img: '',
            imgPreview: null
        }
    },
    created() {
       
            this.$axios.get(`/api/artists/edit/${this.$route.params.id}`)
            .then(response => {
                this.name = response.data['name'];
                this.description = response.data['description'];
                this.img = "/img/"+response.data['image'];
                this.imgPreview = this.img;
            })
            .catch(function(error) {
                console.log(error);
            });
    
    },
}
</script>