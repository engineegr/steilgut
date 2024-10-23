<template>
	<full-screen-temp-comp>
		<responsive-upload-image-box-comp></responsive-upload-image-box-comp>
	</full-screen-temp-comp>
</template>

<script>
import FullScreenTempComp from "../shared/components/FullScreenTempComp";
import ResponsiveUploadImageBoxComp from "../cms/components/ResponsiveUploadImageBoxComp";
export default {
	components: {
		"full-screen-temp-comp": FullScreenTempComp,
		"responsive-upload-image-box-comp": ResponsiveUploadImageBoxComp,
	},
	data: function () {
		return {
			bgUrl: "",
		};
	},
};
</script>

<style lang="scss" scoped></style>
