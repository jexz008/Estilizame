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

?>


<input type="hidden" name="hdnPerfilCategoriaId" id="hdnPerfilCategoriaId" value="<?=$Perfil->categoria_id_fk?>" />
<input type="hidden" name="hdnPerfilId" id="hdnPerfilId" value="<?=$Perfil->id?>" />
<input type="hidden" name="hdnPerfilNombre" id="hdnPerfilNombre" value="<?=$Perfil->nombre?>" />
<input type="hidden" name="hdnPerfilDescripcion" id="hdnPerfilDescripcion" value="<?=$Perfil->descripcion?>" />
<input type="hidden" name="hdnPerfilEstado" id="hdnPerfilEstado" value="<?=$Perfil->estado?>" />
<input type="hidden" name="hdnPerfilMunicipio" id="hdnPerfilMunicipio" value="<?=$Perfil->municipio?>" />

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

                    <div class="row">
                        <?php
                        if($Perfil->galeria):foreach ($Perfil->galeria as $key => $img) {
                            echo <<<HTML
                <div class="col-xs-6 col-md-3">
                    <a href="{$img}" class="thumbnail grouped_elements" rel="group1">
                        <img class="img-thumbnai" src="{$img}" style="width: 128px; height: 128px">
                    </a>
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
            <!--<h2><?=$Perfil->nombre?></h2>
            <h3>Categoria: <?=$Perfil->categoria?></h3>
            <h3>Especialidades:</h3>
            <?php
            if($Perfil->especialidad):foreach ($Perfil->especialidad as $key => $value) {
                echo '<span class="label label-info">'.$value.'</span>';
            }else: echo '<span class="label label-default">Sin especialidades</span>'; endif;
            ?>
            <br><br>
            <p class="text-justify"><?=$Perfil->descripcion?></p>-->

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
                    <div class="embed-responsive embed-responsive-4by3"><?=$Perfil->ubicacion_html?></div>
                </div>
            </div>
            

            <!-- Video Youtube -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Video</h3>
                </div>
                <div class="panel-body">
                <?php if($Perfil->video != "http://www.youtube.com/embed/" ){ ?>
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src="<?= $Perfil->video ?>"></iframe>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-info text-center">PROMOCIONES</h2>
            <table class="table table-responsive table-striped table-condensed table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Promoción</th>
                        <th>Fecha termino</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($Perfil->promocion) : foreach ($Perfil->promocion as $key => $p) { ?>
                            <tr>
                                <td><img src="<?= $p->img ?>" width="600" height="150" /></td>
                                <td><?= $p->nombre ?></td>
                                <td><?= $p->fechaFin ?></td>
                            </tr>
                        <?php } else: echo '<td colspan="3">Sin Promociones</td>';
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#Modal_Promocion">
                PUBLICA UNA PROMOCION
            </button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#Modal_Eventos">
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