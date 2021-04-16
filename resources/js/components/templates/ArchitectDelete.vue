<template>
    <div class="deleteArchitect" :id="'deleteArchitect' + architect.id">
        <form :ref="'deleteConfirm' + architect.id">
            <p> Do You really want to remove {{architect.name}} {{architect.surname}}?</p>
            <div class="deleteButtons">
                <input type="hidden" name="id" :value="architect.id">
                <input type="submit" value="YES" @click="deleteArchitect" :id="'deleteArchitectSubmit' + architect.id">
                <button class="cancelDelete" type="button" @click="cancelDelete(architect.id)">NO</button>
            </div>
            <p class="error">{{error}}</p>
        </form>
    </div>
</template>

<script>
export default {
    props: ['architect'],
    data() {
        return {
            error: ''
        }
    },
    methods: {
        cancelDelete(id) {
            document.getElementById(`deleteArchitect${id}`).style.display = 'none';
            this.error = '';
        },
        deleteArchitect(e) {
            e.preventDefault();
            const id = e.target.id.replace('deleteArchitectSubmit', 'deleteConfirm');
            axios.post('http://localhost/bit/learningvue/public/architects/delete', new FormData(this.$refs[id]))
            .then(res => {
                if(res.data.error) {
                    this.error = res.data.error ?? '';
                } else {
                    const messege = `Architect <span>${res.data.deletedArchitect.name} ${res.data.deletedArchitect.surname}</span> has been removed successfully`;
                    const contDOM = document.querySelector('#toast');
                    const textDOM = document.querySelector('#toast > p');
                    contDOM.classList.remove('hidden');
                    textDOM.innerHTML = messege;
                    setTimeout(() => {
                        contDOM.classList.add('hidden');
                        textDOM.innerHTML = '';
                    }, 3500);
                    this.error = '';
                    this.$parent.$parent.architects = res.data.architects;
                    this.cancelDelete(id.replace('deleteConfirm', ''));
                }
            }).catch(err => { console.log(err) });
        }
    }
}
</script>