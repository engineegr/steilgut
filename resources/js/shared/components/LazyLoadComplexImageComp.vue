<template>
	<!--  Component must be used for complex html components 
    that include several dependent images that must be loaded 
    lazily -->
	<div class="tw-block">
		<div class="tw-block md:tw-hidden">
			<div class="tw-block landscape:tw-hidden" v-if="!isHiddenPortrait">
				<img
					:src="`/images/mobile/${relativePath}/portrait/${imgExt_portrait}/portrait-${baseName}.${imgExt_portrait}`"
					:srcset="`/images/mobile/${relativePath}/portrait/${imgExt_portrait}/portrait-${baseName}.${imgExt_portrait},
            /images/mobile/${relativePath}/portrait/${imgExt_portrait}/portrait-2x-${baseName}.${imgExt_portrait} 2x`"
					:class="[
						basedLazyImgStyleClass,
						basedPortraitLazyImgStyleClass,
						portraitControlLazyImgStyleClass,
						lazyLoadCommonImgStyleClass,
						lazyLoadImgStyleClass_portrait,
						transitionImgStyleClass_portrait,
						getOpacityStyleClass(),
						calcFrontImgStyleClass_portrait(),
					]"
					:style="portraitDataControlLazyImgStyleList"
					alt="Lazy image"
				/>

				<img
					:src="lqipPath_portrait"
					:class="[
						`${basedLazyImgStyleClass}_fogery-portrait-img`,
						lazyLoadCommonImgStyleClass,
						lqipStyleClass_portrait,
						dataLqpiTransitionImgStyleClass_portrait,
						calcForgeryImgZIndexStyleClass(),
					]"
				/>
				<background-shadow-comp
					:zIndexClass="atSurfaceZindexStyleClass"
					v-if="isPortraitBackgroundShadow"
				></background-shadow-comp>
			</div>
			<div class="tw-hidden landscape:tw-block" v-if="!isHiddenLandscape">
				<picture>
					<source
						:srcset="`/images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-2x-${baseName}.${imgExt_16_9} 2x`"
						:data-srcset="`/images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1366px)"
						:class="[
							basedLazyImgStyleClass,
							basedLandscapeLazyImgStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="landscapeDataControlLazyImgStyleList"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedLandscapeLazyImgStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="landscapeDataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1280px) and (max-width: 1365px)"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedLandscapeLazyImgStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="landscapeDataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1024px) and (max-width: 1279px)"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedLandscapeLazyImgStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="landscapeDataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 768px) and (max-width: 1023px)"
					/>
					<source
						:srcset="`/images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedLandscapeLazyImgStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="landscapeDataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 640px) and (max-width: 767px)"
					/>
					<img
						:src="`/images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-${baseName}.${imgExt_16_9}`"
						:srcset="`/images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedLandscapeLazyImgStyleClass,

							landscapeControlLazyImgStyleClass,
							lazyLoadCommonImgStyleClass,
							lazyLoadImgStyleClass_16_9,
							transitionImgStyleClass_16_9,
							getOpacityStyleClass(),
							calcFrontImgStyleClass_16_9(),
						]"
						:style="landscapeDataControlLazyImgStyleList"
						alt="Lazy image"
					/>
				</picture>

				<img
					:src="lqipPath_16_9"
					:class="[
						`${basedLazyImgStyleClass}_fogery-16_9-img`,
						lazyLoadCommonImgStyleClass,
						lqipStyleClass_16_9,
						dataLqpiTransitionImgStyleClass_16_9,
						calcForgeryImgZIndexStyleClass(),
					]"
				/>
				<background-shadow-comp
					:zIndexClass="atSurfaceZindexStyleClass"
					v-if="isLandscapeBackgroundShadow"
				></background-shadow-comp>
			</div>
		</div>
		<div
			class="tw-hidden md:tw-block landscape:tw-hidden"
			:key="desktopImageDashboardKey"
			v-if="!isHiddenDesktop"
		>
			<div v-if="is4_3AspectRatio()">
				<picture>
					<!-- Use 4/3 -->
					<source
						:srcset="`/images/4_3/${relativePath}/xl_1440*1024/${imgExt_4_3}/4_3-xl-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/xl_1440*1024/${imgExt_4_3}/4_3-xl-2x-${baseName}.${imgExt_4_3} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_4_3,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_4_3,
							calcFrontImgStyleClass_4_3(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/4_3/${relativePath}/xl_1440*1024/${imgExt_4_3}/4_3-xl-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/xl_1440*1024/${imgExt_4_3}/4_3-xl-2x-${baseName}.${imgExt_4_3} 2x`"
						media="(min-width: 1440px)"
					/>
					<source
						:srcset="`/images/4_3/${relativePath}/lg_1024*768/${imgExt_4_3}/4_3-lg-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/lg_1024*768/${imgExt_4_3}/4_3-lg-2x-${baseName}.${imgExt_4_3} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_4_3,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_4_3,
							calcFrontImgStyleClass_4_3(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/4_3/${relativePath}/lg_1024*768/${imgExt_4_3}/4_3-lg-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/lg_1024*768/${imgExt_4_3}/4_3-lg-2x-${baseName}.${imgExt_4_3} 2x`"
						media="(min-width: 1024px) and (max-width: 1439px)"
					/>
					<source
						:srcset="`/images/4_3/${relativePath}/md_768*546/${imgExt_4_3}/4_3-md-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/md_768*546/${imgExt_4_3}/4_3-md-2x-${baseName}.${imgExt_4_3} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_4_3,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_4_3,
							calcFrontImgStyleClass_4_3(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/4_3/${relativePath}/md_768*546/${imgExt_4_3}/4_3-md-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/md_768*546/${imgExt_4_3}/4_3-md-2x-${baseName}.${imgExt_4_3} 2x`"
						media="(min-width: 768px) and (max-width: 1023px)"
					/>

					<source
						:srcset="`/images/4_3/${relativePath}/sm_640*455/${imgExt_4_3}/4_3-sm-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/sm_640*455/${imgExt_4_3}/4_3-sm-2x-${baseName}.${imgExt_4_3} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_4_3,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_4_3,
							calcFrontImgStyleClass_4_3(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/4_3/${relativePath}/sm_640*455/${imgExt_4_3}/4_3-sm-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/sm_640*455/${imgExt_4_3}/4_3-sm-2x-${baseName}.${imgExt_4_3} 2x`"
						media="(min-width: 640px) and (max-width: 767px)"
					/>
					<img
						:src="`/images/4_3/${relativePath}/md_768*546/${imgExt_4_3}/4_3-md-${baseName}.${imgExt_4_3}`"
						:srcset="`/images/4_3/${relativePath}/md_768*546/${imgExt_4_3}/4_3-md-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/md_768*546/4_3-md-2x-${baseName}.${imgExt_4_3} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							controlLazyImgStyleClass,
							lazyLoadCommonImgStyleClass,
							lazyLoadImgStyleClass_4_3,
							transitionImgStyleClass_4_3,
							calcFrontImgStyleClass_4_3(),
							getOpacityStyleClass(),
						]"
						:style="dataControlLazyImgStyleList"
						alt="Lazy image"
					/>
				</picture>
				<img
					:src="lqipPath_4_3"
					:class="[
						`${basedLazyImgStyleClass}_fogery-4_3-img`,
						lazyLoadCommonImgStyleClass,
						desktopAspectRatioBalancedStyleClass,
						lqipStyleClass_4_3,
						dataLqpiTransitionImgStyleClass_4_3,
						calcForgeryImgZIndexStyleClass(),
					]"
					:style="dataControlLazyImgStyleList"
				/>
			</div>
			<div v-else-if="is16_9AspectRatio() || is16_10AspectRatio()">
				<picture>
					<source
						:srcset="`/images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width:1920px)"
					/>
					<source
						:srcset="`/images/16_9/${relativePath}/hdplus_1600*900/${imgExt_16_9}/16_9-hdplus-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hdplus_1600*900/${imgExt_16_9}/16_9-hdplus-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/hdplus_1600*900/${imgExt_16_9}/16_9-hdplus-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hdplus_1600*900/${imgExt_16_9}/16_9-hdplus-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1600px) and (max-width: 1919px)"
					/>
					<source
						:srcset="`/images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1366px) and (max-width: 1599px)"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1280px) and (max-width: 1365px)"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/lg_1024*576/${imgExt_16_9}/16_9-lg-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1024px) and (max-width: 1279px)"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/md_768*432/${imgExt_16_9}/16_9-md-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 768px) and (max-width: 1023px)"
					/>
					<source
						:srcset="`/images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							lazyLoadImgStyleClass_16_9,
							lazyLoadCommonImgStyleClass,
							transitionImgStyleClass_16_9,
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 640px) and (max-width: 767px)"
					/>
					<img
						:src="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9}`"
						:srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						:data-src="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9}`"
						:data-srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							controlLazyImgStyleClass,
							lazyLoadCommonImgStyleClass,
							lazyLoadImgStyleClass_16_9,
							transitionImgStyleClass_16_9,
							getOpacityStyleClass(),
							calcFrontImgStyleClass_16_9(),
						]"
						:style="dataControlLazyImgStyleList"
						alt="Lazy image"
					/>
				</picture>

				<img
					:src="lqipPath_16_9"
					:class="[
						`${basedLazyImgStyleClass}_fogery-16_9-img`,
						lazyLoadCommonImgStyleClass,
						lqipStyleClass_16_9,
						desktopAspectRatioBalancedStyleClass,
						dataLqpiTransitionImgStyleClass_16_9,
						calcForgeryImgZIndexStyleClass(),
					]"
					:style="dataControlLazyImgStyleList"
				/>
			</div>
			<background-shadow-comp
				:zIndexClass="atSurfaceZindexStyleClass"
				v-if="isBackgroundShadow"
			></background-shadow-comp>
		</div>
	</div>
</template>

<script>
import mediaHelper from "../../shared/mixins/mediaHelper";
import CachedBackgroundImage from "../../shared/extends/CachedBackgroundImage.vue";
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";

export default {
	mixins: [mediaHelper],
	extends: CachedBackgroundImage,

	components: {
		"background-shadow-comp": BackgroundShadowComp,
	},

	props: {
		lazyLoadCommonImgStyleClass: {
			type: [String],
			default:
				"tw-absolute tw-top-0 tw-bottom-0 tw-left-0 tw-object-fill tw-max-h-full tw-h-full",
		},

		backZIndexStyleClass: {
			type: [String],
			default: "tw-z-n-1",
		},

		atSurfaceZindexStyleClass: {
			type: [String],
			default: "tw-z-0",
		},

		/*
		 * 4/3 Desktop orientation
		 */
		lazyLoadImgStyleClass_4_3: {
			type: [String],
			default: "tw-absolute tw-inset-0 tw-object-cover",
		},

		lqipStyleClass_4_3: {
			type: [String],
			default: "lqip-4_3-img",
		},

		lqpiTransitionImgStyleClass_4_3: {
			type: [String],
			default: "fade-inOut-zindex-opacity-img",
		},

		lazyLoadImgStyleClassCallBack_4_3: {
			type: [Function],
			default: () => {
				return "";
			},
		},

		transitionImgStyleClass_4_3: {
			type: [String],
			default: "fade-inOut-zindex-opacity-img",
		},

		/*
		 * 16/9 Desktop and landscape orientation
		 */
		lqipStyleClass_16_9: {
			type: [String],
			default: "lqip-16_9-img",
		},

		lqpiTransitionImgStyleClass_16_9: {
			type: [String],
			default: "fade-inOut-zindex-opacity-img",
		},

		lazyLoadImgStyleClass_16_9: {
			type: [String],
			default: "tw-absolute tw-inset-0 tw-object-cover",
		},

		lazyLoadImgStyleClassCallBack_16_9: {
			type: [Function],
			default: () => {
				return "";
			},
		},

		transitionImgStyleClass_16_9: {
			type: [String],
			default: "fade-inOut-zindex-opacity-img",
		},

		/*
		 * Portrait orientation
		 */
		lqipStyleClass_portrait: {
			type: [String],
			default: "lqip-portrait-img",
		},

		lqpiTransitionImgStyleClass_portrait: {
			type: [String],
			default: "fade-inOut-zindex-opacity-img",
		},

		lazyLoadImgStyleClass_portrait: {
			type: [String],
			default: "tw-absolute tw-inset-0 tw-object-cover",
		},

		lazyLoadImgStyleClassCallBack_portrait: {
			type: [Function],
			default: () => {
				return "";
			},
		},

		transitionImgStyleClass_portrait: {
			type: [String],
			default: "fade-inOut-opacity",
		},

		// Path to the image placeholder (LQIP - Low Quallity Image Placeholder)
		lqipPath_4_3: {
			type: [String],
		},

		lqipPath_16_9: {
			type: [String],
		},

		lqipPath_portrait: {
			type: [String],
		},
	},

	methods: {
		calcFrontImgStyleClass_4_3: function () {
			if (this.isRendered) {
				return [
					this.atSurfaceZindexStyleClass,
					this.lazyLoadImgStyleClassCallBack_4_3(),
				];
			} else {
				return [this.backZIndexStyleClass];
			}
		},

		calcFrontImgStyleClass_16_9: function () {
			if (this.isRendered) {
				return [
					this.atSurfaceZindexStyleClass,
					this.lazyLoadImgStyleClassCallBack_16_9(),
				];
			} else {
				return [this.backZIndexStyleClass];
			}
		},

		calcFrontImgStyleClass_portrait: function () {
			if (this.isRendered) {
				return [
					this.atSurfaceZindexStyleClass,
					this.lazyLoadImgStyleClassCallBack_portrait(),
				];
			} else {
				return [this.backZIndexStyleClass];
			}
		},

		calcForgeryImgZIndexStyleClass: function () {
			if (this.isRendered) {
				return [this.backZIndexStyleClass];
			} else {
				return [this.atSurfaceZindexStyleClass];
			}
		},

		getOpacityStyleClass: function () {
			return {
				"zero-opacity": !this.isRendered,
			};
		},
	},
};
</script>

<style lang="scss" scoped>
.zero-opacity-img {
	opacity: 0;
}

.full-opacity-img {
	opacity: 1;
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
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
}

/*********************************************************************
*
*************************** END MEDIA QUERIES ****************************
* @link 
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/
</style>
