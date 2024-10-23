<template>
	<div class="store-basket">
		<router-link to="/masthead/wines-cart" v-on:click.native="handleClick">
			<p class="basket-summary-paragraph abs-center tw-z-2">
				<em class="basket-summary-text">{{ inBasketSummaryCount }}</em>
			</p>
			<img
				v-if="ifLightBackgroundPage()"
				class="store-basket-img tw-z-1"
				src="/images/icons/store-pg/black-basket.svg"
				alt="basket"
			/>
			<img
				v-else
				class="store-basket-img tw-z-1"
				src="/images/icons/store-pg/basket.svg"
				alt="basket"
			/>
		</router-link>
	</div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import routeObserver from "../../shared/mixins/routeObserver";
import mediaHelper from "../../shared/mixins/mediaHelper";
export default {
	mixins: [routeObserver, mediaHelper],
	computed: {
		...mapGetters(["inBasketSummaryCount"]),
	},

	methods: {
		handleClick: function (event) {
			this.$emit("click-on-basket-icon");
		},
	},
};
</script>

<style lang="scss" scoped>
@import "@/sass/_components.scss";

@mixin lg-table-basket-icon {
	min-height: calc(42px + 1.2vh);
	min-width: calc(42px + 1.2vh);
}

@mixin phone-basket-icon {
	min-height: calc(24px + 1.2vh);
	min-width: calc(24px + 1.2vh);
}

.store-basket {
	&-img {
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		position: absolute;
	}
}

.basket-summary-text {
	margin: auto;
	font-family: "steilgut_opensans";
	font-weight: 100;
	font-size: 0.7rem;
	color: #c4bbaa;
}

.abs-center {
	position: absolute;
	bottom: -3%;
	left: 50%;
	transform: translate(-50%, 0%);
}

/*********************************************************************
* 
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/

/* All mobile devices */
@media only screen and (min-width: 320px) {
	.store-basket a {
		display: block;
		position: relative;
	}

	.basket-summary-text {
		font-size: calc(0.6rem + 1vh);
	}

	.store-basket a img.store-basket-img {
		top: 0;
		left: 50%;
		transform: translate(-50%, 0%);

		display: block;
		min-height: auto;
		min-width: auto;
		width: 100%;
	}
}

/* Smartphones, Tablets (portrait) ----------- */
@media only screen and (min-width: 320px) and (orientation: portrait) {
}

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.store-basket a {
		@include phone-basket-icon;
	}

	.abs-center {
		bottom: 1%;
	}

	.basket-summary-text {
		font-size: calc(0.6em + var(--100vh, 1vh));
	}
}

/* Tablets in portrait */
@media only screen and (min-width: 1024px) and (orientation: portrait) {
	.store-basket a {
		display: block;
		position: relative;

		@include lg-table-basket-icon;
	}

	.store-basket a img.store-basket-img {
		display: block;

		min-height: auto;
		min-width: auto;
		width: 100%;
	}
}

/* Laptops, desktops, large screens ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.store-basket a {
		width: 32px;
		max-width: 32px;
		height: 32px;
		max-height: 32px;
		position: relative;

		&-img {
			min-height: calc(30px + var(--100nvh, 1vh) * 1.2);
			min-width: calc(30px + var(--100nvh, 1vh) * 1.2);
		}
	}

	.basket-summary-text {
		font-size: calc(0.6rem + var(--100nvh, 1vh) * 0.3);
	}
}

/*********************************************************************
* 
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
