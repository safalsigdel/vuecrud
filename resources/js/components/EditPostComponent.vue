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
                    <p>Edit Post</p>
                    <form id="myForm">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title" v-model="post.title" >
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <input type="text" id="body" class="form-control" name="body" v-model="post.body">
                        </div>
                        <button type="submit" @click="handleSubmit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {post:''}
        },
       methods:{
         handleSubmit(e){
             e.preventDefault();
             Axios.post('/api/update-post',{post:this.post}).then((response) => {
                 this.$router.push('/posts');
             });
         }
       },
        created() {
            Axios.get('/api/edit-post/'+this.$route.params.id).then((response)=>{
                this.post = response.data;
                console.log(response.data);
            })
        }
    }
</script>
