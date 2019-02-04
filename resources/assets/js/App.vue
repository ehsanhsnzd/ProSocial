<template>


    <div>
        <div class="container">
            <nav class="navbar is-transparent">
                <div class="navbar-brand">
                    <a class="navbar-item" href="https://bulma.io">
                        PRO Social
                    </a>
                    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div id="navbarExampleTransparentExample" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href="https://bulma.io/">
                            Home
                        </a>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="https://bulma.io/documentation/overview/start/">
                                Docs
                            </a>
                            <div class="navbar-dropdown is-boxed">
                                <a class="navbar-item" href="https://bulma.io/documentation/overview/start/">
                                    Overview
                                </a>
                                <a class="navbar-item" href="https://bulma.io/documentation/modifiers/syntax/">
                                    Modifiers
                                </a>
                                <a class="navbar-item" href="https://bulma.io/documentation/columns/basics/">
                                    Columns
                                </a>
                                <a class="navbar-item" href="https://bulma.io/documentation/layout/container/">
                                    Layout
                                </a>
                                <a class="navbar-item" href="https://bulma.io/documentation/form/general/">
                                    Form
                                </a>
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="https://bulma.io/documentation/elements/box/">
                                    Elements
                                </a>
                                <a class="navbar-item is-active"
                                   href="https://bulma.io/documentation/components/breadcrumb/">
                                    Components
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <!-- Authentication Links -->
                    <template v-if="isLoggedIn">
                        <div class="navbar-end">
                            <div class="navbar-item has-dropdown is-hoverable">
                                <router-link to="home" class="navbar-link">
                                    {{authUser.name}}<span class="caret"></span>
                                </router-link>
                                <div class="navbar-dropdown is-boxed">
                                    <router-link to="edituser" class="navbar-item">
                                        Edit User
                                    </router-link>
                                    <router-link to="editprofile" class="navbar-item">
                                        Edit Profile
                                    </router-link>
                                    <router-link to="connection" class="navbar-item">
                                        Connection
                                    </router-link>
                                    <router-link to="feed" class="navbar-item">
                                        Feed
                                    </router-link>
                                    <router-link to="followingcompany" class="navbar-item">
                                        Following Company
                                    </router-link>
                                    <router-link to="message" class="navbar-item">
                                        Message
                                    </router-link>
                                    <a href="javascript:void(0);" class="navbar-item" v-on:click="logout">
                                        Logout
                                    </a>
                                </div>
                            </div>
                            <div class="navbar-item has-dropdown is-hoverable">
                                <router-link to="company" class="navbar-link">
                                    Company Dashboard<span class="caret"></span>
                                </router-link>
                                <div class="navbar-dropdown is-boxed">
                                    <router-link to="product" class="navbar-item">
                                        Product
                                    </router-link>
                                    <router-link to="service" class="navbar-item">
                                        Service
                                    </router-link>
                                    <router-link to="companyskill" class="navbar-item">
                                        Skill
                                    </router-link>
                                    <router-link to="companyproject" class="navbar-item">
                                        Projects
                                    </router-link>
                                    <router-link to="companyarticles" class="navbar-item">
                                        Articles
                                    </router-link>
                                    <router-link to="need" class="navbar-item">
                                        Skill Needs
                                    </router-link>
                                    <router-link to="companyadmin" class="navbar-item">
                                        Admins
                                    </router-link>
                                    <router-link to="room" class="navbar-item">
                                        Room
                                    </router-link>
                                </div>
                            </div>

                        </div>
                    </template>

                    <template v-else>
                        <div class="navbar-end">
                            <div class="navbar-item">
                                <div class="buttons">

                                    <router-link class="button is-light" to="/login">Login</router-link>
                                    <router-link class="button is-primary" to="signup">
                                        <strong>Sign up</strong>
                                    </router-link>

                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </nav>
        </div>

        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        PRO Social
                    </h1>
                    <h2 class="subtitle">Social for your job</h2>


                </div>
            </div>
        </section>

        <validation-errors :errors="errorUser" v-if="errorUser"></validation-errors>
        <validation-success :success="successUser" v-if="successUser"></validation-success>
        <br>
        <div class="container">
            <transition name="fade" mode="out-in">
                <router-view class="view"></router-view>
            </transition>
        </div>


    </div>

</template>

<script>
    import * as MutationTypes from './store/auth/MutationTypes';

    export default {
        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
            errorUser() {
                return this.$store.getters.errorUser;
            },
            successUser() {
                return this.$store.getters.successUser;
            },
            isLoggedIn() {
                return this.$store.getters.isLoggedIn;
            },
            authToken() {
                return this.$store.getters.authToken;
            }
        },
        mounted() {
        },
        methods: {
            logout(event) {
                let component = this;
                component.$store.dispatch(MutationTypes.LOGOUT);
                component.$router.push('/');
            }
        }
    }
</script>
