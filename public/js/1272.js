"use strict";(self.webpackChunksteilgut_s_test002=self.webpackChunksteilgut_s_test002||[]).push([[1272],{8085:(n,t,e)=>{e.d(t,{Z:()=>r});var a=e(7897),i=e.n(a),s=e(1519),l=e.n(s)()(i());l.push([n.id,".legal-container[data-v-4d06b5be]{display:flex;flex:1 1 75vh;flex-direction:column;height:75vh;height:calc(var(--100nvh, 1vh)*75);max-width:65%;width:65%}.gold-border[data-v-4d06b5be]{border:2px solid #ebcb9a}.is-bare-page[data-v-4d06b5be]{top:5%}@media only screen and (min-width:320px) and (max-width:1024px){input[type=button][data-v-4d06b5be],input[type=submit][data-v-4d06b5be],input[type=text][data-v-4d06b5be],textarea[data-v-4d06b5be]{-webkit-appearance:none!important;border-radius:0!important}.safari-legal-height[data-v-4d06b5be]{max-height:unset!important}.legal-container[data-v-4d06b5be]{flex:1 0 auto}}@media only screen and (min-width:320px) and (orientation:portrait){.legal-container[data-v-4d06b5be]{height:auto;max-height:unset;padding:0 1rem 1rem}}@media only screen and (min-width:320px) and (max-width:1024px) and (orientation:landscape){.legal-container[data-v-4d06b5be]{height:auto;margin-top:-15vh;max-height:unset;min-height:0;padding-bottom:8vh}.is-bare-page[data-v-4d06b5be]{margin-top:15vh;top:unset}}","",{version:3,sources:["webpack://./resources/js/shared/components/legal/LegalComp.vue"],names:[],mappings:"AAiLA,kCACC,YAAA,CACA,aAAA,CACA,qBAAA,CAEA,WAAA,CACA,kCAAA,CACA,aAAA,CACA,SAhLD,CAmLA,8BACC,wBAhLD,CAmLA,+BACC,MAhLD,CA0LA,gEAEC,oIAIC,iCAAA,CACA,yBA/KA,CAkLD,sCACC,0BA/KA,CAkLD,kCACC,aA/KA,CACF,CAkLA,oEACC,kCAGC,WAAA,CADA,gBAAA,CADA,mBA9KA,CACF,CAwMA,4FACC,kCAGC,WAAA,CACA,gBAAA,CAHA,gBAAA,CACA,YAAA,CAGA,kBAjLA,CAoLD,+BAEC,eAAA,CADA,SAhLA,CAGF",sourcesContent:['\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n.legal-container {\n\tdisplay: flex;\n\tflex: 1 1 75vh;\n\tflex-direction: column;\n\t/* max-height: 80%; */\n\theight: 75vh;\n\theight: calc(var(--100nvh, 1vh) * 75);\n\tmax-width: 65%;\n\twidth: 65%;\n}\n\n.gold-border {\n\tborder: 2px solid #ebcb9a;\n}\n\n.is-bare-page {\n\ttop: 5%;\n}\n/*********************************************************************\n*\n*************************** MEDIA QUERIES ****************************\n* @link \n* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/\n*\n**********************************************************************/\n/* Smartphones (portrait and landscape) ----------- */\n@media only screen and (min-width: 320px) and (max-width: 1024px) {\n\t/* remove rounding corners */\n\ttextarea,\n\tinput[type="text"],\n\tinput[type="button"],\n\tinput[type="submit"] {\n\t\t-webkit-appearance: none !important;\n\t\tborder-radius: 0 !important;\n\t}\n\n\t.safari-legal-height {\n\t\tmax-height: unset !important;\n\t}\n\n\t.legal-container {\n\t\tflex: 1 0 auto;\n\t}\n}\n\n@media only screen and (min-width: 320px) and (orientation: portrait) {\n\t.legal-container {\n\t\tpadding: 0 1rem 1rem 1rem;\n\t\tmax-height: unset;\n\t\theight: auto;\n\t}\n}\n\n/*\n    * @link: https://websiteedu.com/media-queries-for-mobile-and-tablets/?__cf_chl_jschl_tk__=f4b85448ac9131968259f036667ebbe13f3aee4e-1620873849-0-AfVyBOo3EXzkNnPk3o7Y2fBiOHMOfi9Ez_ELD5YtZPhiuNEWff8cy4MUte33zch82L-l8ED6GNcOpaSmkrLTf-MBeOtEwaD0lOUn3JpenolXersHBNrzqH1P2EriQDQ0T3zRwahK5L0Dv1HaV6FtQjSWLbpUA3dzW6f9QfGllFDKoFKyFoeR7ma8DzneAa8_lg_P4uZKkDeDNYNeu4N5ZPGU8bYgv7OSYrlY17sKUZYScM5cG5IWZdKKED70KvynQtzyL22ETSPnUUSdew9gTFo3xTQhiOjCO-h79BHYAl9u9yUtrVPzZ1vXPuL3d8DXGM_Dw7rSMbTARgqzMPirmWcZZnYgYI_Ad_puGDQEky3Mg4ma4ltgGVG__BKE_JGL1Th8dKZhG3-48KTSJNAwh_vX0x3SCvVckdjUkcc4yQ0fkkTUeEy55KZ76yiqO35_PVGoQGj4yBIYAe84TKs8hdVDH7LqZuz_8MfLbzsyRExG0ri6AZhSfs999AwnI72B0g\n    *\n    * @link https://viewportsizer.com/devices/\n    *\n    * Samsung \n    * S8,8+,9,9+,10: W360px - H740px 4x\n    * Galaxy S6, S7, S7 Edge: W360px - H640px 4x\n    * Galaxy S4, S5, Note 3: W360px - H640px 3x\n    * Galaxy Note 10, 10+: W360px - H718px 2x\n    * Galaxy Note 8, 9: W360px - H740px 4x\n    * Galaxy S20 Ultra, S20+, S20: W480 - H1067 3x-4x\n    *\n    * Iphone\n    * iPhone 5, 5C, 5S, SE: W320px - H568px 2x\n    * iPhone 6 Plus, 6S Plus, 7 Plus, 8 Plus: W414px - H736px 3x\n    * iPhone 6, 6S, 7, 8: W375px - H667px 2x\n    * iPhone XR, 11: W414px - H896px 2x\n    * iPhone XS Max, 11 Pro Max: 414px - 896px 3x\n    * iPhone X, XS, 11 Pro: 375px -  812px 3x\n*/\n@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {\n\t.legal-container {\n\t\tmax-height: unset;\n\t\tmin-height: 0;\n\t\theight: auto;\n\t\tmargin-top: -15vh;\n\t\tpadding-bottom: 8vh;\n\t}\n\n\t.is-bare-page {\n\t\ttop: unset;\n\t\tmargin-top: 15vh;\n\t}\n\t/* Safari only */\n\t@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {\n\t\t@supports (-webkit-appearance: none) {\n\t\t}\n\t}\n}\n'],sourceRoot:""}]);const r=l},1272:(n,t,e)=>{e.r(t),e.d(t,{default:()=>h});var a=e(6491),i=e(5047),s=e(5543);e(8094),e(9420);const l={mixins:[a.Z,i.Z,s.Z],components:{"impressum-comp":function(){return e.e(4864).then(e.bind(e,4864))},"datenschutz-comp":function(){return e.e(3860).then(e.bind(e,3860))},"agbs-comp":function(){return e.e(3127).then(e.bind(e,3127))},"widerruf-comp":function(){return e.e(1941).then(e.bind(e,1941))},"versand-comp":function(){return e.e(2181).then(e.bind(e,2181))},"zahlungsarten-comp":function(){return e.e(5629).then(e.bind(e,5629))}},props:{name:{type:[String],default:"impressum"},isBarePage:{type:[String,Boolean],require:!1,default:!1}},created:function(){this.$_checkedOrRedirected()&&console.log("Debug [legalComp::created] Initial state is valid")},mounted:function(){this.isBarePage&&console.log("Debug [legalComp::created] Bare page")},data:function(){return{}},methods:{$_checkedOrRedirected:function(){return!!this.$_isInitialStateValid()||(console.warn("Warn [legalComp::$_checkedOrRedirected] Returned Invalid Arguments"),this.$router.push({name:"controlPanel"}),!1)},$_isInitialStateValid:function(){return!0}},computed:{isImpressum:function(){return"impressum"===this.name},isDatenschutz:function(){return"datenschutz"===this.name},isAGBS:function(){return"agbs"===this.name},isWiderruf:function(){return"widerruf"===this.name},isVersand:function(){return"versand"===this.name},isZahlungsarten:function(){return"zahlungsarten"===this.name}}};var r=e(3379),o=e.n(r),d=e(8085),p={insert:"head",singleton:!1};o()(d.Z,p);d.Z.locals;const h=(0,e(1900).Z)(l,(function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"tw-flex md:tw-w-065 md:tw-max-w-065 landscape:tw-w-065 landscape:tw-max-w-065 tw-w-full tw-max-w-full tw-mx-auto legal-container portrait-non-fp landscape-non-fp tw-z-2",class:{"is-bare-page":n.isBarePage}},[e("lazy-load-image-comp",{attrs:{basedLazyImgStyleClass:"legal-pg-img",relativePath:"legal-pg",baseName:"bg-legal-pg",lqipPath_4_3:"/images/4_3/legal-pg/lqip_4_3/jpg/4_3-lqip-bg-legal-pg.jpg",lqipPath_16_9:"/images/16_9/legal-pg/lqip_16_9/jpg/16_9-lqip-bg-legal-pg.jpg",lqipPath_portrait:"/images/mobile/legal-pg/lqip/portrait-lqip-bg-legal-pg.jpg",lazyLoadCommonImgStyleClass:"tw-fixed tw-inset-0 tw-object-cover tw-max-w-screen tw-w-screen",basedLandscapeLazyImgStyleClass:"tw-h-screen tw-max-h-screen",basedPortraitLazyImgStyleClass:"tw-h-screen tw-max-h-screen",lazyLoadImgStyleClass_4_3:"",lazyLoadImgStyleClass_16_9:"",lazyLoadImgStyleClass_portrait:"",commonImgStyleClass:"",backZIndexStyleClass:"tw-z-n-1",isDesktopAspectRatioCorrection:"true"}}),n._v(" "),e("div",{staticClass:"tw-flex transit-flex-box safari-legal-height tw-flex-col transit-flex-box landscape:tw-h-auto tw-relative tw-z-2"},[n.isImpressum?e("div",{staticClass:"transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"},[e("impressum-comp")],1):n._e(),n._v(" "),n.isDatenschutz?e("div",{staticClass:"transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"},[e("datenschutz-comp")],1):n._e(),n._v(" "),n.isAGBS?e("div",{staticClass:"transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"},[e("agbs-comp")],1):n._e(),n._v(" "),n.isWiderruf?e("div",{staticClass:"transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"},[e("widerruf-comp")],1):n._e(),n._v(" "),n.isVersand?e("div",{staticClass:"transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"},[e("versand-comp")],1):n._e(),n._v(" "),n.isZahlungsarten?e("div",{staticClass:"transit-flex-box tw-flex safari-legal-height tw-h-auto tw-max-w-full"},[e("zahlungsarten-comp")],1):n._e()])],1)}),[],!1,null,"4d06b5be",null).exports}}]);
//# sourceMappingURL=1272.js.map