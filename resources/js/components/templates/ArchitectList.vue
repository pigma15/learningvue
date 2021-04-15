<template>
    <div class="list architects">
        <input class="search" type="text" v-model="searchArchitects" placeholder="search">
        <h2>Architects</h2>
        <div class="line">
            <div class="top">
                <span>Name</span>
                <div class="sort" @click="sortBy('name')">
                    <div class="arrow" ref="sortByName"></div>
                </div>
            </div>
            <div class="top">
                <span>Surname</span>
                <div class="sort" @click="sortBy('surname')">
                    <div class="arrow" ref="sortBySurname"></div>
                </div>
            </div>
            <div class="top actions">
                <span>Actions</span>
            </div>
        </div>
        <div class="line" v-for="architect in filteredArchitects" :key="architect">
            <span> {{ architect.name }} </span>
            <span> {{ architect.surname }} </span>
            <div class="bottom actions">
                <button @click="readAbout(architect.id)" >read about</button>
                <AboutArchitect :architect="architect"/>
                <button @click="editArchitect(architect.id)">edit</button>
                <EditArchitect :architect="architect"/>
                <button class="delete" @click="openDelete(architect.id)">DELETE</button>
                <ArchitectDelete :architect="architect"/>
            </div>
        </div>
    </div>
</template>

<script>
import ArchitectDelete from './ArchitectDelete.vue'
import AboutArchitect from './AboutArchitect.vue'
import EditArchitect from './EditArchitect.vue'

export default {
    components: { ArchitectDelete, AboutArchitect, EditArchitect },
    props: ['architects'],
    data() {
        return {
            sortByName: 'asc',
            sortBySurname: 'asc',
            searchArchitects: ''
        }
    },
    computed: {
        filteredArchitects:
        function () {
            return this.$parent.architects.filter((architect) => {
                return (architect.name.match(this.searchArchitects) || architect.surname.match(this.searchArchitects));
            })
        }
    },
    methods: {
        sortBy(attr) {
            if(attr === 'name') {
                if ('dsc' === this.sortByName) {
                    this.$parent.architects.sort((a, b) => (a.name > b.name) ? 1 : -1);
                    this.sortByName = 'asc';
                    this.$refs.sortByName.classList.toggle('down');
                } else {
                    this.$parent.architects.sort((a, b) => (a.name < b.name) ? 1 : -1);
                    this.sortByName = 'dsc';
                    this.$refs.sortByName.classList.toggle('down');
                }
            }
            if(attr === 'surname') {
                if ('dsc' === this.sortBySurname) {
                    this.$parent.architects.sort((a, b) => (a.surname > b.surname) ? 1 : -1);
                    this.sortBySurname = 'asc';
                    this.$refs.sortBySurname.classList.toggle('down');
                } else {
                    this.$parent.architects.sort((a, b) => (a.surname < b.surname) ? 1 : -1);
                    this.sortBySurname = 'dsc';
                    this.$refs.sortBySurname.classList.toggle('down');
                }
            }
        },
        openDelete(id) {
            document.getElementById(`deleteArchitect${id}`).style.display = 'grid';
        },
        readAbout(id) {
            document.getElementById(`aboutArchitect${id}`).style.display = 'grid';
        },
        editArchitect(id) {
            document.getElementById(`editArchitect${id}`).style.display = 'grid';
        }
    }
}
</script>