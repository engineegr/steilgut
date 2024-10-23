<template>
	<div
		class="responsive-upload-box tw-rounded-lg tw-overflow-hidden tw-shadow-lg"
		:style="{ width: boxWidth + 'px', height: boxHeight + 'px' }"
	>
		<img
			:src="image"
			v-if="image"
			class="tw-object-cover"
			:class="[
				'responsive-upload-box-img',
				isOldImageHidden ? 'tw-hidden' : '',
				bgImgClass,
			]"
		/>
		<input type="hidden" name="oldItemImagePath" :value="image" />
		<img
			:src="newImage"
			v-if="newImage"
			class="tw-object-cover"
			:class="[
				'responsive-upload-box-img',
				!isOldImageHidden ? 'tw-hidden' : '',
				bgImgClass,
			]"
		/>

		<div class="message-box tw-m-2 tw-w-full">
			<div v-if="isNewImageReading">
				<div class="alert alert-info tw-m-3">
					<h1 class="tw-text-green-700 tw-text-center">Loading image...</h1>
				</div>
			</div>
			<div v-if="ifErrors">
				<div v-for="(msg, index) in errorMessages" :key="`${index}_image_item`">
					<div class="alert alert-danger tw-m-3">
						<h2 class="tw-text-center">{{ msg }}</h2>
					</div>
				</div>
			</div>
		</div>

		<div
			v-if="!ifReadOnly"
			class="box-control tw-flex tw-w-full tw-h-auto tw-items-center tw-justify-center tw-bg-grey-lighter tw-opacity-50"
		>
			<label
				class="tw-w-64 tw-absolute tw-flex tw-flex-col tw-items-center tw-px-4 tw-py-6 tw-bg-white tw-text-blue-500 tw-rounded-lg tw-shadow-lg tw-tracking-wide tw-uppercase tw-border tw-border-blue-500 tw-cursor-pointer hover:tw-bg-blue-500 hover:tw-text-white"
			>
				<svg
					class="tw-w-8 tw-h-8"
					fill="currentColor"
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 20 20"
				>
					<path
						d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
					/>
				</svg>
				<span class="tw-mt-2 tw-text-center">{{
					title + " ( " + ratio + " )"
				}}</span>
				<input
					type="file"
					:name="pictureName"
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

		ratio: {
			type: String,
			default: "16/9",
		},

		boxWidth: {
			type: [Number, String],
			default: 800,
		},

		boxHeight: {
			type: [Number, String],
			default: 360,
		},

		pictureName: {
			type: [String],
			default: "picture_16_9",
		},

		bgImgClass: {
			type: [String],
			default: "tw-fixed",
		},

		title: {
			type: [String],
			default: "Choose a background image",
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

	computed: {
		ifReadOnly: function () {
			return this.isReadOnly;
		},

		ifErrors: function () {
			return this.errorMessages && this.errorMessages.length > 0;
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

<style scoped lang="scss">
.responsive-upload-box {
	position: relative;

	.message-box {
		position: absolute;
	}

	.box-control label {
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	&-img {
		height: 100%;
		width: 100%;

		position: absolute;
		z-index: -999;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}
}
</style>
