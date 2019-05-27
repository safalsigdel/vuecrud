require('./bootstrap');

window.Vue = require('vue');
window.VueAxios = require('vue-axios').default;
window.Axios = require('axios').default;

import VueRouter from 'vue-router';
import moment from 'moment';

Vue.use(VueRouter,VueAxios,axios,moment);

const routes = [
    {
        path: '/',
        component: require('./components/HomeComponent.vue').default,
        meta: {title:'Login'},
    },
    {
        path:'/posts',
        name: 'post',
        component:require('./components/Post.vue').default,
        meta:{title:'Posts',requiredAuth:true}
    },
    {
        path: '/posts/:id',
        name: 'editPost',
        component:require('./components/EditPostComponent.vue').default,
        meta:{title:'Edit Post',requiredAuth:true}

    },
    {
        path:'/post/create',
        name:'createPost',
        component:require('./components/CreatePost.vue').default,
        meta:{title:'Create Posts',requiredAuth:true}

    },
    {
        path:'/register',
        name:'register',
        component:require('./components/RegisterComponent.vue').default,
        meta:{title:'Register'}

    },
    {
        path:'/profile',
        name:'profile',
        component:require('./components/Profile.vue').default,
        meta:{title:'Profile'}

    },
    {
        path:'/users',
        name:'user',
        component:require('./components/Users.vue').default,
        meta:{title:'All Users'}

    }

];
const router = new VueRouter({
    routes,
    mode:'history'
});

router.afterEach((to, from) => {

    document.title = to.meta.title;
    if(to.meta.requiredAuth && !localStorage.getItem('api_token')){
        router.push('/');
    }
});

Axios.interceptors.request.use(
    (config) => {
        var token = localStorage.getItem('api_token');
        if (token) {
            config.headers['Authorization'] = 'Bearer ' + token
        }
        config.headers['X-Requested-With'] = 'XMLHttpRequest';
        // TODO: check if have any lang saved in localStorage, if not browser lang or default
        config.headers['Accept-Language'] = 'en';
        return config
    },
    (error) => {
        return Promise.reject(error)
    }
);

Axios.interceptors.response.use(
    (response) => {
        return response
    },
    (error) => {
        if (error.response.status === 401) {
            localStorage.removeItem('username');
            localStorage.removeItem('api_token');
            router.push('/');
        } else {
            return Promise.reject(error);
        }

    }
);
export const bus = new Vue();
const app = new Vue({
    router,
}).$mount('#app');
