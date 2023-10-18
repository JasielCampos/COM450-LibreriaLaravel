@extends('layouts.app')
@section('content')
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2 class="admin-heading">Lista de Categorias</h2>
      </div>
      <div class="offset-md-7 col-md-2">
        <a class="add-new" href="{{ route('category.create') }}">Agregar Categoria</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="message"></div>
        <table class="content-table">
          <thead>
            <th>S.No</th>
            <th>Nombre de la Categoria</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </thead>
          <tbody>
            @forelse ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td class="edit">
                <a href="{{ route('category.edit', $category) }}" class="btn btn-success">Editar</a>
              </td>
              <td class="delete">
                <form action="{{ route('category.destroy', $category) }}" method="post" class="form-hidden">
                  <button class="btn btn-danger delete-author">Eliminar</button>
                  @csrf
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4">No se encontro la categoria</td>
            </tr>
            @endforelse
          </tbody>
        </table>
        {{ $categories->links('vendor/pagination/bootstrap-4') }}
      </div>
    </div>
  </div>
</div>
@endsection
