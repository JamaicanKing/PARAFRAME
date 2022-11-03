<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <center><b>{{ __('VISITOR MANAGEMENT DASHBOARD  SECURITY VIEW') }}</b></center>
        </h2>


    </x-slot>

    @if (session('status'))
        <div class="alert alert-success">
            {!! session('status') !!}
        </div>
    @endif


    <!--MAIN CONTAINER BACKGROUND BEGINS-->
    <div class=" justify-content-center bg-white row overflow-hidden py-4">

        <div class="container">
            <div class="panel visitor">
                <a href=""><span>Visitor Entry</span></a>
              </div>
       

        <div class="panel resident">
            <a href="{{ route('residentEntry')}}"><span>Resident Entry</span></a>
        </div>

        <div class="panel exit">
        <a href=""><span>5 </span>Pages</a>
        </div>

        <div class="panel user">
        <a href=""><span>4 </span>Users</a>
        </div>
    </div>


    </div>


</x-app-layout>
