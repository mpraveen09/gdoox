<?php
        Route::group(['middleware' => 'permission'], function() {
        Route::any('backend/catalog/cat_search', array('as'=>'cat_search','uses'=> 'backend\catalog\CategoriesController@categorySearch'));
        Route::any('backend/catalog/auto_search_cat', array('as'=>'auto_search_cat','uses'=> 'backend\catalog\CategoriesController@autoCatSearch'));
        Route::any('backend/catalog/attr_search', array('as'=>'attr_search','uses'=> 'backend\catalog\AttributesController@attributeSearch'));
        Route::any('backend/catalog/auto_search_attr', array('as'=>'auto_search_attr','uses'=> 'backend\catalog\AttributesController@autoAttrSearch'));
        Route::get('backend/catalog/products/searchcategory', array('as' => 'searchcategory', 'uses' => 'backend\catalog\products\SelectCategoriesController@searchCategory'));
        Route::get('backend/catalog/products/search_product_cat', array('as' => 'search_product_cat', 'uses' => 'backend\catalog\products\SelectCategoriesController@searchProductCategory'));
        Route::any('dashboard/show/user_search', array('as'=>'user_search','uses'=> 'backend\dashboard\UsersController@userSearch'));
        Route::any('search-business', array('as'=>'search-business','uses'=> 'backend\dashboard\SearchBusinessInfoController@index'));
        Route::any('company-details/{id}', array('as'=>'company-details/{id}','uses'=> 'backend\dashboard\SearchBusinessInfoController@show'));
        Route::any('auto_search_shop_categ', array('as'=>'auto_search_shop_categ','uses'=> 'store\StoreController@autoShopCategorySearch'));
        Route::any('auto_search_all', array('as'=>'auto_search_all','uses'=> 'store\StoreController@autoSearchAllCategory'));
        Route::any('auto_search_shop_all_categ', array('as'=>'auto_search_shop_all_categ','uses'=> 'store\StoreController@autoShopAllCategorySearch'));
        Route::get('add_to_cart', array('as'=>'add_to_cart','uses'=> 'cart\ShoppingCartController@addToCart'));
        Route::get('view_cart/{shopid?}', array('as'=>'view_cart','uses'=> 'cart\ShoppingCartController@viewCart'));
        Route::any('cart_add_qty', array('as'=>'cart_add_qty','uses'=> 'cart\ShoppingCartController@addQuantity'));
        Route::any('cart_remove_item', array('as'=>'cart_remove_item','uses'=> 'cart\ShoppingCartController@removeItem'));
        Route::any('view_cart_list', array('as'=>'view_cart_list','uses'=> 'cart\ShoppingCartController@listCart'));
        Route::get('add_to_wishlist', array('as'=>'add_to_wishlist','uses'=> 'cart\ShoppingCartController@addToWishlist'));
        Route::any('show-wishlist', array('as'=>'show-wishlist','uses'=> 'cart\ShoppingCartController@showWishList'));
        Route::any('remove_wishlist_item', array('as'=>'remove_wishlist_item','uses'=> 'cart\ShoppingCartController@removeWishListItem'));
        Route::any('abandoned_cart', array('as'=>'abandoned_cart','uses'=> 'cart\ShoppingCartController@abandonedCart'));
        Route::any('abandoned_cart/view/{shopid}/{cartid}', array('as'=>'view_abandoned_cart','uses'=> 'cart\ShoppingCartController@abandonedCartProduct'));
});
        

//Route::group(['prefix' => 'abandoned_cart', 'namespace' => 'cart' ], function () {
//    Route::any('/{shopid}', array('as' => 'abandoned_cart', 'uses' => 'ShoppingCartController@abandonedCartProducts'));
//});

Route::group(['prefix' => '','middleware' => 'permission'], function() {
Route::resource('cms', 'cms\ContentManagementController',[
    'names' => [
        'index' => 'cms.index',
        'edit' => 'cms.edit',
        'show' => 'cms.show',
        'update' => 'cms.update',
        'create' => 'cms.create',
        'store' => 'cms.store'
        ],
    'except' => ['destroy']
    ]);
});

Route::any('cms/page/{site}', array('as'=>'cms.site.pages', 'uses'=>'cms\ContentManagementController@pages'));
Route::resource('userreview', 'userreview\UserReviewController',[
    'names' => [
        'index' => 'userreview.index',
        'edit' => 'userreview.edit',
        'show' => 'userreview.show',
        'update' => 'userreview.update',
        'create' => 'userreview.create',
        'store' => 'userreview.store'
        ],
    'except' => ['destroy']
]); 


Route::any('/write_review/{shopid}/{prodid}', array('as'=>'write_review','uses'=> 'userreview\UserReviewController@writeReview'));

Route::resource('sellerreview', 'sellerreview\SellerReviewController',[
        'names' => [
            'index' => 'sellerreview.index',
            'edit' => 'sellerreview.edit',
            'show' => 'sellerreview.show',
            'update' => 'sellerreview.update',
            'create' => 'sellerreview.create',
            'store' => 'sellerreview.store'
            ],
        'except' => ['destroy']
     ]); 
Route::group(['middleware' => 'permission'], function() {
Route::any('/seller_review/{shopid}/{prodid}', array('as'=>'seller_review','uses'=> 'sellerreview\SellerReviewController@sellerReview'));
Route::any('/seller_reviews/{shopid}', array('as'=>'seller_reviews','uses'=> 'sellerreview\SellerReviewController@allSellerReviews'));
Route::any('/seller_review_details/{userid}/{shopid}/{prodid}', array('as'=>'seller_review_details','uses'=> 'sellerreview\SellerReviewController@sellerReviewDetails'));

Route::any('productcatalog', array('as'=>'productcatalog','uses'=> 'backend\productcatalog\ProductCatalogController@index'));
Route::any('productcatalog/addcatalog/{store}', array('as'=>'addcatalog/{store}','uses'=> 'backend\productcatalog\ProductCatalogController@addCatalog'));
Route::any('certificationlogos', array('as'=>'certificationlogos','uses'=> 'backend\certificationlogos\CertificationLogosController@index'));
Route::any('certificationlogos/addlogos/{store}', array('as'=>'addlogos/{store}','uses'=> 'backend\certificationlogos\CertificationLogosController@addLogos'));
});

Route::group(['prefix' => 'backend/', 'namespace' => 'backend\productcatalog' ,'middleware' => 'permission' ], function () {
    Route::resource('productcatalog', 'ProductCatalogController',[
        'names' => [
            'edit' => 'productcatalog.edit',
            'update' => 'productcatalog.update',
            'show' => 'productcatalog.show',
            'delete' => 'productcatalog.delete',
            'store' => 'productcatalog.store'
            ],
        'except' => ['destroy']
        ]);     
});

Route::group(['prefix' => 'backend/', 'namespace' => 'backend\certificationlogos', 'middleware' => 'permission'], function () {
    Route::resource('certificationlogos', 'CertificationLogosController',[
        'names' => [  
            'edit' => 'certificationlogos.edit',
            'update' => 'certificationlogos.update',
            'show' => 'certificationlogos.show',
            'destroy' => 'certificationlogos.destroy',
            'store' => 'certificationlogos.store'
            ],
        ]);     
});

Route::group(['middleware' => 'permission'], function() {
Route::resource('distribution_network', 'distribution_network\DistributionNetworksController',[
    'names' => [
        'index' => 'distributionnetwork.index',
        'edit' => 'distributionnetwork.edit',
        'show' => 'distributionnetwork.show',
        'update' => 'distributionnetwork.update',
        'create' => 'distributionnetwork.create',
        'store' => 'distributionnetwork.store'
       ],
    'except' => ['destroy']
    ]); 
});

Route::group(['middleware' => 'permission'], function() {

Route::any('/view_network/{type}', array('as'=>'view_network','uses'=> 'distribution_network\DistributionNetworksController@viewNetwork'));
Route::any('search_network', array('as'=>'search_network','uses'=> 'distribution_network\DistributionNetworksController@searchNetwork'));
Route::any('auto_search_network', array('as'=>'auto_search_network','uses'=> 'distribution_network\DistributionNetworksController@autoNetworkSearch'));


 Route::resource('backend/business_sectors','backend\business_sectors\BusinessSectorsController',[
    'names'=>[
        'index' =>'business-sectors-index',
        'store'=>'business-sectors-store',
        'edit'=>'business-sectors-edit',
        'create'=>'business-sectors-create',
        'update'=>'business-sectors-update',
    ]
  ]);
});
 
Route::group(['prefix'=>'', 'namespace' => 'backend\dashboard','middleware' => 'permission' ], function(){ 
    Route::resource('dashboard/personal-sites','PersonalSiteController',[
        'names'=>[
            'index'=>'personal-sites-index',
            'store'=>'personal-sites-store',
            'edit'=>'personal-sites-edit',
            'create'=>'personal-sites-create',
            'update'=>'personal-sites-update',
        ]
    ]);
});

Route::group(['middleware' => 'permission'], function() {
 Route::resource('backend/general_info','backend\dashboard\UserGeneralInfoController',[
        'names'=>[
            'index' =>'general-info-index',
            'store'=>'general-info-store',
            'edit'=>'general-info-edit',
            'create'=>'general-info-create',
            'update'=>'general-info-update',
        ]
  ]);
 
 Route::resource('backend/professional_skills','backend\dashboard\UserProfessionalSkillsController',[
        'names'=>[
            'index' =>'professional-skills-index',
            'store'=>'professional-skills-store',
            'edit'=>'professional-skills-edit',
            'create'=>'professional-skills-create',
            'update'=>'professional-skills-update',
        ]
  ]);
 
 Route::resource('backend/other_info','backend\dashboard\UserOtherInfoController',[
        'names'=>[
            'index' =>'other-info-index',
            'store'=>'other-info-store',
            'edit'=>'other-info-edit',
            'create'=>'other-info-create',
            'update'=>'other-info-update',
        ]
  ]);
 
 Route::resource('backend/competencies','backend\dashboard\UserCompetenciesController',[
        'names'=>[
            'index' =>'competencies-index',
            'store'=>'competencies-store',
            'edit'=>'competencies-edit',
            'create'=>'competencies-create',
            'update'=>'competencies-update',
        ]
  ]);
 
 Route::resource('backend/personal/site','backend\dashboard\UserPersonalSitesController',[
        'names'=>[ 
            'index' =>'create-personal-site-index',
            'store'=>'create-personal-site-store',
            'edit'=>'create-personal-site-edit',
            'create'=>'create-personal-site-create',
            'update'=>'create-personal-site-update',
        ]
  ]);
 
  Route::resource('backend/about_us','backend\dashboard\UserAboutUsController',[
        'names'=>[
            'store'=>'personal-about-us-store',
            'edit'=>'personal-about-us-edit',
            'create'=>'personal-about-us-create',
            'update'=>'personal-about-us-update',
        ]
  ]);
  
  Route::resource('backend/references','backend\dashboard\personal_sites\UserReferencesController',[
        'names'=>[
            'store'=>'references-store',
            'edit'=>'references-edit',
            'create'=>'references-create',
            'update'=>'references-update',
        ]
  ]);
  
  Route::resource('backend/sponsors','backend\dashboard\personal_sites\UserSponsorsController',[
        'names'=>[
            'store'=>'sponsors-store',
            'edit'=>'sponsors-edit',
            'create'=>'sponsors-create',
            'update'=>'sponsors-update',
        ]
  ]);
  
  Route::resource('backend/sponsors','backend\dashboard\personal_sites\UserSponsorsController',[
        'names'=>[
            'store'=>'sponsors-store',
            'edit'=>'sponsors-edit',
            'create'=>'sponsors-create',
            'update'=>'sponsors-update',
        ]
  ]); 
});

Route::group(['prefix' => 'site', 'namespace' => 'store'], function () {
   Route::any('/{shopid}/page/computer-skills', array('as' => 'computerskills.page', 'uses' => 'StoreController@ComputerSkills'));
   Route::any('/{shopid}/page/other-skills', array('as' => 'otherskills.page', 'uses' => 'StoreController@OtherSkills'));
   Route::any('/{shopid}/page/other-info', array('as' => 'otherinfo.page', 'uses' => 'StoreController@OtherInfo'));
   Route::any('/{shopid}/page/languages', array('as' => 'languages.page', 'uses' => 'StoreController@UserLanguages'));
   Route::any('/{shopid}/page/education', array('as' => 'educationandtraining.page', 'uses' => 'StoreController@EducationAndTraining'));
   Route::any('/{shopid}/page/about-us', array('as' => 'aboutus.page', 'uses' => 'StoreController@AboutUs'));
   Route::any('/{shopid}/page/competencies', array('as' => 'site.competencies', 'uses' => 'StoreController@competencies'));
});

Route::group(['middleware' => 'permission'], function() {
    Route::any('dashboard/share/select_partner', array('as' => 'invited-business-partners.select_partner', 'uses' => 'backend\dashboard\business_partners\ShareProductsController@selectBusinessPartner'));
    Route::any('dashboard/share/products/{site_slug}/{inviter}', array('as' => 'invited-business-partners.list_products', 'uses' => 'backend\dashboard\business_partners\ShareProductsController@listProducts'));
    Route::any('dashboard/share/share_product', array('as' => 'invited-business-partners.share_product', 'uses' => 'backend\dashboard\business_partners\ShareProductsController@shareProduct'));
    Route::any('dashboard/share/unshare_product', array('as' => 'invited-business-partners.unshare_product', 'uses' => 'backend\dashboard\business_partners\ShareProductsController@unshareProduct'));
    Route::any('site/share/product', array('as' => 'share_this_product', 'uses' => 'backend\dashboard\business_partners\ShareProductsController@shareThisProduct'));
    Route::any('site/store/product', array('as' => 'store_shared_product', 'uses' => 'backend\dashboard\business_partners\ShareProductsController@storeSharedProduct'));
    Route::any('dashboard/business/ecosystem', array('as' => 'import-ecom-products.select_ecom', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@listBusinessEcom'));
    Route::any('dashboard/business/shared_sites', array('as' => 'import-ecom-products.select_shared_site', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@listSharedSites'));
    
    Route::any('dashboard/business/business-ecom/view-products', array('as' => 'import-ecom-products.view_products', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@viewProducts'));
    Route::any('dashboard/business/business-ecom/import-shared-products', array('as' => 'import.shared.product', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@importSharedProducts'));
    Route::any('dashboard/business/business-ecom/view-my-products', array('as' => 'ecom.view_my_products', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@viewMyProducts'));
    Route::any('dashboard/business/business-ecom/import-my-products', array('as' => 'ecom.import_my_products', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@importMyProducts'));
    
    Route::any('dashboard/business/business-ecom/import_products', array('as' => 'import-ecom-products.import_products', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@importProducts'));
    Route::any('dashboard/business/myecosystem', array('as' => 'import-ecom-products.list_company', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@listCompany'));
    Route::any('dashboard/business/my_sites', array('as' => 'import-ecom-products.list_site', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@listSites'));
    Route::any('dashboard/business/import_my_products', array('as' => 'import-ecom-products.import_my_products', 'uses' => 'backend\dashboard\business_partners\ImportEcomProductsController@importSiteProducts'));
});



Route::group(['middleware' => 'permission'], function() {
    Route::resource('crm/tasks', 'crm\CrmTasksController',[
        'names' => [
            'index'=>'tasks.index', 
            'create'=>'tasks.create',
            'edit' => 'tasks.edit',
            'update' => 'tasks.update',
            'show' => 'tasks.show',
            'store' => 'tasks.store'
        ],
    ]);
    
    Route::any('crm/tasks/search-task', array('as'=>'tasks.search_task','uses'=> 'crm\CrmTasksController@searchTask'));
    
    Route::resource('crm/users', 'crm\CrmUsersController',[
        'names' => [
            'index'=>'crm_users.index',
            'create'=>'crm_users.create',
            'edit' => 'crm_users.edit',
            'update' => 'crm_users.update',
            'show' => 'crm_users.show',
            'store' => 'crm_users.store'
        ],
    ]);
    
    Route::resource('crm/accounts', 'crm\CrmAccountsController',[
        'names' => [
            'index'=>'crm_accounts.index',
            'create'=>'crm_accounts.create',
            'edit' => 'crm_accounts.edit',
            'update' => 'crm_accounts.update',
            'show' => 'crm_accounts.show',
            'store' => 'crm_accounts.store'
        ],
    ]);
    
    Route::resource('crm/opportunities', 'crm\CrmOpportunitiesController',[
        'names' => [
            'index'=>'crm_opportunities.index',
            'create'=>'crm_opportunities.create',
            'edit' => 'crm_opportunities.edit',
            'update' => 'crm_opportunities.update',
            'show' => 'crm_opportunities.show',
            'store' => 'crm_opportunities.store'
        ],
    ]);
    
    // Route::any('crm/opportunity/search', array('as'=>'crm_opportunities.search_opportunity','uses'=> 'crm\CrmOpportunitiesController@searchOpportunity'));
    
    Route::resource('crm/groups', 'crm\CrmGroupsController',[
        'names' => [
            'index'=>'crm_groups.index',
            'create'=>'crm_groups.create',
            'edit' => 'crm_groups.edit',
            'update' => 'crm_groups.update',
            'show' => 'crm_groups.show',
            'store' => 'crm_groups.store'
        ],
    ]);
    
    Route::resource('crm/contacts', 'crm\CrmContactsController',[
        'names' => [
            'index'=>'crm_contacts.index',
            'create'=>'crm_contacts.create',
            'edit' => 'crm_contacts.edit',
            'update' => 'crm_contacts.update',
            'show' => 'crm_contacts.show',
            'store' => 'crm_contacts.store'
        ],
    ]);
});

Route::any('crm/manage/cart/product/create/{id}', array('as'=>'manage_in_crm','uses'=> 'crm\CrmOpportunitiesController@createProductOpportunity'));
Route::any('crm/manage/cart/product/store/{id}', array('as'=>'ab_cart_opportunities.store','uses'=> 'crm\CrmOpportunitiesController@storeProductOpportunity'));
Route::any('crm/manage/cart/product/update/{id}', array('as'=>'ab_cart_opportunities.update','uses'=> 'crm\CrmOpportunitiesController@updateProductOpportunity'));
Route::any('crm/manage/cart/product/index', array('as'=>'ab_cart_opportunities.index','uses'=> 'crm\CrmOpportunitiesController@indexProductOpportunity'));
Route::any('crm/manage/cart/product/create-opportunity/', array('as'=>'crm_ab_cart_opportunities.create','uses'=> 'crm\CrmOpportunitiesController@createCartProductOpportunity'));


Route::any('crm/contacts/delete', array('as'=>'contacts.delete','uses'=> 'crm\CrmContactsController@deleteContact'));
Route::any('checkout/payment/proceed', array('as'=>'checkout.payment_proceed','uses'=> 'checkout\CheckoutController@proceedToPayment'));

Route::group(['middleware' => [ 'permission']], function() {
    Route::any('crm/export/columns', array('as'=>'crm_contacts.columns','uses'=> 'crm\CrmContactsController@createColumns'));
    Route::any('crm/export/excel', array('as'=>'crm_contacts.create_excel','uses'=> 'crm\CrmContactsController@createExcel'));
    Route::any('crm/upload/excel', array('as'=>'crm_contacts.upload_excel','uses'=> 'crm\CrmContactsController@uploadExcel'));
    Route::any('crm/custom-export/excel', array('as'=>'crm_contacts.export_excel','uses'=> 'crm\CrmContactsController@exportExcel'));
    Route::any('crm/import/excel', array('as'=>'crm_contacts.import_excel','uses'=> 'crm\CrmContactsController@importExcel'));
    Route::any('crm/import/save-excel-data', array('as'=>'crm_contacts.save_excel_data','uses'=> 'crm\CrmContactsController@importExcelData'));
    Route::any('crm/export/columns/save', array('as'=>'crm_contacts.save_custom_fields','uses'=> 'crm\CrmContactsController@saveCustomFields'));
    
    Route::resource('crm/contact-groups', 'crm\CrmContactsGroupController',[
        'names' => [
            'index'=>'crm_contactsgroup.index',
            'create'=>'crm_contactsgroup.create',
            'edit' => 'crm_contactsgroup.edit',
            'update' => 'crm_contactsgroup.update',
            'show' => 'crm_contactsgroup.show',
            'store' => 'crm_contactsgroup.store'
        ],
    ]);
    
    Route::any('crm/select/contact-group', array('as' => 'select_contact_group', 'uses' => 'crm\CrmContactsController@selectGroup'));
    Route::any('crm/select/contact', array('as' => 'crm_select_contact', 'uses' => 'crm\CrmContactsController@selectContact'));
    Route::any('crm/select/add-contact', array('as' => 'add_contact_to_group', 'uses' => 'crm\CrmContactsController@addContactToGroup'));
    Route::any('crm/group/contacts', array('as'=>'group_contacts','uses'=> 'crm\CrmContactsGroupController@viewGroupContacts'));
    Route::resource('crm/create-email', 'crm\CrmEmailsController',[
        'names' => [
            'index'=>'crm_emails.index',
            'create'=>'crm_emails.create',
            'edit' => 'crm_emails.edit',
            'update' => 'crm_emails.update',
            'show' => 'crm_emails.show',
            'store' => 'crm_emails.store'
        ],
    ]);
    
    Route::get('search_email_id', array('as' => 'search_email_id', 'uses' => 'crm\CrmEmailsController@searchEmailId'));
    Route::get('crm/emails/drafts', array('as' => 'crm_emails.drafts', 'uses' => 'crm\CrmEmailsController@viewEmailDrafts'));
    Route::get('select_template', array('as' => 'select_template', 'uses' => 'crm\CrmEmailsController@selectTemplate'));
    
    Route::resource('crm/templates', 'crm\CrmTemplatesController',[
        'names' => [
            'index'=>'crm_templates.index',
            'create'=>'crm_templates.create',
            'edit' => 'crm_templates.edit',
            'update' => 'crm_templates.update',
            'show' => 'crm_templates.show',
            'store' => 'crm_templates.store'
        ],
    ]);
    
    Route::get('get_variable_values', array('as' => 'get_variable_values', 'uses' => 'crm\CrmTemplatesController@variableCatValues')); 
    Route::any('crm/select/group', array('as' => 'select_group', 'uses' => 'crm\CrmUsersController@selectGroup'));
    Route::any('crm/select/user', array('as' => 'crm_select_user', 'uses' => 'crm\CrmUsersController@selectUser'));
    Route::any('crm/select/adduser', array('as' => 'add_user_to_group', 'uses' => 'crm\CrmUsersController@addUserToGroup'));
    
    Route::resource('exceptions', 'exceptions\ExceptionsController',[
        'names' => [
            'index' => 'exceptions.index',
            'edit' => 'exceptions.edit',
            'show' => 'exceptions.show',
            'update' => 'exceptions.update',
            'create' => 'exceptions.create',
            'store' => 'exceptions.store'
            ],
        'except' => ['destroy']
        ]);
 // Routes for Shopping Cart Checkout     
    Route::resource('checkout/address/', 'checkout\CheckoutController',[
        'names' => [
            'index'=>'checkout.index',
            'create'=>'checkout.create',
            'edit' => 'checkout.edit',
            'update' => 'checkout.update',
            'show' => 'checkout.show',
            'store' => 'checkout.store'
        ],
    ]);
    
    Route::any('checkout/payment/confirm', array('as'=>'checkout.payment_confirm','uses'=> 'checkout\CheckoutController@paymentConfirm'));
    Route::any('checkout/payment/payment-method/', array('as'=>'checkout.payment_methods','uses'=> 'checkout\CheckoutController@selectPaymentMethods'));
});

        

// End of Routes for Shopping Cart Checkout

//Route::group(['middleware' => 'permission'], function() {
    // Routes for Internal Messaging System.
    Route::resource('communication/chat', 'backend\dashboard\chat\ChatController',[
        'names' => [
            'index'=>'chat.index',
            'create'=>'chat.create',
            'store'=>'chat.store'
        ],
    ]);


    Route::any('startchat{user}', array('as'=>'startchat','uses'=> 'backend\dashboard\chat\ChatController@startChatting'));
    Route::any('storechat', array('as'=>'storechat','uses'=> 'backend\dashboard\chat\ChatController@storeChat'));
    Route::any('fetchchat', array('as'=>'fetchchat','uses'=> 'backend\dashboard\chat\ChatController@fetchChat'));
    Route::any('fetchinfo', array('as'=>'fetchinfo','uses'=> 'backend\dashboard\chat\ChatController@fetchContactInfo'));
    Route::any('contact', array('as'=>'updatecontact','uses'=> 'backend\dashboard\chat\ChatController@updateContactStatus'));
    Route::any('addcontacts', array('as'=>'addcontacts','uses'=> 'backend\dashboard\chat\ChatController@addContacts'));
    Route::any('savecontacts', array('as'=>'savecontacts','uses'=> 'backend\dashboard\chat\ChatController@saveContacts'));
    Route::any('loadpreviousmessages', array('as'=>'loadpreviousmessages','uses'=> 'backend\dashboard\chat\ChatController@loadPreviousChats'));
    Route::any('chatarchive{user}', array('as'=>'chatarchive','uses'=> 'backend\dashboard\chat\ChatController@chatArchive'));
    Route::any('searchchatarchive', array('as'=>'searchchatarchive','uses'=> 'backend\dashboard\chat\ChatController@searchChatArchive'));
    // End of Routes for Internal Messaging System.

    Route::any('inviteforchat/{id}', array('as' => 'inviteforchat', 'uses' => 'backend\dashboard\business_info\CompanyInvitationsController@inviteForChat'));
//});
    
    
Route::group(['middleware' => 'permission'], function() {
    Route::resource('dashboard/company-network/invite-partner', 'backend\dashboard\business_partners\CompanyNetworkPartnersController', [
        'names' => [
            'create' => 'company.network.invite.create',
        ],
    ]);
    
    Route::any('dashboard/company-network-partner/store/', array('as' => 'company.network.store', 'uses' => 'backend\dashboard\business_partners\CompanyNetworkPartnersController@store'));
    Route::any('dashboard/company-network/show', array('as' => 'company.network.show', 'uses' => 'backend\dashboard\business_partners\CompanyNetworkPartnersController@show'));
    Route::any('dashboard/company-network/update/{site}/{id}', array('as' => 'company.network.update', 'uses' => 'backend\dashboard\business_partners\CompanyNetworkPartnersController@update'));
    Route::any('dashboard/company-network/destroy/{site}/{id}', array('as' => 'company.network.destroy', 'uses' => 'backend\dashboard\business_partners\CompanyNetworkPartnersController@destroy'));
    Route::any('dashboard/company-network/resend/{id}', array('as' => 'company.network.resend', 'uses' => 'backend\dashboard\business_partners\CompanyNetworkPartnersController@resend'));
    
    Route::resource('dashboard/company-network/share-site', 'backend\dashboard\business_partners\NetworkShareSitesController', [
        'names' => [
            'index' => 'network.share.site.index',
            'create' => 'network.share.site.create',
            'show' => 'network.share.site.show',
            'edit' => 'network.share.site.edit',
            'store' => 'network.share.site.store',
            'destroy' => 'network.share.site.destroy',
        ],
    ]);
    
   Route::any('dashboard/network-partner/share-site/{id}/update', array('as' => 'network.share.site.update', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@update'));
   Route::any('dashboard/company-network/share/products/{site_slug}/{inviter}', array('as' => 'list_my_site_products', 'uses' => 'backend\dashboard\business_partners\NetworkShareSitesController@listProducts'));
   Route::any('dashboard/business/company-network/', array('as' => 'import-network-products.select_network', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@listBusinessNetwork'));
   Route::any('dashboard/business/company-network/shared-sites', array('as' => 'import-network-products.select_shared-site', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@listSharedSites'));
   
   Route::any('dashboard/business/network-ecom/view-products', array('as' => 'import-network-products.view_products', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@viewPartnersProducts'));
   Route::any('dashboard/business/network-ecom/import-network-products', array('as' => 'import.network.product', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@importNetworkProducts'));
// Route::any('dashboard/business/import_products', array('as' => 'import-network-products.import_products', 'uses' => 'backend\dashboard\business_partners\ImportNetworkProductsController@importProducts'));
   
   
   
   //-----------------Company Network products----------------------------------------
    Route::resource('dashboard/company-network/products/list', 'backend\dashboard\business_partners\ViewNetworkProductsController', [
        'names' => [
            'index' => 'comnetwork.product.index',
        ],
    ]);

    Route::any('dashboard/company-network/product/{id}/edit-product', array('as' => 'company_network_item.edit', 'uses' => 'backend\catalog\products\NetworkProductsController@editNetworkProduct'));
    Route::any('dashboard/company-network/product/{id}/store', array('as' => 'network.store_item_details', 'uses' => 'backend\catalog\products\NetworkProductsController@storeNetworkItemDetails'));
});
    
    Route::group(['middleware' => 'permission'], function() {
        Route::resource('shopping/user-orders', 'orders\UserOrdersController',[
            'names' => [
                'index'=>'userorders.index',
            ],
        ]);
        Route::any('shopping/order-details/show/{orderid}/{subid}', array('as' => 'userorders.show', 'uses' => 'orders\UserOrdersController@show'));
    
        Route::resource('shopping/orders', 'orders\OrdersController',[
            'names' => [
                'index'=>'orders.index',
                'show'=>'orders.show',
            ],
        ]);
        
        Route::any('shopping/order-details/change-status', array('as' => 'orders.change-product-status', 'uses' => 'orders\OrdersController@changeProductStatus'));
    });
    

    Route::group(['middleware' => 'permission'], function() {
        Route::resource('shopping/contact-seller', 'contact\ContactSellerController',[
            'names' => [
                'index'=>'contact-seller-index',
                'create'=>'contact-seller-create',
                'show'=>'contact-seller-show',
                'edit'=>'contact-seller-edit',
                'store'=>'contact-seller-store'
            ],
        ]);
    
        Route::resource('shopping/contact-buyer', 'contact\ContactBuyerController',[
            'names' => [
                'index'=>'contact-buyer-index',
                'create'=>'contact-buyer-create',
                'show'=>'contact-buyer-show',
                'edit'=>'contact-buyer-edit',
                'store'=>'contact-buyer-store'
            ],
        ]);
    
        Route::resource('contact-gdoox', 'contact\ContactGdooxController',[
            'names' => [
                'index'=>'contact-gdoox-index',
                'create'=>'contact-gdoox-create',
                'show'=>'contact-gdoox-show',
                'edit'=>'contact-gdoox-edit',
                'store'=>'contact-gdoox-store'
            ],
        ]);
        
        Route::get('return-product', array('as'=>'return-product','uses'=> 'orders\UserOrdersController@returnProduct'));
        Route::get('return-product/store', array('as'=>'return-product.store','uses'=> 'orders\UserOrdersController@storeReturnProduct'));
        Route::get('product-return-request', array('as'=>'product-return-request','uses'=> 'orders\OrdersController@returnProductRequest'));
        Route::get('product-return-request/store', array('as'=>'product-return-request.store','uses'=> 'orders\OrdersController@storeReturnProductRequest'));
    });
    
    Route::any('contact-gdoox/messages/reply', array('as'=>'contact-gdoox-reply','uses'=> 'contact\ContactGdooxController@replyToMessages'));
    Route::any('contact-gdoox/messages/reply', array('as'=>'contact-gdoox-reply','uses'=> 'contact\ContactGdooxController@replyToMessages'));
    
    Route::group(['prefix' => 'vsite', 'namespace' => 'store' ], function () {
        Route::any('/{shopid}/vshow/{id}', array('as' => '{shopid}/vshow/', 'uses' => 'StoreController@showVariation'));
    });
    
    
 // Routes for Messages.
    Route::resource('backend/dahboard/user/messages', 'backend\dashboard\messages\MessagesController',[
        'names' => [
            'index'=>'viewmessages.index',
            'create'=>'viewmessages.create',
            'store'=>'viewmessages.store'
        ],
    ]);
    
    Route::any('backend/dashboard/alert-system/index', array('as' => 'alertsytem.index', 'uses' => 'backend\dashboard\AlertSystemController@index'));
    Route::any('backend/dashboard/invite-internal-business-partner/fetch_comsite_cat', array('as' => 'fetch_comsite_cat', 'uses' => 'backend\dashboard\business_partners\InternalBusinessPartnersController@fetchCompanySiteCategories'));
    Route::any('store/product/change/shared_status', array('as' => 'product_shared_status', 'uses' => 'store\StoreController@changeProductShareStatus'));
    Route::any('store/product/change/shareproduct', array('as' => 'share-unshared-product', 'uses' => 'store\StoreController@shareUnsharedProduct'));

    Route::any('dashboard/products/duplicate/{product_id}', array('as' => 'duplicate_this_product', 'uses' => 'backend\dashboard\ViewProductsController@createDuplicateProduct'));
    Route::any('dashboard/products/duplicate/create/{product_id}', array('as' => 'duplicate_this_product.save', 'uses' => 'backend\dashboard\ViewProductsController@saveDuplicateProduct'));