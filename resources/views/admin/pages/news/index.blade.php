<x-admin-app-layout :title="'News List'">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-2 mt-5 card">
                {{-- Header with title and create button --}}
                <div class="px-2 card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Manage News List</h2>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary w-200px" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Create New News Post">
                        <i class="fas fa-plus"></i> Create News
                    </a>
                </div>

                {{-- Table section --}}
                <div class="p-0 card-body">
                    <table id="dataTableSet" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="text-gray-800 fw-bold fs-6 px-7">
                                <th width="3%">Sl</th>
                                <th width="15%">Image</th>
                                <th width="25%">Title</th>
                                <th width="10%">Category</th>
                                <th width="8%">Status</th>
                                <th width="9%">Date</th>
                                {{-- <th width="8%">Author</th> --}}
                                <th width="12%" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($newses as $key => $news)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img width="70" height="70" class="img-fluid rounded-2"
                                            src="{{ $news->thumbnail }}" alt="{{ $news->bangla_title }}">
                                    </td>
                                    <td>{{ $news->bangla_title }}</td>
                                    <td>{{ optional($news->category)->bangla_name ?? optional($news->category)->name }}
                                    </td>
                                    <td>{{ $news->status }}</td>
                                    <td>{{ $news->published_at }}</td>
                                    <td>{{ optional($news->author)->name }}</td>
                                    <td class="text-end">
                                        <div class="gap-2 d-flex justify-content-end">
                                            <a href="{{ route('admin.news.edit', $news->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill">
                                                <i class="text-white fas fa-pen-to-square fs-6 ps-2"></i>
                                            </a>
                                            <a href="{{ route('admin.news.destroy', $news->id) }}"
                                                class="btn btn-sm btn-danger rounded-pill delete">
                                                <i class="text-white fas fa-trash fs-6 ps-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- DataTables script --}}
    {{-- @push('scripts')
        <script>
            $(document).ready(function() {
                $("#dataTableSet").DataTable({
                    language: {
                        lengthMenu: "Show _MENU_",
                    },
                    dom: "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                        ">" +
                        "<'table-responsive'tr>" +
                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">"
                });
            });
        </script>
    @endpush --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#dataTableSet').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.news.ajax') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'thumbnail',
                            name: 'thumbnail',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'bangla_title',
                            name: 'bangla_title'
                        },
                        {
                            data: 'category',
                            name: 'category.name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'published_at',
                            name: 'published_at'
                        },
                        // {
                        //     data: 'author',
                        //     name: 'author.name'
                        // },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    language: {
                        lengthMenu: "Show _MENU_",
                    },
                    dom: "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                        ">" +
                        "<'table-responsive'tr>" +
                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">"
                });
            });
        </script>
    @endpush


</x-admin-app-layout>
