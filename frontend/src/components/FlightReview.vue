<template>
    <div class="container">
        <div id="readFlightReview">
            <h2>Read Flight Review</h2>
            <form>
                <div class="form-group">
                    <label for="airline">Airline</label>
                    <input :value="this.$store.state.review.airline" disabled required type="text" class="form-control" id="airline"
                           aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="flightNumber">Flight Number (Only numbers)</label>
                    <input :value="this.$store.state.review.flight_number" disabled type="text" class="form-control" id="flightNumber">
                </div>
                <div class="form-group">
                    <label for="reviewPoints">Review Score (1-10)</label>
                    <input :value="this.$store.state.review.review_points" disabled class="form-control" id="reviewPoints">
                </div>
                <div class="form-group">
                    <label for="reviewTitle">Review Title</label>
                    <input :value="this.$store.state.review.review_title" disabled type="text" class="form-control" id="reviewTitle">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Flight Review</label>
                    <textarea :value="this.$store.state.review.review_body" disabled class="form-control"
                              id="exampleFormControlTextarea1"></textarea>
                </div>
                <router-link to='/' type="button" class="btn btn-info m-4">Back to the List</router-link>
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                review: this.$store.state.review
            }
        },
        mounted() {
            if(this.$store.state.loggedIn === false) {
                this.$router.push('/login')
            }

            let reviewId = this.$route.params.id;
            this.$store.dispatch('viewReview', reviewId);

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
