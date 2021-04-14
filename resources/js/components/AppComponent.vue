<template>
    <CreateArchitectForm :createArchitectVisible="createArchitectVisible"/>
    <button @click="createArchitect">Add New Architect</button>
</template>

<script>
import CreateArchitectForm from './templates/CreateArchitectForm.vue'

    export default {
        name: "App",
        components: { CreateArchitectForm },
        data() {
            return {
                architects: [],
                createArchitectVisible: false
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
            createArchitect() {
                this.createArchitectVisible = !this.createArchitectVisible;
            }
        },
        computed: {
            
        }
    }
</script>