<x-admin-app-layout :title="'Inqilab || Admin Dashboard'">

    <style>
        .bxs-star {
            color: #f7941d;
        }
    </style>

    {{-- @if (Auth::guard('admin')->user()->status == 'active')
        <div class="row gy-5 g-xl-8">
            @php
                $hour = \Carbon\Carbon::now('Asia/Dhaka')->format('H');
                $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
            @endphp

            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="rounded card-header align-items-start h-200px" style="background-color: #023154">
                        <h2 class="text-white pt-15" style="font-size: 22px">
                            <span class="mb-3 fw-bold">{{ $greeting }} :
                                {{ Auth::guard('admin')->user()->name }}</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
    {{-- New Design Emplement --}}
    <section class="mt-2">
        <div class="row gx-5 gx-xl-5">
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-newspaper fs-1"></i><span class="text-white fs-1 ps-4">
                                Active News</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                {{ $active_news ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-list fs-1"></i><span class="text-white fs-1 ps-4">
                                Categories</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                {{-- @dd($active_categories) --}}
                                {{ $active_categories }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-spinner fs-1"></i><span class="text-white fs-1 ps-4">Pending
                                News</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                {{ $pending_news ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-close fs-1"></i><span class="text-white fs-1 ps-4">Rejected
                                News</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                {{ $unpublished_news ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fab fa-adversal fs-1"></i><span class="text-white fs-1 ps-4">Total
                                Advertisment</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                {{ $active_advertisements ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fab fa-adversal fs-1"></i><span class="text-white fs-1 ps-4">Pending
                                Advertisment</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                {{ $pending_advertisements ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fab fa-adversal fs-1"></i><span class="text-white fs-1 ps-4">Expire
                                Advertisment</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                {{ $expired_advertisements ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p
                            class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-user fs-1"></i><span class="text-white fs-1 ps-4">User
                                Visit</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                0
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="p-2 mt-10 card">
                    <div class="p-0 card-body">
                        <table id="allNewsList" class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                            <thead>
                                <tr class="text-gray-800 fw-bold fs-6 px-7">
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Author</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newses as $news)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div>
                                                <img width="70" height="70" class="img-fluid rounded-2"
                                                    src="{{ $news->thumbnail }}" alt="{{ $news->bangla_name }}">
                                            </div>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $("#allNewsList").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row mb-2'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
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
