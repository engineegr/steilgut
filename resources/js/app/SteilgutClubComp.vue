<template>
	<div class="shrink-transit-flex-box tw-flex page-body">
		<!-- Desktop -->
		<div
			class="md:tw-block landscape:tw-hidden tw-hidden"
			v-if="!isMobileDevice()"
		>
			<lazy-load-image-comp
				basedLazyImgStyleClass="steilgut-club-pg-img"
				relativePath="steilgut-club-pg"
				baseName="bg-steilgut-club-pg"
				lqipPath_4_3="/images/4_3/steilgut-club-pg/lqip_4_3/jpg/4_3-lqip-bg-steilgut-club-pg.jpg"
				lqipPath_16_9="/images/16_9/steilgut-club-pg/lqip_16_9/jpg/16_9-lqip-bg-steilgut-club-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-inset-0 tw-object-fill tw-max-w-full tw-w-full"
				lazyLoadImgStyleClass_16_9=""
				lazyLoadImgStyleClass_4_3=""
				isDesktopAspectRatioCorrection="true"
			></lazy-load-image-comp>
		</div>

		<!-- Landscape -->
		<div class="md:tw-hidden landscape:tw-block tw-hidden">
			<lazy-load-image-comp
				basedLazyImgStyleClass="steilgut-club-pg-img"
				relativePath="steilgut-club-pg"
				baseName="bg-steilgut-club-pg"
				lqipPath_4_3="/images/4_3/steilgut-club-pg/lqip_4_3/jpg/4_3-lqip-bg-steilgut-club-pg.jpg"
				lqipPath_16_9="/images/16_9/steilgut-club-pg/lqip_16_9/jpg/16_9-lqip-bg-steilgut-club-pg.jpg"
				lazyLoadCommonImgStyleClass="tw-fixed tw-inset-0 tw-object-fill tw-max-w-full tw-w-full tw-max-h-screen tw-h-screen"
				isHiddenPortrait="true"
				isDesktopAspectRatioCorrection="false"
			></lazy-load-image-comp>
		</div>

		<!-- Portrait layouts -->
		<div class="md:tw-hidden landscape:tw-hidden tw-block tw-relative tw-inset-0">
			<lazy-load-image-comp
				basedLazyImgStyleClass="bg-steilgut-club-pg-img"
				relativePath="steilgut-club-pg"
				baseName="bg-steilgut-club-pg"
				lqipPath_portrait="/images/mobile/steilgut-club-pg/lqip/jpg/portrait-lqip-bg-steilgut-club-pg.jpg"
				basedPortraitLazyImgStyleClass="tw-relative tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-max-w-full tw-w-full"
				lazyLoadCommonImgStyleClass=""
				imgExt_portrait="jpg"
				isHiddenLandscape="true"
			></lazy-load-image-comp>

			<div class="header tw-absolute tw-z-2 tw-bottom-0 tw-left-0 tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase tw-p-4 tw-max-w-fit-min-content">
				<h1 class="header-text tw-text-left">{{ __("steilgutClub.header") }}</h1>
				<img
					class="header-underline-img"
					src="/images/icons/commons/header-underscore-line.svg"
				/>
			</div>
		</div>

		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div
			class="shrink-transit-flex-box tw-flex"
			v-else
		>
			<div v-if="isLoading">
				<pulse-logo-comp isDefer="true"></pulse-logo-comp>
			</div>
			<div class="page-form md:tw-flex landscape:tw-flex tw-hidden">
				<div class="option-panel">
					<h2 class="subheader tw-text-left">
						{{ __("steilgutClub.subheader") }}
					</h2>

					<div class="input-table">
						<div class="lfp-container input-cell">
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

						<div class="email-container input-cell">
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

						<div class="phone-container input-cell">
							<label
								for="phone"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
							>{{ __("contacts.phoneLabel") }}</label>
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
					</div>
				</div>

				<div class="header-container">
					<section class="content-paragraph tw-mx-auto">
						<div class="header tw-max-w-min-content tw-hidden landscape:tw-block md:tw-block">
							<h1 class="header-text tw-text-left">
								{{ __("steilgutClub.header") }}
							</h1>
							<img
								class="header-underline-img"
								src="/images/icons/commons/header-underscore-line.svg"
							/>
						</div>

						<transition-group name="fade">
							<div
								v-if="isSendError"
								key="isSendError_desktop"
							>
								<h2 class="is-send-error">
									{{ __("formalMessages.wentWrongMsg") }}
								</h2>
							</div>
							<div
								v-show="isSentMsg"
								key="isSentMsg_desktop"
							>
								<h2 class="is-msg-sent">
									{{ __("contacts.sentSuccessText") }}
								</h2>
							</div>
						</transition-group>

						<h2 class="content-subheader tw-block">
							{{ __("steilgutClub.1stPartSubheader") }}
						</h2>
						<span
							class="content-text tw-block tw-max-w-070"
							v-html="__('steilgutClub.1stPartText')"
						>{{ __("steilgutClub.1stPartText") }}</span>
					</section>

					<section class="content-paragraph tw-mx-auto">
						<h2 class="content-subheader tw-block">
							{{ __("steilgutClub.2ndPartSubheader") }}
						</h2>
						<span
							class="content-text tw-block tw-max-w-070"
							v-html="__('steilgutClub.2ndPartText')"
						>{{ __("steilgutClub.2ndPartText") }}</span>
					</section>
				</div>
			</div>
			<div class="page-form md:tw-hidden landscape:tw-hidden tw-flex tw-flex-col">
				<section class="content-paragraph tw-mx-auto">
					<h2 class="content-subheader tw-block">
						{{ __("steilgutClub.1stPartSubheader") }}
					</h2>
					<span
						class="content-text tw-block tw-max-w-full"
						v-html="__('steilgutClub.1stPartText')"
					>{{ __("steilgutClub.1stPartText") }}</span>
				</section>

				<section class="content-paragraph tw-mx-auto">
					<h2 class="content-subheader tw-block">
						{{ __("steilgutClub.2ndPartSubheader") }}
					</h2>
					<span
						class="content-text tw-block tw-max-w-full"
						v-html="__('steilgutClub.2ndPartText')"
					>{{ __("steilgutClub.2ndPartText") }}</span>
				</section>

				<transition-group name="fade">
					<div
						v-if="isSendError"
						key="isSendError_desktop"
					>
						<h2 class="is-send-error">
							{{ __("formalMessages.wentWrongMsg") }}
						</h2>
					</div>
					<div
						v-show="isSentMsg"
						key="isSentMsg_desktop"
					>
						<h2 class="is-msg-sent">
							{{ __("contacts.sentSuccessText") }}
						</h2>
					</div>
				</transition-group>

				<div class="option-panel">
					<h2 class="subheader tw-text-left">
						{{ __("degustation.subheader") }}
					</h2>

					<div class="input-table">
						<div class="lfp-container input-cell">
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

						<div class="email-container input-cell">
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

						<div class="phone-container input-cell">
							<label
								for="phone"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
							>{{ __("contacts.phoneLabel") }}</label>
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

						<div class="tw-inline-flex time-row md:tw-hidden landscape:tw-hidden">
							<div class="date-container input-cell tw-flex-1">
								<label
									for="date"
									:class="[
										{
											'is-invalid-field':
												errorsFor('date').length > 0,
										},
									]"
								>{{ __("common.date") }}</label>
								<input
									type="date"
									name="date"
									placeholder="23-06-2021"
									autocomplete="on"
									v-model="notification['date']"
									class="tw-appearance-none focus:tw-outline-none user-field"
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
								class="input-cell"
								:attributeName="__('common.time')"
							></drop-down-static-list-comp>
						</div>
						<div class="date-container input-cell tw-hidden landscape:tw-block md:tw-block">
							<label
								for="date"
								:class="[
									{
										'is-invalid-field': errorsFor('date').length > 0,
									},
								]"
							>{{ __("common.date") }}</label>
							<input
								type="date"
								name="date"
								placeholder="15 ноября"
								autocomplete="on"
								v-model="notification['date']"
								class="tw-appearance-none focus:tw-outline-none user-field"
								:class="[
									{
										'is-invalid-field': errorsFor('date').length > 0,
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
							class="tw-hidden landscape:tw-block md:tw-block"
							:attributeName="__('common.time')"
						></drop-down-static-list-comp>
					</div>

					<div class="control-panel tw-block">
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
import validationErrors from "../shared/mixins/validationErrors";
import mediaHelper from "../shared/mixins/mediaHelper";
import { refreshFullPageContainers } from "../shared/utils/resizer";
import { mapGetters, mapState } from "vuex";
import { Helper } from "../shared/utils/helper";
import { is422, is404, is500 } from "../shared/utils/response";

const dropDownStaticListComp = () =>
	import("../shared/components/DropDownStaticListComp");

const pulseLogoComp = () => import("../shared/components/PulseLogoComp");

export default {
	mixins: [validationErrors, mediaHelper],

	components: {
		"drop-down-static-list-comp": dropDownStaticListComp,
		"pulse-logo-comp": pulseLogoComp,
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

	data: function () {
		return {
			optionList: [{ isSelected: true }, { isSelected: false }],

			notification: {
				LFP: "Mark Twen",
				email: "mt@ya.ru",
				phone: "+7(962)660000",
			},

			agreement: false,

			isLoading: false,
			isError: false,
			status: null,
			isSentMsg: false,
			isSendError: false,
		};
	},

	methods: {
		handleOptionClick: function (event, index) {
			("use strict");
			this.optionList.forEach((item) => {
				item.isSelected = false;
			});

			this.optionList[index].isSelected = true;
		},

		sendNotification: async function (event) {
			("use strict");

			this.srvSideErrors = null;
			this.clientSideErrorMap = new Map();
			if (!this.$_validateNotification()) {
				return;
			}
			try {
				this.isLoading = true;
				this.isError = false;
				// make post request
				await axios.post("/api/steilgutClub/register", this.notification, {
					headers: {
						"Content-Type": "application/json",
					},
				});
			} catch (reject) {
				if (is404(reject) || is422(reject) || is500(reject)) {
					console.error(
						"Error [SteilgutClubComp::sendNotification] Status (500/422/404): " +
						reject.response.data.errors
					);
					this.srvSideErrors = reject.response.data.errors;
					this.isSendError = true;
				} else {
					this.isError = true;
					console.error(
						"Error [SteilgutClubComp::sendNotification] Unexpected error status: " +
						reject
					);
				}
				console.warn(
					"Warn [SteilgutClubComp::sendNotification] Error occurred " + reject
				);
				this.status = reject.response.status;
				this.srvSideErrors = reject.response.data.errors;
			} finally {
				this.isLoading = false;
				if (!this.hasErrors && !this.isSendError) {
					this.isSentMsg = true;
					setTimeout(() => {
						this.isSentMsg = false;
					}, 3000);
				}

				if (this.isSendError) {
					setTimeout(() => {
						this.isSendError = false;
					}, 3000);
				}
			}
		},

		$_validateNotification: function () {
			("use strict");

			console.log(
				"Debug [SteilgutClubComp:$_validateNotification] enter the function"
			);
			const lfpValidateStr = this.validateRequiredField(this.notification["LFP"]);
			if (lfpValidateStr !== "") {
				this.clientSideErrorMap.set("LFP", lfpValidateStr);
			}

			const emailValidateStr = this.validateEmail(this.notification["email"]);
			if (emailValidateStr !== "") {
				this.clientSideErrorMap.set("email", emailValidateStr);
			}

			const phoneValidateStr = this.validatePhoneNumber(this.notification["phone"]);
			if (phoneValidateStr !== "") {
				this.clientSideErrorMap.set("phone", phoneValidateStr);
			}

			const agreementValidateStr = this.validateConsentCheckbox(this.agreement);
			if (agreementValidateStr !== "") {
				this.clientSideErrorMap.set("agreement", agreementValidateStr);
			}

			const isValid =
				lfpValidateStr === "" &&
				emailValidateStr === "" &&
				phoneValidateStr === "" &&
				agreementValidateStr === "";
			return isValid;
		},

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
	},

	computed: {},
};
</script>

<style lang="scss" scoped>
@import '@/sass/commons.scss';
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
@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.page-form {
		flex-direction: row;

		justify-content: space-evenly;
		align-items: flex-start;

		max-width: 85vw;
		width: 85vw;

		max-height: unset;
		height: auto;
		margin: 2vh auto 7vh 3vw;
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
	}

	.agreement-container .agreement-checkbox-container {
		margin: auto 1vw auto 0;
	}

	.control-panel .agreement-container label.agreement-text {
		max-width: 90%;
	}

	.header-container .content-paragraph .header {
		min-width: 75%;
		margin: 0 0 calc(1.2em + 1.2vh) 0;
		margin: 0 0 calc(1.2em + var(--100vh, 1vh) * 1.2) 0;
	}

	.header .header-underline-img {
		width: 25%;
	}

	.header-container .content-paragraph:nth-child(2) {
		margin: calc(1em + 1.2vh) 0 0 0;
	}

	.option-panel {
		max-width: 25%;
	}

	.page-form h2.subheader,
	.option-panel .input-table {
		max-width: 100%;
		width: 100%;
	}

	.header-container {
		margin-top: -18vh;
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

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.page-form {
				margin: 2vh auto 7vh 3vw;
				margin: calc(var(--100vh, 1vh) * 2) auto
					calc(var(--100vh, 1vh) * 7) 3vw;
			}

			.header-container {
				margin-top: -18vh;
				margin-top: calc(var(--100vh, 1vh) * (-18));
			}

			.option-panel .input-table div.input-cell {
				margin: calc(0.5em + 0.5vh) 0;
				margin: calc(0.5em + var(--100vh, 1vh) * 0.5) 0;
			}

			.agreement-container {
				margin: calc(0.5em + 0.5vh) 0;
				margin: calc(0.5em + var(--100vh, 1vh) * 0.5) 0;
			}

			.header-container .content-paragraph .header {
				margin: 0 0 calc(1.2em + 1.2vh) 0;
				margin: 0 0 calc(1.2em + var(--100vh, 1vh) * 1.2) 0;
			}

			.header-container .content-paragraph:nth-child(2) {
				margin: calc(1em + 1.2vh) 0 0 0;
				margin: calc(1.2em + var(--100vh, 1vh) * 1.2) 0 0 0;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape) {
	.control-panel .send-btn {
		width: 12.9583vw;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	.page-form {
		margin: auto auto auto 4%;
		max-width: 95vw;
		max-width: calc(var(--100nvw, 1vw) * 95);
		width: 95vw;
		width: calc(var(--100nvw, 1vw) * 95);
	}

	.header-container .content-paragraph .header {
		min-width: 90%;
	}

	.option-panel .input-table {
		flex: 1 0 70%;
		max-width: 70%;
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.page-form {
		flex-direction: row;

		justify-content: space-evenly;
		align-items: flex-start;

		max-width: 85vw;
		max-width: calc(var(--100nvw, 1vw) * 85);
		width: 85vw;
		width: calc(var(--100nvw, 1vw) * 85);

		margin: auto auto auto 5%;
		max-height: 90%;
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
		margin: calc(0.5em + var(--100nvh, 0.5vh)) 0;
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
		min-width: 75%;
		margin: 0 0 calc(1.2em + 1.2vh) 0;
		margin: 0 0 calc(1.2em + var(--100nvh, 1.2vh)) 0;
	}

	.header .header-underline-img {
		width: 25%;
	}

	.header-container .content-paragraph:nth-child(2) {
		margin: calc(1em + 1.2vh) 0 0 0;
		margin: calc(1em + var(--100nvh, 1.2vh)) 0 0 0;
	}
}
</style>
