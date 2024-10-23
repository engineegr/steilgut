<template>
	<div class="order portrait-non-fp landscape-non-fp">
		<div class="md:tw-block tw-hidden landscape:tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="desktop-bg-order-pg-img"
				relativePath="order-pg"
				baseName="bg-order-pg"
				lqipPath_4_3="/images/4_3/order-pg/lqip_4_3/jpg/4_3-lqip-bg-order-pg.jpg"
				lqipPath_16_9="/images/16_9/order-pg/lqip_16_9/jpg/16_9-lqip-bg-order-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-absolute tw-object-cover tw-inset-0 img-fp"
				isDesktopAspectRatioCorrection="true"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
			></lazy-load-image-comp>
		</div>

		<div class="md:tw-hidden">
			<div class="landscape:tw-block tw-hidden md:tw-hidden">
				<lazy-load-image-comp
					basedLazyImgStyleClass="landscape-bg-order-pg-img"
					relativePath="order-pg"
					baseName="bg-order-pg"
					lqipPath_4_3="/images/4_3/order-pg/lqip_4_3/jpg/4_3-lqip-bg-order-pg.jpg"
					lqipPath_16_9="/images/16_9/order-pg/lqip_16_9/jpg/16_9-lqip-bg-order-pg.jpg"
					lazyLoadCommonImgStyleClass="tw-fixed tw-z-0 tw-inset-0 tw-object-cover tw-max-w-full tw-w-full img-fp"
					lazyLoadImgStyleClass_4_3=""
					lazyLoadImgStyleClass_16_9=""
					basedLandscapeLazyImgStyleClass=""
					commonImgStyleClass=""
					:isBackgroundShadow="false"
					:isLandscapeBackgroundShadow="false"
					:isPortraitBackgroundShadow="false"
				></lazy-load-image-comp>
				<background-shadow-comp class="tw-fixed" zIndexClass="tw-z-1">
				</background-shadow-comp>
			</div>

			<div class="tw-block landscape:tw-hidden tw-relative md:tw-hidden">
				<lazy-load-image-comp
					basedLazyImgStyleClass="portrait-bg-news-pg-img"
					relativePath="order-pg/order-pg-up-side"
					baseName="bg-order-up-side"
					lqipPath_portrait="/images/mobile/order-pg/portrait-lqip-bg-order-up-side.jpg"
					basedPortraitLazyImgStyleClass="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
					lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
					lazyLoadCommonImgStyleClass=""
					imgExt_portrait="jpg"
					isHiddenLandscape="true"
					isHiddenDesktop="true"
				></lazy-load-image-comp>

				<div
					class="header-underline tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4"
				>
					<h1
						class="header-text"
						v-if="
							isSummaryPaymentMode &&
							isActivePagePath('/masthead/order/payment')
						"
					>
						{{ __("order.summaryHeader") }}
					</h1>
					<h1
						class="header-text"
						v-else-if="
							isInitialPaymentMode &&
							isActivePagePath('/masthead/order/payment')
						"
					>
						{{ __("order.paymentSelectionHeader") }}
					</h1>
					<h1 class="header-text" v-else>{{ __("order.header") }}</h1>
					<div class="title-underline">
						<img
							class="title-underline-img"
							src="/images/icons/cart-pg/white-header-underscore-line.svg"
						/>
					</div>
				</div>
			</div>
		</div>

		<div
			class="order-body tw-relative tw-z-4 tw-flex md:tw-h-full"
			:key="orderBodyUpdateKey"
		>
			<div
				class="transit-flex-box md:tw-flex md:tw-max-h-full tw-hidden landscape:tw-flex"
				v-if="
					(isMobileDevice() && isLandscapeOrientation()) ||
					(!isMobileDevice() && !isBrowserPortraitOrientation())
				"
			>
				<div class="order-header tw-flex">
					<section class="header-paragraph">
						<div class="header-underline">
							<h1
								class="header-text"
								v-if="
									isSummaryPaymentMode &&
									isActivePagePath('/masthead/order/payment')
								"
							>
								{{ __("order.summaryHeader") }}
							</h1>
							<h1
								class="header-text"
								v-else-if="
									isInitialPaymentMode &&
									isActivePagePath('/masthead/order/payment')
								"
							>
								{{ __("order.paymentSelectionHeader") }}
							</h1>
							<h1 class="header-text" v-else>{{ __("order.header") }}</h1>
							<img
								class="title-underline-img"
								src="/images/icons/basket-pg/header-underscore-line.svg"
							/>
						</div>
					</section>
				</div>

				<div class="order-main tw-flex" :key="orderMainUpdateKey">
					<router-view
						idp="landscape0-desktop0-"
						:deliveryOptionList="deliveryOptionList"
						:paymentOptionList="paymentOptionList"
						:orderDetails="orderDetails"
						:goFromSummaryToFinallizationBtnLinkId="`landscape0-desktop0-${goFromSummaryToFinallizationBtnLinkId}`"
						:isInitialModeProp="isInitialPaymentMode"
						:isSummaryModeProp="isSummaryPaymentMode"
						v-on:delivery-auc-address-change="handleAucAddress"
						v-on:personal-attr-change="handlePersonalAttributeChange"
						v-on:delivery-options-change="handleDeliveryOptionClick"
						v-on:payment-options-change="handlePaymentOptionClick"
						v-on:on-payment-validation-check="handlePaymentValidationCheck"
					>
					</router-view>
				</div>

				<div class="order-footer tw-flex tw-border-mt-bg-brown tw-border-t">
					<router-link
						v-if="isActivePagePath('/masthead/order/delivery')"
						class="goto-back-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
						:to="prevRoute"
					>
						<!-- Go to back arrow -->
						<svg
							width="18px"
							height="14px"
							class="goto-back-arrow"
							viewBox="0 0 18 14"
							version="1.1"
							xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink"
						>
							<title>Back arrow</title>
							<path
								d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
								transform="translate(8.812731, 6.452851) scale(-1, 1) translate(-8.812731, -6.452851) "
							></path>
						</svg>
						<span class="goto-back-container">
							<h2 class="goto-back-text">
								{{ __("order.back") }}
							</h2>
						</span>
					</router-link>
					<button
						typw="button"
						v-if="isActivePagePath('/masthead/order/payment')"
						class="goto-back-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
						v-on:click.stop="handlePaymentBackClick"
					>
						<!-- Go to back arrow -->
						<svg
							width="18px"
							height="14px"
							class="goto-back-arrow"
							viewBox="0 0 18 14"
							version="1.1"
							xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink"
						>
							<title>Back arrow</title>
							<path
								d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
								transform="translate(8.812731, 6.452851) scale(-1, 1) translate(-8.812731, -6.452851) "
							></path>
						</svg>
						<span class="goto-back-container">
							<h2 class="goto-back-text">
								{{ __("order.back") }}
							</h2>
						</span>
					</button>
					<span class="summary-title">
						<h1 class="summary-text">
							{{ __("order.summary") }}:
							{{
								$root.helper.getCommaSeparatorDecimal(
									orderDetails.summaryPrice +
										(orderDetails.deliveryPrice > 0
											? orderDetails.deliveryPrice
											: 0)
								)
							}}
							€
						</h1>
					</span>
					<router-link
						v-if="isActivePagePath('/masthead/order/delivery')"
						class="goto-next-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
						:to="{
							name: 'payment',
							params: {
								orderDetails,
								isInitialMode: isInitialPaymentMode,
								isSummaryMode: isSummaryPaymentMode,
							},
						}"
						><span class="goto-next-container">
							<h2 class="goto-next-text">
								{{ __("order.gotoPay") }}
							</h2>
						</span>
						<!-- Go to order pay (next) arrow -->
						<svg
							width="18px"
							height="14px"
							viewBox="0 0 18 14"
							version="1.1"
							xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink"
							class="goto-pay-arrow"
						>
							<title>Next Arrow</title>

							<path
								d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
							></path>
						</svg>
					</router-link>

					<button
						type="button"
						v-if="
							isActivePagePath('/masthead/order/payment') &&
							isInitialPaymentMode
						"
						class="goto-next-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
						:class="{
							'disabled-element': isPaymentValidationError,
							'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': !isPaymentValidationError,
						}"
						v-on:click.stop="handlePaymentToSummaryClick"
					>
						<span class="goto-next-container">
							<h2 class="goto-next-text">
								{{ __("order.goToSummary") }}
							</h2>
						</span>
						<!-- Go to order summary (next) arrow -->
						<svg
							width="18px"
							height="14px"
							viewBox="0 0 18 14"
							version="1.1"
							xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink"
							class="goto-pay-arrow"
							:class="{ 'disabled-element': isPaymentValidationError }"
						>
							<title>Next Arrow</title>

							<path
								d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
							></path>
						</svg>
					</button>

					<button
						:id="`landscape0-desktop0-${goFromSummaryToFinallizationBtnLinkId}`"
						type="button"
						v-show="
							isActivePagePath('/masthead/order/payment') &&
							isSummaryPaymentMode
						"
						class="goto-next-btn tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
					>
						<span class="goto-next-container">
							<h2 class="goto-next-text">
								{{ __("order.createOrderTitle") }}
							</h2>
						</span>
						<!-- Go to order summary (next) arrow -->
						<svg
							width="18px"
							height="14px"
							viewBox="0 0 18 14"
							version="1.1"
							xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink"
							class="goto-pay-arrow"
						>
							<title>Next Arrow</title>

							<path
								d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
							></path>
						</svg>
					</button>
				</div>
			</div>

			<div
				class="transit-flex-box tw-flex md:tw-hidden landscape:tw-hidden"
				v-if="
					(isMobileDevice() && isPortraitOrientation()) ||
					(!isMobileDevice() && isBrowserPortraitOrientation())
				"
			>
				<img
					src="/images/mobile/order-pg/order-pg-down-side/portrait/jpg/portrait-bg-order-down-side.jpg"
					srcset="
						/images/mobile/order-pg/order-pg-down-side/portrait/jpg/portrait-bg-order-down-side.jpg,
						/images/mobile/order-pg/order-pg-down-side/portrait/jpg/portrait-2x-bg-order-down-side.jpg 2x
					"
					class="tw-absolute tw-z-1 tw-object-cover tw-w-full tw-max-w-full landscape:tw-hidden"
				/>

				<div
					class="order-main tw-flex tw-relative tw-z-2"
					:key="orderMainUpdateKey"
				>
					<router-view
						idp="portrait0-"
						:deliveryOptionList="deliveryOptionList"
						:paymentOptionList="paymentOptionList"
						:orderDetails="orderDetails"
						:goFromSummaryToFinallizationBtnLinkId="`portrait0-${goFromSummaryToFinallizationBtnLinkId}`"
						:isInitialModeProp="isInitialPaymentMode"
						:isSummaryModeProp="isSummaryPaymentMode"
						v-on:delivery-auc-address-change="handleAucAddress"
						v-on:personal-attr-change="handlePersonalAttributeChange"
						v-on:delivery-options-change="handleDeliveryOptionClick"
						v-on:payment-options-change="handlePaymentOptionClick"
						v-on:on-payment-validation-check="handlePaymentValidationCheck"
					>
					</router-view>
				</div>

				<div
					class="order-footer tw-flex tw-flex-col tw-justify-stretch tw-items-stretch tw-border-mt-bg-brown tw-border-t tw-relative tw-z-2"
				>
					<div class="summary-title">
						<h1
							class="summary-text tw-text-left"
							v-if="orderDetails.summaryPrice > 0"
						>
							{{ __("order.summary") }}:
							{{
								$root.helper.getCommaSeparatorDecimal(
									orderDetails.summaryPrice +
										(orderDetails.deliveryPrice > 0
											? orderDetails.deliveryPrice
											: 0)
								)
							}}
							€
						</h1>
					</div>
					<div
						class="tw-flex tw-flex-row tw-justify-between tw-content-center tw-w-full tw-max-w-full"
					>
						<router-link
							v-if="isActivePagePath('/masthead/order/delivery')"
							class="goto-back-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
							:to="prevRoute"
						>
							<!-- Go to back arrow -->
							<svg
								width="18px"
								height="14px"
								class="goto-back-arrow"
								viewBox="0 0 18 14"
								version="1.1"
								xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink"
							>
								<title>Back arrow</title>
								<path
									d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
									transform="translate(8.812731, 6.452851) scale(-1, 1) translate(-8.812731, -6.452851) "
								></path>
							</svg>
							<span class="goto-back-container">
								<h2 class="goto-back-text">
									{{ __("order.back") }}
								</h2>
							</span>
						</router-link>

						<button
							typw="button"
							v-if="isActivePagePath('/masthead/order/payment')"
							class="goto-back-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
							v-on:click.stop="handlePaymentBackClick"
						>
							<!-- Go to back arrow -->
							<svg
								width="18px"
								height="14px"
								class="goto-back-arrow"
								viewBox="0 0 18 14"
								version="1.1"
								xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink"
							>
								<title>Back arrow</title>
								<path
									d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
									transform="translate(8.812731, 6.452851) scale(-1, 1) translate(-8.812731, -6.452851) "
								></path>
							</svg>
							<span class="goto-back-container">
								<h2 class="goto-back-text">
									{{ __("order.back") }}
								</h2>
							</span>
						</button>

						<router-link
							v-if="isActivePagePath('/masthead/order/delivery')"
							class="goto-next-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
							:to="{
								name: 'payment',
								params: {
									orderDetails,
									isInitialMode: isInitialPaymentMode,
									isSummaryMode: isSummaryPaymentMode,
								},
							}"
							><span class="goto-next-container">
								<h2 class="goto-next-text">
									{{ __("order.gotoPay") }}
								</h2>
							</span>
							<!-- Go to order pay (next) arrow -->
							<svg
								width="18px"
								height="14px"
								viewBox="0 0 18 14"
								version="1.1"
								xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink"
								class="goto-pay-arrow"
							>
								<title>Next Arrow</title>

								<path
									d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
								></path>
							</svg>
						</router-link>

						<button
							type="button"
							v-if="
								isActivePagePath('/masthead/order/payment') &&
								isInitialPaymentMode
							"
							class="goto-next-btn tw-flex tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown tw-text-mt-bg-brown tw-no-underline hover:tw-no-underline"
							:class="{
								'disabled-element': isPaymentValidationError,
								'hover:tw-border-steilgut-text-gold hover:tw-text-steilgut-text-gold': !isPaymentValidationError,
							}"
							v-on:click.stop="handlePaymentToSummaryClick"
						>
							<span class="goto-next-container">
								<h2 class="goto-next-text">
									{{ __("order.goToSummary") }}
								</h2>
							</span>
							<!-- Go to order summary (next) arrow -->
							<svg
								width="18px"
								height="14px"
								viewBox="0 0 18 14"
								version="1.1"
								xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink"
								class="goto-pay-arrow"
								:class="{ 'disabled-element': isPaymentValidationError }"
							>
								<title>Next Arrow</title>

								<path
									d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
								></path>
							</svg>
						</button>

						<button
							:id="`portrait0-${goFromSummaryToFinallizationBtnLinkId}`"
							type="button"
							v-show="
								isActivePagePath('/masthead/order/payment') &&
								isSummaryPaymentMode
							"
							class="goto-next-btn tw-justify-items-center tw-align-middle tw-bg-transparent tw-border tw-border-mt-bg-brown hover:tw-border-steilgut-text-gold tw-text-mt-bg-brown hover:tw-text-steilgut-text-gold tw-no-underline hover:tw-no-underline"
						>
							<span class="goto-next-container">
								<h2 class="goto-next-text">
									{{ __("order.createOrderTitle") }}
								</h2>
							</span>
							<!-- Go to order summary (next) arrow -->
							<svg
								width="18px"
								height="14px"
								viewBox="0 0 18 14"
								version="1.1"
								xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink"
								class="goto-pay-arrow"
							>
								<title>Next Arrow</title>

								<path
									d="M17.6254613,6.45296067 C17.6254613,6.29651581 17.5648891,6.14708468 17.4640728,6.03457296 L12.0117494,0.175635166 C11.7963815,-0.0558174985 11.4477364,-0.0552330221 11.232918,0.175635166 C11.0175501,0.406503353 11.0175501,0.781493686 11.232918,1.01236187 L15.7455708,5.86112958 L0.550781359,5.86112958 C0.246775688,5.86117829 0,6.12599482 0,6.45296067 C0,6.77992652 0.246775688,7.04479176 0.550781359,7.04479176 L15.7450214,7.04479176 L11.232918,11.8935595 C11.0175501,12.1244277 11.0180995,12.499418 11.232918,12.7302862 C11.4482858,12.9611544 11.7969309,12.9611544 12.0117494,12.7302862 L17.4640728,6.87134838 C17.5670409,6.7605901 17.6238131,6.60823657 17.6254613,6.45296067 Z"
								></path>
							</svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import BackgroundShadowComp from "../../shared/components/BackgroundShadowComp";
import mediaHelper from "../../shared/mixins/mediaHelper";
import validationErrors from "../../shared/mixins/validationErrors";
import routeObserver from "../../shared/mixins/routeObserver";
import { mapGetters, mapState } from "vuex";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";

export default {
	mixins: [mediaHelper, routeObserver, validationErrors, fullscreenCorrector],

	components: {
		"background-shadow-comp": BackgroundShadowComp,
	},

	data: function () {
		return {
			orderMainUpdateKey: "main-order-update-key_0",
			orderBodyUpdateKey: "order-body-update-key_0",
			prevDisplayState: null,

			deliveryOptionList: [
				false, // take the order from the winery
				false, // courier delivery
				true, // post deliver
			],

			paymentOptionList: [
				true, // bank transfer
				false, // card payment
				false, // paypal
			],

			isInitialPaymentMode: true,
			isSummaryPaymentMode: false,

			paymentValidationError: false,
			goFromSummaryToFinallizationBtnLinkId:
				"goFromSummaryToFinallizationBtnLinkId_0",

			orderDetails: {
				summaryPrice: 0,
				deliveryPrice: 0,
				personalData: {
					LFP: "",
					country: this.__("common.Germany"),
					zip: "",
					address: "",
					email: "",
					phone: "",
				},

				addressObj: null,
			},

			summaryData: {
				/*
				 * delivery_options
				 * cart
				 * is_bank_transfer
				 * payment
				 * personal_data
				 * address
				 */
			},

			prevRoute: "/masthead/wines-cart",
			isPaymentValidationError: false,
		};
	},

	beforeRouteEnter(to, from, next) {
		next((vm) => {
			if (from["fullPath"] !== "/") {
				vm.prevRoute = from.fullPath;
			}
		});
	},

	beforeRouteUpdate(to, from, next) {
		next((vm) => {
			if (from["fullPath"] !== "/") {
				vm.prevRoute = from.fullPath;
			}
		});
	},

	created() {
		"use strict";
		this.orderDetails["summaryPrice"] = this.summaryPriceInBasket;
		this.$root.helper.addStyleClassToBody("light-bg");
		window.addEventListener("resize", this.$_resizePageHandler, false);
	},

	mounted() {
		"use strict";
		this.prevDisplayState = this.calcDisplayOrientationState();
		this.$_calcDeliveryPrice();
	},

	destroyed() {
		"use strict";
		this.$root.helper.removeStyleClassFromBody("light-bg");
		window.removeEventListener("resize", this.$_resizePageHandler);
	},

	methods: {
		handleDeliveryOptionClick: function (event, optionIndex) {
			"use strict";
			console.log(
				"Debug [OrderComp::handleDeliveryOptionClick] Option index " + optionIndex
			);
			let oldOptionIndex = -1;

			for (let i = 0; i < this.deliveryOptionList.length; i++) {
				if (this.deliveryOptionList[i]) {
					oldOptionIndex = i;
				}
				if (i !== optionIndex) {
					this.deliveryOptionList[i] = false;
				} else {
					this.deliveryOptionList[i] = true;
				}
			}

			if (oldOptionIndex !== optionIndex) {
				this.$_resetOrderDetails();
				this.orderDetails.personalData["country"] = this.__("common.Germany");
				this.orderDetails["summaryPrice"] = this.summaryPriceInBasket;
				this.$_updateMainView();

				this.$_calcDeliveryPrice({
					countryStr: this.orderDetails.personalData["country"],
				});
			}
		},

		handlePaymentOptionClick: function (event, optionIndex) {
			"use strict";
			console.log(
				"Debug [OrderComp::handleDeliveryOptionClick] Option index " + optionIndex
			);
			let oldOptionIndex = -1;

			for (let i = 0; i < this.paymentOptionList.length; i++) {
				if (this.paymentOptionList[i]) {
					oldOptionIndex = i;
				}
				if (i !== optionIndex) {
					this.paymentOptionList[i] = false;
				} else {
					this.paymentOptionList[i] = true;
				}
			}
		},

		handlePersonalAttributeChange: function (
			event,
			personalAttributeKey,
			personalAttributeValue
		) {
			"use strict";
			// debugger;
			console.log(
				"Debug [OrderComp::handlePersonalAttributeChange] Enter the function"
			);
			if (this.orderDetails.personalData[personalAttributeKey] !== undefined) {
				this.orderDetails.personalData[
					personalAttributeKey
				] = personalAttributeValue;
			}

			if (personalAttributeKey === "country") {
				this.handleCountryChange(personalAttributeValue);
			}
			// this.$_updateMainView();
		},

		handleCountryChange: function (countryStr) {
			"use strict";
			if (this.deliveryOptionList[0]) {
				return;
			}
			this.$_calcDeliveryPrice({ countryStr });
		},

		handleAucAddress: function (event, address, addressStr) {
			"use strict";
			console.log("Debug [OrderComp::handleAucAddress] Enter the function");
			this.orderDetails["address"] = addressStr;
			this.orderDetails["summaryPrice"] = this.summaryPriceInBasket;
			this.orderDetails["personalData"].address = addressStr;
			let germanyRegexp = /^(Deutschland|Германия|Germany|德國)$/;
			let countryStr = this.orderDetails["personalData"].country;

			// if Google address input is not disabled
			if (address) {
				if (this.deliveryOptionList[0]) {
					this.orderDetails["deliveryPrice"] = 0;
				}
				// Fill Address fields: Country, Zip-code, Full Address string
				this.orderDetails["personalData"].country = address["Country"].long_name;
				if (address["Zip"]) {
					this.orderDetails["personalData"].zip = address["Zip"].long_name;
				}
				this.orderDetails["addressObj"] = address;
			}
			this.$_calcDeliveryPrice({ countryStr });
		},

		handlePaymentToSummaryClick: function (event) {
			"use strict";
			if (this.isPaymentValidationError) {
				this.isInitialPaymentMode = true;
				this.isSummaryPaymentMode = false;
			} else if (this.isInitialPaymentMode) {
				this.isSummaryPaymentMode = true;
				this.isInitialPaymentMode = false;
			}

			event.stopPropagation();
		},

		handlePaymentBackClick: function (event) {
			"use strict";
			if (!this.isInitialPaymentMode) {
				this.isInitialPaymentMode = true;
				this.isSummaryPaymentMode = false;
			} else {
				this.$router.push({ path: this.prevRoute });
			}

			event.preventDefault();
		},

		handlePaymentValidationCheck: function (event, isValidationError) {
			"use strict";
			this.isPaymentValidationError = isValidationError;
			if (isValidationError) {
				this.isInitialPaymentMode = true;
				this.isSummaryPaymentMode = false;
			}
		},

		$_calcDeliveryPrice: function ({
			countryStr: aCountryStr = "",
			address: anAddress = "",
		} = {}) {
			let countryStr = aCountryStr;
			let germanyRegexp = /^(Deutschland|Германия|Germany|德國)$/;
			if (!countryStr) {
				countryStr = this.orderDetails["personalData"].country;

				// if Google address input is not disabled
				if (anAddress) {
					countryStr = address["Country"].long_name;
					germanyRegexp = /^DE$/;
				}
			}

			// Wine Set delivery is free
			const isSelfPickUp = this.deliveryOptionList[0];
			if (this.inBasketBottlesCount === 0 || isSelfPickUp) {
				this.orderDetails["deliveryPrice"] = 0;
			} else {
				if (germanyRegexp.test(countryStr)) {
					if (this.inBasketBottlesCount < 12) {
						this.orderDetails["deliveryPrice"] = 8;
					} else {
						this.orderDetails["deliveryPrice"] = 0;
					}
				} else {
					if (this.inBasketBottlesCount >= 24) {
						this.orderDetails["deliveryPrice"] = 0;
					} else {
						this.orderDetails["deliveryPrice"] = 20;
					}
				}
			}
		},

		$_resetOrderDetails: function () {
			"use strict";
			this.orderDetails = { ...this.orderDetails };
			for (let key in this.orderDetails["personalData"]) {
				if (typeof this.orderDetails["personalData"][key] === "number") {
					this.orderDetails["personalData"][key] = -1;
				}
				if (typeof this.orderDetails["personalData"][key] === "string") {
					this.orderDetails["personalData"][key] = "";
				}
			}

			for (let key1 in this.orderDetails) {
				if (typeof this.orderDetails[key1] === "number") {
					this.orderDetails[key1] = 0;
				}
			}
		},

		$_updateMainView: function () {
			"use strict";
			if (this.orderMainUpdateKey === "main-order-update-key_0") {
				this.orderMainUpdateKey = "main-order-update-key_1";
			} else {
				this.orderMainUpdateKey = "main-order-update-key_0";
			}
		},

		$_updateOrderBodyView: function () {
			"use strict";
			if (this.orderBodyUpdateKey === "order-body-update-key_0") {
				this.orderBodyUpdateKey = "order-body-update-key_1";
			} else {
				this.orderBodyUpdateKey = "order-body-update-key_0";
			}
		},

		$_resizePageHandler: function () {
			"use strict";
			// debugger;
			setTimeout(() => {
				const currDisplayState = this.calcDisplayOrientationState();
				if (this.prevDisplayState !== currDisplayState) {
					this.$_updateOrderBodyView();
					this.prevDisplayState = currDisplayState;
				}
			}, 500);
		},
	},

	computed: {
		...mapGetters([
			"summaryPriceInBasket",
			"inBasketSummaryCount",
			"inBasketBottlesCount",
		]),

		ifPaymentClickCondition: function () {
			return this.isPaymentValidationError ? null : "click";
		},
	},
};
</script>

<style lang="scss" scoped>
.order {
	display: flex;
	flex: 1 0 82%;
	flex-direction: column;
	align-items: stretch;
	max-width: 62.3125%;
	width: 62.3125%;

	margin: 0 3vw auto auto;
	margin: 0 calc(var(--100nvw, 1vw) * 3) auto auto;

	height: 82%;
	height: 82vh;
	height: calc(var(--100nvh, 1vh) * 82);
	/* position: relative; */
	/* border: 2px solid #ebcb9a; */
}

.order-body {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column-reverse;
	align-items: stretch;
}

h1.header-text {
	color: #313131;
	font-size: 2rem;
	font-size: calc(1rem + var(--100nvh, 1vh) * 2);
}

h2.header-precaution-text {
	font-family: "steilgut_opensans";
	font-weight: 100;
	font-size: 0.8rem;
	font-size: 1.4vmin;
	font-size: calc(var(--100nvwmin, 1vmin) * 1.4);
	color: #313131;
	height: fit-content;
	width: fit-content;
	padding-top: 1vh;
	padding-top: var(--100nvh, 1vh);
}

.order-header,
.order-footer {
	display: flex;
	align-items: stretch;
	/* border: 2px solid #ebcb9a; */
}

.order-header {
	flex: 0 0 10%;
}

.order-header-general {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	align-items: stretch;
}

.order-footer {
	flex: 0 0 10%;
	flex-direction: row;
	justify-content: space-between;
	align-items: center;
	/* border-top: 2px solid #ebcb9a; */
}

.header-underline {
	padding-top: 2.4444vh;
	padding-top: calc(var(--100nvh, 1vh) * 2.4444);
}

.order-main {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	align-items: stretch;
	/* border: 2px solid #ebcb9a; */

	font-size: 1rem;
	font-size: calc(0.6rem + 0.6vmin);
	font-size: calc(0.6rem + var(--100nvmin, 1vmin) * 0.6);

	max-height: 78%;
	min-height: 75%;
	height: 78%;
	overflow-y: auto;
}

.order-main,
h1.summary-text {
	font-family: "steilgut_opensans";
	font-weight: 100;
	color: #000;
}

h1.summary-text {
	font-size: 1rem;
	font-size: calc(0.8rem + 0.8vmin);
	font-size: calc(0.8rem + var(--100nvmin, 1vmin) * 0.8);
	text-transform: none;
	margin: 0;
}

.goto-next-btn,
.goto-back-btn {
	display: flex;
	margin: 0;
}

.goto-next-btn,
.goto-back-btn {
	font-family: "steilgut_opensans";
	font-weight: 100;
	color: #313131;
	height: fit-content;
	width: fit-content;
	padding: 1vmin;
	padding: var(--100nvmin, 1vmin);
}

.goto-next-btn:not(.disabled-element):hover {
	box-shadow: -2px 2px 5px #c4bbaa;
}

.goto-back-btn::not(.disabled-element):hover {
	box-shadow: 2px 2px 5px #c4bbaa;
}

.goto-pay-arrow,
.goto-back-arrow {
	max-height: 1.25vh;
	max-height: calc(var(--100nvh, 1vh) * 1.25);
	margin: auto 1vmin;
	margin: auto var(--100nvmin, 1vmin);
}

h2.goto-next-text {
	margin-left: 1vmin;
	margin-left: var(--100nvmin, 1vmin);
}

h2.goto-next-text,
h2.goto-back-text {
	font-size: 0.8rem;
	font-size: calc(0.5rem + 0.7vh);
	font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.7);
}

.goto-pay-arrow,
.goto-back-arrow {
	margin: auto 1.5vmin auto 1.5vmin;
	margin: auto calc(var(--100nvmin, 1vmin) * 1.5) auto
		calc(var(--100nvmin, 1vmin) * 1.5);
}

h2.goto-back-text {
	margin-right: 1vmin;
	margin-right: var(--100nvmin, 1vmin);
}

.goto-next-btn:hover svg path,
.goto-back-btn:hover svg path {
	fill: #ebcb9a;
}

.goto-next-container {
	max-height: min-content;
	margin: auto 0;
}

.summary-paragraph,
.order-price,
.delivery-order-price {
	display: flex;
	flex: 0 0 auto;
}

.summary-paragraph {
	flex-direction: column;
}

.order-price,
.delivery-order-price {
	flex-direction: row;
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

	.order {
		position: relative;
		margin: 0;
		min-height: unset;
		max-height: unset;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.order {
		margin-top: -15vh;
		width: 100%;
		min-width: 100%;
		max-width: 100%;
		flex: 1 0 auto;
		max-height: unset;
		height: auto;
	}

	.header-underline h1.header-text {
		color: #ffffff;
		font-size: calc(1.5rem + 1.5vh);
		text-align: left;
	}

	.order-main {
		flex: 1 0 75%;
		height: auto;
		min-height: unset;
	}

	.order-footer {
		margin: 0 4vw;
		border-top: 1px solid #000;
		padding: 2vh 0;
	}

	.order-footer .summary-title h1.summary-text {
		font-size: 1.2rem;
		font-size: calc(1rem + 3vmin);
	}

	.order-footer .goto-back-btn,
	.order-footer .goto-next-btn {
		font-size: 1.3rem;
		font-size: calc(1rem + 0.7vh);
		padding: 1.5vh 2vmin;
	}

	.empty-order-announcement-text-container {
		padding: 2vmin;
	}

	h2.empty-order-announcement-text {
		font-family: "steilgut_opensans";
		font-weight: 100;
		font-size: 0.8rem;
		padding: 2.5vh 1.5vh;
		color: #313131;
		text-align: justify;
	}

	.summary-title {
		padding: 2vh 0;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.summary-title {
				padding: 2vh 0;
				padding: calc(var(--100vh, 1vh) * 2) 0;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.order {
		margin-top: -24vh;
		left: 30.6875vw;
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		align-items: stretch;
		max-width: 62.3125vw;
		width: 62.3125vw;
		height: auto;
		/* position: relative; */
		/* border: 2px solid #ebcb9a; */
	}

	.order-header {
		flex: 0 0 10%;

		margin-bottom: 2vmin;
	}

	.order-header h1.header-text {
		font-size: calc(0.7rem + 3vmin);
		margin: 0 auto 1vmin auto;
	}

	.header-underline img {
		max-width: 60%;
	}

	.order-main {
		display: flex;
		flex: 1 0 auto !important;
		height: auto !important;
		min-height: 65vh !important;
		justify-content: center;
		align-items: stretch;
		/* border: 2px solid #ebcb9a; */
	}

	.order-footer .goto-back-btn,
	.order-footer .goto-next-btn,
	.order-footer .summary-title {
		font-size: 1rem;
		font-size: 4vh;
	}

	.order-footer .goto-back-arrow {
		margin-right: 3vmin;
	}

	.order-footer .goto-back-arrow,
	.order-footer .goto-pay-arrow {
		width: 6vmin;
		height: 6vmin;
	}

	.order-footer {
		flex: 0 0 15%;
		height: auto;
		align-items: stretch;
		padding: 2vmin 0;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			// .order-header h1.header-text {
			// 	font-size: calc(0.7rem + 3vmin);
			// 	font-size: calc(0.7rem + var(--100vh, 1vh) * 3);
			// }

			// .order-footer {
			// 	padding: 2vmin 0;
			// 	padding: calc(0.7rem + var(--100vh, 1vh) * 2) 0;
			// }

			// .order {
			// 	min-height: 90%;
			// 	min-height: calc(var(--100vh, 1vh) * 90);
			// }

			// .order-main {
			// 	min-height: 75%;
			// 	min-height: calc(var(--100vh, 1vh) * 75);
			// }
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
}

@media only screen and (min-width: 340px) and (max-width: 740px) and (orientation: landscape) {
}

@media only screen and (min-width: 375px) and (max-width: 896px) and (orientation: landscape) {
}

@media only screen and (min-width: 1025px) and (max-height: 800px) and (orientation: landscape) {
	.order-main {
		/* border: 2px solid #ebcb9a; */
		font-size: 1rem;
		overflow-y: auto;
		font-size: calc(0.6rem + 0.6vmin);
		font-size: calc(0.6rem + var(--100nvmin, 1vmin) * 0.6);
		height: 77%;
		min-height: 72%;
		max-height: 77%;
	}

	h1.header-text {
		font-size: calc(1rem + 1.4vmin);
		font-size: calc(1rem + var(--100nvmin, 1vmin) * 1.4);
	}

	.summary-text {
		font-size: calc(0.6rem + 0.3vmin);
		font-size: calc(0.6rem + var(--100nvmin, 1vmin) * 0.3);
	}

	.summary-paragraph {
		margin: 0;
	}

	.summary-paragraph h2 {
		font-size: calc(0.5rem + 0.5vh);
		font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.5);
	}
}

@media only screen and (min-width: 1025px) and (max-height: 720px) and (orientation: landscape) {
	.order-main {
		height: 74%;
		min-height: 70%;
		max-height: 74%;
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	/* Styles */

	.order-footer {
		flex: 0 0 9%;
	}

	.goto-next-btn,
	.goto-back-btn {
		margin: 0;
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (min-aspect-ratio: 16/10) {
	/* Styles */
	.order-header {
		margin-bottom: 1.5vmin;
		margin-bottom: calc(var(--100nvmin, 1vmin) * 1.5);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.order-main {
				flex: 1 0 auto;
				min-height: 55vh;
				height: 55vh;
			}
		}
	}
}
</style>
