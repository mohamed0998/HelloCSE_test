<template>

<div class="card col">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">All artists :</h5>
            <div>
                <button class="btn btn-success" type="button" @click="this.$router.push('/artists/add')">New Artist</button>
            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center m-1"> 
<div class="col-md-6 col-lg-3  p-1" v-for="(artist, index) in artists" :key="artist.id" >
<div class="card shadow">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                   <div v-if="artist.image">
                            <img alt="artist-img" width="100" height="100" v-bind:src="'/img/' +artist.image" class="rounded-circle">
                        </div>
                    <div class="mt-3">
                      <h4>{{artist.name}}</h4>
                      <p class="text-secondary mb-1">Artist</p>
                      <p class="text-muted font-size-sm">show, modify or delete this artist by using the buttons below</p>
                      <router-link :to="{name:'viewartist', params: {id:artist.id}}"><ViewButton/></router-link >
                     <router-link :to="{name:'editartist', params: {id:artist.id}}" class="btn btn-primary m-2"><EditButton /></router-link >
                      <DeleteButton  @click="deleteArtist(artist.id)" />
                    </div>
                  </div>
                </div>
</div>
</div>
</div>
</template>

<script>
import DeleteButton from '../reusables/DeleteButton.vue'
import EditButton from '../reusables/EditButton.vue'
import ViewButton from '../reusables/ViewButton.vue'
export default {
        components: {
        DeleteButton,
        EditButton,
        ViewButton,
		
	},
        data() {
            return {
                artists: [],
                error: ''
            }
        },
        created() {
           
                this.$axios.get('/api/artists')
                .then(response => {
                    this.artists = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
      
        },
        methods: {
            deleteArtist(id) {
                
                    let existingObj = this;
                        this.$axios.delete(`/api/artists/delete/${id}`)
                        .then(response => {

                            let i = this.artists.map(item => item.id).indexOf(id);
                            this.artists.splice(i, 1);
                            existingObj.error = "";
                            existingObj.success = response.data.success;
                            console.log(existingObj.success)

                        })
                        .catch(function(error) {
                            existingObj.error = error.response.data.message;
                            existingObj.success = "";
                            console.log(existingObj.error)
                        });
                    }
        },

    }

</script>