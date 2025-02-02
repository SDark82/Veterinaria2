<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrador | Enfermedad</title>
    <link rel="stylesheet" href="../../../statics/css/main.css" />
    <link rel="stylesheet" href="../../../statics/css/administrador/admin_Cliente/cliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">
</head>

<body>
    <div class="fondo">

        <?php include("../../../includes/admin_header.php") ?>

        <div class="main-user">

            <?php include("../../../includes/admin_user.php") ?>

            <div class="contenedor">
                <div class="titulo-opcion">
                    <div class="motivo">ENFERMEDADES</div>
                    <div class="atras" onclick="location.href = '../../administrador/administrador.php'">
                        ATRAS
                    </div>
                </div>
                <div class="botones">
                    <div class="boton verde" onclick="location.href = '../admin_Enfermedades/admin_agregarEnfermedad.php'">
                        <div class="image">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="texto">
                            AGREGAR
                        </div>
                    </div>
                    <div class="line">

                    </div>

                    <div class="bloqueo-boton-general">
                        <div class="boton rojo" id="eliminar" onclick="accionEliminar()">
                            <div class="image">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="texto">
                                ELIMINAR
                            </div>
                        </div>
                        <div class="bloqueo-boton">

                        </div>
                    </div>
                </div>
                <div class="clientes">
                    <div class="descripcion">
                        <div class="herramientas">
                            <div class="buscador">
                                <div class="icono-buscar">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div class="cajaTexto-buscar">
                                    <input type="text" spellcheck="false" placeholder="BUSCAR NOMBRE O ID" id="buscar">
                                </div>
                            </div>
                            <div class="limpiar" onclick="limpiarTabla()">
                                LIMPIAR
                            </div>
                        </div>
                        <div class="total-clientes">
                            TOTAL &nbsp;<span class="clientesTotales">2</span>
                        </div>
                    </div>

                    <div class="tabla-clientes">
                        <table id="tb-cliente" class="tabla">
                            <thead>
                                <th>ID ENFERMEDAD</th>
                                <th>NOMBRE ENFERMEDAD</th>
                                <th>TRATAMIENTOS</th>
                                <th>MEDICAMENTOS</th>

                            </thead>
                            <tbody>
                                <?php

                                include("../../conexion/conexion.php");

                                $query = "SELECT e.Id_Enfermedad, e.Descripcion_Enfermedad, t.Descripcion, m.Descripcion_Medicamento FROM enfermedades AS e, tratamientos AS t, medicamentos AS m
                                    WHERE t.Id_Tratamiento = e.Tratamiento_Enfermedad
                                    AND m.Id_Medicamento = e.Medicamento_Enfermedad";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <tr class="filas" onclick="filas(event)">
                                        <td><?php echo $row['Id_Enfermedad'] ?></td>
                                        <td><?php echo $row['Descripcion_Enfermedad'] ?></td>
                                        <td><?php echo $row['Descripcion'] ?></td>
                                        <td><?php echo $row['Descripcion_Medicamento'] ?></td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>

        <input type="hidden" name="idElemento" id="IdElemento">

        <div class="eliminar">
            <div class="mensaje color-blanco-transparente">

                <div class="eliminar-mensaje">
                    ¿ESTA SEGURO QUE DESEA ELIMINAR A <span id="nombreClienteEliminado"></span> ?
                </div>

                <div class="eliminar-buttons">
                    <div class="default-btn color-rojo-hover">
                        ELIMINAR
                    </div>
                    <div class="default-btn color-secundario-hover" onclick="cancelarEliminar()">
                        CANCELAR
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/Proyecto/statics/js/administrador/admin_enfermedades/tablaEnfermedades.js"></script>
    <script src="/Proyecto/statics/js/administrador/admin_enfermedades/mostrarVentanaEliminacion.js"></script>
</body>

</html>