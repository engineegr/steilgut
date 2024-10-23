import { Helper } from "./shared/utils/helper";

export default {
    state: {
        slider: {
            count: 0,
            data: null,

            control: {
                // describe visible window
                cursor: 0,
                prevCursor: undefined,

                loadBudget: 2,

                from: 0,
                prevFrom: undefined,
                to: 0,
                prevTo: undefined,

                page: 1,
            },

            mode: 'vert', // vert, hor, table

            // constants
            itemHeightPercent: 0.2,
            itemWidthPercent: 0.5,
        },

        groupSet: {
            groups: new Map(),
        },

        attributeFilter: {
            filterMap: new Map(),
        },

        basket: {
            items: [],
        },
    },

    mutations: {

        /*
        * Slider
        */
        resetSlider(state) {
            state["slider"].count = 0;
            state["slider"].data = [];
            state["slider"].mode = 'vert';
            state["slider"]["control"].cursor = 0;
            state["slider"]["control"].from = 0;
            state["slider"]["control"].to = 0;
        },

        initSlider(state, payload) {
            // debugger;
            const modePattern = /^(hor|vert|table)$/;
            if (!modePattern.test(payload['mode'])) {
                throw new Error("Error [store.state::setMode] Wrong slider mode");
            }
            state.slider.mode = payload['mode'];
            if (/^hor$/.test(payload['mode'])) {
                state.slider.itemWidthPercent = payload['itemWidthPercent'];
            } else if (/^table$/.test(payload['mode'])) {
                state.slider.itemWidthPercent = payload['itemWidthPercent'];
                state.slider.itemHeightPercent = payload['itemHeightPercent'];
            } else {
                state.slider.itemHeightPercent = payload['itemHeightPercent'];
            }

            if (payload['loadBudget']) {
                state.slider.loadBudget = payload['loadBudget'];
            }
        },

        setSliderDataCount(state, payload) {
            state.slider.count = payload;
        },

        setExtContentToSliderData(state, payload) {
            const modifyItem = state.slider.data.filter(item => item.id === payload['id']);
            if (modifyItem.length > 1) {
                throw new Error("Error [store.state::setExtContentToSliderData] Data id duplicate error");
            }
            modifyItem[0]['content'] = payload['content'];
        },

        setSliderData(state, payload) {
            state.slider.data = payload;
        },

        setSliderControlCursor(state, payload) {
            state.slider.control.cursor = payload;
        },

        setSliderControlFrom(state, payload) {
            state.slider.control.from = payload;
        },

        setSliderControlPrevCursor(state, payload) {
            state.slider.control.prevCursor = payload;
        },

        setSliderControlPrevFrom(state, payload) {
            state.slider.control.prevFrom = payload;
        },

        setSliderControlTo(state, payload) {
            state.slider.control.to = payload;
        },

        setSliderControlPrevTo(state, payload) {
            state.slider.control.prevTo = payload;
        },

        setSliderControlPage(state, payload) {
            state.slider.control.page = payload;
        },
        /*
        * End of Slider
        */

        /*
        * Group Set
        */
        resetGroupSet(state) {
            state.groupSet.groups = new Map();
        },

        setGroupSet(state, payload) {
            state.groupSet.groups = payload['groups'];
        },

        addToOrReplaceGroupSet(state, payload) {
            const key = payload["key"].toString();
            const newSet = payload["newSet"];

            state.groupSet.groups.set(key, newSet);
        },

        /*
        * End of Groups
        */

        /*
        * Filter
        */

        resetAttributeFilter(state) {
            state.attributeFilter.filterMap = new Map();
        },

        setAttributeFilter(state, payload) {
            state.attributeFilter.filterMap = payload;
        },

        addToAttributeFilter(state, payload) {
            state.attributeFilter.filterMap.set(payload['attributeName'], payload['attributeValue']);
        },

        replaceAttributeFilterValue(state, payload) {
            // debugger;
            if (state.attributeFilter.filterMap.get(payload['attributeName'])) {
                state.attributeFilter.filterMap.delete(payload['attributeName']);
            }
            state.attributeFilter.filterMap.set(payload['attributeName'], payload['attributeValue']);
        },

        removeFromAttributeFilter(state, payload) {
            // debugger;
            state.attributeFilter.filterMap.delete(payload['attributeName']);
        },

        /*
        * End of Attribute Filter
        */

        /*
        * Basket
        */
        setLastSearch(state, payload) {
            state.lastSearch = payload;
        },

        addToBasket(state, payload) {
            // debugger;
            let isAdded = false;
            state.basket.items.forEach(element => {
                if (element.item['id'] === payload['id']) {
                    ++element.count;
                    isAdded = true;
                }
            });

            if (!isAdded) {
                state.basket.items.push({
                    item: payload,
                    count: 1,
                });
            }
        },

        removeFromBasket(state, payload) {
            let toFilter = false;
            state.basket.items = state.basket.items.map(element => {
                if (element.item.id === payload && element.count > 0) {
                    if (element.count > 0) {
                        --element.count;
                    }
                    if (element.count == 0) {
                        toFilter = true;
                    }
                }
                return element;
            });
            if (toFilter) {
                state.basket.items = state.basket.items.filter(element => element.item.id !== payload);
            }
        },

        setBasket(state, payload) {
            state.basket = payload;
        },
        /*
        * End of Basket
        */

    },

    actions: {
        loadStoredState({ commit, dispatch }) {
            const basket = localStorage.getItem('basket.steilgut');
            if (basket) {
                commit('setBasket', JSON.parse(basket));
            }

            const attributeFilterJsonObj = localStorage.getItem('attributeFilter.steilgut');
            if (attributeFilterJsonObj) {
                commit('setAttributeFilter', Helper.createMapFromJSON(attributeFilterJsonObj));
            }
        },

        updateCart({ dispatch }) {
            Helper.dropLoadCurtain({ isMobile: false });
            dispatch('syncCart').then((isSuccess) => {
                Helper.raiseLoadCurtain({ isMobile: false });
            });
        },

        async syncCart({ getters, dispatch }) {
            const updatingCart = getters.getBasketItemListClone;
            let isSuccess = true;
            if (updatingCart.length === 0) {
                return isSuccess;
            }
            const oldProductIds = [];
            updatingCart.forEach((product) => {
                oldProductIds.push(product.item["id"]);
            });
            try {
                const syncCart = (
                    await axios.get("/api/wineStoreProducts", {
                        params: {
                            cart: oldProductIds,
                            sync_cart: 1,
                        },
                    })
                ).data.data;
                syncCart.forEach((product) => {
                    updatingCart.forEach((basketItem) => {
                        const id = basketItem["item"].id;
                        if (
                            id === product["id"]
                        ) {
                            Object.assign(basketItem["item"], product);
                        }
                    })
                });
            } catch (reject) {
                console.warn(`store [loadStoredState] Couldn't sync cart: 
                ${reject.response.status}:${reject.message}`);
                isSuccess = false;
            } finally {
                console.info("store [loadStoredState] Cart is synched OK");
                if (isSuccess) {
                    dispatch("initBasket", {
                        items: updatingCart,
                    });
                }
                return isSuccess;
            }
        },

        /*
        * Filter
        */
        addToAttributeFilter({ commit, state }, payload) {
            commit('addToAttributeFilter', payload);
            localStorage.setItem('attributeFilter.steilgut', Helper.createJsonFromMap(state.attributeFilter["filterMap"]));
        },

        removeFromAttributeFilter({ commit, state }, payload) {
            commit('removeFromAttributeFilter', payload);
            localStorage.setItem('attributeFilter.steilgut', Helper.createJsonFromMap(state.attributeFilter["filterMap"]));
        },

        replaceAttributeFilterValue({ commit, state }, payload) {
            // debugger;
            commit('replaceAttributeFilterValue', payload);
            localStorage.setItem('attributeFilter.steilgut', Helper.createJsonFromMap(state.attributeFilter["filterMap"]));
        },

        /*
        * Basket
        */
        initBasket({ commit, state }, payload) {
            commit("setBasket", payload);
            localStorage.setItem('basket.steilgut', JSON.stringify(state.basket));
        },

        addToBasket({ commit, state }, payload) {
            commit('addToBasket', payload);
            localStorage.setItem('basket.steilgut', JSON.stringify(state.basket));
        },

        removeFromBasket({ commit, state }, payload) {
            commit('removeFromBasket', payload);
            localStorage.setItem('basket.steilgut', JSON.stringify(state.basket));
        },

        clearBasket({ commit, state }, payload) {
            commit('setBasket', {
                items: []
            });
            localStorage.setItem('basket.steilgut', JSON.stringify(state.basket));
        }
        /*
        * End of Basket
        */
    },


    getters: {

        /*
        /* Slider
        */
        getSliderDataCount: state => {
            return state.slider.count;
        },

        getLoadedDataCount: state => {
            return state.slider.data.length;
        },

        getSliderData: state => {
            return state.slider.data;
        },

        getSliderNotDummyItemsLength: state => {
            return Helper.calcNotDummyLength(state.slider.data);
        },

        getSliderDataClone: state => {
            return state.slider.data.slice();
        },

        getSliderCursorData: state => {
            return state.slider.data[state.slider.control.cursor];
        },

        getExtContentFromSliderData: (state) => (payload) => {
            // debugger;
            const filteredItemList = state.slider.data.filter(item => item.id === payload['id']);
            if (filteredItemList.length > 1) {
                throw new Error("Error [store.state::getExtContentFromSliderData] Data id duplicate error");
            }
            return filteredItemList[0]['content'] ? filteredItemList[0]['content'] : undefined;
        },

        getSliderNextItemData: (state) => {
            return state.slider.data[state.slider.control.cursor + 1];
        },

        getSliderPrevItemData: (state) => {
            return state.slider.data[state.slider.control.cursor - 1];
        },

        getSliderItemHeightPercent: state => {
            return state.slider.itemHeightPercent;
        },

        getSliderControloLoadStep: state => {
            return state.slider.control.loadBudget;
        },

        getSliderControlCursor: state => {
            return state.slider.control.cursor;
        },

        getSliderControlPrevCursor: state => {
            return state.slider.control.prevCursor;
        },

        getSliderControlFrom: state => {
            return state.slider.control.from;
        },

        getSliderControlPrevFrom: state => {
            return state.slider.control.prevFrom;
        },

        getSliderControlTo: state => {
            return state.slider.control.to;
        },

        getSliderControlPage: state => {
            return state.slider.control.page;
        },

        getSliderControlPrevTo: state => {
            return state.slider.control.prevTo;
        },

        getSliderItemQuantityPerPage: (state, getters) => {
            // debugger;
            const maxQuantityPerPage = getters.getSliderMaxItemQuantityPerPage;
            let deltaFromTo = state.slider.control.to ? state.slider.control.to - state.slider.control.from + 1 :
                maxQuantityPerPage;

            deltaFromTo = deltaFromTo < state.slider.count
                ? deltaFromTo
                : state.slider.count;

            // console.log("Debug [getSliderItemQuantityPerPage] " + deltaFromTo);
            return deltaFromTo;
        },

        getSliderMaxItemQuantityPerPage: (state, getters) => {
            // debugger;
            if (/^hor$/.test(state.slider.mode) || /^vert$/.test(state.slider.mode)) {
                let itemPercentSize = state.slider.itemHeightPercent;
                if (/^hor$/.test(state.slider.mode)) {
                    itemPercentSize = state.slider.itemWidthPercent;
                }
                if (itemPercentSize === 0) {
                    return slider.slider.count;
                }
                return Math.round(1 / itemPercentSize);
            } else if (/^table$/.test(state.slider.mode)) {
                const colItemPercentSize = state.slider.itemWidthPercent;
                const rowItemPercentSize = state.slider.itemHeightPercent;
                return Math.round(1 / colItemPercentSize) * Math.round(1 / rowItemPercentSize);
            }
        },

        getSliderItemDataByKey: (state) => (payload) => {
            // debugger;
            // console.log("Debug [slider::getSliderItemDataByKey] slider data len " + state.slider.data.length);
            const itemData = state.slider.data[state.slider.control.from + payload["i"] - 1];
            return itemData;
        },

        getSliderItemIdByKey: (state) => (payload) => {
            const itemData = state.slider.data[state.slider.control.from + payload["i"] - 1];
            return itemData["id"];
        },
        /*
        * END of Slider
        */

        /*
        * Group Set
        */
        getGroupByKey: (state) => (payload) => {
            const key = payload["key"].toString();
            return state.groupSet.groups.get(key);
        },

        getGroupLengthByKey: (state) => (payload) => {
            const key = payload["key"].toString();
            const keyGroup = state.groupSet.groups.get(key);
            if (keyGroup) {
                return keyGroup.length;
            }
            return -1;
        },

        getFirstItemFromGroupByKey: (state) => (payload) => {
            const key = payload["key"].toString();
            return state.groupSet.groups.get(key)[0];
        },

        getLastItemFromGroupByKey: (state) => (payload) => {
            const key = payload["key"].toString();
            const keyGroup = state.groupSet.groups.get(key);
            return keyGroup[keyGroup.length - 1];
        },

        hasKeyGroup: (state) => (payload) => {
            const key = payload['key'].toString();
            return state.groupSet.groups.has(key);
        },

        isUpdateKeyGroup: (state) => (payload) => {
            const key = payload['key'].toString();
            const inputGroup = payload['group'];
            const currGroup = state.groupSet.groups.get(key);
            return !Helper.isSparseArray(currGroup) && (!state.groupSet.groups.has(key) || currGroup.length !== inputGroup.length);
        },

        isFullyLoadedKeyGroup: (state) => (payload) => {
            const key = payload['key'].toString();
            const maxLength = payload['maxLength'];
            const currGroup = state.groupSet.groups.get(key);
            return !Helper.isSparseArray(currGroup) && currGroup.length === maxLength;
        },

        getGroupNotDummyLengthByKey: (state) => (payload) => {
            const key = payload['key'].toString();
            const group = state.groupSet.groups.get(key);
            return Helper.calcNotDummyLength(group);
        },
        /*
        * End of Group Set
        */

        /*
        * Attribute Filter 
        */
        getAttributeFilter: (state) => {
            return state.attributeFilter.filterMap;
        },

        getFilterAttributeValue: (state) => (payload) => {
            // debugger;
            return state.attributeFilter.filterMap.get(payload['attributeName']);
        },

        /*
        * END of Attribute filter
        */

        /*
        * Basket
        */
        getBasketItemListClone: (state) => {
            // const basketItemListClone = [... state.basket.items]; // ES6 way
            const basketItemListClone = state.basket.items.slice(); // Old way
            return basketItemListClone;
        },

        getBasketItemById: (state) => (payload) => {
            const basketList = state.basket.items;
            for (let i = 0; i < basketList.length; i++) {
                if (basketList[i].item.id === payload) {
                    return basketList[i];
                }
            }
            return null;
        },

        itemsInBasketCount: (state) => {
            return state.basket.items.length;
        },

        inBasketSummaryCount: (state, getters) => {
            let count = 0;
            state.basket.items.forEach(item => {
                count += item.count;
            });
            return count;
        },

        inBasketBottlesCount: (state) => {
            let count = 0;
            state.basket.items.forEach(item => {
                const data = item.item;
                if (!data.count) { // wine set
                    count += item.count;
                }
            });
            return count;
        },

        inBasketWineSetBottlesCount: (state) => {
            let count = 0;
            state.basket.items.forEach(item => {
                const data = item.item;
                if (data.count) { // Wine Set 
                    count += data.count;
                }
            });
            return count;
        },

        isMinimumCondition: (state, getters) => (payload) => {
            return (getters.inBasketBottlesCount + getters.inBasketWineSetBottlesCount) >= payload["min"];
        },

        specificItemsInBasket: (state) => (payload) => {
            // debugger;
            let count = 0;
            const basketList = state.basket.items;
            for (let i = 0; i < basketList.length; i++) {
                if (basketList[i].item.id === payload) {
                    count = basketList[i].count;
                    break;
                }
            }
            return count;
        },

        setSpecificItemCountInBasket: (state) => (payload) => {
            // debugger;
            let count = 0;
            const basketList = state.basket.items;
            for (let i = 0; i < basketList.length; i++) {
                if (basketList[i].item.id === payload[id]) {
                    basketList[i].count = payload[count];
                    break;
                }
            }
            return count;
        },

        summaryPriceInBasket: (state) => {
            let sum = 0;
            const basketList = state.basket.items;
            basketList.forEach((element) => {
                let price = (element.item.discount > 0) ?
                    element.item.price * (1 - element.item.discount) :
                    element.item.price;

                sum += element.item.totalInStock > 0 ? Helper.getDecimal1000(price * element.count) : 0;
            });
            return Helper.getDecimal100(sum);
        },

        ifCanMakeOrder: (state, getters) => {
            const basketList = state.basket.items;
            let isCanMakeOrder = false;
            basketList.forEach((element) => {
                if (element.item.totalInStock >= element.count) {
                    isCanMakeOrder = true;
                }
            });

            isCanMakeOrder = isCanMakeOrder && getters.isMinimumCondition({
                min: 3,
            });

            return isCanMakeOrder;
        },

        ifAnyProductAbsent: (state) => {
            let isAbsent = false;
            const sliderItem = state.slider.data;
            sliderItem.forEach((item) => {
                if (item.totalInStock <= 0) {
                    isAbsent = true;
                }
            });

            return isAbsent;
        }
    },

};