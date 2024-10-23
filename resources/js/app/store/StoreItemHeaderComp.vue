<template>
	<div class="tw-block landscape:tw-flex-grow-1 landscape:tw-flex store-item-header">
		<!-- Desktop/Landscale/Portrait layout -->
		<div
			class="item-row tw-relative tw-cursor-pointer fade-inOut-opacity"
			:class="{ 'zero-opacity': !this.onStage }"
		>
			<div
				class="item-img-container tw-block landscape:tw-flex landscape:tw-m-auto tw-relative"
			>
				<lazy-load-picture
					:keyIndex="itemKey"
					imageClass="store-item-img__sz"
					:image="itemData.image"
					v-on:mouseover.stop="handleMouseOver($event)"
					v-on:mouseleave.stop="handleMouseLeave($event)"
				>
				</lazy-load-picture>
				<!-- <img
					class="item-img tw-block tw-object-contain"
					:src="itemData.image"
					:alt="itemData.title"
					v-on:mouseover.stop="handleMouseOver($event)"
					v-on:mouseleave.stop="handleMouseLeave($event)"
				/> -->
				<v-touch
					class="md:tw-hidden tw-block tw-absolute item-img tw-top-0 tw-left-0"
					v-on:tap.prevent="handleTap($event)"
				>
				</v-touch>
			</div>
			<header
				class="item-header tw-w-1/2 md:tw-w-auto landscape:tw-w-auto tw-flex tw-flex-col tw-items-start tw-justify-center"
			>
				<h2 class="harvest-text">
					{{ getHarvest }}
					<span v-if="!isDELocale()">{{ __("common.year") }}</span>
				</h2>
				<h2 class="title-terroir landscape:tw-hidden">
					{{ itemData.terroir }}
				</h2>
				<h1 class="title">
					{{ getTitle }}
				</h1>
				<div
					class="out-of-stock-header tw-flex"
					v-if="itemData.totalInStock <= 0"
				>
					<h2 class="is-important-header">
						{{ __("store.outOfStockHeader") }}
					</h2>
				</div>

				<div class="price-control-block md:tw-p-0 landscape:tw-p-0 tw-pt-1">
					<div class="price-block tw-block">
						<div v-if="ifDiscountPrice" class="tw-block">
							<span
								class="discount-price-text tw-block landscape:tw-inline-block"
								>{{ getDiscountPrice }} €</span
							>
							<div
								class="cross-price-block tw-block landscape:tw-inline-block tw-relative landscape:tw-mr-0"
							>
								<img
									src="/images/orig/store-pg/mobile/cross-line-icon.svg"
									alt="Cross line for discount"
									class="tw-absolute tw-inset-0 tw-max-w-full tw-w-full tw-max-h-full tw-h-wull"
								/>
								<span class="price-text tw-h-fit-content">{{
									`${itemData.formatPrice} €`
								}}</span>
							</div>
						</div>
						<div v-else>
							<span class="price-text">{{ itemData.formatPrice }} €</span>
						</div>
					</div>
					<div
						class="add-to-basket-panel tw-relative tw-flex tw-flex-col tw-items-stretch tw-justify-center"
					>
						<div
							class="load-indicator tw-absolute tw-z-1 tw-w-full transit-flex-box"
							v-if="isLoading"
						>
							<div
								class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8 fade-inOut-opacity tw-m-auto"
								:class="{ 'tw-opacity-0': !isMoreThan1SecLoading }"
							></div>
						</div>
						<div
							class="add-to-basket-control fade-inOut-opacity tw-relative tw-z-0"
							:class="{
								'tw-opacity-0': isMoreThan1SecLoading,
								'disabled-element': isLoading,
							}"
						>
							<img
								class="store-basket-minus md:tw-m-auto tw-cursor-pointer"
								src="/images/orig/store-pg/store-minus.svg"
								:class="{ 'disabled-element': !ifItemsHasInBasket }"
								alt="Remove from basket"
								@[ifRemoveClickCondition].stop="
									handleRemoveFromBasket($event)
								"
							/>
							<span class="items-in-basket-count">{{
								howManyItemsInBasket()
							}}</span>
							<img
								class="store-basket-plus md:tw-m-auto tw-cursor-pointer tw-object-scale-down"
								:class="{ 'disabled-element': !ifItemHasInStock() }"
								src="/images/orig/store-pg/store-plus.svg"
								alt="Add to basket"
								v-on:click="handleAddToBasket"
							/>
						</div>
					</div>
				</div>
			</header>

			<slot name="tip" v-if="ifTooltip">
				<transition name="fade-tooltip">
					<tooltip-comp
						class="wineset-tooltip"
						:announcement="getTooltipAnnouncement"
						:image="getTooltipImage"
						:position="tooltipPosition"
						v-show="isTooltipVisible"
					></tooltip-comp>
				</transition>
			</slot>
		</div>
	</div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import validationErrors from "../../shared/mixins/validationErrors";
import mediaHelper from "../../shared/mixins/mediaHelper";
export default {
	mixins: [validationErrors, mediaHelper],

	props: {
		itemData: [Object],
		itemKey: [Number, String],
	},

	data: function () {
		return {
			isLoading: false,
			isMoreThan1SecLoading: false,
			isError: false,

			isTooltipVisible: false,
			tooltipPosition: "right",
			tip: this.__("store.tip"),

			onStage: false,
		};
	},

	created() {
		"use strict";
		this.tooltipPosition = this.getTipPosition();
	},

	mounted() {
		"use strict";
		if (this.isMobileDevice()) {
			const helper = this.$root.helper;
			const eventType = helper.getOrientationChangeEventName();
			if (eventType === "change") {
				window.screen.orientation.addEventListener(
					eventType,
					this.orientationStateHandler,
					false
				);
			} else {
				window.addEventListener(eventType, this.orientationStateHandler, false);
			}
		}

		setTimeout(() => {
			this.onStage = true;
		}, 100);
	},

	destroyed() {
		"use strict";
		if (this.isMobileDevice()) {
			const eventType = this.$root.helper.getOrientationChangeEventName();
			if (eventType === "change") {
				window.screen.orientation.removeEventListener(
					eventType,
					this.orientationStateHandler
				);
			} else {
				window.removeEventListener(eventType, this.orientationStateHandler);
			}
		}
	},

	methods: {
		handleItemClick: function (event) {
			this.$emit("click-on-item", event);
		},

		handleRemoveFromBasket: function (event) {
			this.$store.dispatch("removeFromBasket", this.itemData.id);
			this.$emit("decrease-bottle-count", event);
		},

		handleAddToBasket: function (event) {
			"use strict";
			if (!this.ifItemHasInStock()) {
				return;
			}
			this.$store.dispatch("addToBasket", this.itemData);
			this.$emit("increase-bottle-count", event);
		},

		howManyItemsInBasket: function () {
			return this.specificItemsInBasket(this.itemData.id);
		},

		ifItemHasInStock: function () {
			return this.itemData.totalInStock > 0;
		},

		handleMouseOver: _.throttle(
			function (evt) {
				this.isTooltipVisible = true;
			},
			{
				leading: false,
				trailing: true,
			},
			100
		),

		handleMouseLeave: _.throttle(
			function (evt) {
				this.isTooltipVisible = false;
			},
			{
				leading: false,
				trailing: true,
			},
			100
		),

		handleTap: _.throttle(
			function (evt) {
				this.isTooltipVisible = !this.isTooltipVisible;
			},
			{
				leading: false,
				trailing: true,
			},
			100
		),

		orientationStateHandler: function (evt) {
			this.tooltipPosition = this.getTipPosition();
			this.isTooltipDisappearing = false;
		},

		getTipPosition: function () {
			"use strict";
			const key = this.getItemKeyIndex;
			if (this.isPortraitOrientation() || this.isBrowserPortraitOrientation()) {
				return "down";
			}
			return key % 2 === 0 ? "right" : "left";
		},
	},

	computed: {
		...mapState({
			sliderControlCursor: (state) => {
				return state.slider.control.cursor;
			},

			sliderControlTo: (state) => {
				return state.slider.control.to;
			},
		}),

		...mapGetters([
			"specificItemsInBasket",
			"getSliderDataCount",
			"getLoadedDataCount",
			"getSliderControlFrom",
			"getSliderControlTo",
		]),

		ifDiscountPrice: function () {
			return this.itemData.discount > 0.0;
		},

		getDiscountPrice: function () {
			return this.itemData.formatDiscountPrice;
		},

		ifItemsHasInBasket: function () {
			return this.specificItemsInBasket(this.itemData.id) > 0;
		},

		ifAddClickCondition: function () {
			return !this.ifItemHasInStock() || this.isLoading ? null : "click";
		},

		ifRemoveClickCondition: function () {
			return this.isLoading && this.specificItemsInBasket(this.itemData.id) > 0
				? null
				: "click";
		},

		getTitle: function () {
			"use strict";
			return this.itemData && this.itemData.title
				? this.itemData.title.concat(" *")
				: "";
		},

		getTooltipAnnouncement: function () {
			if (this.ifTooltip) {
				return this.itemData.tooltip.announcement;
			}
			return "dummy_tooltip_announcement";
		},

		getTooltipImage: function () {
			if (this.ifTooltip) {
				this.itemData.tooltip.image;
			}
			return "/images/icons/store-pg/tip@2x.svg";
		},

		ifTooltip: function () {
			if (this.itemData.tooltip) {
				if (this.isPortraitOrientation()) {
					return true;
				}
				const index = this.getItemKeyIndex;
				return (
					index >= this.getSliderControlFrom && index <= this.getSliderControlTo
				);
			}
			return false;
		},

		getItemKeyIndex: function () {
			"use strict";
			const keyRegPattern = /(\d+)_sliderItemHeader/;
			let [_, keyIndex] = keyRegPattern.exec(this.itemKey);
			return parseInt(keyIndex);
		},

		getHarvest: function () {
			"use strict";
			if (this.itemData.harvest) {
				return this.itemData.harvest;
			}

			if (this.itemData.minHarvest && this.itemData.maxHarvest) {
				return `${this.itemData.minHarvest} - ${this.itemData.maxHarvest}`;
			}
		},
	},
};
</script>

<style lang="scss">
.store-item-img__sz {
	max-width: 15vw;
	max-width: calc(var(--100nvw, 1vw) * 15);
	max-height: 23vh;
	max-height: calc(var(--100nvh, 1vh) * 23);
}

@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.store-item-img__sz {
		height: 40vh;
		max-height: 40vh;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.store-item-img__sz {
		min-width: 20vw;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.store-item-img__sz {
		min-width: 10vw;
	}
}

@media only screen and (min-width: 320px) and (max-width: 692px) and (orientation: landscape) {
	.store-item-img__sz {
		max-height: 35vh;
		height: 35vh;

		max-height: calc(var(--100vh, 1vh) * 35);
		height: calc(var(--100vh, 1vh) * 35);
	}
}

@media only screen and (min-width: 320px) and (max-width: 568px) and (orientation: landscape) {
	.store-item-img__sz {
		max-height: 35vh;
		height: 35vh;

		max-height: calc(var(--100vh, 1vh) * 35);
		height: calc(var(--100vh, 1vh) * 35);
	}
}
</style>

<style lang="scss" scoped>
.item-row {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	align-items: center;
	justify-content: center;

	font-family: "steilgut_opensans";
	font-weight: 100;

	width: 450px;
}

.item-img-block {
	width: fit-content;
	max-width: fit-content;
	height: 23vh;
	height: calc(var(--100nvh, 1vh) * 23);
	max-height: 23vh;
	max-height: calc(var(--100nvh, 1vh) * 23);
	min-height: calc(var(--100nvh, 1vh) * 23);
}

.item-img {
	max-width: 15vw;
	max-width: calc(var(--100nvw, 1vw) * 15);
	max-height: 23vh;
	max-height: calc(var(--100nvh, 1vh) * 23);
}

.item-header {
	color: #313131;
	flex-grow: 1;
	margin-left: 3vw;
	margin-left: calc(var(--100nvw, 1vw) * 3);
}

.item-header h1,
h2,
.out-of-stock-header,
.total-in-stock-header {
	width: 100%;
	text-align: left;
	margin: 0.2rem auto;
	margin: calc(0.1rem + var(--100nvh, 1vh) * 0.2) auto;
}

.item-header h1 {
	font-size: calc(1rem + 0.4vh);
	font-size: calc(1rem + var(--100nvh, 1vh) * 0.4);
	font-family: "steilgut_opensans";
	font-weight: 100;
	color: #313131;
}

.item-header h2 {
	font-size: calc(0.7rem + 0.5vh);
	font-size: calc(0.7rem + var(--100nvh, 1vh) * 0.5);
}

.price-control-block > .price-text {
	font-size: 1rem;
}

.price-control-block {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	justify-content: center;
	align-content: center;

	margin: 1rem auto auto 0;
	margin: calc(0.5rem + var(--100nvh, 1vh)) auto auto 0;
}

.price-block {
	flex-grow: 1;

	margin: auto 1vw auto 0;
	margin: auto calc(var(--100nvw, 1vw)) auto 0;
}

.add-to-basket-control {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	justify-content: space-evenly;
	align-content: center;

	height: fit-content;
	width: fit-content;
}

.items-in-basket-count {
	margin: auto 1vw auto 1vw;
	margin: auto calc(var(--100nvw, 1vw)) auto calc(var(--100nvw, 1vw));
}

.add-to-basket-control > .items-in-basket-count {
	font-size: 1rem;
}

.store-basket-minus,
.store-basket-plus {
	max-width: 30px;
	width: 30px;

	max-height: 30px;
	height: 30px;
}

.price-text,
.discount-price-text {
	font-size: calc(0.8rem + 0.5vh);
	font-size: calc(0.8rem + var(--100nvh, 1vh) * 0.5);
}

.fade-tooltip-enter-active,
.fade-tooltip-leave-active {
	transition: all 1s;
	transition-timing-function: ease-in-out;
}
.fade-tooltip-enter, .fade-tooltip-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
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
	.item-img {
		height: 40vh;
		max-height: 40vh;
	}

	.item-row {
		width: auto;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.item-header {
		margin: auto 0 auto 7vw;
	}

	.price-block {
		margin: auto 7vh auto 0;
	}

	.price-control-block {
		margin: 2vh auto auto 0;
	}

	.item-row {
		margin: auto 7vw auto 7vw;
	}

	.items-in-basket-count {
		margin: auto 3vw auto 3vw;
	}

	.add-to-basket-control img {
		display: block;
		margin: auto;
	}

	.items-in-basket-count {
		margin: auto 2vw;
	}

	.item-header > h1,
	.item-header > h2 {
		margin: 1vh 0;
	}

	.total-in-stock-header,
	.out-of-stock-header {
		margin: 1.1vh 0;
	}

	.item-header h1 {
		font-size: calc(1rem + 0.9vw);
	}

	.item-header h2 {
		font-size: calc(1rem + 0.6vw);
	}

	.item-header .total-in-stock-header h2,
	.item-header .out-of-stock-header h2 {
		font-size: calc(0.9rem + 0.5vw);
	}

	.price-text,
	.discount-price-text {
		font-size: calc(1rem + 0.5vh);
	}

	.price-text {
		display: block;
		max-width: 20vw;
	}

	.item-img-container,
	.item-img {
		min-width: 20vw;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.store-item-header {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		align-items: stretch;
		justify-content: center;
		max-width: 100%;
		/* border: 2px solid #ebcb9a; */
	}

	.item-row {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		align-items: stretch;
		justify-content: center;
	}

	.price-control-block {
		flex-direction: column;
		justify-content: flex-end;
		margin: 0 auto 0 0;
	}

	.item-header > h1,
	.item-header > h2 {
		margin: 1vh 0;
		margin: var(--100vh, 1vh);
	}

	.total-in-stock-header,
	.out-of-stock-header {
		margin: 1vh 0;
		margin: var(--100vh, 1vh);
	}

	.add-to-basket-control {
		width: 100%;
		max-width: 100%;
	}

	.add-to-basket-control img {
		display: block;
		margin: auto;
	}

	.items-in-basket-count {
		margin: auto 2vw;
	}

	.item-header {
		margin: auto auto auto 3vw;
	}

	.item-header h1 {
		font-size: calc(1rem + 0.7vh);
		font-size: calc(1rem + var(--100vh, 1vh) * 0.7);
	}

	.item-header h2 {
		font-size: calc(0.9rem + 0.4vh);
		font-size: calc(0.9rem + var(--100vh, 1vh) * 0.4);
	}

	.item-header .total-in-stock-header h2,
	.item-header .out-of-stock-header h2 {
		font-size: calc(0.7rem + 0.3vh);
		font-size: calc(0.7rem + var(--100vh, 1vh) * 0.3);
	}

	.price-text,
	.discount-price-text {
		font-size: calc(0.9rem + 0.5vh);
		font-size: calc(0.9rem + var(--100vh, 1vh) * 0.5);
	}

	.add-to-basket-panel {
		margin-top: 1vh;
		margin-top: var(--100vh, 1vh);
	}

	.store-basket-minus,
	.store-basket-plus {
		width: 32px;
		width: 32px;
		max-width: unset;
		height: auto;
		max-height: unset;
	}

	.item-img-container,
	.item-img {
		min-width: 10vw;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.store-basket-minus,
			.store-basket-plus {
				width: min(max(9vh, 30px), 32px);
				width: min(max(calc(var(--100vh, 1vh) * 9), 30px), 32px);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 692px) and (orientation: landscape) {
	.item-img {
		max-height: 35vh;
		height: 35vh;

		max-height: calc(var(--100vh, 1vh) * 35);
		height: calc(var(--100vh, 1vh) * 35);
	}

	.item-header > h1,
	.item-header > h2 {
		margin: 0.8vh 0;
		margin: calc(var(--100vh, 1vh) * 0.8) 0;
	}

	.total-in-stock-header,
	.out-of-stock-header {
		margin: 0.8vh 0;
		margin: calc(var(--100vh, 1vh) * 0.8) 0;
	}

	.item-header h1 {
		font-size: calc(0.7rem + 0.7vh);
		font-size: calc(0.7rem + var(--100vh, 1vh) * 0.7);
	}

	.item-header h2 {
		font-size: calc(0.7rem + 0.4vh);
		font-size: calc(0.7rem + var(--100vh, 1vh) * 0.4);
	}

	.item-header .total-in-stock-header h2,
	.item-header .out-of-stock-header h2 {
		font-size: calc(0.5rem + 0.3vh);
		font-size: calc(0.5rem + var(--100vh, 1vh) * 0.3);
	}

	.price-text,
	.discount-price-text {
		font-size: calc(0.8rem + 0.5vh);
		font-size: calc(0.8rem + var(--100vh, 1vh) * 0.5);
	}

	.add-to-basket-panel {
		margin-top: 1vh;
		margin-top: var(--100vh, 1vh);
	}

	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 568px) and (orientation: landscape) {
	.item-img {
		max-height: 35vh;
		height: 35vh;

		max-height: calc(var(--100vh, 1vh) * 35);
		height: calc(var(--100vh, 1vh) * 35);
	}

	// .store-basket-minus,
	// .store-basket-plus {
	// 	width: 8vh;
	// 	height: 8vh;

	// 	width: calc(var(--100vh, 1vh) * 8);
	// 	height: calc(var(--100vh, 1vh) * 8);
	// }

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 1025px) and (max-height: 640px) and (-webkit-min-device-pixel-ratio: 1) {
	.item-header h1,
	.price-text,
	.add-to-basket-control {
		font-size: calc(0.7rem + 0.4vmin);
		font-size: calc(0.7rem + var(--100nvmin, 1vmin) * 0.4);
	}

	.item-header h2 {
		font-size: calc(0.5rem + 0.4vmin);
		font-size: calc(0.5rem + var(--100nvmin, 1vmin) * 0.4);
	}

	.store-basket-minus,
	.store-basket-plus {
		max-width: 20px;
		max-height: 20px;
	}

	.total-in-stock-header {
		margin: calc(0.4rem + 0.6vmin) 0;
		margin: calc(0.4rem + var(--100nvmin, 1vmin) * 0.6) 0;
	}
}
</style>
