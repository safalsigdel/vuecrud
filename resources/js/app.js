require('./bootstrap');

window.Vue = require('vue');
window.VueAxios = require('vue-axios').default;
window.Axios = require('axios').default;

import VueRouter from 'vue-router';

Vue.use(VueRouter,VueAxios,axios);

const routes = [
    {
        path: '/',
        component: require('./components/HomeComponent.vue').default
    },
    {
        path: '/user',
        component: require('./components/User.vue').default
    },
    {
        path:'/posts',
        component:require('./components/Post.vue').default
    },
    {
        path: '/edit-post/:id',
        component:require('./components/EditPostComponent.vue').default
    }
];
const router = new VueRouter({
    routes,
    mode:'history'
});

const app = new Vue({
    router,
}).$mount('#app');