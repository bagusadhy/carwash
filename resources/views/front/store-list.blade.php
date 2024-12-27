@extends('layouts.app')
@push('title')
    <title>Stores</title>
@endpush

@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-5">
        <a onclick="window.history.back()" class="cursor-pointer">
            <div class="w-10 h-10 flex shrink-0">
                <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">{{ $carService->name }}</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">{{ $city->name }}, {{ $stores->count() }} Stores</p>
        </div>
        <button class="w-10 h-10 flex shrink-0">
            <img src="{{ asset('assets/images/icons/filter.svg') }}" alt="icon">
        </button>
    </div>
    <section id="Store-list" class="flex flex-col gap-6 px-4 mt-[30px]">
        @forelse ($stores as $store)
            <a href="{{ route('store.detail', $store->slug) }}" class="card">
                <div
                    class="flex flex-col gap-4 rounded-[20px] ring-1 ring-[#E9E8ED] pb-4 bg-white overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                    <div class="w-full h-[120px] flex shrink-0 overflow-hidden relative">
                        <img src="{{ Storage::url($store->thumbnail) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                        <p
                            class="rounded-full p-[6px_10px] {{ $store->is_open && !$store->is_full ? 'bg-[#41BE64]' :  'bg-[#F12B3E]'}} w-fit h-fit font-bold text-[10px] leading-[15px] text-white absolute top-4 right-4">
                            {{ $store->is_open && !$store->is_full ? 'OPEN NOW' : 'CLOSED' }}</p>
                    </div>
                    <div class="flex items-center justify-between gap-4 px-4">
                        <div class="title flex flex-col gap-[6px]">
                            <div class="flex items-center gap-1">
                                <h1 class="font-semibold w-fit">{{ $store->name }}</h1>
                                <div class="w-[18px] h-[18px] flex shrink-0">
                                    <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                                </div>
                            </div>
                            <div class="flex items-center gap-[2px]">
                                <div class="w-4 h-4 flex shrink-0">
                                    <img src="{{ asset('assets/images/icons/location.svg') }}" alt="icon">
                                </div>
                                <p class="text-sm leading-[21px] text-[#909DBF]">{{ substr($store->address, 0, 25) }}...</p>
                            </div>
                        </div>
                        <div class="rating flex flex-col gap-[6px]">
                            <div class="flex items-center justify-end text-right gap-[6px]">
                                <div class="w-[18px] h-[18px] flex shrink-0">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="verified">
                                </div>
                                <h1 class="font-semibold w-fit">4.8</h1>
                            </div>
                            <div class="flex items-center justify-end text-right gap-[2px]">
                                <p class="text-sm leading-[21px] text-[#909DBF]">145 Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-center">Service not available on this city</p>
        @endforelse

        {{-- <a href="details.html" class="card">
            <div
                class="flex flex-col gap-4 rounded-[20px] ring-1 ring-[#E9E8ED] pb-4 bg-white overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                <div class="w-full h-[120px] flex shrink-0 overflow-hidden relative">
                    <img src="assets/images/thumbnails/th-details-1.png" class="w-full h-full object-cover" alt="thumbnail">
                    <p
                        class="rounded-full p-[6px_10px] bg-[#41BE64] w-fit h-fit font-bold text-[10px] leading-[15px] text-white absolute top-4 right-4">
                        OPEN NOW</p>
                </div>
                <div class="flex items-center justify-between gap-4 px-4">
                    <div class="title flex flex-col gap-[6px]">
                        <div class="flex items-center gap-1">
                            <h1 class="font-semibold w-fit">Shayna Xtra Wash</h1>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="assets/images/icons/verify.svg" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <div class="w-4 h-4 flex shrink-0">
                                <img src="assets/images/icons/location.svg" alt="icon">
                            </div>
                            <p class="text-sm leading-[21px] text-[#909DBF]">Nayapati Circle Club, Jakarta</p>
                        </div>
                    </div>
                    <div class="rating flex flex-col gap-[6px]">
                        <div class="flex items-center justify-end text-right gap-[6px]">
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="assets/images/icons/Star 1.svg" alt="verified">
                            </div>
                            <h1 class="font-semibold w-fit">4.8</h1>
                        </div>
                        <div class="flex items-center justify-end text-right gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">145 Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="details-closed.html" class="card">
            <div
                class="flex flex-col gap-4 rounded-[20px] ring-1 ring-[#E9E8ED] pb-4 bg-white overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                <div class="w-full h-[120px] flex shrink-0 overflow-hidden relative">
                    <img src="assets/images/thumbnails/th-details-2.png" class="w-full h-full object-cover" alt="thumbnail">
                    <p
                        class="rounded-full p-[6px_10px] bg-[#F12B3E] w-fit h-fit font-bold text-[10px] leading-[15px] text-white absolute top-4 right-4">
                        CLOSED</p>
                </div>
                <div class="flex items-center justify-between gap-4 px-4">
                    <div class="title flex flex-col gap-[6px]">
                        <div class="flex items-center gap-1">
                            <h1 class="font-semibold w-fit">Night Fast</h1>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="assets/images/icons/verify.svg" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <div class="w-4 h-4 flex shrink-0">
                                <img src="assets/images/icons/location.svg" alt="icon">
                            </div>
                            <p class="text-sm leading-[21px] text-[#909DBF]">Tendean Pusat No. 129</p>
                        </div>
                    </div>
                    <div class="rating flex flex-col gap-[6px]">
                        <div class="flex items-center justify-end text-right gap-[6px]">
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="assets/images/icons/Star 1.svg" alt="verified">
                            </div>
                            <h1 class="font-semibold w-fit">4.8</h1>
                        </div>
                        <div class="flex items-center justify-end text-right gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">145 Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="details-full.html" class="card">
            <div
                class="flex flex-col gap-4 rounded-[20px] ring-1 ring-[#E9E8ED] pb-4 bg-white overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                <div class="w-full h-[120px] flex shrink-0 overflow-hidden relative">
                    <img src="assets/images/thumbnails/th-details-3.png" class="w-full h-full object-cover"
                        alt="thumbnail">
                    <p
                        class="rounded-full p-[6px_10px] bg-[#41BE64] w-fit h-fit font-bold text-[10px] leading-[15px] text-white absolute top-4 right-4">
                        OPEN NOW</p>
                </div>
                <div class="flex items-center justify-between gap-4 px-4">
                    <div class="title flex flex-col gap-[6px]">
                        <div class="flex items-center gap-1">
                            <h1 class="font-semibold w-fit">Robben Focus</h1>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="assets/images/icons/verify.svg" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <div class="w-4 h-4 flex shrink-0">
                                <img src="assets/images/icons/location.svg" alt="icon">
                            </div>
                            <p class="text-sm leading-[21px] text-[#909DBF]">Pantai Indak Papuk</p>
                        </div>
                    </div>
                    <div class="rating flex flex-col gap-[6px]">
                        <div class="flex items-center justify-end text-right gap-[6px]">
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="assets/images/icons/Star 1.svg" alt="verified">
                            </div>
                            <h1 class="font-semibold w-fit">4.8</h1>
                        </div>
                        <div class="flex items-center justify-end text-right gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">145 Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </a> --}}
    </section>
@endsection
