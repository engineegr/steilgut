@extends('cms.layouts.master')
@section('content')
    <div class="item-form">
        @if ($errors->any())
            <div class="alert alert-danger tw-m-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dashboard.news.store') }}" method="POST" enctype="multipart/form-data"
            class="news-catalog-form">
            @csrf
            @include('cms.partials.news.news-content-item')
            <div class="item-form-control tw-my-3">
                <div
                    class="tw-flex tw-justify-center tw-align-middle tw-shadow-md tw-text-center hover:tw-bg-red-500 tw-border tw-border-steilgut-red hover:tw-border-transparent tw-rounded tw-text-black tw-bg-steilgut-beige tw-mb-0 tw-mt-auto item-form-control-btn">
                    <button type="submit"
                        class="tw-text-gray-600 tw-font-semibold hover:tw-text-white tw-py-2 tw-w-full focus:tw-outline-none">
                        Save
                    </button>
                </div>
                <div
                    class="tw-flex tw-justify-center tw-align-middle tw-shadow-md tw-text-center hover:tw-bg-red-500 tw-border tw-border-steilgut-red hover:tw-border-transparent tw-rounded tw-text-black tw-bg-steilgut-beige tw-mb-0 tw-mt-auto item-form-control-btn">
                    <a class="tw-w-full tw-my-auto tw-text-gray-600 tw-font-semibold tw-no-underline hover:tw-no-underline hover:tw-text-white tw-py-2"
                        href="{{ route('admin.dashboard.news') }}">Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection
