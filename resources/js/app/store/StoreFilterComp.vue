<template>
	<div
		class="tw-block md:tw-flex md:tw-w-fit-content md:tw-max-w-fit-content landscape:tw-flex landscape:tw-w-fit-content landscape:tw-max-w-fit-content tw-w-full tw-max-w-full tw-h-auto"
	>
		<!-- Desktop/Landscape layouts-->
		<div class="filter-block tw-hidden md:tw-inline-flex landscape:tw-hidden">
			<h1 class="filter-title">{{ __("store.filters") }}:</h1>
			<span class="tw-inline-flex filter-drop-down-block">
				<!-- <drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline drop-down-dyn-list"
					extractUrl="/api/wines/attrs/colors"
				></drop-down-dyn-list>
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline drop-down-dyn-list"
					attributeName="volume"
					extractUrl="/api/wines/attrs/volumes"
				></drop-down-dyn-list> -->
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline landscape:tw-flex drop-down-dyn-list"
					attributeName="harvest"
					extractUrl="/api/wines/attrs/harvests"
				></drop-down-dyn-list>
				<!-- <drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline landscape:tw-flex drop-down-dyn-list"
					attributeName="wineSort"
					extractUrl="/api/wines/attrs/sorts"
				></drop-down-dyn-list>
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline landscape:tw-flex drop-down-dyn-list"
					attributeName="wineType"
					extractUrl="/api/wines/attrs/types"
				></drop-down-dyn-list> -->
			</span>
		</div>

		<!-- Landscape layout -->
		<div class="filter-block tw-hidden md:tw-hidden landscape:tw-inline-flex">
			<h1 class="filter-title">{{ __("store.filters") }}:</h1>
			<div class="tw-flex filter-drop-down-block">
				<!-- <drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline drop-down-dyn-list"
					extractUrl="/api/wines/attrs/colors"
				></drop-down-dyn-list>

				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline drop-down-dyn-list"
					attributeName="volume"
					extractUrl="/api/wines/attrs/volumes"
				></drop-down-dyn-list> -->
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline drop-down-dyn-list"
					attributeName="harvest"
					extractUrl="/api/wines/attrs/harvests"
				></drop-down-dyn-list>

				<!-- <drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline drop-down-dyn-list"
					attributeName="wineSort"
					extractUrl="/api/wines/attrs/sorts"
				></drop-down-dyn-list>
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="md:tw-inline drop-down-dyn-list"
					attributeName="wineType"
					extractUrl="/api/wines/attrs/types"
				></drop-down-dyn-list> -->
			</div>
		</div>

		<!--  Phone layouts -->
		<div class="filter-block tw-block md:tw-hidden landscape:tw-hidden">
			<header class="store-header-block">
				<h2
					class="minimum-order-precaution"
					:class="[
						{
							'is-invalid-note': !isMinimumConditionProp,
						},
					]"
				>
					{{ __("store.minimumOrder") }}
				</h2>

				<div
					class="filter-title-block"
					v-on:click.prevent="handleFilterOpenning($event)"
				>
					<img
						src="/images/orig/store-pg/mobile/open-filter-icon.svg"
						alt="Open filter"
						v-if="!isOpen"
					/>
					<img
						src="/images/orig/store-pg/mobile/close-filter-icon.svg"
						alt="Close filter"
						v-if="isOpen"
					/>
					<h1>{{ __("store.filters") }}</h1>
				</div>
			</header>
			<div v-if="isOpen" class="tw-block">
				<!-- <drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="drop-down-dyn-list"
					extractUrl="/api/wines/attrs/colors"
				></drop-down-dyn-list>
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="drop-down-dyn-list"
					attributeName="volume"
					extractUrl="/api/wines/attrs/volumes"
				></drop-down-dyn-list> -->
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="drop-down-dyn-list"
					attributeName="harvest"
					extractUrl="/api/wines/attrs/harvests"
				></drop-down-dyn-list>
				<!-- <drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="drop-down-dyn-list"
					attributeName="wineSort"
					extractUrl="/api/wines/attrs/sorts"
				></drop-down-dyn-list>
				<drop-down-dyn-list
					v-on:select-item="handleSelectFilterItem"
					v-on:reset-selected-item="handleResetSelectedItem"
					class="drop-down-dyn-list wide-drop-down-dyn-list"
					attributeName="wineType"
					extractUrl="/api/wines/attrs/types"
				></drop-down-dyn-list> -->
			</div>
		</div>
	</div>
</template>

<script>
import DropDownDynListComp from "../../shared/components/DropDownDynListComp";
import { mapGetters } from "vuex";
export default {
	props: {
		isMinimumConditionProp: {
			type: [String, Boolean, Function],
			required: false,
			default: false,
		},
	},

	data: function () {
		return {
			isOpen: false,
			isLoading: false,
		};
	},
	components: {
		"drop-down-dyn-list": DropDownDynListComp,
	},

	created: function () {
		console.log("Debug [StoreFilterComp::created]");
		// this.$store.commit("resetAttributeFilter");
	},

	methods: {
		handleFilterOpenning: function (event) {
			console.log("Debug [StoreFilterComp::handleFilterOpenning]");
			this.$emit("open-filter", event, (this.isOpen = !this.isOpen));
		},

		handleSelectFilterItem: function (event) {
			console.log(
				"Debug [StoreFilterComp::handleSelectFilterItem] attribute value: "
			);
			this.$emit("select-filtered-item", event);
		},

		handleResetSelectedItem: function (event) {
			console.log(
				"Debug [StoreFilterComp::handleResetSelectedItem] reset attribute value: "
			);
			this.$emit("reset-filtered-item", event);
		},
	},

	computed: {
		...mapGetters(["getAttributeFilter", "getFilterAttributeValue"]),
	},
};
</script>

<style lang="scss" scoped>
.filter-block {
	width: fit-content;
	max-width: 100%;
	max-height: 100%;

	margin: auto 0;

	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	justify-content: center;
	align-content: center;
}

h1.filter-title,
.minimum-order-precaution {
	font-size: 1em;
	font-size: calc(0.5em + var(--100nvh, 1vh) * 0.8);
	font-family: "steilgut_opensans";
	font-weight: 100;
	color: #313131;
	margin: auto 1.5em auto 0;
	text-transform: unset;
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
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	header.store-header-block {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: space-evenly;
		align-items: flex-start;
		padding-left: 1em;
		max-height: unset;
	}

	.filter-title-block {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		max-width: 50%;
		justify-content: space-evenly;
		align-items: center;
	}

	h2.minimum-order-precaution,
	.filter-title-block h1 {
		font-family: "steilgut_opensans ", sans-serif;
		font-weight: 100;
		color: #313131;
		font-size: calc(1rem + 0.5vh);
		margin-left: 0.7rem;
	}

	h2.minimum-order-precaution {
		margin-right: 0.5em;
		font-size: calc(0.8em + 0.3vh);
		max-width: 50%;
	}

	.filter-block {
		max-width: 100%;
		width: 100%;
		height: auto;
		margin: 3vh auto 3vh auto;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	h1.filter-title {
		font-size: 3.5vmin;
		margin: auto 2vmin auto 0;
		height: fit-content;
	}

	.filter-block {
		flex-direction: row;
		max-width: fit-content;
		margin: auto auto auto 0;
	}

	.drop-down-dyn-list {
		flex-grow: 1;
		margin-right: 2vw;
		max-width: fit-content;
	}

	.filter-drop-down-block {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		align-items: center;
		justify-content: flex-start;
		max-width: fit-content;
	}
}

/* Desktops and laptops ----------- */
@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.drop-down-dyn-list {
		width: fit-content;
		max-height: 100;
		height: fit-content;

		margin-right: 1em;
	}

	.drop-down-dyn-list:last-child {
		margin-right: auto;
	}

	.filter-drop-down-block {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		justify-content: center;
		align-items: center;
	}
}
</style>
