<template>
    <div class="list projects">
        <input class="search" type="text" v-model="searchProjects" placeholder="search">
        <h2>Projects</h2>
        <div class="line">
            <div class="top">
                <span>Name</span>
                <div class="sort" @click="sortBy('name')">
                    <div class="arrow" ref="sortByName"></div>
                </div>
            </div>
            <div class="top">
                <span>Location</span>
                <div class="sort" @click="sortBy('location')">
                    <div class="arrow" ref="sortByLocation"></div>
                </div>
            </div>
            <div class="top">
                <span>Architect</span>
                <div class="sort" @click="sortBy('architect')">
                    <div class="arrow" ref="sortByArchitect"></div>
                </div>
            </div>
            <div class="top actions">
                <span>Actions</span>
            </div>
        </div>
        <div class="line" v-for="project in filteredProjects" :key="project">
            <span> {{ project.name }} </span>
            <span> {{ project.location }} </span>
            <span> {{ this.getArchitect(project.architect_id) }} </span>
            <div class="bottom actions">
                <button @click="readAbout(project.id)" >read about</button>
                <AboutProject :project="project" :architect="this.getArchitect(project.architect_id)"/>
                <button @click="editProject(project.id)">edit</button>
                <EditProject :project="project" :architectCurrent="this.getArchitectID(project.architect_id)" :architects="architects"/>
                <button class="delete" @click="openDelete(project.id)">DELETE</button>
                <ProjectDelete :project="project"/>
            </div>
        </div>
    </div>
</template>

<script>
import ProjectDelete from './ProjectDelete.vue'
import AboutProject from './AboutProject.vue'
import EditProject from './EditProject.vue'

export default {
    components: { ProjectDelete, AboutProject, EditProject },
    props: ['architects', 'projects' ],
    data() {
        return {
            sortByName: 'asc',
            sortByLocation: 'asc',
            sortByArchitect: 'asc',
            searchProjects: '',
        }
    },
    computed: {
        filteredProjects:
        function () {
            return this.$parent.projects.filter((project) => {
                return (project.name.match(this.searchProjects) || project.location.match(this.searchProjects));
            })
        }
    },
    methods: {
        sortBy(attr) {
            if(attr === 'name') {
                if ('dsc' === this.sortByName) {
                    this.$parent.projects.sort((a, b) => (a.name > b.name) ? 1 : -1);
                    this.sortByName = 'asc';
                    this.$refs.sortByName.classList.toggle('down');
                } else {
                    this.$parent.projects.sort((a, b) => (a.name < b.name) ? 1 : -1);
                    this.sortByName = 'dsc';
                    this.$refs.sortByName.classList.toggle('down');
                }
            }
            if(attr === 'location') {
                if ('dsc' === this.sortByLocation) {
                    this.$parent.projects.sort((a, b) => (a.location > b.location) ? 1 : -1);
                    this.sortByLocation = 'asc';
                    this.$refs.sortByLocation.classList.toggle('down');
                } else {
                    this.$parent.projects.sort((a, b) => (a.location < b.location) ? 1 : -1);
                    this.sortByLocation = 'dsc';
                    this.$refs.sortByLocation.classList.toggle('down');
                }
            }
            if(attr === 'architect') {
                if ('dsc' === this.sortByArchitect) {
                    this.$parent.projects.sort((a, b) => (this.architectLastName(a.architect_id) > this.architectLastName(b.architect_id)) ? 1 : -1);
                    this.sortByArchitect = 'asc';
                    this.$refs.sortByArchitect.classList.toggle('down');
                } else {
                    this.$parent.projects.sort((a, b) => (this.architectLastName(a.architect_id) < this.architectLastName(b.architect_id)) ? 1 : -1);
                    this.sortByArchitect = 'dsc';
                    this.$refs.sortByArchitect.classList.toggle('down');
                }
            }
        },
        openDelete(id) {
            document.getElementById(`deleteProject${id}`).style.display = 'grid';
        },
        readAbout(id) {
            document.getElementById(`aboutProject${id}`).style.display = 'grid';
        },
        editProject(id) {
            document.getElementById(`editProject${id}`).style.display = 'grid';
        },
        getArchitect(id) {
            for (let architect of this.architects) {
                if (architect.id === id) {
                    return `${architect.name} ${architect.surname}`;
                }
            }
        },
        getArchitectID(id) {
            for (let architect of this.architects) {
                if (architect.id === id) {
                    return architect;
                }
            }
        },
        architectLastName(id) {
            for (let architect of this.architects) {
                if (architect.id === id) {
                    return architect.surname;
                }
            }
        }
    }
}
</script>