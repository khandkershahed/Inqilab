<x-admin-app-layout :title="'Advertisement Add'">
    <div class="card card-flash">
        <div class="card-header mt-6">
            <div class="card-title"></div>
            <div class="card-toolbar">
                <a href="{{ route('admin.advertisement.index') }}" class="btn btn-light-info">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                fill="currentColor" />
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                fill="currentColor" />
                        </svg>
                    </span>
                    Back to the list
                </a>
            </div>
        </div>
        <div class="card-body pt-0">

            <form method="POST" action="{{ route('admin.advertisement.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <!-- Title -->
                    <div class="col-lg-8 mb-3">
                        <x-metronic.label for="title"
                            class="col-form-label fw-bold fs-6">{{ __('Ad Title') }}</x-metronic.label>
                        <x-metronic.input id="title" type="text" name="title" placeholder="Enter the title"
                            :value="old('title')" />
                    </div>

                    <!-- Ad Type -->
                    <div class="col-lg-4 mb-3">
                        <x-metronic.label for="ad_type"
                            class="col-form-label fw-bold fs-6">{{ __('Ad Type') }}</x-metronic.label>
                        <x-metronic.select-option id="ad_type" name="ad_type" data-hide-search="true"
                            data-placeholder="Select Ad Type">
                            <option></option>
                            <option value="image">Image</option>
                            <option value="html">HTML</option>
                            <option value="video">Video</option>
                            <option value="script">Script</option>
                        </x-metronic.select-option>
                    </div>

                    <!-- Image Path (File Manager) -->
                    <div class="col-lg-6 mb-3">
                        <div>
                            <x-metronic.label for="image" class="col-form-label fw-bold fs-6">{{ __('AD Image') }}
                            </x-metronic.label>
                        </div>
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="fas fa-image"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="image_path"
                                    value="{{ old('image_path') }}" placeholder="Image Path">
                            </div>
                            <div class="col-4">
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Video Path -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="video_path"
                            class="col-form-label fw-bold fs-6">{{ __('Video AD Path or Embed') }}</x-metronic.label>
                        <x-metronic.textarea id="video_path" name="video_path" rows="3"
                            placeholder="Enter video URL or embed code">{{ old('video_path') }}</x-metronic.textarea>
                    </div>

                    <!-- HTML Code -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="html_code"
                            class="col-form-label fw-bold fs-6">{{ __('Custom HTML Code') }}</x-metronic.label>
                        <x-metronic.textarea id="html_code" name="html_code" rows="3"
                            placeholder="Enter custom HTML">{{ old('html_code') }}</x-metronic.textarea>
                    </div>

                    <!-- Link -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="link"
                            class="col-form-label fw-bold fs-6">{{ __('Link (Ad URL)') }}</x-metronic.label>
                        <x-metronic.input id="link" type="url" name="link" placeholder="Enter link URL"
                            :value="old('link')" />
                    </div>

                    <!-- Target Blank -->
                    <div class="col-lg-2 col-4 mb-3">
                        <x-metronic.label for="target_blank"
                            class="col-form-label fw-bold fs-6">{{ __('Open in New Tab?') }}</x-metronic.label>
                        <x-metronic.select-option id="target_blank" name="target_blank" data-hide-search="true">
                            <option value="0" {{ old('target_blank') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('target_blank') == '1' ? 'selected' : '' }}>Yes</option>
                        </x-metronic.select-option>
                    </div>

                    <!-- Position -->
                    <div class="col-lg-4 col-8 mb-3">
                        <x-metronic.label for="position"
                            class="col-form-label fw-bold fs-6">{{ __('AD Position') }}</x-metronic.label>

                        <x-metronic.select-option id="position" name="position" data-hide-search="true">
                            <option value="0" {{ old('position') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('position') == '1' ? 'selected' : '' }}>Yes</option>
                        </x-metronic.select-option>
                    </div>

                    <!-- Price -->
                    <div class="col-lg-4 mb-3">
                        <x-metronic.label for="price"
                            class="col-form-label fw-bold fs-6">{{ __('Price ($)') }}</x-metronic.label>
                        <x-metronic.input id="price" type="number" step="0.01" name="price"
                            placeholder="Enter price" :value="old('price', 0.0)" />
                    </div>

                    <!-- Priority -->
                    <div class="col-lg-4 mb-3">
                        <x-metronic.label for="priority"
                            class="col-form-label fw-bold fs-6">{{ __('Priority') }}</x-metronic.label>
                        <x-metronic.input id="priority" type="number" name="priority" placeholder="Enter priority"
                            :value="old('priority', 0)" />
                    </div>

                    <!-- Start Date -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="start_date"
                            class="col-form-label fw-bold fs-6">{{ __('Start Date') }}</x-metronic.label>
                        <x-metronic.input id="start_date" type="date" name="start_date" :value="old('start_date')" />
                    </div>

                    <!-- End Date -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="end_date"
                            class="col-form-label fw-bold fs-6">{{ __('End Date') }}</x-metronic.label>
                        <x-metronic.input id="end_date" type="date" name="end_date" :value="old('end_date')" />
                    </div>

                    <!-- Status -->
                    <div class="col-lg-4 mb-3">
                        <x-metronic.label for="status"
                            class="col-form-label fw-bold fs-6">{{ __('Status') }}</x-metronic.label>
                        <x-metronic.select-option id="status" name="status" data-hide-search="true">
                            <option value="pending">Pending</option>
                            <option value="approved" selected>Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="expired">Expired</option>
                        </x-metronic.select-option>
                    </div>

                    <!-- Is Active -->
                    <div class="col-lg-4 mb-3">
                        <x-metronic.label for="is_active"
                            class="col-form-label fw-bold fs-6">{{ __('Is Active?') }}</x-metronic.label>
                        <x-metronic.select-option id="is_active" name="is_active" data-hide-search="true">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-metronic.select-option>
                    </div>

                    <!-- Company Name -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="company_name"
                            class="col-form-label fw-bold fs-6">{{ __('Company Name') }}</x-metronic.label>
                        <x-metronic.input id="company_name" type="text" name="company_name"
                            placeholder="Enter company name" :value="old('company_name')" />
                    </div>

                    <!-- Company Website -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="company_website"
                            class="col-form-label fw-bold fs-6">{{ __('Company Website') }}</x-metronic.label>
                        <x-metronic.input id="company_website" type="url" name="company_website"
                            placeholder="https://example.com" :value="old('company_website')" />
                    </div>

                    <!-- Hidden user_id or dropdown for admin -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                </div>


                <div class="text-end pt-15">

                    <x-metronic.button type="submit"
                        class="dark rounded-1 px-5">{{ __('Submit') }}</x-metronic.button>

                </div>

            </form>

        </div>
    </div>
    @push('scripts')
    @endpush
</x-admin-app-layout>
