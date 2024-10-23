
import { refreshFullPageContainers, calcNormalizedDimensions } from "./resizer";

export class Helper {

    /*
    * Picture constants
    */
    /* 4/3 */
    static XL_WIDTH() { return 1440; };
    static XL_HEIGHT() { return 1024; }
    static LG_WIDTH_4_3() { return 1024; }
    static LG_HEIGHT_4_3() { return 768; }
    static MD_WIDTH_4_3() { return 768; }
    static MD_HEIGHT_4_3() { return 546; }
    static SM_WIDTH_4_3() { return 640; }
    static SM_HEIGHT_4_3() { return 455; }

    /* 16/9 */
    static FHD_WIDTH() { return 1920; }
    static FHD_HEIGHT() { return 1080; }
    static HDPLUS_WIDTH() { return 1600; }
    static HDPLUS_HEIGHT() { return 900; }
    static WXGA_WIDTH() { return 1366; }
    static WXGA_HEIGHT() { return 768; }
    static HD_WIDTH() { return 1280; }
    static HD_HEIGHT() { return 720; }
    static LG_WIDTH_16_9() { return 1024; }
    static LG_HEIGHT_16_9() { return 576; }
    static MD_WIDTH_16_9() { return 768; }
    static MD_HEIGHT_16_9() { return 432; }
    static SM_WIDTH_16_9() { return 640; }
    static SM_HEIGHT_16_9() { return 360; }

    static GET_DUMMY_STR_VALUE() {
        return 'DUMMY';
    }

    static createDummyArray(len) {
        if (len > 0) {
            const dummyArr = new Array(len);
            dummyArr.fill(this.GET_DUMMY_STR_VALUE(), 0, len);
            return dummyArr;
        } else {
            throw new Error("Error [helper.js::createDummyArray] Invalid Length");
        }
    }

    static isSparseArray(arr) {
        if (arr && arr instanceof Array) {
            let isSparse = false;
            for (let i = 0; i < arr.length && !isSparse; i++) {
                isSparse = arr[i] === this.GET_DUMMY_STR_VALUE();
            }
            return isSparse;
        } else {
            throw new Error("Error [helper.js::isSparseArray] Invalid input sparse array");
        }
    }

    static isSparseRange(arr, range) {
        const [startIndex, endIndex] = range;
        const maxIndex = arr.length - 1;
        if (startIndex > maxIndex || endIndex > maxIndex || startIndex < 0 || startIndex > endIndex) {
            throw new Error("Error [helper.js::isSparseRange] Invalid [ endIndex , startIndex] indexes");
        }
        if (arr && arr instanceof Array) {
            let isSparse = false;
            for (let i = startIndex; i <= maxIndex && i <= endIndex && !isSparse; i++) {
                isSparse = arr[i] === this.GET_DUMMY_STR_VALUE();
            }
            return isSparse;
        } else {
            throw new Error("Error [helper.js::isSparseRange] Invalid input sparse array");
        }
    }

    static calcNotDummyLength(arr) {
        if (arr && arr instanceof Array) {
            if (this.isSparseArray(arr)) {
                let count = 0;
                for (let i = 0; i < arr.length; i++) {
                    if (arr[i] !== this.GET_DUMMY_STR_VALUE()) {
                        ++count;
                    }
                }
                return count;
            } else {
                console.info("INFO [helper.js::calcNotDummyLength] Input array is not sparse")
                return arr.length;
            }
        } else {
            throw new Error("Error [helper.js::calcNotDummyLength] Invalid input sparse array");
        }
    }

    static calcRightIndexOfSparseArray(sparseArr) {
        if (sparseArr && sparseArr instanceof Array) {
            let isDummy = false;
            let i = sparseArr.length - 1;
            for (; i >= 0; i--) {
                isDummy = sparseArr[i] === this.GET_DUMMY_STR_VALUE();
                if (!isDummy) {
                    break;
                }
            }
            return i;
        } else {
            throw new Error("Error [helper.js::calcRightIndexOfSparseArray] Invalid input sparse array");
        }
    }

    static calcLeftIndexOfSparseArray(sparseArr) {
        if (sparseArr && sparseArr instanceof Array) {
            let isDummy = false;
            let i = 0;
            for (; i < sparseArr.length; i++) {
                isDummy = sparseArr[i] === this.GET_DUMMY_STR_VALUE();
                if (!isDummy) {
                    break;
                }
            }
            return i;
        } else {
            throw new Error("Error [helper.js::calcLeftIndexOfSparseArray] Invalid input sparse array");
        }
    }

    static getNewsImageWidth() {
        return 320;
    }

    static $_onImageLoadCallback() {
        // console.info("Debug [Helper:onImageLoaded] Image is LOADED");
    }

    static $_onErrorImageLoadCallback() {
        console.warn("Warn [Helper:onImageLoaded] Image loading failed " + this.src);
    }

    static GET_STEILGUT_VAR_STORE() {
        if (!window.STEILGUT_VAR_STORE) {
            window.STEILGUT_VAR_STORE = {
                STEILGUT_IMAGES: {
                    PRECAUTION_IMG: {},
                    MASTHEAD_BANNERS: {},
                    WINES: {
                        LEFT_WINE_IMG: {},
                        RIGHT_WINE_IMG: {},
                    },
                    SINGLE_WINE: {
                        SUDWAND_SINGLE_WINE_IMG: {},
                        SUDWAND_SINGLE_WINE_BOTTLE_IMG: {},
                        FRAUENBERG_SINGLE_WINE_IMG: {},
                        FRAUENBERG_SINGLE_WINE_BOTTLE_IMG: {},
                    },

                    LOGO_IMG: {},
                    MOBILE_MENU: {},
                    MENU_IMG: {},
                },

                INITIAL_STATE: {
                    WINES_PAGE: {},
                },

                DEVICE_STATE: {
                    ORIENTATION_STATUS: "UNKNOWN",
                    IS_ORIENTATION_CHANGE_STARTED: false,
                    BODY_SCROLL_LOCK: null,
                    PLATFORM_TOOL: null,
                    ANDROID_FULLSCREEN_TOOL: null,
                    ORIGINAL_POTION: -1, // used to detect software keyboard
                },

                IS_LOADED: false,
            };
        }
        return window.STEILGUT_VAR_STORE;
    }

    static getWindowSize() {
        let w = Math.max(window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth);

        let h = Math.max(window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight);

        if (Helper.isMobileAndroidDevice() && Helper.isPortraitOrientation()) {
            w = window.screen ? window.screen.availWidth : w;
            h = window.screen ? window.screen.availHeight : h;
        }

        return {
            wWidth: w,
            wHeight: h,
        };
    }

    static getAndroidMaximumWindowVisibleHeight() {
        if (typeof screen === undefined || typeof screen.availHeight === undefined) {
            return -1;
        }
        let res = window.outerHeight;
        if (window.outerHeight > window.innerHeight) {
            res = window.screen.availHeight - (window.outerHeight - window.innerHeight);
            if (res > window.innerHeight) {
                res = window.innerHeight;
            }
        }
        return res;
    }

    static getAndroidMaximumWindowVisibleWidth() {
        if (typeof screen === undefined || typeof screen.availWidth === undefined) {
            return -1;
        }
        let res = window.innerWidth;
        if (this.isMobileAndroidDevice() && this.isLandscapeOrientation()) {
            return res;
        }
        if (window.outerWidth > window.innerWidth) {
            res = window.screen.availWidth - (window.outerWidth - window.innerWidth);
            if (res > window.innerWidth) {
                res = window.innerWidth;
            }
        } else {
            res = window.outerWidth;
        }
        return res;
    }

    static getDesktopMaximumWindowVisibleHeight({ isFullscreen = false } = {}) {
        if (typeof screen === undefined || typeof screen.availHeight === undefined) {
            return -1;
        }
        if (isFullscreen) {
            return window.screen.availHeight;
        }
        return window.screen.availHeight - (window.outerHeight - window.innerHeight);
    }

    static getDesktopMaximumWindowVisibleWidth({ isFullscreen = false } = {}) {
        if (typeof screen === undefined || typeof screen.availWidth === undefined) {
            return -1;
        }
        if (isFullscreen) {
            return window.screen.availWidth;
        }
        return window.screen.availWidth - (window.outerWidth - window.innerWidth);
    }

    static $__getFullWindowHeight() {
        let h = -Infinity;
        function searchHighestDocumentElement(nodesList) {
            for (let i = nodesList.length - 1; i >= 0; i--) {
                if (nodesList[i].scrollHeight && nodesList[i].clientHeight) {
                    const elHeight = Math.max(nodesList[i].scrollHeight, nodesList[i].clientHeight);
                    h = Math.max(elHeight, h);
                }

                if (nodesList[i].childNodes.length) {
                    searchHighestDocumentElement(nodesList[i].childNodes);
                }
            }
        }
        searchHighestDocumentElement(document.documentElement.childNodes);

        return h;
    }

    static isOverflow() {
        function searchOverflowDocumentElement(nodesList) {
            for (let i = nodesList.length - 1; i >= 0; i--) {
                if (nodesList[i].scrollHeight && nodesList[i].clientHeight) {
                    if (nodesList[i].scrollHeight > nodesList[i].clientHeight) {
                        return true;
                    }
                }

                if (nodesList[i].childNodes.length) {
                    return searchOverflowDocumentElement(nodesList[i].childNodes);
                }
            }
            return false;
        }
        return searchOverflowDocumentElement(document.documentElement.childNodes);
    }


    static setBodyBackgroundColor(bgColor) {
        const body = document.querySelector('body');
        body.setAttribute('style', 'background-color: ' + bgColor);
    }

    static isDisableScroll(htmlElement) {
        const currBodyStyleClassList = htmlElement.getAttribute('class');
        if (currBodyStyleClassList) {
            const styleClassChecker = new RegExp(`.*disable-scroll.*`);
            return styleClassChecker.test(currBodyStyleClassList);
        }
        return false;
    }


    static addStyleClassToBody(styleClassName) {
        const body = document.querySelector('body');
        let newBodyStyleClassList;
        const currBodyStyleClassList = body.getAttribute('class');

        if (currBodyStyleClassList) {
            const styleClassChecker = new RegExp(`.*${styleClassName}.*`);

            if (!styleClassChecker.test(currBodyStyleClassList)) {
                newBodyStyleClassList = `${currBodyStyleClassList} ${styleClassName}`;
                body.setAttribute('class', newBodyStyleClassList);
            }
        } else {
            newBodyStyleClassList = styleClassName;
            body.setAttribute('class', newBodyStyleClassList);
        }
    }

    static removeStyleClassFromBody(styleClassName) {
        const body = document.querySelector('body');
        const currBodyStyleClassList = body.getAttribute('class');
        if (currBodyStyleClassList) {
            const wipedBodyStyleClassList = currBodyStyleClassList.replace(styleClassName, '').trim();
            body.setAttribute('class', wipedBodyStyleClassList);
        }
    }

    static removeStyleClass(styleClassName, elementSelector) {
        const htmlElementList = document.querySelectorAll(elementSelector);
        if (!htmlElementList || htmlElementList.length === 0) {
            console.warn("Warn [helper::removeStyleClass] Couldn't find the element by the selector " + elementSelector);
        } else {
            for (let i = 0; i < htmlElementList.length; i++) {
                const htmlItem = htmlElementList[i];
                if (htmlItem.hasAttribute("class")) {
                    const styleClassStr = htmlItem.getAttribute('class');
                    if (styleClassStr) {
                        const wipedStyleClassStr = styleClassStr.replace(styleClassName, '').trim();
                        htmlItem.setAttribute('class', wipedStyleClassStr);
                    }
                }
            }
        }
    }

    static addStyleClass(styleClassName, elementSelector) {
        const htmlElementList = document.querySelectorAll(elementSelector);
        if (!htmlElementList || htmlElementList.length === 0) {
            console.warn("Warn [helper::removeStyleClass] Couldn't find the element by the selector " + elementSelector);
        } else {
            for (let i = 0; i < htmlElementList.length; i++) {
                const htmlItem = htmlElementList[i];
                if (htmlItem.hasAttribute('class')) {
                    const styleClassStr = htmlItem.getAttribute('class');
                    const styleClassRegExp = new RegExp(".*" + styleClassName + ".*");
                    if (styleClassStr && !styleClassRegExp.test(styleClassStr)) {
                        const resultStyleClassStr = styleClassStr + " " + styleClassName;
                        htmlItem.setAttribute('class', resultStyleClassStr);
                    }
                } else {
                    htmlElement.setAttribute('class', styleClassName);
                }
            }
        }
    }

    static flushStyleAttribute(elementSelector) {
        const htmlElementList = document.querySelectorAll(elementSelector);
        if (!htmlElementList || htmlElementList.length === 0) {
            console.warn("Warn [helper::removeStyleClass] Couldn't find the element by the selector " + elementSelector);
        } else {
            for (let i = 0; i < htmlElementList.length; i++) {
                const htmlItem = htmlElementList[i];
                htmlItem.removeAttribute('style');
            }
        }

    }

    static isChrome() {
        return !!window.chrome;
    }

    static repaintBody() {
        const body = document.querySelector('body');
        const currDisplay = body.style.display;
        body.style.display = 'none';
        body.offsetHeight;
        body.style.display = currDisplay;
    }

    static repaintDocument() {
        const domDocumentStyles = document.documentElement.style;
        const currDisplay = domDocumentStyles.display;
        domDocumentStyles.display = 'none';
        document.documentElement.offsetHeight;
        domDocumentStyles.display = currDisplay;
    }

    static switchBodyLock(isLock, contentElementSelector, domClassList) {
        if (!contentElementSelector) {
            console.warn("helper.js [switchBodyLock] A content element selector is absent");
        }
        const DEVICE_STATUS = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE'];
        if (!DEVICE_STATUS) {
            console.warn("helper.js [switchBodyLock]: couldn't find DEVICE_STATE store");
        } else {
            if (!DEVICE_STATUS['PLATFORM_TOOL'] || !DEVICE_STATUS['BODY_SCROLL_LOCK']) {
                if (!DEVICE_STATUS['PLATFORM_TOOL']) {
                    console.warn("helper.js [switchBodyLock]: couldn't find PLATFORM_TOOL var");
                }
                if (!DEVICE_STATUS['BODY_SCROLL_LOCK']) {
                    console.warn("helper.js [switchBodyLock]: couldn't find BODY_SCROLL_LOCK var");
                }
            } else {
                const platform = DEVICE_STATUS['PLATFORM_TOOL'];
                const bodyScrollLock = DEVICE_STATUS['BODY_SCROLL_LOCK'];
                const iOSSafariVersion = (platform && platform.os) ? platform.os.version : null;
                if (!iOSSafariVersion) {
                    console.warn("helper.js [switchBodyLock] Couldn't determine a platform browser version for iOS");
                } else {
                    const iOSSafari12v = /^12.*$/g;
                    const iOSSafari13v = /^13.*$/g;

                    if (iOSSafariVersion.match(iOSSafari12v) || iOSSafariVersion.match(iOSSafari13v)) {
                        if (!contentElementSelector) {
                            console.warn("helper.js [switchBodyLock] A content element selector is absent");
                        } else {
                            const contentDOMElement = document.querySelector(contentElementSelector);
                            if (!contentDOMElement) {
                                console.warn("helper.js [switchBodyLock] A content element is absent in DOM");
                            } else {
                                if (isLock) {
                                    const disableBodyFn = bodyScrollLock.disableBodyScroll;
                                    disableBodyFn(contentDOMElement);
                                } else {
                                    const enableBodyFn = bodyScrollLock.enableBodyScroll;
                                    enableBodyFn(contentDOMElement);
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    static clearAllBodyScrollLocks() {
        const DEVICE_STATUS = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE'];
        if (!DEVICE_STATUS) {
            console.warn("helper.js [switchBodyLock]: couldn't find DEVICE_STATE store");
        } else {
            if (!DEVICE_STATUS['PLATFORM_TOOL'] || !DEVICE_STATUS['BODY_SCROLL_LOCK']) {
                if (!DEVICE_STATUS['PLATFORM_TOOL']) {
                    console.warn("helper.js [switchBodyLock]: couldn't find PLATFORM_TOOL var");
                }
                if (!DEVICE_STATUS['BODY_SCROLL_LOCK']) {
                    console.warn("helper.js [switchBodyLock]: couldn't find BODY_SCROLL_LOCK var");
                }
            } else {
                const bodyScrollLock = DEVICE_STATUS['BODY_SCROLL_LOCK'];
                bodyScrollLock.clearAllBodyScrollLocks();
            }
        }
    }

    static isMobileDevice() {
        return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
    }

    static isMobileRelatedLayout() {
        return Helper.isMobileDevice() || Helper.isBrowserLandscapeOrientation() || Helper.isBrowserPortraitOrientation();
    }

    static isMobileSafariDevice() {
        const userAgent = window.navigator.userAgent;
        return (/iPhone|iPad|iPod/i.test(userAgent));
    }

    static isMobileAndroidDevice() {
        return (/Android/i.test(navigator.userAgent));
    }

    static isOrientationChanged() {
        if (Helper.isMobileDevice()) {
            let currDevOrientation = "UNKNOWN";
            if (Helper.isPortraitOrientation()) {
                currDevOrientation = "PORTRAIT_DEV_ORIENTATION";
            } else if (Helper.isLandscapeOrientation()) {
                currDevOrientation = "LANDSCAPE_DEV_ORIENTATION";
            }
            const isOrientationChanged = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['IS_ORIENTATION_CHANGE_STARTED'];
            Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['ORIENTATION_STATUS'] = currDevOrientation;
            return isOrientationChanged;
        }
        return false;
    }

    static isPortraitOrientation() {
        const w = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;

        const h = Math.max(window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight);

        return Helper.isMobileDevice() && (window.matchMedia('only screen and (min-width: 320px) and (orientation: portrait)').matches || w < h);
    }

    static isLandscapeOrientation() {
        if (Helper.isMobileSafariDevice()) {
            return window.matchMedia('only screen and (min-width: 320px) and (orientation: landscape)').matches;
        } else if (Helper.isMobileAndroidDevice()) {
            if (screen && screen.orientation && screen.orientation.type) {
                const landscapeRegex = /.*landscape.*/;
                return landscapeRegex.test(screen.orientation.type);
            } else {
                return false;
            }
        } else return false;
    }

    static isBrowserLandscapeOrientation() {
        const wSize = Helper.getWindowSize();
        const width = wSize['wWidth'];
        const height = wSize['wHeight'];

        return !Helper.isMobileDevice() && width > height && width <= 1024;
    }

    static calcDisplayOrientationState() {
        if (this.isMobileDevice()) {
            if (this.isLandscapeOrientation()) {
                return 'mobile-landscape';
            } else if (this.isPortraitOrientation()) {
                return 'mobile-portrait';
            } else {
                console.warn("Warn [Helper::calcDisplayOrientationState] Unknown mobile state");
                return 'mobile';
            }
        } else if (this.isBrowserPortraitOrientation()) {
            return 'desktop-portrait';

        } else if (this.isBrowserLandscapeOrientation()) {
            return 'desktop-landscape'
        } else {
            return 'desktop';
        }
    }

    static isBrowserPortraitOrientation() {
        const wSize = Helper.getWindowSize();
        const width = wSize['wWidth'];
        const height = wSize['wHeight'];

        return !Helper.isMobileDevice() && width < height;
    }

    static zoomOutMobileDevice() {
        const meta = document.querySelector('meta[name="viewport"]');
        const zoomOutContent = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no';
        meta.setAttribute('content', zoomOutContent);
    }

    static zoomInMobileDevice() {
        const meta = document.querySelector('meta[name="viewport"]');
        const zoomInContent = 'width=device-width, initial-scale=1.0, maximum-scale=10.0';
        meta.setAttribute('content', zoomInContent);
    }

    static normalizeViewPortMetadata() {

        const viewport = document.querySelector('meta[name="viewport"]');
        const normalizedContent = 'initial-scale=1, width=device-width';

        if (viewport) {
            window.scrollTo(0, 1);
            viewport.content = normalizedContent;
        }
    }

    static adoptAndroidKeyboardInput() {
        setTimeout(function () {
            let viewheight = Helper.getAndroidMaximumWindowVisibleHeight();
            let viewwidth = Helper.getAndroidMaximumWindowVisibleWidth();
            let viewport = document.querySelector("meta[name=viewport]");
            viewport.setAttribute("content", "height=" + viewheight + ", width=" + viewwidth + ", initial-scale=1.0, maximum-scale=1.0, user-scalable=0");
        }, 100);
    }

    static getMobileDeviceWidth() {
        let screenWidth;
        if (Helper.isPortraitOrientation()) {
            screenWidth = (window.screen.availWidth || window.screen.width);
        } else {
            screenWidth = (window.screen.availHeight || window.screen.height);
        }
        return screenWidth;
    }

    static isAtThePageBottom() {
        const mt = $('#masthead');
        const fullHeight = this.$__getFullWindowHeight();
        const h = Math.max(window.innerHeight,
            document.documentElement.clientHeight,
            document.body.clientHeight, fullHeight);

        return h - mt.scrollTop() <= Math.round(window.innerHeight * 2);
    }

    static getAspectRatio() {
        const width = this.getWindowSize().wWidth;
        const height = this.getWindowSize().wHeight;
        return Helper.getAspectRatioByDimension(width, height);
    }

    static getAspectRatioByDimension(width, height) {
        const fRatio = width / height;

        const diff4_3 = Math.abs(fRatio - 4 / 3);
        const diff16_10 = Math.abs(fRatio - 16 / 10);
        const diff16_9 = Math.abs(fRatio - 16 / 9);

        if (diff4_3 < diff16_10) {
            return '4/3';
        } else if (diff16_10 < diff4_3 && diff16_10 < diff16_9) {
            return '16/10';
        }
        return '16/9';
    }

    /*
    * Map from/to JSON conversion
    */
    static createMapFromJSON(jsonStr) {
        const jsonObj = JSON.parse(jsonStr);
        return this.createMapFromObject(jsonObj);
    }

    static createMapFromObject(obj) {
        const newMap = new Map();
        for (let key in obj) {
            newMap.set(key, obj[key]);
        }
        return newMap;
    }

    static createJsonFromMap(mapObj) {
        const newJsonObj = {};
        mapObj.forEach((val, key) => {
            newJsonObj[key] = val;
        });

        return JSON.stringify(newJsonObj);
    }

    /*
     * @link: https://perishablepress.com/3-ways-preload-images-css-javascript-ajax/
    */
    static addWindowEvent(eventName, func) {
        var oldEventHandler = window[eventName];
        if (typeof window[eventName] != 'function') {
            window[eventName] = func;
        } else {
            window[eventName] = function () {
                if (oldEventHandler) {
                    oldEventHandler();
                }
                func();
            }
        }
    }

    static addDocumentEvent(eventName, func) {
        var oldEventHandler = document[eventName];
        if (typeof document[eventName] != 'function') {
            document[eventName] = func;
        } else {
            document[eventName] = function () {
                if (oldEventHandler) {
                    oldEventHandler();
                }
                func();
            }
        }
    }

    static addReadyStateChangeEvent(func) {
        this.addDocumentEvent("onreadystatechange", func);
    }

    static addLoadEvent(func) {
        this.addWindowEvent("onload", func);
    }

    static addUnloadEvent(func) {
        this.addWindowEvent("onunload", func);
    }

    static addDOMContentLoadedEvent(func) {
        this.addDocumentEvent("DOMContentLoaded", func);
    }

    static getLoadImage(imgPath) {
        const resImg = new Image();

        resImg.onload = this.$_onImageLoadCallback;
        resImg.onerror = this.$_onErrorImageLoadCallback;
        resImg.src = imgPath;

        return resImg;
    }

    static $_calcImgPath(bgImgBasename, imgExt, prefixPath, ar = '16_9', resTitle = 'fhd', resolution = '1920*1080') {
        const devicePixelRatio = (window.devicePixelRatio || '1');
        let imgSrc = `${prefixPath}/${resTitle}_${resolution}/${imgExt}/${ar}-${resTitle}-${bgImgBasename}.${imgExt}`;

        switch (devicePixelRatio) {
            case 1:
                imgSrc = `${prefixPath}/${resTitle}_${resolution}/${imgExt}/${ar}-${resTitle}-${bgImgBasename}.${imgExt}`;
                break;

            case 2:
                imgSrc = `${prefixPath}/${resTitle}_${resolution}/${imgExt}/${ar}-${resTitle}-2x-${bgImgBasename}.${imgExt}`;
                break;

            case 3:
            case 4:
                imgSrc = `${prefixPath}/${resTitle}_${resolution}/${imgExt}/${ar}-${resTitle}-2x-${bgImgBasename}.${imgExt}`;
                break;

            default:
                console.info("Info [helper::$_calcImgPath] Couldn't determine device pixel ratio");
                break;
        }

        return imgSrc;
    }

    static getPortraitBackgroundMobileImage(bgImgRelativePath, bgImgBasename, imgExt = 'jpg', onLoadCallback = Helper.$_onImageLoadCallback, onErrorLoadCallback = Helper.$_onErrorImageLoadCallback) {
        if ((onLoadCallback && onErrorLoadCallback) && !(onLoadCallback instanceof Function || onErrorLoadCallback instanceof Function)) {
            throw new Error("Error [helper::getResponsiveWidescreenBackgroundImage] Wrong callback load function");
        }
        if (!Helper.isMobileDevice()) {
            throw new Error("Error [helper::getMaxResolutionBackgroundMobileImages] The device is not mobile");
        }
        const devicePixelRatio = (window.devicePixelRatio || 1);
        const portraitImgObj = new Image();
        const portraitPrefixPath = `/images/mobile/${bgImgRelativePath}/portrait`;
        let portraitImgSrc = `${portraitPrefixPath}/${imgExt}/portrait-2x-${bgImgBasename}.${imgExt}`;
        switch (devicePixelRatio) {
            case 1:
                portraitImgSrc = `${portraitPrefixPath}/${imgExt}/portrait-${bgImgBasename}.${imgExt}`;
                break;

            case 2:
                portraitImgSrc = `${portraitPrefixPath}/${imgExt}/portrait-2x-${bgImgBasename}.${imgExt}`;
                break;
            case 3:
            case 4:
                portraitImgObj.src = `${portraitPrefixPath}/${imgExt}/portrait-2x-bg-${bgImgBasename}.${imgExt}`;
                break;

            default:
                console.warn("Warn [helper::getMaxResolutionBackgroundMobileImages] Couldn't determine device pixel ratio");
                break;
        }

        portraitImgObj.onload = onLoadCallback;
        portraitImgObj.onerror = onErrorLoadCallback;
        portraitImgObj.src = portraitImgSrc;

        return portraitImgObj;
    }

    static getResponsiveWidescreenBackgroundImage(bgImgRelativePath, bgImgBasename, { imgExt = 'jpg', setScreenWidth = null }, onLoadCallback = Helper.$_onImageLoadCallback, onErrorLoadCallback = Helper.$_onErrorImageLoadCallback) {

        if ((onLoadCallback && onErrorLoadCallback) && !(onLoadCallback instanceof Function || onErrorLoadCallback instanceof Function)) {
            throw new Error("Error [helper::getResponsiveWidescreenBackgroundImage] Wrong callback load function");
        }

        const aspectRatio = this.getAspectRatio();
        let screenWidth = (setScreenWidth || window.screen.availWidth || window.screen.width);
        if (!Helper.isMobileDevice() && !setScreenWidth) {
            const windowDimension = calcNormalizedDimensions();
            if (windowDimension['nWidth'] !== 'nd') {
                screenWidth = windowDimension['nWidth'];
            }
        }
        // debugger;
        let imgObj = new Image();
        // Default value
        let imgSrc = `/images/16_9/${bgImgRelativePath}/FullHD_1920*1080/${imgExt}/16_9-fhd-${bgImgBasename}.${imgExt}`;

        if ('4/3' === aspectRatio) {
            const prefixPath = `/images/4_3/${bgImgRelativePath}`;
            // xl
            if (screenWidth >= Helper.XL_WIDTH()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '4_3', 'xl', '1440*1024');
                // lg    
            } else if (screenWidth >= Helper.LG_WIDTH_4_3()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '4_3', 'lg', '1024*768');
                // md
            } else if (screenWidth >= Helper.MD_WIDTH_4_3()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '4_3', 'md', '768*546');
                // sm
            } else {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '4_3', 'sm', '640*455');
            }
        } else {
            // For 16/9 and 16/10 use the same images
            const prefixPath = `/images/16_9/${bgImgRelativePath}`;
            // fhd
            if (screenWidth >= Helper.FHD_WIDTH()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '16_9', 'fhd', '1920*1080');
                // hd+    
            } else if (screenWidth >= Helper.HDPLUS_WIDTH()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '16_9', 'hdplus', '1600*900');
                // wxga
            } else if (screenWidth >= Helper.WXGA_WIDTH()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '16_9', 'wxga', '1366*768');
                // hd
            } else if (screenWidth >= Helper.HD_WIDTH()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '16_9', 'hd', '1280*720');
                // lg
            } else if (screenWidth >= Helper.LG_WIDTH_16_9()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '16_9', 'lg', '1024*576');
                // md
            } else if (screenWidth >= Helper.MD_WIDTH_16_9()) {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '16_9', 'md', '768*432');
                // sm
            } else {
                imgSrc = Helper.$_calcImgPath(bgImgBasename, imgExt, prefixPath, '16_9', 'sm', '640*360');
            }
        }

        imgObj.onload = onLoadCallback;
        imgObj.onerror = onErrorLoadCallback;
        imgObj.src = imgSrc;

        return imgObj;
    }

    static getLocaleStr() {
        'use strict';
        let currLang = document
            .getElementsByTagName("html")[0]
            .getAttribute("lang");

        if (!currLang) {
            currLang = "ru";
        }
        return currLang.toLowerCase();
    }

    static isDELocale() {
        return this.getLocaleStr() === 'de';
    }

    static isCNLocale() {
        return this.getLocaleStr() === 'zh_cn';
    }

    static isAsyncFunc(func) {
        const AsyncFunction = (async () => { }).constructor;
        const GeneratorFunction = (function () { }).constructor;

        return (func instanceof AsyncFunction && AsyncFunction !== Function && AsyncFunction !== GeneratorFunction);
    }

    static onImageBeginLoad(img, imgSrc) {
        return new Promise(function (onLoadedFn, onFailedLoadFn) {
            img.addEventListener("load", (event) => {
                onLoadedFn(event);
            });
            img.addEventListener("error", (event) => {
                onFailedLoadFn(event);
            });
            if (imgSrc) {
                img.src = imgSrc;
            }
        });
    }

    static onImageLoadHandler(img, imgSrc, vm, onSuccessfullLoadedFn, onFailedLoadFn) {
        Helper.onImageBeginLoad(img, imgSrc).then((resolveEvt) => {
            this.onRenderImgHandler(img, vm, onSuccessfullLoadedFn, resolveEvt);
        }).catch((rejectEvt) => {
            onFailedLoadFn.apply(vm, [rejectEvt]);
        });

    }

    static onRenderImgHandler(img, vm, onRenderFn, resolveEvt) {
        function rendered() {
            onRenderFn.apply(vm, [resolveEvt]);
        }
        function startRender() {
            requestAnimationFrame(rendered);
        }

        requestAnimationFrame(startRender);
    }

    static isAndroidFullscreenMode() {
        if (Helper.isMobileAndroidDevice()) {
            const fullscreenTool = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['ANDROID_FULLSCREEN_TOOL'];
            return fullscreenTool && fullscreenTool.isEnabled && fullscreenTool.isFullscreen;
        }
        return false;
    }

    /*
     * Android API: Enable/Disable Full screen on scroll up/down 
     * It uses the package: https://github.com/sindresorhus/screenfull.js
     */
    static onAndroidFullscreenListenerInit(ctrlBtnSelector = '.android-fullscreen-ctrl-btn') {
        if (Helper.isMobileAndroidDevice()) {
            const fullscreenTool = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['ANDROID_FULLSCREEN_TOOL'];
            if (fullscreenTool && fullscreenTool.isEnabled) {
                const androidFullscreenCtrlBtnList = document.querySelectorAll(ctrlBtnSelector);
                if (androidFullscreenCtrlBtnList && androidFullscreenCtrlBtnList.length > 0) {
                    androidFullscreenCtrlBtnList.forEach((fsCtrlBtn) => {
                        fsCtrlBtn.addEventListener('click', (event) => {
                            Helper.onAndroidFullscreenListenerProcess();
                        }, false);
                    });
                }
            }
        }
    }

    static onAndroidFullscreenListenerProcess() {
        if (Helper.isMobileAndroidDevice()) {
            const fullscreenTool = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['ANDROID_FULLSCREEN_TOOL'];
            if (fullscreenTool && fullscreenTool.isEnabled) {
                let actionSrc = null;
                if (!fullscreenTool.isFullscreen) {
                    actionSrc = {
                        'actionName': 'androidEnterFullscreen',
                    };
                    fullscreenTool.request().catch((error) => {
                        console.warn("Warn [events.js] Can't enter fullscreen")
                    });
                } else {
                    const bodyHtmlElement = document.querySelector('body');
                    bodyHtmlElement.style.minHeight = "calc(var(--100vh,1vh)*100)";
                    actionSrc = {
                        'actionName': 'androidExitFullscreen',
                    }

                    fullscreenTool.exit();
                }

                const fullscreenResizeHandler = _.debounce(() => {
                    refreshFullPageContainers(actionSrc);
                }, 100, {
                    leading: true,
                    trailing: true
                });

                fullscreenResizeHandler();
            }
        }
    }

    /*
     * The Functions (isHiddenHTMLElementBySelector/isHiddenHTMLElement) 
     * below are used to filter responsive images in depending on the device type (mobile | desktop).
     * The filters are applied into the CachedBackgroundImage Vue component to preload only necessary images. 
     */
    static isHiddenHTMLElementBySelector(elemSel) {
        const htmlElemArray = document.querySelectorAll(elemSel);

        if (htmlElemArray.length !== 1) {
            const msg = (htmlElemArray.length > 1) ? 'too much elements were found' : 'no element was found';
            console.warn("Warn [helper.js::isDisplayHiddenHTMLElemnetBySelector] Passed element selector is invalid: " + msg);

            return false;
        } {
            return this.isHiddenHTMLElement(htmlElemArray[0]);
        }
    }

    static isImgListEqualLevelGroup(imgList) {
        const desktopClassLayoutRegExp = /tw-hidden md:tw-block landscape:tw-hidden/g;
        const portraitClassLayoutRegExp = /tw-block landscape:tw-hidden/g;
        const landscapeClassLayoutRegExp = /tw-hidden landscape:tw-block/g;
        const isPortraitOrientation = this.isPortraitOrientation() || this.isBrowserPortraitOrientation();
        const isLandscapeOrientation = this.isLandscapeOrientation() || this.isBrowserLandscapeOrientation();

        function calcImgLevel(htmlElem) {
            const htmlElemClassName = htmlElem.className;
            if (htmlElemClassName) {
                if (Helper.isMobileRelatedLayout()) {
                    if (isPortraitOrientation && portraitClassLayoutRegExp.test(htmlElemClassName)) {
                        return "portrait";
                    }
                    if (isLandscapeOrientation && landscapeClassLayoutRegExp.test(htmlElemClassName)) {
                        return "landscape";
                    }
                } else {
                    if (desktopClassLayoutRegExp.test(htmlElemClassName)) {
                        return "desktop";
                    }
                }
            }
            if (!htmlElem.parentElement) {
                return "unknown";
            }
            return calcImgLevel(htmlElem);
        }
        let currImgLevel = calcImgLevel(imgList[0]);
        let isEqual = true;
        for (let i = 1; i < imgList.length && isEqual; i++) {
            isEqual = currImgLevel === calcImgLevel(imgList[i]);
        }

        return isEqual;
    }

    static isMobileLevelHTMLElement(htmlElem) {
        if (!htmlElem) {
            throw new Error("Helper [isMobileLevelHTMLElement] Passed object is invalid " + htmlElem);
        }
        const mobileClassLayoutRegExp = /md:tw-hidden/g;
        function checkElemLevel(htmlElem) {
            const htmlElemClassName = htmlElem.className;
            if (htmlElemClassName) {
                if (mobileClassLayoutRegExp.test(htmlElemClassName)) {
                    return true;
                }
            }

            if (!htmlElem.parentElement) {
                return false;
            }

            return checkElemLevel(htmlElem.parentElement);
        }

        return checkElemLevel(htmlElem);
    }

    static isHiddenHTMLElement(htmlElem) {
        if (!htmlElem) {
            throw new Error("Helper [isHiddenHTMLElement] Passed object is invalid " + htmlElem);
        }
        return !(htmlElem.offsetWidth || htmlElem.offsetHeight || htmlElem.getClientRects().length);
    }

    static isHiddenHTMLElementByTraversalMethod(htmlElem) {
        if (!htmlElem) {
            throw new Error("Helper [isHiddenHTMLElement] Passed object is invalid " + htmlElem);
        }
        const checkIfHiddenFn = Helper.isHTMLElementHiddenWithUseOfComputedMethod;
        /* Check parents and ancestors */
        function isHiddenHTMLElementInnerFn(htmlElem) {
            if (checkIfHiddenFn(htmlElem)) {
                return true;
            }

            if (!htmlElem.parentElement) {
                return false;
            }

            return isHiddenHTMLElementInnerFn(htmlElem.parentElement);
        }

        return isHiddenHTMLElementInnerFn(htmlElem);
    }

    static isHTMLElementHiddenWithUseOfComputedMethod(htmlElem) {
        const cssObject = window.getComputedStyle(htmlElem);
        if (cssObject) {
            return cssObject.getPropertyValue('display') === 'none';
        } else {
            throw new Error("Helper [isHTMLElementHidden] Couldn't find css attributes of the object " + htmlElem);
        }
    }

    static isHTMLElementHidden(htmlElem) {
        return !(htmlElem.offsetWidth || htmlElem.offsetHeight || htmlElem.getClientRects().length);
    }

    static isElementInViewport(elem) {

        // Special bonus for those using jQuery
        if (typeof jQuery === "function" && elem instanceof jQuery) {
            elem = elem[0];
        }
    
        var rect = elem.getBoundingClientRect();
    
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
            rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
        );
    }

    static getOrientationChangeEventName() {
        const supportsOrientationChange = "onorientationchange" in window;
        let orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";
        orientationEvent = window.screen && window.screen.orientation ? 'change' : 'resize';

        return orientationEvent;
    }

    static isIOS() {
        const DEVICE_STATUS = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE'];
        if (!DEVICE_STATUS) {
            console.warn("helper.js [isIOS]: couldn't find DEVICE_STATUS var");
        } else if (!DEVICE_STATUS['PLATFORM_TOOL'] || !DEVICE_STATUS['BODY_SCROLL_LOCK'] ||
            !DEVICE_STATUS['ORIGINAL_POTION']) {
            if (!DEVICE_STATUS['PLATFORM_TOOL']) {
                console.warn("helper.js [isIOS]: couldn't find PLATFORM_TOOL var");
            }
            if (!DEVICE_STATUS['BODY_SCROLL_LOCK']) {
                console.warn("helper.js [isIOS]: couldn't find BODY_SCROLL_LOCK var");
            }
            if (!DEVICE_STATUS['ORIGINAL_POTION']) {
                console.warn("helper.js [isIOS]: couldn't find ORIGINAL_POTION var");
            }
        } else {
            const isIOS = new RegExp('^(.*iOS.*)$', 'gi');
            const osStr = DEVICE_STATUS['PLATFORM_TOOL']['os'].family;
            return isIOS.test(osStr);
        }
    }

    /* 
      * Detect if software keyboard was openned and apply passed function on the event 
      *
      * Only for Android, for iOS - use blur, focus and etc
      * @link: https://stackoverflow.com/questions/47798279/jquery-mobile-how-to-detect-if-mobile-virtual-keyboard-is-opened
      */
    static androidSoftwareKeyboardInputEventHandler(onResizeFn) {
        if (!onResizeFn) {
            console.warn("helper.js [androidSoftwareKeyboardInputEventHandler]: no onResizeFn was passed");
        } else {
            const DEVICE_STATUS = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE'];
            if (!DEVICE_STATUS) {
                console.warn("helper.js [androidSoftwareKeyboardInputEventHandler]: couldn't find DEVICE_STATE store");
            } else {
                if (!DEVICE_STATUS['ORIGINAL_POTION']) {
                    if (!DEVICE_STATUS['ORIGINAL_POTION']) {
                        console.warn("helper.js [androidSoftwareKeyboardInputEventHandler]: couldn't find ORIGINAL_POTION var");
                    }
                } else {
                    const originalPotion = DEVICE_STATUS['ORIGINAL_POTION'];
                    if (!Helper.isIOS() && originalPotion !== -1) {
                        const wasWithKeyboard = $('body').hasClass('view-withKeyboard');
                        let nowWithKeyboard = false;
                        const diff = Math.abs(originalPotion - ($(window).width() + $(window).height()));
                        if (diff > 100) nowWithKeyboard = true;

                        $('body').toggleClass('view-withKeyboard', nowWithKeyboard);
                        if (wasWithKeyboard != nowWithKeyboard) {
                            onResizeFn(nowWithKeyboard);
                        }
                    }
                }
            }
        }
    }

    static loadResource(src, resolve, reject) {
        return new Promises(function () {
            const scriptElement = document.createElement('script');
            scriptElement.src = src;

            script.onload = () => resolve(scriptElement);
            script.onerror = () => reject(new Error(`Couldn't load the ${src} script`));

        });
    }

    static dropLoadCurtain({ isMobile = true } = {}) {
        if ($('#app').css('opacity') == 1) {
            $('#app').fadeOut(500, 'swing', function () {
                if (isMobile) {
                    $('.app__loading__spinner').show();
                } else {
                    $('.app__loading__display').show();
                }
                $('.app__loading').fadeIn(1000, 'swing');
            });
        }
    }

    static raiseLoadCurtain({ isMobile = true } = {}) {
        if ($('#app').css('display') == "none") {
            $('.app__loading').fadeOut(500, 'swing', function () {
                if (isMobile) {
                    $('.app__loading__spinner').hide();
                } else {
                    $('.app__loading__display').hide();
                }
                $('#app').fadeTo(1000, 1.0, 'swing');
            });
        }
    }

    static getDecimal10(decimel) {
        return Math.round((decimel + Number.EPSILON) * 10 ) / 10
    }

    static getDecimal100(decimel) {
        return Math.round((decimel + Number.EPSILON) * 100 ) / 100
    }

    static getDecimal1000(decimel) {
        return Math.round((decimel + Number.EPSILON) * 1000 ) / 1000
    }

    static getCommaSeparatorDecimal(decimal) {
        return decimal.toString().replace(".", ",");
    }

};
