<?php
$banners = $sitio->createBanners();
?>

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
