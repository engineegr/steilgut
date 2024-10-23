<template>
	<div class="transit-flex-box tw-flex tw-h-auto">
		<div v-if="isError" class="tw-block stripe-error-container">
			<h2 class="stripe-error-text">
				{{ __("order.stripeErrorText") }}
			</h2>
		</div>
		<div
			class="stripe-card-container transit-flex-box tw-h-auto"
			v-else-if="stripeCardAttributes"
		>
			<p>
				<span
					:class="{
						'stripe-invalid-label': isValidationError || isNotComplete,
					}"
					class="stripe-icon badge badge-dark rounded"
					data-bs-toggle="collapse"
					:data-bs-target="`#${stripeCardAttributes['name']}-collapse`"
				>
					<img
						:src="stripeCardAttributes['iconPath']"
						class="img-thumbnail stripe-icon"
					/>
				</span>
			</p>
			<div
				class="collapse md:tw-w-1/2 md:tw-max-w-1/2 rounded"
				:id="`${stripeCardAttributes['name']}-collapse`"
			>
				<div id="cardElement"></div>

				<small class="form-text text-muted" id="cardErrors" role="alert"></small>

				<input type="hidden" name="payment_method" id="paymentMethod" />
			</div>
		</div>
	</div>
</template>

<script>
import { is422 } from "../../utils/response";
import mediaHelper from "../../mixins/mediaHelper";
import { refreshFullPageContainers } from "../../utils/resizer";

export default {
	mixins: [mediaHelper],

	props: {
		idp: {
			type: [String],
			default: "desktop-",
			required: true,
		},
		paymentSubmitButtonId: {
			type: [String],
			default: "payment-btn",
		},

		isHide: {
			type: [String, Boolean],
			default: false,
		},

		stripeCardAttributes: {
			type: [Object],
			default: {
				name: "nd",
				iconPath: "nd",
			},
		},
	},

	data: function () {
		return {
			username: "rockitin.dev",
			email: "rockitin.dev@gmail.com",
			stripe: null,
			cardElement: null,
			stripeKey: "",

			isLoading: false,
			isError: false,
			isValidationError: false,
			isNotComplete: true,

			// Validation errors (422 status)
			errors: [""],
		};
	},

	created() {
		("use strict");
		const collapsibleHtmlElement = document.getElementById(
			`#${this.stripeCardAttributes["name"]}-collapse`
		);
		if (collapsibleHtmlElement) {
			const self = this;
			collapsibleHtmlElement.addEventListener(
				"hidden.bs.collapse",
				refreshFullPageContainers
			);
		}
	},

	async mounted() {
		("use strict");
		console.log("Debug [StripeCardComp::mounted] Enter the function");
		this.$_load();
		// debugger;
		if (!this.isError) {
			const payButton = document.getElementById(this.paymentSubmitButtonId);

			const self = this;
			payButton.addEventListener("click", (event) => {
				event.preventDefault();
				if (self.isHide || self.isValidationError) {
					return;
				}
				let result = {};
				try {
					self.isError = false;
					self.isValidationError = false;
					self.stripe
						.createPaymentMethod("card", self.cardElement, {
							billing_details: {
								name: self.username,
								email: self.email,
							},
						})
						.then((response) => {
							console.log(
								"Debug [StripeCardComp::eventListener] Got response"
							);
							const { paymentMethod, error } = response;

							if (error) {
								const displayError = document.getElementById(
									"cardErrors"
								);
								displayError.textContent = error.message;
								this.isValidationError = true;
								self.$emit("on-payment-btn-failed-submit", event, error);
							} else {
								const data = {
									paymentMethod: paymentMethod.id,
								};
								self.$emit(
									"on-payment-btn-successful-submit",
									event,
									data
								);
							}
						});
				} catch (reject) {
					console.error(
						"Error [StripeCardComp::eventListener] failed to retrieve data about stripe card " +
							reject
					);
					self.$emit("stripe-details-load-failure", event, reject);
					self.isError = true;
				} finally {
					console.log("Debug [StripeCardComp::eventListener] finally");
				}
			});
		}
	},

	destroyed() {
		("use strict");
		const collapsibleHtmlElement = document.getElementById(
			`#${this.stripeCardAttributes["name"]}-collapse`
		);
		if (collapsibleHtmlElement) {
			const self = this;
			collapsibleHtmlElement.removeEventListener(
				"hidden.bs.collapse",
				refreshFullPageContainers
			);
		}
	},

	methods: {
		$_load: async function () {
			("use strict");
			this.isLoading = false;
			this.isError = false;
			console.log("Debug [StripeCardComp::$_load] Enter the function");
			try {
				const stripeDetails = (await axios.get("/api/payments/stripe")).data.data;

				this.stripeKey = stripeDetails["key"];
				this.username = stripeDetails.user["username"];
				this.userEmail = stripeDetails.user["user_email"];

				this.stripe = Stripe(this.stripeKey);
				const elements = this.stripe.elements({
					locale: this.$root.helper.getLocaleStr(),
				});
				this.cardElement = elements.create("card");
				this.cardElement.mount("#cardElement");

				console.info(
					`Info [StripeCardComp::created] Stripe Key [ ${this.stripeKey} ] User [ ${this.username} - ${this.userEmail}]`
				);
			} catch (reject) {
				this.isError = true;
				// 422 Unprocessable Entity (validation errors just for case)
				if (is422(reject)) {
					this.errors = reject.response.data.errors;
				}
			} finally {
				if (this.isError) {
					this.$emit("stripe-details-load-failure", this.errors);
				}
				const self = this;
				this.$emit("validation-check-event", null, false);
				this.cardElement.on("change", (event) => {
					if (event.complete) {
						console.log(
							"Info [StripeCardComp::mounted] Success fill out the card"
						);
						self.isNotComplete = false;
						self.isValidationError = false;
						this.$emit("validation-check-event", event, true);
					} else if (event.error) {
						console.warn(
							"Warn [StripeCardComp::mounted] Failure fill out the card"
						);
						self.isValidationError = true;
						self.isNotComplete = true;
						this.$emit("validation-check-event", event, false);
					}
				});
				this.isLoading = false;
			}
		},
	},
};
</script>

<style lang="scss" scoped>
/**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
.StripeElement {
	box-sizing: border-box;

	height: 40px;

	padding: 10px 12px;

	border: 1px solid transparent;
	border-radius: 4px;
	background-color: white;

	box-shadow: 0 1px 3px 0 #e6ebf1;
	-webkit-transition: box-shadow 150ms ease;
	transition: box-shadow 150ms ease;
}

.StripeElement--focus {
	box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
	border-color: #fa755a;
}

.StripeElement--webkit-autofill {
	background-color: #fefde5 !important;
}

label.stripe-invalid-label {
	border: 1px solid #fa755a;
}

.badge {
	padding-left: 0;
}
/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link 
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/
/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.stripe-card-container {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		width: auto;
		min-height: 60px;
		height: auto;
	}

	div.stripe-card-container span {
		width: 120px;
		height: 70px;
	}

	.stripe-card-container span img {
		height: 60px;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
}

/*
    * @link: https://websiteedu.com/media-queries-for-mobile-and-tablets/?__cf_chl_jschl_tk__=f4b85448ac9131968259f036667ebbe13f3aee4e-1620873849-0-AfVyBOo3EXzkNnPk3o7Y2fBiOHMOfi9Ez_ELD5YtZPhiuNEWff8cy4MUte33zch82L-l8ED6GNcOpaSmkrLTf-MBeOtEwaD0lOUn3JpenolXersHBNrzqH1P2EriQDQ0T3zRwahK5L0Dv1HaV6FtQjSWLbpUA3dzW6f9QfGllFDKoFKyFoeR7ma8DzneAa8_lg_P4uZKkDeDNYNeu4N5ZPGU8bYgv7OSYrlY17sKUZYScM5cG5IWZdKKED70KvynQtzyL22ETSPnUUSdew9gTFo3xTQhiOjCO-h79BHYAl9u9yUtrVPzZ1vXPuL3d8DXGM_Dw7rSMbTARgqzMPirmWcZZnYgYI_Ad_puGDQEky3Mg4ma4ltgGVG__BKE_JGL1Th8dKZhG3-48KTSJNAwh_vX0x3SCvVckdjUkcc4yQ0fkkTUeEy55KZ76yiqO35_PVGoQGj4yBIYAe84TKs8hdVDH7LqZuz_8MfLbzsyRExG0ri6AZhSfs999AwnI72B0g
    *
    * @link https://viewportsizer.com/devices/
    *
    * Samsung 
    * S8,8+,9,9+,10: W360px - H740px 4x
    * Galaxy S6, S7, S7 Edge: W360px - H640px 4x
    * Galaxy S4, S5, Note 3: W360px - H640px 3x
    * Galaxy Note 10, 10+: W360px - H718px 2x
    * Galaxy Note 8, 9: W360px - H740px 4x
    * Galaxy S20 Ultra, S20+, S20: W480 - H1067 3x-4x
    *
    * Iphone
    * iPhone 5, 5C, 5S, SE: W320px - H568px 2x
    * iPhone 6 Plus, 6S Plus, 7 Plus, 8 Plus: W414px - H736px 3x
    * iPhone 6, 6S, 7, 8: W375px - H667px 2x
    * iPhone XR, 11: W414px - H896px 2x
    * iPhone XS Max, 11 Pro Max: 414px - 896px 3x
    * iPhone X, XS, 11 Pro: 375px -  812px 3x
*/
@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.stripe-card-container {
		flex: 1 0 auto !important;
		height: fit-content;
		width: auto;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}
</style>
