<template>
    <div class="navbar">
        <button @click="createArchitect">Add New Architect</button>
        <button>Architects</button>
    </div>
</template>

<script>
export default {

    methods: {
        createArchitect() {
            this.$parent.createArchitect();
        }
    }
}
</script>