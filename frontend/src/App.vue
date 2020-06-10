<template>
    <div id="app">
        <div v-if="loggedIn">
            <div v-if="page==='home'" >
                <flight-reviews @logoutUser="logoutUser"
                                @viewMore="viewMore"
                                @displayCreateForm="displayCreateForm">
                </flight-reviews>
            </div>
            <div v-if="page==='flightreview'" >
                <flight-review @backHome="backHome" v-bind:review="this.review"></flight-review>
            </div>
            <div v-if="page==='create'" >
                <create-flight-review @backHome="backHome"></create-flight-review>
            </div>
        </div>
        <div v-else>
            <login-form @loginUser="loginUser"></login-form>
        </div>
    </div>
</template>

<script>
    import FlightReviews from './components/FlightReviews';
    import FlightReview from './components/FlightReview';
    import LoginForm from './components/LoginForm';
    import CreateFlightReview from './components/CreateFlightReview';

    export default {
        name: 'App',
        components: {
            FlightReviews,
            LoginForm,
            FlightReview,
            CreateFlightReview
        },
        data: function () {
            return {
                loggedIn: (this.$cookies.get('accessToken')!=="false"),
                page: "home",
                review: []
            }
        },
        methods: {
            loginUser() {
                this.loggedIn = true
            },
            logoutUser() {
                this.loggedIn = false
            },
            viewMore(review) {
                this.review = review;
                this.page = "flightreview"
            },
            backHome() {
                this.page = "home"
            },
            displayCreateForm() {
                this.page = "create"
            }
        }
    }
</script>

<style>
    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }
</style>
