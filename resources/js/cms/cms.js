require('./bootstrap');
import VueModule from 'vue';
window.Vue = VueModule;

import CKEditor from 'ckeditor4-vue';
import { Lang } from 'laravel-vue-lang';
import { Helper } from "@/js/shared/utils/helper";

Vue.use(CKEditor);

const htmlLocale = document.getElementsByTagName('html')[0].getAttribute('lang');
Vue.use(Lang, {
	locale: htmlLocale,
	fallback: 'en',
});

import IndexComp from './IndexComp';
import UploadImageBoxComp from './components/UploadImageBoxComp';
import CKEditor4Comp from "./components/CKEditor4Comp.vue";
import DropDownDynListComp from "./components/DropDownDynListComp.vue";
import LangSwitchComp from "../app/LangSwitchComp.vue";
import ResponsiveImageComp from "@/js/shared/components/ResponsiveImageComp.vue";
import ResponsiveUploadImageBoxComp from "@/js/cms/components/ResponsiveUploadImageBoxComp.vue";

(function () {
	Vue.component('upload-image-box', UploadImageBoxComp).default;
	Vue.component('ckeditor4-comp', CKEditor4Comp).default;
	Vue.component('drop-down-dyn-list-comp', DropDownDynListComp).default;
	Vue.component('lang-switch-comp', LangSwitchComp).default;
	Vue.component('responsive-image-comp', ResponsiveImageComp).default;
	Vue.component('responsive-upload-image-box-comp', ResponsiveUploadImageBoxComp).default;

	const cmsApp = new Vue({
		el: '#cms-app',
		components: {
			'index': IndexComp,
		},
		beforeCreate() {
			console.log('Debug [cms-app] Before create');
		},

		data: function() {
			return {
				helper: Helper,
			}
		},
	}).$mount('#cms-app');
}());