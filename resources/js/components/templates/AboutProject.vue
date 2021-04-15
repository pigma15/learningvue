<template>
    <div class="aboutProject" :id="'aboutProject' + project.id">
        <div>
            <button type="button" class="close" @click="close(project.id)">X</button>
            <h2> {{ project.name }} </h2>
            <p> Architect: {{ architect }} </p>
            <p> Location of project: {{ project.location }}</p>
            <p> {{project.about}} </p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['architect', 'project'],
    data() {
        return {

        }
    },
    methods: {
        close(id) {
            document.getElementById(`aboutProject${id}`).style.display = 'none';
        }
    }
}
</script>