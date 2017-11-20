<?php 
    $config->pages = new Paths($rootURL);
    $config->pages->index = $config->urls->root;
    $config->pages->account = $config->urls->root . 'user/account/';
    $config->pages->login = $config->urls->root . 'user/account/login/';
    $config->pages->userscreens = $config->urls->root . 'user/user-screens/';
    $config->pages->ajax = $config->urls->root . 'ajax/';
    $config->pages->ajaxjson = $config->urls->root . 'ajax/json/';
    $config->pages->ajaxload = $config->urls->root . 'ajax/load/';
    $config->pages->cart = $config->urls->root . 'cart/';
    $config->pages->customer = $config->urls->root . 'customers/';
    $config->pages->custinfo = $config->urls->root . 'customers/cust-info/';
    $config->pages->edit = $config->urls->root . 'edit/';
    $config->pages->editorder = $config->urls->root . 'edit/order/';
    $config->pages->editquote = $config->urls->root . 'edit/quote/';
    $config->pages->orderquote = $config->urls->root . 'edit/quote-to-order/';
    $config->pages->confirmorder = $config->urls->root . 'edit/order/confirm/';
    $config->pages->confirmquote = $config->urls->root . 'edit/quote/confirm/';
    $config->pages->print = $config->urls->root."print/";
    $config->pages->products = $config->urls->root . 'products/';
    $config->pages->iteminfo = $config->urls->root . 'products/item-info/';
    $config->pages->user = $config->urls->root . 'user/';
    $config->pages->usernotes = $config->urls->root . 'user/notes/';
    $config->pages->notes = $config->urls->root . 'notes/';
    $config->pages->usertasks = $config->urls->root . 'user/tasks/';
    $config->pages->tasks = $config->urls->root . 'tasks/';
    $config->pages->taskschedule = $config->urls->root . 'tasks/schedule/';
    $config->pages->userpage = $config->urls->root . 'user/';
    $config->pages->dashboard = $config->urls->root . 'user/dashboard/';
    $config->pages->userconfigs = $config->urls->root . 'user/user-config/';
    $config->pages->orders = $config->urls->root . 'user/orders/';
    $config->pages->quotes = $config->urls->root . 'user/quotes/';
    $config->pages->actions = $config->urls->root . 'activity/';
    $config->pages->documentation = $config->urls->root . "documentation/";
    $config->pages->documentstorage = $config->documentstorage;
    $config->pages->vendor = $config->urls->root . "vendors/";
    $config->pages->vendorinfo = $config->urls->root . "vendors/vend-info/";