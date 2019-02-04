<template>


    <div v-if="validationErrors" class="message-box is-active">
        <div class="notification is-danger" style="width: 400px">
            <a @click="closeBox" class="delete"></a>
            <ul width="100%">
                <li class="is-size-7" v-for="(value, key, index) in validationErrors">
                    {{ value }}
                </li>
            </ul>
        </div>
    </div>


</template>

<script>

    export default {
        data() {
            return {}
        },
        props: ['errors'],
        computed: {
            validationErrors() {
                $('.message-box').addClass('is-active')
                let errors = Object.values(this.errors);
                errors = errors.flat();
                return errors;
            }
        },
        methods: {
            closeBox() {
                $('.message-box').removeClass('is-active')
            }
        }
    }
</script>