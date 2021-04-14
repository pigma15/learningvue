<template>
    <div>
        <span> {{ architect.name }} </span>
        <span> {{ architect.surname }} </span>
        <button :id="'edit' + architect.id" @click="getEdit"> EDIT </button>
        <div class="inv" :ref="'editConfirm' + architect.id">
            <EditArchitectForm :architect="architect"/>
        </div>
    </div>
</template>

<script>
import EditArchitectForm from './EditArchitectForm.vue'

    export default {
        props: ['architect'],
        components: { EditArchitectForm },
        methods: {
            getEdit(e) {
                const id = e.target.id.replace('edit', 'editConfirm');
                this.$refs[id].classList.toggle('inv');
            }
        }
    }
</script>

<style>
.inv {
    display: none;
}
</style>