<x-admin-app-layout :title="'News Edit'">
    <style>
        .image-input-empty {
            background-image: url({{ asset('admin/assets/media/svg/files/blank-image.svg') }});
        }

        /* Custom Multi file upload */
        .img-thumb {
            border: 2px solid none;
            border-radius: 3px;
            padding: 1px;
            cursor: pointer;
            width: 70px;
            height: 60px;
            border-radius: 0.475rem;
        }


        .img-thumb-wrapper {
            display: inline-block;
            margin: 1rem 1rem 0 0;
        }


        .remove {
            display: block;
            background: #cf054f;
            border: 1px solid none;
            color: white;
            text-align: center;
            cursor: pointer;
            font-size: 12px;
            padding: 2px 5px;
        }


        .remove:hover {
            background: white;
            color: black;
        }


        .dropzone-field {
            border: 1px dashed #009ef7;
            display: flex;
            flex-wrap: wrap;
            /* Allow multiple images in a row */
            align-items: center;
            border-radius: 4px;
            padding: 10px 5px;
            justify-content: center;
        }


        #files {
            display: none;
        }


        .custom-file-upload {
            border: 0px solid #ccc;
            padding: 6px 12px;
            cursor: pointer;
            background-color: transparent;
        }


        .custom-file-upload i {
            margin-right: 5px;
        }

        /* Custom Multi file upload */
    </style>
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_ecommerce_update_news_form" method="POST" action="{{ route('admin.news.update', $news->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="gap-7 gap-lg-10 col-9">
                    <ul class="border-0 nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x fs-4 fw-semibold mb-n2">
                        <li class="nav-item">
                            <a class="pb-4 nav-link text-active-primary active" data-bs-toggle="tab"
                                href="#general">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="pb-4 nav-link text-active-primary" data-bs-toggle="tab" href="#media">Media</a>
                        </li>
                        <li class="nav-item">
                            <a class="pb-4 nav-link text-active-primary" data-bs-toggle="tab" href="#news_content">News
                                Content</a>
                        </li>
                        <li class="nav-item">
                            <a class="pb-4 nav-link text-active-primary" data-bs-toggle="tab" href="#news_type">News
                                Type</a>
                        </li>
                        <li class="nav-item">
                            <a class="pb-4 nav-link text-active-primary" data-bs-toggle="tab" href="#meta_options">Meta
                                Options</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                {{-- General Info --}}
                                <div class="py-4 mt-3 card card-flush">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <div class="pt-0 card-body">
                                        {{-- <div class="mb-5 fv-row">
                                            <x-metronic.label class="form-label">News English Title</x-metronic.label>
                                            <x-metronic.input type="text" name="title" class="mb-2 form-control"
                                                placeholder="News English Title" :value="old('title', $news->title)">
                                            </x-metronic.input>
                                            <div class="text-muted fs-7">
                                                News English Title is required for slug and recommended to be unique.
                                            </div>
                                        </div> --}}
                                        <div class="mb-5 fv-row">
                                            <x-metronic.label class="form-label">News Bangla Title</x-metronic.label>
                                            <x-metronic.input type="text" name="bangla_title"
                                                class="mb-2 form-control" placeholder="News Bangla Title"
                                                :value="old('bangla_title', $news->bangla_title)">
                                            </x-metronic.input>
                                            <div class="text-muted fs-7">
                                                News Bangla Title is required and recommended to be unique.
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <x-metronic.label class="form-label">Tags</x-metronic.label>
                                            <input class="form-control" name="tags" id="news_Tags"
                                                placeholder="Eg: tag1, tag2" value="{{ old('tags', $news->tags) }}" />
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <x-metronic.label class="form-label">Summary</x-metronic.label>
                                            <x-metronic.textarea id="summary" name="summary"
                                                placeholder="News Summary" class="mb-2 form-control" cols="30"
                                                rows="3">{!! old('summary', $news->summary) !!}</x-metronic.textarea>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <x-metronic.label class="form-label">Summary Bangla</x-metronic.label>
                                            <x-metronic.textarea id="bangla_summary" name="bangla_summary"
                                                placeholder="Summary Bangla" class="mb-2 form-control" cols="30"
                                                rows="3">{!! old('bangla_summary', $news->bangla_summary) !!}</x-metronic.textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="media" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                {{-- Inventory --}}
                                <div class="py-4 card card-flush">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Media</h2>
                                        </div>
                                    </div>
                                    <div class="py-4 mt-3 card-body">
                                        <div class="row">
                                            <div class="col-lg-6 mb-7">
                                                <div>
                                                    <x-metronic.label for="" class="form-label">Thumbnail image
                                                        (Only *.png,, *.webp *.jpg and *.jpeg)</x-metronic.label>
                                                </div>
                                                <div class="image-input image-input-empty" data-kt-image-input="true"
                                                    style="background-image: url({{ asset('storage/' . $news->thumbnail) }}); width: auto; background-size: contain;
                                                    background-position: center;
                                                    border: 1px solid #009ae5;">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-size: contain; background-position: center">
                                                    </div>
                                                    <label
                                                        class="shadow btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" name="thumbnail"
                                                            accept=".png, .jpg, .jpeg, .webp" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>

                                                    <span
                                                        class="shadow btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>

                                                    <span
                                                        class="shadow btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Remove avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-7">
                                                <div>
                                                    <x-metronic.label for="" class="form-label">Banner image
                                                        (Only
                                                        *.png,, *.webp *.jpg and *.jpeg)</x-metronic.label>
                                                </div>
                                                <div class="image-input image-input-empty" data-kt-image-input="true"
                                                    style="background-image: url({{ asset('storage/' . $news->banner_image) }}); width: auto; background-size: contain;
                                                    background-position: center;
                                                    border: 1px solid #009ae5;">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-size: contain; background-position: center">
                                                    </div>

                                                    <label
                                                        class="shadow btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>

                                                        <input type="file" name="banner_image"
                                                            accept=".png, .jpg, .jpeg, .webp" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>

                                                    <span
                                                        class="shadow btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>

                                                    <span
                                                        class="shadow btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Remove avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="pt-5 fv-row">
                                                    <x-metronic.label for="video_url" class="form-label">News
                                                        Video Link</x-metronic.label>
                                                    <input type="text" name="video_url" class="mb-2 form-control"
                                                        placeholder="news Video Link" id="video_url"
                                                        value="{{ old('video_url', $news->video_url) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="news_content" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                {{-- Inventory --}}
                                <div class="py-4 mt-3 card card-flush">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>News Content</h2>
                                        </div>
                                    </div>
                                    <div class="pt-0 card-body row">
                                        <div class="mb-5 fv-row">
                                            <x-metronic.label class="form-label">News Content</x-metronic.label>
                                            <textarea name="content" class="ckeditor">{!! old('content', $news->content) !!}</textarea>
                                            <div class="text-muted fs-7">
                                                Add News content here.
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <x-metronic.label class="form-label">News Content Bangla</x-metronic.label>
                                            <textarea name="bangla_content" class="ckeditor">{!! old('bangla_content', $news->bangla_content) !!}</textarea>
                                            <div class="text-muted fs-7">
                                                Add News Bangla content here.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="news_type" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="py-4 mt-3 card card-flush">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>News Type</h2>
                                        </div>
                                    </div>
                                    <div class="pt-0 card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {{-- is_featured --}}
                                                <div class="form-check form-check-custom form-check-solid mb-7">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="is_featured" id="is_featured" value="1"
                                                        @checked($news->is_featured == '1')>
                                                    <label class="form-check-label" for="is_featured">
                                                        Featured News
                                                    </label>
                                                </div>
                                                {{-- is_most_read --}}
                                                <div class="form-check form-check-custom form-check-solid mb-7">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="is_most_read" id="is_most_read" value="1"
                                                        @checked($news->is_most_read == '1')>
                                                    <label class="form-check-label" for="is_most_read">
                                                        Most Read News
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-custom form-check-solid mb-7">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="show_in_slider" id="show_in_slider" value="1"
                                                        @checked($news->show_in_slider == '1')>
                                                    <label class="form-check-label" for="show_in_slider">
                                                        Show in Slider
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                {{-- is_breaking --}}
                                                <div class="form-check form-check-custom form-check-solid mb-7">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="is_breaking" id="is_breaking" value="1"
                                                        @checked($news->is_breaking == '1')>
                                                    <label class="form-check-label" for="is_breaking">
                                                        Breaking News
                                                    </label>
                                                </div>

                                                <div class="form-check form-check-custom form-check-solid mb-7">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="is_trending" id="is_trending" value="1"
                                                        @checked($news->is_trending == '1')>
                                                    <label class="form-check-label" for="is_trending">
                                                        Trending News
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="meta_options" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                {{-- Meta Options --}}
                                <div class="py-4 mt-3 card card-flush">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Meta Options</h2>
                                        </div>
                                    </div>
                                    <div class="pt-0 card-body">
                                        <div class="mb-10">
                                            <div class="mb-5 fv-row">
                                                <x-metronic.label class="form-label">News Meta
                                                    Title</x-metronic.label>
                                                <x-metronic.input type="text" name="meta_title"
                                                    class="mb-2 form-control" placeholder="News meta title"
                                                    :value="old('meta_title', $news->meta_title)">
                                                </x-metronic.input>
                                            </div>
                                            <div class="text-muted fs-7">
                                                Add news Meta Title.
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <div class="mb-5 fv-row">
                                                <x-metronic.label class="form-label">Meta
                                                    Description</x-metronic.label>
                                                <textarea name="meta_description" class="form-control">{!! old('meta_description', $news->meta_description) !!}</textarea>
                                                <div class="text-muted fs-7">
                                                    Add Meta Meta details.
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="mb-5 fv-row">
                                                <x-metronic.label class="form-label">Meta
                                                    Keywords</x-metronic.label>
                                                <input class="form-control" name="meta_keywords"
                                                    id="news_meta_keyword" placeholder="Eg: tag1, tag2"
                                                    value="{{ old('meta_keywords', $news->meta_keywords) }}" />

                                                <div class="text-muted fs-7">
                                                    Add news Meta keywords.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 d-flex justify-content-end">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-danger me-5">
                            Back To news List
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label"> Save Changes </span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="gap-7 gap-lg-10 mb-7 col-3">
                    {{-- Status Card Start --}}
                    <div class="py-4 mb-6 card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Status</h2>
                            </div>
                        </div>
                        <div class="pt-0 card-body">
                            <x-metronic.select-option id="status" class="mb-2 form-select" data-control="select2"
                                data-hide-search="true" name="status" data-placeholder="Select an option">
                                <option></option>
                                <option value="draft" @selected(old('status', $news->status) == 'draft')>Draft</option>
                                <option value="published" @selected(old('status', $news->status) == 'published')>Published</option>
                                <option value="archived" @selected(old('status', $news->status) == 'archived')>Archived</option>
                                <option value="unpublished" @selected(old('status', $news->status) == 'unpublished')>Unpublished</option>
                            </x-metronic.select-option>
                            <div class="text-muted fs-7">Set the news status.</div>
                        </div>
                    </div>
                    {{-- Status Card End --}}
                    {{-- Category Card Start --}}
                    <div class="py-4 card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Category</h2>
                            </div>
                        </div>
                        <div class="pt-0 card-body">
                            <div class="fv-row">
                                <x-metronic.label for="category_id" class="col-form-label required fw-bold fs-6">
                                    {{ __('Select Category') }}</x-metronic.label>
                                <x-metronic.select-option id="category_id" class="mb-2 form-select"
                                    name="category_id" data-control="select2" data-placeholder="Select an option"
                                    data-allow-clear="true">
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id', $news->category_id) == $category->id)>
                                            {{ $category->name }}
                                            [{{ $category->bangla_name }}]
                                        </option>
                                    @endforeach
                                </x-metronic.select-option>
                            </div>
                            <div class="fv-row">
                                <x-metronic.label for="sub_category_id" class="col-form-label fw-bold fs-6">
                                    {{ __('Select Sub Category') }}</x-metronic.label>
                                <x-metronic.select-option id="sub_category_id" class="mb-2 form-select"
                                    name="sub_category_id" data-control="select2" data-placeholder="Select an option"
                                    data-allow-clear="true">
                                    <option></option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" @selected(old('sub_category_id', $news->sub_category_id) == $subCategory->id)>
                                            {{ $subCategory->name }}
                                            [{{ $subCategory->bangla_name }}]
                                        </option>
                                    @endforeach
                                </x-metronic.select-option>
                            </div>

                        </div>
                    </div>
                    {{-- Category Card End --}}
                </div>
            </div>
        </form>
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


            // news Multiimage Submit
            var uploadedDocumentMap = {}; // Assuming you have this variable defined somewhere

            var myDropzone = new Dropzone("#news_multiimage", {
                url: "{{ route('admin.news.store') }}",
                paramName: "multi_image", // The name that will be used to transfer the file
                uploadMultiple: true,
                parallelUploads: 10,
                maxFiles: 10,
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                accept: function(file, done) {
                    console.log(file);
                    $('#kt_ecommerce_add_news_form').append(
                        '<input type="hidden" name="document[ value="{{ old('document') }}"]" value="' + file
                        .file + '">');
                    done();
                },
                method: "post",
            });

            document.getElementById('kt_ecommerce_add_news_form').addEventListener('submit', function(event) {
                var formData = new FormData(this);
                console.log(formData);
            });
            // textEditor
            class CKEditorInitializer {
                constructor(className) {
                    this.className = className;
                }

                initialize() {
                    const elements = document.querySelectorAll(this.className);
                    elements.forEach(element => {
                        ClassicEditor
                            .create(element)
                            .then(editor => {
                                console.log('CKEditor initialized:', editor);
                            })
                            .catch(error => {
                                console.error('CKEditor initialization error:', error);
                            });
                    });
                }
            }

            // Example usage:
            const ckEditorInitializer = new CKEditorInitializer('.ckeditor');
            ckEditorInitializer.initialize();
        </script>
    @endpush
</x-admin-app-layout>
