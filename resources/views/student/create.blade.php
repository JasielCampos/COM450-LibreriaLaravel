@extends('layouts.app')
@section('content')
<div id="admin-content">
    <div class="container"> <div class="row"> <div class="col-md-3"> <h2 class="admin-heading">Agregar Estudiante</h2>
        </div>
        <div class="offset-md-7 col-md-2">
        <a class="add-new" href="{{ route('students') }}">Lista de Estudiantes</a>
        </div>
    </div>
    <div class="row"> <div class="offset-md-3 col-md-6"> <form class="yourform"
    action="{{ route('student.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
    <label>Estudiante</label>
    <input type="text" class="form-control" placeholder="Nombre del Estudiante" name="name" value="{{
    old('name') }}" required>
    @error('name')
    <div class="alert alert-danger" role="alert">
    {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
<label>Dirección</label>
<input type="text" class="form-control" placeholder="Dirección" name="address" value="{{ old('address')
}}" required>
@error('address')
<div class="alert alert-danger" role="alert">
{{ $message }}
</div>
@enderror
</div>
<div class="form-group">
    <label>Género</label>
    <select name="gender" class="form-control">
    <option value="male" selected>Hombre</option>
    <option value="female">Mujer</option>
    </select>
    @error('gender')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
        </div>
        @enderror
        </div>
        <div class="form-group">
        <label>Clase</label>
        <input type="text" class="form-control" placeholder="Clase" name="class" value="{{ old('class')
        }}" required>
        @error('class')
        <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    </div>
    <div class="form-group">
        <label>Edad</label>
        <input type="number" class="form-control" placeholder="Edad" name="age" value="{{ old('age')
        }}" required>
        @error('age')
        <div class="alert alert-danger" role="alert">
        {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
    <label>Celular</label>
    <input type="phone" class="form-control" placeholder="Celular" name="phone" value="{{
                                old('phone') }}" required>
                                @error('phone')
                                <div class=" alert alert-danger" role="alert">
    {{ $message }}
    </div>
    @enderror
    </div>
    <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
    @error('email')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control" id="photo" name="photo">
</div>
<input type="submit" name="save" class="btn btn-danger" value="Guardar">
</form>
</div>
</div>
</div>
</div>
@endsection