@extends('layouts.app')
@section('content')
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2 class="admin-heading">Actualizar Estudiante</h2>
      </div>
    </div>
    <div class="row">
      <div class="offset-md-3 col-md-6">
        <form class="yourform" action="{{ route('student.update', $student->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Estudiante</label>
            <input type="text" class="form-control" placeholder="Estudiante" name="name" value="{{ $student->name }}" required>
            @error('name')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Direccion</label>
            <input type="text" class="form-control" placeholder="Direccion" name="address" value="{{ $student->address }}" required>
            @error('address')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Género</label>
            <select name="gender" class="form-control">
              @if ($student->gender == 'Hombre')
              <option value="Hombre" selected>Hombre</option>
              @else
              <option value="Mujer" selected>Mujer</option>
              @endif
            </select>
            @error('gender')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Clase</label>
            <input type="text" class="form-control" placeholder="Clase" name="class" value="{{ $student->class }}" required>
            @error('class')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Edad</label>
            <input type="number" class="form-control" placeholder="Edad" name="age" value="{{ $student->age }}" required>
            @error('age')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Celular</label>
            <input type="phone" class="form-control" placeholder="Celular" name="phone" value="{{ $student->phone }}" required>
            @error('phone')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $student->email }}" required>
            @error('email')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="photo" value="{{ $student->photo }}">
            @error('photo')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <input type="submit" name="save" class="btn btn-danger" value="Actualizar">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection