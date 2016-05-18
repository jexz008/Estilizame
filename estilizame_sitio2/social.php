<style type="text/css">

    .social {
        position: fixed; /* Hacemos que la posición en pantalla sea fija para que siempre se muestre en pantalla*/
        left: -40px; /* Establecemos la barra en la izquierda */
        top: 200px; /* Bajamos la barra 200px de arriba a abajo */
        z-index: 20000; /* Utilizamos la propiedad z-index para que no se superponga algún otro elemento como sliders, galerías, etc */
    }

    .social ul {
        list-style: none;
    }

    .social ul li a {
        width: 50px;
        text-align: center;
        display: inline-block;
        color:#fff;
        background: #000;
        padding: 10px 10px;
        text-decoration: none;
        -webkit-transition:all 500ms ease;
        -o-transition:all 500ms ease;
        transition:all 500ms ease; /* Establecemos una transición a todas las propiedades */
        font-size: 20pt;
    }

    .social ul li .icon-facebook {background:#3b5998;} /* Establecemos los colores de cada red social, aprovechando su class */
    .social ul li .icon-twitter {background: #00abf0;}
    .social ul li .icon-googleplus {background: #dd4b39;}
    .social ul li .icon-instagram {background: #125688;}
    .social ul li .icon-mail {background: #666666;}

    .social ul li a:hover {
        background: #000; /* Cambiamos el fondo cuando el usuario pase el mouse */
        padding: 10px 30px; /* Hacemos mas grande el espacio cuando el usuario pase el mouse */
    }  
</style>

<div class="social hidden-xs hidden-sm">
    <ul>
        <li><a href="https://www.facebook.com/estilizame/?fref=ts" target="_blank" class="icon-facebook">
                <i class="fa fa-facebook"></i>
            </a></li>
        <li><a href="http://www.twitter.com/estilizame" target="_blank" class="icon-twitter">
                <i class="fa fa-twitter"></i>
            </a></li>
        <li><a href="http://www.googleplus.com/estilizame" target="_blank" class="icon-googleplus">
                <i class="fa fa-google-plus"></i>
            </a></li>
        <li><a href="http://www.instagram.com/estilizame" target="_blank" class="icon-instagram">
                <i class="fa fa-instagram"></i>
            </a></li>
        <li><a href="mailto:contacto@estilizame.com" class="icon-mail" data-toggle="modal" data-target="#Modal_Contacto">
                <i class="fa fa-envelope"></i>
            </a></li>
    </ul>
</div>
