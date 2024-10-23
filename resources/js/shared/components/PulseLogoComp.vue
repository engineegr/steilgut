<template>
	<div class="transit-flex-box tw-flex">
		<div :class="['tw-absolute', calcColorLogoStyleClass, calcVisibilityClass]"></div>
		<button class="tw-fixed tw-z-20 tw-inset-0 tw-h-sreen tw-w-screen tw-min-w-screen tw-bg-transparent focus:tw-outline-none tw-cursor-default"></button>
	</div>
</template>

<script>
import routeObserver from "../mixins/routeObserver";
export default {
	mixins: [routeObserver],

	props: {
		isDefer: {
			required: false,
			default: false,
			type: [String, Boolean],
		},
		isDark: {
			required: false,
			default: false,
			type: [String, Boolean],
		},
	},

	data: function () {
		return {
			isVisible: true,
		};
	},

	mounted() {
		("use strict");
		if (this.isDefer) {
			this.isVisible = false;
			const self = this;
			setTimeout(() => {
				self.isVisible = true;
			}, 500);
		}
	},

	computed: {
		calcColorLogoStyleClass: function () {
			("use strict");
			if (this.ifLightBackgroundPage() || this.isDark) {
				return "black-steilgut-pulse";
			} else {
				return "white-steilgut-pulse";
			}
		},

		getPulseStyleClass: function () {
			return "pulse-animation";
		},

		calcVisibilityClass: function () {
			("use strict");
			if (this.isDefer) {
				if (this.isVisible) {
					return "tw-z-21 tw-block " + this.getPulseStyleClass;
				} else {
					return "tw-z-n-1 tw-opacity-0";
				}
			}
			return "tw-z-21 tw-block";
		},
	},
};
</script>

<style lang="scss" scoped>
.white-steilgut-pulse {
	position: fixed;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background: url('/images/icons/pulse-logo/white-pulse-logo.png');
	background-size: contain;
	background-repeat: no-repeat;
	width: 185px;
	height: 130px;
}

.black-steilgut-pulse {
	position: fixed;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background: url('/images/icons/pulse-logo/black-pulse-logo.png');
	background-size: contain;
	background-repeat: no-repeat;
	width: 185px;
	height: 130px;
}

.pulse-animation {
	animation: pulse 5s infinite;
}

@keyframes pulse {
	0% {
		transform: translate(-50%, -50%);
		opacity: 0.5;
	}

	50% {
		transform: translate(-50%, -50%) scale(2);
		opacity: 0.7;
	}

	100% {
		transform: translate(-50%, -50%) scale(1);
		opacity: 1;
	}
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

/* all devices (portrait) ----------- */
@media only screen and (min-width: 320px) and (orientation: portrait) {
}

/* Smartphones (landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
}

/* Tablets, ipads, laptops, desktops (landscape) ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}
</style>
