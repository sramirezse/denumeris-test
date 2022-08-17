// require('./bootstrap')

import { createApp } from 'vue';

// Vuex && js-cookie
import store from './store/index';
import Cookies from 'js-cookie';
// Vue Router
import router from './router/index';
//SWEETALERT
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


// import CKEditor from '@ckeditor/ckeditor5-vue';
import DropZone from 'dropzone-vue';
// optionally import default styles
import 'dropzone-vue/dist/dropzone-vue.common.css';

import 'form-wizard-vue3/dist/form-wizard-vue3.css';


// import vSelect from 'vue-select';
// import "vue-select/dist/vue-select.css";
import 'animate.css';
import Pagination from 'v-pagination-3';
import Table from './components/Table.vue';
import Loader from './components/Loader.vue';
import Layout from './layout/Index.vue';
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

//Vue INIT
const app = createApp({
})

app.use(store);
app.use(router);
app.use(VueSweetalert2);
app.use(DropZone);
app.component("v-select", vSelect);
app.component('Loader', Loader);
app.component('Layout', Layout);
app.component('Table', Table);
app.component('Pagination', Pagination);
app.mount('#adapp');
