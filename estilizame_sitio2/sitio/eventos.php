<?php
$sitio = new Sitio();
$categoriaId = 2; // Academia
?>

<div class="container">

    <?php include 'banners.php'; ?>

    <div class="row">
        <div class="col-md-8">
            <?php include 'gridFiltroEventos.php'; ?>         
        </div>        
        <div class="col-md-4">
            <a id="imgFormSigIn" data-toggle="modal" data-target="#myModal" href="#">
                <img class="img-responsive" width="360" height="290" src="img/imagesANUNCIATE-GRATIS.png">
            </a>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-12 grid-section" id="grid-section">         
            <?php include 'gridEventos.php'; ?>
        </div>
    </div>    

</div>