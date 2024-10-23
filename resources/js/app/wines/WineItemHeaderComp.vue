<template>
	<div class="tw-block">
		<!-- Desktop/Phone Landscape layout -->
		<div
			v-if="!mdViewHidden"
			:class="[
				'item-row',
				'md:tw-flex',
				'landscape:tw-flex',
				'tw-hidden',
				'tw-max-w-full',
				'tw-w-full',
			]"
		>
			<!-- <img
				:key="`${itemKey}_image`"
				:class="[
					'item-image',
					'tw-object-fill',
					'tw-z-10',
					'tw-cursor-pointer',
					{ 'tw-mr-0': isOpen },
				]"
				:src="itemData.image"
				:alt="itemData.title"
				v-on:click.prevent="handleOpenItemClick"
			/> -->

			<lazy-load-picture
				:class="[
					'item-image',
					'tw-object-fill',
					'tw-z-10',
					'tw-cursor-pointer',
					{ 'tw-mr-0': isOpen },
				]"
				:keyIndex="`${itemKey}_image`"
				imageClass="wine-slider-item-img__sz"
				:image="itemData.image"
				v-on:on-picture-click.prevent="handleOpenItemClick"
				v-on:stop-loading-img-event="handleHeaderImageLoaded"
			>
			</lazy-load-picture>
			<header
				class="item-header tw-flex tw-flex-col tw-items-center tw-justify-center tw-cursor-pointer fade-inOut-opacity"
				:class="{ 'tw-opacity-0': !isHeaderImgLoaded }"
				v-on:click.prevent="handleOpenItemClick"
				:key="`${itemKey}_header`"
			>
				<h1 :class="['title-text']">
					{{ itemData.title }}
				</h1>
				<div
					class="terroir-block tw-relative tw-flex tw-flex-row tw-items-center tw-justify-center"
				>
					<span :class="['terroir-text', 'tw-capitalize']">{{
						itemData.terroir.split(",")[0]
					}}</span>
					<div class="right-arrow">
						<a href="#">
							<svg
								width="38px"
								height="13px"
								viewBox="0 0 38 13"
								version="1.1"
								xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink"
							>
								<title>icon/next-long</title>
								<g
									id="Page-1"
									stroke="none"
									stroke-width="1"
									fill="none"
									fill-rule="evenodd"
								>
									<g
										id="wine-line"
										transform="translate(-404.000000, -866.000000)"
										fill="#FFFFFF"
										fill-rule="nonzero"
									>
										<g
											id="icon/next-long"
											transform="translate(404.000000, 866.000000)"
										>
											<path
												d="M37.6254613,6.06365414 C37.6254613,5.91659598 37.5648891,5.7761307 37.4640728,5.6703697 L32.0117494,0.162968165 C31.7963815,-0.0545973389 31.4477364,-0.054047931 31.232918,0.162968165 C31.0175501,0.379984262 31.0175501,0.732475174 31.232918,0.949491271 L35.7455708,5.50733292 L0.550781359,5.50733292 C0.246775688,5.5073787 0,5.75630624 0,6.06365414 C0,6.37100204 0.246775688,6.61997536 0.550781359,6.61997536 L35.7450214,6.61997536 L31.232918,11.177817 C31.0175501,11.3948331 31.0180995,11.747324 31.232918,11.9643401 C31.4482858,12.1813562 31.7969309,12.1813562 32.0117494,11.9643401 L37.4640728,6.45693858 C37.5670409,6.3528258 37.6238131,6.20961349 37.6254613,6.06365414 Z"
												id="Arrow_Forward"
											></path>
										</g>
									</g>
								</g>
							</svg>
						</a>
					</div>
				</div>
			</header>
		</div>

		<div v-if="!mobileViewHidden" :class="['md:tw-hidden']">
			<!-- Phone portrait layout -->
			<div
				:class="[
					'landscape:tw-hidden',
					'tw-flex',
					'tw-relative',
					'tw-z-2',
					'tw-w-full',
					'tw-max-w-full',
					calcWineItemStyleClass,
				]"
			>
				<!-- <img
					v-if="!isOdd || isOpen"
					:class="[
						'tw-object-fill',
						'down-item-image',
						calcWineItemImageStyleClass,
					]"
					:src="itemData.image"
					:alt="itemData.title"
					v-on:click.prevent="handleItemImageClick"
				/> -->
				<lazy-load-picture
					v-if="!isOdd || isOpen"
					:class="[
						'tw-object-fill',
						'down-item-image',
						calcWineItemImageStyleClass,
					]"
					:keyIndex="`${itemKey}_image_portrait`"
					imageClass="wine-slider-item-img__sz"
					:image="itemData.image"
					v-on:on-picture-click.prevent="handleItemImageClick"
					v-on:stop-loading-img-event="handleHeaderImageLoaded"
				>
				</lazy-load-picture>

				<header
					v-if="!isOpen"
					class="item-header tw-flex tw-flex-col tw-items-center tw-justify-center"
					:class="[
						calcItemHeaderStyleClass,
						{ 'tw-opacity-0': !isHeaderImgLoaded },
					]"
				>
					<h1 class="title-text">
						{{ itemData.title }}
					</h1>
					<div class="terroir-block">
						<span class="terroir-text tw-capitalize">{{
							itemData.terroir.split(",")[0]
						}}</span>
						<div class="right-arrow" v-on:click.prevent="handleOpenItemClick">
							<a href="">
								<svg
									width="38px"
									height="13px"
									viewBox="0 0 38 13"
									preserveAspectRatio="none"
									version="1.1"
									xmlns="http://www.w3.org/2000/svg"
									xmlns:xlink="http://www.w3.org/1999/xlink"
								>
									<title>icon/next-long</title>
									<g
										id="Page-1"
										stroke="none"
										stroke-width="1"
										fill="none"
										fill-rule="evenodd"
									>
										<g
											id="wine-line"
											transform="translate(-404.000000, -866.000000)"
											fill="#FFFFFF"
											fill-rule="nonzero"
										>
											<g
												id="icon/next-long"
												transform="translate(404.000000, 866.000000)"
											>
												<path
													d="M37.6254613,6.06365414 C37.6254613,5.91659598 37.5648891,5.7761307 37.4640728,5.6703697 L32.0117494,0.162968165 C31.7963815,-0.0545973389 31.4477364,-0.054047931 31.232918,0.162968165 C31.0175501,0.379984262 31.0175501,0.732475174 31.232918,0.949491271 L35.7455708,5.50733292 L0.550781359,5.50733292 C0.246775688,5.5073787 0,5.75630624 0,6.06365414 C0,6.37100204 0.246775688,6.61997536 0.550781359,6.61997536 L35.7450214,6.61997536 L31.232918,11.177817 C31.0175501,11.3948331 31.0180995,11.747324 31.232918,11.9643401 C31.4482858,12.1813562 31.7969309,12.1813562 32.0117494,11.9643401 L37.4640728,6.45693858 C37.5670409,6.3528258 37.6238131,6.20961349 37.6254613,6.06365414 Z"
													id="Arrow_Forward"
												></path>
											</g>
										</g>
									</g>
								</svg>
							</a>
						</div>
					</div>
				</header>
				<!--  odd is a up image-->
				<img
					v-if="isOdd && !isOpen"
					class="item-image up-item-image tw-object-fit tw-relative tw-z-10"
					:src="itemData.image"
					:alt="itemData.title"
					v-on:click.prevent="handleItemImageClick"
				/>
			</div>
		</div>
	</div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
export default {
	props: {
		itemData: [Object],
		itemKey: [Number, String],
		isActive: [Boolean, String],
		isOdd: [Boolean, String],
		isOpen: [Boolean, String],
		mobileViewHidden: {
			type: [Boolean, String],
			default: false,
		},

		mdViewHidden: {
			type: [Boolean, String],
			default: false,
		},
	},

	data: function () {
		return {
			isHeaderImgLoaded: false,
		};
	},

	methods: {
		handleItemImageClick: function (event) {
			"use strict";

			if (this.isOpen) {
				this.handleCloseItemClick(event);
			} else {
				this.handleOpenItemClick(event);
			}
		},
		handleCloseItemClick: function (event) {
			"use strict";
			this.$emit("close-item-click", event);
		},

		handleOpenItemClick: function (event) {
			"use strict";
			this.$emit("open-item-click", event);
		},

		handleHeaderImageLoaded: function (event) {
			this.isHeaderImgLoaded = true;
		},

		$_calcItemKeyIndex: function () {
			const keyRegPattern = /(\d+)_sliderItemHeader/;
			let [_, keyIndex] = keyRegPattern.exec(this.itemKey);
			return parseInt(keyIndex);
		},
	},

	computed: {
		ifActive: function () {
			const keyRegexp = new RegExp(
				this.sliderControlCursor + "_sliderItemHeader",
				"g"
			);
			return keyRegexp.test(this.itemKey);
		},

		ifOdd: function () {
			const keyRegPattern = /(\d+)_sliderItemHeader/;
			let [_, key] = keyRegPattern.exec(this.itemKey);
			return 0 !== parseInt(key) % 2;
		},

		calcWineItemStyleClass: function () {
			return this.isOpen ? "item-row-open" : "item-row";
		},

		calcWineItemImageStyleClass: function () {
			return this.isOpen ? "item-image-open" : "item-image";
		},

		calcItemHeightClass: function () {
			return this.$_calcItemKeyIndex() === this.sliderControlTo
				? "tw-h-auto"
				: "tw-h-full tw-min-h-full";
		},

		calcItemHeaderStyleClass: function () {
			return this.isOdd ? "up-header-container" : "down-header-container";
		},

		...mapState({
			sliderControlCursor: (state) => {
				return state.slider.control.cursor;
			},

			sliderControlTo: (state) => {
				return state.slider.control.to;
			},
		}),
	},
};
</script>

<style lang="scss">
@media only screen and (min-width: 320px) and (orientation: portrait) {
	.wine-slider-item-img__sz {
		max-height: 40vh;
		max-height: calc(var(--100vh, 1vh) * 40);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.wine-slider-item-img__sz {
		max-width: 25vw;
		max-height: 60vh;
		max-height: calc(var(--100vh, 1vh) * 60) !important;
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.wine-slider-item-img__sz {
		max-height: 55vmin;
		max-height: calc(var(--100nvmin, 1vmin) * 55);
	}
}
</style>

<style lang="scss" scoped>
header .terroir-text {
	font-family: "steilgut_opensans";
	font-weight: 100;
}

.right-arrow {
	position: relative;
	display: inline-block;
	width: 38px;
	max-width: 38px;
	height: auto;
	-webkit-transition: -webkit-transform 1s;
	transition: -webkit-transform 1s;
	transition: transform 1s;
	transition: transform 1s, -webkit-transform 1s;
}

.right-arrow:hover {
	transform: translateX(+50%);
	-webkit-transform: translateZ(0) translateY(0%) translateX(+50%);
	transform: translateZ(0) translateY(0%) translateX(+50%);
}

.item-header {
	position: relative;
	z-index: 2;
}

.right-arrow {
	top: 0%;
	right: 0%;
	transform: translate(0%, 0%);
}

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.title-text {
		margin: 1.5vh 0;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.item-row {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		align-items: flex-end;
		justify-content: space-between;
		max-height: 35vh;
		max-height: calc(var(--100vh, 1vh) * 35);
	}

	.item-row-open {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		align-items: center;
		justify-content: flex-end;
	}

	.right-arrow svg {
		margin-left: 0.5em;
		margin-left: 2vmin;
	}

	.item-image {
		position: relative;
		max-height: 40vh;
		max-height: calc(var(--100vh, 1vh) * 40);
	}

	.up-item-image {
		margin: auto 13vw auto auto;
	}

	.up-header-container {
		margin: auto 0 0 8vw;
	}

	.down-item-image {
		margin: auto auto auto 15vw;
	}

	.down-header-container {
		margin: auto 11vw 0 0;
	}

	.item-image-open {
		position: relative;
		max-width: 35vw;
		max-height: 75vh;
	}

	.item-header {
		max-width: 50vw;
		width: fit-content;
	}

	.title-text {
		font-size: calc(1em + 2vh);
		font-size: 8vmin;
		width: 100%;
		max-width: 100%;
		text-align: left;
	}

	.terroir-block {
		display: flex;
		justify-content: space-between;
		align-items: center;
		width: 100%;
		max-width: 100%;
		flex: 1 0 auto;
	}

	.terroir-text {
		font-size: calc(0.6em + 0.4vw);
		font-size: 4.5vmin;
		width: 100%;
		max-width: 100%;
		text-align: left;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.item-row {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}

	.right-arrow {
		top: 0%;
		right: 0%;
		transform: translate(0%, 0%);
		margin-left: 1vw;
		width: 7vmin;

		svg {
			max-width: 7vmin;
		}
	}

	.item-image {
		max-width: 25vw;
		max-height: 60vh;
		max-height: calc(var(--100vh, 1vh) * 60) !important;
	}

	.title-text {
		font-size: calc(1em + 0.5vw);
		font-size: 6vmin;
		width: 100%;
		max-width: 100%;
		text-align: left;
	}

	.terroir-block {
		width: 100%;
		max-width: 100%;
		flex: 1 0 auto;
		height: fit-content;
	}

	.terroir-text {
		font-size: calc(0.6em + 0.4vw);
		font-size: 3vmin;
		width: 100%;
		max-width: 100%;
		text-align: left;
	}

	.item-header {
		margin: auto 2vw 0 2vw;
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.item-row {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		align-items: center;
		justify-content: flex-start;
	}

	.item-image {
		max-height: 55vmin;
		max-height: calc(var(--100nvmin, 1vmin) * 55);
	}

	h1.title-text {
		font-size: calc(1.7em + 0.5vmin);
		font-size: calc(1.7em + var(--100nvmin, 1vmin) * 0.5);
		width: 100%;
		max-width: 100%;
		text-align: center;
		margin: 1vmin;
		margin: var(--100nvmin, 1vmin);
		letter-spacing: 0;
	}

	.terroir-block {
		width: 100%;
		max-width: 100%;
		height: fit-content;
	}

	.terroir-text {
		font-size: 1.3em;
		font-size: calc(1vmin + 0.5em);
		font-size: calc(var(--100nvmin, 1vmin) * 1 + 0.5em);
		display: flex;
		align-items: center;
		justify-content: flex-start;
		width: 100%;
		max-width: 100%;
		text-align: left;
		margin-right: 1em;
		margin-right: calc(0.7vmin + 0.3em);
		margin-right: calc(var(--100nvmin, 1vmin) * 0.7 + 0.3em);
	}
}

/*********************************************************************
*
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
