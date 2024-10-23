<template>
	<div class="tw-block">
		<!-- Responsive image component -->
		<div class="tw-block md:tw-hidden">
			<div class="tw-block landscape:tw-hidden" v-if="isLoadPortrait">
				<img
					v-if="portraitBaseName"
					:src="`/images/mobile/${relativePath}/portrait/${imgExt_16_9}/portrait-${portraitBaseName}.${imgExt_16_9}`"
					:srcset="`/images/mobile/${relativePath}/portrait/${imgExt_16_9}/portrait-${portraitBaseName}.${imgExt_16_9},
            /images/mobile/${relativePath}/portrait/${imgExt_16_9}/portrait-2x-${portraitBaseName}.${imgExt_16_9} 2x`"
					:class="[
						basedLazyImgStyleClass,
						basedPortraitLazyImgStyleClass,
						portraitControlLazyImgStyleClass,
						commonImgStyleClass,
						$_calcTransitionImageClass_4_3(),
						zIndexStyleClass,
						controlImgStyleClass,
						getOpacityStyleClass(),
					]"
					:style="portraitDataControlLazyImgStyleList"
					alt="Responsive image"
				/>
				<img
					v-else
					:src="`/images/mobile/${relativePath}/portrait/${imgExt_16_9}/portrait-${baseName}.${imgExt_16_9}`"
					:srcset="`/images/mobile/${relativePath}/portrait/${imgExt_16_9}/portrait-${baseName}.${imgExt_16_9},
            /images/mobile/${relativePath}/portrait/${imgExt_16_9}/portrait-2x-${baseName}.${imgExt_16_9} 2x`"
					:class="[
						basedLazyImgStyleClass,
						basedPortraitLazyImgStyleClass,
						portraitControlLazyImgStyleClass,
						commonImgStyleClass,
						$_calcTransitionImageClass_4_3(),
						zIndexStyleClass,
						controlImgStyleClass,
						getOpacityStyleClass(),
					]"
					:style="portraitDataControlLazyImgStyleList"
					alt="Responsive image"
				/>
				<background-shadow-comp
					:zIndexClass="zIndexStyleClass"
					v-if="isPortraitBackgroundShadow"
				></background-shadow-comp>
			</div>
			<div class="tw-hidden landscape:tw-block" v-if="isLoadLandscape">
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
						]"
						:style="landscapeDataControlLazyImgStyleList"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedLandscapeLazyImgStyleClass,
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							commonImgStyleClass,
							imgStyleClass_16_9,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
							controlImgStyleClass,
							getOpacityStyleClass(),
						]"
						:style="landscapeDataControlLazyImgStyleList"
						alt="Responsive image"
					/>
				</picture>
				<background-shadow-comp
					:zIndexClass="zIndexStyleClass"
					v-if="isLandscapeBackgroundShadow"
				></background-shadow-comp>
			</div>
		</div>
		<!-- Aspect ratio 4/3 -->
		<div
			:key="desktopImageDashboardKey"
			class="tw-hidden md:tw-block landscape:tw-hidden"
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
							imgStyleClass_4_3,
							commonImgStyleClass,
							$_calcTransitionImageClass_4_3(),
							zIndexStyleClass,
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
							imgStyleClass_4_3,
							commonImgStyleClass,
							$_calcTransitionImageClass_4_3(),
							zIndexStyleClass,
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
							imgStyleClass_4_3,
							commonImgStyleClass,
							$_calcTransitionImageClass_4_3(),
							zIndexStyleClass,
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
							imgStyleClass_4_3,
							commonImgStyleClass,
							$_calcTransitionImageClass_4_3(),
							zIndexStyleClass,
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/4_3/${relativePath}/sm_640*455/${imgExt_4_3}/4_3-sm-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/sm_640*455/${imgExt_4_3}/4_3-sm-2x-${baseName}.${imgExt_4_3} 2x`"
						media="(min-width: 640px) and (max-width: 767px)"
					/>
					<img
						:src="`/images/4_3/${relativePath}/xl_1440*1024/${imgExt_4_3}/4_3-xl-${baseName}.${imgExt_4_3}`"
						:srcset="`/images/4_3/${relativePath}/xl_1440*1024/${imgExt_4_3}/4_3-xl-${baseName}.${imgExt_4_3},
            /images/4_3/${relativePath}/xl_1440*1024/${imgExt_4_3}/4_3-xl-2x-${baseName}.${imgExt_4_3} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							controlLazyImgStyleClass,
							commonImgStyleClass,
							imgStyleClass_4_3,
							$_calcTransitionImageClass_4_3(),
							zIndexStyleClass,
							controlImgStyleClass,
							getOpacityStyleClass(),
						]"
						:style="dataControlLazyImgStyleList"
						alt="Responsive image"
					/>
				</picture>
			</div>
			<!-- Aspect ratio 16/9 / 16/10 -->
			<div v-else>
				<picture>
					<source
						:srcset="`/images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/hdplus_1600*900/${imgExt_16_9}/16_9-hdplus-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hdplus_1600*900/${imgExt_16_9}/16_9-hdplus-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 1600px) and (max-width: 1919px)"
					/>
					<source
						:srcset="`/images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-2x-${baseName}.${imgExt_16_9} 2x`"
						:data-srcset="`/images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/wxga_1366*768/${imgExt_16_9}/16_9-wxga-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
						]"
						:style="dataControlLazyImgStyleList"
						media="(min-width: 1366px) and (max-width: 1599px)"
					/>

					<source
						:srcset="`/images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/hd_1280*720/${imgExt_16_9}/16_9-hd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
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
							imgStyleClass_16_9,
							commonImgStyleClass,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
						]"
						:style="dataControlLazyImgStyleList"
						:data-srcset="`/images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/sm_640*360/${imgExt_16_9}/16_9-sm-2x-${baseName}.${imgExt_16_9} 2x`"
						media="(min-width: 640px) and (max-width: 767px)"
					/>
					<img
						:src="`/images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-${baseName}.${imgExt_16_9}`"
						:srcset="`/images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-${baseName}.${imgExt_16_9},
            /images/16_9/${relativePath}/fhd_1920*1080/${imgExt_16_9}/16_9-fhd-2x-${baseName}.${imgExt_16_9} 2x`"
						:class="[
							basedLazyImgStyleClass,
							basedDesktopLazyImgStyleClass,
							desktopAspectRatioBalancedStyleClass,
							controlLazyImgStyleClass,
							commonImgStyleClass,
							imgStyleClass_16_9,
							$_calcTransitionImageClass_16_9(),
							zIndexStyleClass,
							controlImgStyleClass,
							getOpacityStyleClass(),
						]"
						:style="dataControlLazyImgStyleList"
						alt="Responsive image"
					/>
				</picture>
			</div>
			<background-shadow-comp
				:zIndexClass="zIndexStyleClass"
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
		transitionImgStyleClass_4_3: {
			type: [String],
			default: "fade-inOut-opacity",
		},

		transitionImgStyleClass_16_9: {
			type: [String],
			default: "fade-inOut-opacity",
		},

		transitionImgStyleClass_portrait: {
			type: [String],
			default: "fade-inOut-opacity",
		},

		controlImgStyleClass: {
			type: [String],
			default: "control-responsive-img",
		},
	},

	data: function () {
		return {
			dimension: {
				width: -1,
				height: -1,
			},
		};
	},

	methods: {
		getOpacityStyleClass: function () {
			return {
				"zero-opacity": !this.isRendered && this.isSmooth,
			};
		},

		$_calcTransitionImageClass_16_9: function () {
			if (!this.isSmooth) {
				return "dummy-style-class";
			}
			return this.transitionImgStyleClass_16_9;
		},

		$_calcTransitionImageClass_4_3: function () {
			if (!this.isSmooth) {
				return "dummy-style-class";
			}
			return this.transitionImgStyleClass_4_3;
		},
	},
};
</script>

<style scoped></style>
