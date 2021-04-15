<template>
    <div class="aboutArchitect" :id="'aboutArchitect' + architect.id">
        <div>
            <button type="button" class="close" @click="close(architect.id)">X</button>
            <h2> {{ architect.name }} {{ architect.surname }} </h2>
            <p> {{architect.about}} </p>
            <h3>Projects:</h3>
            <div class="projects" v-for="project in this.projects" :key="project">
                <p v-if="project.architect_id === architect.id"> {{ project.name }} in {{ project.location }} </p>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: ['architect', 'projects'],
    data() {
        return {

        }
    },
    methods: {
        close(id) {
            document.getElementById(`aboutArchitect${id}`).style.display = 'none';
        }
    }
}
</script>