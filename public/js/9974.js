"use strict";(self.webpackChunksteilgut_s_test002=self.webpackChunksteilgut_s_test002||[]).push([[9974,9420],{3078:(t,n,e)=>{e.d(n,{Z:()=>l});var a=e(7897),s=e.n(a),i=e(1519),o=e.n(i)()(s());o.push([t.id,".news-body .ls-news-body-nav-bar .ls-news-body-nav-links[data-v-001a8c07],.news-body .news-body-nav-bar .md-news-body-nav-links[data-v-001a8c07],.news-body .news-body-nav-bar .news-body-nav-links[data-v-001a8c07]{display:inline-block}.ls-title-underline[data-v-001a8c07],.md-title-underline[data-v-001a8c07],.news-body .title-underline[data-v-001a8c07]{max-width:110px;width:110px}.news-body-title-text[data-v-001a8c07]{font-family:steilgut_plantagenet_cherokee,sans-serif;margin:calc(.5em + 1vmin) auto auto 0}blockquote[data-v-001a8c07]{display:block!important;margin:1em 40px!important}figure[data-v-001a8c07]{margin:2em 0}@media only screen and (min-width:320px) and (max-width:1024px){.news-body-nav-bar[data-v-001a8c07]{align-content:center;display:flex;flex-direction:column;height:85vh;justify-content:center;max-height:85vh;max-width:100%;width:100%}}@media only screen and (min-width:320px) and (orientation:portrait){.portrait-news-body[data-v-001a8c07]{margin-top:-15vh}.news-body-thread div p[data-v-001a8c07]{font-size:calc(.5rem + 2vmin)}}@media only screen and (min-width:320px) and (max-width:1024px) and (orientation:landscape){.landscape-news-body[data-v-001a8c07]{margin-top:-25vh}.ls-news-body-nav-bar[data-v-001a8c07]{align-items:flex-start;display:flex;flex-direction:column;height:100%;justify-content:flex-start;min-height:100%;padding-top:25%}.news-body-thread div p[data-v-001a8c07]{font-size:calc(.5rem + 1.1vmin)}}@media only screen and (min-width:1025px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio:1){.md-news-body[data-v-001a8c07]{margin-left:33.3%;max-width:66.7%;width:66.7%}.news-title-line[data-v-001a8c07]{align-content:center;display:flex;flex-direction:row;justify-content:space-between;margin:2rem auto 0 0;width:70%}.news-body-content[data-v-001a8c07]{margin:0 auto 0 0;width:63%}.news-body-thread[data-v-001a8c07]{font-size:calc(.4rem + 1.1vh);font-size:calc(.4rem + var(--100nvh, 1vh)*1.1);line-height:28px;line-height:calc(1rem + 1.3vh);line-height:calc(1rem + var(--100nvh, 1vh)*1.3);padding-bottom:5vw}.news-body-title h1[data-v-001a8c07]{font-size:calc(1.3rem + .8vmin);margin:auto}}@media only screen and (min-width:1025px) and (max-device-width:2048px) and (-webkit-min-device-pixel-ratio:1) and (max-aspect-ratio:159/100){.news-title-line[data-v-001a8c07]{margin:2rem auto 0 10%}.news-body-content[data-v-001a8c07]{margin:0 auto 0 10%}}","",{version:3,sources:["webpack://./resources/js/app/news/NewsBodyComp.vue"],names:[],mappings:"AA8TA,qNACC,oBArTD,CAwTA,uHAIC,eAAA,CADA,WApTD,CAwTA,uCACC,oDAAA,CACA,qCArTD,CAwTA,4BACC,uBAAA,CAIA,yBArTD,CAwTA,wBACC,YArTD,CA+TA,gEAEC,oCASC,oBAAA,CAHA,YAAA,CACA,qBAAA,CAJA,WAAA,CAKA,sBAAA,CAJA,eAAA,CAFA,cAAA,CADA,UA/SA,CACF,CA0TA,oEACC,qCACC,gBAxTA,CA2TD,yCACC,6BAxTA,CACF,CA2TA,4FACC,sCACC,gBAzTA,CA4TD,uCAMC,sBAAA,CAHA,YAAA,CACA,qBAAA,CAHA,WAAA,CAIA,0BAAA,CAHA,eAAA,CAKA,eAzTA,CA4TD,yCACC,+BAzTA,CACF,CA6TA,6GAEC,+BAGC,iBAAA,CADA,eAAA,CADA,WAxTA,CA6TD,kCAIC,oBAAA,CAHA,YAAA,CACA,kBAAA,CACA,6BAAA,CAGA,oBAAA,CADA,SAzTA,CA6TD,oCACC,iBAAA,CACA,SA1TA,CA6TD,mCAGC,6BAAA,CACA,8CAAA,CAEA,gBAAA,CACA,8BAAA,CACA,+CAAA,CAPA,kBArTA,CA+TD,qCACC,+BAAA,CACA,WA5TA,CACF,CAgUA,8IAEC,kCACC,sBA7TA,CAgUD,oCACC,mBA7TA,CACF",sourcesContent:['\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n.news-body .news-body-nav-bar .news-body-nav-links {\n\tdisplay: inline-block;\n}\n\n.news-body .news-body-nav-bar .md-news-body-nav-links {\n\tdisplay: inline-block;\n}\n\n.news-body .ls-news-body-nav-bar .ls-news-body-nav-links {\n\tdisplay: inline-block;\n}\n\n.news-body .title-underline,\n.md-title-underline,\n.ls-title-underline {\n\twidth: 110px;\n\tmax-width: 110px;\n}\n\n.news-body-title-text {\n\tfont-family: "steilgut_plantagenet_cherokee", sans-serif;\n\tmargin: calc(0.5em + 1vmin) auto auto 0;\n}\n\nblockquote {\n\tdisplay: block !important;\n\tmargin-top: 1em !important;\n\tmargin-bottom: 1em !important;\n\tmargin-left: 40px !important;\n\tmargin-right: 40px !important;\n}\n\nfigure {\n\tmargin: 2em 0 2em 0;\n}\n\n/*********************************************************************\n* \n*************************** MEDIA QUERIES ****************************\n*\n**********************************************************************/\n\n/* Smartphones (portrait and landscape) ----------- */\n@media only screen and (min-width: 320px) and (max-width: 1024px) {\n\t/* Styles */\n\t.news-body-nav-bar {\n\t\twidth: 100%;\n\t\tmax-width: 100%;\n\t\theight: 85vh;\n\t\tmax-height: 85vh;\n\n\t\tdisplay: flex;\n\t\tflex-direction: column;\n\t\tjustify-content: center;\n\t\talign-content: center;\n\t}\n}\n\n@media only screen and (min-width: 320px) and (orientation: portrait) {\n\t.portrait-news-body {\n\t\tmargin-top: -15vh;\n\t}\n\n\t.news-body-thread div p {\n\t\tfont-size: calc(0.5rem + 2vmin);\n\t}\n}\n\n@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {\n\t.landscape-news-body {\n\t\tmargin-top: -25vh;\n\t}\n\n\t.ls-news-body-nav-bar {\n\t\theight: 100%;\n\t\tmin-height: 100%;\n\t\tdisplay: flex;\n\t\tflex-direction: column;\n\t\tjustify-content: flex-start;\n\t\talign-items: flex-start;\n\t\tpadding-top: 25%;\n\t}\n\n\t.news-body-thread div p {\n\t\tfont-size: calc(0.5rem + 1.1vmin);\n\t}\n}\n\n/* Laptops, desktops, large screens */\n@media only screen and (min-width: 1025px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {\n\t/* Styles */\n\t.md-news-body {\n\t\twidth: 66.7%;\n\t\tmax-width: 66.7%;\n\t\tmargin-left: 33.3%;\n\t}\n\n\t.news-title-line {\n\t\tdisplay: flex;\n\t\tflex-direction: row;\n\t\tjustify-content: space-between;\n\t\talign-content: center;\n\t\twidth: 70%;\n\t\tmargin: 2rem auto 0 0;\n\t}\n\n\t.news-body-content {\n\t\tmargin: 0 auto 0 0;\n\t\twidth: 63%;\n\t}\n\n\t.news-body-thread {\n\t\tpadding-bottom: 5vw;\n\n\t\tfont-size: calc(0.4rem + 1.1vh);\n\t\tfont-size: calc(0.4rem + var(--100nvh, 1vh) * 1.1);\n\n\t\tline-height: 28px;\n\t\tline-height: calc(1rem + 1.3vh);\n\t\tline-height: calc(1rem + var(--100nvh, 1vh) * 1.3);\n\t}\n\n\t.news-body-title h1 {\n\t\tfont-size: calc(1.3rem + 0.8vmin);\n\t\tmargin: auto;\n\t}\n}\n\n/* Laptops, desktops, large screens: [... 16/10) ----------- */\n@media only screen and (min-width: 1025px) and (max-device-width: 2048px) and (-webkit-min-device-pixel-ratio: 1) and (max-aspect-ratio: 159/100) {\n\t/* Styles */\n\t.news-title-line {\n\t\tmargin: 2rem auto 0 10%;\n\t}\n\n\t.news-body-content {\n\t\tmargin: 0 auto 0 10%;\n\t}\n}\n\n/*********************************************************************\n* \n*************************** END: MEDIA QUERIES ***********************\n*\n**********************************************************************/\n'],sourceRoot:""}]);const l=o},4400:(t,n,e)=>{e.d(n,{Z:()=>l});var a=e(7897),s=e.n(a),i=e(1519),o=e.n(i)()(s());o.push([t.id,".white-steilgut-pulse[data-v-70116b3e]{background:url(/images/icons/pulse-logo/white-pulse-logo.png);background-repeat:no-repeat;background-size:contain}.black-steilgut-pulse[data-v-70116b3e],.white-steilgut-pulse[data-v-70116b3e]{height:130px;left:50%;position:fixed;top:50%;transform:translate(-50%,-50%);width:185px}.black-steilgut-pulse[data-v-70116b3e]{background:url(/images/icons/pulse-logo/black-pulse-logo.png);background-repeat:no-repeat;background-size:contain}.pulse-animation[data-v-70116b3e]{-webkit-animation:pulse-data-v-70116b3e 5s infinite;animation:pulse-data-v-70116b3e 5s infinite}@-webkit-keyframes pulse-data-v-70116b3e{0%{opacity:.5;transform:translate(-50%,-50%)}50%{opacity:.7;transform:translate(-50%,-50%) scale(2)}to{opacity:1;transform:translate(-50%,-50%) scale(1)}}@keyframes pulse-data-v-70116b3e{0%{opacity:.5;transform:translate(-50%,-50%)}50%{opacity:.7;transform:translate(-50%,-50%) scale(2)}to{opacity:1;transform:translate(-50%,-50%) scale(1)}}","",{version:3,sources:["webpack://./resources/js/shared/components/PulseLogoComp.vue"],names:[],mappings:"AAwEA,uCAKC,6DAAA,CAEA,2BAAA,CADA,uBApED,CA0EA,8EAHC,YAAA,CANA,QAAA,CAFA,cAAA,CACA,OAAA,CAEA,8BAAA,CAIA,WA1DD,CA8DA,uCAKC,6DAAA,CAEA,2BAAA,CADA,uBApED,CA0EA,kCACC,mDAAA,CAAA,2CAvED,CA0EA,yCACC,GAEC,UAAA,CADA,8BAtEA,CA0ED,IAEC,UAAA,CADA,uCAvEA,CA2ED,GAEC,SAAA,CADA,uCAxEA,CACF,CA2DA,iCACC,GAEC,UAAA,CADA,8BAtEA,CA0ED,IAEC,UAAA,CADA,uCAvEA,CA2ED,GAEC,SAAA,CADA,uCAxEA,CACF",sourcesContent:["\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n.white-steilgut-pulse {\n\tposition: fixed;\n\ttop: 50%;\n\tleft: 50%;\n\ttransform: translate(-50%, -50%);\n\tbackground: url('/images/icons/pulse-logo/white-pulse-logo.png');\n\tbackground-size: contain;\n\tbackground-repeat: no-repeat;\n\twidth: 185px;\n\theight: 130px;\n}\n\n.black-steilgut-pulse {\n\tposition: fixed;\n\ttop: 50%;\n\tleft: 50%;\n\ttransform: translate(-50%, -50%);\n\tbackground: url('/images/icons/pulse-logo/black-pulse-logo.png');\n\tbackground-size: contain;\n\tbackground-repeat: no-repeat;\n\twidth: 185px;\n\theight: 130px;\n}\n\n.pulse-animation {\n\tanimation: pulse 5s infinite;\n}\n\n@keyframes pulse {\n\t0% {\n\t\ttransform: translate(-50%, -50%);\n\t\topacity: 0.5;\n\t}\n\n\t50% {\n\t\ttransform: translate(-50%, -50%) scale(2);\n\t\topacity: 0.7;\n\t}\n\n\t100% {\n\t\ttransform: translate(-50%, -50%) scale(1);\n\t\topacity: 1;\n\t}\n}\n\n/*********************************************************************\n*\n*************************** MEDIA QUERIES ****************************\n* @link \n* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/\n*\n**********************************************************************/\n/* Smartphones (portrait and landscape) ----------- */\n@media only screen and (min-width: 320px) and (max-width: 1024px) {\n}\n\n/* all devices (portrait) ----------- */\n@media only screen and (min-width: 320px) and (orientation: portrait) {\n}\n\n/* Smartphones (landscape) ----------- */\n@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {\n}\n\n/* Tablets, ipads, laptops, desktops (landscape) ----------- */\n@media only screen and (min-width: 1025px) and (orientation: landscape) {\n\t/* Safari only */\n\t@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {\n\t\t@supports (-webkit-appearance: none) {\n\t\t}\n\t}\n}\n"],sourceRoot:""}]);const l=o},9974:(t,n,e)=>{e.r(n),e.d(n,{default:()=>m});var a=e(7757),s=e.n(a),i=e(9061),o=e(5047),l=e(5543);function d(t,n,e,a,s,i,o){try{var l=t[i](o),d=l.value}catch(t){return void e(t)}l.done?n(d):Promise.resolve(d).then(a,s)}const r={mixins:[o.Z,l.Z],components:{"pulse-logo-comp":i.default},mounted:function(){window.addEventListener("resize",this.$_applyAdditionalStyles,!1)},destroyed:function(){window.removeEventListener("resize",this.$_applyAdditionalStyles)},updated:function(){this.$_applyAdditionalStyles()},props:{id:[String,Number]},data:function(){return{isLoading:!1,isError:!1,aNewsItem:null}},created:function(){var t,n=this;return(t=s().mark((function t(){return s().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return n.isLoading=!0,t.prev=1,t.next=4,axios.get("/api/news-body/".concat(n.id,"/show"));case 4:n.aNewsItem=t.sent.data.data,t.next=11;break;case 7:t.prev=7,t.t0=t.catch(1),console.log("Error [ NewsBodyComp::created ] Error "+t.t0),n.isError=!0;case 11:n.isLoading=!1;case 12:case"end":return t.stop()}}),t,null,[[1,7]])})),function(){var n=this,e=arguments;return new Promise((function(a,s){var i=t.apply(n,e);function o(t){d(i,a,s,o,l,"next",t)}function l(t){d(i,a,s,o,l,"throw",t)}o(void 0)}))})()},methods:{$_applyAdditionalStyles:function(){console.info("[NewBodyComp::updated] Enter the function");var t=".news-body .desktop-news-body .news-body-thread > div > p",n="calc(var(--100nvh, 1vh) * 2.5) 0";this.isMobileDevice()&&(this.isPortraitOrientation()?t=".news-body .portrait-news-body .news-body-thread > div > p":this.isLandscapeOrientation()&&(t=".news-body .landscape-news-body .news-body-thread > div > p"),n="calc(var(--100vmin, 1vmin) * 2.5) 0");var e=document.querySelectorAll(t);e&&e.length>0&&e.forEach((function(t){t.style.margin=n}))}}};var c=e(3379),w=e.n(c),A=e(3078),p={insert:"head",singleton:!1};w()(A.Z,p);A.Z.locals;const m=(0,e(1900).Z)(r,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"news-body transit-flex-box tw-static md:tw-min-h-080 tw-min-h-full tw-h-auto tw-w-full tw-max-w-full md:tw-h-auto portrait-non-fp landscape-non-fp"},[t.isError?e("div",[e("error-comp")],1):e("div",{staticClass:"tw-flex transit-flex-box md:tw-h-auto md:tw-min-h-080 tw-min-h-full tw-h-auto"},[e("div",{staticClass:"tw-hidden transit-flex-box md:tw-flex md:tw-h-auto md:tw-min-h-080 desktop-news-body landscape:tw-hidden"},[e("lazy-load-image-comp",{attrs:{basedLazyImgStyleClass:"bg-news-body-pg-img",relativePath:"news-body-pg",baseName:"bg-news-body-pg",lqipPath_4_3:"/images/4_3/news-body-pg/lqip_4_3/jpg/4_3-lqip-bg-news-body-pg.jpg",lqipPath_16_9:"/images/16_9/news-body-pg/lqip_16_9/jpg/16_9-lqip-bg-news-body-pg.jpg",lazyLoadCommonImgStyleClass:"tw-fixed tw-inset-0 tw-object-cover tw-max-w-screen tw-w-screen tw-max-h-screen tw-h-screen",lazyLoadImgStyleClass_4_3:"",lazyLoadImgStyleClass_16_9:"",basedLandscapeLazyImgStyleClass:"",commonImgStyleClass:"",atSurfaceZindexStyleClass:"tw-z-0",backZIndexStyleClass:"tw-z-n-1",isDesktopAspectRatioCorrection:"true"}}),t._v(" "),e("div",[t.isLoading?e("div",[e("pulse-logo-comp",{attrs:{isDefer:"true"}})],1):e("div",{staticClass:"tw-relative tw-z-auto transit-flex-box tw-flex tw-h-auto tw-min-h-080 md-news-body"},[e("div",{staticClass:"news-title-line"},[e("div",{staticClass:"news-body-nav-bar"},[e("router-link",{staticClass:"hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent",attrs:{to:"/masthead/control-panel"}},[t._v(t._s(t.__("newsBody.main")))]),t._v(" "),e("span",{staticClass:"tw-text-steilgut-gold tw-mx-2"},[t._v("|")]),t._v(" "),e("router-link",{staticClass:"hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent",attrs:{to:"/masthead/news"}},[t._v(t._s(t.__("newsBody.news")))])],1),t._v(" "),e("div",{staticClass:"news-body-posting-date"},[e("span",{staticClass:"tw-text-steilgut-gold posting-date"},[t._v(t._s(t.aNewsItem.postingDate))])])]),t._v(" "),e("div",{staticClass:"news-body-content"},[e("div",{staticClass:"news-body-title tw-my-8"},[e("h1",{staticClass:"news-body-title-text"},[t._v("\n\t\t\t\t\t\t\t\t"+t._s(t.aNewsItem.title)+"\n\t\t\t\t\t\t\t")]),t._v(" "),t._m(0)]),t._v(" "),e("div",{staticClass:"news-body-thread",domProps:{innerHTML:t._s(t.aNewsItem.thread.trim())}})])])])],1),t._v(" "),e("div",{staticClass:"md:tw-hidden tw-flex transit-flex-box tw-min-h-full tw-h-auto"},[e("div",{staticClass:"tw-block landscape:tw-hidden"},[e("lazy-load-image-comp",{attrs:{basedLazyImgStyleClass:"bg-news-body-pg-img",relativePath:"news-body-pg",baseName:"bg-news-body-pg",lqipPath_4_3:"",lqipPath_16_9:"",lqipPath_portrait:"/images/mobile/news-body-pg/portrait/lqip/lqip-portrait-bg-news-body-pg.jpg",lazyLoadCommonImgStyleClass:"tw-absolute tw-inset-0 tw-p-0 tw-m-0 tw-object-cover tw-w-screen tw-h-screen",lazyLoadImgStyleClass_4_3:"",lazyLoadImgStyleClass_16_9:"",basedLandscapeLazyImgStyleClass:"",commonImgStyleClass:"",atSurfaceZindexStyleClass:"tw-z-0",backZIndexStyleClass:"tw-z-n-1",isDesktopAspectRatioCorrection:"false",isHiddenDesktop:"true",isHiddenLandscape:"true"}})],1),t._v(" "),e("div",{staticClass:"landscape:tw-block tw-hidden"},[e("lazy-load-image-comp",{attrs:{basedLazyImgStyleClass:"bg-news-body-pg-img",relativePath:"news-body-pg/landscape",baseName:"bg-news-body-pg",lqipPath_4_3:"",lqipPath_16_9:"/images/16_9/news-body-pg/landscape/lqip_16_9/jpg/16_9-lqip-bg-news-body-pg.jpg",lazyLoadCommonImgStyleClass:"tw-absolute tw-inset-0 tw-p-0 tw-m-0 tw-object-cover tw-w-screen tw-h-screen",lazyLoadImgStyleClass_4_3:"",lazyLoadImgStyleClass_16_9:"",basedLandscapeLazyImgStyleClass:"",commonImgStyleClass:"",atSurfaceZindexStyleClass:"tw-z-0",backZIndexStyleClass:"tw-z-n-1",isDesktopAspectRatioCorrection:"false",isHiddenDesktop:"true"}})],1),t._v(" "),t.isLoading?e("div",[e("pulse-logo-comp",{attrs:{isDefer:"true",isDark:"false"}})],1):e("div",{staticClass:"md:hidden tw-flex transit-flex-box tw-min-h-full tw-h-auto tw-z-auto"},[e("div",{staticClass:"tw-flex transit-flex-box tw-min-h-full tw-h-auto landscape:tw-hidden portrait-news-body"},[e("div",{staticClass:"tw-flex transit-flex-box tw-min-h-screen tw-h-screen"},[e("div",{staticClass:"tw-relative tw-z-auto tw-flex tw-flex-col tw-p-4 tw-mb-0 tw-mt-auto debug-border"},[e("div",{staticClass:"tw-flex tw-flex-row"},[e("router-link",{staticClass:"hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent",attrs:{to:"/masthead/control-panel"}},[t._v(t._s(t.__("newsBody.main")))]),t._v(" "),e("span",{staticClass:"tw-text-steilgut-gold tw-mx-2"},[t._v("|")]),t._v(" "),e("router-link",{staticClass:"hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent",attrs:{to:"/masthead/news"}},[t._v(t._s(t.__("newsBody.news")))])],1),t._v(" "),e("div",{staticClass:"tw-flex tw-flex-col"},[e("h1",{staticClass:"news-body-title-text"},[t._v("\n\t\t\t\t\t\t\t\t\t"+t._s(t.aNewsItem.title)+"\n\t\t\t\t\t\t\t\t")]),t._v(" "),t._m(1)])])]),t._v(" "),e("div",{staticClass:"tw-relative tw-z-9 tw-p-4 tw-flex tw-flex-col"},[e("div",{staticClass:"news-body-posting-date tw-my-2 tw-text-masthead-header-gold"},[e("span",{staticClass:"tw-text-steilgut-gold posting-date"},[t._v(t._s(t.aNewsItem.postingDate))])]),t._v(" "),e("div",{staticClass:"news-body-thread tw-mt-6 tw-mb-4",domProps:{innerHTML:t._s(t.aNewsItem.thread.trim())}})])]),t._v(" "),e("div",{staticClass:"tw-hidden landscape:tw-flex transit-flex-box tw-min-h-full tw-h-auto landscape-news-body"},[e("div",{staticClass:"tw-flex transit-flex-box tw-min-h-screen tw-h-screen"},[e("div",{staticClass:"tw-relative tw-z-auto tw-flex tw-flex-col tw-p-4 tw-mb-0 tw-mt-auto debug-border"},[e("div",{staticClass:"tw-flex tw-flex-row"},[e("router-link",{staticClass:"hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent",attrs:{to:"/masthead/control-panel"}},[t._v(t._s(t.__("newsBody.main")))]),t._v(" "),e("span",{staticClass:"tw-text-steilgut-gold tw-mx-2"},[t._v("|")]),t._v(" "),e("router-link",{staticClass:"hover:tw-text-white tw-text-steilgut-gold hover:tw-no-underline focus:tw-outline-none focus:tw-border-transparent",attrs:{to:"/masthead/news"}},[t._v(t._s(t.__("newsBody.news")))])],1),t._v(" "),e("div",{staticClass:"tw-flex tw-flex-col"},[e("h1",{staticClass:"news-body-title-text"},[t._v("\n\t\t\t\t\t\t\t\t\t"+t._s(t.aNewsItem.title)+"\n\t\t\t\t\t\t\t\t")]),t._v(" "),t._m(2)])])]),t._v(" "),e("div",{staticClass:"tw-relative tw-z-auto tw-p-4 tw-flex tw-flex-col"},[e("div",{staticClass:"news-body-posting-date tw-my-2 tw-text-masthead-header-gold"},[e("span",{staticClass:"tw-text-steilgut-gold posting-date"},[t._v(t._s(t.aNewsItem.postingDate))])]),t._v(" "),e("div",{staticClass:"news-body-thread tw-mt-6 tw-mb-4",domProps:{innerHTML:t._s(t.aNewsItem.thread.trim())}})])])])])])])}),[function(){var t=this.$createElement,n=this._self._c||t;return n("div",{staticClass:"md-title-underline tw-mt-2"},[n("img",{staticClass:"title-underline-img tw-m-auto",attrs:{src:"/images/orig/news-pg/news-title-underline.png"}})])},function(){var t=this.$createElement,n=this._self._c||t;return n("div",{staticClass:"title-underline tw-mt-2"},[n("img",{staticClass:"title-underline-img tw-m-auto",attrs:{src:"/images/orig/news-pg/news-title-underline.png"}})])},function(){var t=this.$createElement,n=this._self._c||t;return n("div",{staticClass:"title-underline tw-mt-2"},[n("img",{staticClass:"title-underline-img tw-m-auto",attrs:{src:"/images/orig/news-pg/news-title-underline.png"}})])}],!1,null,"001a8c07",null).exports},9061:(t,n,e)=>{e.r(n),e.d(n,{default:()=>d});const a={mixins:[e(8663).Z],props:{isDefer:{required:!1,default:!1,type:[String,Boolean]},isDark:{required:!1,default:!1,type:[String,Boolean]}},data:function(){return{isVisible:!0}},mounted:function(){if(this.isDefer){this.isVisible=!1;var t=this;setTimeout((function(){t.isVisible=!0}),500)}},computed:{calcColorLogoStyleClass:function(){return this.ifLightBackgroundPage()||this.isDark?"black-steilgut-pulse":"white-steilgut-pulse"},getPulseStyleClass:function(){return"pulse-animation"},calcVisibilityClass:function(){return this.isDefer?this.isVisible?"tw-z-21 tw-block "+this.getPulseStyleClass:"tw-z-n-1 tw-opacity-0":"tw-z-21 tw-block"}}};var s=e(3379),i=e.n(s),o=e(4400),l={insert:"head",singleton:!1};i()(o.Z,l);o.Z.locals;const d=(0,e(1900).Z)(a,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"transit-flex-box tw-flex"},[e("div",{class:["tw-absolute",t.calcColorLogoStyleClass,t.calcVisibilityClass]}),t._v(" "),e("button",{staticClass:"tw-fixed tw-z-20 tw-inset-0 tw-h-sreen tw-w-screen tw-min-w-screen tw-bg-transparent focus:tw-outline-none tw-cursor-default"})])}),[],!1,null,"70116b3e",null).exports}}]);
//# sourceMappingURL=9974.js.map