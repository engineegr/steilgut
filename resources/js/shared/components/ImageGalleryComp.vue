<template>
	<div class="transit-flex-box tw-flex tw-items-center tw-justify-center">
		<div v-if="isLoading" class="tw-block loader-container">
			<div
				class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
			></div>
		</div>
		<transition-group
			tag="div"
			name="img-gallery-fade"
			class="transit-flex-box tw-flex tw-flex-col"
		>
			<div
				class="transit-flex-box tw-flex image-gallery"
				key="image-gallery-container"
				v-if="!isLoading"
			>
				<div
					v-for="(imgPath, i) in galleryInfo"
					:key="`${i}_image_path`"
					:id="`${i}_image_path_id`"
					class="image-item fade-inOut-opacity"
					:class="getImageContainerStyleClass(i)"
				>
					<img
						v-if="galleryInfo[i]"
						:src="galleryInfo[i].path"
						class="landscape:tw-object-cover md:tw-object-scale-down tw-object-scale-down"
						:class="getImageStyleClass(i)"
						alt="Gallery image"
					/>
				</div>
			</div>

			<div
				class="img-gallery-control-header tw-max-w-full tw-min-w-full"
				key="image-gallery-control-header"
			>
				<h2 class="image-title tw-ml-0 tw-text-steilgut-gold">
					{{ galleryInfo[curr].title }}
				</h2>
				<div
					class="img-gallery-btn-control tw-flex tw-flex-row tw-mr-0"
					v-if="!isLoading"
				>
					<a
						class="paginator-item tw-cursor-pointer"
						v-on:click="handleClickLeftArrow"
					>
						<img
							src="/images/orig/news-pg/icons/left-arrow.svg"
							class="left-arrow-img"
							alt="paginator-left-arrow"
						/>
					</a>
					<a
						class="paginator-item tw-cursor-pointer"
						v-on:click="handleClickRightArrow"
					>
						<img
							src="/images/orig/news-pg/icons/right-arrow.svg"
							class="right-arrow-img tw-cursor-pointer"
							alt="paginator-right-arrow"
						/>
					</a>
				</div>
			</div>
		</transition-group>
	</div>
</template>

<script>
import validationErrors from "../mixins/validationErrors";
import mediaHelper from "../mixins/mediaHelper";
import { refreshFullPageContainers } from "../utils/resizer";
import { mapGetters, mapState } from "vuex";
import { Helper } from "../utils/helper";
export default {
	mixins: [validationErrors, mediaHelper],

	components: {},

	props: {
		galleryInfo: {
			type: [Array],
			required: true,
		},
	},

	created() {
		("use strict");
		// debugger;
		if (this.$_checkedOrRedirected()) {
			console.log(
				"Debug [ImageGalleryComp::beforeRouteLeave] Initial state is valid"
			);
		}

		this.imgLoadArray = new Array(12);
		this.isLoading = true;

		if (this.isMobileDevice()) {
			document.addEventListener(
				"touchstart",
				this.$_handleTouchStart,
				{
					passive: false,
				},
				false
			);
			document.addEventListener(
				"touchmove",
				this.$_handleMove,
				{
					passive: false,
				},
				false
			);
		}
	},

	destroyed() {
		("use strict");

		if (this.isMobileDevice()) {
			document.removeEventListener("touchstart", this.$_handleTouchStart);
			document.removeEventListener("touchmove", this.$_handleMove);
		}
	},

	mounted() {
		("use strict");
		let i = 0;
		this.galleryInfo.forEach((imgItem) => {
			const img = new Image();
			img.src = imgItem.path;
			this.imgLoadArray[i] = img;
			i++;
		});
		const self = this;
		let timerId = setTimeout(() => {
			function checkLoadFn() {
				let sum = 0;
				self.imgLoadArray.forEach((item) => {
					if (self.isImageLoaded(item)) {
						sum++;
					}
				});

				if (sum !== self.imgLoadArray.length) {
					timerId = setTimeout(checkLoadFn, 200);
				} else {
					self.isLoading = false;
				}
			}

			checkLoadFn();
		}, 200);

		if (document.readyState === "complete") {
			setTimeout(() => {
				self.$_initActiveImage();
			}, 1500);
		} else {
			document.addEventListener("readystatechange", () => {
				if (document.readyState === "complete") {
					this.$_initActiveImage();
				}
			});
		}
	},

	data: function () {
		return {
			curr: 0,
			imgLoadArray: null,
			isLoading: false,

			/* Use for Landscape/Portratit scroll*/
			startClientX: -1,

			isActiveImageFetched: false,
		};
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [ImageGalleryComp::$_checkedOrRedirected] Returned Invalid Arguments"
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

		getImageContainerStyleClass: function (index) {
			if (index === this.curr) {
				return "tw-flex tw-relative tw-z-1";
			} else {
				return "tw-absolute tw-z-n-1 zero-opacity out-of-space";
			}
		},

		handleClickLeftArrow: function () {
			("use strict");
			this.curr = this.curr > 0 ? this.curr - 1 : this.imgLoadArray.length - 1;

			this.$_debindActiveImage();
			const self = this;
			setTimeout(() => {
				self.$_initActiveImage();
			}, 500);
		},

		handleClickRightArrow: function () {
			("use strict");
			this.curr = this.curr < this.imgLoadArray.length - 1 ? this.curr + 1 : 0;

			this.$_debindActiveImage();
			const self = this;
			setTimeout(() => {
				self.$_initActiveImage();
			}, 500);
		},

		$_handleTouchStart: _.throttle(
			function (event) {
				// debugger;
				console.log(
					"Debug [ImageGalleryComp listener: document => $_handleTouchStart]"
				);

				if (this.isActiveImageFetched) {
					return;
				}

				if (
					this.isMobileDevice() &&
					event.touches &&
					event.touches.length === 1
				) {
					this.startClientX = event.touches[0].clientX;
					// event.preventDefault();
				}
			},
			{
				leading: true,
				trailing: true,
			},
			50
		),

		$_handleMove: _.throttle(
			function (event) {
				// debugger;
				console.log("Debug [ImageGalleryComp listener: document => touchMove]");
				// Loading if we are at the page bottom
				if (this.isActiveImageFetched) {
					return;
				}
				if (
					this.isMobileDevice() &&
					event.touches &&
					event.touches.length === 1 &&
					this.startClientX > 0
				) {
					let deltaX = this.startClientX - event.touches[0].clientX;
					deltaX = deltaX < 0 ? deltaX * -1 : deltaX;
					if (deltaX > 33) {
						const swipeLeft = this.startClientX > event.touches[0].clientX;
						if (swipeLeft) {
							this.handleClickRightArrow();
						} else {
							this.handleClickLeftArrow();
						}
						this.startClientX = -1;
					}
				}
			},
			{
				leading: true,
				trailing: false,
			},
			50
		),

		$_fetchActiveImage: function () {
			const activeImage = document.querySelector(".active-image");
			this.isActiveImageFetched = !this.isActiveImageFetched;

			activeImage.style.setProperty("--x", 0 + "px");
			activeImage.style.setProperty("--y", 0 + "px");
			if (!this.isActiveImageFetched) {
				Helper.removeStyleClass("fetched-active-image", ".active-image");
			} else {
				Helper.addStyleClass("fetched-active-image", ".active-image");
			}
		},

		$_moveFetchedActiveImage: function (e) {
			const activeImage = document.querySelector(".active-image");
			if (this.isActiveImageFetched) {
				activeImage.style.setProperty(
					"--x",
					-Math.round(e.offsetX * 0.15) + "px"
				);
				activeImage.style.setProperty(
					"--y",
					-Math.round(e.offsetY * 0.15) + "px"
				);
			}
		},

		$_leaveFetchedActiveImage: function () {
			const activeImage = document.querySelector(".active-image");
			activeImage.style.setProperty("--x", 0 + "px");
			activeImage.style.setProperty("--y", 0 + "px");
			this.isActiveImageFetched = false;
		},

		$_initActiveImage: function () {
			("use strict");
			const activeImage = document.querySelector(".active-image");
			activeImage.addEventListener("click", this.$_fetchActiveImage);
			if (!this.isMobileDevice()) {
				activeImage.addEventListener("mousemove", this.$_moveFetchedActiveImage);
				activeImage.addEventListener(
					"mouseleave",
					this.$_leaveFetchedActiveImage
				);
			}
		},

		$_debindActiveImage: function () {
			("use strict");
			const activeImage = document.querySelector(".active-image");

			activeImage.style.setProperty("--x", 0 + "px");
			activeImage.style.setProperty("--y", 0 + "px");
			activeImage.removeEventListener("click", this.$_fetchActiveImage);
			if (!this.isMobileDevice()) {
				activeImage.removeEventListener(
					"mousemove",
					this.$_moveFetchedActiveImage
				);
				activeImage.removeEventListener(
					"mouseleave",
					this.$_leaveFetchedActiveImage
				);
			}
		},

		getImageStyleClass: function (index) {
			("use strict");
			if (index === this.curr) {
				return "active-image";
			}
			return "";
		},
	},
};
</script>

<style lang="scss" scoped>
.image-gallery {
	display: flex;
	width: 100%;
	max-width: 100%;
	max-height: 55vh;
	max-height: calc(var(--100nvh, 1vh) * 55);

	min-height: 55vh;
	min-height: calc(var(--100nvh, 1vh) * 55);

	flex-direction: row;
	align-items: center;
	justify-content: center;
}

.img-gallery-control-header {
	flex-grow: 1;
	display: inline-flex;
	flex: 0 0 5%;
	justify-content: space-between;
	align-items: flex-start;
	margin-top: 0.5em;

	min-height: 5%;
	max-height: 5%;
}

.img-gallery-btn-control {
	display: flex;
	flex: 0 0 auto;
	flex-direction: row;
	align-self: flex-start;
	align-items: stretch;
	justify-content: center;
}

.img-gallery-btn-control a:nth-child(1) {
	margin-right: 15%;
}

.loader-container .loader {
	margin: auto;
}

.image-item {
	min-width: 100%;
	max-width: 100%;
	display: flex;
	flex: 0 0 0;
	flex-direction: column;
	justify-content: center;
	align-items: center;

	height: 100%;
}

.image-item img {
	display: flex;
	flex: 0 1 100%;
	max-height: 100%;
	min-height: 100%;
	min-width: 100%;
	max-width: 100%;
	margin-left: auto;
	margin-right: auto;
}

.image-item img.fetched-active-image:hover {
	transform: scale(1.5, 1.5);
	transition: 0.3s transform;
}

.image-item img.fetched-active-image {
	transition: object-position 0.25s;
}

.image-item img.active-image {
	--x: 0px;
	--y: 0px;
	// object-position: var(--x) var(--y);
}

h2.image-title {
	font-family: "steilgut_opensans";
	font-weight: lighter;
	font-style: italic;
	font-size: calc(0.5em + 0.2vw);
	font-size: calc(0.5em + var(--100nvw, 1vw) * 0.2);
	font-size: 1rem;
}

.img-gallery-fade-enter-active {
	transition: opacity 3s ease;
}

.img-gallery-fade-enter
/* .component-fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.img-gallery-fade-leave {
	display: none;
}

.img-gallery-control-header h2.image-title {
	margin-right: 0.275em;
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

	.image-gallery,
	.img-gallery-control-header {
		max-height: unset;
		min-height: unset;
	}

	.image-item img.active-image {
		object-position: unset;
		margin: 0 auto;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	/* @media only screen and (min-width: 320px) and (max-device-height: 896px) and (max-aspect-ratio: 13/9) { */
	.image-item,
	.image-item img {
		display: block;
		min-width: 100%;
		max-width: 100%;
	}

	.image-gallery,
	.image-item {
		min-height: 30vh;
		max-height: 30vh;
	}

	.image-item img {
		display: block;
		max-height: 100%;
		margin: auto 0;
	}

	.img-gallery-control-header {
		flex: 1 0 auto;
		min-height: 10vh;
		margin: 2vh auto;

		align-items: center;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-device-height: 640px) and (orientation: portrait) {
	.image-gallery {
		min-height: 40vh;
		max-height: 40vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media screen and (min-width: 1025px) and (max-height: 1080px) and (orientation: landscape) {
	.image-gallery {
		flex: 0 0 auto;
		min-height: 45vh;
		min-height: calc(var(--100nvh, 1vh) * 45);

		max-height: 45vh;
		max-height: calc(var(--100nvh, 1vh) * 45);
	}

	.image-item {
		min-width: 100%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media screen and (min-width: 1025px) and (max-height: 800px) and (orientation: landscape) {
	.image-gallery {
		min-height: 30vh;
		min-height: calc(var(--100nvh, 1vh) * 30);

		max-height: 30vh;
		max-height: calc(var(--100nvh, 1vh) * 30);
	}

	.image-item {
		min-width: 60%;
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
	.image-gallery {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		min-width: 100%;
		max-width: 100%;
		height: auto;
	}

	.image-item {
		display: flex;
		flex: 1 0 auto;
		max-width: 100%;
		max-height: 100%;
		min-height: 70vh;
		max-height: 70vh;
	}

	.image-item img {
		display: block;
		max-height: 100%;
		height: 100%;
	}

	.img-gallery-control-header {
		flex: 1 0 auto;
		min-height: 13vh;
		margin-top: 0;
		align-items: center;
		margin: 2vh auto;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}
</style>
