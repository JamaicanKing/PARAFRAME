@json($user)
<x-app-layout>

<x-slot name="header">
    <h2 class="font-bold text-xl text-yellow-400 leading-tight">
        <center><b>{{ __('USER PROFILE') }}</b></center>
    </h2>


</x-slot>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('status'))
<div class="alert alert-danger">
    {!! session('status') !!}
</div>
@endif

<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="image-upload">

                                    <img src="{{ asset('images/5.jpg') }}" style="width:300px">


                                    <div>
                                        <input type="file" id="file" name="file" >
                                    </div>

                                    <div class="input-group mb-3">
                                        <button type="submit" class="form-control" id="submit">Upload</button>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">

                </div>
                <div class="card-body">

                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-first-name">Name</label>
                                    <input type="text" disabled id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="{{ $user[0]->name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-first-name">Email</label>
                                    <input type="Email" id="email" disabled name="email" class="form-control form-control-alternative" placeholder="" value="{{ $user[0]->email ?? ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-address">Address</label>
                                    <input id="input-address" disabled class="form-control form-control-alternative" placeholder="Street Address" value="{{ $user[0]->address ?? ''}}" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Community</label>
                                    <input type="text" id="input-city" disabled class="form-control form-control-alternative" placeholder="Community Name" value="{{ $user[0]->community_name ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-country">Lot</label>
                                    <input type="text" id="input-country" disabled class="form-control form-control-alternative" placeholder="Lot" value="{{ $user[0]->lot ?? ''}}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Security Question 1</label>
                                    <input type="text" name="security_question_1" id="security_question_1" class="form-control form-control-alternative" placeholder="Security Question 1" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-country">Security Question 1 answer</label>
                                    <input type="text" name="security_answer_1" id="security_answer_1" class="form-control form-control-alternative" placeholder="Security answer 1" value="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Security Question 2</label>
                                    <input type="text" name="security_question_2" id="security_question_2" class="form-control form-control-alternative" placeholder="Security Question 2" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-country">Security Question 2 answer</label>
                                    <input type="text" name="security_answer_2" id="security_answer_2" class="form-control form-control-alternative" placeholder="Security answer 2" value="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Security Question 3</label>
                                    <input type="text" name="security_question_3" id="security_question_3" class="form-control form-control-alternative" placeholder="Security Question 3" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-country">Security Question 3 answer</label>
                                    <input type="text" name="security_answer_3" id="security_answer_2" class="form-control form-control-alternative" placeholder="Security answer 3" value="">
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-label for="pin" :value="__('Enter PIN ')" />

                                <x-input id="pin" class="block mt-1 w-full" type="password" name="pin" maxlength="4" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <x-label for="pin" :value="__('CONFIRM PIN ')" />

                                <x-input id="pin_confirmation" class="block mt-1 w-full" type="password" maxlength="4" name="pin_confirmation" required autocomplete="new-password" />
                            </div>

                            


                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6 m-auto text-center">
            <div class="copyright">
                <p>Made By GLC Dashboard </p>
            </div>
        </div>
    </div>
</footer>

</x-app-layout>