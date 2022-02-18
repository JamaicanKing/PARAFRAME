<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <center><b>{{ __('EXIT SEARCH VIEW') }}</b></center>
        </h2>
    </x-slot>

    <div class="container mt-3">
        <div class="row">
            <div class="col">
                @if (session('status'))
                    <div class="alert alert-success">
                        {!! session('status') !!}
                    </div>
                @endif

                <form autocomplete="off" actions="{{ route('exit') }}" method="GET">
                    @csrf
                    <div class="container mt-3">
                        <div class="row">

                            <div class="col">
                                <label>ENTER NAME</label>
                                <div class="form-group pass_show">
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" />
                                </div>
                            </div>
                            <div class="col-sml-4">
                                <label></label>
                                <div class="form-group pass_show">
                                    <h2 style="margin-top: 0.5rem;">OR</h2>
                                </div>
                            </div>
                            <div class="col">
                                <label>ENTER LICENSE PLATE NUMBER</label>
                                <div class="form-group pass_show">
                                    <x-input id="license_plate" class="block mt-1 w-full" type="text"
                                        name="license_plate" />
                                </div>
                            </div>
                            <div class="col-sml-1" style="margin-top: 2.5rem;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>

                    </div>

                </form>
            </div>
        </div>

        @if (isset($visitors) || isset($residents))
            <div class="row">
                <div class="col">
                    @if ($visitors->isNotEmpty())
                        <div class="row">
                            <div class="col">
                                <table class="border-separate table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Visitor Name</th>
                                            <th>Authorisation Status</th>
                                            <th>Visitor Type</th>
                                            <th>License Plate</th>
                                            <th>Resident Name</th>
                                            <th>Community</th>
                                            <th>Lot Number</th>
                                            <th>Street Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visitors as $visit)
                                            <tr>
                                                <td>{{ $visit->name_visitor }}</td>
                                                <td>{{ $visit->status_authorisation }}</td>
                                                <td>{{ $visit->visitor_type }}</td>
                                                <td>{{ $visit->license_plate }}</td>
                                                <td>{{ $visit->name }}</td>
                                                <td>{{ $visit->community }}</td>
                                                <td>{{ $visit->lot }}</td>
                                                <td>{{ $visit->address }}</td>
                                                <td><a name="" id="" class="btn btn-primary" href="{{ route('exit', ['id'=>$visit->visit_id, 'type'=>'visitor']) }}" role="button">exit</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if ($residents->isNotEmpty())
                        <div class="row">
                            <div class="col">
                                <table class="border-separate table table-striped">

                                    <thead>
                                        <tr>
                                            <th>Resident ID</th>
                                            <th>Resident Name</th>
                                            <th>Lot Number</th>
                                            <th>Street Name</th>
                                            <th>Community name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($residents as $resident)
                                            <tr>
                                                <td>{{ $resident->id }}</td>
                                                <td>{{ $resident->name }}</td>
                                                <td>{{ $resident->lot }}</td>
                                                <td>{{ $resident->address }}</td>
                                                <td>{{ $resident->community_name }}</td>
                                                <td><a name="" id="" class="btn btn-primary" href="{{ route('exit', ['id'=>$resident->id, 'type'=>'resident']) }}" role="button">exit</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
