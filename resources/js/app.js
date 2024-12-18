import './bootstrap';
import { createApp } from 'vue';

import app from './components/App.vue';
import router from './router';
import Pagination from './components/others/Pagination.vue';
createApp(app)
.component('Pagination', Pagination)
.use(router)
.mount("#app");