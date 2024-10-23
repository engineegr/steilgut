<template>
	<div
		class="steilgut-history-slider md:tw-w-full md:tw-max-w-full tw-flex portrait-non-fp landscape-non-fp"
	>
		<div class="tw-static" v-if="isChildLoad">
			<pulse-logo-comp isDefer="true"></pulse-logo-comp>
			<button
				class="tw-fixed tw-z-9 focus:tw-outline-none tw-cursor-default tw-w-full tw-h-full"
			></button>
		</div>
		<div
			class="transit-flex-box tw-h-full tw-max-h-full md:tw-min-w-0"
			v-show="!isChildLoad"
		>
			<slider-comp
				:calcCountRequestExpression="calcCountRequestExpression"
				:calcRangeDataRequestExpression="calcRangeDataRequestExpression"
				:mdItemStyleClassCallback="mdSteilgutHistoryItemStyleClassCallback"
				:mdItemsStyleClass="mdSteilgutHistoryItems"
				:mdItemListToContentStyleClass="
					mdSteilgutHistoryItemListToContentStyleClass
				"
				:itemBlockStyleClass="steilgutHistoryItemBlockStyleClass"
				:landscapeItemBlockStyleClass="
					landscapeSteilgutHistoryItemBlockStyleClass
				"
				v-on:on-start-loading-items="resetBgImage"
				v-on:on-stop-loading-items="handleImageLoad"
				v-on:on-increase-list="handleIncreaseList"
				v-on:on-decrease-list="handleDecreaseList"
				v-on:on-tap-item="handleTapItem"
				ref="slotProps"
			>
				<template v-slot:itemHeaderView="slotProps">
					<steilgut-history-item-header
						v-if="slotProps.itemData"
						:itemData="slotProps.itemData"
						:itemKey="slotProps.itemKey"
						:isActive="slotProps.isActive"
						v-on:on-click-item-header="handleClickItemHeader"
					>
					</steilgut-history-item-header>
					<div v-else class="tw-min-w-1/2 tw-h-full"></div>
				</template>

				<template v-slot:md-up-edge-control>
					<div
						class="md-up-control-arrow tw-absolute tw-z-3 tw-top-0 tw-cursor-pointer"
					>
						<img src="/images/orig/steilgut-history-pg/arrow-wine-up.png" />
					</div>
				</template>

				<template v-slot:md-down-edge-control>
					<div
						class="md-down-control-arrow tw-absolute tw-z-3 tw-bottom-0 tw-cursor-pointer"
					>
						<img src="/images/orig/steilgut-history-pg/arrow-wine-down.png" />
					</div>
				</template>

				<template v-slot:background-img="slotProps">
					<div class="md:tw-block landscape:tw-hidden tw-hidden">
						<transition-group name="banner-fade">
							<picture
								key="steilgut_history_background_img"
								v-if="slotProps.itemData && !isBackgroundImgLoading"
							>
								<source
									:srcset="`${slotProps.itemData.hdImage},
                            ${slotProps.itemData.hd2xImage} 2x`"
									media="(min-width: 1280px)"
								/>
								<source
									:srcset="`${slotProps.itemData.lgImage},
                            ${slotProps.itemData.lg2xImage} 2x`"
									media="(min-width: 1024px)"
								/>
								<source
									:srcset="`${slotProps.itemData.mdImage},
                            ${slotProps.itemData.md2xImage} 2x`"
									media="(min-width: 768px)"
								/>

								<source
									:srcset="`${slotProps.itemData.smImage},
                            ${slotProps.itemData.sm2xImage} 2x`"
									media="(min-width: 640px)"
								/>
								<img
									:src="slotProps.itemData.xsImage"
									:srcset="`${slotProps.itemData.xsImage}, ${slotProps.itemData.xs2xImage} 2x`"
									class="steilgut-history-img-bg tw-object-cover fade-inOut-opacity tw-absolute tw-z-n-1 tw-inset-0 tw-min-w-full tw-w-full tw-h-full tw-max-h-full"
									alt="News line left"
									v-if="slotProps.itemData && !isBackgroundImgLoading"
								/>
							</picture>
							<background-shadow-comp
								key="steilgut_history_background_img_shadow"
								zIndexClass="tw-z-1"
							>
							</background-shadow-comp>
							<button
								key="steilgut_history_background_img_mask_0_3"
								class="background-mask-black-0_3 tw-z-0 tw-absolute tw-inset-0 tw-min-w-full tw-w-full tw-h-full tw-max-h-full"
							></button>
						</transition-group>
					</div>

					<!-- Common header for portrait/landscape -->
					<div class="md:tw-hidden">
						<!-- Common header for portrait -->
						<div
							class="history-header-block tw-z-1 tw-block landscape:tw-hidden tw-absolute tw-inset-0"
						>
							<header
								class="history-header tw-pl-6 tw-absolute tw-left-0 tw-z-3"
							>
								<h1 class="history-header-text">
									{{ __("steilgutHistory.title") }}
								</h1>
								<img
									src="/images/orig/steilgut-history-pg/underline-ico/underline-ico.svg"
									alt="History: Underline"
								/>
							</header>
							<transition-group name="banner-fade">
								<img
									key="steilgut_history_background_img_portrait"
									v-if="slotProps.itemData && !isBackgroundImgLoading"
									:src="slotProps.itemData.xsImage"
									:srcset="`${slotProps.itemData.xsImage}, ${slotProps.itemData.xs2xImage} 2x`"
									class="steilgut-history-img-bg tw-absolute tw-z-0 tw-inset-0 tw-object-cover tw-min-w-full tw-w-full tw-h-full tw-max-h-full"
									alt="News line left"
								/>
								<background-shadow-comp
									key="steilgut_history_background_img_shadow"
									zIndexClass="tw-z-1"
								>
								</background-shadow-comp>
								<button
									key="steilgut_history_background_img_mask_0_3_portrait"
									class="background-mask-black-0_3 tw-z-1 tw-absolute tw-inset-0 tw-min-w-full tw-w-full tw-h-full tw-max-h-full"
								></button>
							</transition-group>
						</div>
						<!-- Common header for landscape -->
						<div
							class="history-header-block landscape:tw-block tw-hidden tw-static tw-z-3"
						>
							<header
								class="history-header tw-pl-6 tw-relative tw-left-0 tw-z-3"
							>
								<h1>
									{{ __("steilgutHistory.title") }}
								</h1>
								<img
									src="/images/orig/steilgut-history-pg/underline-ico/underline-ico.svg"
									alt="History: Underline"
								/>
							</header>

							<transition-group name="banner-fade">
								<picture
									v-if="slotProps.itemData && !isBackgroundImgLoading"
									key="steilgut_history_background_img_landscape"
								>
									<source
										:srcset="`${slotProps.itemData.lgImage},
                            ${slotProps.itemData.lg2xImage} 2x`"
										media="(min-width: 1024px)"
									/>
									<source
										:srcset="`${slotProps.itemData.mdImage},
                            ${slotProps.itemData.md2xImage} 2x`"
										media="(min-width: 768px)"
									/>
									<img
										:src="slotProps.itemData.xsImage"
										:srcset="`${slotProps.itemData.smImage}, ${slotProps.itemData.sm2xImage} 2x`"
										class="steilgut-history-img-bg tw-absolute tw-z-0 tw-inset-0 tw-object-cover mobile-landscape-fp-img"
										v-if="
											slotProps.itemData && !isBackgroundImgLoading
										"
										alt="News line left"
									/>
								</picture>
								<background-shadow-comp
									key="steilgut_history_background_img_shadow"
									zIndexClass="tw-z-1"
								>
								</background-shadow-comp>
								<button
									key="steilgut_history_background_img_mask_0_3_landscape"
									class="background-mask-black-0_3 tw-z-1 tw-absolute tw-inset-0 tw-min-w-full tw-w-full tw-h-full tw-max-h-full"
								></button>
							</transition-group>
						</div>
					</div>
				</template>
				<template v-slot:itemContentView="slotProps">
					<steilgut-history-item-content
						:class="[
							{ 'mt-50vh': !slotProps.isOpen },
							{ 'mt-10vh': slotProps.isOpen },
						]"
						v-if="slotProps.itemData"
						:itemData="slotProps.itemData"
						:itemKey="slotProps.itemKey"
						:isActive="slotProps.isActive"
					>
					</steilgut-history-item-content>
					<div v-else class="tw-min-w-1/2 tw-h-full"></div>
				</template>
			</slider-comp>
		</div>
	</div>
</template>

<script>
import SliderComp from "../../shared/components/slider/SliderComp.vue";
import SteilgutHistoryItemHeaderComp from "./SteilgutHistoryItemHeaderComp";
import SteilgutHistoryItemContentComp from "./SteilgutHistoryItemContentComp";
import PulseLogoComp from "../../shared/components/PulseLogoComp";
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";
import mediaHelper from "../../shared/mixins/mediaHelper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";
import { Helper } from "../../shared/utils/helper";
import { mapGetters } from "vuex";

export default {
	mixins: [mediaHelper, fullscreenCorrector],
	components: {
		"slider-comp": SliderComp,
		"steilgut-history-item-header": SteilgutHistoryItemHeaderComp,
		"steilgut-history-item-content": SteilgutHistoryItemContentComp,
		"pulse-logo-comp": PulseLogoComp,
		"background-shadow-comp": BackgroundShadowComp,
	},

	data() {
		return {
			mdSteilgutHistoryItems: "md-steilgut-history-items",
			mdSteilgutHistoryItemListToContentStyleClass:
				"md-steilgut-history-items-to-content safari-only-md-steilgut-history-items-to-content",
			landscapeSteilgutHistoryItemBlockStyleClass:
				"landscape-steilgut-history-item-block",
			steilgutHistoryItemBlockStyleClass: "steilgut-history-item-block",

			mdSteilgutHistoryItemStyleClassCallback: (from, to, index) => {
				return from + index - 1 != to
					? "tw-max-h-full tw-h-1/5 tw-w-full tw-max-w-full tw-z-20 tw-relative"
					: "tw-w-full tw-max-w-full tw-z-20 tw-relative";
			},
			isBackgroundImgLoading: false,
			isChildLoad: false,
			imgLoadArray: null,
			ctrlSum: 0,
		};
	},

	created() {
		console.log("Debug [SteilgutHistorySliderComp] created");
		this.initVertModeSlider();
	},

	mounted() {
		"use strict";
		if (this.isMobileDevice()) {
			if (window.screen && window.screen.orientation) {
				window.screen.orientation.addEventListener(
					"change",
					this.handleImageLoad,
					false
				);
			} else {
				const supportsOrientationChange = "onorientationchange" in window;
				let orientationEvent = supportsOrientationChange
					? "orientationchange"
					: "resize";
				window.addEventListener(orientationEvent, this.handleImageLoad, false);
			}
		}
		this.isBackgroundImgLoading = true;
	},

	destroyed() {
		"use strict";
		if (this.isMobileDevice()) {
			if (window.screen && window.screen.orientation) {
				window.screen.orientation.removeEventListener(
					"change",
					this.handleImageLoad
				);
			} else {
				const supportsOrientationChange = "onorientationchange" in window;
				let orientationEvent = supportsOrientationChange
					? "orientationchange"
					: "resize";
				window.removeEventListener(orientationEvent, this.handleImageLoad);
			}
		}
	},

	methods: {
		calcCountRequestExpression: function () {
			return () => {
				return {
					url: "/api/steilgutHistory/get/count",
					params: {},
				};
			};
		},

		calcRangeDataRequestExpression: function (from, to) {
			return () => {
				return {
					url: `/api/steilgutHistory/pageRange/${from}/${to}`,
					params: {},
				};
			};
		},

		initVertModeSlider: function () {
			"use strict";
			this.$store.commit("resetSlider");
			this.$store.commit("initSlider", {
				mode: "vert",
				itemHeightPercent: 0.2,
			});
		},

		resetBgImage: function () {
			"use strict";
			this.isChildLoad = true;
		},

		handleClickItemHeader: function (event, key) {
			this.$refs.slotProps.setSliderControlCursor(key - 1);
			this.handleTapItem(event, key - 1);
		},

		handleImageLoad: function () {
			"use strict";
			const imgSrcArray = new Array();
			let j = 0;
			const self = this;
			const devicePixelRatio = window.devicePixelRatio || "1";
			const imgQuantity = this.getSliderData.length;
			this.getSliderData.forEach((historyItem) => {
				imgSrcArray[j] = self.getImageSrc(historyItem);
				j++;
			});

			let i = 0;
			this.imgLoadArray = new Array(imgQuantity);
			this.isChildLoad = true;
			this.isBackgroundImgLoading = true;
			this.ctrlSum = 0;
			imgSrcArray.forEach((imgSrc) => {
				const img = new Image();

				self.imgLoadArray[i] = img;
				self.$_processImgLoading(img, imgSrc);
				i++;
			});

			let timerId = setTimeout(() => {
				function checkLoadFn() {
					if (self.ctrlSum !== imgQuantity) {
						timerId = setTimeout(checkLoadFn, 20);
					} else {
						self.isChildLoad = false;
						self.isBackgroundImgLoading = false;
						self.ctrlSum = 0;
					}
				}

				checkLoadFn();
			}, 200);
		},

		handleTapItem: function (event, newCursor) {
			"use strict";
			debugger;
			this.isBackgroundImgLoading = true;
			const cursorData = this.getSliderCursorData;
			const cursorImageSrc = this.getImageSrc(cursorData);
			this.$_processSingleImgLoading(cursorImageSrc);
		},

		handleIncreaseList: function (event, newRange) {
			"use strict";
			this.$_handleCursorChange(event, newRange);
		},

		handleDecreaseList: function (event, newRange) {
			"use strict";
			this.$_handleCursorChange(event, newRange);
		},

		$_handleCursorChange: function (event, newRange) {
			"use strict";
			const maxDataCount = this.getSliderDataCount;
			const cursorIndex = this.getSliderControlCursor;
			const prevCursorIndex = newRange["prevCursor"];
			if (cursorIndex !== prevCursorIndex && cursorIndex !== maxDataCount - 1) {
				this.isBackgroundImgLoading = true;
				const cursorData = this.getSliderCursorData;
				const cursorImageSrc = this.getImageSrc(cursorData);
				this.$_processSingleImgLoading(cursorImageSrc);
			}
		},

		getImageSrc: function (historyItem) {
			"use strict";
			let imgPath = null;
			const screenWidth = window.screen.availWidth || window.screen.width;
			if (screenWidth >= Helper.HD_WIDTH()) {
				// hd
				if (devicePixelRatio === 1) {
					imgPath = historyItem.hdImage;
				} else {
					imgPath = historyItem.hd2xImage;
				}
				// lg
			} else if (screenWidth >= Helper.LG_WIDTH_4_3()) {
				if (devicePixelRatio === 1) {
					imgPath = historyItem.lgImage;
				} else {
					imgPath = historyItem.lg2xImage;
				}
				// md
			} else if (screenWidth >= Helper.MD_WIDTH_4_3()) {
				// sm
				if (devicePixelRatio === 1) {
					imgPath = historyItem.mdImage;
				} else {
					imgPath = historyItem.md2xImage;
				}
			} else {
				if (devicePixelRatio === 1) {
					imgPath = historyItem.smImage;
				} else {
					imgPath = historyItem.sm2xImage;
				}
			}
			return imgPath;
		},

		$_processImgLoading: function (image, imgSrc) {
			"use strict";
			if (image.nodeName === "IMG") {
				const helper = this.$root.$data.helper;
				helper.onImageLoadHandler(
					image,
					imgSrc,
					this,
					this.$_onSuccessfulImageLoadCallback,
					this.$_onFailedImageLoadCallback
				);
			}
		},

		$_processSingleImgLoading: function (imgSrc) {
			"use strict";
			const helper = this.$root.$data.helper;
			const loadImg = new Image();
			helper.onImageLoadHandler(
				loadImg,
				imgSrc,
				this,
				() => {
					this.isBackgroundImgLoading = false;
				},
				this.$_onFailedImageLoadCallback
			);
		},

		$_onSuccessfulImageLoadCallback: function (resolveEvt) {
			"use strict";
			console.log(
				"Debug [cachedBackgroundImage::$_onSuccessfulImageLoadCallback] Emit Fully Loaded Image event" +
					resolveEvt
			);
			this.ctrlSum++;
		},

		$_onFailedImageLoadCallback: function (rejectEvt) {
			"use strict";
			console.error(
				"Error [cachedBackgroundImage::$_onFailedImageLoadCallback] Failed to load image " +
					rejectEvt
			);
			this.isChildLoad = false;
			this.isBackgroundImgLoading = false;
		},
	},

	computed: {
		...mapGetters([
			"getSliderData",
			"getSliderCursorData",
			"getSliderControlCursor",
			"getSliderDataCount",
		]),
	},
};
</script>

<style lang="scss" scoped>
.steilgut-history-slider {
	display: flex;
	flex: 1 0 auto;
	align-items: center;
	justify-content: center;
	max-width: 100%;
	width: 100%;
}

.steilgut-history-img-bg {
	-webkit-transition: all 2s ease;
	-moz-transition: all 0.25s ease;
	transition: all 2s ease;
}

.history-header h1 {
	margin: auto;
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
	.steilgut-history-slider,
	.steilgutHistoryItemBlockStyleClass {
		height: auto;
	}

	.history-header h1 {
		margin: 2vmin auto 2vmin 0;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	/* Header + backhround image */
	.history-header-block {
		height: 50vh;
		max-height: 50vh;
	}

	.history-header {
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-content: center;

		bottom: 10vh;
	}

	.history-header-text {
		font-size: calc(1.7em + 2.5vw);
		margin: auto auto 2vh auto;
	}

	.history-header img {
		width: 60%;
		margin: auto auto auto 0;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.steilgut-history-slider {
		justify-content: flex-start;
		align-content: flex-start;
	}

	.history-header-block {
		height: 20vh;
	}

	.history-header {
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-content: center;
		width: fit-content;
	}

	.history-header img {
		max-width: 60%;
	}

	.steilgut-slider-item-header {
		height: 15vh;
	}

	.mt-50vh {
		margin-top: 50vh;
	}

	.mt-10vh {
		margin-top: 10vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 568px) and (orientation: landscape) {
	.history-header-block {
		height: 27vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.history-header-block {
				height: calc(var(--100vh, 1vh) * 27);
			}
		}
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.steilgut-history-slider {
		height: 82%;
		max-height: 82%;
		height: 82vh;
		max-height: 82vh;
		height: calc(var(--100nvh, 1vh) * 82);
		max-height: calc(var(--100nvh, 1vh) * 82);
	}

	.md-up-control-arrow,
	.md-down-control-arrow {
		width: auto;
		transform: translate(2.9rem, 0);
		transition: transform 1s;
	}

	.md-up-control-arrow:hover {
		transform: translateZ(0) translate(2.9rem, -1rem);
	}

	.md-down-control-arrow:hover {
		transform: translateZ(0) translate(2.9rem, 1rem);
	}
}

@media only screen and (max-width: 1600px) and (orientation: landscape) {
	.md-up-control-arrow,
	.md-down-control-arrow {
		transform: translate(2.6rem, 0);
	}

	.md-up-control-arrow:hover {
		transform: translateZ(0) translate(2.6rem, -1rem);
	}

	.md-down-control-arrow:hover {
		transform: translateZ(0) translate(2.6rem, 1rem);
	}
}
</style>
