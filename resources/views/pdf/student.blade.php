<!DOCTYPE html>
<html>

<head>
    <title>Carnet de Lector</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            /* background-color: lightgreen; */
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            background-color: white;
            width: 46%;
            margin-left: 4%;
            height: 210px;
            border: 6px solid #DC143C;
            border-radius: 3%;
        }

        .card {
            background-color: white;
            color: black;
            border: 3px solid #DC143C;
            display: flex;
        }


        .card-header {
            background-color: #DC143C;
            color: white;
            text-align: center;
            font-size: 20px;
        }

        .card-body {
            display: flex;
            flex-direction: row-reverse;
            background-color: white;
            flex-wrap: nowrap;
        }

        .student-photo {
            width: 60%;
            height: 60%;
            margin-left: 20%;
            margin-top: 10%;
            border-radius: 50%;
            border: 3px solid #DC143C;
        }


        .contenedor-datos {
            /* background-color: lightblue;*/
            width: 70%;
            /* Ocupa la mitad del card-body */
            float: left;
            margin: 10px;
            margin-top: 30px;
        }

        .foto-lector {
            /* background-color: lightblue; */
            float: right;
            width: 50%;
            height: 100%;
            margin-left: 20px;
        }

        p {
            font-size: 12px;
        }

        .font-weight-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Carnet de Lector
            </div>
            <div class="card-body">
                <div class="contenedor-datos">
                    <p class="card-text"><span class="font-weight-bold">Libreria eLibrary</p>
                    <p class="card-text"><span class="font-weight-bold"> Nombre: </span>{{ $student->name }}</p>
                    <p class="card-text"><span class="font-weight-bold">Género: </span>{{ $student->gender }}</p>
                    <p class="card-text"><span class="font-weight-bold">Celular: </span>{{ $student->phone }}</p>
                    <p class="card-text"><span class="font-weight-bold">Email: </span>{{ $student->email }}</p>
                </div>

                <div class="foto-lector">
                    @if ($student->photo)
                        <?php
                        $imagePath = public_path('uploads/' . $student->photo);
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $imageBase64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
                        ?>
                        <img src="{{ $imageBase64 }}" alt="Student Photo" class="student-photo">
                    @else
                        {{-- <div style="width: 100px; height: 100px; border: 1px solid black;"></div> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
