<template>

<div class="form" ref="createArchitectDOM" v-if="createArchitectVisible">
    <form ref="createArchitect">
        <button type="button" class="close" @click="close">X</button>
        <h2>Add New Architect</h2>
        <div class="input">
            <label>Name</label>
            <input type="text" name="name" placeholder="enter name" :value="name">
            <span>{{nameError}}</span>
        </div>
        <div class="input">
            <label>Surname</label>
            <input type="text" name="surname" placeholder="enter surname" :value="surname">
            <span>{{surnameError}}</span>
        </div>
        <div class="input textarea">
            <label>About</label>
            <textarea name="about" placeholder="about" :value="about"></textarea>
            <span>{{aboutError}}</span>
        </div>
        <div class="submit">
            <input type="submit" class="button" id="submit" value="Submit" @click="createArchitect">
        </div>
    </form>
</div>

</template>

<script>
export default {
    props: ['createArchitectVisible'],
    data() {
        return {
            name: '',
            surname: '',
            about: '',
            nameError: '',
            surnameError: '',
            aboutError: ''
        }
    },
    methods: {
        createArchitect(e) {
            e.preventDefault();
            axios.post('http://localhost/bit/learningvue/public/architects/create', new FormData(this.$refs.createArchitect))
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
                } else {
                    this.nameError = '';
                    this.surnameError = '';
                    this.aboutError = '';
                    this.name = '';
                    this.surname = '';
                    this.about = '';
                    const messege = `Architect <span>${res.data.success.name} ${res.data.success.surname}</span> has been added successfully`;
                    const contDOM = document.querySelector('#toast');
                    const textDOM = document.querySelector('#toast > p');
                    contDOM.classList.remove('hidden');
                    textDOM.innerHTML = messege;
                    setTimeout(() => {
                        contDOM.classList.add('hidden');
                        textDOM.innerHTML = '';
                    }, 3500);
                    this.$parent.architects = res.data.architects;
                    this.close();
                }
            }).catch(err => { console.log(err); });
        },
        close() {
            this.nameError = '';
            this.surnameError = '';
            this.aboutError = '';
            this.name = '';
            this.surname = '';
            this.about = '';
            this.$parent.createArchitectVisible = !this.$parent.createArchitectVisible;
        }
    }
}
</script>