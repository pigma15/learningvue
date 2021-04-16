<template>
    <div class="deleteProject" :id="'deleteProject' + project.id">
        <form :ref="'deleteConfirm' + project.id">
            <p> Do You really want to remove {{project.name}} ?</p>
            <div class="deleteButtons">
                <input type="hidden" name="id" :value="project.id">
                <input type="submit" value="YES" @click="deleteProject" :id="'deleteProjectSubmit' + project.id">
                <button class="cancelDelete" type="button" @click="cancelDelete(project.id)">NO</button>
            </div>
            <p class="error">{{error}}</p>
        </form>
    </div>
</template>

<script>
export default {
    props: ['project'],
    data() {
        return {
            error: ''
        }
    },
    methods: {
        cancelDelete(id) {
            document.getElementById(`deleteProject${id}`).style.display = 'none';
            this.error = '';
        },
        deleteProject(e) {
            e.preventDefault();
            const id = e.target.id.replace('deleteProjectSubmit', 'deleteConfirm');
            axios.post('http://localhost/bit/learningvue/public/projects/delete', new FormData(this.$refs[id]))
            .then(res => {
                if(res.data.error) {
                    this.error = res.data.error ?? '';
                } else {
                    const message = `Project <span>${res.data.deletedProject.name}</span> has been removed successfully`;
                    const contDOM = document.querySelector('#toast');
                    const textDOM = document.querySelector('#toast > p');
                    contDOM.classList.remove('hidden');
                    textDOM.innerHTML = message;
                    setTimeout(() => {
                        contDOM.classList.add('hidden');
                        textDOM.innerHTML = '';
                    }, 3500);
                    this.error = '';
                    this.$parent.$parent.projects = res.data.projects;
                    this.cancelDelete(id.replace('deleteConfirm', ''));
                }
            }).catch(err => { console.log(err) });
        }
    }
}
</script>