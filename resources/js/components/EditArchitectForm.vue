<template>
    <form>
        <button type="button"> {{ architect.name }} form</button>
    </form>
</template>

<script>
    export default {
        props: ['architect'],
    }
</script>