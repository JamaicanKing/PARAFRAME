<x-app-layout>
    <x-slot name="header">
        <center><h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <b>{{ __('AVENUE / STREET MANAGEMENT DASHBOARD') }}
        </h2></center>
    </x-slot>
 

<div class=" p-2 mx-auto" style="width: 1000px;">
  <a href="{{ route("address.create") }}">
    <button role="button" class="btn btn-primary" type="submit" >ADD STREET NAME</button><br>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;"><br>
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">STREET NAME</th>
        <th scope="col">ACTIONS</th>
      </tr>
    </thead>
    <tbody>
        @foreach($Addresses as $address)
        <tr>
            <td>{{ $address->name }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("address.edit",['address' => $address->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("address.destroy",['address' => $address->id]) }}" method="POST">
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