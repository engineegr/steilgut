<template>
	<div class="tw-flex-grow" v-if="isError">
		<error-comp></error-comp>
	</div>
	<div
		class="control-panel md:tw-flex-grow md:tw-overflow-y-hidden landscape:tw-overflow-y-hidden portrait-fp landscape-fp"
		v-else
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
						<feOffset dy="1" in="SourceAlpha" result="shadowOffsetOuter1" />
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
						<feOffset dy="1" in="SourceAlpha" result="shadowOffsetOuter1" />
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
		<!-- MAIN CONTENT -->
		<div class="left-arrow-container">
			<a class="left-arrow" v-on:click="decreaseCursor($event)">
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

		<main role="main" class="announcement-main transit-flex-box">
			<transition-group
				tag="div"
				name="announce-fade"
				class="transit-flex-box main-container tw-w-full tw-max-w-full md:tw-max-h-fit-content landscape:tw-max-h-full"
			>
				<div
					:key="`announcementBlock_key_0`"
					v-if="getTumbler[0].turnOn"
					class="announcement-block"
				>
					<article
						class="announcement-article"
						v-on:click="handleOnClickArticle"
					>
						<div class="announcement-header">
							<h1 class="announcement-header-text">
								{{ __("controlPanel.harvestingEndTitle") }}
							</h1>
						</div>
						<div
							class="announcement-header-link"
							v-if="getTumbler[0].linkUrl"
						>
							<section class="announcement-link-text">
								{{ __("controlPanel.harvestingEndUrlTitle") }}
							</section>
							<div class="announcement-right-arrow">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="39"
									height="14"
									viewBox="0 0 39 14"
								>
									<path
										fill="#FFF"
										d="M37.6254613,6.06365414 C37.6254613,5.91659598 37.5648891,5.7761307 37.4640728,5.6703697 L32.0117494,0.162968165 C31.7963815,-0.0545973389 31.4477364,-0.054047931 31.232918,0.162968165 C31.0175501,0.379984262 31.0175501,0.732475174 31.232918,0.949491271 L35.7455708,5.50733292 L0.550781359,5.50733292 C0.246775688,5.5073787 0,5.75630624 0,6.06365414 C0,6.37100204 0.246775688,6.61997536 0.550781359,6.61997536 L35.7450214,6.61997536 L31.232918,11.177817 C31.0175501,11.3948331 31.0180995,11.747324 31.232918,11.9643401 C31.4482858,12.1813562 31.7969309,12.1813562 32.0117494,11.9643401 L37.4640728,6.45693858 C37.5670409,6.3528258 37.6238131,6.20961349 37.6254613,6.06365414 Z"
										transform="translate(.111 .778)"
									/>
								</svg>
							</div>
						</div>
					</article>
					<!-- Control navigation  -->
					<div class="control-nav">
						<button
							:key="index"
							v-for="(item, index) in getTumbler"
							:class="[
								'tw-rounded-full',
								'tw-h-3',
								'tw-w-3',
								'tw-border',
								'tw-appearance-none',
								'focus:tw-outline-none',
								'focus:tw-shadow-outline',
								'focus:tw-border-none',
								'tw-border-white',
								'hover:tw-bg-white',
								{ 'tw-bg-white': getTumbler[index].turnOn },
							]"
							v-on:click="handleControlNavClick($event, index)"
						></button>
					</div>
				</div>

				<div
					:key="`announcementBlock_key_1`"
					v-if="getTumbler[1].turnOn"
					class="video tw-min-h-screen tw-min-w-screen tw-h-screen tw-w-screen"
				>
					<full-video-screen-comp
						class="tw-relative tw-z-2"
					></full-video-screen-comp>
					<background-shadow-comp zIndexClass="tw-z-1"></background-shadow-comp>

					<div :key="`announcementBlock_key_1`" class="video-control-nav">
						<button
							:key="index"
							v-for="(item, index) in getTumbler"
							:class="[
								'tw-rounded-full',
								'tw-h-3',
								'tw-w-3',
								'tw-border',
								'tw-appearance-none',
								'focus:tw-outline-none',
								'focus:tw-shadow-outline',
								'focus:tw-border-none',
								'tw-border-white',
								'hover:tw-bg-white',
								{ 'tw-bg-white': getTumbler[index].turnOn },
							]"
							v-on:click="handleControlNavClick($event, index)"
						></button>
					</div>
				</div>

				<div
					:key="`announcementBlock_key_2`"
					v-if="getTumbler[2].turnOn"
					class="announcement-block"
				>
					<article
						class="announcement-article"
						v-on:click="handleOnClickArticle"
					>
						<div class="announcement-header">
							<h1 class="announcement-header-text">
								{{ __("controlPanel.steilgutWineTitle") }}
							</h1>
						</div>
						<div
							class="announcement-header-link"
							v-if="getTumbler[2].linkUrl"
						>
							<section class="announcement-link-text">
								{{ __("controlPanel.steilgutWineUrlTitle") }}
							</section>
							<div class="announcement-right-arrow">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="39"
									height="14"
									viewBox="0 0 39 14"
								>
									<path
										fill="#FFF"
										d="M37.6254613,6.06365414 C37.6254613,5.91659598 37.5648891,5.7761307 37.4640728,5.6703697 L32.0117494,0.162968165 C31.7963815,-0.0545973389 31.4477364,-0.054047931 31.232918,0.162968165 C31.0175501,0.379984262 31.0175501,0.732475174 31.232918,0.949491271 L35.7455708,5.50733292 L0.550781359,5.50733292 C0.246775688,5.5073787 0,5.75630624 0,6.06365414 C0,6.37100204 0.246775688,6.61997536 0.550781359,6.61997536 L35.7450214,6.61997536 L31.232918,11.177817 C31.0175501,11.3948331 31.0180995,11.747324 31.232918,11.9643401 C31.4482858,12.1813562 31.7969309,12.1813562 32.0117494,11.9643401 L37.4640728,6.45693858 C37.5670409,6.3528258 37.6238131,6.20961349 37.6254613,6.06365414 Z"
										transform="translate(.111 .778)"
									/>
								</svg>
							</div>
						</div>
					</article>
					<div class="control-nav">
						<button
							:key="index"
							v-for="(item, index) in getTumbler"
							:class="[
								'tw-z-3',
								'tw-relative',
								'tw-rounded-full',
								'tw-h-3',
								'tw-w-3',
								'tw-border',
								'tw-appearance-none',
								'focus:tw-outline-none',
								'focus:tw-shadow-outline',
								'focus:tw-border-none',
								'tw-border-white',
								'hover:tw-bg-white',
								{ 'tw-bg-white': getTumbler[index].turnOn },
							]"
							v-on:click="handleControlNavClick($event, index)"
						></button>
					</div>
				</div>

				<div
					class="announcement-block"
					:key="`announcementBlock_key_3`"
					v-if="getTumbler[3].turnOn"
				>
					<article
						class="announcement-article"
						v-on:click="handleOnClickArticle"
					>
						<div class="announcement-header">
							<h1 class="announcement-header-text">
								{{ __("controlPanel.underTheWeatherTitle") }}
							</h1>
						</div>

						<div class="announcement-header-link">
							<section class="announcement-link-text">
								{{ __("controlPanel.underTheWeatherUrlTitle") }}
							</section>
							<div class="announcement-right-arrow">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="39"
									height="14"
									viewBox="0 0 39 14"
								>
									<path
										fill="#FFF"
										d="M37.6254613,6.06365414 C37.6254613,5.91659598 37.5648891,5.7761307 37.4640728,5.6703697 L32.0117494,0.162968165 C31.7963815,-0.0545973389 31.4477364,-0.054047931 31.232918,0.162968165 C31.0175501,0.379984262 31.0175501,0.732475174 31.232918,0.949491271 L35.7455708,5.50733292 L0.550781359,5.50733292 C0.246775688,5.5073787 0,5.75630624 0,6.06365414 C0,6.37100204 0.246775688,6.61997536 0.550781359,6.61997536 L35.7450214,6.61997536 L31.232918,11.177817 C31.0175501,11.3948331 31.0180995,11.747324 31.232918,11.9643401 C31.4482858,12.1813562 31.7969309,12.1813562 32.0117494,11.9643401 L37.4640728,6.45693858 C37.5670409,6.3528258 37.6238131,6.20961349 37.6254613,6.06365414 Z"
										transform="translate(.111 .778)"
									/>
								</svg>
							</div>
						</div>
					</article>
					<!-- Control navigation  -->
					<div class="control-nav">
						<button
							:key="index"
							v-for="(item, index) in getTumbler"
							:class="[
								'tw-z-3',
								'tw-rounded-full',
								'tw-h-3',
								'tw-w-3',
								'tw-border',
								'tw-appearance-none',
								'focus:tw-outline-none',
								'focus:tw-shadow-outline',
								'focus:tw-border-none',
								'tw-border-white',
								'hover:tw-bg-white',
								{ 'tw-bg-white': getTumbler[index].turnOn },
							]"
							v-on:click="handleControlNavClick($event, index)"
						></button>
					</div>
					<!-- <button
                        class="control-panel-2nd4th-bg-filter tw-fixed tw-z-2 tw-inset-0 tw-h-full tw-w-full tw-opacity-50 focus:tw-outline-none tw-cursor-default"
                    ></button> -->
				</div>

				<div
					:key="`announcementBlock_key_4`"
					v-if="getTumbler[4].turnOn"
					class="announcement-block"
				>
					<article
						class="announcement-article"
						v-on:click="handleOnClickArticle"
					>
						<div class="announcement-header">
							<h1 class="announcement-header-text">
								{{ __("controlPanel.tastingSubscribeTitle") }}
							</h1>
						</div>
						<div
							class="announcement-header-link"
							v-if="getTumbler[4].linkUrl"
						>
							<section class="announcement-link-text">
								{{ __("controlPanel.tastingSubscribeUrlTitle") }}
							</section>
							<div class="announcement-right-arrow">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="39"
									height="14"
									viewBox="0 0 39 14"
								>
									<path
										fill="#FFF"
										d="M37.6254613,6.06365414 C37.6254613,5.91659598 37.5648891,5.7761307 37.4640728,5.6703697 L32.0117494,0.162968165 C31.7963815,-0.0545973389 31.4477364,-0.054047931 31.232918,0.162968165 C31.0175501,0.379984262 31.0175501,0.732475174 31.232918,0.949491271 L35.7455708,5.50733292 L0.550781359,5.50733292 C0.246775688,5.5073787 0,5.75630624 0,6.06365414 C0,6.37100204 0.246775688,6.61997536 0.550781359,6.61997536 L35.7450214,6.61997536 L31.232918,11.177817 C31.0175501,11.3948331 31.0180995,11.747324 31.232918,11.9643401 C31.4482858,12.1813562 31.7969309,12.1813562 32.0117494,11.9643401 L37.4640728,6.45693858 C37.5670409,6.3528258 37.6238131,6.20961349 37.6254613,6.06365414 Z"
										transform="translate(.111 .778)"
									/>
								</svg>
							</div>
						</div>
					</article>
					<!-- Control navigation  -->
					<div class="control-nav">
						<button
							:key="index"
							v-for="(item, index) in getTumbler"
							:class="[
								'tw-rounded-full',
								'tw-h-3',
								'tw-w-3',
								'tw-border',
								'tw-appearance-none',
								'focus:tw-outline-none',
								'focus:tw-shadow-outline',
								'focus:tw-border-none',
								'tw-border-white',
								'hover:tw-bg-white',
								{ 'tw-bg-white': getTumbler[index].turnOn },
							]"
							v-on:click="handleControlNavClick($event, index)"
						></button>
					</div>
				</div>
			</transition-group>
		</main>

		<div class="right-arrow-container">
			<a class="right-arrow" v-on:click="increaseCursor($event)">
				<!-- <svg>
					<g><line x1="0" x2="25" y1="31.28" y2="31.28"></line>
						<polyline points="20 25 25 31.28 20 37.56">
						</polyline>
					</g>
				</svg> -->
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
		<!-- END MAIN CONTENT -->
	</div>
</template>

<script>
import MainAnnouncementComp from "./MainAnnouncementComp.vue";
import mediaHelper from "../shared/mixins/mediaHelper";
import fullscreenCorrector from "../shared/mixins/fullscreenCorrector";
import BackgroundShadowComp from "../shared/components/BackgroundShadowComp";

export default {
	mixins: [mediaHelper, fullscreenCorrector],

	computed: {
		getTumbler: function () {
			return this.$_getTumbler();
		},

		getVideoClass: function () {
			return this.isVideoOpacity ? "opacity-video" : "no-opacity-video";
		},
	},

	data: function () {
		return {
			isVideoOpacity: true,
			/* Use for Landscape/Portratit scroll*/
			startClientX: -1,

			isError: false,
		};
	},

	created() {
		("use strict");
		if (this.isMobileDevice()) {
			document.addEventListener(
				"touchstart",
				this.$_handleTouchStart,
				{
					passive: false,
				},
				false
			);
			document.addEventListener(
				"touchmove",
				this.$_handleMove,
				{
					passive: false,
				},
				false
			);
		}
	},

	destroyed() {
		("use strict");
		if (this.isMobileDevice()) {
			document.removeEventListener("touchstart", this.$_handleTouchStart);
			document.removeEventListener("touchmove", this.$_handleMove);
		}
	},

	components: {
		"main-announcement": MainAnnouncementComp,
		"background-shadow-comp": BackgroundShadowComp,
	},

	methods: {
		increaseCursor: function (event) {
			const aTumbler = this.$_getTumbler();
			let aCursor = this.$_getCursor();

			aTumbler[aCursor].turnOn = false;
			let max = aTumbler.length - 1;
			this.$_setCursor(++aCursor > max ? 0 : aCursor);
			aTumbler[this.$_getCursor()].turnOn = true;
			this.$emit("switch-tumbler", event);
		},

		decreaseCursor: function () {
			const aTumbler = this.$_getTumbler();
			let aCursor = this.$_getCursor();

			aTumbler[aCursor].turnOn = false;
			let max = aTumbler.length - 1;
			this.$_setCursor(--aCursor < 0 ? max : aCursor);
			aTumbler[this.$_getCursor()].turnOn = true;
			this.$emit("switch-tumbler", event);
		},

		handleControlNavClick: function (event, next_i) {
			const aTumbler = this.$_getTumbler();
			let aCursor = this.$_getCursor();
			if (next_i != aCursor) {
				aTumbler[aCursor].turnOn = false;
				aTumbler[next_i].turnOn = true;
				this.$_setCursor(next_i);
				this.$emit("switch-tumbler", event);
			}
		},

		handleOnVideoClick: function () {
			this.isVideoOpacity = !this.isVideoOpacity;
		},

		handleOnClickArticle: function (event) {
			try {
				const tumbler = this.$_getTumbler();
				let cursor = this.$_getCursor();
				this.$router.push({
					path: tumbler[cursor].linkUrl,
				});
			} catch (error) {
				this.isError = true;
				console.error(
					"ControlPanelComp [handleOnClickArticle] Error occurred " + error
				);
			}
		},

		$_getTumbler: function () {
			return this.$root.$data.stateStore.controlPanelTumbler;
		},

		$_getCursor: function () {
			return this.$root.$data.stateStore.controlPanelCursor;
		},
		$_setCursor: function (aCursor) {
			this.$root.$data.stateStore.controlPanelCursor = aCursor;
		},

		$_handleTouchStart: _.throttle(
			function (event) {
				// debugger;
				// console.log(
				//     "Debug [storeBasketSliderMixin listener: document => $_handleTouchStart]"
				// );
				if (
					this.isMobileDevice() &&
					event.touches &&
					event.touches.length === 1
				) {
					this.startClientX = event.touches[0].clientX;
					// event.preventDefault();
				}
			},
			{
				leading: true,
				trailing: true,
			},
			50
		),

		$_handleMove: _.throttle(
			function (event) {
				// debugger;
				// console.log(
				//     "Debug [storeBasketSliderMixin listener: document => touchMove]"
				// );
				// Loading if we are at the page bottom

				if (
					this.isMobileDevice() &&
					event.touches &&
					event.touches.length === 1 &&
					this.startClientX > 0
				) {
					let deltaX = this.startClientX - event.touches[0].clientX;
					deltaX = deltaX < 0 ? deltaX * -1 : deltaX;
					if (deltaX > 33) {
						const swipeLeft = this.startClientX > event.touches[0].clientX;
						if (swipeLeft) {
							this.increaseCursor();
						} else {
							this.decreaseCursor();
						}
						this.startClientX = -1;
					}
				}
			},
			{
				leading: true,
				trailing: false,
			},
			50
		),
	},
};
</script>
<style lang="scss" scoped>
.announce-fade-enter-active {
	transition: opacity 3s ease;
}

.announce-fade-enter
/* .component-fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.announce-fade-leave {
	opacity: 0;
	display: none;
}

/* Control Navigation
    --------------------- */
.control-panel {
	flex-grow: 1;
}

.control-panel .control-nav {
	display: grid;
}

/* Article
	----------- */
.control-panel .announcement {
	flex-direction: column;
	margin: auto;
}

.left-arrow-container,
.right-arrow-container {
	display: none;
	z-index: 4;
}

.announcement-main {
	display: flex;
	justify-content: flex-start;
	align-items: center;
}

.control-panel article.announcement-article {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	cursor: pointer;

	&:hover {
		.announcement-right-arrow {
			transform: translateX(50%);
		}
	}
}

.control-panel article.announcement-article .announcement-right-arrow {
	transition: all 0.5s ease-in-out;
}

article.announcement-article .announcement-header-link {
	display: flex;
	flex-direction: row;
	justify-content: space-between;
	align-items: center;
}

article.announcement-article .announcement-link-text {
	padding-right: 1em;
}

article.announcement-article .announcement-header {
	max-width: 27rem;
}

.opacity-video {
	/*to edit the opacity effect change the percentage below */
	filter: opacity(30%);
}

.no-opacity-video {
	/*to edit the opacity effect change the percentage below */
	filter: opacity(100%);
}

.video {
	position: fixed;
	top: 0;
	left: 0;
	/* It is set to 9 unless it overflows the navigation bar (z-index = 10) */
	z-index: 3;
}

.video-control-nav {
	position: absolute;
	top: 65%;
	left: 10em;
	display: flex;
	flex-direction: column;
	z-index: 2;
}

.video-control-nav > button {
	margin-bottom: 0.5em;
}

.video-control-nav > button:last-child {
	margin-bottom: 0;
}

/*
 * see more https://medium.com/@stasonmars/viewport-%D0%B5%D0%B4%D0%B8%D0%BD%D0%B8%D1%86%D1%8B-%D0%B2-css-52c2b029f8b9 
 */
article .announcement-header h1.announcement-header-text {
	font-size: calc(1em + 2vh);
	margin-top: 0;
}

article .announcement-header section.announcement-link-text {
	font-size: calc(0.8em + 2vh);
}

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	/* Control Panel
		-----------------
		*/
	.control-panel {
		display: flex;
		flex-grow: 1;
		flex: 1 0 auto;
		justify-content: center;
		align-content: center;
		flex: 1 0 80%;
		max-height: 80%;
		height: 80%;

		width: 100vw;
		min-width: 100vw;
	}

	.main-container {
		height: 100%;
		max-height: 100%;
	}

	.announcement-main {
		flex: 1 0 100%;
		max-height: 100%;
	}

	.announcement-block {
		display: flex;
		flex: 1 0 100%;
		max-height: 100%;
		flex-direction: column;
		justify-content: center;

		margin: auto auto auto 2rem;
	}

	article.announcement-article {
		border-left: 1px solid #b6afaf;
		max-width: 90vw;
		margin: 0;
		padding: 0;
	}

	article.announcement-article .announcement-header {
		margin: 0 0 8em 0;
		padding: 0 0 0 5%;
	}

	article.announcement-article .announcement-header-link {
		padding: 0 0 0 5%;
		max-width: 85%;
		width: 85%;
	}

	/*
		Control Navigation
	--------------------- */
	.control-nav {
		display: grid;
		grid-template-columns: repeat(5, 1fr);
		grid-column-gap: 0.5em;
		margin: 1.5em auto 0 auto;
		align-items: center;
		justify-content: center;
	}

	.video-control-nav {
		left: 15vw;
	}

	.video-control-nav > button {
		margin-bottom: 1vh;
	}

	div.footer-container-class {
		display: none;
	}

	.video {
		min-width: 100vw;
	}

	.video-announcement-block {
		position: absolute;
		z-index: 3;
		top: 50vh;
		left: 50vw;
		transform: translate(-30vw, -30vh);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.control-panel {
				flex: 1 0 calc(var(--100vh, 1vh) * 80);
				max-height: calc(var(--100vh, 1vh) * 80);
				height: calc(var(--100vh, 1vh) * 80);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-device-height: 640px) and (orientation: portrait) {
	article .announcement-header h1.announcement-header-text {
		font-size: calc(0.8em + 2vw);
	}

	article.announcement-article .announcement-link-text {
		font-size: calc(0.7em + 1vw);
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	/*
		Control Navigation
	--------------------- */
	.control-panel {
		position: absolute;
		display: flex;
		flex: 1 0 100%;
		justify-content: center;
		align-content: center;

		width: 100vw;
		max-width: 100vw;
		min-width: 100vw;

		max-height: 100%;
		max-height: 100vh;
		max-height: calc(var(--100vh, 1vh) * 100);

		height: 100%;
		height: 100vh;
		height: calc(var(--100vh, 1vh) * 100);
	}

	/*
		Arrows
	--------------------- */
	.left-arrow-container {
		position: fixed;
		display: flex;
		justify-self: center;
		align-content: center;
		max-width: 5em;
		max-height: 5em;
		padding: 0;
		top: 50%;
		left: 0.5em;
	}

	.right-arrow-container {
		position: fixed;
		display: flex;
		justify-self: center;
		align-content: center;
		max-width: 5em;
		max-height: 5em;
		padding: 0;
		top: 50%;
		right: 0.5em;
	}

	.right-arrow-container {
		margin: auto 0 auto 0;
	}

	.announcement-main {
		flex-grow: 1;
	}

	.announcement-block {
		display: flex;
		flex: 0 0 80%;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		margin: auto auto auto calc(6px + 20vw);
		width: fit-content;
	}

	.control-panel article.announcement-article {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: space-evenly;
		padding: 0 0 0 5vw;
	}

	h1.announcement-header-text {
		font-size: calc(1em + 2vh);
		margin-top: 0;
	}

	section.announcement-link-text {
		font-size: calc(0.8em + 2vh);
		font-size: calc(var(--100vh, 1vh) * 5);
	}

	article.announcement-article {
		border-left: 1px solid #b6afaf;
	}

	article.announcement-article .announcement-header {
		margin: 0 auto auto 0;
	}

	article.announcement-article .announcement-header-text {
		margin: 0;
	}

	article.announcement-article .announcement-header-link {
		max-width: 30vw;
	}

	/* Control Navigation
		--------------------- */
	.control-nav {
		margin: 7vh auto 0 0;
		margin: calc(var(--100vh, 1vh) * 10) auto 0 0;
		justify-content: center;
		flex-direction: row;
		grid-template-columns: repeat(5, 1fr);
		grid-template-rows: 1fr;
		align-self: flex-start;
	}

	.control-nav button:last-child {
		margin-right: auto;
	}

	.control-nav button {
		margin-right: 1vw;
	}

	.video-control-nav {
		flex-direction: row;
		top: 77%;
		top: calc(var(--100vh, 1vh) * 77);
	}

	.video-control-nav > button {
		margin-right: 1vw;
	}

	.video-control-nav > button:last-child {
		margin-right: 0;
	}

	article .announcement-header h1.announcement-header-text {
		font-size: calc(0.9em + 1vh);
	}

	article.announcement-article .announcement-link-text {
		font-size: calc(0.7em + 0.7vh);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			/*
                Arrows
            --------------------- */
			.left-arrow-container {
				top: 50%;
				top: calc(var(--100vh, 1vh) * 50);
			}

			.right-arrow-container {
				top: 50%;
				top: calc(var(--100vh, 1vh) * 50);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-device-height: 692px) and (orientation: landscape) {
	.video-control-nav {
		top: 57%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.announcement-block {
				max-height: 65%;
				max-height: calc(var(--100vh, 1vh) * 65);
				height: 65%;
				height: calc(var(--100vh, 1vh) * 65);
			}
			.video-control-nav {
				top: 57%;
				top: calc(var(--100vh, 1vh) * 77);
			}
		}
	}
}

@media only screen and (min-width: 1025px) and (min-height: 120px) and (max-height: 600px) {
	/* Control Navigation
		--------------------- */
	.control-nav {
		margin: 7vmin auto 0 0;
		justify-content: center;
		flex-direction: row;
		grid-template-columns: repeat(5, 1fr);
		grid-template-rows: 1fr;
		align-self: flex-start;
	}

	.control-nav > button {
		margin-right: 0.5em;
	}

	.control-nav > button:last-child {
		margin-right: 0;
	}
}

@media only screen and (min-width: 1025px) and (min-height: 601px) and (orientation: landscape) {
	/* Control Navigation
		--------------------- */
	.control-nav {
		margin: calc(2em + 2vh) auto 0 -0.35em;
		max-width: 4em;
		justify-content: center;
		flex-direction: column;
		grid-template-rows: repeat(5, 1fr);
		grid-template-columns: 1fr;
		grid-row-gap: 0.5em;
		align-self: flex-start;
	}
}

/* Desktops, large screen, retina and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/*
		Control Navigation
	--------------------- */
	.control-panel {
		display: flex;
		flex: 1 1 auto;
		flex-direction: row;
		justify-content: flex-start;
		align-content: center;
		min-height: 80%;
		min-height: 80vh;
		/* min-height: calc(var(--100nvh,1vh)*80); */
		max-height: unset;
		min-width: 100%;
	}

	/*
		Arrows
	--------------------- */
	.left-arrow-container {
		position: absolute;
		z-index: 5;
		display: flex;
		justify-self: center;
		align-content: center;
		max-width: 40px;
		width: 40px;
		max-height: 43px;
		height: 43px;
		padding: 0;
		top: 50%;
		left: 2%;

		transform: translate(-2%, -50%);
	}

	.right-arrow-container {
		position: absolute;
		z-index: 5;
		display: flex;
		justify-self: center;
		align-content: center;
		max-width: 40px;
		width: 40px;
		max-height: 43px;
		height: 43px;
		padding: 0;
		top: 50%;
		right: 2%;

		transform: translate(-50%, -2%);
	}

	.right-arrow-container {
		margin: auto 0 auto 0;
	}

	.announcement {
		margin: auto;
	}

	.announcement-block {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		margin: auto 0 auto 10em;
		height: 60%;
		max-height: 60%;
	}

	.control-panel article.announcement-article {
		padding: 0 0 0 2.6em;
	}

	article.announcement-article {
		border-left: 1px solid #b6afaf;
		min-width: 20em;
		margin: auto auto auto 0;
	}

	article.announcement-article .announcement-header {
		margin: 0 0 4em 0;
	}

	article.announcement-article .announcement-header {
		margin: 0 0 8em 0;
	}

	.main-container {
		margin: auto 0;
	}
}
</style>
