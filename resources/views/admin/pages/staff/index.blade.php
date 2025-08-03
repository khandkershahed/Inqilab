<x-admin-app-layout :title="'Staff Management'">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-2 mt-5 card">

                {{-- Header with title and create button --}}
                <div class="px-2 card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Manage Staff List</h2>
                    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Create New News Post">
                        <i class="fas fa-plus"></i> Create Staff
                    </a>
                </div>

                {{-- Table section --}}
                <div class="p-0 card-body">
                    <table id="dataTableSet" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="text-gray-800 fw-bold fs-6 px-7">
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $key => $staff)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="">
                                        <img src="{{ !empty($staff->photo) ? url('storage/admin_images/' . $staff->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($staff->name) }}"
                                            height="60" width="60" alt="{{ $staff->name }}">

                                    </td>
                                    <td class="text-start">{{ $staff->name }}</td>
                                    <td class="text-start">{{ $staff->email }}</td>
                                    <td class="text-start">{{ $staff->phone }}</td>
                                    <td class="text-start">{{ $staff->designation }}</td>
                                    <td class="text-start">
                                        <p>
                                            <span
                                                class="badge {{ $staff->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($staff->status) }}
                                            </span>
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.staff.edit', $staff->id) }}"
                                            class="btn btn-sm btn-primary rounded-pill w-75px">
                                            <i class="text-white fas fa-pen-to-square fs-6 ps-2"></i>
                                        </a>
                                        <a href="{{ route('admin.staff.destroy', $staff->id) }}"
                                            class="btn btn-sm btn-primary rounded-pill w-75px delete">
                                            <i class="text-white fas fa-trash fs-6 ps-2"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
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
