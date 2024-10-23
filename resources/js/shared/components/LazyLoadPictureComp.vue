<template>
	<div
		class="lazy-load-picture tw-flex"
		:style="{ width: boxWidth, height: boxHeight }"
		:class="getContainerClass"
		v-on:click="handlePictureClick"
	>
		<img
			:src="image"
			alt="Lazy Picture"
			class="lazy-load-picture__img tw-object-contain fade-inOut-opacity"
			:class="[getPictureClass, imageClass, 'lazy-load-picture__img__' + keyIndex]"
		/>
	</div>
</template>

<script>
import mediaHelper from "../../shared/mixins/mediaHelper";
export default {
	mixins: [mediaHelper],
	props: {
		keyIndex: {
			type: [String, Number],
			default: 0,
		},

		image: {
			type: String,
			default: "picture-src",
		},

		placeholderClass: {
			type: String,
			default: "tw-bg-transparent",
		},

		imageClass: {
			type: String,
		},

		boxWidth: {
			type: [String, Number],
			default: "auto",
		},
		boxHeight: {
			type: [String, Number],
			default: "auto",
		},
	},

	data: function () {
		return {
			isPictureReady: false,
		};
	},

	mounted() {
		this.onLoadImageHandler();

		if (this.isMobileDevice()) {
			const supportedOrientationChange = this.getOrientationChangeEventName();
			if (supportedOrientationChange === "change") {
				window.screen.orientation.addEventListener(
					supportedOrientationChange,
					this.onLoadImageHandler,
					false
				);
			} else {
				window.addEventListener(
					supportedOrientationChange,
					this.onLoadImageHandler,
					false
				);
			}
		} else {
			window.addEventListener("resize", this.onLoadImageHandler, false);
		}
	},

	destroyed() {
		if (this.isMobileDevice()) {
			const supportedOrientationChange = this.getOrientationChangeEventName();
			if (supportedOrientationChange === "change") {
				window.screen.orientation.removeEventListener(
					supportedOrientationChange,
					this.onLoadImageHandler
				);
			} else {
				window.removeEventListener(
					supportedOrientationChange,
					this.onLoadImageHandler
				);
			}
		} else {
			window.removeEventListener("resize", this.onLoadImageHandler);
		}
	},

	computed: {
		getContainerClass: function () {
			if (this.isPictureReady) {
				return "tw-bg-transparent";
			}
			return this.placeholderClass;
		},

		getPictureClass: function () {
			if (this.isPictureReady) {
				return "tw-opacity-100";
			}
			return "tw-opacity-0";
		},
	},

	methods: {
		onLoadImageHandler: function () {
			const helper = this.$root.$data.helper;
			let picture = this.$_getImage();
			this.isPictureReady = this.isImageLoaded(picture);
			if (!this.isPictureReady) {
				helper.onImageLoadHandler(
					picture,
					null,
					this,
					this.$_onSuccessfulImageLoadCallback,
					this.$_onFailedImageLoadCallback
				);
			} else {
				helper.onRenderImgHandler(
					picture,
					this,
					this.$_onSuccessfulImageLoadCallback,
					null
				);
			}
		},

		$_getImage: function () {
			return document.querySelector(
				"." + "lazy-load-picture__img__" + this.keyIndex
			);
		},

		$_onSuccessfulImageLoadCallback: function (resolveEvt) {
			("use strict");
			this.isPictureReady = true;
			this.$emit("stop-loading-img-event", null, this.keyIndex);
		},

		$_onFailedImageLoadCallback: function (rejectEvt) {
			("use strict");
			this.isPictureReady = true;

			this.$emit("stop-loading-img-event", null, this.keyIndex);
		},

		handlePictureClick: function (evt) {
			this.$emit("on-picture-click", evt);
		},
	},
};
</script>

<style scoped lang="scss">
.lazy-load-picture {
	&__img {
	}

	&__placeholder {
	}
}
</style>
