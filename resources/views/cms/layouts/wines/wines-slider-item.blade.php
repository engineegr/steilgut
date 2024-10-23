<div id="wines-item" class="wines-item col-12 col-md-4">
    <header class="wines-item-header-block tw-mb-2 tw-bg-transparent tw-overflow-hidden tw-px-2">
        <section class="wines-item-info">
            <img src="{{ $item->image }}" class="wines-item-img tw-flex-1 tw-mx-auto tw-object-scale-down" />
            <h1 class="wine-header-text tw-text-black">{{ $item->title }}</h1>
        </section>
    </header>

    <div class="wines-control">
        @section('wines-control-section')
            <div class="edit-review-item tw-text-center tw-shadow-md hover:tw-bg-white tw-bg-gray-100">
                <a class="tw-rounded tw-w-full tw-inline-block hover:tw-bg-orange-300 hover:tw-text-gray-900
                   tw-text-gray-500 tw-font-semibold hover:tw-border-blue-400 tw-py-2
                   tw-no-underline hover:tw-no-underline tw-h-full "
                    href="{{ route('admin.dashboard.wines-slider.show', ['id' => $item->id, 'title' => $item->title]) }}">Preview</a>
            </div>
        @show
    </div>
</div>
