<div id="news-item" class="news-item">
    <div class="news-item-header-block tw-mb-2 tw-bg-transparent tw-overflow-hidden tw-px-2">
        <img src="{{ $item->image }}" class="news-item-img tw-flex-1 tw-m-auto tw-object-scale-down" />
        <div class="news-item-posting-date tw-px-2 tw-pt-2">
            <h1 class="tw-text-black">{{ $item->posting_date }}</h1>
        </div>
        <div class="news-item-title tw-px-2 tw-pt-2 tw-pb-2">
            <h1 class="tw-text-black">{{ $item->title }}</h1>
        </div>
    </div>

    <div class="news-control">
        @section('news-control-section')
            <div class="edit-review-item tw-m-2 tw-text-center hover:tw-shadow-md hover:tw-bg-white tw-bg-gray-100">
                <a class="tw-rounded tw-w-full tw-inline-block hover:tw-bg-orange-300 hover:tw-text-gray-900
                    tw-text-gray-500 tw-font-semibold hover:tw-border-blue-400 tw-py-2
                    tw-no-underline hover:tw-no-underline tw-h-full "
                    href="{{ route('admin.dashboard.news.show', $item->id) }}">Preview</a>
            </div>
        @show
    </div>
</div>
