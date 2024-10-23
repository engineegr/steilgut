<template>
	<div class="paginator">
		<a
			v-on:click="handleLeftClick($event)"
			v-if="ifLeftLink"
			class="paginator-item tw-cursor-pointer"
		>
			<img
				src="/images/orig/news-pg/icons/left-arrow.svg"
				class="left-arrow-img"
				alt="paginator-left-arrow"
			/>
		</a>
		<a
			v-on:click="handleToFirstPage($event)"
			v-if="getFrom > 1"
			class="nonActiveLink tw-mx-1 tw-cursor-pointer"
		>
			1
		</a>
		<div
			class="left-dot-links paginator-item tw-flex tw-flex-row"
			v-if="isLeftDotLinks()"
		>
			<a
				href="#"
				v-on:click="handleLeftDotLinksClick($event)"
				class="nonActiveLink tw-cursor-pointer"
				>...</a
			>
		</div>
		<div
			v-for="i in calcPrintPageLinkQuantity()"
			class="paginator-page-link paginator-item tw-cursor-pointer"
			:key="`${i}_paginator_page_link`"
		>
			<ul>
				<li>
					<a
						href="#"
						v-on:click="handleLinkClick($event, i)"
						:class="getLinkDecoration(i)"
						>{{ getLinkTitle(i) }}</a
					>
				</li>
			</ul>
		</div>
		<div class="right-dot-links paginator-item" v-if="isRightDotLinks()">
			<a
				href="#"
				v-on:click="handleRightDotLinksClick($event)"
				class="nonActiveLink"
				>...</a
			>
		</div>
		<a
			href="#"
			v-on:click="handleToLastPage($event)"
			class="activeLink paginator-item"
			v-if="isLastPagePrint()"
			>{{ getSummaryPageLinkQuantity() }}</a
		>

		<a
			v-on:click="handleRightClick($event)"
			v-if="ifRightLink"
			class="tw-cursor-pointer"
		>
			<img
				src="/images/orig/news-pg/icons/right-arrow.svg"
				alt="paginator-left-arrow"
				class="right-arrow-img"
			/>
		</a>
	</div>
</template>

<script>
import mediaHelper from "../../shared/mixins/mediaHelper";
export default {
	mixins: [mediaHelper],

	props: {
		printPageLinkQuantity: {
			type: Number,
			coerce: (str) => parseInt(str),
		},
		itemsPerPage: {
			type: Number,
			coerce: (str) => parseInt(str),
		},
		count: {
			type: Number,
			coerce: (str) => parseInt(str),
		},
	},

	data: function () {
		return {
			page: this.$_getPage(),
			startClientX: -1,
		};
	},

	created: function () {
		console.log("Debug [PaginatorComp] created");
		if (this.isMobileDevice()) {
			document.addEventListener(
				"touchstart",
				this.$_handleTouchStart,
				{
					passive: false,
				},
				true
			);
			document.addEventListener(
				"touchmove",
				this.$_handleMove,
				{
					passive: false,
				},
				true
			);
		}
	},

	destroyed() {
		("use strict");
		if (this.isMobileDevice()) {
			document.removeEventListener("touchmove", this.$_handleTouchStart);
			document.removeEventListener("touchmove", this.$_handleMove);
		}
	},

	computed: {
		ifLeftLink: function () {
			return this.$_getPage() > 1;
		},

		ifRightLink: function () {
			return this.$_getPage() * this.itemsPerPage < this.count;
		},

		getPage: function () {
			return this.page;
		},

		getFrom: function () {
			return this.$_getFrom();
		},
	},

	methods: {
		handleLinkClick: function (event, i) {
			const oldPage = this.$_getPage();
			this.$_setPage(this.$_getFrom() + i - 1);

			if (this.$_getPage() != oldPage) {
				this.$emit("update-items", event, this.$_getPage());
			}
			event.preventDefault();
		},

		handleLeftClick: function (event, i) {
			let isEmit = false;
			const oldPage = this.$_getPage();
			if (oldPage > 1) {
				this.$_setPage(oldPage - 1);
				if (this.$_getPage() % this.$_getPageLinkQuantity() == 0) {
					this.$_setFrom(this.$_getFrom() - this.$_getPageLinkQuantity());
				}
				this.$emit("update-items", event, this.$_getPage());
			}
			console.log("Debug from: " + this.$_getFrom());

			event.preventDefault();
		},

		handleRightClick: function (event) {
			// debugger;
			const maxPageCount = this.getMaxPageCount();
			if (this.$_getPage() + 1 <= maxPageCount) {
				if (this.$_getPage() % this.$_getPageLinkQuantity() == 0) {
					this.$_setFrom(this.$_getPage() + 1);
				}
				this.$_setPage(this.$_getPage() + 1);

				this.$emit("update-items", event, this.$_getPage());
			}

			event.preventDefault();
		},

		$_handleTouchStart: _.debounce(
			function (event) {
				// debugger;
				console.log(
					"Debug [News PaginatorComp listener: document => $_handleTouchStart]"
				);
				if (
					this.isLandscapeOrientation() &&
					event.touches &&
					event.touches.length === 1
				) {
					this.startClientX = event.touches[0].clientX;
				}
			},
			{
				leading: true,
				trailing: true,
			},
			500
		),

		$_handleMove: _.debounce(
			function (event) {
				// debugger;
				console.log("Debug [News PaginatorComp listener: document => touchMove]");
				// Loading if we are at the page bottom

				if (
					this.isLandscapeOrientation() &&
					event.touches &&
					event.touches.length === 1 &&
					this.startClientX > 0
				) {
					let deltaX = this.startClientX - event.touches[0].clientX;
					deltaX = deltaX < 0 ? deltaX * -1 : deltaX;
					if (deltaX > 33) {
						const swipeLeft = this.startClientX > event.touches[0].clientX;
						if (swipeLeft) {
							this.handleRightClick(event);
						} else {
							this.handleLeftClick(event);
						}
						this.startClientX = -1;
					}
				}
			},
			{
				leading: true,
				trailing: false,
			},
			500
		),

		isLeftDotLinks: function () {
			return (
				this.$_getFrom() > 2 &&
				this.getSummaryPageLinkQuantity() > this.calcPrintPageLinkQuantity()
			);
		},

		handleLeftDotLinksClick: function (event) {
			// debugger;
			const maxPageCount = this.getMaxPageCount();

			if (this.$_getPage() - this.$_getPageLinkQuantity() > 1) {
				this.$_setPage(this.$_getPage() - this.$_getPageLinkQuantity());
				if (this.$_getFrom() - this.$_getPageLinkQuantity() > 1) {
					this.$_setFrom(this.$_getFrom() - this.$_getPageLinkQuantity());
				}
			} else {
				this.$_setPage(1);
				this.$_setFrom(1);
			}

			this.$emit("update-items", event, this.$_getPage());
			event.preventDefault();
		},

		getMaxPageCount: function () {
			return Math.ceil(this.count / this.itemsPerPage);
		},

		calcPrintPageLinkQuantity: function () {
			// debugger;
			const leftCount = this.count - (this.$_getFrom() - 1) * this.itemsPerPage;
			const leftPages = Math.round(leftCount / this.itemsPerPage);
			return this.$_getPageLinkQuantity() > leftPages
				? leftPages
				: this.$_getPageLinkQuantity();
		},

		getLinkTitle: function (i) {
			// // debugger;
			return this.$_getFrom() + i - 1;
		},

		getLinkDecoration: function (i) {
			return {
				activeLink: i === this.page,
				nonActiveLink: i !== this.page,
			};
		},

		isRightDotLinks: function () {
			// debugger;
			return (
				this.$_getFrom() + this.calcPrintPageLinkQuantity() <
				this.getSummaryPageLinkQuantity()
			);
		},

		isLastPagePrint: function () {
			return (
				this.$_getFrom() + this.calcPrintPageLinkQuantity() <=
				this.getSummaryPageLinkQuantity()
				//&& this.$_getPage() != this.getSummaryPageLinkQuantity()
			);
		},

		handleRightDotLinksClick: function (event) {
			// debugger;
			const maxPageCount = this.getMaxPageCount();

			if (this.$_getPage() + this.$_getPageLinkQuantity() <= maxPageCount) {
				this.$_setPage(this.$_getPage() + this.$_getPageLinkQuantity());
				this.$_setFrom(this.$_getFrom() + this.$_getPageLinkQuantity());
			} else {
				this.$_setPage(this.getSummaryPageLinkQuantity());
				this.$_setFrom(
					this.getSummaryPageLinkQuantity() -
						(this.getSummaryPageLinkQuantity() %
							this.$_getPageLinkQuantity()) +
						1
				);
			}

			this.$emit("update-items", event, this.$_getPage());
			event.preventDefault();
		},

		isHover: function (i) {
			return {
				"tw-bg-white": this.$_getFrom() + i - 1 == this.$_getPage(),
			};
		},

		handleToLastPage: function () {
			const maxPageCount = this.getMaxPageCount();
			this.$_setPage(maxPageCount);
			const remainPages = maxPageCount % this.$_getPageLinkQuantity();
			if (remainPages == 0) {
				this.$_setFrom(maxPageCount - this.$_getPageLinkQuantity() + 1);
			} else {
				this.$_setFrom(maxPageCount - remainPages + 1);
			}
			this.$emit("update-items", event, this.$_getPage());
		},

		handleToFirstPage: function () {
			if (this.$_getPage() != 1) {
				this.$_setPage(1);
				this.$_setFrom(1);
				this.$emit("update-wines", event, this.$_getPage());
			}
		},

		getSummaryPageLinkQuantity: function () {
			return Math.ceil(this.$_getCount() / this.$_getItemsPerPage());
		},

		$_getPage: function () {
			return this.$root.$data.stateStore.newsPage;
		},
		$_setPage: function (aPage) {
			this.$root.$data.stateStore.newsPage = aPage;
			this.page = aPage;
		},

		$_getFrom: function () {
			return this.$root.$data.stateStore.newsPaginatorFrom;
		},
		$_setFrom: function (aFrom) {
			this.from = aFrom;
			this.$root.$data.stateStore.newsPaginatorFrom = aFrom;
		},

		$_getPageLinkQuantity: function () {
			return this.printPageLinkQuantity;
		},

		$_getCount: function () {
			return this.$root.$data.stateStore.newsQuantity;
		},

		$_getItemsPerPage: function () {
			return this.$root.$data.stateStore.newsPerPageQuantity;
		},
	},
};
</script>

<style lang="scss" scoped>
.paginator {
	width: fit-content;
	max-width: fit-content;
	margin: 0 0 0 auto;
	display: flex;
	justify-content: flex-end;
	align-items: center;
	flex-direction: row;
	color: #fff;
	padding: 0.5em;
}

.arrow-paginator-class {
	display: flex;
	margin: auto;
	flex-direction: row;
	color: #fff;
	width: 100vw;
	margin-top: 15vw;
}

.arrow-paginator-class .right-arrow-container {
	margin: 0 2em 0 auto;
	max-width: 5em;
}

.arrow-paginator-class .left-arrow-container {
	margin: 0 auto 0 2em;
	max-width: 5em;
}

.left-arrow-img,
.right-arrow-img {
	width: 1.5vw;
	max-width: 1.5vw;
}

.activeLink {
	color: #b09a79;
}

.nonActiveLink {
	color: #c4bbaa;
}

a:hover {
	color: white;
	text-decoration: none;
}

.paginator .paginator-item {
	margin-right: 0.5em;
}

.paginator a {
	font-size: calc(0.3em + 0.5vw);
}

.paginator .paginator-item:last-child {
	margin-right: auto;
}

/*********************************************************************
*
*************************** MEDIA QUERIES ****************************
* @link 
* https://css-tricks.com/snippets/css/media-queries-for-standard-devices/
*
**********************************************************************/

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 1024px) {
	.paginator a {
		font-family: "steilgut_opensans";
		font-weight: lighter;
		font-size: calc(0.6em + 0.7vh);
	}
}

@media only screen and (min-width: 320px) and (orientation: portrait) {
	.left-arrow-img,
	.right-arrow-img {
		width: 3vh;
		max-width: 3vh;
	}
}

@media only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape) {
	.left-arrow-img,
	.right-arrow-img {
		width: 3vw;
		max-width: 3vw;
	}
}

/* Laptops, desktops, large screens: [... 16/10) ----------- */
@media only screen and (min-width: 1025px) and (max-width: 2048px) and (-webkit-min-device-pixel-ratio: 1) and (max-aspect-ratio: 159/100) {
	/* Styles */
	.paginator a {
		font-size: calc(0.3em + 0.8vw);
	}
}
</style>
