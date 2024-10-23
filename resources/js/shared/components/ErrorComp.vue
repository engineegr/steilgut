<template>
	<div class="error tw-overflow-hidden">
		<div class="sm:tw-block tw-hidden" key="error-bg">
			<picture>
				<img
					srcset="/images/xl/error-pg/xl-bg-error-body.jpg"
					class="tw-fixed tw-z-1 tw-inset-0 tw-p-0 tw-m-0 tw-object-cover tw-min-w-full tw-w-full tw-h-full tw-min-h-full"
					alt="Error page bg"
				/>
			</picture>
		</div>
		<div class="tw-block sm:tw-hidden">
			<picture>
				<img
					srcset="
						/images/xs/error-pg/xs-bg-error-body.jpg,
						/images/xs/error-pg/xs-bg-error-body.jpg 2x
					"
					class="tw-fixed tw-z-1 tw-inset-0 tw-p-0 tw-m-0 tw-object-cover tw-min-w-full tw-w-full tw-h-full tw-min-h-full"
					alt="Error page bg"
				/>
			</picture>
		</div>
		<h1 class="error-text tw-text-masthead-header-gold centered-msg">
			{{ __("formalMessages.errorMsg") }}
		</h1>
	</div>
</template>

<style lang="scss" scoped>
.error {
	min-height: 80%;
	min-height: 80vh;
	/* min-height: calc(var(--100nvh,1vh)*80); */
	max-height: unset;
	min-width: 100%;
	min-width: 100vw;
	max-width: 100%;
	max-width: 100vw;

	flex-grow: 1;
}
/*********************************************************************
* 
*************************** MEDIA QUERIES ****************************
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.error-text {
		font-size: 0.8rem;
	}
}

/*********************************************************************
* 
*************************** END: MEDIA QUERIES ***********************
*
**********************************************************************/
</style>
