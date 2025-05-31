<x-admin-app-layout :title="'Advertisement List'">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-2 mt-5 card">

                {{-- Header with title and create button --}}
                <div class="px-2 card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Manage Advertisement List</h2>
                    <a href="{{ route('admin.advertisement.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Create New News Post">
                        <i class="fas fa-plus"></i> Create Advertisement
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
                                <th>Ad Position</th>
                                <th>Start</th>
                                <th>Expired</th>
                                <th>Status</th>
                                <th>Company Name</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($advertisements)
                                @foreach ($advertisements as $advertisement)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img width="70" height="70" class="img-fluid rounded-2"
                                                src="{{ !empty(optional($advertisement)->image_path) ? url(optional($advertisement)->image_path) : asset('images/no_image.jpg') }}"
                                                alt="{{ $advertisement->page_name }}">
                                        </td>
                                        <td>{{ $advertisement->page_name }}</td>
                                        <td>
                                            <p class="text-info">
                                                {{ ucwords(str_replace(['_', '-', ',', '.', ';'], ' ', $advertisement->position)) }}
                                            </p>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($advertisement->start_date)->format('d F Y') }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($advertisement->end_date)->format('d F Y') }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $advertisement->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($advertisement->status) }}</span>
                                        </td>
                                        <td>{{ $advertisement->company_name }}</td>
                                        <td class="text-end">
                                            <div class="gap-2 d-flex justify-content-end">
                                                <a href="{{ route('admin.advertisement.edit', $advertisement->id) }}"
                                                    class="btn btn-sm btn-primary rounded-pill">
                                                    <i class="text-white fas fa-pen-to-square fs-6 ps-2"></i>
                                                </a>
                                                <a href="{{ route('admin.advertisement.destroy', $advertisement->id) }}"
                                                    class="btn btn-sm btn-danger rounded-pill delete"
                                                    data-kt-docs-table-filter="delete_row">
                                                    <i class="text-white fas fa-trash fs-6 ps-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
        <script>
            $(document).ready(function() {
                $(document).on('change', '.status-toggle', function() {
                    const id = $(this).data('id');
                    const route = "{{ route('admin.advertisement.toggle-status', ':id') }}".replace(':id', id);
                    toggleStatus(route, id);
                });
            });
        </script>
    @endpush
</x-admin-app-layout>
