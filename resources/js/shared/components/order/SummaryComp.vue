<template>
	<div class="transit-flex-box tw-flex md:tw-h-full">
		<div
			class="transit-flex-box tw-flex md:tw-flex tw-hidden landscape:tw-flex landscape:tw-full content-main md:tw-h-full"
		>
			<h2 class="tw-block subheader">
				{{ __("order.summaryHeader") }}
			</h2>
			<div
				class="container-fluid gx-0 mx-0 external-order-content tw-overflow-y-auto tw-overflow-x-hidden"
			>
				<div
					class="container-fluid gx-0 mx-0 order-content pb-2"
					v-if="summaryData"
				>
					<div
						:key="`summaryItemRow_${i}`"
						v-for="i in getRowQuantity"
						class="summary-row"
						:class="getRowClass(i)"
					>
						<div class="col-2">
							{{ getBasketItemCount(i) }}
						</div>
						<div class="col-7 text-stat">
							{{ getBasketItemHeader(i) }}
						</div>
						<div class="col-3 text-end">
							{{ getBasketItemPrice(i) }}
						</div>
					</div>

					<div class="row pt-4 pb-1 border-top border-dark g-0 summary-row">
						<div class="col-2"></div>
						<div class="col-5 text-start">
							{{ __("order.subtotalPrice") }}
						</div>
						<div class="col-5 text-end">
							{{ getSubtotalPrice }}
						</div>
					</div>
					<div class="row py-1 g-0 summary-row">
						<div class="col-2"></div>
						<div class="col-5 text-start">
							{{ __("order.summaryDelivery") }}
						</div>
						<div class="col-5 text-end">
							{{ getDeliveryPriceStr }}
						</div>
					</div>
					<div class="row py-1 g-0 summary-row">
						<div class="col-2"></div>
						<div class="col-5 text-start">
							{{ __("order.summary") }}
						</div>
						<div class="col-5 text-end">
							{{ getSummaryPrice }}
						</div>
					</div>
				</div>
			</div>

			<h2 class="tw-block address-header">
				{{ __("common.address") }}
			</h2>
			<div class="row pt-2 pb-1 align-items-center g-0 summary-row">
				<div class="col text-start">
					{{ getLFP }}
				</div>
			</div>
			<div class="row py-1 align-items-center g-0 summary-row">
				<div class="col text-start">
					{{ getAddress }}
				</div>
			</div>

			<h2 class="tw-block payment-option-header">
				{{ __("order.paymentOption") }}
			</h2>
			<div class="row py-2 align-items-center g-0 summary-row">
				<div class="col-6">
					{{ getPaymentOptionStr }}
				</div>
			</div>
		</div>

		<div class="container-fluid g-0 tw-flex md:tw-hidden landscape:tw-hidden">
			<div class="transit-flex-box tw-flex content-main">
				<h2 class="tw-block subheader">
					{{ __("order.summaryHeader") }}
				</h2>

				<div
					class="container-fluid gx-0 mx-0 order-content pb-2"
					v-if="summaryData"
				>
					<div
						:key="`summaryItemRow_${i}`"
						v-for="i in getRowQuantity"
						class="summary-row"
						:class="getRowClass(i)"
					>
						<div class="col-2">
							{{ getBasketItemCount(i) }}
						</div>
						<div class="col-7 text-stat">
							{{ getBasketItemHeader(i) }}
						</div>
						<div class="col-3 text-end">
							{{ getBasketItemPrice(i) }}
						</div>
					</div>

					<div class="row pt-4 pb-1 border-top border-dark g-0 summary-row">
						<div class="col-2"></div>
						<div class="col-5 text-start">
							{{ __("order.subtotalPrice") }}
						</div>
						<div class="col-5 text-end">
							{{ getSubtotalPrice }}
						</div>
					</div>
					<div class="row py-1 g-0 summary-row">
						<div class="col-2"></div>
						<div class="col-5 text-start">
							{{ __("order.summaryDelivery") }}
						</div>
						<div class="col-5 text-end">
							{{ getDeliveryPriceStr }}
						</div>
					</div>
					<div class="row py-1 g-0 summary-row">
						<div class="col-2"></div>
						<div class="col-5 text-start">
							{{ __("order.summary") }}
						</div>
						<div class="col-5 text-end">
							{{ getSummaryPrice }}
						</div>
					</div>
				</div>

				<h2 class="tw-block address-header">
					{{ __("common.address") }}
				</h2>
				<div class="row pt-2 pb-1 align-items-center g-0 summary-row">
					<div class="col text-start">
						{{ getLFP }}
					</div>
				</div>
				<div class="row py-1 align-items-center g-0 summary-row">
					<div class="col text-start">
						{{ getAddress }}
					</div>
				</div>

				<h2 class="tw-block payment-option-header">
					{{ __("order.paymentOption") }}
				</h2>
				<div class="row py-2 align-items-center g-0 summary-row">
					<div class="col-6">
						{{ getPaymentOptionStr }}
					</div>
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
import { Helper } from "../../utils/helper";
export default {
	mixins: [validationErrors, mediaHelper],

	components: {},

	props: {
		summaryData: {
			type: [Object],
			default: {
				/*
				 * delivery_options
				 * cart
				 * personal_data
				 * address
				 */
			},
			required: true,
		},
	},

	created() {
		("use strict");
		// debugger;
		if (this.$_checkedOrRedirected()) {
			console.log("Debug [SummaryComp::created] Initial state is valid");
		}
	},

	data: function () {
		return {
			isError: false,
			isLoading: false,
		};
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [SummaryComp::$_checkedOrRedirected] Returned Invalid Arguments"
				);
				this.$router.push({
					name: "controlPanel",
				});
				return false;
			}
			return true;
		},

		$_isInitialStateValid: function () {
			if (!this.summaryData) {
				this.isError = true;
				console.warn("Warn [SummaryComp] Invalid initial state");
				return false;
			}

			const initialStatePropertyList = [
				"delivery_options",
				"cart",
				"personal_data",
				"address",
			];

			for (let key in initialStatePropertyList) {
				const value = initialStatePropertyList[key];
				if (!this.summaryData.hasOwnProperty(value)) {
					this.isError = true;
					console.warn("Warn [SummaryComp] Invalid initial state");
					return false;
				}
			}
			return true;
		},

		getBasketItemCount: function (i) {
			const id = this.summaryData["cart"][i - 1].id;
			const basketItem = this.getBasketItemById(id);
			return basketItem["count"] + "x";
		},

		getBasketItemHeader: function (i) {
			const id = this.summaryData["cart"][i - 1].id;
			const basketItem = this.getBasketItemById(id).item;

			const helper = this.$root.$data.helper;
			const localeStr = helper.getLocaleStr();
			const harvestStr = this.$_getHarvestStr(basketItem);
			let resultStr = harvestStr + " " + basketItem.terroir;
			switch (localeStr) {
				case "en":
					resultStr = harvestStr + "th " + basketItem.terroir;
					break;
				case "de":
					resultStr = harvestStr + "er " + basketItem.terroir;
					break;
				case "ru":
					resultStr = harvestStr + "ий " + basketItem.terroir;
					break;

				default:
					console.warn(
						"Warn [SummaryComp::getBasketItemHeader] Unknown locale string"
					);
					break;
			}
			return resultStr;
		},

		$_getHarvestStr: function (basketItem) {
			if (basketItem.harvest) {
				return basketItem.harvest;
			}

			if (basketItem.minHarvest && basketItem.maxHarvest) {
				return `${basketItem.minHarvest} - ${basketItem.maxHarvest}`;
			}

			return "N/A";
		},

		getBasketItemPrice: function (i) {
			const id = this.summaryData["cart"][i - 1].id;
			const basketItem = this.getBasketItemById(id).item;
			if (basketItem.discount > 0.0) {
				return basketItem.formatDiscountPrice + " €";
			}
			return this.$root.helper.getCommaSeparatorDecimal(basketItem.price) + " €";
		},

		getRowClass: function (i) {
			if (i == 1) {
				return "row pb-2 pt-1 align-items-center g-0";
			} else if (i == this.summaryData.cart.length) {
				return "row pb-4 pt-2 align-items-center g-0";
			} else {
				return "row py-2 align-items-center g-0";
			}
		},

		getDeliveryPrice: function () {
			if (this.summaryData.prices["deliveryPrice"] < 0) {
				return 0;
			}
			return this.summaryData.prices["deliveryPrice"];
		},
	},

	computed: {
		getRowQuantity: function () {
			return this.summaryData["cart"].length;
		},

		...mapGetters(["getBasketItemById"]),

		getSubtotalPrice: function () {
			return (
				this.$root.helper.getCommaSeparatorDecimal(
					this.summaryData.prices["subtotalPrice"]
				) + " €"
			);
		},

		getDeliveryPriceStr: function () {
			return (
				this.$root.helper.getCommaSeparatorDecimal(this.getDeliveryPrice()) + " €"
			);
		},

		getSummaryPrice: function () {
			return (
				this.$root.helper.getCommaSeparatorDecimal(
					this.summaryData.prices["subtotalPrice"] + this.getDeliveryPrice()
				) + " €"
			);
		},

		getLFP: function () {
			return this.summaryData["personal_data"].lfp;
		},

		getAddress: function () {
			if (this.summaryData["address"].full_path) {
				return (
					this.summaryData["address"].country +
					", " +
					this.summaryData["address"].full_path +
					" " +
					this.summaryData["address"].zip_code
				);
			} else {
				return (
					this.summaryData["address"].country +
					(this.summaryData["address"].street
						? ", " + this.summaryData["address"].street
						: "") +
					(this.summaryData["address"].building_number
						? ", " + this.summaryData["address"].building_number
						: "") +
					(this.summaryData["address"].zip_code
						? " " + this.summaryData["address"].zip_code
						: "")
				);
			}
		},

		getPaymentOptionStr: function () {
			if (this.summaryData["is_bank_transfer"]) {
				return this.__("common.bankTransfer");
			} else {
				return this.__("common.creditCard");
			}
		},
	},
};
</script>

<style lang="scss" scoped>
.subheader,
.address-header,
.payment-option-header {
	font-family: "steilgut_cormorant", sans-serif;
	color: #000;
	font-style: normal;
}

.subheader,
.payment-option-header {
	text-transform: uppercase;
}

.subheader {
	font-size: calc(0.8em + 1vmin);
	margin: 3vmin 0 2.5vmin 0;
}

.address-header {
	font-size: calc(0.7em + 0.6vmin);
	margin: 2vmin 0 1.5vmin 0;
}

.payment-option-header {
	font-size: calc(0.8em + 0.9vmin);
	text-transform: uppercase;
	margin: 3vmin 0 0 0;
}

.content-main {
	display: flex;
	flex: 1 0 90%;
	max-height: 90%;
	height: 90%;
	/* border: 2px solid #ebcb9a; */
	margin: auto auto auto 0;
}

.external-order-content {
	max-width: 60%;
	width: 60%;
	height: 40%;
	max-height: 40%;
	/* border: 2px solid #ebcb9a; */
}

.order-content {
	max-width: 93%;
	width: 93%;
	height: 100%;
	max-height: 100%;
}

.order-summary {
	border-top: 1px solid #000;
}

.item-quantity,
.item-price {
	max-width: fit-content;
}

.summary-fit-item {
	max-width: fit-content;
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
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.content-main {
		margin: 0 4.7vmin;
	}

	.content-main,
	.order-content {
		height: auto;
		max-height: unset;
	}

	.order-content {
		margin: auto 2vmin auto auto;
	}

	.subheader {
		font-size: calc(1.5em + 0.9vmin);
		margin: 2vh auto;
	}

	.address-header {
		font-size: calc(0.8em + 1vmin);
	}

	.payment-option-header {
		font-size: calc(1em + 1vmin);
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
	.subheader {
		font-size: calc(0.9em + 0.7vmin);
		margin: 3vmin 0 2.5vmin 0;
	}

	.address-header {
		font-size: calc(0.6em + 0.6vmin);
		margin: 1vmin 0 0.5vmin 0;
	}

	.payment-option-header {
		font-size: calc(0.7em + 0.9vmin);
		text-transform: uppercase;
		margin: 1vmin 0 0 0;
	}

	.content-main {
		display: flex;
		flex: 1 0 auto;
		max-height: unset;
		height: auto;
		/* border: 2px solid #ebcb9a; */
		margin: 0 auto 0 0;
		max-height: 70%;
	}

	.external-order-content {
		max-width: 60%;
		width: 60%;
		height: 40%;
		max-height: 40%;
		/* border: 2px solid #ebcb9a; */
	}

	.order-content {
		max-width: 93%;
		width: 93%;
		height: 100%;
		max-height: 100%;
	}

	.order-summary {
		border-top: 1px solid #000;
	}

	.item-quantity,
	.item-price {
		max-width: fit-content;
	}

	.summary-fit-item {
		max-width: fit-content;
	}

	.summary-row {
		font-size: calc(0.6em + 0.6vh);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.content-main {
				max-height: calc(var(--100vh, 1vh) * 70);
			}
		}
	}
}
</style>
