<template>
    <div class="container">
        <h2>Create Form comes here</h2>
        <form v-on:submit.prevent="create">
            <div class="form-group">
                <label for="airline">Airline</label>
                <input v-model="airline" required type="text" class="form-control" name="airline" id="airline"
                       aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="flightNumber">Flight Number (Only numbers)</label>
                <input pattern="\d*" required v-model="flight_number" type="text" class="form-control" name="flight_number"
                       id="flightNumber">
            </div>
            <div class="form-group">
                <label for="reviewPoints">Review Score (1-10)</label>
                <input type="number" step="1" min="0"  max="10" v-model="review_points" required class="form-control" name="review_points"
                       id="reviewPoints">
            </div>
            <div class="form-group">
                <label for="reviewTitle">Review Title</label>
                <input v-model="review_title" required type="text" class="form-control" name="review_title"
                       id="reviewTitle">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Flight Review</label>
                <textarea v-model="review_body" name="review_body" class="form-control" id="exampleFormControlTextarea1"
                          rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Review</button>
        </form>
    </div>
</template>
<script>
    import axios from "axios";

    export default {
        name: 'CreateFlightReview',
        data: function () {
            return {
                flight_number: "",
                airline: "",
                review_points: "",
                review_title: "",
                review_body: ""
            }
        },
        methods: {

            create: function () {
                let user = this.$cookies.get('loggedInUser');
                let data = {
                    passenger_id: user.id,
                    airline: this.airline,
                    flight_number: this.flight_number,
                    review_points: this.review_points,
                    review_title: this.review_title,
                    review_body: this.review_body
                }

                let access_token = this.$cookies.get('accessToken');
                axios
                    .post('http://localhost:8000/api/flightreviews', data, {headers: {Authorization: `Bearer ${access_token}`}})
                    .then(response => {
                        console.log(response);
                        this.$emit('backHome');
                    })

            },

        }
    }
</script>
