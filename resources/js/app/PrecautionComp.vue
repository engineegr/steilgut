<template>
	<div class="precaution ar-balanced-page" :style="styleClassList">
		<lazy-load-image-comp
			basedLazyImgStyleClass="precaution-pg-img"
			relativePath="precaution-pg"
			baseName="bg-precaution-pg"
			lqipPath_4_3="/images/4_3/precaution-pg/lqip_4_3/4_3-lqip-bw-precaution-pg.jpg"
			lqipPath_16_9="/images/16_9/precaution-pg/lqip_16_9/16_9-lqip-bw-precaution-pg.jpg"
			lqipPath_portrait="/images/mobile/precaution-pg/lqip/portrait-lqip-bw-bg-precaution-pg.jpg"
			lazyLoadCommonImgStyleClass="tw-absolute tw-inset-0 tw-object-cover img-fp"
			isDesktopAspectRatioCorrection="true"
			:isBackgroundShadow="false"
			:isLandscapeBackgroundShadow="false"
			:isPortraitBackgroundShadow="false"
			:isSmooth="true"
		></lazy-load-image-comp>

		<div id="steilgut-precaution" class="precaution-content">
			<p class="logo">
				<a href="/"
					><img
						class="logo-img tw-object-scale-down"
						src="/images/logos/logo-pre.png"
						alt="Steilgut logo"
				/></a>
			</p>

			<nav id="lang-switch" class="tw-inline-flex">
				<lang-switch></lang-switch>
			</nav>
			<section class="precaution-paragraph tw-inline-block tw-text-white">
				<h1 class="precaution-text">
					{{ __("precaution.alcohol-warn") }}
				</h1>
			</section>
			<router-link
				class="precaution-accept-btn tw-flex tw-justify-items-center tw-align-middle precaution-accept-button tw-bg-transparent tw-border tw-border-lang-beige hover:tw-text-black hover:tw-bg-lang-beige hover:tw-border-gray-800 tw-px-5 tw-py-2 tw-rounded tw-text-white tw-no-underline hover:tw-no-underline android-fullscreen-ctrl-btn"
				to="/masthead/control-panel"
				v-on:click.native="handleConfirm($event)"
			>
				{{ __("precaution.age-accept") }}
				<div class="precaution-right">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="18"
						height="15"
						viewBox="0 0 18 15"
					>
						<path
							fill="currentColor"
							d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
							transform="translate(0 .213)"
						/>
					</svg>
				</div>
			</router-link>
		</div>
	</div>
</template>

<script>
import LangSwitchComp from "./LangSwitchComp.vue";
import { Helper } from "../shared/utils/helper";
import { calcAspectRatioStyleClassList } from "../shared/utils/resizer";
import aspectRatioCorrection from "../shared/mixins/aspectRatioCorrection";
import mediaHelper from "../shared/mixins/mediaHelper";
import fullscreenCorrector from "../shared/mixins/fullscreenCorrector";

export default {
	mixins: [mediaHelper, aspectRatioCorrection],

	mounted() {
		("use strict");
		this.switchBodyLock(true, ".precaution-content");
	},

	beforeRouteLeave(to, from, next) {
		("use strict");
		this.switchBodyLock(false, ".precaution-content");
		next();
	},

	data: function () {
		return {
			prevHeight: 0,

			mainBoardUpdateKey: "mainBoardUpdateKey_0",
			styleClassList: "",
		};
	},
	components: {
		"lang-switch": LangSwitchComp,
	},

	methods: {
		handleConfirm: function (event) {
			console.log("Debug [handleConfirm] Enter the function");

			let steilgutLocalState = JSON.parse(localStorage.getItem("STEILGUT"));
			if (steilgutLocalState && !steilgutLocalState.is18AgeOld) {
				steilgutLocalState.is18AgeOld = true;
				localStorage.setItem("STEILGUT", JSON.stringify(steilgutLocalState));
			}

			this.show = false;
		},
	},
};
</script>

<style lang="scss" scoped>
.pc-images-fade-enter-active,
.pc-images-fade-leave-active {
	transition-property: all;
	transition-duration: 1s;
	transition-timing-function: ease-in-out;
}

.pc-images-fade-enter-to, .pc-images-fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
	opacity: 1;
}

.pc-images-fade-enter {
	opacity: 0;
}

.fade-inOut-opacity {
	transition-property: opacity;
	transition-duration: 1s;
	transition-delay: 1s;
	transition-timing-function: ease-in-out;
}

.back-glass-container {
	position: absolute;
	display: block;

	max-width: 100%;
	width: 100%;
	max-height: 100%;
	height: 100%;

	flex-grow: 1;
	background-color: #ebcb9a;
	filter: grayscale(0.6);
	opacity: 0.5;
}

.steilgut-pulse {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background: url("/images/orig/pulse-logo/logo@2x.png");
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

	50% {
		transform: translate(-50%, -50%) scale(2);
		/* transform: translate(-50%, -50%); */
		opacity: 0.1;
	}

	100% {
		transform: translate(-50%, -50%);
		opacity: 1;
	}
}

/*
	Precaution component
	--------------------
	*/
.precaution {
	position: relative;
	display: flex;
	flex: 1 0 100%;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	max-width: 100%;
	width: 100%;

	min-height: 100%;
	min-height: 100vh;
	/* min-height: -webkit-fill-available; */

	/* border: 2px solid #ebcb9a; */
	/* overflow-y: auto; */
}

.precaution-content {
	position: relative;
	z-index: 2;
	flex: 1 0 100%;
	display: flex;

	flex-direction: column;
	justify-content: center;
	align-items: center;

	margin: 0;
	padding: 0;

	max-width: 100%;
	width: 100%;

	height: 100%;
	/* max-height: 100vh; */
}

.precaution-bg {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;

	max-width: 100%;
	width: 100%;
	max-height: 100%;
	height: 100%;

	background-size: cover;
	background-repeat: no-repeat;
	transition-property: opacity;
	transition-duration: 1.5s;
	transition-delay: 1.5s;
	transition-timing-function: ease;
}

.precaution-paragraph {
	max-width: 20%;
	text-align: center;
	/* top, bottom */
	margin: 2em 0 2em 0;
}

.precaution-text {
	font-family: "steilgut_cormorant", sans-serif;
	font-size: 1.5em;
	text-transform: unset;
}

.precaution-accept-button {
	font-family: "steilgut_opensans";
	font-weight: 100;
	font-size: 1.08em;
}

.precaution-right {
	margin: auto 0 auto 1em;
}

.precaution-right:hover svg path,
.precaution-right:focus svg path {
	fill: #000;
}

.precaution-content .logo {
	margin-bottom: 2em;
}

.precaution-paragraph {
	max-width: 25%;
}

.precaution-paragraph h1.precaution-text {
	margin: 0;
}

p.logo img {
	min-height: 10vh;
	min-height: calc(var(--100nvh, 1vh) * 18);

	max-height: 10vh;
	max-height: calc(var(--100nvh, 1vh) * 18);

	margin: auto;
	display: block;
}

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link 
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (orientation: portrait) {
	.precaution {
		/* 
         * address bar of mobile device is inside a view port 
         * @link 
         * https://medium.com/@stasonmars/viewport-%D0%B5%D0%B4%D0%B8%D0%BD%D0%B8%D1%86%D1%8B-%D0%B2-css-52c2b029f8b9
         */
		max-width: 100%;
		width: 100%;
		overflow: hidden;
	}

	.precaution-content {
		overflow: auto;
		-webkit-overflow-scrolling: touch;
	}

	p.logo img {
		max-height: 25vh;
		max-height: calc(var(--100vh, 1vh) * 25);
		min-height: unset;
	}

	.precaution-text {
		font-size: calc(1em + 0.8vh);
		margin: 2vh auto 2vh auto;
	}

	.precaution-paragraph {
		margin: 2vh 0 2vh 0;
	}
	.precaution-content .logo {
		margin-bottom: 2vh;
	}

	.precaution-paragraph {
		max-width: 50%;
	}

	.precaution-accept-btn {
		margin: 0 0 2em 0;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.precaution {
				min-height: calc(var(--100vh, 1vh) * 100);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	p.logo,
	p.logo img {
		height: 23vh;
		max-height: 23vh;
		min-height: unset;
	}

	.precaution-content p.logo {
		margin-bottom: 5vmin;
		margin-bottom: calc(var(--100vh, 1vh) * 5);
	}

	.precaution-paragraph {
		max-width: 60%;
		margin: calc(var(--100vh, 1vh) * 1) auto calc(var(--100vh, 1vh) * 1) auto;
	}

	.precaution-text {
		font-size: calc(1em + 0.8vh);
		font-size: calc(var(--100vh, 1vh) * 6);
	}

	.precaution-accept-btn {
		font-size: calc(0.8em + 0.8vmin);
		font-size: calc(var(--100vh, 1vh) * 5);
	}
}

/* Safari only */
@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
	@supports (-webkit-appearance: none) {
		p.logo,
		p.logo img {
			height: calc(var(--100vh, 1vh) * 23);
			max-height: calc(var(--100vh, 1vh) * 23);
		}
	}
}
</style>
