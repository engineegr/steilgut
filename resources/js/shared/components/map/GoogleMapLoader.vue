<template>
	<div>
		<div
			class="google-map"
			ref="googleMap"
		></div>
		<template v-if="Boolean(this.google) && Boolean(this.map)">
			<slot
				:google="google"
				:map="map"
			/>
		</template>
	</div>
</template>

<script>
import { Loader } from '@googlemaps/js-api-loader';

export default {
	props: {
		mapConfig: Object,
		apiKey: String,
	},

	data() {
		return {
			google: null,
			map: null,
		};
	},

	async mounted() {
		try {
			const loader = new Loader({
				apiKey: this.apiKey,
			});
			this.google = await loader.load();
		} catch (error) {
			console.error("Error [GoogleMapLoader::mounted] Couldn't initialize Google Map Loader");
		} finally {
			this.initializeMap();
		}
	},

	methods: {
		initializeMap() {
			const mapContainer = this.$refs.googleMap;
			this.map = new this.google.maps.Map(mapContainer, this.mapConfig);

			let tmId;
			let isLoaded;

			function checkThenTriggerClick() {
				if (tmId) {
					clearTimeout(tmId);
				}
				// debugger;
				const fsControl = $(".gm-fullscreen-control");
				if (fsControl.length > 0) {
					// debugger;
					fsControl.trigger("click");
					isLoaded = true;
				} else {
					tmId = setTimeout(checkThenTriggerClick, 1000);
				}
			}
		},
	},
};
</script>

<style lang="scss" scoped>
.google-map {
	width: 100vw;
	min-height: 100vh;
}
</style>
