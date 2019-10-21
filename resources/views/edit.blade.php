@extends('layouts.master')
@extends('layouts.style')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
 <ul>
  @foreach($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
 </ul>
</div>
@endif
<style>
        .container{
            padding:0.5%;
        }
    </style>
<div class="container">
<h1 class="alert alert-dark text-center " style="color:red; text:bold">VOLKENO STAGE</h1>
<br>
<h2 class="alert alert-success " > Modifier l'Employé<span class="fa fa-user" style="float:right"> {{$data->nom}}  {{$data->prenom}}</span> </h2>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

<form method="post" action="{{ route('employee.update', $data->id) }}" enctype="multipart/form-data">
{{csrf_field()}}
{{method_field('PUT')}}
<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input mdbInput type="text" class="form-control" name="nom" id="nom" value="{{ $data->nom }}" placeholder="Nom">
    </div>
    <div class="form-group col-md-6">
      <input mdbInput type="text" class="form-control" name="prenom" id="prenom" value="{{ $data->prenom }}" placeholder="Prenom">
    </div>
  <div class="form-group col-md-6">
    <input mdbInput type="text" class="form-control" name="sexe" id="sexe" value="{{ $data->sexe}}" placeholder="Sexe">
  </div>
  <div class="form-group col-md-6">
    <input mdbInput type="email" class="form-control" name="email" id="email" value="{{ $data->email }}" placeholder="Email">
  </div>
    <div class="form-group col-md-6">
      <input mdbInput type="text" class="form-control" name="telephone" id="telephone" value="{{ $data->telephone }}" placeholder="(+) Telephone">
    </div>
    <div class="row">
    <div class="form-group col-md-4">
        <input type="file" name="image" id="image" class="form-control">
        </div>
    <div class="form-group col-md-3">
        <img src="{{ URL::to('/') }}/images/{{ $data->image }}"  width="80" height="80" />
        <input type="hidden" name="hidden_image" value="{{ $data->image }}" />
    </div>
    </div>
  </div>
 <a href="{{ route('employee.index') }}" class="btn btn-warning">Annuler</a>
 <button type="submit"  name="add" class="btn btn-info input-lg">Modifier</button>
</form>
</div>
 </div>
</form>
</div>
</div>
</div>

@endsection

@section('scripts')

<script>
 $('#browse_file').on('click',function(){
                            $('#image').click();                 
                        })
                        $('#image').on('change', function(e){
                            showFile(this, '#showImage');
                        })
</script>

@endsection