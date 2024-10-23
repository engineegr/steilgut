import VueRouter from 'vue-router';
import PrecautionComp from './app/PrecautionComp';

const mastheadComp = () => import( /* webpackPreload: true */ './app/MastheadComp');
const controlPanelComp = () => import( /* webpackPreload: true */ './app/ControlPanelComp');
const newsPageComp = () => import(/* webpackPrefetch: true */ './app/news/NewsPageComp');
const newsBodyComp = () => import( /* webpackPrefetch: true */'./app/news/NewsBodyComp');
const steilgutHistorySliderComp = () => import(/* webpackPrefetch: true */ './app/steilgutHistory/SteilgutHistorySliderComp');
const winesSliderComp = () => import( /* webpackPrefetch: true */ './app/wines/WinesSliderComp');
const storeSliderComp = () => import( /* webpackPrefetch: true */ './app/store/StoreSliderComp');
const winesCartSliderComp = () => import(/* webpackPrefetch: true */'./app/cart/WinesCartSliderComp.vue');
const orderComp = () => import(/* webpackPrefetch: true */'./app/cart/OrderComp.vue');
const paymentComp = () => import(/* webpackPrefetch: true */'./shared/components/order/PaymentComp.vue');
const deliveryComp = () => import(/* webpackPrefetch: true */'./shared/components/order/DeliveryComp.vue');
// const stripe3DSecureComp = () => import(/* webpackPrefetch: true */'./shared/components/stripe/Stripe3DSecureComp.vue');
const orderFinalizationComp = () => import(/* webpackPrefetch: true */'./shared/components/order/FinalizationComp.vue');
const legalComp = () => import(/* webpackPrefetch: true */'./shared/components/legal/LegalComp.vue');
const contactsPageComp = () => import(/* webpackPrefetch: true */'./app/contacts/ContactsPageComp');
const notFoundComp = () => import(/* webpackPrefetch: true */'./app/NotFoundComp');
// const terroirMapComp = () => import(/* webpackPrefetch: true */"./app/terroir/TerroirMapComp.vue");
const calmontTerroirComp = () => import(/* webpackPrefetch: true */"./app/terroir/CalmontTerroirComp.vue");
const frauenbergNeeferTerroirComp = () => import(/* webpackPrefetch: true */"./app/terroir/NeeferFrauenbergTerroirComp.vue");
const nasleiTerroirComp = () => import(/* webpackPrefetch: true */"./app/terroir/NasleiTerroirComp.vue");

const philipAndIrinaComp = () => import(/* webpackPrefetch: true */"./app/PhilipAndIrinaComp.vue");
const degustationComp = () => import(/* webpackPrefetch: true */"./app/DegustationComp.vue");

const inspirationComp = () => import(/* webpackPrefetch: true */"./app/InspirationComp.vue");
const handwork100Comp = () => import(/* webpackPrefetch: true */"./app/philosophy/Handwork100Comp.vue");
const biodiversityComp = () => import(/* webpackPrefetch: true */"./app/philosophy/BiodiversityComp.vue");

const steilgutClubComp = () => import(/* webpackPrefetch: true */"./app/SteilgutClubComp.vue");

const responsiveImageUploadPageComp = () => import(/* webpackPrefetch: true */"./app/ResponsiveImageUploadPage.vue");
const lazyloadPicturePageComp = () => import(/* webpackPrefetch: true */"./app/LazyLoadPicturePage.vue");

function isStartRequirementConfirmed() {
	let steilgutLocalStrState = localStorage.getItem('STEILGUT');
	if (!steilgutLocalStrState) {
		localStorage.setItem('STEILGUT', JSON.stringify({ is18AgeOld: false }));
		return false;
	} else {
		const steilgutLocalState = JSON.parse(steilgutLocalStrState);
		if (!steilgutLocalState.is18AgeOld) {
			const currPath = window.location.pathname;

			if (currPath === '/') {
				return false;
			}

			const mastheadRegExp = /\/masthead\/.*/;
			const loginRegExp = /\/login/;
			const logoutRegExp = /\/logout/;
			const passwordRegExp = /\/password\/.*/;
			const registerRegExp = /\/register\/.*/;
			const cmsRegExp = /\/cms\/.*/;
			const localesRegExp = /\/locales\/.*/;
			const dropDownRegExp = /\/dropDownBox.*/;
			const navBarRegExp = /\/navBar.*/;
			const newsRegExp = /\/news.*/;
			const fullVideoRegExp = /\/fullVideo.*/;
			const steilgutHistorySlider = /\/steilgutHistorySlider.*/;
			const winesSlider = /\/winesSlider.*/;
			const fullPage = /\/fullPage.*/;
			const lliPage = /\/lliPage.*/;
			const gMapPageRegExp = /\/gMapPage.*/;
			const pulseLogoExp = /\/pulseLogo.*/;
			const legalPageExp = /\/legal.*/;

			const ifDenyToPathChange = [
				mastheadRegExp,
				loginRegExp, logoutRegExp, passwordRegExp,
				registerRegExp, cmsRegExp, localesRegExp,
				dropDownRegExp, navBarRegExp, newsRegExp,
				fullVideoRegExp, steilgutHistorySlider, winesSlider,
				fullPage, lliPage, gMapPageRegExp, pulseLogoExp, legalPageExp
			].some((regExp) => {
				return regExp.test(currPath);
			});
			return !ifDenyToPathChange;
		} else {
			return true;
		}
	}
	return false;
}

const routes = [
	{
		path: '/', component: PrecautionComp, name: 'precaution', props: {
			isDesktopAspectRatioCorrection: true,
		}
	},

	{
		path: '/masthead',
		component: mastheadComp,
		props: {
			isDesktopAspectRatioCorrection: true,
		},
		children: [
			{
				path: 'control-panel',
				name: 'controlPanel',
				component: controlPanelComp,
			},
			{
				path: 'wines',
				component: winesSliderComp,
			},
			{
				path: 'store',
				name: 'store',
				component: storeSliderComp,
			},
			{
				path: 'wines-cart',
				name: 'winesCart',
				component: winesCartSliderComp,
			},
			{
				path: 'order',
				name: 'order',
				component: orderComp,
				children: [
					{
						path: 'delivery',
						name: 'delivery',
						component: deliveryComp,
					},
					{
						path: 'payment',
						name: 'payment',
						component: paymentComp,
						props: true,
					},
					// {
					// 	path: 'stripe3DSecure',
					// 	name: 'payment-stripe3DSecure',
					// 	component: stripe3DSecureComp,
					// 	props: true,
					// },
				]
			},
			{
				path: 'order-finallization',
				name: 'order-finallization',
				component: orderFinalizationComp,
				props: true,
			},
			{
				name: 'news',
				path: 'news',
				component: newsPageComp,
				props: true,
			},
			{
				path: 'news-body/:id',
				name: 'showNewsBody',
				component: newsBodyComp,
				props: true,
			},
			{
				path: 'steilgutHistorySlider',
				name: 'steilgutHistorySlider',
				component: steilgutHistorySliderComp,
			},
			{
				path: 'contacts',
				name: 'contactsPage',
				component: contactsPageComp,
			},

			{
				path: 'legal/:name',
				name: 'legalPage',
				component: legalComp,
				props: true,
			},

			// {
			// 	path: 'terroir/map',
			// 	name: 'terroirMapPage',
			// 	component: terroirMapComp,
			// 	props: true,
			// },

			{
				path: 'terroir/calmont',
				name: 'calmontTerroirPage',
				component: calmontTerroirComp,
				props: true,
			},

			{
				path: 'terroir/frauenbergNeefer',
				name: 'frauenbergNeeferTerroirPage',
				component: frauenbergNeeferTerroirComp,
				props: true,
			},

			{
				path: 'terroir/naslei',
				name: 'nasleiTerroirPage',
				component: nasleiTerroirComp,
				props: true,
			},

			{
				path: 'philipAndIrina',
				name: 'philipAndIrinaPage',
				component: philipAndIrinaComp,
			},

			{
				path: 'degustation',
				name: 'degustationPage',
				component: degustationComp,
			},

			{
				path: 'inspiration',
				name: 'inspirationPage',
				component: inspirationComp,
			},

			{
				path: 'philosophy/handwork100',
				name: 'handwork100PhilosophyPage',
				component: handwork100Comp,
				props: true,
			},

			{
				path: 'philosophy/biodiversity',
				name: 'biodiversityPage',
				component: biodiversityComp,
				props: true,
			},

			{
				path: 'steilgutClub',
				name: 'steilgutClubPage',
				component: steilgutClubComp,
			},
		]
	},

	{
		path: '/legal/:name',
		name: 'cookiesLegalPage',
		component: legalComp,
		props: true,
	},

	{
		path: '/test/fsUploadImg',
		name: 'testFsUploadImgPage',
		component: responsiveImageUploadPageComp,
	},

	{
		path: '/test/lazyPicture',
		name: 'lazyloadPicturePage',
		component: lazyloadPicturePageComp,
	},

	{ path: '*', component: notFoundComp },
];

const router = new VueRouter({
	mode: 'history',
	routes,
});

router.beforeEach((to, from, next) => {
	("use strict");
	const ifStartRequirementConfirmed = isStartRequirementConfirmed();
	if (from['name'] === 'precaution' || to['name'] === 'precaution') {
		if (to['name'] === 'precaution' && ifStartRequirementConfirmed) {
			next({
				name: 'controlPanel',
			});
		} else {
			next();
		}
	} else {
		if (!ifStartRequirementConfirmed) {
			next({
				name: 'precaution',
			});
		} else {
			next();
		}
	}
});

export default router;
