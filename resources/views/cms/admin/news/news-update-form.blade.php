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

        <form action="{{ route('admin.dashboard.news.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('cms.partials.news.news-content-item')
            <div class="item-form-control tw-my-3">
                @if (!$isReadOnly)
                    <div
                        class="item-form-control-btn-container tw-flex tw-justify-center tw-align-middle tw-shadow-md tw-h-full tw-text-center hover:tw-bg-red-500  
                                                                                                                    tw-border tw-border-blue-500 hover:tw-border-transparent tw-rounded">
                        <button type="submit"
                            class="tw-text-gray-600 tw-font-semibold hover:tw-text-white 
                                                                                                                            tw-py-2 tw-w-full focus:tw-outline-none">
                            Save
                        </button>
                    </div>
                @endif
                <div
                    class="item-form-control-btn-container tw-flex tw-text-center tw-border hover:tw-bg-orange-400 
                                                                                                            tw-border-blue-500 hover:tw-border-transparent tw-rounded tw-h-full tw-shadow-md">
                    <a class="tw-w-full tw-my-auto tw-text-gray-600 tw-font-semibold tw-no-underline 
                                                                                                                hover:tw-no-underline hover:tw-text-white tw-py-2"
                        href="{{ route('admin.dashboard.news') }}">Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('exp_footer')
@endsection
