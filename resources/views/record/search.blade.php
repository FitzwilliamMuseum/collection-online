@extends('layouts/layout')
@section('title', 'Our objects and works of art')
@section('hero_image','https://fitz-cms-images.s3.eu-west-2.amazonaws.com/cupidpsychelarge.jpg')
@section('hero_image_title', 'Cupid and Psyche - del Sallaio')
@section('description','A search page for our highlight objects')
@section('keywords', 'search,highlights, objects')
@section('content')

<div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
  {{ \Form::open(['url' => url('/search/results'),'method' => 'GET']) }}
<div class="row">
  <div class="form-group col-md-12">
    <input type="text" id="query" name="query" value="" class="form-control input-lg mr-4"
    placeholder="Search our collection" required value="{{ old('query') }}">
  </div>
</div>

<div class="row">
  <div class="col">
    <h4>Visual results</h4>
  <div class="form-group form-check ">
    <input type="checkbox" class="form-check-input" id="images" name="images">
    <label class="form-check-label" for="images">Only with images?</label>
  </div>
</div>
<div class="col">
  <h4>Operand for your search</h4>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="operator" id="operator" value="AND" checked>
    <label class="form-check-label" for="operator">
      AND
    </label>
  </div>

  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="operator" id="operator" value="OR" >
    <label class="form-check-label" for="operator">
      OR
    </label>
  </div>
</div>
<div class="col">
  <h4>Sort by last update</h4>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="sort" id="sort" value="desc" checked>
    <label class="form-check-label" for="sort">
      Descending
    </label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="sort" id="sort" value="asc" >
    <label class="form-check-label" for="sort">
      Ascending
    </label>
  </div>
</div>

</div>
<div class="row">
  <div class="form-group col-md-12">
  <button type="submit" class="btn btn-dark">Submit</button>
</div>
</div>
@if(count($errors))
<div class="form-group">
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif
{!! Form::close() !!}
</div>
@endsection
