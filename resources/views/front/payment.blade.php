@extends('layouts.app')

@push('title')
    <title>Payment</title>
@endpush

@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-5">
        <a onclick="window.history.back()" class="cursor-pointer">
            <div class="w-10 h-10 flex shrink-0">
                <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Make a Payment</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">Treat Your Car Nicely</p>
            <p class="text-sm font-medium leading-[21px]">Date : {{ $date.' '.$time }}</p>
        </div>
        <div class="w-10 h-10 flex shrink-0">
        </div>
    </div>
    <div id="Order-details" class="flex flex-col gap-2 px-4 mt-[30px]">
        <h2 class="font-semibold">Order Details</h2>
        <div class="flex flex-col w-full rounded-2xl border border-[#E9E8ED] p-4 gap-4 bg-white">
            <div id="Location" class="flex flex-col gap-2">
                <h2 class="font-semibold">Workshop At</h2>
                <div class="flex items-center w-full gap-[10px] bg-white">
                    <div class="w-[80px] h-[60px] flex shrink-0 rounded-xl overflow-hidden">
                        <img src="{{ asset($store->thumbnail) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1">
                            <p class="font-semibold w-fit">{{ $store->name }}</p>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">{{ $store->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="border-[#E9E8ED]">
            <div id="Service" class="flex flex-col gap-2">
                <h2 class="font-semibold">Your Service</h2>
                <div class="flex items-center w-full gap-[10px] bg-white justify-between">
                    <div class="flex items-center gap-[10px]">
                        <div class="w-[60px] h-[60px] flex shrink-0">
                            <img src="{{ asset($service->icon) }}" alt="icon">
                        </div>
                        <div class="flex flex-col h-fit">
                            <p class="font-semibold">{{ $service->name }}</p>
                            <p class="text-sm leading-[21px] text-[#909DBF]">Top Rated Service</p>
                        </div>
                    </div>
                    <p class="rounded-full p-[6px_10px] bg-[#DFB3E6] w-fit font-bold text-xs leading-[18px]">POPULAR
                    </p>
                </div>
            </div>
            <hr class="border-[#E9E8ED]">
            <div id="Price-details" class="flex flex-col gap-[10px]">
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">{{ $service->name }} Price</p>
                    <p class="font-semibold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">Booking Fee</p>
                    <p class="font-semibold">Rp {{ number_format($amount['fee'], 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">PPN 12%</p>
                    <p class="font-semibold">Rp {{ number_format($amount['tax'], 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">Grand Total</p>
                    <p class="font-bold text-xl leading-[30px] text-[#FF8E62]">Rp {{ number_format($amount['total'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex h-full flex-1 mt-5">
        <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data"
            class="w-full flex flex-col rounded-t-[30px] p-5 pt-[30px] gap-[26px] bg-white overflow-x-hidden mb-0 mt-auto">
            @csrf
            <div id="Payment-info" class="flex flex-col gap-4">
                <h2 class="font-semibold">Send Payment</h2>
                <div class="flex items-center w-full gap-[10px] bg-white">
                    <div class="w-[71px] h-[50px] flex shrink-0 rounded-xl overflow-hidden">
                        <img src="{{ asset('assets/images/logos/bca.svg') }}" class="w-full h-full object-contain" alt="thumbnail">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1">
                            <p class="font-semibold w-fit">CarWash Indonesia</p>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">8008129839</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center w-full gap-[10px] bg-white">
                    <div class="w-[71px] h-[50px] flex shrink-0 rounded-xl overflow-hidden">
                        <img src="{{ asset('assets/images/logos/mandiri.svg') }}" class="w-full h-full object-contain" alt="thumbnail">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1">
                            <p class="font-semibold w-fit">CarWash Indonesia</p>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">12379834983281</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="Proof" class="font-semibold">Proof of Payment</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62] relative">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <img src="{{ asset('assets/images/icons/gallery.svg') }}" alt="icon">
                    </div>
                    <button type="button" id="Upload-btn"
                        class="appearance-none outline-none text-[#909DBF] w-full text-left"
                        onclick="document.getElementById('Proof').click()">
                        Add an attachments
                    </button>
                    <input type="file" name="proof" id="Proof" class="absolute -z-10" required>
                </div>
            </div>
            <hr class="border-[#E9E8ED]">
            <button type="submit" class="w-full rounded-full p-[12px_20px] bg-[#FF8E62] font-bold text-white">Confirm
                Payment</button>
        </form>
    </div>
@endsection

@push('after-script')
    <script src="{{ asset('js/custom/payment.js') }}"></script>
@endpush