<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading title is-4">Dashboard</div>
                <figure class="image is-128x128">
                <img class="is-rounded" :src="authUser.image.path" >
                </figure>
                    <div class="subtitle is-2">{{'input.Name' | trans}}: {{authUser.name}}</div>
                    <div class="subtitle ">{{'input.Last Name' | trans}}: {{authUser.last_name}}</div>
                    <div class="subtitle ">{{'input.Email' | trans}}: {{authUser.email}}</div>
                    <div class="subtitle ">{{'input.Type' | trans}}: {{authUser.type}}</div>
                    <div class="subtitle ">{{'input.Date' | trans}} {{'input.Sign Up' | trans}}: {{authUser.created_at}}</div>
                    <div class="subtitle ">{{'input.Messengers' | trans}}: {{authUser.messengers}}</div>
                    <div class="subtitle ">{{'input.Current Jobs' | trans}}: {{authUser.current_jobs}}</div>
                    <div class="subtitle ">{{'input.Jobs' | trans}}: {{authUser.jobs}}</div>
                    <div class="subtitle ">{{'input.Educations' | trans}}: {{authUser.educations}}</div>
                    <div class="subtitle ">{{'input.Skills' | trans}}: {{authUser.skills}}</div>
                    <div class="subtitle ">{{'input.Projects' | trans}}: {{authUser.projects}}</div>
                    <div class="panel-body"></div>
            </div>
        </div>
    </div>
</template>
<script>


    export default {


        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
            isLoggedIn() {
                return this.$store.getters.isLoggedIn;
            }
        },
        mounted() {

        }
    }

</script>

