<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-800 leading-tight">
            <b>{{ __('Authorisation Statuses') }}
        </h2>
    </x-slot>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Authorisation Status') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('authorisationStatus.update',['authorisationStatus' => $authorisationStatus->id]) }}" > 
                        @csrf
                        @method('PUT')                                                                                                                                                           
                        <div class="form-group row">
                            <div class="form-group row">
                                <label for="rating" class="col-md-4 col-form-label text-md-right">{{ __('Authorisation Status') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $authorisationStatus->name }}" required autocomplete="start_date" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>  
                                    @enderror
                                </div>
                            </div>
                            
                        <div class="form-group row">
                            <div class="col-md-10 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
