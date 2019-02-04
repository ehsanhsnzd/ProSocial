<template>


    <div v-if="validationSuccess" id="Message" class="message-box is-active">
        <div class="notification is-success">
            <a @click="closeBox" class="delete"></a>
            <p>
                {{ 'input.Success' | trans }}
            </p>
            <ul>
                <li v-for="(value, key, index) in validationSuccess">
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
        props: ['success'],
        computed: {
            validationSuccess() {
                let success = Object.values(this.success);
                success = success.flat();
                return success;
            }
        },
        methods:{
            closeBox(){
                $('#Message').removeClass('is-active')
            }
        }
    }
</script>