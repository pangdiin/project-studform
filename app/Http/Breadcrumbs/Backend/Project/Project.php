<?php

Breadcrumbs::register('admin.project.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Project Management', route('admin.project.index'));
});

Breadcrumbs::register('admin.project.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.project.index');
    $breadcrumbs->push('Create Project', route('admin.project.create'));
});

Breadcrumbs::register('frontend.project.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.project.index');
    $breadcrumbs->push('View Project : ' . $model->name, route('frontend.project.show', $model));
});


Breadcrumbs::register('admin.project.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.project.index');
    $breadcrumbs->push('Edit Project : ' . $model->name, route('admin.project.edit', $model));
});

Breadcrumbs::register('admin.gallery.project.index', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('admin.project.edit', $model);
    $breadcrumbs->push('Gallery : ' .str_limit( $model->name, 15, '...'), route('admin.gallery.project.index', $model));
});


