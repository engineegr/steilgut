<template>
	<div
		:class="[
			'steilgut-slider-item-header',
			'landscape:tw-w-full landscape:tw-max-w-full md:tw-w-full md:tw-max-w-full tw-max-w-095 tw-w-095',
		]"
	>
		<div
			:class="[
				'item-row',
				'md:tw-flex',
				'tw-hidden',
				'tw-max-w-full',
				'tw-w-full',
				calcItemHeightClass,
				calcActiveStyleClass,
			]"
		>
			<div
				:class="[
					'md-border-cell',
					'tw-text-right',
					calcItemHeightClass,
					magnifiedFontsizeStyleClass,
				]"
				class="item-row__year"
			>
				<span
					class="item-row__year__text tw-cursor-pointer"
					v-on:click="handleOnClickItem"
					>{{ itemData.year }}</span
				>
			</div>
			<div
				:class="[
					'tw-w-full',
					'tw-min-w-fill',
					calcItemHeightClass,
					magnifiedFontsizeStyleClass,
				]"
				class="item-row__title"
			>
				<span
					class="item-row__title__text tw-cursor-pointer"
					v-on:click="handleOnClickItem"
					>{{ itemData.title }}</span
				>
			</div>
		</div>

		<div
			:class="[
				'md:tw-hidden',
				'item-row',
				'tw-pl-2',
				calcActiveStyleClass,
				'tw-h-full',
				'tw-max-h-full',
				'tw-max-w-full',
			]"
		>
			<div class="tw-block tw-w-full tw-min-w-full">
				<span
					class="right-border-cell tw-pr-2 tw-w-1/2 tw-max-w-1/2 tw-border-white"
					>{{ itemData.year }}</span
				>
				<span class="tw-pl-2 item-row-title">{{ itemData.title }}</span>
			</div>
		</div>
	</div>
</template>

<script>
import { parse } from "path";
import { mapState, mapGetters } from "vuex";
export default {
	props: {
		itemData: [Object],
		itemKey: [Number, String],
		isActive: [Boolean, String],
	},

	data() {
		return {
			magnifiedFontsizeStyleClass: "",
		};
	},

	methods: {
		$_calcItemKeyIndex: function () {
			const keyRegPattern = /(\d+)_sliderItemHeader/;
			let [_, keyIndex] = keyRegPattern.exec(this.itemKey);
			return parseInt(keyIndex);
		},

		handleOnClickItem: function (event) {
			const keyRegPattern = /(\d+)_sliderItemHeader/;
			let [_, keyIndex] = keyRegPattern.exec(this.itemKey);
			const index = parseInt(keyIndex);
			this.$emit("on-click-item-header", event, index + 1);
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

		calcActiveStyleClass: function () {
			if (this.ifActive) {
				this.magnifiedFontsizeStyleClass = "font_size_x20";
				setTimeout(() => {
					this.magnifiedFontsizeStyleClass = "";
				}, 500);
			}

			return this.ifActive ? "tw-text-steilgut-history-text-gold" : "";
		},

		calcItemHeightClass: function () {
			return this.$_calcItemKeyIndex() === this.sliderControlTo
				? "tw-h-auto"
				: "tw-h-full tw-min-h-full";
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

<style lang="scss" scoped>
.steilgut-slider-item-header {
	font-family: "steilgut_opensans";
	font-weight: 100;
}

/*********************************************************************
* 
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/

.item-row {
	display: flex;
	flex: 1 0 auto;
	display: -webkit-flex;
	flex-direction: row;
	align-items: center;
	justify-content: space-between;
}

.right-border-cell {
	border-right: 1px solid;
}

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.steilgut-slider-item-header {
		display: flex;
		flex-grow: 1;
		align-items: center;
		height: calc(3em + var(--100vh, 1vh) * 5);
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.item-row {
		&__year {
			padding-right: max(min(2.39vw, 37px), 37px);
			position: relative;
			min-height: min(24px, 2.15vh);

			&__text {
				transition: font-size 0.5s ease-in-out;
				position: absolute;
				&:hover {
					font-size: calc(1rem + 1rem * 0.2);
				}
			}

			&:after {
				content: "";
				display: inline-block;
				width: min(max(1.39vw, 22px), 28px);
			}
		}

		&__title {
			padding-left: 1.39vw;
			transition: font-size 0.5s ease-in-out;
			position: relative;
			min-height: min(24px, 2.15vh);

			&__text {
				position: absolute;
			}
		}

		.font_size_x20 {
			font-size: calc(1rem + 1rem * 0.2);
		}
	}

	.md-border-cell {
		border-right: 1px solid #ebcb9a;
	}
}

/*********************************************************************
* 
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
