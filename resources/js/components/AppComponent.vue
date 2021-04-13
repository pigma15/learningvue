<template>
    <Modal sending="Hello from World" :name="name"/>
    <button @click="sortBy('name')">sort by name</button>
    <button @click="sortBy('surname')">sort by surname</button>
    <div class="screen" v-if="loading"></div>
    <p :id="'clicked' + architect.id" v-for="architect in architects" :key="architect" @click="clicker"> {{ architect.name }} {{ architect.surname }}</p>
</template>

<script>
import Modal from './Modal.vue'

    export default {
        name: "App",
        components: { Modal },
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

                })
                .catch(err => {
                    console.log(err);
                })
        },
        methods: {
            sortBy(attr) {
                if(attr === 'name') this.architects.sort((a, b) => (a.name > b.name) ? 1 : -1);
                if(attr === 'surname') this.architects.sort((a, b) => (a.surname > b.surname) ? 1 : -1);
            },
            clicker(e) {
                e.target.classList.toggle('green');
                for (let architect of this.architects) {
                    if(architect.id == e.target.id.replace('clicked', '')) {
                        this.name = architect.name;
                    }
                }
            }
        },
        computed: {
            
        }
    }
</script>








<style scoped>
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
.screen {
    display: inline-block;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #25a;
}
</style>


