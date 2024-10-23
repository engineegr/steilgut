<template>
	<div
		id="nav-bar"
		class="transit-flex-box tw-bg-transparent md:tw-block navbar_container portrait-non-fp landscape-non-fp"
	>
		<div class="md:tw-hidden landscape:tw-block tw-block" v-if="isMobileMenuOpen">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-menu-pg-img"
				relativePath="menu-pg"
				baseName="bg-menu-pg"
				lqipPath_16_9="/images/16_9/menu-pg/lqip_16_9/jpg/16_9-lqip-bg-menu-pg.jpg"
				lqipPath_portrait="/images/mobile/menu-pg/lqip/jpg/lqip-portrait-bg-menu-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-0 tw-top-0 tw-right-0 tw-bottom-0 tw-object-cover mobile-menu-bg"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass=""
				basedPortraitLazyImgStyleClass=""
				lazyLoadImgStyleClass_portrait=""
				portraitControlLazyImgStyleClass=""
				commonImgStyleClass=""
				atSurfaceZindexStyleClass="tw-z-0"
				zIndexStyleClass="tw-z-0"
				backZIndexStyleClass="tw-z-n-1"
				isHiddenDesktop="true"
			></lazy-load-image-comp>
		</div>
		<header
			role="banner"
			class="navbar_container__navbar_header md:tw-block md:h-full md:max-h-full tw-block"
		>
			<svg width="0" height="0" xmlns="http://www.w3.org/2000/svg">
				<defs>
					<mask id="dropdownlist-underline-b" fill="#fff">
						<path
							id="dropdownlist-underline-a"
							d="M5.281,0.287 C4.391,2.015 2.63,3.513 0.323,4.504 L0.323,4.504 C0.127,4.588 0,4.784 0,5 L0,5 C0,5.216 0.127,5.411 0.323,5.496 L0.323,5.496 C2.629,6.485 4.389,7.982 5.281,9.711 L5.281,9.711 C5.372,9.888 5.553,9.999 5.748,9.999 L5.748,9.999 C5.944,9.999 6.124,9.888 6.214,9.711 L6.214,9.711 C7.072,8.045 8.745,6.6 10.928,5.611 L10.928,5.611 C10.953,5.613 10.975,5.622 11,5.62 L11,5.62 C26.49,4.702 56.755,5.479 56.755,5.479 L56.755,5.479 L64.334,5.683 L73.197,5.889 L86.361,6.036 C86.361,6.036 86.448,5.893 86.49,5.823 L86.49,5.823 C86.523,5.779 86.555,5.736 86.574,5.683 L86.574,5.683 C86.849,5.222 87.132,4.758 87.449,4.334 L87.449,4.334 C88.764,2.567 90.734,1.38 92.717,1.158 L92.717,1.158 C94.846,0.92 97.012,1.811 98.233,3.427 L98.233,3.427 C99.517,5.124 99.659,7.591 98.572,9.29 L98.572,9.29 C97.451,11.042 95.015,11.782 93.25,10.907 L93.25,10.907 C91.929,10.25 91.11,8.786 91.303,7.423 L91.303,7.423 C91.401,6.728 91.818,6.044 92.419,5.596 L92.419,5.596 C92.968,5.185 93.599,5.014 94.193,5.113 L94.193,5.113 C94.834,5.22 95.43,5.708 95.751,6.385 L95.751,6.385 C96.046,7.008 96.052,7.66 95.771,8.176 L95.771,8.176 C95.675,8.348 95.736,8.567 95.906,8.664 L95.906,8.664 C96.075,8.76 96.289,8.698 96.383,8.525 L96.383,8.525 C96.78,7.803 96.78,6.909 96.384,6.073 L96.384,6.073 C95.967,5.189 95.169,4.55 94.306,4.406 L94.306,4.406 C93.523,4.275 92.706,4.492 92.003,5.019 L92.003,5.019 C91.242,5.586 90.733,6.426 90.606,7.322 L90.606,7.322 C90.373,8.982 91.353,10.762 92.942,11.552 L92.942,11.552 C95.045,12.596 97.833,11.755 99.162,9.682 L99.162,9.682 C100.406,7.735 100.251,4.92 98.79,2.99 L98.79,2.99 C97.422,1.179 95.007,0.181 92.64,0.446 L92.64,0.446 C90.436,0.691 88.34,1.951 86.889,3.899 L86.889,3.899 C86.632,4.245 86.4,4.607 86.177,4.973 L86.177,4.973 C86.145,4.967 86.117,4.954 86.085,4.954 L86.085,4.954 C81.801,4.954 73.31,4.814 73.31,4.814 L73.31,4.814 L64.496,4.612 L58.721,4.456 C58.721,4.456 27.297,3.594 11.22,4.533 L11.22,4.533 C11.205,4.524 11.174,4.504 11.174,4.504 L11.174,4.504 C11.174,4.504 7.105,2.015 6.214,0.287 L6.214,0.287 C6.124,0.11 5.944,0 5.748,0 L5.748,0 C5.553,0 5.372,0.11 5.281,0.287 L5.281,0.287 Z M1.77,5 C3.471,4.101 4.842,2.921 5.748,1.575 L5.748,1.575 C6.654,2.921 8.024,4.101 9.725,5 L9.725,5 C8.024,5.898 6.654,7.078 5.748,8.424 L5.748,8.424 C4.842,7.077 3.471,5.897 1.77,5 L1.77,5 Z"
						/>
						<use xlink:href="#dropdownlist-underline-a" />
					</mask>

					<filter
						x="-0.8%"
						y="-7.5%"
						width="101.7%"
						height="114.9%"
						filterUnits="objectBoundingBox"
						id="filter-1"
					>
						<feOffset
							dx="0"
							dy="2"
							in="SourceAlpha"
							result="shadowOffsetOuter1"
						></feOffset>
						<feGaussianBlur
							stdDeviation="2"
							in="shadowOffsetOuter1"
							result="shadowBlurOuter1"
						></feGaussianBlur>
						<feColorMatrix
							values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.5 0"
							type="matrix"
							in="shadowBlurOuter1"
							result="shadowMatrixOuter1"
						></feColorMatrix>
						<feMerge>
							<feMergeNode in="shadowMatrixOuter1"></feMergeNode>
							<feMergeNode in="SourceGraphic"></feMergeNode>
						</feMerge>
					</filter>
					<linearGradient
						x1="15.0782115%"
						y1="94.0751165%"
						x2="15.0782115%"
						y2="6.75708463%"
						id="linearGradient-2"
					>
						<stop stop-color="#000000" stop-opacity="0" offset="0%"></stop>
						<stop stop-color="#000000" offset="100%"></stop>
					</linearGradient>
				</defs>
			</svg>
			<!-- Desktop layout -->
			<div class="tw-hidden landscape:tw-hidden md:tw-block">
				<nav role="navigation tw-block tw-h-full tw-max-h-full">
					<div
						id="steilgut-header-sidebar"
						class="navbar_container__siderbar tw-relative"
					>
						<div class="left-nav tw-relative tw-z-2">
							<div
								class="left-navbar_container__navbar_header__content__list"
							>
								<div
									class="left-navbar_container__navbar_header__content__list__item"
								>
									<drop-down-box
										:menu="dropDownMenuList[0].content"
										:indexMenu="0"
										:isOpen="dropDownMenuList[0].isOpen"
										v-on:click-open="handleDropDownMenuClick"
										v-on:click-close-all="handleDropDownMenuCloseAll"
										v-on:click-on-dropdown-menu-link.stop="
											handleClickOnDropdownMenuLink
										"
									></drop-down-box>
								</div>

								<div
									class="left-navbar_container__navbar_header__content__list__item"
								>
									<drop-down-box
										:menu="dropDownMenuList[2].content"
										:indexMenu="2"
										:isOpen="dropDownMenuList[2].isOpen"
										v-on:click-open="handleDropDownMenuClick"
										v-on:click-close-all="handleDropDownMenuCloseAll"
										v-on:click-on-dropdown-menu-link.stop="
											handleClickOnDropdownMenuLink
										"
									></drop-down-box>
								</div>

								<div
									class="left-navbar_container__navbar_header__content__list__item underline-link"
								>
									<router-link
										:class="[
											'hover:tw-text-masthead-header-gold',
											ifActiveLinkStyleClass('/masthead/wines'),
										]"
										to="/masthead/wines"
										v-on:click.native="handleLinkClick"
										>{{ __("masthead.wines") }}</router-link
									>
									<img
										v-if="isActivePagePath('/masthead/wines')"
										class="underline"
										src="/images/orig/masthead-pg/underline.svg"
										alt="Underline"
									/>
								</div>
							</div>
						</div>
						<p class="logo tw-relative tw-z-2">
							<a href="/">
								<img
									src="/images/logos/logo.png"
									alt="Le Journal"
									class="logo-img tw-object-scale-down"
								/>
							</a>
						</p>
						<div class="right-nav tw-relative tw-z-2">
							<div
								class="right-navbar_container__navbar_header__content__list"
							>
								<div
									class="right-navbar_container__navbar_header__content__list__item underline-link"
								>
									<drop-down-box
										:menu="dropDownMenuList[3].content"
										:indexMenu="3"
										:isOpen="dropDownMenuList[3].isOpen"
										v-on:click-open="handleDropDownMenuClick"
										v-on:click-close-all="handleDropDownMenuCloseAll"
										v-on:click-on-dropdown-menu-link.stop="
											handleClickOnDropdownMenuLink
										"
									></drop-down-box>
								</div>
								<div
									class="right-navbar_container__navbar_header__content__list__item underline-link"
								>
									<router-link
										:class="[
											'hover:tw-text-masthead-header-gold',
											ifActiveLinkStyleClass('/masthead/store'),
										]"
										to="/masthead/store"
										v-on:click.native="handleLinkClick"
										>{{ __("masthead.store") }}</router-link
									>
									<!-- Underline -->
									<img
										v-if="isActivePagePath('/masthead/store')"
										class="underline"
										src="/images/orig/masthead-pg/underline.svg"
										alt="Underline"
									/>
								</div>
								<div
									class="right-navbar_container__navbar_header__content__list__item underline-link"
								>
									<router-link
										:class="[
											'hover:tw-text-masthead-header-gold',
											ifActiveLinkStyleClass('/masthead/contacts'),
										]"
										class="hover:tw-text-masthead-header-gold"
										to="/masthead/contacts"
										v-on:click.native="handleLinkClick"
										>{{ __("masthead.contacts") }}</router-link
									>
									<!-- Underline -->
									<img
										v-if="isActivePagePath('/masthead/contacts')"
										class="underline"
										src="/images/orig/masthead-pg/underline.svg"
										alt="Underline"
									/>
								</div>
							</div>
						</div>
						<!-- <button
							class="tw-absolute tw-z-1 tw-inset-0 tw-h-full tw-w-full focus:tw-outline-none tw-cursor-default"
							:class="bgMenuShadowFilterStyleClass"
						></button> -->
					</div>
				</nav>
			</div>

			<!-- Landscape layout -->
			<div class="tw-hidden landscape:tw-block md:tw-hidden">
				<nav role="navigation" class="block">
					<div
						id="steilgut-header-sidebar"
						class="tw-mt-0 navbar_container__siderbar"
					>
						<p class="logo">
							<a href="/">
								<img
									src="/images/logos/logo-head-mobile.svg"
									alt="Steilgut Logo"
									class="logo-img"
								/>
							</a>
						</p>
						<div class="navbar_container__siderbar__btn_container">
							<button
								type="button"
								class="tw-block tw-z-1 tw-text-white hover:tw-text-gray-500 focus:tw-text-gray-500 focus:tw-outline-none"
							>
								<div v-if="isMobileMenuOpen">
									<div class="basket-cross-icons-container">
										<basket-icon-comp
											class="basket"
											v-on:click-on-basket-icon="
												setIsMobileMenuOpen(false, true)
											"
										></basket-icon-comp>
										<img
											src="/images/orig/header/header-menu-cross-icon.png"
											alt="Open me"
											class="header-menu-cross-icon tw-px-4"
											v-on:click="
												setIsMobileMenuOpen(
													!isMobileMenuOpen,
													false
												)
											"
										/>
									</div>
								</div>
								<div v-if="!isMobileMenuOpen">
									<img
										src="/images/orig/header/header-menu-open-icon.png"
										alt="Close me"
										class="header-menu-open-icon tw-object-scale-down"
										v-on:click="
											setIsMobileMenuOpen(!isMobileMenuOpen, false)
										"
									/>
								</div>
							</button>
						</div>

						<!-- <button
							class="bg-shadow-block focus:tw-outline-none tw-cursor-default"
							v-if="isMobileDevice()"
							:class="bgMenuShadowFilterStyleClass"
						></button> -->
					</div>
					<div
						v-show="isMobileMenuOpen"
						class="navbar_container__navbar_header__content tw-bg-transparent"
					>
						<ul
							class="navbar_container__navbar_header__content__list tw-py-4 tw-px-4"
						>
							<div
								class="navbar_container__navbar_header__content__list__item"
							>
								<!-- about menu -->
								<drop-down-box
									:menu="dropDownMenuList[0].content"
									:indexMenu="0"
									:isOpen="dropDownMenuList[0].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
								></drop-down-box>
							</div>
							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto tw-min-w-full hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<drop-down-box
									:menu="dropDownMenuList[2].content"
									:indexMenu="2"
									:isOpen="dropDownMenuList[2].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
									v-on:click-on-dropdown-menu-link.stop="
										handleClickOnDropdownMenuLink
									"
								></drop-down-box>
							</li>
							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto tw-min-w-full hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<router-link
									class="hover:tw-no-underline tw-px-4"
									:class="[
										'hover:tw-text-masthead-header-gold',
										ifActiveLinkStyleClass('/masthead/wines'),
									]"
									to="/masthead/wines"
								>
									<span class="tw-text-left">
										{{ __("masthead.wines") }}
									</span>
								</router-link>
							</li>

							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto tw-min-w-full hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<drop-down-box
									:menu="dropDownMenuList[3].content"
									:indexMenu="3"
									:isOpen="dropDownMenuList[3].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
									v-on:click-on-dropdown-menu-link.stop="
										handleClickOnDropdownMenuLink
									"
								></drop-down-box>
							</li>

							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto tw-min-w-full hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<router-link
									class="hover:tw-no-underline tw-px-4"
									:class="[
										'hover:tw-text-masthead-header-gold',
										ifActiveLinkStyleClass('/masthead/store'),
									]"
									to="/masthead/store"
								>
									<span class="tw-text-left">
										{{ __("masthead.store") }}
									</span>
								</router-link>
							</li>

							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto tw-min-w-full hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<router-link
									class="hover:tw-no-underline tw-px-4"
									:class="[
										'hover:tw-text-masthead-header-gold',
										ifActiveLinkStyleClass('/masthead/contacts'),
									]"
									to="/masthead/contacts"
								>
									<span class="tw-text-left">
										{{ __("masthead.contacts") }}
									</span>
								</router-link>
							</li>
							<div
								class="navbar_container__navbar_header__content__list__item"
							>
								<!-- legal menu -->
								<drop-down-box
									:menu="dropDownMenuList[1].content"
									:indexMenu="1"
									:isOpen="dropDownMenuList[1].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
								></drop-down-box>
							</div>
						</ul>
						<!-- FOOTER -->
						<footer role="contentinfo">
							<div class="navbar_container__navbar_header__content__footer">
								<nav id="mh-lang-switch">
									<div class="tw-mb-5 tw-inline-flex">
										<lang-switch></lang-switch>
										<div
											class="android-fullscreen-ctrl-btn-container tw-flex tw-mx-4"
											v-if="isMobileAndroidDevice()"
										>
											<i
												class="android-fullscreen-ctrl-btn fas fa-expand tw-my-auto"
											></i>
										</div>
									</div>
								</nav>
								<div
									class="navbar_container__navbar_header__content__footer__social_icons"
								>
									<ul class="social-icons">
										<!-- instagram -->
										<li class="social-link social-link-insta">
											<a href="#">
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
										<!-- vk  -->
										<!-- <li class="social-link social-link-vk">
											<a href="#">
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
										<!-- facebook  -->
										<li class="social-link social-link-facebook">
											<a href="#">
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
											<!-- youtube -->
											<a href="#">
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
						</footer>
					</div>
				</nav>
			</div>

			<!-- Portrait layout -->
			<div class="landscape:tw-hidden tw-block md:tw-hidden">
				<nav role="navigation" class="tw-w-full">
					<div
						id="steilgut-header-sidebar"
						class="tw-mt-0 navbar_container__siderbar"
					>
						<p class="logo">
							<a href="/">
								<img
									src="/images/logos/logo-head-mobile.svg"
									alt="Le Journal"
									class="logo-img"
								/>
							</a>
						</p>
						<div class="navbar_container__siderbar__btn_container">
							<button
								type="button"
								class="tw-block tw-z-1 tw-text-white hover:tw-text-gray-500 focus:tw-text-gray-500 focus:tw-outline-none"
							>
								<div v-if="isMobileMenuOpen">
									<div class="basket-cross-icons-container">
										<basket-icon-comp
											class="basket"
											v-on:click-on-basket-icon="
												setIsMobileMenuOpen(false, true)
											"
										></basket-icon-comp>
										<img
											src="/images/orig/header/header-menu-cross-icon.png"
											alt="Open me"
											class="header-menu-cross-icon tw-px-4 lg-table-portrait:tw-px-0"
											v-on:click="setIsMobileMenuOpen(false, false)"
										/>
									</div>
								</div>
								<div v-if="!isMobileMenuOpen">
									<img
										src="/images/orig/header/header-menu-open-icon.png"
										alt="Close me"
										class="header-menu-open-icon tw-px-4"
										v-on:click="setIsMobileMenuOpen(true, false)"
									/>
								</div>
							</button>
						</div>
						<!-- <button
							class="bg-shadow-block focus:tw-outline-none tw-cursor-default"
							:class="bgMenuShadowFilterStyleClass"
							v-if="isMobileDevice()"
						></button> -->
					</div>
					<div
						v-show="isMobileMenuOpen"
						class="navbar_container__navbar_header__content md:tw-hidden tw-min-w-full tw-bg-transparent transit-flex-box"
					>
						<ul
							class="navbar_container__navbar_header__content__list tw-my-4 tw-px-4 tw-min-w-full"
						>
							<div
								class="navbar_container__navbar_header__content__list__item"
							>
								<!-- about menu -->
								<drop-down-box
									:menu="dropDownMenuList[0].content"
									:indexMenu="0"
									:isOpen="dropDownMenuList[0].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
								></drop-down-box>
							</div>
							<div
								class="navbar_container__navbar_header__content__list__item"
							>
								<!-- Terroir -->
								<drop-down-box
									:menu="dropDownMenuList[2].content"
									:indexMenu="2"
									:isOpen="dropDownMenuList[2].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
								></drop-down-box>
							</div>

							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<router-link
									class="hover:tw-no-underline tw-px-4"
									:class="[
										'hover:tw-text-masthead-header-gold',
										ifActiveLinkStyleClass('/masthead/wines'),
									]"
									to="/masthead/wines"
								>
									<span class="tw-text-left">
										{{ __("masthead.wines") }}
									</span>
								</router-link>
							</li>

							<div
								class="navbar_container__navbar_header__content__list__item"
							>
								<!-- Inspiracy -->
								<drop-down-box
									:menu="dropDownMenuList[3].content"
									:indexMenu="3"
									:isOpen="dropDownMenuList[3].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
								></drop-down-box>
							</div>

							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<router-link
									class="hover:tw-no-underline tw-px-4"
									:class="[
										'hover:tw-text-masthead-header-gold',
										ifActiveLinkStyleClass('/masthead/store'),
									]"
									to="/masthead/store"
								>
									<span class="tw-text-left">
										{{ __("masthead.store") }}
									</span>
								</router-link>
							</li>

							<li
								class="navbar_container__navbar_header__content__list__item tw-text-white tw-no-underline hover:tw-no-underline tw-text-left tw-mx-auto hover:tw-font-bold tw-rounded hover:tw-bg-mt-bg-brown hover:tw-bg-opacity-50"
							>
								<router-link
									class="hover:tw-no-underline tw-px-4"
									:class="[
										'hover:tw-text-masthead-header-gold',
										ifActiveLinkStyleClass('/masthead/contacts'),
									]"
									to="/masthead/contacts"
								>
									<span class="tw-text-left">
										{{ __("masthead.contacts") }}
									</span>
								</router-link>
							</li>

							<div
								class="navbar_container__navbar_header__content__list__item"
							>
								<!-- legal menu -->
								<drop-down-box
									:menu="dropDownMenuList[1].content"
									:indexMenu="1"
									:isOpen="dropDownMenuList[1].isOpen"
									v-on:click-open="handleDropDownMenuClick"
									v-on:click-close-all="handleDropDownMenuCloseAll"
								></drop-down-box>
							</div>
						</ul>
						<!-- FOOTER -->
						<footer role="contentinfo">
							<div class="navbar_container__navbar_header__content__footer">
								<nav id="mh-lang-switch">
									<div class="tw-mb-5 tw-flex tw-justify-center">
										<lang-switch></lang-switch>
										<div
											class="android-fullscreen-ctrl-btn-container tw-flex tw-mx-4"
											v-if="isMobileAndroidDevice()"
										>
											<i
												v-if="isAndroidFullscreenMode()"
												class="android-fullscreen-ctrl-btn fas fa-compress tw-my-auto"
											></i>
											<i
												class="android-fullscreen-ctrl-btn fas fa-expand tw-my-auto"
												v-else
											></i>
										</div>
									</div>
								</nav>
								<div
									class="navbar_container__navbar_header__content__footer__social_icons"
								>
									<ul class="social-icons">
										<!-- instagram -->
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
										<!-- vk  -->
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
										<!-- facebook  -->
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
										<!-- youtube -->
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
						</footer>
					</div>
				</nav>
			</div>
		</header>
	</div>
</template>

<script>
import DropDownBoxComp from "./DropDownBoxComp.vue";
const basketIconComp = () => import("../../app/store/BasketIconComp");
import routeObserver from "../mixins/routeObserver";
import mediaHelper from "../mixins/mediaHelper";
import fullscreenCorrector from "../mixins/fullscreenCorrector";
export default {
	mixins: [routeObserver, mediaHelper],

	components: {
		"drop-down-box": DropDownBoxComp,
		"basket-icon-comp": basketIconComp,
	},

	created: function () {
		if (this.isMobileDevice()) {
			const eventType = this.getOrientationChangeEventName();
			if (eventType === "change") {
				window.screen.orientation.addEventListener(
					eventType,
					this.handleOrientationChangeEvent,
					false
				);
			} else {
				window.addEventListener(
					eventType,
					this.handleOrientationChangeEvent,
					false
				);
			}
		} else {
			window.addEventListener("resize", this.handleResizeEvent, false);
		}
		const currPath = window.location.pathname;
		this.$_calcBgShadowFilterStyleClass(currPath);
	},

	watch: {
		$route() {
			const currPath = this.$route.fullPath;
			this.setIsMobileMenuOpen(false, true);
			this.$_controlBodyBackgroundColor();
			this.$_calcBgShadowFilterStyleClass(currPath);
		},
	},

	mounted() {
		"use strict";
		const helper = this.$root.$data.helper;
		helper.onAndroidFullscreenListenerInit();
	},

	destroyed() {
		"use strict";
		if (this.isMobileDevice()) {
			const eventType = this.getOrientationChangeEventName();
			if (eventType === "change") {
				window.screen.orientation.removeEventListener(
					eventType,
					this.handleOrientationChangeEvent
				);
			} else {
				window.removeEventListener(eventType, this.handleOrientationChangeEvent);
			}
		} else {
			window.removeEventListener("resize", this.handleResizeEvent);
		}
	},

	data: function () {
		return {
			isMobileMenuOpen: this.getIfMobileMenuOpen(),

			bgMenuShadowFilterStyleClass: "dark-bg-menu-shadow-filter",

			// Menu state
			activeDropdownMenuIndex: -1,

			dropDownMenuList: [
				{
					isOpen: false,
					content: {
						header: this.__("masthead.about"),
						linkArray: [
							{
								linkTitle: this.__("masthead.aboutMenu.news"),
								linkUrl: "/masthead/news",
							},

							{
								linkTitle: this.__("masthead.aboutMenu.history"),
								linkUrl: "/masthead/steilgutHistorySlider",
							},

							{
								linkTitle: this.__("masthead.aboutMenu.philipAndIrina"),
								linkUrl: "/masthead/philipAndIrina",
							},

							/* In 3d VERSION */
							// {
							//     linkTitle: this.__("masthead.aboutMenu.steilclub"),
							//     linkUrl: "/masthead/steilgutClub",
							// },

							/* In 3d VERSION */
							// {
							//     linkTitle: this.__("masthead.aboutMenu.harvest"),
							//     linkUrl: "#",
							// },
						],
					},
				},
				{
					isOpen: false,
					content: {
						header: this.__("masthead.legalHeader"),
						linkArray: [
							{
								linkTitle: this.__("masthead.legal.impressum"),
								linkUrl: "/masthead/legal/impressum",
							},

							{
								linkTitle: this.__("masthead.legal.datenschutz"),
								linkUrl: "/masthead/legal/datenschutz",
							},

							{
								linkTitle: this.__("masthead.legal.agbs"),
								linkUrl: "/masthead/legal/agbs",
							},

							{
								linkTitle: this.__("masthead.legal.widerruf"),
								linkUrl: "/masthead/legal/widerruf",
							},

							{
								linkTitle: this.__("masthead.legal.versand"),
								linkUrl: "/masthead/legal/versand",
							},

							{
								linkTitle: this.__("masthead.legal.zahlungsarten"),
								linkUrl: "/masthead/legal/zahlungsarten",
							},
						],
					},
				},
				{
					isOpen: false,
					content: {
						header: this.__("terroir.terroirHeader"),
						linkArray: [
							{
								linkTitle: this.__("terroir.terroirMenu.bremmerCalmont"),
								linkUrl: "/masthead/terroir/calmont",
							},
							{
								linkTitle: this.__(
									"terroir.terroirMenu.neeferFrauenberg"
								),
								linkUrl: "/masthead/terroir/frauenbergNeefer",
							},
							{
								linkTitle: this.__("terroir.terroirMenu.dasProject"),
								linkUrl: "/masthead/terroir/naslei",
							},
						],
					},
				},

				{
					isOpen: false,
					content: {
						header: this.__("philosophy.philosophyHeader"),
						linkArray: [
							{
								linkTitle: this.__("philosophy.philosophyMenu.inspiracy"),
								linkUrl: "/masthead/inspiration",
							},
							{
								linkTitle: this.__(
									"philosophy.philosophyMenu.biodiversity"
								),
								linkUrl: "/masthead/philosophy/biodiversity",
							},
							{
								linkTitle: this.__(
									"philosophy.philosophyMenu.handwork100"
								),
								linkUrl: "/masthead/philosophy/handwork100",
							},
							/* In 3d VERSION */
							// {
							//     linkTitle: this.__(
							//         "philosophy.philosophyMenu.vinification"
							//     ),
							//     linkUrl: "#",
							// },
						],
					},
				},
			],
		};
	},

	methods: {
		getIfMobileMenuOpen: function () {
			return this.$root.$data.stateStore.isMobileMenuOpen;
		},

		setIsMobileMenuOpen: function (
			isMobileMenuOpen,
			isRouteChanged,
			isOrientationChanged
		) {
			this.$root.$data.stateStore.isMobileMenuOpen = isMobileMenuOpen;
			this.isMobileMenuOpen = isMobileMenuOpen;
			this.$emit(
				"switch-mobile-menu",
				event,
				this.getIfMobileMenuOpen(),
				isRouteChanged,
				isOrientationChanged
			);
			this.$_controlBodyBackgroundColor();
		},

		handleDropDownMenuClick: function (event, menuIndex) {
			for (let i = 0; i < this.dropDownMenuList.length; i++) {
				if (i !== menuIndex) {
					this.dropDownMenuList[i].isOpen = false;
				} else {
					this.dropDownMenuList[i].isOpen = !this.dropDownMenuList[i].isOpen;
				}
			}
			this.activeDropdownMenuIndex = menuIndex;
		},

		handleLinkClick: function (event) {
			this.handleDropDownMenuCloseAll();
		},

		ifActiveLinkStyleClass: function (linkPath) {
			const isStoreLink = linkPath === "/masthead/store";
			if (isStoreLink && this.ifOrderRelatedActiveLink()) {
				return "tw-text-masthead-header-gold";
			}
			return this.isActivePagePath(linkPath) && !this.ifOrderRelatedActiveLink()
				? "tw-text-masthead-header-gold"
				: "";
		},

		ifOrderRelatedActiveLink: function () {
			return (
				this.isActivePathMatch("/masthead/order/.*") ||
				this.isActivePathMatch("/masthead/order-finallization") ||
				this.isActivePathMatch("/masthead/wines-cart")
			);
		},

		handleDropDownMenuCloseAll: function (event) {
			this.dropDownMenuList.forEach((item) => {
				item.isOpen = false;
				item.isActive = false;
			});
		},

		handleClickOnDropdownMenuLink: function (event) {
			this.dropDownMenuList.forEach((item) => {
				item.isOpen = false;
			});
			this.setIsMobileMenuOpen(false, true);
		},

		handleOrientationChangeEvent: function (event) {
			if (this.isOrientationChanged()) {
				this.dropDownMenuList.forEach((item) => (item.isOpen = false));
				this.setIsMobileMenuOpen(false, false, true);
			}
		},

		handleResizeEvent: function (event) {
			this.setIsMobileMenuOpen(false, false, false);
			this.handleDropDownMenuCloseAll();
		},

		$_calcBgShadowFilterStyleClass: function (currPath) {
			const storeRegExp = /\/masthead\/store.*/;
			const isLightShadowMode = storeRegExp.test(currPath);
			if (isLightShadowMode) {
				this.bgMenuShadowFilterStyleClass = "light-bg-menu-shadow-filter";
			} else {
				this.bgMenuShadowFilterStyleClass = "dark-bg-menu-shadow-filter";
			}
		},

		$_controlBodyBackgroundColor: function () {
			if (this.getIfMobileMenuOpen()) {
				if (this.ifLightBackgroundPage()) {
					this.$root.helper.removeStyleClassFromBody("light-bg");
				}
			} else {
				if (this.ifLightBackgroundPage()) {
					this.$root.helper.addStyleClassToBody("light-bg");
				} else {
					this.$root.helper.removeStyleClassFromBody("light-bg");
				}
			}
		},
	},
};
</script>

<style scoped lang="scss">
@import "@/sass/_components.scss";

@mixin lg-tablet-cross-open-icon {
	min-height: calc(42px + 1.2vh);
	max-height: calc(42px + 1.2vh);
}

@mixin phone-cross-open-icon {
	min-height: calc(24px + 0.5vh);
	max-height: calc(24px + 0.5vh);
}

.navbar_container__navbar_header {
	min-width: 100%;
}

.navbar_container__siderbar {
	display: block;
	font-family: "steilgut_cormorant", sans-serif;
	// font-weight: 300;
	// font-size: calc(1em + 0.8vw);
	text-decoration: none;
	color: #fff;
}

/* Mobile version  */
.navbar_container__navbar_header__content
	.navbar_container__navbar_header__content__list {
	font-family: "steilgut_cormorant", sans-serif;
	font-size: 1.25rem;
	text-decoration: none;
	color: #fff;
}

.navbar_container__navbar_header a {
	text-decoration: none;
}

.navbar_container__navbar_header a:hover {
	text-decoration: none;
}

.logo {
	max-width: 149px;
	a {
		position: relative;
		padding-top: 107%;
		display: block;
		img {
			display: block;
			position: absolute;
			top: 0;
			margin: 0 auto;
			height: 100%;
			width: 100%;
		}
	}
}

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/
/* All mobile devices */
@media only screen and (min-width: 320px) {
	.navbar_container__siderbar {
		display: flex;
		justify-content: space-between;
	}

	.navbar_container__siderbar__btn_container {
		display: flex;
		justify-content: center;
	}

	.navbar_container__navbar_header__content__footer__social_icons {
		display: flex;
		justify-content: center;
	}

	.navbar_container__navbar_header__content
		ul.navbar_container__navbar_header__content__list {
		display: flex;
		flex: 1 0 auto;
		width: 100%;
		max-width: 100%;
		min-height: 49vh;
		height: auto;
		flex-direction: column;
		justify-content: space-evenly;
		align-items: center;
	}

	.navbar_container__navbar_header__content__list__item {
		min-height: 7vh;
		justify-content: center;
		margin: 1vh auto;
	}

	.navbar_container__navbar_header__content__list__item a span {
		font-weight: 300;
		font-size: calc(1rem + 0.8vh);
	}

	.navbar_container__navbar_header__content__footer {
		display: flex;
		flex-direction: column;
		margin-top: 2vh;
	}

	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.navbar_container__navbar_header__content__list__item a span {
				font-weight: 300;
				font-size: min(max(calc(1rem + 0.8vh), 24px), 26px);
			}
		}
	}
}

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.navbar_container__navbar_header__content {
		position: relative;
		z-index: 3;
	}

	.navbar_container__siderbar__btn_container,
	p.logo {
		position: relative;
		z-index: 6;
	}

	.navbar_container__navbar_header__content__list__item {
		width: 90%;
	}

	.navbar_container__navbar_header__content__list__item a span {
		font-weight: 300;
	}

	/*  
     * Use z-index = 4 because Menu button has z-index = 5
    */
	.bg-shadow-block {
		min-height: 15vh;
		width: 100vw;
		max-width: 100vw;

		top: 0;
		left: 0;
		position: absolute;

		z-index: 2;
	}

	.basket-cross-icons-container {
		display: flex;
		flex-direction: row;
		align-items: stretch;
		justify-items: center;
	}

	.header-menu-open-icon,
	.header-menu-cross-icon {
		@include phone-cross-open-icon;
	}

	.header-menu-cross-icon {
		margin: auto 0;
	}

	p.logo {
		max-width: 94px;
		width: 94px;
		margin-left: 21px;
	}

	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.bg-shadow-block {
				min-height: calc(var(--100vh, 1vh) * 15);
			}
			p.logo {
				max-width: 94px;
				width: max(26vw, 94px);
				margin-left: 21px;
			}
		}
	}
}

@media only screen and (min-width: 1025px) and (orientation: portrait) {
	.navbar_container__navbar_header__content {
		position: relative;
		z-index: 3;

		width: 100vw;
		max-width: 100vw;
		transition: all 0.5s ease-in-out;
		min-height: 80vh;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: center;
	}

	.navbar_container__siderbar__btn_container {
		margin: auto 0 auto auto;
	}

	.basket-cross-icons-container {
		display: flex;
		margin-right: 2vw;
	}

	.basket-cross-icons-container .basket {
		margin-right: 2vw;
	}

	.navbar_container__navbar_header__content__list__item {
		min-height: unset;
	}

	footer .navbar_container__navbar_header__content__footer {
		background: transparent;
		margin: 0 auto 0 auto;
		min-width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: center;
	}

	footer .navbar_container__navbar_header__content__footer .lang-pan {
		margin: 0 auto 0 auto;
	}

	footer
		.navbar_container__navbar_header__content__footer
		div.navbar_container__navbar_header__content__footer__social_icons {
		display: flex;
		margin: 0 auto 1rem auto;
	}
	/* Logo
		-------*/
	.navbar_container__siderbar {
		min-width: 100%;
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		flex-wrap: nowrap;
		padding: 0 0 0 0;
	}

	p.logo .logo-img {
		/* center the logo */
		margin: 0 auto 0 0;
	}

	.navbar_container__navbar_header__content__list__item {
		width: 80%;
		margin-bottom: 4vh;
	}

	.header-menu-open-icon,
	.header-menu-cross-icon {
		@include lg-tablet-cross-open-icon;
	}

	.dark-bg-menu-shadow-filter {
		background-image: url("/images/orig/header/shadows/mobile/portrait/menu-shadow.svg");
		background-size: 100%;
		opacity: 0.9;
	}

	.light-bg-menu-shadow-filter {
		background-image: url("/images/orig/header/shadows/mobile/portrait/light-menu-shadow.svg");
		background-size: 100%;
		opacity: 0.9;
	}

	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
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
	/* @media only screen and (min-width: 320px) and (max-device-height: 896px) and (min-aspect-ratio: 13/9) { */
	.navbar_container__navbar_header__content {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		align-items: center;
		margin: 0 auto 0 auto;

		min-height: 90vh;
		width: 80vw;
		max-width: 80vw;
		/* width: calc(var(--100vw, 1vw) * 80);
        max-width: calc(var(--100vw, 1vw) * 80); */

		transition: all 0.5s ease-in-out;
	}

	p.logo .logo-img {
		margin: 0 auto 0 0;
	}

	.navbar_container__siderbar__btn_container {
		margin: 2% 2% auto auto;
	}

	footer .navbar_container__navbar_header__content__footer {
		background: transparent;
		margin: 0 auto 0 auto;
		min-width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: center;
	}

	footer .navbar_container__navbar_header__content__footer .lang-pan {
		margin: 0 auto 0 auto;
	}

	/* Logo
		-------*/
	.navbar_container__siderbar {
		min-width: 100%;
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		flex-wrap: nowrap;
		padding: 0 0 0 0;
	}

	.navbar_container__navbar_header__content {
	}

	.navbar_container__navbar_header__content {
		z-index: 10;
	}

	.navbar_container__navbar_header__content__list__item {
		min-width: 100%;
	}

	.navbar_container__navbar_header__content__list__item {
		margin-bottom: 3vw;
	}

	.navbar_container__navbar_header__content__list__item a span {
		font-family: "steilgut_cormorant";
		font-weight: 300;
		font-size: min(max(calc(1rem + 0.8vw), 24px), 26px);
	}

	.header-menu-open-icon {
		height: 3vw;
	}

	.header-menu-cross-icon {
		height: 24px;
	}

	.dark-bg-menu-shadow-filter {
		background-image: url("/images/mobile/single-wine/landscape/menu-shadow-002.svg");
		background-size: 100%;
		opacity: 0.9;
	}

	.light-bg-menu-shadow-filter {
		background-image: url("/images/orig/header/shadows/mobile/portrait/light-menu-shadow.svg");
		background-size: 100%;
		opacity: 0.9;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	p.logo {
		width: 74px;
		// height: 81px;
	}
}

/* Desktops, large screens, retina and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.navbar_container__siderbar {
		max-width: 100%;
		width: 100%;

		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		flex-wrap: nowrap;
		padding: 0 0 0 0;
		margin: 0 0 auto 0;
	}

	.navbar_container__siderbar {
		font-size: calc(0.7em + 0.665vw);
		font-size: calc(0.7em + var(--100nvw, 1vw) * 0.665);
	}

	.left-nav,
	.right-nav {
		display: flex;
		justify-content: center;
		align-content: center;
		min-width: 40%;
	}

	.left-nav {
		margin: 1.5em 0.5em auto 1.5em;
	}

	.left-navbar_container__navbar_header__content__list {
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	.left-navbar_container__navbar_header__content__list
		.left-navbar_container__navbar_header__content__list__item {
		margin-right: 1.7em;
	}

	.left-navbar_container__navbar_header__content__list
		.left-navbar_container__navbar_header__content__list__item:last-child {
		margin-right: auto;
	}

	.logo {
		width: 10.35%;
		max-width: 149px;
		max-height: unset;

		a {
			position: relative;
			padding-top: 93%;
			display: block;
			img {
				top: 0;
				position: absolute;
			}
		}
	}

	.right-nav {
		margin: 1.5em 1.5em auto 0.5em;
	}

	.right-navbar_container__navbar_header__content__list {
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	.right-navbar_container__navbar_header__content__list
		.right-navbar_container__navbar_header__content__list__item {
		margin-right: 1.85em;
	}

	.right-nav
		.right-navbar_container__navbar_header__content__list
		.right-navbar_container__navbar_header__content__list__item:last-child {
		margin-right: 0;
	}

	.right-nav
		.right-navbar_container__navbar_header__content__list
		.right-navbar_container__navbar_header__content__list__item:first-child {
		margin-left: 0;
	}

	.navbar_container__siderbar div.logo {
		margin: 0 auto 0 auto;
		background-color: transparent;
	}

	.dark-bg-menu-shadow-filter {
		background-image: url("/images/orig/header/shadows/desktop/menu-shadow.svg");
		background-size: 100%;
		opacity: 0.9;
	}

	.light-bg-menu-shadow-filter {
		background-image: linear-gradient(0deg, rgba(0, 0, 0, 0) -2%, #000000 85%);
		background-size: 100%;
		opacity: 0.6;
	}

	.underline-link {
		position: relative;
	}

	.underline {
		position: absolute;
		left: 50%;
		transform: translate(-50%, -50%);
		min-width: min(93px, 5vw);
		min-width: min(93px, calc(var(--100nvw, 1vw) * 5));
		padding-top: 24px;
		width: 100%;
	}
}

@media only screen and (min-width: 1025px) and (max-height: 1080px) and (orientation: landscape) {
	.logo {
		a {
			padding-top: 88%;
		}
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	@media (max-height: 960px) {
		.logo {
			width: 116px;
		}
	}

	@media (max-height: 800px) {
		.logo {
			width: 104px;
		}
	}

	@media (max-height: 600px) {
		.logo {
			width: 86px;
		}
	}
}
</style>
