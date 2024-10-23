<template>
	<div
		id="masthead"
		class="steilgut-masthead ar-balanced-page"
		:style="getStyleClassList"
	>
		<template v-if="isMastheadControlPanelPage()">
			<div v-for="i in 5" :key="`masthead_bg_container_key_${i}`">
				<transition name="banner-fade">
					<responsive-image-comp
						:key="`masthead_bg_key_${i}`"
						:keyIndex="i"
						v-if="i - 1 === getBgImageIndex && i - 1 !== 1"
						relativePath="masthead-pg"
						:baseName="`bg-mh-00${i - 1}`"
						:basedLazyImgStyleClass="`lazy-img-bg-mh-00${i - 1}`"
						basedPortraitLazyImgStyleClass="tw-object-cover mobile-landscape-fp-img tw-inset-0"
						isDesktopAspectRatioCorrection="true"
						:isSmooth="true"
						zIndexStyleClass="tw-z-0"
						isBackgroundShadow="true"
						isLandscapeBackgroundShadow="true"
						isPortraitBackgroundShadow="true"
					></responsive-image-comp>
				</transition>
			</div>
		</template>

		<div class="masthead-content">
			<header
				role="banner"
				:class="[
					{ 'opened-nav-bar': isMobileMenuOpen },
					{ 'nav-banner': !isMobileMenuOpen },
				]"
			>
				<nav-bar v-on:switch-mobile-menu="handleMobileMenuOpening"> </nav-bar>
			</header>

			<!-- Control view -->
			<transition name="routes-fade">
				<router-view
					v-on:switch-tumbler="handleSwitchTumbler"
					class="tw-flex-grow"
					:class="calcMobilePageOpacity()"
				/>
			</transition>

			<!-- FOOTER -->
			<footer class="masthead-footer" role="contentinfo">
				<div class="footer tw-hidden md:tw-flex">
					<nav class="lang-switch">
						<lang-switch></lang-switch>
					</nav>
					<div class="footer-right-site">
						<div class="tw-inline-flex tw-space-x-2 legal-container">
							<router-link
								class="legal-link-header"
								:class="{ 'tw-text-black': ifLightBackgroundPage() }"
								:to="{
									name: 'legalPage',
									params: {
										name: 'impressum',
									},
								}"
								>{{ __("masthead.legal.impressum") }}</router-link
							>
							<span
								class="tw-flex-none legal-link-separator"
								:class="{ 'tw-text-black': ifLightBackgroundPage() }"
								>|</span
							>
							<router-link
								class="legal-link-header"
								:class="{ 'tw-text-black': ifLightBackgroundPage() }"
								:to="{
									name: 'legalPage',
									params: {
										name: 'datenschutz',
									},
								}"
								>{{ __("masthead.legal.datenschutz") }}</router-link
							>
							<template
								v-if="
									isActivePagePath('/masthead/store') ||
									isActivePagePath('/masthead/wines-cart') ||
									isActivePathMatch('/masthead/order/.*') ||
									isActivePagePath('/masthead/order-finallization') ||
									isActivePathMatch('/masthead/legal/.*')
								"
							>
								<span
									class="tw-flex-none legal-link-separator"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									>|</span
								>
								<router-link
									class="legal-link-header"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									:to="{
										name: 'legalPage',
										params: {
											name: 'agbs',
										},
									}"
									>{{ __("masthead.legal.agbs") }}</router-link
								>
								<span
									class="tw-flex-none legal-link-separator"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									>|</span
								>
								<router-link
									class="legal-link-header"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									:to="{
										name: 'legalPage',
										params: {
											name: 'widerruf',
										},
									}"
									>{{ __("masthead.legal.widerruf") }}</router-link
								>
								<span
									class="tw-flex-none legal-link-separator"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									>|</span
								>
								<router-link
									class="legal-link-header"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									:to="{
										name: 'legalPage',
										params: {
											name: 'versand',
										},
									}"
									>{{ __("masthead.legal.versand") }}</router-link
								>
								<span
									class="tw-flex-none legal-link-separator"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									>|</span
								>
								<router-link
									class="legal-link-header"
									:class="{ 'tw-text-black': ifLightBackgroundPage() }"
									:to="{
										name: 'legalPage',
										params: {
											name: 'zahlungsarten',
										},
									}"
									>{{ __("masthead.legal.zahlungsarten") }}</router-link
								>
							</template>
						</div>
						<basket-icon-comp class="basket"></basket-icon-comp>
						<div class="social-sites-container">
							<ul
								class="social-icons-black-to-white"
								v-if="ifLightBackgroundPage()"
							>
								<li class="social-link social-link-insta">
									<a :href="socialNetLinks()['instagram']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="20"
											height="18"
											viewBox="0 0 20 18"
										>
											<g fill="#FFF">
												<path
													d="M9.99715,3.1812 C6.78865,3.1812 4.178275,5.791575 4.178275,9.000075 C4.178275,12.2187 6.78865,14.819325 9.99715,14.819325 C13.215475,14.819325 15.816025,12.2187 15.816025,9.000075 C15.816025,5.791575 13.215475,3.1812 9.99715,3.1812 Z M9.99715,13.613475 C7.456375,13.613475 5.393725,11.550825 5.393725,9.000075 C5.393725,6.4593 7.4563,4.386675 9.99715,4.386675 C12.5479,4.386675 14.610475,6.4593 14.610475,9.000075 C14.610475,11.550825 12.547975,13.613475 9.99715,13.613475 Z"
												/>
												<path
													d="M14.75995,0 L5.24455,0 C2.90305,0 0.925,1.89555 0.925,4.247475 L0.925,13.763175 C0.925,16.104 2.90305,17.775 5.24455,17.775 L14.75995,17.775 C17.11135,17.775 19.075,16.104 19.075,13.763175 L19.075,4.247475 C19.075,1.89555 17.11135,0 14.75995,0 Z M18.025,13.763175 C18.025,15.526275 16.52365,16.725 14.75995,16.725 L5.24455,16.725 C3.48055,16.725 2.05,15.526275 2.05,13.763175 L2.05,4.247475 C2.05,2.483475 3.48055,1.05 5.24455,1.05 L14.75995,1.05 C16.52365,1.05 18.025,2.483475 18.025,4.247475 L18.025,13.763175 Z"
												/>
												<path
													d="M15.70645,2.394075 C15.188275,2.394075 14.769925,2.812425 14.769925,3.330375 C14.769925,3.8487 15.188275,4.267125 15.70645,4.267125 C16.22455,4.267125 16.643275,3.8487 16.643275,3.330375 C16.643275,2.812425 16.22455,2.394075 15.70645,2.394075 Z"
												/>
											</g>
										</svg>
									</a>
								</li>
								<!-- <li class="social-link social-link-vk">
									<a :href="socialNetLinks()['vk']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="21"
											height="13"
											viewBox="0 0 21 13"
										>
											<path
												fill="#FFF"
												d="M1279.52132,13.8459339 C1279.66558,13.3586431 1279.52132,13 1278.8274,13 L1276.53124,13 C1275.94648,13 1275.67745,13.3079693 1275.53324,13.651045 C1275.53324,13.651045 1274.36377,16.5007422 1272.7108,18.3486034 C1272.17676,18.8826877 1271.93115,19.0542484 1271.63879,19.0542484 C1271.49462,19.0542484 1271.27234,18.8826877 1271.27234,18.3953969 L1271.27234,13.8459339 C1271.27234,13.2611758 1271.10854,13 1270.62518,13 L1267.01524,13 C1266.64879,13 1266.43048,13.2729084 1266.43048,13.5262777 C1266.43048,14.0798098 1267.25696,14.2084575 1267.34274,15.7678429 L1267.34274,19.1517157 C1267.34274,19.8924215 1267.21017,20.0287844 1266.91781,20.0287844 C1266.13812,20.0287844 1264.24347,17.1674002 1263.12074,13.8927274 C1262.89467,13.2572954 1262.67239,13 1262.08376,13 L1259.7875,13 C1259.13257,13 1259,13.3079693 1259,13.651045 C1259,14.2591314 1259.77969,17.2804806 1262.62944,21.2724397 C1264.52797,23.9973696 1267.20227,25.4749921 1269.63489,25.4749921 C1271.09676,25.4749921 1271.27613,25.1475293 1271.27613,24.5822647 C1271.27613,21.978039 1271.1436,21.7324305 1271.87655,21.7324305 C1272.21565,21.7324305 1272.80041,21.9039456 1274.16495,23.2176769 C1275.7242,24.7770623 1275.98154,25.4749921 1276.85478,25.4749921 L1279.15094,25.4749921 C1279.80591,25.4749921 1280.1373,25.1474837 1279.94625,24.5002278 C1279.50963,23.1397487 1276.55849,20.3406797 1276.42597,20.1535516 C1276.08682,19.7169347 1276.18424,19.5219544 1276.42597,19.1320853 C1276.42994,19.1282961 1279.2328,15.1830848 1279.52132,13.8459339 L1279.52132,13.8459339 Z"
												transform="translate(-1259 -13)"
											/>
										</svg>
									</a>
								</li> -->
								<li class="social-link social-link-facebook">
									<a :href="socialNetLinks()['facebook']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="9"
											height="18"
											viewBox="0 0 9 18"
										>
											<path
												fill="#FFF"
												d="M74.984607,18 L74.984607,8.99894618 L77.6471549,8.99894618 L78,5.89713316 L74.984607,5.89713316 L74.9891307,4.34464585 C74.9891307,3.53564525 75.0714989,3.10216426 76.3166349,3.10216426 L77.9811515,3.10216426 L77.9811515,0 L75.3182266,0 C72.1196256,0 70.9938009,1.50471303 70.9938009,4.0351671 L70.9938009,5.89748449 L69,5.89748449 L69,8.99929743 L70.9938009,8.99929743 L70.9938009,18 L74.984607,18 Z"
												transform="translate(-69)"
											/>
										</svg>
									</a>
								</li>
								<li class="social-link social-link-youtube">
									<a :href="socialNetLinks()['youtube']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="26"
											height="18"
											viewBox="0 0 26 18"
										>
											<path
												fill="#C4BBAA"
												d="M24.9374519,4.34674862 C24.9374519,4.34674862 24.6964045,2.64791237 23.9571012,1.89956979 C23.0200295,0.91784952 21.969008,0.91319292 21.4871872,0.855670249 C18.0374703,0.606131418 12.8626212,0.606131418 12.8626212,0.606131418 L12.8516645,0.606131418 C12.8516645,0.606131418 7.67708929,0.606131418 4.22709852,0.855670249 C3.74527765,0.91319292 2.69480409,0.91784952 1.75718454,1.89956979 C1.01788124,2.64791237 0.777381686,4.34674862 0.777381686,4.34674862 C0.777381686,4.34674862 0.530855947,6.34168968 0.530855947,8.33663076 L0.530855947,10.2072133 C0.530855947,12.2018804 0.777381686,14.1968215 0.777381686,14.1968215 C0.777381686,14.1968215 1.01788124,15.8956577 1.75718454,16.6440003 C2.69480409,17.6259945 3.92661104,17.5944939 4.47526776,17.6974869 C6.4477476,17.8867639 12.8571429,17.9453823 12.8571429,17.9453823 C12.8571429,17.9453823 18.0374703,17.9374386 21.4871872,17.6881737 C21.969008,17.6306511 23.0200295,17.6259945 23.9571012,16.6440003 C24.6964045,15.8956577 24.9374519,14.1968215 24.9374519,14.1968215 C24.9374519,14.1968215 25.1834298,12.2018804 25.1834298,10.2072133 L25.1834298,8.33663076 C25.1834298,6.34168968 24.9374519,4.34674862 24.9374519,4.34674862 Z M10.3121755,12.4733326 L10.3110798,5.54678113 L16.9722053,9.02197228 L10.3121755,12.4733326 Z"
											/>
										</svg>
									</a>
								</li>
							</ul>
							<ul class="social-icons" v-else>
								<li class="social-link social-link-insta">
									<a :href="socialNetLinks()['instagram']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="20"
											height="18"
											viewBox="0 0 20 18"
										>
											<g fill="#FFF">
												<path
													d="M9.99715,3.1812 C6.78865,3.1812 4.178275,5.791575 4.178275,9.000075 C4.178275,12.2187 6.78865,14.819325 9.99715,14.819325 C13.215475,14.819325 15.816025,12.2187 15.816025,9.000075 C15.816025,5.791575 13.215475,3.1812 9.99715,3.1812 Z M9.99715,13.613475 C7.456375,13.613475 5.393725,11.550825 5.393725,9.000075 C5.393725,6.4593 7.4563,4.386675 9.99715,4.386675 C12.5479,4.386675 14.610475,6.4593 14.610475,9.000075 C14.610475,11.550825 12.547975,13.613475 9.99715,13.613475 Z"
												/>
												<path
													d="M14.75995,0 L5.24455,0 C2.90305,0 0.925,1.89555 0.925,4.247475 L0.925,13.763175 C0.925,16.104 2.90305,17.775 5.24455,17.775 L14.75995,17.775 C17.11135,17.775 19.075,16.104 19.075,13.763175 L19.075,4.247475 C19.075,1.89555 17.11135,0 14.75995,0 Z M18.025,13.763175 C18.025,15.526275 16.52365,16.725 14.75995,16.725 L5.24455,16.725 C3.48055,16.725 2.05,15.526275 2.05,13.763175 L2.05,4.247475 C2.05,2.483475 3.48055,1.05 5.24455,1.05 L14.75995,1.05 C16.52365,1.05 18.025,2.483475 18.025,4.247475 L18.025,13.763175 Z"
												/>
												<path
													d="M15.70645,2.394075 C15.188275,2.394075 14.769925,2.812425 14.769925,3.330375 C14.769925,3.8487 15.188275,4.267125 15.70645,4.267125 C16.22455,4.267125 16.643275,3.8487 16.643275,3.330375 C16.643275,2.812425 16.22455,2.394075 15.70645,2.394075 Z"
												/>
											</g>
										</svg>
									</a>
								</li>
								<!-- <li class="social-link social-link-vk">
									<a :href="socialNetLinks()['vk']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="21"
											height="13"
											viewBox="0 0 21 13"
										>
											<path
												fill="#FFF"
												d="M1279.52132,13.8459339 C1279.66558,13.3586431 1279.52132,13 1278.8274,13 L1276.53124,13 C1275.94648,13 1275.67745,13.3079693 1275.53324,13.651045 C1275.53324,13.651045 1274.36377,16.5007422 1272.7108,18.3486034 C1272.17676,18.8826877 1271.93115,19.0542484 1271.63879,19.0542484 C1271.49462,19.0542484 1271.27234,18.8826877 1271.27234,18.3953969 L1271.27234,13.8459339 C1271.27234,13.2611758 1271.10854,13 1270.62518,13 L1267.01524,13 C1266.64879,13 1266.43048,13.2729084 1266.43048,13.5262777 C1266.43048,14.0798098 1267.25696,14.2084575 1267.34274,15.7678429 L1267.34274,19.1517157 C1267.34274,19.8924215 1267.21017,20.0287844 1266.91781,20.0287844 C1266.13812,20.0287844 1264.24347,17.1674002 1263.12074,13.8927274 C1262.89467,13.2572954 1262.67239,13 1262.08376,13 L1259.7875,13 C1259.13257,13 1259,13.3079693 1259,13.651045 C1259,14.2591314 1259.77969,17.2804806 1262.62944,21.2724397 C1264.52797,23.9973696 1267.20227,25.4749921 1269.63489,25.4749921 C1271.09676,25.4749921 1271.27613,25.1475293 1271.27613,24.5822647 C1271.27613,21.978039 1271.1436,21.7324305 1271.87655,21.7324305 C1272.21565,21.7324305 1272.80041,21.9039456 1274.16495,23.2176769 C1275.7242,24.7770623 1275.98154,25.4749921 1276.85478,25.4749921 L1279.15094,25.4749921 C1279.80591,25.4749921 1280.1373,25.1474837 1279.94625,24.5002278 C1279.50963,23.1397487 1276.55849,20.3406797 1276.42597,20.1535516 C1276.08682,19.7169347 1276.18424,19.5219544 1276.42597,19.1320853 C1276.42994,19.1282961 1279.2328,15.1830848 1279.52132,13.8459339 L1279.52132,13.8459339 Z"
												transform="translate(-1259 -13)"
											/>
										</svg>
									</a>
								</li> -->
								<li class="social-link social-link-facebook">
									<a :href="socialNetLinks()['facebook']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="9"
											height="18"
											viewBox="0 0 9 18"
										>
											<path
												fill="#FFF"
												d="M74.984607,18 L74.984607,8.99894618 L77.6471549,8.99894618 L78,5.89713316 L74.984607,5.89713316 L74.9891307,4.34464585 C74.9891307,3.53564525 75.0714989,3.10216426 76.3166349,3.10216426 L77.9811515,3.10216426 L77.9811515,0 L75.3182266,0 C72.1196256,0 70.9938009,1.50471303 70.9938009,4.0351671 L70.9938009,5.89748449 L69,5.89748449 L69,8.99929743 L70.9938009,8.99929743 L70.9938009,18 L74.984607,18 Z"
												transform="translate(-69)"
											/>
										</svg>
									</a>
								</li>
								<li class="social-link social-link-youtube">
									<a :href="socialNetLinks()['youtube']">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="26"
											height="18"
											viewBox="0 0 26 18"
										>
											<path
												fill="#C4BBAA"
												d="M24.9374519,4.34674862 C24.9374519,4.34674862 24.6964045,2.64791237 23.9571012,1.89956979 C23.0200295,0.91784952 21.969008,0.91319292 21.4871872,0.855670249 C18.0374703,0.606131418 12.8626212,0.606131418 12.8626212,0.606131418 L12.8516645,0.606131418 C12.8516645,0.606131418 7.67708929,0.606131418 4.22709852,0.855670249 C3.74527765,0.91319292 2.69480409,0.91784952 1.75718454,1.89956979 C1.01788124,2.64791237 0.777381686,4.34674862 0.777381686,4.34674862 C0.777381686,4.34674862 0.530855947,6.34168968 0.530855947,8.33663076 L0.530855947,10.2072133 C0.530855947,12.2018804 0.777381686,14.1968215 0.777381686,14.1968215 C0.777381686,14.1968215 1.01788124,15.8956577 1.75718454,16.6440003 C2.69480409,17.6259945 3.92661104,17.5944939 4.47526776,17.6974869 C6.4477476,17.8867639 12.8571429,17.9453823 12.8571429,17.9453823 C12.8571429,17.9453823 18.0374703,17.9374386 21.4871872,17.6881737 C21.969008,17.6306511 23.0200295,17.6259945 23.9571012,16.6440003 C24.6964045,15.8956577 24.9374519,14.1968215 24.9374519,14.1968215 C24.9374519,14.1968215 25.1834298,12.2018804 25.1834298,10.2072133 L25.1834298,8.33663076 C25.1834298,6.34168968 24.9374519,4.34674862 24.9374519,4.34674862 Z M10.3121755,12.4733326 L10.3110798,5.54678113 L16.9722053,9.02197228 L10.3121755,12.4733326 Z"
											/>
										</svg>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
</template>

<script>
const loginComp = () => import("./LoginComp");
const controlPanelComp = () => import("./ControlPanelComp");
const navBarComp = () => import("../shared/components/NavBarComp");
const basketIconComp = () => import("./store/BasketIconComp");
const backgroundShadowComp = () => import("../shared/components/BackgroundShadowComp");
import aspectRatioCorrection from "../shared/mixins/aspectRatioCorrection";
import mediaHelper from "../shared/mixins/mediaHelper";
import routeObserver from "../shared/mixins/routeObserver";

export default {
	mixins: [aspectRatioCorrection, mediaHelper, routeObserver],

	watch: {
		$route(to, from) {
			"use strict";
			this.$_scrollHiddenHtmlElement("#masthead");
			this.$_scrollHiddenHtmlElement("body");

			let bodyCssStyles = document.querySelector("body").style.cssText;
			const re = /(overflow: auto; -webkit-overflow-scrolling: touch;)|(overflow: auto;)|(-webkit-overflow-scrolling: touch;)/g;
			this.isPrevBodyScroll = bodyCssStyles.match(re) ? true : false;

			const jumpToTop = _.debounce(
				function () {
					window.scrollTo({ top: 0, left: 1, behavior: "smooth" });
				},
				100,
				{ leading: true, trailing: true }
			);

			jumpToTop();
		},
	},

	updated() {
		"use strict";
		const self = this;
		setTimeout(function () {
			self.$_scollAutoHtmlElement("#masthead");
			self.$_scollAutoHtmlElement("body");
		}, 500);
	},

	data: function () {
		return {
			bgCursor: this.$_getBgCursor(),
			prevBgCursor: this.$_getPrevBgCursor(),
			isMobileMenuOpen: this.getIfMobileMenuOpen(),

			/* fullscreenCorrector.js: Use to indetify the content element for switch body lock operations */
			contentElementSelector: ".masthead-content",

			isPrevBodyScroll: false,
		};
	},

	computed: {
		getBgUrl: function () {
			return this.$root.$data.stateStore.mastheadBgUrl;
		},

		getBgImageIndex: function () {
			return this.bgCursor;
		},

		getStyleClassList: function () {
			return this.styleClassList;
		},
	},

	components: {
		"control-panel": controlPanelComp,
		"login-comp": loginComp,
		"nav-bar": navBarComp,
		"basket-icon-comp": basketIconComp,
		"background-shadow-comp": backgroundShadowComp,
	},

	methods: {
		handleSwitchTumbler: function (event) {
			this.$_updateBgCursor();
		},

		getBgImageClass: function (i) {
			return i == this.$_getBgCursor()
				? "masthead-top-bg-img"
				: "masthead-bottom-bg-img";
		},

		getIfMobileMenuOpen: function () {
			return this.$root.$data.stateStore.mastheadIsMobileMenuOpen;
		},

		setIsMobileMenuOpen: function (isMobileMenuOpen) {
			this.$root.$data.stateStore.mastheadIsMobileMenuOpen = isMobileMenuOpen;
			this.isMobileMenuOpen = isMobileMenuOpen;
		},

		/*
		 * Background image and routes methods
		 */
		isMastheadControlPanelPage: function () {
			const ctrlPanelRegExp = /\/masthead\/control\-panel/;
			return ctrlPanelRegExp.test(this.$route.fullPath);
		},

		isWinesPage: function () {
			const winesRegExp = /\/masthead\/wines\/wines-bg/;
			return winesRegExp.test(this.$route.fullPath);
		},

		isSingleWinePage: function () {
			const singleWineRegExp = /\/masthead\/wines\/single-wine-bg/;
			return singleWineRegExp.test(this.$route.fullPath);
		},

		isNewsPage: function () {
			const newsRegExp = /\/masthead\/news/;
			return newsRegExp.test(this.$route.fullPath);
		},

		handleMobileMenuOpening: function (
			event,
			ifMobileMenuOpen,
			isRouteChanged,
			isOrientationChanged = false
		) {
			let bodyCssStyles = document.querySelector("body").style.cssText;
			const re = /(overflow: auto; -webkit-overflow-scrolling: touch;)|(overflow: auto;)|(-webkit-overflow-scrolling: touch;)/g;
			const ohRe = /overflow: hidden;/g;

			if (!isOrientationChanged) {
				if (ifMobileMenuOpen) {
					this.isPrevBodyScroll = bodyCssStyles.match(re) ? true : false;
					if (!this.isPrevBodyScroll) {
						bodyCssStyles = bodyCssStyles.replace(ohRe, "");
						bodyCssStyles +=
							" overflow: auto; -webkit-overflow-scrolling: touch;";
						document.documentElement.style.minHeight = "";
						document
							.querySelector("body")
							.setAttribute("style", bodyCssStyles);
					}

					this.switchBodyLock(false, ".masthead-content");
				}

				if (this.isMobileDevice()) {
					$(".navbar-container").toggleClass("mobile-menu-openned");
				}

				if (!ifMobileMenuOpen && !isRouteChanged) {
					if (this.isPrevBodyScroll && !bodyCssStyles.match(re)) {
						bodyCssStyles +=
							"overflow: auto; -webkit-overflow-scrolling: touch;";
						document.documentElement.style.minHeight = "";
						document
							.querySelector("body")
							.setAttribute("style", bodyCssStyles);
					} else if (!this.isPrevBodyScroll && bodyCssStyles.match(re)) {
						bodyCssStyles = bodyCssStyles.replace(re, "");
						document
							.querySelector("body")
							.setAttribute("style", bodyCssStyles);
					}
					this.switchBodyLock(!this.isPrevBodyScroll, ".masthead-content");
				}
			}
			this.setIsMobileMenuOpen(ifMobileMenuOpen);
		},

		calcMobilePageOpacity: function () {
			return {
				"fully-invisible": this.isMobileMenuOpen,
			};
		},

		/*
		 * Private methods
		 */
		$_getBgCursor: function () {
			return this.$root.$data.stateStore.controlPanelCursor;
		},
		$_setBgCursor: function (bgCursor) {
			this.$root.$data.stateStore.controlPanelCursor = bgCursor;
			this.bgCursor = this.$root.$data.stateStore.controlPanelCursor;
		},
		$_updateBgCursor: function () {
			this.bgCursor = this.$root.$data.stateStore.controlPanelCursor;
		},

		$_getPrevBgCursor: function () {
			return this.$root.$data.stateStore.mastheadPrevBgCursor;
		},
		$_setPrevBgCursor: function (prevBgCursor) {
			this.$root.$data.stateStore.mastheadPrevBgCursor = prevBgCursor;
			this.prevBgCursor = prevBgCursor;
		},

		$_scrollHiddenHtmlElement: function (elemSel) {
			const htmlElement = document.querySelector(elemSel);

			if (htmlElement) {
				const htmlElemStyleClasses = htmlElement.getAttribute("class");

				if (htmlElemStyleClasses) {
					let noAutoScrollClasses = htmlElemStyleClasses
						.replace("md:tw-overflow-y-auto", "")
						.trim();
					const hiddenAutoScrollClass = new RegExp(
						`.*md:tw-overflow-y-hidden.*`
					);
					if (!hiddenAutoScrollClass.test(noAutoScrollClasses)) {
						noAutoScrollClasses = noAutoScrollClasses.concat(
							" md:tw-overflow-y-hidden"
						);
					}
					htmlElement.setAttribute("class", noAutoScrollClasses);
				}
			} else {
				console.warn(
					"Warn [MastheadComp::$_scrollHiddenHtmlElement] Component has invalid identifier"
				);
			}
		},

		$_scollAutoHtmlElement: function (elemSel) {
			const htmlElement = document.querySelector(elemSel);

			if (htmlElement && htmlElement.getAttribute("class")) {
				const htmlElementStyleClasses = htmlElement
					.getAttribute("class")
					.replace("md:tw-overflow-y-hidden", "")
					.trim();

				htmlElement.setAttribute("class", htmlElementStyleClasses);
			}
		},
	},
};
</script>

<style lang="scss">
@media only screen and (min-width: 320px) and (orientation: portrait) {
	.opened-nav-bar {
		display: flex;
		flex: 1 0 auto;
		min-height: 100%;
		min-height: 100vh;
	}
}
</style>

<style lang="scss" scoped>
@import "@/sass/_variables.scss";

.steilgut-masthead,
.masthead-content {
	display: flex;
	flex: 1 0 100%;
	flex-direction: column;
	width: 100%;
	min-width: 100%;
	height: 100%;
	align-items: stretch;

	/* border: 2px solid #ebcb9a; */
}

.nav-banner {
	display: flex;
	flex: 0 0 13%;
	flex-direction: column;
	height: 13%;
	min-height: 13%;

	max-width: 100%;
	width: 100%;
}

.steilgut-masthead {
	position: relative;
	z-index: 5;
	height: 100%;
}

.masthead-bg-img {
	position: absolute;
	min-width: 100%;
	margin: 0;
	padding: 0;
}

.masthead-content {
	position: relative;
	top: 0;
	z-index: 2;
	height: 100%;
	min-height: 100%;
}

.masthead-bg-img {
	height: 100%;
	max-width: 100%;
	width: 100%;
	z-index: 0;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	object-fit: cover;
	background-repeat: no-repeat;
	background-position: center top;
	background-size: cover;
}

.masthead-top-bg-img {
	z-index: 1;
}

.masthead-bottom-bg-img {
	z-index: 0;
}

.header-sidebar ul li {
	display: inline-block;
	margin-right: 1em;
}

.header-sidebar ul li a {
	font-family: "Cormorant", sans-serif;
	font-weight: 300;
	font-size: small;
	text-decoration: none;
}

.header-sidebar ul li a {
	color: #fff;
}

.mobile-open-bg {
	background-color: #4a4a4a;
	position: fixed;
}

footer.masthead-footer {
	display: flex;
	flex: 1 0 5%;
	flex-direction: column;
	width: 100%;
	min-width: 100%;
	height: auto;
	max-height: 5%;
	position: relative;
	z-index: 5;
	bottom: 0;
	left: 0;
	right: 0;
}

footer.masthead-footer .lang-switch {
	display: flex;
	flex: 0 1 auto;
	flex-direction: column;
	margin: auto 0;
}

/*********************************************************************
* 
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.steilgut-masthead {
		/* 
         * address bar of mobile device is inside a view port 
         * @link 
         * https://medium.com/@stasonmars/viewport-%D0%B5%D0%B4%D0%B8%D0%BD%D0%B8%D1%86%D1%8B-%D0%B2-css-52c2b029f8b9
         */
		max-width: 100%;
		width: 100%;
		overflow: hidden;

		min-height: 100%;
		min-height: 100vh;
		min-height: calc(var(--100vh, 1vh) * 100);
		height: auto;
	}

	.masthead-bg-img {
		height: 100%;
		height: 100vh;
		height: calc(var(--100vh, 1vh) * 100);
		max-height: 100%;
		max-height: 100vh;
		max-height: calc(var(--100vh, 1vh) * 100);
		max-width: 100%;
		width: 100%;

		position: fixed;
	}

	.masthead-content {
		overflow: auto;
		-webkit-overflow-scrolling: touch;
	}

	footer.masthead-footer {
		flex: 0 0 5%;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.nav-banner {
		display: flex;
		flex: 0 0 15vh;
		flex-direction: column;
		height: auto;
		min-height: 15vh;
		max-height: 15vh;

		max-width: 100%;
		width: 100%;
	}

	.steilgut-masthead,
	.masthead-content {
		height: auto;
	}

	/* Logo
		-------*/
	.header-sidebar {
		display: flex;
		flex: 0 0 auto;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		flex-wrap: nowrap;
		padding: 0 0 0 0;
	}

	.header-sidebar ul li a {
		font-size: 1.1rem;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.nav-banner {
		display: flex;
		flex: 0 0 25vh;
		flex-direction: column;
		min-height: 25vh;
		height: auto;
	}

	.steilgut-masthead {
		flex-grow: 1;
	}

	/* Logo
		-------*/
	.header-sidebar {
		display: flex;
		flex: 0 0 auto;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		flex-wrap: nowrap;
		padding: 0 0 0 0;
	}

	.header-sidebar ul li a {
		font-size: 1.1rem;
	}

	footer.masthead-footer {
		display: none;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.nav-banner {
				flex: 0 0 25vh;
				flex: 0 0 calc(var(--100vh, 1vh) * 25);

				height: 25vh;
				height: calc(var(--100vh, 1vh) * 25);

				max-height: 25vh;
				max-height: calc(var(--100vh, 1vh) * 25);
			}
		}
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.steilgut-masthead {
		position: relative;
		z-index: 5;
		height: 100%;
	}

	.nav-banner {
		position: relative;
		top: 0;
		z-index: 5;
	}

	.header-sidebar {
		max-width: 100%;
		width: 100%;
		flex-direction: row;

		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		flex-wrap: nowrap;
		padding: 0 0 0 0;
		margin: 0 0 auto 0;
	}

	.left-nav ul {
		margin: auto auto auto 2em;
	}

	.right-nav ul {
		margin: auto 2em auto 2em;
	}

	.header-sidebar ul li:last-child {
		margin-right: auto;
	}

	.header-sidebar p.logo {
		margin: 0 auto 0 auto;
		background-color: transparent;
	}

	.login-right-nav {
		display: flex;
		flex-direction: column;
	}

	/* FOOTER
        --------- */

	footer.masthead-footer {
		flex-direction: column;
		justify-content: flex-end;
	}

	footer .footer {
		display: flex;
		flex: 0 0 auto;
		background: transparent;
		margin: 0 auto 0 auto;
		padding: 0 3.19rem;
		width: 100%;
		max-width: 100%;
		flex-direction: row;
		justify-content: space-evenly;
		align-items: center;
	}

	footer .footer .footer-right-site {
		display: flex;
		flex: 0 0 auto;
		flex-direction: row;
		align-items: center;
		justify-content: flex-end;

		margin: auto 0 auto auto;
		min-width: 50%;
	}

	footer .footer .footer-right-site .legal-container a.legal-link-header,
	footer .footer .footer-right-site .legal-container .legal-link-separator {
		font-size: 0.7rem;
		font-size: calc(0.4rem + 0.6vw);
		color: $STEILGUT_BEIGE_COLOR;
	}

	footer .footer .basket {
		margin: auto 1.56rem 0.5rem 2.5rem;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.steilgut-masthead {
				height: 100vh;
			}
		}
	}
}

/*********************************************************************
* 
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
