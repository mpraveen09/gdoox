@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
  
  <h3 class="page-header"> View Institutional Investor</h3>
  
    <?php echo HTML::link("institutional-investor/edit/$view[_id]", "Edit");?>  |

    <?php echo HTML::link("institutional-investor/delete/$view[_id]", "Delete", array( "onclick"=>"return confirm('Are you sure you want to delete?')"))?>
<table class="table table-striped">
   
    <?php if(!empty($view['fst_name'])){?> <tr class="active"><th>First Name</th><td><?php echo $view['fst_name'];?></td></tr><?php }?>

     <?php if(!empty($view['lst_name'])){?> <tr class="active"><th>Last Name</th><td><?php echo $view['lst_name'];?></td></tr><?php }?>

     <?php if(!empty($view['scnd_name'])){?> <tr class="active"><th>Second Name</th><td><?php echo $view['fst_name'];?></td></tr><?php }?>

     <?php if(!empty($view['initials'])){?> <tr class="active"><th>Initials</th><td><?php echo $view['initials'];?></td></tr><?php }?>

     <?php if(!empty($view['strt_add_of_bsns'])){?> <tr class="active"><th>Street Address Of Your Place Of Business</th><td><?php echo $view['strt_add_of_bsns'];?></td></tr><?php }?>

      <?php if(!empty($view['city_of_bsns'])){?> <tr class="active"><th>City/Town/District/Region Of Your Place Of Business</th><td><?php echo $view['city_of_bsns'];?></td></tr><?php }?>

     <?php if(!empty($view['country_of_bsns'])){?> <tr class="active"><th>Country Of Your Place Of Busines</th><td><?php echo $view['country_of_bsns'];?></td></tr><?php }?>

     <?php if(!empty($view['zip'])){?> <tr class="active"><th>Country Area/Zip Code Of Your Place Of Business</th><td><?php echo $view['zip'];?></td></tr><?php }?>

     <?php if(!empty($view['ph_no1'])){?> <tr class="active"><th>Phone Number 1</th><td><?php echo $view['ph_no1'];?></td></tr><?php }?>

     <?php if(!empty($view['ph_no2'])){?> <tr class="active"><th>Phone Number 2</th><td><?php echo $view['ph_no2'];?></td></tr><?php }?>

     <?php if(!empty($view['fax_no'])){?> <tr class="active"><th>Fax Number</th><td><?php echo $view['fax_no'];?></td></tr><?php }?>

     <?php if(!empty($view['mob'])){?> <tr class="active"><th>Mobile Phone Number</th><td><?php echo $view['mob'];?></td></tr><?php }?>

     <?php if(!empty($view['b_berry'])){?> <tr class="active"><th>Blackberry</th><td><?php echo $view['b_berry'];?></td></tr><?php }?>

     <?php if(!empty($view['msm'])){?> <tr class="active"><th>MSM</th><td><?php echo $view['msm'];?></td></tr><?php }?>

     <?php if(!empty($view['skype'])){?> <tr class="active"><th>Skype User Name</th><td><?php echo $view['skype'];?></td></tr><?php }?>

     <?php if(!empty($view['bsns_email'])){?> <tr class="active"><th>Business Email Address</th><td><?php echo $view['bsns_email'];?></td></tr><?php }?>


 </table>
@endsection