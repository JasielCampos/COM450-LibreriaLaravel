@extends('layouts.app')
@section('content')
<div id="admin-content">
    <div class="container"> <div class="row"> <div class="col-md-4"> <h2 class="admin-heading">Lista de Estudiantes</h2>
        </div> <div class="offset-md-6 col-md-2"> <a class="add-new" href="{{ route('student.create') }}">Agregar
        Estudiante</a>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="message"></div>
            <table class="content-table">
                <thead>
                <th>S.No</th>
                <th>Estudiante</th>
                <th>Género</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Carnet de Lector</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                    <tr>
                    <td class="id">{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td class="text-capitalize">{{ $student->gender }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->email }}</td>
                    <td class="edit">
                    <a href="{{ route('student.pdf', $student->id) }}" target="_blank" class="btn
                        btn-success">Carnet</a>
                        </td>


                        <td class="view">
                            <button data-sid='{{ $student->id }}>' class=" btn btn-primary view-btn">Ver</button>
                        </td>
                        <td class="edit">
                        <a href="{{ route('student.edit', $student) }}>" class="btn btn-success">Editar</a>
                        </td>
                        <td class="delete">
                        <form action="{{ route('student.destroy', $student->id) }}" method="post" class="form-hidden">
                            <button class="btn btn-danger delete-student">Eliminar</button>
                            @csrf
                        </form>
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">No Students Found</td>
                        </tr>
                        @endforelse
                </tbody>
            </table>
            {{ $students->links('vendor/pagination/bootstrap-4') }}
            <div id="modal">
                <div id="modal-form">
                    <table cellpadding="10px" width="100%">

                    </table>
                    <div id="close-btn">X</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".view-btn").on("click", function () {
            var student_id = $(this).data("sid");
            $.ajax({
                url: "http://127.0.0.1:8000/student/show/" + student_id,
                type: "get",
                success: function (student) {
                    console.log(student);
                    var form =
                        "<tr><td>Student Name :</td><td><b>" + student['name'] + "</b></td></tr>" +
                        "<tr><td>Address :</td><td><b>" + student['address'] + "</b></td></tr>" +
                        "<tr><td>Gender :</td><td><b>" + student['gender'] + "</b></td></tr>" +
                        "<tr><td>Class :</td><td><b>" + student['class'] + "</b></td></tr>" +
                        "<tr><td>Age :</td><td><b>" + student['age'] + "</b></td></tr>" +
                        "<tr><td>Phone :</td><td><b>" + student['phone'] + "</b></td></tr>" +
                        "<tr><td>Email :</td><td><b>" + student['email'] + "</b></td></tr>";
                    $("#modal-form table").html(form);
                    $("#modal").show();
                }
            });
        });

        $("#close-btn").on("click", function () {
            $("#modal").hide();
        });

        $(".delete-student").on("click", function (e) {
            e.preventDefault();
            var student_id = $(this).closest("form").data("sid");
            if (confirm("Are you sure you want to delete this student?")) {
                $.ajax({
                    url: window.location.origin + "/student/delete/" + student_id,
                    type: "delete",
                    success: function (data) {
                        $(".message").html(data);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        });
    });
</script>
@endsection