<?php

Breadcrumbs::register('admin.block.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Block Management', route('admin.block.index'));
});

Breadcrumbs::register('admin.block.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.block.index');
    $breadcrumbs->push('Deleted Blocks', route('admin.block.deleted'));
});


Breadcrumbs::register('admin.block.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.block.index');
    $breadcrumbs->push('Create Block', route('admin.block.create'));
});


Breadcrumbs::register('admin.block.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.block.index');
    $breadcrumbs->push('Edit Block : ' . $model->name, route('admin.block.edit', $model));
});
