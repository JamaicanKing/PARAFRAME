<x-app-layout>
    <x-slot name="header">
       <center> <h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <b>{{ __('COMMUNITY MANAGEMENT DASHBOARD') }}
        </h2></center>
    </x-slot>
 

<div class="p-2 mx-auto" style="width: 1000px;">
  <a href="{{ route("community.create") }}">
    <button role="button" class="btn btn-primary" type="submit" >ADD COMMUNITY NAME</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped"><br>
    <thead>
      <tr>
        <th scope="col">COMMUNITY NAME</th>
        <th scope="col">ACTIONS</th>
      </tr>
    </thead>
    <tbody>
        @foreach($communities as $community)
        <tr>
            <td>{{ $community->name }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("community.edit",['community' => $community->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("community.destroy",['community' => $community->id]) }}" method="POST">
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