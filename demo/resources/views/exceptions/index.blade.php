@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>Exceptions</h2>
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info alert-dismissible" role="alert">
        {!!  Session::get('message')  !!}
    </div>
@endif

@if(!$exceptions->count())
    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible" role="alert">
                No Exceptions
            </div>  
        </div>
    </div>
              
@else
          
              
    <div class="card">
        <div class="card-header bgm-blue"><h2>Exceptions</h2></div>
        <div class="row">
            <div class="text-right col-md-12">
                <div class="row">
                    <div class="text-right col-md-12">
                        {!! $exceptions->render() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body card-padding">  
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <th>Id</th>
                        <th>Subject</th>
                        <th>Controller</th>
                        <th>Description</th>
                     </thead>

                     <tbody>
                         <?php $i = 1; ?>
                         @foreach($exceptions as $exception)
                          <tr>
                               <td><?php echo $i; ?></td>
                               <td>{!! $exception->subject !!}</td>
                               <td>{!! $exception->controller !!}</td>
                               <td>{!! $exception->description !!}</td>
<!--                               <td>
                                   <a href="{!! route('exceptions.show', $exception->_id)  !!}">
                                       <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                                   </a> &nbsp; 
                                   <a href="{!! route('exceptions.edit', $exception->_id)  !!}">
                                       <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                                   </a>
                               </td>-->
                           </tr>
                           <?php $i++; ?>
                          @endforeach
                     </tbody>  
                 </table>
            </div>
       </div>
        <div class="row">
            <div class="text-right col-md-12">
                {!! $exceptions->render() !!}
            </div>
        </div>
    </div>                        
    @endif   
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript">


    </script>
@endsection