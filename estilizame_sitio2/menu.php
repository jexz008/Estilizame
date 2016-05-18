<?php
$menus = array( 
array('nombre' => 'Academias', 'link' => 'academias' ),
array('nombre' => 'Marcas', 'link' => 'marcas' ),
array('nombre' => 'Distribuidores', 'link' => 'distribuidores' ),
array('nombre' => 'Salones', 'link' => 'salones' ),
array('nombre' => 'Promociones', 'link' => 'promociones' ),
array('nombre' => 'Eventos', 'link' => 'eventos' ),
);
?>
<header>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<!-- <nav class="navbar navbar-default" role="navigation"> -->
  <div class="container-fluid">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=$_app->url?>">
        <img alt="LOGO" src="<?=$_app->logo_menu?>" alt="<?=$_app->nombre?>" style="max-height:70px">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">-->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li><a href="<?$_app->url?>" style="padding:0"><img alt="LOGO" src="<?=$_app->logo_menu?>" style="max-height:70px">&nbsp</a></li>-->
        <?php
        foreach($menus as $menu){
          $activeClass = ($_GET['module']==$menu['link']) ? 'active' : '';
          echo <<<HTML
            <li class="{$activeClass}"><a href="index.php?module={$menu['link']}"><i class="glyphicon"></i> {$menu['nombre']}</a></li>
HTML;
        } 
        ?>
      </ul>


      
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="/"><i class="glyphicon glyphicon-user"></i> <?=$_SESSION['xc_usuario_nombre']?></a></li>-->
        <li><a href="#" data-target="#myModal" data-toggle="modal" id="btnFormSignIn"><i class="fa fa-sign-in"></i> Iniciar Sesión</a></li>
        <li><a href="#" data-target="#myModal" data-toggle="modal" id="btnFormSignUp"><i class="fa fa-user-plus"></i> Registrate</a></li>
      </ul>
      <!--<ul class="nav navbar-nav navbar-right">
        <li><a href="/<?=$profile?>/mydata" id="menuMyData" ><i class="glyphicon glyphicon-user"></i> <?=$_SESSION['xc_usuario_nombre']?></a></li>
        <li><a href="/"><i class="glyphicon glyphicon-off"></i> Sign Out</a></li>
      </ul>-->


      
    </div>  
  </div>
</nav>

</header>

