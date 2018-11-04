import Vue from 'vue'
import VueCookie from 'vue-cookie'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime'
import App from './App.vue'
import router from './router'

Vue.use(VueCookie);

Vue.use(
  Vuetify, {
    theme: {
      secondary: '#0e71a3',
      primary: '#52c2b8',
      accent: '#e95e29'
    }
  },
);
Vue.use(Datetime);
Vue.component('uploadfile', require('./views/Auth/UploadFile.vue'));
Vue.component('datetime', Datetime);
Vue.component('modal', {
  template: '#modal-template'
})

const app = new Vue({
    el: '#root',
    template: `<app></app>`,
    components: { App },
    router
});
