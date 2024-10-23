<template>
	<div
		class="tw-flex md:tw-w-065 md:tw-max-w-065 landscape:tw-w-065 landscape:tw-max-w-065 tw-w-full tw-max-w-full tw-mx-auto legal-container portrait-non-fp landscape-non-fp tw-z-2"
		:class="{ 'is-bare-page': isBarePage }"
	>
		<lazy-load-image-comp
			basedLazyImgStyleClass="legal-pg-img"
			relativePath="legal-pg"
			baseName="bg-legal-pg"
			lqipPath_4_3="/images/4_3/legal-pg/lqip_4_3/jpg/4_3-lqip-bg-legal-pg.jpg"
			lqipPath_16_9="/images/16_9/legal-pg/lqip_16_9/jpg/16_9-lqip-bg-legal-pg.jpg"
			lqipPath_portrait="/images/mobile/legal-pg/lqip/portrait-lqip-bg-legal-pg.jpg"
			lazyLoadCommonImgStyleClass="tw-fixed tw-inset-0 tw-object-cover tw-max-w-screen tw-w-screen"
			basedLandscapeLazyImgStyleClass="tw-h-screen tw-max-h-screen"
			basedPortraitLazyImgStyleClass="tw-h-screen tw-max-h-screen"
			lazyLoadImgStyleClass_4_3=""
			lazyLoadImgStyleClass_16_9=""
			lazyLoadImgStyleClass_portrait=""
			commonImgStyleClass=""
			backZIndexStyleClass="tw-z-n-1"
			isDesktopAspectRatioCorrection="true"
		></lazy-load-image-comp>
		<div
			class="tw-flex transit-flex-box safari-legal-height tw-flex-col transit-flex-box landscape:tw-h-auto tw-relative tw-z-2"
		>
			<div
				v-if="isImpressum"
				class="transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"
			>
				<impressum-comp></impressum-comp>
			</div>
			<div
				v-if="isDatenschutz"
				class="transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"
			>
				<datenschutz-comp></datenschutz-comp>
			</div>
			<div
				v-if="isAGBS"
				class="transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"
			>
				<agbs-comp></agbs-comp>
			</div>
			<div
				v-if="isWiderruf"
				class="transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"
			>
				<widerruf-comp></widerruf-comp>
			</div>
			<div
				v-if="isVersand"
				class="transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"
			>
				<versand-comp></versand-comp>
			</div>
			<div
				v-if="isZahlungsarten"
				class="transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"
			>
				<zahlungsarten-comp></zahlungsarten-comp>
			</div>
		</div>
	</div>
</template>

<script>
import validationErrors from "../../mixins/validationErrors";
import mediaHelper from "../../mixins/mediaHelper";
import fullscreenCorrector from "../../mixins/fullscreenCorrector";
import { refreshFullPageContainers } from "../../utils/resizer";
import { mapGetters, mapState } from "vuex";
import { Helper } from "../../utils/helper";

const impressumComp = () => import("./ImpressumComp.vue");
const datenschutzComp = () => import("./DatenschutzComp.vue");
const agbsComp = () => import("./AGBSComp.vue");
const widerrufComp = () => import("./WiderrufComp.vue");
const versandComp = () => import("./VersandComp.vue");
const zahlungsartenComp = () => import("./ZahlungsartenComp.vue");

export default {
	mixins: [validationErrors, mediaHelper, fullscreenCorrector],

	components: {
		"impressum-comp": impressumComp,
		"datenschutz-comp": datenschutzComp,
		"agbs-comp": agbsComp,
		"widerruf-comp": widerrufComp,
		"versand-comp": versandComp,
		"zahlungsarten-comp": zahlungsartenComp,
	},

	props: {
		name: {
			type: [String],
			default: "impressum",
		},

		isBarePage: {
			type: [String, Boolean],
			require: false,
			default: false,
		},
	},

	created() {
		("use strict");
		if (this.$_checkedOrRedirected()) {
			console.log("Debug [legalComp::created] Initial state is valid");
		}
	},

	mounted() {
		if (this.isBarePage) {
			console.log("Debug [legalComp::created] Bare page");
		}
	},

	data: function () {
		return {};
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [legalComp::$_checkedOrRedirected] Returned Invalid Arguments"
				);
				this.$router.push({
					name: "controlPanel",
				});
				return false;
			}
			return true;
		},

		$_isInitialStateValid: function () {
			return true;
		},
	},

	computed: {
		isImpressum: function () {
			("use strict");
			return this.name === "impressum";
		},

		isDatenschutz: function () {
			("use strict");
			return this.name === "datenschutz";
		},

		isAGBS: function () {
			("use strict");
			return this.name === "agbs";
		},

		isWiderruf: function () {
			("use strict");
			return this.name === "widerruf";
		},

		isVersand: function () {
			("use strict");
			return this.name === "versand";
		},

		isZahlungsarten: function () {
			("use strict");
			return this.name === "zahlungsarten";
		},
	},
};
</script>

<style lang="scss" scoped>
.legal-container {
	display: flex;
	flex: 1 1 75vh;
	flex-direction: column;
	/* max-height: 80%; */
	height: 75vh;
	height: calc(var(--100nvh, 1vh) * 75);
	max-width: 65%;
	width: 65%;
}

.gold-border {
	border: 2px solid #ebcb9a;
}

.is-bare-page {
	top: 5%;
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
	/* remove rounding corners */
	textarea,
	input[type="text"],
	input[type="button"],
	input[type="submit"] {
		-webkit-appearance: none !important;
		border-radius: 0 !important;
	}

	.safari-legal-height {
		max-height: unset !important;
	}

	.legal-container {
		flex: 1 0 auto;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.legal-container {
		padding: 0 1rem 1rem 1rem;
		max-height: unset;
		height: auto;
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
	.legal-container {
		max-height: unset;
		min-height: 0;
		height: auto;
		margin-top: -15vh;
		padding-bottom: 8vh;
	}

	.is-bare-page {
		top: unset;
		margin-top: 15vh;
	}
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}
</style>
