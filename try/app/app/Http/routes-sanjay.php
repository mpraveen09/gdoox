<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('/thanks', function() {
  return view('auth.thanks');
});


/* --------------------------@Resource Controller for named routes...------------------------------------------------------------------------------------ */
Route::any('dashboard/user/profile', array('as' => 'dashboard-user-profile', 'uses' => 'backend\dashboard\PersonalProfilesController@view', 'middleware' => 'permission'));

Route::group(['prefix' => '', 'namespace' => 'backend\dashboard\business_info\business_verification_logs', 'middleware' => 'permission'], function() {
  Route::resource('dashboard/verify-company/fiscal-vat', 'VerifyFiscalVatController', [
      'names' => [
          'edit' => 'verify-fiscalvat-edit',
          'update' => 'verify-fiscalvat-update',
      ]
  ]);

  Route::resource('dashboard/verify-company/documents', 'VerifyDocumentController', [
      'names' => [
          'edit' => 'verify-documents-edit',
          'update' => 'verify-documents-update',
      ]
  ]);
});

Route::any('dashboard/business-info/verify/', array('as' => 'business-info-verify', 'uses' => 'backend\dashboard\business_info\BusinessInfoController@VerifyCompany', 'middleware' => 'permission'));
Route::any('dashboard/verify-company/fetchcountry', array('as' => 'fetchcountry', 'uses' => 'backend\dashboard\verify_companies\VerifyFiscalVatController@fetchCountry', 'middleware' => 'permission'));
Route::group(['prefix' => '', 'namespace' => 'backend\dashboard\business_info', 'middleware' => 'permission'], function() {
  /* ----------------------------------------#@Business Profile--------------------------------------- */
  Route::resource('dashboard/business-info', 'BusinessInfoController', [
      'names' => [
          'index' => 'business-info-index',
          'create' => 'business-info-create',
          'store' => 'business-info-store',
          'edit' => 'business-info-edit',
          'update' => 'business-info-update',
          'show' => 'business-info-show',
      ]
  ]);
  
  Route::resource('dashboard/business-details', 'BusinessDetailsController', [
      'names' => [
          'index' => 'business-details-index',
          'update' => 'business-details-update',
          'show' => 'business-details-show',
      ]
  ]);

  Route::resource('dashboard/ecommerce-site', 'EcommerceSitesController', [
      'names' => [
          'index' => 'ecomm-index',
          'create' => 'ecomm-create',
          'store' => 'ecomm-store',
          'edit' => 'ecomm-edit',
          'update' => 'ecomm-update',
          'show' => 'ecomm-show',
      ]
  ]);
Route::any('dashboard/ecommerce-site/site-admin', array('as' => 'ecomm.siteadmin', 'uses' => 'EcommerceSitesController@_siteAdmin', 'middleware' => 'permission'));
});

Route::group(['prefix' => '', 'namespace' => 'backend\dashboard'], function() {
  /* --------------------------------------#@Personal Profile------------------------- */
  Route::resource('dashboard/personal-info', 'PersonalInfoController', [
      'names' => [
          'create' => 'personal-info-create',
          'store' => 'personal-info-store',
          'edit' => 'personal-info-edit',
          'update' => 'personal-info-update',
          'show' => 'personal-info-show',
      ]
  ]);
  
  Route::resource('dashboard/social-info', 'SocialInfoController', [
      'names' => [
          'create' => 'social-info-create',
          'edit' => 'social-info-edit',
          'update' => 'social-info-update',
          'store' => 'social-info-store'
      ]
  ]);
  
  Route::resource('dashboard/gdoox-relation', 'RelationInfoController', [
      'names' => [
          'create' => 'relation-info-create',
          'edit' => 'relation-info-edit',
          'update' => 'relation-info-update',
          'store' => 'relation-info-store',
      ]
  ]);
  
  Route::resource('dashboard/position', 'PositionInCompanyController', [
      'names' => [
          'create' => 'position.create',
          'edit' => 'position.edit',
          'update' => 'position.update',
      ]
  ]);
  Route::resource('dashboard/interest-info', 'InterestInfoController', [
      'names' => [
          'create' => 'interest-info-create',
          'edit' => 'interest-info-edit',
          'update' => 'interest-info-update',
          'store' => 'interest-info-store'
      ]
  ]);
  

  Route::resource('dashboard/personal-site', 'PersonalSitesController', [
      'names' => [
          'store' => 'personal-site-store',
          'edit' => 'personal-site-edit',
          'update' => 'personal-site-update',
      ]
  ]);


  Route::resource('dashboard/personal/select_cat', 'SelectCategoriesController', [
      'names' => [
          'index' => 'personal-select_cat-index',
          'store' => 'personal-select_cat-store',
      ]
  ]);
});

Route::any('dashboard/personal-select-cat/edit', array('as' => 'personal-select_cat-edit', 'uses' => 'backend\dashboard\SelectCategoriesController@edit', 'middleware' => 'permission'));
Route::any('dashboard/personal-select-cat/update', array('as' => 'personal-select_cat-update', 'uses' => 'backend\dashboard\SelectCategoriesController@update', 'middleware' => 'permission'));

//--------------------------------------- Account Profile Route-----------------------------------------
Route::any('dashboard/account-profile', array('as' => 'acc_profile.edit', 'uses' => 'backend\dashboard\account_profile\AccountProfilesController@edit', 'middleware' => 'permission'));
Route::any('dashboard/account-profile/update', array('as' => 'acc_profile.update', 'uses' => 'backend\dashboard\account_profile\AccountProfilesController@update', 'middleware' => 'permission'));

Route::any('dashboard/personal_site/jobdetail/create', array('as' => 'jobdetail.create', 'uses' => 'backend\dashboard\personal_sites\JobDetailsController@create', 'middleware' => 'permission'));
Route::any('dashboard/personal_site/jobdetail/edit/{id}', array('as' => 'jobdetail.edit', 'uses' => 'backend\dashboard\personal_sites\JobDetailsController@edit', 'middleware' => 'permission'));
Route::any('dashboard/personal_site/jobdetail/update', array('as' => 'jobdetail.update', 'uses' => 'backend\dashboard\personal_sites\JobDetailsController@update', 'middleware' => 'permission'));
Route::any('dashboard/personal_site/jobdetail/remove/{id}/{name}', array('as' => 'jobdetail.delete', 'uses' => 'backend\dashboard\personal_sites\JobDetailsController@store', 'middleware' => 'permission'));
Route::any('dashboard/personal_site/jobdetail/store', array('as' => 'jobdetail.store', 'uses' => 'backend\dashboard\personal_sites\JobDetailsController@create', 'middleware' => 'permission'));
Route::any('dashboard/personal_site/jobdetail/fetch_org_category', array('as' => 'fetch_org_category', 'uses' => 'backend\dashboard\personal_sites\JobDetailsController@getOrganizationCategory'));
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* ------------------------------------------------------------@Routes for payments methods--------------------------------------------------------------------------------- */

Route::group(['prefix' => '', 'namespace' => 'backend\dashboard', 'middleware' => 'permission'], function() {
  Route::resource('dashboard/payment-methods', 'PaymentMethodsController', [
      'names' => [
          'index' => 'payment-method-index',
          'create' => 'payment-method-create',
          'store' => 'payment-method-store',
          'show' => 'payment-method-show',
          'edit' => 'payment-method-edit',
          'update' => 'payment-method-update'
      ]
  ]);
});
/* -------------------------------------------@Usersbackend -------------------------------------------------------------------------- */

Route::any('dash-board', array('as' => 'dash-board', 'uses' => 'backend\dashboard\UsersController@dash_board', 'middleware' => 'permission'));

Route::group(['prefix' => '', 'namespace' => 'backend\dashboard', 'middleware' => 'permission'], function() {
  Route::resource('dashboard', 'UsersController', [
      'names' => [
          'index' => 'dashboard-index'
      ]
  ]);
  
  Route::resource('dashboard/user', 'UsersController', [
      'names' => [
          'create' => 'user-create',
          'store' => 'user-store',
          'show' => 'user-show',
          'edit' => 'user-edit',
          'update' => 'user-update',
      ]
  ]);
  
  Route::resource('dashboard/user/invite-user', 'InviteUsersController', [
      'names' => [
          'create' => 'invite-user-create',
          'store' => 'invite-user-store',
      ]
  ]);
  
  Route::resource('dashboard/user/invite-multi-user', 'InviteMultiUsersController', [
      'names' => [
          'create' => 'invite-multi-user-create',
          'store' => 'invite-multi-user-store',
      ]
  ]);

  Route::resource('dashboard/user/profile', 'ProfilesController', [
      'names' => [
          'index' => 'profile-index',
          'edit' => 'profile-edit',
          'update' => 'profile-update'
      ],
      'except' => ['destroy']
  ]);

  Route::resource('dashboard/category-upload', 'CategoryUploadController', [
      'names' => [
          'create' => 'category-upload-create',
      ],
      'except' => ['destroy']
  ]);
Route::any('dashboard/category-upload/override-file', array('as' => 'category-upload.override', 'uses' => 'CategoryUploadController@_overridefile'));
Route::any('dashboard/category-upload/view/category-attrib', array('as' => 'category-upload.cat_attr', 'uses' => 'CategoryUploadController@_cat_attr'));
Route::any('dashboard/category-upload/update-categories', array('as' => 'category-upload.update', 'uses' => 'CategoryUploadController@updatecategories'));

Route::any('dashboard/category-mgmt/store-categories', array('as' => 'category-upload-store', 'uses' => 'CategoryUploadController@store'));
});

/*-------------------------------------------Invite Gdoox Member--------------*/
Route::any('dashboard/gdoox_member/create', array('as' => 'gdoox_member.create', 'uses' => 'backend\dashboard\UsersController@createGdooxMember', 'middleware' => 'permission'));
Route::any('dashboard/gdoox_member/store', array('as' => 'gdoox_member.store', 'uses' => 'backend\dashboard\UsersController@store_gdoox_member', 'middleware' => 'permission'));
Route::any('dashboard/gdoox_member/view_all', array('as' => 'gdoox_member.view_all', 'uses' => 'backend\dashboard\UsersController@allGdooxMember', 'middleware' => 'permission'));

Route::any('dashboard/gdoox_member/view_member', array('as' => 'gdoox_member.view_member', 'uses' => 'backend\dashboard\UsersController@viewGdooxMember'));
Route::any('dashboard/gdoox_member/edit_member', array('as' => 'gdoox_member.edit_member', 'uses' => 'backend\dashboard\UsersController@editGdooxMember'));
Route::any('dashboard/gdoox_member/update_member', array('as' => 'gdoox_member.update_member', 'uses' => 'backend\dashboard\UsersController@updateGdooxMember'));

Route::any('dashboard/gdoox_member/{id}/manage_permission', array('as' => 'gdoox_member.manage_permission', 'uses' => 'backend\dashboard\UsersController@managePermisson', 'middleware' => 'permission'));
Route::any('dashboard/gdoox_member/{id}/store_permission', array('as' => 'gdoox_member.store_permission', 'uses' => 'backend\dashboard\UsersController@storeGdooxMemberPermission', 'middleware' => 'permission'));

/*---------------------------Invite team-member----------------------*/
Route::any('dashboard/invite/colleague', array('as' => 'invite.colleague', 'uses' => 'backend\dashboard\UsersController@InviteColleague', 'middleware' => 'permission'));
Route::any('dashboard/invite/colleague/store', array('as' => 'invite.store_colleague', 'uses' => 'backend\dashboard\UsersController@store_team_member', 'middleware' => 'permission'));
Route::any('dashboard/invite/colleague/view-all', array('as' => 'colleague.all', 'uses' => 'backend\dashboard\UsersController@AllColleague', 'middleware' => 'permission'));
Route::any('dashboard/invite/colleague/edit-colleague', array('as' => 'edit.colleague', 'uses' => 'backend\dashboard\UsersController@EditColleague'));
Route::any('dashboard/invite/colleague/update-colleague', array('as' => 'update.colleague', 'uses' => 'backend\dashboard\UsersController@UpdateColleague'));

//-----------------------------------------Route for site images-------------------------------------
Route::any('dashboard/e-site/index', array('as' => 'site.header.images.index', 'uses' => 'backend\dashboard\business_info\SiteHeaderImagesController@index', 'middleware' => 'permission'));
Route::any('dashboard/e-site/header-images/{id}', array('as' => 'site.header.images.create', 'uses' => 'backend\dashboard\business_info\SiteHeaderImagesController@create', 'middleware' => 'permission'));
Route::group(['middleware' => 'permission'], function() {
Route::resource('dashboard/e-site-header-images', 'backend\dashboard\business_info\SiteHeaderImagesController', [
    'names' => [
        'store' => 'site.header.images.store',
        'update' => 'site.header.images.update',
        'show' => 'site.header.images.show'
    ],
    'except' => ['destroy']
]);
});
//--------------------------------------------------Route for site logo-------------------------------------------
Route::any('dashboard/e-comm-site/select', array('as' => 'site.logo.index', 'uses' => 'backend\dashboard\business_info\SiteLogoController@index'));
Route::any('dashboard/e-comm-site/logo/{id}', array('as' => 'site.logo.create', 'uses' => 'backend\dashboard\business_info\SiteLogoController@create'));

Route::resource('dashboard/e-comm-site-logo', 'backend\dashboard\business_info\SiteLogoController', [
    'names' => [
        'store' => 'site.logo.store',
        'edit' => 'site.logo.edit',
        'update' => 'site.logo.update',
        'show' => 'site.logo.show'
    ],
    'except' => ['destroy']
]);

Route::any('dashboard/user/{id}/site/allow', array('as' => 'user-allow', 'uses' => 'backend\dashboard\UsersController@allow', 'middleware' => 'permission'));
Route::any('dashboard/user/{id}/site/disallow', array('as' => 'user-disallow', 'uses' => 'backend\dashboard\UsersController@disallow', 'middleware' => 'permission'));

Route::any('dashboard/user/{id}/site_admin/create', array('as' => 'site_admin', 'uses' => 'backend\dashboard\UsersController@siteAdminCreate'));
Route::any('dashboard/user/{id}/site_admin/remove', array('as' => 'site_admin.remove', 'uses' => 'backend\dashboard\UsersController@siteAdminRemove'));

Route::any('dashboard/show/users', array('as' => 'users', 'uses' => 'backend\dashboard\UsersController@showAll', 'middleware' => 'permission'));
Route::any('dashboard/user/deactive/{id}', array('as' => 'user-deactive', 'uses' => 'backend\dashboard\UsersController@destroy', 'middleware' => 'permission'));

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
Route::get('activate/{code}', array('as' => 'activate', 'uses' => 'backend\dashboard\UsersController@activate'));
Route::get('platform/info', array('as' => 'platform.info', 'uses' => 'backend\dashboard\UsersController@platformInfo'));

Route::get('dashboard/user{code}/reactive', array('as' => 'reactivate', 'uses' => 'backend\dashboard\UsersController@reactivate'));

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------Permission Restriction Route----------------------------------------- */
Route::get('/permission-denied', ['as' => 'permisson.denied', function () {
      return view('permission_denied');
    }]);

//----------------------------------------------Business Invitation--------------------------------------------------------------
Route::any('business-company-invite', array('as' => 'invite.company.index', 'uses' => 'backend\dashboard\business_info\CompanyInvitationsController@index', 'middleware' => 'permission'));
Route::any('business-company-invitestore/{id}', array('as' => 'invite.company.store', 'uses' => 'backend\dashboard\business_info\CompanyInvitationsController@store', 'middleware' => 'permission'));
Route::any('business-company-invite-show/', array('as' => 'invite.company.show', 'uses' => 'backend\dashboard\business_info\CompanyInvitationsController@show', 'middleware' => 'permission'));
Route::any('business-company-invite-update/company/{comp_id}/user/{inviter_id}', array('as' => 'invite.company.update', 'uses' => 'backend\dashboard\business_info\CompanyInvitationsController@update', 'middleware' => 'permission'));
Route::any('business-company-invite-destroy/company/{comp_id}/user/{inviter_id}', array('as' => 'invite.company.destroy', 'uses' => 'backend\dashboard\business_info\CompanyInvitationsController@destroy', 'middleware' => 'permission'));
Route::any('business-company-invite-status', array('as' => 'invite.company.status', 'uses' => 'backend\dashboard\business_info\CompanyInvitationsController@invitationStatus', 'middleware' => 'permission'));



//--------------------------------------------Partner Invitation---------------------------

//-----------------------------------------Internal-----------------------------------------------
Route::group(['middleware' => 'permission'], function() {
Route::resource('dashboard/invite-internal-business-partner', 'backend\dashboard\business_partners\InternalBusinessPartnersController', [
    'names' => [
        'create' => 'invite.inter.partner.create',
    ],
]);

Route::any('dashboard/site/{shop_id}/request', array('as' => 'join.request', 'uses' => 'backend\dashboard\business_partners\InternalBusinessPartnersController@joinRequest'));
Route::any('dashboard/site/{shop_id}/partner/request', array('as' => 'partner.request', 'uses' => 'backend\dashboard\business_partners\InternalBusinessPartnersController@partnerRequest'));
Route::any('dashboard/internal-business-partner/store/', array('as' => 'invite.inter.partner.store', 'uses' => 'backend\dashboard\business_partners\InternalBusinessPartnersController@store'));
Route::any('dashboard/business-partner/resend/{id}', array('as' => 'invite.partner.resend', 'uses' => 'backend\dashboard\business_partners\InternalBusinessPartnersController@resend'));
//---- Not yet gdoox member-----
Route::resource('dashboard/invite-external-business-partner', 'backend\dashboard\business_partners\ExternalBusinessPartnersController', [
    'names' => [
        'create' => 'invite.ext.partner.create',
        'store' => 'invite.ext.partner.store',
    ],
]);


Route::any('dashboard/business-partner/status', array('as' => 'invite.partner.status', 'uses' => 'backend\dashboard\business_partners\ExternalBusinessPartnersController@status'));
Route::any('dashboard/business-partner/show', array('as' => 'invite.partner.show', 'uses' => 'backend\dashboard\business_partners\ExternalBusinessPartnersController@show'));
Route::any('dashboard/business-partner/update/{email}/{id}', array('as' => 'invite.partner.update', 'uses' => 'backend\dashboard\business_partners\ExternalBusinessPartnersController@update'));
Route::any('dashboard/business-partner/destroy/{email}/{id}', array('as' => 'invite.partner.destroy', 'uses' => 'backend\dashboard\business_partners\ExternalBusinessPartnersController@destroy'));

});

Route::get('auth/register/{code}', 'backend\dashboard\business_partners\ExternalBusinessPartnersController@PartnerRegister');
Route::any('auth/user-register/{code}/{email?}', 'backend\dashboard\UsersController@registerUser');

//---------------------------------------Create Business Ecosystem Site------------------------------------------------------------------------------------------
Route::group(['middleware' => 'permission'], function() {
Route::resource('dashboard/business-partner/business-ecosystem', 'backend\dashboard\business_partners\BusinessEcosystemController', [
    'names' => [
        'index' => 'ecosys.site.index',
        'create' => 'ecosys.site.create',
        'edit' => 'ecosys.site.edit',
        'show' => 'ecosys.site.show',
        'update' => 'ecosys.site.update',
        'store' => 'ecosys.site.store',
    ],
]);

Route::any('dashboard/business-partner/shared/product/{id}/{flag}/edit-product', array('as' => 'ecosys_product.edit', 'uses' => 'backend\catalog\products\ProductsController@editSharedProduct'));
Route::any('dashboard/business-partner/shared/product/{id}/update-product', array('as' => 'ecosys.store_product_info', 'uses' => 'backend\catalog\products\ProductsController@updateSharedProduct'));
Route::get('dashboard/business-partner/business-ecosystem/site/{shop_id}/add', ['as' => 'ecosys.site.add', 'uses' => 'backend\dashboard\business_partners\BusinessEcosystemController@addSite']);
Route::get('dashboard/business-partner/business-ecosystem/site/{shop_id}/store', ['as' => 'ecosys.site.storesite', 'uses' => 'backend\dashboard\business_partners\BusinessEcosystemController@storesite']);
Route::get('dashboard/business-ecosystem/index', ['as' => 'ecosys.site.indexall', 'uses' => 'backend\dashboard\business_partners\BusinessEcosystemController@indexall']);
});
Route::group(['middleware' => 'permission'], function() {
//-----------------Ecosystem products----------------------------------------
Route::resource('dashboard/ecosystem/products/list', 'backend\dashboard\ViewProductsController', [
    'names' => [
        'index' => 'ecosys.product.index',
    ],
]);

    Route::any('dashboard/products/list/{purpose?}', array('as' => 'products/list', 'uses' => 'backend\dashboard\ViewProductsController@indexAllProducts'));
    Route::any('dashboard/products/toggle/{id}', array('as' => 'products.toggle', 'uses' => 'backend\catalog\products\ProductsController@toggle'));
});

Route::any('dashboard/products/procurements/{purpose}', array('as' => 'products/procurements', 'uses' => 'backend\dashboard\ViewProductsController@indexAllProducts'));

//-------------------------------------------------Share Sites------------------------------------
Route::group(['middleware' => 'permission'], function() {
    Route::resource('dashboard/partner/share-site', 'backend\dashboard\business_partners\ShareSitesController', [
        'names' => [
            'index' => 'share.site.index',
            'create' => 'share.site.create',
            'show' => 'share.site.show',
            'edit' => 'share.site.edit',
            'store' => 'share.site.store',
            'destroy' => 'share.site.destroy',
        ],
    ]);
    Route::any('dashboard/partner/share-site/{id}/update', array('as' => 'share.site.update', 'uses' => 'backend\dashboard\business_partners\ShareSitesController@update'));
});
//--------------------------------------Business Followers--------------------------------------------
Route::group(['middleware' => 'permission'], function() {
Route::any('dashboard/follow/{shop_id}', array('as' => 'follower.index', 'uses' => 'backend\dashboard\business_partners\FollowersController@index'));
Route::resource('dashboard/follow/site', 'backend\dashboard\business_partners\FollowersController', [
    'names' => [
        'edit' => 'follower.edit',
        'create' => 'follower.create',
        'update' => 'follower.update',
    ],
]);
Route::any('dashboard/follow/site/store', array('as' => 'follower.store', 'uses' => 'backend\dashboard\business_partners\FollowersController@store'));
Route::any('dashboard/business/followers', array('as' => 'follower.all', 'uses' => 'backend\dashboard\business_partners\FollowersController@followers'));
});

//-------------------------------------------------Site Social Links------------------------------------
Route::group(['middleware' => 'permission'], function() {

Route::any('dashboard/site/{id}/sociallinks/create', array('as' => 'sociallink.create', 'uses' => 'backend\dashboard\business_info\SocialLinksController@create'));
Route::resource('dashboard/site/sociallinks', 'backend\dashboard\business_info\SocialLinksController', [
    'names' => [
        'index' => 'sociallink.index',
        'show' => 'sociallink.show',
        'edit' => 'sociallink.edit',
        'store' => 'sociallink.store',
        'update' => 'sociallink.update',
        ],
    ]);
});
//--------------------------Product Promotional Banner -----------------------------

Route::group(['middleware' => 'permission'], function() {
    Route::resource('dashboard/product/promo', 'backend\dashboard\business_info\ProductPromotionalBannersController', [
        'names' => [
            'index' => 'product_promo.index',
            'edit' => 'product_promo.edit',
            'update' => 'product_promo.update',
            'store' => 'product_promo.store'
        ],
    ]);
    
//  Route::any('dashboard/product/promo/banner/{id}/update/', array('as' => 'product_promo.update', 'uses' => 'backend\dashboard\business_info\ProductPromotionalBannersController@update'));
    Route::any('dashboard/product/promo/banner/select_product', array('as' => 'product_promo.select_product', 'uses' => 'backend\dashboard\business_info\ProductPromotionalBannersController@SelectProduct'));
    Route::any('dashboard/product/promo/banner/add_banner/{id}', array('as' => 'product_promo.create', 'uses' => 'backend\dashboard\business_info\ProductPromotionalBannersController@create'));
    Route::any('dashboard/product/promo/banner/{id}/status/{status}', array('as' => 'product_promo.toggle', 'uses' => 'backend\dashboard\business_info\ProductPromotionalBannersController@toggle'));
});
//-----------------------------------------Multi Item Products------------------------------------------
Route::group(['prefix' => '', 'namespace' => 'backend\catalog\products', 'type'=>'multi_item', 'middleware' => 'permission'], function() {
Route::resource('dashboard/multiitem/product', 'MultiItemProductsController', [
    'names' => [
        'create' => 'multi_item.create',
        'show' => 'multi_item.show',
    ],
]);
Route::any('dashboard/multiitem/product/index/all', array('as' => 'multi_item.index', 'uses' => 'MultiItemProductsController@indexing'));
Route::any('dashboard/multiitem/product/{id}/list', array('as' => 'multi_item.list', 'uses' => 'MultiItemProductsController@ListAll'));
Route::any('dashboard/multiitem/product/store_item', array('as' => 'multi_item.store_item', 'uses' => 'MultiItemProductsController@StoreItem'));

Route::any('dashboard/multiitem/product/{id}/add_product', array('as' => 'multi_item.add_product', 'uses' => 'MultiItemProductsController@AddProduct'));
Route::any('dashboard/multiitem/product/search/auto', array('as' => 'multi_item.auto_search', 'uses' => 'MultiItemProductsController@AutoSearch'));

Route::any('dashboard/multiitem/product/{id}/store_product', array('as' => 'multi_item.store_product', 'uses' => 'MultiItemProductsController@StoreProduct'));
Route::any('dashboard/multiitem/product/{id}/remove_product', array('as' => 'multi_item.remove_product', 'uses' => 'MultiItemProductsController@RemoveProduct'));
Route::any('dashboard/multiitem/product/{id}/add_multi_item_details', array('as' => 'multi_item.add_multi_item_details', 'uses' => 'MultiItemProductsController@AddMultiItemDetails'));
Route::any('dashboard/multiitem/product/{id}/add_quantity', array('as' => 'multi_item.add_quantity', 'uses' => 'MultiItemProductsController@AddQuantity'));
Route::any('dashboard/multiitem/product/{id}/toggle', array('as' => 'multi_item.toggle', 'uses' => 'MultiItemProductsController@toggle'));

Route::any('dashboard/multiitem/product/{id}/store_multi_item_details', array('as' => 'multi_item.store_multi_item_details', 'uses' => 'MultiItemProductsController@StoreMultiItemDetails'));
Route::any('dashboard/multiitem/product/{id}/store_quantity', array('as' => 'multi_item.store_quantity', 'uses' => 'MultiItemProductsController@StoreQuantity'));

Route::any('dashboard/multiitem/product/store/new', array('as' => 'multi_item.store', 'uses' => 'MultiItemProductsController@storeMultiItem'));
Route::any('dashboard/multiitem/product/{id}/edit-product', array('as' => 'multi_item.edit', 'uses' => 'MultiItemProductsController@editMultiItem'));
Route::any('dashboard/multiitem/product/{id}/update', array('as' => 'multi_item.update', 'uses' => 'MultiItemProductsController@updateMultiItem'));
});
//----------------------------------Cross Selling Products------------------------------------
Route::group(['prefix' => '', 'namespace' => 'backend\catalog\products', 'type'=>'cross_selling', 'middleware' => 'permission'], function() {
Route::resource('dashboard/cross_selling/product', 'MultiItemProductsController', [
    'names' => [
        'create' => 'cross_selling.create',
        'show' => 'cross_selling.show',
    ],
]);
Route::any('dashboard/cross_selling/product/index/all', array('as' => 'cross_selling.index', 'uses' => 'MultiItemProductsController@indexing'));
Route::any('dashboard/cross_selling/product/{id}/list', array('as' => 'cross_selling.list', 'uses' => 'MultiItemProductsController@ListAll'));
Route::any('dashboard/cross_selling/product/store_item', array('as' => 'cross_selling.store_item', 'uses' => 'MultiItemProductsController@StoreItem'));

Route::any('dashboard/cross_selling/product/{id}/add_product', array('as' => 'cross_selling.add_product', 'uses' => 'MultiItemProductsController@AddProduct'));
Route::any('dashboard/cross_selling/product/search/auto', array('as' => 'cross_selling.auto_search', 'uses' => 'MultiItemProductsController@AutoSearch'));

Route::any('dashboard/cross_selling/product/{id}/store_product', array('as' => 'cross_selling.store_product', 'uses' => 'MultiItemProductsController@StoreProduct'));
Route::any('dashboard/cross_selling/product/{id}/remove_product', array('as' => 'cross_selling.remove_product', 'uses' => 'MultiItemProductsController@RemoveProduct'));
Route::any('dashboard/cross_selling/product/{id}/add_multi_item_details', array('as' => 'cross_selling.add_multi_item_details', 'uses' => 'MultiItemProductsController@AddMultiItemDetails'));
Route::any('dashboard/cross_selling/product/{id}/add_quantity', array('as' => 'cross_selling.add_quantity', 'uses' => 'MultiItemProductsController@AddQuantity'));
Route::any('dashboard/cross_selling/product/{id}/toggle', array('as' => 'cross_selling.toggle', 'uses' => 'MultiItemProductsController@toggle'));

Route::any('dashboard/cross_selling/product/{id}/store_multi_item_details', array('as' => 'cross_selling.store_multi_item_details', 'uses' => 'MultiItemProductsController@StoreMultiItemDetails'));
Route::any('dashboard/cross_selling/product/{id}/store_quantity', array('as' => 'cross_selling.store_quantity', 'uses' => 'MultiItemProductsController@StoreQuantity'));

Route::any('dashboard/cross_selling/product/store/new', array('as' => 'cross_selling.store', 'uses' => 'MultiItemProductsController@storeMultiItem'));
Route::any('dashboard/cross_selling/product/{id}/edit-product', array('as' => 'cross_selling.edit', 'uses' => 'MultiItemProductsController@editMultiItem'));
Route::any('dashboard/cross_selling/product/{id}/update', array('as' => 'cross_selling.update', 'uses' => 'MultiItemProductsController@updateMultiItem'));
});
//----------------------------------Upselling Products------------------------------------
Route::group(['prefix' => '', 'namespace' => 'backend\catalog\products', 'type'=>'up_selling', 'middleware' => 'permission'], function() {
    Route::resource('dashboard/up_selling/product', 'MultiItemProductsController', [
        'names' => [
            'create' => 'up_selling.create',
            'show' => 'up_selling.show',
        ],
    ]);
    Route::any('dashboard/up_selling/product/index/all', array('as' => 'up_selling.index', 'uses' => 'MultiItemProductsController@indexing'));
    Route::any('dashboard/up_selling/product/{id}/list', array('as' => 'up_selling.list', 'uses' => 'MultiItemProductsController@ListAll'));
    Route::any('dashboard/up_selling/product/store_item', array('as' => 'up_selling.store_item', 'uses' => 'MultiItemProductsController@StoreItem'));

    Route::any('dashboard/up_selling/product/{id}/add_product', array('as' => 'up_selling.add_product', 'uses' => 'MultiItemProductsController@AddProduct'));
    Route::any('dashboard/up_selling/product/search/auto', array('as' => 'up_selling.auto_search', 'uses' => 'MultiItemProductsController@AutoSearch'));

    Route::any('dashboard/up_selling/product/{id}/store_product', array('as' => 'up_selling.store_product', 'uses' => 'MultiItemProductsController@StoreProduct'));
    Route::any('dashboard/up_selling/product/{id}/remove_product', array('as' => 'up_selling.remove_product', 'uses' => 'MultiItemProductsController@RemoveProduct'));
    Route::any('dashboard/up_selling/product/{id}/add_multi_item_details', array('as' => 'up_selling.add_multi_item_details', 'uses' => 'MultiItemProductsController@AddMultiItemDetails'));
    Route::any('dashboard/up_selling/product/{id}/add_quantity', array('as' => 'up_selling.add_quantity', 'uses' => 'MultiItemProductsController@AddQuantity'));
    Route::any('dashboard/up_selling/product/{id}/toggle', array('as' => 'up_selling.toggle', 'uses' => 'MultiItemProductsController@toggle'));

    Route::any('dashboard/up_selling/product/{id}/store_multi_item_details', array('as' => 'up_selling.store_multi_item_details', 'uses' => 'MultiItemProductsController@StoreMultiItemDetails'));
    Route::any('dashboard/up_selling/product/{id}/store_quantity', array('as' => 'up_selling.store_quantity', 'uses' => 'MultiItemProductsController@StoreQuantity'));

    Route::any('dashboard/up_selling/product/store/new', array('as' => 'up_selling.store', 'uses' => 'MultiItemProductsController@storeMultiItem'));
    Route::any('dashboard/up_selling/product/{id}/edit-product', array('as' => 'up_selling.edit', 'uses' => 'MultiItemProductsController@editMultiItem'));
    Route::any('dashboard/up_selling/product/{id}/update', array('as' => 'up_selling.update', 'uses' => 'MultiItemProductsController@updateMultiItem'));
});
//----------------------------------------------------Bundle/Combo Product------------------------------------------------------------
Route::group(['prefix' => '', 'namespace' => 'backend\catalog\products',  'type'=>'bundle/combo', 'middleware' => 'permission'], function() {
        Route::resource('dashboard/combo/product', 'MultiItemProductsController', [
            'names' => [
                'create' => 'bundle/combo.create',
                'show' => 'bundle/combo.show',
            ],
        ]);
        Route::any('dashboard/combo/product/index/all', array('as' => 'bundle/combo.index', 'uses' => 'MultiItemProductsController@indexing'));
        Route::any('dashboard/combo/product/{id}/list', array('as' => 'bundle/combo.list', 'uses' => 'MultiItemProductsController@ListAll'));
        Route::any('dashboard/combo/product/store_item', array('as' => 'bundle/combo.store_item', 'uses' => 'MultiItemProductsController@StoreItem'));

        Route::any('dashboard/combo/product/{id}/add_product', array('as' => 'bundle/combo.add_product', 'uses' => 'MultiItemProductsController@AddProduct'));
        Route::any('dashboard/combo/product/search/auto', array('as' => 'bundle/combo.auto_search', 'uses' => 'MultiItemProductsController@AutoSearch'));

        Route::any('dashboard/combo/product/{id}/store_product', array('as' => 'bundle/combo.store_product', 'uses' => 'MultiItemProductsController@StoreProduct'));
        Route::any('dashboard/combo/product/{id}/remove_product', array('as' => 'bundle/combo.remove_product', 'uses' => 'MultiItemProductsController@RemoveProduct'));
        Route::any('dashboard/combo/product/{id}/add_multi_item_details', array('as' => 'bundle/combo.add_multi_item_details', 'uses' => 'MultiItemProductsController@AddMultiItemDetails'));
        Route::any('dashboard/combo/product/{id}/add_quantity', array('as' => 'bundle/combo.add_quantity', 'uses' => 'MultiItemProductsController@AddQuantity'));
        Route::any('dashboard/combo/product/{id}/toggle', array('as' => 'bundle/combo.toggle', 'uses' => 'MultiItemProductsController@toggle'));

        Route::any('dashboard/combo/product/{id}/store_multi_item_details', array('as' => 'bundle/combo.store_multi_item_details', 'uses' => 'MultiItemProductsController@StoreMultiItemDetails'));
        Route::any('dashboard/combo/product/{id}/store_quantity', array('as' => 'bundle/combo.store_quantity', 'uses' => 'MultiItemProductsController@StoreQuantity'));

        Route::any('dashboard/combo/product/store/new', array('as' => 'bundle/combo.store', 'uses' => 'MultiItemProductsController@storeMultiItem'));
        Route::any('dashboard/combo/product/{id}/edit-product', array('as' => 'bundle/combo.edit', 'uses' => 'MultiItemProductsController@editMultiItem'));
        Route::any('dashboard/combo/product/{id}/update', array('as' => 'bundle/combo.update', 'uses' => 'MultiItemProductsController@updateMultiItem'));

});
//------------------------------------------------Create Opportunities for product----------------------------------
Route::group(['prefix' => '', 'namespace' => 'backend\catalog\products', 'middleware' => 'permission'], function() {
        Route::any('dashboard/product/opportunity/products', array('as' => 'opportunities.product', 'uses' => 'OpportunitiesController@products'));
        Route::any('dashboard/product/opportunity/manage/{id}', array('as' => 'opportunities.manage', 'uses' => 'OpportunitiesController@manage'));
        Route::any('dashboard/product/opportunity/extract/{id}', array('as' => 'opportunities.extract', 'uses' => 'OpportunitiesController@extract'));
        Route::any('dashboard/product/opportunity/create/{id}', array('as' => 'opportunities.create', 'uses' => 'OpportunitiesController@create'));
        Route::any('dashboard/product/opportunity/save/{id}', array('as' => 'opportunities.save', 'uses' => 'OpportunitiesController@save'));
        Route::any('dashboard/product/opportunity/index', array('as' => 'opportunities.index', 'uses' => 'OpportunitiesController@index'));
        Route::any('dashboard/product/opportunity/{id}/toggle', array('as' => 'opportunities.toggle', 'uses' => 'OpportunitiesController@toggle'));
 });
 //---------------------------------------Import Products From excel-------------------------------------------------------------
 Route::group(['prefix' => '', 'namespace' => 'backend\catalog\products', 'middleware' => 'permission'], function(){
        Route::any('dashboard/Import/product/list_product', array('as' => 'import_product.list_product', 'uses' => 'ImportProductsController@ListProduct'));
        Route::any('dashboard/Import/product/{id}/detail', array('as' => 'import_product.detail', 'uses' => 'ImportProductsController@Detail'));
        Route::any('dashboard/Import/product/{id}/export', array('as' => 'import_product.export', 'uses' => 'ImportProductsController@Export'));
        Route::any('dashboard/Import/product/view_files', array('as' => 'import_product.view_files', 'uses' => 'ImportProductsController@viewFiles'));
        Route::any('dashboard/Import/product/download/{name}', array('as' => 'import_product.download', 'uses' => 'ImportProductsController@download'));
        Route::any('dashboard/Import/product/import', array('as' => 'import_product.import', 'uses' => 'ImportProductsController@Import'));
        Route::any('dashboard/Import/product/store', array('as' => 'import_product.store', 'uses' => 'ImportProductsController@store'));
        Route::any('dashboard/Import/product/edit/{id}', array('as' => 'import_product.edit', 'uses' => 'ImportProductsController@edit'));
        Route::any('dashboard/Import/product/update/{id}', array('as' => 'import_product.update', 'uses' => 'ImportProductsController@update'));
        Route::any('dashboard/Import/product/info', array('as' => 'import_product.info', 'uses' => 'ImportProductsController@ImportInfo'));
        Route::any('dashboard/Import/product/new_list/{id}', array('as' => 'import_product.new_list', 'uses' => 'ImportProductsController@NewList'));
        Route::any('dashboard/Import/product/toggle/{id}', array('as' => 'import_product.toggle', 'uses' => 'ImportProductsController@toggle'));
 });
 //--------------------------Page Help-----------------------------------------------

 Route::group(['middleware' => 'permission'], function() {
        Route::any('dashboard/item/product/{id}/edit-product', array('as' => 'product.edit', 'uses' => 'backend\catalog\products\ProductsController@editProduct'));
        Route::any('dashboard/item/product/{id}/destroy-product', array('as' => 'product.destroy', 'uses' => 'backend\catalog\products\ProductsController@deleteProduct'));
        Route::any('dashboard/item/product/{id}/update', array('as' => 'product.update', 'uses' => 'backend\catalog\products\ProductsController@updateProductInfo'));
        Route::any('dashboard/item/product/delete-image', array('as' => 'product.delete_image', 'uses' => 'backend\catalog\products\ProductsController@deleteProductImage'));
        Route::any('dashboard/site/product/toggle/{id}', array('as' => 'product.toggle', 'uses' => 'backend\catalog\products\ProductsController@toggleOnSite'));
});

//--------------------------Store Permissions for Team Member-----------------------------------------------
Route::any('dashboard/user/{id}/site/permissions/store', array('as' => 'store.permissions', 'uses' => 'backend\dashboard\UsersController@storeTeamMemberPermissions'));
Route::any('dashboard/user/site/permissions/{id}', array('as' => 'manage.permissions', 'uses' => 'backend\dashboard\UsersController@manageTeamMemberPermissions'));


Route::any('dashboard/page-help/instructions', array('as' => 'pagehelp.store', 'uses' => 'backend\dashboard\PageHelpController@store'));
Route::any('dashboard/page-help/instructions/view', array('as' => 'pagehelp.data', 'uses' => 'backend\dashboard\PageHelpController@HelpData'));


//Route::group(['prefix' => '', 'namespace' => 'backend\dashboard'], function() {
//    Route::resource('dashboard/page-help/', 'PageHelpController', [
//        'names' => [
//            'store' => 'pagehelp.store',
//        ],
//    ]);
// });