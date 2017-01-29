@extends('frontend.layouts.app')

@section('after-styles')
<!-- Product view slider -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.simpleLens.css') }}">
<!-- slick slider -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/slick.css') }}">
<!-- price picker slider -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/nouislider.css') }}">
<!-- Top Slider CSS -->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/frontend/sequence-theme.modern-slide-in.css') }}">
@endsection

@section('content')
<!-- Products section -->
<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            @include('frontend.includes.partials.product-page', ['content' => $papelDeParede])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Products section -->
@endsection

@section('after-scripts')
<!-- To Slider JS -->
<script src="{{ asset('js/frontend/sequence.js') }}"></script>
<script src="{{ asset('js/frontend/sequence-theme.modern-slide-in.js') }}"></script>
<!-- Product view slider -->
<script src="{{ asset('js/frontend/jquery.simpleGallery.js') }}"></script>
<script src="{{ asset('js/frontend/jquery.simpleLens.js') }}"></script>
<!-- slick slider -->
<script src="{{ asset('js/frontend/slick.js') }}"></script>
<!-- Price picker slider -->
<script src="{{ asset('js/frontend/nouislider.js') }}"></script>
@endsection