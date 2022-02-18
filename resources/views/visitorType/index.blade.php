<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-800 leading-tight">
            <b>{{ __('Vistor Types') }}
        </h2>
    </x-slot>
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("visitorType.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD Visitor Type</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Visitor Type</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($visitorTypes as $visitorType)
        <tr>
            <td>{{ $visitorType->name }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("visitorType.edit",['visitorType' => $visitorType->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("visitorType.destroy",['visitorType' => $visitorType->id]) }}" method="POST">
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