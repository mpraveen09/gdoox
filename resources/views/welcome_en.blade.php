@extends('layout.frontend_home.master')
 
@section('header_banner')
    
  <div class="container-fluid home-banner">
    <div class="row home-banner-row">
      <div class="col-xs-12 col-sm-8 col-md-8 text-center">
        
        
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
                    <h1>Hosted Business Eco-System Platform</h1>
                    <h3>No Trading Fees</h3>
                    <h3>It’s a PAY PER USE platform</h3>
                    <br/>
                    <ul class="clist clist-star">
                        <li>More than 200 business sectors organizad by plants, machinery, equipment, accessories, product and services</li>
                        <li>More than 23.000 product categories</li>
                        <li>Create your offer using Gdoox: products ecosystem allows you to configure any product or service in the platform</li>
                        <li>Cross product offer and demand</li>
                        <li>Gdoox structure allows you to create your personalized e-commerce website</li>
                        <li>Create your own e-commerce websites</li>
                        <li>Create e-commerce sites with your partners</li>
                        <li>Share products and services with your parners in a new e-commerce site</li>
                        <li>Alliance Development</li>
                        <li>Involve your company organization</li>
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
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Reduce your costs </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse1" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse1">
                <img src="{{ asset('images/reduce-your-cost.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Eliminates the high costs for traditional eCommerce sites</li>					
                    <li>Gdoox can be used either by micro, small, medium and large companies</li>					
                    <li>It has sustainable costs and does not need external specialist interventions</li>					
                    <li>Security and privacy for your business & your data</li>					
                    <li>No domain costs</li>					
                    <li>No website design costs</li>					
                    <li>No website maintenance costs</li>					
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-orange m-b-0 card-footer">
                    Save money is the buzzword
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        <div class="card">
            <div class="card-header bgm-deeporange m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Alliance Development </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse2" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse2">
                <img src="{{ asset('images/Business Alliance.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Growth to win</li>			
                    <li>Improve the  company Critical Mass</li>			
                    <li>Create your Business Network</li>			
                    <li>Manage your Business Network</li>			
                    <li>Involve your suppliers, consultants and professionals</li>			
                    <li>Companies can create temporary or consolidated alliances, new companies or operate as registered Joint Ventures</li>					
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-deeporange m-b-0 card-footer">
                    Make your company ecosystem grow
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        <div class="card">
            <div class="card-header bgm-red m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Digital Economy Management </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse4" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse4">
                <img src="{{ asset('images/economy.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                        <li>Contacts Management & CRM</li>				
                        <li>Product management tool</li>				
                        <li>Campaign builder</li>				
                        <li>Create Promotions				
                                <ul>
                                <li>Cross selling</li>				
                                <li>Custom Upselling</li>				
                                <li>Abandoned Cart, etc</li>
                                </ul>
                        </li>
                        <li>Trace your marketing action</li>			
                        <li>Mail broadcast</li> 				
                        <li>Mail broadcast follow up</li>				
                        <li>Internal messages</li>				
                        <li>Customized templates</li>				
                        <li>ADVANCED SEO TOOLS</li>	
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-red m-b-0 card-footer">
                    The right product, with the right message, to the right person, at the right time<br/>				
                    Time to value: improve the efficiency and effectiveness of marketing actions
                </div>
            </div>
        </div>     
        <!-- .card ends -->        
        
    </div>
    
    
    
    
    <div class="col-sm-4 col-md-4">

        <div class="card">
            <div class="card-header bgm-green m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Involve your Organization </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse3" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse3">
                <img src="{{ asset('images/team.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Gdoox allows to involve the entire corporate organization</li>				
                    <li>Sellers, buyers, marketing, logistic, management, etc. can be involved</li>				
                    <li>All the company accounts can send messages to each other</li>				
                    <li>All the activities can be monitored</li>				
                    <li>Companies can take advantage of powerful marketing tools.</li>				
                    <li>Contact employees and managers in other companies</li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-green m-b-0 card-footer">
                    All that you need to improve your business
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        


        <div class="card">
            <div class="card-header bgm-teal m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Traders & Corporations </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse6" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse6">
                <img src="{{ asset('images/traders.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Companies, supported by a contact manager, wishing to enter the digital economy by creating their own products showroom that the user can customize according to his/her needs</li>
                    <li>Companies wishing  to operate in the e-commerce and needing a multi-account management to manage their products</li>
                    <li>Companies wishing to operate in multiple channels: B2C, B2B and others. Gdoox allows the creation of multiple sites managed by multiple accounts to cover the different channels</li> 
                    <li>Companies with a large number of products wishing to operate on multiple channels and needing a CRM for sales management<li>Companies wishing to involve their whole organization</li>
                    <li>Companies wanting to reduce their website costs opting for a Hosted e-commerce solution</li>
                    <li>All those who have a commercial or professional activity</li>
                    <li>Organizations and Agencies of a given territory interested in creating a Local Business eco-system</li>
                    <li>Group of enterprises organized in associations, including foreign Chambers of Commerce</li>
                    <li>Sales Offices or Representative Offices in any country</li>
                    <li>Consultant companies specialized in business networks and internationalization</li> 
                    <li>Statutory corporations managing territorial policies</li>
                    <li>Generic or specialized publishers</li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-teal m-b-0 card-footer">
                    No limits for company size or employees number
                </div>
            </div>
        </div>     
        <!-- .card ends -->
        
        
        
        
        <div class="card">
            <div class="card-header bgm-lightgreen m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Procurement & Internationalization </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse5" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body  collapse "  id="collapse5">
                <img src="{{ asset('images/international.jpg') }}" alt="banner" class="card-banner" />

                <div class="card-padding">
                    <br/>
                    <ul class="clist clist-check">
                    <li>Create opportunities for the foreign market</li>			
                    <li>Activate promotions at any time</li>			
                    <li>Advertise products & services</li>			
                    <li>Create alleances with foreign partners</li>			
                    <li>Procurement at any time</li>			
                    <li>Involve your suppliers</li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-lightgreen m-b-0 card-footer">
                    Internationalization has never been so easy
                </div>
            </div>
        </div>     
        <!-- .card ends -->            
    </div>
    
    
    
    
    <div class="col-sm-4 col-md-4">
        <div class="card">
            <div class="card-header bgm-blue m-b-0">
                <h2><i class="zmdi zmdi-thumb-up zmdi-hc-fw"></i> Create your Sites </h2>
                <button class="btn bgm-white btn-float waves-effect waves-effect waves-circle waves-float"  data-toggle="collapse" 
                            data-target="#collapse7" ><i class="zmdi zmdi-plus"></i></button>
            </div>
            <div class="card-body card-padding-sm" style="height: auto;" id="collapse8">
                <div class="text-center sitetype">
                    Single Site / Multi Sites / Single Account / Multi Account
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
                        <li>Personal sites (no e-commerce functions)</li>

                        <li>e-commerce single site 
                        <ul>
                        <li>Company site - single account</li>
                        <li>Company site - multi account</li>
                        </ul></li>
                        <li>e-commerce multi sites
                        <ul>
                        <li>Cluster Multi sites </li>
                        <li>Cluster multi sites plus support sites</li>
                        <li>Multi sites with your partners</li>
                        <li>Cluster multi sites with your partners</li>
                        </ul></li>
                    </ul>					
                </div>
                <div class="card-body card-padding-sm bgm-blue m-b-0 card-footer">
                    Each company or trader can get the best solution
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
 
 