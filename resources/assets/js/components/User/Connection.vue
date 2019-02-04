<template>
    <div class="row">

        <div class="panel-heading title is-4">Connection</div>
        <div class="box" v-for="(connect,Index) in connections">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-64x64">
                        <img class="is-rounded" :src="connect.image.path">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>{{connect.name}} {{connect.last_name}}</strong>
                            <small>{{connect.email}}</small>
                            <small>{{connect.user_type}}</small>
                            <br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa
                            fringilla egestas. Nullam condimentum luctus turpis.
                        </p>
                    </div>
                    <nav class="level is-mobile">
                        <div class="level-left">
                            <a class="level-item" aria-label="reply">
            <span class="icon is-small">
              <i class="fas fa-reply" aria-hidden="true"></i>
            </span>
                            </a>
                            <a class="level-item" aria-label="retweet">
            <span class="icon is-small">
              <i class="fas fa-retweet" aria-hidden="true"></i>
            </span>
                            </a>
                            <a class="level-item" aria-label="like">
            <span class="icon is-small">
              <i class="fas fa-heart" aria-hidden="true"></i>
            </span>
                            </a>
                        </div>
                    </nav>
                </div>
            </article>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {

        data() {
            return {
                connections: {}
            }
        },

        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
            isLoggedIn() {
                return this.$store.getters.isLoggedIn;
            }
        },
        methods: {
            getCoonection(setting) {
                return axios.get('/social/core/api/baseSetting/settings/' + setting)
                    .then((response) =>
                        response.data.data
                    ).catch(function (error) {
                        console.log('an error occured ' + error);
                    });
            },
        },
        mounted() {
            axios.get('/api/connections')
                .then((response) =>
                    this.connections = response.data.data.connections
                ).catch(function (error) {
                console.log('an error occured ' + error);
            });
        }
    }

</script>

