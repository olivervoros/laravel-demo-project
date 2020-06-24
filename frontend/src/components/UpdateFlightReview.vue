<template>
    <div class="container">
        <div id="updateFlightReview">
        <h2>Update Flight Review</h2>
        <div v-if='errorStatus!==""' class="alert alert-danger" role="alert">
            {{ errorStatus }}...
        </div>
        <form v-on:submit.prevent="update">
            <div class="form-group">
                <input :value="this.$store.state.review.id" required type="hidden" class="form-control" name="id">
            </div>
            <div class="form-group">
                <label for="airline">Airline</label>
                <input v-model="this.$store.state.review.airline" required type="text" class="form-control" name="airline" id="airline"
                       aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="flightNumber">Flight Number (Only numbers)</label>
                <input v-model="this.$store.state.review.flight_number" pattern="\d*" required type="text" class="form-control" name="flight_number"
                       id="flightNumber">
            </div>
            <div class="form-group">
                <label for="reviewPoints">Review Score (1-10)</label>
                <input v-model="this.$store.state.review.review_points" type="number" step="1" min="0"  max="10" required class="form-control" name="review_points"
                       id="reviewPoints">
            </div>
            <div class="form-group">
                <label for="reviewTitle">Review Title</label>
                <input v-model="this.$store.state.review.review_title" required type="text" class="form-control" name="review_title"
                       id="reviewTitle">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Flight Review</label>
                <textarea :v-model="this.$store.state.review.review_body" :value="this.$store.state.review.review_body" name="review_body" class="form-control" id="exampleFormControlTextarea1"
                          rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Review</button>
            <router-link to='/' type="button" class="btn btn-info m-4">Back to the List</router-link>
        </form>
        </div>
    </div>
</template>
<script>

    export default {
        name: 'UpdateFlightReview',
        data() {
            return {
                review: {},
                errorStatus: ""
            }
        },
        mounted() {
            let reviewId = this.$route.params.id;
            this.$store.dispatch('viewReview', reviewId);
        },
        methods: {

            update: function () {

                this.$store.dispatch('updateReview', this.review);
            }
        }
    }
</script>
<style>

    div#updateFlightReview h2 {
        margin: 50px 0;
    }

    div#updateFlightReview textarea {
        min-height:50px;
        height:auto;
    }

    div#updateFlightReview {
        width: 500px;
        margin: 20px auto;
    }

    div#updateFlightReview label {
        float: left;
        font-weight: bolder;

    }

</style>
