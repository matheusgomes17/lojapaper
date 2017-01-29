@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.catalog.products.management') . ' | ' . trans('labels.backend.catalog.products.deactivated'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('labels.backend.catalog.products.management') }}
        <small>{{ trans('labels.backend.catalog.products.deactivated') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.catalog.products.deactivated') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.catalog.includes.partials.product-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="products-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.catalog.products.table.name') }}</th>
                            <th>{{ trans('labels.backend.catalog.products.table.code') }}</th>
                            <th>{{ trans('labels.backend.catalog.products.table.category') }}</th>
                            <th>{{ trans('labels.backend.catalog.products.table.create') }}</th>
                            <th>{{ trans('labels.backend.catalog.products.table.last_updated') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script>
        $(function() {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.catalog.product.get") }}',
                    type: 'post',
                    data: {status: 0, trashed: false}
                },
                columns: [
                    {data: 'name', name: '{{config('catalog.products_table')}}.name', render: $.fn.dataTable.render.text()},
                    {data: 'code', name: '{{config('catalog.products_table')}}.code'},
                    {data: 'category', name: '{{config('catalog.categories_table')}}.name', sortable: false},
                    {data: 'created_at', name: '{{config('catalog.products_table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('catalog.products_table')}}.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@stop
