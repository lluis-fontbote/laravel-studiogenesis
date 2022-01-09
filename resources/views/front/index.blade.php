@extends('front.mainLayout')

@section('title', 'Productos')
@section('main-paragraph', 'Aquí se muestran los productos de nuestra web')
@section('css')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection
@section('content')
<!-- Section-->
{{-- <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
          </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top"
                             src="{{ asset('storage/productPhotos') . '/' . $product->photos->first()->filename }}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $product->name }}</h5>
                                <!-- Product price-->
                                {{ count($product->prices) > 0 ? $product->prices->first()->amount : ''}}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ver más</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$products->links()}}
    </div>
</section> --}}
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row mt-2">
	<aside class="col-md-3">
		
<div class="card">
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Categories</h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_2" style="">
			<div class="card-body">
        <form action="{{ route('front.filter') }}" method="POST">
          @csrf
          @foreach ($categories as $category)
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="categories_id[]" value="{{ $category->id }}">
              <div class="custom-control-label">{{ $category->name }}  
                <b class="badge badge-pill badge-light float-right">120</b>  </div>
            </label>
          @endforeach
          <button class="btn btn-primary mt-2">Filtra</button>
        </form>
	    </div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group .// -->
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
              <span class="price">{{ $product->prices->first()->amount ?? '' }}</span>
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

@section('js')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection