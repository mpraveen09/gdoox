<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route::get('/', function () {
//    return view('welcome'); 
//});

Route::get('/', function () {
    return Redirect::to("/home");//return Redirect::to("/home/en/home");//return view('welcome_en'); 
});

Route::get('/l/{locale?}/', function ($locale='en') {
    App::setLocale($locale);
//    return View::make('welcome_new', array('locale' => $locale));
    
    if($locale==="it"){
      return view('welcome_it');
    }elseif($locale==="es"){
      return view('welcome_es');
    }else{
      return view('welcome_en');
    }    
});

Route::get('/home', function () {
    return view('home'); 
});

/*--------------------------@Authentication routes...--------------------------------------------------------------------------------*/
// @Login routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// @Registration routes...
Route::get('auth/register', array('as'=>'get.register','uses'=> 'Auth\AuthController@getRegister'));
Route::post('auth/register', array('as'=>'post.register','uses'=> 'Auth\AuthController@postRegister'));
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

//@Password Reset

Route::get('password/email','Auth\PasswordController@getEmail');
Route::post('password/email','Auth\PasswordController@postEmail');
Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('password/reset/','Auth\PasswordController@postReset');

/*---------------------------------------------------------------------------------------------------------------------------------------------*/


Route::get('contact', function () {
    return view('contact');
});

Route::get('/index.php/contact', function () {
    return view('contact');
});


Route::any('contactus', 'ContactController@sendEmail');
Route::any('/index.php/contactus', 'ContactController@sendEmail');
//Route::get('contact', array('as' => 'contact','uses'=>'ContactController@sendEmail'));
//Route::get('contact', array('as' => 'contact_','uses'=>'ContactController@sendEmail'));

Route::get('404', function() {
    abort(404);
});

Route::get('500', function() {
    abort(500);
});

Route::get('/lang/{lang?}/', function ($lang=null) {
    if($lang==="it"){
      return view('it.welcome');
    }elseif($lang==="es"){
      return view('es.welcome');
    }else{
      return view('welcome');
    }
});

/*--------------------------@Dashboard routes...-------------------------------------------------------------------------------------*/

/* *@ Catalog Management routes (Categories, Attributes etc) ...-------------------------*/

Route::any('products','ProductsController@index');
Route::any('category','backend\CategoriesController@index');
Route::any('category/subcategories','backend\CategoriesController@subCategories');
Route::any('category/attributes','backend\CategoriesController@addCategoryAttributes');
Route::any('category/list','backend\CategoriesController@categoryList');
/*---------------------------------------------------------------------------------------------------------------------------------------------*/


include_once 'routes-deep.php';
include_once 'routes-sanjay.php';
include_once 'routes-mukesh.php';
include_once 'new-routes.php';
/*
"dashboard-user-profile",
"verify-fiscalvat-edit",
"verify-fiscalvat-update",
"verify-documents-edit",
"verify-documents-update",
"fetchcountry",
"business-info-index",
"business-info-create",
"business-info-store", 
"business-info-edit",
"business-info-update",
"business-info-show",
"ecomm-index",
"ecomm-create",
"ecomm-store",
"ecomm-edit",
"ecomm-update",
"ecomm-show",
"ecomm.siteadmin",
"personal-info-create",
"personal-info-edit",
"personal-info-update",
"social-info-create",
"social-info-edit",
"social-info-update",
"position.create",
"position.edit",
"position.update",
"interest-info-create",
"interest-info-edit",
"interest-info-update",
"relation-info-create",
"relation-info-edit",
"relation-info-update",
"acc_profile.edit",
"acc_profile.update",
"payment-method-index",
"payment-method-create",
"payment-method-edit",
"payment-method-store",
"payment-method-show",
"payment-method-update",
"dash-board",
"dashboard-index",
"user-store",
"user-show",
"user-edit",
"user-update",
"invite-user-create",
"invite-user-store",
"invite-multi-user-create",
"invite-multi-user-store",
"profile-index",
"profile-edit",
"profile-update",
"invite.colleague",
"invite.store_colleague",
"colleague.all",
"site.header.images.index",
"site.header.images.create",
"site.header.images.store",
"site.header.images.show",
"site.header.images.update",
"site.logo.index",
"site.logo.create",
"site.logo.store",
"site.logo.edit",
"site.logo.show",
"site.logo.update",
"user-allow",
"user-disallow",
"site_admin",
"site_admin.remove",
"user-deactive",
"activate",
"reactivate",
"permisson.denied",
"invite.company.index",
"invite.company.store",
"invite.company.show",
"invite.company.update",
"invite.company.status",
"invite.company.destroy",
"invite.inter.partner.create",
"join.request",
"partner.request",
"invite.inter.partner.store",
"invite.partner.resend",
"invite.ext.partner.create",
"invite.ext.partner.store",
"invite.partner.status",
"invite.partner.show",
"invite.partner.update",
"invite.partner.destroy",
"ecosys.site.index",
"ecosys.site.create",
"ecosys.site.store",
"ecosys.site.edit",
"ecosys.site.update",
"ecosys.site.show",
"ecosys.site.add",
"ecosys.site.storesite",
"ecosys.site.indexall",
"ecosys.product.index",
"products/list",
"products.toggle",
"share.site.index",
"share.site.create",
"share.site.store",
"share.site.edit",
"share.site.update",
"share.site.show",
"share.site.destroy",
"follower.index",
"follower.edit",
"follower.create",
"follower.update",
"follower.store",
"follower.all",
"sociallink.index",
"sociallink.create",
"sociallink.edit",
"sociallink.update",
"sociallink.show",
"sociallink.store",
"product_promo.index",
"product_promo.create",
"product_promo.edit",
"product_promo.show",
"product_promo.update",
"product_promo.show",
"product_promo.select_product",
"product_promo.toggle",
"multi_item.create",
"multi_item.index",
"multi_item.show",
"multi_item.list",
"multi_item.store_item",
"multi_item.add_product",
"multi_item.auto_search",
"multi_item.store_product",
"multi_item.remove_product",
"multi_item.add_multi_item_details",
"multi_item.add_quantity",
"multi_item.toggle",
"multi_item.store_multi_item_details",
"multi_item.store_quantity",
"multi_item.store",
"multi_item.edit",
"multi_item.update",
"cross_selling.create",
"cross_selling.index",
"cross_selling.show",
"cross_selling.list",
"cross_selling.store_item",
"cross_selling.add_product",
"cross_selling.auto_search",
"cross_selling.store_product",
"cross_selling.remove_product",
"cross_selling.add_multi_item_details",
"cross_selling.add_quantity",
"cross_selling.toggle",
"cross_selling.store_multi_item_details",
"cross_selling.store_quantity",
"cross_selling.store",
"cross_selling.edit",
"cross_selling.update",
"up_selling.create",
"up_selling.index",
"up_selling.show",
"up_selling.list",
"up_selling.store_item",
"up_selling.add_product",
"up_selling.auto_search",
"up_selling.store_product",
"up_selling.remove_product",
"up_selling.add_multi_item_details",
"up_selling.add_quantity",
"up_selling.toggle",
"up_selling.store_multi_item_details",
"up_selling.store_quantity",
"up_selling.store",
"up_selling.edit",
"up_selling.update",
"bundle/combo.create",
"bundle/combo.index",
"bundle/combo.show",
"bundle/combo.list",
"bundle/combo.store_item",
"bundle/combo.add_product",
"bundle/combo.auto_search",
"bundle/combo.store_product",
"bundle/combo.remove_product",
"bundle/combo.add_multi_item_details",
"bundle/combo.add_quantity",
"bundle/combo.toggle",
"bundle/combo.store_multi_item_details",
"bundle/combo.store_quantity",
"bundle/combo.store",
"bundle/combo.edit",
"bundle/combo.update",
"opportunities.product",
"opportunities.manage",
"opportunities.extract",
"opportunities.create",
"opportunities.save",
"opportunities.index",
"opportunities.toggle",
"import_product.list_product",
"import_product.detail",
"import_product.export",
"import_product.view_files",
"import_product.download",
"import_product.import",
"import_product.store",
"import_product.edit",
"import_product.update",
"import_product.info",
"import_product.new_list",
"import_product.toggle",
      "fetchsubcats",
      "fetchcatancestors",
      "products/add",
      "products/save",
      "products/show",
      "products/edit",
      "marketplace",
      "site",
      "{shopid}/show/",
      "businessinfo.page",
      "contact.page",
      "partners.page",
      "message.send",
      "cms.page",
      "site.productcatalog.page",
      "site.productcatalog.show",
      "cms.storetemp",
      "{shopid}/reviews",
      "underdev",
     "cat_search",
      "auto_search_cat",
      "attr_search",
      "auto_search_attr",
      "searchcategory",
      "search_product_cat",
      "user_search",
      "search-business",
      "company-details/{id}",
      "auto_search_shop_categ",
      "auto_search_all",
      "auto_search_shop_all_categ",
      "add_to_cart",
      "view_cart",
      "cart_add_qty",
      "cart_remove_item",
      "view_cart_list",
      "add_to_wishlist",
      "show-wishlist",
      "remove_wishlist_item",
      "abandoned_cart",
      "view_abandoned_cart",
      "cms.index",
      "cms.create",
      "cms.store",
      "cms.edit",
      "cms.update",
      "userreview.index",
      "userreview.create",
      "userreview.store",
      "userreview.edit",
      "userreview.update",
      "userreview.show",
      "sellerreview.index",
      "sellerreview.create",
      "sellerreview.store",
      "sellerreview.edit",
      "sellerreview.update",
      "sellerreview.show",
      "seller_review",
      "seller_reviews",
      "seller_review_details",
      "productcatalog",
      "addcatalog/{store}",
      "certificationlogos",
      "addlogos/{store}",
      "'productcatalog.edit",
      "'productcatalog.update",
      "'productcatalog.show",
      "'productcatalog.delete",
      "'productcatalog.store",
      "certificationlogos.edit",
      "certificationlogos.update",
      "certificationlogos.destroy",
      "certificationlogos.store",
      "certificationlogos.show",
      "distributionnetwork.create",
      "distributionnetwork.store",
      "distributionnetwork.edit",
      "distributionnetwork.update",
      "distributionnetwork.show",
      "view_network",
      "search_network",
      "auto_search_network",
      "business-sectors-index",
      "business-sectors-create",
      "business-sectors-store",
      "business-sectors-edit",
      "business-sectors-update",
      "personal-sites-index",
      "personal-sites-create",
      "personal-sites-store",
      "personal-sites-edit",
      "personal-sites-update",
      "general-info-index",
      "general-info-create",
      "general-info-store",
      "general-info-edit",
      "general-info-update",
      "professional-skills-index",
      "professional-skills-create",
      "professional-skills-store",
      "professional-skills-edit",
      "professional-skills-update",
      "other-info-index",
      "other-info-create",
      "other-info-store",
      "other-info-edit",
      "other-info-update",
      "competencies-index",
      "competencies-create",
      "competencies-store",
      "competencies-edit",
      "competencies-update",
      "create-personal-site-index",
      "create-personal-site-create",
      "create-personal-site-store",
      "create-personal-site-edit",
      "create-personal-site-update",
      "personal-about-us-store",
      "personal-about-us-create",
      "personal-about-us-update",
      "personal-about-us-edit",
      "references-store",
      "references-edit",
      "references-create",
      "references-update",
      "sponsors-store",
      "sponsors-edit",
      "sponsors-create",
      "sponsors-update",
      "sponsors-store",
      "sponsors-create",
      "sponsors-edit",
      "sponsors-update",
      "computerskills.page",
      "otherskills.pag",
      "otherinfo.page",
      "languages.page",
      "educationandtraining.page",
      "aboutus.page",
      "site.competencies",
      "invited-business-partners.select_partner",
      "invited-business-partners.list_products",
      "invited-business-partners.share_product",
      "invited-business-partners.unshare_product",
      "share_this_product",
      "store_shared_product",
      "import-ecom-products.select_ecom",
      "import-ecom-products.select_shared_site",
      "import-ecom-products.import_products",
      "import-ecom-products.list_company",
      "import-ecom-products.list_site",
      "import-ecom-products.import_my_products",
      "tasks.index",
      "tasks.create",
      "tasks.store",
      "tasks.edit",
      "tasks.update",
      "tasks.show",
      "crm_users.index",
      "crm_users.create",
      "crm_users.store",
      "crm_users.edit",
      "crm_users.update",
      "crm_users.show",
      "crm_accounts.index",
      "crm_accounts.create",
      "crm_accounts.store",
      "crm_accounts.edit",
      "crm_accounts.update",
      "crm_accounts.show",
      "crm_opportunities.index",
      "crm_opportunities.create",
      "crm_opportunities.store",
      "crm_opportunities.edit",
      "crm_opportunities.update",
      "crm_opportunities.show",
      "crm_groups.index",
      "crm_groups.create",
      "crm_groups.store",
      "crm_groups.edit",
      "crm_groups.update",
      "crm_groups.show",
      "crm_contacts.index",
      "crm_contacts.create",
      "crm_contacts.store",
      "crm_contacts.edit",
      "crm_contacts.update",
      "crm_contacts.show",
      "crm_contacts.columns",
      "crm_contacts.create_excel",
      "crm_contacts.upload_excel",
      "crm_contacts.import_excel",
      "crm_contacts.save_custom_fields",
      "crm_contactsgroup.index",
      "crm_contactsgroup.create",
      "crm_contactsgroup.store",
      "crm_contactsgroup.edit",
      "crm_contactsgroup.update",
      "crm_contactsgroup.show",
      "group_contacts",
      "crm_emails.index",
      "crm_emails.create",
      "crm_emails.store",
      "crm_emails.edit",
      "crm_emails.update",
      "crm_emails.show",
      "search_email_id",
      "crm_emails.drafts",
      "select_template",
      "crm_templates.index",
      "crm_templates.create",
      "crm_templates.store",
      "crm_templates.edit",
      "crm_templates.update",
      "crm_templates.show",
      "get_variable_values",
      "select_group",
      "crm_select_user",
      "add_user_to_group",
      "exceptions.index",
      "exceptions.create",
      "exceptions.store",
      "exceptions.edit",
      "exceptions.update",
      "exceptions.show",
      "checkout.index",
      "checkout.create",
      "checkout.store",
      "checkout.edit",
      "checkout.update",
      "checkout.show",
"checkout.index",
"checkout.create",
 "checkout.store",
 "checkout.edit",
 "checkout.update",
 "checkout.show",
"chat.index",
"chat.create",
"chat.store",
"chat.edit",
"chat.update",
"chat.show",
"startchat"
*/
/*@personal
 * 
 "personal-site-store",
"personal-site-edit",
"personal-site-update",
"personal-select_cat-index",
"personal-select_cat-store",
"personal-select_cat-edit",
"personal-select_cat-update",
"jobdetail.create",
"jobdetail.edit",
"jobdetail.update",
"jobdetail.delete",
"personal.job.page",
"personal.contact.page",
"personal.message.send",
*/