<template>
    <div class="container">
        <div id="createFlightReview">
        <h2>Create Flight Review</h2>
        <div v-if='this.$store.state.errorStatus!==""' class="alert alert-danger" role="alert">
            {{ this.$store.state.errorStatus }}
        </div>
        <form v-on:submit.prevent="create">
            <div class="form-group">
                <label for="airline">Airline</label>
                <input v-model="review.airline" required type="text" class="form-control" name="airline" id="airline"
                       aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="flightNumber">Flight Number (Only numbers)</label>
                <input pattern="\d*" required v-model="review.flight_number" type="text" class="form-control"
                       name="flight_number"
                       id="flightNumber">
            </div>
            <div class="form-group">
                <label for="reviewPoints">Review Score (1-10)</label>
                <input type="number" step="1" min="0" max="10" v-model="review.review_points" required class="form-control"
                       name="review_points"
                       id="reviewPoints">
            </div>
            <div class="form-group">
                <label for="reviewTitle">Review Title</label>
                <input v-model="review.review_title" required type="text" class="form-control" name="review_title"
                       id="reviewTitle">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Flight Review</label>
                <textarea v-model="review.review_body" name="review_body" class="form-control" id="exampleFormControlTextarea1"
                          rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Review</button>
            <router-link to='/' type="button" class="btn btn-info m-4">Back to the List</router-link>
        </form>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'CreateFlightReview',
        data: function () {
            return {
                review: {},
                errorStatus: ""
            }
        },
        methods: {

            create: function () {

                this.$store.dispatch('createReview', this.review);
            }
        }
    }
</script>
<style>

    div#createFlightReview h2 {
        margin: 50px 0;
    }

    div#createFlightReview textarea {
        min-height:50px;
        height:auto;
    }

    div#createFlightReview {
        width: 500px;
        margin: 20px auto;
    }

    div#createFlightReview label {
        float: left;
        font-weight: bolder;

    }

</style>
