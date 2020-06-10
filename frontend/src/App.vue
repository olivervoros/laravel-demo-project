<template>
    <div id="app">
        <div v-if="loggedIn">
            <flight-reviews @logoutUser="logoutUser"></flight-reviews>
        </div>
        <div v-else>
            <login-form @loginUser="loginUser"></login-form>
        </div>
    </div>
</template>

<script>
    import FlightReviews from './components/FlightReviews';
    import LoginForm from './components/LoginForm';
    export default {
        name: 'App',
        components: {
            FlightReviews,
            LoginForm
        },
        data: function () {
            return {
                loggedIn: (this.$cookies.get('accessToken')!=="false")
            }
        },
        methods: {
            loginUser() {
                this.loggedIn = true
            },
            logoutUser() {
                this.loggedIn = false
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
