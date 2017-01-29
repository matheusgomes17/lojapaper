@if(isset($model))
    {!! Form::model($model, ['route' => ['admin.catalog.category.update', $model->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'put', 'files' => true]) !!}
@else
    {{ Form::open(['route' => 'admin.catalog.category.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
@endif
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.catalog.categories.create') }}</h3>

        <div class="box-tools pull-right">
            @include('backend.catalog.includes.partials.category-header-buttons')
        </div><!--box-tools pull-right-->
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group">
            {{ Form::label('name', trans('validation.attributes.backend.catalog.categories.name'), ['class' => 'col-lg-2 control-label']) }}

            <div class="col-lg-10">
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.catalog.categories.name')]) }}
            </div><!--col-lg-10-->
        </div><!--form control-->

        <div class="form-group">
            {{ Form::label('type', trans('validation.attributes.backend.catalog.categories.type'), ['class' => 'col-lg-2 control-label']) }}

            <div class="col-lg-10">
                {{ Form::select('parent_id', $categories, null, [ 'class' => 'form-control' ]) }}
            </div><!--col-lg-10-->
        </div><!--form control-->

        <div class="form-group">
            {{ Form::label('description', trans('validation.attributes.backend.catalog.categories.description'), ['class' => 'col-lg-2 control-label']) }}

            <div class="col-lg-10">
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.catalog.categories.description')]) }}
            </div><!--col-lg-10-->
        </div><!--form control-->
    </div><!-- /.box-body -->
</div><!--box-->
<div class="box box-info">
    <div class="box-body">
        <div class="pull-left">
            {{ link_to_route('admin.catalog.category.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
        </div><!--pull-left-->

        <div class="pull-right">
            {{ Form::submit(isset($model) ? trans('buttons.general.crud.update') : trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-sm']) }}
        </div><!--pull-right-->

        <div class="clearfix"></div>
    </div><!-- /.box-body -->
</div><!--box-->

{{ Form::close() }}