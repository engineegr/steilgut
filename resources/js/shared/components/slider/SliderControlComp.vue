<template>
	<div class="slider-control">
		<div
			class="md:tw-block tw-hidden tw-w-full tw-min-w-full tw-h-full tw-min-h-full"
		>
			<div
				class="tw-absolute tw-z-2 tw-inset-0 tw-h-full tw-w-full tw-opacity-50 focus:tw-outline-none tw-cursor-default"
				v-on:wheel.prevent="handleWheel"
			></div>
			<div v-on:click="handleClickUp">
				<slot name="md-up-edge"></slot>
			</div>

			<div v-on:click="handleClickDown">
				<slot name="md-down-edge"></slot>
			</div>
		</div>
		<div
			class="md:tw-hidden tw-relative tw-w-full tw-min-w-full tw-h-full tw-min-h-full"
		>
			<div class="tw-block"></div>
			<div class="landscape:tw-block"></div>

			<v-touch
				class="tw-absolute tw-z-2 tw-inset-0 tw-h-full tw-w-full tw-bg-transparent focus:tw-outline-none tw-cursor-default tw-pointer-events-auto"
				v-on:swipeup.prevent="handleSwipeUp"
				v-on:swipedown.prevent="handleSwipeDown"
				v-on:tap.prevent="handleTap"
			></v-touch>
		</div>
	</div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import { SliderHelper } from "../../utils/slider";

export default {
	data() {
		return {
			timerId: null,
		};
	},
	methods: {
		handleClickUp: function (event) {
			// debugger;
			"use strict";
			this.$emit(
				"decrease-list",
				event,
				SliderHelper.calcSliderClickUp({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					itemCount: this.itemCount,
					maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
					step: 1,
					isAutoLoading: false,
				})
			);
		},

		handleClickDown: function (event) {
			// debugger;
			"use strict";
			this.$emit(
				"increase-list",
				event,
				SliderHelper.calcSliderClickDown({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					itemCount: this.itemCount,
					maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
					step: 1,
					isAutoLoading: false,
				})
			);
		},

		handleWheel: function (event) {
			"use strict";
			if (!this.timerId) {
				this.timerId = setTimeout(() => {
					console.log("Debug [SliderControlComp::handleWheel]");
					// debugger;
					if (event.deltaY > 0) {
						this.handleClickDown(event);
					} else {
						this.handleClickUp(event);
					}

					clearTimeout(this.timerId);
					this.timerId = null;
				}, 1000);
			}
		},

		handleSwipeUp: function (event) {
			"use strict";
			// debugger;
			console.log("Debug [SliderControlComp::handleSwipeDown]");
			this.$emit(
				"swipe-up-list",
				event,
				SliderHelper.calcSliderSwipeUp({
					from: this.from,
					to: this.to,
					cursor: this.cursor,
					itemCount: this.itemCount,
					// step: this.$_calcDeltaItemCount(event),
					step: this.getSliderMaxItemQuantityPerPage,
					isAutoLoading: false,
				})
			);
		},

		handleSwipeDown: function (event) {
			"use strict";
			// debugger;
			console.log("Debug [SliderControlComp::handleSwipeUp]");
			if (this.from > 0) {
				this.$emit(
					"swipe-down-list",
					event,
					SliderHelper.calcSliderSwipeDown({
						from: this.from,
						to: this.to,
						// step: this.$_calcDeltaItemCount(event),
						step: this.getSliderMaxItemQuantityPerPage,
						cursor: this.cursor,
					})
				);
			}
		},

		handleTap: function (event) {
			// debugger;
			"use strict";
			console.log("Debug [SliderComp::handleTap]");

			const keyRegPattern = /(\d+)_sliderItemControl/;
			const itemKey = this.$vnode.key;
			let [_, key] = keyRegPattern.exec(itemKey);
			this.$emit("tap-on-item", event, parseInt(key));
		},

		$_calcDeltaItemCount: function (event) {
			"use strict";
			// debugger;
			const boxHeightPx = event.target.offsetHeight;
			const distance = event.distance;
			return Math.round(distance / boxHeightPx);
		},
	},

	computed: {
		...mapState({
			itemCount: (state) => {
				return state.slider.count;
			},

			cursor: (state) => {
				return state.slider.control.cursor;
			},

			from: (state) => {
				return state.slider.control.from;
			},

			to: (state) => {
				return state.slider.control.to;
			},

			itemHeightPercent: (state) => {
				return state.slider.itemHeightPercent;
			},
		}),

		...mapGetters(["getSliderMaxItemQuantityPerPage"]),
	},
};
</script>

<style lang="scss" scoped></style>
