require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './components/App.vue';
import VueSweetalert2 from 'vue-sweetalert2';
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
import VueTelInput from 'vue-tel-input'
import 'vue-tel-input/dist/vue-tel-input.css'


Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(VueAxios, axios);
Vue.use(VueTelInput)

import Dashboard from './components/Dashboard.vue';
import PeopleCreate from './components/PeopleCreate.vue';
import PeopleShow from './components/PeopleShow.vue';
import PeopleEdit from './components/PeopleEdit.vue';

const routes = [
  {
      name: 'home',
      path: '/',
      component: Dashboard
  },
  {
      name: 'create',
      path: '/people/create',
      component: PeopleCreate
  },
  {
      name: 'edit',
      path: '/people/edit/:id',
      component: PeopleEdit
  },
  {
    name: 'show',
    path: '/people/show/:id',
    component: PeopleShow
}
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
