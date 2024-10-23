<template>
	<div class="input-cell">
		<label
			:for="`${idp}au-address-input`"
			:class="[
				{
					'is-required-field': $_ifRequired(),
					'is-invalid-field': $_ifInvalid(),
				},
				addressLabelStyleClassList,
			]"
			>{{ label }}</label
		>
		<input
			type="text"
			:tabindex="tabindex"
			:id="`${idp}au-address-input`"
			name="au-address-input"
			v-on:input="$emit('input', $event.target.value)"
			v-bind:value="value"
			class="tw-appearance-none focus:tw-outline-none au-address-input user-field"
			:class="[{ 'is-invalid-field': $_ifInvalid() }, addressInputStyleClassList]"
			@[ifGoogleAddressDisabled].passive="fillInAddress($event)"
		/>

		<transition name="fade">
			<validation-error
				class="tw-max-w-095"
				v-if="$_ifInvalid() && validationErrors && validationErrors.length > 0"
				:errors="validationErrors"
			></validation-error>
		</transition>
	</div>
</template>

<script>
export default {
	props: {
		idp: {
			type: [String],
			default: "desktop-",
			required: false,
		},

		value: {
			type: [String],
			required: true,
		},

		tabindex: {
			type: [String, Number],
			default: 5,
		},

		apiKey: {
			type: [String],
			// default: "AIzaSyAxvg0Zn65JpuldfSnvGuKm_IRfTi2O4ts",
			default: "AIzaSyB4M7J17ElccuGRn4T88JS2w4vNqV8TyrY",
		},

		label: {
			type: [String],
			defaul: "Address",
		},

		isRequired: {
			type: [String, Boolean],
			default: false,
		},

		isInvalid: {
			type: [String, Boolean],
			default: false,
		},

		isGoogleAddressDisabled: {
			type: [String, Boolean],
			default: true,
		},

		validationErrors: {
			type: [Array],
			defaul: [],
		},

		addressLabelStyleClassList: {
			type: [String, Object],
			default: "",
		},

		addressInputStyleClassList: {
			type: [String, Object],
			default: "",
		},
	},

	data: function () {
		return {
			autocomplete: undefined,
		};
	},

	mounted() {
		"use strict";
		if (!this.isGoogleAddressDisabled) {
			const input = document.getElementById(`${this.idp}au-address-input`);
			const options = {
				types: ["geocode"],
			};
			this.autocomplete = new google.maps.places.Autocomplete(input, options);
			// When the user selects an address from the drop-down, populate the
			// address fields in the form.
			this.autocomplete.addListener("place_changed", this.fillInAddress);
		}
	},

	methods: {
		fillInAddress: function (event) {
			("use sctrict");
			const addressStr = document.getElementById(`${this.idp}au-address-input`)
				.value;
			if (this.isGoogleAddressDisabled) {
				this.$emit("auc-address-change", event, null, addressStr);
				this.$el.focus();
			} else {
				const place = this.autocomplete.getPlace();
				const address = {};
				address.place_id = place.place_id;
				place.address_components.forEach(function (addressComp) {
					switch (addressComp.types[0]) {
						case "street_number":
							address.StreetNumber = addressComp;
							break;
						case "route":
							address.StreetName = addressComp;
							break;
						case "neighborhood":
						case "locality":
							address.City = addressComp;
							break;
						case "administrative_area_level_1":
							address.State = addressComp;
							break;
						case "postal_code":
							address.Zip = addressComp;
							break;
						case "country":
							address.Country = addressComp;
							break;
					}
				});
				this.$emit("auc-address-change", address, addressStr);
			}
		},

		$_ifRequired: function () {
			"use strict";
			return (
				(typeof this.isRequired === "string" && this.isRequired === "true") ||
				(typeof this.isRequired === "boolean" && this.isRequired)
			);
		},

		$_ifInvalid: function () {
			"use strict";
			return (
				(typeof this.isInvalid === "string" && this.isInvalid === "true") ||
				(typeof this.isInvalid === "boolean" && this.isInvalid)
			);
		},
	},

	computed: {
		ifGoogleAddressDisabled: function () {
			"use strict";
			return this.isGoogleAddressDisabled ? "blur" : null;
		},
	},
};
</script>

<style lang="scss" scoped>
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
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.input-cell > label {
		font-size: calc(0.8em + 0.8vh);
	}

	.input-cell > input {
		font-size: 2.5vh;
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.input-cell > input {
		padding: 1.25vh 0;
		padding: calc(var(--100nvh, 1vh) * 1.25) 0;
	}
}
</style>
