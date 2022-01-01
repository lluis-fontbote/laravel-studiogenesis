@extends('front.mainLayout')

@section('title', 'Productos')
@section('main-paragraph', 'Aquí se muestran los productos de nuestra web')

@section('content')
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/productPhotos') . '/' . $product->photos->first()->filename }}" alt="..." />
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
</section>
@endsection