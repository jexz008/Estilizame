<?php
$sitio = new sitio();
$banners = $sitio->createBanners();
$sliders = $sitio->createSliders();
?>



<div class="container-fluid">


<!-- ----------------------------------------- Banners Fila 1 ------------------------------------------- -->
	<div class="row row-banners">
	<div class="col-md-4">


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <!--<ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>-->

  <!-- Wrapper for slides -->
  <div class="carousel-inner banner" role="listbox">
    <!--<div class="item active">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>-->

		<?=$banners[0]?>    

    &nbsp;
  </div>

  <!-- Controls -->
  <!--<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>-->
</div>



	</div>
	<div class="col-md-4">
		<?=$banners[1]?>    
	</div>
	<div class="col-md-4">
		<?=$banners[2]?>
	</div>
	</div><!-- row -->

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

<!-- -------------------------------------- Footer ---------------------------------------- -->
          <footer>
            <div class="row">
              <div class="col-md-6 text-left">
                <p>
                  DESARROLADO POR: <a href="http://plus-tec.com/" target="_blank" class="plustec">PLUSTEC</a>
                </p>
              </div>
              <div class="col-md-3 text-rigth">
                <p>
                  POLITICAS DE PRIVACIDAD
                </p>
              </div>
              <div class="col-md-3 text-rigth">
                <p>
                  TERMINOS Y CONDICIONES
                </p>
              </div>
            </div>
          </footer>
	<!-- End Footer -->

<!-- -------------------------------------- Modal ---------------------------------------- -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <form class="form-horizontal" action="#" id="form_modal" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">...</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Registrar nuevo</button>-->
      </div>
    </div>
  </form>  
  </div>
</div>

<!--<div>
    <div class="page-header">
        <h1>Welcome <small>System Axiem Client</small></h1>
    </div>
    <center><img src="../img/axiem-logo-main.png" align="center" style="width:50%" /></center>
</div>    -->