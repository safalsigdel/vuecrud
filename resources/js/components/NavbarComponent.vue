<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li :class="navProfile">
                <router-link to="/profile" class="nav-link">Profile</router-link>
                <!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
            </li>
            <li :class="navPost">
                <router-link to="/posts" class="nav-link">Posts</router-link>
            </li>
            <li :class="navUser">
                <router-link to="/users" class="nav-link">Users</router-link>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" @submit.prevent="onSearch">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" v-model="search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <span>&nbsp;</span><button class="btn btn-outline-danger my-2 my-sm-0" type="button" @click.prevent="handleLogout">Log Out</button>

        </form>
    </div>

</nav>
</template>
<script>
    import {bus} from "../app";

    export default {
        data(){
          return {
              search: '',
              navUser: 'nav-item',
              navPost: 'nav-item',
              navProfile:'nav-item'

          }
        },
        methods:{
            onSearch(){
                bus.$emit('search', this.search);
            },
            handleLogout(){
                localStorage.removeItem('api_token');
                this.$router.push('/');
            }
        },created() {
            let routeName = this.$route.name;
            console.log(routeName);
            if (routeName === 'user') {
                this.navUser = 'nav-item active';
            }else if (routeName === 'profile') {
                this.navProfile += 'nav-item active';
            }else if (routeName === 'post') {
                this.navPost = 'nav-item active';
            }
        }
    }
</script>