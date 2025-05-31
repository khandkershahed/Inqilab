<x-admin-app-layout :title="'Inqilab Dashboard'">

    <style>
        .bxs-star {
            color: #f7941d;
        }
    </style>

    @if (Auth::guard('admin')->user()->status == 'active')
        <div class="row gy-5 g-xl-8">

            {{-- Total Job --}}
            <div class="col-xl-4">
                <div class="card h-xl-100">
                    <div class="pt-5 border-0 card-header">
                        <h3 class="card-title align-items-start flex-column">
                            <span style="font-size: 20px" class="text-gray-900 card-label fw-bold">Total</span>
                        </h3>
                    </div>
                    <div class="pt-6 card-body">
                        <div class="d-flex flex-stack">
                            <div class="symbol me-5">
                                <div class="text-inverse-danger">
                                    <img src="https://ui-avatars.com/api/?name=Job+Offer&size=40" alt="Avatar">
                                </div>
                            </div>
                            <div class="flex-wrap d-flex align-items-center flex-row-fluid">
                                <div class="flex-grow-1 me-2">
                                    <a href="javascript:;"
                                        class="text-gray-800 text-hover-primary fs-6 fw-bold">AAAAA</a>
                                </div>
                            </div>
                        </div>
                        <div class="my-4 separator separator-dashed"></div>
                    </div>
                </div>
            </div>

            {{-- Greeting and Totals --}}
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
                    <div class="card-body mt-n20">
                        <div class="mt-n20 position-relative">
                            <div class="row g-3 g-lg-6">
                                @php
                                    $infoBoxes = [
                                        ['title' => 'Total Staff', 'icon' => 'fa-check'],
                                        ['title' => 'Total User', 'icon' => 'fa-user'],
                                        ['title' => 'Total Product', 'icon' => 'fa-user-check'],
                                        ['title' => 'Total Blog', 'icon' => 'fa-briefcase'],
                                    ];
                                @endphp

                                @foreach ($infoBoxes as $box)
                                    <div class="col-6">
                                        <div class="px-6 py-5 bg-gray-100 bg-opacity-70 rounded-2">
                                            <div class="mb-8 symbol symbol-30px me-5">
                                                <span class="symbol-label">
                                                    <i class="fas {{ $box['icon'] }}"
                                                        style="font-size: 30px; color: green;"></i>
                                                </span>
                                            </div>
                                            <div class="m-0">
                                                <h4>{{ $box['title'] }}</h4>
                                                <span class="text-gray-500 fw-semibold fs-6"></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Client Review --}}
            <div class="col-xl-4">
                <div class="card h-xl-100">
                    <div class="pt-5 border-0 card-header">
                        <h3 class="card-title align-items-start flex-column">
                            <span style="font-size: 20px" class="text-gray-900 card-label fw-bold">Total Client
                                Review</span>
                        </h3>
                    </div>
                    <div class="pt-6 card-body">
                        <div class="d-flex flex-stack">
                            <div class="symbol me-5">
                                <div class="text-inverse-danger">
                                    <img src="https://ui-avatars.com/api/?name=R&size=40" alt="Avatar">
                                </div>
                            </div>
                            <div class="flex-wrap d-flex align-items-center flex-row-fluid">
                                <div class="flex-grow-1 me-2">
                                    <a href="javascript:;"
                                        class="text-gray-800 text-hover-primary fs-6 fw-bold">AAAAAA</a>
                                    <span class="text-muted fw-semibold d-block fs-7">Position: AAAAA</span>
                                </div>
                                <a href="javascript:;" class="">AAAAAA</a>
                            </div>
                        </div>
                        <div class="my-4 separator separator-dashed"></div>
                    </div>
                </div>
            </div>

        </div>
    @else
        {{-- <p class="text-danger">Admin is not approved yet.</p>
        <span class="text-danger">Please wait. Super admin will approve your account as soon as possible.</span> --}}
    @endif
    {{-- New Design Emplement --}}
    <section class="mt-2">
        <div class="row gx-5 gx-xl-5">
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-newspaper fs-1"></i><span class="text-white fs-1 ps-4">
                                News Available</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                60
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-list fs-1"></i><span class="text-white fs-1 ps-4">
                                Category</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                60
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-spinner fs-1"></i><span class="text-white fs-1 ps-4">Pending
                                News</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                60
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-close fs-1"></i><span class="text-white fs-1 ps-4">Rejected
                                News</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                60
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fab fa-adversal fs-1"></i><span class="text-white fs-1 ps-4">Total Advertisment</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                60
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fab fa-adversal fs-1"></i><span class="text-white fs-1 ps-4">Pending Advertisment</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                60
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fab fa-adversal fs-1"></i><span class="text-white fs-1 ps-4">Expire Advertisment</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                                60
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-5 card card-flush">
                    <div>
                        <p class="px-10 py-5 dashboard-bg bg-primary rounded-2 d-flex align-items-center justify-content-center">
                            <i class="text-white fas fa-user fs-1"></i><span class="text-white fs-1 ps-4">User Visit</span>
                        </p>
                        <div class="text-center ps-5">
                            <span style="font-size: 60px">
                               1060
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
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div>
                                            <img width="70" height="70" class="img-fluid rounded-2"
                                            src="https://weekly-inqilab.vercel.app/_next/image?url=https%3A%2F%2Fv2.weeklyinqilab.com%2Fstorage%2Fnews%2Fthumbnail%2F54a94bb2360a30b3c42f614b8ab5c3761a864a7b87a4f1bf_LiFbnwaFrw1748495386.png&w=640&q=75"
                                            alt="">
                                        </div>
                                    </td>
                                    <td>Omnis sit rerum qui veniam doloribus ist</td>
                                    <td>National</td>
                                    <td>Approved</td>
                                    <td>Feb 13 , 2025</td>
                                    <td>Inqilab</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="" class="text-center rounded-pill btn btn-primary btn-sm">
                                                <i class="text-white fs-6 fas fa-pen-to-square ps-2"></i>
                                            </a>
                                            <a href="" class="text-center rounded-pill btn btn-primary btn-sm">
                                                <i class="text-white fs-6 fas fa-trash ps-2"></i>
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
