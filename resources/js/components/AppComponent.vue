<template>
    <h1>Hello</h1>
    <div v-for="architect in architects" :key="architect">
        <ArchitectRow :architect="architect" />
    </div>
</template>

<script>
import ArchitectRow from './ArchitectRow.vue'

    export default {
        name: "App",
        components: { ArchitectRow },
        data() {
            return {
                name: '',
                architects: [],
                loading: true
            }
        },
        mounted() {
            axios.post('http://localhost/bit/learningvue/public/architects')
                .then(res => {
                    this.architects = res.data.architects;
                    this.loading = false

                }).catch(err => { console.log(err); })
        },
        methods: {

        },
        computed: {
            
        }
    }
</script>