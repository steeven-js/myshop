<div class="col-12 col-sm-6 col-lg-3">
    <div class="product mb-0">
        <div class="product-thumb-info border-0 mb-3">

            <div class="product-thumb-info-badges-wrapper">
            <span class="badge badge-ecommerce badge-success">NEW</span>

            </div>

            <div class="addtocart-btn-wrapper">
                <a href="{{route('addtocart', $itemProduct)}}" class="text-decoration-none addtocart-btn" title="Add to Cart">
                    <i class="icons icon-bag"></i>
                </a>
            </div>

            <a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
                QUICK VIEW
            </a>

            <a href="{{route('welcome.detail', $itemProduct)}}">
                <div class="product-thumb-info-image">

                    @if (isset($itemProduct->image))
                        <img alt="" class="img-fluid" src="{{Storage::url($itemProduct->image)}}">
                    @else
                        <img alt="" class="img-fluid" src="/img/noImage.jpg">
                    @endif

                </div>
            </a>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">{{$itemProduct->category->name}}</a>
                <h3>{{Str::limit($itemProduct->name)}} </h3>
            </div>
            <a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
        </div>
        <div title="Rated 5 out of 5">
            <input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
        </div>
        <p class="price text-5 mb-3">
            {{$itemProduct->prix}}
        </p>
    </div>
</div>