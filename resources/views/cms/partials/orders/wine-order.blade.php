<div id="cms-order" class="cms-order">
    <header class="cms-order-header">
        <h1 class="header-text">{{ __('order.reportHeader') }}</h1>
    </header>

    <main class="cms-order-main">
        @foreach ($orderData->products as $product)
            @include('cms.partials.wine-row', ['wine' => $product->productable, 'subtotal' =>
            $orderData->getSubtotal($product->id)])
        @endforeach
    </main>

    <footer class="cms-order-footer">
        <h2 class="summary-price">{{ $orderData->getSummary() }}</h2>
    </footer>
</div>
