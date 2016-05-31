<?php
session_start();
/* if (!isset($_SESSION['xc_usuario_id']) or $_SESSION['xc_usuario_tipo']!="S"){
  header ("Location: ../index.php");
  } */
$empresaId  = $_SESSION[$_app->prefijo . '_usuario_empresa_id'];
if($_Pruebas) { $empresaId = $_REQUEST['perfil']?:$empresaId; } //Pruebas
$Empresa    = new Empresa();
$Perfil     = $Empresa->getPerfil($empresaId);
$pathImgs   = $_Storage_Images . $_Storage_Images_Prefix . $empresaId;

list($tel1, $tel2, $tel3) = explode(",", $Perfil->telefono);
?>


<input type="hidden" name="hdnPerfilCategoriaId" id="hdnPerfilCategoriaId" value="<?=$Perfil->categoria_id_fk?>" />
<input type="hidden" name="hdnPerfilId" id="hdnPerfilId" value="<?=$Perfil->id?>" />
<input type="hidden" name="hdnPerfilNombre" id="hdnPerfilNombre" value="<?=$Perfil->nombre?>" />
<input type="hidden" name="hdnPerfilEstado" id="hdnPerfilEstado" value="<?=$Perfil->estado?>" />
<input type="hidden" name="hdnPerfilMunicipio" id="hdnPerfilMunicipio" value="<?=$Perfil->municipio?>" />
<input type="hidden" name="hdnPerfilDireccion" id="hdnPerfilDireccion" value="<?= $Perfil->direccion ?>" />
<input type="hidden" name="hdnPerfilTelefono1" id="hdnPerfilTelefono1" value="<?= $tel1 ?>" />
<input type="hidden" name="hdnPerfilTelefono2" id="hdnPerfilTelefono2" value="<?= $tel2 ?>" />
<input type="hidden" name="hdnPerfilTelefono3" id="hdnPerfilTelefono3" value="<?= $tel3 ?>" />
<input type="hidden" name="hdnPerfilEmail" id="hdnPerfilEmail" value="<?=$Perfil->email?>" />
<input type="hidden" name="hdnPerfilVideo" id="hdnPerfilVideo" value="<?=$Perfil->video?>" />
<input type="hidden" name="hdnPerfilFacebook" id="hdnPerfilFacebook" value="<?=$Perfil->facebook?>" />
<input type="hidden" name="hdnPerfilTwitter" id="hdnPerfilTwitter" value="<?=$Perfil->twitter?>" />
<input type="hidden" name="hdnPerfilGoogle" id="hdnPerfilGoogle" value="<?=$Perfil->googleplus?>" />
<input type="hidden" name="hdnPerfilInstagram" id="hdnPerfilInstagram" value="<?=$Perfil->instagram?>" />
<input type="hidden" name="hdnPerfilFoto" id="hdnPerfilFoto" value="<?=$Perfil->foto_perfil?>" >
<input type="hidden" name="hdnPerfilFotoSrc" id="hdnPerfilFotoSrc" value="<?=$pathImgs?>/<?=$Perfil->foto_perfil?>" >
<input type="hidden" name="hdnPerfilCabecera" id="hdnPerfilCabecera" value="<?=$Perfil->foto_cabecera?>" >
<input type="hidden" name="hdnPerfilCabeceraSrc" id="hdnPerfilCabeceraSrc" value="<?=$pathImgs?>/banners/<?=$Perfil->foto_cabecera?>" >
<textarea name="hdnPerfilUbicacion" id="hdnPerfilUbicacion" style="display: none" ><?=$Perfil->ubicacion_html?></textarea>
<textarea name="hdnPerfilDescripcion" id="hdnPerfilDescripcion" style="display: none" ><?=$Perfil->descripcion?></textarea>


<div class="container">

    <div class="row">
        <div class="col-md-12 grid-section" id="grid-section">
            <div class="page-header">
                <h1><?=$Perfil->nombre?> <small><?=$Perfil->categoria?></small></h1>
            </div>
            <img style="width: 100%; height: 250px" class="img-responsive" src="<?=$pathImgs?>/banners/<?=$Perfil->foto_cabecera?>">
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Foto de perfil</h3>
                </div>
                <div class="panel-body">
                    <img class="img-responsive img-rounded center-block" src="<?=$pathImgs?>/<?=$Perfil->foto_perfil?>">
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <button data-target="#Modal_Premium" data-toggle="modal" class="btn btn-primary btn-lg btn-block" type="button">
                ADQUIERE TU MEMBRESIA PREMIUM
            </button>
            <br>
            <!-- Galería -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Galería</h3>
                </div>
                <div class="panel-body">

                    <div class="row" id="perfilGaleria">
                        <?php
                        if($Perfil->galeria):foreach ($Perfil->galeria as $key => $img) {
                            list($imgSinExt) = explode(".jpg", $img);
                            $thumb = $imgSinExt . '_256x256.jpg';
                            echo <<<HTML
                <div class="col-xs-6 col-md-3" id="galeria_{$Perfil->id}_{$key}">
                    <a href="{$img}" class="thumbnail grouped_elements" rel="group1">
                        <img class="img-thumbnai" src="{$thumb}" style="width: 128px; height: 128px">
                    </a>
                    <i class="glyphicon glyphicon-trash ico-del-img" onClick="deleteImg('{$img}', {$key});"></i>
                </div>
HTML;
                        }else: echo "Sin imágenes"; endif;
                        ?>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <!-- Información de Empresa -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mi información</h3>
                </div>
                <div class="panel-body">

                    <dl>
                        <!--<dt>Nombre</dt>-->
                        <dd><h2><?=$Perfil->nombre?></h2></dd>
                        <dt>Categoria</dt>
                        <dd><?=$Perfil->categoria?></dd>
                        <br>
                        <dt>Especialidades</dt>
                        <dd>
                        <?php
                        if($Perfil->especialidades):foreach ($Perfil->especialidades as $key => $especialidad) {
                            echo '<span class="label label-info">'.$especialidad->nombre.'</span> ';
                        }else: echo '<span class="label label-default">Sin especialidades</span>'; endif;
                        ?>
                        </dd>
                        <br>
                        <dt>Descripción</dt>
                        <dd><p class="text-justify"><?=$Perfil->descripcion?></p></dd>
                    </dl>

            <address>
                <strong><?= $Perfil->municipio ?>, <?= $Perfil->estado ?></strong><br>
                <?= $Perfil->direccion ?><br>
                <abbr title="Teléfonos">Tels:</abbr> <?= $Perfil->telefono ?><br>
                <a href="mailto:#"><?=$Perfil->email?></a>
            </address>

            <!-- Redes Sociales -->
            <?php
            if(!empty($Perfil->facebook)){
                echo '<a href="'.$Perfil->facebook.'" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>&nbsp;&nbsp;&nbsp;';
            }
            if(!empty($Perfil->twitter)){
                echo '<a href="'.$Perfil->twitter.'" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>&nbsp;&nbsp;&nbsp;';
            }
            if(!empty($Perfil->googleplus)){
                echo '<a href="'.$Perfil->googleplus.'" target="_blank"><i class="fa fa-google-plus fa-2x"></i></a>&nbsp;&nbsp;&nbsp;';
            }
            if(!empty($Perfil->instagram)){
                echo '<a href="'.$Perfil->instagram.'" target="_blank"><i class="fa fa-facebook-instagram fa-2x"></i></a>&nbsp;&nbsp;&nbsp;';
            }
            ?>

                </div>
            </div>



        </div>
        <div class="col-md-7">
            <!-- Ubicación google maps -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ubicación</h3>
                </div>
                <div class="panel-body">
                    <?php if(!empty($Perfil->ubicacion_html)) { ?>
                        <div class="embed-responsive embed-responsive-4by3"><?=$Perfil->ubicacion_html?></div>
                    <?php }else{ ?>
                        <img class="img-responsive img-rounded center-block" src="img/google-maps-logo.png">
                    <?php } ?>
                </div>
            </div>


            <!-- Video Youtube -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Video</h3>
                </div>
                <div class="panel-body">
                <?php if($Perfil->video != "http://www.youtube.com/embed/" && !empty($Perfil->video)){ ?>
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src="<?= $Perfil->video ?>"></iframe>
                    </div>
                <?php }else{ ?>
                    <img class="img-responsive img-rounded center-block" src="img/youtubelogo.png">
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="grid-section" class="col-md-12 grid-section">
            <h3>PROMOCIONES <small>(<?=count($Perfil->promocion)?>)</small></h3>
            <table class="table table-responsive table-striped table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Promoción</th>
                        <th>Descripción</th>
                        <th>Fecha termino</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($Perfil->promocion) : foreach ($Perfil->promocion as $key => $p) {
                            $imgPromocion = $pathImgs . '/promociones/promocion-' . str_pad($p->id, 10, "0", STR_PAD_LEFT);
                            $imgPromocionThumb = $imgPromocion . '_48x48.jpg';
                            $imgPromocion .= '.jpg';
                    ?>
                            <tr>
                                <td>
                                    <a href="<?=$imgPromocion?>" class="thumbnail grouped_elements" rel="groupPromociones" style="width: 48px; height: 48px; margin: 0"><img class="img-thumbnai" src="<?=$imgPromocionThumb?>" ></a>
                                </td>
                                <td><?= $p->nombre ?></td>
                                <td><?= $p->descripcion ?></td>
                                <td><?= date('d/m/y', strtotime($p->fecha_fin)) ?></td>
                            </tr>
                        <?php } else: echo '<td colspan="3">Sin Promociones</td>';
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modalPerfilUpdate" id="btnFormPromociones">
                PUBLICA UNA PROMOCION
            </button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modalPerfilUpdate" id="btnFormEventos">
                PUBLICA UN EVENTO
            </button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal" id="btnFormUpdatePerfil">
                MODIFICA TU PERFIL
            </button>
        </div>
    </div>
</div>