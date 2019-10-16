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
<h2 class="alert alert-success text-center color:red">Bienvenu!! Veuillez créer un employé</h2>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

<form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">

{{csrf_field()}}
<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input mdbInput type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
    </div>
    <div class="form-group col-md-6">
      <input mdbInput type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom">
    </div>
  <div class="form-group col-md-6">
    <input mdbInput type="text" class="form-control" name="sexe" id="sexe" placeholder="Sexe">
  </div>
  <div class="form-group col-md-6">
    <input mdbInput type="email" class="form-control" name="email" id="email" placeholder="Email">
  </div>
    <div class="form-group col-md-6">
      <input mdbInput type="text" class="form-control" name="telephone" id="telephone" placeholder="(+) Telephone">
    </div>
    <div class="form-group col-md-3">
        <input type="file" name="image" id="image" class="form-control">
    </div>
  </div>
 <a href="{{ route('employee.index') }}" class="btn btn-warning">Annuler</a>
 <button type="submit"  name="add" class="btn btn-info input-lg">Créer</button>
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
 //---------------------Browse image----------------
 $('#browse_file').on('click',function(){
                            $('#image').click();                 
                        })
                        $('#image').on('change', function(e){
                            showFile(this, '#showImage');
                        })
</script>

@endsection