<template>
    <div class="container">
        <h3>Detailed Flight Review</h3>
        <p>Airline: {{ review.airline}}</p>
        <p>Flight Number: {{ review.flight_number}}</p>
        <p>Review Point (1-10) : {{ review.review_point}}</p>
        <p>Review Title: {{ review.review_title}}</p>
        <p>Review: {{ review.review_body}}</p>
        <button v-on:click="backHome" type="button" class="btn btn-info">Back to the list</button>
    </div>
</template>

<script>

    export default {
        props: ['review'],
        methods: {
            backHome: function () {
                this.$emit('backHome');
            }
        }
    }
</script>
