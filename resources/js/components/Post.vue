<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <router-link to="/" class="nav-link">Home</router-link>
                                <!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
                            </li>
                            <li class="nav-item">
                                <router-link to="/posts" class="nav-link">Posts</router-link>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
                <div class="card-body">
                    <br/>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        <th v-if="postNull">No data found</th>
                        <tr v-for="(post,index) in posts">
                            <th>{{index+1}}</th>
                            <td>{{post.title}}</td>
                            <td>{{post.body}}</td>
                            <td>{{post.created_at}}</td>
                            <td><router-link :to="{ name: 'editPost', params: {id: post.id } }">Edit</router-link></td>
                            <td><a href="#" @click="handleDelete(post.id)">Delete</a></td>
                        </tr>
                        </tbody>
                    </table>
                    <router-link to="/user">Go to User</router-link>
                    <router-link to="/post/create">Create Post</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:function(){
            return {
                posts: '',
                postNull:false,
            }
        },
        methods: {
            handleDelete(id){
                Axios.delete('api/posts/'+id).then((response) => {
                    this.$router.push('/posts');
                });
                this.fetchData();
            },
            fetchData(){
                Axios.get('/api/posts').then((response)=>{
                    console.log(response);
                    this.posts = response.data;
                    if (this.posts.length === 0) {
                        this.postNull = true;
                    }
                });
            }
        },
        created(){
            this.fetchData();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>