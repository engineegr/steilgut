import { mapGetters, mapState } from "vuex";
import { SliderHelper } from "../utils/slider";
import mediaHelper from "./mediaHelper";
export default {
    mixins: [mediaHelper],

    data: function () {
        return {
            // Landscape: Use for scroll from left to right and back
            startClientX: -1,
            typeMark: 'Store',
        };
    },

    methods: {
        $_handleMove: _.throttle(
            function (event) {
                // Loading if we are at the page bottom
                if (!this.isFilterOpenned) {
                    this.isAutoLoading = this.$root.$data.helper.isAtThePageBottom();
                    if (this.isAutoLoading) {
                        const newRange = SliderHelper.calcSliderSwipeUp({
                            from: this.getSliderControlFrom,
                            to: this.getSliderControlTo,
                            cursor: this.getSliderControlCursor,
                            itemCount: this.getSliderDataCount,
                            step: this.getSliderMaxItemQuantityPerPage,
                            isAutoLoading: this.isAutoLoading,
                        });
                        this.$refs?.slotProps?.handleAutoloadList(event, newRange);
                    }
                }
            },
            {
                leading: true,
                trailing: true,
            },
            50
        ),

        $_handleLandscapeTouchStart: _.throttle(
            function (event) {
                // debugger;
                // console.log("Debug [storeBasketSliderMixin listener: document => $_handleLandscapeTouchStart]");
                if (!this.isFilterOpenned) {
                    if (this.isLandscapeOrientation() && event.touches && event.touches.length === 1) {
                        this.startClientX = event.touches[0].clientX;
                        // event.preventDefault();
                    }
                }
            },
            {
                leading: true,
                trailing: true,
            },
            50
        ),

        $_handleLandscapeMove: _.throttle(
            function (event) {
                if (!this.isFilterOpenned) {
                    let scrollLeftFn = null;
                    let scrollRightFn = null;

                    switch (this.typeMark) {
                        case 'Store':
                            scrollLeftFn = this.$_handleScrollLeftList;
                            scrollRightFn = this.$_handleScollRightList;
                            break;
                        case 'Cart':
                            scrollLeftFn = this.$_handleDecreaseCartList;
                            scrollRightFn = this.$_handleIncreaseCartList;
                            break;
                        default:
                            throw new Error(`Error [$_handleLandscapeMove] Unknown slider typeMark [${this.typeMark}]`);
                            break;
                    }

                    if (this.isLandscapeOrientation() && event.touches && event.touches.length === 1 && this.startClientX > 0) {
                        let deltaX = this.startClientX - event.touches[0].clientX;
                        deltaX = deltaX < 0 ? deltaX * (-1) : deltaX;
                        if (deltaX > 33) {
                            const swipeLeft = this.startClientX > event.touches[0].clientX;
                            if (swipeLeft) {
                                scrollRightFn(event);
                            } else {
                                scrollLeftFn(event);
                            }
                            this.startClientY = -1;
                        }
                    }
                }
            },
            {
                leading: true,
                trailing: false,
            },
            50
        ),

        /*
         * Dynamic list handlers (like a store list - load from a server)
         * Redefine swipe handlers: we want to calculate a step (delta item count) on ourself
         */
        $_handleScrollLeftList: function (event) {
            // debugger;
            "use strict";
            // console.log("Debug [WinesSliderComp:$_handleScrollLeftList] ");
            const newRange = SliderHelper.calcSliderClickUp({
                from: this.from,
                to: this.to,
                cursor: this.cursor,
                itemCount: this.getSliderDataCount,
                step: 2,
                maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
                isAutoLoading: false,
            });
            this.$refs.slotProps.handleDecreaseList(event, newRange);
        },

        $_handleScollRightList: function (event) {
            "use strict";
            const newRange = SliderHelper.calcSliderClickDown({
                from: this.from,
                to: this.to,
                cursor: this.cursor,
                itemCount: this.getSliderDataCount,
                maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
                step: 2,
                isAutoLoading: false,
            });
            this.$refs.slotProps.handleIncreaseList(event, newRange);
        },

        $_handleStart: function (evt) {
            // "Debug [storeBasketSliderMixin::touchstart] Prevent default";
            evt.preventDefault();
        },

        $_handleResize: function (event) {
            // debugger;
            this.$_updateSliderMode();
            this.$_resetCounts();
            const newFrom = this.getSliderControlFrom;
            const newTo = this.getSliderControlTo;
            const newCursor = this.getSliderControlCursor;

            if (this.$refs.slotProps) {
                this.$refs.slotProps.handleResizeList(event, {
                    from: newFrom,
                    to: newTo,
                    cursor: newCursor,
                });
            } else {
                console.log(
                    "Warrning [storeBasketSliderMixin:$_handleResize] Undefined slotProps"
                );
            }
        },
        /* END: dynamic list handlers */

        $_updateSliderMode: function () {
            "use strict";
            if (this.isPortraitOrientation() || this.isBrowserPortraitOrientation()) {
                this.$_initPortraitTableSliderMode();
                document.addEventListener("touchmove", this.$_handleMove);
                document.removeEventListener("touchmove", this.$_handleLandscapeTouchStart);
                document.removeEventListener("touchmove", this.$_handleLandscapeMove);
            } else if (this.isLandscapeOrientation() || this.isBrowserLandscapeOrientation()) {
                this.$_initLandscapeTableSliderMode();

                document.addEventListener(
                    "touchstart",
                    this.$_handleLandscapeTouchStart,
                    {
                        passive: false,
                    },
                    false
                );
                document.addEventListener(
                    "touchmove",
                    this.$_handleLandscapeMove,
                    {
                        passive: false,
                    },
                    false
                );
                document.removeEventListener("touchmove", this.$_handleMove);
            } else {
                this.$_initTableSliderMode();
            }

        },

        /*
         * Cart list handlers: no need to load from Database
         *
        */
        $_handleDecreaseCartList: function (event) {
            // debugger;
            "use strict";
            // console.log("Debug [CartComp::$_handleDecreaseCartList] event: " + event);

            const newRange = SliderHelper.calcSliderClickUp({
                from: this.from,
                to: this.to,
                cursor: this.cursor,
                maxItemQuantityPerPage: this.getSliderMaxItemQuantityPerPage,
                step: this.getSliderMaxItemQuantityPerPage,
            });

            this.$_applyNewRangeToSlider(newRange);
        },

        $_handleIncreaseCartList: function (event) {
            // debugger;
            // console.log("Debug [CartComp::$_handleIncreaseCartList] event: " + event);

            const newRange = SliderHelper.calcSliderClickDown({
                from: this.from,
                to: this.to,
                cursor: this.cursor,
                itemCount: this.getSliderDataCount,
                step: this.getSliderMaxItemQuantityPerPage,
            });

            this.$_applyNewRangeToSlider(newRange);
        },
        /* END: cart list handlers */

        $_initTableSliderMode: function () {
            "use strict";
            // debugger;

            this.$store.commit("initSlider", {
                mode: "table",
                itemWidthPercent: 0.5,
                itemHeightPercent: 0.5,
            });
        },

        $_resetCounts: function () {
            // debugger;
            "use strict";

            let maxIndex = this.getSliderMaxItemQuantityPerPage - 1;
            if (maxIndex >= this.getSliderDataCount) {
                maxIndex = this.getSliderDataCount - 1;
            }
            this.$store.commit("setSliderControlFrom", 0);
            this.$store.commit("setSliderControlCursor", 0);
            this.$store.commit(
                "setSliderControlTo",
                maxIndex
            );
        },

        $_initLandscapeTableSliderMode: function () {
            "use strict";
            // debugger;
            this.$store.commit("initSlider", {
                mode: "hor",
                itemWidthPercent: 0.5,
                itemHeightPercent: 1,
            });
        },

        $_initPortraitTableSliderMode: function () {
            "use strict";
            this.$store.commit("initSlider", {
                mode: "table",
                itemWidthPercent: 1,
                itemHeightPercent: 0,
            });
        },

        $_applyNewRangeToSlider: function (newRange) {
            "use strict";
            // debugger;
            const deltaCursorFrom = this.cursor - this.from;

            this.$store.commit(
                "setSliderControlCursor",
                newRange["from"] + deltaCursorFrom
            );
            this.$store.commit("setSliderControlFrom", newRange["from"]);
            this.$store.commit("setSliderControlTo", newRange["to"]);
        },
    },

    computed: {
        ...mapState({
            sliderData: (state) => {
                return state.slider.data;
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

        ...mapGetters([
            "getSliderControlCursor",
            "getSliderControlFrom",
            "getSliderControlPrevFrom",
            "getSliderControlTo",
            "getSliderControlPrevTo",
            "getSliderItemDataByKey",
            "getSliderItemIdByKey",
            "getBasketItemById",
            "getSliderMaxItemQuantityPerPage",
            "getSliderItemQuantityPerPage",
            "getSliderDataCount",
            "getSliderPrevItemData",
            "getSliderNextItemData",
            "summaryPriceInBasket",
            "getAttributeFilter",
        ]),
    },
}