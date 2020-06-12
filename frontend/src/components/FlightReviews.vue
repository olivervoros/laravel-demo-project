<template>
    <div class="container">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage Flight Reviews</h2>
                </div>
                <div class="col-sm-6">
                    <button v-on:click="logout" type="button" class="btn btn-warning">Logout</button>
                    <button v-on:click="displayCreateForm" type="button" class="btn btn-success">Add new Review +</button>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Airline</th>
                <th scope="col">Flight Number</th>
                <th scope="col">Score</th>
                <th scope="col">View Review Article</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="review of reviews" :key="review.id">
                <td>{{review.id}}</td>
                <td>{{review.airline}}</td>
                <td>{{review.flight_number}}</td>
                <td>{{review.review_points}}</td>
                <td><a @click="viewMore(review.id)" href="#">View More</a></td>
                <td><a @click="update(review.id)" href="#">Edit</a></td>
                <td><a @click="deleteReview(review.id)" href="#">Delete</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import axios from 'axios';
    import { API_URL } from '../main';

    export default {
        data() {
            return {
                reviews: null
            }
        },
        mounted() {
            let access_token = this.$cookies.get('accessToken');
            axios
                .get(API_URL, {headers: { Authorization: `Bearer ${access_token}` }})
                .then(response => (this.reviews = response.data))
        },
        methods: {

            logout: function () {
                this.$cookies.set('accessToken', false);
                this.$emit('logoutUser')
            },

            update: function (id) {
                let access_token = this.$cookies.get('accessToken');
                axios
                    .get(API_URL + "/" +id, {headers: { Authorization: `Bearer ${access_token}` }})
                    .then(response => {
                        this.$emit('update', response.data);
                })
            },

            viewMore: function (id) {
                let access_token = this.$cookies.get('accessToken');
                axios
                    .get(API_URL + "/" +id, {headers: { Authorization: `Bearer ${access_token}` }})
                    .then(response => {
                        this.$emit('viewMore', response.data);
                    })
            },

            deleteReview: function (id) {
                let that = this;
                if(confirm('Hey! Are you sure you want to delete the flight review?')) {
                    let access_token = this.$cookies.get('accessToken');
                    axios
                        .delete(API_URL + "/" +id, {headers: {Authorization: `Bearer ${access_token}`}})
                        .then(response => {
                            console.log(response);
                        }).catch(
                        function (error) {
                            if (!error.response) {
                                that.errorStatus = 'Network error, cannot connect to the API. Please try later';
                            } else {
                                that.errorStatus = error.response.data.message;
                            }
                        }
                    )
                    axios
                        .get(API_URL, {headers: {Authorization: `Bearer ${access_token}`}})
                        .then(response => {
                            this.reviews = response.data;
                            this.$emit('backHome', "You have successfully deleted the flight review.");
                        }).catch(
                        function (error) {
                            if (!error.response) {
                                that.errorStatus = 'Network error, cannot connect to the API. Please try later';
                            } else {
                                that.errorStatus = error.response.data.message;
                            }
                        }
                    )
                }

            },

            displayCreateForm: function () {
                this.$emit('displayCreateForm')
            },
        }
    }
</script>
<style>
    .table-title {
        background: darkslategray;
        color: #fff;
        padding: 16px 30px;
        border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
        margin: 5px;
        font-size: 24px;
        text-align: left
    }
    .table-title .btn {
        color: #fff;
        float: right;
        font-size: 17px;
        border: none;
        min-width: 150px;
        border-radius: 7px;
        outline: none !important;
        margin-left: 20px;
        font-weight: bolder;
    }
</style>
