<template>
    <div id="app">
        <div v-if="loggedIn">
            <div v-if="page==='HOME'" >
                <flight-reviews @logoutUser="logoutUser"
                                @viewMore="viewMore"
                                @backHome="backHome"
                                @displayCreateForm="displayCreateForm"
                                @update="update">
                </flight-reviews>
            </div>
            <div v-else-if="page==='READ'" >
                <flight-review @backHome="backHome" v-bind:review="this.review"></flight-review>
            </div>
            <div v-else-if="page==='CREATE'" >
                <create-flight-review @backHome="backHome"></create-flight-review>
            </div>
            <div v-else-if="page==='UPDATE'" >
                <update-flight-review v-bind:review="this.review"
                                      @backHome="backHome"
                                      @logoutUser="logoutUser"
                                      @update="update"
                ></update-flight-review>
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
    import UpdateFlightReview from './components/UpdateFlightReview';

    export default {
        name: 'App',
        components: {
            FlightReviews,
            LoginForm,
            FlightReview,
            CreateFlightReview,
            UpdateFlightReview
        },
        data: function () {
            return {
                loggedIn: (this.$cookies.get('accessToken')!=="false"),
                page: "HOME",
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
                this.page = "READ"
            },
            backHome() {
                this.page = "HOME"
            },
            displayCreateForm() {
                this.page = "CREATE"
            },
            update(review) {
                this.review = review;
                this.page = "UPDATE"
            },
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
