<template>
    <div class="container">
        <div class="my-3">
            <button type="button" class="btn btn-primary">Add new Review</button>
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
                <td>View More</td>
                <td>Edit</td>
                <td>Delete</td>
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
            axios
                .get('http://localhost:8000/api/flightreviews')
                .then(response => (this.reviews = response.data))
        },
        methods: {
            logout: function () {
                this.$cookies.set('accessToken', false);
                this.$emit('logoutUser')
            }
        }
    }
</script>
