<template>
	<div class="transit-flex-box tw-flex payment-container tw-h-full">
		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div v-else-if="isLoading">
			<pulse-logo-comp isDefer="true"></pulse-logo-comp>
		</div>
		<div v-else class="transit-flex-box tw-flex payment-container tw-h-full">
			<div
				class="transit-flex-box md:tw-flex tw-hidden landscape:tw-flex landscape:tw-h-full md:tw-h-full"
				v-if="
					(isMobileDevice() && isLandscapeOrientation()) ||
					(!isMobileDevice() && !isBrowserPortraitOrientation())
				"
			>
				<div v-show="isInitialModeProp" class="transit-flex-box tw-h-full">
					<!-- Is Initial Payment Mode -->
					<h2 class="payment-header-text tw-hidden">
						{{ __("order.paymentHeader") }}
					</h2>
					<div class="payment-options-container">
						<button
							type="button"
							name="bank-account-button-active"
							class="payment-option-btn"
							:class="{
								'active-payment-option-btn': internalPaymentOptionList[0],
							}"
							@click="handlePaymentOptionClick($event, 0)"
						>
							<h2 class="payment-options-header">
								{{ __("order.bankAccountPaymentHeader") }}
							</h2>
						</button>

						<button
							v-if="false"
							type="button"
							name="card-payment-button-active"
							class="payment-option-btn"
							:class="{
								'active-payment-option-btn': internalPaymentOptionList[1],
							}"
							@click="handlePaymentOptionClick($event, 1)"
						>
							<h2 class="payment-options-header">
								{{ __("order.cardPaymentHeader") }}
							</h2>
						</button>

						<button
							v-if="false"
							type="button"
							name="paypal-button-active"
							class="payment-option-btn"
							:class="{
								'active-payment-option-btn': internalPaymentOptionList[2],
							}"
							@click="handlePaymentOptionClick($event, 2)"
						>
							<h2 class="payment-options-header">
								{{ __("order.paypalPaymentHeader") }}
							</h2>
						</button>
					</div>

					<div
						class="selected-payment-board tw-h-auto"
						:key="selectedPaymentBoardUpdateKey"
					>
						<div
							v-show="internalPaymentOptionList[0]"
							class="payment-details bank-account-transfer"
						>
							<h2 class="announcement-text">
								{{ __("order.bankTransferAnnouncement") }}
							</h2>
						</div>
						<div
							v-show="internalPaymentOptionList[1]"
							class="payment-details card-payment tw-h-auto"
						>
							<!-- <h2 class="announcement-text">
                                {{ __("order.cardPaymentAnnouncement") }}
                            </h2> -->
							<div class="stripe-card-container">
								<!-- <stripe-card-comp
									:idp="`${idp}-desktop0`"
									:isHide="!internalPaymentOptionList[1]"
									:paymentSubmitButtonId="
										goFromSummaryToFinallizationBtnLinkId
									"
									:stripeCardAttributes="$_createStripeAttributes()"
									v-on:stripe-details-load-failure="
										handleStripeDetailsLoadFailure
									"
									v-on:on-payment-btn-failed-submit="
										handleStripePaymentBtnFailedSubmit
									"
									v-on:on-payment-btn-successful-submit="
										handleStripePaymentBtnSuccessfulSubmit
									"
									v-on:validation-check-event="
										handleStripeCardValidationCheck
									"
								></stripe-card-comp> -->
							</div>
						</div>
						<div
							v-show="internalPaymentOptionList[2]"
							class="payment-details paypal-payment transit-flex-box"
						>
							<h2 class="announcement-text">
								{{ __("order.paypalPaymentAnnouncement") }}
							</h2>
							<p>
								<label
									for="paymentPlatform"
									class="rounded badge badge-light"
									type="button"
									data-toggle="collapse"
									data-target="#PayPal-collapse"
								>
									<img
										:src="
											paymentPlatformMap.get('PayPal')['iconPath']
										"
										class="thumb-nail"
									/>
								</label>
							</p>
							<div
								class="collapse tw-w-1/2 tw-max-w-1/2 rounded"
								id="PayPal-collapse"
							>
								<h2 class="announcement-text">
									{{ __("order.paypalCheckoutAnnouncement") }}
								</h2>
							</div>
						</div>

						<div
							class="agreement-container tw-inline-flex tw-w-full tw-max-w-full input-cell"
						>
							<div
								class="agreement-checkbox-container tw-inline-block input-cell"
							>
								<input
									type="checkbox"
									name="agreement"
									@change="$_validate()"
									v-model="agreement"
								/>
								<span
									class="checkmark"
									:class="[
										{
											'is-invalid-field':
												errorsFor('agreement').length > 0,
										},
									]"
								></span>
							</div>

							<label
								class="agreement-text is-required-field tw-inline-block"
								for="agreement"
								:class="[
									{
										'is-invalid-field':
											errorsFor('agreement').length > 0,
									},
								]"
								>{{ __("order.agreementTitle") }}
							</label>
						</div>

						<div
							class="agreement-container tw-inline-flex tw-w-full tw-max-w-full input-cell"
							v-if="isDELocale()"
						>
							<div
								class="agreement-checkbox-container tw-inline-block input-cell"
							>
								<input
									type="checkbox"
									name="ruleNotificationAgreement"
									@change="$_validate()"
									v-model="ruleAgreement"
								/>
								<span
									class="checkmark"
									:class="[
										{
											'is-invalid-field':
												errorsFor('ruleAgreement').length > 0,
										},
									]"
								></span>
							</div>

							<label
								class="agreement-text is-required-field tw-inline-block"
								for="ruleNotificationAgreement"
								:class="[
									{
										'is-invalid-field':
											errorsFor('ruleAgreement').length > 0,
									},
								]"
								>{{ __("order.ruleAgreementTitle") }}
							</label>
						</div>

						<div
							class="agreement-container tw-inline-flex tw-w-full tw-max-w-full input-cell"
							v-if="isDELocale()"
						>
							<div
								class="agreement-checkbox-container tw-inline-block input-cell"
							>
								<input type="checkbox" name="notificationAgreement" />
								<span class="checkmark"></span>
							</div>

							<label
								class="agreement-text tw-inline-block"
								for="notificationAgreement"
								>{{ __("order.notificationAgreementTitle") }}
							</label>
						</div>
					</div>
				</div>
				<div
					:id="`${idp}summary-data`"
					v-if="ifSummaryMode"
					class="transit-flex-box tw-h-full"
				>
					<summary-order-comp
						:summaryData="$_getSummaryData()"
					></summary-order-comp>
				</div>
			</div>
			<div
				class="transit-flex-box tw-flex payment-container md:tw-hidden landscape:tw-hidden tw-h-auto"
				v-if="
					(isMobileDevice() && isPortraitOrientation()) ||
					(!isMobileDevice() && isBrowserPortraitOrientation())
				"
			>
				<div v-show="isInitialModeProp" class="transit-flex-box tw-h-auto">
					<h2 class="payment-header-text tw-hidden">
						{{ __("order.paymentHeader") }}
					</h2>
					<div class="payment-options-container">
						<button
							type="button"
							name="bank-account-button-active"
							class="payment-option-btn"
							:class="{
								'active-payment-option-btn': internalPaymentOptionList[0],
							}"
							@click="handlePaymentOptionClick($event, 0)"
						>
							<h2 class="payment-options-header">
								{{ __("order.bankAccountPaymentHeader") }}
							</h2>
						</button>

						<button
							v-if="false"
							type="button"
							name="card-payment-button-active"
							class="payment-option-btn"
							:class="{
								'active-payment-option-btn': internalPaymentOptionList[1],
							}"
							@click="handlePaymentOptionClick($event, 1)"
						>
							<h2 class="payment-options-header">
								{{ __("order.cardPaymentHeader") }}
							</h2>
						</button>

						<button
							v-if="false"
							type="button"
							name="paypal-button-active"
							class="payment-option-btn"
							:class="{
								'active-payment-option-btn': internalPaymentOptionList[2],
							}"
							@click="handlePaymentOptionClick($event, 2)"
						>
							<h2 class="payment-options-header">
								{{ __("order.paypalPaymentHeader") }}
							</h2>
						</button>
					</div>

					<div
						class="selected-payment-board"
						:key="selectedPaymentBoardUpdateKey"
					>
						<div
							v-show="internalPaymentOptionList[0]"
							class="payment-details bank-account-transfer"
						>
							<h2 class="announcement-text">
								{{ __("order.bankTransferAnnouncement") }}
							</h2>
						</div>
						<div
							v-show="internalPaymentOptionList[1]"
							class="payment-details card-payment"
						>
							<!-- <h2 class="announcement-text">
                                {{ __("order.cardPaymentAnnouncement") }}
                            </h2> -->
							<div class="stripe-card-container">
								<!-- <stripe-card-comp
									:idp="`${idp}-portrait0`"
									:isHide="!internalPaymentOptionList[1]"
									:paymentSubmitButtonId="
										goFromSummaryToFinallizationBtnLinkId
									"
									:stripeCardAttributes="$_createStripeAttributes()"
									v-on:stripe-details-load-failure="
										handleStripeDetailsLoadFailure
									"
									v-on:on-payment-btn-failed-submit="
										handleStripePaymentBtnFailedSubmit
									"
									v-on:on-payment-btn-successful-submit="
										handleStripePaymentBtnSuccessfulSubmit
									"
									v-on:validation-check-event="
										handleStripeCardValidationCheck
									"
								></stripe-card-comp> -->
							</div>
						</div>
						<div
							v-show="internalPaymentOptionList[2]"
							class="payment-details paypal-payment transit-flex-box"
						>
							<h2 class="announcement-text">
								{{ __("order.paypalPaymentAnnouncement") }}
							</h2>
							<p>
								<label
									for="paymentPlatform"
									class="rounded badge badge-light"
									type="button"
									data-toggle="collapse"
									data-target="#PayPal-collapse"
								>
									<img
										:src="
											paymentPlatformMap.get('PayPal')['iconPath']
										"
										class="thumb-nail"
									/>
								</label>
							</p>
							<div
								class="collapse tw-w-1/2 tw-max-w-1/2 rounded"
								id="PayPal-collapse"
							>
								<h2 class="announcement-text">
									{{ __("order.paypalCheckoutAnnouncement") }}
								</h2>
							</div>
						</div>

						<div
							class="agreement-container tw-block tw-w-full tw-max-w-full input-cell"
						>
							<div
								class="agreement-checkbox-container tw-inline-block input-cell"
							>
								<input
									type="checkbox"
									name="agreement"
									@change="$_validate()"
									v-model="agreement"
								/>
								<span
									class="checkmark"
									:class="[
										{
											'is-invalid-field':
												errorsFor('agreement').length > 0,
										},
									]"
								></span>
							</div>

							<label
								class="agreement-text is-required-field tw-inline-block"
								for="agreement"
								:class="[
									{
										'is-invalid-field':
											errorsFor('agreement').length > 0,
									},
								]"
								>{{ __("order.agreementTitle") }}
							</label>
						</div>

						<div
							class="agreement-container tw-block tw-w-full tw-max-w-full input-cell"
							v-if="isDELocale()"
						>
							<div
								class="agreement-checkbox-container tw-inline-block input-cell"
							>
								<input
									type="checkbox"
									name="ruleNotificationAgreement"
									@change="$_validate()"
									v-model="ruleAgreement"
								/>
								<span
									class="checkmark"
									:class="[
										{
											'is-invalid-field':
												errorsFor('ruleAgreement').length > 0,
										},
									]"
								></span>
							</div>

							<label
								class="agreement-text is-required-field tw-inline-block"
								for="ruleNotificationAgreement"
								:class="[
									{
										'is-invalid-field':
											errorsFor('ruleAgreement').length > 0,
									},
								]"
								>{{ __("order.ruleAgreementTitle") }}
							</label>
						</div>

						<div
							class="agreement-container tw-block tw-w-full tw-max-w-full input-cell"
							v-if="isDELocale()"
						>
							<div
								class="agreement-checkbox-container tw-inline-block input-cell"
							>
								<input type="checkbox" name="notificationAgreement" />
								<span class="checkmark"></span>
							</div>

							<label
								class="agreement-text tw-inline-block"
								for="notificationAgreement"
								>{{ __("order.notificationAgreementTitle") }}
							</label>
						</div>
					</div>
				</div>
				<div
					:id="`${idp}summary-data`"
					v-if="ifSummaryMode"
					class="transit-flex-box tw-h-auto"
				>
					<summary-order-comp
						:summaryData="$_getSummaryData()"
					></summary-order-comp>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import validationErrors from "../../mixins/validationErrors";
import mediaHelper from "../../mixins/mediaHelper";
import { refreshFullPageContainers } from "../../utils/resizer";
import { mapGetters, mapState } from "vuex";
import { is422, is404, is500 } from "../../utils/response";
// const stripeCardComp = () =>
// 	import(/* webpackPrefetch: true */ "../stripe/StripeCardComp");

const pulseLogoComp = () =>
	import(/* webpackPrefetch: true */ "../../components/PulseLogoComp");

const summaryOrderComp = () => import(/* webpackPrefetch: true */ "../order/SummaryComp");

export default {
	mixins: [validationErrors, mediaHelper],

	components: {
		// "stripe-card-comp": stripeCardComp,
		"pulse-logo-comp": pulseLogoComp,
		"summary-order-comp": summaryOrderComp,
	},

	props: {
		idp: {
			type: [String],
			default: "delivery-desktop-",
			required: false,
		},

		/* Initial Mode: make selection of payment type */
		isInitialModeProp: {
			type: [Boolean, String],
			default: true,
			required: true,
		},

		/* Summary Mode: reviev the order and go to Finallization component */
		isSummaryModeProp: {
			type: [Boolean, String],
			default: false,
			required: true,
		},

		deliveryOptionList: {
			type: [Array],
			default: [],
		},

		orderDetails: {
			type: [Object],
			default: {},
		},
		paymentOptionList: {
			type: [Array],
			default: [],
		},

		goFromSummaryToFinallizationBtnLinkId: {
			type: [String],
			required: true,
		},
	},

	data: function () {
		return {
			paymentMainBoardKey: "main-payment-update-key_0",
			// paymentOptionList: [false, false, true],
			paymentPlatformMap: new Map(),

			// orderDetails: {
			// 	summaryPrice: 20,
			// 	deliveryPrice: 8,
			// 	personalData: {
			// 		LFP: 'MkA',
			// 		country: 'USA',
			// 		zip: '444768',
			// 		address: 'Washington',
			// 		email: 'mka@gmail.com',
			// 		phone: '+7(422)4556666',
			// 	},
			// },

			internalPaymentOptionList: [],

			isError: false,
			isLoading: false,
			isValidationError: false,
			isStripeCardComlete: false,

			// Agreements
			agreement: false,
			ruleAgreement: false,

			selectedPaymentBoardUpdateKey: "selected-payment-board_0",

			isSummaryMode: false,
		};
	},

	async created() {
		"use strict";
		console.log("Debug [PaymentComp::created] Enter the function");
		if (this.$_checkedOrRedirected()) {
			// debugger;

			for (let key in this.paymentOptionList) {
				this.internalPaymentOptionList[key] = this.paymentOptionList[key];
			}

			this.isError = false;
			this.isLoading = true;

			try {
				const paymentPlatformList = (
					await axios.get("/api/payments/platform_list")
				).data.data;

				paymentPlatformList.forEach((platform) => {
					this.paymentPlatformMap.set(platform["name"], {
						id: platform["id"],
						iconPath: platform["image"],
					});
				});
				this.paymentPlatformMap.set("BankTransfer", {
					id: "Not defined",
					iconPath: "Not defined",
				});
			} catch (reject) {
				this.isError = true;
			} finally {
				this.isLoading = false;
			}
		}
	},

	mounted() {
		"use strict";
		if (!this.isError) {
			const paymentBtn = document.getElementById(
				this.goFromSummaryToFinallizationBtnLinkId
			);
			paymentBtn.addEventListener("click", this.handleSubmitBankTransferPayment);
		}
	},

	destroyed() {
		"use strict";
		const paymentBtn = document.getElementById(
			this.goFromSummaryToFinallizationBtnLinkId
		);

		if (paymentBtn) {
			// if it is still in the DOM
			paymentBtn.removeEventListener("click", this.handleSubmitBankTransferPayment);
		}
	},

	methods: {
		$_checkedOrRedirected: function () {
			"use strict";
			// debugger;
			if (
				!this.deliveryOptionList ||
				!this.orderDetails ||
				!this.paymentOptionList
			) {
				console.warn(
					"Warn [PaymentComp::$_checkedOrRedirected] Returned Invalid Arguments"
				);
				this.$router.push({
					name: "controlPanel",
				});
				return false;
			}
			return true;
		},

		$_getDataForTransfer: function (paymentName, paymentMethodId) {
			"use strict";

			const submitData = {
				// delivery_options
				// cart
				// is_bank_transfer
				// payment
				// personal_data
				// address
				// prices
			};

			// delivery options
			submitData["delivery_options"] = this.$_getDeliveryOptions();

			// cart
			submitData["cart"] = this.$_getCart();

			// payment details: currency, value, payment_platform
			if (!this.paymentPlatformMap.get(paymentName)) {
				throw new Error(
					"Error [PaymentComp::$_getDataForTransfer] Unknown payment platform name"
				);
			}

			if (paymentName === "BankTransfer") {
				submitData["is_bank_transfer"] = true;
			} else {
				submitData["payment"] = this.$_getPayment(paymentName, paymentMethodId);
				submitData["is_bank_transfer"] = false;
			}

			// personal data: email, first/last name, phone
			submitData["personal_data"] = this.$_getPersonalData();

			// address: country, zip-code, google_place_id, fullpath and etc
			submitData["address"] = this.$_getAddress();
			submitData["prices"] = {
				subtotal_price: this.orderDetails["summaryPrice"],
				delivery_price: this.orderDetails["deliveryPrice"],
			};

			return submitData;
		},

		$_getSummaryData: function () {
			"use strict";
			const summaryData = {
				// delivery_options
				// cart
				// is_bank_transfer
				// personal_data
				// address
				// prices
			};

			// delivery options
			summaryData["delivery_options"] = this.$_getDeliveryOptions();
			// cart
			summaryData["cart"] = this.$_getCart();
			summaryData["is_bank_transfer"] = this.internalPaymentOptionList[0];
			// personal data: email, first/last name, phone
			summaryData["personal_data"] = this.$_getPersonalData();
			// address: country, zip-code, google_place_id, fullpath and etc
			summaryData["address"] = this.$_getAddress();

			// price and delivery price
			summaryData["prices"] = {
				subtotalPrice: this.orderDetails["summaryPrice"],
				deliveryPrice: this.orderDetails["deliveryPrice"],
			};
			return summaryData;
		},

		$_getDeliveryOptions: function () {
			"use strict";
			// clone options
			return this.deliveryOptionList.slice();
		},

		$_getCart: function () {
			"use strict";
			const updatingCart = this.getBasketItemListClone;
			const subtotalProductList = [];
			updatingCart.forEach((product) => {
				if (product["count"] > 0) {
					subtotalProductList.push({
						id: product.item["id"],
						subtotal: product["count"],
					});
				}
			});

			return subtotalProductList;
		},

		$_getPayment: function (paymentName, paymentMethod) {
			"use strict";
			return {
				is_bank_transfer_account: this.paymentOptionList[0],
				currency: "EUR", // constant
				value:
					this.orderDetails["summaryPrice"] +
					(this.orderDetails["deliveryPrice"] > 0
						? this.orderDetails["deliveryPrice"]
						: 0),
				payment_platform: this.paymentPlatformMap.get(paymentName)["id"],
				payment_method: paymentMethod,
			};
		},

		$_getPersonalData: function () {
			"use strict";
			return {
				lfp: this.orderDetails["personalData"].LFP,
				email: this.orderDetails["personalData"].email,
				phone: this.orderDetails["personalData"].phone,
			};
		},

		$_getAddress: function () {
			"use strict";
			const address = this.orderDetails["addressObj"];

			if (address && (this.deliveryOptionList[1] || this.deliveryOptionList[2])) {
				return {
					country: this.$_getShortNameOfAddressAttribute(address, "Country"),
					full_path: this.orderDetails["personalData"].address
						? this.orderDetails["personalData"].address
						: null,
					google_place_id: address["place_id"] ? address["place_id"] : null,
					zip_code: this.$_getShortNameOfAddressAttribute(address, "Zip"),
					county: this.$_getShortNameOfAddressAttribute(address, "State"),
					city: this.$_getShortNameOfAddressAttribute(address, "City"),
					street: this.$_getShortNameOfAddressAttribute(address, "StreetName"),
					building_number: this.$_getShortNameOfAddressAttribute(
						address,
						"StreenNumber"
					),
					organization_title: this.$_getShortNameOfAddressAttribute(
						address,
						"Organization"
					),
				};
			} else {
				return {
					country: this.orderDetails["personalData"].country,
					full_path: this.orderDetails["personalData"].address,
					zip_code: this.orderDetails["personalData"].zip,
				};
			}
		},

		$_getShortNameOfAddressAttribute: function (address, attribute) {
			return address[attribute] && address[attribute].short_name
				? attribute === "Country"
					? address[attribute].long_name
					: address[attribute].short_name
				: null;
		},

		handlePaymentOptionClick: function (event, optionIndex) {
			"use strict";
			console.log(
				"Debug [PaymentComp::handlePaymentOptionClick] Enter the function"
			);
			for (let key in this.internalPaymentOptionList) {
				this.internalPaymentOptionList[key] = false;
			}
			this.internalPaymentOptionList[optionIndex] = true;
			this.internalPaymentOptionList = [...this.internalPaymentOptionList];
			// Normalize for iOS
			if (this.isMobileSafariDevice()) {
				refreshFullPageContainers();
			}

			this.$emit("payment-options-change", event, optionIndex);
		},

		$_validate: function () {
			this.clientSideErrorMap = new Map();
			this.isValidationError = false;
			const agreementValidateStr = this.validateConsentCheckbox(this.agreement);
			if (agreementValidateStr !== "") {
				this.clientSideErrorMap.set("agreement", agreementValidateStr);
				this.isValidationError = true;
			}

			if (this.isDELocale()) {
				const ruleAgreementValidateStr = this.validateConsentCheckbox(
					this.ruleAgreement
				);
				if (ruleAgreementValidateStr !== "") {
					this.clientSideErrorMap.set(
						"ruleAgreement",
						ruleAgreementValidateStr
					);
					this.isValidationError = true;
				}
			}

			this.isValidationError =
				this.isValidationError ||
				(!this.isStripeCardComlete && this.internalPaymentOptionList[1]);
			this.$emit("on-payment-validation-check", event, this.isValidationError);
			return !this.isValidationError;
		},

		$_updateSelectPaymentBoard: function () {
			"use strict";

			if (this.selectedPaymentBoardUpdateKey === "selected-payment-board_0") {
				this.selectedPaymentBoardUpdateKey = "selected-payment-board_1";
			} else {
				this.selectedPaymentBoardUpdateKey = "selected-payment-board_0";
			}
		},

		/*
		 * Payment with Stripe credit card
		 */
		$_createStripeAttributes: function () {
			"use strict";
			console.log(
				"Debug [PaymentComp::$_createStripeAttributes] Enter the function"
			);
			return {
				id: this.paymentPlatformMap.get("Stripe")["id"],
				name: "Stripe",
				iconPath: this.paymentPlatformMap.get("Stripe")["iconPath"],
			};
		},

		handleStripeDetailsLoadFailure: function (event, errors) {
			"use strict";
			console.warn(
				"Warn [PaymentComp::handleStripeDetailsLoadFailure] Enter the function"
			);
			this.isError = true;
		},

		handleStripePaymentBtnFailedSubmit: function (event, error) {
			"use strict";
			this.$emit("on-payment-validation-check", event, true);
		},

		handleStripeCardValidationCheck: function (event, isComplete) {
			"use strict";
			this.isStripeCardComlete = isComplete;
			this.$_validate();
		},

		handleStripePaymentBtnSuccessfulSubmit: function (event, data) {
			"use strict";
			const submitFormData = this.$_getDataForTransfer(
				"Stripe",
				data.paymentMethod
			);
			const orderDetailsParams = {
				personalData: this.$_getPersonalData(),
				payment: this.$_getPayment("Stripe", data.paymentMethod),
			};
			const stripeDataParams = Object.create(null);

			if (!this.$_validate()) {
				return;
			}

			this.isError = false;
			this.isLoading = true;
			const self = this;
			axios
				.post("/api/payments/pay", submitFormData, {
					headers: {
						"Content-Type": "application/json",
					},
				})
				.then((response) => {
					self.isLoading = false;
					const responseBody = response.data;
					orderDetailsParams["orderNumber"] = responseBody.data["order_number"];
					orderDetailsParams["orderId"] = responseBody.data["order_id"];
					//
					// Go to the [Stripe 3DSecure Component] (for additional confirmation) into the Finallization component
					//
					if (
						responseBody.data["is_stripe_3dsecure"] == "true" ||
						responseBody.data["is_stripe_3dsecure"]
					) {
						stripeDataParams["serviceKey"] = responseBody.data["service_key"];
						stripeDataParams["clientSecret"] =
							responseBody.data["client_secret"];
						stripeDataParams["paymentMethodId"] =
							responseBody.data["payment_method_id"];

						/*
						 * Interface for order\FinallizationComp
						 *
						 * Properties
						 *
						 * OrderDetails: Object, required
						 * stripeData: Object, not-required, only for Stripe 3D Secure confirmation
						 * isStripe3DSecureConfirmationRequired: Boolean, required
						 * isBankAccountTransfer: Boolean required
						 * isConfirmation: Boolean, required, confirm w/o additional user bank confirmation (Stripe 3D Secure and etc)
						 * isCancellation: Boolean, required
						 * isInvalid: Boolean, required (order creation failure or error response to a credit card system and etc)
						 */
						self.$router.push({
							name: "order-finallization",
							params: {
								isBankAccountTransfer: false,
								isConfirmation: false,
								isCancellation: false,
								isInvalid: false,
								isStripe3DSecureConfirmationRequired: true,
								orderDetails: orderDetailsParams,
								stripeData: stripeDataParams,
							},
						});
					} else {
						self.$router.push({
							name: "order-finallization",
							params: {
								isBankAccountTransfer: false,
								isConfirmation: true,
								isCancellation: false,
								isStripe3DSecureConfirmationRequired: false,
								isInvalid: false,
								orderDetails: orderDetailsParams,
								stripeData: stripeDataParams,
							},
						});
					}
				})
				.catch((reject) => {
					self.isError = true;
					if (is404(reject) || is422(reject) || is500(reject)) {
						console.error(
							"Error [SummaryComp::handleStripePaymentBtnSuccessfulSubmit] Status (500/422/404): " +
								reject.response.data.errors
						);
						self.srvSideErrors = reject.response.data.errors;
						self.logSrvSideErrors();
					} else {
						console.error(
							"Error [SummaryComp::handleStripePaymentBtnSuccessfulSubmit] Unexpected error status: " +
								reject
						);
					}
					self.$router.push({
						name: "order-finallization",
						params: {
							isBankAccountTransfer: false,
							isInvalid: true,
							isConfirmation: false,
							isCancellation: false,
							isStripe3DSecureConfirmationRequired: false,
							orderDetails: orderDetailsParams,
							stripeData: stripeDataParams,
						},
					});
				});
		},

		handleSubmitPaypalPayment: function (event) {
			"use strict";
			event.preventDefault();
		},

		handleSubmitBankTransferPayment: async function (event) {
			"use strict";
			if (this.internalPaymentOptionList[0] && this.isSummaryModeProp) {
				this.$_doHandleSubmitBankTransferPayment(event);
			}
			event.stopPropagation();
		},

		/*
		 * Payment with Bank account transfer
		 */
		$_doHandleSubmitBankTransferPayment: async function (event) {
			"use strict";
			console.log(
				"Debug [SummaryComp::$_doHandleSubmitBankTransferPayment] Enter the function"
			);

			if (!this.$_validate()) {
				this.$emit("on-payment-validation-check", event);
				return;
			}

			this.isError = false;
			this.isLoading = true;
			let responseRes;
			const stripeDataParams = Object.create(null);
			const submitFormData = this.$_getDataForTransfer(
				"BankTransfer",
				"Not defined"
			);
			const orderDetailsParams = {
				personalData: this.$_getPersonalData(),
				deliveryOptions: this.$_getDeliveryOptions(),
			};
			try {
				responseRes = (
					await axios.post("/api/payments/pay", submitFormData, {
						headers: {
							"Content-Type": "application/json",
						},
					})
				).data.data;

				orderDetailsParams["orderId"] = responseRes["order_id"];
				orderDetailsParams["orderNumber"] = responseRes["order_number"];

				this.$router.push({
					name: "order-finallization",
					params: {
						isBankAccountTransfer: true,
						isConfirmation: false,
						isCancellation: false,
						isInvalid: false,
						orderDetails: orderDetailsParams,
						stripeData: stripeDataParams,
					},
				});
			} catch (reject) {
				this.isError = true;
				if (is404(reject) || is422(reject) || is500(reject)) {
					console.error(
						"Error [SummaryComp::$_doHandleSubmitBankTransferPayment] Status (500/422/404): " +
							reject.response.data.errors
					);
					this.srvSideErrors = reject.response.data.errors;
					this.logSrvSideErrors();
				} else {
					console.error(
						"Error [SummaryComp::$_doHandleSubmitBankTransferPayment] Unexpected error status: " +
							reject
					);
				}

				this.$router.push({
					name: "order-finallization",
					params: {
						isBankAccountTransfer: true,
						isConfirmation: false,
						isCancellation: false,
						isInvalid: true,
						orderDetails: orderDetailsParams,
						stripeData: stripeDataParams,
					},
				});
			} finally {
				this.isLoading = false;
				console.info(
					"Info [SummaryComp::$_doHandleSubmitBankTransferPayment] info: " +
						responseRes
				);
			}
		},
	},

	computed: {
		...mapGetters(["getBasketItemListClone"]),

		ifTransferBankPaymentClickCondition: function () {
			return this.isValidationError || this.isLoading ? null : "click";
		},

		ifSummaryMode: function () {
			this.$_validate();
			return this.isSummaryModeProp;
		},
	},
};
</script>

<style lang="scss" scoped>
@import "@/sass/_components.scss";
@import "@/sass/app/_media.scss";

h2.payment-header-text {
	font-family: "steilgut_cormorant", sans-serif;
	font-size: calc(0.8rem + 0.7vmin);
	font-size: calc(0.8rem + var(--100nvmin, 1vmin) * 0.7);
	text-transform: uppercase;
	color: #000;
	margin: 3vmin 0 1.5vmin 0;
	margin: calc(var(--100nvmin, 1vmin) * 3) 0 calc(var(--100nvmin, 1vmin) * 1.5) 0;
}

.payment-options-container {
	display: flex;
	flex: 0 0 25%;
	flex-direction: row;
	align-items: stretch;
	justify-content: flex-start;
	/* border: 2px solid #ebcb9a; */
}

.payment-option-btn h2 {
	font-family: "steilgut_opensans", sans-serif;
	font-weight: 100;
}

.payment-options-container > button {
	margin: 2% 5% 2% 0;
}

button {
	font: inherit;
	/* font-size: calc(0.5rem + 0.8vh); */
}

button.payment-option-btn {
	width: 13.541667vw;
	width: calc(var(--100nvw, 1vw) * 13.541667);
	min-width: calc(var(--100nvw, 1vw) * 13.541667);

	height: 10.789062vh;
	height: calc(var(--100nvh, 1vh) * 10.789062);
	min-height: calc(var(--100nvh, 1vh) * 10.789062);
	border: 1px solid #767676;
	border-radius: 6px;
	background-color: transparent;
}

button.payment-option-btn:hover {
	box-shadow: 2px 2px 5px #c4bbaa;
	color: #ebcb9a;
	/* border-color: #ebcb9a; */
}

.payment-options-container > button:last-child {
	margin-right: 0;
}

button.active-payment-option-btn {
	border: none !important;
	color: inherit !important;

	background-image: url("/images/icons/order-pg/select-btn.png");
	background-size: cover;
	background-repeat: no-repeat;
}

button.active-payment-option-btn:hover {
	text-shadow: none !important;
	border-color: none !important;
}

button h2.payment-options-header {
	padding: 0 1vmin;
}

.selected-payment-board {
	display: flex;
	/* not less than 60% of parent in height */
	flex: 1 0 auto;
	flex-direction: column;
	align-items: stretch;
	justify-content: flex-start;
	/* border: 2px solid #ebcb9a; */

	width: 100%;
	max-width: 100%;
	padding: 0;
	margin: 0;
}

.selected-payment-board div.payment-details {
	display: flex;
	flex: 0 0 40%;
	flex-direction: column;

	align-items: stretch;
	justify-content: center;

	/* border: 2px solid #c4bbaa; */

	width: 100%;
	max-width: 100%;
	padding: 2vmin 0;
	padding: calc(var(--100nvmin, 1vmin) * 2) 0;
	margin: 0;

	/* min-height: 70%; */
}

.selected-payment-board div.paypal-payment p {
	margin-top: calc(0.5rem + 2vh);
	margin-top: calc(0.5rem + var(--100nvh, 1vh) * 2);
}

.selected-payment-board div.bank-account-transfer {
	flex: 0 0 auto;
}

.bank-account-transfer h2.announcement-text {
	max-width: 80%;
}

.stripe-card-container {
	display: flex;
	flex: 1 0 auto;
	height: auto;
	flex-direction: column;
	margin: 2vmin 0;
	margin: calc(var(--100nvmin, 1vmin) * 2) 0;
}

.payment-icon {
	max-width: 14vmin;
	max-width: calc(var(--100nvmin, 1vmin) * 14);
}

.agreement-container {
	margin: 0.75vmin 0;
	margin: calc(var(--100nvmin, 1vmin) * 0.75) 0;
}

.selected-payment-board .agreement-checkbox-container {
	position: relative;
	z-index: 2;
	display: inline-block;
	vertical-align: middle;
	margin: auto 1vw auto 0;
	margin: auto var(--100nvw, 1vw) auto 0;
	/* aspect ratio: >= 16/10 */
	height: 22px;
	width: 22px;
}

/* Hide the browser's default checkbox */
.selected-payment-board .agreement-checkbox-container input {
	position: absolute;
	opacity: 0;
	z-index: 1;
	cursor: pointer;
	height: 100%;
	width: 100%;
}

/* Create a custom checkbox */
.selected-payment-board .agreement-checkbox-container .checkmark {
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	border: 0.05rem solid #000;
	background-color: transparent;
	border-radius: 0.35vh;
	border-radius: calc(var(--100nvh, 1vh) * 0.35);
	height: 100%;
	width: 100%;
}

/* On mouse-over, add a grey background color */
.selected-payment-board .agreement-checkbox-container:hover input ~ .checkmark {
	background-color: transparent;
}

/* Create the checkmark/indicator (hidden when not checked) */
.selected-payment-board .agreement-checkbox-container .checkmark::after {
	content: "";
	position: absolute;
	display: none;

	top: -100%;
	left: 0%;

	width: 22px;
	height: 33px;
	border: 1px solid #767676;
	filter: brightness(1.2);

	border-width: 0 0.07rem 0.05rem 0;
	transform: rotate(45deg) translate(0%, 0%);
}

/* Show the checkmark when checked */
.selected-payment-board .agreement-checkbox-container input:checked ~ .checkmark::after {
	display: block;
}

.agreement-text {
	margin: 0;
}

.accept-btn {
	margin: 0;
	font-family: "steilgut_opensans";
	font-weight: 100;
	color: #313131;
	height: fit-content;
	width: fit-content;
	padding: 1vmin;
	padding: var(--100nvmin, 1vmin);
}

.accept-btn:hover {
	box-shadow: -2px 2px 5px #c4bbaa;
}

.accept-btn-arrow {
	max-height: 1.25vh;
	max-height: calc(var(--100nvh, 1vh) * 1.25);
	margin: auto 1.5vmin auto 1.5vmin;
	margin: auto calc(var(--100nvmin, 1vmin) * 1.5) auto
		calc(var(--100nvmin, 1vmin) * 1.5);
}

.accept-btn-text-container {
	max-height: min-content;
	margin: auto 0;
}

h2.announcement-text {
	margin: 0;
}

button h2.payment-options-header,
h2.announcement-text,
h2.accept-btn-text {
	font-size: 0.8rem;
	font-size: calc(0.6rem + 0.6vmin);
	font-size: calc(0.6rem + var(--100nvmin, 1vmin) * 0.6);
}

h2.accept-btn-text {
	margin-left: 1vmin;
	margin-left: var(--100nvmin, 1vmin);
}

.accept-btn:hover svg path {
	fill: #ebcb9a;
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
	/* remove rounding corners */
	textarea,
	input[type="text"],
	input[type="button"],
	input[type="submit"] {
		-webkit-appearance: none !important;
		border-radius: 0 !important;
	}

	button.payment-option-btn {
		width: 13.541667vw;
		min-width: unset;
		max-width: 13.541667vw;

		height: 10.789062vh;
		min-height: unset;
		max-height: 10.789062vh;
	}

	.payment-options-container {
		padding-top: calc(0.5rem + 0.5vmin);
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.payment-container {
		align-items: flex-start;
	}

	.payment-options-container {
		flex: 1 0 auto;
		padding: 0 4vw;
		flex-wrap: wrap;
	}

	h2.payment-header-text {
		margin: 2vh auto;
		font-size: calc(1.5rem + 0.9vh);
	}

	button.payment-option-btn {
		width: 45vw;
		max-width: 45vw;
		margin: 1vh 1vh 1vh 0;
		font-size: 0.8rem;
	}

	button.payment-option-btn h2.payment-options-header {
		font-size: calc(0.8rem + 1vh);
	}

	.selected-payment-board {
		display: flex;
		/* not less than 60% of parent in height */
		flex: 1 0 auto;
		height: auto;
		flex-direction: column;
		align-items: stretch;
		justify-content: center;
		/* border-bottom: 1px solid #000; */

		width: 100%;
		max-width: 100%;
		padding: 0 4vw 4vh 4vw;
	}

	.selected-payment-board p {
		padding: 2vh 0;
	}

	.input-cell > label {
		font-size: calc(0.8rem + 0.8vh);
	}

	.input-cell > input {
		font-size: 2.5vh;
	}

	h2.announcement-text {
		padding: 1.5vh 0;
		font-size: 1rem;
		font-size: calc(0.8rem + 0.7vh);
	}

	.accept-btn h2.accept-btn-text {
		font-size: 1.3rem;
		font-size: calc(0.9rem + 0.9vh);
		padding: 1.5vh 2vmin;
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
	h2.payment-header-text {
		font-size: 0.7rem;
		font-size: calc(0.6rem + 2vh);
	}

	button.payment-option-btn {
		height: 11.789062vh;
	}

	button.payment-option-btn:first-child {
		width: 14.541667vw;
	}

	.payment-options-container {
		flex: 0 0 20%;
		align-self: flex-start;
	}

	.selected-payment-board {
		flex: 1 0 auto;
		height: auto;
	}

	.selected-payment-board > * {
		padding: 2vh 0;
	}

	.announcement-text {
		padding: 0.35rem 0.65rem;
	}

	.agreement-container {
		margin: 0;
	}

	.agreement-container .agreement-text {
		white-space: unset;
		width: 90%;
	}

	h2.payment-options-header,
	h2.announcement-text,
	h2.accept-btn-text {
		font-size: 0.8rem;
		font-size: calc(0.6rem + 0.7vmin);
	}

	.selected-payment-board div.payment-details {
		flex: 0 0 auto;
		height: auto;
		padding: 2vmin 0;
	}

	.agreement-checkbox-container .checkmark::after {
		width: 30px;
		height: 15px;
		left: -100%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			h2.payment-header-text {
				font-size: 0.7rem;
				font-size: calc(0.6rem + 2vh);
			}

			h2.payment-options-header,
			h2.announcement-text,
			h2.accept-btn-text {
				font-size: 0.8rem;
				font-size: calc(0.6rem + 0.7vmin);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
}

@media only screen and (min-width: 340px) and (max-width: 740px) and (orientation: landscape) {
}

@media only screen and (min-width: 375px) and (max-width: 896px) and (orientation: landscape) {
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.input-cell > label {
				font-size: calc(0.4rem + 0.4vmin);
				font-size: calc(0.4rem + var(--100nvmin, 1vmin) * 0.4);
			}
		}
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.selected-payment-board {
		flex: 0 0 50%;
	}

	input.payment-option-btn {
		width: 13.541667vw;
		width: calc(var(--100nvw, 1vw) * 13.541667);
		height: 8.789062vh;
		height: calc(var(--100nvh, 1vh) * 8.789062);
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (min-aspect-ratio: 16/10) {
	/* Styles */
}
</style>
