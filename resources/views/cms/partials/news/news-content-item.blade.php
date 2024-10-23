<div class="news-catalog-form-content tw-flex tw-flex-col tw-flex-grow">
    <header class="item-form-header tw-m-auto tw-text-2xl tw-bg-blue-200 tw-text-gray-700 
                                                    tw-border tw-rounded-md tw-shadow-lg tw-my-4 tw-text-center tw-font-semibold
                                                    hover:tw-text-gray-100 hover:tw-bg-orange-400">
        <h1>{{ $categoryTitle }}</h1>
    </header>
    <div class="news-catalog-form-content-primary-field-list tw-bg-gray-100 tw-rounded">
        <section class="upload-box-container tw-m-2">
            @if (!empty($item) and $item->image)
                <upload-image-box image="{{ $item->image }}" :readonly="{{ $isReadOnly ? 'true' : 'false' }}">
                </upload-image-box>
            @else
                <upload-image-box image='' :readonly="{{ $isReadOnly ? 'true' : 'false' }}">
                </upload-image-box>
            @endif
        </section>

        <div class="news-catalog-form-content-primary-field-list-text-field-list">
            <div class="text-field-box tw-m-2 tw-rounded">
                <label class="tw-text-center tw-px-4 tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mt-2"
                    for="title">
                    Title
                </label>
                @if (!empty($item) and $item->title)
                    <input type="text"
                        class="tw-shadow tw-appearance-none tw-border tw-rounded tw-py-2 tw-px-3 tw-m-2
                                                                            tw-text-gray-700 tw-leading-tight tw-focus:outline-none tw-focus:shadow-outline"
                        id="title" name='title' value="{{ $item->title }}" maxlength="96" required
                        {{ $isReadOnly ? 'readonly' : '' }}>
                @else
                    <input type="text"
                        class="tw-shadow tw-appearance-none tw-border tw-rounded tw-py-2 tw-px-3 tw-m-2
                                                                                    tw-text-gray-700 tw-leading-tight tw-focus:outline-none tw-focus:shadow-outline"
                        id="title" name='title' maxlength="33" required {{ $isReadOnly ? 'readonly' : '' }}>
                @endif

                <label class="tw-text-center tw-mt-2 tw-px-4 tw-block tw-text-gray-700 tw-text-sm tw-font-bold"
                    for="postingDate">
                    Posting date
                </label>

                @if (!empty($item) and $item->posting_date)
                    <input type="date" class="tw-py-2 tw-m-2 tw-shadow tw-appearance-none tw-border tw-rounded tw-px-3 
            tw-text-gray-700 tw-leading-tight tw-focus:outline-none tw-focus:shadow-outline tw-mb-3" id="postingDate"
                        name='postingDate' value="{{ $item->posting_date }}" {{ $isReadOnly ? 'readonly' : '' }}
                        required>
                @else
                    <input type="date" class="tw-py-2 tw-m-2 tw-shadow tw-appearance-none tw-border tw-rounded tw-px-3 
            tw-text-gray-700 tw-leading-tight tw-focus:outline-none tw-focus:shadow-outline tw-mb-3" id="postingDate"
                        required name='postingDate' placeholder="YYYY-mm-dd" {{ $isReadOnly ? 'readonly' : '' }}>
                @endif
            </div>

            <div class="lang-drop-down-list-container tw-m-2 tw-rounded bg-steilgut-beige-color">
                <drop-down-dyn-list-comp initial="{{ app()->getLocale() }}">
                </drop-down-dyn-list-comp>
            </div>
        </div>
    </div>

    <div class="">
        <label class="tw-block tw-text-center tw-m-text-center tw-text-gray-700 tw-text-sm tw-font-bold tw-my-2"
            for="news-editor-value">
            Thread
        </label>

        @if (!empty($item) and $item->thread)
            <ckeditor4-comp content="{{ $item->thread }}"></ckeditor4-comp>
        @else
            <ckeditor4-comp content="Best wishes!"></ckeditor4-comp>
        @endif
    </div>
</div>
