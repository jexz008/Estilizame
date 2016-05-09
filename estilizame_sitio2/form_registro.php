<?php





?>

<div>
	<div class="alert alert-default h1-verde hidden-xs">REGÍSTRATE GRATIS 
	<h5>Los campos marcados en <span class="rojo">rojo</span> son obligatorios</h5>
	</div>
</div>


  <div class="form-group">
  	<label for="registro_empresa" class="col-sm-4 control-label">
  		<i class="fa fa-building-o i-rojo"></i> Empresa ó Negocio:
  	</label>
    <div class="col-sm-8">
    	<input type="text" class="form-control" name="registro_empresa" id="registro_empresa" required placeholder="Ingresa el nombre de tu empresa o negocio">
    </div>
  </div>

  <div class="form-group">
  	<label for="registro_categoria" class="col-sm-4 control-label">
  		<i class="fa fa-tasks obligatorio i-rojo"></i> Categoria:
  	</label>
    <div class="col-sm-8">
                  <select class="form-control mayus" name="categoria" id="Categoria" onchange="CambiarCategoria()" required="required">
                    <option value="Academia">Academia</option>
                    <option value="Marcas">Marcas</option>
                    <option value="Distribuidores">Distribuidores</option>
                    <option value="Salones">Salones</option>
                    <option value="Promotores">Promotores</option>
                  </select>
    </div>
  </div>


<!--
<div class="row"> \n\
	<div class="col-md-6"> \n\
		<div class="form-group"><input type="email" name="login_mail" class="form-control" placeholder="Email" required></div> \n\
		<div class="form-group"><input type="password" name="login_password" class="form-control" placeholder="Contraseña" required></div> \n\
	</div> \n\
</div>';-->