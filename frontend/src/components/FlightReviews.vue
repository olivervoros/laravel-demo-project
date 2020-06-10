<template>
    <div class="container">
        <div class="my-3">
            <button v-on:click="displayCreateForm" type="button" class="btn btn-primary">Add new Review</button>
        </div>
        <div>
            <button v-on:click="logout" type="button" class="btn btn-info">Logout</button>
        </div>
        <h1 class="py-4">Flight Reviews</h1>
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

    export default {
        data() {
            return {
                reviews: null
            }
        },
        mounted() {
            let access_token = this.$cookies.get('accessToken');
            axios
                .get('http://localhost:8000/api/flightreviews', {headers: { Authorization: `Bearer ${access_token}` }})
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
                    .get('http://localhost:8000/api/flightreviews/'+id, {headers: { Authorization: `Bearer ${access_token}` }})
                    .then(response => {
                        console.log|(response);
                        this.$emit('update', response.data);
                })
            },

            viewMore: function (id) {
                let access_token = this.$cookies.get('accessToken');
                axios
                    .get('http://localhost:8000/api/flightreviews/'+id, {headers: { Authorization: `Bearer ${access_token}` }})
                    .then(response => {
                        this.$emit('viewMore', response.data);
                    })
            },

            deleteReview: function (id) {
                if(confirm('Hey! Are you sure you want to delete the flight review?')) {
                    let access_token = this.$cookies.get('accessToken');
                    axios
                        .delete('http://localhost:8000/api/flightreviews/' + id, {headers: {Authorization: `Bearer ${access_token}`}})
                        .then(response => {
                            console.log(response);
                        })
                    axios
                        .get('http://localhost:8000/api/flightreviews', {headers: {Authorization: `Bearer ${access_token}`}})
                        .then(response => (this.reviews = response.data))
                }

            },

            displayCreateForm: function () {
                this.$emit('displayCreateForm')
            },
        }
    }
</script>
