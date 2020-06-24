<template>
    <div class="container">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage Flight Reviews</h2>
                </div>
                <div class="col-sm-6">
                    <button v-on:click="logout" type="button" class="btn btn-warning">Logout</button>
                    <router-link to="/create" type="button" class="btn btn-success">Add new Review +</router-link>
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
            <tr v-for="review of $store.state.reviews" :key="review.id">
                <td>{{review.id}}</td>
                <td>{{review.airline}}</td>
                <td>{{review.flight_number}}</td>
                <td>{{review.review_points}}</td>
                <td>
                    <router-link :to="`/view/${review.id}`">View More</router-link>
                </td>
                <td>
                    <router-link :to="`/update/${review.id}`">Edit</router-link>
                </td>
                <td><a @click="deleteReview(review.id)" href="#">Delete</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>

    export default {
        mounted() {

            if (this.$store.state.loggedIn === false) {
                this.$router.push('/login')
            }

            this.$store.dispatch('getReviews');
        },
        methods: {

            logout: function () {

                this.$store.dispatch('logout');
            },

            deleteReview: function (id) {

                this.$store.dispatch('deleteReview', id);

            }
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
