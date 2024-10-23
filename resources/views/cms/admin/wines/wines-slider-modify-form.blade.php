@extends('cms.layouts.master')

@section('exp_head')
@endsection
@section('content')
    <div class="item-form">
        {{-- @if ($errors->any())
            <div class="alert alert-danger tw-m-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('admin.dashboard.wines-slider.store', ['add' => $add, 'id' => $item->id]) }}" method="POST"
            enctype="multipart/form-data" class="wines-slider-form">
            @csrf
            @include('cms.partials.wines.wines-slider-content-item')

            <div class="row">
                <div class="col-md-6 offset-md-5">
                    <div class="item-form-control tw-my-3 tw-max-w-full tw-w-full">
                        @if (!$isReadOnly)
                            <div
                                class="tw-flex tw-justify-center tw-align-middle tw-shadow-md tw-text-center hover:tw-bg-red-500 tw-border tw-border-steilgut-red hover:tw-border-transparent tw-rounded tw-text-black tw-bg-steilgut-beige tw-mb-0 tw-mt-auto item-form-control-btn">
                                <button type="submit"
                                    class="tw-text-gray-600 tw-font-semibold hover:tw-text-white tw-py-2 tw-w-full focus:tw-outline-none">
                                    Save
                                </button>
                            </div>
                        @endif
                        <div
                            class="tw-flex tw-text-center tw-border hover:tw-bg-steilgut-gold tw-border-steilgut-red hover:tw-border-transparent tw-rounded tw-shadow-md tw-text-black tw-bg-steilgut-beige tw-mb-0 tw-mt-auto item-form-control-btn">
                            <a class="tw-w-full tw-my-auto tw-text-gray-600 tw-font-semibold tw-no-underline hover:tw-no-underline hover:tw-text-white tw-py-2"
                                href="{{ route('admin.dashboard.wines-slider') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('exp_footer')
@endsection
