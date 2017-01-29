<?php

Breadcrumbs::register('admin.catalog.category.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('labels.backend.catalog.categories.management'), route('admin.catalog.category.index'));
});

Breadcrumbs::register('admin.catalog.category.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.catalog.category.index');
    $breadcrumbs->push(trans('menus.backend.catalog.categories.create'), route('admin.catalog.category.create'));
});

Breadcrumbs::register('admin.catalog.category.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.catalog.category.index');
    $breadcrumbs->push(trans('menus.backend.catalog.categories.view'), route('admin.catalog.category.show', $id));
});

Breadcrumbs::register('admin.catalog.category.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.catalog.category.index');
    $breadcrumbs->push(trans('menus.backend.catalog.categories.edit'), route('admin.catalog.category.edit', $id));
});