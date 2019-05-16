require('./bootstrap');

window.Vue = require('vue');
window.VueAxios = require('vue-axios').default;
window.Axios = require('axios').default;


import VueRouter from 'vue-router';

Vue.use(VueRouter,VueAxios,axios);

const exampleComponent = require('./components/ExampleComponent.vue').default;
const userComponent = require('./components/User.vue').default;
const routes = [
    {
        path: '/',
        component: exampleComponent
    },
    {
        path: '/user',
        component: userComponent
    }
];
const router = new VueRouter({
    routes,
});

const app = new Vue({
    router,
}).$mount('#app');