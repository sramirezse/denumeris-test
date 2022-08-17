// require('./bootstrap')

import { createApp } from 'vue';

// Vuex && js-cookie
import store from './store/index';
import VueGoogleMaps from '@fawmi/vue-google-maps'


import "vue-select/dist/vue-select.css";
import 'animate.css';
import Pagination from 'v-pagination-3';
import Table from './components/Table.vue';
import Loader from './components/Loader.vue';
import google_map from './components/Map.vue';
import "vue-select/dist/vue-select.css";
import { Chart, registerables } from 'chart.js';
import vSelect from "vue-select";


Chart.register(...registerables);

//Vue INIT
const app = createApp({
})

app.use(store);
app.use(VueGoogleMaps,{
    load: {
        key: 'AIzaSyCT5cXG8VGwbRFIGx76-zOliyRGdDnJiJY',
    },
});
// app.use(VueSweetalert2);
// app.use(VCalendar);
// app.use(DropZone);

// app.component('Wizard', Wizardd);
app.component('Loader', Loader);
app.component('google_map', google_map);
app.component('Table', Table);
app.component("v-select", vSelect);
app.component('Pagination', Pagination);
app.mount('#app');
