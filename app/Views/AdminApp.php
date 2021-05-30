<?php

namespace NinjaPopups\Views;
use NinjaPopups\Views\View;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render Admin
 * @since 1.0.0
 */
class AdminApp
{
    public function bootView()
    {
        View::render('Admin.AdminView');
    }
}
