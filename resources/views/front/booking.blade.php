@extends('layouts.app')

@push('title')
    <title>Booking</title>
@endpush

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush



@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-5">
        <a onclick="window.history.back()" class="cursor-pointer">
            <div class="w-10 h-10 flex shrink-0">
                <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Booking</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">Treat Your Car Nicely</p>
        </div>
        <div class="w-10 h-10 flex shrink-0">
        </div>
    </div>
    <div id="Location" class="flex flex-col gap-2 px-4 mt-[30px]">
        <h2 class="font-semibold">Workshop At</h2>
        <div class="flex items-center w-full rounded-2xl border border-[#E9E8ED] p-4 gap-[10px] bg-white">
            <div class="w-[80px] h-[60px] flex shrink-0 rounded-xl overflow-hidden">
                <img src="{{ Storage::url($carStore->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
            </div>
            <div class="flex flex-col">
                <div class="flex items-center gap-1">
                    <h1 class="font-semibold w-fit">{{ $carStore->name }}</h1>
                    <div class="w-[18px] h-[18px] flex shrink-0">
                        <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                    </div>
                </div>
                <div class="flex items-center gap-[2px]">
                    <p class="text-sm leading-[21px] text-[#909DBF]">{{ $carStore->address }}</p>
                </div>
            </div>
        </div>
    </div>
    <div id="Service" class="flex flex-col gap-2 px-4 mt-5">
        <h2 class="font-semibold">Your Service</h2>
        <div class="rounded-2xl border border-[#E9E8ED] flex items-center justify-between p-4 bg-white">
            <div class="flex items-center gap-[10px]">
                <div class="w-[60px] h-[60px] flex shrink-0">
                    <img src="{{ Storage::url($service->icon) }}" alt="icon">
                </div>
                <div class="flex flex-col h-fit">
                    <p class="font-semibold">{{ $service->name }}</p>
                    <p class="text-sm leading-[21px] text-[#909DBF]">Top Rated Service</p>
                </div>
            </div>
            <p class="rounded-full p-[6px_10px] bg-[#DFB3E6] w-fit font-bold text-xs leading-[18px]">POPULAR</p>
        </div>
    </div>
    <div class="flex h-full flex-1 mt-5">
        <form action="{{ route('payment') }}" method="POST"
            class="w-full flex flex-col rounded-t-[30px] p-5 pt-[30px] gap-[26px] bg-white overflow-x-hidden mb-20 mt-auto">
            @csrf
            <div class="flex flex-col gap-2">
                <h2 class="font-semibold">Choose Day</h2>
                <div class="flex items-center gap-2">
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Today</div>
                        <input type="radio" name="day" id="" class="absolute top-1/2 left-1/2 -z-10" required
                            disabled>
                    </label>
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Tomorrow</div>
                        <input type="radio" name="day" id="" class="absolute top-1/2 left-1/2 -z-10"
                            required>
                    </label>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <h2 class="font-semibold">Choose Time</h2>
                <div class="swiper2 h-fit">
                    <div class="swiper-wrapper w-full h-fit">
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                09:00</div>
                            <input type="radio" name="time" value="09:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                10:00</div>
                            <input type="radio" name="time" value="10:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                11:00</div>
                            <input type="radio" name="time" value="11:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                12:00</div>
                            <input type="radio" name="time" value="12:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                13:00</div>
                            <input type="radio" name="time" value="13:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                14:00</div>
                            <input type="radio" name="time" value="14:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                15:00</div>
                            <input type="radio" name="time" value="15:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                        <label class="swiper-slide !w-fit group relative">
                            <div
                                class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                                16:00</div>
                            <input type="radio" name="time" value="16:00:00" id="" class="absolute top-1/2 left-1/2 -z-10"
                                required>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="Name" class="font-semibold">Your Name</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <img src="{{ asset('assets/images/icons/profile-circle.svg') }}" alt="icon">
                    </div>
                    <input type="text" name="name" id="Name"
                        class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="Write your real name" required>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="Name" class="font-semibold">Phone Number</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <img src="{{ asset('assets/images/icons/call.svg') }}" alt="icon">
                    </div>
                    <input type="tel" name="phone" id="Name"
                        class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="What is your phone number" required>
                </div>
            </div>
            <hr class="border-[#E9E8ED]">
            <div id="CTA-nav"
                class="fixed bottom-20 -ml-5 w-full max-w-[640px] mx-auto border-t border-[#E9E8ED] flex items-center justify-between p-[16px_24px] bg-white z-20">
                <div class="flex flex-col gap-[2px]">
                    <p class="font-bold text-xl leading-[30px]">IDR {{ number_format($service->price, 0, ',', '.') }}</p>
                    <p class="text-sm leading-[21px] text-[#909DBF]">{{ $service->duration_in_hour }} Hours</p>
                </div>
                <button type="submit"
                    class="rounded-full p-[12px_20px] bg-[#FF8E62] font-bold text-white">Booking Now</button>
            </div>
        </form>
    </div>
@endsection

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/custom/booking.js') }}"></script>
@endpush
