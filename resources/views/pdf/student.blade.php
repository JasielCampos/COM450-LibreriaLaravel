<!DOCTYPE html> <html> <head> <title>Carnet de Lector</title> <!-- Enlaces a Bootstrap CSS y estilos personalizados -->
    <style> body { background-color: white; color: white; font-family: Arial, sans-serif; } .container { margin-top:
    50px; } .card { background-color: white; color: black; border: 2px solid red; } .card-header { background-color:
    red; color: white; } .card-body { padding: 20px; } </style> </head> <body> <div class="container"> <div
    class="card"> <div class="card-header"> Carnet de Lector </div>
<div class="card-body"> <p class="card-text">Nombre: {{ $student->name }}</p> <p class="card-text">Género: {{
    $student->gender }}</p>
    <p class="card-text">Celular: {{ $student->phone }}</p>
    <p class="card-text">Email: {{ $student->email }}</p>
    <!-- Agrega más datos si es necesario -->
</div>
</div>
</div>


</body>

</html>