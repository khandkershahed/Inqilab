<x-admin-app-layout :title="'Contact List'">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-2 mt-5 card">

                {{-- Header with title and create button --}}
                <div class="px-2 card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Manage Contacts List</h2>
                </div>

                {{-- Table section --}}
                <div class="p-0 card-body">
                    <table id="dataTableSet" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="text-gray-800 fw-bold fs-6 px-7">
                                <th>Sl</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $key => $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $contact->code }}
                                    </td>
                                    <td>
                                        {{ $contact->name }}
                                    </td>
                                    <td>
                                        {{ $contact->email }}
                                    </td>
                                    <td>
                                        {{ $contact->phone }}
                                    </td>
                                    <td>
                                        <p>
                                            <span class="badge bg-danger">
                                                {{ $contact->status }}
                                            </span>
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <div class="gap-2 d-flex justify-content-end">
                                            <a href="{{ route('admin.contact.edit', $contact->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill">
                                                <i class="text-white fas fa-pen-to-square fs-6 ps-2"></i>
                                            </a>
                                            <a href="{{ route('admin.contact.destroy', $contact->id) }}"
                                                class="btn btn-sm btn-danger rounded-pill delete"
                                                data-kt-docs-table-filter="delete_row">
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
