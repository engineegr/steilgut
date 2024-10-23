export default {

    methods: {
        isChrome: function () {
            return this.$root.$data.helper.isChrome();
        },

        isMobileDevice: function () {
            return this.$root.$data.helper.isMobileDevice();
        },

        isMobileRelatedLayout: function () {
            return this.$root.$data.helper.isMobileRelatedLayout();
        },

        flushStyleAttribute: function (elementSelector) {
            return this.$root.$data.helper.flushStyleAttribute(elementSelector);
        },

        isMobileSafariDevice: function () {
            return this.$root.$data.helper.isMobileSafariDevice();
        },

        isMobileAndroidDevice: function () {
            return this.$root.$data.helper.isMobileAndroidDevice();
        },

        isAndroidFullscreenMode: function () {
            return this.$root.$data.helper.isAndroidFullscreenMode();
        },

        isPortraitOrientation: function () {
            return this.$root.$data.helper.isPortraitOrientation();
        },

        isLandscapeOrientation: function () {
            return this.$root.$data.helper.isLandscapeOrientation();
        },

        isBrowserLandscapeOrientation: function () {
            return this.$root.$data.helper.isBrowserLandscapeOrientation();
        },

        isBrowserPortraitOrientation: function () {
            return this.$root.$data.helper.isBrowserPortraitOrientation();
        },

        calcDisplayOrientationState: function () {
            return this.$root.$data.helper.calcDisplayOrientationState();
        },

        zoomOutMobileDevice: function () {
            return this.$root.$data.helper.zoomOutMobileDevice();
        },

        zoomInMobileDevice: function () {
            return this.$root.$data.helper.zoomInMobileDevice();
        },

        is4_3AspectRatio: function () {
            // debugger;
            const helper = this.$root.$data.helper;
            const is4_3 = '4/3' === helper.getAspectRatio();
            // console.log("Debug [mediaHelper::is4_3AspectRatio] is 4/3 ratio: " + is4_3);
            return is4_3;
        },

        is16_9AspectRatio: function (pagePath) {
            // debugger;
            const helper = this.$root.$data.helper;
            const is16_9 = '16/9' === helper.getAspectRatio();
            // console.log("Debug [mediaHelper::is16_9AspectRatio] is 16/9 ratio: " + is16_9);
            return is16_9;
        },

        is16_10AspectRatio: function (pagePath) {
            // debugger;
            const helper = this.$root.$data.helper;
            const is16_10 = '16/10' === helper.getAspectRatio();
            // console.log("Debug [mediaHelper::is16_10AspectRatio] is 16/10 ratio: " + is16_10);
            return is16_10;
        },

        isImageLoadedByStyleClass: function (imageClass) {
            const imageList = document.querySelectorAll('.' + imageClass);

            if (imageList.length != 1) {
                throw new Error(
                    "mediaHelper.js [isImageLoaded] Wrong number of passed images (not equal 1)"
                );
            }

            return this.isImageLoaded(imageList[0]);
        },

        isImageLoaded: function (image) {
            return image && image.complete;
        },

        calcAspectRatio: function () {
            return this.$root.$data.helper.getAspectRatio();
        },

        calcHtmlElementDimension: function (htmlElementStyleClass) {
            const htmlElement = document.querySelector(
                "." + htmlElementStyleClass
            );

            if (!htmlElement) {
                throw new Error("Error [mediaHelper:calcHtmlElementDimension] can't determine the element");
            }
            return {
                width: htmlElement.width,
                height: htmlElement.height
            };
        },

        isDELocale: function () {
            return this.$root.$data.helper.isDELocale();
        },

        isCNLocale: function () {
            return this.$root.$data.helper.isCNLocale();
        },

        switchBodyLock: function (isLock, contentElementSelector) {
            return this.$root.$data.helper.switchBodyLock(isLock, contentElementSelector);
        },

        clearAllBodyScrollLocks: function () {
            return this.$root.$data.helper.clearAllBodyScrollLocks();
        },

        socialNetLinks: function () {
            return {
                'instagram': 'https://www.instagram.com/steilgut_weine/',
                'facebook': 'https://www.facebook.com/steilgut/',
                'youtube': 'https://www.youtube.com/channel/UChZUnKq5qmc8kLxsGiKSqfg',
                'vk': 'https://vk.com/public206539712',
            }
        },

        /*
        * The Functions (isHiddenHTMLElementBySelector/isHiddenHTMLElement) 
        * below are used to filter responsive images in depending on the device type (mobile | desktop).
        * The filters are applied into the CachedBackgroundImage Vue component to preload only necessary images. 
        */
        isHiddenHTMLElement: function (htmlElem) {
            return this.$root.$data.helper.isHiddenHTMLElement(htmlElem);
        },

        isHiddenHTMLElementBySelector: function (elemSel) {
            return this.$root.$data.helper.isHiddenHTMLElementBySelector(elemSel);
        },

        isMobileLevelHTMLElement: function (htmlElem) {
            return this.$root.$data.helper.isMobileLevelHTMLElement(htmlElem);
        },

        isImgListEqualLevelGroup: function (imgList) {
            return this.$root.$data.helper.isImgListEqualLevelGroup(imgList);
        },
        /* End of responsive image functions*/

        getOrientationChangeEventName: function () {
            return this.$root.$data.helper.getOrientationChangeEventName();
        },

        isOrientationChanged: function () {
            return this.$root.$data.helper.isOrientationChanged();
        }
    }
};