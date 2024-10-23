<template>
	<div class="transit-flex-box tw-flex page-body portrait-non-fp landscape-non-fp">
		<!-- Desktop -->
		<div class="md:tw-block landscape:tw-hidden tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="degustation-pg-img"
				relativePath="degustation-pg"
				baseName="bg-degustation-pg"
				lqipPath_4_3="/images/4_3/degustation-pg/lqip_4_3/jpg/4_3-lqip-bg-degustation-pg.jpg"
				lqipPath_16_9="/images/16_9/degustation-pg/lqip_16_9/jpg/16_9-lqip-bg-degustation-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-top-0 tw-right-0 tw-bottom-0 tw-object-cover tw-max-w-full tw-w-full img-fp tw-object-cover"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				isDesktopAspectRatioCorrection="true"
			></lazy-load-image-comp>
		</div>

		<!-- Landscape -->
		<div class="md:tw-hidden landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="degustation-pg-img"
				relativePath="degustation-pg"
				baseName="bg-degustation-pg"
				lqipPath_4_3="/images/4_3/degustation-pg/lqip_4_3/jpg/4_3-lqip-bg-degustation-pg.jpg"
				lqipPath_16_9="/images/16_9/degustation-pg/lqip_16_9/jpg/16_9-lqip-bg-degustation-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-inset-0 tw-object-cover tw-max-w-full tw-w-full tw-max-h-screen tw-h-screen"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				isHiddenPortrait="true"
				isDesktopAspectRatioCorrection="false"
			></lazy-load-image-comp>
		</div>

		<!-- Portrait layouts -->
		<div class="md:tw-hidden landscape:tw-hidden tw-block tw-relative tw-inset-0">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-degustation-pg-img"
				relativePath="degustation-pg"
				baseName="bg-degustation-pg"
				lqipPath_portrait="/images/mobile/degustation-pg/lqip/jpg/portrait-lqip-bg-degustation-pg.jpg"
				lazyLoadImgStyleClass_portrait="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				basedPortraitLazyImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
			></lazy-load-image-comp>

			<div
				class="header tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4 tw-max-w-fit-min-content"
			>
				<h1 class="header-text tw-text-left">{{ __("degustation.header") }}</h1>
				<img
					class="header-underline-img"
					src="/images/icons/commons/header-underscore-line.svg"
				/>
			</div>
		</div>
		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div class="transit-flex-box tw-flex" v-else>
			<div v-if="isLoading">
				<pulse-logo-comp isDefer="true"></pulse-logo-comp>
			</div>
			<div class="page-form">
				<!-- Landscape/Desktop -->
				<div
					class="header tw-max-w-min-content tw-hidden landscape:tw-block md:tw-block"
				>
					<h1 class="header-text tw-text-left">
						{{ __("degustation.header") }}
					</h1>
					<img
						class="header-underline-img"
						src="/images/icons/commons/header-underscore-line.svg"
					/>
				</div>

				<section class="content-paragraph">
					<span class="content-text quote">{{
						__("degustation.1stPartText")
					}}</span>
				</section>

				<section class="content-paragraph">
					<span class="content-text">{{ __("degustation.2ndPartText") }}</span>
				</section>

				<div class="option-panel">
					<h2 class="subheader tw-text-left">
						{{ __("degustation.subheader") }}
					</h2>
					<div class="button-panel tw-flex tw-flex-row">
						<button
							type="button"
							name="terrace-button"
							class="option-btn"
							:class="{
								'active-option-btn': optionList[0].isSelected,
							}"
							@click="handleOptionClick($event, 0)"
						>
							<h2 class="button-header">
								{{ __("degustation.terraceTitle") }}
							</h2>
						</button>

						<button
							type="button"
							name="vineyard-button"
							class="option-btn"
							:class="{
								'active-option-btn': optionList[1].isSelected,
							}"
							@click="handleOptionClick($event, 1)"
						>
							<h2 class="button-header">
								{{ __("degustation.vineyardTitle") }}
							</h2>
						</button>
					</div>

					<div class="input-table">
						<div class="lfp-container input-cell">
							<label
								class="field-title-text is-required-field"
								for="LFP"
								:class="[
									{
										'is-invalid-field': errorsFor('LFP').length > 0,
									},
								]"
							>
								{{ __("contacts.LFPHeader") }}
							</label>
							<input
								type="text"
								class="user-field tw-appearance-none focus:tw-outline-none is-required-field"
								name="LFP"
								maxlength="33"
								v-model="notification['LFP']"
								:placeholder="__('contacts.LFPPlaceholder')"
								:class="[
									{
										'is-invalid-field': errorsFor('LFP').length > 0,
									},
								]"
							/>
							<transition name="fade">
								<validation-error
									class="tw-max-w-095 landscape:tw-hidden"
									v-if="errorsFor('LFP').length > 0"
									:errors="errorsFor('LFP')"
								></validation-error>
							</transition>
						</div>

						<div class="email-container input-cell">
							<label
								class="field-title-text is-required-field"
								for="email"
								:class="[
									{
										'is-invalid-field': errorsFor('email').length > 0,
									},
								]"
							>
								{{ __("contacts.emailHeader") }}
							</label>
							<input
								type="text"
								class="user-field tw-appearance-none focus:tw-outline-none is-required-field"
								name="email"
								v-model="notification['email']"
								:placeholder="__('contacts.emailPlaceholder')"
								maxlength="33"
								:class="[
									{
										'is-invalid-field': errorsFor('email').length > 0,
									},
								]"
							/>
							<transition name="fade">
								<validation-error
									v-if="errorsFor('email').length > 0"
									class="tw-max-w-095 landscape:tw-hidden"
									:errors="errorsFor('email')"
								></validation-error>
							</transition>
						</div>

						<div class="phone-container input-cell">
							<label
								for="phone"
								class="is-required-field"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
								>{{ __("contacts.phoneLabel") }}</label
							>
							<input
								type="text"
								name="phone"
								:placeholder="__('contacts.phoneLabelPlaceholder')"
								autocomplete="on"
								v-model="notification['phone']"
								class="tw-appearance-none focus:tw-outline-none user-field is-required-field"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
							/>
							<transition name="fade">
								<validation-error
									class="tw-max-w-095 landscape:tw-hidden"
									v-if="errorsFor('phone').length > 0"
									:errors="errorsFor('phone')"
								></validation-error>
							</transition>
						</div>

						<!-- Portrait -->
						<div
							class="tw-inline-flex time-row md:tw-hidden landscape:tw-hidden tw-flex-grow tw-justify-between"
						>
							<div
								class="date-container input-cell tw-flex tw-flex-col tw-flex-grow tw-relative tw-max-w-045"
							>
								<label
									for="date"
									class="is-required-field"
									:class="[
										{
											'is-invalid-field':
												errorsFor('date').length > 0,
										},
									]"
									>{{ __("common.date") }}</label
								>
								<input
									type="date"
									name="date"
									placeholder="23-06-2021"
									autocomplete="on"
									v-model="notification['date']"
									class="tw-appearance-none focus:tw-outline-none user-field tw-absolute tw-left-0 tw-bottom-0 tw-flex-grow tw-h-auto"
									:class="[
										{
											'is-invalid-field':
												errorsFor('date').length > 0,
											'chrome-input-date': isChrome(),
										},
									]"
								/>
								<transition name="fade">
									<validation-error
										class="tw-max-w-095"
										v-if="errorsFor('date').length > 0"
										:errors="errorsFor('date')"
									></validation-error>
								</transition>
							</div>

							<drop-down-static-list-comp
								:isHeader="true"
								:isControl="true"
								class="tw-flex-grow input-cell"
								v-on:select-item="handleTimeSelection"
								:attributeName="__('common.time')"
								:attributeValue="notification['time']"
								:dropDownStaticListWrapperCtrlStyleClass="`tw-h-full`"
							></drop-down-static-list-comp>
						</div>

						<!-- Desktop/Landscape -->
						<div
							class="date-container input-cell tw-hidden landscape:tw-block md:tw-block"
						>
							<label
								for="date"
								class="is-required-field"
								:class="[
									{
										'is-invalid-field': errorsFor('date').length > 0,
									},
								]"
								>{{ __("common.date") }}</label
							>
							<input
								type="date"
								name="date"
								placeholder="15 ноября"
								autocomplete="on"
								v-model="notification['date']"
								class="tw-appearance-none focus:tw-outline-none user-field is-required-field"
								:class="[
									{
										'is-invalid-field': errorsFor('date').length > 0,
										'chrome-input-date': isChrome(),
									},
								]"
							/>
							<transition name="fade" class="landscape:tw-hidden">
								<validation-error
									class="tw-max-w-095"
									v-if="errorsFor('date').length > 0"
									:errors="errorsFor('date')"
								></validation-error>
							</transition>
						</div>

						<drop-down-static-list-comp
							:isHeader="true"
							:isControl="true"
							v-on:select-item="handleTimeSelection"
							class="tw-hidden landscape:tw-block md:tw-block input-cell"
							:attributeName="__('common.time')"
							:attributeValue="notification['time']"
							:inputCtrlStyleClassList="`md:tw-static`"
							:dropDownStaticListWrapperCtrlStyleClass="`landscape:tw-h-full`"
							dropDownStaticListBodyWrapperStyleClass="md:tw-absolute"
							:downArrowSelectorCtrlStyleClassList="`top-6px`"
							:upArrowSelectorCtrlStyleClassList="`top-6px`"
							dropDownStaticListContolElemStyleClass="drop-down-static-list-control-element-container"
						></drop-down-static-list-comp>
					</div>

					<transition-group name="fade" tag="div" class="info-msg">
						<div v-if="isSendError" key="isSendError_desktop">
							<h2 class="is-send-error">
								{{ __("formalMessages.wentWrongMsg") }}
							</h2>
						</div>
						<div v-show="isSentMsg" key="isSentMsg_desktop">
							<h2 class="is-msg-sent">
								{{ __("contacts.sentSuccessText") }}
							</h2>
						</div>
					</transition-group>

					<div
						class="control-panel tw-hidden landscape:tw-flex md:tw-inline-flex"
					>
						<button
							type="submit"
							class="send-btn tw-appearance-none focus:tw-outline-none"
							v-on:click.prevent="sendNotification"
							:disabled="isLoading"
						>
							<span class="send-btn-text">{{
								__("contacts.sendBtnTitle")
							}}</span>
							<img
								class="send-btn-arrow"
								src="/images/icons/commons/send-btn-next.svg"
								alt="Sending arrow"
							/>
						</button>
						<div class="agreement-container tw-inline-flex">
							<div class="agreement-checkbox-container">
								<input
									type="checkbox"
									name="notificationAgreement"
									v-model="agreement"
									:class="[
										{
											'is-invalid-field':
												errorsFor('agreement').length > 0,
										},
									]"
								/>
								<span
									class="checkmark"
									:class="[
										{
											'is-invalid-field':
												errorsFor('agreement').length > 0,
										},
									]"
								></span>
							</div>
							<label
								class="agreement-text is-required-field"
								for="notificationAgreement"
								:class="[
									{
										'is-invalid-field':
											errorsFor('agreement').length > 0,
									},
								]"
								>{{ __("contacts.agreementTitle") }}
							</label>
						</div>
					</div>

					<div class="control-panel tw-block landscape:tw-hidden md:tw-hidden">
						<div class="agreement-container tw-inline-flex">
							<div class="agreement-checkbox-container">
								<input
									type="checkbox"
									name="notificationAgreement"
									v-model="agreement"
								/>
								<span
									class="checkmark"
									:class="[
										{
											'is-invalid-field':
												errorsFor('agreement').length > 0,
										},
									]"
								></span>
							</div>
							<label
								class="agreement-text is-required-field"
								for="notificationAgreement"
								:class="[
									{
										'is-invalid-field':
											errorsFor('agreement').length > 0,
									},
								]"
								>{{ __("contacts.agreementTitle") }}
							</label>
						</div>
						<button
							type="submit"
							class="send-btn tw-appearance-none focus:tw-outline-none"
							v-on:click.prevent="sendNotification"
							:disabled="isLoading"
						>
							<span class="send-btn-text">{{
								__("contacts.sendBtnTitle")
							}}</span>
							<img
								class="send-btn-arrow"
								src="/images/icons/commons/send-btn-next.svg"
								alt="Sending arrow"
							/>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import BackgroundShadowComp from "../shared/components/BackgroundShadowComp";
import validationErrors from "../shared/mixins/validationErrors";
import mediaHelper from "../shared/mixins/mediaHelper";
import fullscreenCorrector from "../shared/mixins/fullscreenCorrector";
import degustationSignUp from "../shared/mixins/degustationSignUp";
import { refreshFullPageContainers } from "../shared/utils/resizer";
import { mapGetters, mapState } from "vuex";
import { Helper } from "../shared/utils/helper";
import { is422, is404, is500 } from "../shared/utils/response";

const dropDownStaticListComp = () =>
	import("../shared/components/DropDownStaticListComp");

const pulseLogoComp = () => import("../shared/components/PulseLogoComp");

export default {
	mixins: [validationErrors, mediaHelper, degustationSignUp, fullscreenCorrector],

	components: {
		"drop-down-static-list-comp": dropDownStaticListComp,
		"pulse-logo-comp": pulseLogoComp,
		"background-shadow-comp": BackgroundShadowComp,
	},

	created() {
		("use strict");
		// debugger;
		if (this.$_checkedOrRedirected()) {
			console.log(
				"Debug [DegustationComp::beforeRouteLeave] Initial state is valid"
			);
		}
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [DegustationComp::$_checkedOrRedirected] Returned Invalid Arguments"
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

	computed: {},
};
</script>

<style lang="scss">
.top-6px {
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.top-6px {
		top: 6px;
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.top-6px {
		top: 6px;
	}
	.drop-down-static-list-control-element-container {
		top: 0%;
		height: 5vh;
		height: calc(var(--100vh, 1vh) * 5);
	}
}
</style>

<style lang="scss" scoped>
@import "@/sass/commons.scss";

.control-panel {
	align-items: center;
}

.option-panel .input-table .input-cell:nth-child(1) {
	grid-column: span 2;
}

.option-panel .input-table .input-cell:nth-child(2) {
	grid-column: span 2;
}

.option-panel .input-table .input-cell:nth-child(3) {
	grid-column: span 2;
}

.option-panel .input-table .input-cell:nth-child(4) {
	grid-column: span 1;
}

.option-panel .input-table .input-cell:nth-child(5) {
	grid-column: span 1;
}

.drop-down-static-list .drop-down-static-list-header .drop-down-header-text input {
	position: unset !important;
}

.info-msg {
	height: 52px;
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.option-panel .input-table .input-cell {
		padding-right: 0;
	}

	.option-panel .input-table .time-row .input-cell {
		height: 12vh;
		height: calc(var(--100vh, 1vh) * 12);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		.option-panel .input-table .time-row .input-cell {
			height: 12vh;
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.time-container label {
		padding-top: 1vh;
		padding-top: var(--100vh, 1vh);
	}

	.option-panel .input-table {
		flex: 1 0 auto;
		grid-template-rows: repeat(3, 17vh);
		grid-template-rows: repeat(3, calc(var(--100vh, 1vh) * 17));
	}

	.option-panel .input-table .input-cell:nth-child(4) {
		grid-column: span 2;
	}

	.option-panel .input-table .input-cell:nth-child(5) {
		grid-column: span 2;
	}

	.option-panel .input-table .drop-down-static-list {
		width: 200%;
	}

	.agreement-container {
		max-width: 75%;
		.agreement-checkbox-container {
			margin-left: 15px;

			.checkmark::after {
				width: 19px;
				height: 33px;
				left: 37%;
				top: -80%;
			}
		}
	}

	.control-panel label.agreement-text {
		margin-left: 10px;
		max-width: 80%;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.time-container label {
				padding-top: 1vh;
			}

			.option-panel .input-table {
				flex: 1 0 auto;
				grid-template-rows: repeat(3, 14vh);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 568px) and (orientation: landscape) {
	.option-panel .input-table {
		flex: 1 0 auto;
		grid-template-rows: repeat(3, 15vh);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.agreement-container {
		.agreement-checkbox-container {
			margin-left: 21px;

			.checkmark::after {
				width: 16px;
				left: 43%;
				top: -90%;
			}
		}
	}
	/* Styles */
	.drop-down-static-list .drop-down-static-list-header .drop-down-header-text input {
		position: unset !important;
	}
}
</style>
