<template>
    <div class="container">
        <h2>Welcome to the Flight Reviews Site</h2>
        <transition name="fade">
        <div v-if='errorStatus!==""' class="alert alert-danger" role="alert">
            {{ errorStatus }}...
        </div>
        </transition>
    <form v-on:submit.prevent="login">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input required v-model="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input required v-model="password" type="password"  class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</template>
<script>
    import axios from 'axios';
    import { API_LOGIN_URL } from "../main";

    export default {
        name: 'LoginForm',
        data: function () {
            return {
                email: "",
                password: "",
                errorStatus: ""
            }
        },
        methods: {
            login: function () {
                let that = this;
                axios
                    .post(API_LOGIN_URL, { email: this.email, password: this.password})
                    .then(response => {
                        this.$cookies.set('accessToken', response.data.access_token);
                        this.$cookies.set('loggedInUser', JSON.stringify(response.data.user));
                        this.$emit('loginUser',"Welcome! You have logged in successfully...");
                    }).catch(
                    function (error) {
                        if (!error.response) {
                            that.errorStatus = 'Network error, cannot connect to the API. Please try later';
                            setTimeout(() => that.errorStatus = "", 5000)
                        } else {
                            that.errorStatus = error.response.data.message;
                            setTimeout(() => that.errorStatus = "", 5000)
                        }
                    }
                )
            }
        }

    }
</script>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
