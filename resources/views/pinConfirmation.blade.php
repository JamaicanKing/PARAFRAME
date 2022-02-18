@json($resident)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <center><b>{{ __('RESIDENT PIN CHANGE') }}</b></center>
        </h2>


    </x-slot>
    <style>
        .pass_show {
            position: relative
        }

        .pass_show .ptxt {

            position: absolute;

            top: 50%;

            right: 10px;

            z-index: 1;

            color: #f36c01;

            margin-top: -10px;

            cursor: pointer;

            transition: .3s ease all;

        }

        .pass_show .ptxt:hover {
            color: #333333;
        }

    </style>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

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
    <form method="POST" action="{{ route('pinConfirmation') }}">
        @csrf
        <div class="container">
            <div class="row">


                <div class="col-sm-4">

                    <input onfocus="this.value=''" class="form-control" type="hidden" style="text-align:left;"
                        name="resident_id" id="resident_id" placeholder="ID USER" value="{{ $resident->id }}">
                    <label style="color:black">{{ __('RESIDENT NAME :') }}</label>
                    <input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;"
                        name="resident_name" id="resident_name" placeholder="ID USER" value="{{ $resident->name }}">

                    <img src="data:image;base64, {{ base64_encode($avatar->avatar) }}" alt="Image"  />

                    <label>ENTER PIN NUMBER</label>
                    <div class="form-group pass_show">
                        <input type="password" value="" id="pin" name="pin" class="form-control"
                            placeholder=" ENTER PIN NUMBER">
                    </div>

                </div>

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>



    <script>
        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">Show</span>');
        });


        $(document).on('click', '.pass_show .ptxt', function() {

            $(this).text($(this).text() == "Show" ? "Hide" : "Show");

            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

        });
    </script>
</x-app-layout>
