import Vue from 'vue'
import VueCookie from 'vue-cookie'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
// import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.min.css';


import App from './App.vue'
import UploadFile from './views/Auth/UploadFile.vue'
import router from './router'

Vue.use(VueCookie);

Vue.use(
  Vuetify, {
    theme: {
      secondary: '#0e71a3',
      primary: '#52c2b8',
      accent: '#e95e29'
    }
  }
)
// Vue.component('vue-ctk-date-time-picker', VueCtkDateTimePicker);
Vue.component('uploadfile', require('./views/Auth/UploadFile.vue'));

Vue.component('modal', {
  template: '#modal-template'
})

const app = new Vue({
    el: '#root',
    template: `<app></app>`,
    components: { App },
    router
});
