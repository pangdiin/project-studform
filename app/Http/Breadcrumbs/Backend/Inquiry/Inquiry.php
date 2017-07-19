<?php

Breadcrumbs::register('admin.inquiry.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Enquiry Management', route('admin.inquiry.index'));
});


Breadcrumbs::register('admin.inquiry.show', function ($breadcrumbs, $inquiry) {
    $breadcrumbs->parent('admin.inquiry.index');
    $breadcrumbs->push('View Enquiry', route('admin.inquiry.show', $inquiry->id));
});