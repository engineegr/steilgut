@extends('cms.layouts.master')

@section('content')
    <div class="dashboard-content tw-antialiased tw-h-full tw-w-full">
        @if (session('status'))
            <div
                class="tw-flex tw-justify-items-center tw-align-items-center tw-w-auto tw-h-auto tw-border 
                                                                                                                                        tw-border-gray-700 tw-bg-gray-300">
                <div class="alert tw-bg-teal-300 tw-w-full tw-h-full tw-my-2" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        <div class="items tw-h-full tw-w-full">
            <div class="items-navbar sm-hidden">
                <div class="items-navbar-title tw-w-full tw-text-3xl">
                    <h1 class="text-steilgut-gold-color">Categories</h1>
                </div>
                <ul class="items-navbar-list tw-h-full">
                    @foreach ($categories as $category)
                        @if ($category->name == $activeCategory->name)
                            <li class="items-navbar-list-active-link tw-text-2xl tw-w-full tw-text-black">
                                <a href="/cms/admin/{{ $category->url }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @else
                            <li
                                class="items-navbar-list-link tw-text-2xl tw-w-full tw-text-gray-200 hover:tw-text-gray-700">
                                <a href="/cms/admin/{{ $category->url }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="items-dropdown sm-visible">
                <button class="btn btn-secondary dropdown-toggle items-dropdown-title" type="button"
                    id="dropdownCategoryMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownCategoryMenuButton">
                    @foreach ($categories as $category)
                        @if ($category->name == $activeCategory->name)
                            <li>
                                <a class="dropdown-item items-dropdown-item-active"
                                    href="/cms/admin/{{ $category->url }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item items-dropdown-item" href="/cms/admin/{{ $category->url }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="items-content tw-h-auto tw-flex tw-flex-col tw-justify-center">
                @administratorRole
                @if ($activeCategory->dict_name === 'NEWS_CATEGORY')
                    <div class="items-content-common-control">
                        <div class="items-content-common-control-create-item tw-m-2 tw-text-center tw-shadow-md">
                            <a class="tw-rounded tw-w-full tw-inline-block hover:tw-bg-yellow-500 hover:tw-text-gray-900 tw-text-gray-500 tw-font-semibold hover:tw-border-blue-400 tw-py-2 tw-nderline hover:tw-no-underline tw-h-full"
                                href="{{ route('admin.dashboard.news.create') }}">Create</a>
                        </div>
                    </div>
                @elseif($activeCategory->dict_name === 'WINE_CATEGORY')
                    @if (!empty($winesBranch))
                        @if ($winesBranch == 'SLIDER')
                            <div class="items-content-common-control">
                                <div class="items-content-common-control-create-item tw-m-2 tw-text-center tw-shadow-md">
                                    <a class="tw-rounded tw-w-full tw-inline-block hover:tw-bg-yellow-500 hover:tw-text-gray-900 tw-text-gray-500 tw-font-semibold hover:tw-border-blue-400 tw-py-2 tw-nderline hover:tw-no-underline tw-h-full"
                                        href="{{ route('admin.dashboard.wines-slider.create') }}">Create</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
                @endadministratorRole
                <div class="items-content-active-category">
                    @switch($activeCategory->dict_name)
                        @case('NEWS_CATEGORY')
                            <div class="news">
                                <div class="sm-visible news-link-ctrl">{{ $items->links() }}</div>
                                <div class="news-line tw-mb-2">
                                    @foreach ($items as $item)
                                        @administratorRole
                                        @include('cms.admin.news.admin-news-item', ['id' => $item->id])
                                        @endadministratorRole

                                        @guestRole
                                        @include('cms.layouts.news.news-item', ['item' => $item])
                                        @endguestRole
                                    @endforeach
                                </div>
                                <div class="sm-hidden news-link-ctrl">{{ $items->links() }}</div>
                            </div>
                        @break
                        @case('WINE_CATEGORY')
                            <div class="wines container-fluid">
                                @if (empty($winesBranch))
                                    @include('cms.admin.wines.wine-branches')
                                @elseif ($winesBranch == 'CATALOG')
                                    <div class="sm-visible wines-link-ctrl">{{ $items->links() }}</div>
                                    <div class="row tw-mb-2">
                                        @foreach ($items as $item)
                                            @administratorRole
                                            @include('cms.admin.wines.admin-wines-catalog-item', ['id' => $item->id])
                                            @endadministratorRole

                                            @guestRole
                                            @include('cms.layouts.wines.wines-catalog-item', ['item' => $item])
                                            @endguestRole
                                        @endforeach
                                    </div>
                                    <div class="sm-hidden wines-link-ctrl d-flex justify-content-center">
                                        {{ $items->links() }}</div>
                                @elseif ($winesBranch == 'SLIDER')
                                    <div class="sm-visible wines-link-ctrl">{{ $items->links() }}</div>
                                    <div class="row tw-mb-2">
                                        @foreach ($items as $item)
                                            @administratorRole
                                            @include('cms.admin.wines.admin-wines-slider-item', ['id' => $item->id])
                                            @endadministratorRole

                                            @guestRole
                                            @include('cms.layouts.wines.wines-slider-item', ['item' => $item])
                                            @endguestRole
                                        @endforeach
                                    </div>
                                    <div class="sm-hidden wines-link-ctrl d-flex justify-content-center">
                                        {{ $items->links() }}</div>
                                @endif
                            </div>
                        @break
                        @default
                            {{ abort(404, 'Category not found') }}
                    @endswitch
                </div>
            </div>
        </div>
    </div>
@endsection
