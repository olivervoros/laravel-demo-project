<template>
    <div class="container">
        <h2>Welcome to the Flight Reviews Site</h2>
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
    export default {
        name: 'LoginForm',
        data: function () {
            return {
                email: "",
                password: ""
            }
        },
        methods: {
            login: function () {

                axios
                    .post('http://localhost:8000/api/login', { email: this.email, password: this.password})
                    .then(response => {
                        this.$cookies.set('accessToken', response.data.access_token);
                        this.$cookies.set('loggedInUser', JSON.stringify(response.data.user));
                        this.$emit('loginUser', 'test');
                    })
            }
        }

    }
</script>
