<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>REPORTE</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    @page {
      margin: 0cm 0cm;
      font-size: 0.25cm;
    }

    body {
      margin: 2cm 1cm 2cm;
    }
  </style>
</head>

<body>
  <main>
    <form id="pdfForm2" class="yourform mb-5" action="{{ route('pdf_month') }}" method="get">


      <div class="container" style="size">
        <h5 style="text-align: center"><strong>Reporte de libros no devueltos</strong></h5>
        <table class="table table-striped text-center">
          <thead>
            <th scope="col">S.No</th>
            <th scope="col">Estudiante</th>
            <th scope="col">Titulo del Libro</th>
            <th scope="col">Celular</th>
            <th scope="col">Email</th>
            <th scope="col">Fecha de Prestamo</th>
            <th scope="col">Fecha de Devolucion</th>
            <!-- <th scope="col">Dias de Retraso</th> -->
          </thead>
          <tbody>
            @forelse ($books as $book)
            <tr>
              <td scope="row">{{ $book->id }}</td>
              <td>{{ $book->student->name }}</td>
              <td>{{ $book->book->name }}</td>
              <td>{{ $book->student->phone }}</td>
              <td>{{ $book->student->email }}</td>
              <td>{{ $book->issue_date->format('d M, Y') }}</td>
              <td>{{ $book->return_date->format('d M, Y') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="10">No se encontro nada!</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
  </main>
</body>

</html>