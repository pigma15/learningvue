<template>
    <div class="deleteArchitect" :id="'deleteArchitect' + architect.id">
        <form :ref="'deleteConfirm' + architect.id">
            <p> Do You really want to remove {{architect.name}} {{architect.surname}}?</p>
            <div class="deleteButtons">
                <input type="hidden" name="id" :value="architect.id">
                <input type="submit" value="YES" @click="deleteArchitect" :id="'deleteArchitectSubmit' + architect.id">
                <button class="cancelDelete" type="button" @click="cancelDelete(architect.id)">NO</button>
            </div>
        </form>
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
        cancelDelete(id) {
            document.getElementById(`deleteArchitect${id}`).style.display = 'none';
        },
        deleteArchitect(e) {
            e.preventDefault();
            const id = e.target.id.replace('deleteArchitectSubmit', 'deleteConfirm');
            axios.post('http://localhost/bit/learningvue/public/architects/delete', new FormData(this.$refs[id]))
            .then(res => {
                console.log(res.data);
                this.$parent.$parent.architects = res.data.architects;
            }).catch(err => { console.log(err) });
            document.getElementById(`deleteArchitect${id.replace('deleteConfirm', '')}`).style.display = 'none';
        }
    }
}
</script>