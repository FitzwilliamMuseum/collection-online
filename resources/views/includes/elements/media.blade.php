@if(array_key_exists('multimedia', $record['_source']))

  @section('media-files')
    @if(array_key_exists('large', $record['_source']['multimedia'][0]['processed']))
    <div class="container-fluid bg-white">
      <div class="shadow-sm p-3 mx-auto mb-3">
        <div>
          <a href="/id/image/{{ $record['_source']['multimedia'][0]['admin']['id']}}"><img class="img-fluid mx-auto d-block main-image" src="{{ env('APP_URL')}}/imagestore/{{ $record['_source']['multimedia'][0]['processed']['large']['location'] }}"
            loading="lazy" alt="An image of {{ ucfirst($record['_source']['summary_title']) }}"
            /></a>
          </div>
          <div class="text-center mt-2">
            @include('includes.elements.exif-short')
          </div>
          <div class="text-center mt-2">
            <a class="btn btn-sm btn-sm btn-dark m-1" href="/id/image/{{ $record['_source']['multimedia'][0]['admin']['id']}}" ><i class="fas fa-search mr-2"></i> View image details</a>
            @if(!array_key_exists('source',$record['_source']['multimedia'][0]['admin']))
              <a class="btn btn-sm btn-sm btn-dark m-1" href="#download-message" data-toggle="collapse" aria-expanded="false" aria-controls="download-message"
              ><i class="fas fa-download mr-2"></i> Use this image</a>
              @php
              $con = array();
              foreach ($record['_source']['multimedia'] as $image ){
                if(Arr::has($image, 'processed.zoom')) {
                  $con[] = array(
                    'zoom' => Arr::has($image, 'processed.zoom'),
                    'image' => $image['admin']['id']
                  );
                }
              }
              @endphp

              @if(!empty($con))
                @if(Arr::get($con, 'zoom', true))
                  @php
                  $slow = Arr::pluck($con, 'image');
                  @endphp
                  {{-- Check for IIIF --}}
                  <a class="btn btn-sm btn-sm btn-dark m-1 " href="/id/image/iiif/{{ $record['_source']['multimedia'][0]['admin']['id']}}" ><img src="/images/logos/iiif.svg" alt="IIIF icon - view image" width="20px" />  Deep zoom</a>
                  <a class="btn btn-sm btn-sm btn-dark m-1 " href="https://api.fitz.ms/data-distributor/iiif/{{ $record['_source']['admin']['id']}}/manifest" ><img src="/images/logos/iiif.svg" alt="IIIF Manifest" width="20px" />  IIIF Manifest</a>
                  <a class="btn btn-sm btn-sm btn-dark m-1 " href="/id/image/slow/iiif/?image={{ $slow[0] }}" ><i class="fas fa-eye"></i> Slow looking</a>
                  @php
                    $three = [];
                  @endphp
                  @foreach($record['_source']['identifier'] as $key => $rep)
                    @if(array_key_exists('type',$rep))
                      @if($rep['type'] ===  'Online 3D model')
                        @php
                          $three[] = true;
                        @endphp
                      @endif
                    @endif
                  @endforeach
                  @if(!empty($three))
                    <a class="btn btn-sm btn-sm btn-dark m-1 " href="/id/image/3d/{{ $record['_source']['identifier'][1]['priref'] }}" ><i class="fas fa-eye"></i> 3D view</a>
                  @endif
                @endif
              @endif
            @endif
          </div>
          @if(!array_key_exists('source',$record['_source']['multimedia'][0]['admin']))
          <div class="bg-grey col-md-6 mt-2 mx-auto collapse p-3" id="download-message">
            @include('includes.elements.terms')
          </div>
          @endif
        </div>
      </div>
    @endif

    @if(array_key_exists('multimedia', $record['_source']))

      @if(!empty(array_slice($record['_source']['multimedia'],1)))
        @php
        $images = [];
        foreach (array_slice($record['_source']['multimedia'],1,6) as $image ){
          if(!Arr::has($image, 'admin.source')){
            $images[] = array(
              'admin' => $image['admin'],
              'processed' => $image['processed']
            );
          }
        }
        @endphp

        @if(sizeof($images) > 0)
          <div class="container">
            <h3 class="lead">Alternative views</h3>
            <div class="row">
              @foreach($images as $media)
                <div class="col-md-2 mt-3">
                  <div class="h-100">
                    <a href="/id/image/{{ $media['admin']['id']}}"><img class="img-fluid mx-auto d-block" src="{{ env('APP_URL')}}/imagestore/{{ $media['processed']['preview']['location'] }}"
                      loading="lazy" alt="An image of {{ ucfirst($record['_source']['summary_title']) }}"
                      /></a>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            @php
            $records = count($record['_source']['multimedia']);
            @endphp

            @if($records > 4)
              <div class="container">
                <a class="btn btn-sm btn-sm btn-dark m-1 mt-2" href="{{ route('images.multiple', [$record['_source']['identifier'][1]['value']]) }}"
                ><i class="fas fa-eye mr-2"></i>  View all {{ $records }} images attached </a>
              </div>
            @endif

          @endif

        @endif
      @endif
      @endsection

    @endif
