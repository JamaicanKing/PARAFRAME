<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-800 leading-tight">
            <b>{{ __('Test DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="bg-black py-7">
        <div class="bg-white overflow-hidden shadow-sm m:rounded-lg max-w-6xl mx-auto sm:px-6 lg:px-0">
            <div class="p-10 bg-gray border-b border-gray-200">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    </div>


                    <div class="mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="p-3">
                                <div class="flex items-center">
                                    <img fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500" src="{{asset('assets/images/security guard.jpg')}}"></img>
                                    <div class="ml-4 text-lg leading-7 font-bold">REGISTER NEW VISITOR</div>
                                </div>

                                <form method="POST" action="{{ route('resident.store') }}" >
                                @csrf

                                <div class="ml-12">
                                    <div class="mt-4 text-gray-600 dark:text-gray-600 text-sm">

                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                        <!-- Name --><br>
                                        <x-label for="name_visitor name" :value="__('NAME')" />
                                        <x-input id="name_visitor" class="block mt-1 w-full" type="text" name="name_visitor" :value="old('name_visitor')" required autofocus />

                                        <!-- Select Visitor Mode OF Transportation --><br>

                                        <x-label for="visitor_type" value="{{ __('MODE OF TRANSPORTATION') }}" />
                                        <select name="visitor_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <option value="PEDESTRIAN">PEDESTRIAN</option>
                                            <option value="DRIVER">DRIVER</option>
                                            <option value="PASSENGER">PASSENGER</option>
                                        </select>


                                        <!-- Select Visitor Audhotisation Status --><br>
                                        <x-label for="status_authorisation" value="{{ __('AUTHORISATION STATUS') }}" />
                                        <select name="status_authorisation" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <option value="SINGLE ENTRY">SINGLE ENTRY</option>
                                            <option value="MULTIPLE ENTRY - (WHITELIST)">MULTIPLE ENTRY - (WHITELIST)</option>
                                            <option value="DENY ENTRY - (BLACKLIST)">DENY ENTRY - (BLACKLIST)</option>
                                        </select>

                                        <!-- License Plate --><br>
                                        <x-label for="license_plate" :value="__('LICENSE PLATE #')" />
                                        <x-input id="license_plate" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                                        <BR>

                                        <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Submit
                                        </button>


                                    </div>
                                </div>
                            </div>

                            <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">

                                <div class="ml-12">
                                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">


                                        <!-- 2nd Column -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
</x-app-layout>