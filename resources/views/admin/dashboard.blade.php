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
        <p class="text-danger">Admin is not approved yet.</p>
        <span class="text-danger">Please wait. Super admin will approve your account as soon as possible.</span>
    @endif

</x-admin-app-layout>
