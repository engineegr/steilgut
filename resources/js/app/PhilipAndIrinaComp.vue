<template>
	<div
		class="transit-flex-box tw-flex philip-and-irina portrait-non-fp landscape-non-fp"
	>
		<!-- Desktop -->
		<div class="md:tw-block landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="left-philip-and-irina-pg-img"
				relativePath="philip-and-irina-pg/left-philip-and-irina-pg"
				baseName="bg-left-philip-and-irina-pg"
				lqipPath_4_3="/images/4_3/philip-and-irina-pg/left-philip-and-irina-pg/lqip_4_3/jpg/4_3-lqip-bg-left-philip-and-irina-pg.jpg"
				lqipPath_16_9="/images/16_9/philip-and-irina-pg/left-philip-and-irina-pg/lqip_16_9/jpg/16_9-lqip-bg-left-philip-and-irina-pg.jpg"
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
		<div
			class="md:tw-hidden landscape:tw-hidden tw-block tw-relative tw-inset-0"
			v-show="isPortraitOrientation() || isBrowserPortraitOrientation()"
		>
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-philip-and-irina-pg-img"
				relativePath="philip-and-irina-pg"
				baseName="bg-philip-and-irina-pg"
				lqipPath_portrait="/images/mobile/philip-and-irina-pg/lqip/portrait-lqip-bg-philip-and-irina-pg.jpg"
				lazyLoadImgStyleClass_portrait="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
			></lazy-load-image-comp>

			<div
				class="title tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4 tw-max-w-fit-content"
			>
				<h1 class="tw-text-left">{{ __("philipAndIrina.title") }}</h1>
				<div class="title-underline">
					<img
						class="title-underline-img"
						src="/images/icons/philip-and-irina-pg/header-underscore-line.svg"
					/>
				</div>
			</div>
		</div>

		<div class="philip-and-irina-content">
			<div class="philip-and-irina-thread">
				<div
					class="philip-and-irina-title tw-my-8 tw-hidden landscape:tw-max-w-fit-content landscape:tw-block md:tw-block md:tw-max-w-fit-content"
				>
					<h1 class="philip-and-irina-text landscape:tw-max-w-fit-content">
						{{ __("philipAndIrina.title") }}
					</h1>
					<div class="title-underline tw-max-w-min-fit-content">
						<img
							class="title-underline-img tw-ml-0"
							src="/images/icons/philip-and-irina-pg/header-underscore-line.svg"
						/>
					</div>
				</div>
				<h2 class="subheader">{{ __("philipAndIrina.subheader") }}</h2>
				<section
					class="philip-and-irina-paragraph"
					v-html="__('philipAndIrina.1stPartText')"
				>
					{{ __("philipAndIrina.1stPartText") }}
				</section>
			</div>

			<div class="image-container">
				<section class="image-section tw-max-w-full tw-w-full">
					<img
						:src="img1part1stPath"
						alt="Svalbard"
						class="tw-object-cover tw-block tw-mx-auto tw-max-w-full tw-w-full"
					/>
					<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
						{{ __("philipAndIrina.1stPartImgSubheader") }}
					</h2>
				</section>
			</div>
			<div class="philip-and-irina-thread">
				<section
					class="philip-and-irina-paragraph"
					v-html="__('philipAndIrina.2ndPartText')"
				>
					{{ __("philipAndIrina.2ndPartText") }}
				</section>
			</div>

			<div class="inline-image-list image-container">
				<section class="image-section">
					<img
						:src="img2part1stPath"
						alt="Svalbard"
						class="tw-object-scale-down tw-w-full tw-max-w-full"
					/>
					<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
						{{ __("philipAndIrina.2ndPart1stImgSubheader") }}
					</h2>
				</section>
				<section class="image-section">
					<img
						:src="img2part2ndPath"
						alt="Svalbard"
						class="tw-object-scale-down tw-w-full tw-max-w-full"
					/>
					<h2 class="img-subheader tw-ml-0 tw-text-steilgut-beige">
						{{ __("philipAndIrina.2ndPart2ndImgSubheader") }}
					</h2>
				</section>
			</div>

			<div class="philip-and-irina-thread">
				<section
					class="philip-and-irina-paragraph"
					v-html="__('philipAndIrina.3dPartText')"
				>
					{{ __("philipAndIrina.3dPartText") }}
				</section>
			</div>
		</div>
	</div>
</template>

<script>
import BackgroundShadowComp from "../shared/components/BackgroundShadowComp";
import validationErrors from "../shared/mixins/validationErrors";
import mediaHelper from "../shared/mixins/mediaHelper";
import fullscreenCorrector from "../shared/mixins/fullscreenCorrector";
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
				"Debug [PhilipAndIrinaComp::beforeRouteLeave] Initial state is valid"
			);
		}
	},

	data: function () {
		return {
			img1part1stPath:
				"/images/orig/philip-and-irina-pg/pic001-philip-and-irina-pg.jpg",
			img2part1stPath:
				"/images/orig/philip-and-irina-pg/pic002-philip-and-irina-pg.jpg",
			img2part2ndPath:
				"/images/orig/philip-and-irina-pg/pic003-philip-and-irina-pg.jpg",
		};
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [PhilipAndIrinaComp::$_checkedOrRedirected] Returned Invalid Arguments"
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
.philip-and-irina-title h1 {
	margin: 0.5rem auto;
}

.title-underline-img {
	width: 60%;
}

.philip-and-irina-content {
	position: relative;
	z-index: 2;
	margin: 2rem auto auto 16.583%;

	overflow: auto;
	-webkit-overflow-scrolling: touch;
}

.philip-and-irina-content .philip-and-irina-thread {
	font-family: "steilgut_opensans";
	font-weight: lighter;
	font-size: calc(0.8rem + 0.2vw);
	margin: 0 auto 0.67rem auto;
	max-width: 55%;
}

.philip-and-irina-thread h2.subheader {
	font-weight: normal;
	font-style: italic;
	margin: 0.5rem auto;
	font-size: 1rem;
}

.philip-and-irina-thread section.philip-and-irina-paragraph {
	max-width: 100%;
	line-height: 24px;
}

.philip-and-irina-content .image-section {
	margin: 0 auto;
}

.philip-and-irina-content div.image-container {
	margin: 1.5rem auto;
	max-width: 55%;
	width: 55%;
}

div.image-container section.image-section h2.img-subheader {
	font-weight: normal;
	font-style: italic;
	margin: 0.5rem auto;
	color: #c4bbaa;
	margin: 0.5rem auto auto 0;
}

.philip-and-irina-content div.inline-image-list {
	display: flex;
	flex: 1 0 auto;
	justify-content: space-between;
	align-items: center;
}

.philip-and-irina-content div.inline-image-list section.image-section:first-child {
	margin: auto calc(0.6rem + 2vw) auto 0;
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

	.philip-and-irina {
		height: auto;
		min-height: unset;
		max-height: unset;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.philip-and-irina {
		margin-top: -17vh;
	}

	.title .title-underline {
		width: fit-content;
	}

	.title .title-underline-img {
		width: 90%;
	}

	.title h1 {
		font-size: calc(1.5rem + 2vmin);
		margin: auto;
	}

	.philip-and-irina-content {
		margin: auto 0;
		padding: 3vh 5vw;
	}

	.philip-and-irina-content .philip-and-irina-thread,
	.philip-and-irina-paragraph {
		width: 100%;
		max-width: 100%;
	}

	.philip-and-irina-content .philip-and-irina-thread {
		margin: auto 0;
	}

	.inline-image-list {
		flex-direction: column;
		max-width: 100%;
		width: 100%;
		margin: 0 auto;
	}

	.philip-and-irina-content div.image-container {
		width: 100%;
		max-width: 100%;
		margin: 0 auto;
	}

	.philip-and-irina-content div.image-container section.image-section:first-child {
		margin: 5vmin 0;
	}

	.philip-and-irina-content div.image-container section.image-section {
		width: 100%;
		max-width: 100%;
		margin: 5vmin 0;
	}
}

@media only screen and (min-width: 320px) and (max-device-height: 640px) and (orientation: portrait) {
	.philip-and-irina {
		margin-top: -20vh;
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
	.philip-and-irina {
		display: block;
		margin-top: -20vh;
	}

	.philip-and-irina-content {
		margin: 0 auto auto 32.782%;
	}

	.philip-and-irina-title h1 {
		margin: 2vh auto;
	}

	.philip-and-irina-content div.image-container,
	.philip-and-irina-content .philip-and-irina-thread {
		max-width: 75%;
		width: 75%;
		margin: 0 auto 0.67rem 10%;
	}

	.philip-and-irina-content div.inline-image-list section.image-section {
		margin: 0 auto;
	}

	.philip-and-irina-content div.inline-image-list section.image-section:first-child {
		margin: 0 calc(0.6rem + 2vw) auto 0;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.philip-and-irina-title h1 {
				/* margin: calc(var(--100vh, 1vh) * 2) auto; */
			}
		}
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}
</style>
