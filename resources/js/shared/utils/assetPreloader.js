import { Helper } from "./helper";

export class AssetPreloader {

    /*
   * Preload precaution start page image
   */
    static preloadPrecautionPageBackgroundImages() {
        "use strict";
        // console.log("Debug [assetPreloader::preloadPrecautionPageBackgroundImages] enter the function ");
        // console.log("Debug [assetPreloader::preloadPrecautionPageBackgroundImages] document state " + document.readyState);

        const images = {};
        if (Helper.isMobileDevice()) {
            images['portrait'] = Helper.getPortraitBackgroundMobileImage('precaution-pg', 'bg-precaution-pg');
            images['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('precaution-pg', 'bg-precaution-pg', { setScreenWidth: Helper.getMobileDeviceWidth() });
        } else {
            images['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('precaution-pg', 'bg-precaution-pg', { imgExt: 'jpg' });
        }
        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['PRECAUTION_IMG'] = images;
        return images;
    }

    static preloadLogoImage() {
        "use strict";
        const logoImg = Helper.getLoadImage('/images/logos/logo-head-mobile.svg');
        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['LOGO_IMG'] = logoImg;
        return logoImg;
    }

    static preloadMobileMenu() {
        "use strict";

        const images = {};
        images['hamburger'] = Helper.getLoadImage('/images/orig/header/header-menu-open-icon.png');
        images['cross'] = Helper.getLoadImage('/images/orig/header/header-menu-cross-icon.png');
        images['basket'] = Helper.getLoadImage('/images/icons/store-pg/basket.svg');

        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['MOBILE_MENU'] = images;

        return images;
    }

    /*
    * Preload masthead background banners
    */
    static preloadMastheadPageBackgroundBanners() {
        "use strict";
        // console.log("Debug [passetPreloader::preloadMastheadPageBackgroundBanners] enter the function");

        // debugger;
        const images = { 'mh000': {}, 'mh001': {}, 'mh002': {}, 'mh003': {} };
        if (Helper.isMobileDevice()) {

            images['mh000']['portrait'] = Helper.getPortraitBackgroundMobileImage('masthead-pg', 'bg-mh-000');
            images['mh001']['portrait'] = Helper.getPortraitBackgroundMobileImage('masthead-pg', 'bg-mh-002');
            images['mh002']['portrait'] = Helper.getPortraitBackgroundMobileImage('masthead-pg', 'bg-mh-003');
            images['mh003']['portrait'] = Helper.getPortraitBackgroundMobileImage('masthead-pg', 'bg-mh-004');


            images['mh000']['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-000', { setScreenWidth: Helper.getMobileDeviceWidth() });
            images['mh001']['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-002', { setScreenWidth: Helper.getMobileDeviceWidth() });
            images['mh002']['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-003', { setScreenWidth: Helper.getMobileDeviceWidth() });
            images['mh003']['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-004', { setScreenWidth: Helper.getMobileDeviceWidth() });

        } else {
            images['mh000']['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-000', { imgExt: 'jpg' });
            images['mh001']['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-002', { imgExt: 'jpg' });
            images['mh002']['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-003', { imgExt: 'jpg' });
            images['mh003']['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('masthead-pg', 'bg-mh-004', { imgExt: 'jpg' });
        }

        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['MASTHEAD_BANNERS'] = images;

        return images;
    }

    static preloadWineBottleImages() {
        "use strict";
        // console.log("Debug [passetPreloader::preloadWineBottleImages] enter the function");
        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['SINGLE_WINE']['SUDWAND_SINGLE_WINE_BOTTLE_IMG'] = Helper.getLoadImage('/images/icons/single-wine-pg/sudwand.png');
        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['SINGLE_WINE']['FRAUENBERG_SINGLE_WINE_BOTTLE_IMG'] = Helper.getLoadImage('/images/icons/single-wine-pg/frauenberg.png');
    }

    /*
    * Preload wine catalog images
    */
    static preloadLeftWineBackgroundImages() {
        "use strict";
        // console.log("Debug [passetPreloader::preloadLeftWineBackgroundImages] enter the function");

        const images = {};
        if (Helper.isMobileDevice()) {
            images['portrait'] = Helper.getPortraitBackgroundMobileImage('wines-pg', 'bg-wine-item-up');
            images['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('wines-pg', 'bg-left-wines-pg', { setScreenWidth: Helper.getMobileDeviceWidth() });
            images['portrait_lqip_img'] = Helper.getLoadImage('/images/mobile/wines-pg/lqip/portrait-lqip-wine-item-up.jpg')
            images['landscape_lqip_4_3_img'] = Helper.getLoadImage('/images/4_3/wines-pg/lqip_4_3/4_3-lqip-bw-left-bg-wines-pg.jpg');
            images['landscape_lqip_16_9_img'] = Helper.getLoadImage('/images/16_9/wines-pg/lqip_16_9/16_9-lqip-bw-left-bg-wines-pg.png');
        } else {
            images['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('wines-pg', 'bg-left-wines-pg', { imgExt: 'jpg' });
        }

        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['WINES']['LEFT_WINE_IMG'] = images;

        return images;
    }

    static preloadRightWineBackgroundImages() {
        "use strict";
        // console.log("Debug [passetPreloader::preloadRightWineBackgroundImages] enter the function");
        const images = {};
        if (Helper.isMobileDevice()) {
            images['portrait'] = Helper.getPortraitBackgroundMobileImage('wines-pg', 'bg-wine-item-down', 'png');
            images['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('wines-pg', 'bg-right-wines-pg', { imgExt: 'png', setScreenWidth: Helper.getMobileDeviceWidth() });

            images['portrait_lqip_img'] = Helper.getLoadImage('/images/mobile/wines-pg/lqip/portrait-lqip-wine-item-down.png')
            images['landscape_lqip_4_3_img'] = Helper.getLoadImage('/images/4_3/wines-pg/lqip_4_3/4_3-lqip-bw-right-bg-wines-pg.png');
            images['landscape_lqip_16_9_img'] = Helper.getLoadImage('/images/16_9/wines-pg/lqip_16_9/16_9-lqip-bw-right-bg-wines-pg.png');
        } else {
            images['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('wines-pg', 'bg-right-wines-pg', { imgExt: 'png' });
        }

        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['WINES']['RIGHT_WINE_IMG'] = images;

        return images;
    }


    /*
    * Preload single wine images
    */
    static preloadSudwandSingleWineBackgroundImages() {
        "use strict";
        // console.log("Debug [passetPreloader::preloadSudwandSingleWineBackgroundImages] enter the function");

        const images = {};
        if (Helper.isMobileDevice()) {
            images['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('single-wine-pg/sudwand-single-wine-pg', 'bg-sudwand-single-wine-pg', { setScreenWidth: Helper.getMobileDeviceWidth() });
        } else {
            images['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('single-wine-pg/sudwand-single-wine-pg', 'bg-sudwand-single-wine-pg', { imgExt: 'jpg' });
        }

        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['SINGLE_WINE']['SUDWAND_SINGLE_WINE_IMG'] = images;
    }

    static preloadFrauenbergSingleWineBackgroundImages() {
        "use strict";
        // console.log("Debug [passetPreloader::preloadFrauenbergSingleWineBackgroundImages] enter the function");

        const images = {};
        if (Helper.isMobileDevice()) {
            images['landscape'] = Helper.getResponsiveWidescreenBackgroundImage('single-wine-pg/frauenberg-single-wine-pg', 'bg-frauenberg-single-wine-pg', { setScreenWidth: Helper.getMobileDeviceWidth() });
        } else {

            images['desktop'] = Helper.getResponsiveWidescreenBackgroundImage('single-wine-pg/frauenberg-single-wine-pg', 'bg-frauenberg-single-wine-pg', { imgExt: 'jpg' });
        }

        Helper.GET_STEILGUT_VAR_STORE()['STEILGUT_IMAGES']['SINGLE_WINE']['FRAUENBERG_SINGLE_WINE_IMG'] = images;
    }

    static preloadRequiredAssets() {
        "use strict";


    }
}