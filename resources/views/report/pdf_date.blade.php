
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>TABLA DE REPORTES DIA</title>
    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
    <header>
        <br>
        <p><strong>Reporte no entregados</strong></p>
    </header>
     @if ($report)
    <div class="conteiner">
        <table class="table table-striped text-center">
            <thead>
              <tr>
                <th scope="col">S.No</th>
                <th scope="col">Student Name</th>
                <th scope="col">Book Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Issue Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($report as $reports)
                <tr>
                  <td scope='row'>{{ $reports->id }}</td>
                  <td>{{ $reports->student->name }}</td>
                  <td>{{ $reports->book->name }}</td>
                  <td>{{ $reports->student->phone }}</td>
                  <td>{{ $reports->student->email }}</td>
                  <td>{{ $reports->issue_date->format('d M, Y') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="10">No Record Found!</td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    @endif
</body>
</html>