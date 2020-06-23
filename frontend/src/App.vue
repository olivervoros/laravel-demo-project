<template>
    <div id="app">
        <router-view
            @loginUser="loginUser"
            @logoutUser="logoutUser"
        />
    </div>
</template>

<script>

    export default {
        name: 'App',
        components: {
        },
        data: function () {
            return {
                loggedIn: (this.$cookies.get('accessToken') !== "false"),
                review: [],
                message: ""
            }
        },
        methods: {
            loginUser(message) {
                console.log("LOGIN_USER!!");
                this.loggedIn = true
                if (message) {
                    this.message = message
                    setTimeout(() => this.message = "", 5000)
                }
                this.$router.push('/')
            },
            logoutUser() {
                console.log("LOGOUT_USER!!");
                this.loggedIn = false
                this.$router.push('/login')
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

    .fade-enter-active, .fade-leave-active {
        transition: opacity 2s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
