<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <navbar></navbar>
                <div class="card-body">
                    <p>Listing All Users</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Profession</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        <th v-if="usersNull">No data found</th>
                        <tr v-for="(user,index) in users">
                            <th>{{index+1}}</th>
                            <td>{{user.first_name}} {{user.last_name}}</td>
                            <td>{{user.phone}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.profession}}</td>
                            <td>{{user.created_at}}</td>
                        </tr>
                        </tbody>
                    </table>
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
                users: '',
                usersNull:false,
            }
        },
        methods: {
            fetchData(){
                Axios.get('/api/users').then((response)=>{
                    console.log(response);
                    this.users = response.data;
                    if (this.users.length === 0) {
                        this.usersNull = true;
                    }
                });
            }
        },
        created(){
            this.fetchData();
            bus.$on('search',obj=>{
                    Axios.get('/api/search/'+this.$route.name + '/?q=' + obj).then((response) => {
                        this.users = response.data;
                        if (this.users.length === 0) {
                            this.usersNull = true;
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