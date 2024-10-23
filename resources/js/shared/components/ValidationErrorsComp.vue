<template>
	<div>
		<div class="invalid-field" v-for="(error, index) in errors" :key="key(index)">
			{{ error }}
		</div>
	</div>
</template>

<script>
export default {
	props: ["errors"],
	methods: {
		key(index) {
			return `validation_error_${index}_${Math.random()}`;
		},
	},
};
</script>

<style lang="scss" scoped>
.user-field.is-invalid-field ~ div > .invalid-field {
	display: block;
	color: #ff6660 !important;
	font-family: "steilgut_cormorant";
	font-weight: 100;
	line-height: calc(0.7em + 0.7vmin);
	margin: 0.5vmin 0;
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.user-field.is-invalid-field ~ div > .invalid-field {
		font-size: calc(0.8em + 0.8vh) !important;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.user-field.is-invalid-field ~ div > .invalid-field {
		line-height: 2.5vh !important;
		line-height: calc(var(--100vh, 1vh) * 2.5) !important;
	}
}

@media only screen and (min-width: 1025px) and (orientation: landscape) {
	div.invalid-field {
		font-size: calc(0.4em + 0.8vmin) !important;
	}
	/* Safari only */
	@media not all and (min-resolution: 0.001dpcm) and (-webkit-min-device-pixel-ratio: 0) {
		@supports (-webkit-appearance: none) {
			div.invalid-field {
				font-size: calc(0.4em + 0.6vmin) !important;
			}
		}
	}
}
</style>
