<template>
    <div id="app">
        <transition name="fade">
            <div v-if='message!==""' class="alert alert-primary" role="alert">
                {{ message }}
            </div>
        </transition>
        <router-view
            @loginUser="loginUser"
            @logoutUser="logoutUser"
            @showMessage="showMessage"
            :loggedIn="loggedIn"
        />
    </div>
</template>

<script>

    export default {
        name: 'App',
        data: function () {
            return {
                loggedIn: (this.$cookies.get('accessToken') !== "false"),
                review: [],
                message: ""
            }
        },
        methods: {
            loginUser(message) {
                this.loggedIn = true
                if (message) {
                    this.message = message
                    setTimeout(() => this.message = "", 5000)
                }
                this.$router.push('/')
            },
            logoutUser() {
                this.loggedIn = false
                this.$router.push('/login')
            },
            showMessage(message) {
                if (message) {
                    this.message = message
                    setTimeout(() => this.message = "", 5000)
                }
                if (this.$route.path !== "/") {
                    this.$router.push('/')
                }
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
