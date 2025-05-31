<x-admin-app-layout :title="'Edit ePaper'">
    <div class="card card-flash">
        <div class="card-header">
            <div class="card-title">Edit New ePaper</div>
            <div class="card-toolbar">
                <a href="{{ route('admin.epaper.index') }}" class="btn btn-light-info">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <form method="POST" action="{{ route('admin.epaper.update',$epaper->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <!-- ePaper Name -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="epaper_name" class="fw-bold">ePaper Name</x-metronic.label>
                        <x-metronic.input type="text" id="epaper_name" name="epaper_name" :value="old('epaper_name',$epaper->epaper_name)" />
                    </div>


                    <!-- Title -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="epaper_title" class="fw-bold">Title</x-metronic.label>
                        <x-metronic.input type="text" id="epaper_title" name="epaper_title" :value="old('epaper_title',$epaper->epaper_title)" />
                    </div>

                    <!-- Post Date -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="post_date" class="fw-bold">Post Date</x-metronic.label>
                        <input type="date" class="form-control" name="post_date" value="{{ old('post_date',$epaper->post_date) }}" />
                    </div>

                    <!-- Image Path -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="epaper_image" class="fw-bold">Cover Image Path</x-metronic.label>
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="fas fa-image"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="epaper_image"
                                    value="" placeholder="Image Path">
                            </div>
                            <div class="col-4">
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    <img src="{{ $epaper->epaper_image }}" width="150px" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Alt Text -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="epaper_image_alt" class="fw-bold">Image ALT Text</x-metronic.label>
                        <x-metronic.input type="text" id="epaper_image_alt" name="epaper_image_alt"
                            :value="old('epaper_image_alt',$epaper->epaper_image_alt)" />
                    </div>

                    <!-- Image URL -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="epaper_image_url" class="fw-bold">Image URL</x-metronic.label>
                        <x-metronic.input type="url" id="epaper_image_url" name="epaper_image_url"
                            :value="old('epaper_image_url',$epaper->epaper_image_url)" />
                    </div>

                    <!-- Language -->
                    <div class="col-lg-3 mb-3">
                        <x-metronic.label for="language" class="fw-bold">Language</x-metronic.label>
                        <x-metronic.input type="text" id="language" name="language" :value="old('language',$epaper->language, 'en')" />
                    </div>

                    <!-- Page Number -->
                    <div class="col-lg-3 mb-3">
                        <x-metronic.label for="page_number" class="fw-bold">Page Number</x-metronic.label>
                        <x-metronic.input id="page_number" name="page_number" type="number"
                            :value="old('page_number',$epaper->page_number)" />
                    </div>

                    <!-- Total Pages -->
                    <div class="col-lg-3 mb-3">
                        <x-metronic.label for="total_pages" class="fw-bold">Total Pages</x-metronic.label>
                        <x-metronic.input id="total_pages" name="total_pages" type="number"
                            :value="old('total_pages',$epaper->total_pages, 1)" />
                    </div>

                    <!-- PDF URL -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="epaper_pdf_url" class="fw-bold">PDF URL</x-metronic.label>
                        <x-metronic.input type="url" id="epaper_pdf_url" name="epaper_pdf_url"
                            :value="old('epaper_pdf_url',$epaper->epaper_pdf_url)" />
                    </div>

                    <!-- Category -->
                    {{-- <div class="col-lg-6 mb-3">
                        <x-metronic.label for="epaper_category" class="fw-bold">Category</x-metronic.label>
                        <x-metronic.input id="epaper_category" name="epaper_category"
                            :value="old('epaper_category',$epaper->epaper_category)" />
                    </div> --}}

                    <!-- Tags -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="tags" class="fw-bold">Tags </x-metronic.label>
                        <input type="text" class="form-control" name="tags" id="news_Tags" placeholder="Eg: tag1, tag2"
                            value="{{ old('tags',$epaper->tags) }}" />
                    </div>

                    <!-- Publisher -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="published_by" class="fw-bold">Published By</x-metronic.label>
                        <x-metronic.input type="text" id="published_by" name="published_by" :value="old('published_by',$epaper->published_by)" />
                    </div>

                    <!-- Region -->
                    <div class="col-lg-6 mb-3">
                        <x-metronic.label for="region" class="fw-bold">Region</x-metronic.label>
                        <x-metronic.input type="text" id="region" name="region" :value="old('region',$epaper->region)" />
                    </div>

                    <!-- Is Active -->
                    <div class="col-lg-3 mb-3">
                        <x-metronic.label for="is_active" class="fw-bold">Active</x-metronic.label>
                        <x-metronic.select-option name="is_active" id="is_active" data-hide-search="true">
                            <option value="1" @selected(old('is_active',$epaper->is_active, 1) == 1)>Yes</option>
                            <option value="0" @selected(old('is_active',$epaper->is_active) == 0)>No</option>
                        </x-metronic.select-option>
                    </div>

                </div>

                <div class="text-end pt-10">
                    <button type="submit" class="btn btn-dark px-5">Submit</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // The DOM elements you wish to replace with Tagify
                var input1 = document.querySelector("#news_Tags");
                var input3 = document.querySelector("#news_meta_keyword");
                // Initialize Tagify components on the above inputs
                new Tagify(input1);
                new Tagify(input3);
            });
        </script>
    @endpush
</x-admin-app-layout>
