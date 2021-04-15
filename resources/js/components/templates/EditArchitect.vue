<template>

<div class="form editArchitect" :id="'editArchitect' + architect.id">
    <form :ref="'editArchitect' + architect.id">
        <button type="button" class="close" @click="cancelEditArchitect(architect.id)">X</button>
        <h2>Edit {{ architect.name }} {{ architect.surname }} </h2>
        <div class="input">
            <label>Name</label>
            <input type="text" name="name" placeholder="enter name" :value="name">
            <span>{{nameError}}</span>
        </div>
        <div class="input">
            <label>Surname</label>
            <input type="text" name="surname" placeholder="enter surname" :value="architect.surname">
            <span>{{surnameError}}</span>
        </div>
        <div class="input textarea">
            <label>About</label>
            <textarea name="about" placeholder="about" :value="architect.about"></textarea>
            <span>{{aboutError}}</span>
        </div>
        <div class="submit">
            <input type="submit" class="button" value="Submit" @click="editArchitect" :id="'editArchitectSubmit' + architect.id">
        </div>
        <input type="hidden" name="id" :value="architect.id">
    </form>
</div>

</template>

<script>
export default {
    props: ['architect'],
    data() {
        return {
            name: this.architect.name,
            surname: this.architect.surname,
            about: this.architect.name.about,
            nameError: '',
            surnameError: '',
            aboutError: ''
        }
    },
    methods: {
        editArchitect(e) {
            e.preventDefault();
            const id = e.target.id.replace('editArchitectSubmit', 'editArchitect');
            axios.post('http://localhost/bit/learningvue/public/architects/edit', new FormData(this.$refs[id]))
            .then(res => {
                 if (res.data.error) {
                    this.nameError = res.data.error.name ?? '';
                    this.surnameError = res.data.error.surname ?? '';
                    this.aboutError = res.data.error.about ?? '';
                    if (res.data.architect) {
                        this.name = res.data.architect.name ?? '';
                        this.surname = res.data.architect.surname ?? '';
                        this.about = res.data.architect.about ?? '';
                    }
                }else {
                    this.nameError = '';
                    this.surnameError = '';
                    this.aboutError = '';
                    console.log(res.data.success); 
                    this.$parent.$parent.architects = res.data.architects;
                    this.cancelEditArchitect(id.replace('editArchitect', ''));
                }
            }).catch(err => { console.log(err); });
        },
        cancelEditArchitect(id) {
            document.getElementById(`editArchitect${id}`).style.display = 'none';
        }
    }
}
</script>