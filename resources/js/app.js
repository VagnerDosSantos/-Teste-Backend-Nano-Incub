require('./bootstrap');

window.Vue = require('vue').default;

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const options = {
    confirmButtonColor: '#00c853',
    cancelButtonColor: '#d50000',
    cancelButtonText: 'Cancelar'
};

Vue.use(VueSweetalert2, options);

Vue.component('excluir-funcionario', require('./components/ExcluirFuncionario.vue').default);
Vue.component('bar-chart', require('./components/BarChart.vue').default);

const app = new Vue({
    el: '#container',
});
