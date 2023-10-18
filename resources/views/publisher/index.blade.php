@extends('layouts.app')
@section('content')
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2 class="admin-heading">Lista de Editoriales</h2>
      </div>
      <div class="offset-md-7 col-md-2">
        <a class="add-new" href="{{ route('publisher.create') }}">Agregar Editorial</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="message"></div>
        <table class="content-table">
          <thead>
            <th>S.No</th>
            <th>Nombre de la Editorial</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </thead>
          <tbody>
            @forelse ($publishers as $publisher)
            <tr>
              <td>{{ $publisher->id }}</td>
              <td>{{ $publisher->name }}</td>
              <td class="edit">
                <a href="{{ route('publisher.edit', $publisher) }}" class="btn btn-success">Editar</a>
              </td>
              <td class="delete">
                <form action="{{ route('publisher.destroy', $publisher) }}" method="post" class="form-hidden">
                  <button class="btn btn-danger delete-author">Eliminar</button>
                  @csrf
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4">No se encontro edilorial</td>
            </tr>
            @endforelse
          </tbody>
        </table>
        {{ $publishers->links('vendor/pagination/bootstrap-4') }}
      </div>
    </div>
  </div>
</div>
@endsection
