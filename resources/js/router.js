import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// import uncomponenteComp from ...





const router = new VueRouter({
    // path per le pagine
    mode: 'history',
    routes: [
        // aggiungo tutte le rotte sotto forma di oggetti
        {
            // path: '/',
            // name: 'home',
            // component: HomePageComp
        },
        {
            // path: '/about-us',
            // name: 'about-us',
            // component: AboutUsComp
        },

    ]
});

export default router;
