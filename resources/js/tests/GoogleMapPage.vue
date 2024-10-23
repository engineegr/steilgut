<template>
    <div>
        <TravelMap class="travel-map" />
    </div>
</template>

<script>
import TravelMap from "../shared/components/map/TravelMap";

export default {
    name: "App",
    components: {
        TravelMap,
    },

    mounted() {
        console.log("Debug [GoogleMapPage] mounted");
    },
};
</script>

<style lang="scss" scoped>
.travel-map {
    height: 100%;
    width: 100%;
}
</style>
