<template>

<div class="form" ref="createArchitect">
    <form>
        <button type="button" class="close">X</button>
        <h2>Add New Architect</h2>
        <div class="input">
            <label>Name</label>
            <input type="text" name="name" placeholder="enter name">
            <span></span>
        </div>
        <div class="input">
            <label>Surname</label>
            <input type="text" name="surname" placeholder="enter surname">
            <span></span>
        </div>
        <div class="input textarea">
            <label>About</label>
            <textarea name="about" placeholder="name"></textarea>
            <span></span>
        </div>
        <div class="submit">
            <input type="submit" class="button" id="submit" value="Submit" @click="createArchitect">
        </div>
    </form>
</div>

</template>

<script>
export default {
    methods: {
        createArchitect(e) {
            e.preventDefault();
            console.log(this.$refs.createArchitect);
            axios.post('http://localhost/bit/learningvue/public/architects/create')
            .then(res => {
                    console.log(res);
                }).catch(err => { console.log(err); });
        }
    }
}
</script>