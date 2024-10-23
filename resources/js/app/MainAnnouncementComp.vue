<template>
	<main role="main">
		<div class="announcement-container-class">
			<article class="announcement-class tw-border-l-2 tw-border-light-gray">
				<h1 class="announcement-header-class">{{ announcementTitle }}</h1>
				<section>
					<a v-bind:href="linkUrl" v-if="linkText !== ''">{{ linkText }}</a>
				</section>
			</article>
		</div>
	</main>
</template>

<script type="text/javascript">
	export default {
		props: ['announcementTitle', 'linkText', 'linkUrl'],
	}
</script>