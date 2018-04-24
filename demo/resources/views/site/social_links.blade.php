@if(!empty($storename->sociallinks))
  <div class="social-link-wrapper text-right">
    <strong>Follow Us:-</strong>
      @if($storename->sociallinks['facebook'])
      <a href="{!!$storename->sociallinks['facebook']!!}" target="_blank"><i class="zmdi zmdi-facebook-box zmdi-hc-fw"></i></a>
      @endif
      @if($storename->sociallinks['twitter'])
      <a href="{!!$storename->sociallinks['twitter']!!}" target="_blank"><i class="zmdi zmdi-twitter-box zmdi-hc-fw"></i></a>
      @endif
      @if($storename->sociallinks['google_plus'])
      <a href="{!!$storename->sociallinks['google_plus']!!}" target="_blank"><i class="zmdi zmdi-google-plus-box zmdi-hc-fw"></i></a>
      @endif
      @if($storename->sociallinks['linkedin'])
      <a href="{!!$storename->sociallinks['linkedin']!!}" target="_blank"><i class="zmdi zmdi-linkedin-box zmdi-hc-fw"></i></a>
      @endif
      @if($storename->sociallinks['pinterest'])
      <a href="{!!$storename->sociallinks['pinterest']!!}" target="_blank"><i class="zmdi zmdi-pinterest-box zmdi-hc-fw"></i></a>
      @endif
  </div>
  @endif
