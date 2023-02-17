import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// import uncomponenteComp from ...
import SearchPage from './pages/SearchPage.vue';




const router = new VueRouter({
    // path per le pagine

    mode: 'history',
    routes: [
        // aggiungo tutte le rotte sotto forma di oggetti
        {
            path: '/',
            name: 'search',
            component: SearchPage
        },

    ]
});

export default router;
