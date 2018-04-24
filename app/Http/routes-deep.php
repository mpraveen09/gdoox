<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 *@ Catalog Management routes (Categories, Attributes etc) ...-------------------------*/
Route::group(['prefix' => 'backend/catalog', 'namespace' => 'backend\catalog' ,'middleware' => 'permission' ], function () { 
    
    Route::get('attributes_search/{$term}',['uses' => 'AttributesController@getSearch','as' => 'attributes_search']);
    Route::resource('attributes', 'AttributesController',[
        'names' => [
            'index' => 'attributes.index',
            'edit' => 'attributes.edit',
            'show' => 'attributes.show',
            'update' => 'attributes.update',
            'create' => 'attributes.create',
            'store' => 'attributes.store'
            ],
        'except' => ['destroy']
    ]);
    
    Route::any('attributes/assign/{id}', array('as'=>'attributes.assign','uses'=> 'AttributesController@assignCategories'));
  //Route::any('attributes/update_assign_cat/{id}', array('as'=>'attributes.update_assign_cat','uses'=> 'AttributesController@updateAssignedCategories'));
    
    Route::resource('attributesassoc', 'AttributesAssocController',[
        'names' => [
            'index' => 'attributesassoc.index',
            'edit' => 'attributesassoc.edit',
            'show' => 'attributesassoc.show',
            'update' => 'attributesassoc.update',
            'create' => 'attributesassoc.create',
            'store' => 'attributesassoc.store'
            ],
        'except' => ['destroy']
        ]);

    Route::resource('attributestype', 'AttributesTypeController',[
        'names' => [
            'index' => 'attributestype.index',
            'edit' => 'attributestype.edit',
            'show' => 'attributestype.show',
            'update' => 'attributestype.update',
            'create' => 'attributestype.create',
            'store' => 'attributestype.store'
            ],
        'except' => ['destroy']
    ]);
    
    Route::resource('dropdownoptions', 'DropdownOptionsController',[
        'names' => [
            'index' => 'dropdownoptions.index',
            'edit' => 'dropdownoptions.edit',
            'show' => 'dropdownoptions.show',
            'update' => 'dropdownoptions.update',
            'create' => 'dropdownoptions.create',
            'store' => 'dropdownoptions.store'
            ],
        'except' => ['destroy']
        ]);
    
    Route::resource('categories', 'CategoriesController',[
        'names' => [
            'index' => 'categories.index',
            'edit' => 'categories.edit',
            'show' => 'categories.show',
            'update' => 'categories.update',
            'create' => 'categories.create',
            'store' => 'categories.store'
            ],
        'except' => ['destroy']
        ]);    
    
    Route::any('categories/assign/{id}', array('as'=>'categories.assign','uses'=> 'CategoriesController@assignAttributes'));
   // Route::any('categories/update_assign_attr/{id}', array('as'=>'categories.update_assign_attr','uses'=> 'CategoriesController@updateAssignedAttributes'));
    Route::any('backend/catalog/get_attributes', array('as'=>'categories.get_attributes','uses'=> 'CategoriesController@attrSearch'));
    
    
   // Add Products
    Route::group(['prefix' => '', 'namespace' => 'products' , 'middleware' => 'permission' ], function () {
     // Route::get('products/select_cat/{purpose?}', array('as' => 'select_cat.index', 'uses' => 'SelectCategoriesController@index'));
        Route::get('products/select_cat/sell', array('as' => 'select_cat_to_sell.index', 'uses' => 'SelectCategoriesController@index'));
        Route::get('procurements/select_cat/buy', array('as' => 'select_cat_to_buy.index', 'uses' => 'SelectCategoriesController@index'));
       // Fetch sub cats of given parent
        Route::get('products/fetchsubcats', array('as' => 'fetchsubcats', 'uses' => 'SelectCategoriesController@fetchSubCats', 'middleware' => 'permission' ));
        //Fetch parent/ancestors of given category id
        Route::get('products/fetchcatancestors', array('as' => 'fetchcatancestors', 'uses' => 'SelectCategoriesController@fetchCatAncestors', 'middleware' => 'permission' ));

//      Route::resource('product', 'ProductsController',[
//            'names' => [
//                'index' => 'product.index',
//                //'edit' => 'product.edit',
//                'show' => 'product.show',
//                'update' => 'product.update',
//                //'create' => 'product.create',
//                'store' => 'product.store'
//                ],
//            'except' => ['destroy', 'edit']
//        ]);
        
        Route::any('products/add/sell', array('as' => 'products/add', 'uses' => 'ProductsController@add', 'middleware' => 'permission'));
        Route::any('products/save', array('as' => 'products/save', 'uses' => 'ProductsController@store', 'middleware' =>  'permission'));
//      Route::any('products/list', array('as' => 'products/list', 'uses' => 'ViewProductsController@indexAllProducts', 'middleware' => 'permission' ));
        Route::any('products/show/{id}', array('as' => 'products/show', 'uses' => 'ProductsController@show', 'middleware' => 'permission' ));
        Route::any('products/edit/{id}', array('as' => 'products/edit', 'uses' => 'ProductsController@edit', 'middleware' => 'permission' ));
        Route::any('products/add/procurement/buy', array('as' => 'products.add.buy', 'uses' => 'ProductsController@add', 'middleware' => 'permission'));
    });
});

Route::group(['prefix' => 'marketplace', 'namespace' => 'store' ], function () {
        Route::any('/', array('as' => 'marketplace', 'uses' => 'StoreController@index'));
//      Route::any('show/{id}', array('as' => 'store/show', 'uses' => 'StoreController@show'));
});

//Route::group(['prefix' => 'site', 'namespace' => 'store' ], function () {
//        Route::any('{shopid?}', array('as' => 'site/{shopid}', 'uses' => 'StoreController@marketplace'));
//        Route::any('show/{id}', array('as' => 'store/show', 'uses' => 'StoreController@show'));
//});

Route::group(['prefix' => 'site', 'namespace' => 'store' ], function () {
    Route::any('/{shopid}', array('as' => 'site', 'uses' => 'StoreController@siteHome'));
    Route::any('/{shopid}/show/{id}/{selected?}', array('as' => '{shopid}/show/', 'uses' => 'StoreController@show'));
    Route::any('/{shopid}/page/businessinfo', array('as' => 'businessinfo.page', 'uses' => 'StoreController@BusinessInfoPage'));
    Route::any('/{shopid}/page/contact-us', array('as' => 'contact.page', 'uses' => 'StoreController@ContactPage'));
    
    Route::any('/{shopid}/page/companies-involved', array('as' => 'partners.page', 'uses' => 'StoreController@involvedPartners'));
     
    Route::any('/{shopid}/page/contact-us/message/send', array('as' => 'message.send', 'uses' => 'StoreController@sendmessage'));
    Route::any('/{shopid}/page/{pagename}/{id}', array('as' => 'cms.page', 'uses' => 'StoreController@pages'));
    Route::any('/{shopid}/page/product-catalog', array('as' => 'site.productcatalog.page', 'uses' => 'StoreController@ProductCatalog'));
    Route::any('/{shopid}/page/product-catalog/show/{id}', array('as' => 'site.productcatalog.show', 'uses' => 'StoreController@showproductcatalog'));

//  Personal Site details Routes-------------------------------

    Route::any('/{shopid}/page/job-details', array('as' => 'personal.job.page', 'uses' => 'StoreController@JobDetailPage'));
    Route::any('/{shopid}/page/contact', array('as' => 'personal.contact.page', 'uses' => 'StoreController@PersonalContact'));
    Route::any('/{shopid}/page/contact/personalsite-message/send', array('as' => 'personal.message.send', 'uses' => 'StoreController@PersonalContactEnquiry'));
  
});

  Route::any('/{shopid}/page/{pagename}/{id}/storetemp', array('as' => 'cms.storetemp', 'uses' => 'cms\ContentManagementController@storetemp'));
//url('backend/catalog/attributesassoc')}}/{{$attribute->id

Route::group(['prefix' => 'site', 'namespace' => 'sellerreview' ], function () {
    Route::any('/{shopid}/reviews/', array('as' => '{shopid}/reviews', 'uses' => 'SellerReviewController@allSellerReviews'));
});



Route::any('/underdev', array('as' => 'underdev', 'uses' => 'store\StoreController@underdev'));

Route::any('backend/catalog/products/variation', array('as' => 'products/variation', 'uses' => 'backend\catalog\products\ProductsController@verifyVariation'));
Route::any('backend/catalog/products/create-variation', array('as' => 'create.variation', 'uses' => 'backend\catalog\products\ProductsController@createVariation'));
Route::any('backend/catalog/products/{prodid}/edit-product', array('as' => 'productvariation.edit', 'uses' => 'backend\catalog\products\ProductsController@editProduct'));
Route::any('backend/catalog/procurement/search/product', array('as' => 'search.product', 'uses' => 'backend\catalog\products\ProductsController@searchProcurementProduct'));
Route::any('backend/catalog/products/verify/{id}/product-variation', array('as' => 'verify.variation', 'uses' => 'backend\catalog\products\ProductsController@verifyProductVariation'));
Route::any('backend/catalog/products/view-variation/{id}', array('as' => 'view.product.variation', 'uses' => 'backend\catalog\products\ProductsController@viewVariation'));
Route::any('backend/catalog/products/verify/{id}/update-product-variation', array('as' => 'update-product-variation', 'uses' => 'backend\catalog\products\ProductsController@updateProductVariation'));
Route::any('backend/catalog/products/verify/{id}/edit-product-variation', array('as' => 'edit-product-variation', 'uses' => 'backend\catalog\products\ProductsController@editVariation'));

//Commercial plan temp page

Route::get('plans', function () {
    return view('commercial_plans.index');
});


Route::group(['middleware' => [ 'permission']], function() {
    Route::resource('dashboard/gdoox/payment-method', 'subscription\SubscriptionGdooxPaypalPaymentController', [
        'names' => [
            'index' => 'gdoox-paypal.index',
            'edit' => 'gdoox-paypal.edit',
            'update' => 'gdoox-paypal.update'
        ],
        'except' => ['create','store','destroy']
    ]);    
});

Route::resource('backend/catalog/products/classifications/labels', 'backend\catalog\products\classifications\ProductClassificationsLabelsController', [
    'names' => [
        'index' => 'classifications_labels.index',
        'edit' => 'classifications_labels.edit',
        'create' => 'classifications_labels.create',
        'store' => 'classifications_labels.store',
        'update' => 'classifications_labels.update'
    ],
    'except' => ['destroy']
]);    



Route::any('backend/catalog/products/classifications/classify/{purpose?}', array('as' => 'products/classifications/classify', 'uses' => 'backend\dashboard\ViewProductsController@indexAllProducts'));
Route::any('backend/catalog/products/classifications/addproducts/{pid}', array('as' => 'products/classifications/addproduct', 'uses' => 'backend\catalog\products\classifications\ProductClassificationsLabelsController@addProductsLabel'));
Route::any('backend/catalog/products/classifications/storeproductlabel/', array('as' => 'products/classifications/storeproductlabel', 'uses' => 'backend\catalog\products\classifications\ProductClassificationsLabelsController@storeProductsLabel'));
Route::any('backend/catalog/products/classifications/productsinlabel/{clid}', array('as' => 'products/classifications/productsinlabel', 'uses' => 'backend\catalog\products\classifications\ProductClassificationsLabelsController@productsInLabel'));