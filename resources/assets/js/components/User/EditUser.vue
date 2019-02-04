<template>
    <form class="form-horizontal" method="POST" action="#" @submit.prevent="edit">
        <div class="control">
            <div class="field">
                <label class="label">{{'input.Name' | trans}}</label>
                <div class="control">
                    <input class="input" type="text"  name="name"    v-model="user.name">
                </div>
            </div>
        </div>
        <div class="control">
            <div class="field">
                <label class="label">{{'input.Last Name' | trans}}</label>
                <div class="control">
                    <input class="input" type="text" name="last_name"   v-model="user.last_name">
                </div>
            </div>
        </div>
        <div class="control">
            <div class="field">
                <label class="label">{{'input.Email' | trans}}</label>
                <div class="control">
                    <input class="input"  type="email"  name="email" disabled v-model="user.email">
                </div>
            </div>
        </div>
        <div class="control">
            <div class="field">
                <label class="label">{{'input.Old Password' | trans}}</label>
                <div class="control">
                    <input class="input" type="password"  name="old_password"   v-model="user.old_password">
                </div>
            </div>
        </div>
        <div class="control">
            <div class="field">
                <label class="label">{{'input.New Password' | trans}}</label>
                <div class="control">
                    <input class="input" type="password"  name="password"   v-model="user.password">
                </div>
            </div>
        </div>
        <div class="control">
            <div class="field">
                <label class="label">{{'input.Repeat Password' | trans}}</label>
                <div class="control">
                    <input class="input" type="password"   name="c_password"  v-model="user.c_password">
                </div>
            </div>
        </div>
        <br>
        <div class="control">
            <button type="submit" class="button is-primary" id="btnSubmit">
                {{'input.Submit' | trans}}
            </button>
        </div>
    </form>
</template>

<script>
    import axios from 'axios';
    import * as MutationTypes from '../../store/auth/MutationTypes';

    export default {
        data() {
            return {
                user: {
                    name: '',
                    last_name:'',
                    email: '',
                    old_password:'',
                    password: '',
                    c_password: ''
                }
            }
        },
        mounted() {
            this.user.name=this.authUser.name;
            this.user.last_name=this.authUser.last_name;
            this.user.email=this.authUser.email;
        },
        methods: {
            edit() {
                let user = {
                    name : this.user.name,
                    last_name : this.user.last_name,
                    email: this.user.email,
                    old_password : this.user.old_password,
                    password: this.user.password,
                    c_password: this.user.c_password
                };
                let component = this;
                $("#btnSubmit").addClass("is-loading");
                axios.put('/api/user/'+ this.authUser.id, user)
                    .then(function (response) {
                        $("#btnSubmit").removeClass("is-loading");
                        if (response.data.meta.status == 'success'){
                            component.$store.dispatch(MutationTypes.SHOW_SUCCESS, response);
                        }
                    }).catch(error => {
                    if (error.response.data.meta.status == 'fail'){
                        $("#btnSubmit").removeClass("is-loading");
                        component.$store.dispatch(MutationTypes.SHOW_ERROR, error);
                    }
                })
            }
        },
        computed: {
            authUser() {
                return this.$store.getters.authUser;
            }
        }
    }
</script>
