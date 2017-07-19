<?php

Breadcrumbs::register('admin.page.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Page Management', route('admin.page.index'));
});


Breadcrumbs::register('admin.page.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.page.index');
    $breadcrumbs->push('Deleted Pages', route('admin.page.deleted'));
});

Breadcrumbs::register('admin.page.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.page.index');
    $breadcrumbs->push('Create Page', route('admin.page.create'));
});


Breadcrumbs::register('frontend.page.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.page.index');
    $breadcrumbs->push('View Page : ' . $model->name, route('frontend.page.show', $model));
});

Breadcrumbs::register('admin.page.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('frontend.page.show', $model);
    $breadcrumbs->push('Edit Page : ' . $model->name, route('admin.page.edit', $model));
});
