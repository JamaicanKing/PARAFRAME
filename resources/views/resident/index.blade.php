<x-app-layout>
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("resident.create") }}">
    <button role="button" class="btn btn-success" type="submit">ADD RESIDENT</button>
  </a> 

</div>


<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">RESIDENT NAME</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($residents as $resident)
        <tr>
            <td>{{ $resident->name }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("resident.edit",['resident' => $resident->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("resident.destroy",['resident' => $resident->id]) }}" method="POST">
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