@extends('master')

@section('header_banner')
  <div class="container-fluid home-banner">
    <div class="row home-banner-row">
      <div class="col-xs-12 col-sm-8 col-md-8 text-center">

        
        <?php // echo route('contact_');?>
        
        
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <h1>Improve your business</h1>
                  </div>
                  <div class="item">
                    <h1>Level playing field</h1>
                  </div>
                  <div class="item">
                    <h1>Greater competitiveness towards competitors</h1>
                  </div>
                  <div class="item">
                    <h1>The future is now</h1>
                  </div>                  
                </div>
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>                  
                </ol>
<!--                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>-->
              </div>        
        
        
        
        
        
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
                <form method="GET" action="<?php echo URL::to('/contactus');?>" accept-charset="UTF-8" class="bs-component quote-form">  
                    <fieldset>
                      <h3 class="panel-title">Request here your Invitation Code for FREE ACCESS</h3>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="required">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Business Email" required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </fieldset>
                  </form>        
        
        

        
      </div>
    </div>  
  </div>
@endsection

@section('content')

<div class="container home-feature text-center big-txt">
    <br/>
    <h1>Nuestra Mision</h1>
    <p>
Poner a disposición una plataforma para el comercio electrónico a todos aquellos que trabajan o quieren trabajar en la economía digital.<br/> 
Simplificar las complejas acciones necesarias para la gestion o manejo de un sitio web de e-commerce <br/>
Ser de apoyo alla direccion de la empresa  durante la busqueda de potenciales socios  y rendir facil, veloz y segura la participacion de un cosio, de un cliente o de un abastecedor <br/>
Permitir a los usuarios de la plataforma de competir en el mercado utilizando potentes instrumentos de marketing <br/>
Permitir el acceso facil al economia digital a empresas medias, pequenas o muy pequenas  el cual desarrollo hace crecer nuestra economia.<br/>
Ofrecer la posibilidad a cada pais de ofrecer y presentarse en manera relevante en el excenario internacional. <br/>
Permitir a las asociaciones de empresas  de dar un suporte continuado a sus asociados.trabajando conjuntamente para desarrollar nuovos mercados y crear nuevas oportunidades de negocios. <br/>
Crear nuevas formas de organizacion del trabajo y nuevas modalidades de agregacion para hacer crecer las actividades economicas. <br/>
<br/>
Nosotros hacemos lo que los otros promente di hacer. <br/>      
    </p>
</div>

<hr/>

  <div class="container home-feature big-txt">
    <br/>
    <h1 class="color-primary text-center">Plataforma de eco-systemas empresariales <br/><small>(Individual  & Multi usuario)</small></h1>
    <br/>

    
    <div class="list-group row">
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Elimina los costos elevados de manejo de los sitios tradicionales  de comercio electronico</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Puede ser utilizado de parte de micro, pequenas, medias y grandes empresas.</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Es una plataforma  PAY PER USE.</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Costos sostenibles y no necesita el empleo de personal especializado</p>
            </div>
        </div>      
    </div>
      

  <div class="list-group row">      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Permite  de involucrar toda la organizacion de la empresa</p>
            </div>
        </div>      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Non hay que pagar costos de intermediacion o sea no se pagan porcentajes por las ventas</p>
            </div>
        </div>      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">La empresa tiene a su disposiciòn potentes instrumentos de marketing</p>
            </div>
        </div>      

      
    </div>
    <br/><br/><br/>
</div>    
    
    
    
<div class="container-fluid home-feature big-txt business_social container-bg text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Red Social de negocios de e-commerce 
    &amp; Plaza electronica de mercadeo</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-2 col-md-offset-1">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Ser  SOCIAL es una de las llaves de suceso de la empresa 
            Es una plaza de mercadeo
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            para empresas o usuarios que venden y compran Los operadores puede
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            comunicarse y desarrollar nuevas oportunidadesTodos los participantes a la red Gdoox
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Gdoox son a su vez clientes y potencialea provehedores. 
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Con seguridad y en manera reservado.
          </p>        
      </div>      
      
      
    </div>    
    <br/><br/>
</div>      


<div class="container home-feature big-txt ">
    <br/>
    <h1 class="color-primary text-center">Empresas multi sitio y multi-canal. 
Desarrollo de aleanzas de negocios.</h1>
    <h2 class="color-primary text-center">Vencer en el comercio B2B quiere decis desarrollar eficacia y eficiencia operativa aplicada a los varios modelos de negocios</h2>
    <br/>
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="gdoox-c-h2">GDOOX ES UNA PLATAFORMA MULTI-CANAL</h2>
        <span class="gdoox-c">B2B</span>
        <span class="gdoox-c">B2C</span>
        <span class="gdoox-c">B2E</span>
        <span class="gdoox-c">C2C</span>
      </div>
      <div class="col-md-12 text-center gdoox-c-txt">
        <p>
          <br/>
            Con acciones de marketing diferentes para cada canal.<br/>
            Con acciones de marketing personalizadas.<br/>
            Las empresas pueden crear aleanzas temporales o consolidas. Puede crear Red o Cadenas de empresas      
        </p>
        <br/><br/>

      </div>
      
      <div class="list-group row gdoox-c-list">      
          <div class="list-group-item col-sm-5 col-md-5 col-md-offset-1 col-sm-offset-1">
              <div class="row-action-primary">
                  <i class="mdi-action-done-all"></i>
              </div>
              <div class="row-content">
                  <p class="list-group-item-text">GDOOX ES UNA PLATAFORMA UTILIZABLE con qualquier aparato (PC, TABLET y MOBIL)</p>
              </div>
          </div>      
          <div class="list-group-item col-sm-5 col-md-5">
              <div class="row-action-primary">
                  <i class="mdi-action-done-all"></i>
              </div>
              <div class="row-content">
                  <p class="list-group-item-text">GDOOX ES UN ECO-SISTEMA DE EMPRESA</p>
              </div>
          </div>      

      </div>
      
    </div>
    
</div>

<div class="container-fluid home-feature big-txt crm_section container-bg text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Manejo de contactos y CRM</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-3 col-md-offset-3 col-sm-offset-2 ">
          <div class="well text-left">
              <strong> Crear promociones </strong> 
              <ul>
                  <li>Upselling Personalizados</li>
                  <li>Cross selling Personalizados</li>
                  <li>Carrito abandonado, etc.</li>
              </ul>
          </div>       
      </div>
      <div class="col-sm-4 col-md-3">
          <div class="well text-left">
            <strong>Manejar las promociones</strong> 
              <ul>
                  <li>Por Correo electronico</li>
                  <li>Crear mensajes</li>
                  <li>Modelos personalizados</li>
              </ul>
          </div>       
      </div>
        
    </div>    
    <br/><br/>

      <p class="crm-p-caps">
        COMUNICAR CON TODOS VS CLIENTES Y ABASTECEDORES PRESENTES EN LA PLATAFORMA<br/>
        MONITORAR LAS PROMOCIONES  <br/>
        INSTRUMENTI E SEO AVANZADOS
      </p>
      <br/>
      <p class="crm-p-small">
        El producto justo. Con el mensaje justo, para la persona justa, al momento justo.<br/>
        El tiempo es dinero: Mejora la eficaz y la eficiencia de las acciones de marketing.  
        <br/>
        <br/>
      </p>  
    
</div>      


<div class="container-fluid home-feature pi_section big-txt text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Abastecimientos e internacionalizaciòn</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox cruza la demanda con la oferta. Maneja mas de 200 areas o sectores economicos.         
          </p>        
      </div>
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox maneja tambien las subastas inversas (tambien en version C2B).
          </p>        
      </div>
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox es un potente suporte para asociaciones de empresas pudiendo desarrollar acciones conjuntas a favor de los asociados.
          </p>        
      </div>  
    </div>    
    <br/><br/>
    
    <h2><strong>Cada producto es asociado a 5 macro niveles</strong></h2>
    <br/>
    <div class="row">
      <div class=" col-sm-3 col-md-2 col-md-offset-1">
          <div class="well text-center">
              pais
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              business<br/>area
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              categoria
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              Preferencias
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              definicion o<br/>descripcion
          </div>
      </div>
      
      
    </div>      
</div>      

<hr/>




<div class="container-fluid home-feature ">
      <div class="row header-logo-row">
          <div class="col-md-8 col-sm-8">
            <br/><br/>
              <a href="<?php echo URL::to('/');?>">
                <img src="{{ asset('images/gdoox.png') }}" alt="GDoox" class="logo-header"/>
              </a>
            
              
            <p class="copyright"><br/>&copy; 2015 All Rights Reserved.</p>
          </div>
        <div class="col-md-4 col-sm-4">
                <form method="GET" action="<?php echo URL::to('/contactus');?>" accept-charset="UTF-8" class="bs-component quote-form form-white-bg">  
                    <fieldset>
                      <h3 class="panel-title">Request here your Invitation Code for FREE ACCESS</h3>
                        
                        <div class="form-group">
                          <input type="text" class="form-control" id="name_" name="name" placeholder="Your Name" required="required">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email_" name="email" placeholder="Your Business Email"  required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </fieldset>
                  </form>           
        </div>
      </div>
  
</div>


       



@endsection