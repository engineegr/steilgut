<template>
	<div
		class="news-body transit-flex-box tw-static md:tw-min-h-080 tw-min-h-full tw-h-auto tw-w-full tw-max-w-full md:tw-h-auto portrait-non-fp landscape-non-fp"
	>
		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div
			class="tw-flex transit-flex-box md:tw-h-auto md:tw-min-h-080 tw-min-h-full tw-h-auto"
			v-else
		>
			<div
				class="tw-hidden transit-flex-box md:tw-flex md:tw-h-auto md:tw-min-h-080 desktop-news-body landscape:tw-hidden"
			>
				<lazy-load-image-comp
					basedLazyImgStyleClass="bg-news-body-pg-img"
					relativePath="news-body-pg"
					baseName="bg-news-body-pg"
					lqipPath_4_3="/images/4_3/news-body-pg/lqip_4_3/jpg/4_3-lqip-bg-news-body-pg.jpg"
					lqipPath_16_9="/images/16_9/news-body-pg/lqip_16_9/jpg/16_9-lqip-bg-news-body-pg.jpg"
					lazyLoadCommonImgStyleClass="tw-fixed tw-inset-0 tw-object-cover tw-max-w-screen tw-w-screen tw-max-h-screen tw-h-screen"
					lazyLoadImgStyleClass_4_3=""
					lazyLoadImgStyleClass_16_9=""
					basedLandscapeLazyImgStyleClass=""
					commonImgStyleClass=""
					atSurfaceZindexStyleClass="tw-z-0"
					backZIndexStyleClass="tw-z-n-1"
					isDesktopAspectRatioCorrection="true"
				></lazy-load-image-comp>
				<div>
					<div v-if="isLoading">
						<pulse-logo-comp isDefer="true"></pulse-logo-comp>
					</div>
					<div
						class="tw-relative tw-z-auto transit-flex-box tw-flex tw-h-auto tw-min-h-080 md-news-body"
						v-else
					>
						<div class="news-title-line">
							<div class="news-body-nav-bar">
								<router-link
									class="hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent"
									to="/masthead/control-panel"
									>{{ __("newsBody.main") }}</router-link
								>
								<span class="tw-text-steilgut-gold tw-mx-2">|</span>
								<router-link
									class="hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent"
									to="/masthead/news"
									>{{ __("newsBody.news") }}</router-link
								>
							</div>
							<div class="news-body-posting-date">
								<span class="tw-text-steilgut-gold posting-date">{{
									aNewsItem.postingDate
								}}</span>
							</div>
						</div>
						<div class="news-body-content">
							<div class="news-body-title tw-my-8">
								<h1 class="news-body-title-text">
									{{ aNewsItem.title }}
								</h1>
								<div class="md-title-underline tw-mt-2">
									<img
										class="title-underline-img tw-m-auto"
										src="/images/orig/news-pg/news-title-underline.png"
									/>
								</div>
							</div>
							<div
								class="news-body-thread"
								v-html="aNewsItem.thread.trim()"
							></div>
						</div>
					</div>
				</div>
			</div>
			<div class="md:tw-hidden tw-flex transit-flex-box tw-min-h-full tw-h-auto">
				<div class="tw-block landscape:tw-hidden">
					<lazy-load-image-comp
						basedLazyImgStyleClass="bg-news-body-pg-img"
						relativePath="news-body-pg"
						baseName="bg-news-body-pg"
						lqipPath_4_3=""
						lqipPath_16_9=""
						lqipPath_portrait="/images/mobile/news-body-pg/portrait/lqip/lqip-portrait-bg-news-body-pg.jpg"
						lazyLoadCommonImgStyleClass="tw-absolute tw-inset-0 tw-p-0 tw-m-0 tw-object-cover tw-w-screen tw-h-screen"
						lazyLoadImgStyleClass_4_3=""
						lazyLoadImgStyleClass_16_9=""
						basedLandscapeLazyImgStyleClass=""
						commonImgStyleClass=""
						atSurfaceZindexStyleClass="tw-z-0"
						backZIndexStyleClass="tw-z-n-1"
						isDesktopAspectRatioCorrection="false"
						isHiddenDesktop="true"
						isHiddenLandscape="true"
					></lazy-load-image-comp>
				</div>
				<div class="landscape:tw-block tw-hidden">
					<lazy-load-image-comp
						basedLazyImgStyleClass="bg-news-body-pg-img"
						relativePath="news-body-pg/landscape"
						baseName="bg-news-body-pg"
						lqipPath_4_3=""
						lqipPath_16_9="/images/16_9/news-body-pg/landscape/lqip_16_9/jpg/16_9-lqip-bg-news-body-pg.jpg"
						lazyLoadCommonImgStyleClass="tw-absolute tw-inset-0 tw-p-0 tw-m-0 tw-object-cover tw-w-screen tw-h-screen"
						lazyLoadImgStyleClass_4_3=""
						lazyLoadImgStyleClass_16_9=""
						basedLandscapeLazyImgStyleClass=""
						commonImgStyleClass=""
						atSurfaceZindexStyleClass="tw-z-0"
						backZIndexStyleClass="tw-z-n-1"
						isDesktopAspectRatioCorrection="false"
						isHiddenDesktop="true"
					></lazy-load-image-comp>
				</div>

				<div v-if="isLoading">
					<pulse-logo-comp isDefer="true" isDark="false"></pulse-logo-comp>
				</div>

				<div
					class="md:hidden tw-flex transit-flex-box tw-min-h-full tw-h-auto tw-z-auto"
					v-else
				>
					<div
						class="tw-flex transit-flex-box tw-min-h-full tw-h-auto landscape:tw-hidden portrait-news-body"
					>
						<div class="tw-flex transit-flex-box tw-min-h-screen tw-h-screen">
							<div
								class="tw-relative tw-z-auto tw-flex tw-flex-col tw-p-4 tw-mb-0 tw-mt-auto debug-border"
							>
								<div class="tw-flex tw-flex-row">
									<router-link
										class="hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent"
										to="/masthead/control-panel"
										>{{ __("newsBody.main") }}</router-link
									>
									<span class="tw-text-steilgut-gold tw-mx-2">|</span>
									<router-link
										class="hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent"
										to="/masthead/news"
										>{{ __("newsBody.news") }}</router-link
									>
								</div>
								<div class="tw-flex tw-flex-col">
									<h1 class="news-body-title-text">
										{{ aNewsItem.title }}
									</h1>
									<div class="title-underline tw-mt-2">
										<img
											class="title-underline-img tw-m-auto"
											src="/images/orig/news-pg/news-title-underline.png"
										/>
									</div>
								</div>
							</div>
						</div>
						<div class="tw-relative tw-z-9 tw-p-4 tw-flex tw-flex-col">
							<div
								class="news-body-posting-date tw-my-2 tw-text-masthead-header-gold"
							>
								<span class="tw-text-steilgut-gold posting-date">{{
									aNewsItem.postingDate
								}}</span>
							</div>
							<div
								class="news-body-thread tw-mt-6 tw-mb-4"
								v-html="aNewsItem.thread.trim()"
							></div>
						</div>
					</div>
					<div
						class="tw-hidden landscape:tw-flex transit-flex-box tw-min-h-full tw-h-auto landscape-news-body"
					>
						<div class="tw-flex transit-flex-box tw-min-h-screen tw-h-screen">
							<div
								class="tw-relative tw-z-auto tw-flex tw-flex-col tw-p-4 tw-mb-0 tw-mt-auto debug-border"
							>
								<div class="tw-flex tw-flex-row">
									<router-link
										class="hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent"
										to="/masthead/control-panel"
										>{{ __("newsBody.main") }}</router-link
									>
									<span class="tw-text-steilgut-gold tw-mx-2">|</span>
									<router-link
										class="hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent"
										to="/masthead/news"
										>{{ __("newsBody.news") }}</router-link
									>
								</div>
								<div class="tw-flex tw-flex-col">
									<h1 class="news-body-title-text">
										{{ aNewsItem.title }}
									</h1>
									<div class="title-underline tw-mt-2">
										<img
											class="title-underline-img tw-m-auto"
											src="/images/orig/news-pg/news-title-underline.png"
										/>
									</div>
								</div>
							</div>
						</div>
						<div class="tw-relative tw-z-auto tw-p-4 tw-flex tw-flex-col">
							<div
								class="news-body-posting-date tw-my-2 tw-text-masthead-header-gold"
							>
								<span class="tw-text-steilgut-gold posting-date">{{
									aNewsItem.postingDate
								}}</span>
							</div>
							<div
								class="news-body-thread tw-mt-6 tw-mb-4"
								v-html="aNewsItem.thread.trim()"
							></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import PulseLogoComp from "../../shared/components/PulseLogoComp";
import mediaHelper from "../../shared/mixins/mediaHelper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";
export default {
	mixins: [mediaHelper, fullscreenCorrector],

	components: {
		"pulse-logo-comp": PulseLogoComp,
	},

	mounted() {
		("use strict");
		window.addEventListener("resize", this.$_applyAdditionalStyles, false);
	},

	destroyed() {
		("use strict");
		window.removeEventListener("resize", this.$_applyAdditionalStyles);
	},

	updated() {
		("use strict");
		this.$_applyAdditionalStyles();
	},

	props: {
		id: [String, Number],
	},

	data() {
		return {
			isLoading: false,
			isError: false,

			aNewsItem: null,
		};
	},

	async created() {
		this.isLoading = true;
		try {
			this.aNewsItem = (
				await axios.get(`/api/news-body/${this.id}/show`)
			).data.data;
		} catch (error) {
			console.log("Error [ NewsBodyComp::created ] Error " + error);
			this.isError = true;
		}
		this.isLoading = false;
	},

	methods: {
		$_applyAdditionalStyles: function () {
			("strict");
			console.info("[NewBodyComp::updated] Enter the function");

			let paragraphListSelector =
				".news-body .desktop-news-body .news-body-thread > div > p";

			let marginStyle = "calc(var(--100nvh, 1vh) * 2.5) 0";
			if (this.isMobileDevice()) {
				if (this.isPortraitOrientation()) {
					paragraphListSelector =
						".news-body .portrait-news-body .news-body-thread > div > p";
				} else if (this.isLandscapeOrientation()) {
					paragraphListSelector =
						".news-body .landscape-news-body .news-body-thread > div > p";
				}

				marginStyle = "calc(var(--100vmin, 1vmin) * 2.5) 0";
			}
			const paragraphList = document.querySelectorAll(paragraphListSelector);

			if (paragraphList && paragraphList.length > 0) {
				paragraphList.forEach((p) => {
					p.style.margin = marginStyle;
				});
			}
		},
	},
};
</script>

<style lang="scss" scoped>
.news-body .news-body-nav-bar .news-body-nav-links {
	display: inline-block;
}

.news-body .news-body-nav-bar .md-news-body-nav-links {
	display: inline-block;
}

.news-body .ls-news-body-nav-bar .ls-news-body-nav-links {
	display: inline-block;
}

.news-body .title-underline,
.md-title-underline,
.ls-title-underline {
	width: 110px;
	max-width: 110px;
}

.news-body-title-text {
	font-family: "steilgut_plantagenet_cherokee", sans-serif;
	margin: calc(0.5em + 1vmin) auto auto 0;
}

blockquote {
	display: block !important;
	margin-top: 1em !important;
	margin-bottom: 1em !important;
	margin-left: 40px !important;
	margin-right: 40px !important;
}

figure {
	margin: 2em 0 2em 0;
}

/*********************************************************************
* 
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	/* Styles */
	.news-body-nav-bar {
		width: 100%;
		max-width: 100%;
		height: 85vh;
		max-height: 85vh;

		display: flex;
		flex-direction: column;
		justify-content: center;
		align-content: center;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.portrait-news-body {
		margin-top: -15vh;
	}

	.news-body-thread div p {
		font-size: calc(0.5rem + 2vmin);
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.landscape-news-body {
		margin-top: -25vh;
	}

	.ls-news-body-nav-bar {
		height: 100%;
		min-height: 100%;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;
		padding-top: 25%;
	}

	.news-body-thread div p {
		font-size: calc(0.5rem + 1.1vmin);
	}
}

/* Laptops, desktops, large screens */
@media only screen and (min-width: 1025px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
	/* Styles */
	.md-news-body {
		width: 66.7%;
		max-width: 66.7%;
		margin-left: 33.3%;
	}

	.news-title-line {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-content: center;
		width: 70%;
		margin: 2rem auto 0 0;
	}

	.news-body-content {
		margin: 0 auto 0 0;
		width: 63%;
	}

	.news-body-thread {
		padding-bottom: 5vw;

		font-size: calc(0.4rem + 1.1vh);
		font-size: calc(0.4rem + var(--100nvh, 1vh) * 1.1);

		line-height: 28px;
		line-height: calc(1rem + 1.3vh);
		line-height: calc(1rem + var(--100nvh, 1vh) * 1.3);
	}

	.news-body-title h1 {
		font-size: calc(1.3rem + 0.8vmin);
		margin: auto;
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-device-width: 2048px) and (-webkit-min-device-pixel-ratio: 1) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.news-title-line {
		margin: 2rem auto 0 10%;
	}

	.news-body-content {
		margin: 0 auto 0 10%;
	}
}

/*********************************************************************
* 
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
