
@if(Auth::user())  
  @if( Auth::user()->id ===  $personalsitedetails->user_id)
    @if(!empty($owner))
        <div class="go-social">
          <div class="clearfix">
            <p class="lead">
                Site URL : {{ URL::to('/site/') }}/{!!  $shopid !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Owner/Admin: {!! $owner !!}</p>
          </div>
        </div>
    @endif
  
    <div class="card panel-collapse">
      <div class="card-header card-padding-sm bgm-bluegray" role="tab" id="quickmenu-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse-quickmenu" aria-expanded="true" aria-controls="collapse-quickmenu">Quick Menu - Site Management<small>This menu is only for you</small>
          </a>
        </h2>
      </div>
      <div class="card-body card-padding collapse" id="collapse-quickmenu"  role="tabpanel" aria-labelledby="quickmenu-heading">
        <div  class="row panel-body">
            <div class="col-md-4">
              <ul>
                  <li class="">
                     Add/Edit Personal Profile
                       <ul>
                          <li><a href="{!! route('profile-index') !!}">Your Account</a></li>
                          <!--<li><a href="{!! route('personal-info-edit') !!}">Personal Info</a></li>-->
                          <li><a href="{!! route('social-info-create') !!}">Social Info</a></li>
                          <li><a href="{!! route('relation-info-create') !!}">Relation with Gdoox</a></li>
                          <li><a href="{!! route('interest-info-create') !!}">Interests</a></li>
                          <li>
                             Business Sectors
                             <ul>
                                  <li><a href="{!! route('business-sectors-index') !!}">Business Sectors I'am Interested In</a></li>
                             </ul>           
                          </li> 	
                        </ul>
                  </li>               
               </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li class="">
                       Add/Edit Personal Site
                       <ul>
                           <li><a href="{!! route('personal-about-us-create') !!}">About Us</a></li>
                            <li><a href="{!! route('general-info-create') !!}">General Information</a></li>
                            <li><a href="{!! route('professional-skills-create') !!}">Professional Skills</a></li>
                            <li><a href="{!! route('other-info-create') !!}">Other Information</a></li>
                            <li>  <a href="{!! route('jobdetail.create') !!}">Job Details</a></li>
                            <li><a href="{!! route('competencies-create') !!}">Competencies</a></li>
                            <li><a href="{!! route('site.header.images.index') !!}">Add Site Images</a></li>
                       </ul>           
                    </li>               
                 </ul>
              </div>
        </div>
      </div>
    </div>
  @endif
@endif

