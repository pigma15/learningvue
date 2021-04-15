<template>
    <div class="navbar">
        <button @click="createArchitect">Add New Architect</button>
        <button @click="architectList">Architects</button>
        <button @click="createProject">Add New Project</button>
        <button @click="projecList">Projects</button>
    </div>
</template>

<script>
export default {

    methods: {
        createArchitect() {
            this.$parent.createArchitect();
        },
        createProject() {
            this.$parent.createProject();
        },
        architectList() {
            this.$parent.architectListVisible = true;
            this.$parent.projectListVisible = false;
        },
        projecList() {
            this.$parent.architectListVisible = false;
            this.$parent.projectListVisible = true;
        }
    }
}
</script>