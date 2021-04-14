<template>
    <form :ref="'editFrom' + architect.id">
        <button type="button" @click="closeForm" :id="'canceEdit' + architect.id"> close {{ architect.name }} </button>
    </form>
</template>

<script>
    export default {
        props: ['architect', 'id'],
        methods: {
            closeForm(e) {
                const id = e.target.id.replace('canceEdit', 'editConfirm');
                console.log(this.$parent.$parent.architects = [{
                    id: 1,
                    name: 'Rope',
                    surname: 'Forever'
                }]);
                //this.$parent.$refs[id].classList.add('inv');
            }
        }
    }
</script>