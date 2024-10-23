<template>
	<div
		class="store-slider store-slider-safari-only tw-w-full tw-max-w-full tw-relative md:tw-static landscape:tw-absolute landscape:tw-w-screen landscape:tw-overflow-y-hidden portrait-non-fp landscape-fp"
	>
		<slider
			:calcCountRequestExpression="calcCountRequestExpression"
			:calcRangeDataRequestExpression="calcRangeDataRequestExpression"
			itemBackgroundHidden="true"
			:mobileViewHidden="false"
			mdItemBlockStyleClass="md:tw-block md-store-items-block"
			itemBlockStyleClass="store-items-block"
			landscapeItemBlockStyleClass="landscape:tw-flex ls-store-items-block"
			:showLoading="false"
			:stopLoadingAsyncFn="stopLoadingAsyncFn"
			:mdStopLoadingCallback="mdStopLoadingPostProcess"
			:stopLoadingCallback="stopLoadingPostProcess"
			:landscapeStopLoadingCallback="landscapeStopLoadingPostProcess"
			ref="slotProps"
		>
			<!-- Desktop layout -->
			<template v-slot:mdItemListView="slotProps">
				<lazy-load-image-comp
					atSurfaceZindexStyleClass="tw-z-0"
					zIndexStyleClass="tw-z-0"
					basedLazyImgStyleClass="desktop-bg-store-pg-img"
					relativePath="store-pg"
					baseName="bg-store-pg"
					commonImgStyleClass=""
					lazyLoadImgStyleClass_16_9=""
					lazyLoadImgStyleClass_4_3=""
					basedLandscapeLazyImgStyleClass=""
					basedPortraitLazyImgStyleClass=""
					transitionImgStyleClass_16_9="fade-inOut-opacity"
					transitionImgStyleClass_4_3="fade-inOut-opacity"
					lqipPath_4_3="/images/4_3/store-pg/lqip_4_3/jpg/4_3-lqip-bg-store-pg.jpg"
					lqipPath_16_9="/images/16_9/store-pg/lqip_16_9/jpg/16_9-lqip-bg-store-pg.jpg"
					lazyLoadCommonImgStyleClass="tw-absolute tw-object-cover tw-inset-0"
				></lazy-load-image-comp>
				<header
					class="store-header-block store-header-block-safari-only tw-relative tw-flex tw-z-4 tw-flex-row tw-content-center tw-justify-start"
				>
					<div class="header-title">
						<div
							class="header-underline tw-w-fit-content tw-max-w-fit-content"
						>
							<h1 class="header-text">
								{{ __("store.title") }}
							</h1>
							<img
								class="title-underline-img"
								src="/images/icons/store-pg/header-underscore-line.svg"
							/>
						</div>
						<store-filter
							class="store-filter"
							v-on:select-filtered-item="handleSelectFilterItem"
							v-on:reset-filtered-item="handleResetFilterItem"
						></store-filter>
					</div>
					<div class="arrow-control">
						<div v-if="getSliderControlFrom > 0">
							<a
								class="left-arrow"
								v-on:click="
									handleDecreaseCursor(
										$event,
										slotProps.handleDecreaseListCallback
									)
								"
							>
								<img
									src="/images/orig/store-pg/left-arrow.svg"
									alt="Prev"
								/>
							</a>
						</div>
						<div v-if="to < getSliderDataCount - 1">
							<a
								class="right-arrow"
								v-on:click="
									handleIncreaseCursor(
										$event,
										slotProps.handleIncreaseListCallback
									)
								"
							>
								<img
									src="/images/orig/store-pg/right-arrow.svg"
									alt="Prev"
								/>
							</a>
						</div>
					</div>
					<div
						class="header tw-flex tw-flex-row tw-content-center tw-justify-between"
					></div>
				</header>

				<main
					class="store-item-list-block store-item-list-block-safari-only tw-relative tw-z-3 tw-flex"
				>
					<div v-if="isEmptyLoadedItemResult">
						<h1 class="centered-msg tw-text-steilgut-history-text-gold">
							{{ __("formalMessages.emptyLoadedResultMsg") }}
						</h1>

						<div class="additional-note-container tw-absolute tw-bottom-0">
							<h2 class="additional-note-text">
								{{ __("store.sulfiteNote") }}
							</h2>
							<h2
								class="whole-sale-header-text additional-note-text"
								v-if="ifAnyProductAbsent"
							>
								{{ __("store.wholeSaleHeader") }}
							</h2>
						</div>
					</div>
					<div v-else class="store-item-list">
						<div
							v-for="i in slotProps.itemQuantityPerPage"
							:key="`${slotProps.from + i - 1}_storeSliderItem_desktop`"
							class="tw-block"
						>
							<store-item-header
								v-if="getSliderItemDataByKey({ i })"
								:itemData="getSliderItemDataByKey({ i })"
								:itemKey="`${
									slotProps.from + i - 1
								}_sliderItemHeader_desktop`"
								v-on:increase-bottle-count="handleChangeBottleCount"
								v-on:decrease-bottle-count="handleChangeBottleCount"
							>
							</store-item-header>
						</div>
					</div>
					<div
						class="additional-note-container"
						v-if="!isEmptyLoadedItemResult"
					>
						<h2 class="additional-note-text">
							{{ __("store.sulfiteNote") }}
						</h2>
						<h2
							class="whole-sale-header-text additional-note-text"
							v-if="ifAnyProductAbsent"
						>
							{{ __("store.wholeSaleHeader") }}
						</h2>
					</div>
				</main>

				<footer
					class="store-footer-block tw-relative tw-flex tw-z-3 tw-flex-row tw-items-center tw-justify-between tw-border-mt-bg-brown tw-border-t"
				>
					<span class="summary-title">
						<h1 class="summary-text">
							{{ __("store.summary") }}:
							{{
								$root.helper.getCommaSeparatorDecimal(
									summaryPriceInBasket
								)
							}}
							€
						</h1>
					</span>

					<h2 class="product-count-precaution">
						{{ __("store.minimumOrder") }}
					</h2>
					<router-link
						class="goto-cart-btn tw-flex tw-justify-items-center tw-items-center accept-button tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
						:class="{
							'disabled-element': !isMinimumCount,
							'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': isMinimumCount,
						}"
						to="/masthead/wines-cart"
						v-on:click.prevent="handleSubmitOrder($event)"
						>{{ __("store.submitOrder") }}
						<div class="goto-cart-arrow">
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
				</footer>
			</template>

			<!-- Phone portrait layout -->
			<template v-slot:itemListView="slotProps">
				<header class="tw-relative tw-z-3 store-header-block">
					<div
						class="tw-relative tw-z-1 tw-overflow-hidden tw-w-full tw-max-w-full"
					>
						<img
							src="/images/xs/store-pg/xs-bg-store-up-side.png"
							srcset="
								/images/xs/store-pg/xs-bg-store-up-side.png,
								/images/xs/store-pg/xs-2x-bg-store-up-side.png 2x
							"
							class="tw-relative tw-z-n-1 tw-inset-0 tw-object-cover tw-w-full tw-max-w-full tw-h-full"
						/>
						<div
							class="header-block tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-py-2 tw-px-4"
						>
							<h1 class="header-text">{{ __("store.title") }}</h1>
							<img
								class="title-underline-img"
								src="/images/icons/cart-pg/white-header-underscore-line.svg"
							/>
						</div>
					</div>
					<background-shadow-comp
						class="tw-absolute"
						zIndexClass="tw-z-1"
					></background-shadow-comp>
				</header>

				<main class="store-item-list-block tw-relative tw-z-3">
					<img
						src="/images/xs/store-pg/xs-bg-store-down-side.png"
						srcset="
							/images/xs/store-pg/xs-bg-store-down-side.png,
							/images/xs/store-pg/xs-2x-bg-store-down-side.png 2x
						"
						class="tw-absolute tw-z-1 tw-inset-0 tw-left-0 tw-object-cover tw-w-full tw-max-w-full"
					/>

					<store-filter
						:isMinimumConditionProp="isMinimumCount"
						v-on:open-filter="handleFilterOpenning"
						class="tw-relative tw-top-0 tw-left-0 tw-z-2 tw-py-2"
						v-on:select-filtered-item="handleSelectFilterItem"
						v-on:reset-filtered-item="handleResetFilterItem"
					/>
					<template v-if="!isFilterOpenned">
						<div v-if="isEmptyLoadedItemResult" class="centered-msg-block">
							<h1 class="centered-msg tw-text-steilgut-history-text-gold">
								{{ __("formalMessages.emptyLoadedResultMsg") }}
							</h1>
						</div>
						<div
							v-else
							class="store-item-list tw-flex tw-w-full tw-max-w-full tw-h-auto tw-relative tw-z-2"
						>
							<div
								v-for="i in getSliderItemQuantityPerPage"
								:key="`${
									slotProps.from + i - 1
								}_storeSliderItem_portrait`"
								class="store-item"
							>
								<store-item-header
									v-if="getSliderItemDataByKey({ i })"
									:itemData="getSliderItemDataByKey({ i })"
									:itemKey="`${
										slotProps.from + i - 1
									}_sliderItemHeader_portrait`"
									v-on:increase-bottle-count="handleChangeBottleCount"
									v-on:decrease-bottle-count="handleChangeBottleCount"
								>
								</store-item-header>
							</div>
						</div>

						<div
							class="additional-note-container tw-max-w-full"
							v-if="!isEmptyLoadedItemResult"
						>
							<h2 class="additional-note-text">
								{{ __("store.sulfiteNote") }}
							</h2>
							<h2
								class="whole-sale-header-text additional-note-text"
								v-if="ifAnyProductAbsent"
							>
								{{ __("store.wholeSaleHeader") }}
							</h2>
						</div>
					</template>
					<div
						v-if="isAutoLoading"
						class="loading-block tw-block tw-w-fit-content"
					>
						<div
							class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-12 tw-w-12"
						></div>
					</div>
				</main>

				<footer
					v-if="!isFilterOpenned"
					class="store-footer-block tw-relative tw-block tw-z-2 tw-ml-4 tw-border-mt-bg-brown tw-border-t"
				>
					<span class="summary-title-block">
						<h1 class="summary-text tw-text-black">
							{{ __("store.summary") }}:
							{{
								$root.helper.getCommaSeparatorDecimal(
									summaryPriceInBasket
								)
							}}
							€
						</h1>
					</span>
					<router-link
						class="goto-cart-btn tw-flex tw-justify-between tw-items-center accept-button tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
						:class="{
							'disabled-element': !isMinimumCount,
							'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': isMinimumCount,
						}"
						to="/masthead/wines-cart"
						v-on:click.prevent="handleSubmitOrder($event)"
					>
						<span class="submit-order-text tw-inline">{{
							__("store.submitOrder")
						}}</span>
						<img
							class="goto-cart-btn-arrow tw-inline"
							src="/images/icons/cart-pg/right-arrow.png"
							alt="Go to the cart"
						/>
					</router-link>
				</footer>
			</template>

			<!-- Landscape layout -->
			<template v-slot:lsItemListView="slotProps">
				<lazy-load-image-comp
					basedLazyImgStyleClass="landscape-bg-store-pg-img"
					lazyLoadCommonImgStyleClass=""
					relativePath="store-pg"
					baseName="bg-store-pg"
					lazyLoadImgStyleClass_16_9=""
					lazyLoadImgStyleClass_4_3=""
					commonImgStyleClass=""
					basedPortraitLazyImgStyleClass=""
					basedDesktopLazyImgStyleClass=""
					transitionImgStyleClass_16_9="fade-inOut-opacity"
					transitionImgStyleClass_4_3="fade-inOut-opacity"
					lqipPath_4_3="/images/4_3/store-pg/lqip_4_3/jpg/4_3-lqip-bg-store-pg.jpg"
					lqipPath_16_9="/images/16_9/store-pg/lqip_16_9/jpg/16_9-lqip-bg-store-pg.jpg"
					lqipStyleClass_16_9="tw-fixed tw-inset-0 tw-object-cover tw-max-h-full tw-h-full tw-max-w-full tw-w-full tw-z-n-2"
					lqipStyleClass_4_3="tw-fixed tw-inset-0 tw-object-cover tw-max-h-full tw-h-full tw-max-w-full tw-w-full tw-z-n-2"
					basedLandscapeLazyImgStyleClass="tw-fixed tw-inset-0 tw-object-cover tw-max-h-full tw-h-full tw-max-w-full tw-w-full"
					atSurfaceZindexStyleClass="tw-z-n-1"
					backZIndexStyleClass="tw-z-n-2"
					isHiddenPortrait="true"
					isHiddenDesktop="true"
				></lazy-load-image-comp>

				<header class="store-header-block tw-relative tw-flex tw-z-4 tw-flex-col">
					<div
						class="header tw-flex tw-flex-row tw-content-center tw-justify-evenly"
					>
						<div class="header-title">
							<div class="header-underline tw-max-w-min-content">
								<h1 class="header-text">
									{{ __("store.title") }}
								</h1>
								<img
									class="title-underline-img"
									src="/images/icons/store-pg/header-underscore-line.svg"
								/>
							</div>
							<store-filter
								class="store-filter"
								v-on:select-filtered-item="handleSelectFilterItem"
								v-on:reset-filtered-item="handleResetFilterItem"
							></store-filter>
						</div>
						<div class="arrow-control">
							<img
								src="/images/orig/store-pg/left-arrow.svg"
								alt="Prev"
								v-if="getSliderControlFrom > 0"
								class="left-arrow"
								v-on:click="
									handleDecreaseCursor(
										$event,
										slotProps.handleDecreaseListCallback
									)
								"
							/>
							<img
								v-if="to < getSliderDataCount - 1"
								src="/images/orig/store-pg/right-arrow.svg"
								alt="Prev"
								class="right-arrow"
								v-on:click="
									handleIncreaseCursor(
										$event,
										slotProps.handleIncreaseListCallback
									)
								"
							/>
						</div>
					</div>
				</header>

				<main class="store-item-list-block tw-relative tw-z-3 tw-flex">
					<div v-if="isEmptyLoadedItemResult" class="centered-msg-block">
						<h1 class="centered-msg tw-text-steilgut-history-text-gold">
							{{ __("formalMessages.emptyLoadedResultMsg") }}
						</h1>
					</div>
					<div v-else class="store-item-list">
						<div
							v-for="i in slotProps.itemQuantityPerPage"
							:key="`${slotProps.from + i - 1}_storeSliderItem_landscape`"
							class="tw-block landscape:tw-flex landscape:tw-flex-grow-1 store-item"
						>
							<store-item-header
								v-if="getSliderItemDataByKey({ i })"
								:itemData="getSliderItemDataByKey({ i })"
								:itemKey="`${
									slotProps.from + i - 1
								}_sliderItemHeader_landscape`"
								v-on:increase-bottle-count="handleChangeBottleCount"
								v-on:decrease-bottle-count="handleChangeBottleCount"
							>
							</store-item-header>
						</div>
					</div>
					<div
						class="additional-note-container"
						v-if="!isEmptyLoadedItemResult"
					>
						<h2 class="additional-note-text">
							{{ __("store.sulfiteNote") }}
						</h2>
						<h2
							class="whole-sale-header-text additional-note-text"
							v-if="ifAnyProductAbsent"
						>
							{{ __("store.wholeSaleHeader") }}
						</h2>
					</div>
				</main>

				<footer
					class="store-footer-block tw-relative tw-flex tw-z-3 tw-flex-row tw-items-center tw-justify-between tw-border-mt-bg-brown tw-border-t"
				>
					<span class="summary-title">
						<h1 class="summary-text">
							{{ __("store.summary") }}:
							{{
								$root.helper.getCommaSeparatorDecimal(
									summaryPriceInBasket
								)
							}}
							€
						</h1>
					</span>

					<h2 class="product-count-precaution">
						{{ __("store.minimumOrder") }}
					</h2>
					<router-link
						class="goto-cart-btn tw-flex tw-justify-items-center tw-items-center accept-button tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
						:class="{
							'disabled-element': !isMinimumCount,
							'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': isMinimumCount,
						}"
						to="/masthead/wines-cart"
						v-on:click.prevent="handleSubmitOrder($event)"
					>
						<span class="goto-cart-container tw-inline-block">
							<h2 class="goto-cart-text">
								{{ __("cart.submitOrder") }}
							</h2>
						</span>
						<div class="goto-cart-arrow tw-inline-block">
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
				</footer>
			</template>
		</slider>
	</div>
</template>

<script>
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";
import SliderComp from "../../shared/components/slider/SliderComp.vue";
import SliderControlComp from "../../shared/components/slider/SliderControlComp.vue";
import StoreFilterComp from "./StoreFilterComp";
import StoreItemHeaderComp from "./StoreItemHeaderComp";
import { SliderHelper } from "../../shared/utils/slider";
import { mapGetters, mapState } from "vuex";
import mediaHelper from "../../shared/mixins/mediaHelper";
import storeCartSlider from "../../shared/mixins/storeCartSlider";
import { Helper } from "../../shared/utils/helper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";

export default {
	mixins: [mediaHelper, storeCartSlider, fullscreenCorrector],
	components: {
		slider: SliderComp,
		"slider-control": SliderControlComp,
		"store-filter": StoreFilterComp,
		"store-item-header": StoreItemHeaderComp,
		"background-shadow-comp": BackgroundShadowComp,
	},

	beforeRouteLeave(to, from, next) {
		if (to["name"] === "winesCart" && !this.isMinimumCount) {
			console.warn(
				"Warn [StoreSliderComp::beforeRouteLeave] Minimum bottles in the order (>=3): invalid condition"
			);
			next(false);
		} else {
			next();
		}
	},

	created() {
		"use strict";
		this.$root.helper.addStyleClassToBody("light-bg");
		// change settings for the content when it changes orientation
		window.addEventListener("resize", this.$_handleResize);
	},

	mounted() {
		"use strict";
		this.$_updateSliderMode();
	},

	destroyed() {
		"use strict";
		document.removeEventListener("touchmove", this.$_handleMove);
		document.removeEventListener("touchmove", this.$_handleLandscapeTouchStart);
		document.removeEventListener("touchmove", this.$_handleLandscapeMove);
		window.removeEventListener("resize", this.$_handleResize);
		this.$root.helper.removeStyleClassFromBody("light-bg");
	},

	data: function () {
		return {
			isFilterOpenned: false,

			// Portrait event related data
			isAutoLoading: false,
			startX: 0,
			startY: 0,

			isEmptyLoadedItemResult: false,
		};
	},

	methods: {
		calcCountRequestExpression: function () {
			return () => {
				let queryParams = {};
				let requestUrl = `/api/wineProducts/get/count`;
				if (this.isFiltering()) {
					queryParams = {
						filter: Helper.createJsonFromMap(this.getAttributeFilter),
					};
					requestUrl = `/api/wineProducts/filter_count`;
				}
				return {
					url: requestUrl,
					params: queryParams,
				};
			};
		},

		calcRangeDataRequestExpression: function (from, to) {
			// debugger;
			// const vm = this;
			return () => {
				let queryParams = {};
				let requestUrl = `/api/wineProducts/pageRange/${from}/${to}`;
				if (this.isFiltering()) {
					queryParams = {
						filter: Helper.createJsonFromMap(this.getAttributeFilter),
					};
					requestUrl = `/api/wineProducts/pageRange/${from}/${to}/filter`;
				}
				return {
					url: requestUrl,
					params: queryParams,
				};
			};
		},

		isFiltering: function () {
			return this.getAttributeFilter.size > 0;
		},

		/*
		 *  Landscape and desktop arrow movement processing
		 */

		handleDecreaseCursor: function (event, handleDecreaseListCallback) {
			// debugger;
			"use strict";
			handleDecreaseListCallback(
				event,
				SliderHelper.calcSliderClickUp({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
					itemCount: this.getSliderDataCount,
					step: this.getSliderMaxItemQuantityPerPage,
				})
			);
		},

		handleIncreaseCursor: function (event, handleIncreaseListCallback) {
			// debugger;
			"use strict";
			handleIncreaseListCallback(
				event,
				SliderHelper.calcSliderClickDown({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					itemCount: this.getSliderDataCount,
					maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
					step: this.getSliderMaxItemQuantityPerPage,
				})
			);
		},

		handleChangeBottleCount: function (event) {
			"use strict";
			this.$_validate();
		},

		handleSubmitOrder: function (event) {
			"use strict";
			console.log("Debug [StoreSliderComp::handleConfirm] ");
		},

		//
		// Filter
		//
		handleFilterOpenning: function (event, isFilterOpenned) {
			console.log("Debug [StoreSliderComp::handleFilterOpenning]");
			this.isFilterOpenned = isFilterOpenned;
		},

		handleSelectFilterItem: function (event) {
			this.$_updateSliderMode();
			// fetch the filtered result
			this.$refs.slotProps.handleRebuildList();
		},

		handleResetFilterItem: function (event) {
			// reset the previous result
			this.$_updateSliderMode();
			this.$refs.slotProps.handleRebuildList();
		},

		mdStopLoadingPostProcess: function (isError) {
			this.$_checkIfEmptyLoadedItemResult(isError);
		},

		landscapeStopLoadingPostProcess: function (isError) {
			this.$_checkIfEmptyLoadedItemResult(isError);
		},

		stopLoadingPostProcess: function (isError) {
			this.isAutoLoading = false;
			this.$_checkIfEmptyLoadedItemResult(isError);
		},

		stopLoadingAsyncFn: async function () {
			return this.$store.dispatch("syncCart");
		},

		$_checkIfEmptyLoadedItemResult: function (isError) {
			return (this.isEmptyLoadedItemResult =
				this.getSliderDataCount == 0 && !isError);
		},

		$_validate: function () {
			return this.isMinimumCondition({ min: 3 });
		},
	},

	computed: {
		...mapGetters([
			"inBasketWineSetBottlesCount",
			"ifAnyProductAbsent",
			"isMinimumCondition",
		]),

		isMinimumCount: function () {
			return this.isMinimumCondition({ min: 3 });
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

.store-slider {
	display: flex;
	flex: 1 0 82%;

	height: 82%;
	height: 82vh;
	height: calc(var(--100nvh, 1vh) * 82);
}

.bg-image {
	filter: contrast(70%);
	opacity: 0.5;
}

header.store-header-block {
	display: flex;
	flex-direction: row;
	flex: 0 1 14%;
	height: 14%;
	max-height: 15%;

	width: 88%;
	max-width: 88%;
	margin: 0 3vw 2vh auto;
	margin: 0 calc(var(--100nvw, 1vw) * 3) 1% auto;
}

header.store-header-block .header-title {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	max-height: 100%;
	min-height: 0;
	flex-wrap: wrap;
	min-width: 80%;
	text-align: left;
	margin: auto auto auto 0;
	max-height: 100%;
}

header.store-header-block .header-title div.header-underline {
	min-width: 20%;
}

header.store-header-block .store-filter {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	flex-grow: 1;
	min-width: 50%;
	width: 50%;
	margin: 2vh auto 2vh 2vw;
	margin: calc(var(--100nvh, 1vh) * 2) auto calc(var(--100nvh, 1vh) * 2)
		calc(var(--100nvw, 1vw) * 2);
}

.store-header-block .arrow-control {
	min-width: fit-content;
	max-width: fit-content;
}

.store-item-list-block {
	flex: 0 0 70%;
	min-height: 0%;
	height: 70%;
	max-height: 70%;
	max-width: 88%;
	width: 88%;
	margin: 0 3vw 2vh auto;
	margin: 0 calc(var(--100nvw, 1vw) * 3) calc(var(--100nvh, 1vh) * 2) auto;
	align-items: stretch;
	flex-direction: column;
}

.store-item-list {
	display: grid;
	grid-template-columns: repeat(2, 50%);
	grid-template-rows: repeat(2, 50%);
	justify-items: flex-start;
	align-items: center;
	gap: 1vh 1vw;
	gap: calc(var(--100nvh, 1vh)) calc(var(--100nvw, 1vw));
	flex-grow: 1;
	width: 100%;
	max-width: 100%;
}

.store-footer-block {
	flex: 0 1 10%;
	height: 10%;
	min-height: 10%;
	width: 88%;
	max-width: 88%;

	margin: 0 3vw 0 auto;
	margin: 0 calc(var(--100nvw, 1vw) * 3) 0 auto;
}

.summary-text {
	font-size: 1rem;
	font-size: calc(1rem + var(--100nvh, 1vh) * 1.5);
}

h2.product-count-precaution {
	font-size: 1rem;
	font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.7);
}

.accept-button {
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

.goto-cart-arrow {
	margin: auto auto auto 1vmin;
	margin: auto auto auto calc(var(--100nvw, 1vw));
}

.goto-cart-arrow svg {
	max-width: calc(0.4rem + 1.5vh);
	max-width: calc(0.4rem + var(--100nvh, 1vh) * 1.5);
}

.goto-cart-arrow:hover svg path {
	fill: #ebcb9a;
}

.additional-note-container {
	margin: 2vh 0 0 0;
	margin: calc(var(--100nvh, 1vh) * 2) 0 0 0;
}

h2.additional-note-text {
	font-family: "steilgut_opensans";
	font-weight: 100;
	color: #313131;
	font-size: calc(0.5rem + 0.5vh);
	font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.5);
	padding: 0.5vh 0;
	padding: calc(var(--100nvh, 1vh) * 0.5) 0;

	overflow: auto;
}

.additional-note-container h2.whole-sale-header-text {
	color: #af7977;
}

/* .wine-store-bg-filter {
    -webkit-box-shadow: inset 0px 5vh 40vh 50px rgba(0, 0, 0, 0.8);
    -moz-box-shadow: inset 0px 5vh 40vh 50px rgba(0, 0, 0, 0.8);
    box-shadow: inset 0px 5vh 40vh 50px rgba(0, 0, 0, 0.8);
} */

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.store-slider {
		display: block;
		height: auto;
		max-height: unset;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: portrait) {
	.store-slider {
		position: relative;
		height: auto;
		max-height: unset;
		margin-top: -15vh;
	}

	.header-block {
		padding-left: 10%;
	}

	header.store-header-block {
		min-height: 50vh;
		height: 50vh;
		width: 100%;
		max-width: 100%;
		margin: 0;
	}

	.store-header-block .header-text {
		margin: auto;
		color: #ffffff;
		font-size: calc(1.8rem + 2vh);
	}

	.store-header-block img.title-underline-img {
		max-width: 70%;
	}

	.store-item-list-block {
		display: block;
		width: 100%;
		max-width: 100%;
		height: auto;
		min-height: 85%;
		max-height: unset;
		margin: 0 3vw 2vh auto;
	}

	.store-item-list {
		display: flex;
		flex-direction: column;
		flex: 1 0 auto;
		align-items: center;
		justify-content: center;
		min-height: auto;
		height: 50vh;
	}

	.store-item {
		width: 100%;
		max-width: 100%;
		padding-bottom: 5vh;
	}

	.store-item:last-child {
		padding-bottom: 0;
	}

	.store-footer-block {
		width: 88%;
		max-width: 88%;
		height: fit-content;
		padding: 3vh 0 2vh 0;
		margin: 2vh 3vw auto auto;
		text-align: left;
	}

	.summary-title-block {
		width: 100%;
		max-width: 100%;
	}

	.summary-text {
		text-align: left;
		text-transform: capitalize;
		font-size: calc(1rem + 3vmin);
		padding: 0;
		margin-top: 0;
	}

	.goto-cart-btn {
		width: 80%;
		max-width: 80%;
		padding: 1.75vh 3vh;
	}

	.submit-order-text {
		padding: 0;
		font-size: calc(1rem + 0.5vh);
		font-weight: lighter;
	}

	.goto-cart-btn-arrow {
		width: 18px;
		height: 14px;
	}

	.loading-block {
		margin: 6vh auto auto auto;
	}

	h2.additional-note-text {
		font-size: calc(1rem + 0.6vw);
	}

	.additional-note-container {
		margin: 4vh 0 0 3vw;
	}

	.additional-note-container .additional-note-text {
		max-width: 90%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.store-slider {
				margin-top: unset;
				top: -15vh;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-height: 568px) and (orientation: portrait) {
	.store-slider {
		margin-top: -15vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.store-slider {
				margin-top: unset;
				top: -15vh;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.store-slider {
		max-width: 100vw;
		margin: 0;

		flex: 0 0 100%;
		display: flex;

		position: absolute;
		height: calc(var(--100vh, 1vh) * 100);
		min-height: calc(var(--100vh, 1vh) * 100);
	}

	header.store-header-block {
		max-height: 15%;
		max-width: 80%;
		width: 80%;
		margin: 0 auto 1vh 3vw;
		margin: 0 auto var(--100vh, 1vh) 3vw;
		flex: 0 0 15%;
		display: flex;
	}

	.header-underline h1.header-text {
		font-size: 6vh;
		font-size: calc(var(--100vh, 1vh) * 6);
		margin: 0 auto 1vh auto;
		margin: 0 auto var(--100vh, 1vh) auto;
	}

	.store-item-list-block {
		display: flex;
		width: 100%;
		max-width: 100%;
		flex: 1 0 55%;
		max-height: 55%;
		min-height: unset;
		align-items: stretch;
		justify-content: center;
	}

	.store-item-list {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: space-evenly;
		align-items: stretch;
	}

	.store-item {
		display: flex;
		flex-direction: column;
		flex: 1 0 auto;
		width: 45%;
		max-width: 45%;
		/* border: 2px solid #ebcb9a; */
	}

	.additional-note-container {
		margin: 2vh auto 0 3vw;
		margin: calc(var(--100vh, 1vh) * 2) auto 0 3vw;
	}

	.arrow-control {
		margin: 0 auto auto auto;
	}

	.arrow-control .left-arrow {
		margin-right: 3vh;
		margin-right: calc(var(--100vh, 1vh) * 3);
	}

	.arrow-control .left-arrow,
	.arrow-control .right-arrow {
		width: 6vh;
		width: calc(var(--100vh, 1vh) * 6);
		height: 6vh;
		height: calc(var(--100vh, 1vh) * 6);
	}

	.summary-text,
	h2.product-count-precaution {
		font-family: "steilgut_opensans";
		font-weight: 100;
		color: #313131;
		margin: 0.5rem auto;
		text-align: center;
		height: fit-content;
	}

	.summary-text {
		font-size: 1rem;
		font-size: calc(0.7rem + var(--100vh, 1vh) * 0.7);
	}

	h2.product-count-precaution,
	h2.additional-note-text,
	.accept-button {
		font-size: 0.7rem;
		font-size: calc(0.5rem + var(--100vh, 1vh) * 0.7);
	}

	h2.product-count-precaution {
		position: absolute;
		bottom: 0%;
		left: 50%;
		transform: translateX(-50%);
	}

	.accept-button {
		font-family: "steilgut_opensans";
		font-weight: 100;
		color: #313131;
		height: fit-content;
		width: fit-content;
		padding: 1vh;
		padding: var(--100vh, 1vh);
	}

	.store-header-block .header-title {
		flex-grow: 1;
		margin-left: 0;
	}

	.centered-msg-block {
		position: relative;
		min-height: calc(var(--100vh, 1vh) * 50);
		min-height: 50vh;
		width: 100%;
		max-width: 100%;
	}

	.store-footer-block {
		height: 10%;
		max-height: 10%;
		max-width: 90%;
		margin: 0 auto 0 3vw;
		flex-grow: 1;
	}

	.goto-cart-arrow {
		margin: auto 0.5vw auto 0.5vw;
	}

	.goto-cart-arrow svg {
		max-height: 9px;
		max-width: 10px;
	}

	.goto-cart-container {
		max-height: min-content;
		margin: auto 0 auto 3vh;
		margin: auto 0 auto calc(var(--100vh, 1vh) * 3);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 680px) and (orientation: landscape) {
	.store-item-list-block {
		flex: 1 0 65%;
		height: 65%;
		max-height: 65%;
	}

	header.store-header-block {
		margin-top: 0vh;
		margin-bottom: 1vh;
		margin-bottom: var(--100vh, 1vh);
	}

	.additional-note-container {
		margin-top: 2vh;
		margin-top: calc(var(--100vh, 1vh) * 2);
		margin-bottom: calc(var(--100vh, 1vh) * 4);
	}

	header.store-header-block .header-title {
		flex-wrap: nowrap;
	}

	.accept-button {
		font-size: calc(0.5rem + 0.5vh);
		font-size: calc(0.5rem + var(--100vh, 1vh) * 0.5);
	}

	.store-footer-block {
		flex: 0 0 10%;
		height: 10%;
		max-height: 10%;
	}

	h2.product-count-precaution {
		max-width: 96px;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 1025px) and (max-height: 620px) and (-webkit-min-device-pixel-ratio: 1) {
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

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	@supports (-webkit-appearance: none) {
		.store-slider {
			/* max-height: 80%;
			max-height: 80vh;
			max-height: calc(var(--100nvh, 1vh) * 80); */
			height: 80%;
			height: 80vh;
			height: calc(var(--100nvh, 1vh) * 80);
		}

		h2.product-count-precaution {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1440px) and (orientation: landscape) {
	h2.product-count-precaution {
		left: 55%;
	}
}
</style>
