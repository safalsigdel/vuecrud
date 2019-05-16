<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home Component</div>

                    <div class="card-body">
                       <p class="red">Post Page</p>
                        <br/>
                        <ul v-for="post in posts">
                            <li>{{post.body}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data:function(){
            return {posts:''};
        },
        created(){
            Axios.get('/api/posts').then((response)=>{
                this.posts = response.data;
                console.log(response);
            })
        }
    }
</script>
