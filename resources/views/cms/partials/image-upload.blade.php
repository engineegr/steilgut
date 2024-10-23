<div class="upload-box tw-rounded-lg tw-overflow-hidden tw-shadow-lg">
    <img src="{{ $image }}" class="upload-box-img" />
    @if (!$isReadOnly)
        <div class="upload-box-content tw-flex tw-w-full tw-h-screen 
        tw-items-center tw-justify-center tw-bg-grey-lighter tw-opacity-50">
            <label class="tw-w-64 tw-flex tw-flex-col tw-items-center tw-px-4 tw-py-6 tw-bg-white 
        tw-text-blue-500 tw-rounded-lg tw-shadow-lg tw-tracking-wide tw-uppercase tw-border tw-border-blue-500 
        tw-cursor-pointer hover:tw-bg-blue-500 hover:tw-text-white">
                <svg class="tw-w-8 tw-h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                </svg>
                <span class="tw-mt-2 tw-text-base tw-leading-normal">Select a file</span>
                <input type='file' name='itemImage' class="tw-hidden" />
            </label>
        </div>
    @endif
</div>
