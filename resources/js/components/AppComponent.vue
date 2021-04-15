<template>
    <Navbar />
    <ArchitectList :architects="architects" v-if="architectListVisible"/>
    <CreateArchitectForm :createArchitectVisible="createArchitectVisible" />

</template>

<script>
import Navbar from './templates/Navbar.vue'
import CreateArchitectForm from './templates/CreateArchitectForm.vue'
import ArchitectList from './templates/ArchitectList.vue'


    export default {
        name: "App",
        components: { Navbar, CreateArchitectForm, ArchitectList },
        data() {
            return {
                architects: [],
                createArchitectVisible: false,
                architectListVisible: true
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