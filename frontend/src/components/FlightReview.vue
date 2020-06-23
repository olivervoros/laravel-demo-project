<template>
    <div class="container">
        <div id="readFlightReview">
            <h2>Read Flight Review</h2>
            <form>
                <div class="form-group">
                    <label for="airline">Airline</label>
                    <input :value="review.airline" disabled required type="text" class="form-control" id="airline"
                           aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="flightNumber">Flight Number (Only numbers)</label>
                    <input :value="review.flight_number" disabled type="text" class="form-control" id="flightNumber">
                </div>
                <div class="form-group">
                    <label for="reviewPoints">Review Score (1-10)</label>
                    <input :value="review.review_points" disabled class="form-control" id="reviewPoints">
                </div>
                <div class="form-group">
                    <label for="reviewTitle">Review Title</label>
                    <input :value="review.review_title" disabled type="text" class="form-control" id="reviewTitle">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Flight Review</label>
                    <textarea :value="review.review_body" disabled class="form-control"
                              id="exampleFormControlTextarea1"></textarea>
                </div>
                <router-link to='/' type="button" class="btn btn-info m-4">Back to the List</router-link>
            </form>
        </div>
    </div>
</template>

<script>

    import axios from "axios";
    import {API_URL} from "../main";

    export default {
        data() {
            return {
                review: {}
            }
        },
        mounted() {
            if(this.$cookies.get('accessToken') === "false") {
                this.$router.push('/login')
            }

            let access_token = this.$cookies.get('accessToken');
            axios
                .get(API_URL + "/" + this.$route.params.id, {headers: {Authorization: `Bearer ${access_token}`}})
                .then(response => (this.review = response.data))
        }
    }
</script>

<style>
    div#readFlightReview h2 {
        margin: 50px 0;
    }

    div#readFlightReview textarea {
        min-height: 250px;
        height: auto;
    }

    div#readFlightReview {
        width: 500px;
        margin: 20px auto;
    }

    div#readFlightReview label {
        float: left;
        font-weight: bolder;

    }

</style>
