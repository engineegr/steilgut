<template>
	<div class="transit-flex-box tw-flex based-terroir portrait-non-fp landscape-non-fp">
		<!-- Desktop -->
		<div class="md:tw-block landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="frauenberg-neefer-terroir-pg-img"
				relativePath="frauenberg-neefer-terroir-pg"
				baseName="bg-frauenberg-neefer-pg"
				lqipPath_4_3="/images/4_3/frauenberg-neefer-terroir-pg/lqip_4_3/jpg/4_3-lqip-bg-frauenberg-neefer-pg.jpg"
				lqipPath_16_9="/images/16_9/frauenberg-neefer-terroir-pg/lqip_16_9/jpg/16_9-lqip-bg-frauenberg-neefer-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-0 tw-top-0 tw-left-0 tw-bottom-0 tw-w-03277 tw-max-w-03277 tw-object-cover"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				widthCoeff_4_3="0.327"
				widthCoeff_16_9="0.327"
				isDesktopAspectRatioCorrection="true"
				:isBackgroundShadow="false"
				:isLandscapeBackgroundShadow="false"
				:isPortraitBackgroundShadow="false"
			></lazy-load-image-comp>

			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-based-terroir-pg-img"
				relativePath="based-terroir-pg"
				baseName="bg-based-terroir-pg"
				lqipPath_4_3="/images/4_3/based-terroir/lqip_4_3/jpg/4_3-lqip-bg-based-terroir-pg.jpg"
				lqipPath_16_9="/images/16_9/based-terroir/lqip_16_9/jpg/16_9-lqip-bg-based-terroir-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-n-2 tw-top-0 tw-right-0 tw-bottom-0 tw-object-cover"
				lazyLoadImgStyleClass_4_3="bg-based-terroir-pg-width-4_3"
				lazyLoadImgStyleClass_16_9="bg-based-terroir-pg-width-16_9"
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				atSurfaceZindexStyleClass="tw-z-n-2"
				backZIndexStyleClass="tw-z-n-3"
				isDesktopAspectRatioCorrection="true"
				:isBackgroundShadow="false"
				:isLandscapeBackgroundShadow="false"
				:isPortraitBackgroundShadow="false"
			></lazy-load-image-comp>
			<background-shadow-comp zIndexClass="tw-z-1"> </background-shadow-comp>
		</div>

		<!-- Portrait layouts -->
		<div class="md:tw-hidden landscape:tw-hidden tw-relative tw-inset-0">
			<lazy-load-image-comp
				basedLazyImgStyleClass="frauenberg-neefer-terroir-pg-img"
				relativePath="frauenberg-neefer-terroir-pg"
				baseName="bg-frauenberg-neefer-terroir-pg"
				lqipPath_portrait="/images/mobile/frauenberg-neefer-terroir-pg/lqip/jpg/portrait-lqip-bg-frauenberg-terroir-pg.jpg"
				lazyLoadImgStyleClass_portrait="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
			></lazy-load-image-comp>

			<div
				class="title tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4 tw-max-w-fit-content"
			>
				<h1 class="tw-text-left">{{ __("frauenbergNeeferTerroir.title") }}</h1>
				<div class="title-underline">
					<img
						class="title-underline-img"
						src="/images/icons/based-terroir-pg/header-underscore-line.svg"
					/>
				</div>
			</div>
		</div>

		<div class="based-terroir-content">
			<div class="based-terroir-thread">
				<div
					class="based-terroir-title tw-my-8 tw-hidden landscape:tw-max-w-fit-content landscape:tw-block md:tw-block md:tw-max-w-fit-content"
				>
					<h1 class="based-terroir-text landscape:tw-max-w-fit-content">
						{{ __("frauenbergNeeferTerroir.title") }}
					</h1>
					<div class="title-underline tw-max-w-min-fit-content">
						<img
							class="title-underline-img tw-ml-0"
							src="/images/icons/based-terroir-pg/header-underscore-line.svg"
						/>
					</div>
				</div>
				<lazy-load-image-comp
					v-if="isPortraitOrientation() || isBrowserPortraitOrientation()"
					basedLazyImgStyleClass="bg-based-terroir-pg-img"
					relativePath="based-terroir-pg"
					baseName="bg-based-terroir-pg"
					lqipPath_portrait="/images/mobile/based-terroir-pg/lqip/jpg/portrait-lqip-bg-based-terroir-pg.jpg"
					basedPortraitLazyImgStyleClass=""
					lazyLoadImgStyleClass_portrait=""
					portraitControlLazyImgStyleClass=""
					lazyLoadCommonImgStyleClass="tw-absolute tw-z-1 tw-top-0 tw-right-0 tw-bottom-0 tw-object-cover img-half-screen"
					lazyLoadImgStyleClass_4_3=""
					lazyLoadImgStyleClass_16_9=""
					basedLandscapeLazyImgStyleClass=""
					commonImgStyleClass=""
					atSurfaceZindexStyleClass="tw-z-0"
					backZIndexStyleClass="tw-z-n-1"
					isHiddenLandscape="true"
				></lazy-load-image-comp>
				<section
					class="based-terroir-paragraph tw-relative tw-z-9"
					v-html="__('frauenbergNeeferTerroir.1stPartText')"
				>
					{{ __("frauenbergNeeferTerroir.1stPartText") }}
				</section>

				<section
					class="based-terroir-paragraph tw-relative tw-z-9"
					v-html="__('frauenbergNeeferTerroir.2ndPartText')"
				>
					{{ __("frauenbergNeeferTerroir.2ndPartText") }}
				</section>
			</div>
		</div>
	</div>
</template>

<script>
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";
import validationErrors from "../../shared/mixins/validationErrors";
import mediaHelper from "../../shared/mixins/mediaHelper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";
import { mapGetters, mapState } from "vuex";

export default {
	mixins: [validationErrors, mediaHelper, fullscreenCorrector],

	components: {
		"background-shadow-comp": BackgroundShadowComp,
	},

	created() {
		("use strict");
		// debugger;
		if (this.$_checkedOrRedirected()) {
			console.log(
				"Debug [FrauenbergNeeferTerroirComp::beforeRouteLeave] Initial state is valid"
			);
		}
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [FrauenbergNeeferTerroirComp::$_checkedOrRedirected] Returned Invalid Arguments"
				);
				this.$router.push({
					name: "controlPanel",
				});
				return false;
			}
			return true;
		},

		$_isInitialStateValid: function () {
			return true;
		},
	},

	computed: {},
};
</script>

<style lang="scss">
@import "@/sass/global-based-terroir.scss";
</style>

<style lang="scss" scoped>
@import "@/sass/based-terroir.scss";
</style>
