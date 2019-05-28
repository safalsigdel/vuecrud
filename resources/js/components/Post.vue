<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
               <navbar></navbar>
                <div class="card-body">
                    <p>Listing Posts</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <th v-if="postNull">No data found</th>
                        <tr v-for="(post,index) in posts">
                            <th>{{index+1}}</th>
                            <td>{{post.title}}</td>
                            <td>{{post.body}}</td>
                            <td>{{post.created_at}}</td>
                            <td>{{post.updated_at}}</td>
                            <td><router-link :to="{ name: 'editPost', params: {id: post.id } }">Edit</router-link> <a href="" @click.prevent="handleDelete(post.id)">Delete</a></td>

                        </tr>
                        </tbody>
                    </table>
                    <router-link to="/users">Go to User</router-link>
                    <router-link to="/post/create">Create Post</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Navbar from '../components/Navbar';
    import {bus} from "../app";

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
                    this.fetchData();
                });

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
            bus.$on('search', obj => {
                Axios.get('/api/search/'+this.$route.name + '/?q=' + obj).then((response) => {
                    this.posts = response.data;
                    if (this.posts.length === 0) {
                        this.postNull = true;
                    }
                });
            });
        },
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            'navbar': Navbar

        }
    }
</script>