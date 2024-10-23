<template>
	<section class="video-bg">
		<video
			playsinline
			loop
			:autoplay="autoplay"
			:muted="muted"
			ref="video"
			preload="metadata"
			width="100%"
			height="100%"
			poster="/videos/lesse2020-poster-26s-hd.jpg"
		>
			<source
				v-for="(source, i) in sources"
				v-bind:key="`fullScreenVideo_${i}`"
				:src="source"
				:type="getMediaType(source)"
			/>
		</video>
		<div
			class="video-control"
			:class="{ 'dim-background': !isPlay }"
			v-on:click.prevent="handleControlClick($event)"
		>
			<div
				class="inner-video-control"
				v-on:mouseover.stop="handleMouseMove($event, true)"
				v-on:mouseleave.stop="handleMouseMove($event, false)"
			>
				<transition-group name="fade" class="inner-video-control">
					<div
						key="video-playpause"
						class="video-playpause"
						v-show="isControlShow || !isPlay"
					>
						<div
							class="transit-flex-box tw-max-h-full tw-cursor-pointer"
							v-if="isPlay"
						>
							<a v-on:click.prevent="pause($event)">
								<svg
									width="130px"
									height="130px"
									viewBox="0 0 130 130"
									preserveAspectRatio="none"
									version="1.1"
									xmlns="http://www.w3.org/2000/svg"
									xmlns:xlink="http://www.w3.org/1999/xlink"
								>
									<!-- Generator: Sketch 63 (92445) - https://sketch.com -->
									<title>icon/pause</title>
									<g
										id="Page-1"
										stroke="none"
										stroke-width="1"
										fill="none"
										fill-rule="evenodd"
									>
										<g
											id="Artboard"
											transform="translate(-287.000000, -60.000000)"
										>
											<g
												id="icon/pause"
												transform="translate(287.000000, 60.000000)"
											>
												<circle
													id="Oval"
													stroke="#C4BBAA"
													cx="65"
													cy="65"
													r="64.5"
												></circle>
												<g
													id="Group"
													transform="translate(51.000000, 48.000000)"
													fill="#C4BBAA"
												>
													<rect
														id="Rectangle"
														x="0"
														y="0"
														width="9"
														height="35"
													></rect>
													<rect
														id="Rectangle"
														x="20"
														y="0"
														width="9"
														height="35"
													></rect>
												</g>
											</g>
										</g>
									</g>
								</svg>
							</a>
						</div>
						<div
							class="transit-flex-box tw-max-h-full tw-cursor-pointer"
							v-show="isControlShow || !isPlay"
							v-else
						>
							<a v-on:click.prevent="play($event)">
								<svg
									width="130px"
									height="130px"
									preserveAspectRatio="none"
									viewBox="0 0 130 130"
									version="1.1"
									xmlns="http://www.w3.org/2000/svg"
									xmlns:xlink="http://www.w3.org/1999/xlink"
								>
									<!-- Generator: Sketch 63 (92445) - https://sketch.com -->
									<title>icon/play</title>
									<g
										id="Page-1"
										stroke="none"
										stroke-width="1"
										fill="none"
										fill-rule="evenodd"
									>
										<g
											id="Artboard"
											transform="translate(-37.000000, -60.000000)"
										>
											<g
												id="icon/play"
												transform="translate(37.000000, 60.000000)"
											>
												<circle
													id="Oval"
													stroke="#C4BBAA"
													cx="65"
													cy="65"
													r="64.5"
												></circle>
												<polygon
													id="Path"
													fill="#C4BBAA"
													fill-rule="nonzero"
													points="56 47 83.749479 64.8856437 56 82.772565"
												></polygon>
											</g>
										</g>
									</g>
								</svg>
							</a>
						</div>
					</div>
					<div
						key="video-input"
						class="video-input"
						v-show="isControlShow || !isPlay"
					>
						<div
							class="video-input-control tw-relative tw-max-w-xl tw-overflow-hidden tw-bg-transparent tw-cursor-pointer"
						>
							<div
								class="video-input-volume tw-w-full tw-h-full tw-bg-masthead-video-input-beige tw-opacity-50 tw-absolute"
								v-on:click.prevent="handleCursorChange($event, true)"
							></div>
							<div
								class="tw-h-full tw-bg-masthead-video-input-beige tw-absolute"
								:style="getInputVolumeStyle"
								v-on:click.prevent="handleCursorChange($event, false)"
							></div>
						</div>
					</div>
					<slot></slot>
				</transition-group>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	props: {
		sources: {
			type: Array,
			required: false,
			default: () => {
				return ["/videos/Lese2020.mp4"];
			},
		},
		img: {
			type: String,
		},
		muted: {
			type: Boolean,
			default: false,
		},
		autoplay: {
			type: Boolean,
			default: false,
		},
		controlAutohide: {
			type: Boolean,
			default: true,
		},

		controlAutohideTimeOut: {
			type: Number,
			default: 15000,
		},

		isBackgroundShadow: {
			type: [String, Boolean],
			default: true,
		},
	},
	data() {
		return {
			video: null,

			isPlay: this.autoplay,
			isPause: false,
			isStop: true,
			isControlShow: true,

			inputVolume: 0,
			videoPlayTimerId: null,
			autohideControlTimerId: null,
		};
	},

	mounted() {
		this.setImageUrl();
		if (this.videoCanPlay()) {
			this.$refs.video.addEventListener("canplay", () => {
				this.$refs.video.style.visibility = "visible";
			});

			this.$refs.video.addEventListener("loadedmetadata", () => {
				this.$refs.video.style.visibility = "visible";
			});
		}
		this.video = this.$refs.video;

		if (this.autoplay) {
			this.$_setProgressTimer(1000);
		}

		if (this.controlAutohide) {
			this.$_setAutohideControlTimer(this.controlAutohideTimeOut);
		}
	},

	beforeDestroy() {
		if (!!this.videoPlayTimerId) {
			clearTimeout(this.videoPlayTimerId);
		}

		if (!!this.autohideControlTimerId) {
			clearTimeout(this.autohideControlTimerId);
		}
	},

	computed: {
		getInputVolumeStyle() {
			return {
				width: this.inputVolume + "%",
			};
		},
	},

	methods: {
		play(event) {
			if (!this.isPlay) {
				this.isPlay = true;
				this.isPause = false;
				this.isStop = false;
				this.video.play();
				this.video.muted = this.muted;
				this.$_setProgressTimer(500);
				this.$_setAutohideControlTimer(this.controlAutohideTimeOut);
			}
			// console.log("Debug [ FullScreenVideoComp ] Press play");
		},

		stop(event) {
			if (this.isPlay) {
				this.video.stop();
				this.video.currentTime = 0;
				this.isPause = false;
				this.isStop = true;
				this.isPlay = false;

				if (!!this.videoPlayTimerId) {
					clearTimeout(this.videoPlayTimerId);
					this.videoPlayTimerId = null;
				}

				if (!!this.autohideControlTimerId) {
					clearTimeout(this.autohideControlTimerId);
					this.autohideControlTimerId = null;
				}
			}
			// console.log("Debug [ FullScreenVideoComp ] Press stop");
		},

		pause(event) {
			if (this.isPlay) {
				this.video.pause();
				this.isPlay = false;
				this.isPause = true;
				this.isStop = false;

				if (!!this.videoPlayTimerId) {
					clearTimeout(this.videoPlayTimerId);
					this.videoPlayTimerId = null;
				}
			}
			// console.log("Debug [ FullScreenVideoComp ] Press play");
		},

		handleCursorChange(event, isIncrease) {
			// console.log(
			// 	"Debug [ FullScreenVideoComp ] handleCursorChange is increase " +
			// 		isIncrease
			// );

			const volumeContainerRect = event.target.getBoundingClientRect();
			const leftVolContainerOffset = volumeContainerRect.left;
			const volumeContainerWidth = this.$_calcInputVolumeContainerWidth(
				event,
				isIncrease
			);
			const relXPos = event.pageX - leftVolContainerOffset;

			this.inputVolume = Math.ceil((relXPos / volumeContainerWidth) * 100);
			this.video.currentTime = (this.inputVolume * this.video.duration) / 100;
			// console.log(
			// 	"Debug [ FullScreenVideoComp ] handleCursorChangey: inputVolume % " +
			// 		this.inputVolume
			// );
		},

		handleControlClick(event) {
			// console.log("Debug [ FullScreenVideoComp ] handleControlMousemove");
			this.isControlShow = !this.isControlShow;
		},

		handleMouseMove(event, isMouseOver) {
			// console.log("Debug [ FullScreenVideoComp ] handleControlMousemove");
			this.isControlShow = isMouseOver;
		},

		videoCanPlay() {
			return !!this.$refs.video.canPlayType;
		},

		setImageUrl() {
			if (this.img) {
				this.$el.style.backgroundImage = `url(${this.img})`;
			}
		},

		getMediaType(src) {
			return "video/" + src.split(".").pop();
		},

		$_calcInputVolumeContainerWidth(event, isIncrease) {
			return isIncrease
				? event.target.getBoundingClientRect().width
				: document.getElementsByClassName("video-input-volume")[0].offsetWidth;
		},

		$_setProgressTimer(timeOut = 500) {
			const inputVolumeWidth = document.getElementsByClassName(
				"video-input-volume"
			)[0].offsetWidth;

			const vm = this;
			const duration = this.video.duration;
			this.videoPlayTimerId = setTimeout(function updateProgressTimer() {
				clearTimeout(vm.videoPlayTimerId);
				vm.videoPlayTimerId = null;

				vm.inputVolume = Math.ceil((vm.video.currentTime / duration) * 100);
				vm.videoPlayTimerId = setTimeout(updateProgressTimer, timeOut);
			}, timeOut);
		},

		$_setAutohideControlTimer(timeOut = 500) {
			const vm = this;
			this.autohideControlTimerId = setTimeout(
				function updateAutohideControlTimer() {
					clearTimeout(vm.autohideControlTimerId);
					vm.autohideControlTimerId = null;
					vm.isControlShow = false;

					vm.autohideControlTimerId = setTimeout(
						updateAutohideControlTimer,
						timeOut
					);
				},
				timeOut
			);
		},
	},
};
</script>

<style lang="scss" scoped>
.video-bg {
	position: relative;
	overflow: hidden;
	width: 100%;
	height: 100%;
	min-width: 100%;
	display: flex;
}

.video-bg video {
	position: absolute;
	visibility: hidden;
	min-width: 100%;
	min-height: 100%;
	width: 100%;
	height: 100%;
	object-fit: cover;
	background-repeat: no-repeat;
	background-position: center top;
	background-size: cover;
}

.video-control {
	position: relative;
	top: 0;
	left: 0;
	z-index: 20;
	min-width: 100%;
	height: 100%;
}

.inner-video-control {
	max-width: 100%;
	min-height: 100%;
	height: 100%;
	width: 100%;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;

	margin: 0;
	padding: 0;
}

.video-playpause {
	display: flex;
	min-height: 50%;
	height: 50%;
	justify-content: center;
	align-items: flex-end;
}

.video-input {
	height: 50%;
	width: 100%;
	min-width: 100%;
	display: flex;
	justify-content: flex-end;
	align-items: center;
	padding-right: 3.19rem;
}

.video-input-control {
	max-width: 40%;
	width: 40%;
	height: 0.5rem;
}

.dim-background {
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
	background-color: rgba(0, 0, 0, 0.4);
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	.video-input {
		align-items: flex-end;

		&-control {
			margin-bottom: 15.53vh;
			max-width: unset;
			width: 52.6%;
		}
	}

	.video-playpause {
		min-height: unset;
		height: auto;

		margin: auto auto 0 auto;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.video-bg {
		height: 100%;
		height: calc(var(--100vh, 1vh) * 100);
	}
	.video-bg video {
		min-height: 100%;
		min-height: calc(var(--100vh, 1vh) * 100);
		height: 100%;
		height: calc(var(--100vh, 1vh) * 100);
	}

	.video-control,
	.inner-video-control {
		min-height: 100%;
		min-height: calc(var(--100vh, 1vh) * 100);
		height: 100%;
		height: calc(var(--100vh, 1vh) * 100);
	}
}
</style>
