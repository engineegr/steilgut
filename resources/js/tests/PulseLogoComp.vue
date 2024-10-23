<template>
	<div class="tw-h-auto tw-w-full tw-max-w-full tw-overflow-y-auto">
		<div
			id="fp-first"
			class="fp"
		>
			<pulse-logo-comp></pulse-logo-comp>
		</div>
	</div>
</template>

<script>
const pulseLogoComp = () =>
	import(/* webpackPrefetch: true */ "../shared/components/PulseLogoComp")
export default {
	components: {
		"pulse-logo-comp": pulseLogoComp,
	},
};
</script>

<style scoped>
.steilgut-pulse {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background: url('/images/orig/pulse-logo/logo@2x.png');
	background-size: contain;
	background-repeat: no-repeat;
	width: 185px;
	height: 130px;
	animation: pulse 5s infinite;
}

@keyframes pulse {
	0% {
		transform: translate(-50%, -50%);
		opacity: 1;
	}

	25% {
		transform: translate(-50%, -50%) scale(1.1);
		/* transform: translate(-50%, -50%); */
		opacity: 0.1;
	}

	50% {
		transform: translate(-50%, -50%) scale(1.25);
		/* transform: translate(-50%, -50%); */
		opacity: 0.1;
	}

	75% {
		transform: translate(-50%, -50%) scale(1.5);
		/* transform: translate(-50%, -50%); */
		opacity: 0.1;
	}

	100% {
		transform: translate(-50%, -50%);
		opacity: 1;
	}
}

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

	background-color: #ebcb9a;
	/* filter: grayscale(0.6); */
	opacity: 0.5;
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
@media only screen and (min-width: 320px) and (max-width: 896px) {
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
}

@media only screen and (min-width: 321px) and (max-width: 896px) and (orientation: landscape) {
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1024px) and (max-width: 1600px) and (-webkit-min-device-pixel-ratio: 1) {
}

/* Large screens ----------- */
@media only screen and (min-width: 1824px) and (-webkit-min-device-pixel-ratio: 1) {
}

/* ----------- Retina Screens ----------- */
@media screen and (min-device-width: 1200px) and (max-width: 1600px) and (-webkit-min-device-pixel-ratio: 2) and (min-resolution: 192dpi) {
}

/* 
    *
    * ---------------------- iPhones ------------------- *
    *
*/
/* ----------- iPhone 4 and 4S ----------- */

/* Portrait and Landscape */
@media only screen and (min-width: 320px) and (max-width: 480px) and (-webkit-min-device-pixel-ratio: 2) {
}

/* Portrait */
@media only screen and (min-width: 320px) and (max-width: 480px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait) {
}

/* Landscape */
@media only screen and (min-width: 320px) and (max-width: 480px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: landscape) {
}

/* ----------- iPhone 5, 5S, 5C and 5SE ----------- */

/* Portrait and Landscape */
@media only screen and (min-width: 320px) and (max-width: 568px) and (-webkit-min-device-pixel-ratio: 2) {
}

/* Portrait */
@media only screen and (min-width: 320px) and (max-width: 568px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait) {
}

/* Landscape */
@media only screen and (min-width: 320px) and (max-width: 568px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: landscape) {
}

/* ----------- iPhone 6, 6S, 7 and 8 ----------- */

/* Portrait and Landscape */
@media only screen and (min-device-width: 375px) and (max-width: 667px) and (-webkit-min-device-pixel-ratio: 2) {
}

/* Portrait */
@media only screen and (min-device-width: 375px) and (max-width: 667px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait) {
}

/* Landscape */
@media only screen and (min-device-width: 375px) and (max-width: 667px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: landscape) {
}

/* ----------- iPhone 6+, 7+ and 8+ ----------- */

/* Portrait and Landscape */
@media only screen and (min-device-width: 414px) and (max-width: 736px) and (-webkit-min-device-pixel-ratio: 3) {
}

/* Portrait */
@media only screen and (min-device-width: 414px) and (max-width: 736px) and (-webkit-min-device-pixel-ratio: 3) and (orientation: portrait) {
}

/* Landscape */
@media only screen and (min-device-width: 414px) and (max-width: 736px) and (-webkit-min-device-pixel-ratio: 3) and (orientation: landscape) {
}

/* ----------- iPhone X ----------- */

/* Portrait and Landscape */
@media only screen and (min-device-width: 375px) and (max-width: 812px) and (-webkit-min-device-pixel-ratio: 3) {
}

/* Portrait */
@media only screen and (min-device-width: 375px) and (max-width: 812px) and (-webkit-min-device-pixel-ratio: 3) and (orientation: portrait) {
}

/* Landscape */
@media only screen and (min-device-width: 375px) and (max-width: 812px) and (-webkit-min-device-pixel-ratio: 3) and (orientation: landscape) {
}

/* iPhone XS Max, XR ----------- */
@media only screen and (min-device-width: 414px) and (max-height: 896px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 3) {
	/* Styles */
}

@media only screen and (min-device-width: 414px) and (max-height: 896px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 3) {
	/* Styles */
}

/* ----------- Apple Watch ----------- */
@media (max-width: 42mm) and (min-device-width: 38mm) {
}

/* iPads (portrait and landscape) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) {
	/* Styles */
}

/* iPads (landscape) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
	/* Styles */
}

/* iPads (portrait) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: portrait) {
	/* Styles */
}

/**********
iPad 3
**********/
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 2) {
	/* Styles */
}

@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 2) {
	/* Styles */
}

/* iPads (portrait and landscape) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) {
	/* Styles */
}

/* iPads (landscape) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
	/* Styles */
}

/* iPads (portrait) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: portrait) {
	/* Styles */
}

/**********
iPad 3
**********/
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 2) {
	/* Styles */
}

@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 2) {
	/* Styles */
}

/* 
    *
    * ---------------------- Samsung ------------------- *
    *
*/
/* ----------- Galaxy S3 ----------- */

/* Portrait and Landscape */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 2) {
}

/* Portrait */
@media screen and (device-width: 320px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait) {
}

/* Landscape */
@media screen and (device-width: 320px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape) {
}

/* ----------- Galaxy S4, S5 and Note 3 ----------- */

/* Portrait and Landscape */
@media screen and (device-width: 320px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 3) {
}

/* Portrait */
@media screen and (device-width: 320px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait) {
}

/* Landscape */
@media screen and (device-width: 320px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape) {
}

/* ----------- Galaxy S6 ----------- */

/* Portrait and Landscape */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 4) {
}

/* Portrait */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 4) and (orientation: portrait) {
}

/* Landscape */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 4) and (orientation: landscape) {
}

/* 
    *
    * ---------------------- Google Pixels ------------------- *
    *
*/
/* Portrait and Landscape */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 3) {
}

/* Portrait */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait) {
}

/* Landscape */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape) {
}

/* ----------- Google Pixel XL ----------- */

/* Portrait and Landscape */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 4) {
}

/* Portrait */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 4) and (orientation: portrait) {
}

/* Landscape */
@media screen and (device-width: 360px) and (device-height: 640px) and (-webkit-device-pixel-ratio: 4) and (orientation: landscape) {
}

/* 
    *
    * ---------------------- Windows Phone ------------------- *
    *
*/

/* Portrait and Landscape */
@media screen and (device-width: 480px) and (device-height: 800px) {
}

/* Portrait */
@media screen and (device-width: 480px) and (device-height: 800px) and (orientation: portrait) {
}

/* Landscape */
@media screen and (device-width: 480px) and (device-height: 800px) and (orientation: landscape) {
}
</style>
