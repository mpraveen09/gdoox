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
    <h1>La nostra Mission</h1>
    <p>
      Rendere accessibile  una piattaforma di e-commerce a tutti coloro che operano o vogliono operare nell'economia digitale. <br/>
      Rendere  semplici le complesse azioni necessarie per la gestione di un sito eCommerce. <br/>
      Essere il supporto per il management nella ricerca di partner e rendere facile, veloce e sicuro il coinvolgimento di un partner, cliente e fornitore.<br/>
      Consentire agli utenti della piattaforma di competere  sul mercato  con potenti strumenti di marketing.<br/>
      Rendere facile l'accesso all'economia digitale a piccole e piccolissime aziende, il cui sviluppo farà crescere la nostra economia.<br/>
      Offrire ad ogni paese la possibilità di presentarsi in maniera rilevante sullo scenario internazionale.<br/>
      Consentire alla associazioni d'impresa di poter dare un supporto continuo ai loro associati per lo sviluppo di nuovi mercati.<br/>
      Creare nuove forme di lavoro e nuove modalità di aggregazione per far crescere  le proprie attività.<br/>
      <br/>
      NOI FACCIAMO CIO' CHE GLI ALTRI PROMETTONO DI FARE.
    </p>
</div>

<hr/>

  <div class="container home-feature big-txt">
    <br/>
    <h1 class="color-primary text-center">Eco-sistemi d'affari (nel cloud) <br/><small>(mono e multi-utente)</small></h1>
    <br/>

    
    <div class="list-group row">
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Elimina gli elevati costi di gestione dei tradizionali siti di e-commerce</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Ha costi sostenibili e non necessità d'interventi esterni specialistici</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Permette di coinvolgere l'intera organizzazione aziendale</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">L'azienda ha a disposizione potenti strumenti di marketing</p>
            </div>
        </div>      
    </div>
      

  <div class="list-group row">      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Puo' essere utilizzato da micro, piccole, medie e grandi aziende</p>
            </div>
        </div>      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">E' una piattaforma PAY PER USE.</p>
            </div>
        </div>      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Non ha costi d'intermediazione</p>
            </div>
        </div>      

      
    </div>
    <br/><br/><br/>
</div>    
    
    
    
<div class="container-fluid home-feature big-txt business_social container-bg text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Social Business. <br/>E-commerce site Network  e Marketplace</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-2 col-md-offset-1">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Essere SOCIAL è una delle chiavi di successo per le imprese
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            E’ un marketplace per aziende e utenti che comprano e vendono
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Tutti gli operatori  possono comunicare fra di loro per sviluppare nuove opportunità
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Tutti i partecipanti  del Network Gdoox sono a loro volta vostri clienti potenziali 
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            In sicurezza e riservatezza
          </p>        
      </div>      
      
      
    </div>    
    <br/><br/>
</div>      


<div class="container home-feature big-txt ">
    <br/>
    <h1 class="color-primary text-center">Società Multi-sito, multi canale e sviluppo di alleanze </h1>
    <h2 class="color-primary text-center">Vincere nel commercio B2B  vuol dire sviluppare l’efficacia ed efficienza operativa da applicare nei vari modelli di business</h2>
    <br/>
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="gdoox-c-h2">Gdoox è una piattaforma multi-canale</h2>
        <span class="gdoox-c">B2B</span>
        <span class="gdoox-c">B2C</span>
        <span class="gdoox-c">B2E</span>
        <span class="gdoox-c">C2C</span>
      </div>
      <div class="col-md-12 text-center gdoox-c-txt">
        <p>
          <br/>
            Con azioni di marketing differenziate per canale<br/>
            Con azioni di marketing personalizzate<br/>
            Le aziende possono creare alleanze temporali o consolidate (Reti d'impresa)          
        </p>
        <br/><br/>

      </div>
      
      <div class="list-group row gdoox-c-list">      
          <div class="list-group-item col-sm-5 col-md-5 col-md-offset-1 col-sm-offset-1">
              <div class="row-action-primary">
                  <i class="mdi-action-done-all"></i>
              </div>
              <div class="row-content">
                  <p class="list-group-item-text">GDOOX È UNA PIATTAFORMA OMNI-DEVICE: (PC, TABLET e MOBILE)</p>
              </div>
          </div>      
          <div class="list-group-item col-sm-5 col-md-5">
              <div class="row-action-primary">
                  <i class="mdi-action-done-all"></i>
              </div>
              <div class="row-content">
                  <p class="list-group-item-text">GDOOX È UN ECOSISTEMA DI AZIENDE</p>
              </div>
          </div>      

      </div>
      
    </div>
    
</div>

<div class="container-fluid home-feature big-txt crm_section container-bg text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Gestione dei contatti aziendali e CRM</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-3 col-md-offset-3 col-sm-offset-2 ">
          <div class="well text-left">
              <strong> Creare promozioni </strong> 
              <ul>
                  <li>Cross selling</li>
                  <li>Upselling personalizzati</li>
                  <li>Carrello abbandonato, etc.</li>
              </ul>
          </div>       
      </div>
      <div class="col-sm-4 col-md-3">
          <div class="well text-left">
            <strong>Gestire la promozione</strong> 
              <ul>
                  <li>Per posta</li>
                  <li>Creare un messaggio</li>
                  <li>Modelli personalizzati</li>
              </ul>
          </div>       
      </div>
        
    </div>    
    <br/><br/>

      <p class="crm-p-caps">
        Comunicate con tutti i VOSTRI clienti e fornitori<br/>
        COMUNICATE CON CLIENTI e fornitori presenti nella piattaforma<br/>
        MONITORATE LE PROMOZIONI  <br/>
        Strumenti di SEO avanzati
      </p>
      <br/>
      <p class="crm-p-small">
        Il prodotto giusto, con il messaggio giusto, alla persona giusta , al momento giusto<br/>
        Time to value: migliorare l'efficacia e l'efficienza delle azioni di marketing 
        <br/>
        <br/>
      </p>  
    
</div>      


<div class="container-fluid home-feature pi_section big-txt text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Acquisti aziendali e Internazionalizzazione</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox incrocia la domanda con l’offerta.  Gestisce oltre 200 filiere dell’economia          
          </p>        
      </div>
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox gestisce anche le Reverse Auction<br/>
            Reverse Auction (anche in versione C2B)
          </p>        
      </div>
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox è un supporto per le associazioni di categoria che possono svolgere azioni congiunte a favore dei propri associati
          </p>        
      </div>  
    </div>    
    <br/><br/>
    
    
    <h2><strong>Ogni prodotto è associato a 5 macro-livelli</strong></h2>
    <br/>
    
    <div class="row">
      <div class=" col-sm-3 col-md-2 col-md-offset-1">
          <div class="well text-center">
              paese
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
              preferenze
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
            definizione o <br/>descrizione
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