import Vue from 'vue'
import App from './App.vue'
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'

import VueCookies from 'vue-cookies'
Vue.use(VueCookies)

Vue.config.productionTip = false

export const API_URL = "http://localhost:8000/api/flightreviews";
export const API_LOGIN_URL = "http://localhost:8000/api/login";

new Vue({
  render: h => h(App),
}).$mount('#app')
