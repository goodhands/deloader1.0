import VueRouter from 'vue-router';

const routes = [

    { 
        path: '/', 
        component: require('./views/Home').default 
    },

    { 
        path: '/category', 
        component: require('./views/Category').default 
    },

    { 
        path: '/post/:id', 
        component: require('./views/Posts').default
    }

];

export default new VueRouter({
    routes,
    mode: 'history'
}) 