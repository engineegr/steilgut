<template>
	<div class="news-content tw-relative tw-z-5 md:tw-static md:tw-z-auto">
		<div v-if="isError">
			<error-comp></error-comp>
		</div>
		<div v-else class="landscape:tw-flex landscape:tw-flex-grow-1">
			<div v-if="isLoading">
				<h1 class="loading-msg tw-text-steilgut-history-text-gold">
					{{ __("formalMessages.loadingMsg") }}
				</h1>
				<button
					class="tw-fixed tw-z-20 tw-inset-0 tw-h-full tw-w-full tw-bg-gray-200 tw-opacity-25 focus:tw-outline-none tw-cursor-default"
				></button>
			</div>
			<div v-else class="landscape:tw-flex landscape:tw-flex-grow-1">
				<!-- Portrait -->
				<div
					class="news-line tw-m-auto md:tw-hidden landscape:tw-hidden tw-block tw-p-4"
				>
					<div class="items" v-if="getItems">
						<div
							class="an-item tw-transparent tw-m-2 tw-rounded-lg tw-overflow-hidden"
							v-for="i in getItemsPerPage"
							:key="`${i}_news_item`"
						>
							<transition name="anim-fade">
								<items-description
									:key="`${
										getPaginatorFrom + i
									}_news_item_description_portrait`"
									:itemKey="`${
										getPaginatorFrom + i
									}_news_item_description_portrait`"
									v-if="getCurrentItem(i)"
									:newsItem="getCurrentItem(i)"
									v-on:switch-view="handleOnItemClick"
								/>
							</transition>
						</div>
					</div>

					<paginator
						v-if="getItems && getCount > getItemsPerPage"
						v-on:update-items="handleUpdateItems"
						:printPageLinkQuantity="1"
						:count="count"
						:itemsPerPage="getItemsPerPage"
						:page="getPage"
						:ifMasquerade="true"
					/>
				</div>
				<!-- Landscape / Desktop -->

				<div class="tw-hidden md:tw-block landscape:tw-block">
					<!-- Desktop -->
					<div
						class="news-line tw-my-auto md:tw-flex landscape:tw-hidden fade-inOut-opacity"
					>
						<div class="news-line-header">
							<div
								class="title tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase md:tw-block landscape:tw-block"
							>
								<div class="title-container">
									<h1>{{ __("news.title") }}</h1>
									<div class="title-underline">
										<img
											class="title-underline-img"
											src="/images/orig/news-pg/news-title-underline.png"
										/>
									</div>
								</div>
							</div>
							<paginator
								v-if="getItems && getCount > getItemsPerPage"
								v-on:update-items="handleUpdateItems"
								:printPageLinkQuantity="1"
								:count="count"
								:itemsPerPage="getItemsPerPage"
								:page="getPage"
								:ifMasquerade="true"
								class="news-line-paginator"
							/>
						</div>
						<div class="items" v-if="getItems">
							<div
								class="an-item tw-transparent tw-rounded-lg tw-overflow-hidden"
								v-for="i in getItemsPerPage"
								:key="`${i}_news_item`"
							>
								<transition name="anim-fade">
									<items-description
										:key="`${
											getPaginatorFrom + i
										}_news_item_description_desktop`"
										:itemKey="`${
											getPaginatorFrom + i
										}_news_item_description_desktop`"
										v-if="getCurrentItem(i)"
										:newsItem="getCurrentItem(i)"
										v-on:switch-view="handleOnItemClick"
									/>
								</transition>
							</div>
						</div>
					</div>

					<!-- Landscape -->
					<div class="news-line md:tw-hidden landscape:tw-flex">
						<div class="title-block tw-flex">
							<div
								class="title tw-font-bold tw-text-center tw-text-xl tw-text-white tw-uppercase md:tw-block landscape:tw-block"
							>
								<div class="title-underline">
									<h1>{{ __("news.title") }}</h1>
									<img
										class="title-underline-img"
										src="/images/orig/news-pg/news-title-underline.png"
									/>
								</div>
							</div>
							<paginator
								v-if="getItems && getCount > getItemsPerPage"
								v-on:update-items="handleUpdateItems"
								:printPageLinkQuantity="1"
								:count="count"
								:itemsPerPage="getItemsPerPage"
								:page="getPage"
								:ifMasquerade="true"
							/>
						</div>
						<div class="items" v-if="getItems">
							<div
								class="an-item tw-transparent"
								v-for="i in getItemsPerPage"
								:key="`${i}_news_item`"
							>
								<transition name="anim-fade">
									<items-description
										:key="`${
											getPaginatorFrom + i
										}_news_item_description_landscape`"
										:itemKey="`${
											getPaginatorFrom + i
										}_news_item_description_landscape`"
										class="fade-inOut-opacity-img"
										v-if="getCurrentItem(i)"
										:newsItem="getCurrentItem(i)"
										v-on:switch-view="handleOnItemClick"
									/>
								</transition>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import PaginatorComp from "./PaginatorComp";
import NewsDescriptionComp from "./NewsDescriptionComp";
import mediaHelper from "../../shared/mixins/mediaHelper";

function httpGetPage(clientPage, itemsPerPage) {
	const startPage = clientPage * itemsPerPage - itemsPerPage + 1;
	const endPage = clientPage * itemsPerPage;
	return axios.get("/api/news/pageRange/" + startPage + "/" + endPage);
}

export default {
	mixins: [mediaHelper],

	components: {
		paginator: PaginatorComp,
		"items-description": NewsDescriptionComp,
	},

	data: function () {
		return {
			items: this.$_getItems(),
			page: this.$_getPage(),
			itemsPerPage: this.$_getItemsPerPage(),
			count: this.$_getCount(),
			isLoading: false,
			isError: false,

			aspectRatio: "16/9",
		};
	},

	props: {
		fullDocHeight: {
			type: [Number, String],
			coerce: (str) => parseInt(str),
		},

		fixedItemsPerPage: {
			type: [Number, String],
			default: -1,
			coerce: (str) => parseInt(str),
		},
	},

	created: function () {
		console.log("Debug [NewsComp] created");
		let itemsPerPage = 4;
		this.aspectRatio = this.calcAspectRatio();
		if (!this.isMobileDevice()) {
			if (this.aspectRatio === "4/3") {
				console.log("Debug [NewsComp::created] aspect ratio is 4/3");
				itemsPerPage = 3;
			} else {
				itemsPerPage = 4;
				if (this.aspectRatio === "16/10") {
					console.log("Debug [NewsComp::created] aspect ratio is 16/9");
				} else {
					console.log("Debug [NewsComp::created] aspect ratio is 16/10");
				}
			}
		}
		this.$_setItemsPerPage(itemsPerPage);
		this.$_reCreateItems();
		const vm = this;
		function handleReadyStateChange(event) {
			// debugger;
			if (document.readyState == "complete") {
				console.log(
					"Debug [NewsComp] beforeCreate.handleReadyStateChange state complete"
				);
				vm.$_handleWindowsSize(event);
			}
		}

		window.addEventListener("resize", this.$_handleWindowsSize);
		document.onreadystatechange = handleReadyStateChange;
	},

	destroyed() {
		console.log("Debug [NewsComp::destroyed]");
		window.removeEventListener("resize", this.$_handleWindowsSize);
	},

	computed: {
		getItems: function () {
			return this.$_getItems();
		},

		getPage: function () {
			return this.$_getPage();
		},

		getItemsPerPage: function () {
			return this.$_getItemsPerPage();
		},

		getCount: function () {
			return this.$_getCount();
		},

		getPaginatorFrom: function () {
			return this.$root.$data.stateStore.newsPaginatorFrom;
		},
	},

	methods: {
		handleUpdateItems: function (event, page) {
			// debugger;
			this.$_setPage(page);
			if (
				!this.$_getItems()[
					page * this.$_getItemsPerPage() - this.$_getItemsPerPage()
				]
			) {
				httpGetPage(page, this.$_getItemsPerPage()).then(
					(response) => {
						console.log(response);
						// debugger;
						const newItems = response["data"]["data"];

						const items = [].concat(this.$_getItems());
						const startIndex =
							page * this.$_getItemsPerPage() - this.$_getItemsPerPage();

						const endIndex = page * this.$_getItemsPerPage();
						for (
							let i = startIndex, j = 0;
							i < endIndex && j < this.$_getItemsPerPage();
							i++, j++
						) {
							items[i] = newItems[j];
						}
						this.$_setItems(items);
						this.isLoading = false;
					},
					(error) => {
						console.log(error);
						this.isLoading = false;
						this.isError = true;
					}
				);
			}
		},

		handleOnItemClick: function (event, key) {
			if (this.winesPerPage == 1) {
				this.$router.push("/masthead/wines/wines-bg");
			} else if (this.winesPerPage == 2) {
				this.$router.push("/masthead/wines/single-wine-bg");
			}
			this.$_setSelectedWineKey(key);
		},

		getCurrentItem: function (i) {
			//
			const itemIndex =
				this.$_getPage() * this.$_getItemsPerPage() -
				this.$_getItemsPerPage() +
				i -
				1;
			return this.$_getItems()[itemIndex];
		},

		$_getItems: function () {
			return this.$root.$data.stateStore.newsList;
		},
		$_setItems: function (newsList) {
			this.$root.$data.stateStore.newsList = newsList;
			this.items = newsList;
		},

		$_getPage: function () {
			return this.$root.$data.stateStore.newsPage;
		},
		$_setPage: function (newsPage) {
			this.$root.$data.stateStore.newsPage = newsPage;
			this.page = newsPage;
		},

		$_setFrom: function (aFrom) {
			this.$root.$data.stateStore.paginatorFrom = aFrom;
		},

		$_getItemsPerPage: function () {
			return this.$root.$data.stateStore.newsPerPageQuantity;
		},

		$_setItemsPerPage: function (newsPerPageQuantity) {
			this.$root.$data.stateStore.newsPerPageQuantity = newsPerPageQuantity;
			this.itemsPerPage = newsPerPageQuantity;
		},

		$_getCount: function () {
			return this.$root.$data.stateStore.newsQuantity;
		},
		$_setCount: function (newsCount) {
			this.$root.$data.stateStore.newsQuantity = newsCount;
			this.count = newsCount;
		},

		$_getSelectedItemKey: function () {
			return this.$root.$data.stateStore.newsSelectedItemKey;
		},

		$_setSelectedWineKey: function (newsSelectedItemKey) {
			this.$root.$data.stateStore.newsSelectedItemKey = newsSelectedItemKey;
			this.selectedItemKey = newsSelectedItemKey;
		},

		$_reCreateItems: function () {
			this.$root.$data.stateStore.newsCreated = false;
			this.$root.$data.stateStore.newsPaginatorFrom = 1;
			this.$root.$data.stateStore.newsPage = 1;
			this.isLoading = true;
			// fetch a range of news: 1.. perPageCount
			httpGetPage(1, this.$_getItemsPerPage())
				.then((response) => {
					// debugger;
					console.log(
						"Debug [NewsComp::created] Loaded news count: " + response
					);
					this.$_setItems(response["data"]["data"]);
					this.$root.$data.stateStore.newsCreated = true;
					this.isLoading = false;
				})
				.catch((error) => {
					// debugger;
					console.log("Error [NewsComp::created] Failed to load news: ");
					this.isLoading = false;
					this.isError = true;
				});

			axios
				.get("/api/news/get/count")
				.then((response) => {
					// debugger;
					console.log(
						"Debug [NewsComp::created] Loaded news count: " + response
					);
					this.$_setCount(response["data"]);
					this.isLoading = false;
				})
				.catch((error) => {
					// debugger;
					console.log(
						"Error [NewsComp::created] Failed to load news count: " + error
					);
					this.isLoading = false;
					this.isError = true;
				});
		},

		$_handleWindowsSize: _.debounce(
			function (event) {
				console.log(
					"Debug [NewsComp::$_handleWindowsSize] resize the window callback"
				);
				// debugger;
				let isUpdate = false;
				let itemsPerPage = 4;
				if (!this.isMobileDevice()) {
					const newAspectRatio = this.calcAspectRatio();
					if (this.aspectRatio !== newAspectRatio) {
						if (newAspectRatio === "4/3") {
							console.log("Debug [NewsComp::created] aspect ratio is 4/3");
							itemsPerPage = 3;
						} else {
							itemsPerPage = 4;
							if (newAspectRatio === "16/10") {
								console.log(
									"Debug [NewsComp::created] aspect ratio is 16/10"
								);
							} else {
								console.log(
									"Debug [NewsComp::created] aspect ratio is 16/9"
								);
							}
						}
						isUpdate = true;
						this.aspectRatio = newAspectRatio;
					}
				}
				if (isUpdate) {
					this.$_setItemsPerPage(itemsPerPage);

					this.$root.$data.stateStore.newsPaginatorFrom = 1;
					this.$root.$data.stateStore.newsPage = 1;
				}
			},
			400,
			{
				leading: true,
				trailing: true,
			}
		),
	},
};
</script>

<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
	transition: opacity 1.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}

.loading-msg {
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	position: absolute;
	z-index: 20;
}

/*
 * Default styles aim on desktop version (aspect ratio: 4/3)
*/
.news-content {
	width: 100%;
	max-width: 100%;
	display: flex;
	flex: 1 0 auto;
	flex-direction: column;
	flex-grow: 1;
	margin: 5vh auto auto;

	min-width: 60vw;
	min-width: calc(var(--100nvw, 1vw) * 50);
}

.news-line-header {
	display: flex;
	flex: 1 0 auto;
	flex-direction: row;
	justify-content: space-between;
	align-items: flex-end;
	max-width: 68.5777vw;
	max-width: calc(var(--100nvw, 1vw) * 68.5777);
	width: 68.5777vw;
	width: calc(var(--100nvw, 1vw) * 68.5777);
}

.title {
	margin: auto;
}

.title h1 {
	font-size: calc(1em + 2.3vh);
	font-size: calc(1em + var(--100nvh, 1vh) * 2.3);
	margin: auto auto 1vh auto;
	margin: auto auto var(--100nvh, 1vh) auto;
}

.news-line .title .title-underline-img {
	margin: auto auto auto 0;
	max-width: calc(5.575em + 1vw);
	max-width: calc(5.575em + var(--100nvw, 1vw));
}

.news-line {
	position: relative;
	z-index: 1;
	max-width: 100vw;
	max-width: calc(var(--100nvw, 1vw) * 100);
	width: 100vw;
	width: calc(var(--100nvw, 1vw) * 100);
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-content: center;
	margin: auto;
}

.news-line .items {
	display: flex;
	flex-grow: 1;
	flex-direction: row;
	margin: 7vh auto auto auto;
	margin: calc(var(--100nvh, 1vh) * 7) auto auto auto;

	height: 55vh;
	height: calc(var(--100nvh, 1vh) * 55);
}

.an-item {
	flex-grow: 1;
	max-height: 100%;
	margin-right: 2vw;
	margin-right: calc(var(--100nvw, 1vw) * 2);
}

.an-item:last-child {
	margin-right: 0;
}

.news-line-paginator {
	position: absolute;
	right: 0;
}

.news-line-header .title-container {
	width: fit-content;
	margin: auto;
}

.news-line-header .title {
	flex-grow: 1;
	margin: auto;
}

/*
 * END Default styles aim on desktop version
*/

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.news-line .items {
		min-height: unset;
		min-width: unset;
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.loading-msg {
		top: 75%;
		left: 50%;
		transform: translate(-50%, -75%);
		position: absolute;
		z-index: 20;
	}
	.news-content {
		margin: auto;
	}

	.news-line {
		max-width: 100vw;
		width: 100vw;
	}

	.news-line .items {
		flex-direction: column;
		margin: auto;
		max-width: 100%;
		width: 100%;
		height: unset;
	}

	.an-item {
		flex-grow: 1;
		max-height: fit-content;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.news-content {
		width: 100%;
		max-width: 100%;
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
		margin: auto;
		flex-grow: 1;
		max-height: 100%;
		height: 100%;
		flex-grow: 1;
	}

	.news-line {
		position: relative;
		z-index: 1;
		max-width: 72vw;
		width: 72vw;
		max-height: 100vh;
		height: 100vh;
		max-height: calc(var(--100vh, 1vh) * 100);
		height: calc(var(--100vh, 1vh) * 100);
		flex-grow: 1;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-content: center;
		margin: 0 auto 0 24.96252vw;
	}

	.news-line .items {
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		max-width: fit-content;
		margin: 0 auto 0 auto;
		max-width: 63vw;

		max-height: 60vh;
		max-height: calc(var(--100vh, 1vh) * 60);
		height: 60vh;
		height: calc(var(--100vh, 1vh) * 60);
	}

	.title-block {
		flex-grow: 1;
		display: flex;
		flex: 1 0 auto;
		flex-direction: row;
		max-width: 55vw;
		width: 55vw;
		height: 15vh;
		max-height: 15vh;
		height: calc(var(--100vh, 1vh) * 15);
		max-height: calc(var(--100vh, 1vh) * 15);
		justify-content: center;
		align-items: center;
		margin: 9.6vh auto auto auto;
		margin: calc(var(--100vh, 1vh) * 9.6) auto auto 7.0449775vw;
	}

	.paginator {
		margin: 0 2vw auto auto;
		padding: 0;
	}

	.an-item {
		flex-grow: 1;
		height: 100%;
		max-height: 100%;
		margin-right: 2vw;
	}

	.news-line .title {
		margin: 0 auto auto 0;
	}

	.news-line .items {
		margin-top: 0;
		margin-right: auto;
		margin-bottom: auto;
		max-width: 66vw;
	}

	.title-block,
	.news-line .items {
		margin-left: 6.045vw;
	}

	.news-line .title .title-underline {
		max-width: min-content;
	}

	.news-line .title .title-underline h1 {
		font-size: calc(0.8em + 0.8vw);
		font-size: 6vmin;
		font-size: calc(var(--100vh, 1vh) * 6);
		margin: 2vmin auto;
		margin: 0 0 calc(var(--100vh, 1vh) * 2) 0;
	}

	.news-line .title .title-underline img {
		max-width: 60%;
		margin: auto auto auto 0;
	}
}

@media only screen and (min-width: 320px) and (max-width: 568px) and (orientation: landscape) {
	.news-line .items {
		max-width: 63vw;
	}
}

@media only screen and (min-width: 1025px) {
	.news-content {
		align-items: center;
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-aspect-ratio: 159/100) {
	.news-line {
		position: relative;
		margin: auto;
	}

	.news-line-paginator {
		position: absolute;
		right: 0;
		transform: translate(-50%, 0);
	}

	.news-line-header .title-container {
		width: fit-content;
		margin: auto;
		position: absolute;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.news-line-header .title {
		flex-grow: 1;
		margin: auto;
	}
}

/* Laptops, desktops, large screens: [16/10 ...] ----------- */
@media only screen and (min-width: 1025px) and (min-aspect-ratio: 16/10) {
	.news-content {
		margin: 8vh auto auto;
		margin: calc(var(--100nvh, 1vh) * 8) auto auto;
	}

	.news-line {
		width: 100vw;
		width: calc(var(--100nvw, 1vw) * 100);
		max-width: 100vw;
		max-width: calc(var(--100nvw, 1vw) * 100);
	}

	.news-line-header {
		width: 62.3698vw;
		width: calc(var(--100nvw, 1vw) * 62.3698);
		margin: auto auto 7vh 27.3177vw;
		margin: auto auto calc(var(--100nvh, 1vh) * 7) calc(var(--100nvw, 1vw) * 27.3177);
	}

	.news-line-paginator {
		position: static;
		right: auto;
	}

	.news-line-header .title-container {
		width: fit-content;
		margin: auto auto auto 0;
	}

	.news-line-header .title {
		margin: auto auto auto 0;
	}

	.news-line .items {
		margin: auto auto auto calc(var(--100nvw, 1vw) * 27.3177);
	}
}

@media only screen and (min-width: 1025px) and (max-height: 800px) and (min-aspect-ratio: 16/10) {
	.news-line-header {
		width: 62.3698vw;
		width: calc(var(--100nvw, 1vw) * 62.3698);
		margin: auto auto 5vh 27.3177vw;
		margin: auto auto calc(var(--100nvh, 1vh) * 5) calc(var(--100nvw, 1vw) * 27.3177);
	}
}
</style>
