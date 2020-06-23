import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'

import VueCookies from 'vue-cookies'
import FlightReviews from "./components/FlightReviews";
import CreateFlightReview from "./components/CreateFlightReview";
import FlightReview from "./components/FlightReview";
import UpdateFlightReview from "./components/UpdateFlightReview";
import LoginForm from "./components/LoginForm";

Vue.use(VueCookies)
Vue.use(VueRouter)

Vue.config.productionTip = false

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'HOME',
            component: FlightReviews
        },
        {
            path: '/create',
            name: 'CREATE',
            component: CreateFlightReview
        },
        {
            path: '/view/:id',
            name: 'READ',
            component: FlightReview,
        },
        {
            path: '/update/:id',
            name: 'UPDATE',
            component: UpdateFlightReview
        },
        {
            path: '/login',
            name: 'LOGIN',
            component: LoginForm
        }
    ]
})

export const API_URL = "http://localhost:8000/api/flightreviews";
export const API_LOGIN_URL = "http://localhost:8000/api/login";

new Vue({
  render: h => h(App),
    router
}).$mount('#app')
