require('./bootstrap');


import VueModule from 'vue';
window.Vue = VueModule;

// import FullPageComp from "../tests/FullPageComp.vue";

(function () {
	function init() {

		// 	const demoApp = new Vue({
		// 		el: '#demo-app',
		// 		components: {
		// 			'index-comp': FullPageComp,
		// 		},

		// 		mounted() {
		// 		}
		// 	}).$mount('#demo-app');
		// }

		var scream,
			brim;

		gajus.Scream = window.V_SCREAM;

		if (platform.os.family == 'iOS' && parseInt(platform.os.version, 10) > 8 || platform.ua.indexOf('like Mac OS X') != -1) {
			scream = gajus.Scream({
				width: {
					portrait: 320,
					landscape: 896
				}
			});

			brim = gajus.Brim({
				viewport: scream
			});

			brim.on('viewchange', function (e) {
				document.body.className = e.viewName;
			});
		} else {
			document.querySelector('#not-ios-8').style.display = 'block';
		}
	}

	if (document.readyState === 'complete' || document.readyState === 'loaded' || document.readyState === "interactive") {
		init();
	} else {
		window.addEventListener('DOMContentLoaded', function () {
			init();
		});
	}

}());
