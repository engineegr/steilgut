<template>
	<form class="lang-pan tw-mt-auto tw-mb-auto" method="post" action="/locale/update">
		<input type="hidden" name="_token" :value="csrf" />
		<input type="hidden" name="locale" v-model="selectedLang" />
		<button
			type="submit"
			:class="[
				'lang-links',
				'tw-rounded-full',
				'tw-w-6',
				'tw-h-6',
				'sm:tw-w-8',
				'sm:tw-h-8',
				'tw-flex',
				'tw-flex-1',
				'tw-items-center',
				'tw-justify-center',
				'tw-border',
				'tw-border-lang-beige',
				'tw-no-underline',
				'hover:tw-no-underline',
				'hover:tw-text-black',
				'hover:tw-bg-lang-beige',
				isActiveLang(lang) ? 'tw-text-black' : 'tw-text-lang-beige',
				isActiveLang(lang) ? 'tw-bg-lang-beige' : '',
			]"
			v-for="lang in langs"
			:key="lang.text"
			v-on:click="switchLang($event, lang)"
		>
			{{ lang.text }}
		</button>
	</form>
</template>

<script>
export default {
	data() {
		return {
			langs: [
				{ text: "RU" },
				// { text: "EN" },
				{ text: "DE" },
				// { text: "CN" },
			],
			selectedLang: "",
			csrf: document
				.querySelector('meta[name="csrf-token"]')
				.getAttribute("content"),
		};
	},
	created() {
		const currLang = document.getElementsByTagName("html")[0].getAttribute("lang");
		this.selectedLang = currLang.toUpperCase();
	},
	methods: {
		switchLang(event, selectedLang) {
			console.log(
				"Debug [switchLang] Enter the function: TODO localization process in Vue JS"
			);
			const currLang = document
				.getElementsByTagName("html")[0]
				.getAttribute("lang");
			if (!currLang) {
				currLang = "ru";
			}
			this.selectedLang = selectedLang.text.toLowerCase();
			if (!currLang) {
				console.log("Debug [switch_lang] Can't retrieve curr lang");
				event.preventDefault();
			} else {
				console.log("Debug [switch_lang] Current lang: " + currLang);
				console.log("Debug [switch_lang] Selected lang: " + this.selectedLang);
				if (currLang.toLowerCase() == this.selectedLang) {
					console.log(
						"Debug [switch_lang] Current lang is == selected lang" +
							this.selectedLang
					);
					event.preventDefault();
				} else {
					this.$lang().setLocale(this.selectedLang);
				}
			}
		},
		isActiveLang: function (lang) {
			return (
				this.selectedLang.toLowerCase() === lang.text.toLowerCase() ||
				(this.selectedLang === "ZH-CN" && lang.text === "CN") ||
				(this.selectedLang === "ZH_CN" && lang.text === "CN")
			);
		},
	},
};
</script>

<style lang="scss" scoped>
.lang-pan {
	text-decoration: none;
	grid-gap: 0.5em;
	font-size: 0.855em;
	display: inline-grid;
	grid-template-columns: 1fr 1fr;
	flex-direction: row;
	justify-content: center;
	align-items: center;
}

.lang-pan button:first-child {
	text-decoration: none;
}

.selected-lang {
	background-color: #c4bbaa;
	color: black;
}
/* ===================== MEDIA QUERIES ===================== */

/* 320+ 
	------------------------------------------ */
@media only screen and (min-width: 320px) {
	.lang-pan .lang-links {
		font-size: smaller;
	}
}
/* ===================== END: MEDIA QUERIES ===================== */
</style>
