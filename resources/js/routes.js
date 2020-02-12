import VueRouter from 'vue-router';

const routes = [

    { 
        path: '/', 
        component: require('./views/Home').default,
    },

    { 
        path: '/category/:id', 
        component: require('./views/Category').default ,
        name: 'category'
    },

    { 
        path: '/dev/:id', 
        component: require('./views/Posts').default,
        name: 'dev'
    },

    { 
        path: '/archive', 
        component: require('./views/Archive').default,
        name: 'archive',
    },

    { 
        path: '/archive/:year', 
        component: require('./views/Year').default,
        name: 'year',
        meta: { transitionName: 'slide' },
    }

];

export default new VueRouter({
    routes,
    mode: 'history'
}) 