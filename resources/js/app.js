require('./bootstrap');

window.Vue = require('vue');

Vue.use(Vuetify);

import Vuetify from 'vuetify'


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});
