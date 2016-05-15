<?php
$sitio = new sitio();
$sliders = $sitio->createSliders();
?>



<div class="container-fluid">

<?php include 'banners.php'; ?>

<!-- ----------------------------------------- Slider Fila 2 ------------------------------------------- -->

	<div class="row">
		<div class="col-md-12 text-center">

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
		<?=$sliders[0]?>
    &nbsp;
  </div>

</div>

			
		</div>
	</div><!-- row -->

<!-- ----------------------------------------- Texto Fila 2 ------------------------------------------- -->

	<div class="row">
		<div class="col-md-12 text-center">
            <div class="alert alert-default h1-verde">Menú de especialidades</div>
		</div>
	</div><!-- row -->
        
	<div class="row row-banners2">
            
            <div class="col-md-4 text-center">
                <div id="carousel-colores" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner banner" role="listbox">
                        <?= $banners[0] ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-colores" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-colores" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>    
                </div>                    
            </div> 

            <div class="col-md-4 text-center">
                <div id="carousel-peinados" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner banner" role="listbox">
                        <?= $banners[0] ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-peinados" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-peinados" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>    
                </div>                     
            </div>    
            
            
            <div class="col-md-4 text-center">
                <div id="carousel-expo" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner banner" role="listbox">
                        <?= $banners[0] ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-expo" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-expo" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>    
                </div>                     
                </div> 
	

        </div><!-- row -->
</div><!-- container-fluid -->


<!-- -------------------------------------- Contacto, Nosotros ---------------------------------------- -->

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="circulares contacto" data-toggle="modal" data-target="#myModal" id="btnModalContacto">
          </div>
        </div>
        <div class="col-md-4" align="center">
          <img src="img/e-chica.png" alt="" />
        </div>
        <div class="col-md-4">
          <div class="circulares nosotros" data-toggle="modal" data-target="#myModal" id="btnModalNosotros">
          </div>
        </div>
      </div>
    </div>


<!--<div>
    <div class="page-header">
        <h1>Welcome <small>System Axiem Client</small></h1>
    </div>
    <center><img src="../img/axiem-logo-main.png" align="center" style="width:50%" /></center>
</div>    -->