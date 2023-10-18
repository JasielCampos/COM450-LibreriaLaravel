
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2 class="admin-heading"></h2>
      </div>
    </div>
    <div class="row">
      <div class="offset-md-3 col-md-6">
        <div class="yourform">
          <table cellpadding="10px" width="90%" style="margin: 0 0 20px;">
            <tr>
              <td>Estudiante: </td>
              <td><b>{{ $books->student->name }}</b></td>
            </tr>
            <tr>
              <td>Titulo del Libro : </td>
              <td><b>{{ $books->book->name }}</b></td>
            </tr>
            <tr>
              <td>Celular : </td>
              <td><b>{{ $books->student->phone }}</b></td>
            </tr>
            <tr>
              <td>Email : </td>
              <td><b>{{ $books->student->email }}</b></td>
            </tr>
            <tr>
              <td>Fecha de Prestamo : </td>
              <td><b>{{ $books->issue_date->format('d M, Y H:i') }}</b></td>
            </tr>
            <tr>
              <td>Fecha de Devolucion : </td>
              <td><b>{{ $books->return_date->format('d M, Y') }}</b></td>
            </tr>
           
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
