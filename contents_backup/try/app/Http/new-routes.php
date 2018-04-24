<?php
    Route::any('dashboard/business/company-network/select-network', array('as' => 'import-net-products.list_company', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@listCompany'));
    Route::any('dashboard/business/company-network/view-products', array('as' => 'import-net-products.view_products', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@viewProducts'));
    Route::any('dashboard/business/company-network/import-products', array('as' => 'import_net_product.import_products', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@importProductsToNetwork'));

    Route::any('dashboard/product-mgmt/view-product-configuration', array('as' => 'view_item_configuration', 'uses' => 'backend\catalog\products\MultiItemProductsController@viewProductConfiguration'));

    Route::any('dashboard/business/company-network/assign-network-site', array('as' => 'company.network.assign.site', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@viewSites'));
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