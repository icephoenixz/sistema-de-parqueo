<?php

include('app/config.php');
include('layout/admin/datos_usuario_sesion.php');



    //echo "exite sesion";
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <?php include('layout/admin/head.php'); ?>
    </head>
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('layout/admin/menu.php'); ?>
        <div class="content-wrapper">
            <br>
            <div class="container">

                <h2>Bienvenido al SISTEMA DE PARQUEO - HILARIWEB</h2>

                <br>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Mapeo actual del parqueo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <?php
                                    $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1' ");
                                    $query_mapeos->execute();
                                    $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($mapeos as $mapeo){
                                        $id_map = $mapeo['id_map'];
                                        $nro_espacio = $mapeo['nro_espacio'];
                                        $estado_espacio = $mapeo['estado_espacio'];

                                        if($estado_espacio == "LIBRE"){ ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $nro_espacio;?></h2>

                                                    <button class="btn btn-success" style="width: 100%;height: 114px"
                                                            data-toggle="modal" data-target="#modal<?php echo $id_map;?>">
                                                        <p><?php echo $estado_espacio;?></p>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal<?php echo $id_map;?>" tabindex="-1"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">INGRESO DEL VEHICULO</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Placa: <span><b style="color: red">*</b></span></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" style="text-transform: uppercase" class="form-control" id="placa_buscar<?php echo $id_map;?>">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <button class="btn btn-primary" id="btn_buscar_cliente<?php echo $id_map;?>" type="button">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                                                </svg>
                                                                                 Buscar
                                                                            </button>
                                                                            <script>
                                                                                $('#btn_buscar_cliente<?php echo $id_map;?>').click(function () {
                                                                                    var placa = $('#placa_buscar<?php echo $id_map;?>').val();
                                                                                    var id_map = "<?php echo $id_map;?>";

                                                                                    if(placa == ""){
                                                                                        alert('Debe de llenar el campo placa');
                                                                                        $('#placa_buscar<?php echo $id_map;?>').focus();
                                                                                    }else{
                                                                                        var url = 'clientes/controller_buscar_cliente.php';
                                                                                        $.get(url,{placa:placa,id_map:id_map},function (datos) {
                                                                                            $('#respuesta_buscar_cliente<?php echo $id_map;?>').html(datos);
                                                                                        });
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </div>

                                                                    <div id="respuesta_buscar_cliente<?php echo $id_map;?>">

                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Fecha de ingreso:</label>
                                                                        <div class="col-sm-8">
                                                                            <?php
                                                                            date_default_timezone_set("America/caracas");
                                                                            $fechaHora = date("Y-m-d h:i:s");
                                                                            $dia = date('d');
                                                                            $mes = date('m');
                                                                            $ano = date('Y');
                                                                            ?>
                                                                            <input type="date" class="form-control" id="fecha_ingreso<?php echo $id_map;?>" value="<?php echo $ano."-".$mes."-".$dia; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Hora de ingreso:</label>
                                                                        <div class="col-sm-8">
                                                                            <?php
                                                                            date_default_timezone_set("America/caracas");
                                                                            $fechaHora = date("Y-m-d h:i:s");
                                                                            $hora = date('H');
                                                                            $minutos = date('i');
                                                                            ?>
                                                                            <input type="time" class="form-control" id="hora_ingreso<?php echo $id_map;?>"  value="<?php echo $hora.":".$minutos; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Cuvículo:</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="cuviculo<?php echo $id_map;?>" value="<?php echo $nro_espacio; ?>">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-primary" id="btn_registrar_ticket<?php echo $id_map;?>">Imprimir ticket</button>
                                                                    <script>
                                                                        $('#btn_registrar_ticket<?php echo $id_map;?>').click(function () {

                                                                           var placa = $('#placa_buscar<?php echo $id_map;?>').val();
                                                                           var nombre_cliente = $('#nombre_cliente<?php echo $id_map;?>').val();
                                                                           var nit_ci = $('#nit_ci<?php echo $id_map;?>').val();
                                                                           var fecha_ingreso = $('#fecha_ingreso<?php echo $id_map;?>').val();
                                                                           var hora_ingreso = $('#hora_ingreso<?php echo $id_map;?>').val();
                                                                           var cuviculo = $('#cuviculo<?php echo $id_map;?>').val();
                                                                           var user_session = "<?php echo $usuario_sesion; ?>";


                                                                           if(placa == ""){
                                                                              alert('Debe de llenar el campo Placa');
                                                                               $('#placa_buscar<?php echo $id_map;?>').focus();
                                                                           }else if(nombre_cliente == ""){
                                                                                alert('Debe de llenar el campo nombre del cliente');
                                                                               $('#nombre_cliente<?php echo $id_map;?>').focus();
                                                                           }else if(nit_ci == ""){
                                                                               alert('Debe de llenar el campo Nit/Ci');
                                                                               $('#nit_ci<?php echo $id_map;?>').focus();
                                                                           }
                                                                           else{

                                                                               var url_1 = 'parqueo/controller_cambiar_estado_ocupado.php';
                                                                               $.get(url_1,{cuviculo:cuviculo},function (datos) {
                                                                                   $('#respuesta_ticket').html(datos);
                                                                               });

                                                                               var url_2 = 'clientes/controller_registrar_clientes.php';
                                                                               $.get(url_2,{nombre_cliente:nombre_cliente,nit_ci:nit_ci,placa:placa},function (datos) {
                                                                                   $('#respuesta_ticket').html(datos);
                                                                               });

                                                                               var url_3 = 'tickets/controller_registrar_ticket.php';
                                                                               $.get(url_3,{placa:placa,nombre_cliente:nombre_cliente,nit_ci:nit_ci,fecha_ingreso:fecha_ingreso,hora_ingreso:hora_ingreso,cuviculo:cuviculo,user_session:user_session},function (datos) {
                                                                                   $('#respuesta_ticket').html(datos);
                                                                               });


                                                                           }

                                                                        });
                                                                    </script>
                                                                </div>
                                                                <div id="respuesta_ticket">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>

                                        <?php
                                        }
                                        if($estado_espacio == "OCUPADO"){ ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $nro_espacio;?></h2>
                                                    <button class="btn btn-info">
                                                        <img src="<?php echo $URL;?>/public/imagenes/auto1.png" width="60px" alt="">
                                                    </button>
                                                    <p><?php echo $estado_espacio;?></p>
                                                </center>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>

                        </div>



                    </div>
                </div>

            </div>

        </div>
        <!-- /.content-wrapper -->
        <?php include('layout/admin/footer.php'); ?>
    </div>
    <?php include('layout/admin/footer_link.php'); ?>
    </body>
    </html>

