@extends('layouts.app')
@section('content')
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2 class="admin-heading">Lista de Libros Prestados</h2>
      </div>
      <div class="offset-md-6 col-md-3">
        <a class="add-new" href="{{ route('book_issue.create') }}">Agregar Libro Prestado</a>
        <!-- <a class="add-new" href="{{ route('book_issued.generate_pdf') }}">Generar PDF</a> -->
        <a class="add-new" href="{{ route('generate_pdf') }}">Generar PDF</a>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="content-table">
          <thead>
            <th>S.No</th>
            <th>Estudiante</th>
            <th>Titulo del Libro</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Fecha de Prestamo</th>
            <th>Fecha de Devolucion</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </thead>
          <tbody>
            @forelse ($book as $book)
            <!-- <tr style='@if (date(' Y-m-d')> $book->return_date->format('d-m-Y') && $book->issue_status == 'N') ) background:rgba(255,0,0,0.2) @endif' > -->
            <td>{{ $book->id }}</td>
            <td>{{ $book->student->name }}</td>
            <td>{{ $book->book->name }}</td>
            <td>
              @if ($book->student && $book->student->phone)
              {{ $book->student->phone }}
              @else
              N/A
              @endif
            </td>


            <td>{{ $book->student->email }}</td>
            <td>
              @if ($book->return_date)
              {{ \Carbon\Carbon::parse($book->return_date)->format('d M, Y H:i') }}
              @else
              N/A
              @endif
            </td>




            <td>
              @if ($book->issue_status == 'Y')
              <span class='badge badge-success'>Disponible</span>
              @else
              <span class='badge badge-danger'>Prestado</span>
              @endif
            </td>
            <td class="edit">
              <a href="{{ route('book_issue.edit', $book->id) }}" class="btn btn-success">Editar</a>
            </td>
            <td class="delete">
              <form action="{{ route('book_issue.destroy', $book) }}" method="post" class="form-hidden">
                <button class="btn btn-danger">Eliminar</button>
                @csrf
              </form>
            </td>
            </tr>
            @empty
            <tr>
              <td colspan="10">No existen libros prestados</td>
            </tr>
            @endforelse
          </tbody>
        </table>
        {{ $books->links('vendor/pagination/bootstrap-4') }}
      </div>
    </div>
  </div>
</div>
@endsection