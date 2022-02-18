<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-800 leading-tight">
            <b>{{ __('STREET NAME OFFICIALS') }}
        </h2>
    </x-slot>
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("officialAddress.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD STREET NAME OFFICIAL</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">STREET NAME OFFICIAL</th>
        <th scope="col">ACTIONS</th>
      </tr>
    </thead>
    <tbody>
        @foreach($OfficialAddresses as $officialaddress)
        <tr>
            <td>{{ $officialaddress->name }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("officialAddress.edit",['officialAddress' => $officialAddress->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("officialAddress.destroy",['officialAddress' => $officialAddress->id]) }}" method="POST">
                                @csrf
                                @method("Delete")
                                <button role="button" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <td>
        </tr>
        @endforeach
    
    </tbody>
    </table>
</div>

  
</x-app-layout>