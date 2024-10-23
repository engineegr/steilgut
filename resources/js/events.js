
import $ from 'jquery';
import { Helper } from "./shared/utils/helper";
import { refreshFullPageContainers } from "./shared/utils/resizer";
import { AssetPreloader } from "./shared/utils/assetPreloader";

if (!window._) {
    window._ = require('lodash');
}

(function () {
    "use strict";
    try {
        if (!window.$ && !window.jQuery) {
            window.$ = window.jQuery = $;
        }
    } catch (e) { }

    const refreshFullPageContainerHandler = _.debounce((paramActionSrc) => {
        "use strict";
        if (Helper.isOrientationChanged()) {
            return;
        }
        console.info("events.js [refreshFullPageContainerHandler] RESIZE Event");
        let actionSrc = Helper.isMobileAndroidDevice() && Helper.isOrientationChanged() ? { actionName: 'orientationChange' } : {
            actionName: 'unknown'
        };
        if (paramActionSrc) {
            actionSrc = paramActionSrc;
        }

        if (actionSrc['actionName'] === 'orientationChange') {
            const fullscreenTool = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['ANDROID_FULLSCREEN_TOOL'];
            if (fullscreenTool && fullscreenTool.isEnabled) {
                fullscreenTool.exit();
            }
        }
        refreshFullPageContainers(actionSrc);
    }, 30, {
        leading: true,
        trailing: false,
    });

    /*
     * Resize events: added on window.load event
    */
    function runInitializer() {
        "use strict";
        if (Helper.isMobileDevice()) {
            Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['ORIENTATION_STATUS'] = 'UNKNOWN';

            if (window.screen && window.screen.orientation) {
                window.screen.orientation.addEventListener("change", orientationChangeHandler, false);
            } else {
                const supportsOrientationChange = "onorientationchange" in window;
                let orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";
                window.addEventListener(orientationEvent, orientationChangeHandler, false);
            }

            const DEVICE_STATUS = Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE'];
            if (!DEVICE_STATUS) {
                throw new Error("events.js [runInitializer]: couldn't find DEVICE_STATUS var");
            } else if (!DEVICE_STATUS['ORIGINAL_POTION']) {
                if (!DEVICE_STATUS['ORIGINAL_POTION']) {
                    throw new Error("events.js [runInitializer]: couldn't find ORIGION_POTION var");
                }
            } else {
                DEVICE_STATUS['ORIGINAL_POTION'] = $(window).width() + $(window).height();
                if (Helper.isMobileAndroidDevice()) {
                    const tmp = require('screenfull');
                    if (!tmp) {
                        throw new Error("events.js [runInitializer]: couldn't import screenfull");
                    }
                    DEVICE_STATUS['ANDROID_FULLSCREEN_TOOL'] = tmp;

                    Helper.onAndroidFullscreenListenerInit();
                    Helper.adoptAndroidKeyboardInput();
                }
            }
            window.addEventListener("resize", refreshFullPageContainerHandler, false);
        } else {
            document.addEventListener("fullscreenchange", 
                () => {
                    console.log("Fullscreenchange");
                    refreshFullPageContainerHandler();
                }, 
                false);
            window.addEventListener("resize", 
                () => {
                    console.log("resize");
                    refreshFullPageContainerHandler();   
                },
                false);
        }

        refreshFullPageContainers({
            actionName: 'init',
        });
    }

    function orientationChangeHandler() {
        "use strict";
        Helper.GET_STEILGUT_VAR_STORE()['DEVICE_STATE']['IS_ORIENTATION_CHANGE_STARTED'] = true;
        refreshFullPageContainers({ actionName: 'orientationChange' })
    }

    window.onerror = function (message, url, line, col, errorObj) {
        console.log(`Error [window::onerror] ${message}\n${url}, ${line}:${col}`);
    };

    document.addEventListener("readystatechange", function () {
    });

    /*
     * Preload assets
     */
    Helper.addReadyStateChangeEvent(AssetPreloader['preloadPrecautionPageBackgroundImages']);
    Helper.addReadyStateChangeEvent(AssetPreloader['preloadLogoImage']);
    Helper.addReadyStateChangeEvent(AssetPreloader['preloadMobileMenu']);
    Helper.addLoadEvent(runInitializer);
    Helper.addLoadEvent(AssetPreloader['preloadMastheadPageBackgroundBanners']);
    Helper.addLoadEvent(AssetPreloader['preloadLeftWineBackgroundImages']);
    Helper.addLoadEvent(AssetPreloader['preloadRightWineBackgroundImages']);
    Helper.addLoadEvent(AssetPreloader['preloadSudwandSingleWineBackgroundImages']);
    Helper.addLoadEvent(AssetPreloader['preloadFrauenbergSingleWineBackgroundImages']);
    Helper.addLoadEvent(AssetPreloader['preloadWineBottleImages']);

    const cleanListenersHandler = function () {
        document.removeEventListener("readystatechange", runInitializer);
        document.removeEventListener("touchmove", touchMoveFullscreenHandler);

        if (Helper.isMobileDevice()) {
            if (window.screen && window.screen.orientation) {
                window.screen.orientation.removeEventListener("change", orientationChangeHandler);
            } else {
                const supportsOrientationChange = "onorientationchange" in window;
                let orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";
                window.removeEventListener(orientationEvent, orientationChangeHandler);
            }
        } else {
            window.removeEventListener("resize", refreshFullPageContainerHandler);
            document.removeEventListener("fullscreenchange", refreshFullPageContainerHandler);
        }

    }

    Helper.addUnloadEvent(cleanListenersHandler);

})();
