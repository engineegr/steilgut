<template>
	<div
		class="wines-slider transit-flex-box portrait-fp landscape-fp is-content-height-minimum"
	>
		<div class="tw-flex tw-fex-grow-0" v-if="!isOpen">
			<div
				class="md:tw-flex md:tw-flex-grow md:tw-min-w-screen tw-hidden landscape:tw-hidden"
			>
				<!-- Desktop: Left -->
				<lazy-load-image-comp
					basedLazyImgStyleClass="desktop-left-bg-wines-pg-img"
					relativePath="wines-pg"
					baseName="bg-left-wines-pg"
					lqipPath_4_3="/images/4_3/wines-pg/lqip_4_3/4_3-lqip-bw-left-bg-wines-pg.png"
					lqipPath_16_9="/images/16_9/wines-pg/lqip_16_9/16_9-lqip-bw-left-bg-wines-pg.png"
					lazyLoadCommonImgStyleClass="tw-absolute tw-top-0 tw-bottom-0 tw-left-0 tw-object-fill tw-max-h-full tw-h-full"
					transitionImgStyleClass_4_3="fade-filter-img"
					transitionImgStyleClass_16_9="fade-filter-img"
					lqipStyleClass_4_3="lqip-left-bg-wines-4_3-img"
					lqipStyleClass_16_9="lqip-left-bg-wines-16_9-img"
					lazyLoadImgStyleClass_4_3="left-bg-wines-4_3-img"
					lazyLoadImgStyleClass_16_9="left-bg-wines-16_9-img"
					:lazyLoadImgStyleClassCallBack_4_3="
						calcExtendedLeftBgImageStyleClassFunc
					"
					:lazyLoadImgStyleClassCallBack_16_9="
						calcExtendedLeftBgImageStyleClassFunc
					"
					widthCoeff_4_3="0.51"
					widthCoeff_16_9="0.51"
					isHiddenPortrait="true"
					isHiddenLandscape="true"
					:isBackgroundShadow="false"
					:isLandscapeBackgroundShadow="false"
					:isPortraitBackgroundShadow="false"
				></lazy-load-image-comp>

				<!-- Desktop: Right -->
				<lazy-load-image-comp
					basedLazyImgStyleClass="desktop-right-bg-wines-pg-img"
					relativePath="wines-pg"
					baseName="bg-right-wines-pg"
					lqipPath_4_3="/images/4_3/wines-pg/lqip_4_3/4_3-lqip-bw-right-bg-wines-pg.png"
					lqipPath_16_9="/images/16_9/wines-pg/lqip_16_9/16_9-lqip-bw-right-bg-wines-pg.png"
					lazyLoadCommonImgStyleClass="tw-absolute tw-top-0 tw-bottom-0 tw-right-0 tw-object-fill tw-max-h-full tw-h-full"
					transitionImgStyleClass_4_3="fade-filter-img"
					transitionImgStyleClass_16_9="fade-filter-img"
					lqipStyleClass_4_3="lqip-right-bg-wines-4_3-img"
					lqipStyleClass_16_9="lqip-right-bg-wines-16_9-img"
					lazyLoadImgStyleClass_4_3="right-bg-wines-4_3-img"
					lazyLoadImgStyleClass_16_9="right-bg-wines-16_9-img"
					imgExt_4_3="png"
					imgExt_16_9="png"
					:lazyLoadImgStyleClassCallBack_4_3="
						calcExtendedRightBgImageStyleClassFunc
					"
					:lazyLoadImgStyleClassCallBack_16_9="
						calcExtendedRightBgImageStyleClassFunc
					"
					widthCoeff_4_3="0.57153"
					widthCoeff_16_9="0.555729"
					isHiddenPortrait="true"
					isHiddenLandscape="true"
					:isBackgroundShadow="false"
					:isLandscapeBackgroundShadow="false"
					:isPortraitBackgroundShadow="false"
				></lazy-load-image-comp>
				<background-shadow-comp zIndexClass="tw-z-1"> </background-shadow-comp>
			</div>
			<div class="tw-flex tw-flex-grow-0 md:tw-hidden">
				<div class="tw-flex tw-flex-grow-0 landscape:tw-hidden">
					<!-- Portrait: Up image -->
					<lazy-load-image-comp
						basedLazyImgStyleClass="portrait-left-bg-wines-pg-img"
						basedPortraitLazyImgStyleClass="portrait-lazy-img"
						relativePath="wines-pg"
						baseName="bg-wine-item-up"
						lqipPath_portrait="/images/mobile/wines-pg/lqip/portrait-lqip-wine-item-up.jpg"
						lazyLoadCommonImgStyleClass=""
						lazyLoadImgStyleClass_portrait="wine-item-up-bg-image tw-object-fill"
						lqipStyleClass_portrait="wine-item-up-bg-image tw-object-fill"
						transitionImgStyleClass_portrait="fade-filter-img"
						:lazyLoadImgStyleClassCallBack_portrait="
							calcExtendedLeftBgImageStyleClassFunc
						"
						isHiddenDesktop="true"
						isHiddenLandscape="true"
					></lazy-load-image-comp>
					<!-- Portrait: Down image -->
					<lazy-load-image-comp
						basedLazyImgStyleClass="portrait-right-bg-wines-pg-img"
						basedPortraitLazyImgStyleClass="portrait-lazy-img"
						relativePath="wines-pg"
						baseName="bg-wine-item-down"
						imgExt_portrait="png"
						lqipPath_portrait="/images/mobile/wines-pg/lqip/portrait-lqip-wine-item-down.png"
						lazyLoadCommonImgStyleClass=""
						lazyLoadImgStyleClass_portrait="wine-item-down-bg-image tw-object-fill"
						lqipStyleClass_portrait="wine-item-down-bg-image tw-object-fill"
						transitionImgStyleClass_portrait="fade-filter-img"
						:lazyLoadImgStyleClassCallBack_portrait="
							calcExtendedRightBgImageStyleClassFunc
						"
						isHiddenDesktop="true"
						isHiddenLandscape="true"
						:isBackgroundShadow="false"
						:isLandscapeBackgroundShadow="false"
						:isPortraitBackgroundShadow="false"
					></lazy-load-image-comp>
				</div>
				<div class="tw-hidden landscape:tw-flex landscape:tw-flex-grow-0">
					<!-- Left -->
					<lazy-load-image-comp
						basedLazyImgStyleClass="landscape-left-bg-wines-pg-img"
						basedLandscapeLazyImgStyleClass="landscape-lazy-img"
						relativePath="wines-pg"
						baseName="bg-left-wines-pg"
						lqipPath_4_3="/images/4_3/wines-pg/lqip_4_3/4_3-lqip-bw-left-bg-wines-pg.png"
						lqipPath_16_9="/images/16_9/wines-pg/lqip_16_9/16_9-lqip-bw-left-bg-wines-pg.png"
						lazyLoadCommonImgStyleClass="tw-absolute tw-top-0 tw-bottom-0 tw-left-0 tw-object-fill tw-max-h-full tw-h-full desktop-img-ar-balanced"
						transitionImgStyleClass_4_3="fade-filter-img"
						transitionImgStyleClass_16_9="fade-filter-img"
						lqipStyleClass_4_3="lqip-left-bg-wines-4_3-img"
						lqipStyleClass_16_9="lqip-left-bg-wines-16_9-img"
						lazyLoadImgStyleClass_4_3="left-bg-wines-4_3-img"
						lazyLoadImgStyleClass_16_9="left-bg-wines-16_9-img"
						:lazyLoadImgStyleClassCallBack_4_3="
							calcExtendedLeftBgImageStyleClassFunc
						"
						:lazyLoadImgStyleClassCallBack_16_9="
							calcExtendedLeftBgImageStyleClassFunc
						"
						widthCoeff_4_3="0.51"
						widthCoeff_16_9="0.51"
						isHiddenDesktop="true"
						isHiddenPortrait="true"
						:isBackgroundShadow="false"
						:isLandscapeBackgroundShadow="false"
						:isPortraitBackgroundShadow="false"
					></lazy-load-image-comp>
					<!-- Right -->
					<lazy-load-image-comp
						basedLazyImgStyleClass="landscape-right-bg-wines-pg-img"
						basedLandscapeLazyImgStyleClass="landscape-lazy-img"
						relativePath="wines-pg"
						baseName="bg-right-wines-pg"
						lqipPath_4_3="/images/4_3/wines-pg/lqip_4_3/4_3-lqip-bw-right-bg-wines-pg.png"
						lqipPath_16_9="/images/16_9/wines-pg/lqip_16_9/16_9-lqip-bw-right-bg-wines-pg.png"
						lazyLoadCommonImgStyleClass="tw-absolute tw-top-0 tw-bottom-0 tw-right-0 tw-object-fill tw-max-h-full tw-h-full desktop-img-ar-balanced"
						transitionImgStyleClass_4_3="fade-filter-img"
						transitionImgStyleClass_16_9="fade-filter-img"
						lqipStyleClass_4_3="lqip-right-bg-wines-4_3-img"
						lqipStyleClass_16_9="lqip-right-bg-wines-16_9-img"
						lazyLoadImgStyleClass_4_3="right-bg-wines-4_3-img"
						lazyLoadImgStyleClass_16_9="right-bg-wines-16_9-img"
						imgExt_4_3="png"
						imgExt_16_9="png"
						:lazyLoadImgStyleClassCallBack_4_3="
							calcExtendedRightBgImageStyleClassFunc
						"
						:lazyLoadImgStyleClassCallBack_16_9="
							calcExtendedRightBgImageStyleClassFunc
						"
						widthCoeff_4_3="0.57153"
						widthCoeff_16_9="0.555729"
						isHiddenDesktop="true"
						isHiddenPortrait="true"
						:isBackgroundShadow="false"
						:isLandscapeBackgroundShadow="false"
						:isPortraitBackgroundShadow="false"
					></lazy-load-image-comp>
					<background-shadow-comp zIndexClass="tw-z-1">
					</background-shadow-comp>
				</div>
			</div>
		</div>
		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div v-else-if="isLoading" class="tw-block">
			<pulse-logo-comp isDefer="true" isDark="true"></pulse-logo-comp>
		</div>
		<!--  -->
		<div
			v-if="!isError"
			class="tw-w-full tw-max-w-full md:tw-max-h-full md:tw-h-full transit-flex-box"
		>
			<!-- SVG declarations -->
			<div>
				<svg width="0" height="0" xmlns="http://www.w3.org/2000/svg">
					<defs>
						<!-- Left arrow -->
						<filter
							id="arrow-wine-l-a"
							width="132.5%"
							height="137.8%"
							x="-16.2%"
							y="-18.3%"
							filterUnits="objectBoundingBox"
						>
							<feOffset
								dy="1"
								in="SourceAlpha"
								result="shadowOffsetOuter1"
							/>
							<feGaussianBlur
								in="shadowOffsetOuter1"
								result="shadowBlurOuter1"
								stdDeviation="1"
							/>
							<feColorMatrix
								in="shadowBlurOuter1"
								result="shadowMatrixOuter1"
								values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.5 0"
							/>
							<feMerge>
								<feMergeNode in="shadowMatrixOuter1" />
								<feMergeNode in="SourceGraphic" />
							</feMerge>
						</filter>

						<!-- Right arrow -->
						<filter
							id="arrow-wine-r-a"
							width="132.5%"
							height="137.8%"
							x="-16.2%"
							y="-18.3%"
							filterUnits="objectBoundingBox"
						>
							<feOffset
								dy="1"
								in="SourceAlpha"
								result="shadowOffsetOuter1"
							/>
							<feGaussianBlur
								in="shadowOffsetOuter1"
								result="shadowBlurOuter1"
								stdDeviation="1"
							/>
							<feColorMatrix
								in="shadowBlurOuter1"
								result="shadowMatrixOuter1"
								values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.5 0"
							/>
							<feMerge>
								<feMergeNode in="shadowMatrixOuter1" />
								<feMergeNode in="SourceGraphic" />
							</feMerge>
						</filter>
					</defs>
				</svg>
			</div>

			<!-- All custome style classes are placed into app.scss -->
			<slider
				:calcCountRequestExpression="calcCountRequestExpression"
				:calcRangeDataRequestExpression="calcRangeDataRequestExpression"
				itemBackgroundHidden="true"
				isInitialState="true"
				:mobileViewHidden="false"
				mdItemBlockStyleClass="md:tw-flex md-wine-items-block"
				itemBlockStyleClass="wine-items-block"
				landscapeItemBlockStyleClass="ls-wine-items-block landscape:tw-block"
				ref="slotProps"
			>
				<!-- Desktop layout -->
				<template v-slot:mdItemListView="slotProps">
					<div v-if="getSliderControlFrom > 0">
						<div
							class="left-grape-arrow-container tw-cursor-pointer"
							v-if="!isOpen"
						>
							<a
								class="left-grape-arrow"
								v-on:click="
									handleDecreaseHarvest(
										$event,
										slotProps.handleDecreaseListCallback,
										false
									)
								"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="40"
									height="43"
									viewBox="0 0 40 43"
								>
									<g
										fill="#EBCB9A"
										fill-rule="evenodd"
										filter="url(#arrow-wine-l-a)"
										transform="rotate(90 18.5 19.278)"
									>
										<path
											d="M19.6426907 22.6941467C16.2846046 22.6941467 13.5528973 25.425854 13.5528973 28.7839401 13.5528973 32.1420261 16.2846046 34.8737335 19.6426907 34.8737335 23.0007768 34.8737335 25.7324841 32.1420261 25.7324841 28.7839401 25.7324841 25.425854 23.0007768 22.6941467 19.6426907 22.6941467M19.6426907 35.3708594C16.0106882 35.3708594 13.0557713 32.4159426 13.0557713 28.7839401 13.0557713 25.1519376 16.0106882 22.1970207 19.6426907 22.1970207 23.2746932 22.1970207 26.2296101 25.1519376 26.2296101 28.7839401 26.2296101 32.4159426 23.2746932 35.3708594 19.6426907 35.3708594M19.6426907.572040115C16.2846046.572040115 13.5528973 3.303996 13.5528973 6.6618335 13.5528973 10.019671 16.2846046 12.7516269 19.6426907 12.7516269 23.0007768 12.7516269 25.7324841 10.019671 25.7324841 6.6618335 25.7324841 3.303996 23.0007768.572040115 19.6426907.572040115M19.6426907 13.2487529C16.0106882 13.2487529 13.0557713 10.293836 13.0557713 6.6618335 13.0557713 3.02983101 16.0106882.0749141249 19.6426907.0749141249 23.2746932.0749141249 26.2296101 3.02983101 26.2296101 6.6618335 26.2296101 10.293836 23.2746932 13.2487529 19.6426907 13.2487529"
										/>
										<path
											d="M32.5679664.572040115C29.2098804.572040115 26.4781731 3.303996 26.4781731 6.6618335 26.4781731 10.019671 29.2098804 12.7516269 32.5679664 12.7516269 35.9260525 12.7516269 38.6577598 10.019671 38.6577598 6.6618335 38.6577598 3.303996 35.9260525.572040115 32.5679664.572040115M32.5679664 13.2487529C28.935964 13.2487529 25.9810471 10.293836 25.9810471 6.6618335 25.9810471 3.02983101 28.935964.0749141249 32.5679664.0749141249 36.1999689.0749141249 39.1548858 3.02983101 39.1548858 6.6618335 39.1548858 10.293836 36.1999689 13.2487529 32.5679664 13.2487529M6.71741494.572040115C3.35932888.572040115.627621563 3.303996.627621563 6.6618335.627621563 10.019671 3.35932888 12.7516269 6.71741494 12.7516269 10.075501 12.7516269 12.8072083 10.019671 12.8072083 6.6618335 12.8072083 3.303996 10.075501.572040115 6.71741494.572040115M6.71741494 13.2487529C3.08541246 13.2487529.130495572 10.293836.130495572 6.6618335.130495572 3.02983101 3.08541246.0749141249 6.71741494.0749141249 10.3494174.0749141249 13.3043343 3.02983101 13.3043343 6.6618335 13.3043343 10.293836 10.3494174 13.2487529 6.71741494 13.2487529"
										/>
										<path
											d="M26.1053286,11.7573749 C22.7472425,11.7573749 20.0155352,14.4893308 20.0155352,17.8471683 C20.0155352,21.2052543 22.7472425,23.9369617 26.1053286,23.9369617 C29.4634146,23.9369617 32.195122,21.2052543 32.195122,17.8471683 C32.195122,14.4893308 29.4634146,11.7573749 26.1053286,11.7573749 M26.1053286,24.4340877 C22.4733261,24.4340877 19.5184092,21.4791708 19.5184092,17.8471683 C19.5184092,14.2151658 22.4733261,11.2602489 26.1053286,11.2602489 C29.7373311,11.2602489 32.6922479,14.2151658 32.6922479,17.8471683 C32.6922479,21.4791708 29.7373311,24.4340877 26.1053286,24.4340877"
										/>
										<path
											d="M13.1800528,11.7573749 C9.82196675,11.7573749 7.09025944,14.4893308 7.09025944,17.8471683 C7.09025944,21.2052543 9.82196675,23.9369617 13.1800528,23.9369617 C16.5381389,23.9369617 19.2698462,21.2052543 19.2698462,17.8471683 C19.2698462,14.4893308 16.5381389,11.7573749 13.1800528,11.7573749 M13.1800528,24.4340877 C9.54805033,24.4340877 6.59313345,21.4791708 6.59313345,17.8471683 C6.59313345,14.2151658 9.54805033,11.2602489 13.1800528,11.2602489 C16.8120553,11.2602489 19.7669722,14.2151658 19.7669722,17.8471683 C19.7669722,21.4791708 16.8120553,24.4340877 13.1800528,24.4340877"
										/>
									</g>
								</svg>
							</a>
						</div>
					</div>
					<div id="wine-items-id" :class="[calcWineItemListStyleClass]">
						<div
							v-for="i in slotProps.itemQuantityPerPage"
							:key="`${slotProps.from + i - 1}_sliderItem`"
							:class="[
								{
									'tw-w-1/2 tw-max-w-1/2 tw-mt-auto tw-mb-auto': !isOpen,
								},
								calcPositionStyleClass(i - 1),
								{
									'tw-flex tw-w-full tw-max-w-full md:tw-h-full': isOpen,
								},
							]"
						>
							<div
								v-if="!isOpen"
								class="tw-relative tw-z-1 tw-w-full tw-max-w-full"
								v-on:mouseover.stop="handleMouseOver($event, i)"
								v-on:mouseleave.stop="handleMouseLeave($event, i)"
							>
								<wine-item-header
									v-show="getSliderItemDataByKey({ i })"
									:itemData="getSliderItemDataByKey({ i })"
									:itemKey="`${
										slotProps.from + i - 1
									}_sliderItemHeader`"
									:isOdd="i % 2 !== 0"
									:mobileViewHidden="false"
									:isOpen="isOpen"
									v-on:open-item-click.stop="
										switchToWineCatalog(
											$event,
											slotProps.from + i - 1
										)
									"
								>
								</wine-item-header>
							</div>
							<div
								v-if="isOpen"
								class="wine-item-open tw-w-full tw-max-w-full md:tw-max-h-full"
							>
								<wine-item-content
									:key="`${
										slotProps.from + i - 1
									}_${getSliderItemIdByKey({
										i,
									})}_sliderItemContent`"
									v-if="getSliderItemIdByKey({ i })"
									:contentId="getSliderItemIdByKey({ i })"
									:isSmooth="true"
									v-on:click-on-item.stop="
										switchToWineSlider(
											$event,
											slotProps.from + i - 1,
											slotProps.handleIncreaseListCallback
										)
									"
								>
									<template v-slot:harvestControlDesktop>
										<transition-group
											tag="div"
											name="bottom-control-items-fade"
											key="desktop-harvest-block"
											class="harvest-block"
										>
											<div
												v-if="!selectedHarvest"
												key="desktop-harvest-loading-block"
											>
												<div
													class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-6 tw-w-6"
												></div>
											</div>
											<div
												v-else
												key="desktop-harvest-container"
												class="harvest-container tw-flex tw-items-center"
											>
												<span
													class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
													v-if="isPrevHarvest"
													v-on:click.stop="
														handleDecreaseHarvest(
															$event,
															slotProps.handleDecreaseListCallback
														)
													"
												>
													<img
														class="tw-z-1 tw-object-scale-down"
														src="/images/icons/wines-pg/left-arrow-icon.svg"
													/>
												</span>
												<span
													class="prev-wine-item-terroir-text tw-px-4 tw-capitalize tw-text-steilgut-text-gray"
													>{{ selectedHarvest }}</span
												>
												<span
													class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
													v-if="isNextHarvest"
													v-on:click.stop="
														handleIncreaseHarvest(
															$event,
															slotProps.handleIncreaseListCallback
														)
													"
												>
													<img
														class="tw-z-1 tw-object-scale-down"
														src="/images/icons/wines-pg/right-arrow-icon.svg"
													/>
												</span>
											</div>
										</transition-group>
									</template>
								</wine-item-content>
							</div>
						</div>
					</div>
					<transition-group
						tag="div"
						name="bottom-control-items-fade"
						class="bottom-arrow-control-block tw-flex tw-flex-row tw-w-full tw-w-max-w-full tw-flex-content-center tw-justify-between tw-relative tw-z-1"
						v-if="isOpen"
					>
						<!-- <transition-group
							tag="div"
							name="bottom-control-items-fade"
							v-if="isPrevWineTitle"
							key="desktop-prev-wine-title"
							class="left-arrow tw-block tw-relative tw-z-1"
						>
							<div
								v-if="isPrevWineTitleCharging"
								key="desktop-prev-wine-title-charging"
							>
								<div
									class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-6 tw-w-6"
								></div>
							</div>
							<div
								v-else
								key="desktop-prev-wine-title-link"
								class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-p-0 tw-cursor-pointer hover:tw-text-steilgut-text-gold"
								v-on:click.stop="handlePrevWineCatalogClick($event)"
							>
								<img
									class="tw-z-1 tw-object-fit"
									src="/images/icons/wines-pg/left-arrow-icon.svg"
								/>

								<span
									class="prev-wine-item-terroir-text tw-pl-4 tw-capitalize tw-text-steilgut-text-gray"
									>{{ prevWineTitle }}</span
								>
							</div>
						</transition-group> -->

						<!-- <transition-group
							tag="div"
							name="bottom-control-items-fade"
							key="desktop-harvest-block"
							class="harvest-block"
						>
							<div
								v-if="!selectedHarvest"
								key="desktop-harvest-loading-block"
							>
								<div
									class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-6 tw-w-6"
								></div>
							</div>
							<div
								v-else
								key="desktop-harvest-container"
								class="harvest-container tw-flex tw-items-center"
							>
								<span
									class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
									v-if="isPrevHarvest"
									v-on:click.stop="
										handleDecreaseHarvest(
											$event,
											slotProps.handleDecreaseListCallback
										)
									"
								>
									<img
										class="tw-z-1 tw-object-scale-down"
										src="/images/icons/wines-pg/left-arrow-icon.svg"
									/>
								</span>
								<span
									class="prev-wine-item-terroir-text tw-px-4 tw-capitalize tw-text-steilgut-text-gray"
									>{{ selectedHarvest }}</span
								>
								<span
									class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
									v-if="isNextHarvest"
									v-on:click.stop="
										handleIncreaseHarvest(
											$event,
											slotProps.handleIncreaseListCallback
										)
									"
								>
									<img
										class="tw-z-1 tw-object-scale-down"
										src="/images/icons/wines-pg/right-arrow-icon.svg"
									/>
								</span>
							</div>
						</transition-group> -->

						<transition-group
							name="bottom-control-items-fade"
							tag="div"
							v-if="isNextWineTitle || isPrevWineTitle"
							class="right-arrow tw-relative tw-z-1 tw-block"
							key="desktop-next-wine-title"
						>
							<div
								v-if="isNextWineTitleCharging || isPrevWineTitleCharging"
								key="desktop-next-wine-title-charging"
							>
								<div
									class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
								></div>
							</div>
							<div
								v-else-if="isNextWineTitle"
								key="desktop-next-wine-title-link"
								class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-p-0 tw-cursor-pointer hover:tw-text-steilgut-text-gold"
								v-on:click.stop="
									handleNextWineCatalogClick($event, false)
								"
							>
								<span
									class="next-wine-item-terroir-text tw-pr-4 tw-capitalize tw-text-steilgut-text-gray"
									>{{ nextWineTitle }}</span
								>
								<img
									class="tw-z-1 tw-object-fill"
									src="/images/icons/wines-pg/right-arrow-icon.svg"
								/>
							</div>
							<div
								v-else-if="isPrevWineTitle"
								key="desktop-prev-wine-title-link"
								class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-p-0 tw-cursor-pointer hover:tw-text-steilgut-text-gold"
								v-on:click.stop="
									handlePrevWineCatalogClick($event, false)
								"
							>
								<span
									class="next-wine-item-terroir-text tw-pr-4 tw-capitalize tw-text-steilgut-text-gray"
									>{{ prevWineTitle }}</span
								>
								<img
									class="tw-z-1 tw-object-fill"
									src="/images/icons/wines-pg/right-arrow-icon.svg"
								/>
							</div>
						</transition-group>
					</transition-group>
					<div v-if="getSliderControlTo + 1 < getSliderDataCount">
						<div
							class="right-grape-arrow-container tw-cursor-pointer"
							v-if="!isOpen"
						>
							<a
								class="right-grape-arrow"
								v-on:click="
									handleIncreaseHarvest(
										$event,
										slotProps.handleIncreaseListCallback,
										false
									)
								"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="40"
									height="43"
									viewBox="0 0 40 43"
								>
									<g
										fill="#EBCB9A"
										fill-rule="evenodd"
										filter="url(#arrow-wine-r-a)"
										transform="matrix(0 1 1 0 2 .778)"
									>
										<path
											d="M19.6426907 22.6941467C16.2846046 22.6941467 13.5528973 25.425854 13.5528973 28.7839401 13.5528973 32.1420261 16.2846046 34.8737335 19.6426907 34.8737335 23.0007768 34.8737335 25.7324841 32.1420261 25.7324841 28.7839401 25.7324841 25.425854 23.0007768 22.6941467 19.6426907 22.6941467M19.6426907 35.3708594C16.0106882 35.3708594 13.0557713 32.4159426 13.0557713 28.7839401 13.0557713 25.1519376 16.0106882 22.1970207 19.6426907 22.1970207 23.2746932 22.1970207 26.2296101 25.1519376 26.2296101 28.7839401 26.2296101 32.4159426 23.2746932 35.3708594 19.6426907 35.3708594M19.6426907.572040115C16.2846046.572040115 13.5528973 3.303996 13.5528973 6.6618335 13.5528973 10.019671 16.2846046 12.7516269 19.6426907 12.7516269 23.0007768 12.7516269 25.7324841 10.019671 25.7324841 6.6618335 25.7324841 3.303996 23.0007768.572040115 19.6426907.572040115M19.6426907 13.2487529C16.0106882 13.2487529 13.0557713 10.293836 13.0557713 6.6618335 13.0557713 3.02983101 16.0106882.0749141249 19.6426907.0749141249 23.2746932.0749141249 26.2296101 3.02983101 26.2296101 6.6618335 26.2296101 10.293836 23.2746932 13.2487529 19.6426907 13.2487529"
										/>
										<path
											d="M32.5679664.572040115C29.2098804.572040115 26.4781731 3.303996 26.4781731 6.6618335 26.4781731 10.019671 29.2098804 12.7516269 32.5679664 12.7516269 35.9260525 12.7516269 38.6577598 10.019671 38.6577598 6.6618335 38.6577598 3.303996 35.9260525.572040115 32.5679664.572040115M32.5679664 13.2487529C28.935964 13.2487529 25.9810471 10.293836 25.9810471 6.6618335 25.9810471 3.02983101 28.935964.0749141249 32.5679664.0749141249 36.1999689.0749141249 39.1548858 3.02983101 39.1548858 6.6618335 39.1548858 10.293836 36.1999689 13.2487529 32.5679664 13.2487529M6.71741494.572040115C3.35932888.572040115.627621563 3.303996.627621563 6.6618335.627621563 10.019671 3.35932888 12.7516269 6.71741494 12.7516269 10.075501 12.7516269 12.8072083 10.019671 12.8072083 6.6618335 12.8072083 3.303996 10.075501.572040115 6.71741494.572040115M6.71741494 13.2487529C3.08541246 13.2487529.130495572 10.293836.130495572 6.6618335.130495572 3.02983101 3.08541246.0749141249 6.71741494.0749141249 10.3494174.0749141249 13.3043343 3.02983101 13.3043343 6.6618335 13.3043343 10.293836 10.3494174 13.2487529 6.71741494 13.2487529"
										/>
										<path
											d="M26.1053286,11.7573749 C22.7472425,11.7573749 20.0155352,14.4893308 20.0155352,17.8471683 C20.0155352,21.2052543 22.7472425,23.9369617 26.1053286,23.9369617 C29.4634146,23.9369617 32.195122,21.2052543 32.195122,17.8471683 C32.195122,14.4893308 29.4634146,11.7573749 26.1053286,11.7573749 M26.1053286,24.4340877 C22.4733261,24.4340877 19.5184092,21.4791708 19.5184092,17.8471683 C19.5184092,14.2151658 22.4733261,11.2602489 26.1053286,11.2602489 C29.7373311,11.2602489 32.6922479,14.2151658 32.6922479,17.8471683 C32.6922479,21.4791708 29.7373311,24.4340877 26.1053286,24.4340877"
										/>
										<path
											d="M13.1800528,11.7573749 C9.82196675,11.7573749 7.09025944,14.4893308 7.09025944,17.8471683 C7.09025944,21.2052543 9.82196675,23.9369617 13.1800528,23.9369617 C16.5381389,23.9369617 19.2698462,21.2052543 19.2698462,17.8471683 C19.2698462,14.4893308 16.5381389,11.7573749 13.1800528,11.7573749 M13.1800528,24.4340877 C9.54805033,24.4340877 6.59313345,21.4791708 6.59313345,17.8471683 C6.59313345,14.2151658 9.54805033,11.2602489 13.1800528,11.2602489 C16.8120553,11.2602489 19.7669722,14.2151658 19.7669722,17.8471683 C19.7669722,21.4791708 16.8120553,24.4340877 13.1800528,24.4340877"
										/>
									</g>
								</svg>
							</a>
						</div>
					</div>
				</template>

				<!-- Phone portrait layout -->
				<template v-slot:itemListView="slotProps">
					<div :class="[calcWineItemListStyleClass]">
						<div v-if="isOpen">
							<img
								src="/images/mobile/single-wine/portrait/jpg/portrait-2x-bg-single-wine-pg.jpg"
								class="tw-absolute tw-inset-0 tw-object-cover tw-w-full tw-max-w-full tw-z-n-1"
							/>
						</div>
						<div
							v-for="i in getSliderMaxItemQuantityPerPage"
							:key="`${slotProps.from + i - 1}_sliderItem`"
							:class="[calcWineItemStyleClass(i)]"
							v-on:click.prevent="
								handleTapOnItem($event, slotProps.from + i - 1)
							"
						>
							<!-- Wine header can open the content and close: he must be fit (use of tw-w-fit-content tw-mx-auto)  -->
							<div v-if="!isOpen" class="tw-flex">
								<wine-item-header
									v-if="
										getSliderItemDataByKey({
											i,
										})
									"
									:itemData="
										getSliderItemDataByKey({
											i,
										})
									"
									:itemKey="`${
										slotProps.from + i - 1
									}_sliderItemHeader`"
									:isOdd="i % 2 !== 0"
									:mobileViewHidden="false"
									:isOpen="isOpen"
									class="tw-static tw-flex-grow tw-h-fit-content"
									v-on:open-item-click.stop="
										switchToWineCatalog(
											$event,
											slotProps.from + i - 1
										)
									"
								>
								</wine-item-header>
							</div>
							<div v-else class="wine-item-open">
								<wine-item-content
									:key="`${
										slotProps.from + i - 1
									}_${getSliderItemIdByKey({ i })}_sliderItemContent`"
									v-if="getSliderItemDataByKey({ i })"
									:contentId="getSliderItemIdByKey({ i })"
									:isSmooth="true"
									v-on:click-on-item.stop="
										switchToWineSlider(
											$event,
											slotProps.from + i - 1,
											slotProps.handleIncreaseListCallback
										)
									"
								>
									<template v-slot:harvestControlPortrait>
										<div
											class="harvest-control-block tw-relative tw-z-1"
										>
											<div v-if="!selectedHarvest">
												<div
													class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
												></div>
											</div>
											<div v-else class="harvest-container tw-flex">
												<span
													class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer tw-my-auto tw-mx-0"
													v-if="isPrevHarvest"
													v-on:click.stop="
														handleDecreaseHarvest(
															$event,
															slotProps.handleDecreaseListCallback
														)
													"
												>
													<img
														class="tw-z-1 tw-object-scale-down"
														src="/images/icons/wines-pg/left-arrow-icon.svg"
													/>
												</span>
												<span
													class="wine-item-harvest-text tw-px-4 tw-capitalize tw-text-steilgut-text-gray"
													>{{ selectedHarvest }}</span
												>
												<span
													class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer tw-my-auto tw-mx-0"
													v-if="isNextHarvest"
													v-on:click.stop="
														handleIncreaseHarvest(
															$event,
															slotProps.handleIncreaseListCallback
														)
													"
												>
													<img
														class="tw-z-1 tw-object-scale-down"
														src="/images/icons/wines-pg/right-arrow-icon.svg"
													/>
												</span>
											</div>
										</div>
									</template>
								</wine-item-content>

								<!-- <div class="harvest-control-block tw-relative tw-z-1">
									<div v-if="!selectedHarvest">
										<div class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"></div>
									</div>
									<div
										v-else
										class="harvest-container tw-flex"
									>
										<span
											class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
											v-if="isPrevHarvest"
											v-on:click.stop="
												handleDecreaseHarvest(
													$event,
													slotProps.handleDecreaseListCallback
												)
											"
										>
											<img
												class="tw-z-1 tw-object-scale-down"
												src="/images/icons/wines-pg/left-arrow-icon.svg"
											/>
										</span>
										<span class="prev-wine-item-terroir-text tw-px-4 tw-capitalize tw-text-steilgut-text-gray">{{ selectedHarvest }}</span>
										<span
											class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
											v-if="isNextHarvest"
											v-on:click.stop="
												handleIncreaseHarvest(
													$event,
													slotProps.handleIncreaseListCallback
												)
											"
										>
											<img
												class="tw-z-1 tw-object-scale-down"
												src="/images/icons/wines-pg/right-arrow-icon.svg"
											/>
										</span>
									</div>
								</div> -->

								<div
									class="bottom-arrow-control-block tw-flex tw-flex-row tw-w-full tw-w-max-w-full tw-flex-content-center tw-justify-between tw-relative tw-z-1"
									v-if="isOpen"
								>
									<div
										v-if="isPrevWineTitle"
										class="left-arrow tw-block"
									>
										<div v-if="isPrevWineTitleCharging">
											<div
												class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
											></div>
										</div>
										<div
											class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-pl-0 tw-cursor-pointer hover:tw-text-steilgut-text-gold"
											v-on:click="
												handlePrevWineCatalogClick($event)
											"
										>
											<img
												class="tw-z-1 tw-object-fit"
												src="/images/icons/wines-pg/left-arrow-icon.svg"
											/>

											<span
												class="prev-wine-item-terroir-text tw-pl-2 tw-capitalize tw-text-steilgut-text-gray"
												>{{ prevWineTitle }}</span
											>
										</div>
									</div>

									<div
										v-if="isNextWineTitle"
										class="right-arrow tw-block"
									>
										<div v-if="isNextWineTitleCharging">
											<div
												class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
											></div>
										</div>
										<div
											class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-p-0 tw-cursor-pointer hover:tw-text-steilgut-text-gold"
											v-on:click="
												handleNextWineCatalogClick($event)
											"
										>
											<span
												class="next-wine-item-terroir-text tw-pr-2 tw-capitalize tw-text-steilgut-text-gray"
												>{{ nextWineTitle }}</span
											>
											<img
												class="tw-z-1 tw-object-fill"
												src="/images/icons/wines-pg/right-arrow-icon.svg"
											/>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div v-if="!isOpen" class="control-nav">
							<button
								:key="`${page}_controlNavPoint`"
								v-for="page in 4"
								:class="[
									'tw-rounded-full',
									'tw-h-4',
									'tw-w-4',
									'tw-border',
									'tw-appearance-none',
									'focus:tw-outline-none',
									'focus:tw-border-none',
									'tw-border-steilgut-text-gray',
									calcControlPointBgStyleClass(page),
								]"
								v-on:click="
									handleControlPointClick(
										$event,
										page - 1,
										slotProps.handleIncreaseListCallback
									)
								"
							></button>
						</div>
					</div>
				</template>

				<!-- Landscape layout -->
				<template v-slot:lsItemListView="slotProps">
					<div v-if="getSliderControlFrom > 0 && !isOpen">
						<img
							src="/images/mobile/wines-pg/icons/grape-left-arrow.png"
							alt="Left arrow"
							class="tw-object-contain left-grape-arrow-container"
							v-on:click="
								handleDecreaseHarvest(
									$event,
									slotProps.handleDecreaseListCallback
								)
							"
						/>
					</div>
					<div :class="[calcWineItemListStyleClass]">
						<div
							v-for="i in slotProps.itemQuantityPerPage"
							:key="`${slotProps.from + i - 1}_sliderItem`"
							:class="[
								{
									'tw-w-1/2 tw-max-w-1/2 tw-mt-auto tw-mb-auto': !isOpen,
								},
								calcPositionStyleClass(i - 1),
								{
									'tw-flex tw-w-full tw-max-w-full tw-min-h-full tw-max-h-full tw-h-full': isOpen,
								},
							]"
							v-on:click.prevent="
								handleTapOnItem($event, slotProps.from + i - 1)
							"
						>
							<div
								v-if="!isOpen"
								class="tw-relative tw-z-1 tw-w-full tw-max-w-full"
							>
								<wine-item-header
									v-if="getSliderItemDataByKey({ i })"
									:itemData="getSliderItemDataByKey({ i })"
									:itemKey="`${
										slotProps.from + i - 1
									}_sliderItemHeader`"
									:isOdd="i % 2 !== 0"
									:mobileViewHidden="false"
									:isOpen="isOpen"
									v-on:open-item-click.stop="
										switchToWineCatalog(
											$event,
											slotProps.from + i - 1
										)
									"
								>
								</wine-item-header>
							</div>
							<div
								v-else
								class="wine-item-open tw-w-full tw-max-w-full md:tw-max-h-screen landscape:tw-h-auto"
							>
								<wine-item-content
									:key="`${
										slotProps.from + i - 1
									}_${getSliderItemIdByKey({
										i,
									})}_landscape_sliderItemContent`"
									v-if="getSliderItemDataByKey({ i })"
									:contentId="getSliderItemIdByKey({ i })"
									:isSmooth="true"
									v-on:click-on-item.stop="
										switchToWineSlider(
											$event,
											slotProps.from + i - 1,
											slotProps.handleIncreaseListCallback
										)
									"
								>
									<template v-slot:harvestControlLandscape>
										<transition-group
											tag="div"
											name="bottom-control-items-fade"
											key="landscape-harvest-block"
											class="harvest-block"
										>
											<div
												v-if="!selectedHarvest"
												key="landscape-harvest-loading-block"
											>
												<div
													class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-6 tw-w-6"
												></div>
											</div>
											<div
												v-else
												class="harvest-container tw-flex"
												key="landscape-harvest-container"
											>
												<span
													class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
													v-if="isPrevHarvest"
													v-on:click="
														handleDecreaseHarvest(
															$event,
															slotProps.handleDecreaseListCallback
														)
													"
												>
													<img
														class="tw-z-1 tw-object-scale-down"
														src="/images/icons/wines-pg/left-arrow-icon.svg"
													/>
												</span>
												<span
													class="prev-wine-item-terroir-text tw-px-4 tw-capitalize tw-text-steilgut-text-gray"
													>{{ selectedHarvest }}</span
												>
												<span
													class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
													v-if="isNextHarvest"
													v-on:click="
														handleIncreaseHarvest(
															$event,
															slotProps.handleDecreaseListCallback
														)
													"
												>
													<img
														class="tw-z-1 tw-object-scale-down"
														src="/images/icons/wines-pg/right-arrow-icon.svg"
													/>
												</span>
											</div>
										</transition-group>
									</template>
								</wine-item-content>
								<transition-group
									tag="div"
									name="bottom-control-items-fade"
									class="bottom-arrow-control-block tw-flex tw-flex-row tw-w-full tw-w-max-w-full tw-flex-content-center tw-justify-between tw-relative tw-z-21"
									v-if="isOpen"
								>
									<!-- <transition-group
										tag="div"
										name="bottom-control-items-fade"
										v-if="isPrevWineTitle"
										key="landscape-prev-wine-title"
										class="left-arrow tw-block tw-relative tw-z-1"
									>
										<div
											v-if="isPrevWineTitleCharging"
											key="landscape-prev-wine-title-charging"
										>
											<div
												class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
											></div>
										</div>
										<span
											v-else
											key="landscape-prev-wine-title-link"
											class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
											v-on:click.stop="handlePrevWineCatalogClick($event)"
										>
											<div
												class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-px-4"
											>
												<img
													class="tw-z-1 tw-object-fit"
													src="/images/icons/wines-pg/left-arrow-icon.svg"
												/>

												<span
													class="prev-wine-item-terroir-text tw-px-4 tw-capitalize tw-text-steilgut-text-gray"
													>{{ prevWineTitle }}</span
												>
											</div>
										</span>
									</transition-group> -->

									<!-- <transition-group
										tag="div"
										name="bottom-control-items-fade"
										key="landscape-harvest-block"
										class="harvest-block"
									>
										<div
											v-if="!selectedHarvest"
											key="landscape-harvest-loading-block"
										>
											<div class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-6 tw-w-6"></div>
										</div>
										<div
											v-else
											class="harvest-container tw-flex"
											key="landscape-harvest-container"
										>
											<span
												class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
												v-if="isPrevHarvest"
												v-on:click="
													handleDecreaseHarvest(
														$event,
														slotProps.handleDecreaseListCallback
													)
												"
											>
												<img
													class="tw-z-1 tw-object-scale-down"
													src="/images/icons/wines-pg/left-arrow-icon.svg"
												/>
											</span>
											<span class="prev-wine-item-terroir-text tw-px-4 tw-capitalize tw-text-steilgut-text-gray">{{ selectedHarvest }}</span>
											<span
												class="tw-no-underline hover:tw-no-underline tw-inline-block hover:tw-text-steilgut-text-gold tw-cursor-pointer"
												v-if="isNextHarvest"
												v-on:click="
													handleIncreaseHarvest(
														$event,
														slotProps.handleDecreaseListCallback
													)
												"
											>
												<img
													class="tw-z-1 tw-object-scale-down"
													src="/images/icons/wines-pg/right-arrow-icon.svg"
												/>
											</span>
										</div>
									</transition-group> -->

									<transition-group
										name="bottom-control-items-fade"
										tag="div"
										v-if="isNextWineTitle || isPrevWineTitle"
										class="right-arrow tw-relative tw-z-1 tw-block"
										key="landscape-next-wine-title"
									>
										<div
											v-if="
												isNextWineTitleCharging ||
												isPrevWineTitleCharging
											"
											key="landscape-next-wine-title-charging"
										>
											<div
												class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
											></div>
										</div>
										<div
											v-else-if="isNextWineTitle"
											key="landscape-next-wine-title-link"
											class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-p-0 tw-cursor-pointer hover:tw-text-steilgut-text-gold"
											v-on:click.stop="
												handleNextWineCatalogClick($event)
											"
										>
											<span
												class="next-wine-item-terroir-text tw-pr-4 tw-capitalize tw-text-steilgut-text-gray"
												>{{ nextWineTitle }}</span
											>
											<img
												class="tw-z-1 tw-object-fill"
												src="/images/icons/wines-pg/right-arrow-icon.svg"
											/>
										</div>
										<div
											v-else-if="isPrevWineTitle"
											key="landscape-prev-wine-title-link"
											class="tw-flex tw-flex-row tw-content-center tw-justify-between tw-p-0 tw-cursor-pointer hover:tw-text-steilgut-text-gold"
											v-on:click.stop="
												handlePrevWineCatalogClick($event)
											"
										>
											<span
												class="next-wine-item-terroir-text tw-pr-4 tw-capitalize tw-text-steilgut-text-gray"
												>{{ prevWineTitle }}</span
											>
											<img
												class="tw-z-1 tw-object-fill"
												src="/images/icons/wines-pg/right-arrow-icon.svg"
											/>
										</div>
									</transition-group>
								</transition-group>
							</div>
						</div>
					</div>

					<div v-if="to < getSliderDataCount - 1 && !isOpen">
						<img
							src="/images/mobile/wines-pg/icons/grape-right-arrow.png"
							alt="Right arrow"
							class="tw-object-contain right-grape-arrow-container"
							v-on:click="
								handleIncreaseHarvest(
									$event,
									slotProps.handleIncreaseListCallback
								)
							"
						/>
					</div>
				</template>
			</slider>
		</div>
	</div>
</template>

<script>
import SliderComp from "../../shared/components/slider/SliderComp.vue";
import SliderControlComp from "../../shared/components/slider/SliderControlComp";
import WineItemHeaderComp from "./WineItemHeaderComp";
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";
import { SliderHelper } from "../../shared/utils/slider";
import { mapGetters, mapState } from "vuex";
import PulseLogoComp from "../../shared/components/PulseLogoComp";
import { Helper } from "../../shared/utils/helper";
import mediaHelper from "../../shared/mixins/mediaHelper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";
import { is422, is404, is500, processErrorResponse } from "../../shared/utils/response";

const wineItemContentComp = () =>
	import(/* webpackPrefetch: true */ "./WineItemContentComp");

function $_getData() {
	return new Promise((resolve, reject) => {
		const WINES_PAGE_INITIAL_STATE = Helper.GET_STEILGUT_VAR_STORE()["INITIAL_STATE"][
			"WINES_PAGE"
		];
		if (
			WINES_PAGE_INITIAL_STATE &&
			Object.keys(WINES_PAGE_INITIAL_STATE).length > 0
		) {
			const initialData = {
				titleMap: WINES_PAGE_INITIAL_STATE["TITLE_MAP"],
				titleCountMap: WINES_PAGE_INITIAL_STATE["TITLE_COUNT_MAP"],
			};
			resolve(initialData);
		} else {
			const urlParams = new URLSearchParams([["is_title_map", true]]);
			axios
				.get("/api/wines", {
					params: urlParams,
				})
				.then((response) => {
					resolve(response.data.data);
				})
				.catch((error) => {
					reject(error);
				});
		}
	});
}

export default {
	mixins: [mediaHelper, fullscreenCorrector],
	components: {
		slider: SliderComp,
		"slider-control": SliderControlComp,
		"wine-item-header": WineItemHeaderComp,
		"wine-item-content": wineItemContentComp,
		"pulse-logo-comp": PulseLogoComp,
		"background-shadow-comp": BackgroundShadowComp,
	},

	beforeRouteEnter(to, from, next) {
		"use strict";
		console.log("Debug [WineSliderComp::beforeRouteEnter]");
		$_getData()
			.then((initialData) => {
				next((vm) =>
					vm.setData({
						data: initialData,
						error: null,
					})
				);
			})
			.catch((error) => {
				console.log(
					"Debug [WineSliderComp::beforeRouteEnter] Unexpected error occurred: " +
						error
				);
				next((vm) =>
					vm.setData(
						{ data: null },
						{
							error,
						}
					)
				);
			});
	},

	// beforeRouteLeave(to, from, next) {
	// 	if (this.isOpen) {
	// 		// window.history.replaceState(null, "", "masthead/wines");
	// 		try {
	// 			this.switchToWineSlider(
	// 				null,
	// 				this.getSliderControlFrom + this.getSliderControlCursor - 1,
	// 				this.$refs.slotProps.handleIncreaseList,
	// 				() => next(false)
	// 			);
	// 		} catch (e) {
	// 			console.warn(e);
	// 		}
	// 	} else {
	// 		next();
	// 	}
	// },

	data: function () {
		return {
			/* List of brief wine description: Title/Image */
			headerList: null,
			headerCount: -1,

			titleMap: null,
			titleCountMap: null,

			selectedHarvest: -1,
			selectedHeader: "",

			nextWineTitle: null,
			prevWineTitle: null,
			/* Use for additional loading UI components (like next harvest wine title) */
			isPrevWineTitleCharging: false,
			isNextWineTitleCharging: false,

			isLoading: true,
			isError: false,

			isOpen: false,
			isEven: false,

			isLeftBgImageHover: false,
			isRightBgImageHover: false,

			startClientY: -1,
			startClientX: -1,

			currentTitleIndex: 0,
		};
	},

	created() {
		console.log("Debug [WineSliderComp] created");
		const self = this;
		this.isLoading = true;
		this.$store.commit("resetSlider");
		this.initHorModeSlider();

		// window.addEventListener("orientationchange", this.handleResize);
		window.addEventListener("resize", this.handleResize);
		if (this.isMobileDevice()) {
			document.addEventListener(
				"touchstart",
				this.handleTouchStart,
				{
					passive: false,
				},
				false
			);
			document.addEventListener(
				"touchmove",
				this.handleTouchMove,
				{
					passive: false,
				},
				false
			);
		}
	},

	destroyed() {
		console.log("Debug [WineSliderComp] destroyed");
		document.removeEventListener("touchstart", this.handleTouchStart);
		document.removeEventListener("touchmove", this.handleTouchMove);
		// window.removeEventListener("orientationchange", this.handleResize);
		window.removeEventListener("resize", this.handleResize);
	},

	computed: {
		calcWineItemListStyleClass: function () {
			return this.isOpen ? "wine-items-open" : "wine-items";
		},

		calcExtendedLeftBgImageStyleClass: function () {
			return this.isLeftBgImageHover ? "tw-filter-none" : "tw-filter-grayscale";
		},

		calcExtendedRightBgImageStyleClass: function () {
			return this.isRightBgImageHover ? "tw-filter-none" : "tw-filter-grayscale";
		},

		...mapState({
			sliderData: (state) => {
				return state.slider.data;
			},

			cursor: (state) => {
				return state.slider.control.cursor;
			},

			from: (state) => {
				return state.slider.control.from;
			},

			to: (state) => {
				return state.slider.control.to;
			},

			itemHeightPercent: (state) => {
				return state.slider.itemHeightPercent;
			},
		}),

		...mapGetters([
			"getSliderControlCursor",
			"getSliderControlPrevCursor",
			"getSliderControlFrom",
			"getSliderControlPrevFrom",
			"getSliderControlTo",
			"getSliderControlPage",
			"getSliderControlPrevTo",
			"getSliderItemDataByKey",
			"getSliderItemIdByKey",
			"getSliderMaxItemQuantityPerPage",
			"getSliderItemQuantityPerPage",
			"getSliderData",
			"getSliderDataClone",
			"getSliderCursorData",
			"getSliderDataCount",
			"getSliderPrevItemData",
			"getSliderNextItemData",
			"getSliderNotDummyItemsLength",
			// Group of set
			"getGroupByKey",
			"hasKeyGroup",
			"getFirstItemFromGroupByKey",
			"getLastItemFromGroupByKey",
			"isUpdateKeyGroup",
			"isFullyLoadedKeyGroup",
			"getGroupLengthByKey",
			"getGroupNotDummyLengthByKey",
		]),

		isNextWineTitle: function () {
			return this.nextWineTitle ? true : false;
		},

		isPrevWineTitle: function () {
			return this.prevWineTitle ? true : false;
		},

		isNextHarvest: function () {
			"use strict";
			return this.getSliderControlCursor < this.getSliderDataCount - 1;
		},

		isPrevHarvest: function () {
			"use strict";
			return this.getSliderControlCursor > 0;
		},
	},

	methods: {
		setData: function (response, error) {
			const data = response.data;
			if (data) {
				this.titleCountMap = {};
				for (let t of Object.keys(data["titleCountMap"])) {
					this.titleCountMap[t] = data["titleCountMap"][t];
				}

				this.titleMap = data["titleMap"];
				this.$_initSlider(data);
			} else {
				this.isError = true;
				console.error(
					"Error [WinesSliderComp::setData] Error occurred: " + error
				);
			}
			this.isLoading = false;
		},

		$_initSlider: function (data) {
			"use strict";
			this.$store.commit("resetSlider");
			this.initHorModeSlider();

			this.headerCount = Object.keys(data["titleCountMap"]).length;
			this.headerList = [];
			const titleList = Object.keys(data["titleMap"]);
			for (let title of titleList) {
				if (titleList.length > 0) {
					this.headerList.push({
						title,
						image: data["titleMap"][title][0].image,
						terroir: data["titleMap"][title][0].terroir,
					});
				}
			}

			let to = 1;
			if (this.headerCount == 1) {
				to = 0;
			}
			this.$store.commit("setSliderControlCursor", 0);
			this.$store.commit("setSliderControlFrom", 0);
			this.$store.commit("setSliderControlTo", to);
			this.$store.commit("setSliderData", this.headerList);
			this.$store.commit("setSliderDataCount", this.headerCount);
		},

		calcCountRequestExpression: function () {
			const self = this;
			return () => {
				if (this.isOpen) {
					return {
						url: `/api/wines/get/count/${this.selectedHeader}`,
					};
				} else {
					return {
						url: `/api/wines/header/get/count`,
						params: null,
					};
				}
			};
		},

		calcRangeDataRequestExpression: function (from, to) {
			const self = this;
			return () => {
				if (this.isOpen) {
					return {
						url: `/api/wines/pageRange/${from}/${to}/${this.selectedHeader}`,
					};
				} else {
					return {
						url: `/api/wines/header/pageRange/${from}/${to}`,
					};
				}
			};
		},

		calcWineItemStyleClass: function (i) {
			if (this.isOpen) {
				return "wine-item-open";
			} else {
				if (i % 2 === 0) {
					return "wine-item-even-block";
				} else {
					return "wine-item-odd-block";
				}
			}
		},

		calcSliderControlClass: function (index) {
			return index % 2 > 0 ? "top-slider-control" : "bottom-slider-control";
		},

		calcControlPointBgStyleClass: function (page) {
			if (this.isControlPointSet(page)) {
				return "tw-bg-steilgut-text-gray";
			} else {
				return "tw-bg-transparent";
			}
		},

		calcExtendedLeftBgImageStyleClassFunc: function () {
			return this.isLeftBgImageHover ? "tw-filter-none" : "tw-filter-grayscale";
		},

		calcExtendedRightBgImageStyleClassFunc: function () {
			return this.isRightBgImageHover ? "tw-filter-none" : "tw-filter-grayscale";
		},

		calcPositionStyleClass: function (index) {
			if (this.isOpen) {
				return "tw-m-auto md:tw-m-0";
			} else {
				if (index % 2 === 0) {
					return "tw-ml-0 tw-mr-auto";
				} else {
					return "tw-ml-auto tw-mr-0";
				}
			}
		},

		$_resetPrevAndNextWineTitles: function () {
			"use strict";
			this.prevWineTitle = null;
			this.nextWineTitle = null;
		},

		$_updatePrevAndNextWineTitles: function () {
			"use strict";
			this.$_resetPrevAndNextWineTitles();
			if (this.isOpen) {
				this.$_calcPrevWineTitle();
				this.$_calcNextWineTitle();
			}
		},

		$_calcNextWineTitle: function () {
			if (
				this.currentTitleIndex >= 0 &&
				this.currentTitleIndex < this.headerCount - 1
			) {
				this.nextWineTitle = this.headerList[this.currentTitleIndex + 1].title;
			} else {
				this.nextWineTitle = this.headerList[0].title;
			}
		},

		$_calcPrevWineTitle: function () {
			if (this.currentTitleIndex > 0) {
				this.prevWineTitle = this.headerList[this.currentTitleIndex - 1].title;
			} else {
				this.prevWineTitle = null;
			}
		},

		initHorModeSlider: function () {
			"use strict";
			this.$store.commit("initSlider", {
				mode: "hor",
				itemWidthPercent: 0.5,
			});
		},

		initOpenHorModeSlider: function () {
			"use strict";
			this.$store.commit("initSlider", {
				mode: "hor",
				itemWidthPercent: 1.0,
			});
		},

		/*
		 *  Portrait arrow movement processing
		 */

		isControlPointSet: function (page) {
			"use strict";
			const nPage = Math.round(
				(this.currentTitleIndex + 1) / this.getSliderMaxItemQuantityPerPage
			);

			return nPage === page;
		},

		handleControlPointClick: function (event, page, handleIncreaseListCallback) {
			"use strict";
			// debugger;
			const from = this.getSliderControlFrom;
			const to = this.getSliderControlTo;
			const diff = this.getSliderMaxItemQuantityPerPage;
			const delta = to - this.getSliderControlCursor;
			const currMaxRequest = page * diff;
			const quantity = this.headerCount;
			if (currMaxRequest > this.headerCount) {
				return;
			} else {
				this.handleSwipeUpList(null, { stepSize: currMaxRequest });
			}
		},

		switchView: function (event) {
			"use strict";
			this.isOpen = !this.isOpen;
			if (this.isOpen) {
				this.initOpenHorModeSlider();
			} else {
				this.initHorModeSlider();
			}
		},

		/*
		 * Transform the slider data (wine header list) to the catalog data.
		 */
		switchToWineCatalog: async function (event, newCursor) {
			try {
				this.isOpen = true;
				const cursorData = this.headerList[newCursor];
				this.selectedHeader = cursorData.title;
				const newSliderData = this.titleMap[cursorData.title];
				this.currentTitleIndex = newCursor;
				if (!newSliderData) {
					this.isLoading = true;
					//
					const url = `/api/wines/pageRange/0/1/${this.selectedHeader}`;
					const data = (await axios.get(url)).data.data;

					this.titleMap[cursorData.title] = data;
				}
				const oldFrom = this.getSliderControlFrom;
				const oldTo = this.getSliderControlTo;

				this.$_resetPrevAndNextWineTitles();
				// this.$_calcPrevWineTitle({ newCursor });
				// this.$_calcNextWineTitle({ newCursor });
				this.$_updatePrevAndNextWineTitles();

				this.$store.commit("setSliderData", newSliderData);
				this.$store.commit(
					"setSliderDataCount",
					this.titleCountMap[cursorData.title]
				);
				this.$store.commit("setSliderControlPrevFrom", oldFrom);
				this.$store.commit("setSliderControlPrevTo", oldTo);
				this.$store.commit("setSliderControlPrevCursor", newCursor);
				this.$store.commit("setSliderControlCursor", 0);
				this.$store.commit("setSliderControlFrom", 0);
				this.$store.commit("setSliderControlTo", 0);

				this.selectedHarvest = newSliderData[0].content.harvest;
				this.isEven = newCursor % 2 === 0;

				if (this.isPortraitOrientation()) {
					document.removeEventListener("touchstart", this.handleTouchStart);
					document.removeEventListener("touchmove", this.handleTouchMove);
				}
				this.initOpenHorModeSlider();
			} catch (reject) {
				this.isError = true;
				processErrorResponse(reject);
			} finally {
				this.isLoading = false;
			}
		},

		switchToWineSlider: function (
			event,
			cursor,
			handleIncreaseListCallback,
			nextCallback = null
		) {
			// debugger;
			if (!this.isOpen) {
				return;
			}
			const from = this.getSliderControlFrom;
			const to = this.getSliderControlTo;
			this.isOpen = false;
			this.$_resetPrevAndNextWineTitles();
			this.initHorModeSlider();
			this.$store.commit("setSliderData", this.headerList);
			this.$store.commit("setSliderDataCount", this.headerCount);

			const [newFrom, newTo, newCursor] = this.$_calcNewRangeAfterCloseEvent();

			this.$store.commit("setSliderControlCursor", newCursor);
			this.$store.commit("setSliderControlFrom", newFrom);
			this.$store.commit("setSliderControlPrevFrom", undefined);
			this.$store.commit("setSliderControlTo", newTo);
			this.$store.commit("setSliderControlPrevTo", undefined);

			if (this.isMobileDevice()) {
				document.addEventListener(
					"touchstart",
					this.handleTouchStart,
					{
						passive: false,
					},
					false
				);
				document.addEventListener(
					"touchmove",
					this.handleTouchMove,
					{
						passive: false,
					},
					false
				);
			}
			handleIncreaseListCallback(event, {
				from: this.from,
				to: this.to,
				cursor: this.cursor,
			})
				.then((response) => {
					self.isLoading = false;
					if (nextCallback) nextCallback();
					this.isOpen = false;
					this.initHorModeSlider();
				})
				.catch((reject) => {
					processErrorResponse(reject);
					self.isError = true;
					self.isLoading = false;
					if (nextCallback) nextCallback();
				});
		},

		$_calcNewRangeAfterCloseEvent: function () {
			"use strict";
			this.initHorModeSlider();

			let newFrom = this.getSliderControlPrevFrom;
			let newTo = this.getSliderControlPrevTo;
			let newCursor = newFrom;

			let num = 0;
			this.headerList.forEach((item, i) => {
				if (item.title === this.selectedHeader) {
					num = i;
				}
			});

			if (num < this.getSliderMaxItemQuantityPerPage) {
				newFrom = 0;
				newTo = newFrom + this.getSliderItemQuantityPerPage - 1;
				newCursor = num;
			} else {
				newFrom =
					this.getSliderMaxItemQuantityPerPage *
					Math.floor(num / this.getSliderMaxItemQuantityPerPage);

				newTo =
					newFrom + this.getSliderMaxItemQuantityPerPage - 1 >
					this.getSliderDataCount
						? this.getSliderDataCount - 1
						: newFrom + this.getSliderMaxItemQuantityPerPage - 1;

				newCursor = newFrom + (num % this.getSliderItemQuantityPerPage);
			}

			return [newFrom, newTo, newCursor];
		},

		/*
		 *  Landscape and desktop arrow movement processing
		 */
		handleDecreaseHarvest: function (event, handleDecreaseListCallback) {
			("use strict");
			const helper = this.$root.$data.helper;
			this.selectedHarvest = null;
			if (this.from >= 0) {
				const newRange = SliderHelper.calcSliderClickUp({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
					itemCount: this.getSliderDataCount,
					step: this.getSliderMaxItemQuantityPerPage,
				});

				const self = this;
				this.isLoading = true;
				handleDecreaseListCallback(event, newRange)
					.then((response) => {
						if (!self.getSliderCursorData) {
							console.error(
								"Error [WinesSliderComp::handleDecreaseHarvest] Invalid state of the slider"
							);
							self.isError = true;
						}
						if (self.isOpen) {
							self.selectedHarvest =
								self.getSliderCursorData.content["harvest"];
						}
						self.isLoading = false;
					})
					.catch((reject) => {
						processErrorResponse(reject);
						self.isError = true;
						self.isLoading = false;
					});
			} else {
				console.error(
					"Error [WinesSliderComp::handleDecreaseHarvest] Invalid state of the slider"
				);
				this.isError = true;
			}
		},

		handleIncreaseHarvest: function (event, handleIncreaseListCallback) {
			"use strict";
			this.selectedHarvest = null;
			const self = this;
			if (this.to <= this.getSliderDataCount - 1) {
				this.isLoading = true;
				handleIncreaseListCallback(
					event,
					SliderHelper.calcSliderClickDown({
						from: this.from,
						to: this.to,
						cursor: this.cursor,
						itemCount: this.getSliderDataCount,
						maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
						step: this.getSliderMaxItemQuantityPerPage,
					})
				).then(
					(response) => {
						if (self.isOpen) {
							if (!self.getSliderCursorData) {
								console.error(
									"Error [WinesSliderComp::handleIncreaseHarvest] Invalid state of the slider"
								);
								self.isError = true;
							} else {
								self.selectedHarvest =
									self.getSliderCursorData.content["harvest"];
							}
						}

						self.isLoading = false;
					},
					(reject) => {
						processErrorResponse(reject);
						self.isError = true;
						self.isLoading = false;
					}
				);
			} else {
				console.error(
					"Error [WinesSliderComp::handleIncreaseHarvest] Invalid state of the slider"
				);
				this.isError = true;
			}
		},

		handlePrevWineCatalogClick: async function (event) {
			"use strict";

			this.currentTitleIndex =
				this.currentTitleIndex - 1 < 0
					? this.headerCount - 1
					: --this.currentTitleIndex;

			this.switchToWineCatalog(event, this.currentTitleIndex);
			this.$_updatePrevAndNextWineTitles();
		},

		handleNextWineCatalogClick: async function (event) {
			"use strict";
			this.currentTitleIndex =
				this.currentTitleIndex + 1 >= this.headerCount
					? 0
					: ++this.currentTitleIndex;

			this.switchToWineCatalog(event, this.currentTitleIndex);

			this.$_updatePrevAndNextWineTitles();
		},

		handleMouseOver: function (event, i) {
			"use strict";
			console.log("Debug [WinesSliderComp] Mouse over " + i);
			if (i % 2 !== 0) {
				this.isLeftBgImageHover = true;
			} else {
				this.isRightBgImageHover = true;
			}
		},

		handleMouseLeave: function (event, i) {
			"use strict";
			console.log("Debug [WinesSliderComp] Mouse leave " + i);
			if (i % 2 !== 0) {
				this.isLeftBgImageHover = false;
			} else {
				this.isRightBgImageHover = false;
			}
		},

		handleResize: _.debounce(
			function (event) {
				"use strict";
				// debugger;
				console.log("Debug [handleResize] enter the function");

				if (this.isMobileDevice()) {
					if (this.isOpen) {
						if (!this.$refs.slotProps.handleIncreaseList) {
							this.isError = true;
							throw new Error(
								"Error [WinesSliderComp::handleResize] invalid slider state"
							);
						}
						this.switchToWineSlider(
							event,
							this.getSliderControlPrevFrom,
							this.$refs.slotProps.handleIncreaseList
						);
					}
				}
			},
			500,
			{
				leading: true,
				trailing: true,
			}
		),

		handleTouchStart: _.throttle(
			function (event) {
				"use strict";
				if (event.touches && event.touches.length === 1) {
					this.startClientY = event.touches[0].clientY;
					this.startClientX = event.touches[0].clientX;
				}
			},
			50,
			{
				leading: true,
				trailing: true,
			}
		),

		handleTouchMove: _.throttle(
			function (event) {
				"use strict";
				if (
					this.isPortraitOrientation() &&
					!this.isOpen &&
					event.touches &&
					event.touches.length === 1 &&
					this.startClientY > 0
				) {
					let deltaY = event.touches[0].clientY - this.startClientY;
					deltaY = deltaY < 0 ? deltaY * -1 : deltaY;
					if (deltaY > 33) {
						const swipeYUp = this.startClientY > event.touches[0].clientY;
						if (swipeYUp) {
							if (this.to + 1 < this.getSliderDataCount) {
								this.handleSwipeUpList(event);
							} else {
								console.info(
									"INFO [handleTouchMove] We are at the bottom of the page"
								);
							}
						} else {
							const swipeYDown =
								this.startClientY < event.touches[0].clientY;
							if (swipeYDown) {
								if (this.from > 0) {
									this.handleSwipeDownList(event);
								} else {
									console.info(
										"INFO [handleTouchMove] We are at the top of the page"
									);
								}
							}
						}
						this.startClientY = -1;
					}
				}

				if (
					(this.isLandscapeOrientation() ||
						(this.isPortraitOrientation() && this.isOpen)) &&
					event.touches &&
					event.touches.length === 1 &&
					this.startClientX > 0
				) {
					const swipeXRight = this.startClientX < event.touches[0].clientX;
					let deltaX = event.touches[0].clientX - this.startClientX;
					deltaX = deltaX < 0 ? deltaX * -1 : deltaX;

					if (deltaX > 33) {
						if (swipeXRight) {
							if (this.from > 0) {
								const handleDecreaseListCallback = this.$refs.slotProps
									.handleDecreaseList;
								this.handleDecreaseHarvest(
									event,
									handleDecreaseListCallback
								);
							} else {
								console.info(
									"INFO [handleTouchMove] We are at the bottom of the page"
								);
							}
						} else {
							const swipeXLeft =
								this.startClientX > event.touches[0].clientX;
							if (swipeXLeft) {
								if (this.to + 1 < this.getSliderDataCount) {
									const handleIncreaseListCallback = this.$refs
										.slotProps.handleIncreaseList;
									this.handleIncreaseHarvest(
										event,
										handleIncreaseListCallback
									);
								} else {
									console.info(
										"INFO [handleTouchMove] We are at the top of the page"
									);
								}
							}
						}

						this.startClientX = -1;
					}
				}
			},
			50,
			{
				leading: true,
				trailing: true,
			}
		),

		/*
		 * Redefine swipe handlers: we want to calculate a step (delta item count) on ourself
		 */
		handleSwipeUpList: function (event, step = { stepSize: 2 }) {
			if (!this.$refs.slotProps.handleSwipeUpList) {
				console.error(
					"Error [WinesSliderComp::handleSwipeUpList] Invalid state of the slider: there is no handleSwipeUpList callback"
				);
				self.isError = true;
			}
			const stepCount = step.stepSize;
			let newRange = 0;
			if (stepCount > this.to) {
				newRange = SliderHelper.calcSliderSwipeUp({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					itemCount: this.getSliderDataCount,
					step: stepCount,
					isAutoLoading: false,
				});

				this.currentTitleIndex =
					this.currentTitleIndex + stepCount >= this.headerCount
						? this.headerCount - 1
						: this.currentTitleIndex + stepCount;
			} else {
				newRange = SliderHelper.calcSliderSwipeDown({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					itemCount: this.getSliderDataCount,
					step: this.to - stepCount,
					isAutoLoading: false,
				});

				this.currentTitleIndex =
					this.currentTitleIndex - (this.to - stepCount) < 0
						? 0
						: this.currentTitleIndex - (this.to - stepCount);
			}
			this.$_resetPrevAndNextWineTitles();
			const self = this;

			this.isLoading = true;
			this.$refs.slotProps.handleSwipeUpList(event, newRange).then(
				(response) => {
					console.log(
						"Debug [WinesSliderComp::handleSwipeUpList] self var: " + self
					);
					console.log(
						"Debug [WinesSliderComp::handleSwipeUpList] self var: " + this
					);
					if (self.isOpen) {
						if (!self.getSliderCursorData) {
							console.error(
								"Error [WinesSliderComp::handleSwipeUpList] Invalid state of the slider"
							);
							self.isError = true;
						} else {
							self.selectedHarvest =
								self.getSliderCursorData.content["harvest"];
						}
					} else {
						self.selectedHarvest = null;
						self.$_resetPrevAndNextWineTitles();
					}
					self.isLoading = false;
					self.$_printSliderControl();
				},
				function (reject) {
					processErrorResponse(reject);
					self.isError = true;
					self.isLoading = false;
				}
			);
		},

		handleSwipeDownList: function (event) {
			"use strict";
			if (!this.$refs.slotProps.handleSwipeDownList) {
				console.error(
					"Error [WinesSliderComp::handleSwipeDownList] Invalid state of the slider: there is no handleSwipeDownList callback"
				);
				self.isError = true;
			} else if (this.from > 0) {
				const step = 2;
				const newRange = SliderHelper.calcSliderSwipeDown({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					itemCount: this.getSliderDataCount,
					step,
					isAutoLoading: false,
				});

				this.$_resetPrevAndNextWineTitles();
				const self = this;

				this.currentTitleIndex =
					this.currentTitleIndex - step < 0 ? 0 : this.currentTitleIndex - step;

				this.isLoading = true;
				this.$refs.slotProps
					.handleSwipeDownList(event, newRange)
					.then((response) => {
						console.log(
							"Debug [WinesSliderComp::handleSwipeDownList] Response self var: " +
								response.self
						);
						if (self.isOpen) {
							if (!self.getSliderCursorData) {
								console.error(
									"Error [WinesSliderComp::handleSwipeDownList] Invalid state of the slider"
								);
								self.isError = true;
							} else {
								self.selectedHarvest =
									self.getSliderCursorData.content["harvest"];
							}
						} else {
							self.selectedHarvest = null;
							self.$_resetPrevAndNextWineTitles();
						}
						self.isLoading = false;
						self.$_printSliderControl();
					})
					.catch((reject) => {
						processErrorResponse(reject);
						self.isError = true;
						self.isLoading = false;
					});
			} else {
				console.error(
					"Error [WinesSliderComp::handleSwipeDownList] Invalid state of the slider"
				);
				this.isError = true;
			}
		},

		$_printSliderControl: function () {
			"use strict";
			console.info("INFO [$_printSliderControl] From " + this.getSliderControlFrom);
			console.info("INFO [$_printSliderControl] To " + this.getSliderControlTo);
			console.info(
				"INFO [$_printSliderControl] Cursor " + this.getSliderControlCursor
			);
		},

		handleTapOnItem: function (event, i) {
			"use strict";

			if (i % 2 !== 0) {
				this.isLeftBgImageHover = false;
				this.isRightBgImageHover = true;
			} else {
				this.isLeftBgImageHover = true;
				this.isRightBgImageHover = false;
			}
		},
	},
};
</script>

<style lang="scss" scoped>
/*
		Arrows
	--------------------- */
.left-grape-arrow-container {
	position: fixed;
	z-index: 4;
	display: flex;
	justify-self: center;
	align-content: center;
	max-width: 5em;
	max-height: 5em;
	padding: 0;
	top: 50%;
	left: 1.2em;
}

.right-grape-arrow-container {
	position: fixed;
	z-index: 4;
	display: flex;
	justify-self: center;
	align-content: center;
	max-width: 5em;
	max-height: 5em;
	padding: 0;
	top: 50%;
	right: 0.5em;
}

.wines-slider {
	display: flex;
	flex: 1 0 auto;
	align-items: center;
	justify-content: center;
	min-width: 100%;
	width: 100%;
}

.wines-img-bg {
	-webkit-transition: all 2s ease;
	-moz-transition: all 0.25s ease;
	transition: all 2s ease;
}

.black-and-white-image {
	opacity: 1;
	filter: grayscale(70%);
	-webkit-filter: grayscale(70%);
}

.no-black-and-white-image {
	opacity: 1;
	filter: grayscale(70%);
	-webkit-filter: grayscale(70%);
}

.harvest-block {
	min-width: 8.5vw;
	/* border: 2px solid #ebcb9a; */
}

.harvest-container {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

/* Transitions */
.bottom-control-items-fade-enter-active {
	transition: opacity 3s ease-in-out;
}

.bottom-control-items-fade-enter
/* .component-fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.bottom-control-items-fade-leave {
	opacity: 0;
	display: none;
}

.bottom-arrow-control-block {
	min-height: 20px;
	height: 20px;
}

/*
* https://www.cssmatic.com/box-shadow
* https://css-tricks.com/almanac/properties/b/box-shadow/#example
*/
/* .wines-bg-filter {
    -webkit-box-shadow: inset 0px 10vh 15vh 100px rgba(0, 0, 0, 0.8);
    -moz-box-shadow: inset 0px 10vh 15vh 100px rgba(0, 0, 0, 0.8);
    box-shadow: inset 0px 10vh 15vh 100px rgba(0, 0, 0, 0.8);
} */

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.wines-slider {
		position: absolute;
		top: 0;
		left: 0;

		max-width: 100%;
		width: 100%;
	}

	.wine-items {
		width: 100%;
		max-width: 100%;
		height: 100%;
		max-height: 100%;
	}

	.wine-items-open {
		width: 100%;
		max-width: 100%;

		height: auto;
		min-height: 100%;
	}

	.bottom-arrow-control-block {
		padding: 0;
	}

	.wine-item-harvest-text,
	.prev-wine-item-terroir-text,
	.next-wine-item-terroir-text {
		font-size: calc(0.7em + 0.3vh);
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.wines-slider {
		height: 100%;
		max-height: 100%;
	}

	.wine-items {
		position: absolute;
		z-index: 3;
		top: 0;
		left: 50vw;
		transform: translate(-50vw, 0);

		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: space-evenly;
		align-content: center;

		overflow-y: hidden;
	}

	.wine-items-open {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: center;
		align-content: center;
	}

	.item-up-bg-image {
		position: absolute;
		top: 0;
		left: 0;
		/* max-height: 60vh; */
		max-height: 55%;
		/* height: 60vh; */
		height: 55%;
		/* max-width: 100vw; */
		max-width: 100%;
		/* width: 100vw; */
		width: 100%;
	}

	.item-down-bg-image {
		position: absolute;
		top: 40vh;
		left: 0;
		max-height: 57%;
		/* min-height: calc(var(--100vh, 1vh) * 55) !important; */
		height: 57%;
		/* height: calc(var(--100vh, 1vh) * 55) !important; */
		min-width: 100%;
		/* min-width: calc(var(--100vw, 1vw) * 100) !important; */
		width: 100%;
		/* width: calc(var(--100vw, 1vw) * 100) !important; */
	}

	.wine-item {
		width: 100%;
		max-width: 100%;

		height: 50%;
		max-height: 50%;
	}

	.wine-item-odd-block {
		min-height: 45%;
	}

	.wine-item-even-block {
		min-height: 40%;
	}

	.wine-item-open {
		display: block;

		width: 100%;
		max-width: 100%;
		min-height: 100vh;
		height: 100vh;

		padding: 0 3vw 0 3vw;
	}

	/*
		Control Navigation
	--------------------- */
	.control-nav {
		position: absolute;
		z-index: 3;
		left: 5%;
		bottom: 7%;

		display: grid;
		grid-template-rows: repeat(4, 1fr);
		grid-row-gap: 0.5em;
		margin: 1.5em auto 0 auto;
		align-items: center;
		justify-content: center;
	}

	.bottom-arrow-control-block {
		padding: 2vh 0 5vh 0;
	}

	.right-arrow {
		margin: auto 0 auto auto;
		max-width: fit-content;
	}

	.left-arrow {
		margin: auto auto auto 0;
		max-width: fit-content;
	}

	.harvest-control-block {
		display: flex;
		flex: 1 0 auto;
		max-width: fit-content;
		margin: 2vh auto;
	}

	.harvest-container {
		/* border: 2px solid #ebcb9a; */
		position: static;
		transform: unset;
		top: unset;
		left: unset;
		display: block;
	}

	.wine-item-harvest-text {
		font-size: calc(1em + 0.3vh);
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
	.wines-slider {
		min-height: 100%;
		height: auto;
	}

	.left-grape-arrow-container,
	.right-grape-arrow-container {
		height: 15vh;
		height: calc(var(--100vh, 1vh) * 15);
		max-height: 15vh;
		max-height: calc(var(--100vh, 1vh) * 15);
		position: absolute;
		z-index: 4;
	}

	.left-grape-arrow-container {
		left: 3vw;
	}

	.right-grape-arrow-container {
		right: 3vw;
	}

	.wine-items {
		position: absolute;
		z-index: 3;

		top: 0;
		left: 50%;
		transform: translate(-50%, 0);

		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: center;
		align-content: center;
	}

	.wine-item-content {
		/* max-height: 90%; */
		height: 90%;
	}

	.wine-item-open {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: space-between;
		height: auto;
	}

	.right-arrow {
		margin: auto 0 auto auto;
		max-width: fit-content;
	}

	.left-arrow {
		margin: auto auto auto 0;
		max-width: fit-content;
	}

	.wine-items-open {
		width: 100%;
		max-width: 100%;

		height: auto;
	}

	.bottom-arrow-control-block {
		padding: 0;
		min-height: 12%;
		min-height: 12vh;
	}

	.harvest-block {
		width: 100%;
		flex-basis: 10%;
		position: relative;
	}

	.harvest-container {
		position: absolute;
		top: unset;
		left: unset;
		bottom: 0;
		right: 0;
		transform: unset;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.bottom-arrow-control-block {
				min-height: calc(var(--100vh, 1vh) * 10);
			}
		}
	}

	/* Chrome only */
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	.prev-wine-item-terroir-text,
	.next-wine-item-terroir-text {
		font-size: calc(0.5em + 0.5vmin);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

/* Desktops, large screens, retina and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* Styles */

	.harvest-block .prev-wine-item-terroir-text,
	.harvest-block .next-wine-item-terroir-text {
		font-size: 1.5em;
		font-size: calc(1em + var(--100nvh) * 0.7);
	}

	.wines-slider {
		flex: 1 0 82%;
		/* max-height: 82%;
		max-height: 82vh;
		max-height: calc(var(--100nvh, 1vh) * 82); */
		height: 82%;
		height: 82vh;
		height: calc(var(--100nvh, 1vh) * 82);
	}

	.wine-items-open {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: flex-start;
		align-content: center;

		width: 100%;
		max-width: 100%;

		height: 95%;
		max-height: 95%;
	}

	.wine-items {
		position: relative;
		z-index: 3;
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: center;
		align-content: center;

		width: 100%;
		max-width: 100%;
	}

	.wine-item {
		width: 50%;
		max-width: 50%;

		height: 100%;
		max-height: 100%;
	}

	.wine-item-open {
		width: 100%;
		max-width: 100%;

		height: 100%;
		max-height: 100%;

		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-evenly;
	}

	.md-up-control-arrow,
	.md-down-control-arrow {
		min-width: 15rem;
		width: 15rem;
		transform: translate(3.15rem, 0);
		-webkit-transition: -webkit-transform 1s;
		transition: -webkit-transform 1s;
		transition: transform 1s;
		transition: transform 1s, -webkit-transform 1s;
	}

	.md-up-control-arrow:hover {
		-webkit-transform: translateZ(0) translate(3.15rem, -1rem);
		transform: translateZ(0) translate(3.15rem, -1rem);
	}

	.md-down-control-arrow:hover {
		-webkit-transform: translateZ(0) translate(3.15rem, 1rem);
		transform: translateZ(0) translate(3.15rem, 1rem);
	}

	.right-arrow {
		margin: auto 1.5vw auto auto;
		margin: auto calc(var(--100nvw, 1vw) * 1.5) auto auto;
		max-width: fit-content;
	}

	.left-arrow {
		margin: auto auto auto 1.5vw;
		margin: auto auto auto calc(var(--100nvw, 1vw) * 1.5);
		max-width: fit-content;
	}

	.harvest-container {
		position: absolute;
		top: unset;
		left: unset;
		bottom: 0;
		right: 0;
		transform: unset;

		margin-bottom: 1em;
		margin-bottom: calc(0.5em + 0.5vmin);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.wines-slider {
				flex: 1 0 80%;
				/* max-height: 80%; */
				/* max-height: 80vh; */
				/* max-height: calc(var(--100nvh, 1vh) * 80); */
				height: 80%;
				height: 80vh;
				height: calc(var(--100nvh, 1vh) * 80);
			}
		}
	}
}

@media only screen and (min-width: 1025px) and (max-height: 1080px) and (orientation: landscape) {
	.harvest-block {
		flex-basis: 15%;
	}
}

@media only screen and (min-width: 1025px) and (max-height: 720px) and (orientation: landscape) {
	.wine-items-open {
		flex: 0 0 90%;
		max-height: 90%;
		height: 90%;
	}
}
</style>
