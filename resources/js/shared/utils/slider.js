import { Helper } from "./helper";

export class SliderHelper {
    // 
    // Slider Calculation interface
    // 
    static calcSliderSwipeUp(payload) {
        const from = payload["from"];
        const to = payload["to"];
        const cursor = payload["cursor"];


        // auto-loading mode: all items keep on the page
        // we only load new items, but don't hide old ones
        const isAutoLoading = payload['isAutoLoading'];

        const itemCount = payload["itemCount"];
        const maxIndex = itemCount - 1;
        const step = payload["step"];

        const newTo = to + step;
        const newRange =
            newTo > maxIndex
                ? {
                    to: maxIndex,
                    from: to + 1,
                    cursor: -1,
                    prevCursor: cursor,
                }
                : {
                    to: newTo,
                    from: to + 1,
                    cursor: -1,
                    prevCursor: cursor,
                };
        if (isAutoLoading) {
            newRange["from"] = 0;
        }

        newRange["cursor"] = newRange["from"];

        return newRange;
    }

    static calcSliderSwipeDown(payload) {
        const from = payload["from"];
        const to = payload["to"];
        const step = payload["step"];
        const cursor = payload["cursor"];
        // auto-loading mode: all items keep on the page
        // we only load new items, but don't hide old ones
        const isAutoLoading = payload['isAutoLoading'];

        const newFrom = from - step;
        const newRange =
            newFrom < 0
                ? { from: 0, to: step - 1, cursor: 0, prevCursor: cursor, }
                : { from: newFrom, to: newFrom + step - 1, cursor: newFrom, prevCursor: cursor, };

        if (isAutoLoading) {
            newRange["from"] = 0;
        }
        return newRange;
    }

    static calcSliderClickUp(payload) {
        const from = payload["from"];
        const to = payload["to"];
        const cursor = payload["cursor"];
        const step = payload["step"] ? payload["step"] : 1;
        const maxItemPerPage = payload["maxItemQuantityPerPage"];
        // auto-loading mode: all items keep on the page
        // we only load new items, but don't hide old ones
        const isAutoLoading = payload['isAutoLoading'];
        const itemCount = payload['itemCount'];

        let newCursor = cursor;
        let newFrom = from;
        let newTo = to;
        newCursor = newCursor - step < 0 ? 0 : newCursor -= step;
        let newRange = {
            from: newFrom,
            to: newTo,
            cursor: newCursor,
            prevCursor: cursor,
        };

        function calcNewFrom() {
            if (newFrom - maxItemPerPage < 0) {
                return 0;
            } else {
                const temp = newFrom - maxItemPerPage;
                if (temp > 0 && temp < maxItemPerPage - 1) {
                    return 0;
                } else {
                    const r = temp % maxItemPerPage;
                    if (r !== 0) {
                        return temp - r;
                    } else {
                        return temp;
                    }
                }
            }
        }
        newFrom = calcNewFrom();
        if (from > newCursor) {
            newRange = {
                from: newFrom,
                to:
                    newFrom == 0
                        ? (newTo = maxItemPerPage - 1)
                        : (newTo = (newFrom + maxItemPerPage) >= itemCount ?
                            itemCount - 1 : (newFrom + maxItemPerPage - 1)),
                cursor: newTo,
                prevCursor: cursor,
            };
        }

        if (isAutoLoading) {
            newRange["from"] = 0;
        }
        return newRange;
    }

    static calcSliderClickDown(payload) {
        let newFrom = payload["from"];
        let newTo = payload["to"];
        let newCursor = payload["cursor"];
        const cursor = payload["cursor"];
        const itemCount = payload["itemCount"];
        const maxItemPerPage = payload['maxItemQuantityPerPage'];
        const step = payload["step"] ? payload["step"] : 1;
        // auto-loading mode: all items keep on the page
        // we only load new items, but don't hide old ones
        const isAutoLoading = payload['isAutoLoading'];

        newCursor = newCursor + step >= itemCount ? itemCount - 1 : newCursor += step;
        if (newTo < newCursor) {
            newFrom = newTo + 1;

            if (maxItemPerPage === 1) {
                newTo = newFrom;
            } else {
                newTo =
                    newFrom + maxItemPerPage >= itemCount
                        ? itemCount - 1
                        : newFrom + maxItemPerPage - 1;
            }
        }
        const newRange = {
            from: newFrom,
            to: newTo,
            cursor: newCursor,
            prevCursor: cursor,
        }
        if (isAutoLoading) {
            newRange["from"] = 0;

        }
        return newRange;
    }

    static isLoading(payload) {
        const itemData = payload['itemData'];
        let maxIndex = itemData.length - 1;
        if (Helper.isSparseArray(itemData)) {
            maxIndex = Helper.calcLeftIndexOfSparseArray(itemData);
        }
        const to = payload['to'];

        if (to >= payload['maxLength']) {
            debugger;
            throw new Error("Error [slider.js::isLoading] Invalid [ to ] index");
        }
        return maxIndex < to;
    }

    static isLoadingRange(payload) {
        const itemData = payload['itemData'];
        const startIndex = payload['startIndex'];
        const endIndex = payload['endIndex'];
        let maxIndex = itemData.length - 1;
        if (startIndex > maxIndex || endIndex > maxIndex || startIndex < 0 || startIndex > endIndex) {
            throw new Error("Error [slider.js::isLoading] Invalid [ endIndex , startIndex] indexes");
        }

        return Helper.isSparseRange(itemData, [
            startIndex,
            endIndex
        ]);
    }

    static isReverseLoading(payload) {
        const itemData = payload['itemData'];
        const dataLen = itemData.length;
        const startIndex = payload['startIndex'];
        const endIndex = payload['endIndex'];
        if (Helper.isSparseArray(itemData) && endIndex < dataLen) {
            for (let i = startIndex; i <= endIndex; i++) {
                if (itemData[i] === Helper.GET_DUMMY_STR_VALUE()) {
                    return true;
                }
            }
            return false;
        }
        return to > dataLen - 1;
    }
}