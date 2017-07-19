<?php

Breadcrumbs::register('admin.view.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('View Management', route('admin.view.index'));
});


Breadcrumbs::register('admin.view.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.view.index');
    $breadcrumbs->push('Deleted', route('admin.view.deleted'));
});

Breadcrumbs::register('admin.view.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.view.index');
    $breadcrumbs->push('Create', route('admin.view.create'));
});


// Breadcrumbs::register('frontend.view.show', function ($breadcrumbs, $model) {
//     $breadcrumbs->parent('admin.view.index');
//     $breadcrumbs->push('View : ' . $model->name, route('frontend.view.show', $model));
// });

Breadcrumbs::register('admin.view.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.view.index');
    // $breadcrumbs->parent('frontend.view.show', $model);
    $breadcrumbs->push('Edit : ' . $model->name, route('admin.view.edit', $model));
});
