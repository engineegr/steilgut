<template>
	<div class="wines-cart">
		<div class="md:tw-block tw-hidden landscape:tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="desktop-bg-cart-pg-img"
				relativePath="cart-pg"
				baseName="bg-cart-pg"
				lqipPath_4_3="/images/4_3/cart-pg/lqip_4_3/jpg/4_3-lqip-bg-cart-pg.jpg"
				lqipPath_16_9="/images/16_9/cart-pg/lqip_16_9/jpg/16_9-lqip-bg-cart-pg.jpg"
				lazyLoadImgStyleClass_16_9=""
				lazyLoadImgStyleClass_4_3=""
				transitionImgStyleClass_16_9="fade-inOut-opacity"
				transitionImgStyleClass_4_3="fade-inOut-opacity"
				lazyLoadCommonImgStyleClass="tw-absolute tw-z-0 tw-object-cover tw-inset-0"
				:isDesktopAspectRatioCorrection="true"
			></lazy-load-image-comp>
		</div>

		<div class="landscape:tw-block tw-hidden md:tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="landscape-bg-cart-pg-img"
				relativePath="cart-pg"
				baseName="bg-cart-pg"
				lqipPath_4_3="/images/4_3/cart-pg/lqip_4_3/jpg/4_3-lqip-bg-cart-pg.jpg"
				lqipPath_16_9="/images/16_9/cart-pg/lqip_16_9/jpg/16_9-lqip-bg-cart-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-n-1 tw-inset-0 tw-object-fill tw-max-w-full tw-w-full fp"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				:isBackgroundShadow="false"
				:isLandscapeBackgroundShadow="false"
				:isPortraitBackgroundShadow="false"
			></lazy-load-image-comp>
			<background-shadow-comp class="tw-fixed" zIndexClass="tw-z-1">
			</background-shadow-comp>
		</div>
		<cart-slider class="tw-relative tw-z-4" ref="slotProps">
			<template v-slot:mdHeaderAddition>
				<div class="tw-block">
					<h2 class="header-precaution-text">
						{{ __("cart.numberPrecautionMsg") }}
					</h2>
				</div>
			</template>
			<template v-slot:mdCartMain="slotProps">
				<div class="store-item-list">
					<div
						v-for="i in slotProps.itemQuantityPerPage"
						:key="`${slotProps.from + i - 1}_storeSliderItem`"
						class="tw-block"
					>
						<store-item-header
							v-if="
								slotProps.getSliderItemDataByKeyCallback({
									i,
								}).item
							"
							:itemData="
								slotProps.getSliderItemDataByKeyCallback({
									i,
								}).item
							"
							:itemKey="`${slotProps.from + i - 1}_sliderItemHeader`"
						>
						</store-item-header>
					</div>
				</div>
				<div v-if="isDELocale()">
					<h2 class="additional-note-text">
						{{ __("store.sulfiteNote") }}
					</h2>
				</div>
			</template>
			<template v-slot:landscapeCartMain="slotProps">
				<div class="store-item-list">
					<div
						v-for="i in slotProps.itemQuantityPerPage"
						:key="`${slotProps.from + i - 1}_storeSliderItem`"
						class="tw-block tw-flex-grow"
					>
						<store-item-header
							v-if="
								slotProps.getSliderItemDataByKeyCallback({
									i,
								}).item
							"
							:itemData="
								slotProps.getSliderItemDataByKeyCallback({
									i,
								}).item
							"
							:itemKey="`${slotProps.from + i - 1}_sliderItemHeader`"
						>
						</store-item-header>
					</div>
				</div>

				<div v-if="isDELocale()">
					<h2 class="additional-note-text">
						{{ __("store.sulfiteNote") }}
					</h2>
				</div>
			</template>

			<template v-slot:portraitCartHeader="slotProps">
				<header class="tw-relative tw-z-3 cart-header-block">
					<div class="tw-relative tw-z-1 tw-overflow-hidden">
						<img
							src="/images/mobile/cart-pg/portrait/jpg/portrait-2x-bg-store-up-side.jpg"
							srcset="
								/images/mobile/cart-pg/portrait/jpg/portrait-bg-store-up-side.jpg,
								/images/mobile/cart-pg/portrait/jpg/portrait-2x-bg-store-up-side.jpg 2x
							"
							class="tw-relative tw-z-n-1 tw-inset-0 tw-object-cover tw-w-full tw-max-w-full"
						/>
						<background-shadow-comp
							zIndexClass="tw-z-1"
						></background-shadow-comp>

						<section
							class="header-paragraph tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-py-2 tw-px-4"
						>
							<div class="header-underline">
								<h1 class="header-text" v-if="slotProps.itemQuantity > 0">
									{{ __("cart.header") }}
								</h1>
								<h1
									class="header-text"
									v-if="slotProps.itemQuantity === 0"
								>
									{{ __("cart.emptyCartMessage") }}
								</h1>
								<img
									class="title-underline-img"
									src="/images/icons/cart-pg/white-header-underscore-line.svg"
								/>
							</div>
						</section>
					</div>
				</header>
			</template>

			<template v-slot:portraitCartMain="slotProps">
				<img
					src="/images/mobile/cart-pg/portrait/jpg/portrait-bg-store-down-side.jpg"
					srcset="
						/images/mobile/cart-pg/portrait/jpg/portrait-bg-store-down-side.jpg,
						/images/mobile/cart-pg/portrait/jpg/portrait-2x-bg-store-down-side.jpg 2x
					"
					class="tw-absolute tw-z-n-1 tw-object-cover tw-w-full tw-max-w-full"
				/>
				<div class="store-items-list-container tw-relative tw-z-2">
					<div class="store-item-list" v-if="slotProps.itemQuantity > 0">
						<div
							v-for="i in slotProps.itemQuantityPerPage"
							:key="`${slotProps.from + i - 1}_storeSliderItem`"
							class="store-item tw-flex tw-flex-grow"
						>
							<store-item-header
								v-if="
									slotProps.getSliderItemDataByKeyCallback({
										i,
									}).item
								"
								:itemData="
									slotProps.getSliderItemDataByKeyCallback({
										i,
									}).item
								"
								:itemKey="`${slotProps.from + i - 1}_sliderItemHeader`"
							>
							</store-item-header>
						</div>
					</div>
					<div v-else>
						<article class="empty-cart-announcement-text-container">
							<!-- eslint-disable vue/no-v-html -->
							<div
								class="empty-cart-announcement-text"
								v-html="__('cart.emptyCartAnnouncement')"
							></div>
							<!--eslint-enable-->
						</article>
					</div>

					<div
						v-if="isDELocale() && slotProps.itemQuantity > 0"
						class="additional-note-container"
					>
						<h2 class="additional-note-text">
							{{ __("store.sulfiteNote") }}
						</h2>
					</div>
				</div>
			</template>
		</cart-slider>
	</div>
</template>

<script>
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";
import StoreItemHeaderComp from "../store/StoreItemHeaderComp";
import CartSliderComp from "../../shared/components/CartSliderComp";
import mediaHelper from "../../shared/mixins/mediaHelper";
import validationErrors from "../../shared/mixins/validationErrors";
import { mapState, mapGetters } from "vuex";

export default {
	mixins: [mediaHelper, validationErrors],

	components: {
		"store-item-header": StoreItemHeaderComp,
		"cart-slider": CartSliderComp,
		"background-shadow-comp": BackgroundShadowComp,
	},
};
</script>

<style lang="scss" scoped>
.wines-cart {
	display: flex;
	flex: 1 0 75%;
	flex-direction: column;
	align-items: stretch;
	max-width: 62.3125vw;
	max-width: calc(var(--100nvw, 1vw) * 62.3125);
	width: 62.3125vw;
	width: calc(var(--100nvw, 1vw) * 62.3125);
	margin: auto 3vw auto auto;
	margin: 0 calc(var(--100nvw, 1vw) * 3) 0 auto;
	max-height: 82%;
	max-height: 82vh;
	max-height: calc(var(--100nvh, 1vh) * 82);
	height: 82%;
	height: 82vh;
	height: calc(var(--100nvh, 1vh) * 82);
	/* position: relative; */
	/* border: 2px solid #ebcb9a; */
}

h2.header-precaution-text,
h2.additional-note-text {
	font-family: "steilgut_opensans";
	font-weight: 100;

	color: #313131;
	height: fit-content;
	width: fit-content;
}

h2.header-precaution-text {
	font-size: 0.8rem;
	font-size: 1.4vmin;
	font-size: calc(var(--100nvmin, 1vmin) * 1.4);
	padding-top: 1vh;
	padding-top: calc(var(--100nvh, 1vh));
}

.store-item-list {
	display: grid;
	grid-template-columns: repeat(2, 50%);
	grid-template-rows: repeat(2, 50%);
	justify-items: flex-start;
	align-items: center;
	gap: 1vh 1vw;
	gap: calc(var(--100nvh, 1vh)) calc(var(--100nvw, 1vw));
	flex-grow: 1;
	width: 100%;
	max-width: 100%;
}

h2.additional-note-text {
	font-size: calc(0.7rem + 0.5vh);
	font-size: calc(0.7rem + calc(var(--100nvh, 1vh) * 0.5));
	padding: 1vmin 0;
	padding: var(--100nvmin, 1vmin) 0;
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
	.wines-cart {
		height: auto;
		min-height: unset;
		max-height: unset;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.cart-header-block {
		height: auto;
		width: 100%;
		max-width: 100%;
		margin: 0;
	}

	.cart-header-block .header-text {
		margin: auto;
		color: #ffffff;
		font-size: calc(1.8rem + 1vh);
	}

	.header-block {
		padding-left: 10%;
	}

	.header-underline {
		padding-top: 2.4444vh;
	}

	.empty-cart-announcement-text-container {
		padding: 2vmin;
	}

	.empty-cart-announcement-text {
		font-family: "steilgut_opensans";
		font-weight: 100;
		font-size: calc(1rem + 0.6vw);
		padding: 2.5vh 1.5vh;
		color: #313131;
		text-align: justify;
	}

	.additional-note-container {
		margin: 2vh auto 0 3vw;
	}

	h2.additional-note-text {
		font-size: calc(1rem + 0.6vw);
	}

	.wines-cart {
		position: absolute;
		width: 100%;
		max-width: 100%;
		margin: 0;
	}

	.store-item-list {
		display: flex;
		flex-direction: column;
		flex: 1 0 auto;
		align-items: center;
		justify-content: center;
		height: auto;
	}

	.store-item:first-child {
		margin: 1.9rem auto 0.95em auto;
	}

	.store-item {
		width: 100%;
		max-width: 100%;
		margin: 0.95em auto 0.95em auto;
		padding-bottom: 3vh;
	}
}

@media only screen and (min-width: 321px) and (max-width: 1024px) and (orientation: landscape) {
	.wines-cart {
		position: absolute;
		left: 30.6875vw;
		display: flex;
		flex: 1 0 100%;
		flex-direction: column;
		align-items: stretch;
		max-width: 62.3125vw;
		width: 62.3125vw;
		max-height: 100%;
		height: 100%;
		/* position: relative; */
		/* border: 2px solid #ebcb9a; */
	}
	.store-item-list {
		display: flex;
		flex-direction: row;
		flex: 1 0 auto;
		justify-content: space-around;
		align-items: center;
		margin: auto;
	}

	.store-item {
		height: 100%;
		max-height: 100%;
		width: 45%;
		max-width: 45%;
	}

	h2.additional-note-text {
		font-size: 0.7rem;
		font-size: calc(var(--100vh, 1vh) * 3);
	}

	.wines-cart {
		margin: auto 6vw auto auto;
	}
}

@media only screen and (min-width: 321px) and (max-width: 692px) and (orientation: landscape) {
	h2.additional-note-text {
		font-size: calc(0.7rem + 0.4vh);
		font-size: calc(0.7rem + var(--100nvh, 1vh) * 0.4);
	}

	.store-item {
		padding-bottom: 5vh;
		padding-bottom: calc(var(--100nvh, 1vh) * 5);
	}

	.store-item:last-child {
		padding-bottom: 0;
	}
}

@media only screen and (min-width: 897px) and (max-height: 620px) and (-webkit-min-device-pixel-ratio: 1) {
	h2.additional-note-text {
		font-size: calc(0.6rem + 0.5vmin);
		font-size: calc(0.6rem + var(--100vmin, 1vmin) * 0.5);
	}
}
</style>
