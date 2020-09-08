<template>    
        <table class="table">
            <thead>
                <tr>
                    <th>  
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Plot
                    </th>
                    <th v-if="user.role_id == '1'">
                    </th>
                    <th v-if="user.role_id == '1'">
                    </th>
                </tr>
            </thead>
            <tr v-for="movie in movies">
                <td>
                    <img height="80px" :src="movie.image" width="70px" v-if="movie.method == 'imdb'"></img>
                    <img height="80px" :src="'/storage/'+movie.image" width="70px" v-else></img>
                </td> 
                <td>
                    <b>{{movie.name}}</b>
                </td>
                <td>
                    {{movie.description}}
                </td>
                <td v-if="user.role_id == '1'">
                    <a class="btn btn-info btn-sm" :href="'/movie/'+movie.id+'/edit'">Edit</a>
                    <a class="btn btn-danger btn-sm" @click="deleteMovie(movie.id)" style="color: #FFF">
                        Remove
                    </a>
                </td>
            </tr>
        </table>    
</template>

<script>
    export default {
        props : ['user'],

        data: function() {
            return {
                movies: [],
                editRoute: 'movie.edit'
            }
        },

        mounted() {
            this.loadMovies();
        },

        methods: {
            loadMovies: function() {
                axios.get('/api/vue-index')
                .then((response)=> {
                    this.movies = response.data;
                })
                .catch( function(error){
                    console.log(error);
                });
            },
            deleteMovie(id,event) {
                axios.delete('movie/'+id);
                location.reload();
            }
        }

    }
</script>
