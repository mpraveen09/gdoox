<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
<!--------------------------------------------------------End Personal Profile------------------------------------------------------------>

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>Personal Profile</a>
    <ul>
        <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
        <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
        <li><a href="{!! route('social-info-create')!!}">Social Info</a></li>
        <li><a href="{!! route('relation-info-create')!!}">Relation with Gdoox</a></li>
        <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
<!--        <li class="sub-menu">
           <a href="">Business Sectors</a>
           <ul>-->
                <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'am Interested In</a></li>
<!--           </ul>           
        </li> 	-->
      </ul>
  </li>

<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
  
  
  <!------------------------------------------ Personal Site ----------------------------------------------------------->
<li class="sub-menu">
   <a href=""><i class="zmdi zmdi-view-list"></i>Personal Site</a>
   <ul>
        <li><a href="{!! route('create-personal-site-create')!!}">Create Your Personal Site</a></li>
        <li><a href="{!! route('personal-about-us-create')!!}">Summary</a></li>
        <li><a href="{!! route('general-info-create')!!}">General Information</a></li>
        <li><a href="{!! route('professional-skills-create')!!}">Professional Skills</a></li>
        <li><a href="{!! route('other-info-create')!!}">Other Information</a></li>
        <li><a href="{!! route('jobdetail.create')!!}">Job Details</a></li>
        <li><a href="{!! route('competencies-create')!!}">Competencies</a></li>
        <li><a href="{!! route('references-create')!!}">References</a></li>
        <li><a href="{!! route('sponsors-create')!!}">Sponsors</a></li>
        <li class="sub-menu"><a href="">Add Site Images</a>
            <ul>
                 <li><a href="{!! route('site.header.images.index')!!}">Add Site Images</a></li>
            </ul>
        </li>
   </ul>           
</li> 	
<!------------------------------------------ End Personal Site ----------------------------------------------------------->
