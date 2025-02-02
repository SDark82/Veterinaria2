<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrador | Proveedor</title>
    <link rel="stylesheet" href="../../../statics/css/main.css" />
    <link rel="stylesheet" href="../../../statics/css/administrador/admin_Cliente/cliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">

</head>

<body>
    <div class="fondo">

        <?php include("../../../includes/admin_header.php") ?>

        <div class="main-user">

            <?php include("../../../includes/admin_user.php") ?>

            <div class="contenedor">
                <div class="titulo-opcion">
                    <div class="motivo">PROVEEDORES</div>
                    <div class="atras" onclick="location.href = '../../administrador/administrador.php'">
                        ATRAS
                    </div>
                </div>
                <div class="botones">
                    <div class="boton verde"
                        onclick="location.href = '../admin_Proveedores/admin_agregarProveedor.php'">
                        <div class="image">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="texto">
                            AGREGAR
                        </div>
                    </div>
                    <div class="line">

                    </div>
                    <form action="admin_editarProveedor.php" method="get" id="form1">
                        <div class="boton" id="editar">
                            <div class="image">
                                <i class="fas fa-pen"></i>
                            </div>
                            <div class="texto">
                                EDITAR
                            </div>
                        </div>
                        <input type="hidden" name="idProveedor" id="idProveedor">
                    </form>
                    <div class="boton rojo" id="eliminar" onclick="accionEliminar()" style="display: none;">
                        <div class="image">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="texto">
                        </div>
                    </div>
                    <div class="difuminacion">

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
                            <div class="limpiar" onclick="limpiar()">
                                LIMPIAR
                            </div>
                        </div>
                        <div class="total-proveedores">
                            TOTAL &nbsp;<span class="ProveedoresTotales">2</span>
                        </div>
                    </div>

                    <div class="tabla-clientes">
                        <table id="tb-cliente" class="tabla">
                            <thead>
                                <th>ID PROVEEDOR</th>
                                <th>RTN PROVEEDOR</th>
                                <th>NOMBRE</th>
                                <th>DIRECCION</th>
                                <th>TELEFONO</th>
                                <th>ESTADO</th>
                            </thead>
                            <tbody>
                            <?php
                                include('../../conexion/conexion.php');

                                $query = 'SELECT * FROM  proveedores ';
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_array($result)) { ?>

                                    <tr class="filas" onclick="filas(event)">
                                        <td><?php echo $row['Id_Proveedor'] ?></td>
                                        <td><?php echo $row['RTN_Proveedor'] ?></td>
                                        <td><?php echo $row['Nombre_Legal'] ?></td>
                                        <td><?php echo $row['Direccion_Proveedor'] ?></td>
                                        <td><?php echo $row['Telefono_Proveedor'] ?></td>
                                        <td><?php echo $row['Estado_Proveedor']?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="eliminar">
            <div class="mensaje color-blanco-transparente">

                <div class="eliminar-mensaje">
                    ¿ESTA SEGURO QUE DESEA ELIMINAR A <span id="nombreProveedorEliminado"></span> ?
                </div>

                <div class="eliminar-buttons">
                <form action="admin_eliminarProveedor.php" method="get" id="form2">
                        <input type="hidden" name="idProveedor" id="idProveedorEliminado">
                        <div class="default-btn color-rojo-hover" onclick="eliminarProveedor()">
                            ELIMINAR
                        </div>
                    </form>
                    <div class="default-btn color-secundario-hover" onclick="cancelarEliminar()">
                        CANCELAR
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../statics/js/administrador/admin_Proveedor/admin_proveedor.js"></script>
</body>

</html>