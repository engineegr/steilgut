<template>
	<div class="tw-h-auto tw-w-full tw-max-w-full tw-overflow-y-auto">
		<div id="fp-first" class="fp">
			<header class="fp-header-10 flex-center">
				<span class="fas fa-times"></span>
			</header>
			<main class="fp-main-80 flex-center">
				<h1>Main</h1>
			</main>
			<footer class="fp-footer-10 flex-center">
				<h1>Footer</h1>
			</footer>
		</div>
		<div id="fp-second" class="fp">
			<header class="fp-header-10 flex-center">
				<h1>Header002</h1>
			</header>
			<main class="fp-main-80 flex-center">
				<h1>Main002</h1>
			</main>
			<footer class="fp-footer-10 flex-center">
				<h1>Footer002</h1>
			</footer>
		</div>
	</div>
</template>

<script>
export default {
	mounted() {
		debugger;
		console.log("Debug [mounted]");
	},
};
</script>

<style scoped>
.fp {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	justify-content: center;
	align-content: center;
	max-height: 100%;
	height: 100%;

	max-width: 100%;
	width: 100%;
}

.fp-header-10 {
	height: 10%;
	max-height: 10%;

	width: 100%;
	max-width: 100%;

	background-color: orange;
}

.fp-main-80 {
	height: 80%;
	max-height: 80%;

	width: 100%;
	max-width: 100%;

	background-color: yellowgreen;
}

.fp-footer-10 {
	height: 10%;
	max-height: 10%;

	width: 100%;
	max-width: 100%;

	background-color: burlywood;
}

.flex-center {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	justify-content: center;
	align-items: center;
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

@media only screen and (min-width: 320px) and (orientation: portrait) {
}

@media only screen and (min-width: 321px) and (max-width: 1024px) and (orientation: landscape) {
}
</style>
