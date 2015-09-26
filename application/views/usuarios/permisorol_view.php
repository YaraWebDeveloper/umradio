<?php echo $header ?>
<div class="page-header">
    <h1>Permisos de Rol <small>Administración</small></h1>
</div>
<?php
mensaje(validation_errors());
//verficar que los mensajes no vengan vacíos
if ($valorMensaje != NULL):
    //escribo el mensaje que se envio.
    mensaje($valorMensaje, $valorTipoMensaje);
endif; //fin de verificacion de mensajes 
?>
<ul id="myTab" class="nav nav-tabs">
    <?php if ($editar == 0) : ?>
        <li class="active"><a href="#uno" data-toggle="tab">Roles Activos</a></li>
    <?php else: ?>
        <li><a href="<?php echo base_url($this->uri->segment(1)) ?>">Regresar</a></li>
    <?php endif; ?>
    <?php if ($editar == 1): ?>
        <li class="active"><a href="#dos" data-toggle="tab">Asignar Permisos</a></li>
<?php endif; ?>
    <!--<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
            <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
        </ul>
    </li> -->
</ul>
<div id="myTabContent" class="tab-content">
        <?php if ($Registros != NULL) { ?>
        <div class="tab-pane fade in <?php if ($editar == 0): ?>active <?php endif ?>" id="uno">
    <?php if ($Registros != ' ') { ?>
                <h2>Listado Actual</h2>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Registros as $itemRol):
                            echo ' 
                                <tr>             
                                    <td> ' . $itemRol->usu_rol_nombre . ' </td>
                                    <td> <a href="' . base_url($this->uri->segment(1) . "/editarPermisoRol/" . $itemRol->usu_rol_id) . '">Editar</a> </td>
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
    <div class="tab-pane fade in <?php if ($editar == 1): ?>active <?php endif ?>" id="dos">
        <!-- inicio formulario -->
        <script src="<?php echo base_url("themes") ?>/general/scripts/jquery.min.js"></script>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url("themes") ?>/general/content/css/jquery.multiselect2side.css" />
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/jquery.multiselect2side.js"></script>
        <script type="text/javascript">
            $().ready(function() {
                $('#comp').on('click', function() {
                    $('#permisos_der option').each(function() {
                        //alert('opcion ' + $(this).text() + ' valor ' + $(this).attr('value'));
                        $(this).attr("selected", true);
                    });

                });

                $('#first').multiselect2side({
                    optGroupSearch: "Grupo: ",
                    labeldx: "Permisos del Rol",
                    search: "<img src='<?php echo base_url("themes") ?>/general/content/img/multiselect/search.gif' />"
                });

                /*$('.clickToView2').click(function() {
                 $(this).parent().prevAll("select:first").toggle();
                 return false;
                 });
                 
                 $('.clickToView').click(function() {
                 elClick = $(this);
                 selEl = elClick.prevAll("select:first");
                 
                 $.ajax({
                 url: 'jmultiselect2side.php',
                 data: selEl.serialize() + '&SELECTNAME=' + selEl.attr("name"),
                 success: function(data) {
                 elClick.next().next().next().html(data);
                 }
                 });
                 return false;
                 });*/
            });
        </script>
        <h2>Asignar permisos al rol: -<?php echo $dataNombreRol; ?></h2>
        <?php
        $dataAtributos = array(
            'class' => 'formulario'
        );

        echo form_open($Action, $dataAtributos);
        ?>
        <?php
        $dataConfirmar = array(
            'name' => 'comprobar',
            'id' => 'comp',
            'value' => 'Comprobar Roles',
            'class' => 'required'
        );
        ?>
        <table class="table table-condensed table-striped">
            <tr>
                <td colspan="2"><?php echo form_dropdown('permisos', $dataModulos, $dataPermisos, 'id="first" class="required"') ?></td>
            </tr>
            <tr>
                <td><?php echo form_hidden('mar_id', $valorId) ?></td>
                <td>

<?php echo form_checkbox($dataConfirmar) ?> 
                    Confirmar permisos de rol
                </td>
            </tr>
            <tr>
                <td><?php echo form_hidden('usu_rol_id', $valorId) ?></td>
                <td><?php echo form_submit('guardar', 'Guardar'); ?></td>
            </tr>
        </table>
<?php echo form_close() ?>
        <!-- fin formulario -->                            
    </div>
    <!--<div class="tab-pane fade" id="dropdown1">
      <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
    </div> -->

</div>    





<?php echo $footer ?>        