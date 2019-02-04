<template>
    <form method="POST" action="#" @submit.prevent="register">
        <div class="control">
            <div class="field">
                <label class="label">{{'input.Name' | trans}}</label>
                <input type="text" class="input" name="name" required autofocus
                       v-model="user.name">
            </div>
        </div>

        <div class="control">
            <div class="field">
                <label class="label">{{'input.Last Name' | trans}}</label>
                <div class="control">
                    <input class="input" type="text" name="last_name" v-model="user.last_name">
                </div>
            </div>
        </div>

        <div class="control">
            <div class="field">
                <label class="label">{{'input.Email' | trans}}</label>
                <input type="email" class="input" name="email" required
                       v-model="user.email">
            </div>
        </div>

        <div class="control">
            <div class="field">
                <label class="label">{{'input.Password' | trans}}</label>
                <input class="input" type="password" name="password" required autofocus
                       v-model="user.password">
            </div>
        </div>

        <div class="control">
            <div class="field">
                <label class="label">{{'input.Repeat Password' | trans}}</label>
                <input class="input" type="password" name="c_password" required autofocus
                       v-model="user.c_password">
            </div>
        </div>
        <br>

        <div class="control">
            <button type="submit" class="button is-primary" id="btnSubmit">
                {{'input.Sign Up' | trans}}
            </button>
        </div>

        <div class="form-group text-center">
            <p v-if="apiStatus == 'fail'" class="c-red m-b-0 font-15">
                {{message}}
            </p>
        </div>


        <div id="reg-success" class="modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box bg-success">
                  {{message}}
                    <div>
                        <router-link to="home">{{'input.Go to dashboard' | trans}}</router-link>
                    </div>
                </div>
            </div>
            <button class="modal-close is-large" aria-label="close" @click="closeBox"></button>
        </div>

    </form>
</template>

<script>
    import axios from 'axios';
    import * as MutationTypes from '../../store/auth/MutationTypes';

    export default {
        data() {
            return {
                apiStatus: '',
                message: '',
                user: {
                    name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    c_password: ''
                }
            }
        },
        mounted() {
        },
        methods: {
            register() {
                $("#btnSubmit").addClass("is-loading");
                let component = this;
                axios.post('/api/register', this.user)
                    .then(function (response) {
                        $("#btnSubmit").removeClass("is-loading");
                        component.message = response.data.meta.message;
                        component.apiStatus = response.data.meta.status;
                        if (response.data.meta.status === "success") {
                            component.user.email = '';
                            component.user.password = '';
                            component.user.name = '';
                            component.user.c_password = '';
                            $("#reg-success").addClass("is-active");
                            component.$store.dispatch(MutationTypes.SAVE_USER, response);
                            // component.$router.push('home');
                        }
                    }).catch(function (error) {
                    $("#btnSubmit").removeClass("is-loading");
                    component.$store.dispatch(MutationTypes.SHOW_ERROR, error);
                });
            },
            closeBox(){
                $("#reg-success").removeClass("is-active");
            }
        }
    }

</script>
