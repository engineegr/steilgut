<template>
	<div class="transit-flex-box tw-flex based-terroir portrait-non-fp landscape-non-fp">
		<!-- Desktop -->
		<div class="md:tw-block landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-naslei-terroir-pg-img"
				relativePath="naslei-terroir-pg"
				baseName="bg-naslei-terroir-pg"
				lqipPath_4_3="/images/4_3/naslei-terroir-pg/lqip_4_3/jpg/4_3-lqip-bg-naslei-terroir-pg.jpg"
				lqipPath_16_9="/images/16_9/naslei-terroir-pg/lqip_16_9/jpg/16_9-lqip-bg-naslei-terroir-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-0 tw-top-0 tw-left-0 tw-bottom-0 tw-w-03277 tw-max-w-03277 tw-object-cover"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				widthCoeff_4_3="0.327"
				widthCoeff_16_9="0.327"
				:isDesktopAspectRatioCorrection="true"
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
				:isDesktopAspectRatioCorrection="true"
				:isBackgroundShadow="false"
				:isLandscapeBackgroundShadow="false"
				:isPortraitBackgroundShadow="false"
			></lazy-load-image-comp>
			<background-shadow-comp zIndexClass="tw-z-1"> </background-shadow-comp>
		</div>

		<!-- Portrait layouts -->
		<div class="md:tw-hidden landscape:tw-hidden tw-relative tw-inset-0">
			<lazy-load-image-comp
				basedLazyImgStyleClass="naslei-terroir-pg-img"
				relativePath="naslei-terroir-pg"
				baseName="bg-naslei-terroir-pg"
				lqipPath_portrait="/images/mobile/naslei-terroir-pg/lqip/jpg/lqip-portrait-bg-naslei-terroir-pg.jpg"
				lazyLoadImgStyleClass_portrait="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
			></lazy-load-image-comp>

			<div
				class="title tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4 tw-max-w-fit-content"
			>
				<h1 class="tw-text-left">{{ __("nasleiTerroir.title") }}</h1>
				<div class="title-underline tw-w-3/5">
					<img
						class="title-underline-img tw-block tw-max-w-full"
						src="/images/icons/based-terroir-pg/header-underscore-line.svg"
					/>
				</div>
			</div>
		</div>

		<div class="based-terroir-content">
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
			<div class="based-terroir-thread tw-relative tw-z-9">
				<div
					class="based-terroir-title tw-my-8 tw-hidden landscape:tw-max-w-min-content landscape:tw-block md:tw-block md:tw-max-w-fit-content"
				>
					<h1 class="based-terroir-text">
						{{ __("nasleiTerroir.title") }}
					</h1>
					<div class="title-underline tw-w-fit-content">
						<img
							class="title-underline-img tw-ml-0"
							src="/images/icons/based-terroir-pg/header-underscore-line.svg"
						/>
					</div>
				</div>
				<section
					class="based-terroir-paragraph"
					v-html="__('nasleiTerroir.1stPartText')"
				>
					{{ __("nasleiTerroir.1stPartText") }}
				</section>
				<section
					class="based-terroir-paragraph"
					v-html="__('nasleiTerroir.1stPart2ndText')"
				>
					{{ __("nasleiTerroir.1stPart2ndText") }}
				</section>
				<div class="image-container tw-w-full tw-max-w-full">
					<section class="image-section tw-w-full tw-max-w-full">
						<img
							:src="img1part1stPath"
							alt="Svalbard"
							class="tw-object-cover tw-mx-auto tw-w-full tw-max-w-full"
						/>
						<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
							{{ __("nasleiTerroir.1stPhotoHeader") }}
						</h2>
					</section>
				</div>
				<section
					class="based-terroir-paragraph"
					v-html="__('nasleiTerroir.2ndPartText')"
				>
					{{ __("nasleiTerroir.2ndPartText") }}
				</section>

				<div class="image-container inline-image-list tw-w-full tw-max-w-full">
					<section
						class="image-section md:tw-w-045 md:tw-max-w-045 landscape:tw-w-045 landscape:tw-max-w-045 tw-w-full tw-max-w-full"
					>
						<img
							:src="img2part1stPath"
							alt="Svalbard"
							class="tw-object-scale-down tw-mx-auto tw-w-full tw-max-w-full"
						/>
						<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
							{{ __("nasleiTerroir.2ndPhotoHeader") }}
						</h2>
					</section>
					<section
						class="image-section md:tw-w-045 md:tw-max-w-045 landscape:tw-w-045 landscape:tw-max-w-045 tw-w-full tw-max-w-full"
					>
						<img
							:src="img6part6thPath"
							alt="Svalbard"
							class="tw-object-scale-down tw-w-full tw-max-w-full"
						/>
						<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
							{{ __("nasleiTerroir.3dPhotoHeader") }}
						</h2>
					</section>
				</div>

				<section
					class="based-terroir-paragraph"
					v-html="__('nasleiTerroir.3dPartText')"
				>
					{{ __("nasleiTerroir.3dPartText") }}
				</section>

				<div class="inline-image-list image-container tw-w-full tw-max-w-full">
					<section
						class="image-section md:tw-w-045 md:tw-max-w-045 landscape:tw-w-045 landscape:tw-max-w-045 tw-w-full tw-max-w-full"
					>
						<img
							:src="img3part3dPath"
							alt="Svalbard"
							class="tw-object-scale-down tw-w-full tw-max-w-full"
						/>
						<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
							{{ __("nasleiTerroir.4thPhotoHeader") }}
						</h2>
					</section>
					<section
						class="image-section md:tw-w-045 md:tw-max-w-045 landscape:tw-w-045 landscape:tw-max-w-045 tw-w-full tw-max-w-full"
					>
						<img
							:src="img4part3dPath"
							alt="Svalbard"
							class="tw-object-scale-down tw-w-full tw-max-w-full"
						/>

						<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
							{{ __("nasleiTerroir.5thPhotoHeader") }}
						</h2>
					</section>
				</div>

				<section
					class="based-terroir-paragraph"
					v-html="__('nasleiTerroir.4thPartText')"
				>
					{{ __("nasleiTerroir.4thPartText") }}
				</section>

				<div class="image-container tw-w-full tw-max-w-full">
					<section class="image-section tw-w-full tw-max-w-full">
						<img
							:src="img5part5thPath"
							alt="Svalbard"
							class="tw-object-cover tw-mx-auto tw-w-full tw-max-w-full"
						/>

						<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
							{{ __("nasleiTerroir.6thPhotoHeader") }}
						</h2>
					</section>
				</div>
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
				"Debug [CalmontTerroirComp::beforeRouteLeave] Initial state is valid"
			);
		}
	},

	data: function () {
		return {
			img1part1stPath: "/images/orig/naslei-pg/pic001-naslei-terroir-pg.jpeg",
			img2part1stPath: "/images/orig/naslei-pg/pic002-naslei-terroir-pg.jpeg",
			img3part3dPath: "/images/orig/naslei-pg/pic003-naslei-terroir-pg.jpeg",
			img4part3dPath: "/images/orig/naslei-pg/pic004-naslei-terroir-pg.jpeg",
			img5part5thPath: "/images/orig/naslei-pg/pic005-naslei-terroir-pg.jpeg",
			img6part6thPath: "/images/orig/naslei-pg/pic006-naslei-terroir-pg.jpeg",
		};
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [CalmontTerroirComp::$_checkedOrRedirected] Returned Invalid Arguments"
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
