<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Subir y descargar archivos del FTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">📤 Subir archivo al servidor FTP</h4>
                    </div>
                    <div class="card-body">

                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="archivo" class="form-label">Selecciona un archivo:</label>
                                <input type="file" class="form-control" name="archivo" id="archivo" required>
                                <small class="form-text text-muted">
                                    Solo se permiten archivos JPG, PNG y PDF, con un tamaño máximo de 10 MB.
                                </small>
                            </div>

                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" id="barraProgreso">0%</div>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <button type="submit" name="subir" class="btn btn-success">
                                    <i class="bi bi-upload"></i> Subir archivo
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Limpiar
                                </button>
                            </div>
                        </form>

                        <hr>

                        <?php
                        // ⚙️ Configuración FTP
                        $ftp_server = "18.119.248.153";  // Cambiar por tu IP
                        $ftp_user = "user1";              // Cambiar por tu usuario FTP
                        $ftp_pass = "user1";              // Cambiar por tu contraseña FTP

                        // Subir archivo si hay envío
                        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['archivo'])) {

                            $archivo_local = $_FILES['archivo']['tmp_name'];
                            $archivo_nombre = basename($_FILES['archivo']['name']);
                            $archivo_remoto = $archivo_nombre;

                            $max_tamano = 10 * 1024 * 1024; // 10 MB
                            $tipos_permitidos = ['image/jpeg', 'image/png', 'application/pdf'];

                            if ($_FILES['archivo']['size'] > $max_tamano) {
                                echo '<div class="alert alert-warning mt-3">⚠️ El archivo excede el tamaño máximo permitido (10MB).</div>';
                            } elseif (!in_array($_FILES['archivo']['type'], $tipos_permitidos)) {
                                echo '<div class="alert alert-warning mt-3">⚠️ Tipo de archivo no permitido. Solo JPG, PNG y PDF.</div>';
                            } elseif (!is_uploaded_file($archivo_local)) {
                                echo '<div class="alert alert-warning mt-3">⚠️ No se recibió el archivo correctamente.</div>';
                            } else {
                                $conn_id = ftp_connect($ftp_server, 21, 10);
                                if (!$conn_id) {
                                    echo '<div class="alert alert-danger mt-3">❌ No se pudo conectar al servidor FTP.</div>';
                                } elseif (!ftp_login($conn_id, $ftp_user, $ftp_pass)) {
                                    echo '<div class="alert alert-danger mt-3">❌ Error de autenticación FTP.</div>';
                                    ftp_close($conn_id);
                                } else {
                                    ftp_pasv($conn_id, true);

                                    if (ftp_put($conn_id, $archivo_remoto, $archivo_local, FTP_BINARY)) {
                                        echo '<div class="alert alert-success mt-3">✅ Archivo <strong>' . htmlspecialchars($archivo_nombre) . '</strong> subido exitosamente.</div>';
                                    } else {
                                        echo '<div class="alert alert-warning mt-3">⚠️ No se pudo subir el archivo.</div>';
                                    }

                                    ftp_close($conn_id);
                                }
                            }
                        }

                        <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Subir y descargar archivos del FTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">📤 Subir archivo al servidor FTP</h4>
                    </div>
                    <div class="card-body">

                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="archivo" class="form-label">Selecciona un archivo:</label>
                                <input type="file" class="form-control" name="archivo" id="archivo" required>
                                <small class="form-text text-muted">
                                    Solo se permiten archivos JPG, PNG y PDF, con un tamaño máximo de 10 MB.
                                </small>
                            </div>

                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" id="barraProgreso">0%</div>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <button type="submit" name="subir" class="btn btn-success">
                                    <i class="bi bi-upload"></i> Subir archivo
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Limpiar
                                </button>
                            </div>
                        </form>

                        <hr>

                        <?php
                        // ⚙️ Configuración FTP
                        $ftp_server = "18.119.248.153";  // Cambiar por tu IP
                        $ftp_user = "user1";              // Cambiar por tu usuario FTP
                        $ftp_pass = "user1";              // Cambiar por tu contraseña FTP

                        // Subir archivo si hay envío
                        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['archivo'])) {

                            $archivo_local = $_FILES['archivo']['tmp_name'];
                            $archivo_nombre = basename($_FILES['archivo']['name']);
                            $archivo_remoto = $archivo_nombre;

                            $max_tamano = 10 * 1024 * 1024; // 10 MB
                            $tipos_permitidos = ['image/jpeg', 'image/png', 'application/pdf'];

                            if ($_FILES['archivo']['size'] > $max_tamano) {
                                echo '<div class="alert alert-warning mt-3">⚠️ El archivo excede el tamaño máximo permitido (10MB).</div>';
                            } elseif (!in_array($_FILES['archivo']['type'], $tipos_permitidos)) {
                                echo '<div class="alert alert-warning mt-3">⚠️ Tipo de archivo no permitido. Solo JPG, PNG y PDF.</div>';
                            } elseif (!is_uploaded_file($archivo_local)) {
                                echo '<div class="alert alert-warning mt-3">⚠️ No se recibió el archivo correctamente.</div>';
                            } else {
                                $conn_id = ftp_connect($ftp_server, 21, 10);
                                if (!$conn_id) {
                                    echo '<div class="alert alert-danger mt-3">❌ No se pudo conectar al servidor FTP.</div>';
                                } elseif (!ftp_login($conn_id, $ftp_user, $ftp_pass)) {
                                    echo '<div class="alert alert-danger mt-3">❌ Error de autenticación FTP.</div>';
                                    ftp_close($conn_id);
                                } else {
                                    ftp_pasv($conn_id, true);

                                    if (ftp_put($conn_id, $archivo_remoto, $archivo_local, FTP_BINARY)) {
                                        echo '<div class="alert alert-success mt-3">✅ Archivo <strong>' . htmlspecialchars($archivo_nombre) . '</strong> subido exitosamente.</div>';
                                    } else {
                                        echo '<div class="alert alert-warning mt-3">⚠️ No se pudo subir el archivo.</div>';
                                    }

                                    ftp_close($conn_id);
                                }
                            }
                        }

                        // Mostrar lista de archivos disponibles en el FTP
                        echo '<hr>';
                        echo '<h5 class="text-center mb-3">📂 Archivos disponibles en el servidor:</h5>';

                        $conn_id = ftp_connect($ftp_server, 21, 10);
                        if ($conn_id && ftp_login($conn_id, $ftp_user, $ftp_pass)) {
                            ftp_pasv($conn_id, true);

                            $archivos = ftp_nlist($conn_id, ".");

                            if ($archivos !== false && count($archivos) > 0) {
                                echo '<ul class="list-group">';
                                foreach ($archivos as $archivo) {
                                    if ($archivo != "." && $archivo != "..") {
                                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                        echo '<i class="bi bi-file-earmark"></i> ' . htmlspecialchars($archivo);
                                        // Cambiar el enlace para descarga HTTP si es posible
                                        echo '';
                                 
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                }
                                echo '</ul>';
                            } else {
                                echo '<div class="alert alert-info text-center">ℹ️ No hay archivos en la carpeta del servidor.</div>';
                            }

                            ftp_close($conn_id);
                        } else {
                            echo '<div class="alert alert-danger text-center">❌ No se pudo conectar para listar archivos.</div>';
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const form = document.querySelector('form');
        const barraProgreso = document.getElementById('barraProgreso');

        form.addEventListener('submit', function () {
            let progreso = 0;
            barraProgreso.style.width = progreso + '%';
            barraProgreso.textContent = progreso + '%';

            const intervalo = setInterval(function () {
                if (progreso >= 100) {
                    clearInterval(intervalo);
                } else {
                    progreso += 10;
                    barraProgreso.style.width = progreso + '%';
                    barraProgreso.textContent = progreso + '%';
                }
            }, 200);
        });
    </script>

</body>

</html>


                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const form = document.querySelector('form');
        const barraProgreso = document.getElementById('barraProgreso');

        form.addEventListener('submit', function () {
            let progreso = 0;
            barraProgreso.style.width = progreso + '%';
            barraProgreso.textContent = progreso + '%';

            const intervalo = setInterval(function () {
                if (progreso >= 100) {
                    clearInterval(intervalo);
                } else {
                    progreso += 10;
                    barraProgreso.style.width = progreso + '%';
                    barraProgreso.textContent = progreso + '%';
                }
            }, 200);
        });
    </script>

</body>

</html>
