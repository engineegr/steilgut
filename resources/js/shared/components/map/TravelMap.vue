<template>
	<!-- apiKey="AIzaSyB4M7J17ElccuGRn4T88JS2w4vNqV8TyrY" -->
	<GoogleMapLoader
		:mapConfig="mapConfig"
		apiKey="AIzaSyDgAUAyre3iRncREYroxt8fA-JDe6nyJz4"
	>
		<!-- insert your google maps api key to render styled map -->
		<template slot-scope="{ google, map }">
			<GoogleMapMarker
				v-for="marker in markers"
				:key="marker.id"
				:marker="marker"
				:google="google"
				:map="map"
			/>
		</template>
	</GoogleMapLoader>
</template>

<script>
import GoogleMapLoader from "./GoogleMapLoader";
import GoogleMapMarker from "./GoogleMapMarker";

import { mapSettings } from "./constants/mapSettings";

export default {
	components: {
		GoogleMapLoader,
		GoogleMapMarker,
	},

	data() {
		return {
			markers: [
				{
					id: "a",
					position: { lat: 50.09675180593459, lng: 7.120886756158978 }, //50.09675180593459, 7.120886756158978
					icon: null,
				},
			],
		};
	},

	computed: {
		mapConfig() {
			return {
				...mapSettings,
				center: this.mapCenter,
			};
		},

		mapCenter() {
			return this.markers[0].position;
		},
	},
};
</script>
