require('./bootstrap');
import VueModule from 'vue';
window.Vue = VueModule;

import router from './routes';
import VueRoute from 'vue-router';
import Vuex from 'vuex';
import VueTouch from 'vue-touch';

import { Lang } from 'laravel-vue-lang';

import IndexComp from './IndexComp';
import LangSwitchComp from './app/LangSwitchComp';
import LazyLoadImageComp from "./shared/components/LazyLoadComplexImageComp.vue";
import ResponsiveImageComp from "./shared/components/ResponsiveImageComp.vue";

const portableNavBarComp = () => import( /* webpackPrefetch: true */ './shared/components/PortableNavBarComp');
const fullScreenVideoComp = () => import( /* webpackPrefetch: true */ './shared/components/FullScreenVideoComp');
const errorComp = () => import( /* webpackPrefetch: true */ './shared/components/ErrorComp');
const validationErrorsComp = () => import( /* webpackPrefetch: true */ './shared/components/ValidationErrorsComp');
const tooltipComp = () => import( /* webpackPrefetch: true */ './shared/components/TooltipComp');
const lazyLoadPictureComp = () => import( /* webpackPrefetch: true */ "./shared/components/LazyLoadPictureComp");

import storeDefinition from './store';
import { Helper } from "./shared/utils/helper";

(function () {
	// debugger;
	Vue.use(VueRoute);
	Vue.use(Vuex);
	Vue.use(VueTouch, { name: 'v-touch' });

	const store = new Vuex.Store(storeDefinition);
	// Register the lang plugin
	const htmlLocale = document.getElementsByTagName('html')[0].getAttribute('lang');
	Vue.use(Lang, {
		locale: htmlLocale,
		fallback: 'ru',
	});

	Vue.component('lang-switch', LangSwitchComp);
	Vue.component('lazy-load-image-comp', LazyLoadImageComp);
	Vue.component('responsive-image-comp', ResponsiveImageComp);
	Vue.component('full-video-screen-comp', fullScreenVideoComp);
	Vue.component('error-comp', errorComp);
	Vue.component('tooltip-comp', tooltipComp);
	Vue.component('validation-error', validationErrorsComp);
	Vue.component('portable-navbar', portableNavBarComp);
	Vue.component('lazy-load-picture', lazyLoadPictureComp);

	// Internal state
	class StateStore {
		constructor() {
			this.fullDocHeight = undefined;
			this.fullDocWidth = undefined;

			this.controlPanelState = {
				tumbler: [
					{
						linkUrl: '/masthead/store',
						bgUrl: 'bg - mh - 000',
						turnOn: true
					},
					{
						linkUrl: 'http://ya.ru',
						bgUrl: 'bg - mh - 001',
						turnOn: false
					},
					{
						linkUrl: '/masthead/philosophy/handwork100',
						bgUrl: 'bg - mh - 002',
						turnOn: false
					},
					{
						linkUrl: '/masthead/philosophy/biodiversity',
						bgUrl: 'bg - mh - 003',
						turnOn: false
					},
					{
						linkUrl: '/masthead/degustation',
						bgUrl: 'bg - mh - 004',
						turnOn: false
					},
				],
				cursor: 0,
			};

			this.mastheadState = {
				prevBgCursor: undefined,
				isMobileMenuOpen: false,
			};

			this.winesCatalogState = {
				wines: undefined,
				page: 1,
				winesPerPage: 2,
				count: 0,
				isCreated: false,
				isShortWineDescription: true,
				selectedWineKey: undefined,
			};

			this.winesPaginator = {
				from: 1,
			};

			this.newsState = {
				news: undefined,
				page: 1,
				newsPerPageQuantity: 2,
				quantity: 0,
				isCreated: false,
				selectedKey: undefined,
			};

			this.newsPaginator = {
				from: 1,
			};
		}

		//
		// Masthead getter/setter method
		//
		get mastheadPrevBgCursor() {
			return this.mastheadState.prevBgCursor;
		}

		set mastheadPrevBgCursor(prevBgCursor) {
			this.mastheadState.prevBgCursor = prevBgCursor;
		}

		get mastheadIsMobileMenuOpen() {
			return this.mastheadState.isMobileMenuOpen;
		}
		set mastheadIsMobileMenuOpen(isMobileMenuOpen) {
			this.mastheadState.isMobileMenuOpen = isMobileMenuOpen;
		}

		//
		// Control Panel getter/setter method
		//
		get controlPanelTumbler() {
			return this.controlPanelState.tumbler;
		}

		set controlPanelTumbler(_controlPanelTumbler) {
			this.controlPanelState.tumbler = _controlPanelTumbler;
		}

		get controlPanelCursor() {
			return this.controlPanelState.cursor;
		}

		set controlPanelCursor(cursor) {
			this.controlPanelState.cursor = cursor;
		}

		//
		//  Wine catalog getter/setter method
		//

		get winesCatalogList() {
			return this.winesCatalogState.wines;
		}
		set winesCatalogList(wines) {
			this.winesCatalogState.wines = wines;
		}

		get winesCatalogPage() {
			return this.winesCatalogState.page;
		}
		set winesCatalogPage(page) {
			this.winesCatalogState.page = page;
		}

		get winesCatalogWinesPerPage() {
			return this.winesCatalogState.winesPerPage;
		}
		set winesCatalogWinesPerPage(winesPerPage) {
			this.winesCatalogState.winesPerPage = winesPerPage;
		}

		get winesCatalogCount() {
			return this.winesCatalogState.count;
		}
		set winesCatalogCount(count) {
			this.winesCatalogState.count = count;
		}

		get winesCatalogCreated() {
			return this.winesCatalogState.isCreated;
		}
		set winesCatalogCreated(isCreated) {
			this.winesCatalogState.isCreated = isCreated;
		}

		get winesCatalogIfShortDescription() {
			return this.winesCatalogState.isShortWineDescription;
		}
		set winesCatalogIfShortDescription(isShortDescription) {
			this.winesCatalogState.isShortWineDescription = isShortDescription;
		}

		get winesCatalogSelectedWineKey() {
			return this.winesCatalogState.selectedWineKey;
		}
		set winesCatalogSelectedWineKey(selectedWineKey) {
			this.winesCatalogState.selectedWineKey = selectedWineKey;
		}

		//
		// Wines paginator 
		//
		get winesPaginatorFrom() {
			return this.winesPaginator.from;
		}
		set winesPaginatorFrom(from) {
			this.winesPaginator.from = from;
		}

		//
		// News
		//
		get newsList() {
			return this.newsState.news;
		}
		set newsList(news) {
			this.newsState.news = news;
		}
		get newsPage() {
			return this.newsState.page;
		}
		set newsPage(page) {
			this.newsState.page = page;
		}

		get newsPerPageQuantity() {
			return this.newsState.newsPerPageQuantity;
		}
		set newsPerPageQuantity(newsPerPageQuantity) {
			this.newsState.newsPerPageQuantity = newsPerPageQuantity;
		}

		get newsQuantity() {
			return this.newsState.quantity;
		}
		set newsQuantity(quantity) {
			this.newsState.quantity = quantity;
		}
		get newsCreated() {
			return this.newsState.isCreated;
		}
		set newsCreated(isCreated) {
			this.newsState.isCreated = isCreated;
		}

		get newsSelectedItemKey() {
			return this.newsState.selectedItemKey;
		}
		set newsSelectedItemKey(selectedItemKey) {
			this.newsState.selectedItemKey = selectedItemKey;
		}

		//
		// News paginator 
		//
		get newsPaginatorFrom() {
			return this.newsPaginator.from;
		}
		set newsPaginatorFrom(from) {
			this.newsPaginator.from = from;
		}

	}

	const app = new Vue({
		el: '#app',
		router,
		store,

		components: {
			'index': IndexComp,
			'full-page': () => import('./tests/FullPageComp.vue'),
		},
		data: function () {
			return {
				bgUrl: '',
				stateStore: new StateStore(),
				helper: Helper,
			};
		},
		beforeCreate() {
			this.$store.dispatch('loadStoredState');
		},

	}).$mount('#app');

	if (window.STEILGUT_VAR_STORE) {
		window.STEILGUT_VAR_STORE['VUE_APP_INSTANCE'] = app;
	}
}());