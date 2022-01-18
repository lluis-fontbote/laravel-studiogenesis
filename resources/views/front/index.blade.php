@extends('front.mainLayout')

@section('title', 'Productos')
@section('main-paragraph', 'Aquí se muestran los productos de nuestra web')
@section('content')

<div class="container">
	<div class="row mt-2">
	<aside class="col-md-3">
		
<div class="card">
  <form action="{{ route('front.filter') }}" method="GET">
    @csrf
    @foreach ($parentCategories as $parent)
      <article class="filter-group">
        <header class="card-header">
          <a data-bs-toggle="collapse" href="#collapse_{{ $parent->id }}" role="button" aria-expanded="false" aria-controls="collapse_{{ $parent->id }}">
            <i class="icon-control fa fa-chevron-down"></i>
            <h6 class="title">{{ $parent->name }}</h6>
          </a>
        </header>
        <div class="collapse" id="collapse_{{ $parent->id }}">
          <div class="card-body">
              @foreach ($parent->children as $child)
                <label class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="categories_id[]" value="{{ $child->id }}">
                  <div class="custom-control-label">{{ $child->name }}  
                    <b class="badge badge-pill badge-light float-right">120</b>  </div>
                </label>
              @endforeach
          </div> <!-- card-body.// -->
        </div>
      </article> <!-- filter-group .// -->
    @endforeach
    <button class="btn btn-primary mt-2" style="width:100%;">Filtra</button>
  </form>
</div> <!-- card.// -->

	</aside>
	<main class="col-md-9">

<div class="row">
  @foreach ($products as $product)
    <div class="col-md-4">
      <figure class="card card-product-grid">
        <div class="img-wrap"> 
            <img src="{{ asset('storage/productPhotos') . '/' . $product->photos->first()->filename }}" class="img-fluid">
        </div> <!-- img-wrap.// -->
        <figcaption class="info-wrap">
          <div class="fix-height">
            <a href="#" class="title">{{ $product->name }}</a>
            <div class="price-wrap mt-2">
              <span class="price">{{ $product->prices->first()->amount . ' €' ?? '' }}</span>
            </div> <!-- price-wrap.// -->
          </div>
          <a href="#" class="btn btn-block btn-primary">Add to cart </a>
        </figcaption>
      </figure>
    </div> <!-- col.// -->
  @endforeach

  {{ $products->links() }}

	</main>
	</div>
</div>
@endsection