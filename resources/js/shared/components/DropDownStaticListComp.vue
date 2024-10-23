<template>
	<div class="drop-down-static-list tw-relative md:tw-h-auto">
		<div
			class="drop-down-static-list-wrapper tw-cursor-pointer tw-w-full tw-relative tw-max-h-full"
			:class="dropDownStaticListWrapperCtrlStyleClass"
		>
			<div
				class="drop-down-header-wrapper tw-flex tw-flex-col tw-relative md:tw-top-0 tw-w-full tw-text-left tw-h-full tw-max-h-full tw-z-9"
				:class="dropDownStaticHeaderWrapperStyleClass"
			>
				<label
					for="static-attribute"
					class="tw-relative tw-w-full"
					:class="[
						inputLabelStyleClassList,
						{ 'is-required-field': isRequired },
					]"
					v-if="isHeader && selectedAttributeValue"
					>{{ attributeName }}</label
				>
				<input
					type="text"
					name="static-attribute"
					:class="inputCtrlStyleClassList"
					class="tw-appearance-none focus:tw-outline-none tw-bg-transparent tw-w-full tw-max-w-full tw-overflow-auto drop-down-header-field tw-cursor-pointer tw-flex-grow"
					v-model="selectedAttributeValue"
				/>

				<div
					class="drop-down-list-body-wrapper tw-outline-none focus:tw-outline-none"
					:class="dropDownStaticListBodyWrapperStyleClass"
					:tabIndex="tabindex"
					v-on:click="handleOpenClick($event, isOpen)"
					v-on:focus="handleOpenClick($event)"
					v-on:blur="isOpen = false"
				>
					<div
						class="drop-down-list-body tw-shadow-lg tw-flex tw-flex-col tw-h-auto tw-max-w-full"
						:class="getListBackground"
						v-if="isOpen"
					>
						<div
							class="list-item tw-flex tw-cursor-pointer tw-flex-grow hover:tw-text-dyn-drop-down-item-text-pink"
							:class="[
								dropDownListItemCtrlStyleClass,
								getListItemTextStyleClass,
							]"
							v-for="(attr, i) in attributeValueList"
							:key="`${i}_${attr}_storeSliderItem`"
							v-on:click="handleSelectItem($event, attr)"
						>
							<div class="tw-inline-block tw-m-auto">{{ attr }}</div>
						</div>
					</div>
				</div>
			</div>

			<div
				class="tw-min-h-full tw-min-w-full tw-absolute drop-down-list-control-element-container tw-z-10"
				:class="[
					dropDownStaticListContolElemStyleClass,
					getControlElementStyleClass,
				]"
				v-on:click="handleSwitchClick($event)"
			>
				<img
					v-if="!isOpen && isControl"
					class="tw-absolute control-arrow"
					:class="downArrowSelectorCtrlStyleClassList"
					src="/images/icons/commons/white-arrow-down.svg"
					alt="Closed filter"
				/>

				<img
					v-if="isOpen && isControl"
					class="tw-absolute control-arrow"
					:class="upArrowSelectorCtrlStyleClassList"
					src="/images/icons/commons/white-arrow-up.svg"
					alt="Openned filter"
				/>
			</div>
		</div>

		<button
			class="tw-fixed tw-z-4 tw-inset-0 tw-h-screen tw-w-screen focus:tw-outline-none tw-cursor-default"
			v-if="isOpen"
			v-on:click="isOpen = false"
		></button>
	</div>
</template>

<script>
export default {
	props: {
		attributeName: {
			type: String,
			default: "Time",
		},

		dropDownStaticListWrapperCtrlStyleClass: {
			type: String,
			default: "",
		},

		dropDownStaticHeaderWrapperStyleClass: {
			type: String,
			default: "md:tw-h-full",
		},

		inputLabelStyleClassList: {
			type: String,
			default: "",
		},

		inputCtrlStyleClassList: {
			type: String,
			default: "",
		},

		upArrowSelectorCtrlStyleClassList: {
			type: String,
			default: "",
		},

		downArrowSelectorCtrlStyleClassList: {
			type: String,
			default: "",
		},

		dropDownListItemCtrlStyleClass: {
			type: String,
			default: "",
		},

		dropDownStaticListBodyWrapperStyleClass: {
			type: String,
			default: "",
		},

		dropDownStaticListContolElemStyleClass: {
			type: String,
			default: "",
		},

		attributeValue: {
			type: String,
			default: "10:00 - 12:00",
		},

		isRequired: {
			type: [Boolean, String],
			default: true,
		},

		tabindex: {
			type: [String, Number],
			default: 0,
		},

		isHeader: {
			type: [Boolean, String],
			dafault: false,
		},

		isControl: {
			type: [Boolean, String],
			default: true,
		},

		isLightMode: {
			type: [Boolean, String],
			default: false,
		},

		attributeValueList: {
			type: [Array],
			default: function () {
				return [
					"10:00 - 12:00",
					"12:00 - 14:00",
					"14:00 - 16:00",
					"16:00 - 18:00",
				];
			},
		},
	},

	data: function () {
		return {
			isOpen: false,
			selectedAttributeValue: "10:00 - 12:00",
		};
	},

	created() {
		const handleEscKey = (e) => {
			if (e.key === "Esc" || e.key == "Escape") {
				this.isOpen = false;
			}
		};

		document.addEventListener("keydown", handleEscKey);
		this.$once("hook:beforeDestroy", () => {
			document.removeEventListener("keydown", handleEscKey);
		});
		this.selectedAttributeValue = this.attributeValue;
	},

	methods: {
		handleSwitchClick: function (event) {
			("use strict");
			this.isOpen = !this.isOpen;
		},

		handleOpenClick: function (event) {
			("use strict");
			this.isOpen = true;
		},

		handleSelectItem: function (event, attr) {
			console.log(
				"Debug [DropDownStaticListComp::handleSelectItem] Selected attribute: " +
					attr
			);
			if (attr !== " ") {
				this.selectedAttributeValue = attr;
			}
			this.$emit("select-item", event, this.attributeName, attr);
			this.isOpen = false;
			event.stopPropagation();
		},

		resetSelectedAttribute: function (event) {
			console.log(
				"Debug [DropDownStaticListComp::resetSelectedAttribute] Selected attribute: "
			);
			this.selectedAttributeValue = null;
			this.$emit("reset-selected-item", event);
		},
	},

	computed: {
		getSelectedAttributeValue: function () {
			if (this.isOpen) {
				return "";
			} else {
				return this.selectedAttributeValue;
			}
		},

		getControlElementStyleClass: function () {
			if (this.isOpen) {
				return "tw-z-0";
			} else {
				return "tw-z-9";
			}
		},

		getListBackground: function () {
			if (this.isLightMode) {
				return "tw-bg-dyn-drop-down-item-bg-beige";
			} else {
				return "tw-bg-black";
			}
		},

		getListItemTextStyleClass: function () {
			if (this.isLightMode) {
				return "tw-text-black";
			} else {
				return "tw-text-white";
			}
		},
	},
};
</script>

<style lang="scss"></style>

<style lang="scss" scoped>
.drop-down-static-list {
	width: 100%;
	height: auto;

	/* Works in Safari, Mozilla */
	scrollbar-color: #ededed #cbcdc4;
	scrollbar-width: thin;

	/* Works for Webkit (Chrome) */
	::-webkit-scrollbar {
		width: 28px;
	}

	::-webkit-scrollbar-track {
		background-color: #cbcdc4;
	}

	::-webkit-scrollbar-thumb {
		border: 4px solid rgba(0, 0, 0, 0);
		background-clip: padding-box;
		background-color: #ededed;
	}
}

.drop-down-header-wrapper {
	font-size: 1rem;
	font-family: "steilgut_opensans", sans-serif;
	font-weight: 300;
	color: #ffffff;
}

.drop-down-static-list-arrow-down,
.drop-down-static-list-arrow-up {
	width: 12px;
	max-width: 12px;
}

.control-arrow {
	right: 0;
	max-height: 12%;
	max-width: 8%;
	transform: translate(0, 50%);
}

.light-bg-shadow-filter {
	/*
    * https://www.cssmatic.com/box-shadow
    * https://css-tricks.com/almanac/properties/b/box-shadow/#example
    */
	-webkit-box-shadow: inset 0px 60vh 30vh 10vh rgba(0, 0, 0, 0.2);
	-moz-box-shadow: inset 0px 60vh 30vh 10vh rgba(0, 0, 0, 0.2);
	box-shadow: inset 0px 60vh 30vh 10vh rgba(0, 0, 0, 0.2);
}

.drop-down-list-body-wrapper {
	position: absolute;
	z-index: 9;
	top: 100%;
	left: 0;
	max-width: 100%;
	width: 100%;
	max-height: 198px;
	max-height: max(calc(var(--100nvh, 1vh) * 13), 198px);

	overflow: auto;
	-webkit-overflow-scrolling: touch;
}

.drop-down-list-body {
	display: block;
	height: auto;
	min-height: 13vh;
	min-height: calc(var(--100nvh, 1vh) * 13);
	height: 13vh;
	height: calc(var(--100nvh, 1vh) * 13);

	max-width: 100%;
	width: 100%;

	transition: all 3s ease-in-out;
}

.drop-down-static-list .drop-down-static-list-wrapper {
	height: auto;
}

.drop-down-list-body .list-item {
	font-size: calc(0.5rem + 1.2vh);
	font-size: calc(0.5rem + var(--100nvh, 1vh) * 1.2);
}

.drop-down-list-body .list-item > div {
	white-space: nowrap;
	overflow-x: auto;
	overflow-y: hidden;
	text-overflow: ellipsis;

	min-width: 80%;
	max-width: 90%;
	text-align: center;
}

.drop-down-header-field {
	font-size: calc(0.4rem + 0.6vw);
	font-size: calc(0.4rem + var(--100nvw, 1vw) * 0.6);

	background: transparent;
	border-bottom: 0.05rem solid #ffffff;
	padding: 1vh 0;
	padding: var(--100nvh, 1vh) 0;
	color: #ffffff;

	min-height: calc(1rem + 3vh);
	min-height: calc(1rem + var(--100nvh, 1vh) * 3);
	height: calc(1.3rem + 3vh);
	height: calc(1.3rem + var(--100nvh, 1vh) * 3);
}

.drop-down-header-wrapper label {
	color: #c4bbaa;
	font-size: calc(0.4rem + 0.4vw);
	font-size: calc(0.4rem + var(--100nvw, 1vw) * 0.4);
}

.drop-down-header-wrapper input:disabled {
	opacity: 1;
}

.drop-down-header-wrapper input {
	position: static;
	bottom: 0;
	left: 0;
}

.inblack-element {
	opacity: 1;
	filter: grayscale(100%);
	-webkit-filter: grayscale(100%);
}

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/
/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	/* remove rounding corners */
	textarea,
	input[type="text"],
	input[type="button"],
	input[type="date"],
	input[type="submit"] {
		-webkit-appearance: none !important;
		border-radius: 0 !important;
	}

	.drop-down-list-body-wrapper {
		max-height: 20vh;
	}

	.drop-down-list-body {
		display: block;
		padding: 0;
		margin: 0;

		max-width: 100%;
		width: 100%;
		min-height: 20vh;
		height: 20vh;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.drop-down-static-list {
		display: flex;
		flex-direction: column;
		max-width: 50%;
	}

	.drop-down-header-wrapper {
		color: #ffffff;
		width: 100%;
		max-width: 100%;
	}

	.drop-down-static-list-wrapper {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
	}

	.drop-down-header-block {
		display: block;
		max-width: 100%;
		margin: 1.5rem 0;
		padding-left: 1rem;
	}

	.drop-down-static-list-arrow-down {
		display: inline-block;
		max-width: 50%;
		width: 45%;
	}

	.drop-down-static-list-arrow-up {
		display: inline-block;
		max-width: 50%;
		width: 45%;
	}

	.drop-down-static-list-arrow-down img,
	.drop-down-static-list-arrow-up img {
		margin: auto 0 auto auto;
	}

	.drop-down-list-body .list-item {
		display: block;
		position: relative;
		padding: 1vw;
		max-width: 100%;
		width: 100%;
		font-size: calc(0.4rem + 3vw);
	}

	.drop-down-list-body::-webkit-scrollbar {
		display: none;
	}

	.control-arrow {
		max-height: 30%;
		top: 0%;
	}

	.drop-down-header-wrapper label {
		font-size: calc(0.4rem + 1.7vh);
	}

	.drop-down-header-field {
		padding: 2vh 0;
		font-size: 1.2rem;
		font-size: calc(0.5rem + 1.8vh);

		max-height: unset;
		height: auto;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

@media only screen and (min-width: 320px) and (max-height: 640px) and (orientation: portrait) {
	.drop-down-list-body .list-item {
		font-size: calc(0.4rem + 2.5vw);
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.drop-down-static-list-wrapper {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		max-width: 100%;
		width: 100%;
	}

	.drop-down-list-body .list-item {
		font-size: 0.8rem;
		font-size: calc(0.4rem + 0.9vh);

		width: 100%;
		max-width: 100%;
		height: fit-content;
		max-height: 100%;

		padding: 1vh 0;
	}

	.drop-down-list-body .list-item:first-child {
		margin-top: 0.3rem;
	}

	.drop-down-list-body .list-item:last-child {
		margin-bottom: 0.3rem;
	}

	.drop-down-header-wrapper label {
		font-size: calc(0.4rem + 0.4vw);
	}

	.drop-down-header-wrapper:last-child {
		margin-right: 0;
	}

	.drop-down-static-list-arrow-down {
		max-width: 2.8vmin;
	}

	.drop-down-static-list {
		width: 100%;
		padding: 1vh 0;
		height: 17vh;
		// max-height: 23px;
	}
	.drop-down-header-field {
		padding: 1vh 0;
		font-size: calc(0.4rem + 0.9vh);
		min-height: 8vh;
	}

	.control-arrow {
		top: 6px;
		height: 6px;
		width: 10px;
	}

	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
		}
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* styles */
	.drop-down-static-list-wrapper {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
	}

	.list-item {
		width: 100%;
		max-width: 100%;
		height: fit-content;
		max-height: 100%;
	}

	.list-item:first-child {
		margin-top: 0.3rem;
	}

	.list-item:last-child {
		margin-bottom: 0.3rem;
	}
}

/*********************************************************************
*
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
