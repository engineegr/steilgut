<div class="container-fluid wines-item-content">

    @if ($add)
        <responsive-image-comp based-lazy-img-style-class="single-wine-pg-img"
            relative-path="{{ $item->backgroundImage->relative_path }}"
            base-name="{{ $item->backgroundImage->base_name }}" img-style-class_16_9="" img-style-class_4_3=""
            transition-img-style-class_16_9="fade-inOut-opacity" transition-img-style-class_4_3="fade-inOut-opacity"
            common-img-style-class="tw-fixed tw-opacity-10 tw-inset-0 tw-object-cover tw-max-h-full tw-h-full tw-max-w-full tw-w-full"
            z-index-style-class="tw-z-0" is-desktop-aspect-ratio-correction="true" is-load-portrait="false"
            is-load-landscape="false">
        </responsive-image-comp>
    @endif

    <div class="row wines-item-content-row">
        @if (!$isReadOnly)
            <div class="row">
                <div class="col-md-4 offset-md-8 offset-lg-9 col-xxl-2 offset-xxl-9 py-4 px-2">
                    <div class="px-0 lang-drop-down-list-container tw-rounded bg-steilgut-beige-color">
                        <drop-down-dyn-list-comp initial="{{ app()->getLocale() }}">
                        </drop-down-dyn-list-comp>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12 col-md-3 col-lg-4">
            @if ($isReadOnly)
                <h2 class="harvest-text">{{ $item->harvest }}<h2>
            @else
                <input name="harvest" type="text"
                    class="tw-w-auto tw-ml-auto tw-mr-0 tw-text-right form-control wine-item-type-input tw-mb-4 harvest-text"
                    value="{{ $item->harvest }}" autofocus>
            @endif
            @if ($add)
                <div class="col-12">
                    <img src="{{ $item->image }}" alt="Wine Catalog Image"
                        class="bottle-img tw-mx-auto tw-px-0 md:tw-mr-0 md:tw-ml-auto">
                </div>
            @else
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <responsive-upload-image-box-comp box-width="360" box-height="360"
                                    picture-name="wineBackgroundPicture_16_9"
                                    readonly="{{ $isReadOnly ? 'true' : 'false' }}"
                                    class="bg-upload-image-box tw-m-auto" bg-img-class="tw-fixed">
                                </responsive-upload-image-box-comp>
                            </div>

                            <div class="col-12">
                                <responsive-upload-image-box-comp box-width="360" box-height="360"
                                    picture-name="wineBackgroundPicture_4_3"
                                    readonly="{{ $isReadOnly ? 'true' : 'false' }}"
                                    class="bg-upload-image-box tw-m-auto" bg-img-class="tw-relative" ratio="4/3">
                                </responsive-upload-image-box-comp>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <responsive-upload-image-box-comp box-width="320" box-height="800"
                            picture-name="wineBottlePicture" readonly="{{ $isReadOnly ? 'true' : 'false' }}"
                            title="Choose a wine bottle img" class="bg-upload-image-box tw-m-auto"
                            bg-img-class="tw-relative tw-h-4/5 tw-w-auto" ratio="4/3">
                        </responsive-upload-image-box-comp>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-9 col-lg-8 col-xl-6 offset-xl-1 wine-property-col-container">
            <div class="row">
                <div class="col-5 col-md-3 offset-md-1 col-lg-3 offset-lg-0">
                    @if ($isReadOnly)
                        <h2 class="wine-item-type-text">{{ $item->wineType }}</h3>
                            <h1 class="wine-item-title-text">{{ $item->title }}</h1>
                        @else
                            <input id="type-input-id" name="wineType" type="text"
                                class="form-control wine-item-type-input" value="{{ $item->wineType }}">

                            @if ($add)
                                <div class="wine-item-title">
                                    <input name="title" type="hidden" class="form-control wine-item-title-input"
                                        value="{{ $item->title }}">
                                </div>
                                <h1 class="wine-item-title-text">{{ $item->title }}</h1>
                            @else
                                <div class="wine-item-title">
                                    <input id="title-input-id" name="title" type="text"
                                        class="form-control wine-item-title-input" value="{{ $item->title }}">
                                </div>
                            @endif
                    @endif
                </div>

                <div class="col-6 offset-1 col-md-5 offset-md-2 col-lg-7 offset-lg-1 col-xl-6 offset-xl-3">
                    <div class="price-count-container tw-flex tw-flex-col tw-justify-center tw-items-end">
                        <div class="price-discount-container tw-inline-flex tw-justify-between">
                            <div class="price-container tw-flex tw-flex-col">
                                @if ($isReadOnly)
                                    <h2 class="price-text">{{ $item->getFormatPrice() }} €<h2>
                                        @else
                                            <div class="edit-container">
                                                <input type="text" name="price"
                                                    class="price-text form-control tw-inline-block"
                                                    value="{{ $item->getFormatPrice() }}"><span
                                                    class="price-text tw-inline">€</span>

                                            </div>
                                @endif
                                <h3 class="price-note-text tw-text-right">{{ __('store.minimumOrder') }}</h3>
                            </div>
                            <div class="discount-container tw-flex tw-flex-col tw-pl-4">
                                @if ($isReadOnly)
                                    <h2 class="price-text">{{ $item->product->getNumericDiscount() }} %<h2>
                                        @else
                                            <div class="edit-container">
                                                <input type="text" name="discount"
                                                    class="price-text form-control tw-inline-block"
                                                    value="{{ $item->product->getNumericDiscount() }}">
                                                <span class="price-text tw-inline">%</span>
                                            </div>
                                @endif
                                <h3 class="price-note-text tw-text-right">{{ __('store.discount') }}</h3>
                            </div>
                        </div>
                        @if ($isReadOnly)
                            <h2 class="count-text">{{ $item->product->total_in_stock }} шт</h3>
                            @else
                                <div class="edit-container">
                                    <input type="text" name="count" class="count-text form-control tw-inline-block"
                                        value="{{ $item->product->total_in_stock }}"><span
                                        class="price-text tw-inline">шт</span>
                        @endif
                        <h3 class="count-note-text">{{ __('store.total') }}</h3>
                    </div>
                </div>

                {{-- <div class="col-lg-4 offset-lg-4">
                    <div class="price-cart-container tw-inline-flex tw-justify-between">
                        <div class="price-container">
                            @if ($isReadOnly)
                                <h2 class="price-text">17 €</h3>
                                @else
                                    <input type="text" name="price-input" class="price-text form-control tw-inline-block" value="17"><span class="price-text tw-inline-block">€</span>
                            @endif
                            <h3 class="price-note-text">минимальный заказ 3 бутылки</h3>
                        </div>

                        <div class="cart-container tw-text-right">
                            <div class="add-to-cart-bg-icon-container tw-cursor-pointer">
                                <img src="/images/icons/cms/wines-catalog-item/add-to-card-bg.svg"
                                    alt="Add to Cart background"
                                    class="tw-object-cover add-to-cart-bg-icon hover:tw-shadow">
                            </div>
                            <h3 class="price-cart-text">Добавить в контейнер</h3>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="wine-property-table-container">
                {{-- Property of the wine --}}
                <div class="row offset-md-1 offset-lg-0">
                    <div class="col-6 col-sm-4 wine-property-col">
                        <h3 class="property-header-text">{{ __('wines.residualSugar') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-1st-row-value-text">{{ $item->residual_sugar }}</h2>
                        @else
                            <input id="sugar-input" name="sugar" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->residual_sugar }}">
                        @endif
                    </div>
                    <div class="col-6 col-sm-4 wine-property-col">
                        <h3 class="property-header-text">{{ __('wines.acidity') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-1st-row-value-text">{{ $item->acidity }}</h2>
                        @else
                            <input id="acidity-input" name="acidity" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->acidity }}">
                        @endif
                    </div>
                    <div class="col-6 col-sm-4 wine-property-col sm-hidden">
                        <h3 class="property-header-text">{{ __('wines.strength') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-1st-row-value-text">{{ $item->strength }}</h2>
                        @else
                            <input id="strength-input" name="strength" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->strength }}">
                        @endif
                    </div>
                </div>

                <div class="row offset-md-1 offset-lg-0 sm-visible">
                    <div class="col-6 col-sm-4 wine-property-col">
                        <h3 class="property-header-text">{{ __('wines.strength') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-1st-row-value-text">{{ $item->strength }}</h2>
                        @else
                            <input id="strength-input--mobile" name="strength--mobile" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->strength }}">
                        @endif
                    </div>
                    <div class="col-6 col-sm-4 wine-property-col">
                        <h3 class="property-header-text">{{ __('wines.wineSort') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-2nd-row-value-text">{{ $item->wineSort }}</h2>
                        @else
                            <input id="sort-input--mobile" name="sort--mobile" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->wineSort }}">
                        @endif
                    </div>
                </div>

                <div class="row offset-md-1 offset-lg-0">
                    <div class="col-6 col-sm-4 wine-property-col sm-hidden">
                        <h3 class="property-header-text">{{ __('wines.wineSort') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-2nd-row-value-text">{{ $item->wineSort }}</h2>
                        @else
                            <input id="sort-input" name="sort" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->wineSort }}">
                        @endif
                    </div>
                    <div class="col-6 col-sm-4 wine-property-col">
                        <h3 class="property-header-text">{{ __('wines.soil') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-2nd-row-value-text">{{ $item->soil }}</h2>
                        @else
                            <input id="soil-input" name="soil" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->soil }}">
                        @endif
                    </div>
                    <div class="col-6 col-sm-4 wine-property-col">
                        <h3 class="property-header-text">{{ __('wines.terroir') }}</h3>
                        @if ($isReadOnly)
                            <h2 class="property-2nd-row-value-text">{{ $item->terroir }}</h2>
                        @else
                            <input id="terroir-input" name="terroir" type="text"
                                class="form-control property-1st-row-value-text" value="{{ $item->terroir }}">
                        @endif
                    </div>
                </div>
            </div>

            <div class="row offset-md-1 offset-lg-0">
                <div class="col-md-8 col-lg-9">
                    <div class="additional-note">
                        <div class="control-room">
                            <img src="/images/icons/cms/wines-catalog-item/grape.svg" alt="Harvest Aspect Grape Icon"
                                class="harvest-aspect-icon tw-object-scale-down">
                            <a class="ctrl-link active-ctrl-link harvest-aspect-ctrl-link tw-no-underline hover:tw-underline"
                                data-bs-toggle="collapse" href="#harvest-aspect-collapse-id" role="button"
                                aria-expanded="true" aria-controls="harvest-aspect-collapse-id"
                                id="harvest-aspect-control-id">
                                {{ __('wines.harvestWays') }}
                            </a>
                            <img src="/images/icons/cms/wines-catalog-item/wine-cups.svg"
                                alt="Harvest Aspect Grape Icon"
                                class="taste-icon tw-object-scale-down disabled-element">
                            <a class="ctrl-link taste-ctrl-link tw-no-underline hover:tw-underline disabled-element"
                                role="button" data-bs-toggle="collapse" data-bs-target="#taste-collapse-id"
                                aria-expanded="false" aria-controls="taste-collapse-id" id="taste-control-id">
                                {{ __('wines.taste') }}
                            </a>
                        </div>
                        <div class="collapse" id="harvest-aspect-collapse-id">
                            @if ($isReadOnly)
                                <div class="additional-note-text tw-text-steilgut-bg-color" id="harvest-aspect-area-id">
                                    {{ $item->harvest_aspect }}</div>
                            @else
                                <textarea name="harvestAspect" cols="30" class="additional-note-textarea"
                                    rows="10">{{ $item->harvest_aspect }}</textarea>
                            @endif
                        </div>

                        <div class="collapse show" id="taste-collapse-id">
                            @if ($isReadOnly)
                                <div class="additional-note-text tw-text-steilgut-bg-color" id="taste-area-id">
                                    {{ $item->taste }}</div>
                            @else
                                <textarea name="taste" cols="30" class="additional-note-textarea"
                                    rows="10">{{ $item->taste }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module" defer>
            $(document).ready(function() {
                ("use strict");
                const invalidState = (!window.STEILGUT_CMS_VAR_STORE || (window.STEILGUT_CMS_VAR_STORE && !
                        window
                        .STEILGUT_CMS_VAR_STORE['UTILS']) ||
                    (window.STEILGUT_CMS_VAR_STORE && window.STEILGUT_CMS_VAR_STORE['UTILS'] && !window
                        .STEILGUT_CMS_VAR_STORE['UTILS'].Helper));

                let helper = null;
                if (!invalidState) {
                    helper = window.STEILGUT_CMS_VAR_STORE['UTILS'].Helper;
                } else {
                    throw new Error(
                        "wines-catalog-content-item.blade.php: Could detect STEILGUT_CMS_VAR_STORE");
                }

                function setFocusToTextBox() {
                    $("#title-input-id").focus();
                }
                setFocusToTextBox();

                const harvestAspectControlHTMLElement = document.getElementById('harvest-aspect-collapse-id');
                const harvestAspectControlBootstrapElement = new window.bootstrap.Collapse(
                    harvestAspectControlHTMLElement);

                const tasteControlHTMLElement = document.getElementById('taste-collapse-id');
                const tasteControlBootstrapElement = new window.bootstrap.Collapse(tasteControlHTMLElement);

                const harvestAspectCtrlSelectors = [
                    '.harvest-aspect-ctrl-link',
                    '.harvest-aspect-icon',
                ];
                const tasteCtrlSelectors = [
                    '.taste-ctrl-link',
                    '.taste-icon',
                ];

                function disableCtrlElement(ctrlSelectors) {
                    ctrlSelectors.forEach(sel => {
                        helper.addStyleClass('disabled-element', sel);
                    });
                };

                function enableCtrlElement(ctrlSelectors) {
                    ctrlSelectors.forEach(sel => {
                        helper.removeStyleClass('disabled-element', sel);
                    });
                };

                $('#harvest-aspect-control-id').click(function() {
                    tasteControlBootstrapElement.hide();
                    harvestAspectControlBootstrapElement.show();
                    enableCtrlElement(harvestAspectCtrlSelectors);
                    disableCtrlElement(tasteCtrlSelectors);
                });

                $('#taste-control-id').click(function() {
                    harvestAspectControlBootstrapElement.hide();
                    tasteControlBootstrapElement.show();
                    disableCtrlElement(harvestAspectCtrlSelectors);
                    enableCtrlElement(tasteCtrlSelectors);
                });

            });

        </script>
    @endpush
</div>
