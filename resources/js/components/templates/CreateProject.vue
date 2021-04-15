<template>

<div class="form" ref="createProjectDOM" v-if="createProjectVisible">
    <form ref="createProject">
        <button type="button" class="close" @click="close">X</button>
        <h2>Add New Project</h2>
        <div class="input">
            <label>Name</label>
            <input type="text" name="name" placeholder="enter name" :value="name">
            <span>{{nameError}}</span>
        </div>
        <div class="input">
            <label>Location</label>
            <input type="text" name="location" placeholder="enter location" :value="location">
            <span>{{locationError}}</span>
        </div>
        <div class="input textarea">
            <label>About</label>
            <textarea name="about" placeholder="about" :value="about"></textarea>
            <span>{{aboutError}}</span>
        </div>
        <div class="input select">
            <label>Architect</label>
            <select name="architect_id">
                <option value="0" selected disabled>Select Architect</option>
                <option v-for="architect in architects" :key="architect" :value="architect.id"> {{architect.name}} {{architect.surname}}</option>
            </select>
            <span>{{architectError}}</span>
        </div>
        <div class="submit">
            <input type="submit" class="button" id="submit" value="Submit" @click="createProject">
        </div>
    </form>
</div>

</template>

<script>
export default {
    props: ['createProjectVisible', 'architects'],
    data() {
        return {
            name: '',
            location: '',
            about: '',
            nameError: '',
            locationError: '',
            aboutError: '',
            architectError: ''
        }
    },
    methods: {
        createProject(e) {
            e.preventDefault();
            axios.post('http://localhost/bit/learningvue/public/projects/create', new FormData(this.$refs.createProject))
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
                    console.log(res.data.success);
                    this.$parent.projects = res.data.projects;
                    this.close();
                }
            }).catch(err => { console.log(err); });
        },
        close() {
            this.nameError = '';
            this.locationError = '';
            this.aboutError = '';
            this.architectError = '';
            this.name = '';
            this.location = '';
            this.about = '';
            this.$parent.createProjectVisible = !this.$parent.createProjectVisible;
        }
    }
}
</script>