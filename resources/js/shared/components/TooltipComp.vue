<template>
	<div class="tip tip_sz transit-flex-box" :class="position">
		<span class="tip__text">{{ announcement }}</span>
		<img :src="image" alt="Tip background" class="tip__bg_img" />
	</div>
</template>

<script>
import validationErrors from "../mixins/validationErrors";
import mediaHelper from "../mixins/mediaHelper";
import { refreshFullPageContainers } from "../utils/resizer";
import { Helper } from "../utils/helper";
export default {
	props: {
		announcement: {
			type: [String],
			required: true,
		},

		position: {
			type: [String],
			required: true,
		},

		image: {
			type: [String],
			default: "/images/icons/store-pg/tip@2x.svg",
		},
	},

	data: function () {
		return {};
	},

	methods: {},

	computed: {},
};
</script>

<style lang="scss" scoped>
.tip {
	position: absolute;
	z-index: 20;
	text-align: center;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;

	&__text {
		/* Style for "По вашему" */
		max-width: 222px;
		color: #ffffff;
		font-family: "steilgut_opensans";
		font-size: 16px;
		font-weight: 300;

		z-index: 0;
	}

	&__bg_img {
		position: absolute;
		z-index: -1;

		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 100%;
	}
}

.tip_sz {
	width: min(max(22vw, 296px), 316px);
	height: min(max(19vh, 181px), 201px);
}

.left {
	top: 75%;
	left: -65%;
}

.right {
	top: 75%;
	left: 25%;
}

.top {
}

.down {
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
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.top {
		top: -100%;
		left: 0%;
	}

	.down {
		top: 100%;
		left: 0%;
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
	.tip {
		&__text {
			font-size: calc(0.6vw + 4px);
			width: 80%;
		}

		&__bg_img {
		}
	}

	.tip_sz {
		width: 148px;
		height: 90px;
	}

	.left {
		top: 50%;
		left: -70%;
	}

	.right {
		top: 50%;
		left: 50%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.tip_sz {
				width: min(max(22vw, 148px), 158px);
				height: min(max(19vh, 90px), 100px);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	.left {
		top: 50%;
		left: -100%;
	}
}

@media only screen and (min-width: 340px) and (max-width: 740px) and (orientation: landscape) {
}

@media only screen and (min-width: 375px) and (max-width: 1024px) and (orientation: landscape) {
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* Styles */
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	/* Styles */
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (min-aspect-ratio: 16/10) {
	/* Styles */
}
</style>
