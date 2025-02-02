<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="/Proyecto/statics/css/main.css" />
    <link rel="stylesheet" href="/Proyecto/statics/css/administrador/admin_Cliente/cliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">
</head>

<body>
    <div class="fondo">

        <?php include("../../../includes/cliente_header.php") ?>

        <div class="main-user">

            <?php include("../../../includes/cliente_user.php") ?>

            <div class="contenedor">
                <div class="titulo-opcion">
                    <div class="motivo">MASCOTAS</div>
                    <div class="atras" onclick="location.href = '../cliente.php'">
                        ATRAS
                    </div>
                </div>
                <div class="botones">
                    <div class="boton verde" onclick="location.href = 'agregarMascotas.php'">
                        <div class="image">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="texto">
                            AGREGAR
                        </div>
                    </div>
                    <div class="line">

                    </div>
                    <?php
                    include("../../conexion/conexion.php");

                    if (isset($_GET['value'])) {
                        $valor = $_GET['value'];
                        switch ($valor) {
                            case 1:
                                echo "<div class='eliminacion-Cliente'>
                                <i class='fas fa-check'></i> &nbsp; MASCOTA ELIMINADA
                                </div>";
                                break;
                            case 2:
                                echo "<div class='alerta-mascota'>
                                <i class='fas fa-exclamation-circle'></i> &nbsp; MASCOTA TIENE CITA PENDIENTE
                                </div>";
                                break;

                            default:
                                # code...
                                break;
                        }
                    }

                    ?>
                </div>
                <div class="contenedor-mascotas">

                    <?php


                    $idCliente = $_SESSION['idCliente'];

                    $query = "SELECT m.Nombre_Mascota, m.Sexo, m.Edad_Mascota, m.Fecha_Mascota, m.Id_Mascota, te.Tipo_Especie, m.Fecha_Registro, r.Nombre_Raza
                    FROM mascotas AS m, tipo_especies AS te, razas AS r
                    WHERE m.Id_Cliente = '$idCliente'
                    AND te.Id_Especie = m.Id_Especie
                    AND m.Id_Raza = R.Id_Raza
                    ";
                    $resultado = mysqli_query($conn, $query);
                    $cont = 0;
                    while ($row = mysqli_fetch_array($resultado)) { ?>

                        <div class="perfil-mascotas color-blanco-transparente">
                            <div class="titulo-mascotas">
                                <?php echo $row['Nombre_Mascota'] ?>
                            </div>

                            <div class="icono-mascotas">
                                <?php

                                switch ($_SESSION['especies'][$cont]) {
                                    case '1':
                                        echo "<i class='fas fa-dog fa-3x'></i>";
                                        break;
                                    case '2':
                                        echo "<i class='fas fa-cat fa-3x'></i>";
                                        break;
                                    case '33':
                                        echo "<i class='fas fa-fish fa-3x'></i>";
                                        break;
                                    default:
                                        echo "<i class='fas fa-paw fa-3x'></i>";
                                        break;
                                }
                                $cont = $cont + 1;
                                ?>
                            </div>

                            <div class="info-mascotas">
                                <div class="col-mascota identificador">
                                    <div>
                                        SEXO:
                                    </div>
                                    <div>
                                        EDAD:
                                    </div>
                                    <div>
                                        FECHA NACIMIENTO:
                                    </div>
                                    <div>
                                        ESPECIE:
                                    </div>
                                    <div>
                                        RAZA:
                                    </div>
                                    <div>
                                        FECHA
                                        INGRESO:
                                    </div>
                                    <div>
                                        ULTIMA
                                        CITA:
                                    </div>
                                </div>

                                <div class="col-mascota result">
                                    <div>
                                        <?php echo $row['Sexo'] ?>
                                    </div>
                                    <div>
                                        <?php
                                        switch ($row['Edad_Mascota']) {
                                            case 0:
                                                echo "- 1 año";
                                                break;
                                            case 1:
                                                echo "1 año";
                                                break;
                                            default:
                                                echo $row['Edad_Mascota'] . " años";
                                                break;
                                        }

                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        $date = date("d-m-Y", strtotime($row['Fecha_Mascota']));
                                        echo $date;
                                        ?>
                                    </div>
                                    <div>
                                        <?php echo $row['Tipo_Especie'] ?>
                                    </div>
                                    <div>
                                        <?php echo $row['Nombre_Raza'] ?>
                                    </div>
                                    <div>
                                        <?php
                                        $date = date("d-m-Y", strtotime($row['Fecha_Registro']));
                                        echo $date ?>
                                    </div>
                                    <div>

                                        <?php

                                        $idMascota = $row['Id_Mascota'];
                                        $query2 = "SELECT Fecha_Cita
                                            FROM citas
                                            WHERE Id_Mascota = $idMascota
                                            ORDER BY Fecha_Cita DESC
                                            LIMIT 1";
                                        $resultado2 = mysqli_query($conn, $query2);
                                        $row2 = mysqli_fetch_array($resultado2);
                                        if (isset($row2['Fecha_Cita'])) {
                                            $date = date("d-m-Y", strtotime($row2['Fecha_Cita']));
                                            echo $date;
                                        } else {
                                            echo 'Sin Cita';
                                        }

                                        ?>
                                        <input type="hidden" id="idMascotaEliminar" value="<?php echo $idMascota ?>">
                                    </div>

                                </div>


                            </div>

                            <div class="botones-mascotas">

                                <div class="boton-historial-mascotas color-secundario" onclick="historial(<?php echo $idMascota ?>)">
                                    <i class="fas fa-history"></i> &nbsp; HISTORIAL
                                </div>
                                <div class="boton-eliminar-mascotas color-rojo-hover" onclick="accionEliminar(event)">
                                    <i class="fas fa-times"></i> &nbsp; ELIMINAR
                                </div>

                            </div>

                            <div class="editar-mascota">
                                <i class="fas fa-pen-square fa-2x"></i>
                            </div>
                        </div>

                    <?php } ?>
                </div>


            </div>

        </div>


        <div class="eliminar">
            <div class="mensaje color-blanco-transparente">

                <div class="eliminar-mensaje">
                    ¿Esta seguro que desea eliminar a: <span id="mascotaEliminar"></span>?
                </div>

                <div class="eliminar-buttons">
                    <form action="eliminarMascotas.php" method="get" id="form2">
                        <input type="hidden" name="idMascota" id="idMascota">
                        <input type="hidden" name="nombreMascota" id="inputNombreMascota">
                        <div class="default-btn color-rojo-hover" onclick="eliminarCliente()">
                            ELIMINAR
                        </div>
                    </form>
                    <div class="default-btn color-secundario-hover" onclick="cancelarEliminar()">
                        CANCELAR
                    </div>
                </div>
            </div>
        </div>



        <script src="/Proyecto/statics/js/cliente/cliente.js"></script>
        <script src="/Proyecto/statics/js/cliente/mascotas.js"></script>

</body>

</html>