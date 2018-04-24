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
                    <h1>Piattaforma ospitata di ecosistema aziendale</h1>
                    <h3>Nessun costo di intermediazione</h3>
                    <h3>E' una piattaforma PAY PER USE</h3>
                    <br/>
                    <ul class="clist clist-star">
                        <li>Più di 200 settori aziendali organizzati per impianti, macchinari, attrezzature, accessori, prodotti e servizi</li>
                        <li>Più di 23.000 categorie di prodotto</li>
                        <li>Create la vostra offerta utilizzando Gdoox: l'ecosistema di prodotti consente di configurare qualsiasi prodotto o servizio nella piattaforma</li>
                        <li>Incrociate domanda e offerta di prodotti</li>
                        <li>La struttura di Gdoox vi consente di creare il vostro personalizzato sito di e-commerce</li>
                        <li>Create il vostro siti di e-commerce</li>
                        <li>Create siti di e-commerce con i vostri partner</li>
                        <li>Condividete prodotti e servizi con i vostri partner in un nuovo sito di e-commerce</li>
                        <li>Sviluppate alleanze</li>
                        <li>Coinvolgete l'intera organizzazione aziendale</li>
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
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Riducete i costi </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse1" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse1">
                <img src="{{ asset('images/reduce-your-cost.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Eliminate gli elevati costi di gestione dei tradizionali siti di e-commerce</li>
                    <li>Gdoox può essere utilizzato da micro, piccole, medie e grandi aziende</li>
                    <li>Ha costi sostenibili e non necessità d'interventi esterni specialistici</li>
                    <li>Sicurezza e riservatezza per la vostra azienda ed i vostri dati</li>
                    <li>Nessun costo di dominio</li>
                    <li>Nessun costo per la progettazione di un sito web</li>
                    <li>Nessun costo di manutenzione per siti web</li>					
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-orange m-b-0 card-footer">
                    Risparmiare soldi è la parola d'ordine	
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        <div class="card">
            <div class="card-header bgm-deeporange m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Sviluppo di alleanze </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse2" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse2">
                <img src="{{ asset('images/Business Alliance.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Crescere per vincere</li>	
                    <li>Migliorare la massa critica dell'azienda</li>	
                    <li>Creare la vostra rete di aziende</li>	
                    <li>Gestire la vostra rete di aziende</li>	
                    <li>Coinvolgere i vostri fornitori, consulenti e professionisti</li>	
                    <li>Le aziende possono creare alleanze temporali o consolidate (Reti d’impresa)</li>						
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-deeporange m-b-0 card-footer">
                    Fate crescere il vostro ecosistema aziendale
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        
        <div class="card">
            <div class="card-header bgm-red m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Coinvolgete la vostra organizzazione </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse3" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse3">
                <img src="{{ asset('images/team.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Gdoox permette di coinvolgere l'intera organizzazione aziendale</li>	
                    <li>Potrete coinvolgere: venditori, acquirenti, marketing, logistica, management, ecc.</li>	
                    <li>Tutti gli account dell'azienda possono inviarsi messaggi fra di loro</li>	
                    <li>Tutte le attività possono essere monitorate</li>	
                    <li>Le aziende hanno a disposizione potenti strumenti di marketing</li>	
                    <li>Contatta impiegati e manager di altre aziende</li>	
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-red m-b-0 card-footer">
                    Tutto quello di cui avete bisogno per migliorare il vostro business
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
    </div>
    
    
    
    
    <div class="col-sm-4 col-md-4">
        <div class="card">
            <div class="card-header bgm-green m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Gestire l'economia digitale </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse4" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse4">
                <img src="{{ asset('images/economy.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                        <li>Gestione dei contatti aziendali e CRM</li>
                        <li>Strumenti per la gestione dei prodotti</li>
                        <li>Costruttore di campagne</li>
                        <li>Creare promozioni
                        <ul>
                        <li>Cross selling</li>
                        <li>Upselling personalizzati</li>
                        <li>Carrello abbandonato, ecc.</li>
                        </ul></li>
                        <li>Tracciare le vostre azioni di marketing</li>
                        <li>Mail broadcast </li>
                        <li>Mail broadcast follow up</li>
                        <li>Messaggi interni</li>
                        <li>Template personalizzati</li>
                        <li>STRUMENTI DI SEO AVANZATI</li>	
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-green m-b-0 card-footer">
                    Il prodotto giusto, con il messaggio giusto, alla persona giusta, al momento giusto	<br/>			
                    Time to value: migliorare l'efficacia e l'efficienza delle azioni di marketing
                </div>
            </div>
        </div>     
        <!-- .card ends -->        



        <div class="card">
            <div class="card-header bgm-teal m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Operatori e imprese </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse6" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse6">
                <img src="{{ asset('images/traders.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Aziende, supportate da un contact manager, che desiderano entrare nell'economia digitale creando un proprio showroom di prodotti che l'utente può personalizzare secondo le proprie esigenze</li>
                    <li>Aziende che desiderano operare nell'e-commerce e che necessitano di una gestione multi-account per gestire i loro prodotti</li>
                    <li>Aziende che desiderano operare in diversi canali: B2C, B2B e altri. Gdoox permette la creazione di più siti gestiti da più account per coprire i diversi canali</li>
                    <li>Aziende con un numero elevato di prodotti che desiderano operare su più canali e che necessitano di un CRM per la gestione delle vendite</li>
                    <li>Aziende che desiderano coinvolgere l'intera organizzazione</li>
                    <li>Aziende che desiderano ridurre i costi per un sito Web optando per una soluzione di Hosted e-commerce</li>
                    <li>Tutti coloro che hanno un'attività commerciale o professionale</li>
                    <li>Organizzazioni e agenzie di un determinato territorio interessate a creare un ecosistema aziendale locale</li>
                    <li>Gruppi di imprese organizzate in associazioni, tra cui le camere di commercio estere</li>
                    <li>Uffici vendite o Sales Representative in quaunque paese</li>
                    <li>Società di consulenza specializzate in internazionalizzazione e reti d'impresa</li>
                    <li>Enti statali che gestiscono le politiche territoriali</li>
                    <li>Editori specializzati o generici</li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-teal m-b-0 card-footer">
                    Senza limiti di dimensioni della società o numero di dipendenti
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        
        
        <div class="card">
            <div class="card-header bgm-lightgreen m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Acquisti e internazionalizzazione </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse5" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse5">
                <img src="{{ asset('images/international.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Create opportunità per il mercato estero</li>
                    <li>Attivate promozioni in qualsiasi momento</li>
                    <li>Pubblicizzate prodotti e servizi</li>
                    <li>Create alleances con partner stranieri</li>
                    <li>Acquistate in qualsiasi momento</li>
                    <li>Coinvolgete i vostri fornitori</li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-lightgreen m-b-0 card-footer">
                    L'internazionalizzazione non è mai stata così semplice
                </div>
            </div>
        </div>     
        <!-- .card ends -->            
    </div>
    
    
    
    
    <div class="col-sm-4 col-md-4">
        <div class="card">
            <div class="card-header bgm-blue m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Create i vostri siti </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse7" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body card-padding-sm" style="height: auto;" id="collapse8">
                <div class="text-center sitetype">
                    Singolo Sito / Multi Sito / Singolo Account / Multi Account
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
                        <li>Siti personali (senza funzioni di e-commerce)</li>
                        <li>singolo sito e-commerce
                        <ul><li>Sito aziendale - singolo account</li>
                        <li>Sito aziendale - multi account</li>
                        </ul></li>
                        <li>multi-siti di e-commerce
                        <ul><li>Multi siti Cluster</li>
                        <li>Multi siti Cluster più siti di supporto</li>
                        <li>Multi siti con i vostri partner</li>
                        <li>Multi siti Cluster con i vostri partner</li>
                        </ul></li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-blue m-b-0 card-footer">
                    Ogni azienda o professionista può trovare la migliore soluzione
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
 
 