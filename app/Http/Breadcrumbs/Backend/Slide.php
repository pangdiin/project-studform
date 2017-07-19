<?php

Breadcrumbs::register('admin.slide.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Slide Management', route('admin.slide.index'));
});

Breadcrumbs::register('admin.slide.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.slide.index');
    $breadcrumbs->push('Create Slide', route('admin.slide.create'));
});

Breadcrumbs::register('admin.slide.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.slide.index');
    $breadcrumbs->push('Update Slide # ' . $model->id, route('admin.slide.edit', $model));
});
