@extends('layouts.app')
@section('content')
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2 class="admin-heading">Actualizar Libro</h2>
      </div>
    </div>
    <div class="row">
      <div class="offset-md-3 col-md-6">
        <form class="yourform" action="{{ route('book.update', $book->id) }}" method="post" autocomplete="off">
          @csrf
          <div class="form-group">
            <label>Titulo</label>
            <input type="text" class="form-control @error('name') isinvalid @enderror" placeholder="Titulo" name="name" value="{{ $book->name }}">
            @error('name')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Categoría</label>
            <select class="form-control @error('category_id') isinvalid @enderror " name="category_id">
              <option value="">Categoría</option>
              @foreach ($categories as $category)
              @if ($category->id == $book->category_id)
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
              @else
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endif
              @endforeach
            </select>
            @error('category_id')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Autor</label>
            <select class="form-control @error('auther_id') isinvalid @enderror " name="author_id">
              <option value="">Autor</option>
              @foreach ($authors as $auther)
              @if ($auther->id == $book->auther_id)
              <option value="{{ $auther->id }}" selected>{{ $auther->name }}</option>
              @else
              <option value="{{ $auther->id }}">{{ $auther->name }}</option>
              @endif
              @endforeach
            </select>
            @error('auther_id')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Editorial</label>
            <select class="form-control @error('publisher_id') isinvalid @enderror " name="publisher_id">
              <option value="">Editorial</option>
              @foreach ($publishers as $publisher)
              @if ($publisher->id == $book->publisher_id)
              <option value="{{ $publisher->id }}" selected>{{ $publisher->name }}</option>
              @else
              <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
              @endif
              @endforeach
            </select>
            @error('publisher_id')
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