<template>
    <Navbar />
    <ArchitectList :architects="architects" :projects="projects" v-if="architectListVisible"/>
    <ProjectList :architects="architects" :projects="projects" v-if="projectListVisible"/>
    <CreateArchitectForm :createArchitectVisible="createArchitectVisible"/>
    <CreateProject :createProjectVisible="createProjectVisible" :architects="architects"/>
    <div class="loader" v-if="loadingArchitects || loadingProjects">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="hidden" id="toast">
        <p></p>
    </div>
    <div class="backToTop">
        <a class="hidden" href="#">
            <div class="triangle"></div>
        </a>
    </div>

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
                projectListVisible: false,
                loadingArchitects: true,
                loadingProjects: true
            }
        },
        mounted() {
            axios.post('http://localhost/bit/learningvue/public/architects')
            .then(res => {
                this.architects = res.data.architects.sort((a, b) => (a.surname > b.surname) ? 1 : -1);
                setTimeout(() => {
                    this.loadingArchitects = false;
                },6000);
            }).catch(err => { console.log(err) });
            axios.post('http://localhost/bit/learningvue/public/projects')
            .then(res => {
                this.projects = res.data.projects.sort((a, b) => (a.name > b.name) ? 1 : -1);
                setTimeout(() => {
                    this.loadingProjects = false;
                },6000);
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