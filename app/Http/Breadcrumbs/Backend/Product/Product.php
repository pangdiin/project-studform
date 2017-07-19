<?php

Breadcrumbs::register('admin.product.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Products', route('admin.product.index'));
});

Breadcrumbs::register('admin.product.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.product.index');
    $breadcrumbs->push('Create', route('admin.product.create'));
});

Breadcrumbs::register('frontend.product.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.product.index');
    $breadcrumbs->push('View : ' .str_limit( $model->name, 15, '...'), route('frontend.product.show', $model));
});

Breadcrumbs::register('admin.product.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('frontend.product.show', $model);
    $breadcrumbs->push('Edit : ' .str_limit( $model->name, 15, '...'), route('admin.product.edit', $model));
});

Breadcrumbs::register('admin.gallery.product.index', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.product.edit', $model);
    $breadcrumbs->push('Gallery : ' .str_limit( $model->name, 15, '...'), route('admin.gallery.product.index', $model));
});

Breadcrumbs::register('admin.product.brochure.index', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.product.edit', $model);
    $breadcrumbs->push('Brochure : ' .str_limit( $model->name, 15, '...'), route('admin.product.brochure.index', $model));
});


