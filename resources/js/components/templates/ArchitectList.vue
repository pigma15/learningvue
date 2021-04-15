<template>
    <div class="list architects">
        <input class="search" type="text" v-model="searchArchitects" placeholder="search">
        <h2>Architects</h2>
        <div class="line">
            <div class="top">
                <span>Name</span>
                <div class="sort">
                    <div class="arrow" @click="sortBy('name')" ref="sortByName"></div>
                </div>
            </div>
            <div class="top">
                <span>Surname</span>
                <div class="sort">
                    <div class="arrow" @click="sortBy('surname')" ref="sortBySurname"></div>
                </div>
            </div>
        </div>
        <div class="line" v-for="architect in filteredArchitects" :key="architect">
            <span> {{ architect.name }} </span>
            <span> {{ architect.surname }} </span>
        </div>
    </div>
</template>

<script>
export default {
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
        }
    }
}
</script>