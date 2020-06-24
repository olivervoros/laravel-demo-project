<template>
    <div id="app">
        <transition name="fade">
            <div v-if='this.$store.state.message!==""' class="alert alert-primary" role="alert">
                {{ this.$store.state.message }}
            </div>
        </transition>
        <router-view></router-view>
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
