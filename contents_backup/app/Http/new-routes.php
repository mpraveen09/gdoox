<?php

// Company Network

    Route::any('dashboard/business/company-network/assign-network-site', array('as' => 'company.network.assign.site', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@viewSites','middleware'=>'permission'));
    Route::any('dashboard/business/company-network/select-network', array('as' => 'import-net-products.list_company', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@listCompany','middleware'=>'permission'));
        
// End Company Network

    Route::any('dashboard/business/company-network/view-products', array('as' => 'import-net-products.view_products', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@viewProducts'));
    Route::any('dashboard/business/company-network/import-products', array('as' => 'import_net_product.import_products', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@importProductsToNetwork'));

    Route::any('dashboard/product-mgmt/view-product-configuration', array('as' => 'view_item_configuration', 'uses' => 'backend\catalog\products\MultiItemProductsController@viewProductConfiguration'));
    Route::any('dashboard/business/company-network/store-network-site', array('as' => 'company.network.store.site', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@storeAssignedNetworkSite'));

    Route::any('dashboard/ecosystem/products/toggle/{id}', array('as' => 'ecosys.products.toggle', 'uses' => 'backend\catalog\products\ProductsController@toggle'));
    Route::any('dashboard/company-network/products/toggle/{id}', array('as' => 'network.products.toggle', 'uses' => 'backend\catalog\products\ProductsController@toggle'));

    // Route::any('dashboard/share/company-network/products/{site_slug}/{inviter}', array('as' => 'invited-company-partners.list_products', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@listProducts'));
    Route::any('dashboard/share/company-network/share_product', array('as' => 'invited-company-partners.share_product', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@shareProduct'));

    Route::any('dashboard/business/company-network/add-site', array('as' => 'company.network.add.site', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@addSite'));
    Route::any('dashboard/business/company-network/update-site', array('as' => 'company.network.update.site', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@updateSite'));
   
    Route::any('dashboard/business-partner/business-ecosystem/store/ecosystem-site', array('as' => 'ecosystem.store.site', 'uses' => 'backend\dashboard\business_partners\BusinessEcosystemController@storeEcosystemSite'));
    Route::any('dashboard/business-partner/business-ecosystem/update/ecosystem-site', array('as' => 'update.ecosystem.site', 'uses' => 'backend\dashboard\business_partners\BusinessEcosystemController@updateEcosystemSite'));
    Route::get('bid', array('as'=>'bid','uses'=> 'backend\bidding\ProductBidController@addBidAmount'));
    Route::get('view_product_bids', array('as'=>'view_product_bids','uses'=> 'backend\bidding\ProductBidController@viewProductBids'));
   
    Route::any('dashboard/products/auction-bids', array('as'=>'auction.index','uses'=> 'backend\bidding\ProductBidController@indexAuctionBids'));
    Route::any('dashboard/products/reverse-auction-bids', array('as'=>'reverse-auction.index','uses'=> 'backend\bidding\ProductBidController@indexRevAuctionBids'));
    
    Route::any('dashboard/products/user-auction-bids', array('as'=>'user-auction.index','uses'=> 'backend\bidding\ProductBidController@indexUserAuctionBids'));
    Route::any('dashboard/products/user-reverse-auction-bids', array('as'=>'user-reverse-auction.index','uses'=> 'backend\bidding\ProductBidController@indexUserRevAuctionBids'));

    Route::resource('dashboard/advertising/campaigns', 'backend\campaigns\CampaignsController', [
      'names' => [
          'index' => 'campaigns.index',
          'create' => 'campaigns.create',
          'store' => 'campaigns.store',
          'edit' => 'campaigns.edit',
          'update' => 'campaigns.update',
        ]
    ]);
    
    Route::any('dashboard/advertising/request/campaigns', array('as'=>'campaigns.request','uses'=> 'backend\campaigns\CampaignsController@campaignRequest'));
    Route::any('dashboard/advertising/request/store-campaigns', array('as'=>'store.campaigns.request','uses'=> 'backend\campaigns\CampaignsController@storeCampaignRequest'));
//  Route::any('dashboard/advertising/request/index-campaigns', array('as'=>'index.campaigns.request','uses'=> 'backend\campaigns\CampaignsController@indexCampaignRequest'));
    Route::any('dashboard/advertising/request/edit-campaign/{id}', array('as'=>'edit.campaigns.request','uses'=> 'backend\campaigns\CampaignsController@editCampaignRequest'));
    Route::any('dashboard/advertising/request/update-campaign/{id}', array('as'=>'update.campaign.requests','uses'=> 'backend\campaigns\CampaignsController@updateCampaignRequest'));
    
    
// Add Bid to Cart.
    Route::get('add_bid_to_cart', array('as'=>'add_bid_to_cart','uses'=> 'cart\ShoppingCartController@addBidToCart'));
    
    
// B2B Price Requests

    Route::resource('products/b2b/price-request', 'b2b_price_request\B2BPriceRequestController', [
      'names' => [
          'index' => 'price-request.index',
          'create' => 'price-request.create',
          'store' => 'price-request.store'
        ]
    ]);
    
    Route::any('products/b2b/product_price_access/{id}', array('as'=>'approve.prod.price_req','uses'=> 'b2b_price_request\B2BPriceRequestController@approveProductPriceReq'));
    Route::any('products/b2b/store_price_access/{id}', array('as'=>'approve.store.price_req','uses'=> 'b2b_price_request\B2BPriceRequestController@approveStorePriceReq'));
    Route::any('plans/info', array('as'=>'account.plans','uses'=> 'payment\PaymentController@accountPlans'));
    
    
    // New Routes..
    Route::resource('/account/payment/', 'payment\PaymentController', [
      'names' => [
          'index' => 'account-payment.index',
          'create' => 'account-payment.create',
          'store' => 'account-payment.store'
        ]
    ]);
    
    
    Route::any('account/payment/proceed-to-payment', array('as'=>'proceed-to-payment','uses'=> 'payment\PaymentController@proceedToPayment'));
    Route::any('account/payment/plan-configure', array('as'=>'plan-configure','uses'=> 'payment\PaymentController@planConfigure'));
    
    Route::any('account/payment/response', array('as'=>'account-payment.response','uses'=> 'payment\PaymentController@paymentResponse'));
    Route::any('account/payment/cancel', array('as'=>'account-payment.cancel','uses'=> 'payment\PaymentController@paymentCancel'));
    
    

    Route::any('product/payment/success', array('as'=>'product-payment.success','uses'=> 'checkout\CheckoutController@paymentSuccess'));
    
    Route::resource('platform/subscription-discounts', 'subscription\SubscriptionDiscountController', [
        'names' => [
            'index' => 'gdoox-subscription.index',
            'create' => 'gdoox-subscription.create',
            'store' => 'gdoox-subscription.store',
            'edit' => 'gdoox-subscription.edit',
            'update' => 'gdoox-subscription.update'
        ]
    ]);

    Route::resource('platform/subscription-charges', 'subscription\SubscriptionChargesController', [
        'names' => [
            'index' => 'subscription-charges.index',
            'create' => 'subscription-charges.create',
            'store' => 'subscription-charges.store',
            'edit' => 'subscription-charges.edit',
            'update' => 'subscription-charges.update'
        ]
    ]);
    
    
    Route::resource('platform/country/subscription-charges', 'subscription\CountrySubsChargesController', [
        'names' => [
            'index' => 'country-subscription.index',
            'create' => 'country-subscription.create',
            'store' => 'country-subscription.store',
            'edit' => 'country-subscription.edit',
            'update' => 'country-subscription.update'
        ]
    ]);
    
    
    Route::any('account/payment/ipn', array('as'=>'account-payment.ipn','uses'=> 'payment\PaymentController@fetchIPN'));
    Route::any('account/payment/success', array('as'=>'account-payment.success','uses'=> 'payment\PaymentController@paymentSuccess'));
    
    
    
    Route::resource('subscription/plan_configuration', 'subscription\GdooxSubscriptionPlanConfigurationController', [
        'names' => [
            'index' => 'plan_configuration.index',
            'create' => 'plan_configuration.create',
            'store' => 'plan_configuration.store',
            'edit' => 'plan_configuration.edit',
            'update' => 'plan_configuration.update'
        ]
    ]);    

    Route::resource('subscription/plan_configuration_country', 'subscription\GdooxSubscriptionPlanConfigurationCountryController', [
        'names' => [
            'index' => 'plan_configuration_country.index',
            'create' => 'plan_configuration_country.create',
            'store' => 'plan_configuration_country.store',
            'edit' => 'plan_configuration_country.edit',
            'update' => 'plan_configuration_country.update',
            'show' => 'plan_configuration_country.show'
        ]
    ]);     


Route::any('backend/dashboard/show-invited-users', array('as'=>'show-invited-users','uses'=> 'backend\dashboard\InviteUsersController@showInvited'));

