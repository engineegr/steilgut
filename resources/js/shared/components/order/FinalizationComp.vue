<template>
	<div class="order-finallization-canvas">
		<lazy-load-image-comp
			basedLazyImgStyleClass="order-finallization-pg-img"
			relativePath="order-finallization-pg"
			baseName="bg-order-finallization-pg"
			lqipPath_4_3="/images/4_3/order-finallization-pg/lqip_4_3/4_3-lqip-order-finallization-pg.jpg"
			lqipPath_16_9="/images/16_9/order-finallization-pg/lqip_16_9/16_9-lqip-order-finallization-pg.jpg"
			lqipPath_portrait="/images/mobile/order-finallization-pg/lqip/portrait-lqip-order-finallization-pg.jpg"
			lazyLoadCommonImgStyleClass="tw-absolute tw-inset-0 tw-object-cover tw-max-h-full tw-h-full tw-max-w-full tw-w-full"
		></lazy-load-image-comp>

		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div v-else-if="isLoading">
			<pulse-logo-comp isDefer="true"></pulse-logo-comp>
		</div>
		<div class="tw-flex transit-flex-box" v-else>
			<div v-if="isStripe3DSecureConfirmationRequiredGo">
				<stripe-3dsecure-comp
					:serviceKey="stripeData.serviceKey"
					:clientSecret="stripeData.clientSecret"
					v-on:on-confirmation="handleStripe3DSecureConfirmation"
					v-on:on-cancellation="handleStripe3DSecureCancellation"
					v-on:on-error-response="handleStripe3DSecureErrorResponse"
				></stripe-3dsecure-comp>
			</div>
			<div class="tw-flex transit-flex-box" v-else>
				<div
					class="tw-hidden landscape:tw-hidden md:tw-flex transit-flex-box"
					v-if="!isMobileDevice()"
				>
					<div v-if="isBankAccountTransfer">
						<h1
							class="order-finallization-header-text centered-msg err-msg"
							v-if="isInvalid"
						>
							{{ __("order.orderCreationErrorMsg") }}
						</h1>
						<div
							class="order-finallization-header-text centered-msg succcess-msg"
							v-else
						>
							<span v-html="getSuccessfulOrderCreationLocaleMsg()"></span>
						</div>
					</div>
					<div v-else>
						<h1
							class="order-finallization-header-text centered-msg err-msg"
							v-if="isInvalid"
						>
							{{ __("order.orderCreationErrorMsg") }}
						</h1>
						<div
							class="order-finallization-header-text centered-msg err-msg"
							v-else-if="
								isCancellation ||
								isStripe3DSecureCancell ||
								isStripe3DSecureErrorResponse
							"
						>
							<span v-html="getCancelledPaymentLocaleMsg()"></span>
						</div>

						<div
							class="order-finallization-header-text centered-msg succcess-msg"
							v-else-if="isConfirmation || isStripe3DSecureConfirmed"
						>
							<span v-html="getApprovedPaymentLocaleMsg()"></span
							><span>&#160;</span
							><span v-html="getSuccessfulOrderCreationLocaleMsg()"></span>
						</div>
					</div>
				</div>
				<div class="tw-flex md:tw-hidden transit-flex-box">
					<div
						v-if="isBankAccountTransfer"
						class="order-finalization-text-container"
					>
						<h1
							class="order-finallization-header-text centered-msg err-msg"
							v-if="isInvalid"
						>
							{{ __("order.orderCreationErrorMsg") }}
						</h1>
						<div
							class="order-finallization-header-text centered-msg succcess-msg"
							v-else
						>
							<div v-html="getSuccessfulOrderCreationLocaleMsg()"></div>
						</div>
					</div>
					<div v-else class="order-finalization-text-container">
						<h1
							class="order-finallization-header-text centered-msg err-msg"
							v-if="isInvalid"
						>
							{{ __("order.orderCreationErrorMsg") }}
						</h1>
						<div
							class="order-finallization-header-text centered-msg err-msg"
							v-else-if="
								isCancellation ||
								isStripe3DSecureCancell ||
								isStripe3DSecureErrorResponse
							"
						>
							<div v-html="getCancelledPaymentLocaleMsg()"></div>
						</div>

						<div
							class="order-finallization-header-text centered-msg succcess-msg"
							v-else-if="isConfirmation || isStripe3DSecureConfirmed"
						>
							<div v-html="getApprovedPaymentLocaleMsg()"></div>
							<div v-html="getSuccessfulOrderCreationLocaleMsg()"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
const stripe3DSecureComp = () =>
	import(/* webpackPrefetch: true */ "../../components/stripe/Stripe3DSecureComp");

const pulseLogoComp = () =>
	import(/* webpackPrefetch: true */ "../../components/PulseLogoComp");

import mediaHelper from "../../mixins/mediaHelper";
import fullscreenCorrector from "../../mixins/fullscreenCorrector";
import validationErrors from "../../mixins/validationErrors";
import { is422, is404, is500 } from "../../utils/response";

/*
 * Interface
 *
 * Properties
 *
 * OrderDetails: Object, required: orderId, orderNumber, personalData, deliveryOptions
 * stripeData: Object, not-required, only for Stripe 3D Secure confirmation
 * isStripe3DSecureConfirmationRequired: Boolean, required
 * isBankAccountTransfer: Boolean required
 * isConfirmation: Boolean, required, confirm w/o additional user bank confirmation (Stripe 3D Secure and etc)
 * isCancellation: Boolean, required
 * isInvalid: Boolean, required (order creation failure or error response to a credit card system and etc)
 */
export default {
	mixins: [mediaHelper, validationErrors, fullscreenCorrector],
	components: {
		"stripe-3dsecure-comp": stripe3DSecureComp,
		"pulse-logo-comp": pulseLogoComp,
	},

	props: {
		orderDetails: {
			type: [Object],
			default: function () {
				return {
					state: "Not defined",
				};
			},
		},

		stripeData: {
			type: [Object],
			default: function () {
				return {
					state: "Not defined",
				};
			},
		},

		isStripe3DSecureConfirmationRequired: {
			type: [Boolean, String],
			default: false,
		},

		isBankAccountTransfer: {
			type: [String, Boolean],
			default: true,
		},

		isConfirmation: {
			type: [String, Boolean],
			default: true,
		},

		isCancellation: {
			type: [String, Boolean],
			default: false,
		},

		isInvalid: {
			type: [String, Boolean],
			default: false,
		},
	},

	data: function () {
		return {
			isError: false,
			isLoading: false,

			isStripe3DSecureConfirmationRequiredGo: false,
			isStripe3DSecureConfirmed: false,
			isStripe3DSecureCancell: false,
			isStripe3DSecureErrorResponse: false,
		};
	},

	created() {
		"use strict";
		if (this.$_checkedOrRedirected()) {
			this.isStripe3DSecureConfirmationRequiredGo = this.isStripe3DSecureConfirmationRequired;

			if (this.$_toCleanBasket()) {
				this.$store.dispatch("clearBasket");
			}
		}
	},

	mounted() {
		"use strict";
		if (!this.$_checkedOrRedirected()) {
			return;
		}
		if (
			!this.isInvalid &&
			!this.isStripe3DSecureConfirmationRequired &&
			(this.isConfirmation || this.isBankAccountTransfer)
		) {
			if (this.isConfirmation) {
				this.$_updateOrderToPaiedStatus();
			}
			this.$_sendNotification();
		}
	},

	methods: {
		$_checkedOrRedirected: function () {
			"use strict";
			const nullInvalid = !this.orderDetails || !this.stripeData;
			const dummyInvalidOrderDetails =
				this.orderDetails && this.orderDetails["state"] === "Not defined";
			const dummyInvalidStripeData =
				this.stripeData && this.stripeData["state"] === "Not defined";
			if (nullInvalid || dummyInvalidOrderDetails || dummyInvalidStripeData) {
				console.warn(
					"Warn [FinalizationComp::$_checkedOrRedirected] Returned Invalid Arguments"
				);
				this.$router
					.push({
						name: "store",
					})
					.catch((reject) => {
						console.warn(
							"Warn [FinalizationComp] Vue navigation router error"
						);
					});
				return false;
			}
			return true;
		},

		$_calcOrderNumberStr: function () {
			"use strict";
			return this.orderDetails["orderNumber"];
		},

		$_formNumberStr: function (strNumber) {
			"use strict";
			return '<span class="number-text">' + strNumber + "</span>";
		},

		getSuccessfulOrderCreationLocaleMsg: function () {
			"use strict";
			const msg = this.__("order.orderCreationSuccessfulMsg");
			return msg.replace(
				":order_number",
				this.$_formNumberStr(this.$_calcOrderNumberStr())
			);
		},

		getApprovedPaymentLocaleMsg: function () {
			"use strict";
			let msg = this.__("order.successfulPaymentText");
			msg = msg.replace(":lfp", this.orderDetails.personalData["lfp"]);
			msg = msg.replace(
				":amount",
				this.$_formNumberStr(this.orderDetails.payment["value"])
			);
			msg = msg.replace(":currency", this.orderDetails.payment["currency"]);

			return msg;
		},

		getCancelledPaymentLocaleMsg: function () {
			"use strict";
			let msg = this.__("order.failedPaymentAppovalText");
			msg = msg.replace(
				":order_number",
				this.$_formNumberStr(this.$_calcOrderNumberStr())
			);

			return msg;
		},

		handleStripe3DSecureConfirmation: function (response) {
			"use strict";
			console.info(
				"Info [FinallizationComp::handleStripe3DSecureConfirmation] Got Stripe 3D Secure confirmation response " +
					response
			);

			/* Need to make additional request to approval server method to confirm the client */
			this.$_sendConfirmation();
			/* */

			this.isStripe3DSecureConfirmationRequiredGo = false;
			this.isStripe3DSecureConfirmed = true;
			this.isStripe3DSecureCancell = false;
			this.isStripe3DSecureErrorResponse = false;

			// clean cart
			this.$store.dispatch("clearBasket");
		},

		handleStripe3DSecureCancellation: function (response) {
			"use strict";
			console.info(
				"Info [FinallizationComp::handleStripe3DSecureCancellation] Got Stripe 3D Secure cancellation response " +
					response
			);

			this.isStripe3DSecureConfirmationRequiredGo = false;
			this.isStripe3DSecureConfirmed = false;
			this.isStripe3DSecureCancell = true;
			this.isStripe3DSecureErrorResponse = false;
			//
			// Remove the order
			//
			const orderParams = Object.create(null);
			orderParams.order_id = this.orderDetails["orderId"];
			this.isLoading = true;
			this.isError = false;
			const self = this;
			axios
				.post(
					"/api/payments/cancellation",
					{ params: orderParams },
					{
						headers: {
							"Content-Type": "application/json",
						},
					}
				)
				.then((response) => {
					self.isLoading = false;
					console.info(
						"Info [FinallizationComp::handleStripe3DSecureCancellation] Order with id " +
							self.orderDetails["orderId"] +
							" was successfuly removed"
					);
				})
				.catch((reject) => {
					self.isError = true;
					self.isLoading = false;
					console.warn(
						"Warn [FinallizationComp::handleStripe3DSecureCancellation] Order with id " +
							self.orderDetails["orderId"] +
							" could be removed."
					);
					if (is404(reject) || is422(reject) || is500(reject)) {
						console.error(
							"Error [PaymentComp::handleStripePaymentBtnSuccessfulSubmit] Status (500/422/404): " +
								reject.response.data.errors
						);
						self.srvSideErrors = reject.response.data.errors;
					} else {
						console.error(
							"Error [PaymentComp::handleStripePaymentBtnSuccessfulSubmit] Unexpected error status: " +
								reject
						);
					}
				});
		},

		handleStripe3DSecureErrorResponse: function (response) {
			"use strict";
			console.info(
				"Info [FinallizationComp::handleStripe3DSecureErrorResponse] Got Stripe 3D Secure error response " +
					response
			);

			this.isStripe3DSecureConfirmationRequiredGo = false;
			this.isStripe3DSecureConfirmed = false;
			this.isStripe3DSecureCancell = false;
			this.isStripe3DSecureErrorResponse = true;
		},

		$_sendConfirmation: function () {
			"use strict";
			this.isError = false;
			this.isLoading = true;
			const self = this;
			const urlParams = new URLSearchParams();
			urlParams.append("order_id", self.orderDetails["orderId"]);
			urlParams.append(
				"payment_platform",
				self.orderDetails["payment"].payment_platform
			);
			// intent id <=> payment_method_id but not the same as payment_method
			urlParams.append("payment_method_id", self.stripeData["paymentMethodId"]);

			axios
				.get("/api/payments/approval", { params: urlParams })
				.then((response) => {
					// debugger;
					self.isLoading = false;
					console.info(
						"Info [FinallizationComp::$_sendConfirmation] Stripe 3D Secure confirmation is approved"
					);
					this.$_sendNotification();
				})
				.catch((reject) => {
					// debugger;
					self.isLoading = false;
					self.isError = true;
					console.error(
						"Error [FinallizationComp::$_sendConfirmation] Stripe 3D Secure confirmation is failed"
					);

					if (is404(reject) || is422(reject) || is500(reject)) {
						console.error(
							"Error [FinallizationComp::$_sendConfirmation] Status (500/422/404): " +
								reject.response.data.errors
						);
						self.srvSideErrors = reject.response.data.errors;
					} else {
						console.error(
							"Error [FinallizationComp::$_sendConfirmation] Unexpected error status: " +
								reject
						);
					}
				});
		},

		$_updateOrderToPaiedStatus: function () {
			"use strict";
			const orderParams = Object.create(null);
			orderParams["is_order_change_status"] = true;
			orderParams["order_state_id"] = 2; // status is PAYED
			this.isLoading = true;
			this.isError = false;
			const self = this;
			axios
				.put(
					`/api/order/${self.orderDetails.orderId}`,
					{ params: orderParams },
					{
						headers: {
							"Content-Type": "application/json",
						},
					}
				)
				.then((response) => {
					self.isLoading = false;
					console.info(
						"Info [FinallizationComp::$_updateOrderStatusToPaied] Order state is " +
							orderParams["order_state_id"] +
							" was switched on"
					);

					self.$_sendNotification();
				})
				.catch((reject) => {
					self.isError = true;
					self.isLoading = false;
					console.warn(
						"Warn [FinallizationComp::$_updateOrderStatusToPaied] Couldn't change order state"
					);
					if (is404(reject) || is422(reject) || is500(reject)) {
						console.error(
							"Error [FinallizationComp::$_updateOrderStatusToPaied] Status (500/422/404): " +
								reject.response.data.errors
						);
						self.srvSideErrors = reject.response.data.errors;
					} else {
						console.error(
							"Error [FinallizationComp::$_updateOrderStatusToPaied] Unexpected error status: " +
								reject
						);
					}
				});
		},

		$_toCleanBasket: function () {
			"use strict";
			return !this.isInvalid && (this.isBankAccountTransfer || this.isConfirmation);
		},

		$_sendNotification: function () {
			"use strict";
			this.isLoading = true;
			this.isError = false;
			const self = this;
			axios
				.post(`/api/order/sendNotification/${this.orderDetails.orderId}`, {
					headers: {
						"Content-Type": "application/json",
					},
				})
				.then((response) => {
					this.isLoading = false;
					console.info(
						"Info [FinallizationComp::$_sendNotification] Letter with order was sent"
					);
				})
				.catch((reject) => {
					this.isError = true;
					this.isLoading = false;
					console.warn(
						"Warn [FinallizationComp::$_sendNotification] Couldn't change order state"
					);
					if (is404(reject) || is422(reject) || is500(reject)) {
						console.error(
							"Error [PaymentComp::$_sendNotification] Status (500/422/404): " +
								reject.response.data.errors
						);
						this.srvSideErrors = reject.response.data.errors;
					} else {
						console.error(
							"Error [PaymentComp::$_sendNotification] Unexpected error status: " +
								reject
						);
					}
				});
		},
	},
};
</script>

<style lang="scss" scoped>
.order-finallization-canvas {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	justify-content: center;
	flex-wrap: wrap;
	align-items: stretch;

	max-width: 100%;
	width: 100%;
	margin: 0;
	padding: 0;
}

.order-finallization-header-text {
	font-size: 24px;
	font-size: 1.5em;
	font-size: calc(1.2em + 1vmin);
	font-size: calc(1.2em + var(--100nvmin, 1vmin));
	text-transform: unset;
	color: #ffffff;
	font-weight: 400;
	font-style: normal;
	letter-spacing: normal;
	line-height: normal;
	text-align: center;
}

.order-finallization-header-text {
	font-family: "steilgut_cormorant", sans-serif;
}

.succcess-msg {
	color: #ffffff;
}

.err-msg {
	color: #ff6660;
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
	.order-finallization-header-text {
		/* break line if it overflows, doesn't save spaces. */
		white-space: pre-line;
		overflow: auto;

		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.order-finallization-canvas {
		min-height: 0;
		margin: auto;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.order-finallization-canvas,
	.order-finallization-header-text {
		max-width: 90vw;
		max-width: calc(var(--100vw, 1vw) * 90);
		width: 90vw;
		width: calc(var(--100vw, 1vw) * 90);

		max-height: 50vh;
		max-height: calc(var(--100vh, 1vh) * 50);
		height: 50vh;
		height: calc(var(--100vh, 1vh) * 50);
	}

	.order-finallization-header-text {
		font-size: 24px;
		font-size: 1.5em;
		font-size: calc(1.3em + 1.3vmin);
		font-size: calc(1.3em + var(--100vmin, 1vmin) * 1.3);
	}
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
	.order-finallization-canvas,
	.order-finallization-header-text {
		max-height: 50vh;
		max-height: calc(var(--100vh, 1vh) * 50);
		height: 50vh;
		height: calc(var(--100vh, 1vh) * 50);

		max-width: 70vw;
		max-width: calc(var(--100vw, 1vw) * 70);
		width: 70vw;
		width: calc(var(--100vw, 1vw) * 70);
	}

	.order-finallization-canvas {
		margin: 5vh auto;
		margin: calc(var(--100vh, 1vh) * 5) auto;
	}

	.order-finallization-header-text {
		font-size: 1.3em;
		font-size: calc(1em + 2vh);
		font-size: calc(1em + var(--100vh, 1vh) * 2);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}
</style>
