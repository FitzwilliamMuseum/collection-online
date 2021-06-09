@if(array_key_exists('multimedia', $record['_source']))
@section('media-files')
  <div class="container-fluid bg-white">
    <div class="shadow-sm p-3 mx-auto mb-3">
      <div>
        <a href="/id/image/{{ $record['_source']['multimedia'][0]['admin']['id']}}"><img class="img-fluid mx-auto d-block main-image" src="{{ env('APP_URL')}}/imagestore/{{ $record['_source']['multimedia'][0]['processed']['large']['location'] }}"
          loading="lazy" alt="An image of {{ ucfirst($record['_source']['summary_title']) }}"
          /></a>
        </div>
        <div class="text-center mt-2">
          <span class="btn btn-wine m-1 p-2 share">
            <a href="/id/image/{{ $record['_source']['multimedia'][0]['admin']['id']}}" ><i class="fas fa-search mr-2"></i> View image details</a>
          </span>

          @if(!array_key_exists('source',$record['_source']['multimedia'][0]['admin']))
            <span class="btn btn-wine m-1 p-2 share">
              <a href="{{ env('APP_URL')}}/imagestore/{{ $record['_source']['multimedia'][0]['processed']['large']['location'] }}" target="_blank"
              download="{{ basename($record['_source']['multimedia'][0]['processed']['large']['location'] ) }}"><i class="fas fa-download mr-2"></i> Download this image</a>
            </span>

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
                <span class="btn btn-wine m-1 p-2 share">
                  <a href="/id/image/iiif/{{ $record['_source']['multimedia'][0]['admin']['id']}}" ><img src="/images/logos/iiif.svg" width="20px" />  IIIF view</a>
                </span>
                <span class="btn btn-wine m-1 p-2 share">
                  <a href="https://api.fitz.ms/data-distributor/iiif/{{ $record['_source']['admin']['id']}}/manifest" ><img src="/images/logos/iiif.svg" width="20px" />  IIIF Manifest</a>
                </span>
                <span class="btn btn-wine m-1 p-2 share">
                  <a href="/id/image/slow/iiif/?image={{ $slow[0] }}" ><i class="fas fa-eye"></i> Slow looking</a>
                </span>
              @endif
            @endif
          @endif
        </div>
      </div>
    </div>
  @endif

@if(array_key_exists('multimedia', $record['_source']))

  @if(!empty(array_slice($record['_source']['multimedia'],1)))
    @php
    $images = [];
    foreach (array_slice($record['_source']['multimedia'],1,3) as $image ){
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
        <h3>Alternative views</h3>
      <div class="row">
        @foreach($images as $media)
          <div class="col-md-4 mt-3">
            <div class="card card-body h-100">
              <a href="/id/image/{{ $media['admin']['id']}}"><img class="img-fluid mx-auto d-block" src="{{ env('APP_URL')}}/imagestore/{{ $media['processed']['preview']['location'] }}"
                loading="lazy" alt="An image of {{ ucfirst($record['_source']['summary_title']) }}"
                /></a>
                <span class="btn btn-wine m-1 mt-3 mb-3 p-2 share">
                  <a href="{{ env('APP_URL')}}/imagestore/{{ $media['processed']['large']['location'] }}" target="_blank"
                  download="{{ basename($media['processed']['large']['location'] ) }}"><i class="fas fa-download mr-2"></i>  Download this image</a>
                </span>
              </div>
            </div>
          @endforeach
        </div>
    </div>
        @php
        $records = count($record['_source']['multimedia']);
        @endphp

        @if($records > 4)
          <span class="btn btn-wine m-1 mt-3 mb-3 p-2 share d-block">
            <a href="{{ route('images.multiple', [$record['_source']['identifier'][1]['value']]) }}"
            ><i class="fas fa-eye mr-2"></i>  View all {{ $records }} images attached </a>
          </span>
        @endif

      @endif

    @endif
@endsection
  @endif
