<template>
	<!--  Component must be used for complex html components 
    that include image array loading synchronously 
    lazily -->
	<div>
		<div v-if="!imagePropertyList">
			<h1 class="centered-msg tw-text-steilgut-history-text-gold">
				{{ __("formalMessages.loadingMsg") }}
			</h1>
		</div>
		<div class="sync-lazy-load-image-array" v-else>
			<div
				v-for="(imageProperty, i) in imagePropertyList"
				:key="`${i}_syncLazyLoadImgItem`"
			>
				<sync-lazy-load-image-comp
					:keyIndex="i"
					:isFullyLoaded="isFullyLoaded"
					:isHidden="imageProperty['isHidden']"
					:basedLazyImgStyleClass="`${imageProperty['basedLazyImgStyleClass']}`"
					:basedPortraitLazyImgStyleClass="
						imageProperty['basedPortraitLazyImgStyleClass']
					"
					:basedLandscapeLazyImgStyleClass="
						imageProperty['basedLandscapeLazyImgStyleClass']
					"
					:basedDesktopLazyImgStyleClass="
						imageProperty['basedDesktopLazyImgStyleClass']
					"
					:portraitControlLazyImgStyleClass="
						imageProperty['portraitControlLazyImgStyleClass']
					"
					:landscapeControlLazyImgStyleClass="
						imageProperty['landscapeControlLazyImgStyleClass']
					"
					:controlLazyImgStyleClass="imageProperty['controlLazyImgStyleClass']"
					:portraitControlLazyImgStyleList="
						imageProperty['portraitControlLazyImgStyleList']
					"
					:landscapeControlLazyImgStyleList="
						imageProperty['landscapeControlLazyImgStyleList']
					"
					:controlLazyImgStyleList="imageProperty['controlLazyImgStyleList']"
					:lazyLoadCommonImgStyleClass="
						imageProperty['lazyLoadCommonImgStyleClass']
					"
					:lazyLoadImgStyleClass_4_3="
						imageProperty['lazyLoadImgStyleClass_4_3']
					"
					:transitionImgStyleClass_4_3="
						imageProperty['transitionImgStyleClass_4_3']
					"
					:lazyLoadImgStyleClass_16_9="
						imageProperty['lazyLoadImgStyleClass_16_9']
					"
					:transitionImgStyleClass_16_9="
						imageProperty['transitionImgStyleClass_16_9']
					"
					:relativePath="imageProperty['relativePath']"
					:baseName="imageProperty['baseName']"
					v-on:start-loading-img-event="handleStartLoadingImgEvent"
					v-on:stop-loading-img-event="handleStopLoadingImgEvent"
				>
				</sync-lazy-load-image-comp>
			</div>

			<div v-if="is4_3AspectRatio()">
				<img
					:src="lqipPath_4_3"
					:class="[
						`${basedLazyImgStyleClass}_fogery-4_3-img`,
						lazyLoadCommonImgStyleClass,
						lqipStyleClass_4_3,
						lqpiTransitionImgStyleClass_4_3,
						calcForgeryImgZIndexStyleClass(),
					]"
				/>
			</div>
			<div v-else-if="is16_10AspectRatio() || is16_9AspectRatio()">
				<img
					:src="lqipPath_16_9"
					:class="[
						`${basedLazyImgStyleClass}_fogery-16_9-img`,
						lazyLoadCommonImgStyleClass,
						lqipStyleClass_16_9,
						lqpiTransitionImgStyleClass_16_9,
						calcForgeryImgZIndexStyleClass(),
					]"
				/>
			</div>

			<background-shadow-comp class="tw-fixed" zIndexClass="tw-z-1">
			</background-shadow-comp>
		</div>
	</div>
</template>

<script>
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";
import mediaHelper from "../../shared/mixins/mediaHelper";
export default {
	mixins: [mediaHelper],

	components: {
		"sync-lazy-load-image-comp": () => import("./SyncLazyLoadImageComp"),
		"background-shadow-comp": BackgroundShadowComp,
	},

	props: {
		imagePropertyList: {
			type: Array,
			default: [
				{
					basedLazyImgStyleClass: "lazy-img",

					basedPortraitLazyImgStyleClass: "portrait-contact-pg-lazy-img",
					basedLandscapeLazyImgStyleClass: "landscape-contact-pg-lazy-img",
					basedDesktopLazyImgStyleClass: "desktop-contact-pg-lazy-img",

					controlLazyImgStyleClass: "control-lazy-img",
					controlLazyImgStyleList: "",
					lazyLoadCommonImgStyleClass:
						"md:tw-absolute landscape:tw-fixed tw-fixed tw-top-0 tw-bottom-0 tw-object-fill tw-max-h-full tw-h-full",
					lazyLoadImgStyleClass_4_3:
						"md:tw-absolute landscape:tw-fixed tw-fixed tw-inset-0 tw-object-cover",
					transitionImgStyleClass_4_3: "fade-inOut-opacity",
					lazyLoadImgStyleClass_16_9:
						"md:tw-absolute landscape:tw-fixed tw-fixed tw-inset-0 tw-object-cover",
					transitionImgStyleClass_16_9: "fade-inOut-opacity",

					/*
					 * Template: /images/{xl|lg|md|sm|xs}/{relativePath}/{xl|lg|md|xs|sm}+{-2x}?-{baseName}+ - type is included in the baseName
					 */
					relativePath: "contact-pg",

					baseName: "bg-map-contact-pg",

					imgExt_4_3: ".png",

					imgExt_16_9: ".png",

					isHidden: false,
				},
			],
		},

		basedLazyImgStyleClass: {
			type: [String],
			default: "bg-contact-pg",
		},

		backZIndexStyleClass: {
			type: [String],
			default: "tw-z-n-2",
		},

		atSurfaceZindexStyleClass: {
			type: [String],
			default: "tw-z-n-1",
		},

		lazyLoadCommonImgStyleClass: {
			type: [String],
			default: "tw-absolute tw-inset-0 tw-object-cover",
		},

		lqipStyleClass_4_3: {
			type: [String],
			default:
				"tw-absolute tw-inset-0 tw-object-cover tw-h-full tw-max-h-full tw-w-full tw-max-w-full",
		},

		lqpiTransitionImgStyleClass_4_3: {
			type: [String],
			default: "fade-inOut-opacity",
		},

		lqipStyleClass_16_9: {
			type: [String],
			default:
				"tw-absolute tw-inset-0 tw-object-cover tw-h-full tw-max-h-full tw-w-full tw-max-w-full",
		},

		lqpiTransitionImgStyleClass_16_9: {
			type: [String],
			default: "fade-inOut-opacity",
		},

		// for data-src
		baseName: {
			type: [String],
		},

		// Path to the image placeholder (LQIP - Low Quallity Image Placeholder)
		lqipPath_4_3: {
			type: [String],
		},

		lqipPath_16_9: {
			type: [String],
		},

		imgExt_4_3: {
			default: ".png",
			type: [String],
		},

		imgExt_16_9: {
			default: ".png",
			type: [String],
		},
	},

	data: function () {
		return {
			imgLoadingStatusBits: [],

			// images have just loaded
			isFullyLoaded: false,
		};
	},

	created() {
		("use strict");
		for (let i = 0; i < this.imagePropertyList.length; i++) {
			this.imgLoadingStatusBits[i] = this.imagePropertyList[i].isHidden ? 1 : 0;
		}

		console.info(
			"info [SyncLazyLoadImageArrayComp::created] Length " +
				this.imgLoadingStatusBits.length
		);
	},

	methods: {
		handleStartLoadingImgEvent: function (event, imgIndex) {
			if (imgIndex >= this.imgLoadingStatusBits.length) {
				console.warn(
					"Warn [SyncLazyLoadImageArrayComp::handleStartLoadingImgEvent] index " +
						imgIndex
				);
			}
			this.imgLoadingStatusBits[imgIndex] = 0;
		},

		handleStopLoadingImgEvent: function (event, imgIndex) {
			("use strict");
			if (imgIndex >= this.imgLoadingStatusBits.length) {
				console.warn(
					"Warn [SyncLazyLoadImageArrayComp::handleStopLoadingImgEvent] index " +
						imgIndex
				);
			}
			this.imgLoadingStatusBits[imgIndex] = 1;
			this.isFullyLoaded = this.ifFullyLoaded();
			if (this.isFullyLoaded) {
				this.$emit("fully-loaded-img-list-event", event);
			}
		},

		calcForgeryImgZIndexStyleClass: function () {
			("use strict");
			if (this.isFullyLoaded) {
				return [this.backZIndexStyleClass, "zero-opacity-img"];
			} else {
				return [this.atSurfaceZindexStyleClass];
			}
		},

		ifFullyLoaded: function () {
			("use strict");
			let sum = 0;
			for (let i = 0; i < this.imagePropertyList.length; i++) {
				if (this.imagePropertyList[i].isHidden) {
					this.imgLoadingStatusBits[i] = 1;
				}

				sum += this.imgLoadingStatusBits[i];
			}
			console.log(
				"Debug [SyncLazyLoadImageArrayComp::ifFullyLoaded] summary " + sum
			);
			return sum === this.imgLoadingStatusBits.length;
		},
	},

	computed: {},
};
</script>

<style lang="scss" scoped>
.zero-opacity-img {
	opacity: 0;
}

.full-opacity-img {
	opacity: 1;
}
</style>
