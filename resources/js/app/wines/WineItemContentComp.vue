<template>
	<div v-if="isError">
		<error-comp></error-comp>
	</div>
	<div
		v-else
		class="md:tw-max-w-full md:tw-w-full md:tw-h-full transit-flex-box item-row"
	>
		<div
			class="fade-inOut-opacity-wine-slider"
			v-show="isLoading"
			:class="{ 'zero-opacity': !this.isInvisible }"
		>
			<pulse-logo-comp></pulse-logo-comp>
		</div>
		<div
			class="md:tw-max-w-full md:tw-w-full md:tw-h-full fade-inOut-zindex-opacity-img landscape:tw-flex transit-flex-box item-row"
			:class="calcContentStyleClass()"
		>
			<!-- Desktop layout -->
			<div
				class="tw-hidden landscape:tw-hidden md:tw-flex tw-content-center tw-justify-evenly tw-w-full tw-max-w-full tw-h-full tw-max-h-full md:tw-overflow-y-auto"
			>
				<responsive-image-comp
					:id="`${content.title}-single-background-image`"
					:basedLazyImgStyleClass="`${content.title}-single-wine-pg-img`"
					:relativePath="`${content.background_image['relative_path']}`"
					:baseName="`${content.background_image['base_name']}`"
					imgStyleClass_16_9=""
					imgStyleClass_4_3=""
					transitionImgStyleClass_16_9="fade-inOut-opacity"
					transitionImgStyleClass_4_3="fade-inOut-opacity"
					commonImgStyleClass="tw-absolute tw-z-0 tw-inset-0 tw-object-cover tw-max-h-full tw-h-full tw-max-w-full tw-w-full"
					isDesktopAspectRatioCorrection="true"
					isHiddenPortrait="true"
					isHiddenLandscape="true"
				></responsive-image-comp>
				<div
					class="tw-block tw-relative tw-z-auto tw-h-full tw-max-h-full tw-w-027 tw-min-w-027 tw-cursor-pointer"
					v-on:click.prevent="handleItemClick"
				>
					<!-- <img
						class="item-image tw-object-contain"
						:src="content.image"
						:alt="content.title"
					/> -->

					<lazy-load-picture
						class="item-image"
						:keyIndex="'desktop_' + contentId"
						imageClass="wine-catalog-item-img__sz"
						:image="content.image"
					>
					</lazy-load-picture>
				</div>
				<div
					class="tw-hidden md:tw-flex tw-pb-2 tw-flex-col tw-content-center tw-justify-center tw-relative tw-z-auto tw-w-1/2 tw-max-w-1/2 tw-h-full tw-max-h-full tw-overflow-hidden"
				>
					<div
						class="header-basket-block tw-flex tw-flex-row tw-content-center tw-justify-between"
					>
						<div class="header-container tw-pt-4">
							<header
								class="content-header tw-flex tw-flex-col tw-content-left tw-justify-center"
							>
								<!-- <span
                                class="type-text"
                                v-show="!$_getHelper().isDELocale()"
                                >{{ content.wineType }}</span
                            > -->
								<div class="title-container tw-flex tw-items-end">
									<h1 class="header-text">{{ content.title }}</h1>
									<h1 class="header-harvest-text">
										{{ content.harvest }}
									</h1>
								</div>
								<img
									class="header-underscore-line tw-object-fill tw-w-fit-content"
									src="/images/icons/single-wine-pg/header-underscore-line.svg"
								/>
							</header>
						</div>
						<div
							class="price-basket-block tw-flex tw-flex-row tw-content-center tw-justify-between tw-pt-4"
						>
							<div
								class="item-price tw-flex tw-flex-col tw-content-left tw-justify-start"
							>
								<span class="item-price-text tw-text-steilgut-text-gold"
									>{{ content.formatPrice }} €</span
								>
								<span class="item-price-note">{{
									__("cart.minimumOrder")
								}}</span>
							</div>
							<div
								class="basket-control tw-flex tw-flex-row tw-items-start tw-justify-end"
								:class="{
									'disabled-element':
										content.product.total_in_stock === 0,
								}"
							>
								<div
									class="add-to-basket-container tw-relative tw-h-fit-content"
								>
									<img
										class="add-to-basket-icon tw-object-fit"
										src="/images/icons/single-wine-pg/add-to-basket.svg"
										@[ifCanAddToCart].stop="handleAddToBasket($event)"
									/>
								</div>
								<span
									class="add-to-basket-note tw-h-fit-content tw-text-left tw-text-steilgut-text-gold"
									>{{ __("cart.addToBasket") }}</span
								>
							</div>
						</div>
					</div>
					<div class="content-table">
						<table class="table table-borderless tw-w-full">
							<tbody>
								<tr class="table-title">
									<th scope="col" class="left-edge-title">
										{{ __("wines.residualSugar") }}
									</th>
									<th scope="col" class="table-title">
										{{ __("wines.acidity") }}
									</th>
									<th scope="col" class="right-edge-title">
										{{ __("wines.strength") }}
									</th>
								</tr>
								<tr class="table-row">
									<td class="left-edge-title first-row-cell">
										{{ content.residualSugar }}
									</td>
									<td class="table-cell-title first-row-cell">
										{{ content.acidity }}
									</td>
									<td class="right-edge-title first-row-cell">
										{{ content.strength }}
									</td>
								</tr>
								<tr class="table-title">
									<th scope="col" class="left-edge-title">
										{{ __("wines.wineSort") }}
									</th>
									<th scope="col" class="table-cell-title">
										{{ __("wines.soil") }}
									</th>
									<th scope="col" class="right-edge-title">
										{{ __("wines.terroir") }}
									</th>
								</tr>
								<tr class="table-row">
									<td class="left-edge-title">
										<h2 class="row-2nd">{{ content.wineSort }}</h2>
									</td>
									<td class="table-cell-title">
										<h2 class="row-2nd">{{ content.soil }}</h2>
									</td>
									<td class="right-edge-title">
										<h2 class="row-2nd">{{ content.terroir }}</h2>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="harvest-block"></div>
					<div class="portable-navbar-container">
						<portable-navbar :menu="createExtContentMenu()">
							<template v-slot:oppositeTitleDesktop>
								<slot name="harvestControlDesktop"> </slot>
							</template>
						</portable-navbar>
					</div>
				</div>
			</div>

			<!-- Portrait layout -->
			<div
				id="header-image-item"
				class="md:tw-hidden tw-block landscape:tw-hidden item-row tw-max-w-full tw-w-full tw-h-auto"
			>
				<header
					class="header-content tw-flex tw-flex-col tw-content-left tw-justify-start"
					v-on:click.prevent="handleItemClick"
				>
					<div
						class="image-container tw-block tw-relative"
						v-on:click.prevent="handleItemClick"
					>
						<!-- <img
							class="item-image tw-object-contain"
							:srcset="content.image"
							:src="content.image"
							:alt="content.title"
						/> -->

						<lazy-load-picture
							class="item-image"
							:keyIndex="'portrait_' + contentId"
							imageClass="wine-catalog-item-img__sz"
							:image="content.image"
						>
						</lazy-load-picture>
					</div>
					<span class="type-text" v-show="!$_getHelper().isDELocale()">{{
						content.wineType.split()[0]
					}}</span>

					<div class="tw-flex tw-flex-row">
						<div class="header-underscore-container tw-max-w-fit-content">
							<div class="title-container tw-flex tw-items-end">
								<h1 class="header-text">{{ content.title }}</h1>
								<h1 class="header-harvest-text">
									{{ content.harvest }}
								</h1>
							</div>
							<img
								class="header-underscore-line tw-object-fill tw-w-fit-content"
								src="/images/icons/single-wine-pg/header-underscore-line.svg"
							/>
						</div>
					</div>
				</header>
				<div
					class="price-basket-block tw-flex tw-flex-row tw-content-center tw-justify-between tw-py-4"
				>
					<div
						class="item-price tw-flex tw-flex-col tw-content-left tw-justify-center"
					>
						<span class="item-price-text tw-text-steilgut-text-gold"
							>{{ content.formatPrice }} €</span
						>
						<span class="item-price-note">{{ __("cart.minimumOrder") }}</span>
					</div>
					<div
						class="basket-control tw-flex tw-flex-row tw-content-center tw-justify-center"
						:class="{
							'disabled-element': content.product.total_in_stock === 0,
						}"
					>
						<div
							class="add-to-basket-container tw-relative tw-m-auto tw-h-fit-content"
						>
							<img
								class="add-to-basket-icon tw-object-fit"
								src="/images/icons/single-wine-pg/add-to-basket.svg"
								@[ifCanAddToCart].stop="handleAddToBasket($event)"
							/>
						</div>
						<span
							class="add-to-basket-note tw-h-fit-content tw-text-left tw-text-steilgut-text-gold"
							>{{ __("cart.addToBasket") }}</span
						>
					</div>
				</div>
				<div class="content-table tw-py-4">
					<table class="table table-borderless tw-w-full">
						<tbody>
							<tr class="table-title">
								<th scope="col" class="left-edge-title">
									{{ __("wines.residualSugar") }}
								</th>
								<th scope="col" class="right-edge-title">
									{{ __("wines.acidity") }}
								</th>
							</tr>
							<tr class="table-row">
								<td class="left-edge-title">
									{{ content.residualSugar }}
								</td>
								<td class="right-edge-title">
									{{ content.acidity }}
								</td>
							</tr>
							<tr class="table-title">
								<th scope="col" class="left-edge-title">
									{{ __("wines.strength") }}
								</th>
								<th scope="col" class="right-edge-title">
									{{ __("wines.wineSort") }}
								</th>
							</tr>
							<tr class="table-row">
								<td class="left-edge-title">
									{{ content.strength }}
								</td>
								<td class="right-edge-title">
									{{ content.wineSort }}
								</td>
							</tr>
							<tr class="table-title">
								<th scope="col" class="left-edge-title">
									{{ __("wines.soil") }}
								</th>
								<th scope="col" class="right-edge-title">
									{{ __("wines.terroir") }}
								</th>
							</tr>
							<tr class="table-row">
								<td class="left-edge-title">
									{{ content.soil }}
								</td>
								<td class="right-edge-title">
									{{ content.terroir }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<slot name="harvestControlPortrait"> </slot>
				<portable-navbar :menu="createExtContentMenu()"></portable-navbar>
			</div>

			<!-- Landscape layout -->
			<div
				class="tw-hidden md:tw-hidden landscape:tw-flex landscape:tw-h-full tw-max-w-full tw-w-full tw-flex-grow transit-flex-box landscape:tw-flex-row"
			>
				<responsive-image-comp
					:id="`${content.title}-single-background-image`"
					:basedLazyImgStyleClass="`${content.title}-single-wine-pg-img`"
					:relativePath="`${content.background_image['relative_path']}`"
					:baseName="`${content.background_image['base_name']}`"
					imgStyleClass_16_9=""
					imgStyleClass_4_3=""
					transitionImgStyleClass_16_9="fade-inOut-opacity"
					transitionImgStyleClass_4_3="fade-inOut-opacity"
					commonImgStyleClass="tw-fixed tw-z-0 tw-inset-0 tw-object-cover tw-max-h-full tw-h-full tw-max-w-full tw-w-full"
					isHiddenPortrait="true"
					isHiddenDesktop="true"
				></responsive-image-comp>
				<div
					class="image-container tw-block tw-relative"
					v-on:click.prevent="handleItemClick"
				>
					<!-- <img
						class="item-image tw-object-contain"
						:src="content.image"
						:alt="content.title"
					/> -->
					<lazy-load-picture
						class="item-image"
						:keyIndex="'landscape_' + contentId"
						imageClass="wine-catalog-item-img__sz"
						:image="content.image"
					>
					</lazy-load-picture>
				</div>
				<div
					class="item-description-container tw-flex tw-flex-col tw-items-center"
				>
					<div
						class="header-price-container tw-flex tw-flex-grow tw-flex-row tw-items-center tw-justify-between"
					>
						<div class="tw-flex tw-flex-row">
							<header class="header-content tw-flex tw-flex-col">
								<!-- <h2 class="type-text" v-show="!$_getHelper().isDELocale()">
                                {{ content.wineType }}
                            </h2> -->
								<div
									class="header-text-container"
									:class="[{ 'tw-max-w-min-content': !isCNLocale() }]"
								>
									<div class="title-container tw-flex tw-items-end">
										<h1
											class="header-text"
											:class="[
												{ 'tw-max-w-fit-content': !isCNLocale() },
											]"
										>
											{{ content.title }}
										</h1>
										<h1 class="header-harvest-text">
											{{ content.harvest }}
										</h1>
									</div>
									<img
										class="header-underscore-line tw-object-scale-down"
										src="/images/icons/single-wine-pg/header-underscore-line.svg"
									/>
								</div>
							</header>
						</div>
						<div
							class="price-basket-block tw-flex tw-flex-row tw-items-center tw-justify-between tw-w-3/5 tw-max-w-060"
						>
							<div
								class="item-price tw-flex tw-flex-col tw-items-end tw-justify-start tw-flex-grow"
							>
								<h1 class="item-price-text tw-text-steilgut-text-gold">
									{{ content.formatPrice }} €
								</h1>
								<span class="item-price-note tw-text-right">{{
									__("cart.minimumOrder")
								}}</span>
							</div>
							<div
								class="basket-control tw-flex tw-flex-col tw-items-center tw-justify-center"
								:class="{
									'disabled-element':
										content.product.total_in_stock === 0,
								}"
							>
								<div
									class="add-to-basket-container tw-mx-auto tw-relative tw-h-fit-content"
								>
									<img
										class="add-to-basket-icon tw-object-fit"
										src="/images/icons/single-wine-pg/add-to-basket.svg"
										@[ifCanAddToCart].stop="handleAddToBasket($event)"
									/>
								</div>
								<span
									class="add-to-basket-note tw-text-center tw-text-steilgut-text-gold"
									>{{ __("cart.addToBasket") }}</span
								>
							</div>
						</div>
					</div>
					<div class="content-table">
						<table class="table table-borderless tw-w-full">
							<tbody>
								<tr class="table-title">
									<th scope="col" class="left-edge-title">
										{{ __("wines.residualSugar") }}
									</th>
									<th scope="col" class="table-cell-title">
										{{ __("wines.acidity") }}
									</th>
									<th scope="col" class="right-edge-title">
										{{ __("wines.strength") }}
									</th>
								</tr>
								<tr class="table-row">
									<td class="left-edge-value first-row-cell">
										{{ content.residualSugar }}
									</td>
									<td class="table-cell-value first-row-cell">
										{{ content.acidity }}
									</td>
									<td class="right-edge-value first-row-cell">
										{{ content.strength }}
									</td>
								</tr>
								<tr class="table-title">
									<th scope="col" class="left-edge-title">
										{{ __("wines.wineSort") }}
									</th>
									<th scope="col" class="table-cell-title">
										{{ __("wines.soil") }}
									</th>
									<th scope="col" class="right-edge-title">
										{{ __("wines.terroir") }}
									</th>
								</tr>
								<tr class="table-row">
									<td class="left-edge-value">
										{{ content.wineSort }}
									</td>
									<td class="table-cell-value">
										{{ content.soil }}
									</td>
									<td class="right-edge-value">
										{{ content.terroir }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<slot name="harvestControlLandscape"> </slot>
					<portable-navbar
						id="landscape-portable-navbar"
						class="portable-navbar"
						:menu="createExtContentMenu()"
					></portable-navbar>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import { Helper } from "../../shared/utils/helper";
import mediaHelper from "../../shared/mixins/mediaHelper";

const pulseLogoComp = () =>
	import(/* webpackPrefetch: true */ "../../shared/components/PulseLogoComp");

export default {
	mixins: [mediaHelper],

	components: {
		"pulse-logo-comp": pulseLogoComp,
	},

	props: {
		isSmooth: {
			default: false,
			type: [String, Boolean],
		},

		smoothTimeOut: {
			default: 100,
			type: [Number, String],
		},

		contentId: {
			type: [Number, String],
		},
	},

	data: function () {
		return {
			isError: false,
			isLoading: false,
			isInvisible: false,
			wineItemContentDashboardKey: "wineItemContentDashboardKey",
			contentMuck: {
				image: "",
				title: "",
				winesort: "",
				color: "",
				harvest: "",
				price: "",
				volume: "",
				wineType: "",
				soil: "",
				terroir: "",
				age: "",
				residualSugar: "",
				acidity: "",
				strength: "",
				area: "",
				harvestAspect: "",
				taste: "",
				background_image: {
					base_name: "",
					relative_path: "",
				},
			},

			content: {
				id: null,
				image: "",
				title: "",
				winesort: "",
				color: "",
				harvest: "",
				price: "",
				volume: "",
				wineType: "",
				soil: "",
				terroir: "",
				age: "",
				residualSugar: "",
				acidity: "",
				strength: "",
				area: "",
				harvestAspect: "",
				taste: "",
				background_image: {
					base_name: "",
					relative_path: "",
				},
			},
		};
	},

	async created() {
		"use strict";
		if (this.isSmooth) {
			this.isInvisible = true;
			this.$_handleSmoothBehavior();
		}
		this.content = null;
		const temp = this.getExtContentFromSliderData({ id: this.contentId });

		if (!temp) {
			this.isError = false;
			try {
				this.isLoading = true;
				const item = (await axios.get(`/api/wines/${this.itemId}`)).data.data;
				const excludedKeys = ["id"];
				this.content = Object.keys(item).reduce((resultObj, srcKey) => {
					if (!excludedKeys.some((k) => k === srcKey)) {
						resultObj[srcKey] = item[srcKey];
					}
					return resultObj;
				}, {});

				this.$store.commit("setExtContentToSliderData", {
					id: this.itemId,
					content: this.content,
				});
			} catch (error) {
				this.isError = true;
				this.isLoading = false;
				console.error(
					"Error [SliderComp::created] Unexpected error occurred: " + error
				);
			} finally {
				this.isLoading = false;
				this.content = temp;
			}
		} else {
			this.content = temp;
		}
	},

	methods: {
		handleItemClick: function (event) {
			"use strict";
			console.log("Debug [handleItemClick] ");
			this.$emit("click-on-item", event);
		},

		$_updateDashboard: function () {
			"use strict";
			if (
				(this.wineItemContentDashboardKey =
					"wineItemContentDashboardKey_0" ||
					this.wineItemContentDashboardKey === "wineItemContentDashboardKey")
			) {
				this.wineItemContentDashboardKey = "wineItemContentDashboardKey_1";
			} else {
				this.wineItemContentDashboardKey = "wineItemContentDashboardKey_0";
			}
		},

		createExtContentMenu: function () {
			return [
				{
					header: {
						title: this.__("wines.harvestWays"),
						icon: "/images/icons/single-wine-pg/wine-cups.svg",
					},
					text: this.content.harvestAspect,
				},
				// {
				// 	header: {
				// 		title: this.__("wines.harvestWays"),
				// 		icon: "/images/icons/single-wine-pg/grape.svg",
				// 	},
				// 	text: this.content.harvestAspect,
				// },
				// Comments from 13112022
				// {
				// 	header: {
				// 		title: this.__("wines.taste"),
				// 		icon: "/images/icons/single-wine-pg/wine-cups.svg",
				// 	},
				// 	text: this.content.taste,
				// },
			];
		},

		handleAddToBasket: function (event) {
			// debugger;
			const product = {};
			product["id"] = this.content.product["id"];
			product["title"] = this.content["title"];
			product["price"] = this.content["price"];
			product["discount"] = this.content.product["discount"];
			product["image"] = this.content["image"];
			product["harvest"] = this.content["harvest"];
			product["color"] = this.content["color"];
			product["terroir"] = this.content["terroir"];
			product["wineType"] = this.content["wineType"];

			this.$store.dispatch("addToBasket", product);
		},

		$_handleSmoothBehavior: function () {
			"use strict";
			let currTimeOut = 0;
			if (this.isSmooth) {
				currTimeOut = this.smoothTimeOut;
			}
			const self = this;

			setTimeout(() => {
				self.isInvisible = false;
			}, currTimeOut);
		},

		$_getHelper: function () {
			return this.$root.$data.helper;
		},

		calcContentStyleClass: function () {
			return {
				"zero-opacity": this.isInvisible,
			};
		},
	},

	computed: {
		...mapState({
			sliderControlCursor: (state) => {
				return state.slider.control.cursor;
			},

			sliderControlTo: (state) => {
				return state.slider.control.to;
			},
		}),

		...mapGetters(["getExtContentFromSliderData"]),

		ifCanAddToCart: function () {
			("use strict");
			return this.content.product["total_in_stock"] > 0 ? "click" : null;
		},
	},
};
</script>

<style lang="scss">
.wine-catalog-item-img__sz {
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.wine-catalog-item-img__sz {
		max-height: 100%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.wine-catalog-item-img__sz {
				max-height: 100%;
				max-height: calc(var(--100vh, 1vh) * 80);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.wine-catalog-item-img__sz {
		max-height: 75%;
		height: 75%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.wine-catalog-item-img__sz {
				max-height: 75%;
				height: 75%;
				max-height: calc(var(--100vh, 1vh) * 75);
				height: calc(var(--100vh, 1vh) * 75);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.wine-catalog-item-img__sz {
		height: 65vh;
		height: calc(var(--100nvmin, 1vmin) * 65);
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 897px) and (max-height: 720px) and (orientation: landscape) {
	.wine-catalog-item-img__sz {
		height: 65vh;
		height: calc(var(--100nvh, 1vh) * 65);
	}
}
</style>

<style lang="scss" scoped>
.loading-msg {
	margin: auto;
	width: fit-content;
}

.add-to-basket-icon {
	cursor: pointer;
}

@keyframes bubble-btn-anim {
	from {
		transform: translate(-50%, -50%) scale(1.5);
		opacity: 25%;
	}

	to {
		transform: translate(-50%, -50%) scale(2.5);
		opacity: 75%;
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
	.header-harvest-text {
		font-family: "steilgut_plantagenet_cherokee", sans-serif;
		align-self: center;
		color: #fff;
		margin-left: 0.75rem;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.header-content {
		height: 80%;
		max-height: 80%;
		margin-top: 14vh;
	}

	.image-container {
		width: 40%;
		min-width: 40%;
		max-height: 70vh;
		height: 70vh;
		margin: 0 auto;
	}

	.item-image {
		max-height: 100%;
		margin: 2.5vh auto 1.5vh auto;
		padding-bottom: 4vh;
	}

	h2.type-text {
		font-family: "steilgut_cormorant";
		font-size: calc(1em + 0.7vh);
		font-weight: lighter;
		text-transform: capitalize;
	}

	h1.header-text {
		margin: 2vh 0 1vh 0;
		font-size: calc(1.3em + 0.5vh) 0;
	}

	h1.header-harvest-text {
		margin-top: auto;
		margin-bottom: 1vh;
	}

	.header-underscore-line {
		max-width: 45%;
		width: fit-content;
		margin-left: 0;
	}

	.item-price-text,
	.add-to-basket-note,
	.item-price-note,
	.table-title th,
	.table-row {
		font-family: "steilgut_opensans";
		font-weight: lighter;
	}

	.item-price-note {
		font-size: calc(0.7em + 0.3vh);
	}

	.item-price-text {
		font-size: calc(1em + 0.8vh);
	}

	.add-to-basket-note {
		font-size: calc(0.7em + 0.5vh);
		padding-left: 2vmin;
	}

	.control-btn-circle:active {
		animation: bubble-btn-anim 1.25s;
	}

	.control-btn-circle {
		max-width: 5vh;
		width: 5vh;
		height: 5vh;
	}

	.table-title th,
	.item-price-note {
		color: #c4bbaa;
	}

	.table-title th.left-edge-title,
	.table-row td.left-edge-title {
		padding: 0.75rem 0.75rem 0rem 0rem;
	}

	.table-title th.right-edge-title,
	.table-row td.right-edge-title {
		padding: 0.75rem 0rem 0rem 0.75rem;
	}

	.table-row td {
		color: white;
	}

	.table-title > th {
		font-size: calc(0.7em + 0.3vh);
	}

	.table-row {
		font-size: 1.5em;
		font-size: calc(0.7em + 0.3vh);
	}

	.add-to-basket-note {
		margin: auto 0 auto 0;
	}

	.portable-navbar {
		max-height: max-content;
		height: max-content;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.header-content {
				height: 95vh;
				max-height: 95vh;
				height: calc(var(--100vh, 1vh) * 97);
				max-height: calc(var(--100vh, 1vh) * 97);
				margin-top: 14vh;
				margin-top: calc(var(--100vh, 1vh) * 14);
			}

			h1.header-text {
				margin: 2vh 0 1vh 0;
				margin: calc(var(--100vh, 1vh) * 2) 0 calc(var(--100vh, 1vh) * 1) 0;
			}

			h1.header-harvest-text {
				margin-bottom: 1vh;
				margin-bottom: calc(var(--100vh, 1vh));
			}

			.image-container {
				width: 40%;
				min-width: 40%;
				max-height: 77vh;
				max-height: calc(var(--100vh, 1vh) * 80);
				height: 77vh;
				height: calc(var(--100vh, 1vh) * 80);
			}

			.item-image {
				max-height: 100%;
				max-height: calc(var(--100vh, 1vh) * 80);
				padding-bottom: 4vh;
				padding-bottom: calc(var(--100vh, 1vh) * 4);

				margin: 2.5vh auto 0 auto;
				margin: calc(var(--100vh, 1vh) * 2.5) auto 0 auto;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-height: 720px) and (orientation: portrait) {
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.header-content {
				height: 93vh;
				max-height: 93vh;
				height: calc(var(--100vh, 1vh) * 95);
				max-height: calc(var(--100vh, 1vh) * 95);
				margin: 8vh auto;
				margin: calc(var(--100vh, 1vh) * 8) auto;
			}

			.item-image {
				padding-bottom: 4vh;
				padding-bottom: calc(var(--100vh, 1vh) * 4);
			}
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
	.item-row {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		min-height: 85%;
		min-height: 85vh;
		height: 85vh;
	}

	.image-container {
		width: 40%;
		min-width: 40%;
		max-height: 74vh;
		height: 74vh;
	}

	.header-content {
		width: fit-content;
		max-width: fit-content;

		justify-content: space-between;
		align-items: flex-start;
	}

	.add-to-basket-container {
		margin: auto 0 auto auto;
	}

	.image-container,
	.item-description-container {
		position: relative;
		z-index: 5;
	}

	.item-image {
		position: fixed;
		top: 50%;
		left: 33%;
		transform: translate(-50%, -50%);
		z-index: 1;
		max-height: 75%;
		height: 75%;
	}

	h2.type-text {
		font-family: "steilgut_cormorant";
		font-weight: lighter;
		text-transform: capitalize;
	}

	.item-description-container {
		display: flex;
		flex-direction: column;
		justify-content: space-evenly;
		align-items: stretch;
		width: 53%;
		max-width: 53%;
		height: auto;
	}

	.header-price-container,
	.content-table,
	.portable-navbar {
		max-width: 100%;
		width: 100%;
	}

	.header-price-container {
		margin: 0 auto 2% 0;
		max-height: min-content;
	}

	.content-table {
		margin: 0 auto auto 0;
	}

	h1.header-text,
	h1.item-price-text {
		margin: 2vmin 0;
	}

	h1.header-text,
	h1.item-price-text {
		font-size: calc(0.8em + 0.5vw);
		font-size: 5.5vmin;
	}

	.header-harvest-text {
		font-size: calc(0.7em + 0.4vw);
		font-size: 4.75vmin;
	}

	.header-text-container {
		display: flex;
		flex-direction: column;
	}

	.header-underscore-line {
		max-width: 45%;
		width: fit-content;
		margin-left: 0;
	}

	.add-to-basket-icon {
		max-height: 10vmin;
	}

	.control-btn-circle {
		max-width: 5vw;
		width: 5vw;
		height: 5vw;
	}

	.item-price {
		margin-right: 0;
	}

	h1.item-price-text,
	.add-to-basket-note,
	.item-price-note,
	.table-title th,
	.table-row {
		font-family: "steilgut_opensans";
		font-weight: lighter;
	}

	.add-to-basket-note,
	.item-price-note {
		font-size: calc(0.3em + 0.5vh);
	}

	.add-to-basket-note {
		max-width: 60%;
		margin: 2vmin 0;
	}

	.table-title th,
	.item-price-note {
		color: #c4bbaa;
		padding: 0;
	}

	.table-title th {
		padding: 0 !important;
	}

	.table-title th.left-edge-title {
		padding: 0.5vh 1vw 1vh 0rem !important;
	}

	.table-title th.right-edge-title {
		padding: 0.5vh 0rem 1vh 1vw !important;
	}

	.table-title th.table-cell-title {
		padding: 0.5vh 1vw 1vh 1vw !important;
	}

	.table-row td {
		padding: 0 !important;
	}

	.table-row td.left-edge-value {
		padding: 0 1vw 1vh 0rem !important;
	}

	.table-row td.right-edge-value {
		padding: 0 0rem 1vh 1vw !important;
	}

	.table-row td.table-cell-value {
		padding: 0 1vw 1vh 1vw !important;
	}

	.table-row td {
		color: white;
	}

	.content-table table tbody tr:nth-child(4) td {
		color: rgb(225, 219, 208);
	}

	.table-title > th {
		font-size: calc(0.5em + 0.5vh);
	}

	.table-row .first-row-cell {
		font-size: calc(1em + 0.75vh);
	}

	.table-row,
	h2.type-text {
		font-size: calc(0.5em + 0.6vh);
	}

	.content-table table {
		margin-bottom: 0 !important;
	}

	.portable-navbar {
		margin-top: 4%;
		margin-top: calc(var(--100vh, 1vh) * 2);
		height: 25vh;
		max-height: 25vh;
		overflow: hidden;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.item-row {
				min-height: calc(var(--100vh, 1vh) * 85);
				height: calc(var(--100vh, 1vh) * 85);
			}

			h1.header-text,
			h1.item-price-text {
				margin: 2vmin 0;
				margin: calc(var(--100vh, 1vh) * 2) 0;
				font-size: calc(0.7em + 0.5vw);
				font-size: 5vmin;
				font-size: calc(var(--100vh, 1vh) * 5.7);
			}

			.add-to-basket-icon {
				max-height: 10vmin;
				max-height: calc(var(--100vh, 1vh) * 10);
			}

			.add-to-basket-note {
				max-width: 60%;
				margin: 2vmin 0;
				margin: calc(var(--100vh, 1vh) * 2) 0;
			}

			.image-container {
				width: 40%;
				min-width: 40%;
				max-height: 80vh;
				height: 80vh;

				max-height: calc(var(--100vh, 1vh) * 80);
				height: calc(var(--100vh, 1vh) * 80);
			}

			.item-image {
				top: 50%;
				top: calc(var(--100vh, 1vh) * 50);
				left: 33%;
				max-height: 75%;
				height: 75%;
				max-height: calc(var(--100vh, 1vh) * 75);
				height: calc(var(--100vh, 1vh) * 75);
			}

			.table-title > th {
				font-size: calc(0.3em + 0.5vh);
				font-size: calc(var(--100vh, 1vh) * 2.5);
			}

			.table-row .first-row-cell {
				font-size: calc(1em + 8vh);
				font-size: calc(0.9em + var(--100vh, 1vh) * 0.8);
			}

			.table-row,
			h2.type-text {
				font-size: calc(0.5em + 0.8vh);
				font-size: calc(0.5em + var(--100vh, 1vh) * 0.8);
			}

			.portable-navbar {
				height: 22vh;
				height: calc(22 * var(--100vh, 1vh));
				max-height: 22vh;
				max-height: calc(22 * var(--100vh, 1vh));
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	.item-row {
		padding-top: 0;
		min-height: 85%;
		padding-left: 0;
	}

	.header-price-container,
	.portable-navbar {
		max-height: min-content;
	}

	.header-price-container {
		margin: 0 auto 0 0;
	}

	.add-to-basket-container {
		margin: auto;
	}

	.portable-navbar {
		height: 25vh;
		max-height: 25vh;
		overflow: hidden;
		margin-top: 2%;
	}

	.item-description-container {
		margin-top: 0;
		padding-top: 2%;
		align-self: flex-start;
		justify-content: space-between;
		width: 51%;
		max-width: 51%;
		margin: 0 auto 0 2vw;
	}

	.content-table {
		margin: 0 auto 0 0;
	}

	.content-table table {
		margin-bottom: 0 !important;
	}

	.table-title > th {
		font-size: calc(0.4em + 0.4vh);
	}

	.table-row .first-row-cell {
		font-size: calc(0.9em + 0.75vh);
	}

	.table-row,
	h2.type-text {
		font-size: calc(0.5em + 0.6vh);
	}

	h1.header-text,
	h1.item-price-text {
		margin: 2vmin 0;
		font-size: calc(0.7em + 0.4vw);
		font-size: 4.5vmin;
	}

	.add-to-basket-note,
	.item-price-note {
		font-size: calc(0.2em + 0.2vh);
	}

	.add-to-basket-icon {
		max-height: 9vmin;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.item-row {
				min-height: 88%;
				min-height: calc(var(--100vh, 1vh) * 88);
			}

			.portable-navbar {
				height: 25vh;
				height: calc(var(--100vh, 1vh) * 25);
				max-height: 25vh;
				max-height: calc(var(--100vh, 1vh) * 25);
				overflow: hidden;
				margin-top: 2%;
			}

			.table-title > th {
				font-size: calc(0.4em + 0.4vh);
				font-size: calc(0.4em + var(--100vh, 1vh) * 0.4);
			}

			.table-row .first-row-cell {
				font-size: calc(0.9em + 0.75vh);
				font-size: calc(0.9em + var(--100vh, 1vh) * 0.75);
			}

			.table-row,
			h2.type-text {
				font-size: calc(0.5em + 0.6vh);
				font-size: calc(0.5em + var(--100vh, 1vh) * 0.6);
			}

			h1.header-text,
			h1.item-price-text {
				margin: 2vmin 0;
				margin: calc(var(--100vh, 1vh) * 2) 0;
				font-size: calc(0.8em + 0.5vw);
				font-size: 5.5vmin;
				font-size: calc(var(--100vh, 1vh) * 6);
			}

			.add-to-basket-note,
			.item-price-note {
				font-size: calc(0.2em + 0.4vh);
				font-size: calc(var(--100vh, 1vh) * 3);
			}

			.add-to-basket-icon {
				max-height: 9vmin;
				max-height: calc(var(--100vh, 1vh) * 9);
			}
		}
	}
}

/* Iphone 4 and another small devices*/
/* Landscape */
@media only screen and (min-width: 320px) and (max-width: 480px) and (orientation: landscape) {
	.item-description-container {
		max-width: 45vw !important;
		width: 45vw !important;
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.header-container {
		display: flex;
		flex-direction: row;
		align-items: flex-start;
		justify-content: flex-start;
	}

	h1.header-text {
		font-size: 1em;
		font-size: calc(1em + var(--100nvh, 1vh) * 2);
		color: #fff;
	}

	h1.header-harvest-text {
		font-family: "steilgut_plantagenet_cherokee";
		font-size: 0.75em;
		font-size: calc(0.75em + var(--100nvh, 1vh) * 2);
		color: #fff;
		margin-left: 1em;
		margin-top: auto;
		margin-bottom: 0;
	}

	.item-image {
		position: absolute;
		top: 50%;
		right: 0%;
		transform: translateY(-50%);
		height: 65vh;
		height: calc(var(--100nvmin, 1vmin) * 65);
	}

	.content-table {
		padding: 0.85em 0;
		padding: calc(0.5em + 1vmin) 0;
		padding: calc(0.5em + var(--100nvmin, 1vmin) * 1) 0;
	}

	.price-basket-block {
		width: 28%;
	}

	.add-to-basket-container {
		margin: 0 0 auto auto;
		flex-grow: 1;
	}

	.add-to-basket-icon {
		width: 85%;
		max-width: 85%;
		margin: 0 auto;
	}

	.basket-control,
	.item-price {
		display: inline-block;
		max-width: 50%;
	}

	.add-to-basket-note {
		font-size: 0.75em;
		font-size: calc(0.5em + 0.5vmin);
		font-size: calc(0.5em + var(--100nvmin, 1vmin) * 0.5);
		margin: 0 auto;
		padding-left: 0.5em;
		padding-left: 0.5vmin;
		padding-left: calc(0.5vmin + var(--100nvmin, 1vmin) * 0.5);
		max-width: 70%;
	}

	h1.header-text {
		margin: 0 0 0 0.4em;
		margin: 0 0 0 calc(0.1em + 0.3vmin) 0;
		margin: 0 0 0 calc(0.1em + var(--100nvmin, 1vmin) * 0.3) 0;
	}

	.header-underscore-line {
		max-width: 45%;
	}

	.type-text {
		font-family: "steilgut_cormorant";
		font-size: 1.2em;
		font-size: calc(1em + 1vmin);
		font-size: calc(1em + var(--100nvmin, 1vmin) * 1);
		font-weight: lighter;
		text-transform: capitalize;
	}

	.item-price-text,
	.add-to-basket-note,
	.item-price-note,
	.table-title th,
	.table-row {
		font-family: "steilgut_opensans";
		font-weight: lighter;
	}

	.item-price-text {
		font-size: 1.4em;
		font-size: calc(1.3em + 0.8vmin);
		font-size: calc(1.3em + var(--100nvmin, 1vmin) * 0.8);
		margin-bottom: 0.4em;
		margin-bottom: calc(0.1em + var(--100nvmin, 1vmin) * 0.7);
	}

	.table-title th,
	.item-price-note {
		color: #c4bbaa;
	}

	.table-title th {
		padding: 16px 8px 0rem 16px;
		padding: calc(10px + var(--100nvh, 1vh)) calc(5px + var(--100nvh, 1vh)) 0
			calc(10px + var(--100nvh, 1vh));
	}

	.table-title th.left-edge-title {
		padding: 16px 0 0 0;
		padding: calc(10px + var(--100nvh, 1vh)) 0 0 0;
	}

	.table-row td.left-edge-title {
		padding: 8px 0 0 0;
		padding: calc(5px + var(--100nvh, 1vh) * 0.3) 0 0 0;
	}

	.table-value-title th.right-value-title {
		padding: 16px 0 8px 0;
		padding: calc(10px + var(--100nvh, 1vh)) 0 calc(5px + var(--100nvh, 1vh)) 0;
	}

	.table-row td.table-cell-title {
		padding: 8px 16px 0rem 16px;
		padding: calc(5px + var(--100nvh, 1vh) * 0.3) calc(10px + var(--100nvh, 1vh)) 0
			calc(10px + var(--100nvh, 1vh));
	}

	.table-row td.right-edge-title {
		padding: 8px 0 0 16px;
		padding: calc(5px + var(--100nvh, 1vh) * 0.3) 0 0 calc(10px + var(--100nvh, 1vh));
	}

	.table-row td {
		color: white;
	}

	.table-row h2.row-2nd {
		max-width: 50%;
	}

	.content-table table tbody tr:nth-child(4) td {
		color: rgb(225, 219, 208);
	}

	.item-price-note {
		font-size: 0.6em;
	}

	.table-title > th {
		font-size: 0.7em;
		font-size: calc(0.5em + 0.7vmin);
		font-size: calc(0.5em + var(--100nvmin, 1vmin) * 0.7);
	}

	.table-row {
		font-size: 1.1em;
		font-size: calc(0.85em + 0.4vmin);
		font-size: calc(0.85em + var(--100nvmin, 1vmin) * 0.4);
	}

	.table-row .first-row-cell {
		font-size: 1.2em;
		font-size: calc(1em + 0.5vmin);
		font-size: calc(1em + var(--100nvmin, 1vmin) * 0.5);
	}

	.portable-navbar-container {
		display: flex;
		flex: 0 1 auto;
		flex-direction: column;
		padding-top: 0%;

		height: 320px;
	}

	.portable-navbar-container > div {
		margin: 2vmin auto auto auto;
	}

	.harvest-block {
		flex-basis: 20%;
	}
}

@media only screen and (min-width: 1025px) and (max-width: 1200px) and (orientation: landscape) {
	.price-basket-block {
		width: 30%;
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 897px) and (max-height: 720px) and (orientation: landscape) {
	.content-table {
		padding: calc(0.3em + 0.5vmin) 0;
		padding: calc(0.3em + var(--100nvmin, 1vmin) * 0.5) 0;
	}

	.item-image {
		position: absolute;
		right: 0%;
		left: unset;
		height: 65vh;
		height: calc(var(--100nvh, 1vh) * 65);
	}

	.price-basket-block {
		max-width: 29.3%;
	}

	.add-to-basket-container {
		margin: 0 0 auto auto;
		flex-grow: 1;
	}

	.add-to-basket-icon {
		width: 70%;
		max-width: 70%;
		margin: 0 auto;
	}

	.basket-control,
	.item-price {
		display: inline-block;
		max-width: 50%;
	}

	.add-to-basket-note {
		font-size: calc(0.4em + 0.3vmin);
		font-size: calc(0.4em + var(--100nvmin, 1vmin) * 0.3);
		margin: 0 auto;
		max-width: 40%;
	}

	.header-underscore-line {
		max-width: 45%;
	}

	.type-text {
		font-family: "steilgut_cormorant";
		font-size: 1.2em;
		font-weight: lighter;
		text-transform: capitalize;
	}

	.item-price-text,
	.add-to-basket-note,
	.item-price-note,
	.table-title th,
	.table-row {
		font-family: "steilgut_opensans";
		font-weight: lighter;
	}

	.item-price-text {
		font-size: calc(1em + 0.4vmin);
		font-size: calc(1em + var(--100nvmin, 1vmin) * 0.4);
	}

	.table-title th,
	.item-price-note {
		color: #c4bbaa;
	}

	.table-title th {
		padding: calc(0.3em + 0.5vmin) calc(0.2em + 0.3vmin) 0rem calc(0.3em + 0.5vmin);

		padding: calc(0.3em + var(--100nvmin, 1vmin) * 0.5)
			calc(0.2em + var(--100nvmin, 1vmin) * 0.3) 0rem
			calc(0.3em + var(--100nvmin, 1vmin) * 0.5);
	}

	.table-title th.left-edge-title {
		padding: calc(0.3em + 0.5vmin) 0;
		padding: calc(0.3em + var(--100nvmin, 1vmin) * 0.5) 0;
	}

	.table-row td.left-edge-title {
		padding: calc(0.2em + 0.3vmin) 0 0 0;
		padding: calc(0.2em + var(--100nvmin, 1vmin) * 0.3) 0 0 0;
	}

	.table-value-title th.right-value-title {
		padding: calc(0.3em + 0.5vmin) 0 calc(0.2em + 0.3vmin) 0;
		padding: calc(0.3em + var(--100nvmin, 1vmin) * 0.5) 0
			calc(0.2em + var(--100nvmin, 1vmin) * 0.3) 0;
	}

	.table-row td.table-cell-title {
		padding: calc(0.2em + 0.3vmin) calc(0.3em + 0.5vmin) 0rem calc(0.3em + 0.5vmin);

		padding: calc(0.2em + var(--100nvmin, 1vmin) * 0.3)
			calc(0.3em + var(--100nvmin, 1vmin) * 0.5) 0rem
			calc(0.3em + var(--100nvmin, 1vmin) * 0.5);
	}

	.table-row td.right-edge-title {
		padding: calc(0.2em + 0.3vmin) 0 0 calc(0.3em + 0.5vmin);
		padding: calc(0.2em + var(--100nvmin, 1vmin) * 0.3) 0 0
			calc(0.3em + var(--100nvmin, 1vmin) * 0.5);
	}

	.table-row td {
		color: white;
	}

	.item-price-note {
		font-size: 0.6em;
		font-size: calc(0.3em + 0.5vmin);
		font-size: calc(0.3em + var(--100nvmin, 1vmin) * 0.5);
	}

	.table-title > th {
		font-size: 0.7em;
		font-size: calc(0.5em + 0.7vmin);
		font-size: calc(0.5em + var(--100nvmin, 1vmin) * 0.7);
	}

	.table-row {
		font-size: 1em;
		font-size: calc(0.7em + 0.7vmin);
		font-size: calc(0.7em + var(--100nvmin, 1vmin) * 0.7);
	}

	.portable-navbar-container > div {
		margin: 0 auto auto auto;
	}

	.portable-navbar-container {
		height: 30%;
		max-height: 30%;
	}
}
</style>
