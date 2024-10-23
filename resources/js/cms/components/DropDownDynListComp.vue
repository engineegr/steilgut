<template>
	<div class="drop-down-box tw-rounded">
		<div v-if="isLoading" class="tw-block tw-p-2 md:tw-px-2 landscape:tw-px-2">
			<div
				class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
			></div>
		</div>
		<div v-else>
			<div
				class="tw-hidden md:tw-flex landscape:tw-flex tw-relative drop-down-box-common"
			>
				<div
					class="drop-down-box-header tw-cursor-pointer tw-px-2"
					v-on:click="isOpen = !isOpen"
				>
					<span
						class="drop-down-header-text tw-flex tw-justify-start tw-items-center tw-mx-2 landscape:tw-m-0 tw-relative"
					>
						<span>{{ __("common." + attributeName) }}</span>
						<span v-if="selectedAttributeValue">:</span>
						<span
							class="tw-mx-2 tw-inline tw-text-dyn-drop-down-item-text-pink"
							v-if="selectedAttributeValue"
						>
							{{ ` ${selectedAttributeValue}` }}
							<i
								class="fas fa-times fal"
								v-on:click.stop="resetSelectedAttribute($event)"
							></i>
						</span>
					</span>
					<div v-if="!isOpen" class="drop-down-box-arrow-down">
						<img
							src="/images/orig/store-pg/arrow-down.svg"
							alt="Closed filter"
						/>
					</div>
					<div v-else class="drop-down-box-arrow-up">
						<img
							src="/images/orig/store-pg/arrow-up.svg"
							alt="Openned filter"
						/>
					</div>
				</div>

				<div
					class="drop-down-container tw-shadow-lg tw-bg-dyn-drop-down-item-bg-beige tw-block"
					v-if="isOpen"
				>
					<!-- Content of the list -->
					<div
						class="list-item tw-cursor-pointer md:tw-flex landscape:tw-flex tw-hidden tw-cursor-pointer tw-overflow-hidden tw-opacity-50"
						v-for="(attr, i) in attributeList"
						:key="`${i}_${attr}_storeSliderItem`"
						v-on:click="handleSelectItem($event, attr)"
					>
						<span
							class="attribute-text tw-text-mt-bg-brown hover:tw-text-dyn-drop-down-item-text-pink"
							>{{ attr }}</span
						>
					</div>
				</div>
			</div>
			<div class="md:tw-hidden landscape:tw-hidden tw-block tw-relative">
				<div class="drop-down-box-header" v-on:click="isOpen = !isOpen">
					<span
						class="drop-down-header-text tw-inline-block tw-mx-2 tw-relative"
					>
						<span v-if="!selectedAttributeValue">{{
							__("wines." + attributeName)
						}}</span>
						<input
							v-if="selectedAttributeValue"
							tabindex="2"
							type="text"
							:id="`${attributeName}InputField`"
							:name="`${attributeName}InputField`"
							autocomplete="on"
							v-model="selectedAttributeValue"
							class="tw-appearance-none focus:tw-outline-none user-field tw-bg-transparent tw-w-full"
						/>
					</span>
					<div v-if="!isOpen" class="drop-down-box-arrow-down">
						<img
							src="/images/orig/store-pg/arrow-down.svg"
							alt="Closed filter"
						/>
					</div>
					<div v-else class="drop-down-box-arrow-up">
						<img
							src="/images/orig/store-pg/arrow-up.svg"
							alt="Openned filter"
						/>
					</div>
				</div>

				<div
					class="drop-down-container tw-absolute tw-z-3 tw-bg-dyn-drop-down-item-bg-beige"
					v-if="isOpen"
				>
					<div
						class="list-item tw-cursor-pointer"
						v-for="(attr, i) in attributeList"
						:key="`${i}_${attr}_storeSliderItem`"
						v-on:click="handleSelectItem($event, attr)"
					>
						<span
							class="attribute-text tw-text-mt-bg-brown hover:tw-text-dyn-drop-down-item-text-pink"
							>{{ attr }}</span
						>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	props: {
		attributeName: {
			type: String,
			default: "lang",
		},

		initial: {
			type: String,
			requred: true,
		},

		extractUrl: {
			type: String,
			default: "/api/cms/langs",
		},
	},

	data: function () {
		return {
			attributeList: [" "],

			isOpen: false,
			isLoading: false,
			isError: false,
			selectedAttributeValue: null,
		};
	},

	async created() {
		const handleEscKey = (e) => {
			if (e.key === "Esc" || e.key == "Escape") {
				this.isOpen = false;
			}
		};

		document.addEventListener("keydown", handleEscKey);
		this.$once("hook:beforeDestroy", () => {
			document.removeEventListener("keydown", handleEscKey);
		});

		// debugger;
		// this.$store.commit("resetAttributeFilter");
		this.isLoading = true;
		try {
			this.attributeList = this.attributeList.concat(
				(await axios.get(this.extractUrl)).data
			);
		} catch (error) {
			console.log("Error [DropDownDynListComp::created] " + error);
			this.isError = true;
			this.isLoading = false;
			this.attributeList = null;
		} finally {
			this.isLoading = false;
		}
	},

	mounted() {
		("use strict");
		if (!this.initial) {
			console.warn("DropDownDynListComp [mounted] Null initial selected attribute");
		} else {
			this.selectedAttributeValue = this.initial;
		}
	},

	methods: {
		handleSelectItem: function (event, attr) {
			// debugger;
			console.log(
				"Debug [DropDownDynListComp::handleSelectItem] Selected attribute: " +
					attr
			);
			if (attr !== " ") {
				this.selectedAttributeValue = attr;
			} else {
				this.selectedAttributeValue = null;
			}
			this.isOpen = false;
		},
	},

	computed: {
		ifOpen: function () {
			return this.isOpen;
		},
	},
};
</script>

<style scoped>
/* styles */
.drop-down-box {
	width: 100%;
	background-color: #cbcdc4;
	background-image: linear-gradient(to top, rgba(0, 0, 0, 0) 0%, #b7b1b1 100%);
}

.drop-down-box-header {
	height: 3rem;

	font-size: 1rem;
	font-family: "steilgut_opensans", sans-serif;
	font-weight: bolder;
	color: #313131;

	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	justify-content: space-between;
	align-items: center;
}

.drop-down-container {
	position: absolute;
	z-index: 5;
	display: block;
	height: auto;
	max-height: 27vh;
	min-width: 100%;
	width: fit-content;
	overflow-y: auto;
	overflow-x: hidden;
	right: 0;
	top: 100%;
	margin-top: 12px;
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

.drop-down-box-common {
	height: 45px;
}

.drop-down-box-arrow-down,
.drop-down-box-arrow-up {
	width: 12px;
	max-width: 12px;
}

/* width */
::-webkit-scrollbar {
	height: auto;
	/* border-radius: 10px; */
}

/* Track */
::-webkit-scrollbar-track {
	background: transparent;
	/* border-radius: 10px; */
	opacity: 0.5;
}

/* Handle */
::-webkit-scrollbar-thumb {
	background: #ededed;
	/* border-radius: 10px; */
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
	background: #ebcb9a;
}

.attribute-text {
	width: fit-content;
	margin: auto auto auto 0;
	padding: 0 0.5rem 0 0.5rem;
	min-height: 1.6rem;
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

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/
/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.drop-down-box-header {
		width: 212px;
		height: 45px;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.drop-down-header-text {
		font-size: calc(1rem + 0.5vh);
		font-weight: 100;
		color: #313131;
	}

	.drop-down-box-header {
		display: flex;
		flex-direction: row;
		justify-content: space-evenly;
		align-items: center;
		width: 100%;
	}

	.drop-down-header-text {
		display: inline-block;
		max-width: 75%;
		width: 75%;
	}

	.drop-down-box-arrow-up,
	.drop-down-box-arrow-down {
		display: flex;
		width: 10%;
	}

	.drop-down-box-arrow-down img,
	.drop-down-box-arrow-up img {
		margin: auto 0 auto auto;
		cursor: pointer;
	}

	.drop-down-container {
		display: block;
		max-width: 100%;
		width: 100%;
		overflow-y: auto;
		overflow-x: hidden;
		padding: 1rem 0 1rem 0;
		max-height: 6rem;
		top: 100%;
	}

	.drop-down-container .list-item {
		display: block;
		position: relative;
		padding: 1rem 0 1rem 0;
		max-width: 100%;
		width: 100%;
	}

	.drop-down-container .list-item:last-child {
		padding: 1rem 0 0.5rem 0;
	}

	.drop-down-container .list-item .attribute-text {
		display: inline-block;
		position: absolute;
		right: 0;
		top: 0;
		max-width: 80%;
		width: 80%;
		margin: auto 0 auto auto;
		text-transform: capitalize;
		font-size: calc(1rem + 0.3vh);
	}

	.drop-down-container::-webkit-scrollbar {
		display: none;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.drop-down-box-header {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		max-width: 100%;
		width: 100%;
	}

	.drop-down-container {
		position: absolute;
		z-index: 5;
		display: block;
		height: auto;
		max-height: 100px;
		min-width: 100%;
		width: fit-content;
		overflow-y: auto;
		overflow-x: hidden;
		right: 0;
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

	.drop-down-header-text:last-child {
		margin-right: 0;
	}

	.drop-down-box-arrow-down {
		max-width: 2.8vmin;
		max-width: calc(var(--100vh, 1vh) * 2.8);
	}
}

/* Smartphones (portrait) ----------- */
@media only screen and (max-width: 320px) {
	/* Styles */
}

/* iPads (portrait and landscape) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) {
	/* Styles */
}

/* iPads (landscape) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
	/* Styles */
}

/* iPads (portrait) ----------- */
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: portrait) {
	/* Styles */
}

/**********
iPad 3
**********/
@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 2) {
	/* Styles */
}

@media only screen and (min-device-width: 768px) and (max-width: 1024px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 2) {
	/* Styles */
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1024px) and (orientation: landscape) {
}

/*********************************************************************
*
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
