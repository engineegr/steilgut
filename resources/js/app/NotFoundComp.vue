<template>
	<div id="not-found" class="notfound-content bg-notfound-image">
		<!-- <h1>404 Page not found</h1> -->
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			bgUrl: "",
		};
	},
};
</script>

<style lang="scss" scoped>
.bg-notfound-image {
	display: flex;
	flex-direction: column;
	justify-content: center;
	flex-wrap: nowrap;
	align-items: center;
	min-height: 100vh;
	max-width: 100vw;
	margin: 0;
	padding: 0;
	background-image: url("images/bg - notfound.jpg");
	background-repeat: no-repeat;
	background-position: center;
	background-size: 100% auto;
	background-size: auto;
}
</style>
