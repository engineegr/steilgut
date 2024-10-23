<template>
	<div class="transit-flex-box tw-flex tw-h-full">
		<!-- Desktop -->
		<div
			class="minh-transit-flex-box md:tw-flex tw-hidden landscape:tw-hidden delivery-form"
		>
			<h2 class="select-delivery-text tw-block" v-if="false">
				{{ __("order.deliveryOptions") }}
			</h2>
			<div class="delivery-options-container">
				<button
					type="button"
					name="mail-delivery-button-active"
					class="delivery-option-btn"
					:class="{
						'active-delivery-option-btn': deliveryOptionList[2],
					}"
					@click="handleDeliveryOptionClick($event, 2)"
				>
					<h2 class="delivery-options-header">
						{{ __("order.mailDeliveryHeader") }}
					</h2>
				</button>

				<button
					type="button"
					name="winery-delivery-button-active"
					class="delivery-option-btn"
					:class="{
						'active-delivery-option-btn': deliveryOptionList[0],
					}"
					@click="handleDeliveryOptionClick($event, 0)"
				>
					<h2 class="delivery-options-header">
						{{ __("order.wineryDeliveryHeader") }}
					</h2>
				</button>

				<button
					v-if="false"
					type="button"
					name="courier-delivery-button-active"
					class="delivery-option-btn"
					:class="{
						'active-delivery-option-btn': deliveryOptionList[1],
					}"
					@click="handleDeliveryOptionClick($event, 1)"
				>
					<h2 class="delivery-options-header">
						{{ __("order.courierDeliveryHeader") }}
					</h2>
				</button>
			</div>

			<div
				class="selected-delivery-content"
				:key="mainBoardKey"
				:class="$_calcDeliveryInfoContainerStyleClass()"
			>
				<p class="input-cell" key="lfp_input_p">
					<label
						:for="`${idp}-LFP`"
						class="is-required-field delivery-input-label"
						:class="[
							{
								'is-invalid-field': errorsFor('LFP').length > 0,
							},
						]"
						>{{ __("contacts.LFPHeader") }}</label
					>
					<!-- v-on:keydown.tab="handleNexFocusElement" -->
					<input
						type="text"
						:id="`${idp}-LFP`"
						name="LFP"
						class="tw-appearance-none focus:tw-outline-none LFP user-field delivery-input"
						:placeholder="__('contacts.LFPPlaceholder')"
						autofocus
						tabindex="1"
						v-model="personalData['LFP']"
						v-on:change="handlePersonalAttributeChange"
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
				</p>

				<p class="input-cell tw-flex tw-flex-col" key="country_input_p">
					<!-- <label
                        for="country"
                        class="is-required-field"
                        :class="[
                            {
                                'is-invalid-field': errorsFor('country').length > 0,
                            },
                        ]"
                        >{{ __("contacts.country") }}</label
                    >
                    <input
                        type="text"
                        :id="`${idp}-country`"
                        name="country"
                        :placeholder="__('contacts.countryPlaceholder')"
                        autocomplete="on"
                        v-model="personalData['country']"
                        @change="handlePersonalAttributeChange"
                        class="tw-appearance-none focus:tw-outline-none user-field"
                        :class="[
                            {
                                'is-invalid-field': errorsFor('country').length > 0,
                            },
                        ]"
                    /> -->

					<drop-down-static-list
						:attributeName="__('common.country')"
						:attributeValue="personalData['country']"
						:attributeValueList="countryList"
						dropDownStaticListWrapperCtrlStyleClass="tw-h-full"
						dropDownStaticHeaderWrapperStyleClass="md:tw-h-auto"
						inputLabelStyleClassList="delivery-input-label"
						inputCtrlStyleClassList="delivery-input"
						dropDownStaticListBodyWrapperStyleClass="drop-down-list-top-margin tw-left-0"
						v-on:select-item="handleCountryAttributeChange"
						:isHeader="true"
						:isControl="false"
						:isLightMode="true"
						:isRequired="deliveryOptionList[2]"
						:tabindex="2"
					>
					</drop-down-static-list>
				</p>

				<p class="input-cell" v-if="!deliveryOptionList[0]" key="zipcode_input_p">
					<label
						:for="`${idp}-zip`"
						class="delivery-input-label"
						:class="[
							{
								'is-invalid-field': errorsFor('zip').length > 0,
							},
						]"
						>{{ __("contacts.zipHeader") }}</label
					>

					<input
						type="text"
						tabindex="3"
						:id="`${idp}-zip`"
						name="zip"
						v-model="personalData['zip']"
						:placeholder="__('contacts.zipPlaceholder')"
						autocomplete="on"
						@change="handlePersonalAttributeChange"
						class="tw-appearance-none focus:tw-outline-none user-field delivery-input"
						:class="[{ 'is-invalid-field': errorsFor('zip').length > 0 }]"
					/>
					<transition name="fade">
						<validation-error
							class="tw-max-w-095"
							v-if="errorsFor('zip').length > 0"
							:errors="errorsFor('zip')"
						></validation-error>
					</transition>
				</p>

				<p class="input-cell" key="email_input_p">
					<label
						:for="`${idp}-email`"
						class="is-required-field delivery-input-label"
						:class="[
							{
								'is-invalid-field': errorsFor('email').length > 0,
							},
						]"
						>{{ __("contacts.emailHeader") }}</label
					>
					<input
						type="text"
						tabindex="4"
						:id="`${idp}-email`"
						name="email"
						:placeholder="__('contacts.emailPlaceholder')"
						autocomplete="on"
						@change="handlePersonalAttributeChange"
						v-model="personalData['email']"
						class="tw-appearance-none focus:tw-outline-none user-field delivery-input"
						:class="[
							{
								'is-invalid-field': errorsFor('email').length > 0,
							},
						]"
					/>
					<transition name="fade">
						<validation-error
							class="tw-max-w-095"
							v-if="errorsFor('email').length > 0"
							:errors="errorsFor('email')"
						></validation-error>
					</transition>
				</p>
				<p
					class="input-cell address-cell"
					key="address_input_p"
					v-show="!deliveryOptionList[0]"
				>
					<address-au-comp
						:idp="`${idp}-desktop-`"
						:tabindex="5"
						:label="__('contacts.addressLabel')"
						:isRequired="true"
						:isInvalid="errorsFor('address').length > 0"
						:validationErrors="errorsFor('address')"
						addressLabelStyleClassList="delivery-input-label"
						addressInputStyleClassList="delivery-input"
						v-on:auc-address-change="handleAucAddressChange"
						v-model="personalData['address']"
					/>
				</p>

				<p class="input-cell" key="phone_input_p">
					<label
						:for="`${idp}-phone`"
						class="delivery-input-label"
						:class="[
							{
								'is-invalid-field': errorsFor('phone').length > 0,
							},
						]"
						>{{ __("contacts.phoneLabel") }}</label
					>
					<input
						type="text"
						tabindex="6"
						:id="`${idp}-phone`"
						name="phone"
						:placeholder="__('contacts.phoneLabelPlaceholder')"
						v-model="personalData['phone']"
						@change="handlePersonalAttributeChange"
						class="tw-appearance-none focus:tw-outline-none user-field delivery-input"
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
				</p>
			</div>

			<!-- v-if="isDELocale()" -->
			<div class="agreement-container tw-block tw-w-full tw-max-w-full input-cell">
				<div class="agreement-checkbox-container tw-inline-block input-cell">
					<input
						type="checkbox"
						tabindex="7"
						:id="`${idp}_deliveryAddressDiffs`"
						name="deliveryAddressDiffs"
					/>
					<span class="checkmark"></span>
				</div>

				<label
					class="agreement-text tw-inline-block"
					:for="`${idp}_deliveryAddressDiffs`"
					>{{ __("order.deliveryAddressDifferenciesTitle") }}
				</label>
			</div>

			<div class="summary-paragraph">
				<div class="order-price price-row">
					<h2 class="order-price-header">
						{{ __("order.priceHeader") }}
					</h2>
					<h2 class="order-price-value">
						{{ $root.helper.getCommaSeparatorDecimal(summaryPriceInBasket) }}
						€
					</h2>
				</div>
				<div class="delivery-order-price price-row">
					<template v-if="orderDetails['deliveryPrice'] >= 0">
						<h2 class="delivery-order-price-header">
							{{ __("order.deliveryPriceHeader") }}
						</h2>
						<h2 class="delivery-order-price-value">
							{{
								$root.helper.getCommaSeparatorDecimal(
									orderDetails["deliveryPrice"]
								)
							}}
							€
						</h2>
					</template>
					<template v-else>
						<h2 class="delivery-order-price-header">
							{{ __("order.notFixedDeliveryPrice") }}
						</h2>
					</template>
				</div>
				<div class="summary-price price-row">
					<h2 class="summary-price-value">{{ __("order.summary") }}:</h2>
					<h2 class="summary-price-header">
						{{
							$root.helper.getCommaSeparatorDecimal(
								orderDetails.summaryPrice +
									(orderDetails.deliveryPrice > 0
										? orderDetails.deliveryPrice
										: 0)
							)
						}}
						€
					</h2>
				</div>
			</div>
		</div>

		<div class="transit-flex-box tw-flex md:tw-hidden delivery-from">
			<!-- Portrait -->
			<div class="tw-flex landscape:tw-hidden transit-flex-box delivery-options">
				<h2 class="select-delivery-text tw-block" v-if="false">
					{{ __("order.deliveryOptions") }}
				</h2>
				<div class="delivery-options-container">
					<button
						type="button"
						name="mail-delivery-button-active"
						class="delivery-option-btn"
						:class="{
							'active-delivery-option-btn': deliveryOptionList[2],
						}"
						@click="handleDeliveryOptionClick($event, 2)"
						data-bs-toggle="collapse"
						:data-bs-target="`#${idp}-portrait-selected-delivery-content-wrapper`"
						aria-expanded="false"
						:aria-controls="`#${idp}-portrait-selected-delivery-content-wrapper`"
					>
						<h2 class="delivery-options-header">
							{{ __("order.mailDeliveryHeader") }}
						</h2>
					</button>

					<button
						type="button"
						name="winery-delivery-button-active"
						class="delivery-option-btn"
						:class="{
							'active-delivery-option-btn': deliveryOptionList[0],
						}"
						@click="handleDeliveryOptionClick($event, 0)"
						data-bs-toggle="collapse"
						:data-bs-target="`#${idp}-portrait-selected-delivery-content-wrapper`"
						aria-expanded="false"
						:aria-controls="`#${idp}-portrait-selected-delivery-content-wrapper`"
					>
						<h2 class="delivery-options-header">
							{{ __("order.wineryDeliveryHeader") }}
						</h2>
					</button>

					<button
						v-if="false"
						type="button"
						name="courier-delivery-button-active"
						class="delivery-option-btn"
						:class="{
							'active-delivery-option-btn': deliveryOptionList[1],
						}"
						@click="handleDeliveryOptionClick($event, 1)"
						data-bs-toggle="collapse"
						:data-bs-target="`#${idp}-portrait-selected-delivery-content-wrapper`"
						aria-expanded="false"
						:aria-controls="`#${idp}-portrait-selected-delivery-content-wrapper`"
					>
						<h2 class="delivery-options-header">
							{{ __("order.courierDeliveryHeader") }}
						</h2>
					</button>
				</div>

				<div :id="`${idp}-portrait-selected-delivery-content-wrapper`">
					<div
						class="selected-delivery-content"
						v-show="$_isDeliveryFieldsVisible"
						:key="mainBoardKey"
						:class="$_calcDeliveryInfoContainerStyleClass()"
					>
						<p class="input-cell" key="lfp_input_p">
							<label
								for="LFP"
								class="is-required-field delivery-input-label"
								:class="[
									{
										'is-invalid-field': errorsFor('LFP').length > 0,
									},
								]"
								>{{ __("contacts.LFPHeader") }}</label
							>
							<input
								tabindex="0"
								type="text"
								:id="`${idp}portrait-LFP`"
								name="LFP"
								class="tw-appearance-none focus:tw-outline-none LFP user-field delivery-input"
								:placeholder="__('contacts.LFPPlaceholder')"
								autocomplete="on"
								v-model="personalData['LFP']"
								@change="handlePersonalAttributeChange"
								:class="[
									{
										'is-invalid-field': errorsFor('LFP').length > 0,
									},
								]"
							/>
						</p>

						<p class="input-cell" key="email_input_p">
							<label
								for="email"
								class="is-required-field delivery-input-label"
								:class="[
									{
										'is-invalid-field': errorsFor('email').length > 0,
									},
								]"
								>{{ __("contacts.emailHeader") }}</label
							>
							<input
								tabindex="1"
								type="text"
								:id="`${idp}portrait-email`"
								name="email"
								:placeholder="__('contacts.emailPlaceholder')"
								autocomplete="on"
								@change="handlePersonalAttributeChange"
								v-model="personalData['email']"
								class="tw-appearance-none focus:tw-outline-none user-field delivery-input"
								:class="[
									{
										'is-invalid-field': errorsFor('email').length > 0,
									},
								]"
							/>
							<transition name="fade">
								<validation-error
									class="tw-max-w-095"
									v-if="errorsFor('email').length > 0"
									:errors="errorsFor('email')"
								></validation-error>
							</transition>
						</p>

						<p class="input-cell" key="phone_input_p">
							<label
								for="phone"
								class="delivery-input-label"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
								>{{ __("contacts.phoneLabel") }}</label
							>
							<input
								tabindex="2"
								type="text"
								:id="`${idp}portrait-phone`"
								name="phone"
								:placeholder="__('contacts.phoneLabelPlaceholder')"
								autocomplete="on"
								v-model="personalData['phone']"
								@change="handlePersonalAttributeChange"
								class="tw-appearance-none focus:tw-outline-none user-field delivery-input"
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
						</p>
						<section class="input-address-country-zipcode">
							<p class="input-cell tw-inline-block" key="country_input_p">
								<!-- <label
									for="country"
									class="is-required-field delivery-input-label"
									:class="[
                                        {
                                            'is-invalid-field':
                                                errorsFor('country').length > 0,
                                        },
                                    ]"
								>{{ __("contacts.country") }}</label>
								<input
									tabindex="2"
									type="text"
									:id="`${idp}portrait-country`"
									name="country"
									:placeholder="__('contacts.countryPlaceholder')"
									autocomplete="on"
									v-model="personalData['country']"
									@change="handlePersonalAttributeChange"
									class="tw-appearance-none focus:tw-outline-none user-field delivery-input"
									:class="[
                                        {
                                            'is-invalid-field':
                                                errorsFor('country').length > 0,
                                        },
                                    ]"
								/> -->

								<drop-down-static-list
									:attributeName="__('common.country')"
									:attributeValue="personalData['country']"
									:attributeValueList="countryList"
									:isHeader="true"
									:isControl="false"
									:isLightMode="true"
									:isRequired="deliveryOptionList[2]"
									:tabindex="3"
									dropDownStaticListWrapperCtrlStyleClass="tw-h-full"
									inputLabelStyleClassList="delivery-input-label"
									inputCtrlStyleClassList="delivery-input"
									v-on:select-item="handleCountryAttributeChange"
								>
								</drop-down-static-list>
							</p>

							<p
								class="input-cell tw-inline-block"
								v-if="!deliveryOptionList[0]"
								key="zipcode_input_p"
							>
								<label
									for="zip"
									:class="[
										{
											'is-invalid-field':
												errorsFor('zip').length > 0,
										},
									]"
									class="delivery-input-label"
									>{{ __("contacts.zipHeader") }}</label
								>

								<input
									tabindex="4"
									type="text"
									:id="`${idp}portrait-zip`"
									name="zip"
									v-model="personalData['zip']"
									:placeholder="__('contacts.zipPlaceholder')"
									autocomplete="on"
									@change="handlePersonalAttributeChange"
									class="user-field tw-appearance-none focus:tw-outline-none delivery-input"
									:class="[
										{
											'is-invalid-field':
												errorsFor('zip').length > 0,
										},
									]"
								/>
							</p>
						</section>

						<p
							class="input-cell address-cell"
							key="address_input_p"
							v-show="!deliveryOptionList[0]"
						>
							<address-au-comp
								:idp="`${idp}-portrait`"
								:tabindex="5"
								:label="__('contacts.addressLabel')"
								isRequired="true"
								:isInvalid="errorsFor('address').length > 0"
								:validationErrors="errorsFor('address')"
								v-on:auc-address-change="handleAucAddressChange"
								v-model="personalData['address']"
								addressLabelStyleClassList="delivery-input-label"
								addressInputStyleClassList="delivery-input"
							/>
						</p>
					</div>

					<div class="summary-paragraph">
						<div class="order-price price-row">
							<h2 class="order-price-header">
								{{ __("order.priceHeader") }}
							</h2>
							<h2 class="order-price-value">
								{{
									$root.helper.getCommaSeparatorDecimal(
										summaryPriceInBasket
									)
								}}
								€
							</h2>
						</div>
						<div class="delivery-order-price price-row">
							<template v-if="orderDetails['deliveryPrice'] >= 0">
								<h2 class="delivery-order-price-header">
									{{ __("order.deliveryPriceHeader") }}
								</h2>
								<h2 class="delivery-order-price-value">
									{{
										$root.helper.getCommaSeparatorDecimal(
											orderDetails["deliveryPrice"]
										)
									}}
									€
								</h2>
							</template>
							<template v-else>
								<h2 class="delivery-order-price-header">
									{{ __("order.notFixedDeliveryPrice") }}
								</h2>
							</template>
						</div>
						<div class="summary-price price-row">
							<h2 class="summary-price-value">
								{{ __("order.summary") }}:
							</h2>
							<h2 class="summary-price-header">
								{{
									$root.helper.getCommaSeparatorDecimal(
										orderDetails.summaryPrice +
											(orderDetails.deliveryPrice > 0
												? orderDetails.deliveryPrice
												: 0)
									)
								}}
								€
							</h2>
						</div>
					</div>
				</div>

				<!-- v-if="isDELocale()" -->
				<div
					class="agreement-container tw-block tw-w-full tw-max-w-full input-cell"
				>
					<div class="agreement-checkbox-container tw-inline-block input-cell">
						<input
							:tabindex="6"
							type="checkbox"
							name="deliveryAddressDiffs"
						/>
						<span class="checkmark"></span>
					</div>

					<label
						class="agreement-text tw-inline-block"
						for="deliveryAddressDiffs"
						>{{ __("order.deliveryAddressDifferenciesTitle") }}
					</label>
				</div>
			</div>
			<!-- Landscape -->
			<div class="tw-hidden landscape:tw-flex transit-flex-box">
				<h2 class="select-delivery-text tw-block" v-if="false">
					{{ __("order.deliveryOptions") }}
				</h2>
				<div class="delivery-options-container">
					<button
						type="button"
						name="mail-delivery-button-active"
						class="delivery-option-btn"
						:class="{
							'active-delivery-option-btn': deliveryOptionList[2],
						}"
						@click="handleDeliveryOptionClick($event, 2)"
						data-bs-toggle="collapse"
						:data-bs-target="`#${idp}-landscape-selected-delivery-content-wrapper`"
						aria-expanded="false"
						:aria-controls="`#${idp}-landscape-selected-delivery-content-wrapper`"
					>
						<h2 class="delivery-options-header">
							{{ __("order.mailDeliveryHeader") }}
						</h2>
					</button>

					<button
						type="button"
						name="winery-delivery-button-active"
						class="delivery-option-btn"
						:class="{
							'active-delivery-option-btn': deliveryOptionList[0],
						}"
						@click="handleDeliveryOptionClick($event, 0)"
						data-bs-toggle="collapse"
						:data-bs-target="`#${idp}-landscape-selected-delivery-content-wrapper`"
						aria-expanded="false"
						:aria-controls="`#${idp}-landscape-selected-delivery-content-wrapper`"
					>
						<h2 class="delivery-options-header">
							{{ __("order.wineryDeliveryHeader") }}
						</h2>
					</button>

					<button
						v-if="false"
						type="button"
						name="courier-delivery-button-active"
						class="delivery-option-btn"
						:class="{
							'active-delivery-option-btn': deliveryOptionList[1],
						}"
						@click="handleDeliveryOptionClick($event, 1)"
						data-bs-toggle="collapse"
						:data-bs-target="`#${idp}-landscape-selected-delivery-content-wrapper`"
						aria-expanded="false"
						:aria-controls="`#${idp}-landscape-selected-delivery-content-wrapper`"
					>
						<h2 class="delivery-options-header">
							{{ __("order.courierDeliveryHeader") }}
						</h2>
					</button>
				</div>

				<div
					:id="`${idp}-landscape-selected-delivery-content-wrapper`"
					class="collapse show selected-delivery-content-wrapper"
				>
					<div
						class="selected-delivery-content"
						v-show="$_isDeliveryFieldsVisible"
						:key="mainBoardKey"
						:class="$_calcDeliveryInfoContainerStyleClass()"
					>
						<p class="input-cell" key="lfp_input_p">
							<label
								for="LFP"
								class="is-required-field delivery-input-label"
								:class="[
									{
										'is-invalid-field': errorsFor('LFP').length > 0,
									},
								]"
								>{{ __("contacts.LFPHeader") }}</label
							>
							<input
								tabindex="0"
								type="text"
								:id="`${idp}landscape-LFP`"
								name="LFP"
								class="tw-appearance-none focus:tw-outline-none LFP user-field delivery-input"
								:placeholder="__('contacts.LFPPlaceholder')"
								autocomplete="on"
								v-model="personalData['LFP']"
								@change="handlePersonalAttributeChange"
								:class="[
									{
										'is-invalid-field': errorsFor('LFP').length > 0,
									},
								]"
							/>
						</p>

						<p class="input-cell" key="country_input_p">
							<!-- <label
								for="country"
								class="is-required-field"
								:class="[
                                    {
                                        'is-invalid-field':
                                            errorsFor('country').length > 0,
                                    },
                                ]"
							>{{ __("contacts.country") }}</label>
							<input
								tabindex="2"
								type="text"
								:id="`${idp}landscape-country`"
								name="country"
								:placeholder="__('contacts.countryPlaceholder')"
								autocomplete="on"
								v-model="personalData['country']"
								@change="handlePersonalAttributeChange"
								class="tw-appearance-none focus:tw-outline-none user-field"
								:class="[
                                    {
                                        'is-invalid-field':
                                            errorsFor('country').length > 0,
                                    },
                                ]"
							/> -->

							<drop-down-static-list
								:attributeName="__('common.country')"
								:attributeValue="personalData['country']"
								:attributeValueList="countryList"
								dropDownStaticListWrapperCtrlStyleClass="delivery-drop-down-static-list-wrapper-ctrl-style-class"
								dropDownStaticHeaderWrapperStyleClass="md:tw-h-auto"
								inputLabelStyleClassList="delivery-input-label"
								inputCtrlStyleClassList="delivery-input"
								dropDownStaticListBodyWrapperStyleClass="drop-down-list-top-margin tw-left-0"
								v-on:select-item="handleCountryAttributeChange"
								:isHeader="true"
								:isControl="false"
								:isLightMode="true"
								:isRequired="deliveryOptionList[2]"
								:tabindex="2"
							>
							</drop-down-static-list>
						</p>

						<p
							class="input-cell"
							v-if="!deliveryOptionList[0]"
							key="zipcode_input_p"
						>
							<label
								for="zip"
								:class="[
									{
										'is-invalid-field': errorsFor('zip').length > 0,
									},
								]"
								class="delivery-input-label"
								>{{ __("contacts.zipHeader") }}</label
							>

							<input
								tabindex="2"
								type="text"
								:id="`${idp}landscape-zip`"
								name="zip"
								v-model="personalData['zip']"
								:placeholder="__('contacts.zipPlaceholder')"
								autocomplete="on"
								@change="handlePersonalAttributeChange"
								tw-appearance-none
								focus:tw-outline-none
								class="user-field delivery-input"
								:class="[
									{ 'is-invalid-field': errorsFor('zip').length > 0 },
								]"
							/>
						</p>

						<p class="input-cell" key="email_input_p">
							<label
								for="email"
								class="is-required-field delivery-input-label"
								:class="[
									{
										'is-invalid-field': errorsFor('email').length > 0,
									},
								]"
								>{{ __("contacts.emailHeader") }}</label
							>
							<input
								tabindex="3"
								type="text"
								:id="`${idp}landscape-email`"
								name="email"
								:placeholder="__('contacts.emailPlaceholder')"
								autocomplete="on"
								@change="handlePersonalAttributeChange"
								v-model="personalData['email']"
								class="tw-appearance-none focus:tw-outline-none user-field delivery-input"
								:class="[
									{
										'is-invalid-field': errorsFor('email').length > 0,
									},
								]"
							/>
						</p>
						<p
							class="input-cell address-cell"
							key="address_input_p"
							v-show="!deliveryOptionList[0]"
						>
							<address-au-comp
								:tabindex="4"
								:idp="`${idp}-landscape`"
								:label="__('contacts.addressLabel')"
								isRequired="true"
								:isInvalid="errorsFor('address').length > 0"
								v-on:auc-address-change="handleAucAddressChange"
								v-model="personalData['address']"
								addressLabelStyleClassList="delivery-input-label"
								addressInputStyleClassList="delivery-input"
							/>
						</p>

						<p class="input-cell" key="phone_input_p">
							<label
								for="phone"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
								class="delivery-input-label"
								>{{ __("contacts.phoneLabel") }}</label
							>
							<input
								tabindex="5"
								type="text"
								:id="`${idp}landscape-phone`"
								name="phone"
								:placeholder="__('contacts.phoneLabelPlaceholder')"
								autocomplete="on"
								v-model="personalData['phone']"
								@change="handlePersonalAttributeChange"
								class="tw-appearance-none focus:tw-outline-none user-field delivery-input-label"
								:class="[
									{
										'is-invalid-field': errorsFor('phone').length > 0,
									},
								]"
							/>
						</p>
					</div>

					<div class="summary-paragraph">
						<div class="order-price price-row">
							<h2 class="order-price-header">
								{{ __("order.priceHeader") }}
							</h2>
							<h2 class="order-price-value">
								{{
									$root.helper.getCommaSeparatorDecimal(
										summaryPriceInBasket
									)
								}}
								€
							</h2>
						</div>
						<div class="delivery-order-price price-row">
							<template v-if="orderDetails['deliveryPrice'] >= 0">
								<h2 class="delivery-order-price-header">
									{{ __("order.deliveryPriceHeader") }}
								</h2>
								<h2 class="delivery-order-price-value">
									{{
										$root.helper.getCommaSeparatorDecimal(
											orderDetails["deliveryPrice"]
										)
									}}
									€
								</h2>
							</template>
							<template v-else>
								<h2 class="delivery-order-price-header">
									{{ __("order.notFixedDeliveryPrice") }}
								</h2>
							</template>
						</div>
						<div class="summary-price price-row">
							<h2 class="summary-price-value">
								{{ __("order.summary") }}:
							</h2>
							<h2 class="summary-price-header">
								{{
									$root.helper.getCommaSeparatorDecimal(
										orderDetails.summaryPrice +
											(orderDetails.deliveryPrice > 0
												? orderDetails.deliveryPrice
												: 0)
									)
								}}
								€
							</h2>
						</div>
					</div>
				</div>

				<!-- v-if="isDELocale()" -->
				<div
					class="agreement-container tw-inline-flex tw-w-full tw-max-w-full input-cell"
				>
					<div class="agreement-checkbox-container tw-inline-block input-cell">
						<input
							:tabindex="6"
							type="checkbox"
							name="deliveryAddressDiffs"
						/>
						<span class="checkmark"></span>
					</div>

					<label
						class="agreement-text tw-inline-block"
						for="deliveryAddressDiffs"
						>{{ __("order.deliveryAddressDifferenciesTitle") }}
					</label>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import validationErrors from "../../mixins/validationErrors";
import mediaHelper from "../../mixins/mediaHelper";
import { refreshFullPageContainers } from "../../utils/resizer";
import { mapGetters, mapState } from "vuex";
import { Helper } from "../../utils/helper";
const addressAutocompleteComp = () =>
	import(/* webpackPrefetch: true */ "../map/AddressAutocompleteComp");

const dropDownStaticListComp = () =>
	import(/* webpackPrefetch: true */ "../../components/DropDownStaticListComp");

export default {
	mixins: [validationErrors, mediaHelper],

	components: {
		"address-au-comp": addressAutocompleteComp,
		"drop-down-static-list": dropDownStaticListComp,
	},

	props: {
		idp: {
			type: [String],
			default: "delivery-desktop-",
			required: false,
		},

		orderDetails: {
			type: [Object],
			default: {},
		},
		deliveryOptionList: {
			type: [Array],
			default: [],
		},
	},

	created() {
		"use strict";
		if (this.$_checkedOrRedirected()) {
			console.log("Debug [OrderComp::beforeRouteLeave] Enter the function");
			for (let key in this.orderDetails["personalData"]) {
				this.personalData[key] = this.orderDetails["personalData"][key];
			}
		}
	},

	mounted() {
		"use strict";
		const lfpElement = this.$_findNextFocusableElement(1);
		lfpElement.focus();
	},

	data: function () {
		return {
			mainBoardKey: "delivery-options-container",
			personalData: {
				LFP: "",
				country: "",
				zip: "",
				address: {},
				email: "",
				phone: "",
			},

			isChecked: false,

			countryList: [
				this.__("common.Belgium"),
				this.__("common.Bulgaria"),
				this.__("common.Denmark"),
				this.__("common.Germany"),
				this.__("common.Estonia"),
				this.__("common.Finland"),
				this.__("common.France"),
				this.__("common.Greece"),
				this.__("common.Ireland"),
				this.__("common.Italy"),
				this.__("common.Croatia"),
				this.__("common.Latvia"),
				this.__("common.Lithuania"),
				this.__("common.Luxembourg"),
				this.__("common.Malta"),
				this.__("common.Netherlands"),
				this.__("common.Austria"),
				this.__("common.Poland"),
				this.__("common.Portugal"),
				this.__("common.Romania"),
				this.__("common.Sweden"),
				this.__("common.Slovakia"),
				this.__("common.Slovenia"),
				this.__("common.Spain"),
				this.__("common.Czechia"),
				this.__("common.Hungary"),
				this.__("common.Cyprus"),
			],
		};
	},

	beforeRouteEnter(to, from, next) {
		next((vm) => {
			vm.$parent.prevRoute = "/masthead/wines-cart";
		});
	},

	beforeRouteLeave(to, from, next) {
		"use strict";
		const isNext = "payment" === to["name"];
		if (isNext && !this.$_validateFields()) {
			if (this.mainBoardKey === "delivery-options-container_0") {
				this.mainBoardKey = "delivery-options-container_1";
			} else {
				this.mainBoardKey = "delivery-options-container_0";
			}

			next(false);
		} else {
			this.mainBoardKey = "delivery-options-container";
			next();
			this.$parent.prevRoute = from["fullPath"];
		}
	},

	methods: {
		$_checkedOrRedirected: function () {
			"use strict";

			if (!this.deliveryOptionList || !this.orderDetails) {
				console.warn(
					"Warn [DeliveryComp::$_checkedOrRedirected] Returned Invalid Arguments"
				);
				this.$router
					.push({
						name: "controlPanel",
					})
					.catch((reject) => {
						console.warn("Warn [DeliveryComp] Vue navigation router error");
					});
				return false;
			}
			return true;
		},

		handleAucAddressChange: function (event, address, addressStr) {
			this.$emit("delivery-auc-address-change", event, address, addressStr);
		},

		handleDeliveryOptionClick: function (event, optionIndex) {
			"use strict";
			console.log(
				"Debug [DeliveryComp:handleDeliveryOptionClick] Enter the function"
			);
			this.clientSideErrorMap.clear();
			this.$emit("delivery-options-change", event, optionIndex);

			const lfpFocusableElement = this.$_findNextFocusableElement(1);
			if (lfpFocusableElement) {
				lfpFocusableElement.focus();
			}
		},

		handlePersonalAttributeChange: function (event) {
			"use strict";
			const personalAttributeName = event.target.name;
			const personalAttributeValue = event.target.value;
			this.$emit(
				"personal-attr-change",
				event,
				personalAttributeName,
				personalAttributeValue
			);
		},

		handleCountryAttributeChange: function (event, attrName, attrValue) {
			"use strict";
			this.$emit("personal-attr-change", event, "country", attrValue);
			let nextFocusableElement = null;
			if (this.deliveryOptionList[2]) {
				nextFocusableElement = this.$_findNextFocusableElement(3);
			} else if (this.deliveryOptionList[0]) {
				nextFocusableElement = this.$_findNextFocusableElement(4);
			}
			if (nextFocusableElement) {
				nextFocusableElement.focus();
			}
		},

		$_validateFields: function () {
			"use strict";
			this.clientSideErrorMap.clear();
			const lfpValidateStr = this.validateRequiredField({
				fieldTitle: "LFP",
				fieldValue: this.orderDetails.personalData["LFP"],
			});
			if (lfpValidateStr !== "") {
				this.clientSideErrorMap.set("LFP", lfpValidateStr);
			}

			if (this.deliveryOptionList[2]) {
				const countryValidateStr = this.validateRequiredField({
					fieldTitle: "country",
					fieldValue: this.orderDetails.personalData["country"],
				});
				if (countryValidateStr !== "") {
					this.clientSideErrorMap.set("country", countryValidateStr);
				}
			}

			const addressValidateStr = this.validateRequiredField({
				fieldTitle: "address",
				fieldValue: this.orderDetails.personalData["address"],
			});
			if (
				addressValidateStr !== "" &&
				(this.deliveryOptionList[1] || this.deliveryOptionList[2])
			) {
				this.clientSideErrorMap.set("address", addressValidateStr);
			}

			const zipValidateStr = this.validateZipCode(
				this.orderDetails.personalData["zip"]
			);
			if (
				zipValidateStr !== "" &&
				(this.deliveryOptionList[1] || this.deliveryOptionList[2])
			) {
				this.clientSideErrorMap.set("zip", zipValidateStr);
			}

			const emailValidateStr = this.validateEmail(
				this.orderDetails.personalData["email"]
			);
			if (emailValidateStr !== "") {
				this.clientSideErrorMap.set("email", emailValidateStr);
			}

			const phoneValidateStr = this.validateRequiredField({
				fieldTitle: "phone",
				fieldValue: this.orderDetails.personalData["phone"],
			});
			if (phoneValidateStr !== "") {
				this.clientSideErrorMap.set("phone", phoneValidateStr);
			}

			return this.clientSideErrorMap.size === 0;
		},

		$_calcDeliveryInfoContainerStyleClass: function () {
			"use strict";
			if (this.deliveryOptionList[1] || this.deliveryOptionList[2]) {
				return "selected-delivery-content-3rows";
			} else {
				return "selected-delivery-content-2rows";
			}
		},

		handleNexFocusElement: function (event) {
			"use strict";
			const currElementTabindex = event.target.tabIndex;
			const nextElementTabindex =
				currElementTabindex + 1 === 8 ? 1 : currElementTabindex + 1;
			const nextFocusableElement = this.$_findNextFocusableElement(
				nextElementTabindex
			);
			if (nextFocusableElement) {
				nextFocusableElement.focus();
			}
		},

		$_getInputElementList: function () {
			const deliverForm = document.querySelectorAll(".delivery-form");
			if (deliverForm.length !== 1) {
				console.warn(
					"DeliveryComp [$_getInputElementList] Wrong delivery form state"
				);
			} else {
				return document.querySelectorAll(
					".delivery-form input[type='text'], .delivery-form input[type='checkbox']"
				);
			}

			return null;
		},

		$_findNextFocusableElement: function (nextTabindex) {
			const allInputElements = this.$_getInputElementList();
			for (const item of allInputElements.entries()) {
				const inputElement = item[1];
				if (inputElement.tabIndex === nextTabindex) {
					return inputElement;
				}
			}
			return null;
		},
	},

	computed: {
		...mapGetters(["summaryPriceInBasket"]),

		$_isDeliveryFieldsVisible: function () {
			return (
				this.deliveryOptionList[0] ||
				this.deliveryOptionList[1] ||
				this.deliveryOptionList[2]
			);
		},
	},
};
</script>

<style lang="scss">
@import "@/sass/_variables.scss";

@media only screen and (min-width: 320px) and (orientation: portrait) {
	#app {
		label.delivery-input-label {
			color: #767676;
			font-size: calc(0.8rem + 0.8vh);
		}

		input.delivery-input {
			padding: 0.5vh 0;
			min-height: calc(0.7rem + 7vh);
			height: calc(0.7rem + 7vh);
			font-size: calc(1rem + 1.2vh);
			position: static;
			border-bottom: 0.05rem solid #000;
			color: #000000;
		}

		.drop-down-static-list {
			padding: 0;
			max-width: unset;
			width: 100%;
		}
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	#app {
		label.delivery-input-label {
			color: #767676;
			font-size: calc(0.8rem + 0.6vh);
		}

		input.delivery-input {
			padding: 0.5vh 0;
			min-height: calc(0.7rem + 5vh);
			height: calc(0.7rem + 5vh);
			font-size: calc(0.9rem + 0.8vh);
			position: static;
			border-bottom: 0.05rem solid #000;
			color: #000000;
		}

		.drop-down-static-list {
			padding: 0;
		}

		.delivery-drop-down-static-list-wrapper-ctrl-style-class {
			height: auto;
		}

		/* Safari only */
		@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
			@supports (-webkit-appearance: none) {
				.delivery-drop-down-static-list-wrapper-ctrl-style-class {
					height: 14vh;
				}
			}
		}
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	#app {
		label.delivery-input-label {
			color: #767676 !important;
			font-size: calc(0.5rem + 0.6vh) !important;
			font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.6) !important;
		}

		input.delivery-input {
			padding: 1.25vh 0;
			padding: calc(var(--100nvh, 1vh) * 1.25) 0;
			min-height: calc(1rem + 3vh);
			min-height: calc(1rem + var(--100nvh, 1vh) * 3);
			height: calc(1rem + 3vh);
			height: calc(1rem + var(--100nvh, 1vh) * 3);
			font-size: calc(0.6rem + 0.8vh);
			font-size: calc(0.6rem + var(--100nvh, 1vh) * 0.8);
			position: static;
			border-bottom: 0.05rem solid #000;
			color: #000000;
		}
	}
}
</style>

<style lang="scss" scoped>
@import "@/sass/_variables.scss";
@import "@/sass/_components.scss";
@import "@/sass/app/_media.scss";

h2.select-delivery-text {
	font-family: "steilgut_cormorant", sans-serif;
	font-size: calc(0.8rem + 0.7vmin);
	font-size: calc(0.8rem + var(--100nvmin, 1vmin) * 0.7);
	text-transform: uppercase;
	color: #000;
	margin: 3vmin 0 1.5vmin 0;
	margin: calc(var(--100nvmin, 1vmin) * 3) 0 calc(var(--100nvmin, 1vmin) * 1.5) 0;
}

.delivery-option-btn h2 {
	font-family: "steilgut_opensans";
	font-weight: 100;
}

.delivery-options-container {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	align-items: stretch;
	justify-content: flex-start;
	/* border: 2px solid #ebcb9a; */
}

.delivery-option-btn h2 {
	font-size: 0.6rem;
	font-size: calc(0.6rem + 0.7vmin);
	font-size: calc(0.6rem + var(--100nvmin, 1vmin) * 0.7);
	padding: 0 0.7vmin;
	padding: 0 calc(var(--100nvmin, 1vmin) * 0.7);
}

.delivery-options-container > button {
	margin: 0 5% auto 0;
}

button {
	font: inherit;
	font-size: calc(0.5rem + 0.8vh);
	font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.8);
}

button.delivery-option-btn {
	width: 13.541667vw;
	width: calc(var(--100nvw, 1vw) * 13.541667);
	min-width: calc(var(--100nvw, 1vw) * 13.541667);

	height: 10.789062vh;
	height: calc(var(--100nvh, 1vh) * 10.789062);
	min-height: calc(var(--100nvh, 1vh) * 10.789062);

	border: 1px solid #767676;
	border-radius: 6px;
	background-color: transparent;
}

button.delivery-option-btn:hover {
	box-shadow: 2px 2px 5px #c4bbaa;
	color: #ebcb9a;
	border-color: #ebcb9a;
}

.delivery-options-container > button:last-child {
	margin-right: 0;
}

button.active-delivery-option-btn {
	border: none !important;
	color: inherit !important;

	background-image: url("/images/icons/order-pg/select-btn.png");
	background-size: cover;
	background-repeat: no-repeat;
}

button.active-delivery-option-btn:hover {
	text-shadow: none !important;
	border-color: none !important;
}

.selected-delivery-content {
	display: grid;
	/* not less than 60% of parent in height */
	flex: 0 0 50%;
	flex-direction: row;
	align-items: stretch;
	justify-content: flex-start;
	/* border: 2px solid #c4bbaa; */

	grid-template-columns: [first] 38% repeat(2, $DESKTOP_ORDER_ROW_HEIGHT);
	gap: 4% 4%;
	width: 100%;
	max-width: 100%;
	padding: 3vmin 0 1vmin 0;
	padding: calc(var(--100nvmin, 1vmin) * 3) 0 var(--100nvmin, 1vmin) 0;
	margin: auto 0;
}

.selected-delivery-content-3rows {
	flex: 0 0 50%;
	grid-template-rows: repeat(3, 30%);
}

.selected-delivery-content-2rows {
	flex: 0 0 45%;
	grid-template-rows: repeat(2, 45%);
}

.selected-delivery-content-wrapper {
	margin: 1vh 0;
	margin: var(--100nvh, 1vh) 0;
}

p.input-cell {
	padding: 0;
}

p.input-cell div.invalid-field {
	font-size: calc(0.5rem + 0.4vmin) !important;
	font-size: calc(0.5rem + var(--100nvmin, 1vmin) * 0.4) !important;
	margin: 0.5vmin 0;
	margin: calc(var(--100nvmin, 1vmin) * 0.5) 0;
}

p.address-cell {
	grid-row: 2;
	grid-column: 2 / span 2;
}

.summary-paragraph {
	display: flex;
	flex: 1 0 9%;
	flex-direction: column;
	align-items: stretch;
	justify-content: flex-end;
	margin: 2vmin 0;
	margin: calc(var(--100nvmin, 1vmin) * 2) 0;

	max-width: 25%;
	width: 25%;
}

.price-row {
	display: flex;
	flex-direction: row;
	flex: 0 0 auto;
	max-width: 100%;
	justify-content: space-between;
	align-items: center;
	padding: 0.5vmin 0;
	padding: calc(var(--100nvmin, 1vmin) * 0.5) 0;

	max-height: fit-content;
}

.summary-paragraph * h2 {
	font-size: calc(0.5rem + 0.8vh);
	font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.8);
}

.summary-title {
	max-height: fit-content;
	max-width: fit-content;
}

h1.summary-text {
	font-size: calc(1rem + 1vh);
	font-size: calc(1rem + var(--100nvh, 1vh));
	font-family: "steilgut_opensans";
	font-weight: 100;
	color: #313131;
	text-align: center;
	text-transform: unset;
}

.summary-text {
	margin: 0;
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

	button.delivery-option-btn {
		min-height: unset;
		max-height: unset;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.delivery-options {
		flex: 0 0 auto;
		padding: 2vh 4vw;
	}

	.delivery-options-container {
		flex-wrap: wrap;
		justify-content: center;
	}

	h2.select-delivery-text {
		font-size: calc(1.5rem + 0.9vh);
	}

	button.delivery-option-btn {
		width: 44vw;
		height: 86px;
		margin: 1vh 1vh 1vh 0;
	}

	button.delivery-option-btn h2.delivery-options-header {
		font-size: calc(0.7rem + var(--100vmin, 1vmin) * 0.7);
	}

	.selected-delivery-content {
		display: flex;
		/* not less than 60% of parent in height */
		flex: 1 0 auto;
		flex-direction: column;
		align-items: stretch;
		justify-content: center;
		border: 2px solid #c4bbaa;

		width: 100%;
		max-width: 100%;
		padding: 2vh 2vw;
		margin: auto;
	}

	.selected-delivery-content p {
		padding: 2vh 0;
	}

	.summary-paragraph {
		margin: 0;
		margin-top: 2vh;
		max-width: 80%;
		width: 80%;
	}

	.input-cell > label,
	.summary-paragraph * h2 {
		font-size: calc(0.8rem + 0.8vh);
	}

	.input-cell > input {
		font-size: 2.5vh;
	}

	.input-address-country-zipcode {
		display: inline-flex;
		width: 100%;
		max-width: 100%;
	}

	.input-address-country-zipcode .input-cell {
		max-width: 47%;
	}

	.input-address-country-zipcode .input-cell:first-child {
		margin-right: 4vw;
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
	h2.select-delivery-text {
		font-size: 1rem;
		font-size: calc(1rem + 1vmin);
		font-size: calc(1rem + var(--100vmin, 1vmin));
	}

	button.delivery-option-btn {
		width: 156px;
		height: 72px;
	}

	button.delivery-option-btn h2.delivery-options-header {
		font-size: calc(0.775rem + 0.8vmin);
	}

	.summary-paragraph * h2 {
		font-size: calc(0.7rem + 0.8vh);
		font-size: calc(0.7rem + calc(var(--100vh, 1vh) * 0.8));
	}

	.delivery-options-container {
		flex: 0 0 20%;
		align-self: flex-start;
	}

	.input-cell > label {
		font-size: calc(0.8rem + 0.6vh);
		font-size: calc(0.8rem + calc(var(--100vh, 1vh) * 0.6));
	}

	.input-cell > input {
		font-size: calc(0.9rem + 0.8vh);
		font-size: calc(0.9rem + calc(var(--100vh, 1vh) * 0.8));
	}

	.selected-delivery-content {
		border: 2px solid #c4bbaa;
	}

	.selected-delivery-content > p {
		padding: 2vh;
		padding: calc(var(--100vh, 1vh) * 2);
	}

	.summary-paragraph {
		max-width: 40%;
		width: 40%;
	}

	.selected-delivery-content-2rows {
		flex: 0 0 45%;
		grid-template-rows: repeat(2, 17vh);
		grid-template-rows: repeat(2, calc(var(--100vh, 1vh) * 17));
	}

	.selected-delivery-content-3rows {
		grid-template-rows: repeat(3, 19vh);
		grid-template-rows: repeat(3, calc(var(--100vh, 1vh) * 19));
	}

	.agreement-container {
		.agreement-checkbox-container {
			margin-right: 2vw;

			.checkmark::after {
				left: -50%;
				top: -50%;
			}
		}

		label.agreement-text {
			white-space: unset;
		}
	}

	label.delivery-input-label {
		@include text-wrapper;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			h2.select-delivery-text {
				font-size: 1rem;
				font-size: calc(1rem + 1vmin);
			}

			button.delivery-option-btn h2.delivery-options-header {
				font-size: calc(0.775rem + 0.8vmin);
			}

			.summary-paragraph * h2 {
				font-size: calc(0.7rem + 0.8vh);
			}

			.delivery-options-container {
				flex: 0 0 20%;
				align-self: flex-start;
			}

			.input-cell > label {
				font-size: calc(0.8rem + 0.6vh);
			}

			.input-cell > input {
				font-size: calc(0.9rem + 0.8vh);
			}

			.selected-delivery-content > p {
				padding: 2vh;
			}

			.selected-delivery-content-2rows {
				flex: 0 0 45%;
				grid-template-rows: repeat(2, 17vh);
			}

			.selected-delivery-content-3rows {
				grid-template-rows: repeat(3, 19vh);
			}
		}
	}
}

@media only screen and (min-width: 320px) and (max-device-height: 568px) and (orientation: landscape) {
	.selected-delivery-content-3rows {
		grid-template-rows: repeat(3, 22vh);
		grid-template-rows: repeat(3, calc(var(--100vh, 1vh) * 22));
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.selected-delivery-content-3rows {
				grid-template-rows: repeat(3, 22vh);
			}
		}
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.delivery-options-container {
		flex: 0 0 auto;
	}

	.selected-delivery-content {
		margin: 0;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			.input-cell > label {
				font-size: calc(0.4rem + 0.4vmin);
				font-size: calc(0.4rem + var(--100nvmin, 1vmin) * 0.4);
			}

			.selected-delivery-content {
				max-height: 52%;
			}
		}
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.selected-delivery-content {
		flex: 0 0 50%;
	}

	input.delivery-option-btn {
		width: 13.541667vw;
		width: calc(var(--100nvw, 1vw) * 13.541667);
		height: 8.789062vh;
		height: calc(var(--100nvh, 1vh) * 8.789062);
	}
}

@media only screen and (min-width: 1025px) and (max-height: 720px) and (orientation: landscape) {
	.delivery-options-container {
		flex: 0 0 auto;
	}

	.delivery-options-container button.delivery-option-btn {
		max-width: 15%;
		margin: 0 1% 0 0;
	}
	.selected-delivery-content-3rows {
		grid-template-rows: repeat(3, $DESKTOP_ORDER_ROW_HEIGHT);
	}

	p.input-cell {
		padding: 2% 0;
	}
}
</style>
