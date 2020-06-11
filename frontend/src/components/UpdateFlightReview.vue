<template>
    <div class="container">
        <button v-on:click="backHome" type="button" class="btn btn-info my-4">Back to the list</button>
        <h2>Update Flight Review</h2>
        <div v-if='errorStatus!==""' class="alert alert-danger" role="alert">
            {{ errorStatus }}...
        </div>
        <form v-on:submit.prevent="update">
            <div class="form-group">
                <input :value="review.id" required type="hidden" class="form-control" name="id">
            </div>
            <div class="form-group">
                <label for="airline">Airline</label>
                <input :value="review.airline" required type="text" class="form-control" name="airline" id="airline"
                       aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="flightNumber">Flight Number (Only numbers)</label>
                <input :value="review.flight_number" pattern="\d*" required type="text" class="form-control" name="flight_number"
                       id="flightNumber">
            </div>
            <div class="form-group">
                <label for="reviewPoints">Review Score (1-10)</label>
                <input :value="review.review_points" type="number" step="1" min="0"  max="10" required class="form-control" name="review_points"
                       id="reviewPoints">
            </div>
            <div class="form-group">
                <label for="reviewTitle">Review Title</label>
                <input :value="review.review_title" required type="text" class="form-control" name="review_title"
                       id="reviewTitle">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Flight Review</label>
                <textarea :value="review.review_body" name="review_body" class="form-control" id="exampleFormControlTextarea1"
                          rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>
    </div>
</template>
<script>
    import axios from "axios";

    export default {
        name: 'UpdateFlightReview',
        props: ['review'],
        data: function () {
            return {
                id: "",
                flight_number: "",
                airline: "",
                review_points: "",
                review_title: "",
                review_body: "",
                errorStatus: ""
            }
        },
        methods: {
            update: function (event) {
                let that = this;

                let reviewId = event.target.elements.id.value
                let airline = event.target.elements.airline.value
                let flight_number = event.target.elements.flight_number.value
                let review_points = event.target.elements.review_points.value
                let review_title = event.target.elements.review_title.value
                let review_body = event.target.elements.review_body.value

                let user = this.$cookies.get('loggedInUser');
                let data = {
                    passenger_id: user.id,
                    airline: airline,
                    flight_number: flight_number,
                    review_points: review_points,
                    review_title: review_title,
                    review_body: review_body
                }

                let access_token = this.$cookies.get('accessToken');
                axios
                    .put('http://localhost:8000/api/flightreviews'+"/"+ reviewId, data, {headers: {Authorization: `Bearer ${access_token}`}})
                    .then(response => {
                        console.log(response);
                        this.$emit('backHome');
                    }).catch(
                    function (error) {
                        if (!error.response) {
                            that.errorStatus = 'Network error, cannot connect to the API. Please try later';
                        } else {
                            that.errorStatus = error.response.data.message;
                        }
                    }
                )

            },
            backHome: function () {
                this.$emit('backHome');
            }
        }
    }
</script>
