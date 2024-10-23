import { Helper } from "./helper";

/**
* Set's the CSS properties for the passed item/s.
* @param {NodeList|HTMLElement} items
* @param {Object} props css properties and values.
*/
export function css(items, props) {
    "use strict";
    items = getList(items);

    var key;
    for (key in props) {
        if (props.hasOwnProperty(key)) {
            if (key !== null) {
                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    item.style[key] = props[key];
                }
            }
        }
    }
    return items;
}

/**
* Gets the window height. Crossbrowser.
* 
* inner{Height,Width} - visual side of viewbox plus {hor,ver} scrollbar
* client{Height,Width} - only visual side of viewbox
* offset{Height,Width} - inlcude padding, border and {hor, ver} scrollbar
*/
export function getWindowHeight() {
    "use strict";
    let visibleHeight;
    if ('innerHeight' in window) {
        visibleHeight = window.innerHeight;
    } else {
        visibleHeight = document.documentElement.offsetHeight;
    }
    return visibleHeight;
}

export function getWindowWidth() {
    "use strict";
    return window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;
}

/**
* Gets an iterable element for the passed element/s
*/
export function getList(item) {
    "use strict";
    return !isArrayOrList(item) ? [item] : item;
}

/**
* Checks if the passed element is an iterable element or not
*/
export function isArrayOrList(el) {
    "use strict";
    return Object.prototype.toString.call(el) === '[object Array]' ||
        Object.prototype.toString.call(el) === '[object NodeList]';
}

/**
 * Calculate display size units to eliminate influence of 
 * the Search bar and the bottom panel in mobile devices
 */
export function calcCustomDimensions(srcAction = { actionName: 'unknown', postFn: null }) {
    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = Helper.getWindowSize()['wHeight'] * 0.01;
    let vw = Helper.getWindowSize()['wWidth'] * 0.01;

    if (Helper.isMobileAndroidDevice()) {
        vw = Helper.getAndroidMaximumWindowVisibleWidth() * 0.01;
        vh = Helper.getAndroidMaximumWindowVisibleHeight() * 0.01;
    }

    let vmin = vh;
    if (vh > vw) {
        vmin = vw;
    }

    const isAndroidScreenModeChanged = (srcAction['actionName'] === 'androidEnterFullscreen' || srcAction['actionName'] === 'androidExitFullscreen');
    const isOrientationState = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['IS_ORIENTATION_CHANGE_STARTED'];
    const isRefresh = (Helper.isMobileAndroidDevice() && (isOrientationState || srcAction['actionName'] === 'init') || isAndroidScreenModeChanged) || Helper.isMobileSafariDevice();

    if (isRefresh) {
        // Then we set the value in the --100vh, --100vw custom property to the root of the document
        document.documentElement.style.setProperty('--100vh', `${vh}px`);
        document.documentElement.style.setProperty('--100vw', `${vw}px`);
        document.documentElement.style.setProperty('--100vmin', `${vmin}px`);
    }
}

export function calcAspectRatioDimensions() {
    "use strict";
    const normalizedDimensions = calcNormalizedDimensions();
    let nWidth = normalizedDimensions['nWidth'];
    let nHeight = normalizedDimensions['nHeight'];
    const isChange = nHeight === 'nd' || nWidth === 'nd' || normalizedDimensions['isDiff'];
    if (isChange) {
        if (nHeight === 'nd' || nWidth === 'nd') {
            nHeight = Helper.getDesktopMaximumWindowVisibleHeight({ isFullScreen: true });
            nWidth = Helper.getDesktopMaximumWindowVisibleWidth({ isFullScreen: true });
        }
        let nVmin = -1;
        if (nHeight < nWidth) {
            nVmin = nHeight / 100;
        } else {
            nVmin = nWidth / 100;
        }

        const nvw = nWidth / 100;
        const nvh = nHeight / 100;
        document.documentElement.style.setProperty('--100nh', `${nHeight}px`);
        document.documentElement.style.setProperty('--100nw', `${nWidth}px`);
        document.documentElement.style.setProperty('--100nvmin', `${nVmin}px`);
        document.documentElement.style.setProperty('--100nvw', `${nvw}px`);
        document.documentElement.style.setProperty('--100nvh', `${nvh}px`);
        document.documentElement.style.setProperty('nvh', `${nvh}px`);
    }
}

export function calcAspectRatioStyleClassList(arBalancedSelector = ASPECT_RATIO_BALANCED_SEL, widthCoeff = 1.0, heightCoeff = 1.0) {
    if (Helper.isMobileRelatedLayout()) {
        Helper.flushStyleAttribute(arBalancedSelector);
        return;
    }

    const normalizedDimensions = calcNormalizedDimensions();
    if (!normalizedDimensions['isDiff']) {
        return 'nd';
    }
    const arBalancedElementList = $(arBalancedSelector);

    let nWidth = normalizedDimensions['nWidth'], nHeight = normalizedDimensions['nHeight'];
    if (nHeight === 'nd' || nWidth === 'nd') {
        return 'nd';
    } else {
        nWidth = Math.round(nWidth * widthCoeff);
        nHeight = Math.round(nHeight * heightCoeff);
    }
    const resultImgStyleClass = `min-height: ${nHeight}px; max-height: ${nHeight}px; height: ${nHeight}px; max-width: ${nWidth}px; width: ${nWidth}px;`;
    if (!arBalancedElementList || arBalancedElementList.length === 0) {
        console.warn("Warn [resizer::calcAspectRatioStyleClassList] Can't retreive Aspect Ratio Balanced nodes");
    }
    return resultImgStyleClass;
}

export function calcNormalizedDimensions() {
    "use strict";
    const wWidth = Helper.getWindowSize().wWidth;
    const wHeight = Helper.getWindowSize().wHeight;
    const maxWinVisibleHeight = Helper.getDesktopMaximumWindowVisibleHeight();
    const maxWinVisibleWidth = Helper.getDesktopMaximumWindowVisibleWidth();

    let bSide = -1, sSide = -1;
    if (wWidth >= wHeight) {
        bSide = wWidth;
        sSide = wHeight;
    } else {
        bSide = wHeight;
        sSide = wWidth;
    }
    const fRatio = bSide / sSide;
    const diff4_3 = Math.abs(fRatio - 4 / 3);
    const diff16_10 = Math.abs(fRatio - 16 / 10);
    const diff16_9 = Math.abs(fRatio - 16 / 9);
    let diff = -1;
    let wK = 4;
    let hK = 3;

    const aspectRatio = Helper.getAspectRatio();
    if (aspectRatio == '4/3') {
        diff = diff4_3;
    } else if (aspectRatio == '16/9') {
        diff = diff16_9;
        wK = 16;
        hK = 9;
    } else {
        diff = diff16_10;
        wK = 16;
        hK = 10;
    }

    let nHeight = wHeight;
    let nWidth = wWidth;
    const isDiff = diff >= 0.0;

    if (isDiff) {
        if (wWidth >= wHeight) {
            nHeight = Math.round((wWidth * hK) / wK);

            if (maxWinVisibleHeight > 0 && wHeight != maxWinVisibleHeight && nHeight < wHeight) {
                nHeight = wHeight;
                nWidth = Math.round((nHeight * wK) / hK);
            }

            if (maxWinVisibleHeight > 0 && wHeight === maxWinVisibleHeight) {
                nHeight = wHeight;
                nWidth = Math.round((nHeight * wK) / hK);
            }

        } else {
            nWidth = Math.round((wHeight * wK) / hK);

            if (maxWinVisibleWidth > 0 && wWidth != maxWinVisibleWidth && nWidth < wWidth) {
                isRecalc = true;
                nWidth = wWidth;
                nHeight = Math.round((nWidth * hK) / wK);
            }

            if (maxWinVisibleWidth > 0 && wWidth === maxWinVisibleWidth) {
                nWidth = wWidth;
                nHeight = Math.round((nWidth * hK) / wK);
            }
        }
    }

    const isFullScreen = (maxWinVisibleHeight > 0 && wHeight === maxWinVisibleHeight && maxWinVisibleWidth > 0 && wWidth === maxWinVisibleWidth);

    if (isFullScreen || wHeight > maxWinVisibleHeight || wWidth > maxWinVisibleWidth) {
        nHeight = 'nd';
        nWidth = 'nd';
    }

    return {
        nHeight,
        nWidth,
        isDiff
    }

}

/*
 * srcAction: ['unknown', 'orientation_change'] 
*/
export function refreshFullPageContainers(srcAction = { actionName: 'unknown', postFn: null }) {
    let windowWidth = null;
    const FULL_PAGE_SEL = '.fp';
    let resizeTimerId = null;
    let END_COUNT = 0;
    const ITERATION_COUNT = 5;
    let isLoadCurtainOn = (srcAction['actionName'] !== 'init' && srcAction['actionName'] === 'orientationChange');

    if (isLoadCurtainOn) {
        Helper.dropLoadCurtain({
            isMobile: true,
        });
    }
    resizeProcess();

    /*
    * Resize event handler.
    */
    function resizeProcess() {
        "use strict";
        if (resizeTimerId) {
            clearTimeout(resizeTimerId);
        }

        //in order to call the functions only when the resize is finished
        //http://stackoverflow.com/questions/4298612/jquery-how-to-call-resize-event-only-once-its-finished-resizing    
        resizeTimerId = setTimeout(() => {

            //issue #3336 
            //(some apps or browsers, like Chrome/Firefox for Mobile take time to report the real height)
            //so we check it 3 times with intervals in that case
            for (let i = 0; i < ITERATION_COUNT; i++) {
                resizeTimerId = setTimeout(resizeActions, 200 * i);
            }
        }, 200);
    }

    /**
    * When resizing the site, we adjust the heights of the sections, slimScroll...
    */
    function resizeActions() {
        "use strict";
        calcCustomDimensions(srcAction);
        calcAspectRatioDimensions();
        reBuildHeight();
        reBuildWidth();

        ++END_COUNT;
        if (END_COUNT === ITERATION_COUNT) {
            if (Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['IS_ORIENTATION_CHANGE_STARTED'] || srcAction['actionName'] === 'init') {
                if (Helper.isMobileAndroidDevice()) {
                    Helper.adoptAndroidKeyboardInput();
                }

                Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['IS_ORIENTATION_CHANGE_STARTED'] = false;
                window.scrollTo({ top: 0, left: 1, behavior: "smooth" });
            }

            if (srcAction['postFn']) {
                srcAction['postFn']();
            }


            if (isLoadCurtainOn) {
                Helper.raiseLoadCurtain({
                    isMobile: true,
                });
            } else if (srcAction['actionName'] === 'init') {
                $('.app__loading__display').fadeOut(1500, 'swing');
                $('.app__loading__white_steilgut_pulse').fadeOut(1500, 'swing', function () {
                    $('.app__loading').hide();
                    $('#app').fadeTo(1000, 1.0, 'swing');
                });
            }
        }

    }

    function reBuildHeight() {
        "use strict";
        const fullPageList = $(FULL_PAGE_SEL);
        function processHtmlElementHeight(__section) {
            const windowHeight = getWindowHeight();
            css(__section, { 'height': windowHeight + 'px' });
        }

        for (let i = 0; i < fullPageList.length; i++) {
            // debugger;
            const section = fullPageList[i];
            // bug on Android: it doesn't update the vh unit
            if (!Helper.isMobileSafariDevice()) {
                section.style = [];
            }

            const isHtmlOrBodyElement = /body|html/i.test(section.localName);
            if (isHtmlOrBodyElement && Helper.isMobileSafariDevice()) {
                processHtmlElementHeight(section);
            } else if (!isHtmlOrBodyElement) {
                processHtmlElementHeight(section);
            }
        }

    }

    function reBuildWidth() {
        "use strict";
        windowWidth = getWindowWidth();
        const fullPageList = $(FULL_PAGE_SEL);
        for (let i = 0; i < fullPageList.length; i++) {
            const section = fullPageList[i];
            css(section, { 'width': windowWidth + 'px' });
            css(section, { 'max-width': windowWidth + 'px' });
        }

    }
}