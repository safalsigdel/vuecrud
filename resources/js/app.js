require('./bootstrap');

window.Vue = require('vue');
window.VueAxios = require('vue-axios').default;
window.Axios = require('axios').default;

import VueRouter from 'vue-router';

Vue.use(VueRouter,VueAxios,axios);
let auth = localStorage.getItem('auth');

const routes = [
    {
        path: '/',
        component: require('./components/HomeComponent.vue').default,
        meta:{requiredAuth:true}
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
        path: '/posts/:id',
        name: 'editPost',
        component:require('./components/EditPostComponent.vue').default
    },
    {
        path:'/post/delete/:id',
        name:'deletePost',
        component:require('./components/Deletepost.vue').default 
    },
    {
        path:'/post/create',
        name:'createPost',
        component:require('./components/CreatePost.vue').default
    }
];
const router = new VueRouter({
    routes,
    mode:'history'
});
router.beforeEach((to, from, next) => {

    if (to.matched.some(record => record.meta.requiredAuth)) {
        if (auth === 'unauthenticated') {
            next({
                path: '/',
                query:{redirect: to.fullPath}
            })
        }else {
            next();
        }
    }
});
const app = new Vue({
    router,
}).$mount('#app');