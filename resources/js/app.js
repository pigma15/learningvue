const { default: axios } = require('axios');
require('./bootstrap');

import {createApp} from 'vue'
import AppComponent from './components/AppComponent.vue'

createApp({
    components: {
        AppComponent,
    }
}).mount('#app');


function animateBackToTop() {
    const backToTop = document.querySelector('.backToTop > a');
    addEventListener('wheel', event => {
        if (window.scrollY < window.innerHeight / 6) {
            backToTop.classList.add('hidden')
        } else {
            if (event.deltaY > 0) {
                backToTop.classList.add('hidden')
            }
            if (event.deltaY < 0) {
                backToTop.classList.remove('hidden')
            }
        }
        return;
    })
}

animateBackToTop();