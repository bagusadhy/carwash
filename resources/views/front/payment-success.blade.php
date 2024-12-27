@extends('layouts.app')
@push('title')
    <title>Payment Success</title>
@endpush

@section('content')
    @section('disable-navigation')
    @endsection
    <div class="flex flex-col items-center gap-[50px] max-w-[330px] m-auto h-fit w-full py-6">
        <div class="w-[120px] h-[120px] flex shrink-0">
            <img src="{{ Storage::url($service->icon) }}" class="w-full h-full object-contain" alt="icon">
        </div>
        <div class="flex flex-col gap-1 text-center">
            <h1 class="font-bold text-2xl leading-[36px]">Yeay! Your Booking On Review</h1>
            <p class="text-center px-5 leading-[28px]">Your booking is being processed, our admin will contact you.</p>
        </div>
        <div class="w-full rounded-2xl border border-[#E9E8ED] p-4 flex flex-col gap-2 bg-white">
            <p class="font-semibold">Your Booking ID</p>
            <div class="flex items-center gap-[10px]">
                <div class="w-[60px] h-[60px] flex shrink-0">
                    <img src="{{ asset('assets/images/icons/illustration6.svg') }}" alt="icon">
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <p class="font-semibold w-fit">{{ $trx_id }}</p>
                        <div class="w-[18px] h-[18px] flex shrink-0">
                            <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                        </div>
                    </div>
                    <div class="flex items-center gap-[2px]">
                        <p class="text-sm leading-[21px] text-[#909DBF]">Protect your booking ID</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full gap-[14px]">
            <a href="{{ route('index') }}"
                class="w-full rounded-full p-[12px_20px] bg-[#FF8E62] font-bold text-white text-center">Book
                More</a>
            <a href="{{ route('booking.detail') }}" onclick="event.preventDefault(); document.getElementById('booking-detail').submit();"
                class="w-full rounded-full border border-[#E9E8ED] p-[12px_20px] bg-white text-center font-bold transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">Check
                My Booking
                <form action="{{ route('booking.detail') }}" method="post" class="hidden" id="booking-detail">
                    @csrf
                    <input type="hidden" name="trx_id" value="{{ $trx_id }}">
                    <input type="hidden" name="phone" value="{{ $phone }}">
            </a>
        </div>
    </div>
@endsection

{{-- <script>
    const elementGet = document.getElementById('booking-detail');
</script> --}}
