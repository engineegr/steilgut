@extends("email.layouts.master")
@section('content')
    <div class="wine-order-container tw-relative transit-flex-box tw-z-1">
        <img src="/images/16_9/order-pg/fhd_1920*1080/jpg/16_9-fhd-bg-order-pg.jpg"
            srcset="/images/16_9/order-pg/fhd_1920*1080/jpg/16_9-fhd-bg-order-pg.jpg /images/16_9/order-pg/fhd_1920*1080/jpg/16_9-fhd-2x-bg-order-pg.jpg 2x"
            class="tw-absolute tw-z-0 tw-inset-0 tw-object-cover tw-h-screen tw-w-full"
            alt="Steilgut mail background image (Order)" />

        <div class="wine-order-content-container tw-relative transit-flex-box tw-z-10">
            <header class="wine-order-header">
                <img src="/images/icons/pulse-logo/black-pulse-logo.png" alt="Black Steilgut Logo"
                    class="tw-object-fill mail-logo tw-m-auto">
                <h1>{{ __('order.emailHeader') }}
                </h1>
                <p class="order-number">{{ $orderData->order_uuid . ' - ' . $orderData->id }}</p>
                <p class="order-status tw-m-auto">{{ __('order.statusHeader') }}: {{ $orderData->getLocaleStatus() }}
                </p>
            </header>
            <main class="wine-order-main">
                {{-- Persinal data --}}
                <div class="card personalData">
                    @php
                        $p = $orderData->person;
                        $pd = $orderData->person->personalData;
                        $address = $orderData->address;
                        $phone = $orderData->person->phones->first()->phone_number;
                    @endphp
                    <i class="far fa-id-card card-img-top"></i>
                    <div class="card-body">
                        <h5 class="card-title">{{ __('personalData.header') }}</h5>
                        <form>
                            <div class="form-group col-7">
                                <label for="lfp">{{ __('personalData.lfp') }}</label>
                                <input type="text" class="form-control" id="lfp"
                                    placeholder="{{ __('personalData.lfp') }}" value="{{ $pd->lfp }}" readonly>
                            </div>
                            <div class="form-group col-7">
                                <label for="email">{{ __('personalData.email') }}</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="{{ __('personalData.email') }}" value="{{ $p->email }}" readonly>
                            </div>
                            <div class="form-group col-7">
                                <label for="country">{{ __('personalData.country') }}</label>
                                <input type="text" class="form-control" id="country"
                                    placeholder="{{ __('personalData.country') }}" value="{{ $address->country }}"
                                    readonly>
                            </div>

                            @if ($address->zip_code)

                                <div class="form-group col-7">
                                    <label for="zip">{{ __('personalData.zip') }}</label>
                                    <input type="text" class="form-control" id="zip"
                                        placeholder="{{ __('personalData.zip') }}" value="{{ $address->zip_code }}"
                                        readonly>
                                </div>
                            @endif

                            @if ($address->full_path)
                                <div class="form-group col-7">
                                    <label for="address">{{ __('personalData.address') }}</label>
                                    <input type="text" class="form-control" id="address"
                                        placeholder="{{ __('personalData.address') }}"
                                        value="{{ $address->full_path }}" readonly>
                                </div>
                            @endif

                            @if ($phone)
                                <div class="form-group col-7">
                                    <label for="phone">{{ __('personalData.phone') }}</label>
                                    <input type="text" class="form-control" id="phone"
                                        placeholder="{{ __('personalData.phone') }}" value="{{ $phone }}"
                                        readonly>
                                </div>
                            @endif

                        </form>
                    </div>

                </div>
                <header class="wine-order-table-header">
                    <h2>{{ __('order.emailSubtotalTableHeader') }} / </h2>
                    <h2>{{ __('order.emailPriceTableHeader') }}</h2>
                </header>
                @foreach ($orderData->products as $product)
                    @include("email.partials.wine-row", ['wine' => $product->productable, 'subtotal' =>
                    $orderData->getSubtotal($product->id), 'price' => $product->getPrice() ])
                @endforeach
            </main>
            <footer class="wine-order-footer">
                <h2 class="tw-m-auto">{{ __('order.emailPriceSummary') }}: {{ $orderData->getSummaryPrice() }} €</h2>
            </footer>
        </div>
    </div>
@endsection
