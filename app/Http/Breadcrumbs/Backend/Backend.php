<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin.dashboard'));
});

require __DIR__.'/Search.php';
require __DIR__.'/Access.php';
require __DIR__.'/Setting.php';
require __DIR__.'/Inquiry/Inquiry.php';
require __DIR__.'/Tag/Tag.php';
require __DIR__.'/Product/Product.php';
require __DIR__.'/Project/Project.php';
require __DIR__.'/Slide.php';
require __DIR__.'/Page.php';
require __DIR__.'/Block.php';
require __DIR__.'/View/View.php';
require __DIR__.'/Menu.php';
require __DIR__.'/LogViewer.php';

Breadcrumbs::register('admin.newsletter.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Newsletter Management', route('admin.newsletter.index'));
});
