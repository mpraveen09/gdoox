@extends('layout.frontend_home.master')

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

              </div>        
        
        
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
                <form method="GET" action="<?php echo URL::to('/contactus');?>" accept-charset="UTF-8" class="bs-component quote-form">  
                    <fieldset>
                      <h3 class="panel-title">Request here your Invitation Code for FREE ACCESS</h3>
                        
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="name" name="name" placeholder="Your Name" required="required">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Your Business Email" required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning bgm-deeporange">Submit</button>
                        </div>
                    </fieldset>
                  </form>        
        
        

        
      </div>
    </div>  
  </div>

@endsection

@section('right_col_title')
    <div class="container-fluid home-banner-text" >

        <div class="container">
            <div class="row" >
                <div class="col-md-12 text-center">
                    <h1>Plataforma hospedada de Ecosystemas Empresariales</h1>
                    <h3>Ningus costo de intermediacion</h3>
                    <h3>Es una plataforma PAY PER USE</h3>
                    <br/>
                    <ul class="clist clist-star">
                        <li>Mas de 200 sectores de negocios organizados en plantas, equipos, maquinas, accesorios, productos y servicios</li>
                        <li>Mas de 23.000 categorias de productos</li>
                        <li>Gdoox permite de crear vs oferta de productos. El ecosistema de productos permite de configurar qualquier producto o servicio </li>
                        <li>Gdoox permite el encuentro entre la demanda y la oferta de productos </li>
                        <li>Esta estructura permite de personalizar los sitios web de comercio electronico </li>

                        <li>Crea su sitio web de comercio electronico </li>
                        <li>Crea sitios de comercio electronico con otros socios o partners </li>
                        <li>Condivide productos i/o servicios en un nuevo sitio de comercio electronico. </li>
                        <li>Desarrollo de las aliancias de la empresa</li>
                        <li>Involucra toda la organizacion de la empresa</li>
                    </ul>
                    
                    <br/><br/>
                    <a href="{{ URL::to('/contactus') }}" class="btn bgm-lightblue waves-effect">Request your Invitation Code for FREE ACCESS</a>
                    <br/><br/><br/>
            </div>
            </div>
        </div>

    </div>
@endsection

@section('right_col')

<div class="container-fluid gdoox-serv">


<div class="row" >
    <div class="col-sm-4 col-md-4">
        <div class="card">
            <div class="card-header bgm-orange m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Reduccion de costos </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse1" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse1">
                <img src="{{ asset('images/reduce-your-cost.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Elimina los altos costos de los tradicionales sitios de e-commerce</li>
                    <li>Puede ser usada de micro, pequeñas y grandes compañias </li>
                    <li>Tiene un costo sostenible  y no necesita de especialista esternos </li>
                    <li>Seguridad y reserva para los negocioa y para sus datos </li>
                    <li>Un dominio proprio sin algun costo</li>
                    <li>Ningus costo por la proyectacion del sitio web </li>
                    <li>No tiene costos de mantenimiento </li>					
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-orange m-b-0 card-footer">
                    Ahorrar es la palabra clave
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        <div class="card">
            <div class="card-header bgm-deeporange m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Desarrollo de aleanzas </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse2" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse2">
                <img src="{{ asset('images/Business Alliance.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Crecer para ganar y vencer</li>
                    <li>Aumenta la masa critica de la empresa</li>
                    <li>Crear la red de negocios de la empresa</li>
                    <li>Manejar la red de negocios  de la empresa </li>
                    <li>Involucra abastecedores, asesores y agentes comerciales</li>
                    <li>Las empresas pueden crear aleanzas temporales e definitivas sea con empresas reales o virtuales </li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-deeporange m-b-0 card-footer">
                    Hace crecer el eco-sistema empresarial
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        <div class="card">
            <div class="card-header bgm-red m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Involucra la organizacion de la empresa </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse3" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse3">
                <img src="{{ asset('images/team.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                        <li>Involucra la entera organizacion de la empresa </li>	
                        <li>Vendedores, compradores, en marketing, la logistica, la administraciony  etc y las gerencias</li>	
                        <li>Toda la organizacion de la empresa intercambian notificaciones</li>	
                        <li>Los empleados y manager pueden comunicar con otras empresas velozmente </li>	
                        <li>Todas las actividades puedesn ser seguidas y monitoradas</li>	
                        <li>La empresa obtiene enormes ventajas de las herramientas de gestion a dispociciòn </li>	
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-red  m-b-0 card-footer">
                    Todo lo que necesita para hacer crecer los negocios
                </div>
            </div>
        </div>     
        <!-- .card ends -->
 
        
    </div>
    
    
    
    
    <div class="col-sm-4 col-md-4">


        
        
        <div class="card">
            <div class="card-header bgm-green m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Maneja la economia digital </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse4" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse4">
                <img src="{{ asset('images/economy.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                        <li>Manejo de los contactos de negocios  & CRM</li>
                        <li>Herramientas para el manejo de los productos</li>
                        <li>Constructor de campagnas comerciales</li>
                        <li>Crear Promociones 
                                <ul>
                                <li>Cross selling</li>
                                <li>Upselling</li>
                                <li>Carrito abandonado, etc</li>
                                </ul>
                        </li>
                        <li>Sigue las acciones de Marketing </li>
                        <li>Mail broadcast </li>
                        <li>Mail broadcast follow up</li>
                        <li>Mensajes internos </li>
                        <li>Templates personalizados</li>
                        <li>Herramientas avanzadas de SEO </li>	
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-green m-b-0 card-footer">
                    El producto justo. Con el mensaje justo, a la persona justa al momento justo<br/>
                    Time to value: improve the efficiency and effectiveness of marketing actions.
                </div>
            </div>
        </div>     
        <!-- .card ends -->       

        <div class="card">
            <div class="card-header bgm-teal m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Comerciantes y corporaciones </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse6" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse6">
                <img src="{{ asset('images/traders.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                        <li>Empresas que con un Mnejador de contactos  desean entrar el la economia digital creando una expociciòm de productos y servicio  y que puede ser personalizada sengun criterios propios</li>
                        <li>Companies wishing  to operate in the e-commerce and needing a multi-account management to manage their products</li>
                        <li>Empresas que desean trabajar en solucion multi canal. Gdoox permite la creacion de sitios multiples segun la necesidad</li>
                        <li>Empreas con un elevado numero de productos  que desean operar en multi canal y necesitan de un CRM para manejar las ventas</li>
                        <li>Empresas que desean involucrar toda la propia organizacion</li>
                        <li>Empresas que quieren disminuir los costos de Hospitalidad de la propia plataforma de e-commerce</li>
                        <li>Todas las empresas  y personas que hacen un actividad comercial</li>
                        <li>Organizaciones y admnistradores del territorio que quieren crear un proprio eco-sistema de empresas en su territorio</li>
                        <li>Grupos de empresas organizadas en asociaciones  inclusa las Camaras de Comercio extranjeras </li>
                        <li>Oficinas de ventas o de representatncias establecidas en el pais</li>
                        <li>Sociedades de asesorias especializadas en la creacion de redes de empress o de internazionalizacion  </li>
                        <li>Entidades publicas  que administran las politicas territoriales sobre las actividades de empresas.</li>
                        <li>Editores genèricos y especializados </li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-teal m-b-0 card-footer">
                    Ningun limite para las empresas ni por tamaño o por numero de empleados o productos
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        
        
        <div class="card">
            <div class="card-header bgm-lightgreen m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Abastecimientos e internacionalizaciòn </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse5" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse5">
                <img src="{{ asset('images/international.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                        <li>Crear oportunidades pare el mercado internacional</li>
                        <li>Hacer Promociones en qualquier momento</li>
                        <li>Publicidad para los productos o servicios</li>
                        <li>Crear alenzas con socios extranjeros </li>
                        <li>Abasteserse en qualquier momento</li>
                        <li>Envolucrar los abastesedores </li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-lightgreen m-b-0 card-footer">
                    Jamas la internacionalizaciòn ha sido asì facil
                </div>
            </div>
        </div>     
        <!-- .card ends -->            
    </div>
    
    
    
    
    <div class="col-sm-4 col-md-4">
        <div class="card">
            <div class="card-header bgm-blue m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Creacion de sitios web </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse7" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body card-padding-sm" style="height: auto;" id="collapse8">
                <div class="text-center sitetype">
                    Mono sitio / multi sitios / singular o multi usuario
                </div>
                <div class="text-center">
                    <span class="gdoox-c">B2B</span>
                    <span class="gdoox-c">B2C</span>
                    <span class="gdoox-c">B2E</span>
                    <span class="gdoox-c">C2C</span>
                    <span class="gdoox-c">C2B</span>
                    
                </div>
            </div>
            
            
            <div class="card-body  collapse "  id="collapse7">
                <img src="{{ asset('images/ecommerce.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                        <li>Sitio Personal  (sin funciones de e-commerce )</li>
                        <li>Sitios singulares de e-commerce  
                        <ul>
                                <li>e-commerce  -un solo usuario de la empresa</li>
                                <li>e-commerce para multi usuarios de la empresa</li>
                        </ul>
                        </li>
                        <li>e-commerce  multi sitios
                        <ul>
                                <li>Cluster de Multi sitios </li>
                                <li>Cluster de  multi sitios con sitios de suporte </li>
                                <li>Multi sitios con socios o partners</li>
                                <li>Clusterde multi sitios con socios o partners </li>
                        </ul>
                        </li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-blue m-b-0 card-footer">
                    Cada empresa puede  crear su mejor solucion
                </div>
            </div>
        </div>     
        <!-- .card ends -->            

    </div>
    

    
    
</div>


    <div class="col-md-12 text-center footer-inv">
        <br/><br/>
        <h1><a href="{{ URL::to('/contactus') }}">Request your Invitation Code for FREE ACCESS</a></h1>
    </div>

</div>
@endsection
 
 