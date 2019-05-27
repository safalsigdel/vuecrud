<template>
    <div class="container">
        <br><br><br><br>
    <div class="row">
            <div class="panel col-sm-5 offset-3">
                <div class="panel-heading">
                    <h3 class="panel-title">Please sign in</h3>
                </div>
                <div class="panel-body">
                    <form @submit.prevent="handleSubmit">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="text" v-model="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" v-model="password" type="password" value="">
                                <span class="red">{{invalidResponse}}</span>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                            <br>
                            <span class="blue">Don't have an account?</span><span class="green"><router-link to="/register"> Create one</router-link></span>
                        </fieldset>
                    </form>
                </div>
            </div>
    </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                email:'',
                password:'',
                invalidResponse:''
            }
        },
        methods:{
            handleSubmit(){
                Axios.post('api/login', {email: this.email, password: this.password})
                    .then((response) => {
                        if (response) {
                            localStorage.setItem('api_token', response.data.api_token);
                            this.$router.push('/profile');
                        } else {
                            this.invalidResponse = "Email or password do not matched";
                        }
                    });
            },

        },
        created() {
            if (localStorage.getItem('api_token')) {
                this.$router.push('/profile');
            }
        }
    }
</script>
<style scoped>
    .custom {
        margin-left: 12px;

    }
</style>
