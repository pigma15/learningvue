<template>
    <Navbar />
    <ArchitectList :architects="architects" :projects="projects" v-if="architectListVisible"/>
    <ProjectList :architects="architects" :projects="projects" v-if="projectListVisible"/>
    <CreateArchitectForm :createArchitectVisible="createArchitectVisible"/>
    <CreateProject :createProjectVisible="createProjectVisible" :architects="architects"/>

</template>

<script>
import Navbar from './templates/Navbar.vue'
import CreateArchitectForm from './templates/CreateArchitectForm.vue'
import CreateProject from './templates/CreateProject.vue'
import ArchitectList from './templates/ArchitectList.vue'
import ProjectList from './templates/ProjectList.vue'


    export default {
        name: "App",
        components: { Navbar, CreateArchitectForm, ArchitectList, CreateProject, ProjectList },
        data() {
            return {
                architects: [],
                projects: [],
                createArchitectVisible: false,
                createProjectVisible: false,
                architectListVisible: true,
                projectListVisible: false
            }
        },
        mounted() {
            axios.post('http://localhost/bit/learningvue/public/architects')
                .then(res => {
                    this.architects = res.data.architects.sort((a, b) => (a.surname > b.surname) ? 1 : -1);;
                }).catch(err => { console.log(err) });
            axios.post('http://localhost/bit/learningvue/public/projects')
                .then(res => {
                    this.projects = res.data.projects.sort((a, b) => (a.name > b.name) ? 1 : -1);;
                }).catch(err => { console.log(err) });
        },
        methods: {
            createArchitect() {
                this.createArchitectVisible = !this.createArchitectVisible;
            },
            createProject() {
                this.createProjectVisible = !this.createProjectVisible;
            }

        },
        computed: {
            
        }
    }
</script>