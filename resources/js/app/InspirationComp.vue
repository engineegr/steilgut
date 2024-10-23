<template>
	<div class="transit-flex-box tw-flex page-body portrait-non-fp landscape-non-fp">
		<!-- Desktop -->
		<div class="md:tw-block landscape:tw-block tw-hidden">
			<!-- <lazy-load-image-comp
				basedLazyImgStyleClass="bg-based-terroir-pg-img"
				relativePath="based-terroir-pg"
				baseName="bg-based-terroir-pg"
				lqipPath_4_3="/images/4_3/based-terroir/lqip_4_3/jpg/4_3-lqip-bg-based-terroir-pg.jpg"
				lqipPath_16_9="/images/16_9/based-terroir/lqip_16_9/jpg/16_9-lqip-bg-based-terroir-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-inset-0 tw-object-cover"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass="mobile-landscape-fp-img"
				commonImgStyleClass=""
				atSurfaceZindexStyleClass="tw-z-0"
				backZIndexStyleClass="tw-z-n-1"
				isDesktopAspectRatioCorrection="true"
			></lazy-load-image-comp> -->
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-based-terroir-pg-img"
				relativePath="based-terroir-pg"
				baseName="bg-based-terroir-pg"
				lqipPath_4_3="/images/4_3/based-terroir/lqip_4_3/jpg/4_3-lqip-bg-based-terroir-pg.jpg"
				lqipPath_16_9="/images/16_9/based-terroir/lqip_16_9/jpg/16_9-lqip-bg-based-terroir-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-0 tw-top-0 tw-right-0 tw-bottom-0 tw-object-cover"
				lazyLoadImgStyleClass_4_3="bg-based-terroir-pg-width-4_3"
				lazyLoadImgStyleClass_16_9="bg-based-terroir-pg-width-16_9"
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				atSurfaceZindexStyleClass="tw-z-0"
				backZIndexStyleClass="tw-z-n-1"
				isDesktopAspectRatioCorrection="true"
				:isBackgroundShadow="false"
				:isLandscapeBackgroundShadow="false"
				:isPortraitBackgroundShadow="false"
			></lazy-load-image-comp>
		</div>

		<!-- Landscape -->
		<div class="md:tw-hidden landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="landscape-left-inspiration-pg-img"
				relativePath="inspiration-pg/left-inspiration-bg"
				baseName="bg-left-inspiration-pg"
				lqipPath_4_3="/images/4_3/inspiration-pg/left-inspiration-bg/lqip_4_3/jpg/4_3-lqip-bg-left-inspirtaion-pg.jpg"
				lqipPath_16_9="/images/16_9/inspiration-pg/left-inspiration-bg/lqip_16_9/jpg/16_9-lqip-bg-left-inspirtaion-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-z-0 tw-top-0 tw-bottom-0 tw-left-0 tw-object-cover tw-object-cover tw-h-screen tw-min-h-screen"
				lqipStyleClass_16_9="tw-w-1/4 tw-max-w-1/4"
				lazyLoadImgStyleClass_4_3=""
				lazyLoadImgStyleClass_16_9=""
				basedLandscapeLazyImgStyleClass=""
				commonImgStyleClass=""
				isDesktopAspectRatioCorrection="true"
				:isBackgroundShadow="false"
				:isLandscapeBackgroundShadow="false"
				:isPortraitBackgroundShadow="false"
			></lazy-load-image-comp>
		</div>

		<!-- Portrait layouts -->
		<div class="md:tw-hidden landscape:tw-hidden tw-block tw-relative tw-inset-0">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-inspiration-pg-img"
				relativePath="inspiration-pg"
				baseName="bg-inspiration-pg"
				lqipPath_portrait="/images/mobile/inspiration-pg/lqip/portrait-lqip-bg-inspiration-pg.jpg"
				basedPortraitLazyImgStyleClass=""
				lazyLoadImgStyleClass_portrait="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
				atSurfaceZindexStyleClass="tw-z-0"
				backZIndexStyleClass="tw-z-n-3"
			></lazy-load-image-comp>

			<div
				class="header tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4 tw-max-w-fit-min-content"
			>
				<h1 class="header-text tw-text-left tw-w-fit-content">
					{{ __("inspiration.header") }}
				</h1>
				<img
					class="header-underline-img"
					src="/images/icons/commons/header-underscore-line.svg"
				/>
			</div>
		</div>

		<div v-show="isLoading">
			<pulse-logo-comp isDefer="true"></pulse-logo-comp>
		</div>

		<!--  Desktop/Landscape -->

		<div class="page-form md:tw-flex landscape:tw-flex tw-hidden">
			<div class="optional-panel-wrapper fade-inOut-opacity landscape:tw-hidden">
				<div class="option-panel__container">
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
							<div class="lfp-container input-cell tw-flex-grow">
								<label
									class="field-title-text"
									for="LFP"
									:class="[
										{
											'is-required-field':
												errorsFor('LFP').length > 0,
										},
									]"
								>
									{{ __("contacts.LFPHeader") }}
								</label>
								<input
									type="text"
									class="user-field tw-appearance-none focus:tw-outline-none"
									name="LFP"
									maxlength="33"
									v-model="notification['LFP']"
									:placeholder="__('contacts.LFPPlaceholder')"
									:class="[
										{
											'is-invalid-field':
												errorsFor('LFP').length > 0,
										},
									]"
								/>
								<transition name="fade">
									<validation-error
										class="tw-max-w-095"
										v-if="errorsFor('LFP').length > 0"
										:errors="errorsFor('LFP')"
									></validation-error>
								</transition>
							</div>

							<div class="email-container input-cell tw-flex-grow">
								<label
									class="field-title-text"
									for="email"
									:class="[
										{
											'is-required-field':
												errorsFor('email').length > 0,
										},
									]"
								>
									{{ __("contacts.emailHeader") }}
								</label>
								<input
									type="text"
									class="user-field tw-appearance-none focus:tw-outline-none"
									name="email"
									v-model="notification['email']"
									:placeholder="__('contacts.emailPlaceholder')"
									maxlength="33"
									:class="[
										{
											'is-invalid-field':
												errorsFor('email').length > 0,
										},
									]"
								/>
								<transition name="fade">
									<validation-error
										v-if="errorsFor('email').length > 0"
										class="tw-max-w-095"
										:errors="errorsFor('email')"
									></validation-error>
								</transition>
							</div>

							<div class="phone-container input-cell tw-flex-grow">
								<label
									for="phone"
									:class="[
										{
											'is-invalid-field':
												errorsFor('phone').length > 0,
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
									class="tw-appearance-none focus:tw-outline-none user-field"
									:class="[
										{
											'is-invalid-field':
												errorsFor('phone').length > 0,
										},
									]"
								/>
								<transition name="fade">
									<validation-error
										class="tw-max-w-095"
										v-if="errorsFor('phone').length > 0"
										:errors="errorsFor('phone')"
									></validation-error>
								</transition>
							</div>

							<div
								class="tw-inline-flex time-row input-cell tw-w-full tw-max-w-full tw-justify-between tw-flex-grow"
							>
								<div
									class="date-container tw-relative tw-flex-grow tw-w-1/2 tw-max-w-1/2"
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
										class="tw-appearance-none focus:tw-outline-none user-field tw-absolute tw-bottom-0 tw-left-0 tw-max-w-full tw-text-white"
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
									isHeader="true"
									class="tw-flex-grow tw-w-045 tw-max-w-045"
									v-on:select-item="handleTimeSelection"
									:attributeName="__('common.time')"
									:attributeValue="notification['time']"
									:dropDownStaticListWrapperCtrlStyleClass="`md:tw-h-full`"
									:dropDownListItemCtrlStyleClass="`md:tw-text-md-steilgut-inspiration-time-font-size`"
								></drop-down-static-list-comp>
							</div>
						</div>

						<div class="control-panel">
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

							<transition-group
								name="fade"
								tag="div"
								class="tw-flex-grow tw-flex tw-justify-start tw-items-center info-msg"
							>
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

			<div class="header-container">
				<section class="content-paragraph tw-mx-auto">
					<div
						class="header tw-max-w-min-content tw-hidden landscape:tw-block md:tw-block"
					>
						<h1 class="header-text tw-text-left">
							{{ __("inspiration.header") }}
						</h1>
						<img
							class="header-underline-img"
							src="/images/icons/commons/header-underscore-line.svg"
						/>
					</div>

					<h2 class="content-subheader quote tw-block">
						{{ __("inspiration.1stPartQuoteText") }}
					</h2>
					<span
						class="content-text tw-block tw-max-w-100"
						v-html="__('inspiration.1stPartText')"
						>{{ __("inspiration.1stPartText") }}</span
					>
				</section>

				<section class="content-paragraph tw-mx-auto" v-if="false">
					<h2 class="content-subheader quote tw-block">
						{{ __("inspiration.2ndPartQuoteText") }}
					</h2>
					<span
						class="content-text tw-block tw-max-w-070"
						v-html="__('inspiration.2ndPartText')"
						>{{ __("inspiration.2ndPartText") }}</span
					>
				</section>
			</div>

			<background-shadow-comp zIndexClass="tw-z-1"> </background-shadow-comp>
		</div>

		<!-- Portrait -->
		<div class="page-form md:tw-hidden landscape:tw-hidden tw-flex tw-flex-col">
			<div
				class="header-container tw-relative"
				v-on:click="isSignUpOpen = !isSignUpOpen"
			>
				<h2 class="subheader tw-text-left">
					{{ __("degustation.subheader") }}
				</h2>
				<img
					v-if="!isSignUpOpen"
					class="tw-absolute control-arrow"
					src="/images/icons/commons/white-arrow-down.svg"
					alt="Closed filter"
				/>

				<img
					v-else
					class="tw-absolute control-arrow"
					src="/images/icons/commons/white-arrow-up.svg"
					alt="Openned filter"
				/>
			</div>
			<div class="option-panel-container">
				<div class="option-panel" v-if="isSignUpOpen">
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
						<div class="lfp-container input-cell tw-flex-grow">
							<label
								class="field-title-text"
								for="LFP"
								:class="[
									{
										'is-required-field': errorsFor('LFP').length > 0,
									},
								]"
							>
								{{ __("contacts.LFPHeader") }}
							</label>
							<input
								type="text"
								class="user-field tw-appearance-none focus:tw-outline-none"
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
									class="tw-max-w-095"
									v-if="errorsFor('LFP').length > 0"
									:errors="errorsFor('LFP')"
								></validation-error>
							</transition>
						</div>

						<div class="email-container input-cell tw-flex-grow">
							<label
								class="field-title-text"
								for="email"
								:class="[
									{
										'is-required-field':
											errorsFor('email').length > 0,
									},
								]"
							>
								{{ __("contacts.emailHeader") }}
							</label>
							<input
								type="text"
								class="user-field tw-appearance-none focus:tw-outline-none"
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
									class="tw-max-w-095"
									:errors="errorsFor('email')"
								></validation-error>
							</transition>
						</div>

						<div class="phone-container input-cell tw-flex-grow">
							<label
								for="phone"
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
								class="tw-appearance-none focus:tw-outline-none user-field"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
							/>
							<transition name="fade">
								<validation-error
									class="tw-max-w-095"
									v-if="errorsFor('phone').length > 0"
									:errors="errorsFor('phone')"
								></validation-error>
							</transition>
						</div>

						<div
							class="tw-inline-flex time-row tw-flex-grow tw-justify-between"
						>
							<div
								class="date-container input-cell tw-flex tw-flex-col tw-flex-grow tw-relative tw-max-w-045"
							>
								<label
									for="date"
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
									class="tw-appearance-none focus:tw-outline-none user-field tw-absolute tw-left-0 tw-bottom-0 tw-text-white tw-flex-grow tw-h-auto"
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
								isHeader="true"
								class="input-cell tw-flex-grow tw-max-w-045"
								:attributeName="__('common.time')"
								:dropDownStaticListWrapperCtrlStyleClass="`tw-h-full`"
							></drop-down-static-list-comp>
						</div>
					</div>

					<div class="control-panel">
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

						<transition-group
							name="fade"
							tag="div"
							class="tw-flex-grow tw-flex tw-justify-start tw-items-center"
						>
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
					</div>
				</div>
			</div>
			<div
				class="header tw-max-w-min-content tw-hidden landscape:tw-block md:tw-block"
			>
				<h1 class="header-text tw-text-left">{{ __("inspiration.header") }}</h1>
				<img
					class="header-underline-img"
					src="/images/icons/commons/header-underscore-line.svg"
				/>
			</div>

			<div class="content-container">
				<section class="content-paragraph">
					<span class="content-text quote">{{
						__("inspiration.1stPartQuoteText")
					}}</span>
				</section>

				<section class="content-paragraph">
					<span
						class="content-text tw-block tw-max-w-090"
						v-html="__('inspiration.1stPartText')"
						>{{ __("inspiration.1stPartText") }}</span
					>
				</section>
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

	data: function () {
		return {
			isSignUpOpen: false,
			isLoading: true,
		};
	},

	created() {
		("use strict");
		// debugger;
		if (this.$_checkedOrRedirected()) {
			console.log(
				"Debug [SteilgutClubComp::beforeRouteLeave] Initial state is valid"
			);
		}
	},

	mounted() {
		("use strict");

		this.handleOptionalPanelImageLoading();
	},

	methods: {
		$_checkedOrRedirected: function () {
			("use strict");
			if (!this.$_isInitialStateValid()) {
				console.warn(
					"Warn [SteilgutClubComp::$_checkedOrRedirected] Returned Invalid Arguments"
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

		handleOptionalPanelImageLoading: function () {
			("use strict");
			if (this.isMobileDevice()) {
				this.isLoading = false;
				return;
			}

			this.isLoading = true;
			let imgPath =
				"/images/4_3/inspiration-pg/left-inspiration-pg/xl_1440*1024/jpg/4_3-xl-2x-bg-left-inspiration-pg.jpg";
			if (this.is16_9AspectRatio()) {
				imgPath =
					"/images/16_9/inspiration-pg/left-inspiration-bg/fhd_1920*1080/jpg/16_9-fhd-2x-bg-left-inspiration-pg.jpg";
			}

			const imgObj = new Image();
			imgObj.src = imgPath;

			if (this.isImageLoaded(imgObj)) {
				this.isLoading = false;
			} else {
				const self = this;
				imgObj.addEventListener("load", () => {
					console.info("InspirationComp [image:load] Load completed");
					self.isLoading = false;
				});

				imgObj.onerror = () => {
					console.warn(
						"InspirationComp [image:load] failed to load the bg image"
					);
				};
			}
		},
	},
};
</script>

<style lang="scss">
@import "@/sass/global-based-terroir.scss";

@media only screen and (min-width: 320px) and (max-width: 896px) and (orientation: landscape) {
	img.bg-based-terroir-pg-width-4_3 {
		max-width: 69vw;
		width: 69vw;
	}

	img.bg-based-terroir-pg-width-16_9 {
		max-width: 77vw;
		width: 77vw;
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.drop-down-header-wrapper label {
		font-size: 0.875rem !important;
	}

	.drop-down-header-field {
		font-size: 1.125rem !important;
	}
}
</style>

<style lang="scss" scoped>
@import "@/sass/commons.scss";
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

.header-container {
	max-width: 90%;
	margin-left: 30%;
	z-index: 20;
}

.optional-panel-wrapper {
	position: fixed;
	z-index: 1;
	top: 0;
	padding-top: 7%;
	left: 0;
	height: auto;
	min-height: 100vh;
	max-width: 33%;
	overflow-y: hidden;

	background-color: rgba(0, 0, 0, 0.3);
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.page-form .header-container h2.subheader {
		font-family: "steilgut_opensans";
		font-weight: 100;
		font-size: calc(0.7rem + 0.8vh);
		font-size: calc(0.7rem + var(--100vh, 1vh) * 0.8);
	}

	.control-arrow {
		max-height: 45%;
		max-width: 10%;
	}

	.header-container,
	.content-container {
		max-width: 100%;
	}

	.content-container {
		margin: 0 4vw;
	}

	.header-container {
		margin: 0 4vw 2vh 4vw;
		margin: 0 4vw calc(var(--100vh, 1vh) * 2) 4vw;
	}

	.option-panel-container {
		background: #000000;
		max-width: 100%;
		width: 100%;
	}

	.option-panel {
		margin: 2vh 4vw;
		margin: calc(var(--100vh, 1vh) * 2) 4vw;
	}

	.option-panel .input-table .input-cell {
		padding-right: 0;
	}

	.option-panel .input-table .time-row .input-cell {
		height: 12vh;
		height: calc(var(--100vh, 1vh) * 12);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.page-form .header-container h2.subheader {
				font-size: calc(0.7rem + 0.8vh);
			}

			.header-container {
				margin: 0 4vw 2vh 4vw;
			}

			.option-panel {
				margin: 2vh 4vw;
			}

			.option-panel .input-table .time-row .input-cell {
				height: 12vh;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.page-form {
		flex-direction: row;

		justify-content: space-evenly;
		align-items: flex-start;

		max-width: 85vw;
		// max-width: calc(var(--100vw, 1vw) * 85);
		width: 85vw;
		// width: calc(var(--100vw, 1vw) * 85);

		max-height: unset;
		height: auto;
		margin: 2vh auto 7vh 3vw;
		// margin: calc(var(--100vh, 1vh) * 2) auto calc(var(--100vh, 1vh) * 7)
		//     calc(var(--100vw, 1vw) * 3);
	}

	.option-panel {
		max-height: unset;
		height: auto;
	}

	.option-panel .input-table {
		display: flex;
		flex: 0 1 70%;
		max-width: 70%;
		flex-direction: column;
	}

	.option-panel .input-table div.input-cell {
		margin-right: 0;
		margin: calc(0.5em + 0.5vh) 0;
		// margin: calc(0.5em + var(--100vh, 1vh) * 0.5) 0;
	}

	.control-panel {
		flex: 1 0 35%;
		flex-direction: column;
		flex-wrap: nowrap;
		justify-content: stretch;
		max-height: 35%;
		height: 35%;
	}

	.agreement-container {
		margin: calc(0.5rem + 0.5vh) 0;
		// margin: calc(0.5rem + var(--100vh, 1vh) * 0.5) 0;
	}

	.agreement-container .agreement-checkbox-container {
		margin: auto var(--100vw, 1vw) auto 0;
	}

	.control-panel .agreement-container label.agreement-text {
		max-width: 90%;
	}

	.header-container {
		margin-left: 44%;
	}

	.header-container .content-paragraph .header {
		min-width: 75%;
		margin: 0 0 calc(1.2rem + 1.2vh) 0;
		// margin: 0 0 calc(1.2em + var(--100vh, 1vh) * 1.2) 0;
	}

	.header .header-underline-img {
		width: 25%;
	}

	.header-container .content-paragraph:nth-child(2) {
		margin: calc(1rem + 1.2vh) 0 0 0;
		// margin: calc(1.2em + var(--100vh, 1vh) * 1.2) 0 0 0;
	}

	.option-panel {
		max-width: 25%;
	}

	.page-form h2.subheader,
	.option-panel .input-table {
		max-width: 100%;
		width: 100%;
	}

	.option-panel .input-table {
		flex: 1 0 70%;
	}

	.page-form .control-panel {
		flex: 1 0 auto;
		max-height: unset;
		min-height: unset;
		align-items: flex-start;
	}

	.option-panel .control-panel {
		margin-top: 0;
	}

	.optional-panel-wrapper {
		max-width: 32vw;
		max-width: calc(var(--100nvw, 1vw) * 32);
	}

	.optional-panel-wrapper {
		background: no-repeat center
			url("/images/16_9/inspiration-pg/left-inspiration-bg/fhd_1920*1080/jpg/16_9-fhd-2x-bg-left-inspiration-pg.jpg");

		background-size: 32vw 100vh;
		// background-size: calc(var(--100vw, 1vw) * 32) calc(var(--100vh, 1vh) * 100);

		height: 100vh;
		// height: calc(var(--100vh, 1vh) * 100);

		min-height: 100vh;
		// min-height: calc(var(--100vh, 1vh) * 100);
		overflow: auto;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	// @media only screen and (min-width: 320px) and (max-width: 640px) and (min-aspect-ratio: 13/9) {
	.control-panel .send-btn {
		width: 12.9583vw;
		// width: calc(var(--100vw, 1vw) * 12.9583);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* Styles */
	.optional-panel-wrapper {
		max-width: 26vw;
		max-width: calc(var(--100nvw, 1vw) * 26);
		width: 26vw;
		width: calc(var(--100nvw, 1vw) * 26);
	}

	.optional-panel-wrapper {
		background: no-repeat center
			url("/images/16_9/inspiration-pg/left-inspiration-bg/fhd_1920*1080/jpg/16_9-fhd-2x-bg-left-inspiration-pg.jpg");

		background-size: calc(var(--100nvw, 1vw) * 26) 100%;

		overflow: auto;
	}

	.info-msg {
		height: 64px;
	}

	.page-body,
	.page-form {
		max-height: unset;
		height: auto;
	}

	.page-form {
		flex-direction: row;

		justify-content: space-evenly;
		align-items: flex-start;

		max-width: 85vw;
		max-width: calc(var(--100nvw, 1vw) * 85);
		width: 85vw;
		width: calc(var(--100nvw, 1vw) * 85);

		margin: 1% auto auto 5%;
	}

	.option-panel__container {
		max-height: 90vh;
		max-height: calc(var(--100nvh, 1vh) * 90);
		overflow: auto;
	}

	.option-panel {
		flex: 1 0 auto;
		max-height: max(100%, 680px);
		min-height: 720px;
		height: auto;
		background: transparent;

		margin: 0 auto;
		margin-top: calc(1.5rem + var(--100nvh, 1vh) * 1);

		overflow: hidden;

		width: 85%;
		max-width: 85%;
	}

	.option-panel .input-table {
		display: flex;
		flex: 0 0 calc(var(--100nvh, 1vh) * 40);
		width: 100%;
		min-width: 280px;
		max-width: 290px;
		flex-direction: column;
		height: auto;
	}

	.option-panel .input-table div.input-cell {
		margin: calc(0.5em + 0.5vh) 0;
		margin: calc(0.5em + var(--100nvh, 0.5vh)) 0;
		min-height: min(max(calc(var(--100nvh, 1vh) * 6), 67px), 72px);
		padding: 0;
	}

	.option-panel .input-table * input {
		min-height: unset !important;
		height: unset !important;
	}

	.option-panel .input-table input[type="date"] {
		min-width: unset !important;
		border-bottom: unset !important;
	}

	.option-panel .input-table .date-container {
		border-bottom: 0.05rem solid #fff;
	}

	.option-panel .input-table .date-container input.user-field {
		padding: 1vh 0;
		padding: var(--100nvh, 1vh) 0;
	}

	.control-panel {
		flex: 1 0 35%;
		flex-direction: column;
		flex-wrap: nowrap;
		justify-content: stretch;
		max-height: 35%;
		height: 35%;
	}

	.agreement-container {
		margin: calc(0.5em + 0.5vh) 0;
		margin: calc(0.5em + var(--100nvh, 0.5vh)) 0;
	}

	.agreement-container .agreement-checkbox-container {
		margin: auto 1vw auto 0;
		margin: auto calc(var(--100nvw, 1vw)) auto 0;
	}

	.control-panel .agreement-container label.agreement-text {
		max-width: 70%;
	}

	.header-container .content-paragraph .header {
		width: fit-content;
		max-width: fit-content;
		margin: 0 0 calc(1.2em + 1.2vh) 0;
		margin: 0 0 calc(1.2em + var(--100nvh, 1.2vh)) 0;
	}

	.header-container .content-paragraph:nth-child(2) {
		margin: calc(1em + 1.2vh) 0 0 0;
		margin: calc(1em + var(--100nvh, 1.2vh)) 0 0 0;
	}

	.option-panel .input-table * label {
		font-size: 0.875rem;
	}

	.option-panel .input-table * input,
	.option-panel .input-table .user-field {
		font-size: 1.125rem;
		width: min(21.6vw, 311px);
		width: min(calc(var(--100nvw, 1vw) * 21.6), 311px);
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-width: 2048px) and (max-aspect-ratio: 159/100) {
	.header-container {
		margin-left: 35%;
	}

	.page-form {
		margin: auto auto auto 4%;
		max-width: 95vw;
		max-width: calc(var(--100nvw, 1vw) * 95);
		width: 95vw;
		width: calc(var(--100nvw, 1vw) * 95);
	}

	/* Styles */
	.optional-panel-wrapper {
		max-width: 32vw;
		max-width: calc(var(--100nvw, 1vw) * 32);
		width: 32vw;
		width: calc(var(--100nvw, 1vw) * 32);
	}

	.optional-panel-wrapper {
		background: no-repeat center
			url("/images/4_3/inspiration-pg/left-inspiration-pg/xl_1440*1024/jpg/4_3-xl-2x-bg-left-inspiration-pg.jpg");
		background-size: calc(var(--100nvw, 1vw) * 32) 100%;

		overflow: auto;
	}
}

@media only screen and (min-width: 1025px) and (max-height: 1079px) and (orientation: landscape) {
	.option-panel {
		width: 87%;
		max-width: 87%;
	}

	.optional-panel-wrapper {
		background-size: calc(var(--100nvw, 1vw) * 30) 100%;
	}

	.option-panel__container {
		max-height: 80vh;
		max-height: calc(var(--100nvh, 1vh) * 80);
		overflow: auto;
	}
}
</style>
