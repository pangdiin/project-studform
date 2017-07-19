<?php

Breadcrumbs::register('admin.setting.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Settings', route('admin.setting.index'));
});

Breadcrumbs::register('admin.setting.show', function ($breadcrumbs, $key) {
    $breadcrumbs->parent('admin.setting.index');
    $group = config('setting')[$key];
    $breadcrumbs->push($group['name'], route('admin.setting.show', $key));
});
