@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h2>CRM</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
        <!-- if there are creation errors, they will show here -->
        @if (HTML::ul($errors->all()))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {!! HTML::ul($errors->all()) !!}
            </div>
        @endif

    
       <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>Messages</h2>
            </div><!-- .card-header -->
            
            <div class="card-body card-padding">                    
                <table class="table">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($messages as $message)
                              <tr>
                                  <td>
                                      @if($message->user_id=== Auth::user()->id)
                                      You:
                                      @else
                                          Buyer:
                                      @endif
                                  </td>
                                  <td>{!! $message->message !!}</td>
                                  <td>{!! $message->created_at !!}</td>
                              </tr>
                          @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <button name="button">Reply</button>
            </div>
        </div>
  
@endsection

@section('footer_add_js_script')

<script>

</script>
@endsection


