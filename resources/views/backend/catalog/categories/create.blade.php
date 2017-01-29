@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.catalog.categories.management') . ' | ' . trans('labels.backend.catalog.categories.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.catalog.categories.management') }}
        <small>{{ trans('labels.backend.catalog.categories.create') }}</small>
    </h1>
@endsection

@section('content')
    @include('backend.catalog.includes.partials.category-form')
@stop