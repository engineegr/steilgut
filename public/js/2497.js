"use strict";(self.webpackChunksteilgut_s_test002=self.webpackChunksteilgut_s_test002||[]).push([[2497],{4527:(n,t,a)=>{a.d(t,{Z:()=>o});var e=a(7897),s=a.n(e),l=a(1519),i=a.n(l)()(s());i.push([n.id,".zero-opacity-img[data-v-1cedaa5a]{opacity:0}.full-opacity-img[data-v-1cedaa5a]{opacity:1}","",{version:3,sources:["webpack://./resources/js/shared/components/SyncLazyLoadImageArrayComp.vue"],names:[],mappings:"AAmSA,mCACC,SAlSD,CAqSA,mCACC,SAlSD",sourcesContent:["\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n.zero-opacity-img {\n\topacity: 0;\n}\n\n.full-opacity-img {\n\topacity: 1;\n}\n"],sourceRoot:""}]);const o=i},2497:(n,t,a)=>{a.r(t),a.d(t,{default:()=>g});var e=a(1031);const s={mixins:[a(5047).Z],components:{"sync-lazy-load-image-comp":function(){return a.e(1284).then(a.bind(a,1284))},"background-shadow-comp":e.default},props:{imagePropertyList:{type:Array,default:[{basedLazyImgStyleClass:"lazy-img",basedPortraitLazyImgStyleClass:"portrait-contact-pg-lazy-img",basedLandscapeLazyImgStyleClass:"landscape-contact-pg-lazy-img",basedDesktopLazyImgStyleClass:"desktop-contact-pg-lazy-img",controlLazyImgStyleClass:"control-lazy-img",controlLazyImgStyleList:"",lazyLoadCommonImgStyleClass:"md:tw-absolute landscape:tw-fixed tw-fixed tw-top-0 tw-bottom-0 tw-object-fill tw-max-h-full tw-h-full",lazyLoadImgStyleClass_4_3:"md:tw-absolute landscape:tw-fixed tw-fixed tw-inset-0 tw-object-cover",transitionImgStyleClass_4_3:"fade-inOut-opacity",lazyLoadImgStyleClass_16_9:"md:tw-absolute landscape:tw-fixed tw-fixed tw-inset-0 tw-object-cover",transitionImgStyleClass_16_9:"fade-inOut-opacity",relativePath:"contact-pg",baseName:"bg-map-contact-pg",imgExt_4_3:".png",imgExt_16_9:".png",isHidden:!1}]},basedLazyImgStyleClass:{type:[String],default:"bg-contact-pg"},backZIndexStyleClass:{type:[String],default:"tw-z-n-2"},atSurfaceZindexStyleClass:{type:[String],default:"tw-z-n-1"},lazyLoadCommonImgStyleClass:{type:[String],default:"tw-absolute tw-inset-0 tw-object-cover"},lqipStyleClass_4_3:{type:[String],default:"tw-absolute tw-inset-0 tw-object-cover tw-h-full tw-max-h-full tw-w-full tw-max-w-full"},lqpiTransitionImgStyleClass_4_3:{type:[String],default:"fade-inOut-opacity"},lqipStyleClass_16_9:{type:[String],default:"tw-absolute tw-inset-0 tw-object-cover tw-h-full tw-max-h-full tw-w-full tw-max-w-full"},lqpiTransitionImgStyleClass_16_9:{type:[String],default:"fade-inOut-opacity"},baseName:{type:[String]},lqipPath_4_3:{type:[String]},lqipPath_16_9:{type:[String]},imgExt_4_3:{default:".png",type:[String]},imgExt_16_9:{default:".png",type:[String]}},data:function(){return{imgLoadingStatusBits:[],isFullyLoaded:!1}},created:function(){for(var n=0;n<this.imagePropertyList.length;n++)this.imgLoadingStatusBits[n]=this.imagePropertyList[n].isHidden?1:0;console.info("info [SyncLazyLoadImageArrayComp::created] Length "+this.imgLoadingStatusBits.length)},methods:{handleStartLoadingImgEvent:function(n,t){t>=this.imgLoadingStatusBits.length&&console.warn("Warn [SyncLazyLoadImageArrayComp::handleStartLoadingImgEvent] index "+t),this.imgLoadingStatusBits[t]=0},handleStopLoadingImgEvent:function(n,t){t>=this.imgLoadingStatusBits.length&&console.warn("Warn [SyncLazyLoadImageArrayComp::handleStopLoadingImgEvent] index "+t),this.imgLoadingStatusBits[t]=1,this.isFullyLoaded=this.ifFullyLoaded(),this.isFullyLoaded&&this.$emit("fully-loaded-img-list-event",n)},calcForgeryImgZIndexStyleClass:function(){return this.isFullyLoaded?[this.backZIndexStyleClass,"zero-opacity-img"]:[this.atSurfaceZindexStyleClass]},ifFullyLoaded:function(){for(var n=0,t=0;t<this.imagePropertyList.length;t++)this.imagePropertyList[t].isHidden&&(this.imgLoadingStatusBits[t]=1),n+=this.imgLoadingStatusBits[t];return console.log("Debug [SyncLazyLoadImageArrayComp::ifFullyLoaded] summary "+n),n===this.imgLoadingStatusBits.length}},computed:{}};var l=a(3379),i=a.n(l),o=a(4527),y={insert:"head",singleton:!1};i()(o.Z,y);o.Z.locals;const g=(0,a(1900).Z)(s,(function(){var n=this,t=n.$createElement,a=n._self._c||t;return a("div",[n.imagePropertyList?a("div",{staticClass:"sync-lazy-load-image-array"},[n._l(n.imagePropertyList,(function(t,e){return a("div",{key:e+"_syncLazyLoadImgItem"},[a("sync-lazy-load-image-comp",{attrs:{keyIndex:e,isFullyLoaded:n.isFullyLoaded,isHidden:t.isHidden,basedLazyImgStyleClass:""+t.basedLazyImgStyleClass,basedPortraitLazyImgStyleClass:t.basedPortraitLazyImgStyleClass,basedLandscapeLazyImgStyleClass:t.basedLandscapeLazyImgStyleClass,basedDesktopLazyImgStyleClass:t.basedDesktopLazyImgStyleClass,portraitControlLazyImgStyleClass:t.portraitControlLazyImgStyleClass,landscapeControlLazyImgStyleClass:t.landscapeControlLazyImgStyleClass,controlLazyImgStyleClass:t.controlLazyImgStyleClass,portraitControlLazyImgStyleList:t.portraitControlLazyImgStyleList,landscapeControlLazyImgStyleList:t.landscapeControlLazyImgStyleList,controlLazyImgStyleList:t.controlLazyImgStyleList,lazyLoadCommonImgStyleClass:t.lazyLoadCommonImgStyleClass,lazyLoadImgStyleClass_4_3:t.lazyLoadImgStyleClass_4_3,transitionImgStyleClass_4_3:t.transitionImgStyleClass_4_3,lazyLoadImgStyleClass_16_9:t.lazyLoadImgStyleClass_16_9,transitionImgStyleClass_16_9:t.transitionImgStyleClass_16_9,relativePath:t.relativePath,baseName:t.baseName},on:{"start-loading-img-event":n.handleStartLoadingImgEvent,"stop-loading-img-event":n.handleStopLoadingImgEvent}})],1)})),n._v(" "),n.is4_3AspectRatio()?a("div",[a("img",{class:[n.basedLazyImgStyleClass+"_fogery-4_3-img",n.lazyLoadCommonImgStyleClass,n.lqipStyleClass_4_3,n.lqpiTransitionImgStyleClass_4_3,n.calcForgeryImgZIndexStyleClass()],attrs:{src:n.lqipPath_4_3}})]):n.is16_10AspectRatio()||n.is16_9AspectRatio()?a("div",[a("img",{class:[n.basedLazyImgStyleClass+"_fogery-16_9-img",n.lazyLoadCommonImgStyleClass,n.lqipStyleClass_16_9,n.lqpiTransitionImgStyleClass_16_9,n.calcForgeryImgZIndexStyleClass()],attrs:{src:n.lqipPath_16_9}})]):n._e(),n._v(" "),a("background-shadow-comp",{staticClass:"tw-fixed",attrs:{zIndexClass:"tw-z-1"}})],2):a("div",[a("h1",{staticClass:"centered-msg tw-text-steilgut-history-text-gold"},[n._v("\n\t\t\t\t"+n._s(n.__("formalMessages.loadingMsg"))+"\n\t\t\t")])])])}),[],!1,null,"1cedaa5a",null).exports}}]);
//# sourceMappingURL=2497.js.map