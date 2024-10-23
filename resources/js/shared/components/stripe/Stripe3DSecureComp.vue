<template>
	<div class="stripe-3d-secure-canvas">
		<h1 class="stripe-3d-secure-header-text centered-msg">
			{{ __("order.stripe3dSecureHeader") }}
		</h1>
	</div>
</template>

<script>
import { is404, is422, is500 } from "../../utils/response";
import validationErrors from "../../mixins/validationErrors";

export default {
	mixins: [validationErrors],
	props: {
		serviceKey: {
			type: [String],
			default: "Not defined",
		},
		clientSecret: {
			type: [String],
			default: "Not defined",
		},
	},

	created() {
		("use strict");
		console.log("Info [Stripe3DSecureComp::create] Enter the function");
	},

	mounted() {
		("use strict");
		const stripe = Stripe(this.serviceKey);
		const self = this;
		try {
			stripe
				.handleCardAction(this.clientSecret)
				.then(function (response) {
					// debugger;
					if (response.error) {
						console.warn(
							"Warn [Stripe3DSecureComp::mounted] Failed 3d Secure Authentication"
						);
						self.$emit("on-cancellation", response);
					} else {
						console.log(
							"Info [Stripe3DSecureComp::mounted] Successful 3d Secure Authentication"
						);
						self.$emit("on-confirmation", response);
					}
				})
				.catch((reject) => {
					if (is404(reject) || is422(reject) || is500(reject)) {
						console.error(
							"Error [Stripe3DSecureComp::mounted] Status (404|422|500): " +
							reject.response.data.errors
						);
					} else {
						console.error(
							"Error [Stripe3DSecureComp::mounted] Unexpected error status: " +
							reject
						);
					}
					self.$emit("on-error-response", reject);
				});
		} catch (reject) {
			console.error(
				"Error [Stripe3DSecureComp::mounted] Unexpected error status: " + reject
			);
			self.$emit("on-error-response", reject);
		}
	},
};
</script>

<style lang="scss" scoped>
.stripe-3d-secure-canvas {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	justify-content: center;
	flex-wrap: nowrap;
	align-items: stretch;

	max-width: 100%;
	width: 100%;
	margin: 0;
	padding: 0;
}

.stripe-3d-secure-header-text {
	font-family: 'steilgut_cormorant', sans-serif;
	font-size: 1.5em;
	text-transform: unset;
}
</style>
