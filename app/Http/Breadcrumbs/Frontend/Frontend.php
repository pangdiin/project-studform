<?php

use App\Models\Order\Order;

Breadcrumbs::register('frontend.user.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('frontend.user.dashboard'));
});



Breadcrumbs::register('frontend.user.account', function ($breadcrumbs) {
    $breadcrumbs->parent('frontend.user.dashboard');
    $breadcrumbs->push('Account', route('frontend.user.account'));
});

Breadcrumbs::register('frontend.order.index', function ($breadcrumbs, $type) {
    $breadcrumbs->parent('frontend.user.dashboard');
    $breadcrumbs->push( $type['name'] . ' Commitments', route('frontend.order.index', $type['route']));
});



Breadcrumbs::register('frontend.order.create', function ($breadcrumbs, $type) {
    $breadcrumbs->parent('frontend.order.index', $type);
    $breadcrumbs->push('Create '. $type['name'] .' Order', route('frontend.order.create', $type['route']));
});

Breadcrumbs::register('frontend.order.show', function ($breadcrumbs, $type, $order) {
    $breadcrumbs->parent('frontend.order.index', $type);
    $breadcrumbs->push( 'Order # ' . $order->order_number, route('frontend.order.show', [$type['route'], $order->id]));
});


Breadcrumbs::register('frontend.order.edit', function ($breadcrumbs, $type, $order) {
    $breadcrumbs->parent('frontend.order.show', $type, $order);
    $breadcrumbs->push( 'Edit Order # ' . $order->order_number, route('frontend.order.edit', [$type['route'], $order]));
});