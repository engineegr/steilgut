<template>
	<div class="fs-empty-page">
		<slot></slot>
	</div>
</template>

<script>
export default {
	data: function () {
		return {};
	},
};
</script>

<style lang="scss" scoped>
.fs-empty-page {
	display: flex;
	flex-direction: column;
	justify-content: center;
	flex-wrap: nowrap;
	align-items: center;
	min-height: 100vh;
	max-width: 100vw;
	margin: 0;
	padding: 0;
}
</style>
