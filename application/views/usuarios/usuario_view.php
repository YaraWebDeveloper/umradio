<?php echo $header ?>

<div class="page-header">
    <h1>Usuarios <small>Administración</small></h1>
</div>
<?php
mensaje(validation_errors());
//verficar que los mensajes no vengan vacíos
if ($valorMensaje != NULL):
    //escribo el mensaje que se envio.
    mensaje($valorMensaje, $valorTipoMensaje);
endif; //fin de verificacion de mensajes 
if ($dataRolUsuario != NULL):
    ?>
    <ul id="myTab" class="nav nav-tabs">
        <?php if ($Registros != NULL && $Registros != '') { ?>
            <li class="active"><a href="#uno" data-toggle="tab">Regístros Actuales</a></li>
        <?php } else { ?>
            <li><a href="<?php echo base_url($this->uri->segment(1)) ?>">Regresar</a></li>
        <?php } ?>
        <li <?php
        if ($Registros == NULL) {
            echo 'class="active"';
        }
        ?>><a href="#dos" data-toggle="tab">Agregar Regístro</a></li>
        <!--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
            </ul>
        </li> -->
    </ul>
    <?php
endif;
?>
<div id="myTabContent" class="tab-content">
    <?php if ($Registros != NULL) { ?>
        <div class="tab-pane fade in active" id="uno">
            <?php if ($Registros != ' ') { ?>
                <h2>Listado Actual</h2>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Registros as $itemUsuario):
                            echo ' 
                                    <tr>
                                        <td> ' . $itemUsuario->usu_nombre . ' ' . $itemUsuario->usu_apellido . ' </td>
                                        <td> ' . reemplazarEstado($itemUsuario->est_id) . ' </td>
                                        <td> <a href="' . base_url("usuario/editarUsuario/" . $itemUsuario->usu_id) . '">Editar</a> </td>
                                    </tr>
                                    ';
                        endforeach;
                        ?>
                    </tbody>
                </table>             
            <?php }else if ($Registros == ' ') { ?>
                <p>Aún no existe ningún registro para esta sección</p>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="tab-pane fade <?php
    if ($Registros == NULL) {
        echo 'in active';
    }
    ?>" id="dos">
         <?php
         $inputDisable = false;
         if ($Registros == NULL):
             $inputDisable = true;
         endif;
         $dataInputNombre = controlInput('usu_nombre', $valorNombre, 'Nombre', "required");
         $dataInputApellido = controlInput('usu_apellido', $valorApellido, 'Apellido', "required");
         $dataInputCedula = controlInput('usu_documento', $valorCedula, 'Documento de identidad', "required number", $inputDisable);
         $dataInputTelefono = controlInput('usu_telefono', $valorTelefono, 'Teléfono');
         $dataInputCelular = controlInput('usu_celular', $valorCelular, 'Célular');
         $dataInputCorreo = controlInput('usu_correo', $valorCorreo, 'Correo electrónico', "required email", $inputDisable);
         $dataInputContrasena = controlInput('usu_contrasena', "", 'Contrasena', "required pass", $inputDisable);
         $dataTipo = controlSelect($dataRolUsuario, "usu_rol_id", "usu_rol_nombre");
         $dataSelectedTipo = array($valorRolUsuario);
         $dataTipoDoc = controlSelect($dataTipoDoc, "tip_doc_id", "tip_doc_nombre");
         $dataSelectTipoDoc = array($valorTipoDoc);
         $dataEmpresa = controlSelect($dataEmpresa, "emp_id", "emp_razon_social");
         $dataSelectedEmpresa = array($valorEmpresa);
         $dataEstados = controlSelect();
         $dataSelectedEstados = array($valorEstado);
         ?>
        <!-- inicio formulario -->
        <h2>Administrar Usuario</h2>
        <?php
        $dataAtributos = array(
            'class' => 'formulario form_contrasena'
        );

        echo form_open($Action, $dataAtributos);
        ?>
        <table class="table table-condensed table-striped">
            <tr>
                <td style="width: 220px" class="align-right"><?php echo form_label('Nombre', 'lab_usu_nombre'); ?></td>
                <td>
                    <?php echo form_input($dataInputNombre); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Apellido', 'lab_usu_apellido'); ?></td>
                <td>
                    <?php echo form_input($dataInputApellido); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Tipo de Documento', 'lab_tip_doc_id'); ?></td>
                <td><?php //echo form_dropdown('tip_doc_id', array('0' => 'Choose a category...') + $dataTipoDoc, '0', 'disabled="disabled",class="required input-xlarge');               ?>
                    <?php echo form_dropdown('tip_doc_id', $dataTipoDoc, $dataSelectTipoDoc, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Documento de identidad', 'lab_usu_documento'); ?></td>
                <td>
                    <?php echo form_input($dataInputCedula); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Teléfono', 'lab_usu_telefono'); ?></td>
                <td>
                    <?php echo form_input($dataInputTelefono); ?>
                </td>
            </tr> 
            <tr>
                <td class="align-right"><?php echo form_label('Célular', 'lab_usu_celular'); ?></td>
                <td>
                    <?php echo form_input($dataInputCelular); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Email', 'lab_usu_correo'); ?></td>
                <td>
                    <?php echo form_input($dataInputCorreo); ?>
                </td>
            </tr> 
            <?php if ($Registros != NULL): ?>
                <tr>
                    <td class="align-right"><?php echo form_label('Contraseña', 'lab_usu_contrasena'); ?></td>
                    <td>
                        <?php echo form_password($dataInputContrasena); ?>
                        <div id="pswd_info">
                            <h4>La contraseña debería cumplir con los siguientes requerimientos:</h4>
                            <ul>
                                <li id="letter"><i aria-hidden="true"></i> Al menos debería tener <strong>una letra minúscula</strong></li>
                                <li id="special"> <i aria-hidden="true"></i> Debería tener carácteres especiales como <strong>@!#$%&?¿¡.</strong></li>
                                <li id="capital"><i aria-hidden="true"></i> Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                                <li id="number"><i aria-hidden="true"></i> Al menos debería tener <strong>un número</strong></li>
                                <li id="length"><i aria-hidden="true"></i> Debería tener más de <strong>8 carácteres</strong> como mínimo</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="align-right"><?php echo form_label('Empresa', 'lab_emp_id'); ?></td>
                <td><?php echo form_dropdown('emp_id', $dataEmpresa, $dataSelectedEmpresa, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Rol del usuario', 'lab_rol_usu_id'); ?></td>
                <td><?php echo form_dropdown('usu_rol_id', $dataTipo, $dataSelectedTipo, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Estado', 'lab_est_id'); ?></td>
                <td><?php echo form_dropdown('est_id', $dataEstados, $dataSelectedEstados, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td><?php echo form_hidden('usu_id', $valorId) ?></td>
                <td><?php echo form_submit('guardar', 'Guardar'); ?></td>
            </tr>
        </table>
        <?php echo form_close() ?>
        <!-- fin formulario -->   

        <!-- fin validaciones -->
    </div>
    <!--<div class="tab-pane fade" id="dropdown1">
      <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
    </div> -->
    <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/securepass.js"></script>
    <script type="text/javascript">
        $('.form_contrasena').validate({
            rules: {
                usu_contrasena: {
                    minlength: 8,
                    securePass: true
                }
            },
            messages: {
                usu_contrasena: {
                    minlength: "",
                    securePass: ""
                }
            }
        });
    </script>
</div>    





<?php echo $footer ?>        