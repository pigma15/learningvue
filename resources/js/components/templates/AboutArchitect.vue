<template>
    <div class="aboutArchitect" :id="'aboutArchitect' + architect.id">
        <div>
            <button type="button" class="close" @click="close(architect.id)">X</button>
            <h2> {{ architect.name }} {{ architect.surname }} </h2>
            <p> {{architect.about}} </p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['architect'],
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