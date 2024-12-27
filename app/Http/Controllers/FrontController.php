<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\BookingTransaction;
use App\Models\City;
use App\Models\CarStore;
use App\Models\CarService;
use App\Models\StorePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreBookingRequest;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        session()->flush();
        $cities = City::select('slug', 'name')->get();
        $services = CarService::withCount('storeServices')->get();

        // dd($services);
        return view('front.index', compact('cities', 'services'));
    }


    /**
     * Display a search result.
     */

    public function search(Request $request)
    {
        $citySlug = $request->city;
        $serviceSlug = $request->service_type;

        $city = City::where('slug', $citySlug)->first();

        $carService = CarService::where('slug', $serviceSlug)->first();
        if(!$carService) {
            return redirect()->back()->with('error', 'Service not found');
        }

        $stores = CarStore::whereHas('storeServices', function($query) use ($carService) {
            $query->where('car_service_id', $carService->id);
        })->where('city_id', $city->id)->get();

        session()->put('service_type', $serviceSlug);


        return view('front.store-list', compact('stores', 'city', 'carService'));
    }

    /**
     * Display store details.
     */
    public function detail(CarStore $carStore)
    {
        $storePhotos = $carStore->storePhotos->all();
        $service = CarService::where('slug', session('service_type'))->first();

        return view('front.store-detail', compact('carStore', 'storePhotos', 'service'));
    }

    /**
     * Display booking form.
     */
    public function booking(CarStore $carStore){

        session()->put('car_store', $carStore->slug);

        $service = CarService::where('slug', session('service_type'))->first();
        return view('front.booking', compact('carStore', 'service'));
    }

    /**
     * Process payment.
     */
    public function payment(StoreBookingRequest $request){
        session()->put('customer_name', $request->name);
        session()->put('customer_phone', $request->phone);
        session()->put('time', $request->time);
        return redirect()->route('payment.form');
    }

    /**
     * Display payment form.
     */
    public function paymentForm(){
        $store = CarStore::where('slug', session('car_store'))->first();
        $service = CarService::where('slug', session('service_type'))->first();
        $name = session('customer_name');
        $phone = session('customer_phone');
        $time = session('time');
        $date = Carbon::tomorrow()->format('Y-m-d');

        $amount = [
            'fee' => $service->price*10/100,
            'tax' =>  $service->price*12/100,
            'total' => $service->price + ($service->price*10/100) +( $service->price*12/100)
        ];

        return view('front.payment', compact('store', 'service', 'name', 'phone', 'time', 'date', 'amount'));

    }

    /**
     * Store payment.
     */
    public function paymentStore(StorePaymentRequest $request){
        // dd($request->all());

        $service = CarService::where('slug', session('service_type'))->first();
        $total_amount = $service->price + ($service->price*10/100) +( $service->price*12/100);
        $data = [
            'car_service_id' => $service->id,
            'car_store_id' => CarStore::where('slug', session('car_store'))->first()->id,
            'trx_id' => BookingTransaction::generateUniqueTrxId(),
            'name' => session('customer_name'),
            'phone_number' => session('customer_phone'),
            'is_paid' => false,
            'proof' => $request->file('proof')->store('proofs', 'public'),
            'total_amount' => $total_amount,
            'started_at' => Carbon::tomorrow()->format('Y-m-d'),
            'time_at' => session('time')
        ];
        BookingTransaction::create($data);
        $trx_id = $data['trx_id'];


        return redirect()->route('payment.success', $trx_id);


    }

    /**
     * Display payment success.
     */
    public function paymentSuccess($trx_id){
        $service = CarService::where('slug', session('service_type'))->first();
        $phone = session('customer_phone');
        return view('front.payment-success', compact('trx_id', 'service', 'phone'));

    }

    /**
     * Display booking detail.
     */
    public function bookingCheck(){
        return view('front.check-booking');
    }

    /**
     * Display booking detail.
     */
    public function bookingDetail(Request $request){
        $trx_id = $request->trx_id;
        $phone = $request->phone;

        $booking = BookingTransaction::where('trx_id', $trx_id)->where('phone_number', $phone)->first();
        if(!$booking){
            return redirect()->back()->with('error', 'Booking not found');
        }

        $booking->with('carService', 'carStore');
        $amount = [
            'fee' => $booking->carService->price*10/100,
            'tax' =>  $booking->carService->price*12/100,
            'total' => $booking->carService->price + ($booking->carService->price*10/100) +( $booking->carService->price*12/100)
        ];

        return view('front.booking-detail', compact('booking', 'amount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
