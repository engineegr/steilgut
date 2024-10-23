<template>
	<div class="upload-box tw-rounded-lg tw-overflow-hidden tw-shadow-lg">
		<img
			:src="image"
			class="tw-object-scale-down"
			:class="['upload-box-img', isOldImageHidden ? 'tw-hidden' : '']"
		/>
		<input
			type="hidden"
			name="oldItemImagePath"
			:value="image"
		>
		<img
			:src="newImage"
			class="tw-object-scale-down"
			:class="['upload-box-img', !isOldImageHidden ? 'tw-hidden' : '']"
		/>

		<div class="message-box tw-m-2">
			<div v-if="isNewImageReading">
				<div class="alert alert-info tw-m-3">
					<h1>Loading image...</h1>
				</div>
			</div>
			<div v-if="ifErrors">
				<div
					v-for="i in errorMessages"
					:key="`${i}_image_item`"
				>
					<div class="alert alert-danger tw-m-3">
						<h2>{{ errorMessage }}</h2>
					</div>
				</div>
			</div>
		</div>

		<div
			v-if="!ifReadOnly"
			class="upload-box-content tw-flex tw-w-full tw-h-screen tw-items-center tw-justify-center tw-bg-grey-lighter tw-opacity-50"
		>
			<label class="tw-w-64 tw-absolute tw-flex tw-flex-col tw-items-center tw-px-4 tw-py-6 tw-bg-white tw-text-blue-500 tw-rounded-lg tw-shadow-lg tw-tracking-wide tw-uppercase tw-border tw-border-blue-500 tw-cursor-pointer hover:tw-bg-blue-500 hover:tw-text-white">
				<svg
					class="tw-w-8 tw-h-8"
					fill="currentColor"
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 20 20"
				>
					<path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
				</svg>
				<span class="tw-mt-2 tw-text-base tw-leading-normal">Select a file</span>
				<input
					type="file"
					name="itemImage"
					class="tw-hidden"
					v-on:change="handleImageChange($event)"
					accept=".png,.jpeg, image/jpeg, image/png"
					alt="News image"
				/>
			</label>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		readonly: {
			type: Boolean,
		},
		image: {
			type: String,
		},
	},

	data: function () {
		return {
			isNewImageReading: false,
			errorMessages: [],
			isOldImageHidden: false,
			newImage: undefined,
		};
	},

	created() {
		console.log("Debug [ UploadImageBox:created ]");
	},

	computed: {
		ifReadOnly: function () {
			return this.isReadOnly;
		},

		ifErrors: function () {
			return this.errorMessage && this.errorMessage.length > 0;
		},
	},

	methods: {
		handleImageChange: function (event) {
			this.errorMessages = [];
			if (event.target.files.length > 1) {
				this.errorMessages.push(
					"Error [ResponsiveUploadImageBoxComp:handleImageChange]: too many files selected " +
					event.target.files.length
				);
			} else {
				this.isNewImageReading = true;
				this.$_checkAndLoadImage(event.target.files[0]);
			}
			event.preventDefault();
		},

		$_checkAndLoadImage: function (aFile) {
			const toBase64 = new Promise((resolve, reject) => {
				const aFileReader = new FileReader();
				aFileReader.readAsDataURL(aFile);
				aFileReader.onload = () => {
					var image = new Image();
					image.src = aFileReader.result;
					const self = this;
					image.onload = function (params) {
						const helper = self.$root.$data.helper;
						if (
							self.ratio !=
							helper.getAspectRatioByDimension(this.width, this.height)
						) {
							return reject(
								"Error [ResponsiveUploadImageBoxComp:$_checkAndLoadImage] Invalid image ratio"
							);
						}
						return resolve(aFileReader.result);
					};
				};
				aFileReader.onerror = (error) => {
					return reject(error);
				};
			});

			const result = toBase64
				.then((aFileReadResult) => {
					let prefix = "";
					const regExpJpeg = /^(.*.jpeg)$/;
					const regExpJpg = /^(.*.jpg)$/;
					const regExpPng = /^(.*.png)$/;

					const validImg =
						regExpJpeg.test(aFile.name) ||
						regExpJpg.test(aFile.name) ||
						regExpPng.test(aFile.name);

					if (!validImg) {
						this.errorMessages.push(
							"Error [ResponsiveUploadImageBoxComp:handleImageChange]: Unknown image type " +
							aFile.name
						);
					} else {
						this.newImage = aFileReadResult;
					}
					this.isOldImageHidden = true;
					this.isNewImageReading = false;
				})
				.catch((errMsg) => {
					this.errorMessages.unshift(errMsg);
					this.isOldImageHidden = true;
					this.isNewImageReading = false;
				});
		},
	},
};
</script>

<style scoped>
.upload-box-img {
	max-height: 60vh;
	height: 60vh;
}
</style>