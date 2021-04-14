<template>
    <CreateArchitectForm />
</template>

<script>
import CreateArchitectForm from './templates/CreateArchitectForm.vue'

    export default {
        name: "App",
        components: { CreateArchitectForm },
        data() {
            return {
                architects: [],
            }
        },
        mounted() {
            axios.post('http://localhost/bit/learningvue/public/architects')
                .then(res => {
                    this.architects = res.data.architects;
                    this.loading = false
                }).catch(err => { console.log(err); });
        },
        methods: {

        },
        computed: {
            
        }
    }
</script>