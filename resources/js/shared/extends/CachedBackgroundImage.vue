<script>
import { calcAspectRatioStyleClassList } from "../utils/resizer";

export default {
	props: {
		keyIndex: {
			type: [String, Number],
			default: 0,
		},

		/* For filter */
		basedLazyImgStyleClass: {
			type: [String],
			default: "lazy-img",
		},

		commonImgStyleClass: {
			type: [String],
			default: "tw-absolute tw-top-0",
		},

		zIndexStyleClass: {
			type: [String],
			default: "tw-z-0",
		},

		imgStyleClass_4_3: {
			type: [String],
			default: "tw-absolute tw-inset-0",
		},

		imgStyleClass_16_9: {
			type: [String],
			default: "tw-absolute tw-inset-0",
		},

		desktopAspectRatioBalancedStyleClass: {
			type: [String],
			default: "desktop-img-ar-balanced img-fp",
		},

		basedDesktopLazyImgStyleClass: {
			type: [String],
			default: "desktop-lazy-img tw-object-cover",
		},

		basedPortraitLazyImgStyleClass: {
			type: [String],
			default:
				"portrait-lazy-img tw-object-cover tw-left-0 tw-right-0 tw-top-0 tw-w-full tw-max-w-full",
		},

		basedLandscapeLazyImgStyleClass: {
			type: [String],
			default:
				"landscape-lazy-img tw-object-cover mobile-landscape-fp-img tw-inset-0",
		},

		/*
		 * Control Style classes
		 */

		controlLazyImgStyleClass: {
			type: [String],
			default: "dummy-style-class",
		},

		landscapeControlLazyImgStyleClass: {
			type: [String],
			default: "dummy-style-class",
		},

		portraitControlLazyImgStyleClass: {
			type: [String],
			default: "dummy-style-class",
		},

		controlLazyImgStyleList: {
			type: [String],
			default: "",
		},

		portraitControlLazyImgStyleList: {
			type: [String],
			default: "",
		},

		landscapeControlLazyImgStyleList: {
			type: [String],
			default: "",
		},
		/*
		 * Template: /images/{xl|lg|md|sm|xs}/{relativePath}/{xl|lg|md|xs|sm}+{-2x}?-{baseName}+ - type is included in the baseName
		 */
		relativePath: {
			type: [String],
		},

		// for data-src
		baseName: {
			type: [String],
		},

		portraitBaseName: {
			type: [String],
			required: false,
		},

		isLoadLandscape: {
			type: [String, Boolean],
			required: false,
			default: true,
		},

		isLoadPortrait: {
			type: [String, Boolean],
			required: false,
			default: true,
		},

		imgExt_4_3: {
			default: "jpg",
			type: [String],
		},

		imgExt_16_9: {
			default: "jpg",
			type: [String],
		},

		imgExt_portrait: {
			default: "jpg",
			type: [String],
		},

		isSmooth: {
			default: false,
			type: [String, Boolean],
		},

		smoothTimeOut: {
			default: 0,
			type: [String, Number],
		},

		isHiddenDesktop: {
			default: false,
			type: [String, Boolean],
		},

		isHiddenPortrait: {
			default: false,
			type: [String, Boolean],
		},

		isHiddenLandscape: {
			default: false,
			type: [String, Boolean],
		},

		isDesktopAspectRatioCorrection: {
			type: [Boolean, String],
			required: false,
			default: true,
		},

		widthCoeff_4_3: {
			type: [Number, String],
			default: 1.0,
		},

		heightCoeff_4_3: {
			type: [Number, String],
			default: 1.0,
		},

		widthCoeff_16_9: {
			type: [Number, String],
			default: 1.0,
		},

		heightCoeff_16_9: {
			type: [Number, String],
			default: 1.0,
		},

		isSelfControl: {
			type: [Boolean, String],
			default: true,
		},

		isBackgroundShadow: {
			type: [String, Boolean],
			default: true,
		},
		isLandscapeBackgroundShadow: {
			type: [String, Boolean],
			default: true,
		},
		isPortraitBackgroundShadow: {
			type: [String, Boolean],
			default: true,
		},
	},

	data: function () {
		return {
			isLoaded: false,
			isRendered: false,
			desktopImageDashboardKey: "desktopImageDashboardKey_0",

			dataLqpiTransitionImgStyleClass_4_3: "dummy-style-class",
			dataLqpiTransitionImgStyleClass_16_9: "dummy-style-class",
			dataLqpiTransitionImgStyleClass_portrait: "dummy-style-class",

			dataControlLazyImgStyleList: "",
			landscapeDataControlLazyImgStyleList: "",
			portraitDataControlLazyImgStyleList: "",
		};
	},

	created() {
		("use strict");
		this.dataControlLazyImgStyleList = this.controlLazyImgStyleList;
		this.landscapeDataControlLazyImgStyleList = this.landscapeControlLazyImgStyleClass;
		this.portraitDataControlLazyImgStyleList = this.portraitControlLazyImgStyleClass;
	},

	mounted() {
		("use strict");
		this.onMountedLoadImageHandler();

		if (this.isMobileDevice()) {
			const supportedOrientationChange = this.getOrientationChangeEventName();
			if (supportedOrientationChange === "change") {
				window.screen.orientation.addEventListener(
					supportedOrientationChange,
					this.resizeEventCallback,
					false
				);
			} else {
				window.addEventListener(
					supportedOrientationChange,
					this.resizeMobileEventCallback,
					false
				);
			}
		} else {
			this.onMountedDesktopImgCorrectionHandler();
		}
	},

	updated() {
		("use strict");
		this.$_refreshControlLazyImgStyleLists();
	},

	destroyed() {
		("use strict");
		if (this.isMobileDevice()) {
			const supportedOrientationChange = this.getOrientationChangeEventName();
			if (supportedOrientationChange === "change") {
				window.screen.orientation.removeEventListener(
					supportedOrientationChange,
					this.resizeEventCallback
				);
			} else {
				window.removeEventListener(
					supportedOrientationChange,
					this.resizeMobileEventCallback
				);
			}
		} else {
			window.removeEventListener("resize", this.resizeEventCallback);
			document.removeEventListener("fullscreenchange", this.resizeEventCallback);
		}
	},

	methods: {
		onMountedLoadImageHandler: function () {
			("use strict");
			this.dataLqpiTransitionImgStyleClass_4_3 = this.lqpiTransitionImgStyleClass_4_3;
			this.dataLqpiTransitionImgStyleClass_16_9 = this.lqpiTransitionImgStyleClass_16_9;
			this.dataLqpiTransitionImgStyleClass_portrait = this.lqpiTransitionImgStyleClass_portrait;
			// it must a single responsive img array
			const responsiveImages = this.$_extractNonHiddenResponsiveIMGList();
			if (responsiveImages) {
				responsiveImages.forEach((checkedImg) => {
					this.isLoaded = this.isImageLoaded(checkedImg);
					if (this.isLoaded) {
						const helper = this.$root.$data.helper;
						/*
						 * If the image is loaded we wait while it is being rendered.
						 * We provide checking for the state (loaded) in created method.
						 */
						helper.onRenderImgHandler(
							checkedImg,
							this,
							this.$_onSuccessfulImageLoadCallback,
							null
						);
					} else {
						this.$emit("start-loading-img-event", null, this.keyIndex);
						this.$_processImgLoading(checkedImg);
					}
				});
			}
		},

		onMountedDesktopImgCorrectionHandler: function () {
			("use strict");
			// debugger;
			if (
				this.isDesktopAspectRatioCorrection === "true" ||
				this.isDesktopAspectRatioCorrection === true
			) {
				window.addEventListener("resize", this.resizeEventCallback, false);
				document.addEventListener(
					"fullscreenchange",
					this.resizeEventCallback,
					false
				);
				this.$_doDesktopImgCorrection();
			}
		},

		resizeMobileEventCallback: function (event) {
			if (this.isOrientationChanged()) {
				this.resizeEventCallback();
			}
		},

		resizeEventCallback: function (event) {
			("use strict");
			this.$emit("start-loading-img-event", event, this.keyIndex);
			if (this.isMobileDevice()) {
				this.isLoaded = false;
				this.isRendered = false;
			}
			const self = this;
			setTimeout(() => {
				if (
					self.isDesktopAspectRatioCorrection === "true" ||
					self.isDesktopAspectRatioCorrection === true
				) {
					self.$_doDesktopImgCorrection();
				} else {
					self.dataControlLazyImgStyleList = "";
					if (self.controlLazyImgStyleClass) {
						self.dataControlLazyImgStyleList = self.controlLazyImgStyleList;
						self.landscapeDataControlLazyImgStyleList =
							self.landscapeControlLazyImgStyleClass;
						self.portraitDataControlLazyImgStyleList =
							self.portraitControlLazyImgStyleClass;
					}
				}

				let responsiveThrottleTimeout = null;
				const responsiveImages = this.$_extractNonHiddenResponsiveIMGList();
				const _vm = self;
				if ("IntersectionObserver" in window) {
					const _event = event;
					const imageObserver = new IntersectionObserver(function (
						entries,
						observer
					) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting) {
								var image = entry.target;
								_vm.$_processImgLoading(image);
								imageObserver.unobserve(image);
							}
						});
					});

					if (responsiveImages) {
						responsiveImages.forEach(function (image) {
							imageObserver.observe(image);
						});
					}
				} else {
					if (responsiveThrottleTimeout) {
						clearTimeout(responsiveThrottleTimeout);
					}

					responsiveThrottleTimeout = setTimeout(function () {
						var scrollTop = window.pageYOffset;
						responsiveImages.forEach(function (image) {
							if (image.offsetTop < window.innerHeight + scrollTop) {
								_vm.$_processImgLoading(image);
							}
						});
					}, 20);
				}
			}, 50);
		},

		$_updateDesktopImageDashboard: function () {
			("use strict");
			if (this.desktopImageDashboardKey === "desktopImageDashboardKey_0") {
				this.desktopImageDashboardKey = "desktopImageDashboardKey_1";
			} else {
				this.desktopImageDashboardKey = "desktopImageDashboardKey_0";
			}
		},

		$_doDesktopImgCorrection: function () {
			("use strict");
			let widthCoeff = 1.0,
				heightCoeff = 1.0;
			if (this.is4_3AspectRatio()) {
				widthCoeff = this.widthCoeff_4_3;
				heightCoeff = this.heightCoeff_4_3;
			} else {
				widthCoeff = this.widthCoeff_16_9;
				heightCoeff = this.heightCoeff_16_9;
			}
			const resultStyleList = calcAspectRatioStyleClassList(
				".desktop-img-ar-balanced",
				widthCoeff,
				heightCoeff
			);
			if (resultStyleList !== "nd") {
				this.isLoaded = false;
				this.isRendered = false;
				this.dataControlLazyImgStyleList = resultStyleList;
			} else {
				this.dataControlLazyImgStyleList = "";
				if (this.controlLazyImgStyleList) {
					this.dataControlLazyImgStyleList = this.controlLazyImgStyleList;
				}
			}
		},

		$_extractNonHiddenResponsiveIMGList: function () {
			("use strict");
			const responsiveImages = document.querySelectorAll(
				"img." + this.basedLazyImgStyleClass
			);
			if (responsiveImages.length === 0) {
				console.warn(
					"Warn cachedBackgroundImage [onMountedLoadImageHandler] no responsive images were found"
				);
				return null;
			}

			const self = this;
			let extractedResponsiveImages = [...responsiveImages].filter(
				(htmlElemItem) => {
					if (self.isMobileRelatedLayout()) {
						return self.isMobileLevelHTMLElement(htmlElemItem);
					} else {
						return !self.isHiddenHTMLElement(htmlElemItem);
					}
				}
			);

			if (!extractedResponsiveImages || extractedResponsiveImages.length === 0) {
				console.warn(
					"Info [$_extractNonHiddenResponsiveIMGList] Couldn't extract images"
				);
			}

			return extractedResponsiveImages;
		},

		$_processImgLoading: function (image) {
			const helper = this.$root.$data.helper;
			if (image && this.isImageLoaded(image)) {
				helper.onRenderImgHandler(
					image,
					this,
					this.$_onSuccessfulImageLoadCallback,
					null
				);
			} else {
				helper.onImageLoadHandler(
					image,
					null,
					this,
					this.$_onSuccessfulImageLoadCallback,
					this.$_onFailedImageLoadCallback
				);
			}
		},

		$_onSuccessfulImageLoadCallback: function (resolveEvt) {
			("use strict");
			if (!this.isSmooth) {
				this.dataLqpiTransitionImgStyleClass_4_3 = "dummy-style-class";
				this.dataLqpiTransitionImgStyleClass_16_9 = "dummy-style-class";
				this.dataLqpiTransitionImgStyleClass_portrait = "dummy-style-class";
			}

			this.isLoaded = true;
			this.isRendered = true;
			this.$emit("stop-loading-img-event", null, this.keyIndex);
		},

		$_onFailedImageLoadCallback: function (rejectEvt) {
			("use strict");
			this.isLoaded = true;
			this.isRendered = true;
			this.$emit("stop-loading-img-event", null, this.keyIndex);
		},

		$_refreshControlLazyImgStyleLists: function () {
			if (this.controlLazyImgStyleList && this.controlLazyImgStyleList != "") {
				if (this.controlLazyImgStyleList === "reset") {
					this.dataControlLazyImgStyleList = "";
				} else {
					this.dataControlLazyImgStyleList = this.controlLazyImgStyleList;
				}
			}

			if (
				this.landscapeControlLazyImgStyleList &&
				this.landscapeControlLazyImgStyleList != ""
			) {
				this.landscapeDataControlLazyImgStyleList = this.landscapeControlLazyImgStyleList;
			}

			if (
				this.portraitControlLazyImgStyleList &&
				this.portraitControlLazyImgStyleList != ""
			) {
				this.portraitDataControlLazyImgStyleList = this.portraitControlLazyImgStyleList;
			}
		},
	},
};
</script>
