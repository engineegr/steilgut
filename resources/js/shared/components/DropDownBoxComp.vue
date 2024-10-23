<template>
	<div class="drop-down-box">
		<!-- Desktop version -->
		<div class="tw-relative tw-hidden md:tw-block landscape:tw-hidden">
			<div
				class="drop-down-box-header tw-relative tw-z-20 tw-cursor-pointer drop-down-box-top tw-top-0 tw-max-w-full hover:tw-text-masthead-header-gold tw-cursor-pointer"
				v-on:click="handleMenuOpenClick($event)"
			>
				<span
					class="drop-down-box-header-text tw-block"
					:class="{
						'tw-text-masthead-header-gold': ifActive,
					}"
					>{{ menu.header }}</span
				>

				<div class="rel-drop-down-box-list tw-static drop-down-box-top">
					<div
						:class="[
							ifOpen,
							'drop-down-box-list',
							'tw-left-0',
							'tw-absolute',
							'md:tw-flex',
							'tw-hidden',
							'landscape:tw-hidden',
							'tw-text-black',
							'tw-max-w-full',
							'tw-justify-center',
							'tw-items-center',
							'tw-flex-col',
							'tw-text-center',
						]"
					>
						<!-- Underline -->
						<img
							class="drop-down-header-underline-img"
							src="/images/orig/masthead-pg/underline.svg"
							alt="Underline"
						/>
						<div class="drop-down-box-links" v-if="isOpen">
							<div class="drop-down-box-links-inner-block">
								<!-- 
                                        /*
                                        * We set a white/steilgut-gold colors for links in the app.scss.
                                        * We don't use tailwindcss color classes because 
                                        * they overlap the classes below.
                                        */
                                     -->
								<router-link
									v-for="(link, i) in menu.linkArray"
									:key="`link_menu_${link.linkTitle}_${i}`"
									:to="link.linkUrl"
									v-on:click.native="handleMenuLinkOpenClick"
									class="drop-down-box-link tw-block tw-text-center tw-no-underline hover:tw-no-underline focus:tw-no-underline focus:tw-outline-none"
									:class="[calcActiveMenuLinkStyleClass(link.linkUrl)]"
									v-html="link.linkTitle"
								></router-link>
							</div>
							<!-- Border -->
							<img
								src="/images/orig/masthead-pg/drop-down-menu.svg"
								alt="Drop down menu border"
								class="drop-down-box-border-img"
							/>
						</div>
					</div>
					<img
						v-if="ifActive && !isOpen"
						class="underline"
						src="/images/orig/masthead-pg/underline.svg"
						alt="Underline"
					/>
				</div>
			</div>

			<button
				class="tw-fixed tw-inset-0 tw-h-full tw-w-full focus:tw-outline-none tw-cursor-default"
				v-if="isOpen"
				v-on:click="handleMenuClickCloseAll($event)"
			></button>
		</div>

		<!-- Landscape/Portrait -->
		<div class="md:tw-hidden tw-block tw-relative tw-min-w-full landscape:tw-block">
			<div
				class="drop-down-box-header tw-min-w-full tw-px-4"
				v-on:click.prevent="handleMenuOpenClick($event)"
			>
				<span
					class="drop-down-box-header-text"
					:class="{
						'tw-text-masthead-header-gold': ifActive,
					}"
				>
					{{ this.menu.header }}
				</span>
				<div v-if="!isOpen" class="drop-down-box-arrow-down">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="15"
						height="9"
						viewBox="0 0 15 9"
					>
						<polyline
							fill="none"
							stroke="#FFF"
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							points=".66 .41 6.723 6.48 .8 12.41"
							transform="rotate(90 6.5 7.5)"
						/>
					</svg>
				</div>
				<div
					v-else
					class="drop-down-box-arrow-up"
					v-on:click="handleMenuClickCloseAll($event)"
				>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="15"
						height="9"
						viewBox="0 0 15 9"
					>
						<polyline
							fill="none"
							stroke="#FFF"
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							points=".66 .41 6.723 6.48 .8 12.41"
							transform="rotate(-90 4.5 3.5)"
						/>
					</svg>
				</div>
			</div>
			<div
				class="drop-down-box-list drop-down-box-top tw-relative tw-min-w-full"
				v-if="isOpen"
			>
				<div class="drop-down-box-inner-list">
					<!-- 
                        /*
                        * We set a white/steilgut-gold colors for links in the app.scss.
                        * We don't use tailwindcss color classes because 
                        * they overlap the classes below.
                        */
                    -->
					<router-link
						v-for="(link, i) in menu.linkArray"
						:key="`link_menu_${link.linkTitle}_${i}`"
						:to="link.linkUrl"
						class="drop-down-box-link tw-block tw-text-left tw-no-underline hover:tw-no-underline focus:tw-no-underline focus:tw-outline-none"
						:class="[calcActiveMenuLinkStyleClass(link.linkUrl)]"
						v-html="link.linkTitle"
					>
						<p class="tw-text-left">
							{{ link.linkTitle }}
						</p>
					</router-link>
				</div>
			</div>
			<button
				class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-bg-transparent focus:tw-outline-none tw-cursor-default"
				v-if="isOpen"
				v-on:click="handleMenuClickCloseAll($event)"
			></button>
		</div>
	</div>
</template>

<script>
import routeObserver from "../mixins/routeObserver";
export default {
	mixins: [routeObserver],
	props: {
		menu: {
			header: String,

			linkArray: [],
		},

		indexMenu: {
			type: [Number, String],
			default: 0,
		},

		isOpen: {
			type: [Boolean, String],
			default: false,
		},
	},

	methods: {
		handleMenuOpenClick: function (event) {
			// debugger;
			console.log("Debug [DropDownBoxComp::handleMenuOpenClick] ");
			this.$emit("click-open", event, this.indexMenu);
		},

		handleMenuLinkOpenClick: function (event) {
			// debugger;
			console.log("Debug [DropDownBoxComp::handleMenuLinkOpenClick] ");
			this.$emit("click-on-dropdown-menu-link", event);
		},

		handleMenuClickCloseAll: function (event) {
			// debugger;
			console.log("Debug [DropDownBoxComp::handleMenuClickCloseAll] ");
			this.$emit("click-close-all", event);
		},

		calcActiveMenuLinkStyleClass: function (menuLinkPath) {
			// debugger;
			console.log(
				"Debug [DropDownBoxComp::calcActiveMenuLinkStyleClass] " + menuLinkPath
			);
			return this.isActivePagePath(menuLinkPath) ? "active-drop-down-box-link" : "";
		},
	},

	created() {
		const handleEscKey = (e) => {
			console.log("Debug [DropDownBoxComp::handleEscKey] ");
			if (e.key === "Esc" || e.key == "Escape") {
				this.$emit("click-close-all", event);
			}
		};

		document.addEventListener("keydown", handleEscKey);
		this.$once("hook:beforeDestroy", () => {
			document.removeEventListener("keydown", handleEscKey);
		});
	},

	computed: {
		ifOpen: function () {
			return this.isOpen ? "drop-down-box-list" : "md:tw-hidden";
		},

		ifActive: function () {
			let isActive = false;
			this.menu.linkArray.forEach((linkItem) => {
				isActive = this.isActivePagePath(linkItem.linkUrl) || isActive;
			});
			return isActive;
		},
	},
};
</script>

<style lang="scss" scoped>
.drop-down-box-top {
	z-index: 3;
}

.drop-down-box-header {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	align-items: center;
}

.light-bg-shadow-filter {
	/*
    * https://www.cssmatic.com/box-shadow
    * https://css-tricks.com/almanac/properties/b/box-shadow/#example
    */
	-webkit-box-shadow: inset 0px 60vh 30vh 10vh rgba(0, 0, 0, 0.2);
	-moz-box-shadow: inset 0px 60vh 30vh 10vh rgba(0, 0, 0, 0.2);
	box-shadow: inset 0px 60vh 30vh 10vh rgba(0, 0, 0, 0.2);
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
	.drop-down-box-header {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
	}

	.drop-down-box-inner-list a {
		margin-left: 20%;
		font-family: steilgut_cormorant;
		font-weight: 300;
	}

	.drop-down-box-header span.drop-down-box-header-text {
		font-family: steilgut_cormorant;
		font-weight: 300;
	}

	.drop-down-box-list {
		background-color: rgba(0, 0, 0, 0.5);
		border: 0.3vw solid #4a4a4a;
		/* border: calc(var(--100vw, 1vw) * 0.3) solid #4a4a4a; */
	}

	.drop-down-box-inner-list {
		max-width: 80%;
		width: 80%;
		margin: 2vh auto;
	}

	.drop-down-box-link:focus {
		color: #ebcb9a;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.drop-down-box-header span.drop-down-box-header-text {
		font-size: min(max(calc(1rem + 0.8vh), 24px), 26px);
	}

	.drop-down-box-inner-list a {
		font-size: min(max(calc(1rem + 0.6vh), 22px), 23px);
	}

	.drop-down-box-inner-list .drop-down-box-link {
		margin: 2vh 0;
	}

	.drop-down-box-inner-list .drop-down-box-link:last-child {
		margin: 2vh 0 0 0;
	}

	.drop-down-box-arrow-down {
		height: 1.67vh;
		width: 2.78vh;
		min-height: 9px;
		min-width: 15px;
	}
}

@media only screen and (min-width: 1024px) and (orientation: portrait) {
	.drop-down-box-header span.drop-down-box-header-text,
	.drop-down-box-inner-list a {
		font-size: calc(1.2rem + 0.8vh);
	}

	.drop-down-box-header {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.drop-down-box-header span.drop-down-box-header-text {
		font-size: min(max(calc(1rem + 0.8vh), 24px), 26px);
	}

	.drop-down-box-inner-list a {
		font-size: min(max(calc(1rem + 0.6vh), 22px), 23px);
	}

	.drop-down-box-arrow-down {
		height: 3.67vh;
		width: 1.67vh;
		min-height: 9px;
		min-width: 15px;
	}
}

/* Laptops, desktops, large screens  ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.drop-down-box-top {
		z-index: 3;
	}

	.drop-down-box-list {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		width: 100%;
		min-width: 100%;
		background: transparent;
		border: none;
	}

	.drop-down-header-underline-block {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.underline {
		position: absolute;
		left: 50%;
		transform: translate(-50%, -50%);
		padding-top: 1.575rem;
		min-width: min(93px, 5vw);
		min-width: min(93px, calc(var(--100nvw, 1vw) * 5));
		width: 100%;
	}

	.drop-down-header-underline-img {
		position: relative;
		display: block;
		left: 50%;
		transform: translateX(-50%);

		min-width: min(93px, 5vw);
		min-width: min(93px, calc(var(--100nvw, 1vw) * 5));
		width: 100%;
		margin: auto;
		overflow: hidden;
		padding: 7px 0;
	}

	.drop-down-box-img-links-inner-block {
		max-width: 110%;
		width: 110%;
	}

	.drop-down-box-bg {
		position: absolute;
		z-index: 1;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		height: 100%;
		min-width: 100%;
		margin: 0;
		padding: 0;
	}

	.drop-down-box-border-img {
		position: absolute;
		display: block;
		z-index: 1;
		top: 0;
		left: 0;
		height: 100%;
		max-width: 107%;
		width: 107%;
		object-fit: fill;

		left: 50%;
		transform: translateX(-50%);
	}

	.drop-down-box-links {
		position: relative;
		top: 0%;
		left: 50%;
		transform: translate(-50%, 0);

		margin: auto;
		line-height: normal;
		font-size: 23px;
		font-size: calc(0.775rem + 1vh);
		font-size: calc(0.775rem + var(--100nvmin, 1vmin));

		min-width: max-content;
		width: 125%;
		max-width: unset;
		min-height: 180px;
		max-height: unset;
	}

	.drop-down-box-links-inner-block {
		position: relative;
		top: 0%;
		left: 50%;
		transform: translateX(-50%);

		z-index: 3;
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		max-height: 100%;
		height: 100%;
		max-width: 100%;
		height: 100%;
		margin: auto;
		padding: 37% 10%;
	}

	.drop-down-box-link {
		position: relative;
		z-index: 2;
		padding-top: 20px;
	}

	.drop-down-box-link:first-child {
		padding-top: 0;
	}
}

@media only screen and (min-width: 1025px) and (max-height: 720px) and (orientation: landscape) {
	// .drop-down-box-links {
	// 	width: 120px;
	// 	height: 180px;
	// }
}
</style>
