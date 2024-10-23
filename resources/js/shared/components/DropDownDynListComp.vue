<template>
	<div class="drop-down-box">
		<div v-if="isLoading" class="tw-block tw-p-2 md:tw-px-2 landscape:tw-px-2">
			<div
				class="loader tw-ease-linear tw-rounded-full tw-border-2 tw-border-t-2 tw-border-gray-400 tw-h-8 tw-w-8"
			></div>
		</div>
		<div v-else>
			<div class="tw-hidden md:tw-block landscape:tw-block tw-relative">
				<div
					class="drop-down-box-header tw-cursor-pointer"
					v-on:click="isOpen = !isOpen"
				>
					<span
						class="drop-down-header-text tw-block tw-mx-2 landscape:tw-m-0 tw-relative"
					>
						<span>{{ __("wines." + attributeName) }}</span>
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
						class="list-item md:tw-flex landscape:tw-flex tw-hidden tw-cursor-pointer tw-overflow-hidden"
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

				<button
					class="tw-fixed tw-z-4 tw-inset-0 tw-h-screen tw-w-screen light-bg-shadow-filter focus:tw-outline-none tw-cursor-default"
					v-if="isOpen"
					v-on:click="isOpen = false"
				></button>
			</div>
			<div class="md:tw-hidden landscape:tw-hidden tw-block">
				<div class="drop-down-header-block" v-on:click="isOpen = !isOpen">
					<span
						class="drop-down-header-text tw-inline-block tw-mx-2 tw-relative"
					>
						<span>{{ __("wines." + attributeName) }}</span>
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
					class="drop-down-container tw-relative tw-z-3 tw-bg-dyn-drop-down-item-bg-beige"
					v-if="isOpen"
				>
					<div
						class="list-item"
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

				<button
					class="tw-fixed tw-z-2 tw-inset-0 tw-h-full tw-w-full light-bg-shadow-filter focus:tw-outline-none tw-cursor-default"
					v-if="isOpen"
					v-on:click="isOpen = false"
				></button>
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
			default: "color",
		},

		extractUrl: {
			type: String,
			default: "/api/wines/get/colors",
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
			if (this.getSelectedAttribute()) {
				this.selectedAttributeValue = this.getSelectedAttribute();
			}
			console.log("Debug [DropDownDynListComp] set orientationchange listener");
			window.addEventListener("orientationchange", () => {
				console.log("Debug [DropDownDynListComp] orientationchange ");
				this.selectedAttributeValue = this.getSelectedAttribute();
			});
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
				this.$store.dispatch("replaceAttributeFilterValue", {
					attributeName: this.attributeName,
					attributeValue: attr,
				});
				this.selectedAttributeValue = attr;
			} else {
				this.$store.dispatch("removeFromAttributeFilter", {
					attributeName: this.attributeName,
				});
				this.selectedAttributeValue = null;
			}
			this.$emit("select-item", event, this.attributeName, attr);
			this.isOpen = false;
		},

		resetSelectedAttribute: function (event) {
			console.log(
				"Debug [DropDownDynListComp::resetSelectedAttribute] Selected attribute: "
			);
			this.$store.dispatch("removeFromAttributeFilter", {
				attributeName: this.attributeName,
			});
			this.selectedAttributeValue = null;
			this.$emit("reset-selected-item", event);
		},

		getSelectedAttribute: function () {
			return this.getFilterAttributeValue({
				attributeName: this.attributeName,
			});
		},
	},

	computed: {
		ifOpen: function () {
			return this.isOpen;
		},

		...mapGetters(["getFilterAttributeValue"]),
	},
};
</script>

<style lang="scss" scoped>
.drop-down-header-text {
	font-size: 1rem;
	font-size: calc(0.5rem + var(--100nvh, 1vh) * 0.8);
	font-family: "steilgut_opensans", sans-serif;
	font-weight: 100;
	color: #313131;
}

.drop-down-box-arrow-down,
.drop-down-box-arrow-up {
	width: 12px;
	max-width: 12px;
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
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.drop-down-header-text {
		font-size: calc(1rem + 0.5vh);
		font-family: "steilgut_cormorant", sans-serif;
		font-weight: 100;
		color: #313131;
	}

	.drop-down-box-header {
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

	.drop-down-header-text {
		display: inline-block;
		max-width: 50%;
		width: 45%;
	}

	.drop-down-box-arrow-down {
		display: inline-block;
		max-width: 50%;
		width: 45%;
	}

	.drop-down-box-arrow-up {
		display: inline-block;
		max-width: 50%;
		width: 45%;
	}

	.drop-down-box-arrow-down img,
	.drop-down-box-arrow-up img {
		margin: auto 0 auto auto;
	}

	.drop-down-container {
		display: block;
		max-width: 100%;
		width: 100%;
		overflow-y: auto;
		overflow-x: hidden;
		padding: 1rem 0 1rem 0;
		max-height: 6rem;
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
		margin-top: 2.9vh;
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

	.drop-down-header-text {
		font-size: 3.1vmin;
		padding-right: 4vmin;
	}

	.drop-down-header-text:last-child {
		margin-right: 0;
	}

	.drop-down-box-arrow-down {
		max-width: 2.8vmin;
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	/* styles */
	.drop-down-box-header {
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
}

/*********************************************************************
*
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
