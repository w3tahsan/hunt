<?php

use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('index', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('index'));
});

Breadcrumbs::for('cart', function (BreadcrumbTrail $trail): void {
    $trail->parent('index');
    $trail->push('Cart', route('cart'));
});
Breadcrumbs::for('product.details', function (BreadcrumbTrail $trail): void {
    $trail->parent('index');
    $trail->push('Product');
    $trail->push('Product Details', route('product.details', ''));
});
