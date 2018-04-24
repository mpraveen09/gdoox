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
    <h1>Our Mission</h1>
    <p>
        Our Main Goals are:<br/> 
        To make an e-commerce platform available to all who operate or want to operate in the digital economy.<br/>
        To simplify the complex actions required to manage an e-commerce site. <br/>
        To be a support for management in finding partners and render the involvement of a partner, customer and supplier, easy, fast and secure.<br/>
        To allow platform users to compete on the market with powerful marketing tools.<br/>
        To provide easy access to the digital economy to small and micro enterprises, whose development will make our economy grow.<br/>
        To offer to each country the opportunity to present themselves significantly on the international stage.<br/>
        To allow business associations to give continued support to their members for the development of new markets. <br/>
        To create new jobs and new ways of aggregation to grow business.<br/>
        <br/>
        We do what others promise to do. <br/>      
    </p>
</div>

<hr/>

  <div class="container home-feature big-txt">
    <br/>
    <h1 class="color-primary text-center">Hosted Eco-System Platform <br/><small>(Single &amp; Multi-Account)</small></h1>
    <br/>

    
    <div class="list-group row">
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Eliminates the high costs of traditional eCommerce sites</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">It can be used either by micro, small, medium and large companies.</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">It's a PAY PER USE platform.</p>
            </div>
        </div>
      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">No Fees for trading</p>
            </div>
        </div>      
    </div>
      

  <div class="list-group row">      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Companies can take advantage of powerful marketing tools.</p>
            </div>
        </div>      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">It has sustainable costs and does not need external specialist</p>
            </div>
        </div>      
        <div class="list-group-item col-sm-6 col-md-3">
            <div class="row-action-primary">
                <i class="mdi-action-done-all"></i>
            </div>
            <div class="row-content">
                <p class="list-group-item-text">Allows to involve the entire corporate organization.</p>
            </div>
        </div>      

      
    </div>
    <br/><br/><br/>
</div>    
    
    
    
<div class="container-fluid home-feature big-txt business_social container-bg text-center">
    <br/><br/>
    <h1 class="color-primary text-center">E-commerce site Network <br/>&amp; Marketplace</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-2 col-md-offset-1">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Being SOCIAL is one of the keys to success for enterprises.     
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            It'a marketplace for companies and consumers who buy and sell
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            All operators can communicate with each other to develop new opportunities
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Every Gdoox Network user is also your potential customer. 
          </p>        
      </div>
      <div class="col-sm-4 col-md-2">
          <i class="mdi-social-group feature-mdi"></i>        
          <p >
            Security and privacy for your business &amp; your data
          </p>        
      </div>      
      
      
    </div>    
    <br/><br/>
</div>      


<div class="container home-feature big-txt ">
    <br/>
    <h1 class="color-primary text-center">Company Multi-Sites, Multi-Channel &amp; Alliance Development </h1>
    <h2 class="color-primary text-center">Winning in B2B commerce means develop the effectiveness and operational efficiency to be applied in the various business models</h2>
    <br/>
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="gdoox-c-h2">GDOOX IS MULTI-CHANNEL</h2>
        <span class="gdoox-c">B2B</span>
        <span class="gdoox-c">B2C</span>
        <span class="gdoox-c">B2E</span>
        <span class="gdoox-c">C2C</span>
      </div>
      <div class="col-md-12 text-center gdoox-c-txt">
        <p>
          <br/>
            With differentiated marketing channels & customized marketing actions<br/>
Companies can create temporary or consolidated alliances, new companies or operate as registered Joint Ventures          
        </p>
        <br/><br/>

      </div>
      
      <div class="list-group row gdoox-c-list">      
          <div class="list-group-item col-sm-5 col-md-5 col-md-offset-1 col-sm-offset-1">
              <div class="row-action-primary">
                  <i class="mdi-action-done-all"></i>
              </div>
              <div class="row-content">
                  <p class="list-group-item-text">GDOOX IS AN OMNI-DEVICE PLATFORM: PC, TABLET & MOBILE</p>
              </div>
          </div>      
          <div class="list-group-item col-sm-5 col-md-5">
              <div class="row-action-primary">
                  <i class="mdi-action-done-all"></i>
              </div>
              <div class="row-content">
                  <p class="list-group-item-text">GDOOX IS A COMPANY ECO-SYSTEM</p>
              </div>
          </div>      

      </div>
      
    </div>
    
</div>

<div class="container-fluid home-feature big-txt crm_section container-bg text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Contacts Management &amp; CRM</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-3 col-md-offset-3 col-sm-offset-2 ">
          <div class="well text-left">
              <strong> Create Promotions </strong> 
              <ul>
                  <li>Cross selling</li>
                  <li>Custom Upselling</li>
                  <li>Abandoned Cart, etc.</li>
              </ul>
          </div>       
      </div>
      <div class="col-sm-4 col-md-3">
          <div class="well text-left">
            <strong>Manage Promotions</strong> 
              <ul>
                  <li>By mail</li>
                  <li>Internal message</li>
                  <li>Customized templates</li>
              </ul>
          </div>       
      </div>
        
    </div>    
    <br/><br/>

      <p class="crm-p-caps">
        COMMUNICATE WITH ALL YOUR CUSTOMERS AND SUPPLIERS<br/>
        Communicate with customers and suppliers within the platform<br/>
        MONITOR PROMOTIONS <br/>
        Advanced SEO Tools
      </p>
      <br/>
      <p class="crm-p-small">
        The right product, with the right message, to the right person, at the right time<br/>
        Time to value: improve the efficiency and effectiveness of marketing actions.  
        <br/>
        <br/>
      </p>  
    
</div>      


<div class="container-fluid home-feature pi_section big-txt text-center">
    <br/><br/>
    <h1 class="color-primary text-center">Procurement &amp; Internationalization</h1>
    <br/><br/>

    <div class="row">
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox crosses offer and demand. It operates with more than 200 economy sectors.          
          </p>        
      </div>
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox also manages Reverse Auctions (including C2B version).          
          </p>        
      </div>
      <div class="col-sm-4 col-md-4">
          <i class="mdi-action-list feature-mdi"></i>        
          <p >
            Gdoox is a powerful support for Companies Associations which can carry out joint actions for the benefit of its members.
          </p>        
      </div>  
    </div>    
    <br/><br/>
    
    <h2><strong>Each product is associated with five Macro-Levels</strong></h2>
    <br/>
    <div class="row">
      <div class=" col-sm-3 col-md-2 col-md-offset-1">
          <div class="well text-center">
              country
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              business<br/>area
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              Business<br/>category
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              product<br/>category
          </div>
      </div>
      <div class=" col-sm-3 col-md-2 ">
          <div class="well text-center">
              definition or<br/>description
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