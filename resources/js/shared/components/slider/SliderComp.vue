<template>
	<div
		class="slider md:tw-max-h-full md:tw-h-full landscape:tw-min-h-full tw-h-full tw-w-full tw-max-w-full"
	>
		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div class="md:tw-max-h-full md:tw-h-full md:tw-max-w-full md:tw-w-full" v-else>
			<div v-if="isLoading" class="tw-block">
				<pulse-logo-comp isDefer="true" isDark="true"></pulse-logo-comp>
			</div>
			<div
				class="md:tw-max-h-full md:tw-h-full tw-h-auto tw-w-full tw-max-w-full landscape:tw-h-full"
			>
				<transition name="fade">
					<div v-if="!itemBackgroundHidden" class="tw-block">
						<slot
							name="background-img"
							v-if="getSliderData"
							v-bind:itemData="getItemDataByIndex(sliderControlCursor)"
						>
						</slot>
					</div>
				</transition>
				<div
					v-if="!mdViewHidden"
					:class="[
						'tw-hidden',
						'md:tw-flex',
						'landscape:tw-hidden',
						mdItemBlockStyleClass,
					]"
				>
					<slot
						v-if="getSliderData"
						name="mdItemListView"
						v-bind:itemData="getSliderData"
						v-bind:from="sliderControlFrom"
						v-bind:to="sliderControlTo"
						v-bind:cursor="sliderControlCursor"
						v-bind:itemQuantityPerPage="calcItemQuantityPerPage"
						v-bind:handleDecreaseListCallback="handleDecreaseList"
						v-bind:handleIncreaseListCallback="handleIncreaseList"
						v-bind:handleRebuildListCallback="handleRebuildList"
						v-bind:handleAsyncRebuildListByRangeCallback="
							handleAsyncRebuildListByRange
						"
						v-bind:applySliderNewRangeCallback="applySliderNewRange"
						v-bind:setSliderControlCursorCallback="setSliderControlCursor"
					>
						<!-- Default implementation of item list in desktop -->

						<div :class="[mdItemListToContentStyleClass]">
							<div :class="[mdItemsStyleClass, 'tw-relative']">
								<div
									class="md-up-edge-indent tw-relative tw-h-1/10"
								></div>

								<div
									v-for="i in calcItemQuantityPerPage"
									ref="ref_sliderItems"
									:key="`${sliderControlFrom + i - 1}_sliderItem`"
									v-on:click="handleOnClickItemHeader($event, i)"
									:class="[
										mdItemStyleClassCallback(
											sliderControlFrom,
											sliderControlTo,
											i
										),
									]"
								>
									<slot
										name="itemHeaderView"
										v-bind:itemData="getSliderItemDataByKey({ i })"
										v-bind:itemKey="`${
											sliderControlFrom + i - 1
										}_sliderItemHeader`"
										v-bind:isActive="
											sliderControlCursor + 1 ==
											sliderControlFrom + i
										"
									></slot>
								</div>

								<div
									class="md-down-edge-indent tw-relative tw-h-1/10"
								></div>

								<slider-control
									class="tw-absolute tw-inset-0"
									v-on:increase-list="handleIncreaseList"
									v-on:decrease-list="handleDecreaseList"
								>
									<template v-slot:md-up-edge>
										<slot name="md-up-edge-control"></slot>
									</template>
									<template v-slot:md-down-edge>
										<slot name="md-down-edge-control"></slot>
									</template>
								</slider-control>
							</div>
							<slot
								name="itemContentView"
								v-bind:itemData="getItemDataByIndex(sliderControlCursor)"
								v-bind:itemKey="sliderControlCursor"
								v-bind:isOpen="isOpen"
							></slot>
						</div>

						<!-- END: Default implementation of item list in portrait mobile -->
					</slot>
				</div>
				<div v-if="!mobileViewHidden" class="md:tw-hidden">
					<div
						:class="[
							'tw-block',
							'landscape:tw-hidden',
							'md:tw-hidden',
							itemBlockStyleClass,
						]"
					>
						<slot
							name="itemListView"
							v-if="getSliderData"
							v-bind:itemData="getSliderData"
							v-bind:from="sliderControlFrom"
							v-bind:to="sliderControlTo"
							v-bind:cursor="sliderControlCursor"
							v-bind:itemQuantityPerPage="calcItemQuantityPerPage"
							v-bind:handleDecreaseListCallback="handleDecreaseList"
							v-bind:handleIncreaseListCallback="handleIncreaseList"
							v-bind:handleRebuildListCallback="handleRebuildList"
							v-bind:applySliderNewRangeCallback="applySliderNewRange"
							v-bind:setSliderControlCursorCallback="setSliderControlCursor"
							v-bind:handleSwipeUpListCallback="handleSwipeUpList"
							v-bind:handleSwipeDownListCallback="handleSwipeDownList"
						>
							<!-- Default implementation of item list in portrait mobile -->

							<div class="drop-down-box tw-relative tw-z-2">
								<div
									class="drop-down-box-header tw-z-2 tw-relative tw-w-full tw-max-w-full tw-pl-4"
									v-on:click="isOpen = !isOpen"
								>
									<slot
										name="itemHeaderView"
										v-bind:itemData="
											getItemDataByIndex(sliderControlCursor)
										"
										v-bind:itemKey="`${sliderControlCursor}_sliderItemHeader`"
										v-bind:isActive="true"
									></slot>
									<div v-if="!isOpen" class="drop-down-box-arrow-down">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="15"
											height="9"
											viewBox="0 0 15 9"
										>
											<polyline
												fill="none"
												stroke="#FFF"
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												points=".66 .41 6.723 6.48 .8 12.41"
												transform="rotate(90 6.5 7.5)"
											/>
										</svg>
									</div>
									<div class="drop-down-box-arrow-up" v-else>
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="15"
											height="9"
											viewBox="0 0 15 9"
										>
											<polyline
												fill="none"
												stroke="#FFF"
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												points=".66 .41 6.723 6.48 .8 12.41"
												transform="rotate(-90 4.5 3.5)"
											/>
										</svg>
									</div>
								</div>
								<div
									v-if="isOpen"
									class="drop-down-box-hidden-list tw-flex tw-z-2 tw-relative tw-w-full tw-min-w-full tw-h-auto tw-pl-4"
								>
									<div
										v-for="i in calcItemQuantityPerPage"
										:key="`${sliderControlFrom + i - 1}_sliderItem`"
										class="tw-relative tw-z-10 tw-w-full tw-max-w-full"
										v-on:click="handleOnClickItemHeader($event, i)"
									>
										<slot
											name="itemHeaderView"
											v-bind:itemData="
												getSliderItemDataByKey({ i })
											"
											v-bind:itemKey="`${
												sliderControlFrom + i - 1
											}_sliderItemHeader`"
										></slot>

										<slider-control
											:key="`${
												sliderControlFrom + i - 1
											}_sliderItemControl`"
											:class="[
												'tw-absolute',
												'tw-z-10',
												'tw-inset-0',
												'tw-min-h-full',
												'tw-h-full',
												'tw-w-full',
												'tw-min-w-full',
												'tw-opacity-50',
												'focus:tw-outline-none',
												'tw-cursor-default',
												'tw-pointer-events-none',
												'hover:tw-bg-transparent',
												calcItemBgStyleClass(i),
											]"
											v-on:swipe-up-list="handleSwipeUpList"
											v-on:swipe-down-list="handleSwipeDownList"
											v-on:tap-on-item="handleTapItem"
										></slider-control>
									</div>
								</div>
								<button
									class="tw-fixed tw-z-1 tw-inset-0 tw-h-full tw-w-full tw-opacity-50 focus:tw-outline-none tw-cursor-default"
									v-if="isOpen"
									v-on:click="isOpen = false"
								></button>
							</div>
							<slot
								name="itemContentView"
								v-bind:itemData="getItemDataByIndex(sliderControlCursor)"
								v-bind:itemKey="`${sliderControlCursor}_sliderItemContent`"
								v-bind:isOpen="isOpen"
							></slot>

							<!-- END: Default implementation of item list in portrait mobile -->
						</slot>
					</div>
					<div
						:class="[
							'tw-hidden',
							'landscape:tw-block',
							'md:tw-hidden',
							landscapeItemBlockStyleClass,
						]"
					>
						<slot
							v-if="getSliderData"
							name="lsItemListView"
							v-bind:itemData="getSliderData"
							v-bind:from="sliderControlFrom"
							v-bind:to="sliderControlTo"
							v-bind:cursor="sliderControlCursor"
							v-bind:itemQuantityPerPage="calcItemQuantityPerPage"
							v-bind:handleDecreaseListCallback="handleDecreaseList"
							v-bind:handleIncreaseListCallback="handleIncreaseList"
							v-bind:handleRebuildListCallback="handleRebuildList"
							v-bind:handleAsyncRebuildListByRangeCallback="
								handleAsyncRebuildListByRange
							"
							v-bind:applySliderNewRangeCallback="applySliderNewRange"
							v-bind:setSliderControlCursorCallback="setSliderControlCursor"
						>
							<!-- Default implementation of item list in landscape mobile -->

							<div
								class="drop-down-box tw-relative tw-z-10 tw-h-080 tw-max-h-4/5 tw-max-w-full tw-w-full"
							>
								<div
									class="drop-down-box-header tw-z-10 tw-relative tw-max-w-full tw-px-4"
									v-on:click="isOpen = !isOpen"
								>
									<slot
										name="itemHeaderView"
										v-bind:itemData="
											getItemDataByIndex(sliderControlCursor)
										"
										v-bind:itemKey="`${sliderControlCursor}_sliderItemHeader`"
										v-bind:isActive="true"
									></slot>
									<div v-if="!isOpen" class="drop-down-box-arrow-down">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="15"
											height="9"
											viewBox="0 0 15 9"
										>
											<polyline
												fill="none"
												stroke="#FFF"
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												points=".66 .41 6.723 6.48 .8 12.41"
												transform="rotate(90 6.5 7.5)"
											/>
										</svg>
									</div>
									<div v-else>
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="15"
											height="9"
											viewBox="0 0 15 9"
										>
											<polyline
												fill="none"
												stroke="#FFF"
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												points=".66 .41 6.723 6.48 .8 12.41"
												transform="rotate(-90 4.5 3.5)"
											/>
										</svg>
									</div>
								</div>
								<div
									v-if="isOpen"
									class="drop-down-box-hidden-list tw-relative tw-z-10 tw-w-full tw-max-w-full tw-px-4 tw-h-auto"
									v-on:click="isOpen = false"
								>
									<div
										v-for="i in calcItemQuantityPerPage"
										:key="`${sliderControlFrom + i - 1}_sliderItem`"
										v-on:click="handleOnClickItemHeader($event, i)"
										class="tw-relative tw-z-10"
									>
										<slot
											name="itemHeaderView"
											v-bind:itemData="
												getSliderItemDataByKey({ i })
											"
											v-bind:itemKey="`${
												sliderControlFrom + i - 1
											}_sliderItemHeader`"
										></slot>

										<slider-control
											:key="`${
												sliderControlFrom + i - 1
											}_sliderItemControl`"
											:class="[
												'tw-absolute',
												'tw-z-10',
												'tw-inset-0',
												'tw-px-4',
												'tw-min-h-full',
												'tw-h-full',
												'tw-w-4/5',
												'tw-max-w-080',
												'tw-opacity-50',
												'focus:tw-outline-none',
												'tw-cursor-default',
												'tw-pointer-events-none',
												'hover:tw-bg-transparent',
												calcItemBgStyleClass(i),
											]"
											v-on:swipe-up-list="handleSwipeUpList"
											v-on:swipe-down-list="handleSwipeDownList"
											v-on:tap-on-item="handleTapItem"
										></slider-control>
									</div>
								</div>
								<button
									class="tw-absolute tw-z-9 tw-inset-0 tw-h-full tw-w-full tw-opacity-50 focus:tw-outline-none tw-cursor-default"
									v-if="isOpen"
									v-on:click="isOpen = false"
								></button>
							</div>

							<slot
								name="itemContentView"
								v-bind:itemData="getItemDataByIndex(sliderControlCursor)"
								v-bind:itemKey="sliderControlCursor"
								v-bind:isOpen="isOpen"
							></slot>

							<!-- END: Default implementation of item list in landscape mobile -->
						</slot>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import SliderControlComp from "./SliderControlComp";
import PulseLogoComp from "../PulseLogoComp";
import { mapState, mapGetters } from "vuex";
import { SliderHelper } from "../../utils/slider";
import mediaHelper from "../../mixins/mediaHelper";
import { is422, is404, is500, processErrorResponse } from "../../utils/response";

export default {
	mixins: [mediaHelper],

	components: {
		"slider-control": SliderControlComp,
		"pulse-logo-comp": PulseLogoComp,
	},

	props: {
		isInitialState: {
			type: [String, Boolean],
			required: false,
			default: false,
		},

		calcCountRequestExpression: [Function],
		calcRangeDataRequestExpression: [Function],

		//
		// Passing style classes for different layouts:
		// they encompass the whole items block
		//
		mdItemBlockStyleClass: {
			type: [String],
			default:
				"md:tw-flex tw-relative tw-z-2 tw-items-center \
                tw-justify-center tw-h-full tw-max-h-full \
                tw-w-full tw-max-w-full",
		},

		itemBlockStyleClass: {
			type: [String],
			default:
				"tw-block tw-items-center tw-justify-center \
                tw-h-full tw-max-h-full tw-w-full tw-max-w-full",
		},

		landscapeItemBlockStyleClass: {
			type: [String],
			default: "landscape:tw-block tw-w-full tw-min-w-full",
		},

		//
		// Style class is passed for an item list (desktop layout - md)
		//
		mdItemsStyleClass: [String],

		//
		// Style class is passed to control an active item's content view and an item list (desktop layout - md)
		//
		mdItemListToContentStyleClass: {
			type: [String],
			default: "md-default-slider-items-to-content-style-class",
		},

		//
		// Style class is passed for a separate item element (desktop layout - md)
		//
		mdItemStyleClassCallback: {
			type: [Function],
			default: (from, to, index) => {
				return "tw-w-full tw-max-w-full h-auto";
			},
		},

		itemBlockStyleClass: {
			type: [String],
		},

		landscapeItemBlockStyleClass: {
			type: [String],
		},

		mobileViewHidden: {
			type: [Boolean, String],
			default: false,
		},

		mdViewHidden: {
			type: [Boolean, String],
			default: false,
		},

		itemBackgroundHidden: {
			type: [Boolean, String],
			default: false,
		},

		// For Desktop layout
		mdShowLoading: {
			type: [Boolean, String],
			default: true,
		},

		// For portrait layout
		showLoading: {
			type: [Boolean, String],
			default: true,
		},

		// For landscape layout
		landscapeShowLoading: {
			type: [Boolean, String],
			default: true,
		},

		// Stop loading callbacks
		stopLoadingAsyncFn: {
			type: [Function],
			default: () => {
				console.log("SliderComp [stopLoadingAsyncFn]");
				return Promise.resolve(true);
			},
		},
		// For Desktop
		mdStopLoadingCallback: {
			type: [Function],
			default: (isError) => {
				console.log("SliderComp [mdStopLoadingCallback]");
				if (isError) {
					console.log(
						"SliderComp [mdStopLoadingCallback] Warning error occurred during data loading"
					);
				}
			},
		},

		// For Portrait
		stopLoadingCallback: {
			type: [Function],
			default: (isError) => {
				console.log("SliderComp [stopLoadingCallback]");
				if (isError) {
					console.log(
						"SliderComp [stopLoadingCallback] Warning error occurred during data loading"
					);
				}
			},
		},

		// For Landscape
		landscapeStopLoadingCallback: {
			type: [Function],
			default: (isError) => {
				if (isError) {
					console.warn(
						"SliderComp [landscapeStopLoadingCallback] Warning error occurred during data loading"
					);
				}
			},
		},
	},

	data: function () {
		return {
			isLoading: false,
			isError: false,

			// for mobile
			isOpen: false,
		};
	},

	created() {
		"use strict";
		if (!this.isInitialState) {
			this.$_reBuild();
		}
	},

	methods: {
		getItemDataByIndex: function (index) {
			return this.getSliderData[index];
		},

		handleSwipeUpList: async function (event, newRange) {
			"use strict";
			console.log("Debug [SliderComp::handleSwipeUpList]");
			const isSparseData = this.$root.$data.helper.isSparseArray(
				this.getSliderData
			);
			let retPromise = null;
			if (isSparseData) {
				const promise = this.$_straightwayUpdateSparseItemData(newRange);
			} else {
				retPromise = this.$_straightwayUpdateItemData(newRange);
			}
			this.$emit("on-increase-list", event, newRange);
			return retPromise;
		},

		handleSwipeDownList: function (event, newRange) {
			// debugger;
			console.log("Debug [SliderComp::handleSwipeDownList]");
			const isSparseData = this.$root.$data.helper.isSparseArray(
				this.getSliderData
			);
			if (isSparseData) {
				return this.$_reverseUpdateSparseItemData(newRange);
			}
			this.$_applySwipedNewRange(newRange);
			this.$emit("on-decrease-list", event, newRange);
			const self = this;
			return new Promise((resolveFunc, rejectFunc) => {
				resolveFunc({
					newItemData: {},
					oldItemData: self.getSliderData,
					self,
				});
			});
		},

		handleTapItem: function (event, newCursor) {
			this.isOpen = false;
			this.$store.commit("setSliderControlCursor", newCursor);
			this.$emit("on-tap-item", event, newCursor);
		},

		handleIncreaseList: function (event, newRange) {
			const isSparseData = this.$root.$data.helper.isSparseArray(
				this.getSliderData
			);
			let retPromise = null;
			if (isSparseData) {
				retPromise = this.$_straightwayUpdateSparseItemData(newRange);
			} else {
				retPromise = this.$_straightwayUpdateItemData(newRange);
			}
			this.$emit("on-increase-list", event, newRange);
			return retPromise;
		},

		handleDecreaseList: function (event, newRange) {
			"use strict";
			const isSparseData = this.$root.$data.helper.isSparseArray(
				this.getSliderData
			);
			if (isSparseData) {
				return this.$_reverseUpdateSparseItemData(newRange);
			}
			this.applySliderNewRange(newRange);
			this.$emit("on-decrease-list", event, newRange);
			const self = this;
			return new Promise((resolveFunc, rejectFunc) => {
				resolveFunc({
					newItemData: {},
					oldItemData: self.getSliderData,
				});
			});
		},

		handleRebuildList: function (event) {
			"use strict";
			this.isLoading = true;
			this.$_applySwipedNewRange({
				from: 0,
				to: 0,
			});
			this.$_reBuild();
		},

		handleAsyncRebuildListByRange: function (event, newRange) {
			"use strict";
			this.isLoading = true;
			return this.$_asyncReBuildByRange(newRange);
		},

		handleResizeList: async function (event, newRange) {
			"use strict";
			this.isLoading = true;
			return this.$_straightwayUpdateItemData(newRange);
		},

		handleAutoloadList: async function (event, newRange) {
			"use strict";
			// debugger;
			console.log("Debug [SliderComp::handleAutoloadList] ");
			this.isLoading = true;
			return this.$_straightwayUpdateItemData(newRange);
		},

		handleOnClickItemHeader: function (event, key) {
			this.$emit("on-click-item-header", event, key);
		},

		$_findItemByKey: function (key) {
			"use strict";
			return this.$children.filter(
				(child) =>
					child.$props &&
					child.$props.itemKey &&
					child.$props.itemKey == key + "_sliderItemHeader"
			);
		},

		applySliderNewRange: function (newRange) {
			"use strict";
			this.$store.commit("setSliderControlCursor", newRange["cursor"]);
			this.$store.commit("setSliderControlFrom", newRange["from"]);
			this.$store.commit("setSliderControlTo", newRange["to"]);
		},

		setSliderControlCursor: function (aNewCursor) {
			if (
				aNewCursor < this.sliderControlFrom ||
				aNewCursor > this.sliderControlTo
			) {
				this.isError = true;
				console.error(
					"SliderComp [setSliderControlCursor] Invalid cursor value " +
						aNewCursor
				);
			} else {
				this.$store.commit("setSliderControlCursor", aNewCursor);
			}
		},

		$_applySwipedNewRange: function (newRange) {
			"use strict";
			// debugger;
			const deltaCursorFrom = this.sliderControlCursor - this.sliderControlFrom;
			this.$store.commit(
				"setSliderControlCursor",
				newRange["from"] + deltaCursorFrom
			);
			this.$store.commit("setSliderControlFrom", newRange["from"]);
			this.$store.commit("setSliderControlTo", newRange["to"]);
		},

		$_straightwayUpdateItemData: async function (newRange) {
			"use strict";
			try {
				const to = newRange["to"];
				const diff = this.getSliderMaxItemQuantityPerPage;
				const oldItemData = this.getSliderData.slice(
					0,
					this.getSliderData.length
				);
				const self = this;
				if (
					SliderHelper.isLoading({
						itemData: this.getSliderData,
						to: newRange["to"],
						maxLength: this.itemCount,
					})
				) {
					this.$_startLoadingPreProcess();
					const startIndex = this.getSliderData.length;

					let endIndex = startIndex + diff * this.sliderControlLoadBudget;
					if (endIndex > this.itemCount) {
						endIndex = this.itemCount - 1;
					}
					const requestBody = this.calcRangeDataRequestExpression(
						startIndex + 1,
						endIndex + 1
					)();
					console.log("Debug [SliderComp::created] " + requestBody.url);

					const newItemData = (
						await axios.get(requestBody.url, {
							params: requestBody.params,
						})
					).data.data;

					this.$store.commit("setSliderData", oldItemData.concat(newItemData));
					return new Promise((resolve, reject) => {
						resolve({
							newItemData,
							oldItemData,
							self,
						});
					});
				} else {
					return new Promise((resolve, reject) => {
						resolve({
							newItemData: {},
							oldItemData,
							self,
						});
					});
				}
			} catch (reject) {
				processErrorResponse(reject);
				self.isError = true;
			} finally {
				if (!this.isError) {
					this.applySliderNewRange(newRange);
				}
				if (this.isLoading) {
					this.$_stopLoadingPostProcess();
				}
			}
		},

		$_straightwayUpdateSparseItemData: async function (newRange) {
			"use strict";
			const oldItemData = this.getSliderData;
			const isSparseData = this.$root.$data.helper.isSparseArray(oldItemData);
			if (!isSparseData) {
				throw new Error(
					"Error [SliderComp::$_straightwayUpdateSparseItemData] Invalid parameters: the slider data is not sparse"
				);
			}
			try {
				const from = newRange["from"];
				const to = newRange["to"];
				const diff = this.getSliderMaxItemQuantityPerPage;
				const itemData = this.getSliderData;
				const self = this;

				let startIndex = from;
				let endIndex = startIndex + diff * this.sliderControlLoadBudget;
				if (endIndex > itemData.length - 1) {
					endIndex = itemData.length - 1;
				}
				if (
					SliderHelper.isLoadingRange({
						itemData,
						startIndex,
						endIndex,
					})
				) {
					debugger;
					this.$_startLoadingPreProcess();
					const requestBody = this.calcRangeDataRequestExpression(
						startIndex + 1,
						endIndex + 1
					)();
					console.log("Debug [SliderComp::created] " + requestBody.url);
					const newItemData = (
						await axios.get(requestBody.url, {
							params: requestBody.params,
						})
					).data.data;
					for (
						let k = startIndex, m = 0;
						k <= endIndex, m < newItemData.length;
						k++, m++
					) {
						oldItemData[k] = newItemData[m];
					}
					this.$store.commit("setSliderData", oldItemData);
					return new Promise((resolve, reject) => {
						resolve({
							newItemData,
							oldItemData,
							self,
						});
					});
				} else {
					return new Promise((resolve, reject) => {
						resolve({
							newItemData: {},
							oldItemData,
							self,
						});
					});
				}
			} catch (reject) {
				processErrorResponse(reject);
				self.isError = true;
			} finally {
				if (!this.isError) {
					this.applySliderNewRange(newRange);
					this.$emit("on-increase-list");
				}
				if (this.isLoading) {
					this.$_stopLoadingPostProcess();
				}
			}
		},

		$_reverseUpdateSparseItemData: async function (newRange) {
			"use strict";
			const oldItemData = this.getSliderData;
			const isSparseData = this.$root.$data.helper.isSparseArray(oldItemData);
			if (!isSparseData) {
				throw new Error(
					"Error [SliderComp::$_reverseUpdateSparseItemData] Invalid parameters: the slider data is not sparse"
				);
			}
			try {
				const maxIndex = this.getSliderData.length - 1;
				const diff = this.getSliderMaxItemQuantityPerPage;
				let startIndex = newRange["from"] - diff * this.sliderControlLoadBudget;
				const self = this;
				if (startIndex < 0) {
					startIndex = 0;
				}
				let endIndex = newRange["to"];
				if (endIndex > maxIndex) {
					endIndex = maxIndex;
				}
				// debugger;
				if (
					SliderHelper.isReverseLoading({
						itemData: this.getSliderData,
						startIndex,
						endIndex,
					})
				) {
					this.$_startLoadingPreProcess();
					const requestBody = this.calcRangeDataRequestExpression(
						startIndex + 1,
						endIndex + 1
					)();
					const newItemData = (
						await axios.get(requestBody.url, {
							params: requestBody.params,
						})
					).data.data;

					for (
						let i = startIndex, j = 0;
						i <= endIndex, j < newItemData.length;
						i++, j++
					) {
						oldItemData[i] = newItemData[j];
					}
					this.$store.commit("setSliderData", oldItemData);
					return new Promise((resolve, reject) => {
						resolve({
							newItemData,
							oldItemData,
							self,
						});
					});
				} else {
					return new Promise((resolve, reject) => {
						resolve({
							newItemData: {},
							oldItemData,
							self,
						});
					});
				}
			} catch (reject) {
				processErrorResponse(reject);
				self.isError = true;
				return new Promise((resolveFunc, rejectFunc) => {
					rejectFunc({
						reject,
					});
				});
			} finally {
				if (!this.isError) {
					this.applySliderNewRange(newRange);
					this.$emit("on-decrease-list");
				}
				if (this.isLoading) {
					this.$_stopLoadingPostProcess();
				}
			}
		},

		$_asyncReBuildByRange: async function (newRange) {
			"use strict";
			this.$_startLoadingPreProcess();
			let from = newRange["from"];
			let to = newRange["to"];
			let newItemData;

			try {
				const requestBody = this.calcRangeDataRequestExpression(
					from + 1,
					to + 1
				)();
				newItemData = (
					await axios.get(requestBody.url, {
						params: requestBody.params,
					})
				).data.data;
			} catch (reject) {
				this.processErrorResponse(reject);
				this.isError = true;
				return new Promise((resolveFunc, rejectFunc) => {
					rejectFunc({
						reject,
					});
				});
			} finally {
				const oldItemData = this.getSliderData;
				if (!this.isError) {
					this.$store.commit("setSliderData", newItemData);
					this.$store.commit("setSliderControlCursor", 0);
					this.$store.commit("setSliderControlFrom", 0);
					this.$store.commit("setSliderControlTo", to);
				}
				this.$_stopLoadingPostProcess();
				return new Promise((resolveFunc, rejectFunc) => {
					resolveFunc({
						newItemData,
						oldItemData,
					});
				});
			}
		},

		$_reBuild: function () {
			this.$_startLoadingPreProcess();
			let to = 0;
			const countRequestBody = this.calcCountRequestExpression()();
			const self = this;
			axios({
				method: "GET",
				url: countRequestBody.url,
				params: countRequestBody.params,
				// timeout: 500,
			})
				.then((response) => {
					const count = response.data.data.count;
					self.$store.commit("setSliderDataCount", count);
					if (count < self.getSliderMaxItemQuantityPerPage) {
						to = count - 1;
					} else {
						to = self.getSliderMaxItemQuantityPerPage - 1;
					}

					const diff = self.getSliderMaxItemQuantityPerPage;
					let loadTo = to + diff * self.sliderControlLoadBudget;
					loadTo = loadTo > count ? count : loadTo;
					const requestBody = self.calcRangeDataRequestExpression(1, loadTo)();
					return axios.get(requestBody.url, {
						params: requestBody.params,
					});
				})
				.then((response) => {
					let newItemData = response.data.data;
					if (!Array.isArray(newItemData)) {
						newItemData = Object.values(newItemData);
					}

					const oldItemData = self.getSliderData;
					self.$store.commit("setSliderControlCursor", 0);
					self.$store.commit("setSliderControlFrom", 0);
					self.$store.commit("setSliderData", newItemData);
					self.$store.commit("setSliderControlTo", to);
					self.$_stopLoadingPostProcess();
				})
				.catch((reject) => {
					processErrorResponse(reject);
					self.isError = true;
				});
		},

		$_startLoadingPreProcess: function () {
			"use strict";
			this.isLoading = true;
			this.isError = false;
			this.$emit("on-start-loading-items");
		},

		$_stopLoadingPostProcess: function () {
			"use strict";
			if (this.stopLoadingAsyncFn && !this.isError) {
				this.stopLoadingAsyncFn().then((isSuccess) => {
					this.$_postLoadingProcess();
					this.isError = !isSuccess;
				});
			} else {
				this.$_postLoadingProcess();
			}
		},

		$_postLoadingProcess: function () {
			"use strict";

			this.isLoading = false;
			if (this.$root.$data.helper.isPortraitOrientation()) {
				this.stopLoadingCallback(this.isError);
			} else if (this.$root.$data.helper.isLandscapeOrientation()) {
				this.landscapeStopLoadingCallback(this.isError);
			} else {
				this.mdStopLoadingCallback(this.isError);
			}
			this.$emit("on-stop-loading-items", this.isError);
		},

		calcItemBgStyleClass: function (i) {
			return this.sliderControlCursor + 1 == this.sliderControlFrom + i
				? "tw-bg-transparent"
				: "tw-bg-gray-300";
		},
	},

	computed: {
		...mapState({
			itemCount: (state) => {
				return state.slider.count;
			},

			sliderControlLoadBudget: (state) => {
				return state.slider.control.loadBudget;
			},

			sliderControlCursor: (state) => {
				return state.slider.control.cursor;
			},

			sliderControlFrom: (state) => {
				return state.slider.control.from;
			},

			sliderControlTo: (state) => {
				return state.slider.control.to;
			},
		}),

		...mapGetters([
			"getSliderItemQuantityPerPage",
			"getSliderMaxItemQuantityPerPage",
			"getSliderControlCursor",
			"getSliderData",
			"getSliderItemDataByKey",
		]),

		calcItemQuantityPerPage: function () {
			return this.getSliderItemQuantityPerPage;
		},
	},
};
</script>

<style lang="scss" scoped>
.loading-msg {
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	position: fixed;
	z-index: 20;
}

.slider {
	flex-grow: 1;
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
	.drop-down-box {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.drop-down-box-header {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
	}

	.drop-down-box-inner-list a {
		margin-left: 20%;
		font-family: steilgut_cormorant;
		font-weight: 300;
		font-size: 1em;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.drop-down-box-hidden-list {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.drop-down-box-header,
	.drop-down-box-inner-list {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;

		width: calc(var(--100vw, 1vw) * 80);
		max-width: calc(var(--100vw, 1vw) * 80);
		margin: auto auto auto 0;
	}
}
</style>
