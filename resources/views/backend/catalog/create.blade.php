@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.catalog.products.management') . ' | ' . trans('labels.backend.catalog.products.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.catalog.products.management') }}
        <small>{{ trans('labels.backend.catalog.products.create') }}</small>
    </h1>
@endsection

@section('content')
    @include('backend.catalog.includes.partials.product-form')
@stop