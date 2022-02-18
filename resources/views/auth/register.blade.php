
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>


            <!-- COMMUNITY NAME -->
                
                <label style="color:yellow">{{ __('COMMUNITY NAME :') }}</label>
 
                <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='community'  name='community' onchange="{{ (isset($Onchange)) }}" >
                        <option id='defaultOption' value="">{{ __('SELECT COMMUNITY NAME') }}</option>
                        @if(isset($communities))
                            @foreach ( $communities as $community )
                                <option 
                                    {{ (isset($selectedId) && $selectedId == $option->id ) ? 'selected' : '' }}  
                                    value="{{ $community->id ?? '' }}" >{{ __($community->name ?? '' ) }}
                                </option>  
                            @endforeach
                        @endif
                        
                
                    </select>
                    @error('community')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </p>

            <div>
                <x-label for="name" :value="__('LOT NUMBER')" />

                <x-input id="lot" class="block mt-1 w-full" type="text" name="lot" :value="old('lot')" autofocus />
            </div>

            <!-- STREET ADDRESS -->

                <label style="color:yellow">{{ __('STREET ADDRESS :') }}</label>
 
                <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='address'  name='address' onchange="{{ (isset($Onchange)) }}" >
                        <option id='defaultOption' value="">{{ __('SELECT STREET NAME') }}</option>
                        @if(isset($addresses))
                            @foreach ( $addresses as $address )
                                <option 
                                    {{ (isset($selectedId) && $selectedId == $option->id ) ? 'selected' : '' }}  
                                    value="{{ $address->id ?? '' }}" >{{ __($address->name ?? '' ) }}
                                </option>  
                            @endforeach
                        @endif
                        
                
                    </select>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </p>


            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>


            
            <!-- Select Option Rol type -->
            <div class="mt-4">
                            <x-label for="role_id" value="{{ __('Register as:') }}" />
                            <select name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="RESIDENT">RESIDENT</option>
                                <option value="SECURITY">SECURITY</option>
                            </select>
                        </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
