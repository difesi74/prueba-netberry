require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('app-component', require('./components/AppComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('lista-tareas-component', require('./components/ListaTareasComponent.vue').default);
Vue.component('tarea-component', require('./components/TareaComponent.vue').default);

const app = new Vue({
    el: '#app',
});
