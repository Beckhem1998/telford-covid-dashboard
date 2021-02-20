require('./bootstrap');

import Vue from 'vue';

Vue.component('timeline',require('./components/timeline.vue').default);

const app = new Vue({
    el: '#main'
});
