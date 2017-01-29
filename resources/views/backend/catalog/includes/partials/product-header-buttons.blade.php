<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.catalog.product.index', trans('menus.backend.catalog.products.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('admin.catalog.product.create', trans('menus.backend.catalog.products.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    {{ link_to_route('admin.catalog.product.deactivated', trans('menus.backend.catalog.products.deactivated'), [], ['class' => 'btn btn-warning btn-xs']) }}
    {{ link_to_route('admin.catalog.product.deleted', trans('menus.backend.catalog.products.deleted'), [], ['class' => 'btn btn-danger btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.catalog.products.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('admin.catalog.product.index', trans('menus.backend.catalog.products.all')) }}</li>
            <li>{{ link_to_route('admin.catalog.product.create', trans('menus.backend.catalog.products.create')) }}</li>
            <li class="divider"></li>
            <li>{{ link_to_route('admin.catalog.product.deactivated', trans('menus.backend.catalog.products.deactivated')) }}</li>
            <li>{{ link_to_route('admin.catalog.product.deleted', trans('menus.backend.catalog.products.deleted')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>