<?php
session_start();
/* if (!isset($_SESSION['xc_usuario_id']) or $_SESSION['xc_usuario_tipo']!="S"){
  header ("Location: ../index.php");
  } */
$empresaId = $_SESSION[$_app->prefijo . '_usuario_empresa_id'];

$Empresa = new Empresa();
$Perfil = $Empresa->getPerfil($empresaId);
?>



<div class="container">

    <div class="row">
        <div class="col-md-12 grid-section" id="grid-section">         
            <div class="page-header">
                <h1>Consuelo Vizzuett Makeup Artist <small>Salones</small></h1>
            </div>            
            <img style="width: 100%; height: 250px" class="img-responsive" src="storage/img/empresas/empresa_10/banners/PORTADILLA.jpg">
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <img class="img-responsive" src="storage/img/empresas/empresa_10/volante (1).jpg">
        </div>        
        <div class="col-md-7">
            <button data-target="#Modal_Premium" data-toggle="modal" class="btn btn-info form-control" type="button">
                ADQUIERE TU MEMBRESIA PREMIUM
            </button>
            <br><br>
            <div class="row">

                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img class="img-thumbnai" src="storage/img/empresas/empresa_10/galeria/tempFileForShare.jpg" style="width: 128px; height: 128px">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img class="img-thumbnai" src="storage/img/empresas/empresa_10/galeria/aew.jpg" style="width: 128px; height: 128px">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img class="img-thumbnai" src="storage/img/empresas/empresa_10/galeria/tempFileForShare.jpg" style="width: 128px; height: 128px">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img class="img-thumbnai" src="storage/img/empresas/empresa_10/galeria/aew.jpg" style="width: 128px; height: 128px">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img class="img-thumbnai" src="storage/img/empresas/empresa_10/galeria/tempFileForShare.jpg" style="width: 128px; height: 128px">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img class="img-thumbnai" src="storage/img/empresas/empresa_10/galeria/aew.jpg" style="width: 128px; height: 128px">
                    </a>
                </div>

            </div>    



        </div>        
    </div>

    <div class="row">
        <div class="col-md-5">
            <!-- Información de Empresa -->
            <h2><?=$Perfil->nombre?></h2>
            <h3>Categoria: <?=$Perfil->categoria?></h3>
            <h3>Especialidades:</h3>
            <?php
            foreach ($Perfil->especialidad as $key => $value) {
                echo "<h4>".$value."</h4>";
            }
            ?>
            <br>
            <h4><?=$Perfil->descripcion?></h4><br>
            <h4><?=$Perfil->direccion?></h4>
            <h4><?=$Perfil->municipio?>, <?=$Perfil->estado?></h4>
            <h4>Teléfonos</h4>
            <h4><?=$Perfil->telefono?></h4>
            <h4><?=$Perfil->email?></h4>

            <!-- Redes Sociales --> 
            <?php
            if(!empty($Perfil->facebook)){
                echo '<a href="'.$Perfil->facebook.'" target="_blank"><i class="fa fa-facebook-square socialmedia"></i></a>';
            }
            if(!empty($Perfil->twitter)){
                echo '<a href="'.$Perfil->twitter.'" target="_blank"><i class="fa fa-twitter-square socialmedia"></i></a>';
            }
            if(!empty($Perfil->googleplus)){
                echo '<a href="'.$Perfil->googleplus.'" target="_blank"><i class="fa fa-google-plus socialmedia"></i></a>';
            }
            if(!empty($Perfil->instagram)){
                echo '<a href="'.$Perfil->instagram.'" target="_blank"><i class="fa fa-facebook-instagram socialmedia"></i></a>';
            }
            
            ?>
        </div>
        <div class="col-md-7">
            <!-- Ubicación google maps -->            
            <?=$Perfil->ubicacion_html?>
            
            <!-- Video Youtube -->            
            <?php if($Perfil->video != "http://www.youtube.com/embed/" ){ ?>
                <div class="col-lg-12 banner text-right">
                  <iframe width="730" height="360" src="<?=$Perfil->video?>"></iframe>
                </div>
            <?php } ?>            
        </div>          
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-info text-center">PROMOCIONES</h2>
            <table class="table table-responsive table-striped table-condensed table-hover table-bordered">
                <thead>
                <tr class="tabla_header">
                    <th>Imagen</th>
                    <th>Promoción</th>
                    <th>Termina</th>
                </tr>
                </thead>
                <tbody>
                    <?php   foreach ($Perfil->promocion as $key => $p) { ?>
                    <tr>
                        <td><img src="<?=$p->img?>" width="600" height="150" /></td>
                        <td><?=$p->nombre?></td>
                        <td><?=$p->termio?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>        
    </div>    
    
    <div class="row">
        <div class="col-md-4">
            <button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#Modal_Promocion">
                PUBLICA UNA PROMOCION
            </button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#Modal_Eventos">
                PUBLICA UN EVENTO
            </button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#Modal_Modificar">
                MODIFICA TU PERFIL
            </button>
        </div>        
    </div>    
</div>