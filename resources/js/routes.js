import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// import uncomponenteComp from ...
import ShowPage from './pages/SearchPage.vue';




const router = new VueRouter({
    // path per le pagine

    mode: 'history',
    routes: [
        // aggiungo tutte le rotte sotto forma di oggetti
        {
            path: '/search',
            name: 'search',
            component: ShowPage
        },

    ]
});

export default router;
