<template>
	<div class="transit-flex-box tw-flex based-terroir portrait-non-fp landscape-non-fp">
		<!-- Desktop -->
		<div class="md:tw-block landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-left-biodiversity-pg-img"
				relativePath="left-biodiversity-pg"
				baseName="bg-left-biodiversity-pg"
				lqipPath_4_3="/images/4_3/left-biodiversity-pg/lqip_4_3/jpg/4_3-lqip-bg-left-biodiversity-pg.jpg"
				lqipPath_16_9="/images/16_9/left-biodiversity-pg/lqip_16_9/jpg/16_9-lqip-bg-left-biodiversity-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-top-0 tw-left-0 tw-bottom-0 tw-w-03277 tw-max-w-03277 tw-object-cover"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				widthCoeff_4_3="0.327"
				widthCoeff_16_9="0.327"
				atSurfaceZindexStyleClass="tw-z-1"
				backZIndexStyleClass="tw-z-n-1"
				isDesktopAspectRatioCorrection="true"
			></lazy-load-image-comp>

			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-based-terroir-pg-img"
				relativePath="based-terroir-pg"
				baseName="bg-based-terroir-pg"
				lqipPath_4_3="/images/4_3/based-terroir/lqip_4_3/jpg/4_3-lqip-bg-based-terroir-pg.jpg"
				lqipPath_16_9="/images/16_9/based-terroir/lqip_16_9/jpg/16_9-lqip-bg-based-terroir-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-0 tw-top-0 tw-right-0 tw-bottom-0 tw-object-cover"
				lazyLoadImgStyleClass_4_3="bg-based-terroir-pg-width-4_3"
				lazyLoadImgStyleClass_16_9="bg-based-terroir-pg-width-16_9"
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				atSurfaceZindexStyleClass="tw-z-n-2"
				backZIndexStyleClass="tw-z-n-3"
				isDesktopAspectRatioCorrection="true"
			></lazy-load-image-comp>
		</div>

		<!-- Portrait layouts -->
		<div class="md:tw-hidden landscape:tw-hidden tw-block tw-relative tw-inset-0">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-biodiversity-pg-img"
				relativePath="biodiversity-pg"
				baseName="bg-biodiversity-pg"
				lqipPath_portrait="/images/mobile/biodiversity-pg/lqip/jpg/portrait-lqip-bg-biodiversity-pg.jpg"
				lazyLoadImgStyleClass_portrait="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
			></lazy-load-image-comp>

			<div
				class="title tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4 tw-max-w-fit-content"
			>
				<h1 class="tw-text-left">{{ __("biodiversity.title") }}</h1>
				<div class="title-underline">
					<img
						class="title-underline-img"
						src="/images/icons/based-terroir-pg/header-underscore-line.svg"
					/>
				</div>
			</div>
		</div>

		<div class="based-terroir-content tw-relative md:tw-static landscape:tw-relative">
			<div
				class="based-terroir-title tw-hidden tw-w-fit-content landscape:tw-block md:tw-block"
			>
				<h1 class="based-terroir-text">
					{{ __("biodiversity.title") }}
				</h1>
				<div class="title-underline tw-max-w-full">
					<img
						class="title-underline-img tw-ml-0 tw-max-w-040 tw-w-2/5"
						src="/images/icons/based-terroir-pg/header-underscore-line.svg"
					/>
				</div>
			</div>
			<lazy-load-image-comp
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
				isHiddenDesktop="true"
			></lazy-load-image-comp>
			<section class="based-terroir-paragraph">
				<h2 class="biodiversity-annotation">
					{{ __("biodiversity.annotation") }}
				</h2>
				<image-gallery-comp
					:galleryInfo="getImageGalleryInfo()"
				></image-gallery-comp>
			</section>
		</div>
	</div>
</template>

<script>
import validationErrors from "../../shared/mixins/validationErrors";
import mediaHelper from "../../shared/mixins/mediaHelper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";
import imageGalleryComp from "../../shared/components/ImageGalleryComp";
import { mapGetters, mapState } from "vuex";

export default {
	mixins: [validationErrors, mediaHelper, fullscreenCorrector],

	components: {
		"image-gallery-comp": imageGalleryComp,
	},

	created() {
		("use strict");
		// debugger;
		if (this.$_checkedOrRedirected()) {
			console.log(
				"Debug [BiodiversityComp::beforeRouteLeave] Initial state is valid"
			);
		}
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [BiodiversityComp::$_checkedOrRedirected] Returned Invalid Arguments"
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

		getImageGalleryInfo: function () {
			("use strict");
			return [
				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-001.JPG",
					title: this.__("biodiversity.pic001Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-002.JPG",
					title: this.__("biodiversity.pic002Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-003.JPG",
					title: this.__("biodiversity.pic003Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-004.JPG",
					title: this.__("biodiversity.pic004Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-005.JPG",
					title: this.__("biodiversity.pic005Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-006.JPG",
					title: this.__("biodiversity.pic006Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-007.JPG",
					title: this.__("biodiversity.pic007Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-008.JPG",
					title: this.__("biodiversity.pic008Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-009.JPG",
					title: this.__("biodiversity.pic009Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-010.JPG",
					title: this.__("biodiversity.pic010Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-011.JPG",
					title: this.__("biodiversity.pic011Title"),
				},

				{
					path: "/images/orig/biodiversity-pg/biodiversity-pg-pic-012.JPG",
					title: this.__("biodiversity.pic012Title"),
				},
			];
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

.based-terroir-content {
	display: flex;
	flex-direction: column;
	flex: 1 0 auto;
	min-height: 75%;
	min-width: 50%;
	max-width: 50%;
	margin: auto auto auto 35.5%;
	padding-top: 2em;
}

.based-terroir-content .based-terroir-title {
	margin: 0 auto 0.67em 0;
}

.based-terroir-content .based-terroir-paragraph {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	align-items: center;
	justify-content: center;

	min-height: calc(var(--100nvh, 1vh) * 60);
}

.based-terroir-content .based-terroir-paragraph .biodiversity-annotation {
	/* Style for "Уникальные" */
	// min-width: 900px;
	max-width: 100%;
	color: #ffffff;
	font-family: "steilgut_opensans", serif;
	font-size: 1em;
	font-weight: 300;
	font-style: normal;
	letter-spacing: normal;
	text-align: left;

	margin: 20px auto;
	line-height: 28px;
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

	.based-terroir {
		position: relative;
		z-index: 2;
	}

	.based-terroir-content .based-terroir-paragraph h2.biodiversity-annotation {
		max-width: 100%;
		min-width: 0;

		line-height: 28px;
		line-height: calc(0.7em + 3vmin);
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.based-terroir-content {
		margin: 0;
		max-width: 100%;
		width: 100%;

		min-height: 50vh;
		height: auto;
	}

	.based-terroir-content .based-terroir-paragraph {
		min-height: 0;
		height: auto;
		position: relative;
		z-index: 10;
		min-height: 100%;
	}

	.based-terroir-content .based-terroir-paragraph h2.biodiversity-annotation {
		margin: 0 auto 3vh 0;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-height: 640px) and (orientation: portrait) {
	.based-terroir-content {
		min-height: 60vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
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
	.based-terroir {
		flex: 1 0 auto;
		min-height: 100%;
		height: auto;
	}

	.based-terroir-content {
		height: auto;
	}

	.based-terroir-content .based-terroir-paragraph {
		min-height: 75vh;
		flex-grow: 1;
		max-width: 67vw;
	}

	.based-terroir-content .based-terroir-title {
		flex-grow: 1;
		max-height: 15vh;
		min-height: 15vh;

		margin: 5vh auto 0 0;
	}

	.based-terroir-content .based-terroir-title h1.based-terroir-text {
		font-size: calc(1em + 3vmin);
	}

	.based-terroir-content .based-terroir-paragraph h2.biodiversity-annotation {
		margin: 5vmin auto;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}
</style>
