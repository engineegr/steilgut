@extends('cms.layouts.wines.wines-catalog-item')
@section('wines-control-section')
    @parent

    <div class="tw-inline-flex tw-w-full tw-items-center tw-justify-end tw-mt-2 wines-catalog-list">
        <div class="edit-review-item tw-text-center tw-shadow-md hover:tw-bg-white tw-bg-gray-100 tw-mr-2 tw-w-1/2">
            <a class="tw-rounded tw-w-full tw-inline-block hover:tw-bg-yellow-600 hover:tw-text-gray-900
                        tw-text-gray-500 tw-font-semibold hover:tw-border-blue-400 tw-py-2
                        tw-no-underline hover:tw-no-underline tw-h-full"
                href="{{ route('admin.dashboard.wines-catalog.edit', $item->id) }}">Edit</a>
        </div>
        {{-- Don't have a deletion logic for wine dictionary records --}}
        <div
            class="tw-shadow-md tw-text-center hover:tw-bg-red-500 tw-shadow-md tw-border tw-border-blue-500 hover:tw-border-transparent tw-rounded disabled-element tw-w-1/2">
            {{-- <form action="{{ route('admin.dashboard.wines-catalog.destroy', $item->id) }}" method="POST"> --}}
                {{-- @csrf --}}
                <button type="submit" class="tw-text-gray-600 tw-font-semibold hover:tw-text-white 
                                                                tw-py-2 tw-px-8 focus:tw-outline-none">

                    Delete
                </button>
            {{-- </form> --}}
        </div>
    </div>
    @overwrite
