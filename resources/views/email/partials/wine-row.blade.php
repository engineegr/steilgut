{{-- * Interface
    *
    * wine 
    * subtotal --}}
<div class="wine-row-container transit-flex-box">
    <header class="wine-row">
        <div class="wine-header">
            <div class="wine-img-container">
                <img src="{{ $wine->image }}" alt="wine bottle image" class="tw-object-fill wine-order-bottle-img" />
            </div>
            <h2 class="wine-title">{{ $wine->title }}</h2>
        </div>
        <div class="wine-tail">
            <span class="row-dots"></span>
            <div class="tail-summary">
                <h2 class="wine-subtotal">
                    {{ $subtotal }} /
                </h2>
                <h2 class="wine-price">
                    {{ $price }} €
                </h2>
            </div>
        </div>
    </header>
    <article class="wine-article">
        {{ $wine->taste }}
    </article>
</div>
