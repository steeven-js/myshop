@extends('layouts.myshop')
@section('main')

<div class="container">

    <div class="row">
        <div class="col">
            <ul class="breadcrumb breadcrumb-style-2 d-block text-4 mb-4">
                <li><a href="#" class="text-color-default text-color-hover-primary text-decoration-none">Home</a></li>
                <li><a href="#" class="text-color-default text-color-hover-primary text-decoration-none">Electronics</a></li>
                <li>{{$product->name}}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 mb-5 mb-md-0">

            <div class="thumb-gallery-wrapper">
                <div class=" manual nav-inside nav-style-1 nav-dark mb-3">
                    <div>
                        <img alt="" class="img-fluid" src="{{Storage::url($product->image)}}">
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-7">

            <div class="summary entry-summary position-relative">

                <h1 class="mb-0 font-weight-bold text-7">{{$product->name}}</h1>

                <div class="pb-0 clearfix d-flex align-items-center">
                    <div title="Rated 3 out of 5" class="float-start">
                        <input type="text" class="d-none" value="3" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'primary', 'size':'xs'}">
                    </div>
                </div>

                <div class="divider divider-small">
                    <hr class="bg-color-grey-scale-4">
                </div>

                <p class="price mb-3">
                    <span class="sale text-color-dark">${{$product->prix}}</span>
                </p>

                <p class="text-3-5 mb-3">{{$product->description}}</p>

                    <div>
                    <a href="{{route('addtocart', $product)}}"><button type="submit" class="btn btn-dark btn-modern text-uppercase bg-color-hover-primary border-color-hover-primary">Add to cart</button></a>
                    </div>

            </div>

        </div>
    </div>

    <div class="row pt-4">
        <div class="col">
            <h4 class="font-weight-semibold text-4 mb-3">RELATED PRODUCTS</h4>
            <hr class="mt-0">

            <div class="products row">
                <div class="col-4
                ">

                    <div class="owl-carousel owl-theme nav-style-1 nav-outside nav-outside nav-dark mb-0 owl-carousel-init stage-margin owl-loaded owl-drag" data-plugin-options="{'loop': false, 'autoplay': false, 'items': 4, 'nav': true, 'dots': false, 'margin': 20, 'autoplayHoverPause': true, 'autoHeight': true, 'stagePadding': '75', 'navVerticalOffset': '50px'}" style="height: auto;">
                        <div class="owl-stage-outer owl-height" style="height: 534.938px">

                                    @forelse ($products as $itemProduct)

                            <div class="product mb-0">

                                <a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
                                    QUICK VIEW
                                </a>

                                <a href="shop-product-sidebar-left.html">
                                    <div class="product-thumb-info-image">
                                        <img alt="" class="img-fluid" src="{{Storage::url($product->image)}}">

                                    </div>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">electronics</a>
                                    <h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">{{$itemProduct->name}}</a></h3>
                                </div>
                                <a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
                            </div>
                            <p class="price text-5 mb-3">
                                <span class="sale text-color-dark font-weight-semi-bold">{{$itemProduct->prix}}</span>
                            </p>

                            @empty
        
                            @endforelse

                        </div>
                    </div>

                </div>
            </div>

    </div>
</div>

@endsection
