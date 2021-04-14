<template>
    <h1>{{sending}}</h1>
    <span> {{ name }} </span>
    <br>
</template>

<script>
export default {
    props: ['sending', 'name']
}
</script>