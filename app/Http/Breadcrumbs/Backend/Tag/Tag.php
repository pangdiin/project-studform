<?php

Breadcrumbs::register('admin.tag.index', function ($breadcrumbs, $type) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push( $type['name'] . ' Tag Management', route('admin.tag.index', $type['route']));
});


Breadcrumbs::register('admin.tag.show', function ($breadcrumbs, $tag) {
    $breadcrumbs->parent('admin.tag.index');
    $breadcrumbs->push('View Tag ' . $tag->name, route('admin.tag.show', $tag->id));
});

Breadcrumbs::register('admin.tag.edit', function ($breadcrumbs, $type, $tag) {
    $breadcrumbs->parent('admin.tag.index', $type);
    $breadcrumbs->push('Edit Tag ' . $tag, route('admin.tag.edit', [$type['route'], $tag]));
});