@extends('layout.app')

@section('content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900">Add a new customer</h2>
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="house" class="block mb-2 text-sm font-medium text-gray-900 ">House name/no.</label>
                        <input type="text" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  :ring-primary-500 :border-primary-500" placeholder="Type house name/no." required="">
                    </div>

                    <div class="w-full">
                        <label for="street" class="block mb-2 text-sm font-medium text-gray-900 ">Street</label>
                        <input type="text" name="street" id="street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  :ring-primary-500 :border-primary-500" placeholder="Street" required="">
                    </div>

                    <div>
                        <label for="area" class="block mb-2 text-sm font-medium text-gray-900 ">Area</label>
                        <select name="area" id="area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5  :ring-primary-500 :border-primary-500">
                            <option selected="">Select area</option>
                            <option value="Blaydon">Blaydon</option>
                            <option value="Rowlands Gill">Rowlands Gill</option>
                            <option value="High Spen">High Spen</option>
                            <option value="Greenside">Greenside</option>
                            <option value="Ryton">Ryton</option>
                            <option value="Whickham">Whickham</option>
                            <option value="Stella">Stella</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Phone no.</label>
                        <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  :ring-primary-500 :border-primary-500" placeholder="07976015082">
                    </div>

                    <div class="w-full">
                        <label for="first_clean_price" class="block mb-2 text-sm font-medium text-gray-900 ">Price (£)</label>
                        <input
                            type="number"
                            step="0.50"
                            name="first_clean_price"
                            id="first_clean_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  :ring-primary-500 :border-primary-500"                            placeholder="e.g. 25.00"
                            required
                        >
                    </div>

                    <div class="w-full">
                        <label for="cleaning_frequency_weeks" class="block mb-2 text-sm font-medium text-gray-900">
                            Frequency (weeks)
                        </label>
                        <input
                            type="number"
                            name="cleaning_frequency_weeks"
                            id="cleaning_frequency_weeks"
                            min="4"
                            max="52"
                            step="4"
                            value="{{ old('cleaning_frequency_weeks', 4) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required
                        >
                    </div>


                    <div class="sm:col-span-2">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 ">Notes</label>
                        <textarea name="notes" id="notes" rows="8" class="mb-3 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500  :ring-primary-500 :border-primary-500" placeholder="Notes go here..."></textarea>
                    </div>
                </div>

                <div class="w-full">
                    <label for="scheduled_for" class="block mb-2 text-sm font-medium text-gray-900">
                        First Clean Date
                    </label>
                    <input
                        type="date"
                        name="scheduled_for"
                        id="scheduled_for"
                        value="{{ old('scheduled_for', now()->addWeeks(4)->format('Y-m-d')) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        required
                    >
                </div>


                <button type="submit" class="bg-blue-500 items-center px-2 py-2.5 m-4 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                    Add Customer +
                </button>
            </form>
        </div>
    </section>
@endsection
