<template>
    <button type="button" @click="sortBy('name')">sort by name</button>
    <button type="button" @click="sortBy('surname')">sort by surname</button>
    <p v-for="architect in architects" :key="architect" @click="e => e.target.classList.toggle('green')"> {{ architect.name }} {{ architect.surname }}</p>
</template>

<script>
    export default {
        data() {
            return {
                architects: []
            }
        },
        mounted() {
            axios.post('http://localhost/bit/learningvue/public/architects')
                .then(res => {
                    this.architects = res.data.architects;
                })
                .catch(err => {
                    console.log(err);
                })
        },
        methods: {
            sortBy(attr) {
                if(attr === 'name') this.architects.sort((a, b) => (a.name > b.name) ? 1 : -1);
                if(attr === 'surname') this.architects.sort((a, b) => (a.surname > b.surname) ? 1 : -1);
            }
        },
        computed: {
            
        }
    }
</script>








<style>
p {
    display: grid;
    place-items: center;
    height: 20px;
    margin: 4px 30%;
    border: 1px solid black;
    width: 40%;
}
p.green {
    background: #6d7;
}
</style>