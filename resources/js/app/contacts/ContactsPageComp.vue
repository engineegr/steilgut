<template>
	<div
		class="contacts-pg md:tw-static md:tw-z-auto landscape:tw-relative landscape:tw-z-0 tw-relative tw-z-0 portrait-non-fp landscape-fp"
	>
		<div class="tw-hidden md:tw-flex desktop-contacts-pg">
			<div v-if="isLoading">
				<pulse-logo-comp isDefer="true"></pulse-logo-comp>
			</div>

			<sync-lazy-load-image-array-comp
				:key="imgArrayKeyForUpdate"
				:imagePropertyList="getBgImagePropertyList()"
				v-on:fully-loaded-img-list-event="handleFullyLoadedImgList"
				lqipPath_4_3="/images/4_3/contacts-pg/lqip_4_3/png/4_3-lqip-bg-contacts-pg.png"
				lqipPath_16_9="/images/16_9/contacts-pg/lqip_16_9/png/16_9-lqip-bg-contacts-pg.png"
			>
			</sync-lazy-load-image-array-comp>
			<steilgut-embeded-google-map
				:key="googleMapKeyForUpdate"
				class="travel-map-size"
				v-if="isGoogleMapOpened"
				:class="calcTravelMapStyleClass()"
				:style="calcLandscapeTravelMapStyleList"
			></steilgut-embeded-google-map>
			<!-- <travel-map-comp
				:key="googleMapKeyForUpdate"
				class="travel-map-size"
				v-if="isGoogleMapOpened"
				:class="calcTravelMapStyleClass()"
			></travel-map-comp> -->

			<transition name="contacts-pg-desktop-form-fade">
				<div
					class="contacts-pg-form"
					:key="contactsPgFormKeyForUpdate"
					:style="contactPgFormWidthStyle"
				>
					<div
						class="control-btn-container tw-cursor-pointer"
						v-on:click="handleMapStateChangeEvent"
						v-if="isMapOpened"
					>
						<img
							src="/images/orig/contacts-pg/control-minus-btn-icon/control-minus.svg"
							alt="Control minus map icon"
							class="minus-control-btn-icon control-btn centered"
						/>
					</div>
					<div
						class="control-btn-container tw-cursor-pointer"
						v-on:click="handleMapStateChangeEvent"
						v-else
					>
						<img
							src="/images/orig/contacts-pg/control-plus-btn-icon/control-plus.svg"
							alt="Control plus map icon"
							class="plus-control-btn-icon control-btn centered"
						/>
					</div>

					<div class="contacts-pg-form-content" v-if="!isMapOpened">
						<div class="header-container">
							<h1 class="header">{{ __("contacts.header") }}</h1>
							<div class="header-underline">
								<img
									class="title-underline-img"
									src="/images/orig/contacts-pg/contacts-form/underline.svg"
								/>
							</div>
						</div>

						<div class="informational-lines-container">
							<span class="informational-text">{{
								__("contacts.address")
							}}</span>
							<a
								class="informational-text tw-underline tw-text-steilgut-text-gray"
								href=""
								v-on:click.prevent="handleMapOpenEvent"
								>{{ __("contacts.seeMapPhrase") }}</a
							>
							<span class="informational-text">{{
								__("contacts.phone")
							}}</span>
							<a
								href="mailto: steilgut-weine.de"
								class="hover:tw-text-steilgut-gold tw-underline informational-text"
								>{{ __("contacts.email") }}</a
							>
						</div>

						<transition-group name="fade" class="informational-announcement">
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

						<p class="contact-to-us-header">
							{{ __("contacts.contactToUsPhrase") }}
						</p>

						<div class="user-fields-container tw-max-w-070 tw-w-70/10">
							<div
								class="user-fields-first-line-container tw-w-full tw-max-w-full"
							>
								<div class="LFP-container user-field">
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

								<div class="email-container user-field">
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
							</div>
							<div
								class="user-fields-second-line-container message-conatiner user-field tw-w-full tw-max-w-full"
							>
								<label
									class="field-title-text"
									for="notificationMsg"
									:class="[
										{
											'is-required-field':
												errorsFor('message').length > 0,
										},
									]"
								>
									{{ __("contacts.messageHeader") }}
								</label>
								<textarea
									name="notificationMsg"
									class="user-field tw-appearance-none focus:tw-outline-none tw-w-full tw-max-w-full"
									cols="30"
									rows="10"
									:placeholder="__('contacts.messagePlaceholder')"
									v-model="notification['message']"
									:class="[
										{
											'is-invalid-field':
												errorsFor('message').length > 0,
										},
									]"
								></textarea>
								<transition name="fade">
									<validation-error
										v-if="errorsFor('message').length > 0"
										:errors="errorsFor('message')"
									></validation-error>
								</transition>
							</div>

							<div
								class="contacts-control-container tw-w-full tw-max-w-full"
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
										src="/images/orig/contacts-pg/contacts-form/send-btn-next.svg"
										alt="Sending arrow"
									/>
								</button>
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
										class="agreement-text"
										for="notificationAgreement"
										:class="[
											{
												'is-required-field':
													errorsFor('agreement').length > 0,
											},
										]"
										>{{ __("contacts.agreementTitle") }}
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</transition>
		</div>
		<div class="md:tw-hidden mobile-contacts-pg">
			<div v-if="isLoading">
				<pulse-logo-comp isDefer="true"></pulse-logo-comp>
			</div>
			<div class="tw-flex tw-flex-col landscape:tw-hidden portrait-contacts-pg">
				<transition-group
					name="bg-img-fade"
					appear
					tag="div"
					class="tw-flex-grow travel-map-container"
				>
					<lazy-load-image-comp
						:key="bgMapContactsImgKey"
						basedLazyImgStyleClass="bg-map-contacts-img"
						relativePath="contacts-pg"
						baseName="bg-map-contacts-pg"
						lqipPath_portrait="/images/mobile/contacts-pg/lqip/portrait-lqip-bg-map-contacts-pg.jpg"
						lazyLoadCommonImgStyleClass=""
						:portraitControlLazyImgStyleClass="
							constBgImagePropertyList[0][
								'portraitControlLazyImgStyleClass'
							]
						"
						lqipStyleClass_portrait="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-object-fill tw-w-full tw-max-w-full"
						v-show="!isGoogleMapOpened"
					></lazy-load-image-comp>
					<!-- <travel-map-comp
						:key="googleMapKeyForUpdate"
						class="travel-map-size"
						v-if="
							((isMobileDevice() && isPortraitOrientation()) ||
								(!isMobileDevice() && isBrowserPortraitOrientation())) &&
							isGoogleMapOpened
						"
						:class="calcTravelMapStyleClass()"
					></travel-map-comp> -->

					<steilgut-embeded-google-map
						:key="googleMapKeyForUpdate"
						class="travel-map-size"
						v-if="isGoogleMapOpened"
						:class="calcTravelMapStyleClass()"
					></steilgut-embeded-google-map>
					<img
						key="minusIconUpdateKey"
						src="/images/orig/contacts-pg/control-minus-btn-icon/control-minus.svg"
						alt="Control minus map icon"
						class="minus-control-btn-icon tw-relative tw-z-3"
						v-if="isMapOpened"
						v-on:click="handleMapStateChangeEvent"
					/>
					<div
						key="headerContainerKey"
						v-show="!isMapOpened"
						class="header-container tw-relative tw-z-2"
					>
						<h1 class="header">
							{{ __("contacts.header") }}
						</h1>
						<div class="header-underline">
							<img
								class="title-underline-img"
								src="/images/orig/contacts-pg/contacts-form/underline.svg"
							/>
						</div>
					</div>
				</transition-group>
				<transition
					name="contacts-pg-portrait-form-fade"
					tag="div"
					class="tw-flex-grow"
				>
					<div class="contacts-pg-form" :key="contactsPgFormKeyForUpdate">
						<img
							v-if="!isMapOpened"
							src="/images/orig/contacts-pg/control-plus-btn-icon/control-plus.svg"
							alt="Control plus map icon"
							class="plus-control-btn-icon control-btn centered"
							v-on:click="handleMapStateChangeEvent"
						/>

						<div class="contacts-pg-form-content">
							<div class="informational-lines-container">
								<span class="informational-text">{{
									__("contacts.address")
								}}</span>
								<a
									class="informational-text tw-underline tw-text-steilgut-text-gray"
									href=""
									v-on:click.prevent="handleMapOpenEvent"
									>{{ __("contacts.seeMapPhrase") }}</a
								>
								<span
									class="informational-text informational-text-phone-email"
									>{{ __("contacts.phone") }}</span
								>
								<a
									href="mailto: steilgut-weine.de"
									class="hover:tw-text-steilgut-gold tw-underline informational-text informational-text-phone-email"
									>{{ __("contacts.email") }}</a
								>
							</div>

							<transition-group name="fade">
								<div v-show="isSendError" key="isSendError_portrait">
									<h2 class="is-send-error">
										{{ __("formalMessages.wentWrongMsg") }}
									</h2>
								</div>
								<div v-show="isSentMsg" key="isSentMsg_portrait">
									<h2 class="is-msg-sent">
										{{ __("contacts.sentSuccessText") }}
									</h2>
								</div>
							</transition-group>

							<p class="contact-to-us-header">
								{{ __("contacts.contactToUsPhrase") }}
							</p>

							<div class="user-fields-container">
								<div class="LFP-container user-field bottom-border-field">
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

								<div
									class="email-container user-field bottom-border-field"
								>
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
								<div class="user-field notification-msg">
									<label
										class="field-title-text"
										for="notificationMsg"
										:class="[
											{
												'is-required-field':
													errorsFor('message').length > 0,
											},
										]"
									>
										{{ __("contacts.messageHeader") }}
									</label>
									<textarea
										name="notificationMsg"
										class="user-field tw-appearance-none focus:tw-outline-none tw-w-full tw-max-w-full"
										cols="30"
										rows="10"
										:placeholder="__('contacts.messagePlaceholder')"
										v-model="notification['message']"
										:class="[
											{
												'is-invalid-field':
													errorsFor('message').length > 0,
											},
										]"
									></textarea>

									<transition name="fade">
										<validation-error
											v-if="errorsFor('message').length > 0"
											:errors="errorsFor('message')"
										></validation-error>
									</transition>
								</div>

								<div class="contacts-control-container">
									<div class="agreement-container tw-flex">
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
															errorsFor('agreement')
																.length > 0,
													},
												]"
											></span>
										</div>
										<label
											class="agreement-text"
											for="notificationAgreement"
											:class="[
												{
													'is-required-field':
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
											src="/images/orig/contacts-pg/contacts-form/send-btn-next.svg"
											alt="Sending arrow"
										/>
									</button>
								</div>
							</div>
						</div>
					</div>
				</transition>
			</div>
			<div class="tw-hidden landscape:tw-block landscape-contacts-pg">
				<transition-group name="bg-img-fade" appear>
					<sync-lazy-load-image-array-comp
						:key="imgArrayKeyForUpdate"
						:imagePropertyList="getBgImagePropertyList()"
						v-on:fully-loaded-img-list-event="handleFullyLoadedImgList"
						lqipPath_4_3="/images/4_3/contacts-pg/lqip_4_3/png/4_3-lqip-bg-contacts-pg.png"
						lqipPath_16_9="/images/16_9/contacts-pg/lqip_16_9/png/16_9-lqip-bg-contacts-pg.png"
					>
					</sync-lazy-load-image-array-comp>
					<!-- <travel-map-comp
						v-if="
							((isMobileDevice() && isLandscapeOrientation()) ||
								(!isMobileDevice() && isBrowserLandscapeOrientation())) &&
							isGoogleMapOpened
						"
						:key="googleMapKeyForUpdate"
						class="travel-map-size"
						:class="calcTravelMapStyleClass()"
					></travel-map-comp> -->

					<steilgut-embeded-google-map
						:key="googleMapKeyForUpdate"
						class="travel-map-size"
						v-if="isGoogleMapOpened"
						:class="calcTravelMapStyleClass()"
						:style="calcLandscapeTravelMapStyleList"
					></steilgut-embeded-google-map>
				</transition-group>

				<transition name="contacts-pg-desktop-form-fade" appear>
					<div
						class="contacts-pg-form"
						:key="contactsPgFormKeyForUpdate"
						:style="contactPgFormWidthStyle"
					>
						<div class="control-btn-container" v-if="isMapOpened">
							<img
								src="/images/orig/contacts-pg/control-minus-btn-icon/control-minus.svg"
								alt="Control minus map icon"
								class="minus-control-btn-icon control-btn centered"
								v-on:click="handleMapStateChangeEvent"
							/>
						</div>
						<div class="control-btn-container" v-else>
							<img
								src="/images/orig/contacts-pg/control-plus-btn-icon/control-plus.svg"
								alt="Control plus map icon"
								class="plus-control-btn-icon control-btn centered"
								v-on:click="handleMapStateChangeEvent"
							/>
						</div>

						<div class="contacts-pg-form-content" v-if="!isMapOpened">
							<div class="header-container">
								<h1 class="header">
									{{ __("contacts.header") }}
								</h1>
								<div class="header-underline">
									<img
										class="title-underline-img"
										src="/images/orig/contacts-pg/contacts-form/underline.svg"
									/>
								</div>
							</div>

							<div class="informational-lines-container">
								<span class="informational-text">{{
									__("contacts.address")
								}}</span>
								<a
									class="informational-text tw-underline tw-text-steilgut-text-gray"
									href=""
									v-on:click.prevent="handleMapOpenEvent"
									>{{ __("contacts.seeMapPhrase") }}</a
								>
								<span class="informational-text">{{
									__("contacts.phone")
								}}</span>
								<a
									href="mailto: steilgut-weine.de"
									class="hover:tw-text-steilgut-gold tw-underline informational-text"
									>{{ __("contacts.email") }}</a
								>
							</div>

							<transition-group
								name="fade"
								v-show="srvSideErrors || isSentMsg"
							>
								<div v-show="srvSideErrors" key="isSendError_landscape">
									<h2 class="is-send-error">
										{{ __("formalMessages.wentWrongMsg") }}
									</h2>
								</div>
								<div v-show="isSentMsg" key="isSentMsg_landscape">
									<h2 class="is-msg-sent">
										{{ __("contacts.sentSuccessText") }}
									</h2>
								</div>
							</transition-group>

							<p class="contact-to-us-header">
								{{ __("contacts.contactToUsPhrase") }}
							</p>

							<div class="user-fields-container tw-max-w-070 tw-w-7/10">
								<div
									class="user-fields-first-line-container tw-max-w-full tw-w-full"
								>
									<div class="LFP-container user-field">
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
									</div>

									<div class="email-container user-field">
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
									</div>
								</div>
								<div
									class="user-fields-second-line-container message-conatiner user-field tw-max-w-full tw-w-full"
								>
									<label
										class="field-title-text"
										for="notificationMsg"
										:class="[
											{
												'is-required-field':
													errorsFor('message').length > 0,
											},
										]"
									>
										{{ __("contacts.messageHeader") }}
									</label>
									<textarea
										name="notificationMsg"
										class="user-field tw-appearance-none focus:tw-outline-none tw-max-w-full tw-w-full"
										cols="30"
										rows="10"
										:placeholder="__('contacts.messagePlaceholder')"
										v-model="notification['message']"
										:class="[
											{
												'is-invalid-field':
													errorsFor('message').length > 0,
											},
										]"
									></textarea>
								</div>

								<div
									class="contacts-control-container tw-max-w-full tw-w-full"
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
											src="/images/orig/contacts-pg/contacts-form/send-btn-next.svg"
											alt="Sending arrow"
										/>
									</button>
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
															errorsFor('agreement')
																.length > 0,
													},
												]"
											></span>
										</div>
										<label
											class="agreement-text"
											for="notificationAgreement"
											:class="[
												{
													'is-required-field':
														errorsFor('agreement').length > 0,
												},
											]"
											>{{ __("contacts.agreementTitle") }}
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</transition>
			</div>
		</div>
	</div>
</template>

<script>
import DropDownBoxCompVue from "../../shared/components/DropDownBoxComp.vue";
import mediaHelper from "../../shared/mixins/mediaHelper";
import fullscreenCorrector from "../../shared/mixins/fullscreenCorrector";
import validationErrors from "../../shared/mixins/validationErrors";
import { is422 } from "../../shared/utils/response";
import PulseLogoComp from "../../shared/components/PulseLogoComp";

const syncLazyLoadImageArrayComp = () =>
	import("../../shared/components/SyncLazyLoadImageArrayComp");
// const travelMapComp = () => import("../../shared/components/map/TravelMap.vue");
const steilgutEmbededGoogleMap = () =>
	import("../../shared/components/map/SteilgutEmbededGoogleMap");

export default {
	mixins: [mediaHelper, validationErrors, fullscreenCorrector],

	components: {
		"sync-lazy-load-image-array-comp": syncLazyLoadImageArrayComp,
		// "travel-map-comp": travelMapComp,
		"steilgut-embeded-google-map": steilgutEmbededGoogleMap,
		"pulse-logo-comp": PulseLogoComp,
	},

	data() {
		return {
			constBgImagePropertyList: [
				{
					basedLazyImgStyleClass: "bg-map-contacts-pg-lazy-img",
					basedDesktopLazyImgStyleClass: "desktop-bg-map-contacts-pg-lazy-img",
					basedPortraitLazyImgStyleClass:
						"portrait-bg-map-contacts-pg-lazy-img",
					basedLandscapeLazyImgStyleClass:
						"landscape-bg-map-contacts-pg-lazy-img",

					portraitControlLazyImgStyleClass: "dummy-style-class",
					landscapeControlLazyImgStyleClass: "dummy-style-class",
					controlLazyImgStyleClass: "dummy-style-class",

					portraitControlLazyImgStyleList: "",
					landscapeControlLazyImgStyleList: "",
					controlLazyImgStyleList: "",

					lazyLoadCommonImgStyleClass:
						"tw-top-0 tw-bottom-0 tw-max-h-full tw-h-full",
					lazyLoadImgStyleClass_4_3: "tw-inset-0 tw-object-cover",
					transitionImgStyleClass_4_3: "fade-inOut-opacity",
					lazyLoadImgStyleClass_16_9: "tw-left-0 tw-object-cover",

					lazyLoadImgStyleClass_portrait:
						"tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-w-full tw-max-w-full tw-max-h-full tw-h-full",
					// transitionImgStyleClass_16_9: "contacts-pg-fade-inOut-opacity",
					transitionImgStyleClass_16_9: "fade-inOut-opacity",

					/*
					 * Template: /images/{xl|lg|md|sm|xs}/{relativePath}/{xl|lg|md|xs|sm}+{-2x}?-{baseName}+ - type is included in the baseName
					 */
					relativePath: "contacts-pg",

					baseName: "bg-map-contacts-pg",

					imgExt_4_3: ".jpg",
					imgExt_16_9: ".jpg",
					imgExt_portrait: "jpg",

					width: -1,
					height: -1,

					isHidden: false,
				},
				{
					basedLazyImgStyleClass: "bg-right-contacts-pg-lazy-img",
					basedDesktopLazyImgStyleClass:
						"desktop-bg-right-contacts-pg-lazy-img",

					basedPortraitLazyImgStyleClass:
						"portrait-bg-right-contacts-pg-lazy-img",

					basedLandscapeLazyImgStyleClass:
						"landscape-bg-right-contacts-pg-lazy-img",

					portraitControlLazyImgStyleClass: "dummy-style-class",
					landscapeControlLazyImgStyleClass: "dummy-style-class",
					controlLazyImgStyleClass: "dummy-style-class",

					portraitControlLazyImgStyleList: "",
					landscapeControlLazyImgStyleList: "height: auto",
					controlLazyImgStyleList: "",

					lazyLoadCommonImgStyleClass:
						"tw-top-0 tw-bottom-0 tw-max-h-full tw-h-full",
					lazyLoadImgStyleClass_4_3: "tw-right-0 tw-object-cover",
					transitionImgStyleClass_4_3: "fade-inOut-opacity",
					lazyLoadImgStyleClass_16_9: "tw-right-0 tw-object-cover",
					transitionImgStyleClass_16_9: "fade-inOut-opacity",

					/*
					 * Template: /images/{xl|lg|md|sm|xs}/{relativePath}/{xl|lg|md|xs|sm}+{-2x}?-{baseName}+ - type is included in the baseName
					 */
					// relativePath: "contacts-pg",
					relativePath: "based-terroir-pg",

					// baseName: "bg-right-contacts-pg",
					baseName: "bg-based-terroir-pg",

					imgExt_4_3: "jpg",
					imgExt_16_9: "jpg",
					imgExt_portrait: "jpg",

					width: -1,
					height: -1,

					isHidden: false,
				},
			],

			bgImagePropertyList: null,

			isMapOpened: false,
			isGoogleMapOpened: false,
			mainBoardKeyForUpdate: "mainBoardKeyForUpdate_0",
			imgArrayKeyForUpdate: "imgArrayKeyForUpdate_0",
			googleMapKeyForUpdate: "googleMapKeyForUpdate_0",
			bgMapContactsImgKey: "bgMapContactsImgKey_0",
			contactsPgFormKeyForUpdate: "contactsPgFormKeyForUpdate_0",

			contactPgFormWidthStyle: {
				width: -1,
				maxWidth: -1,
			},

			notification: {
				LFP: "",
				email: "",
				message: "",
			},
			agreement: false,

			srvSideErrors: null,

			status: null,
			isLoading: false,
			isSentMsg: false,
		};
	},

	created() {
		("use strict");
		// debugger;
		console.log("Debug [ContactsPageComp::created] enter the function");
		this.bgImagePropertyList = this.constBgImagePropertyList.slice(
			0,
			this.constBgImagePropertyList.length
		);

		if (this.isMobileDevice()) {
			const supportedOrientationChange = this.getOrientationChangeEventName();
			if (supportedOrientationChange === "change") {
				window.screen.orientation.addEventListener(
					supportedOrientationChange,
					this.resizeMobileEventCallback,
					false
				);
			} else {
				window.addEventListener(
					supportedOrientationChange,
					this.resizeMobileEventCallback,
					false
				);
			}
		} else {
			window.addEventListener("resize", this.resizeEventCallback, false);
			document.addEventListener(
				"fullscreenchange",
				this.resizeEventCallback,
				false
			);
		}
	},

	destroyed() {
		("use strict");
		// debugger;
		console.log("Debug [ContactsPageComp::destroyed] enter the function");
		window.removeEventListener("resize", this.resizeEventCallback);

		if (this.isMobileDevice()) {
			const supportedOrientationChange = this.getOrientationChangeEventName();
			if (supportedOrientationChange === "change") {
				window.screen.orientation.removeEventListener(
					supportedOrientationChange,
					this.resizeMobileEventCallback
				);
			} else {
				window.removeEventListener(
					supportedOrientationChange,
					this.resizeMobileEventCallback
				);
			}
		} else {
			window.removeEventListener("resize", this.resizeEventCallback);
			document.removeEventListener("fullscreenchange", this.resizeEventCallback);
		}
	},

	methods: {
		handleMapStateChangeEvent: function (event) {
			("use strict");
			console.log(
				"Debug [ContactsPageComp::handleMapStateChangeEvent] enter the function"
			);
			this.isMapOpened = !this.isMapOpened;
			this.$_handleMapStatusDimensions();
			this.$_updateMainComponents();
		},

		$_calcImageDimensions: function () {
			("use strict");
			for (let i = 0; i < this.constBgImagePropertyList.length; i++) {
				let bgImgElementList;
				if (this.isMobileDevice() || this.isBrowserPortraitOrientation()) {
					if (
						this.isPortraitOrientation() ||
						this.isBrowserPortraitOrientation()
					) {
						bgImgElementList = document.querySelectorAll(
							"." +
								this.constBgImagePropertyList[i]
									.basedPortraitLazyImgStyleClass
						);
					} else {
						bgImgElementList = document.querySelectorAll(
							"." +
								this.constBgImagePropertyList[i]
									.basedLandscapeLazyImgStyleClass
						);
					}
				} else {
					if (this.is4_3AspectRatio()) {
						bgImgElementList = document.querySelectorAll(
							"." +
								this.constBgImagePropertyList[i]
									.basedDesktopLazyImgStyleClass +
								"_img_4_3"
						);
					} else {
						bgImgElementList = document.querySelectorAll(
							"." +
								this.constBgImagePropertyList[i]
									.basedDesktopLazyImgStyleClass +
								"_img_16_9"
						);
					}
				}
				if (bgImgElementList.length >= 1) {
					let bgImgElement;
					bgImgElementList.forEach(function (item) {
						const nodeNameStr = item["nodeName"];
						if (
							nodeNameStr === "IMG" &&
							item.clientHeight > 0 &&
							item.clientWidth > 0
						) {
							bgImgElement = item;
						}
					});

					if (bgImgElement) {
						this.constBgImagePropertyList[i].width = bgImgElement.clientWidth;
						this.constBgImagePropertyList[i].height =
							bgImgElement.clientHeight;
						console.info(
							"Warning [ContactsPageComp::$_calcImageDimensions] Image: " +
								i +
								" client width: " +
								bgImgElement.clientWidth +
								" current src: " +
								bgImgElement.currentSrc
						);
					} else {
						console.warn(
							"Warning [ContactsPageComp::$_calcImageDimensions] Couldn't find the IMG element"
						);
					}
				} else {
					console.warn(
						"Warning [ContactsPageComp::$_calcImageDimensions] Couldn't find the image list"
					);
				}
			}
		},

		resizeEventCallback: _.debounce(
			function (event) {
				("use strict");
				this.isMapOpened = false;
				this.$_handleMapStatusDimensions();
				this.$_updateMainComponents();
			},
			50,
			{
				leading: true,
				trailing: true,
			}
		),

		resizeMobileEventCallback: function (event) {
			("use strict");

			if (this.isOrientationChanged()) {
				console.info(
					"Info [ContactsPageComp::resizeMobileEventCallback] Change orientation"
				);
				this.resizeEventCallback(event);
			}
		},

		$_resizePageHandler: function () {
			("use strict");
			// debugger;
			setTimeout(() => {
				const currDisplayState = this.calcDisplayOrientationState();
				if (this.displayState !== currDisplayState) {
					this.$_updateMainBoard();
					this.displayState = currDisplayState;
				}
			}, 500);
		},

		$_updateMainBoard: function () {
			("use strict");
			if (this.mainBoardKeyForUpdate === "mainBoardKeyForUpdate_0") {
				this.mainBoardKeyForUpdate = "mainBoardKeyForUpdate_1";
			} else {
				this.mainBoardKeyForUpdate = "mainBoardKeyForUpdate_0";
			}
		},

		/*
		 * Update contact page form and background images
		 */
		$_updateMainComponents: function () {
			("use strict");
			this.bgImagePropertyList = this.constBgImagePropertyList.slice(
				0,
				this.constBgImagePropertyList.length
			);

			if (this.contactsPgFormKeyForUpdate === "contactsPgFormKeyForUpdate_0") {
				this.contactsPgFormKeyForUpdate = "contactsPgFormKeyForUpdate_1";
			} else {
				this.contactsPgFormKeyForUpdate = "contactsPgFormKeyForUpdate_0";
			}

			if (this.googleMapKeyForUpdate === "googleMapKeyForUpdate_0") {
				this.googleMapKeyForUpdate = "googleMapKeyForUpdate_1";
			} else {
				this.googleMapKeyForUpdate = "googleMapKeyForUpdate_0";
			}
		},

		$_handleMapStatusDimensions: function () {
			("use strict");
			this.constBgImagePropertyList[1]["controlLazyImgStyleClass"] =
				"control-lazy-img";
			this.$_calcImageDimensions();

			if (this.isMapOpened) {
				if (this.isPortraitOrientation() || this.isBrowserPortraitOrientation()) {
					this.constBgImagePropertyList[0]["portraitControlLazyImgStyleClass"] =
						"tw-relative tw-z-0 tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-w-full tw-max-w-full travel-map-size";
				} else {
					if (this.is4_3AspectRatio()) {
						this.constBgImagePropertyList[1][
							"landscapeControlLazyImgStyleClass"
						] = "opened-right-contacts-pg-lazy-img";

						this.constBgImagePropertyList[1]["controlLazyImgStyleClass"] =
							"opened-right-contacts-pg-lazy-img";
					} else {
						if (
							this.constBgImagePropertyList[0].width > 0 ||
							this.constBgImagePropertyList[1].width > 0
						) {
							const wWidth = this.$root.$data.helper.getWindowSize()[
								"wWidth"
							];

							console.info(
								"INFO [ContactsPageComp::$_handleMapStatusDimensions] Display width " +
									wWidth
							);
							let leftOffset001 = -1;
							let leftOffset = -1;
							if (!this.isGoogleMapOpened) {
								leftOffset001 =
									wWidth - this.constBgImagePropertyList[0].width;

								leftOffset =
									this.constBgImagePropertyList[1].width -
									leftOffset001;

								if (
									Math.round(wWidth * 0.9) <=
									this.constBgImagePropertyList[0].width
								) {
									leftOffset =
										this.constBgImagePropertyList[1].width -
										Math.round(wWidth * 0.1);

									console.info(
										"INFO [ContactsPageComp::$_handleMapStatusDimensions] LOW left offest " +
											leftOffset +
											" Left image width: " +
											this.constBgImagePropertyList[0].width
									);
								} else {
									console.info(
										"INFO [ContactsPageComp::$_handleMapStatusDimensions] NORMAL left offest " +
											leftOffset
									);
								}
							} else {
								leftOffset =
									this.constBgImagePropertyList[1].width -
									Math.round(wWidth * 0.1);
							}

							const clipPathStyleStr =
								"clip-path: inset(0% 0% 0% " +
								leftOffset +
								"px); -webkit-clip-path: inset(0% 0% 0% " +
								leftOffset +
								"px);";

							const clipPathTransitionStr =
								"transition: clip-path,-webkit-clip-path 1s;";

							this.constBgImagePropertyList[1][
								"landscapeControlLazyImgStyleList"
							] = clipPathStyleStr;

							this.constBgImagePropertyList[1][
								"controlLazyImgStyleList"
							] = clipPathStyleStr;

							this.constBgImagePropertyList[1][
								"landscapeControlLazyImgStyleClass"
							] = "bg-right-contacts-pg-width-16_9";

							this.constBgImagePropertyList[1]["controlLazyImgStyleClass"] =
								"bg-right-contacts-pg-width-16_9";
						} else {
							throw new Error(
								"Error [ContactsPageComp::getContactsPgFormWidth] Map is opened but couldn't determine a width for the map image (aspect ratio > 4/3)"
							);
						}
					}
				}
			} else {
				this.isGoogleMapOpened = false;
				this.constBgImagePropertyList[0]["portraitControlLazyImgStyleClass"] =
					"dummy-style-class";

				this.constBgImagePropertyList[0]["landscapeControlLazyImgStyleClass"] =
					"dummy-style-class";

				this.constBgImagePropertyList[0]["controlLazyImgStyleClass"] =
					"dummy-style-class";

				this.constBgImagePropertyList[1]["portraitControlLazyImgStyleList"] =
					"reset";

				this.constBgImagePropertyList[1]["landscapeControlLazyImgStyleList"] =
					"reset";

				this.constBgImagePropertyList[1]["controlLazyImgStyleList"] = "reset";

				this.constBgImagePropertyList[0].isHidden = false;

				if (this.isPortraitOrientation() || this.isBrowserPortraitOrientation()) {
					this.constBgImagePropertyList[0]["portraitControlLazyImgStyleClass"] =
						"tw-absolute tw-z-0 tw-top-0 tw-left-0 tw-right-0 tw-object-cover tw-w-full tw-max-w-full";
				} else {
					if (this.is4_3AspectRatio()) {
						this.constBgImagePropertyList[1][
							"landscapeControlLazyImgStyleClass"
						] = "bg-right-contacts-pg-width-4_3";
						this.constBgImagePropertyList[1]["controlLazyImgStyleClass"] =
							"bg-right-contacts-pg-width-4_3";
					} else {
						this.constBgImagePropertyList[1][
							"landscapeControlLazyImgStyleClass"
						] = "bg-right-contacts-pg-width-16_9";
						this.constBgImagePropertyList[1]["controlLazyImgStyleClass"] =
							"bg-right-contacts-pg-width-16_9";
					}
				}
			}

			this.$_calcContactsPgFormWidthStyle();
		},

		handleFullyLoadedImgList: function (event) {
			("use strict");
			console.log(
				"Debug [ContactsPageComp::handleFullyLoadedImgList] Images are fully loaded"
			);
			this.$_handleMapStatusDimensions();
			this.$_updateMainComponents();
		},

		$_calcContactsPgFormWidthStyle: function () {
			("use strict");
			console.log(
				"Debug [ContactsPageComp::$_calcContactsPgFormWidthStyle] Enter the function"
			);

			if (this.isMapOpened) {
				if (this.is4_3AspectRatio()) {
					this.contactPgFormWidthStyle = {
						maxWidth: 5 + "vw",
						width: 5 + "vw",
					};
				} else if (
					this.constBgImagePropertyList[0].width > 0 ||
					this.isGoogleMapOpened
				) {
					const wWidth = this.$root.$data.helper.getWindowSize()["wWidth"];
					let w;
					let wStr = wWidth - this.constBgImagePropertyList[0].width;
					if (
						Math.round(wWidth * 0.9) <=
							this.constBgImagePropertyList[0].width ||
						this.isGoogleMapOpened
					) {
						wStr = 10 + "vw";
					}
					this.contactPgFormWidthStyle = {
						maxWidth: wStr,
						width: wStr,
					};
				} else {
					throw new Error(
						"Error [ContactsPageComp::getContactsPgFormWidth] Map is opened but couldn't determine a width for the map image (aspect ratio > 4/3)"
					);
				}
			} else {
				if (this.is4_3AspectRatio()) {
					this.contactPgFormWidthStyle = {
						maxWidth: 67.2222 + "vw",
						width: 67.2222 + "vw",
					};
				} else {
					this.contactPgFormWidthStyle = {
						maxWidth: 62.7344 + "vw",
						width: 62.7344 + "vw",
					};
				}
			}
		},

		sendNotification: async function (event) {
			("use strict");
			// debugger;
			console.log("Debug [ContactsPageComp:sendNotification] enter the function");
			this.srvSideErrors = null;
			this.clientSideErrorMap = new Map();
			this.isLoading = true;
			this.status = null;
			this.isSentMsg = false;

			try {
				this.$_validateNotification();

				if (this.clientSideErrorMap.size === 0) {
					// make post request
					await axios.post("/api/contacts/sendNotification", {
						notification: this.notification,
					});
				}
			} catch (error) {
				console.warn(
					"Warn [ContactsPageComp::sendNotification] Error occurred " + error
				);
				this.status = error.response.status;
				this.srvSideErrors = error.response.data.errors;
				this.status = erorr.response.status;
			} finally {
				this.isLoading = false;
				if (!this.hasErrors) {
					this.isSentMsg = true;
					setTimeout(() => {
						this.isSentMsg = false;
					}, 3000);
				}
			}
		},

		$_validateNotification: function () {
			("use strict");
			console.log(
				"Debug [ContactsPageComp:$_validateNotification] enter the function"
			);
			const lfpValidateStr = this.validateRequiredField({
				fieldTitle: "LFP",
				fieldValue: this.notification["LFP"],
			});
			if (lfpValidateStr !== "") {
				this.clientSideErrorMap.set("LFP", lfpValidateStr);
			}

			const messageValidateStr = this.validateRequiredField({
				fieldTitle: "message",
				fieldValue: this.notification["message"],
			});
			if (messageValidateStr !== "") {
				this.clientSideErrorMap.set("message", messageValidateStr);
			}

			const emailValidateStr = this.validateEmail(this.notification["email"]);
			if (emailValidateStr !== "") {
				this.clientSideErrorMap.set("email", emailValidateStr);
			}

			const agreementValidateStr = this.validateConsentCheckbox(this.agreement);
			if (agreementValidateStr !== "") {
				this.clientSideErrorMap.set("agreement", agreementValidateStr);
			}
		},

		handleMapOpenEvent: function (event) {
			// debugger;
			this.isMapOpened = true;
			this.isGoogleMapOpened = true;
			this.constBgImagePropertyList[0].controlLazyImgStyleClass = "tw-opacity-0";
			this.constBgImagePropertyList[0].isHidden = true;

			this.$_googleMapOpeningUpdateComponents();
		},

		$_googleMapOpeningUpdateComponents: function () {
			("use strict");
			if (this.imgArrayKeyForUpdate === "imgArrayKeyForUpdate_0") {
				this.imgArrayKeyForUpdate = "imgArrayKeyForUpdate_1";
			} else {
				this.imgArrayKeyForUpdate = "imgArrayKeyForUpdate_0";
			}

			if (this.contactsPgFormKeyForUpdate === "contactsPgFormKeyForUpdate_0") {
				this.contactsPgFormKeyForUpdate = "contactsPgFormKeyForUpdate_1";
			} else {
				this.contactsPgFormKeyForUpdate = "contactsPgFormKeyForUpdate_0";
			}

			if (this.googleMapKeyForUpdate === "googleMapKeyForUpdate_0") {
				this.googleMapKeyForUpdate = "googleMapKeyForUpdate_1";
			} else {
				this.googleMapKeyForUpdate = "googleMapKeyForUpdate_0";
			}
		},

		$_calcMinusControlIconStyle: function () {
			("use strict");
			console.log(
				"Debug [ContactsPageComp::calcMinusControlIconStyleClass] Enter the function"
			);
			// debugger;
			this.$_calcImageDimensions();
			const mapImgHeight = this.constBgImagePropertyList[0].height;
			if (mapImgHeight > 0) {
				const minusIconImage = document.querySelector(".minus-control-btn-icon");
				if (!minusIconImage) {
					throw new Error(
						"Error [ContactsPageComp::calcMinusControlIconStyle] Couldn't find minus icon image"
					);
				}
				const iconHeight = mapImgHeight - Math.round(minusIconImage.height / 2);
				return {
					top: `${iconHeight}px`,
					left: "50%",
				};
			}
			return {
				top: -1,
				left: "50%",
			};
		},

		calcTravelMapStyleClass() {
			if (this.isPortraitOrientation() || this.isBrowserPortraitOrientation()) {
				return "tw-absolute tw-inset-0 tw-z-0";
			}
			return "tw-absolute tw-top-0 tw-bottom-0 tw-z-0";
		},

		getBgImagePropertyList() {
			return this.bgImagePropertyList
				? this.bgImagePropertyList
				: this.constBgImagePropertyList;
		},
	},

	computed: {
		hasErrors() {
			return this.hasSrvSideErrors || this.hasClientSideErrors || this.isSendError;
		},

		hasSrvSideErrors() {
			return (this.status == 422 && this.srvSideErrors) || this.isSendError;
		},

		hasClientSideErrors() {
			return this.clientSideErrorMap && this.clientSideErrorMap.size > 0;
		},

		isSendError() {
			return this.status && this.status !== 422;
		},

		calcLandscapeTravelMapStyleList() {
			return `right: ${this.contactPgFormWidthStyle["width"]};`;
		},
	},
};
</script>

<style lang="scss">
/*
 * Contacts page
*/
.zero-margin {
	margin: 0 !important;
}

.bg-right-contacts-pg-width-4_3 {
	max-width: 67.2222vw;
	width: 67.2222vw;
}

.bg-right-contacts-pg-width-16_9 {
	max-width: 62.7344vw;
	width: 62.7344vw;
}

.opened-right-contacts-pg-lazy-img {
	clip-path: inset(0% 0% 0% 95%);
}

.opened-contacts-pg-form-width {
	width: 5vw;
	max-width: 5vw;
	transition: width 3s;
}

.contacts-pg-fade-inOut-opacity {
	transition-property: opacity;
	transition-duration: 1.5s;
	transition-delay: 0.5s;
	transition-timing-function: ease-in-out;
}

.contacts-pg-right-fade {
	transition-property: clip-path opacity;
	transition-duration: 3s;
	transition-delay: 1.5s;
	transition-timing-function: ease-in-out;
}

/*
 * END: Contacts page 
*/

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.bg-map-contacts-pg-lazy-img,
	.bg-right-contacts-pg-lazy-img {
		position: absolute;
	}

	.travel-map-size {
		width: 100%;
		height: 100%;
		height: 100vh;
		height: calc(var(--100vh, 1vh) * 100);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.travel-map-size {
				width: 100%;
				height: 100%;
				height: 100vh;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.bg-map-contacts-pg-lazy-img,
	.bg-right-contacts-pg-lazy-img {
		position: absolute;
	}

	.bg-map-contacts-pg-lazy-img {
		min-width: 40vw;
	}
}

@media only screen and (min-device-width: 320px) and (max-device-width: 1024px) and (orientation: landscape) {
	.bg-map-contacts-pg-lazy-img,
	.bg-right-contacts-pg-lazy-img {
		position: fixed;
	}
}

/* Laptops, desktops, large screens ----------- */
@media only screen and (min-width: 1025px) and (max-width: 3840px) and (-webkit-min-device-pixel-ratio: 1) {
	.bg-map-contacts-pg-lazy-img,
	.bg-right-contacts-pg-lazy-img {
		position: absolute;
	}
}
</style>

<style scoped lang="scss">
.fade-enter-active,
.fade-leave-active {
	transition: opacity 3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

/**
 * ==============================================
 * Dot Pulse: https://codepen.io/nzbin/pen/GGrXbp
 * ==============================================
 */
.dot-pulse {
	position: relative;
	left: -53vw;
	width: 1vw;
	height: 1vw;
	border-radius: 0.5vw;
	background-color: #ebcb9a;
	color: #ebcb9a;
	box-shadow: 49.5vw 0 0 -0.5vw #ebcb9a;
	animation: dotPulse 3s infinite linear;
	animation-delay: 0.25s;
}

.dot-pulse::before,
.dot-pulse::after {
	content: "";
	display: inline-block;
	position: absolute;
	width: 1vw;
	height: 1vw;
	border-radius: 0.5vw;
	top: 0;

	background-color: #ebcb9a;
	color: #ebcb9a;
}

.dot-pulse::before {
	box-shadow: 0.5vw 0 0vw 1vw #ebcb9a;
	animation: dotPulseBefore 3s infinite linear;
	animation-delay: 0s;
}

.dot-pulse::after {
	box-shadow: 1.5vw 0 0vw 1vw #ebcb9a;
	animation: dotPulseAfter 3s infinite linear;
	animation-delay: 0.5s;
}

@keyframes dotPulseBefore {
	0% {
		box-shadow: 49vw 0 0.3vw -1vw #ebcb9a;
	}
	30% {
		box-shadow: 49vw 0 0.3vw 0vw #ebcb9a;
	}
	60%,
	100% {
		box-shadow: 49vw 0 0.3vw -1vw #ebcb9a;
	}
}

@keyframes dotPulse {
	0% {
		box-shadow: 50vw 0 0.3vw -1vw #ebcb9a;
	}
	30% {
		box-shadow: 50vw 0 0.3vw 0.5vw #ebcb9a;
	}
	60%,
	100% {
		box-shadow: 50vw 0 0.3vw -1vw #ebcb9a;
	}
}

@keyframes dotPulseAfter {
	0% {
		box-shadow: 51vw 0 0.3vw -1vw #ebcb9a;
	}
	30% {
		box-shadow: 51vw 0 0.3vw 0.5vw #ebcb9a;
	}
	60%,
	100% {
		box-shadow: 51vw 0 0.3vw -1vw #ebcb9a;
	}
}

.contacts-pg {
	display: flex;
	flex: 1 0 82%;
	height: 82%;
	width: 100%;
	max-width: 100%;
	align-items: stretch;
}

.desktop-contacts-pg,
.mobile-contacts-pg,
.portrait-contacts-pg,
.landscape-contacts-pg {
	display: flex;
	flex: 1 0 auto;
	align-items: stretch;
}

.contacts-pg-form {
	display: flex;
	flex: 1 0 100%;
	flex-direction: row;
	justify-content: flex-start;
	align-items: stretch;

	max-width: 62.7344%;
	width: 62.7344%;

	max-height: 100%;

	margin: 0 0 0 auto;
	/* border: 2px solid #ebcb9a; */

	position: relative;
	z-index: 2;
}

.control-btn-container {
	margin: auto auto auto 0;
	max-width: 2.7037%;
	width: 2.7037%;

	position: relative;
	z-index: 1;
}

.control-btn-container img {
	max-width: unset !important;
}

.control-btn-circle {
	opacity: 0%;
	max-width: 2.7037vw;
	max-width: calc(var(--100nvw, 1vw) * 2.7037);

	width: 2.7037vw;
	width: calc(var(--100nvw, 1vw) * 2.7037);
	height: 2.7037vw;
	height: calc(var(--100nvw, 1vw) * 2.7037);
	background: #c4bbaa;
	border-radius: 50%;
	position: absolute;
	top: 0%;
	left: 0%;
	transform: translate(-50%, -50%);
}

.control-btn-circle:active {
	animation: bubble-btn-anim 1.25s;
}

@keyframes bubble-btn-anim {
	from {
		transform: translate(-50%, -50%) scale(1.5);
		opacity: 25%;
	}

	to {
		transform: translate(-50%, -50%) scale(2.5);
		opacity: 75%;
	}
}

.bg-img-fade-enter-active,
.bg-img-fade-leave-active {
	transition: opacity 1s ease;
}
.bg-img-fade-enter
/* .component-fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.bg-img-fade-leave-to {
	display: none;
}

.contacts-pg-desktop-form-fade-enter-active {
	transition: opacity 3s ease;
}

.contacts-pg-desktop-form-fade-enter
/* .component-fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.contacts-pg-desktop-form-fade-leave {
	display: none;
}

.contacts-pg-portrait-form-fade-enter-active {
	transition: opacity 3s ease;
}

.contacts-pg-portrait-form-fade-enter
/* .component-fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.contacts-pg-portrait-form-fade-leave {
	opacity: 0;
}

.contacts-pg-form-content {
	display: flex;
	flex-direction: column;
	flex: 1 0 95%;

	max-height: 100%;
	min-height: 95%;

	justify-content: center;
	align-items: flex-start;

	margin: auto auto auto 0;
	padding-left: 5.89583vw;
	padding-left: calc(var(--100nvw, 1vw) * 5.89583);

	position: relative;
	z-index: 1;
}

.contacts-pg-form-content .header,
.contacts-pg-form-content .contact-to-us-header,
.contacts-pg-form-content .informational-text {
	color: #fff;
}

.contacts-pg-form-content .field-title {
	color: #ebcb9a;
}

.contacts-pg-form-content h1.header,
.contacts-pg-form-content .contact-to-us-header {
	font-family: "steilgut_cormorant";
	font-weight: 100;
	font-size: calc(1em + 0.7vw);
	font-size: calc(1em + var(--100nvw, 1vw) * 0.7);
}

.contacts-pg-form-content h1.header {
	font-size: calc(1em + 1vw);
	font-size: calc(1em + var(--100nvw, 1vw));
	margin: auto auto 1vh auto;
	margin: auto auto var(--100nvh, 1vh) auto;
}

.contacts-pg-form-content .header-container img.title-underline-img {
	max-width: 60%;
}

.contacts-pg-form-content .contact-to-us-header {
	font-size: calc(0.7em + 0.7vw);
	font-size: calc(0.7em + var(--100nvw, 1vw) * 0.7);
	text-transform: capitalize;
}

.contacts-pg-form-content .informational-text {
	font-family: "steilgut_opensans";
	font-weight: lighter;
}

.contacts-pg-form-content .informational-text,
.contacts-pg-form-content .field-title-text,
.contacts-pg-form-content .user-field,
.contacts-pg-form-content .send-btn .send-btn-text {
	font-family: "steilgut_opensans";
	font-weight: lighter;
}

.contacts-pg-form-content .informational-text {
	font-size: calc(0.5em + 0.5vw);
	font-size: calc(0.5em + var(--100nvw, 1vw) * 0.5);
}

.contacts-pg-form-content .field-title-text,
.contacts-pg-form-content label.agreement-text {
	font-size: calc(0.4em + 0.4vw);
	font-size: calc(0.4em + var(--100nvw, 1vw) * 0.4);
	color: #c4bbaa;
}

.contacts-pg-form-content .user-field {
	font-size: calc(0.4em + 0.6vw);
	font-size: calc(0.4em + var(--100nvw, 1vw) * 0.6);
}

/* Required field css marks */
.contacts-pg-form-content label.is-required-field::after {
	content: " *";
	color: #af7977 !important;
}

.contacts-pg-form-content input.is-invalid-field {
	border-bottom: 0.05em solid #af7977 !important;
}

.contacts-pg-form-content textarea.is-invalid-field {
	border: 0.05em solid #af7977 !important;
}

.contacts-pg-form-content span.is-invalid-field {
	border: 0.05em solid #af7977 !important;
}

.contacts-pg-form-content button.send-btn:disabled {
	filter: opacity(0.25) !important;
}

.contacts-pg-form-content h2.is-send-error {
	color: #af7977 !important;
	font-family: "steilgut_opensans";
	font-weight: lighter;
	font-size: calc(0.8em + 0.8vw);
	font-size: calc(0.8em + var(--100nvw, 1vw) * 0.8);
	padding: 1vh 0;
	padding: var(--100nvh, 1vh) 0;
}

h2.is-msg-sent {
	// color: #ebcb9a !important;
	color: #ffffcc;
	font-family: "steilgut_opensans";
	font-weight: lighter;
	font-size: calc(0.8em + 0.8vw);
	font-size: calc(0.8em + var(--100nvw, 1vw) * 0.8);
}

.LFP-container {
	margin-right: 2vw;
}

.contacts-pg-form-content .contacts-control-container {
	flex: 1 0 auto;
	display: flex;
	flex-direction: row;
	justify-content: flex-start;
	align-items: center;
}

.contacts-pg-form-content .send-btn {
	background-image: url("/images/orig/contacts-pg/contacts-form/send-btn-bg.png");
	background-size: cover;
	background-repeat: no-repeat;

	background-color: #3434;
	filter: opacity(0.75) brightness(1.1);

	width: 8.9583vw;
	width: calc(var(--100nvw, 1vw) * 8.9583);
	height: 4.62963vh;
	height: calc(var(--100nvh, 1vh) * 4.62963);
	color: #313131;

	display: flex;
	flex-direction: row;
	justify-content: space-evenly;
	align-items: center;
}

.contacts-pg-form-content .send-btn .send-btn-text {
	/* flex-grow: 1; */
	margin: auto 0 auto auto;
	display: inline-block;
	font-size: calc(0.4em + 0.6vw);
	font-size: calc(0.4em + var(--100nvw, 1vw) * 0.6);
}

.contacts-pg-form-content .send-btn .send-btn-arrow {
	max-width: 10%;
	width: 10%;
	margin: auto;
}

.contacts-pg-form-content label.agreement-text {
	margin: auto 0;
	font-size: calc(0.5em + 0.3vh);
	font-size: calc(0.5em + var(--100nvh, 1vh) * 0.3);
	color: #fff;
}

.contacts-pg-form-content .informational-lines-container {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	margin: 3vh 0;
	margin: calc(var(--100nvh, 1vh) * 3) 0;
}

.contacts-pg-form-content .informational-lines-container .informational-text {
	margin: 0.5vh 0;
	margin: calc(var(--100nvh, 1vh) * 0.5) 0;
}

.contacts-pg-form-content .contact-to-us-header {
	margin: 2vh 0;
	margin: calc(var(--100nvh, 1vh) * 2) 0;
	text-transform: uppercase;
}

.contacts-pg-form .user-fields-container {
	display: flex;
	flex-direction: column;
	flex: 1 0 auto;
}

.contacts-pg-form .user-fields-container > * {
	margin: 1vmin 0;
	margin: var(--100nvmin, 1vmin) 0;
}

.contacts-pg-form-content .user-fields-container .user-fields-first-line-container {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	justify-content: space-between;
	align-items: center;
}

.contacts-pg-form-content .user-fields-container .user-field {
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	justify-content: center;
	align-items: flex-start;
	margin-left: 0;
}

.contacts-pg-form-content .user-fields-first-line-container .email-container input {
	align-self: stretch;
}

.contacts-pg-form-content .user-fields-first-line-container input {
	background: transparent;
	border-bottom: 0.05em solid #c4bbaa;
	padding: 1vh 0;
	padding: var(--100nvh, 1vh) 0;
}

.contacts-pg-form-content .user-fields-second-line-container {
	margin: 0 auto;
}

.contacts-pg-form-content .user-fields-container textarea {
	width: 30vw;
	width: calc(var(--100nvw, 1vw) * 30);
	height: 10vh;
	height: calc(var(--100nvh, 1vh) * 10);
	border: 0.05em solid #c4bbaa;
	background: transparent;
	resize: none;
	padding: 2.5vh 1vw;
	padding: calc(var(--100nvh, 1vh) * 2.5) var(--100nvw, 1vw);
}

.contacts-pg-form-content .user-fields-first-line-container label {
	margin: 0;
}

.contacts-pg-form-content .user-fields-second-line-container label {
	margin: 1vh 0;
	margin: var(--100nvh, 1vh) 0;
}
.agreement-container {
	.agreement-checkbox-container {
		.checkmark {
			border-color: #ffffff;
		}

		.checkmark::after {
			filter: brightness(3.2);
		}
	}
}

.travel-map-size {
	width: 100%;
	height: 100%;
	height: 100vh;
	height: calc(var(--100nvh, 1vh) * 100);
}

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/

/* Laptops, desktops, large screens */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.agreement-container {
		.agreement-checkbox-container {
			margin-left: 21px;

			.checkmark::after {
				left: 16%;
			}
		}
	}

	.informational-announcement {
		height: 52px;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	/* Styles */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.contacts-pg-form {
		max-width: 67.2222vw;
		width: 67.2222vw;
	}

	.contacts-pg-form-content {
		margin: auto auto auto 0;
		padding-left: 5.89583vw;
	}

	.contacts-pg-form-content .send-btn {
		width: 11.9444vw;
		height: 4.8828vh;
	}

	.informational-announcement {
		height: 90px;
		display: flex;
		justify-content: center;
		align-items: center;
	}
}

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) {
	/* remove rounding corners */
	textarea,
	input[type="text"],
	input[type="button"],
	input[type="submit"] {
		-webkit-appearance: none !important;
		border-radius: 0 !important;
	}

	.contacts-pg-form .control-btn {
		z-index: 9;
		position: absolute;
	}
}

@media only screen and (min-width: 320px) and (max-height: 568px) and (orientation: portrait) {
	.contact-pg {
		margin-top: -13vh;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.header-container {
		margin: 35.66666667vh auto 5vh 6.388889vw;
		margin: calc(var(--100vh, 1vh) * 35.66666667) auto calc(var(--100vh, 1vh) * 5)
			6.388889vw;
	}

	.portrait-contacts-pg {
		max-width: 100vw;
		width: 100vw;
	}

	.contacts-pg {
		height: auto;
		max-height: unset;
		margin-top: -15vh;
	}

	.contacts-pg-form {
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: center;
		align-items: stretch;

		height: auto;
		max-height: unset; /* general value: 80vh */

		width: 100%;
		max-width: 100%;

		margin: 0 auto 0 auto;
		border: 2px solid #ebcb9a;

		position: relative;
		z-index: 2;
		background-color: #343434;
	}

	.control-btn-container {
		margin: 0 auto 0 auto;
	}

	.minus-control-btn-icon {
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.contacts-pg-form-content {
		flex: 1 0 auto;
		max-height: unset;
		min-height: unset;
		height: auto;

		justify-content: center;
		align-items: stretch;
		padding: 0;

		position: relative;
		z-index: 2;

		padding: 0 5vw 0 5vw;
		margin: 0;
	}

	.user-fields-container {
		display: flex;
		flex: 1 0 auto;
		align-items: stretch;
		justify-content: center;
		flex-direction: column;
	}

	.contacts-pg-form .control-btn {
		left: 50%;
	}

	.contacts-pg-form-content .informational-lines-container .informational-text {
		font-size: calc(0.6rem + 2vw);
		margin: 0.5vh 0;
		margin: calc(var(--100vh, 1vh) * 0.5) 0;
	}

	.contacts-pg-form-content .informational-lines-container {
		flex: 0 0 auto;
		margin: 6vh 0;
		margin: calc(var(--100vh, 1vh) * 6) 0;
	}

	.informational-text-phone-email {
		margin: 1.7vh 0;
		margin: calc(var(--100vh, 1vh) * 1.7) 0;
	}

	.contacts-pg-form .user-fields-container {
		flex: 0 0 auto;
	}

	.contacts-pg-form-content .contact-to-us-header {
		font-size: calc(1rem + 1.5vw);
		margin: 2vh 0;
		margin: calc(var(--100vh, 1vh) * 2) 0;
	}

	.contacts-pg-form-content label.field-title-text,
	.contacts-pg-form-content h2.is-send-error,
	h2.is-msg-sent {
		font-size: calc(0.8rem + 0.8vh);
		font-size: calc(0.8rem + var(--100vh, 1vh) * 0.8);
	}

	.contacts-pg-form-content div.user-field {
		font-size: calc(0.4rem + 0.6vw);
		padding: 1.5vh 0;
		padding: calc(var(--100vh, 1vh) * 1.5) 0;
		margin: 1.7vh 0;
		margin: calc(var(--100vh, 1vh) * 1.7) 0;
	}

	.contacts-pg-form-content div input.user-field {
		width: 100%;
		border-bottom: 0.05rem solid #c4bbaa;
		padding: 2vh 0;
		padding: calc(var(--100vh, 1vh) * 2) 0;
	}

	.contacts-pg-form-content div input.user-field,
	.contacts-pg-form-content .user-fields-container textarea {
		font-size: 2.5vh;
		font-size: calc(var(--100vh, 1vh) * 2.5);
		background: transparent;
	}

	.contacts-pg-form-content .user-fields-container textarea {
		width: 90vw;
		margin: 2vh 0;
		margin: calc(var(--100vh, 1vh) * 2) 0;
		padding: 2.5vh 1vw;
		padding: calc(var(--100vh, 1vh) * 2.5) 1vw;
		height: 20vh;
		height: calc(var(--100vh, 1vh) * 20);
	}

	.contacts-control-container {
		flex-direction: column;
		margin: auto auto auto 0;
	}

	.contacts-pg-form-content .agreement-container label.agreement-text {
		display: inline-block;
		font-size: 2vh;
		font-size: calc(var(--100vh, 1vh) * 2);
		margin-left: 3vw;
		max-width: 80%;
	}

	.contacts-pg-form-content .send-btn {
		height: 50px;
		width: 172px;
		margin: 2.5vh auto 2.5vh 0;
		margin: calc(var(--100vh, 1vh) * 2.5) auto calc(var(--100vh, 1vh) * 2.5) 0;
	}

	.contacts-pg-form-content .send-btn .send-btn-text {
		font-size: calc(1rem + 0.9vh);
		font-size: calc(1rem + calc(var(--100vh, 1vh) * 0.9));
	}

	.contacts-pg-form-content .contacts-control-container {
		flex: 1 0 auto;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: flex-start;
	}

	.contacts-pg-form .user-fields-container > * {
		margin: 1vh 0;
		margin: var(--100vh, 1vh) 0;
	}

	.agreement-container .agreement-checkbox-container {
		top: 0;
	}

	.minus-control-btn-icon {
		top: calc(100vh - 23px);
		top: calc(var(--100vh, 1vh) * 100 - 23px);
		left: 50%;

		transform: translate(-50%, calc(-100vh + 43px));
		transform: translate(-50%, calc(var(--100vh, 1vh) * -100 + 43px));
	}

	.travel-map-size {
		width: 100%;
		height: 100%;
		height: 100vh;
		height: calc(var(--100vh, 1vh) * 100);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.header-container {
				margin: 35.66666667vh auto 5vh 6.388889vw;
			}

			.contacts-pg-form-content .informational-lines-container .informational-text {
				margin: 0.5vh 0;
			}

			.contacts-pg-form-content .informational-lines-container {
				margin: 6vh 0;
			}

			.informational-text-phone-email {
				margin: 1.7vh 0;
			}

			.contacts-pg-form-content .contact-to-us-header {
				margin: 2vh 0;
			}

			.contacts-pg-form-content label.field-title-text,
			.contacts-pg-form-content h2.is-send-error,
			h2.is-msg-sent {
				font-size: calc(0.8rem + 0.8vh);
			}

			.contacts-pg-form-content div.user-field {
				padding: 1.5vh 0;
				margin: 1.7vh 0;
			}

			.contacts-pg-form-content div input.user-field {
				padding: 2vh 0;
			}

			.contacts-pg-form-content div input.user-field,
			.contacts-pg-form-content .user-fields-container textarea {
				font-size: 2.5vh;
			}

			.contacts-pg-form-content .user-fields-container textarea {
				margin: 2vh 0;
				padding: 2.5vh 1vw;
				height: 20vh;
			}

			.contacts-control-container {
				flex-direction: column;
				margin: auto auto auto 0;
			}

			.contacts-pg-form-content .send-btn {
				margin: 2.5vh auto 2.5vh 0;
			}

			.contacts-pg-form-content .send-btn .send-btn-text {
				font-size: calc(1rem + 0.9vh);
			}

			.contacts-pg-form .user-fields-container > * {
				margin: 1vh 0;
			}

			.minus-control-btn-icon {
				top: calc(100vh - 23px);
				left: 50%;

				transform: translate(-50%, calc(-100vh + 43px));
			}

			.travel-map-size {
				width: 100%;
				height: 100vh;
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.contacts-pg {
		flex: 1 0 auto;
		max-height: 100vh;
		max-height: calc(var(--100vh, 1vh) * 100);
		height: 100vh;
		height: calc(var(--100vh, 1vh) * 100);
		margin-top: -24vh;
		margin-top: calc(var(--100vh, 1vh) * -24);
	}

	.contacts-pg-form {
		flex: 1 0 auto;
		align-items: stretch;
		height: 95vh;
		height: calc(var(--100vh, 1vh) * 95);
		max-height: 95vh;
		max-height: calc(var(--100vh, 1vh) * 95);
		padding-top: 0;
	}

	.landscape-contacts-pg {
		max-height: 100%;
		height: 100%;
	}

	.contacts-pg-form-content {
		height: 100%;
		max-height: 100%;
		padding-left: unset;
		padding: 2vh 0 0 5.89583vw;
		padding: calc(var(--100vh, 1vh) * 2) 0 0 5.89583vw;
	}

	.contacts-pg-form-content .informational-lines-container {
		max-height: fit-content;
		margin: 1.5vh 0;
		margin: calc(var(--100vh, 1vh) * 1.5) 0;
	}

	.contacts-pg-form-content .contact-to-us-header {
		margin: 0.25vh 0 0 0;
		margin: calc(var(--100vh, 1vh) * 0.25) 0 0 0;
		padding: 0;
	}

	.contacts-pg-form-content div.header-container {
		width: min-content;
	}

	.contacts-pg-form-content h1.header {
		margin: 0 auto 1vh 0;
		margin: 0 auto var(--100vh, 1vh) 0;
	}

	.contacts-pg-form-content h1.header,
	.contacts-pg-form-content .contact-to-us-header {
		font-size: 4.7vh;
		font-size: calc(var(--100vh, 1vh) * 4.7);
	}

	.contacts-pg-form-content .informational-text {
		margin: 1.5vh 0;
		margin: calc(var(--100vh, 1vh) * 1.5) 0;
	}

	.contacts-pg-form-content .informational-text,
	.contacts-pg-form-content .user-field,
	.contacts-pg-form-content .send-btn .send-btn-text,
	.contacts-pg-form-content .field-title-text,
	.contacts-pg-form-content h2.is-send-error,
	h2.is-msg-sent {
		font-size: 3vh;
		font-size: calc(var(--100vh, 1vh) * 3);
	}

	.contacts-pg-form-content .user-fields-container {
		flex: 1 0 40%;
		flex: 1 0 calc(var(--100vh, 1vh) * 40);
	}

	.contacts-pg-form-content .user-fields-container .user-field:first-child {
		margin-right: 1vw;
	}

	.contacts-pg-form-content label.agreement-text {
		font-size: 1.5vh;
		font-size: calc(var(--100vh, 1vh) * 1.5);
		margin-left: 7px;
	}

	.user-fields-container .contacts-control-container {
		margin-top: 1vh;
		margin-top: var(--100vh, 1vh);
		padding: 0;
	}

	.contacts-pg-form-content .user-fields-second-line-container label {
		margin: 1vh 0;
		margin: var(--100vh, 1vh) 0;
	}

	.contacts-pg-form-content .user-fields-container textarea {
		width: 30vw;
		height: 15vh;
		height: calc(var(--100vh, 1vh) * 15);
		padding: 2.5vh 1vw;
		padding: calc(var(--100vh, 1vh) * 2.5) 1vw;
	}

	.contacts-pg-form-content .send-btn {
		width: 12.9583vw;
		height: 6.62963vh;
		height: calc(var(--100vh, 1vh) * 6.62963);
	}

	.agreement-container {
		max-width: 75%;
		.agreement-checkbox-container {
			margin-left: 10px;
			width: 13px;
			min-width: 13px;
			height: 13px;
			min-height: 13px;
			.checkmark::after {
				width: 10px;
				height: 15px;
				left: 17%;
				top: -66%;
			}
		}
	}

	.travel-map-size {
		width: 100%;
		height: 100%;
		height: 100vh;
		height: calc(var(--100vh, 1vh) * 100);
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.contacts-pg {
				margin-top: max(-29vh, -100px);
				margin-top: max(calc(var(--100vh, 1vh) * -29), -100px);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 680px) and (orientation: landscape) {
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.contacts-pg {
				margin-top: max(-29vh, -80px);
				margin-top: max(calc(var(--100vh, 1vh) * -29), -80px);
			}
		}
	}
}
</style>
