<template>
	<div class="news-item">
		<!-- SVG declarations -->
		<div>
			<svg width="0" height="0" xmlns="http://www.w3.org/2000/svg">
				<defs>
					<path
						id="news-form-a"
						d="M310,59.5550717 L291.835088,59.5550717 L291.835088,33.5845703 C272.40117,28.3569681 273.855088,27.1952788 246.636725,16.1635806 C221.104327,5.81714866 189.768947,0 154.994561,0 C120.225614,0 88.8902339,5.81714866 63.3596491,16.1635806 C36.1449123,27.1952788 37.5988304,28.3569681 18.1594737,33.5845703 L18.1594737,59.5550717 L0,59.5550717 L0,429.918613 L310,429.918613 L310,59.5550717 Z"
					/>
				</defs>
			</svg>
		</div>

		<router-link
			class="news-item-img-block tw-relative md:tw-overflow-auto tw-block tw-ml-0 hover:tw-no-underline focus:tw-outline-none fade-inOut-opacity"
			:class="{ 'zero-opacity': !this.isHeaderImgLoaded }"
			:to="{ name: 'showNewsBody', params: { id: newsItem.id } }"
		>
			<lazy-load-picture
				:keyIndex="itemKey"
				class="tw-object-scale-down news-item-img tw-ml-0 tw-block"
				imageClass="news-item-img__sz"
				:image="newsItem.image"
				v-on:on-picture-click.prevent="handleOnClick($event)"
				v-on:stop-loading-img-event="handleHeaderImageLoaded"
			>
			</lazy-load-picture>
			<!-- <img
				:src="newsItem.image"
				class="tw-object-scale-down news-item-img tw-ml-0 tw-block"
				v-on:click="handleOnClick($event)"
			/> -->
			<div class="news-item-posting-date">
				<h1 class="tw-text-news-text-gold news-item-posting-date-text">
					{{ newsItem.postingDate }}
				</h1>
			</div>
			<div class="news-item-title">
				<router-link
					class="hover:tw-no-underline"
					:to="{ name: 'showNewsBody', params: { id: newsItem.id } }"
				>
					<h1 class="hover:tw-text-masthead-header-gold">
						{{ newsItem.title }}
					</h1>
				</router-link>
			</div>
		</router-link>
	</div>
</template>

<script>
export default {
	props: {
		itemKey: [Number, String],
		newsItem: {
			id: Number,
			title: String,
			posting_date: String,
			image: String,
		},
	},

	data: function () {
		return {
			isHeaderImgLoaded: false,
		};
	},

	methods: {
		handleHeaderImageLoaded: function (event) {
			this.isHeaderImgLoaded = true;
		},
	},
};
</script>

<style lang="scss">
.news-item-img__sz {
	max-width: 100%;
	height: auto;
	width: auto;
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.news-item-img__sz {
		max-width: 70vw;
		min-height: 45vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.news-item-img__sz {
		max-width: 15vw;
		height: auto;
	}

	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.news-item-img__sz {
				max-height: calc(var(--100vh, 1vh) * 45);
				min-height: calc(var(--100vh, 1vh) * 45);
			}
		}
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.news-item-img__sz {
		height: 40vh;
		height: calc(var(--100nvh, 1vh) * 40);
	}
}
</style>

<style lang="scss" scoped>
@import "@/sass/_components.scss";
/*
 * Default styles aim on desktop version
*/
.news-item {
	display: flex;
	flex-direction: column;
	margin: 0 auto 0 auto;
	max-width: 21.52778vw;
	max-width: calc(var(--100nvw, 1vw) * 21.52778);
	width: 21.52778vw;
	width: calc(var(--100nvw, 1vw) * 21.52778);
}

.news-item-img-block {
	display: flex;
	flex-grow: 1;
	height: auto;
}

.news-item-img-block img.news-item-img {
	display: block;
	height: auto;
	width: auto;
	max-width: 100%;
}

.news-item-posting-date h1 {
	font-family: "steilgut_opensans";
	font-weight: lighter;
	margin: min(max(1.5vh, 1.875rem), 2rem) auto auto 0;
	margin: min(max(calc(var(--100nvh, 1vh) * 1.5), 1.875rem), 2rem) auto auto 0;
	font-size: calc(0.4rem + 0.4vw);
	font-size: calc(0.4rem + var(--100nvw, 1vw) * 0.4);
}

.news-item .news-item-title h1 {
	font-family: "steilgut_plantagenet_cherokee", sans-serif;
	max-width: 20.528vw;
	max-width: calc(var(--100nvw, 1vw) * 20.528);
	margin: min(max(1vh, 0.625rem), 0.8rem) auto auto 0;
	margin: min(max(var(--100nvh, 1vh), 0.625rem), 0.8rem) auto auto 0;
	font-size: calc(0.6rem + 0.7vw);
	font-size: calc(0.6rem + var(--100nvw, 1vw) * 0.7);
	@include dots-2line-string;
}

/*
 * END: Default styles aim on desktop version
*/

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.news-item {
		max-width: 100%;
		width: 100%;
		max-height: fit-content;
	}

	.news-item .news-item-title h1 {
		max-width: unset;
		width: auto;
	}

	.news-item-img-block {
		display: flex;
		width: fit-content;
		height: fit-content;
		max-width: 100%;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.news-item .news-item-title h1 {
		font-size: calc(0.7rem + 0.7vh);
		max-width: 70vw;
		margin: min(max(1vh, 0.625rem), 0.8rem) auto auto 0;
	}

	.news-item .news-item-posting-date h1 {
		margin: 1.5vh auto auto 0;
		font-size: calc(0.5rem + 0.5vh);
	}

	.news-item-img-block img.news-item-img {
		max-width: 70vw;
		min-height: 45vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.news-item-img-block img.news-item-img {
		max-width: 15vw;
		height: auto;
	}

	.news-item-posting-date h1 {
		margin: min(max(1.5vh, 0.875rem), 1rem) auto auto 0;
		margin: min(max(calc(var(--100nvh, 1vh) * 1.5), 0.875rem), 1rem) auto auto 0;
	}

	.news-item .news-item-title h1 {
		font-size: calc(0.6rem + 0.5vw);
		font-size: 4.3vmin;

		margin: auto;
		margin-top: 2vh;
	}

	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.news-item-img-block img.news-item-img {
				max-height: calc(var(--100vh, 1vh) * 45);
				min-height: calc(var(--100vh, 1vh) * 45);
			}

			.news-item .news-item-title h1 {
				margin-top: calc(var(--100vh, 1vh) * 2);
			}
		}
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-width: 2048px) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.news-item {
		max-width: 21.52778vw;
		max-width: calc(var(--100nvw, 1vw) * 21.52778);
		width: 21.52778vw;
		width: calc(var(--100nvw, 1vw) * 21.52778);
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.news-item {
		&-img-block {
			img.news-item-img {
				height: 40vh;
				height: calc(var(--100nvh, 1vh) * 40);
			}
		}
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (min-aspect-ratio: 16/10) {
	/* Styles */

	.news-item {
		max-width: 13.8828vw;
		max-width: calc(var(--100nvw, 1vw) * 13.8828);
		width: 13.8828vw;
		width: calc(var(--100nvw, 1vw) * 13.8828);
		height: auto;
		// height: 50vh;
		// height: calc(var(--100nvh, 1vh) * 50);
		// max-height: 50vh;
		// max-height: calc(var(--100nvh, 1vh) * 50);
	}
}

@media only screen and (min-width: 1025px) and (max-height: 800px) and (orientation: landscape) {
	.news-item-posting-date h1 {
		margin: min(max(calc(var(--100nvh, 1vh) * 1.5), 1rem), 1.175rem) auto auto 0;
	}
}
</style>
