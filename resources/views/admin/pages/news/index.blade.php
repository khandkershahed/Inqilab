<x-admin-app-layout :title="'News List'">

    <div class="row">
        <div class="col-lg-12">
            <div class="p-2 mt-5 card">

                {{-- Header with title and create button --}}
                <div class="px-2 card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Manage News List</h2>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Create New News Post">
                        <i class="fas fa-plus"></i> Create News
                    </a>
                </div>

                {{-- Table section --}}
                <div class="p-0 card-body">
                    <table id="dataTableSet" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="text-gray-800 fw-bold fs-6 px-7">
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Author</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newses as $key => $news)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img width="70" height="70" class="img-fluid rounded-2"
                                            src="https://weekly-inqilab.vercel.app/_next/image?url=https%3A%2F%2Fv2.weeklyinqilab.com%2Fstorage%2Fnews%2Fthumbnail%2F54a94bb2360a30b3c42f614b8ab5c3761a864a7b87a4f1bf_LiFbnwaFrw1748495386.png&w=640&q=75"
                                            alt="News Image">
                                    </td>
                                    <td>{{ $news->bangla_title }}</td>
                                    <td>{{ optional($news->category)->bangla_name ?? optional($news->category)->name }}
                                    </td>
                                    <td>{{ optional($news->subCategory)->bangla_name ?? optional($news->subCategory)->name }}
                                    </td>
                                    <td>{{ $news->status }}</td>
                                    <td>{{ $news->published_at }}</td>
                                    <td>{{ $news->author_id }}</td>
                                    <td class="text-end">
                                        <div class="gap-2 d-flex justify-content-end">
                                            <a href="{{ route('admin.news.edit', $news->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill">
                                                <i class="text-white fas fa-pen-to-square fs-6 ps-2"></i>
                                            </a>
                                            <a href="{{ route('admin.news.destroy', $news->id) }}"
                                                class="btn btn-sm btn-danger rounded-pill">
                                                <i class="text-white fas fa-trash fs-6 ps-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- DataTables script --}}
    @push('scripts')
        <script>
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
        </script>
    @endpush

</x-admin-app-layout>
