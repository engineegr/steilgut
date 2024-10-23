<template>
	<div class="portable-navbar tw-flex tw-flex-col md:tw-max-h-full md:tw-h-full">
		<div
			class="transit-flex-box tw-flex md:tw-w-full md:tw-max-w-full md:tw-max-h-full landscape:tw-hidden"
		>
			<div
				class="tw-flex tw-flex-row tw-content-center tw-items-center tw-w-full tw-max-w-full md:tw-relative"
			>
				<div
					v-for="(menuItem, i) in menu"
					:key="`${i}_${calcMenuItemStyleClass(i)}_portableNavbarMenuItem`"
					:class="[
						'tw-relative',
						{ 'tw-text-steilgut-gold': menuControl[i].isOpen },
						calcMenuItemStyleClass(i),
					]"
					@click="handleItemMenuClick($event, i)"
				>
					<img
						class="menu-item-icon tw-object-contain"
						:src="menuItem.header.icon"
					/>
					<h1
						:class="[
							'header-text',
							calcHeaderTextStyleClass(i),
							'md:tw-px-2 tw-px-2',
						]"
					>
						{{ menuItem.header.title }}
					</h1>
				</div>
				<slot name="oppositeTitleDesktop"></slot>
			</div>
			<transition name="portable-navbar-fade">
				<div
					class="menu-item-content tw-w-full tw-max-w-full"
					:key="`${cursor}_menuItemContent`"
				>
					<p class="menu-item-text soft-gray" v-html="menu[cursor].text">
						{{ menu[cursor].text }}
					</p>
				</div>
			</transition>
		</div>
		<div
			class="tw-flex tw-flex-col tw-content-center tw-items-center tw-w-full tw-max-w-full tw-hidden landscape:tw-flex"
		>
			<div
				v-for="(menuItem, i) in menu"
				:key="`${i}_${calcMenuItemStyleClass(i)}_portableNavbarMenuItem`"
				class="menu-item-block tw-w-full tw-max-w-full"
			>
				<div
					:class="[
						'tw-relative',
						{ 'tw-cursor-pointer': menu.length > 1 },
						calcMenuItemStyleClass(i),
					]"
					@click="handleItemMenuOpenCloseClick($event, i)"
				>
					<div class="menu-item-header tw-block">
						<img
							class="menu-item-icon tw-object-scale-down tw-inline-block"
							:src="menuItem.header.icon"
						/>
						<h1
							:class="[
								'header-text',
								'md:tw-px-2 tw-px-2',
								{ 'tw-text-steilgut-gold': menuControl[i].isOpen },
							]"
							class="tw-inline-block"
						>
							{{ menuItem.header.title }}
						</h1>
					</div>
					<img
						v-if="menuControl[i].isOpen"
						class="menu-item-arrow-up tw-object-scale-down"
						src="/images/icons/single-wine-pg/arrow-up.svg"
					/>
					<img
						v-else
						class="menu-item-arrow-down tw-object-scale-down"
						src="/images/icons/single-wine-pg/arrow-down.svg"
					/>
				</div>

				<transition name="portable-navbar-fade">
					<div
						class="menu-item-content tw-w-full tw-max-w-full soft-gray"
						:key="`${i}_menuItemContent`"
						v-if="menuControl[i].isOpen"
					>
						<p class="menu-item-text" v-html="menuItem.text">
							{{ menuItem.text }}
						</p>
					</div>
				</transition>
			</div>
		</div>
	</div>
</template>

<script>
import mediaHelper from "../mixins/mediaHelper";
export default {
	mixins: [mediaHelper],
	props: {
		menu: {
			type: Array,
			default: [
				{
					header: {
						title: "Header001",
						icon: "path/to/icon",
					},
					text: "Some text",
				},
				{
					header: {
						title: "Header002",
						icon: "path/to/icon",
					},
					text: "Some text 002",
				},
			],
		},
	},

	data: function () {
		return {
			cursor: 0,

			isHarvestAspectOpen: false,
			isTasteOpen: false,

			/* use only for Landscape */
			menuControl: [],
		};
	},

	created() {
		("use strict");
		for (let i = 0; i < this.menu.length; i++) {
			this.menuControl[i] = Object.create(null);
			this.menuControl[i].isOpen = false;
		}
	},

	methods: {
		handleItemMenuClick: function (event, index) {
			this.cursor = index;
		},

		handleItemMenuOpenCloseClick: function (event, index) {
			const prevState = this.menuControl[index].isOpen;
			this.menuControl.forEach((element) => {
				element.isOpen = false;
			});

			this.menuControl[index].isOpen = !prevState;

			// Tells VUE to update vDOM
			this.menuControl = this.menuControl.slice(0);
		},

		$_parseIndexByKey: function (key) {
			const keyPattern = /^(\d)+_portableNavbarMenuItem$/;
			const [_, index] = keyPattern.exec(key);
			return index - 1;
		},

		calcMenuItemStyleClass: function (index) {
			let resultStyleClass = "menu-item";

			if (
				this.isPortraitOrientation() ||
				(!this.isMobileDevice() && !this.isBrowserLandscapeOrientation())
			) {
				resultStyleClass =
					this.menu.length - 1 !== index
						? "menu-item menu-item-right-border"
						: "menu-item";

				if (this.cursor !== index) {
					resultStyleClass += " disabled-icon";
				}
			}

			if (
				this.isLandscapeOrientation() ||
				(!this.isMobileDevice() && this.isBrowserLandscapeOrientation())
			) {
				if (!this.menuControl[index].isOpen) {
					resultStyleClass += " disabled-icon menu-item-bottom-border";
				} else {
					resultStyleClass += " opened-menu-item-bottom-border";
				}
			}

			return resultStyleClass;
		},

		calcHeaderTextStyleClass: function (key) {
			if (this.menu.length == 1) {
				return "tw-text-steilgut-text-gold";
			}
			return key === this.cursor
				? "tw-text-steilgut-text-gold tw-underline"
				: "tw-text-steilgut-text-gray";
		},
	},

	computed: {
		ifHarvestAspectOpen: function () {
			if (!this.isMobileDevice() || this.isPortraitOrientation()) {
				return true;
			}
			return this.isHarvestAspectOpen;
		},

		ifTasteOpen: function () {
			if (!this.isMobileDevice() || this.isPortraitOrientation()) {
				return true;
			}
			return this.isTasteOpen;
		},
	},
};
</script>

<style lang="scss" scoped>
.portable-navbar-fade-enter-active {
	transition: opacity 3s ease;
}

.portable-navbar-fade-enter
/* .component-fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.portable-navbar-fade-leave {
	opacity: 0;
	display: none;
}

.menu-item {
	display: flex;
	flex-direction: row;
	justify-content: center;
	align-content: center;
	margin-bottom: 1em;
	margin-bottom: calc(0.5em + 0.5vmin);
}

.menu-item:nth-child(1) {
	padding: 0.5em 2em 0.5em 0.5em;
	padding: calc(0.2em + var(--100nvmin, 1vmin) * 0.3) calc(0.4em + var(--100nvw, 1vw))
		calc(0.2em + var(--100nvmin, 1vmin) * 0.3)
		calc(0.2em + var(--100nvmin, 1vmin) * 0.3);
}

.menu-item:nth-child(2) {
	padding: 0.5em 0.5em 0.5em 2em;
	padding: calc(0.2em + var(--100nvmin, 1vmin) * 0.3) calc(0.4em + var(--100nvw, 1vw))
		calc(0.2em + var(--100nvmin, 1vmin) * 0.3)
		calc(0.2em + var(--100nvmin, 1vmin) * 0.3);
}

p.menu-item-text {
	max-height: 100%;
	line-height: 23px;
	line-height: calc(0.655em + var(--100nvh));
	overflow: auto;
}

.menu-item-right-border {
	border-right: 1px solid rgba(204, 204, 204, 0.2);
}
/*  */
.menu-item-bottom-border {
	border-bottom: 1px solid rgba(204, 204, 204, 0.2);
}

.opened-menu-item-bottom-border {
	border-bottom: 1px solid rgba(235, 203, 154, 0.2);
}

.menu-item-content {
	padding: 2vh 0;
	height: max-content;
}

.menu-item-text,
.header-text {
	font-family: "steilgut_opensans";
	font-weight: lighter;
	font-size: calc(0.7em + 0.3vh);
}

.menu-item {
	text-align: justify;
}

.disabled-icon {
	opacity: 0.4;
	filter: grayscale(100%);
	-webkit-filter: grayscale(100%);
}

h1.header-text {
	margin: 0;
	max-height: fit-content;
	text-transform: none;
}

h1.header-text::first-letter {
	text-transform: capitalize;
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
	p.menu-item-text {
		line-height: 23px;
		line-height: calc(0.655em + var(--100vh));
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	p.menu-item-text {
		max-height: 100%;
		line-height: 5vmin;
	}

	.menu-item-content {
		border-top: 0.1em solid rgba(204, 204, 204, 0.2);
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.portable-navbar {
		max-width: 50vw;
		margin: auto auto auto 0;
	}

	.menu-item-block {
		margin: 0;
		display: flex;
		flex: 0 0 auto;
		flex-direction: column;
	}

	.menu-item {
		flex: 0 0 auto;
		width: 100%;
		justify-content: space-between;
		align-items: center;

		padding: 1.5% 0;
		margin: 1% 0;
		font-size: calc(0.5em + 0.5vw);
		font-size: 5vh;
	}

	.menu-item-icon {
		max-height: 5vmin;
	}

	.menu-item-content {
		max-height: 10vh;
		overflow-y: auto;
		padding: 1.5% 0;
	}

	.menu-item-text {
		font-size: 3vh;
	}

	.menu-item-text,
	.header-text {
		font-size: calc(0.3em + 0.5vh);
	}

	p.menu-item-text {
		max-height: 100%;
		line-height: 12px;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.menu-item {
				font-size: calc(0.5em + 0.5vw);
				font-size: calc(var(--100vh, 1vh) * 5);
			}
			.menu-item-icon {
				max-height: 5vmin;
				max-height: calc(var(--100vh, 1vh) * 5);
			}

			.menu-item-content {
				max-height: 10vh;
				max-height: calc(var(--100vh, 1vh) * 15);
			}

			.menu-item-text,
			.header-text {
				font-size: calc(0.3em + 0.5vh);
				font-size: calc(var(--100vh, 1vh) * 2.5);
			}

			p.menu-item-text {
				max-height: 100%;
				line-height: calc(var(--100vh, 1vh) * 3);
				overflow-y: auto;
			}
		}
	}

	/* Chrome only */
	@media screen and (-webkit-min-device-pixel-ratio: 0) and (min-resolution: 0.001dpcm) {
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	.menu-item {
		font-size: calc(var(--100vh, 1vh) * 3);
	}

	.menu-item-icon {
		max-height: 3.5vmin;
	}

	.menu-item-arrow-up,
	.menu-item-arrow-down {
		height: 3vh;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.menu-item-arrow-up,
			.menu-item-arrow-down {
				font-size: calc(0.3em + 0.5vh);
				height: calc(var(--100vh, 1vh) * 2);
			}
		}
	}
}

/* Laptops, desktops, large screens */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* Styles */
	.menu-item-content {
		flex: 1 0 auto;
		max-height: 70%;
		/* for mozilla */

		scrollbar-width: 0px !important;
		border-top: 0.1em solid rgba(204, 204, 204, 0.2) !important;
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-width: 2048px) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.menu-item-content {
		max-height: 100%;
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (min-aspect-ratio: 16/10) {
	/* Styles */
	.menu-item-content {
		border-top: 0.1em solid rgba(204, 204, 204, 0.2);
	}
}

@media only screen and (min-width: 897px) and (max-height: 720px) {
	.menu-item-content {
		flex: 1 0 auto;
		max-height: 50%;
		overflow: auto;
		/* for mozilla */
		scrollbar-width: 0px;
		border-top: 0.1em solid rgba(204, 204, 204, 0.2);
	}

	.menu-item-text,
	.header-text {
		font-size: 0.8em;
		font-size: calc(0.6em + 0.6vmin);
	}

	.menu-item {
		padding: 0.5em;
		padding: calc(0.2em + 0.3vmin);
		margin-bottom: 0;
	}
}
</style>
