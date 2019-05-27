<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <NavbarComponent></NavbarComponent>
                <div class="card-body">
                    <p>Edit Post</p>
                    <form id="myForm">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title" v-model="title" >
                            <span class="red" v-if="titleErrorData">{{titleErrorData}}</span>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <input type="text" id="body" class="form-control" name="body" v-model="body">
                            <span class="red" v-if="bodyErrorData">{{bodyErrorData}}</span>
                        </div>
                        <button type="submit" class="btn btn-primary" @click="handleSubmit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    // const NavbarComponent = require('../components/NavbarComponent.vue').default;
    import NavbarComponent from '../components/NavbarComponent';
    export default {
        data(){
            return {
                titleError:false,
                titleErrorData: '',
                bodyErrorData: '',
                title: '',
                body: ''
            }
        },
        mounted(){
            console.log('mounted');
            console.log();
        },
       methods:{
         handleSubmit(e){
             e.preventDefault();
             Axios.post('/api/posts', {title:this.title, body: this.body})
                 .then((response) => {
                     if (response) {
                         this.$router.push('/posts');
                     }

                 }).catch((error)=>{
                 console.log('error');

                 let title = error.response.data.errors.title[0];
                 let body = error.response.data.errors.body[0];
                 console.log(error.response.data.errors);
                 if (title) {
                     this.titleErrorData = title;
                 }
                 if (body) {
                     this.bodyErrorData = body;
                 }

             });
         }
       },
        created() {
            Axios.get('/api/edit-post/'+this.$route.params.id).then((response)=>{
                this.post = response.data;
                console.log(response.data);

            })
        },
        components:{
            NavbarComponent

        }
    }
</script>
