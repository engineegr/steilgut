<template>
	<div
		class="news-page tw-h-auto tw-inset-0 tw-static md:tw-flex md:max-h-full md:tw-w-full md:max-w-full md:tw-static md:tw-overflow-hidden landscape:tw-z-auto landscape:tw-absolute landscape:tw-overflow-hidden portrait-non-fp"
	>
		<!-- Desktop / Landscape layout -->
		<div class="md:tw-block landscape:tw-hidden tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-news-pg-img"
				relativePath="news-pg"
				baseName="bg-news-pg"
				lqipPath_4_3="/images/4_3/news-pg/lqip_4_3/4_3-lqip-bg-news-pg.png"
				lqipPath_16_9="/images/16_9/news-pg/lqip_16_9/16_9-lqip-bg-news-pg.png"
				lazyLoadCommonImgStyleClass="tw-absolute tw-inset-0 tw-object-fill tw-max-w-full tw-w-full tw-max-h-full tw-h-full"
			></lazy-load-image-comp>
		</div>

		<div class="md:tw-hidden landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-news-pg-img"
				relativePath="news-pg/landscape"
				baseName="bg-news-pg"
				lqipPath_16_9="/images/16_9/news-pg/lqip_16_9/16_9-lqip-bg-news-pg.png"
				lazyLoadCommonImgStyleClass="tw-absolute tw-inset-0 tw-object-fill tw-max-w-full tw-w-full tw-max-h-full tw-h-full"
				isHiddenPortrait="true"
			></lazy-load-image-comp>
		</div>

		<!-- Portrait layouts -->
		<div class="md:tw-hidden landscape:tw-hidden tw-block tw-relative tw-inset-0">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-news-pg-img"
				relativePath="news-pg"
				baseName="bg-news-pg"
				lqipPath_portrait="/images/mobile/news-pg/lqip/portrait-lqip-bg-news-pg.jpg"
				basedPortraitLazyImgStyleClass="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
			></lazy-load-image-comp>

			<div
				class="title tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4"
			>
				<h1>{{ __("news.title") }}</h1>
				<div class="title-underline">
					<img
						class="title-underline-img"
						src="/images/orig/news-pg/news-title-underline.png"
					/>
				</div>
			</div>
		</div>

		<news-comp></news-comp>
	</div>
</template>
<script>
import NewsComp from "./NewsComp";
import mediaHelper from "../../shared/mixins/mediaHelper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";
export default {
	mixins: [mediaHelper, fullscreenCorrector],
	components: {
		"news-comp": NewsComp,
	},
};
</script>

<style lang="scss" scoped>
.news-bg-filter {
	-webkit-box-shadow: inset 0px 15vh 60vh 30px rgba(0, 0, 0, 0.7);
	-moz-box-shadow: inset 0px 15vh 60vh 30px rgba(0, 0, 0, 0.7);
	box-shadow: inset 0px 15vh 60vh 30px rgba(0, 0, 0, 0.7);
}

.title h1 {
	margin: auto auto 1vh auto;
}

.title-underline-img {
	margin: auto auto auto 0;
}

.news-page {
	flex-grow: 1;
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
	.news-page {
		max-width: 100%;
		width: 100%;

		max-width: 100vw;
		width: 100vw;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.news-page {
		margin-top: -33%;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.news-page {
		display: flex;
		flex: 1 0 auto;
		justify-content: center;
		align-items: center;

		max-height: 100%;
		height: 100%;

		margin: auto;
	}
}

@media screen and (min-width: 1025px) and (orientation: landscape) {
	.news-page {
		flex-grow: 1;
		align-items: center;
	}
}
</style>
