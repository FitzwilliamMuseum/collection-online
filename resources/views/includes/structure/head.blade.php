<div class="container-fluid head parallax position-relative">
  <div class="absolute-bottom">
    <div class="w-100">
    <div class="mr-3">
      <a tabindex="0" class="further-info fa-stack fa-lg float-right mr-4 mb-4" role="button" data-toggle="popover"
      data-placement="left" data-content="@yield('hero_image_title')">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-info fa-stack-1x fa-inverse"></i></a>
    </div>
    <div class="mr-3">
      <a tabindex="0" class="further-info fa-stack fa-lg float-right mr-4 mb-4"
      role="button" data-toggle="lightbox" data-max-width="1024"
      data-remote="@yield('hero_image')" data-title="@yield('hero_image_title')">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-expand fa-stack-1x fa-inverse"></i>
    </a>
    </div>
    </div>
  </div>
</div>
<div class="container-fluid bg-black">
  <div class="ml-3 pt-4 pb-4">
    <h1 class="shout" id="doc-main-h1">@yield('title')</h1>

  </div>
</div>
