<x-admin-app-layout :title="'News'">
    <div class="card card-flash">
        <div class="card-header mt-6">
            <div class="card-title"></div>
            <div class="card-toolbar">

                {{-- @if (Auth::guard('admin')->user()->can('add.brand')) --}}
                <a href="{{ route('admin.news.create') }}" class="btn btn-light-primary">
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
                    Add News
                </a>
                {{-- @endif --}}

            </div>
        </div>

        <div class="card-body pt-0">
            <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead class="bg-dark text-light">
                    <tr>
                        <th width="5%">Sl</th>
                        <th width="10%">Category</th>
                        <th width="10%">Sub Category</th>
                        <th width="57%">Bangla Title</th>
                        <th width="10%">Status</th>
                        <th width="8%">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-bold text-gray-600">

                    @foreach ($newses as $key => $news)
                        {{-- @dd([
                            'news_category_id' => $news->category_id,
                            'category_model' => $news->category,
                            'news_sub_category_id' => $news->sub_category_id,
                            'sub_category_model' => $news->subCategory,
                        ]); --}}
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-start">
                                {{ !empty(optional($news->category)->bangla_name) ? optional($news->category)->bangla_name : optional($news->category)->name }}
                            </td>
                            <td class="text-start">
                                {{ !empty(optional($news->subCategory)->bangla_name) ? optional($news->subCategory)->bangla_name : optional($news->subCategory)->name }}
                            </td>
                            <td class="text-start">{{ $news->bangla_title }}</td>
                            <td class="text-start">
                                <p>
                                    <span class="badge {{ $news->status == 'published' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($news->status) }}
                                    </span>
                                </p>
                            </td>


                            <td>
                                {{-- @if (Auth::guard('admin')->user()->can('edit.news')) --}}
                                <a href="{{ route('admin.news.edit', $news->id) }}" class="text-primary">
                                    <i class="fa-solid fa-edit text-primary me-7 fs-4"></i>
                                </a>
                                {{-- @endif

                                @if (Auth::guard('admin')->user()->can('delete.news')) --}}
                                <a href="{{ route('admin.news.destroy', $news->id) }}" class="delete">
                                    <i class="fa-solid fa-trash text-danger fs-4"></i>
                                </a>
                                {{-- @endif --}}

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>

    @push('scripts')
        <script>
            $("#kt_datatable_example_5").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        </script>
    @endpush

</x-admin-app-layout>
