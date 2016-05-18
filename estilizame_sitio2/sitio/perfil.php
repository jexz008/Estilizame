<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of perfil
 *
 * @author Joel Corona
 */
class perfil {
    //put your code here
}

<?php
$sitio = new sitio();
$categoriaId = 2; // Academia
?>

<div class="page-header">
  <h1>Example page header <small>Subtext for header</small></h1>
</div>

<div class="container">
       
    <div class="row">
        <div class="col-md-8">
            <?php include 'gridFiltro.php'; ?>         
        </div>        
        <div class="col-md-4">
            <a id="imgFormSigIn" data-toggle="modal" data-target="#myModal" href="#">
                <img class="img-responsive" width="360" height="290" src="img/imagesANUNCIATE-GRATIS.png">
            </a>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-12 grid-section" id="grid-section">         
            <?php include 'grid.php'; ?>
        </div>
    </div>    
