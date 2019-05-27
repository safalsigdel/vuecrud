<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
               <navbar></navbar>
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
                        <button type="submit" @click.prevent="handleSubmit(post.id)">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import NavbarComponent from '../components/NavbarComponent';
    export default {
        data(){
            return {post:''}
        },
       methods:{
         handleSubmit(id){

             Axios.put('/api/posts/'+id,{post:this.post}).then((response)=>{
                 console.log(response.data);
                 this.$router.push('/posts');
             });
         }
       },
        created() {
            const url = '/api/posts/'+this.$route.params.id +'/edit';
            Axios.get(url).then((response)=>{
                this.post = response.data;
            })
        },
        components:{
            'navbar': NavbarComponent

        }
    }
</script>
