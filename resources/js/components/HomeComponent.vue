<template>
    <div class="container">
    <br/>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit="handleSubmit">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="email" autofocus>

                                    <span class="invalid-feedback" role="alert">
<!--                                        <strong>{{ $message }}</strong>-->
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" v-model="password" required autocomplete>
                                    <span class="invalid-feedback" role="alert">
<!--                                        <strong>{{ $message }}</strong>-->
                                    </span>
<!--                                    @enderror-->
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {email:'',password:''}
        },
        methods:{
            handleSubmit(e){
                e.preventDefault();
                Axios.post('api/login', {email:this.email, password:this.password}).then((response) => {
                    console.log(response.data);
                    if (response.data==="false") {
                        localStorage.setItem('auth', 'unauthenticated');
                        this.$router.push('/');
                    }else{
                        localStorage.setItem('auth', 'authenticated');
                        this.$router.push('/posts')
                    }
                });
            }
        }
    }
</script>
