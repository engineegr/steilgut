<template>
	<div class="steilgut-history-item-content tw-w-full tw-max-w-full">
		<div class="md:tw-block tw-justify-center tw-hidden tw-h-full tw-max-h-full">
			<div class="item-story">
				<header class="history-header tw-pb-6 tw-max-w-min-content">
					<h1 class="tw-m-auto">
						{{ __("steilgutHistory.title") }}
					</h1>
					<img
						class="header-underscore-line"
						src="/images/orig/steilgut-history-pg/underline-ico/underline-ico.svg"
						alt="History: Underline"
					/>
				</header>
				<article class="md:tw-overflow-auto thread" v-html="itemData.thread">
					{{ itemData.thread }}
				</article>
			</div>
		</div>

		<div class="md:tw-hidden">
			<div class="tw-flex landscape:tw-hidden item-story">
				<div class="item-story-inner tw-pl-8 tw-py-6">
					<article v-html="itemData.thread">
						{{ itemData.thread }}
					</article>
				</div>
			</div>
			<div class="landscape:tw-flex tw-hidden item-story">
				<div class="item-story-inner tw-pl-6 tw-pb-6">
					<article v-html="itemData.thread" class="thread">
						{{ itemData.thread }}
					</article>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		itemData: [Object],
		itemKey: [Number, String],
	},

	created() {
		("use strict");
		console.log("Debug [SteilgutHistoryItemComp::created]");
	},
};
</script>

<style lang="scss" scoped>
.steilgut-history-item-content {
	font-family: "steilgut_opensans";
	font-weight: 100;
	line-height: 23px;
	line-height: calc(0.8em + var(--100nvh, 1vh) * 2);
}

.history-header {
	display: flex;
	flex-direction: column;
	justify-content: flex-start;
	align-content: center;
}

.item-story {
	display: flex;
	justify-content: center;
	align-content: center;
	width: 100%;
	min-width: 100%;
}

.header-underscore-line {
	max-width: 80%;
	width: fit-content;
	margin-left: 0;
}

.thread {
	max-height: calc(var(--100nvh, 1vh) * 60);
	padding: 0 1em 0 0;
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
	.item-story-inner {
		position: relative;
		z-index: 3;

		width: 100%;
		min-width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-content: center;
	}

	.steilgut-history-item-content {
		position: relative;
	}

	.thread {
		max-height: unset;
		height: auto;
	}

	.steilgut-history-item-content {
		font-family: "steilgut_opensans";
		font-weight: 100;
		line-height: 23px;
		line-height: calc(0.8rem + 2vmin);
	}
}

@media only screen and (min-width: 321px) and (max-width: 1024px) and (orientation: landscape) {
	.steilgut-history-item-content {
		padding: 0;
		margin-top: 50vh;
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.item-story {
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-content: center;
		width: 80%;
		max-width: 80%;
	}

	.history-header {
		display: flex;
		justify-content: flex-start;
		align-content: center;
	}
}
</style>
