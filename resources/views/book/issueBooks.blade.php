@extends('layouts.app')
@section('content')
<div id="admin-content">
    <div class="container"> <div class="row"> <div class="col-md-3"> <h2 class="admin-heading">Lista de Libros
        Prestados</h2> </div> <div class="offset-md-6 col-md-3"> <a class="add-new"
        href="{{ route('book_issue.create') }}">Agregar Libro Prestado</a>

        </div>
    </div>
    <div class="row"> <div class="col-md-12"> <table class="content-table">
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
            @forelse ($books as $book)
            <tr style='@if (date(' Y-m-d')> $book->return_date->format('d-m-Y') && $book->issue_status == 'N') )
            background:rgba(255,0,0,0.2) @endif' >
            <td>{{ $book->id }}</td>
            <td>{{ $book->student->name }}</td>
            <td>{{ $book->book->name }}</td>
            <td>{{ $book->student->phone }}</td>
            <td>{{ $book->student->email }}</td>
            <td>{{ date('d M, Y H:i', strtotime($book->issue_date)) }}</td>
            <td>
                @if ($book->return_date)
                {{ date('d M, Y H:i', strtotime($book->return_date->format('d-m-Y'))) }}
                @else
                N/A
                @endif
            </td>


         <t    
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
                <div class="row mt-5">
                    <div class="col-md-6 offset-md-3">
                        <button class="btn btn-primary" onclick="generateCharts()">Generar Gráfica</button>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 offset-md-3">
                        <h3>Estado de libros</h3>
                        <div id="chart-container">
                            <canvas id="booksChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                @section('scripts')
                <script>
                    function generateCharts() {
                        var ctx = document.getElementById('booksChart').getContext('2d');

                        // Assuming that PHP is rendering this JavaScript, directly embed the PHP output into the JavaScript
                        const data = <? php echo json_encode($books); ?>;

                        const dataArray = data.data; // extracting array from object

                        var prestado = dataArray.filter(book => book.issue_status === 'N').length;
                        var devuelto = dataArray.filter(book => book.issue_status === 'Y').length;

                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Prestado', 'Devuelto'],
                                datasets: [{
                                    label: 'Estado de libros',
                                    data: [prestado, devuelto],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(0, 255, 0, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(0, 255, 0, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                //make the chart smaller
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: false
                                    }
                                }
                            }
                        });
                    }
                </script>



    </div>
    @endsection




    @endsection