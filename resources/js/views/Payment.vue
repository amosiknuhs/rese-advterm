<template>
    <div>
        <stripe-checkout
            ref="checkoutRef"
            :pk="public_Key"
            :session-id="sessionId"
        />
        <button @click="submit">Checkout!</button>
    </div>
</template>

<script>
export default {
    props: {
        // user_code: String,
        public_Key: String,
        sessionId: String, // session id from backend
    },
    data() {
        // this.public_Key = process.env.STRIPE_PUBLISHABLE_KEY;
        return {
            loading: false,
        };
    },
    methods: {
        submit() {
            // You will be redirected to Stripe's secure checkout page
            this.$refs.checkoutRef.redirectToCheckout();
        },
    },
};
</script>
