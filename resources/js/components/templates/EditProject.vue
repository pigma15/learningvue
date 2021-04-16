<template>

<div class="form editProject" :id="'editProject' + project.id">
    <form :ref="'editProject' + project.id">
        <button type="button" class="close" @click="cancelEditProject(project.id)">X</button>
        <h2> {{project.name}} </h2>
        <div class="input">
            <label>Name</label>
            <input type="text" name="name" placeholder="enter name" :value="project.name">
            <span>{{nameError}}</span>
        </div>
        <div class="input">
            <label>Location</label>
            <input type="text" name="location" placeholder="enter location" :value="project.location">
            <span>{{locationError}}</span>
        </div>
        <div class="input textarea">
            <label>About</label>
            <textarea name="about" placeholder="about" :value="project.about"></textarea>
            <span>{{aboutError}}</span>
        </div>
        <div class="input select">
            <label>Architect</label>
            <select name="architect_id" >
                <option v-for="architect in architects" :key="architect" :value="architect.id" :selected="architect.id === architectCurrent.id"> {{architect.name}} {{architect.surname}}</option>
            </select>
            <span>{{architectError}}</span>
        </div>
        <div class="submit">
            <input type="submit" class="button" value="Submit" @click="editProject" :id="'editProjectSubmit' + project.id">
        </div>
        <input type="hidden" name="id" :value="project.id">
    </form>
</div>

</template>

<script>
export default {
    props: ['project', 'architectCurrent', 'architects'],
    data() {
        return {
            name: this.project.name,
            location: this.project.location,
            about: this.project.about,
            nameError: '',
            locationError: '',
            aboutError: '',
            architectError: ''
        }
    },
    methods: {
        editProject(e) {
            e.preventDefault();
            const id = e.target.id.replace('editProjectSubmit', 'editProject');
            axios.post('http://localhost/bit/learningvue/public/projects/edit', new FormData(this.$refs[id]))
            .then(res => {
                if (res.data.error) {
                    this.nameError = res.data.error.name ?? '';
                    this.locationError = res.data.error.location ?? '';
                    this.aboutError = res.data.error.about ?? '';
                    this.architectError = res.data.error.architect_id ?? '';
                    if (res.data.project) {
                        this.name = res.data.project.name ?? '';
                        this.location = res.data.project.location ?? '';
                        this.about = res.data.project.about ?? '';
                    }
                } else {
                    this.nameError = '';
                    this.locationError = '';
                    this.aboutError = '';
                    this.architectError = '';
                    this.name = '';
                    this.location = '';
                    this.about = '';
                    const message = `Project <span>${res.data.success}</span> has been edited successfully`;
                    const contDOM = document.querySelector('#toast');
                    const textDOM = document.querySelector('#toast > p');
                    contDOM.classList.remove('hidden');
                    textDOM.innerHTML = message;
                    setTimeout(() => {
                        contDOM.classList.add('hidden');
                        textDOM.innerHTML = '';
                    }, 3500);
                    this.$parent.$parent.projects = res.data.projects;
                    this.cancelEditProject(id.replace('editProject', ''));
                }
            }).catch(err => { console.log(err); });
        },
        cancelEditProject(id) {
            this.nameError = '';
            this.locationError = '';
            this.aboutError = '';
            this.architectError = '';
            document.getElementById(`editProject${id}`).style.display = 'none';
        }
    }
}
</script>