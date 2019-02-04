<template>
    <div>
        <a class="button is-primary" @click="OpenModal('#job-modal')">Jobs</a>
        <a class="button is-primary" @click="OpenModal('#education-modal')">Educations</a>
        <a class="button is-info" @click="OpenModal('#projects-modal')">Activity</a>
        <a class="button is-info" @click="OpenModal('#skills-modal')">Skills</a>
        <a class="button is-info" @click="OpenModal('#Articles-modal')">Articles</a>
        <br>
        <br>

        <form class="form-horizontal" method="POST" action="#" @submit.prevent="edit">
            <div class="control">
                <div class="field">
                    <label class="label">{{'input.Country' | trans}}</label>
                    <div class="control">
                        <div class="select">
                            <select name="country" v-model="user.country" @change="onChange_setState">
                                <option :value="null">{{'input.Select' | trans}} {{'input.Country' | trans}}</option>
                                <option v-for="(country,Index) in countries"
                                        :value="country.setting_id" :key="Index"
                                        :selected="country.setting_id == user.country">
                                    {{ country.title }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="control">
                <div class="field">
                    <label class="label">{{'input.State' | trans}}</label>
                    <div class="control">
                        <div class="select">
                            <select name="state" v-model="user.state" @change="onChange_setCity">
                                <option :value="null">{{'input.Select' | trans}} {{'input.State' | trans}}</option>
                                <option v-for="(state,Index) in states"
                                        :value="state.setting_id" :key="Index"
                                        :selected="state.setting_id == user.state">
                                    {{ state.title }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="control">
                <div class="field">
                    <label class="label">{{'input.City' | trans}}</label>
                    <div class="control">
                        <div class="select">
                            <select name="city" v-model="user.city">
                                <option :value="null">{{'input.Select' | trans}} {{'input.City' | trans}}</option>
                                <option v-for="(city,Index) in cities"
                                        :value="city.setting_id" :key="Index"
                                        :selected="city.setting_id == user.city">
                                    {{ city.title }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="control">
                <div class="field">
                    <label class="label">{{'input.Zip Code' | trans}}</label>
                    <div class="control">
                        <input class="input" type="text" name="zip" v-model="user.zip">
                    </div>
                </div>
            </div>
            <div class="control">
                <div class="field">
                    <label class="label">{{'input.Description' | trans}}</label>
                    <div class="control">
                        <input class="input" type="text" name="description" v-model="user.description">
                    </div>
                </div>
            </div>
            <div class="control">
                <div class="field">
                    <label class="label">{{'input.Phone' | trans}}</label>
                    <div class="control">
                        <input class="input" type="text" name="phone" v-model="user.phone">
                    </div>
                </div>
            </div>
            <div class="control">
                <div class="field">
                    <label class="label">{{'input.Address' | trans}}</label>
                    <div class="control">
                        <input class="input" type="text" name="address" v-model="user.address">
                    </div>
                </div>
            </div>

            <br>
            <br>
            <div class="control">
                <button type="submit" class="button is-primary" id="btnSubmit">
                    {{'input.Submit' | trans}}
                </button>
            </div>
        </form>

        <form class="form-horizontal" method="POST" action="#" @submit.prevent="addJob">
            <div class="modal" id="job-modal">
                <div class="modal-background"></div>
                <div class="modal-card">

                    <header class="modal-card-head">
                        <p class="modal-card-title">Your Jobs</p>
                        <a class="delete" aria-label="close" @click="CloseModal('#job-modal')"></a>
                    </header>

                    <section class="modal-card-body">
                        <validation-errors :errors="message" v-if="apiStatus == 'fail'"></validation-errors>
                        <validation-success :success="message" v-if="apiStatus == 'success'"></validation-success>
                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Title' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="job" v-model="job.title">
                                </div>
                            </div>
                        </div>
                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Description' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="description" v-model="job.description">
                                </div>
                            </div>
                        </div>
                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Headline' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="headline" v-model="job.headline">
                                </div>
                            </div>
                        </div>
                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Company' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="company_name" v-model="job.company_name">
                                </div>
                            </div>
                        </div>
                        <div class="control">
                            <div class="field">
                                <label class="checkbox">
                                    <input type="checkbox" name="currently" v-model="job.currently">
                                    {{'input.Currently' | trans}}
                                </label>


                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.From' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="from" v-model="job.job_from_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.From' |
                                                trans}}
                                            </option>
                                            <option v-for="(from,Index) in froms"
                                                    :value="from.setting_id" :key="Index"
                                                    :selected="job.setting_id == job.job_from_id">
                                                {{ from.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.To' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="to" v-model="job.job_to_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.To' | trans}}
                                            </option>
                                            <option v-for="(to,Index) in tos"
                                                    :value="to.setting_id" :key="Index"
                                                    :selected="job.setting_id == job.job_to_id">
                                                {{ to.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.City' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="city" v-model="job.city_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.City' |
                                                trans}}
                                            </option>
                                            <option v-for="(city,Index) in cities"
                                                    :value="city.setting_id" :key="Index"
                                                    :selected="city.setting_id == job.city_id">
                                                {{ city.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Type' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="type" v-model="job.job_type_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.Type' |
                                                trans}}
                                            </option>
                                            <option v-for="(type,Index) in types"
                                                    :value="type.setting_id" :key="Index"
                                                    :selected="type.setting_id == job.job_type_id">
                                                {{ type.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Album' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="type" v-model="job.album_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.Album' |
                                                trans}}
                                            </option>
                                            <option v-for="(album,Index) in albums"
                                                    :value="album.setting_id" :key="Index"
                                                    :selected="album.setting_id == job.album_id">
                                                {{ album.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                    <footer class="modal-card-foot">
                        <button type="submit" class="button is-success" id="btnSave">{{'input.Save' | trans}}</button>
                        <a @click="CloseModal('#job-modal')" class="button">{{'input.Cancel' | trans}}</a>
                    </footer>

                </div>
            </div>
        </form>


        <form class="form-horizontal" method="POST" action="#" @submit.prevent="addEdu">
            <div class="modal" id="education-modal">
                <div class="modal-background"></div>
                <div class="modal-card">

                    <header class="modal-card-head">
                        <p class="modal-card-title">Your Educations</p>
                        <a class="delete" aria-label="close" @click="CloseModal('#education-modal')"></a>
                    </header>

                    <section class="modal-card-body">
                        <validation-errors :errors="message" v-if="apiStatus == 'fail'"></validation-errors>
                        <validation-success :success="message" v-if="apiStatus == 'success'"></validation-success>


                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.School' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="school" v-model="edu.school">
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Degree' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="degree" v-model="edu.degree_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.Degree' |
                                                trans}}
                                            </option>
                                            <option v-for="(degree,Index) in degrees"
                                                    :value="degree.setting_id" :key="Index"
                                                    :selected="degree.setting_id == edu.degree_id">
                                                {{ degree.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Field' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="field" v-model="edu.field">
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Grade' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="grade" v-model="edu.grade">
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Activity' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="activity" v-model="edu.activity">
                                </div>
                            </div>
                        </div>

                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Description' | trans}}</label>
                                <div class="control">
                                    <input class="input" type="text" name="description" v-model="job.description">
                                </div>
                            </div>
                        </div>


                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.From' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="from" v-model="edu.from_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.From' |
                                                trans}}
                                            </option>
                                            <option v-for="(from,Index) in froms"
                                                    :value="from.setting_id" :key="Index"
                                                    :selected="job.setting_id == edu.from_id">
                                                {{ from.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.To' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="to" v-model="edu.to_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.To' | trans}}
                                            </option>
                                            <option v-for="(to,Index) in tos"
                                                    :value="to.setting_id" :key="Index"
                                                    :selected="job.setting_id == edu.to_id">
                                                {{ to.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="control">
                            <div class="field">
                                <label class="label">{{'input.Album' | trans}}</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="type" v-model="edu.album_id">
                                            <option :value="null">{{'input.Select' | trans}} {{'input.Album' |
                                                trans}}
                                            </option>
                                            <option v-for="(album,Index) in albums"
                                                    :value="album.setting_id" :key="Index"
                                                    :selected="album.setting_id == edu.album_id">
                                                {{ album.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                    <footer class="modal-card-foot">
                        <button type="submit" class="button is-success" id="btnSaveEdu">{{'input.Save' | trans}}
                        </button>
                        <a @click="CloseModal('#education-modal')" class="button">{{'input.Cancel' | trans}}</a>
                    </footer>

                </div>
            </div>
        </form>

    </div>
</template>

<script>
    import axios from 'axios';
    import * as MutationTypes from '../../store/auth/MutationTypes';

    export default {
        data() {
            return {
                message: '',
                apiStatus: '',
                types: {},
                albums: {},
                froms: {},
                tos: {},
                degrees: {},
                countries: {},
                cities: {},
                states: {},
                user: {},
                job: {
                    job_type_id: null,
                    job_from_id: null,
                    job_to_id: null,
                    album_id: null,
                    currently: null,
                    title: null,
                    description: null,
                    headline: null,
                    company_name: null,
                    city_id: null,
                    company_id: null,
                },
                edu: {
                    school: null,
                    degree_id: null,
                    from_id: null,
                    to_id: null,
                    album_id: null,
                    field: null,
                    grade: null,
                    description: null,
                    activity: null,
                }
            }
        },
        mounted() {
            this.getSetting('country').then((response) => this.countries = response.country);
            this.getSetting('job_type').then((response) => this.types = response.job_type);
            this.getSetting('job_type').then((response) => this.types = response.job_type);
            this.user.country = this.authUser.profile.country_id;
            this.user.city = this.authUser.profile.city_id;
            this.user.state = this.authUser.profile.state_id;
            this.user.zip = this.authUser.profile.zip;
            this.user.description = this.authUser.profile.description;
            this.user.phone = this.authUser.profile.phone;
            this.user.address = this.authUser.profile.address;

            this.onChange(this.user.country).then((response) => this.states = response);
            this.onChange(this.user.state).then((response) => this.cities = response);
            // if (this.user.country) {
            //     this.onChangeCountry();
            // }
            // if (this.user.state) {
            //     this.onChangeState();
            // }
        },
        methods: {
            edit() {
                let user = {
                    country_id: this.user.country,
                    city_id: this.user.city,
                    state_id: this.user.state,
                    zip: this.user.zip,
                    description: this.user.description,
                    phone: this.user.phone,
                    address: this.user.address
                };
                let component = this;
                $("#btnSubmit").addClass("is-loading");
                axios.put('/api/profile/' + this.authUser.id, user)
                    .then(function (response) {
                        $("#btnSubmit").removeClass("is-loading");
                        if (response.data.meta.status == 'success') {
                            component.$store.dispatch(MutationTypes.SHOW_SUCCESS, response);
                        }
                    }).catch(error => {
                    if (error.response.data.meta.status == 'fail') {
                        $("#btnSubmit").removeClass("is-loading");
                        component.$store.dispatch(MutationTypes.SHOW_ERROR, error);
                    }
                })


            },
            addJob() {
                this.message=''
                $("#btnSave").addClass("is-loading");
                axios.post('/api/job', this.job)
                    .then(function (response) {
                        $("#btnSave").removeClass("is-loading");
                        this.message = response.data.meta.message
                        this.apiStatus = response.data.meta.status
                    }).catch(error => {
                    $("#btnSave").removeClass("is-loading");
                    this.message = error.response.data.meta.message
                    this.apiStatus = error.response.data.meta.status

                })
            }, addEdu() {
                this.message=''
                $("#btnSaveEdu").addClass("is-loading");
                axios.post('/api/education', this.edu)
                    .then(function (response) {
                        $("#btnSaveEdu").removeClass("is-loading");
                        this.message = response.data.meta.message
                        this.apiStatus = response.data.meta.status
                    }).catch(error => {
                    $("#btnSaveEdu").removeClass("is-loading");
                    this.message = error.response.data.meta.message
                    this.apiStatus = error.response.data.meta.status

                })
            },
            onChange_setState() {
                this.onChange(this.user.country).then((response) => this.states = response);
            },
            onChange_setCity() {
                this.onChange(this.user.state).then((response) => this.states = response);
            },

            getSetting(setting) {
                return axios.get('/social/core/api/baseSetting/settings/' + setting)
                    .then((response) =>
                        response.data.data
                    ).catch(function (error) {
                        console.log('an error occured ' + error);
                    });
            },
            onChange(setting) {
                return axios.get('/social/core/api/setting/' + setting)
                    .then((response) =>
                        response.data.data.setting.children
                    ).catch(function (error) {
                        console.log('an error occured ' + error);
                    });
            }
            , OpenModal(id) {
                $(id).addClass("is-active");
            }
            , CloseModal(id) {
                $(id).removeClass("is-active");
                $('.message-box').removeClass("is-active");
            }
        },

        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
        }
    }
</script>
