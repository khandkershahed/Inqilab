<x-admin-app-layout :title="'Category Edit'">
    <div class="card card-flash">
        <div class="mt-6 card-header">
            <div class="card-title"></div>
            <div class="card-toolbar">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light-info">

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
        <div class="pt-0 card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 mb-7">
                        <x-metronic.label for="name"
                            class="col-form-label required fw-bold fs-6">{{ __('Category Name') }}</x-metronic.label>
                        <x-metronic.input id="name" type="text" name="name" placeholder="Enter the name"
                            :value="old('name', $category->name)"></x-metronic.input>
                    </div>
                    <div class="col-lg-6 mb-7">
                        <x-metronic.label for="bangla_name"
                            class="col-form-label required fw-bold fs-6">{{ __('Category Bangla Name') }}</x-metronic.label>
                        <x-metronic.input id="bangla_name" type="text" name="bangla_name"
                            placeholder="Enter the Bangla name" :value="old('bangla_name', $category->bangla_name)"></x-metronic.input>
                    </div>

                    <div class="col-lg-2 mb-7">
                        <x-metronic.label for="status" class="col-form-label required fw-bold fs-6">
                            {{ __('Select a Status ') }}</x-metronic.label>
                        <x-metronic.select-option id="status" name="status" data-hide-search="true"
                            data-placeholder="Select an option">
                            <option></option>
                            <option value="active" @selected($category->status == 'active')>Active</option>
                            <option value="inactive" @selected($category->status == 'inactive')>Inactive</option>
                        </x-metronic.select-option>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="parent_id"
                            class="col-form-label fw-bold fs-6">{{ __('Select a parent Category') }}</x-metronic.label>
                        <x-metronic.select-option id="parent_id" name="parent_id" data-hide-search="false"
                            data-placeholder="Select an option">
                            <option></option>
                            {!! $categoriesOptions !!}
                        </x-metronic.select-option>
                    </div>


                    <div class="col-lg-3 mb-7">
                        <x-metronic.label for="code"
                            class="col-form-label required fw-bold fs-6">{{ __('Category Code') }}</x-metronic.label>
                        <x-metronic.input id="code" type="text" name="code" placeholder="Category Code"
                            :value="old('code', $category->code)"></x-metronic.input>
                    </div>
                    <div class="col-lg-3 mb-7">
                        <x-metronic.label for="serial"
                            class="col-form-label required fw-bold fs-6">{{ __('Category serial') }}</x-metronic.label>
                        <x-metronic.input id="serial" type="text" name="serial" placeholder="Category serial"
                            :value="old('serial', $category->serial)"></x-metronic.input>
                    </div>
                    <div class="col-lg-12 mb-7">
                        <x-metronic.label for="description" class="col-form-label fw-bold fs-6 ">{{ __('Description') }}
                        </x-metronic.label>

                        <x-metronic.textarea id="description" :value="old('description', $category->description)"
                            name="description">{{ old('description', $category->description) }}</x-metronic.textarea>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="fas fa-image"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="logo"
                                    value="{{ $category->logo }}" placeholder="Image Path">
                            </div>
                            <div class="col-4">
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    <img width="150px" src="{{ $category->logo }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="image"
                            class="col-form-label fw-bold fs-6 required">{{ __('Thumbnail Image') }}
                        </x-metronic.label>

                        <x-metronic.file-input id="image" name="image" :source="asset('storage/' . $category->image)"
                            :value="old('image', $category->image)"></x-metronic.file-input>
                    </div>
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="banner_image"
                            class="col-form-label fw-bold fs-6 ">{{ __('Banner Image') }}
                        </x-metronic.label>

                        <x-metronic.file-input id="banner_image" :source="asset('storage/' . $category->banner_image)" :value="old('banner_image', $category->banner_image)"
                            name="banner_image"></x-metronic.file-input>
                    </div>

                </div>

                <div class="text-end pt-15">

                    <x-metronic.button type="submit"
                        class="px-5 dark rounded-1">{{ __('Update Data') }}</x-metronic.button>

                </div>

            </form>
        </div>
    </div>

</x-admin-app-layout>
