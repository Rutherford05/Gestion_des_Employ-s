    
@extends('layouts.master')
@section('content')

<style>
        .container{
            padding:0.5%;
        }
    </style>
<div class="container">
<h1 class="alert alert-dark text-center " style="color:red; text:bold">GESTION DES EMPLOYES</h1>

@if($message = Session::get('Success'))
<div class="alert alert-success">
<p align="center">{{$message}}</p>
</div>
@endif

@if($message = Session::get('error'))
<div class="alert alert-danger">
<p align="center">{{$message}}</p>
</div>
@endif

</div>
<div class="input-group">
<form class="form-inline ml-auto">
      <div class="md-form my-0">
      <input class="form-control" id="search"
                           value="{{ request('search') }}"
                           placeholder="Rechercher" name="search"
                           type="text" id="search"/>
      </div>
      <button href="#!" class="btn btn-success btn-md btn-rounded my-0 ml-sm-2" type="submit">Rechercher</button>
    </form>
<div align="right">
 <a href="{{ route('employee.create') }}" class="btn btn-success">
 <span class="fa fa-plus-circle"> Ajouter un Employé</span></a>
</div>
<table class="table table-bordered table-striped bg-dark" style="color:white; border:none">
 <tr class="text-center">
  <th width="10%">Image</th>
  <th >Nom</th>
  <th >Prenom</th>
  <th >Sexe</th>
  <th >Email</th>
  <th >Telephone</th>
  <th >Action</th>
 </tr>
 @foreach($data as $employee)
 <tbody style="color:black; font:blod; background:#ffff">
  <tr class="text-center">
   <td><img src="{{ URL::to('/') }}/images/{{ $employee->image }}"  width="90" height="90" /></td>
   <td>{{ $employee->nom }}</td>
   <td>{{ $employee->prenom }}</td>
   <td>{{ $employee->sexe }}</td>
   <td>{{ $employee->email }}</td>
   <td>{{ $employee->telephone }}</td>
   <td width="25%">
   <form action="{{ route('employee.destroy', $employee->id) }}" method="post">
	<a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-success"><span class="fa fa-edit"></span>Modifier</a>
	{{csrf_field()}}
    {{method_field('DELETE')}}
	<button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span>Supprimer</button>
	</form>
    
            
   </td>
  </tr>
  </tbody>
 @endforeach
</table>
{!! $data->links() !!}
@endsection