import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// import uncomponenteComp from ...
import SearchPage from './pages/SearchPage.vue';
import ShowPage from './pages/ShowPage.vue';


const router = new VueRouter({
    // path per le pagine

    mode: 'history',
    routes: [
        // aggiungo tutte le rotte sotto forma di oggetti
        {
            path: '/profiles',
            name: 'search',
            component: SearchPage
        },
        {
            path: '/profile/:id',
            name: 'singleProfile',
            component: ShowPage
        },


    ]
});

export default router;
