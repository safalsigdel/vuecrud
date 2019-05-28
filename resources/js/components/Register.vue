<template>
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 offset-3">
                <form role="form" @submit.prevent="handleRegister">
                    <br>
                    <h2>Please Sign Up <small>It's free and always will be.</small></h2>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="firstName" class="form-control" v-model="firstName"  placeholder="First Name" tabindex="1">
                                <span class="red" v-if="errors.first_name">{{errors.first_name[0]}}</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="lastName"  class="form-control" v-model="lastName" placeholder="Last Name" tabindex="2">
                                <span class="red" v-if="errors.last_name">{{errors.last_name[0]}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" v-model="userName" placeholder="UserName" tabindex="3">
                        <span class="red" v-if="errors.username">{{errors.username[0]}}</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone"  class="form-control" v-model="phone" placeholder="Phone" tabindex="3">
                        <span class="red" v-if="errors.phone">{{errors.phone[0]}}</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="profession"  class="form-control" v-model="profession" placeholder="Profession" tabindex="3">
                        <span class="red" v-if="errors.profession">{{errors.profession[0]}}</span>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email"  class="form-control" v-model="email" placeholder="Email Address" tabindex="4">
                        <span class="red" v-if="errors.email">{{errors.email[0]}}</span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password"  class="form-control" v-model="password" placeholder="Password" tabindex="5">
                                <span class="red" v-if="errors.password">{{errors.password[0]}}</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="passwordConfirm" v-model="passwordConfirm"  class="form-control" placeholder="Confirm Password" tabindex="6">
                                <span class="red" v-if="errors.passwordConfirm">{{errors.passwordConfirm[0]}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
						<button type="button" class="btn" data-color="info" tabindex="7" >I Agree</button>
                        <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1" @click="agree">
					</span>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-9">
                            By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
                        </div>
                    </div>

                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><input :disabled="checkAgree" type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                        <div class="col-xs-12 col-md-6"><router-link to="/" class="btn btn-primary btn-block btn-lg">Go Back</router-link></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                firstName: '',
                lastName: '',
                userName: '',
                phone: '',
                profession: "",
                password: '',
                passwordConfirm: '',
                email: '',
                checkAgree:true,
                errors: []


            };
        },
        methods:{
            handleRegister() {

                const data = {
                    first_name: this.firstName,
                    last_name:this.lastName,
                    username: this.userName,
                    phone: this.phone,
                    profession: this.profession,
                    password: this.password,
                    passwordConfirm: this.passwordConfirm,
                    email: this.email
                };
                Axios.post('api/register',data).then((response)=>{
                    if (response) {
                        this.$router.push('/posts');
                    }
                }).catch((error)=>{
                    this.errors = error.response.data.errors;
                });
            },
            agree(){
                let agree = this.checkAgree;
                agree ? this.checkAgree = false : this.checkAgree=true;

            }
        }
    }
</script>