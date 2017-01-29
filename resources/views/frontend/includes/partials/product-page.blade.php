<ul class="nav nav-tabs aa-products-tab">
    <li class="active"><a href="{{ route('frontend.category', $content->first()->categories->id) }}">{{ ucfirst($content->first()->categories->name) }}</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade in active">
        <ul class="aa-product-catg">
            @foreach($content as $view)
                <li>
                    <figure>
                        <a class="aa-product-img" href="#"><img src="{{ asset($view->cover) }}" alt="{{ $view->name }}"></a>
                        <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>{{ trans('labels.frontend.product.add_budge') }}</a>
                        <figcaption>
                            <h4 class="aa-product-title"><a href="{{ route('frontend.product', $view->id) }}">{{ $view->name }}</a></h4>
                            <i class="aa-product-price">{{ trans('labels.frontend.product.ask_for_quote') }}</i>
                        </figcaption>
                    </figure>
                    <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="{{ trans('labels.frontend.product.add_to_wishlist') }}">
                            <span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle2="tooltip" data-placement="top" title="{{ trans('labels.frontend.product.quick_view') }}" data-toggle="modal"
                           data-target="#{{ str_slug($view->name).$view->id }}"><span class="fa fa-search"></span></a>
                    </div>
                    <!-- product badge -->
                    <span class="aa-badge aa-sale" href="#">NOVO</span>
                </li>
            @endforeach
        </ul>
        <div class="text-center">
            <a class="aa-browse-btn" href="{{ route('frontend.category', $content->first()->categories->id) }}">{{ trans('labels.frontend.product.browse_all_products') }} <span class="fa fa-long-arrow-right"></span></a>
        </div>
    </div>

    <div id="quick-view-modal">
        @foreach($content as $modal)
            <div class="modal fade" id="{{ str_slug($modal->name).$modal->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div class="simpleLens-gallery-container" id="demo-1">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container">
                                                    <a class="simpleLens-lens-image" data-lens-image="{{ asset($modal->cover) }}">
                                                        <img src="{{ asset($modal->cover) }}" class="simpleLens-big-image">
                                                    </a>
                                                </div>
                                            </div><br>
                                            <div class="simpleLens-thumbnails-container">
                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                   data-lens-image="{{ asset($modal->cover) }}"
                                                   data-big-image="{{ asset($modal->cover) }}">
                                                    <img src="{{ asset($modal->cover) }}" width="45" height="55">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{ $modal->name }}</h3>
                                        <p>{{ $modal->description }}</p>

                                        <div class="aa-prod-quantity">
                                            <p class="aa-prod-category">
                                                Categoria: <a href="{{ route('frontend.category', $modal->categories->id) }}">{{ $modal->categories->name }}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            <a href="{{ route('frontend.product', $modal->id) }}" class="aa-add-to-cart-btn">{{ trans('labels.frontend.product.view_detail') }}</a>
                                            <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>{{ trans('labels.frontend.product.add_to_budge') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- / quick view modal -->
        @endforeach
    </div>
</div>