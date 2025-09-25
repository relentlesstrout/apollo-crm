@extends('layout.app')

@section('content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900">Edit {{ $customer->house_no . ' ' . $customer->street }} </h2>
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="house_no" class="block mb-2 text-sm font-medium text-gray-900 ">House name/no.</label>
                        <input type="text" name="house_no" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  :ring-primary-500 :border-primary-500"
                               value="{{ old('house_no', $customer->house_no) }}" required="">
                    </div>

                    <div class="w-full">
                        <label for="street" class="block mb-2 text-sm font-medium text-gray-900 ">Street</label>
                        <input type="text" name="street" id="street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  :ring-primary-500 :border-primary-500" value="{{ old('street', $customer->street) }}" required="">
                    </div>

                    <div>
                        <label for="area" class="block mb-2 text-sm font-medium text-gray-900 ">Area</label>
                        <select name="area" id="area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            @php
                                $areas = ['Blaydon', 'Rowlands Gill', 'High Spen', 'Greenside', 'Ryton', 'Whickham', 'Stella'];
                            @endphp

                            @foreach($areas as $area)
                                <option value="{{ $area }}" {{ old('area', $customer->area) === $area ? 'selected' : '' }}>
                                    {{ $area }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="w-full">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Phone no.</label>
                        <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  :ring-primary-500 :border-primary-500"
                               value="{{ old('phone', $customer->phone) }}">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 ">Notes</label>
                        <textarea name="notes" id="notes" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500  :ring-primary-500 :border-primary-500">
                            {{ old('notes', $customer->notes) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 items-center px-2 py-2.5 m-4 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                    edit Customer
                </button>
            </form>
        </div>
    </section>
@endsection
