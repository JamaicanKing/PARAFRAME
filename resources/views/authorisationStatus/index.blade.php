<!DOCTYPE Html>
<html>
<head>

<style>
        table, th, td {
            border: 1.5px solid black;
        }

        table tr:not(:first-child) {
            cursor: pointer;
            transition: all .25s ease-in-out;
        }

        table tr:not(:first-child):hover {
            background-color: #ffad99;
        }

</style>
    </head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-800 leading-tight">
            <b>{{ __('Authorisation Statuses') }}
        </h2>
    </x-slot>
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("authorisationStatus.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD Authorisation Status</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Authorisation Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($authorisationStatus as $authorisationStatus)
        <tr>
            <td>{{ $authorisationStatus->name }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("authorisationStatus.edit",['authorisationStatus' => $authorisationStatus->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("authorisationStatus.destroy",['authorisationStatus' => $authorisationStatus->id]) }}" method="POST">
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