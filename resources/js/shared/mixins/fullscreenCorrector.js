import { Helper } from "../utils/helper";

export default {
    mounted() {
        'use strict';
        if (Helper.isMobileDevice()) {
            this.orientationStateInit();
            /* from @link https://newbedev.com/detect-rotation-of-android-phone-in-the-browser-with-javascript : use resize for Android and orientationchange for Iphone*/
            const eventType = Helper.getOrientationChangeEventName()
            if (eventType === 'change') {
                window.screen.orientation.addEventListener(eventType, this.orientationStateHandler, false);
            } else {
                window.addEventListener(eventType, this.orientationStateHandler, false);
            }
            window.addEventListener("resize", this.resizeStateHandler, false);

            const bodyLockStatus = this.$_bodyLockStatus();
            const isAnyOrientationFullscreenOnly = bodyLockStatus['portrait'] || bodyLockStatus['landscape'];
            const iOSDev = Helper.isIOS();
            /* Process input action: jump to the top in the case of fullscreen page status (only for iOS, in the case of Android - monitor Resize event */
            if (iOSDev && isAnyOrientationFullscreenOnly) {
                $(document).on('blur focus', 'select, textarea, input[type=text], input[type=date], input[type=password], input[type=email], input[type=number]', this.inputStateHandler);
            }
        }
    },

    destroyed() {
        'use strict';
        if (Helper.isMobileDevice()) {
            this.switchBodyScroll(false);
            Helper.switchBodyLock(false, this.contentElementSelector);

            if (window.screen && window.screen.orientation) {
                window.screen.orientation.removeEventListener('change', this.orientationStateHandler);
            } else {
                window.removeEventListener('orientationchange', this.orientationStateHandler);
                window.removeEventListener('resize', this.orientationStateHandler);
                window.removeEventListener('resize', this.resizeStateHandler);
            }

            const iOSDev = Helper.isIOS();
            const bodyLockStatus = this.$_bodyLockStatus();
            const isAnyOrientationFullscreenOnly = bodyLockStatus['portrait'] || bodyLockStatus['landscape'];
            /* Process input action: jump to the top in the case of fullscreen page status (only for iOS, in the case of Android - monitor Resize event */
            if (iOSDev && isAnyOrientationFullscreenOnly) {
                $(document).off('blur focus', 'select, textarea, input[type=text], input[type=date], input[type=password], input[type=email], input[type=number]', this.inputStateHandler);
            }
        }
    },

    data: function () {
        return {
            /* fullscreenCorrector.js: Use to indetify the content element for switch body lock operations */
            contentElementSelector: ".masthead-content",
        }
    },

    methods: {
        orientationStateHandler: _.debounce(function () {
            'use strict';
            if (Helper.isOrientationChanged() && Helper.isMobileDevice()) {
                this.orientationStateInit();
            }
        }, 500, {
            leading: true,
            trailing: true,
        }),

        resizeStateHandler: _.debounce(function () {
            if (!Helper.isOrientationChanged()) {
                function jumpToTopFn(nowWithKeyboard) {
                    if (!nowWithKeyboard) {
                        window.scrollTo({ top: 0, left: 1, behavior: "smooth" });
                    }
                };
                if (this.$_jumpToTop() && !Helper.isIOS()) {
                    Helper.androidSoftwareKeyboardInputEventHandler(jumpToTopFn);
                }
            }
        }, 50, {
            leading: true, trailing: true
        }),

        inputStateHandler: _.debounce(function (e) {
            var nowWithKeyboard = (e.type == 'focusin');
            $('body').toggleClass('view-withKeyboard', nowWithKeyboard);
            const isJumpToTop = this.$_jumpToTop();
            if (!nowWithKeyboard & isJumpToTop) {
                window.scrollTo({ top: 0, left: 1, behavior: "smooth" });
            }
        }, 50, {
            leading: true, trailing: true
        }),


        orientationStateInit: function () {
            'use strict';
            const domClassList = this.$el && this.$el.classList ? this.$el.classList : null;
            const isBodyScroll = this.$_isBodyScroll();
            if (domClassList) {
                Helper.switchBodyLock(!isBodyScroll, this.contentElementSelector, domClassList);
                this.switchBodyScroll(isBodyScroll);
                if (!isBodyScroll) {
                    setTimeout(() => {
                        window.scrollTo({ top: 0, left: 1, behavior: "smooth" });
                    }, 500);
                }
            } else {
                consol.error("mixins:fullscreenCorrector [Error] Couldn't extract body style attribute");
            }
        },

        switchBodyScroll: function (isBodyScroll) {
            'use strict';
            const bodyHtmlElem = document.querySelector("body");
            let bodyCssStyles = bodyHtmlElem.style.cssText;
            const re = /(overflow: auto; -webkit-overflow-scrolling: touch;)|(overflow: auto;)|(-webkit-overflow-scrolling: touch;)/g;
            const ohRe = /overflow: hidden;/g;
            if (isBodyScroll) {
                bodyCssStyles.replace(ohRe, "");
                if (!bodyCssStyles.match(re)) {
                    bodyCssStyles += "overflow: auto; -webkit-overflow-scrolling: touch;";
                }
            } else {
                if (bodyCssStyles.match(re)) {
                    bodyCssStyles = bodyCssStyles.replace(re, "");
                }
            }
            bodyHtmlElem.style.minHeight = 'unset';
            bodyHtmlElem.setAttribute("style", bodyCssStyles);
        },

        $_bodyLockStatus: function () {
            'use strict';
            const domClassList = this.$el && this.$el.classList ? this.$el.classList : null;
            const bodyLockStatus = {
                portrait: true,
                landscape: true,
            };
            if (domClassList) {
                if (Helper.isPortraitOrientation()) {
                    const portraitNonFpClass = /portrait-non-fp/g;
                    domClassList.forEach((classItem) => {
                        if (classItem.match(portraitNonFpClass)) {
                            bodyLockStatus['portrait'] = false;
                        }
                    });
                } else if (Helper.isLandscapeOrientation()) {
                    const landscapeNonFpClass = /landscape-non-fp/g;
                    domClassList.forEach((classItem) => {
                        if (classItem.match(landscapeNonFpClass)) {
                            bodyLockStatus['landscape'] = false;
                        }
                    });
                }
            }
            return bodyLockStatus;
        },

        $_jumpToTop: function () {
            'use strict';
            const bodyLockStatus = this.$_bodyLockStatus();
            const isPortrait = Helper.isPortraitOrientation();
            const isLandscape = Helper.isLandscapeOrientation();
            return (isPortrait && bodyLockStatus['portrait']) || (isLandscape && bodyLockStatus['landscape']);
        },

        $_isBodyScroll: function () {
            'use strict';
            const bodyLockStatus = this.$_bodyLockStatus();
            const isPortrait = Helper.isPortraitOrientation();
            const isLandscape = Helper.isLandscapeOrientation();
            return (isPortrait && !bodyLockStatus['portrait']) || (isLandscape && !bodyLockStatus['landscape']);
        },

        $_isBodyLock: function () {
            'use strict';
            const bodyLockStatus = this.$_bodyLockStatus();
            const isPortrait = Helper.isPortraitOrientation();
            const isLandscape = Helper.isLandscapeOrientation();
            return ((isPortrait && bodyLockStatus['portrait']) || (isLandscape && bodyLockStatus['landscape'])) && !$('.navbar-container').hasClass('mobile-menu-openned');
        },

        $_onSoftwareKeyboardClosingHandler: function () {
            setTimeout(() => {
                window.scrollTo({ top: 0, left: 1, behavior: "smooth" });
            }, 500);
        },

    },
}