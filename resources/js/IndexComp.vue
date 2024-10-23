<template>
    <div id="app-index" class="index fp tw-antialiased md:tw-overflow-auto">
        <router-view></router-view>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.index {
    display: block;
    margin: auto;
    align-content: stretch;
    height: 100%;
    min-height: 100%;
    max-width: 100%;
    width: 100%;
    overflow: auto;
}

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 896px) {
    .index {
        display: flex;
        flex: 1 0 auto;
        justify-content: center;
        align-content: stretch;
        height: 100%;
        min-height: 100%;
        max-width: 100%;
        width: 100%;
    }
}
</style>
