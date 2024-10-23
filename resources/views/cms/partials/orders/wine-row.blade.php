{{-- * Interface
    *
    * wine 
    * subtotal --}}
<div class="cms-wine-container">
    <header class="cms-wine-row">
        <div class="cms-wine-header">
            <img src="{{ wine->image }}" alt="wine bottle image" />
            <span h2="cms-wine-title">{{ wine->title }}</span>
        </div>
        <span class="cms-row-dots"></span>
        <header class="cms-subtotal">
            {{ subtotal }}
        </header>
    </header>
    <article class="cms-wine-article">
        {{ wine->taste }}
    </article>
</div>
