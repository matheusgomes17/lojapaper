<?php

Breadcrumbs::register('admin.catalog.product.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('labels.backend.catalog.products.management'), route('admin.catalog.product.index'));
});

Breadcrumbs::register('admin.catalog.product.deactivated', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.catalog.product.index');
    $breadcrumbs->push(trans('menus.backend.catalog.products.deactivated'), route('admin.catalog.product.deactivated'));
});

Breadcrumbs::register('admin.catalog.product.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.catalog.product.index');
    $breadcrumbs->push(trans('menus.backend.catalog.products.deleted'), route('admin.catalog.product.deleted'));
});

Breadcrumbs::register('admin.catalog.product.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.catalog.product.index');
    $breadcrumbs->push(trans('menus.backend.catalog.products.create'), route('admin.catalog.product.create'));
});

Breadcrumbs::register('admin.catalog.product.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.catalog.product.index');
    $breadcrumbs->push(trans('menus.backend.catalog.products.view'), route('admin.catalog.product.show', $id));
});

Breadcrumbs::register('admin.catalog.product.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.catalog.product.index');
    $breadcrumbs->push(trans('menus.backend.catalog.products.edit'), route('admin.catalog.product.edit', $id));
});