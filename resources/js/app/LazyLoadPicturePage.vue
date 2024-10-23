<template>
	<full-screen-temp-comp>
		<lazy-load-picture-comp
			image="/images/pictures/wine-bottles/sudwand.png"
			boxWidth="auto"
			boxHeight="100vh"
			placeholderClass="placeholder"
		>
		</lazy-load-picture-comp>
	</full-screen-temp-comp>
</template>

<script>
import FullScreenTempComp from "../shared/components/FullScreenTempComp";
import LazyLoadPictureComp from "../shared/components/LazyLoadPictureComp";
export default {
	components: {
		"full-screen-temp-comp": FullScreenTempComp,
		"lazy-load-picture-comp": LazyLoadPictureComp,
	},
	data: function () {
		return {
			bgUrl: "",
		};
	},
};
</script>

<style lang="scss">
.placeholder {
	background-color: #c4bbaa;
}
</style>

<style lang="scss" scoped></style>
