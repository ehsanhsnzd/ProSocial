import Vue from "vue";
import Router from "vue-router";
import Welcome from "../components/Welcome.vue";
import Login from "../components/User/Login.vue";
import SignUp from "../components/User/SignUp.vue";
import Home from "../components/User/Home.vue";
import EditUser from "../components/User/EditUser.vue";
import EditProfile from "../components/User/EditProfile.vue";
import Connection from "../components/User/Connection.vue";
import Feed from "../components/User/Feed.vue";
import FollowingCompany from "../components/User/FollowingCompany.vue";
import Message from "../components/User/Message.vue";

import CompanyAdmin from "../components/Company/Admin.vue";
import Need from "../components/Company/Need.vue";
import Product from "../components/Company/Product.vue";
import Service from "../components/Company/Service.vue";
import Room from "../components/Company/Room.vue";

import {store} from "../store";
import * as MutationTypes from '../store/auth/MutationTypes';
import NProgress from 'nprogress';

Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'welcome',
            component: Welcome
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/signup',
            name: 'signup',
            component: SignUp
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/edituser',
            name: 'edituser',
            component: EditUser
        },
        {
            path: '/editprofile',
            name: 'editprofile',
            component: EditProfile
        },
        {
            path: '/connection',
            name: 'connection',
            component: Connection
        },
        {
            path: '/feed',
            name: 'feed',
            component: Feed
        },
        {
            path: '/followingcompany',
            name: 'followingcompany',
            component: FollowingCompany
        },
        {
            path: '/message',
            name: 'message',
            component: Message
        },
        {
            path: '/companyadmin',
            name: 'companyadmin',
            component: CompanyAdmin
        },
        {
            path: '/need',
            name: 'need',
            component: Need
        },
        {
            path: '/product',
            name: 'product',
            component: Product
        },
        {
            path: '/service',
            name: 'service',
            component: Service
        },
        {
            path: '/room',
            name: 'room',
            component: Room
        }
    ]
});


router.beforeEach((to, from, next) => {
    if (store.getters.isLoggedIn) {
        console.log("logged in");
        store.dispatch(MutationTypes.FETCH_USER).then(() => next());

    } else {
        console.log("not logged in");
        next();
    }
})


router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.path) {
        // Start the route progress bar.
         NProgress.start();
        store.dispatch(MutationTypes.OFF_MESSAGE);
    }

    next();
});

router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done();
    store.dispatch(MutationTypes.OFF_MESSAGE);
});


export default router;