<x-admin-app-layout :title="'Faq List'">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-2 mt-5 card">

                {{-- Header with title and create button --}}
                <div class="px-2 card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Manage Faq List</h2>
                </div>

                {{-- Table section --}}
                <div class="p-0 card-body">
                    <table id="dataTableSet" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="text-gray-800 fw-bold fs-6 px-7">
                                <th width="5%">Sl</th>
                                <th width="20%">Question</th>
                                <th width="45%">Ans</th>
                                <th width="20%">Status</th>
                                <th width="10%" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    {{-- {{ $faq->question }} --}}
                                    Lorem ipsum dolor sit amet?
                                </td>
                                <td>
                                    {{-- {{ $faq->answer }} --}}
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque vero ullam illo.
                                    Possimus maiores vero deserunt consequuntur voluptatem blanditiis inventore!
                                </td>
                                <td>
                                    {{-- <p>
                                        <span class="badge {{ $faq->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($faq->status) }}
                                        </span>
                                    </p> --}}
                                    <p>
                                        <span class="badge bg-success">active</span>
                                    </p>
                                </td>

                                <td class="text-end">
                                    <div class="gap-2 d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-primary rounded-pill">
                                            <i class="text-white fas fa-pen-to-square fs-6 ps-2"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger rounded-pill">
                                            <i class="text-white fas fa-trash fs-6 ps-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
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

    {{-- <div class="card card-flash">
        <div class="mt-6 card-header">
            <div class="card-title"></div>
            <div class="card-toolbar">
                <a href="{{ route('admin.faq.create') }}" class="btn btn-light-primary">
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
                    Add Faq
                </a>

            </div>
        </div>

        <div class="pt-0 card-body">
            <table id="kt_datatable_example_5" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                <thead class="bg-dark text-light">
                    <tr>
                        <th width="2%">No</th>
                        <th width="30%">Question</th>
                        <th width="5%">Status</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">

                        <tr>
                            <td>1</td>

                            <td class="text-start">{{ $faq->question }}</td>

                            <td class="text-start">
                                <p>
                                    <span class="badge {{ $faq->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($faq->status) }}
                                    </span>
                                </p>

                            </td>


                            <td>
                                <a href="{{ route('admin.faq.edit', $faq->id) }}" class="">
                                    <i class="fa-solid fa-edit text-primary me-1 fs-4"></i>
                                </a>
                                <a href="{{ route('admin.faq.destroy', $faq->id) }}" class="delete">
                                    <i class="fa-solid fa-trash text-danger fs-4"></i>
                                </a>

                            </td>
                        </tr>

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
    @endpush --}}


</x-admin-app-layout>
