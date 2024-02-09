<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
    <!-- Enlazar Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['phone'] }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Acciones">
                                <button type="button" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger" onclick="eliminarUsuario({{ $user['id'] }})">Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

<script>
    function eliminarUsuario(userId) {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            fetch(`/api/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Si la solicitud se completó con éxito, mostrar un mensaje de éxito
                    alert('El usuario ha sido eliminado exitosamente.');
                    // Actualizar la página o realizar cualquier otra acción necesaria
                    window.location.reload();
                } else {
                    // Si la solicitud falló, mostrar un mensaje de error
                    alert('Hubo un problema al intentar eliminar el usuario.');
                }
            })
            .catch(error => {
                console.error('Hubo un error al realizar la solicitud:', error);
            });
        }
    }
</script>