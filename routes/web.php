<?php

use App\Http\Controllers;
use App\Http\Controllers\AdminAssetController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminDriverController;
use App\Http\Controllers\AdminHrController;
use App\Http\Controllers\AdminOperationController;
use App\Http\Controllers\AdminOtherPartnerController;
use App\Http\Controllers\AdminPartnerController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminSupplierController;
use App\Http\Controllers\OtherPartnerController;
use App\Http\Controllers\OtherPartnerDeliveryController;
use App\Http\Controllers\OtherPartnerPaymentController;
use App\Http\Controllers\OtherPartnerPrimeController;
use App\Http\Controllers\OtherPartnerReportController;
use App\Http\Controllers\OtherPartnerSettingController;
use App\Http\Controllers\PartnerBagController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PartnerCustomerController;
use App\Http\Controllers\PartnerDeliveryController;
use App\Http\Controllers\PartnerPaymentController;
use App\Http\Controllers\PartnerPrimeController;
use App\Http\Controllers\PartnerReportController;
use App\Http\Controllers\PartnerSettingController;
use App\Http\Controllers\PartnerChatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerAppController;
use App\Http\Controllers\CollectorAppController;
use App\Http\Controllers\DriverAppController;
use App\Http\Controllers\SupplierProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// default route is login/partners
Route::get('/', function() {

    return redirect()->route('admin.login');
});









// ============== LOGINS 

// users
Route::get('login/users', [AdminController::class, 'login'])->name('admin.login');
Route::post('login/users/checkuser', [AdminController::class, 'checkuser'])->name('admin.checkuser');

Route::get('user/logout', [AdminController::class, 'logout'])->name('admin.logout');


// restaurants
Route::get('login/restaurants', [PartnerController::class, 'login'])->name('partner.login');
Route::post('login/restaurants/checkuser', [PartnerController::class, 'checkuser'])->name('partner.checkuser');

Route::get('restaurant/logout', [PartnerController::class, 'logout'])->name('partner.logout');


// other partners
Route::get('login/partners', [OtherPartnerController::class, 'login'])->name('otherpartner.login');
Route::post('login/partners/checkuser', [OtherPartnerController::class, 'checkuser'])->name('otherpartner.checkuser');

Route::get('partner/logout', [OtherPartnerController::class, 'logout'])->name('otherpartner.logout');





// ============ ADMIN ROUTES



View::composer('layouts.admin', function ($view) {
    $modules = array();

    $user_role =  DB::table('user_roles')
        ->where('user_id', Session::get('user_id'))
        ->first();

    if ($user_role) {
        $permissions =  DB::table('permissions')
            ->where('access', 1)
            ->where('role_id',  $user_role->role_id)
            ->get();

        foreach ($permissions as $perm) {
            $modules[]  =  $perm->modulename;
        }
    } else {
        $modules[] = "";
    }

    $view->with('modules', $modules);
});




// dashboard
Route::get('admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');


// remove notification
Route::post('admin/removeNotification', [AdminController::class, 'removenotifications'])->name('admin.removenotifications');


// operation related (deliveries)
Route::post('admin/add-onetimeorder-driver', [AdminController::class, 'addonetimeorderdriver'])->name('admin.addonetimeorderdriver');


// operation related (deliveries)
Route::post('admin/add-partner-onetimeorder-driver', [AdminController::class, 'addothersingleordersdrivermain'])->name('admin.addothersingleordersdrivermain');




// ===================================================

// messages chat
Route::view('/admins/chats', 'chat');
Route::resource('messages', 'MessageController')->only([
    'index',
    'store'
]);



// =====================================================

// lock screen and unlock
Route::get('admin/lock', [AdminController::class, 'adminlock'])->name('admin.adminlock');

Route::post('admin/unlock', [AdminController::class, 'adminunlock'])->name('admin.adminunlock');



// =============================================


Route::get('admin/profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
Route::post('admin/profile/update', [AdminProfileController::class, 'updateprofile'])->name('admin.updateprofile');


// ===========================================







// Partners
Route::get('admin/partners', [AdminPartnerController::class, 'partners'])->name('admin.partners');

Route::get('admin/partners/manage', [AdminPartnerController::class, 'managepartners'])->name('admin.managepartners');

Route::get('admin/partners/requests', [AdminPartnerController::class, 'requestpartners'])->name('admin.requestpartners');



// ---- operation on partner
Route::post('admin/partners/add-partner', [AdminPartnerController::class, 'addpartner'])->name('admin.addpartner');

// search
Route::post('admin/partners/search-partner-main', [AdminPartnerController::class, 'searchpartnermain'])->name('admin.searchpartnermain');

Route::post('admin/partners/search-partner', [AdminPartnerController::class, 'searchpartner'])->name('admin.searchpartner');

// edit update
Route::post('admin/partners/edit-partner', [AdminPartnerController::class, 'editpartner'])->name('admin.editpartner');

Route::post('admin/partners/update-partner', [AdminPartnerController::class, 'updatepartner'])->name('admin.updatepartner');


Route::post('admin/partners/delete-partner', [AdminPartnerController::class, 'deletepartner'])->name('admin.deletepartner');





// ================================================================




// Other Partners
Route::get('admin/otherpartners', [AdminOtherPartnerController::class, 'otherpartners'])->name('admin.otherpartners');

Route::get('admin/otherpartners/manage', [AdminOtherPartnerController::class, 'manageotherpartners'])->name('admin.manageotherpartners');

Route::get('admin/otherpartners/requests', [AdminOtherPartnerController::class, 'requestotherpartners'])->name('admin.requestotherpartners');



// ---- operation on partner
Route::post('admin/otherpartners/add-otherpartner', [AdminOtherPartnerController::class, 'addotherpartner'])->name('admin.addotherpartner');

// search
Route::post('admin/otherpartners/search-otherpartner-main', [AdminOtherPartnerController::class, 'searchotherpartnermain'])->name('admin.searchotherpartnermain');

Route::post('admin/otherpartners/search-otherpartner', [AdminOtherPartnerController::class, 'searchotherpartner'])->name('admin.searchotherpartner');

// edit update
Route::post('admin/otherpartners/edit-otherpartner', [AdminOtherPartnerController::class, 'editotherpartner'])->name('admin.editotherpartner');

Route::post('admin/otherpartners/update-otherpartner', [AdminOtherPartnerController::class, 'updateotherpartner'])->name('admin.updateotherpartner');


Route::post('admin/otherpartners/delete-otherpartner', [AdminOtherPartnerController::class, 'deleteotherpartner'])->name('admin.deleteotherpartner');





// ==============================================================


// Suppliers
Route::get('admin/suppliers', [AdminSupplierController::class, 'suppliers'])->name('admin.suppliers');

Route::get('admin/suppliers/manage', [AdminSupplierController::class, 'managesuppliers'])->name('admin.managesuppliers');



// ---- operation on suppliers
Route::post('admin/suppliers/add-suppliers', [AdminSupplierController::class, 'addsupplier'])->name('admin.addsupplier');


Route::post('admin/suppliers/update-suppliers', [AdminSupplierController::class, 'updatesupplier'])->name('admin.updatesupplier');



// =================================================================




// drivers
Route::get('admin/drivers', [AdminDriverController::class, 'drivers'])->name('admin.drivers');

Route::post('admin/drivers/delete-driver', [AdminDriverController::class, 'deletedriver'])->name('admin.deletedriver');




Route::get('admin/drivers/manage', [AdminDriverController::class, 'managedrivers'])->name('admin.managedrivers');
Route::get('admin/drivers/requests', [AdminDriverController::class, 'requestdrivers'])->name('admin.requestdrivers');
Route::get('admin/drivers/settings', [AdminDriverController::class, 'settingdrivers'])->name('admin.settingdrivers');


// ----- operation on drivers
Route::post('admin/drivers/add-driver', [AdminDriverController::class, 'adddriver'])->name('admin.adddriver');

// search
Route::post('admin/drivers/search-driver-main', [AdminDriverController::class, 'searchdrivermain'])->name('admin.searchdrivermain');

Route::post('admin/drivers/search-driver', [AdminDriverController::class, 'searchdriver'])->name('admin.searchdriver');

// edit update
Route::post('admin/drivers/edit-driver', [AdminDriverController::class, 'editdriver'])->name('admin.editdriver');

Route::post('admin/drivers/update-driver', [AdminDriverController::class, 'updatedriver'])->name('admin.updatedriver');






// =================================================================




// customers
Route::get('admin/customers', [AdminCustomerController::class, 'customers'])->name('admin.customers');



Route::get('admin/customers/manage', [AdminCustomerController::class, 'managecustomers'])->name('admin.managecustomers');


// related to suppliers only
Route::get('admin/customers/orders', [AdminSupplierController::class, 'customersorders'])->name('admin.customersorders');



// search
Route::post('admin/customers/search-customer-main', [AdminCustomerController::class, 'searchcustomermain'])->name('admin.searchcustomermain');

Route::post('admin/customers/search-customer', [AdminCustomerController::class, 'searchcustomer'])->name('admin.searchcustomer');


// add special order driver

Route::post('admin/customers/add-specialorder-driver', [AdminCustomerController::class, 'addspecialorderdriver'])->name('admin.addspecialorderdriver');


// operation related (deliveries)
Route::post('admin/customers/add-onetimeorder-driver', [AdminCustomerController::class, 'addonetimeorderdriver'])->name('admin.addonetimeorderdriver_customers');







// =================================================================





// operations
Route::get('admin/operations/all-orders', [AdminOperationController::class, 'allorders'])->name('admin.allorders');

// functions inside
Route::get('admin/operations/all-orders/search-all-orders', [AdminOperationController::class, 'searchallorders'])->name('admin.searchallorders');

Route::get('admin/operations/all-orders/search-collected-orders', [AdminOperationController::class, 'searchcollectedorders'])->name('admin.searchcollectedorders');

Route::get('admin/operations/all-orders/search-other-singleorders', [AdminOperationController::class, 'searchothersingleorders'])->name('admin.searchothersingleorders');


// -----

Route::get('admin/operations/today-orders', [AdminOperationController::class, 'todayorders'])->name('admin.todayorders');

Route::post('admin/operations/today-orders/search-today-orders', [AdminOperationController::class, 'searchtodayorders'])->name('admin.searchtodayorders');






// ------



Route::get('admin/operations/tracking', [AdminOperationController::class, 'tracking'])->name('admin.tracking');

Route::post('admin/operations/tracking/filter', [AdminOperationController::class, 'filtertracking'])->name('admin.filtertracking');



// -----


Route::get('admin/operations/health', [AdminOperationController::class, 'healthoperations'])->name('admin.healthoperations');

Route::post('admin/operations/health/add-order-driver', [AdminOperationController::class, 'addorderdriver'])->name('admin.addorderdriver');

Route::post('admin/operations/health/add-collectedorder-driver', [AdminOperationController::class, 'addcollectedorderdriver'])->name('admin.addcollectedorderdriver');


Route::post('admin/operations/health/add-singleorder-driver', [AdminOperationController::class, 'addsingleordersdriver'])->name('admin.addsingleordersdriver');




Route::post('admin/operations/health/add-othersingleorder-driver', [AdminOperationController::class, 'addothersingleordersdriver'])->name('admin.addothersingleordersdriver');





// -----

Route::get('admin/operations/payments', [AdminOperationController::class, 'payments'])->name('admin.payments');

Route::get('admin/operations/partners-payment', [AdminOperationController::class, 'otherpayments'])->name('admin.otherpayments');

Route::post('admin/operations/payments/confirm', [AdminOperationController::class, 'confirmpayment'])->name('admin.confirmpayment');



Route::post('admin/operations/payments/confirm-single', [AdminOperationController::class, 'confirmsinglepayment'])->name('admin.confirmsinglepayment');

Route::post('admin/operations/payments/confirm-others', [AdminOperationController::class, 'confirmotherpayment'])->name('admin.confirmotherpayment');





// ----------- 
// related to suppliers only
Route::get('admin/operations/dispatched-products', [AdminSupplierController::class, 'dispatchedproducts'])->name('admin.dispatchedproducts');


Route::post('admin/operations/dispatched-products/received', [AdminSupplierController::class, 'receiveproducts'])->name('admin.receiveproducts');


Route::get('admin/operations/dispatched-products/canceled/{dispatchid}', [AdminSupplierController::class, 'cancelproducts'])->name('admin.cancelproducts');






// ----------- 
// inventory products
Route::get('admin/operations/inventory-products', [AdminSupplierController::class, 'inventoryproducts'])->name('admin.inventoryproducts');


Route::get('admin/operations/inventory-products/{id}', [AdminSupplierController::class, 'singleproduct'])->name('admin.singleproduct');



// =================================================================




// assets
Route::get('admin/assets', [AdminAssetController::class, 'assets'])->name('admin.assets');

Route::post('admin/assets/add-asset', [AdminAssetController::class, 'addasset'])->name('admin.addasset');

Route::post('admin/assets/search-assets', [AdminAssetController::class, 'searchassets'])->name('admin.searchassets');


Route::post('admin/assets/edit-asset', [AdminAssetController::class, 'editassets'])->name('admin.editassets');


Route::post('admin/assets/update-asset', [AdminAssetController::class, 'updateassets'])->name('admin.updateassets');

Route::post('admin/assets/delete-asset', [AdminAssetController::class, 'deleteassets'])->name('admin.deleteassets');



// =====================================================================


// reports
Route::get('admin/reports/restaurants-reports', [AdminReportController::class, 'restaurantsreports'])->name('admin.restaurantsreports');

Route::get('admin/reports/restaurants-reports/search-regular', [AdminReportController::class, 'searchrestaurantsreports'])->name('admin.searchrestaurantsreports');

Route::get('admin/reports/restaurants-reports/search-single', [AdminReportController::class, 'searchsinglerestaurantsreports'])->name('admin.searchsinglerestaurantsreports');



Route::get('admin/reports/partners-reports', [AdminReportController::class, 'partnersreports'])->name('admin.partnersreports');

Route::get('admin/reports/partners-reports/search-single', [AdminReportController::class, 'searchpartnersreports'])->name('admin.searchpartnersreports');



Route::get('admin/reports/payments-reports', [AdminReportController::class, 'paymentsreports'])->name('admin.paymentsreports');

Route::get('admin/reports/payments-reports/search-regular', [AdminReportController::class, 'searchpaymentsreports'])->name('admin.searchpaymentsreports');




// ======================================================================



// settings

// general settings
Route::get('admin/settings/general-settings', [AdminSettingController::class, 'generalsettings'])->name('admin.generalsettings');


Route::post('admin/settings/general-settings/update', [AdminSettingController::class, 'updategeneralsettings'])->name('admin.updategeneralsettings');




// service settings
Route::get('admin/settings/service-settings', [AdminSettingController::class, 'servicesettings'])->name('admin.servicesettings');


Route::post('admin/settings/service-settings/add-charge', [AdminSettingController::class, 'addcharge'])->name('admin.addcharge');



Route::post('admin/settings/service-settings/edit-charge', [AdminSettingController::class, 'editcharge'])->name('admin.editcharge');


// new
Route::post('admin/settings/service-settings/add-supplier-charge', [AdminSettingController::class, 'addsuppliercharge'])->name('admin.addsuppliercharge');

Route::post('admin/settings/service-settings/edit-supplier-charge', [AdminSettingController::class, 'editsuppliercharge'])->name('admin.editsuppliercharge');


Route::post('admin/settings/service-settings/add-othercharge', [AdminSettingController::class, 'addothercharge'])->name('admin.addothercharge');

Route::post('admin/settings/service-settings/edit-othercharge', [AdminSettingController::class, 'editothercharge'])->name('admin.editothercharge');














// ====================================================================





// ============ PARTNER ROUTES



// dashboard
Route::get('restaurant', [PartnerController::class, 'dashboard'])->name('partner.dashboard');


// remove notification
Route::post('restaurant/removeNotification', [PartnerController::class, 'removenotifications'])->name('partner.removenotifications');



// add extra days (also used in custmer)
Route::post('restaurant/renew-customer', [PartnerController::class, 'renewcustomer'])->name('partner.renewcustomerdash');


Route::post('restaurant/customer/update-customer-deliverydays', [PartnerCustomerController::class, 'updatecustomerdeliverydays'])->name('partner.update.customerdeliverydays');

// =====================================================

// lock screen and unlock
Route::get('restaurant/lock', [PartnerController::class, 'partnerlock'])->name('partner.partnerlock');

Route::post('restaurant/unlock', [PartnerController::class, 'partnerunlock'])->name('partner.partnerunlock');



// ======================================================



// customers
Route::get('restaurant/customers', [PartnerCustomerController::class, 'customers'])->name('partner.customers');



Route::get('restaurant/customers/manage', [PartnerCustomerController::class, 'managecustomers'])->name('partner.managecustomers');


Route::get('restaurant/customer/customer-info/{customer_id}', [PartnerCustomerController::class, 'customerinfo'])->name('partner.customer.info');

Route::post('restaurant/customer/update-customer-info', [PartnerCustomerController::class, 'updatecustomerinfo'])->name('partner.update.customer.info');


// renew requests
Route::get('restaurant/customers/renew-requests', [PartnerCustomerController::class, 'renewrequests'])->name('partner.renewrequests');


// freeze requests
Route::get('restaurant/customers/freeze-requests', [PartnerCustomerController::class, 'freezerequests'])->name('partner.freezerequests');




// ----- operation on customers

Route::post('restaurant/customers/add-customer', [PartnerCustomerController::class, 'addcustomer'])->name('partner.addcustomer');

// search
Route::post('restaurant/customers/search-customer-main', [PartnerCustomerController::class, 'searchcustomermain'])->name('partner.searchcustomermain');

Route::post('restaurant/customers/search-customer', [PartnerCustomerController::class, 'searchcustomer'])->name('partner.searchcustomer');


// freeze
Route::post('restaurant/customers/freeze-customer', [PartnerCustomerController::class, 'freezeorders'])->name('partner.freezeorders');




// freeze requests
Route::post('restaurant/customers/freeze-requests/confirm', [PartnerCustomerController::class, 'confirmfreezerequest'])->name('partner.confirmfreezerequest');



// edit update
Route::post('restaurant/customers/edit-customer', [PartnerCustomerController::class, 'editcustomer'])->name('partner.editcustomer');

Route::post('restaurant/customers/update-customer', [PartnerCustomerController::class, 'updatecustomer'])->name('partner.updatecustomer');


// renew customer
Route::post('restaurant/customers/renew-customer-main', [PartnerCustomerController::class, 'renewcustomermain'])->name('partner.renewcustomermain');

Route::post('restaurant/customers/renew-customer', [PartnerCustomerController::class, 'renewcustomer'])->name('partner.renewcustomer');



// delete customer and its orders
Route::post('restaurant/customers/delete-customer', [PartnerCustomerController::class, 'deletecustomer'])->name('partner.deletecustomer');


// ======================================================


// deliveries (one time order)
Route::get('restaurant/deliveries', [PartnerDeliveryController::class, 'deliveries'])->name('partner.deliveries');


// make singleorder
Route::post('restaurant/deliveries/add-singledelivery', [PartnerDeliveryController::class, 'addsingleorder'])->name('partner.addsingleorder');

// search
Route::post('restaurant/deliveries/search-deliveries', [PartnerDeliveryController::class, 'searchregulardeliveries'])->name('partner.searchregulardeliveries');



// cancel orders and single orders
Route::post('restaurant/deliveries/cancel-delivery', [PartnerDeliveryController::class, 'cancelorder'])->name('partner.cancelorder');

Route::post('restaurant/deliveries/cancel-singledelivery', [PartnerDeliveryController::class, 'cancelsingleorder'])->name('partner.cancelsingleorder');







// ===================================================================




// payments
Route::get('restaurant/payments/collected-cash', [PartnerPaymentController::class, 'collectedcash'])->name('partner.collectedcash');

Route::post('restaurant/payments/collected-cash/confirm', [PartnerPaymentController::class, 'confirmcollectedcash'])->name('partner.confirmcollectedcash');






// =====================================================================



// reports 
Route::get('restaurant/reports', [PartnerReportController::class, 'alldeliveryreports'])->name('partner.alldeliveryreports');

Route::post('restaurant/reports/regular-search', [PartnerReportController::class, 'searchalldeliveryreports'])->name('partner.searchalldeliveryreports');

Route::post('restaurant/reports/single-search', [PartnerReportController::class, 'searchallsingledeliveryreports'])->name('partner.searchallsingledeliveryreports');





// =======================================================================


// bags
Route::get('restaurant/bags', [PartnerBagController::class, 'bags'])->name('partner.bags');

Route::post('restaurant/bags/search', [PartnerBagController::class, 'searchbags'])->name('partner.searchbags');






// ====================================================================

// chats
Route::get('restaurant/chats/drivers', [PartnerChatController::class, 'driverschat'])->name('partner.driverschat');
Route::post('restaurant/chats/drivers', [PartnerChatController::class, 'sendmessagedriver'])->name('partner.sendmessagedriver');


Route::get('restaurant/chats/customers', [PartnerChatController::class, 'customerschat'])->name('partner.customerschat');

Route::post('restaurant/chats/customers', [PartnerChatController::class, 'sendmessagecustomer'])->name('partner.sendmessagecustomer');


//====================================================================================


// settings
Route::get('restaurant/settings/general', [PartnerSettingController::class, 'general'])->name('partner.general');

Route::post('restaurant/settings/general/update', [PartnerSettingController::class, 'updategeneral'])->name('partner.updategeneral');






// ======================================================================


// primes 
Route::get('restaurant/primeware', [PartnerPrimeController::class, 'prime'])->name('partner.prime');

Route::post('restaurant/primeware/update', [PartnerPrimeController::class, 'updateprime'])->name('partner.updateprime');





Route::get('restaurant/ads', [PartnerPrimeController::class, 'ads'])->name('partner.ads');
Route::post('restaurant/addads', [PartnerPrimeController::class, 'addads'])->name('partner.addads');
Route::post('restaurant/deleteads', [PartnerPrimeController::class, 'deleteads'])->name('partner.deleteads');


// ======================================================================




// ============ OTHER PARTNER ROUTES



// dashboard
Route::get('partner', [OtherPartnerController::class, 'dashboard'])->name('otherpartner.dashboard');


// remove notification
Route::post('partner/removeNotification', [OtherPartnerController::class, 'removenotifications'])->name('otherpartner.removenotifications');


// cancel order in dashboard
Route::post('partner/cancel-singledelivery', [OtherPartnerController::class, 'cancelsingleorder'])->name('otherpartner.cancelsingleordermain');



// =====================================================

// lock screen and unlock
Route::get('partner/lock', [OtherPartnerController::class, 'otherpartnerlock'])->name('otherpartner.otherpartnerlock');

Route::post('partner/unlock', [OtherPartnerController::class, 'otherpartnerunlock'])->name('otherpartner.otherpartnerunlock');




// ======================================================


// deliveries (single order)
Route::get('partner/deliveries', [OtherPartnerDeliveryController::class, 'deliveries'])->name('otherpartner.deliveries');


// make singleorder
Route::post('partner/deliveries/add-singledelivery', [OtherPartnerDeliveryController::class, 'addsingleorder'])->name('otherpartner.addsingleorder');

// search
Route::post('partner/deliveries/search-deliveries', [OtherPartnerDeliveryController::class, 'searchregulardeliveries'])->name('otherpartner.searchregulardeliveries');


Route::post('partner/deliveries/cancel-singledelivery', [OtherPartnerDeliveryController::class, 'cancelsingleorder'])->name('otherpartner.cancelsingleorder');




// =====================================================================



// reports 
Route::get('partner/reports', [OtherPartnerReportController::class, 'alldeliveryreports'])->name('otherpartner.alldeliveryreports');

Route::post('partner/reports/search', [OtherPartnerReportController::class, 'searchalldeliveryreports'])->name('otherpartner.searchalldeliveryreports');






// =====================================================================


// payments
Route::get('partner/payments/collected-cash', [OtherPartnerPaymentController::class, 'collectedcash'])->name('otherpartner.collectedcash');

Route::post('partner/payments/collected-cash/confirm', [OtherPartnerPaymentController::class, 'confirmcollectedcash'])->name('otherpartner.confirmcollectedcash');







// ====================================================================


// settings
Route::get('partner/settings/general', [OtherPartnerSettingController::class, 'general'])->name('otherpartner.general');

Route::post('partner/settings/general/update', [OtherPartnerSettingController::class, 'updategeneral'])->name('otherpartner.updategeneral');





// =======================================================================


// primes 
Route::get('partner/primeware', [OtherPartnerPrimeController::class, 'prime'])->name('otherpartner.prime');

Route::post('partner/primeware/update', [OtherPartnerPrimeController::class, 'updateprime'])->name('otherpartner.updateprime');





// =======================================================================




//  OTHER ROUTES EXTENDED VERSION

//HR
Route::get('admin/hr/departments', [AdminHrController::class, 'departments'])->name('admin.departments');
Route::post('admin/hr/add-department', [AdminHrController::class, 'add_department'])->name('add.department');
Route::get('admin/hr/delete-department/{dept_id}',[AdminHrController::class, 'delete_department'])->name('delete.department');

Route::get('admin/hr/employees',[AdminHrController::class, 'employees'])->name('admin.employees');
Route::post('admin/hr/add/employees',[AdminHrController::class, 'addemployee'])->name('admin.add.employee');
Route::post('admin/hr/update/password',[AdminHrController::class, 'updatepassword'])->name('admin.update.password');

Route::get('admin/hr/roles',[AdminHrController::class, 'roles'])->name('admin.roles');

Route::post('admin/hr/add-role',[AdminHrController::class, 'addrole'])->name('admin.add.role');

Route::get('admin/hr/delete-role/{role_id}',[AdminHrController::class, 'deleterole'])->name('admin.delete.role');

Route::post('admin/hr/add-user-permission', [AdminHrController::class, 'adduserrole'])->name('admin.add.user.role');

Route::get('admin/hr/leave',[AdminHrController::class, 'leave'])->name('admin.leave');
Route::post('admin/hr/add-leave', [AdminHrController::class, 'addleave'])->name('admin.add.leave');
Route::get('admin/hr/delete-leave/{leave_id}', [AdminHrController::class, 'deleteleave'])->name('admin.delete.leave');




// =======================================================================

//  Supplier  ROUTES

// ------- login
Route::get('supplier/login',[SupplierController::class, 'login'])->name('supplier.login');

Route::get('supplier/logout', [SupplierController::class, 'logout'])->name('supplier.logout');

Route::post('supplier/check-login',[SupplierController::class, 'checklogin'])->name('supplier.check.login');


// ----- signup
Route::get('customer/purchase', [SupplierController::class, 'purchase'])->name('supplier.purchase');

Route::post('customer/purchase/create', [SupplierController::class, 'addpurchase'])->name('supplier.addpurchase');

Route::get('customer/purchase/{purchaseid}', [SupplierController::class, 'purchaseInvoice'])->name('supplier.purchaseInvoice');


// ----- dashboard
Route::get('supplier/dashboard',[SupplierController::class, 'dashboard'])->name('supplier.home');




// ------ products
Route::get('supplier/products',[SupplierProductController::class, 'products'])->name('supplier.products');

Route::post('supplier/products/create',[SupplierProductController::class, 'addproduct'])->name('supplier.addproduct');


Route::get('supplier/products/{id}/edit', [SupplierProductController::class, 'editproduct'])->name('supplier.editproduct');

Route::post('supplier/products/edit/update', [SupplierProductController::class, 'updateproduct'])->name('supplier.updateproduct');


Route::get('supplier/products/{id}/delete', [SupplierProductController::class, 'deleteproduct'])->name('supplier.deleteproduct');

Route::post('supplier/products/dispatch', [SupplierProductController::class, 'dispatchproduct'])->name('supplier.dispatch');

// ------ manage products
Route::get('supplier/products/manage', [SupplierProductController::class, 'manageproducts'])->name('supplier.manageproducts');





// ------ deliveries
Route::get('supplier/deliveries', [SupplierProductController::class, 'deliveries'])->name('supplier.deliveries');

//filter deliveries
Route::post('supplier/deliveries', [SupplierProductController::class, 'filterDeliveries'])->name('supplier.filterDeliveries');




// ------ reports
Route::get('supplier/reports', [SupplierProductController::class, 'reports'])->name('supplier.reports');









// ------ settings
Route::get('supplier/settings', [SupplierProductController::class, 'settings'])->name('supplier.settings');

Route::get('supplier/update-settings', [SupplierProductController::class, 'updatesettings'])->name('supplier.updatesettings');



// =======================================================================




//  CUSTOMER WEB APP ROUTES
Route::get('customer/login',  [CustomerAppController::class, 'home'])->name('customer.index');

Route::post('customer/checklogin',  [CustomerAppController::class, 'login'])->name('customer.login');

Route::get('customer/home',  [CustomerAppController::class, 'home'])->name('customer.home');
Route::get('customer/allDeliveris',  [CustomerAppController::class, 'allDeliveris'])->name('customer.all.deliveris');
Route::get('customer/comingDeliveries',  [CustomerAppController::class, 'comingDeliveris'])->name('customer.coming.deliveris');
Route::get('customer/canceledDeliveries',  [CustomerAppController::class, 'canceledDeliveries'])->name('customer.canceled.deliveries');



Route::get('customer/my-restaurant',  [CustomerAppController::class, 'myRestaurant'])->name('customer.myRestaurant');

Route::post('customer/freez',  [CustomerAppController::class, 'freez'])->name('customer.freez');
Route::post('customer/renew',  [CustomerAppController::class, 'renew'])->name('customer.renew');

Route::get('customer/ads',  [CustomerAppController::class, 'ads'])->name('customer.ads');

Route::get('customer/ads/all',  [CustomerAppController::class, 'allAds'])->name('customer.ads.all');

Route::get('customer/profile',  [CustomerAppController::class, 'profile'])->name('customer.profile');

Route::get('customer/customer-driver-chat/{delivery_id}',  [CustomerAppController::class, 'customerDriverChat'])->name('customer.driver.chat');

Route::post('customer/customer-driver-send',  [CustomerAppController::class, 'customerDriverSend'])->name('customer.driver.send');

Route::get('customer/customer-partner-chat',  [CustomerAppController::class, 'customerPartnerChat'])->name('customer.partner.chat');


Route::post('customer/customer-partner-send',  [CustomerAppController::class, 'customerPartnerSend'])->name('customer.partner.send');

Route::get('customer/profile',  [CustomerAppController::class, 'profile'])->name('customer.profile');

Route::get('customer/edit-profile',  [CustomerAppController::class, 'editProfile'])->name('customer.edit.profile');


Route::post('customer/update-profile',  [CustomerAppController::class, 'updateProfile'])->name('customer.update.profile');



Route::post('customer/update-location',  [CustomerAppController::class, 'updateLocation'])->name('customer.update.location');
Route::get('customer/location-altr',  [CustomerAppController::class, 'locationAltr'])->name('customer.location.altr');

Route::get('customer/logout',  [CustomerAppController::class, 'logout'])->name('customer.logout');


// =======================================================================




//  COLLECOTR WEB APP ROUTES
Route::get('collector/login',  [CollectorAppController::class, 'index'])->name('collector.login');

Route::post('collector/login',  [CollectorAppController::class, 'checkLogin'])->name('collector.check.login');

Route::get('collector/home',  [CollectorAppController::class, 'home'])->name('collector.home');


Route::get('collector/restaurant-deliveris/{restaurant_id}',  [CollectorAppController::class, 'CollectorOrdersByRestaurants'])->name('collector.restaurant.orders');

Route::post('collector/restaurant-deliveris/filtter/{restaurant_id}',  [CollectorAppController::class, 'CollectorOrdersByRestaurantsFillter'])->name('collector.restaurant.orders.filtter');

Route::get('collector/restaurant-deliveris/filtter/{restaurant_id}',  [CollectorAppController::class, 'CollectorOrdersByRestaurants'])->name('collector.restaurant.orders.filtter');


Route::post('collector/update-delivery-status',  [CollectorAppController::class, 'updateDeliveryStatus'])->name('collector.delivery.status');

Route::get('collector/return-cash',  [CollectorAppController::class, 'returnCash'])->name('collector.return.cash.page');
Route::post('collector/return-cash-amount',  [CollectorAppController::class, 'returnCashAmount'])->name('collector.return.cash');

Route::get('collector/search-restaurant',  [CollectorAppController::class, 'searchRestaurant'])->name('collector.search.restaurant');

Route::post('collector/search-restaurant',  [CollectorAppController::class, 'getSearchRestaurant'])->name('collector.search.restaurant');

Route::get('collector/profile',  [CollectorAppController::class, 'profile'])->name('collector.profile');

Route::get('collector/edit-profile',  [CollectorAppController::class, 'editProfile'])->name('collector.edit.profile');

Route::post('collector/update-profile',  [CollectorAppController::class, 'updateProfile'])->name('collector.update.profile');

Route::get('collector/logout',  [CollectorAppController::class, 'logout'])->name('collector.logout');


// =======================================================================




//  DRIVER WEB APP ROUTES

Route::get('driver/login',  [DriverAppController::class, 'index'])->name('driver.login');
Route::post('driver/login',  [DriverAppController::class, 'checkLogin'])->name('driver.check.login');

Route::get('driver/home',  [DriverAppController::class, 'home'])->name('driver.home');
Route::get('driver/home-by-restaurant/{rest_id}',  [DriverAppController::class, 'homeByRest'])->name('driver.home.by.restaurant');


Route::post('driver/update-delivery-status',  [DriverAppController::class, 'DriverUpdateDeliveryStatus'])->name('driver.delivery.status');

Route::post('driver/update-delivery-deliver-status',  [DriverAppController::class, 'DriverUpdateDeliveryDeliverStatus'])->name('driver.delivery.deliver.status');

Route::get('driver/delivery-deliver/{delivery_id}',  [DriverAppController::class, 'deliveryDeliver'])->name('driver.delivery.deliver');


Route::get('driver/orders',  [DriverAppController::class, 'orders'])->name('driver.orders');
Route::post('driver/update-order-status',  [DriverAppController::class, 'DriverUpdateOrderStatus'])->name('driver.order.status');

Route::get('driver/customer-chat/{delivery_id}',  [DriverAppController::class, 'driverCustomerChat'])->name('driver.customer.chat');
Route::post('driver/customer-chat-send',  [DriverAppController::class, 'driverCustomerSend'])->name('driver.customer.send');

Route::get('driver/search-by-district',  [DriverAppController::class, 'searchByDistrict'])->name('driver.search.by.distrect');

Route::post('driver/search-by-district',  [DriverAppController::class, 'getSearchByDistrict'])->name('driver.get.search.by.distrect');

Route::get('driver/profile',  [DriverAppController::class, 'profile'])->name('driver.profile');

Route::get('driver/edit-profile',  [DriverAppController::class, 'editProfile'])->name('driver.edit.profile');

Route::post('driver/update-profile',  [DriverAppController::class, 'updateProfile'])->name('driver.update.profile');

Route::get('driver/logout',  [DriverAppController::class, 'logout'])->name('driver.logout');



