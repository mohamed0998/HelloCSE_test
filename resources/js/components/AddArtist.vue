<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Add new artist Data</h5>
                <div>
                    <router-link :to="{name: 'artists'}" class="btn btn-success">Go Back</router-link>
                </div>
            </div>
            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strError}}</strong>
            </div>


            <form @submit.prevent="addArtist" enctype="multipart/form-data">
                <div class="form-gorup mb-2 ">
                    <label>Add image</label><span class="text-danger">*</span>
                   
                   <div class="row d-flex justify-content-center mb-4"><label id="add-img-label" for="add-single-img" class="row">+</label>
                     <input type="file" id="add-single-img" v-on:change="onChange" /></div>
                        <div v-if="img" class="d-flex justify-content-center"> 
                            <img v-bind:src="imgPreview" class="rounded-circle" id="image-input" width="100" />
                        </div>

                </div>

                <div class="form-group mb-2">
                    <label>Name</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="name" placeholder="Enter artist name">
                </div>

                <div class="form-group mb-2">
                    <label>Description</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="description" placeholder="Enter artist description" style="height:400px;"></textarea>
                </div>


                <button type="submit" class="btn btn-primary mt-4 mb-4"> Add artist</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            name: '',
            description: '',
            img: '',
            error: '',
            imgPreview: null
        }
    },
    methods: {
        onChange(e) {
            this.img = e.target.files[0];
            let reader = new FileReader();
            reader.addEventListener("load", function () {
                this.imgPreview = reader.result;
            }.bind(this), false);

            if (this.img) {
                if ( /\.(jpe?g|png|gif)$/i.test( this.img.name ) ) {
                    reader.readAsDataURL( this.img );
                }
            }
        },
        addArtist(e) {
          
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('file', this.img);

                this.$axios.post('/api/artists/add', formData, config)
                .then(response => {
                    this.$router.push({ name: 'artists'})
                })
                .catch(function(error) {
                    existingObj.error = error.response.data.message;
                });
          
        }

    },
  
}

</script>

<style>
#add-single-img {
  opacity: 0;
  height: 0;
}

#add-img-label {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 150%;
  cursor: pointer;
  width: 100px;
  height: 100px;
  border: solid 1px black;
  border-radius:50px;
  object-fit: cover;
}

</style>
