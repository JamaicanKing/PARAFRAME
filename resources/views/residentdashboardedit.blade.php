@json($statusAuthorisation)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-800 leading-tight">
            <b>{{ __('RESIDENT DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="bg-black py-7">
        <div class="bg-white overflow-hidden shadow-sm m:rounded-lg max-w-6xl mx-auto sm:px-6 lg:px-0">
            <div class="bg-gray border-b border-gray-200 padding:0.5rem">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">

                 
                        <form method="POST" action="{{ route('dashboard.update',['id' => $visits->id]) }}">
                            @csrf
 
                            <div class="mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                                <div class="grid grid-cols-1 md:grid-cols-2">
                                    <div class="p-">
                                        <div class="flex items-center">
                                            <!--<img fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500" src="{{asset('assets/images/security guard.jpg')}}"></img>-->
                                            <div class="ml-4 text-lg leading-7 font-bold">REGISTER NEW VISITOR</div>
                                        </div>

                                        <div class="ml-30">
                                            <div class="mt-4 text-gray-600 dark:text-gray-600 text-sm">

                                                <!-- Validation Errors -->
                                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                                <!-- Name --><br>
                                                <x-label for="name_visitor name" :value="__('NAME')" />
                                                <x-input id="name_visitor" class="block mt-1 w-full" type="text" name="name_visitor" value="{{ $visits->name_visitor }}" required autofocus />



                                                <label style="color:yellow">{{ __('MODE OF TRANSPORTATION :') }}</label>

                                                <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='visitor_type' name='visitor_type' onchange="{{ (isset($Onchange)) }}">
                                                        <option id='defaultOption' value="">{{ __('SELECT MODE OF TRANSPORTATION') }}</option>
                                                        @if(isset($visitorTypes))
                                                        @foreach ( $visitorTypes as $visitorType )
                                                        <option {{ (isset($visitorType) && $visitorType->name == $visitorType->name ) ? 'selected' : '' }} value="{{ $visitorType->name ?? '' }}">{{ __($visitorType->name ?? '' ) }}
                                                        </option>
                                                        @endforeach
                                                        @endif

                                                    </select>
                                                    @error('visitor_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </p>


                                                <label style="color:yellow">{{ __('STATUS AUTHORISATION :') }}</label>

                                                <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='status_authorisation' name='status_authorisation' onchange="{{ (isset($Onchange)) }}">
                                                        <option id='defaultOption' value="">{{ __('SELECT AUTHORISATION STATUS') }}</option>
                                                        @if(isset($authorisationStatus))
                                                        @foreach ( $authorisationStatus as $authorisationStatus )
                                                        <option {{ (isset($statusAuthorisation) && $statusAuthorisation == $authorisationStatus->name ) ? 'selected' : '' }} value="{{ $authorisationStatus->name ?? '' }}">{{ __($authorisationStatus->name ?? '' ) }}
                                                        </option>
                                                        @endforeach
                                                        @endif

                                                    </select>
                                                    @error('status_authorisation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </p>

                                                <!-- License Plate --><br>
                                                <x-label for="license_plate" :value="__('LICENSE PLATE #')" />
                                                <x-input id="license_plate" class="block mt-1 w-full" type="text" name="license_plate" value="{{ $licensePlate }}" autofocus />

                                                <BR>
                                                <div class="col-md-10 text-left">
                                                <button type="submit" class="btn btn-primary">Submit</button>                                  
                                                </div>

                        </form>
                    </div>
                </div>
            </div>

            </x-app-layout>