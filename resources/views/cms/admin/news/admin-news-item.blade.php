@extends('cms.layouts.news.news-item')
@section('news-control-section')
    @parent
    <div class="edit-review-item tw-m-2 tw-text-center tw-shadow-md">
        <a class="tw-rounded tw-w-full tw-inline-block hover:tw-bg-yellow-600 hover:tw-text-gray-900
                tw-text-gray-500 tw-font-semibold hover:tw-border-blue-400 tw-py-2
                tw-no-underline hover:tw-no-underline tw-h-full "
            href="{{ route('admin.dashboard.news.edit', $item->id) }}">Edit</a>
    </div>
    <div class="tw-shadow-md tw-m-2 tw-text-center hover:tw-bg-red-500  
                                            tw-border tw-border-blue-500 hover:tw-border-transparent tw-rounded">
        <form action="{{ route('admin.dashboard.news.destroy', $item->id) }}" method="POST">
            @csrf
            <button type="submit" class="tw-text-gray-600 tw-font-semibold hover:tw-text-white 
                                                        tw-py-2 tw-px-8 focus:tw-outline-none">

                Delete
            </button>
        </form>
    </div>
    @overwrite
