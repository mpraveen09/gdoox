@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Category Upload</h2>-->
@endsection

@section('right_col_title_right')
@endsection

@section('header_add_js_script')        
@endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

     <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Import Categories</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
          <div class="progress progress-striped active" style="display:none;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  </div>
              </div>
              <br/>
               <br/>
               {!! Form::open(['route'=>'category-upload.override', 'method'=>'POST', 'files' => true, 'name' => 'cat_upload', 'class' => 'cat_upload'])!!}
                  <div class="row">
                      <div class="col-sm-12">
                          {!! Form::label('file','Browse File',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                              <span class="btn btn-primary btn-file m-r-10">
                                <span class="fileinput-new">Select file</span>
                                  <span class="fileinput-exists">Change</span>
                                  {!! Form::file('file') !!}
                              </span>
                            (Please select excel format only)
                              <span class="fileinput-filename"></span>
                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-sm-10 clearfix">
                              {!! Form::label('column', 'Enter the last column', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-3 col-sm-3 col-xs-6">
                                {!! Form::text('col', 'g', array('class'=>'form-control')) !!}
                              </div>
                      </div>
                  </div>
               <div class="row">
                    <div class="form-group clearfix">
                      <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="button" class="btn btn-round btn-success process upload">Upload</button>
                          {!! HTML:: link('/dashboard','Cancel',array('class'=>'btn btn-round btn-primary'))!!}
                      </div>
                    </div>
               </div>
        </div>
    </div>
<div class="card override_file" style="display: none;">
  <div class="card-header bgm-blue">
    <h2>Process Next</h2>
  </div>
  <div class="card-body card-padding">  
      {!!$str = "File is already exist do you want to replace it?"!!}
        <div class="radio col-sm-12">
           <label>
              {!! Form::radio('override', 1, true)!!}
               <i class="input-helper"></i>
               Yes
           </label>
          <label>
              {!! Form::radio('override', 0, true)!!}
               <i class="input-helper"></i>
               No
           </label>
        </div>
        <div class="row">
             <div class="form-group clearfix">
               <div class="col-md-6">
                      <button type="submit" class="btn btn-primary" name="replace" value="replace">Done</button>
               </div>
             </div>
        </div>
      {!!Form::close()!!}
  </div>
</div>
@if($term == 2)
<div class="card">
  <div class="card-header bgm-blue">
    <h2>Process Next</h2>
  </div>
  <div class="card-body card-padding">  
      {!!$str = "Some categories are already exists do you want to override?"!!}
      {!!Form::open(['route' => 'category-upload.cat_attr'])!!}
      {!!Form::hidden('filename', $filename)!!}
      {!!Form::hidden('col', $col)!!}
      {!!Form::hidden('row', $row)!!}
        <div class="radio col-sm-12">
           <label>
              {!! Form::radio('confirm', 1, true)!!}
               <i class="input-helper"></i>
               Yes
           </label>
          <label>
              {!! Form::radio('confirm', 0, true)!!}
               <i class="input-helper"></i>
               Only Fresh Categories
           </label>
        </div>
      <button type="submit" class="btn btn-primary">Done</button>
      {!!Form::close()!!}
  </div>
</div>
@endif
@if($term == 3)
<div class="card">
  <div class="card-header bgm-blue">
    <h2>All Import Categories</h2>
  </div>
  <div class="card-body card-padding">  
      {!!Form::open(['route' => 'category-upload.update'])!!}
      {!!Form::hidden('file', $filename)!!}
      {!!Form::hidden('col', $col)!!}
    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <thead>
                <tr>
                    <th>Category Id</th>
                    <th>Category Name</th>
                </tr>
            </thead>
            <tbody>    
              @foreach($tmp_categories as $category)
              <tr>
                  <td>{!!$category->cat_id!!}</td><td>{!!$category->name!!}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
      
      
      <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
          <button type="submit" class="btn btn-primary" name="done" value="done">Import</button>
          <button type="submit" class="btn btn-primary" name="cancel" value="cancel">Cancel</button>
        </div>
      </div>
  </div>
      {!!Form::close()!!}
</div>

@endif
@endsection
@section('footer_add_js_files') 
      <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>
      <script src="{{ asset('/m-admin-ui/vendors/input-mask/input-mask.min.js') }}"></script>
@endsection       
@section('footer_add_js_script')
<script>
  $(".upload").click(function(){
//        $('.progress').css('display','block');
        var uploadFile = document.getElementById("file");
        if( "" == uploadFile.value){
            alert('File is required.');
        }
        else {
            var fd = new FormData();
            var col = $('input[name=col]').val();
//          alert(col);
//          return false;
            fd.append( "file", $("#file")[0].files[0]);
            $.ajax({
                url: "{!! route('category-upload-store') !!}",
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    if(data.upload == true){
                      var url = "{!! route('category-upload.cat_attr') !!}";
                      url += '?filename=' + data.filename+ '&col=' + data.col + '&row=' + data.row ;
                      window.location.href = url;
                    }
                    else {
                          if (data.extention != undefined){
                              alert(data.extention[0]);
                          }
                          else if (data.errors.error != undefined){
                              $('.override_file').show();
                          }
                    }
                },
            });
        }
  });
</script>
@endsection
