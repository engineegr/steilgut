<template>
	<div class="cart">
		<div v-if="isError" class="tw-fixed tw-z-20 tw-left-0">
			<error-comp></error-comp>
		</div>
		<div
			v-show="isLoading"
			class="tw-absolute fade-inOut-opacity tw-w-full tw-h-full tw-z-20"
		>
			<div
				class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8 fade-inOut-opacity tw-m-auto tw-absolute tw-top-1/2 tw-left-1/2"
			></div>
			<button
				class="tw-fixed tw-z-20 tw-inset-0 tw-h-sreen tw-w-screen tw-min-w-screen focus:tw-outline-none tw-cursor-default background-mask-black-0_3"
			></button>
		</div>
		<div class="transit-flex-box">
			<!-- Desktop -->
			<div class="cart-body md:tw-flex landscape:tw-hidden tw-hidden">
				<div class="cart-header tw-flex">
					<div class="cart-header-general tw-flex">
						<slot name="mdCartHeader">
							<section class="header-paragraph">
								<div class="header-underline">
									<h1 class="header-text">
										{{ __("cart.header") }}
									</h1>
									<img
										class="title-underline-img"
										src="/images/icons/basket-pg/header-underscore-line.svg"
									/>
								</div>
							</section>
							<div class="arrow-control">
								<div v-if="from > 0">
									<a
										class="left-arrow"
										v-on:click="$_handleDecreaseCartList($event)"
									>
										<img
											src="/images/icons/basket-pg/left-arrow.svg"
											alt="Prev"
										/>
									</a>
								</div>
								<div v-if="to < getSliderDataCount - 1">
									<a
										class="right-arrow"
										v-on:click="$_handleIncreaseCartList($event)"
									>
										<img
											src="/images/icons/basket-pg/right-arrow.svg"
											alt="Prev"
										/>
									</a>
								</div>
							</div>
						</slot>
					</div>

					<slot name="mdCartHeaderAddition"></slot>
				</div>

				<div class="cart-main tw-flex">
					<div v-if="getSliderDataCount > 0" class="tw-flex transit-flex-box">
						<slot
							name="mdCartMain"
							v-bind:itemData="sliderData"
							v-bind:from="from"
							v-bind:to="to"
							v-bind:cursor="cursor"
							v-bind:itemQuantityPerPage="getSliderItemQuantityPerPage"
							v-bind:getSliderItemDataByKeyCallback="getSliderItemDataByKey"
						>
						</slot>
					</div>
					<div
						class="cart-main__empty-card__text tw-text-steilgut-text-brown"
						v-else
					>
						<!-- eslint-disable vue/no-v-html -->
						<div v-html="__('cart.emptyCartAnnouncement')"></div>
						<!--eslint-enable-->
					</div>
				</div>

				<div
					class="cart-footer tw-flex tw-border-mt-bg-brown tw-border-t"
					v-if="getSliderDataCount > 0"
				>
					<slot name="mdCartFooter">
						<span class="summary-title">
							<h1 class="summary-text">
								{{ __("cart.summary") }}:
								{{
									$root.helper.getCommaSeparatorDecimal(
										summaryPriceInBasket
									)
								}}
								€
							</h1>
						</span>
						<router-link
							class="goto-order-accept-btn accept-button tw-flex tw-justify-items-center tw-items-center tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
							:class="{
								'disabled-element': !ifCanMakeOrder,
								'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': ifCanMakeOrder,
							}"
							:disabled="!ifCanMakeOrder"
							:event="ifCanMakeOrder ? 'click' : ''"
							to="/masthead/order/delivery"
							><span class="goto-order-container">
								<h2 class="goto-order-text">
									{{ __("cart.submitOrder") }}
								</h2>
							</span>
							<div class="goto-order-arrow">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="18"
									height="15"
									viewBox="0 0 18 15"
									preserveAspectRatio="none"
								>
									<path
										fill="currentColor"
										d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
										transform="translate(0 .213)"
									/>
								</svg>
							</div>
						</router-link>
					</slot>
				</div>
			</div>

			<!-- Portrait -->
			<div class="cart-body tw-flex landscape:tw-hidden md:tw-hidden">
				<div class="cart-header tw-flex">
					<slot
						name="portraitCartHeader"
						v-bind:itemQuantity="getSliderDataCount"
					>
					</slot>
				</div>

				<div class="cart-main tw-flex tw-relative">
					<slot
						name="portraitCartMain"
						v-bind:itemData="sliderData"
						v-bind:from="from"
						v-bind:to="to"
						v-bind:cursor="cursor"
						v-bind:itemQuantity="getSliderDataCount"
						v-bind:itemQuantityPerPage="getSliderItemQuantityPerPage"
						v-bind:getSliderItemDataByKeyCallback="getSliderItemDataByKey"
					>
					</slot>
				</div>

				<div class="cart-footer tw-flex" v-if="getSliderDataCount > 0">
					<slot name="portraitCartFooter">
						<footer
							class="cart-footer-block tw-relative tw-block tw-z-2 tw-ml-4 tw-border-mt-bg-brown tw-border-t"
						>
							<span class="summary-title-block">
								<h1 class="summary-text tw-text-black">
									{{ __("cart.summary") }}:
									{{
										$root.helper.getCommaSeparatorDecimal(
											summaryPriceInBasket
										)
									}}
									€
								</h1>
							</span>
							<router-link
								class="goto-order-accept-btn accept-button tw-flex tw-justify-between tw-items-center tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
								:class="{
									'disabled-element': !ifCanMakeOrder,
									'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': ifCanMakeOrder,
								}"
								:disabled="!ifCanMakeOrder"
								:event="ifCanMakeOrder ? 'click' : ''"
								to="/masthead/order/delivery"
								><span class="goto-order-container">
									<h2 class="goto-order-text">
										{{ __("cart.submitOrder") }}
									</h2>
								</span>
								<img
									class="goto-order-arrow"
									src="/images/icons/cart-pg/right-arrow.png"
									alt="Go to order arrow"
								/>
							</router-link>
						</footer>
					</slot>
				</div>
			</div>

			<!-- Landscape -->
			<div class="cart-body tw-hidden landscape:tw-flex md:tw-hidden">
				<div class="cart-header tw-flex">
					<div class="cart-header-general tw-flex">
						<slot name="landscapeCartHeader">
							<section class="header-paragraph">
								<div class="header-underline">
									<h1 class="header-text">
										{{ __("cart.header") }}
									</h1>
									<img
										class="title-underline-img"
										src="/images/icons/basket-pg/header-underscore-line.svg"
									/>
								</div>
							</section>
							<div class="arrow-control">
								<div v-if="from > 0">
									<a
										class="left-arrow"
										v-on:click="$_handleDecreaseCartList($event)"
									>
										<img
											src="/images/icons/basket-pg/left-arrow.svg"
											alt="Prev"
										/>
									</a>
								</div>
								<div v-if="to < getSliderDataCount - 1">
									<a
										class="right-arrow"
										v-on:click="$_handleIncreaseCartList($event)"
									>
										<img
											src="/images/icons/basket-pg/right-arrow.svg"
											alt="Prev"
										/>
									</a>
								</div>
							</div>
						</slot>
					</div>

					<slot name="mdCartHeaderAddition"></slot>
				</div>

				<div class="cart-main tw-flex">
					<div v-if="getSliderDataCount > 0" class="tw-flex transit-flex-box">
						<slot
							name="landscapeCartMain"
							v-bind:itemData="sliderData"
							v-bind:from="from"
							v-bind:to="to"
							v-bind:cursor="cursor"
							v-bind:itemQuantity="getSliderDataCount"
							v-bind:itemQuantityPerPage="getSliderItemQuantityPerPage"
							v-bind:getSliderItemDataByKeyCallback="getSliderItemDataByKey"
						>
						</slot>
					</div>
					<div v-else>
						<!-- eslint-disable vue/no-v-html -->
						<div
							class="tw-text-steilgut-text-brown empty-cart-warning-text"
							v-html="__('cart.emptyCartAnnouncement')"
						></div>
						<!-- eslint-enable -->
					</div>
				</div>

				<div
					class="cart-footer tw-flex tw-border-mt-bg-brown tw-border-t"
					v-if="getSliderDataCount > 0"
				>
					<slot name="landscapeCartFooter">
						<span class="summary-title">
							<h1 class="summary-text">
								{{ __("cart.summary") }}:
								{{
									$root.helper.getCommaSeparatorDecimal(
										summaryPriceInBasket
									)
								}}
								€
							</h1>
						</span>

						<router-link
							class="goto-order-accept-btn accept-button tw-flex tw-justify-items-center tw-items-center tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
							:class="{
								'disabled-element': !ifCanMakeOrder,
								'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': ifCanMakeOrder,
							}"
							:disabled="!ifCanMakeOrder"
							:event="ifCanMakeOrder ? 'click' : ''"
							to="/masthead/order/delivery"
							><span class="goto-order-container tw-inline-block">
								<h2 class="goto-order-text">
									{{ __("cart.submitOrder") }}
								</h2>
							</span>
							<div class="goto-order-arrow tw-inline-block">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="18"
									height="15"
									viewBox="0 0 18 15"
									preserveAspectRatio="none"
								>
									<path
										fill="currentColor"
										d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
										transform="translate(0 .213)"
									/>
								</svg>
							</div>
						</router-link>
					</slot>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import mediaHelper from "../mixins/mediaHelper";
import storeCartSlider from "../mixins/storeCartSlider";
import { mapState, mapGetters } from "vuex";
import { SliderHelper } from "../utils/slider";
import PulseLogoComp from "./PulseLogoComp";

export default {
	mixins: [mediaHelper, storeCartSlider],

	components: {
		"pulse-logo-comp": PulseLogoComp,
	},

	data: function () {
		return {
			isLoading: false,
			isError: false,
		};
	},

	created() {
		"use strict";
		// debugger;
		this.typeMark = "Cart";
		console.log("Debug [CartSliderComp::created] Enter the function");
		this.$store.commit("resetSlider");
		this.$root.helper.addStyleClassToBody("light-bg");
		// change settings for the content when it changes orientation
		window.addEventListener("resize", this.$_handleResize);
		this.$_updateSlider();
		this.isLoading = true;
		this.$store.dispatch("syncCart").then((isSuccess) => {
			this.isLoading = false;
			if (isSuccess) {
				this.$_updateSlider();
			} else {
				this.isError = true;
			}
		});
	},

	destroyed() {
		"use strict";
		console.log("Debug [CartSliderComp:destroyed] destroyed");
		document.removeEventListener("touchmove", this.$_handleMove);
		document.removeEventListener("touchmove", this.$_handleLandscapeTouchStart);
		document.removeEventListener("touchmove", this.$_handleLandscapeMove);
		window.removeEventListener("resize", this.$_handleResize);
		this.$root.helper.removeStyleClassFromBody("light-bg");
	},

	computed: {
		...mapGetters(["getBasketItemListClone", "ifCanMakeOrder"]),

		ifMakeOrderClickCondition: function () {
			return this.ifCanMakeOrder ? "click" : null;
		},
	},

	methods: {
		$_updateSlider: function () {
			const clonedItemsFromCart = this.getBasketItemListClone;
			this.$store.commit("setSliderData", clonedItemsFromCart);
			this.$store.commit("setSliderDataCount", clonedItemsFromCart.length);
			this.$_updateSliderMode();
			this.$_resetCounts();
		},
	},
};
</script>

<style lang="scss" scoped>
h1.header-text {
	color: #313131;
	font-size: 2rem;
	font-size: calc(1rem + var(--100nvh, 1vh) * 2.5);
}

.summary-text,
h2.product-count-precaution {
	font-size: 1rem;
	font-size: calc(1rem + var(--100nvh, 1vh) * 1.5);
	font-family: "steilgut_opensans";
	font-weight: 100;

	color: #313131;
	margin: 0.5rem auto;

	text-align: center;

	height: fit-content;
	text-transform: capitalize;
}

.cart,
.cart-body {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	align-items: stretch;
	/* border: 2px solid #ebcb9a; */
}

.cart-header,
.cart-footer {
	display: flex;
	align-items: stretch;
}

.cart-header {
	flex: 0 0 12%;
	flex-direction: column;
	/* border: 2px solid #ebcb9a; */
}

.cart-header-general {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	align-items: stretch;
}

.cart-footer {
	flex: 0 0 11%;
	justify-content: space-between;
}

.header-underline {
	padding-top: 2.4444vh;
	padding-top: calc(var(--100nvh, 1vh) * 2.4444);
}

.cart-footer {
	flex-direction: row;
}

.cart-main {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	align-items: stretch;
	/* border: 2px solid #ebcb9a; */
}

.summary-title {
	max-height: fit-content;
	max-width: fit-content;
}

.summary-text,
.goto-order-accept-btn {
	margin: 1.3vmin 0 0 0;
	margin: calc(var(--100nvmin, 1vmin) * 1.3) 0 0 0;
}

.arrow-control {
	display: flex;
	flex-direction: row;
	justify-content: center;
	align-content: center;
	margin: auto 0 auto auto;
}

.arrow-control .left-arrow,
.right-arrow {
	width: 33px;
	max-width: 33px;
	height: 33px;
	max-height: 33px;
}

.arrow-control .left-arrow {
	margin-right: 1vw;
	margin-right: calc(var(--100nvw, 1vw));
}

.goto-order-accept-btn {
	font-family: "steilgut_opensans";
	font-weight: 100;
	font-size: 1rem;
	font-size: 2vmin;
	font-size: calc(var(--100nvmin, 1vmin) * 2);
	color: #313131;
	height: fit-content;
	width: fit-content;
	padding: 1vmin;
	padding: calc(var(--100nvmin, 1vmin));
}

.goto-order-arrow {
	margin: auto auto auto 1vmin;
	margin: auto auto auto var(--100nvmin, 1vmin);
}

.goto-order-arrow svg {
	max-width: calc(0.4rem + 1.5vh);
	max-width: calc(0.4rem + calc(var(--100nvh, 1vh) * 1.5));
}

.goto-order-container {
	max-height: min-content;
	margin: auto 0;
}

.background-mask-black-0_3 {
	background-color: rgba(0, 0, 0, 0.3);
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
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.cart-footer-block {
		height: 10%;
		min-height: 10%;
		width: 88%;
		max-width: 88%;

		margin: 2vh 3vw auto auto;
		padding: 3vh 0;
	}

	.summary-text,
	.goto-order-accept-btn {
		font-size: calc(1rem + 0.5vh);
	}

	.summary-text,
	.goto-order-accept-btn {
		margin: 1.3vmin 0 0 0;
	}

	// .goto-order-accept-btn {
	// 	padding: 1vmin 2vmin;
	// }

	h1.summary-text {
		display: block;
		text-align: left;
		padding-bottom: 3vh;
		font-size: calc(1rem + 3vmin);
	}

	.goto-order-accept-btn {
		padding: 1.75vh 3vh;
		width: 80%;
	}

	h2.goto-order-text {
		padding-right: 2vh;
	}

	.goto-order-arrow {
		width: 18px;
		height: 14px;
		display: block;
		margin: auto;
		margin-right: 0;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.cart {
		position: relative;
		flex: 0 0 93%;
		margin: auto 0;
		/* margin-top: calc(-1 * var(--100vh, 1) * 20); */
	}

	.header-underline {
		width: min-content;
	}

	.header-underline h1.header-text {
		font-size: 6vmin;
		font-size: calc(var(--100vh, 1vh) * 7);
		margin: 0 auto 1vmin auto;
		margin: 0 auto calc(var(--100vh, 1vh) * 1) auto;
		width: fit-content;
	}

	.arrow-control {
		margin: auto 0 auto auto;
	}

	.arrow-control .left-arrow {
		margin-right: 3vmin;
	}

	.arrow-control .left-arrow,
	.arrow-control .right-arrow {
		width: 6vmin;
		height: 6vmin;
	}

	.summary-text,
	.goto-order-accept-btn {
		font-size: 1rem;
		font-size: calc(var(--100vh, 1vh) * 4);
	}

	.summary-text,
	.goto-order-accept-btn {
		margin: 1.3vmin 0 0 0;
		margin: calc(var(--100vh, 1vh) * 1.3) 0 0 0;
	}

	.goto-order-accept-btn {
		padding: 1vmin 2vmin;
		padding: calc(var(--100vh, 1vh) * 1) calc(var(--100vh, 1vh) * 3);
	}

	.goto-order-arrow {
		max-height: fit-content;
		max-width: fit-content;
		max-width: calc(var(--100vh, 1vh) * 6);
		margin: auto 0 auto 3vmin;
		margin: auto 0 auto calc(var(--100vh, 1vh) * 3);
	}

	.goto-order-arrow svg {
		max-height: 9px;
		max-width: 10px;
	}

	.cart-header-general {
		margin-right: 14vmin;
	}
	.empty-cart-warning-text {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		font-size: calc(var(--100vh, 1vh) * 5);
	}
}

@media only screen and (min-width: 320px) and (max-width: 680px) and (orientation: landscape) {
	h2.product-count-precaution {
		max-width: 96px;
	}
}

@media only screen and (min-width: 897px) and (max-height: 620px) {
	h1.header-text,
	.summary-text,
	.accept-button {
		font-size: calc(1rem + 1.4vmin);
		font-size: calc(1rem + var(--100nvmin, 1vmin) * 1.4);
	}

	.store-item-list-block {
		flex: 1 1 67%;
		height: 67%;
		min-height: 67%;
		margin: 0 3vw 0 auto;
		margin: 0 calc(var(--100nvw, 1vw) * 3) 0 auto;
	}

	.store-item-list {
		grid-template-columns: repeat(2, 45%);
		grid-template-rows: repeat(2, 45%);
	}

	.store-footer-block {
		height: 7%;
		min-height: 7%;
		margin: 1vh 3vw auto auto;
		margin: auto calc(var(--100nvw, 1vw) * 3) calc(var(--100nvh, 1vh) * 2) auto;
	}

	h2.product-count-precaution,
	.summary-text {
		margin: 1vmin auto;
		margin: var(--100nvw, 1vw) auto;
	}

	.goto-cart-btn {
		margin: var(--100nvw, 1vw) 0 auto auto;
	}

	.accept-button,
	h2.product-count-precaution {
		font-size: calc(0.7rem + 0.3vmin);
		font-size: calc(0.7rem + var(--100nvw, 1vw) * 0.3);
	}

	h2.additional-note-text {
		font-size: calc(0.6rem + 0.5vmin);
		font-size: calc(0.6rem + var(--100nvmin, 1vmin) * 0.5);
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.goto-order-arrow:hover svg path {
		fill: #ebcb9a;
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (min-aspect-ratio: 16/10) {
	/* Styles */
	.goto-order-arrow:hover svg path {
		fill: #ebcb9a;
	}

	.cart-main__empty-card__text {
		padding-top: min(max(3.9vh, 40px), 52px);
		width: min(max(37.56vw, 541px), 600px);
		font-size: 16px;
		text-transform: unset;
		font-size: 16px;
		font-weight: 300;
		font-style: normal;
		letter-spacing: normal;
		line-height: normal;
		text-align: left;
	}
}
</style>
