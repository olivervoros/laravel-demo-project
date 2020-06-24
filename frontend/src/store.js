import Vue from 'vue';
import Vuex from 'vuex';
import axios from "axios";
import {API_LOGIN_URL, API_URL} from "./main";
import cookie from 'vue-cookies'
import { router } from "./main.js"

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        reviews : [],
        review : [],
        errorStatus: '',
        message: '',
        loggedIn: (cookie.get('accessToken') !== "false")
    },

    mutations: {
        setReviews(state, reviews) {
            state.reviews = reviews;
        },
        setReview(state, review) {
            state.review = review;
        },
        setErrorStatus(state, error) {
            state.errorStatus = error;
        },
        setMessage(state, message) {
            state.message = message;
        },
        clearMessage(state, sec = 5000) {
            setTimeout(() => state.message = "", sec)
        },
        login(state) {
            state.loggedIn = true;
        },
        logout(state) {
            state.loggedIn = false;
        }

    },
    actions: {
        getReviews(context) {
            let access_token = cookie.get('accessToken');
            axios
                .get(API_URL, {headers: { Authorization: `Bearer ${access_token}` }})
                .then(response => (context.commit('setReviews', response.data)))
        },
        createReview(context, review) {

            let access_token = cookie.get('accessToken');
            let user = cookie.get('loggedInUser');

            let data = {
                passenger_id: user.id,
                airline: review.airline,
                flight_number: review.flight_number,
                review_points: review.review_points,
                review_title: review.review_title,
                review_body: review.review_body
            }
            axios
                .post(API_URL, data, {headers: {Authorization: `Bearer ${access_token}`}})
                .then(response => {
                    console.log(response);
                    context.commit('setMessage', "You have successfully created the review...")
                    context.commit('clearMessage')
                }).catch(
                function (error) {
                    if (!error.response) {
                        context.commit('setErrorStatus', "Network error, cannot connect to the API. Please try later...")
                    } else {
                        context.commit('setErrorStatus', error.response.data.message)
                    }
                }
            )
            router.push('/')
        },
        updateReview(context, review) {

            let user = cookie.get('loggedInUser');
            let data = {
                passenger_id: user.id,
                airline: review.airline,
                flight_number: review.flight_number,
                review_points: review.review_points,
                review_title: review.review_title,
                review_body: review.review_body
            }

            let access_token = cookie.get('accessToken');
            axios
                .put(API_URL +"/"+ review.id, data, {headers: {Authorization: `Bearer ${access_token}`}})
                .then(response => {
                    console.log(response);
                    context.commit('login')
                    context.commit('setMessage', "You have successfully updated the review...")
                }).catch(
                function (error) {
                    if (!error.response) {
                        context.commit('setErrorStatus', "Network error, cannot connect to the API. Please try later...")
                    } else {
                        context.commit('setErrorStatus', error.response.data.message)
                    }
                }
            )
            router.push('/')
        },
        deleteReview(context, id) {

            if(confirm('Hey! Are you sure you want to delete the flight review?')) {
                let access_token = cookie.get('accessToken');
                axios
                    .delete(API_URL + "/" +id, {headers: {Authorization: `Bearer ${access_token}`}})
                    .then(response => {
                        console.log(response);

                    }).catch(
                    function (error) {
                        if (!error.response) {
                            context.commit('setErrorStatus', "Network error, cannot connect to the API. Please try later...")
                        } else {
                            context.commit('setErrorStatus', error.response.data.message)
                        }
                    }
                )
                axios
                    .get(API_URL, {headers: {Authorization: `Bearer ${access_token}`}})
                    .then(response => {
                        context.commit('setReviews', response.data)
                        context.commit('setMessage', "You have successfully deleted the review...")
                    }).catch(
                    function (error) {
                        if (!error.response) {
                            context.commit('setErrorStatus', "Network error, cannot connect to the API. Please try later...")
                        } else {
                            context.commit('setErrorStatus', error.response.data.message)
                        }
                    }
                )
            }
        },
        login(context, userData) {
            axios
                .post(API_LOGIN_URL, { email: userData.email, password: userData.password})
                .then(response => {
                    cookie.set('accessToken', response.data.access_token);
                    cookie.set('loggedInUser', JSON.stringify(response.data.user));
                    context.commit('setMessage', "You have logged in successfully...")
                }).catch(
                function (error) {
                    if (!error.response) {
                        context.commit('setErrorStatus', "Network error, cannot connect to the API. Please try later...")
                    } else {
                        context.commit('setErrorStatus', error.response.data.message)
                    }
                }
            )
            router.push('/')
        },
        viewReview(context, reviewId) {
            let access_token = cookie.get('accessToken');
            axios
                .get(API_URL + "/" + reviewId, {headers: {Authorization: `Bearer ${access_token}`}})
                .then(response => (context.commit('setReview', response.data)))
        },
        logout(context) {
            context.commit('logout');
            cookie.set('accessToken', false);
            router.push('/login')
        }
    }
})
