<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form @submit="handleRegister">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" v-model="name" >
                                    <span v-if="errors.name" class="red">{{ errors.name[0] }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="email">
                                    <span v-if="errors.email" class="red">{{ errors.email[0] }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right" >Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" v-model="password">
                                    <span v-if="errors.password" class="red">{{ errors.password[0] }}</span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password-confirmation" v-model="passwordConfirm">
                                    <span v-if="errors.passwordConfirm" class="red">{{ errors.passwordConfirm[0] }}</span>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
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
    export default {
        data() {
            return {
                name: '',
                password: '',
                passwordConfirm: '',
                email: '',
                errors: []


            };
        },
        methods:{
            handleRegister(e) {
                e.preventDefault();
                Axios.post('api/register', {
                    name: this.name, password: this.password, passwordConfirm: this.passwordConfirm,
                    email: this.email
                }).then((response)=>{
                    if (response) {
                        this.$router.push('/posts');
                    }
                }).catch((error)=>{
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>