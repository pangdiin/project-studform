<?php

Breadcrumbs::register('admin.menu.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Menu Management', route('admin.menu.index'));
});

Breadcrumbs::register('admin.menu.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.menu.index');
    $breadcrumbs->push('Create Menu', route('admin.menu.create'));
});

Breadcrumbs::register('admin.menu.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.menu.index');
    $breadcrumbs->push('Update Menu # ' . $model->name, route('admin.menu.edit', $model));
});
