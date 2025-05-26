<x-admin-app-layout :title="'Advertisement List'">
    <div class="card">
        <div class="card-header bg-dark align-items-center d-flex justify-content-between">
            <div>
                <h1 class="mb-0 text-center w-100 text-white">Manage Your Advertisement</h1>
            </div>
            <div>
                <a href="{{ route('admin.advertisement.create') }}" class="btn btn-white rounded-2">
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
                    Create Ad
                </a>
            </div>
        </div>
        <div class="card-body py-0">
            <table class="table my-datatable table-striped table-row-bordered gy-5 gs-7">
                <thead class="bg-light-danger">
                    <tr class=" text-white fw-bolder fs-7 text-uppercase gs-0">
                        <th width="5%">Sl</th>
                        <th width="15%" class="text-center">Thumbnail Image</th>
                        <th width="15%" class="text-center">Background Image</th>
                        <th width="20%">Page Name</th>
                        <th width="15%">Creacted At</th>
                        <th width="10%">Status</th>
                        <th width="20%" class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if ($advertisements)
                        @foreach ($advertisements as $advertisement)
                            <tr class="odd">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    <img class="w-50px h-50px"
                                        src="{{ !empty(optional($advertisement)->image) ? asset('storage/' . optional($advertisement)->image) : asset('images/no_image.jpg') }}"
                                        alt="{{ $advertisement->page_name }}">
                                </td>
                                <td class="text-center">
                                    <img class="w-50px h-50px"
                                        src="{{ !empty(optional($advertisement)->bg_image) ? asset('storage/' . optional($advertisement)->bg_image) : asset('images/no_image.jpg') }}"
                                        alt="{{ $advertisement->page_name }}">
                                </td>
                                <td class="text-info">
                                    {{ ucwords(str_replace(['_', '-', ',', '.', ';'], ' ', $advertisement->page_name)) }}
                                </td>
                                <td>
                                    {{ $advertisement->created_at->format('d F Y') }}
                                </td>
                                <td>
                                    <span class="badge {{ $advertisement->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $advertisement->status == 'active' ? 'Active' : 'InActive' }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        data-bs-toggle="modal" data-bs-target="#faqViewModal_{{ $advertisement->id }}">
                                        <i class="fa-solid fa-expand"></i>
                                    </a>
                                    <a href="{{ route('admin.advertisement.edit', $advertisement->id) }}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="{{ route('admin.advertisement.destroy', $advertisement->id) }}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete"
                                        data-kt-docs-table-filter="delete_row">
                                        <i class="fa-solid fa-trash-can-arrow-up"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif --}}
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
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
