<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home Component</div>

                    <div class="card-body">
                        Welcome to Homepage
                        <br/>
                        <ul v-for="(post,index) in posts">
                            <li>{{index+1}}{{post.body}}</li>
                        </ul>
                        <router-link to="/user">Go to User</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:function(){
            return {posts:''}
        },
        created(){
            Axios.get('http://localhost:8000/posts').then((response)=>{
                this.posts = response.data;
            });
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>