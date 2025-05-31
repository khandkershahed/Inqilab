<x-admin-app-layout :title="'All Category List'">

    <div class="row">
        <div class="col-lg-12">
            <div class="p-2 mt-5 card">

                {{-- Header with title and create button --}}
                <div class="px-2 card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Manage Category List</h2>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Create New News Post">
                        <i class="fas fa-plus"></i> Create Category
                    </a>
                </div>

                {{-- Table section --}}
                <div class="p-0 card-body">
                    <table id="dataTableSet" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="text-gray-800 fw-bold fs-6 px-7">
                                <th>Sl</th>
                                <th>Icon</th>
                                <th>Category</th>
                                <th>Bangla Category</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img width="70" height="70" class="img-fluid rounded-2"
                                            src="https://v2.weeklyinqilab.com/storage/{{ $category->logo }}  "
                                            alt="{{ $category->page_name }}">
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        {{ $category->bangla_name }}
                                    </td>
                                    <td>
                                        {{ $category->slug }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $category->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($category->status) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="gap-2 d-flex justify-content-end">
                                            {{-- <a href="{{ route('admin.categories.show', $child->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill">
                                                <i class="text-white fas fa-eye fs-6 ps-2"></i>
                                            </a> --}}
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill">
                                                <i class="text-white fas fa-pen-to-square fs-6 ps-2"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.destroy', $category->id) }}"
                                                class="btn btn-sm btn-danger rounded-pill delete"
                                                data-kt-docs-table-filter="delete_row">
                                                <i class="text-white fas fa-trash fs-6 ps-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- @foreach ($category->children as $child)
                                    <tr>
                                        <td>
                                            <span class="fw-bolder">
                                                {{ $loop->parent->iteration }}.{{ $loop->iteration }}</span>

                                        </td>
                                        <td>
                                            <span class="fw-bolder"> -- {{ $child->name }}</span>

                                        </td>
                                        <td>
                                            <span class="fw-bolder"> {{ $child->slug }}</span>

                                        </td>
                                        <td>
                                            <div
                                                class="badge {{ $child->status == 'active' ? 'badge-light-success' : 'badge-light-danger' }}">
                                                {{ $child->status == 'active' ? 'Active' : 'InActive' }}
                                            </div>

                                        </td>
                                        <td>
                                            <span class="fw-bolder">
                                                {{ $child->parent->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.categories.show', $child->id) }}"
                                                class="menu-link"><i
                                                    class="fa-solid fa-eye text-success me-4 fs-4"></i></a>
                                            <a href="{{ route('admin.categories.edit', $child->id) }}"
                                                class="menu-link"><i
                                                    class="fa-solid fa-edit text-primary me-4 fs-4"></i></a>
                                            <a href="{{ route('admin.categories.destroy', $child->id) }}"
                                                class="menu-link delete"><i
                                                    class="fa-solid fa-trash text-danger fs-4"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
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
