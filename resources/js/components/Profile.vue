<template>

    <div class="container-fluid">
        <navbar></navbar>
        <br>
            <div class="row">
                <div class="col-md-2">
                    <div class="profile-img">
                        <img :src="'/images/'+profile.profile_picture" width="200" alt="image"/>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile-head">
                        <h5 class="bold">
                            {{profile.first_name}} {{profile.last_name}}
                        </h5>
                        <h6>
                            {{profile.profession}}
                        </h6>
                        <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- model strted                -->
                <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Edit Profile</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 offset-1">
                                    <form role="form" @submit.prevent="handleProfileEdit" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="name">First Name</label>
                                                    <input type="text" id="name" name="firstName" class="form-control" v-model="first_name"  placeholder="First Name" tabindex="1">
                                                    <span class="red" v-if="errors.first_name">{{errors.first_name[0]}}</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName">Last Name</label>
                                                    <input type="text" id="lastName" name="lastName"  class="form-control" v-model="last_name" placeholder="Last Name" tabindex="2">
                                                    <span class="red" v-if="errors.last_name">{{errors.last_name[0]}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" id="phone" name="phone"  class="form-control" v-model="phone" placeholder="Phone" tabindex="3">
                                            <span class="red" v-if="errors.phone">{{errors.phone[0]}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="profession">Profession</label>
                                            <input type="text" id="profession" name="profession"  class="form-control" v-model="profession" placeholder="Profession" tabindex="3">
                                            <span class="red" v-if="errors.profession">{{errors.profession[0]}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Change Profile Picture</label>
                                            <input type="file" id="email" name="profilePicture"  class="form-control" v-on:change="imageChange" placeholder="Email Address" tabindex="4">
                                            <span class="red" v-if="errors.profile_picture">{{errors.profile_picture[0]}}</span>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button class="red btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-success"  data-toggle="modal" data-target="#modalRegisterForm">
                        Edit Profile</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>WORK LINK</p>
                        <a href="">Website Link</a><br/>
                        <a href="">Bootsnipp Profile</a><br/>
                        <a href="">Bootply Profile</a>
                        <p>SKILLS</p>
                        <a href="">Web Designer</a><br/>
                        <a href="">Web Developer</a><br/>
                        <a href="">WordPress</a><br/>
                        <a href="">WooCommerce</a><br/>
                        <a href="">PHP, .Net</a><br/>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{profile.username}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{profile.first_name}} {{profile.last_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{profile.email}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{profile.phone}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Profession</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{profile.profession}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Experience</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Expert</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Hourly Rate</label>
                                </div>
                                <div class="col-md-6">
                                    <p>10$/hr</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Total Projects</label>
                                </div>
                                <div class="col-md-6">
                                    <p>230</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>English Level</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Expert</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Availability</label>
                                </div>
                                <div class="col-md-6">
                                    <p>6 months</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Your Bio</label><br/>
                                    <p>Your detail description</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>
<script>
    import NavbarComponent from '../components/NavbarComponent';
    export default{
        data(){
            return {
                profile: '',
                first_name: '',
                email: '',
                last_name:'',
                phone: '',
                profession: '',
                profilePicture: '',
                id: '',
                errors: []
            };
        },
        methods: {
            handleProfileEdit(){
                let profile = {

                    first_name: this.first_name,
                    last_name: this.last_name,
                    profile_picture: this.profilePicture,
                    phone: this.phone,
                    profession: this.profession,
                    id: this.id
                };
                Axios.post('api/update-profile', profile).then((response)=>{
                        this.getProfileData();
                        $('#modalRegisterForm').modal('hide');
                }).catch((errors)=>{
                    this.errors = errors.response.data.errors;
                });
            },
            imageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.profilePicture = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            getProfileData(){
                Axios.get('api/profile').then((response) => {
                    this.profile = response.data;
                    this.first_name = response.data.first_name;
                    this.last_name = response.data.last_name;
                    this.email = response.data.email;
                    this.phone = response.data.phone;
                    this.profession = response.data.profession;
                    this.id = response.data.id;

                });
            }
        },
        components:{
            'navbar': NavbarComponent

        },
        created(){
            this.getProfileData();
        }
    }
</script>