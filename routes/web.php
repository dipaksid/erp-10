<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('auth.login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Existing routes
Route::group(['middleware' => 'auth', 'middleware' => 'isAdmin'], function()
{
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landing');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('home/servicesales',[App\Http\Controllers\HomeController::class, 'servicesales'])->name('home.servicesales');
    Route::resource('customers', App\Http\Controllers\CustomersController::class);
    Route::resource('supplier', App\Http\Controllers\SuppliersController::class);
    Route::get('stock/customercategorylist', 'StockController@customercategorylist')->name('stock.customercategorylist');
    Route::post('/stock/updseq', 'StockController@updseq')->name('stock.updseq');
    Route::post('/stock/updseq2', 'StockController@updseq2')->name('stock.updseq2');
    Route::resource('serviceform','ServiceFormController');
    Route::resource('stock', 'StockController');
    Route::resource('areas', App\Http\Controllers\AreasController::class);
    Route::resource('terms', App\Http\Controllers\TermsController::class);
    Route::get('customercategory/uploadsystem/{customercategory}', 'App\Http\Controllers\CustomerCategoriesController@uploadsystem')->name('customercategory.uploadsystem');
    Route::put('customercategory/uploadsystem/{customercategory}', 'App\Http\Controllers\CustomerCategoriesController@uploadsystemfile')->name('customercategory.uploadsystem');
    Route::patch('customercategory/uploadsystem/{customercategory}', 'App\Http\Controllers\CustomerCategoriesController@uploadsystemfile')->name('customercategory.uploadsystem');
    Route::resource('customercategory', App\Http\Controllers\CustomerCategoriesController::class);
    Route::get('customer-groups/customerlist', 'App\Http\Controllers\CustomerGroupsController@customerList')->name('customer-groups.customerlist');
    Route::get('customer-groups/categorylist', 'App\Http\Controllers\CustomerGroupsController@categorylist')->name('customer-groups.categorylist');
    Route::get('customer-groups/agentlist', 'App\Http\Controllers\CustomerGroupsController@agentlist')->name('customer-groups.agentlist');
    Route::get('customer-groups/custservice', 'App\Http\Controllers\CustomerGroupsController@custservice')->name('customer-groups.custservice');
    Route::get('customer-groups/printpdffile/{customergroup}', 'App\Http\Controllers\CustomerGroupsController@printpdffile')->name('customer-groups.printpdffile');
    Route::post('customer-groups/custservice', 'App\Http\Controllers\CustomerGroupsController@savecustservice')->name('customer-groups.savecustservice');
    Route::post('customer-groups/savegroupcustservice', 'App\Http\Controllers\CustomerGroupsController@savegroupcustservice')->name('customer-groups.savegroupcustservice');
    Route::resource('customer-groups', App\Http\Controllers\CustomerGroupsController::class);
    Route::get('customer-services/serviceslist', 'App\Http\Controllers\CustomerServiceController@serviceslist')->name('customerservice.serviceslist');
    Route::get('customer-services/agentlist', 'App\Http\Controllers\CustomerServiceController@agentlist')->name('customerservice.agentlist');
    Route::resource('customer-services', 'App\Http\Controllers\CustomerServicesController');
    Route::get('customer-pwspg-app/customerlist', 'App\Http\Controllers\CustomerPGAppsController@customerlist')->name('customerPwspgApp.customerlist');
    Route::resource('customer-pwspg-app', 'App\Http\Controllers\CustomerPGAppsController');
    Route::get('totalpayapp/customerlist', 'App\Http\Controllers\TotalpayAppsController@customerlist')->name('totalpayapp.customerlist');
    Route::resource('totalpayapp', App\Http\Controllers\TotalpayAppsController::class);
    Route::resource('banks', App\Http\Controllers\BanksController::class);
    Route::resource('agents', App\Http\Controllers\AgentsController::class);
    Route::resource('staffs', App\Http\Controllers\StaffsController::class);
    Route::resource('stockcategories', App\Http\Controllers\StockCategoriesController::class);
    Route::resource('users', App\Http\Controllers\UsersController::class);
    Route::resource('roles', App\Http\Controllers\RolesController::class);
    Route::resource('permissions', App\Http\Controllers\PermissionsController::class);
    Route::resource('uoms', App\Http\Controllers\UomsController::class);
    Route::resource('system_settings', App\Http\Controllers\SystemSettingsController::class);
    Route::resource('company_settings', App\Http\Controllers\CompanySettingsController::class);
    Route::resource('servicesrate','ServiceRateProfileController');
    Route::resource('solutionprofile','SolutionProfileController');
    Route::resource('softwareservice','SoftwareServiceController');
    Route::post('/trainingform/updseq', 'TrainingFormController@updseq')->name('trainingform.updseq');
    Route::post('/trainingform/updseq2', 'TrainingFormController@updseq2')->name('trainingform.updseq2');
    Route::get('/trainingform/formdetail', 'TrainingFormController@detailList')->name('trainingform.formdetail');
    Route::get('/trainingform/trainingformlist', 'TrainingFormController@trainingformList')->name('trainingform.trainingformlist');
    Route::post('/trainingform/{id}', 'TrainingFormController@update')->name('trainingform.update');
    Route::resource('trainingform','TrainingFormController');
    Route::post('/evaluationform/{id}', 'EvaluationFormController@update')->name('evaluationform.update');
    Route::resource('evaluationform','EvaluationFormController');
    Route::post('/leaveform/{id}', 'App\Http\Controllers\LeaveFormsController@update')->name('leaveform.update');
    Route::resource('leaveform',App\Http\Controllers\LeaveFormsController::class);
    Route::get('/leaveformpdf/{id}', 'App\Http\Controllers\LeaveFormsController@leaveformpdf');
    Route::get('/leaveform/docdelete', 'App\Http\Controllers\LeaveFormsController@docdelete');

    # SALES INVOICES
    Route::get('/salesinvoice', 'SalesInvoiceController@index')->name('salesinvoice.index');
    Route::put('/salesinvoice/{salesinvoice}', 'SalesInvoiceController@update')->name('salesinvoice.update');
    Route::patch('/salesinvoice/{salesinvoice}', 'SalesInvoiceController@update')->name('salesinvoice.update');
    Route::post('/salesinvoice', 'SalesInvoiceController@store')->name('salesinvoice.store');
    Route::get('/salesinvoice/edit', 'SalesInvoiceController@edit')->name('salesinvoice.edit');
    Route::get('/salesinvoice/checkcust', 'SalesInvoiceController@checkcust')->name('salesinvoice.checkcust');
    Route::post('/salesinvoice/checkcust', 'SalesInvoiceController@checkcustsales')->name('salesinvoice.checkcustsales');
    Route::get('/salesinvoice/checkinv', 'SalesInvoiceController@checkinv')->name('salesinvoice.checkinv');
    Route::post('/salesinvoice/checkinv', 'SalesInvoiceController@checkinvsales')->name('salesinvoice.checkinv');
    Route::get('/salesinvoice/checkserialnum', 'SalesInvoiceController@checkserialnum')->name('salesinvoice.checkserialnum');
    Route::post('/salesinvoice/checkserialnum', 'SalesInvoiceController@checkserialnumsales')->name('salesinvoice.checkserialnum');
    Route::get('/salesinvoice/checkstockcode', 'SalesInvoiceController@checkstockcode')->name('salesinvoice.checkstockcode');
    Route::post('/salesinvoice/checkstockcode', 'SalesInvoiceController@checkstockcodesales')->name('salesinvoice.checkstockcode');

    Route::get('/salesinvoice/invoice/{salesinvoice}', 'SalesInvoiceController@invoicepdf')->name('invoicepdf');
    Route::get('/salesinvoice/lhinvoice/{salesinvoice}', 'SalesInvoiceController@lhinvoicepdf')->name('lhinvoicepdf');
    Route::get('/salesinvoice/lhinvdo/{salesinvoice}', 'SalesInvoiceController@lhinvdopdf')->name('lhinvdopdf');
    Route::get('/salesinvoice/do/{salesinvoice}', 'SalesInvoiceController@dopdf')->name('dopdf');
    Route::get('/salesinvoice/lhdo/{salesinvoice}', 'SalesInvoiceController@lhdopdf')->name('lhdopdf');
    Route::get('/salesinvoice/note/{salesinvoice}', 'SalesInvoiceController@notepdf')->name('notepdf');
    Route::post('/salesinvoice/checkcustnote', 'SalesInvoiceController@checkcustnote')->name('salesinvoice.checkcustnote');
    Route::post('/salesinvoice/savesalesnote', 'SalesInvoiceController@savesalesnote')->name('salesinvoice.savesalesnote');
    Route::post('/salesinvoice/pdftoprinter', 'SalesInvoiceController@pdftoprinter')->name('salesinvoice.pdftoprinter');
    Route::post('/salesinvoice/servicesales', 'SalesInvoiceController@servicesales')->name('salesinvoice.servicesales');
    Route::post('/salesinvoice/cancelsales', 'SalesInvoiceController@cancelsales')->name('salesinvoice.cancelsales');
    Route::get('/salesinvoice/cancelindex', 'SalesInvoiceController@cancelindex')->name('salesinvoice.cancelindex');
    Route::post('/salesinvoice/checkcustoutsales', 'SalesInvoiceController@checkcustoutsales')->name('salesinvoice.checkcustoutsales');
    Route::get('/salesinvoice/lhblank', 'SalesInvoiceController@lhblankpdf')->name('lhblankpdf');
    Route::post('/salesinvoice/uploadservicefile', 'SalesInvoiceController@uploadservicefile')->name('salesinvoice.uploadservicefile');


    # RECEIVE PAYMENT
    Route::get('/receivepayment', 'ReceivePaymentController@index')->name('receivepayment.index');
    Route::put('/receivepayment/{receipt}', 'ReceivePaymentController@update')->name('receivepayment.update');
    Route::patch('/receivepayment/{receipt}', 'ReceivePaymentController@update')->name('receivepayment.update');
    Route::post('/receivepayment', 'ReceivePaymentController@store')->name('receivepayment.store');
    Route::get('/receivepayment/edit', 'ReceivePaymentController@edit')->name('receivepayment.edit');
    Route::get('/receivepayment/checkcust', 'ReceivePaymentController@checkcust')->name('receivepayment.checkcust');
    Route::post('/receivepayment/checkcust', 'ReceivePaymentController@checkcustpayment')->name('receivepayment.checkcustpayment');
    Route::get('/receivepayment/checkrcpt', 'ReceivePaymentController@checkrcpt')->name('receivepayment.checkrcpt');
    Route::post('/receivepayment/checkrcpt', 'ReceivePaymentController@checkrcptpay')->name('receivepayment.checkrcptpay');
    Route::get('/receivepayment/or/{receivepayment}', 'ReceivePaymentController@payvoucherpdf')->name('payvoucherpdf');
    Route::get('/receivepayment/lhor/{receivepayment}', 'ReceivePaymentController@lhpayvoucherpdf')->name('lhpayvoucherpdf');
    Route::post('/receivepayment/pdftoprinter', 'ReceivePaymentController@pdftoprinter')->name('receivepayment.pdftoprinter');
    # PAYMENT VOUCHER
    Route::get('/paymentvoucher', 'PaymentVoucherController@index')->name('paymentvoucher.index');
    Route::put('/paymentvoucher/{payment}', 'PaymentVoucherController@update')->name('paymentvoucher.update');
    Route::patch('/paymentvoucher/{payment}', 'PaymentVoucherController@update')->name('paymentvoucher.update');
    Route::post('/paymentvoucher', 'PaymentVoucherController@store')->name('paymentvoucher.store');
    Route::get('/paymentvoucher/edit', 'PaymentVoucherController@edit')->name('paymentvoucher.edit');
    Route::get('/paymentvoucher/checksupp', 'PaymentVoucherController@checksupp')->name('paymentvoucher.checksupp');
    Route::post('/paymentvoucher/checksupp', 'PaymentVoucherController@checksupppayment')->name('paymentvoucher.checksupppayment');
    Route::get('/paymentvoucher/checkpymt', 'PaymentVoucherController@checkpymt')->name('paymentvoucher.checkpymt');
    Route::post('/paymentvoucher/checkpymt', 'PaymentVoucherController@checkpymtdet')->name('paymentvoucher.checkpymtdet');
    Route::get('/paymentvoucher/pv/{payment}', 'PaymentVoucherController@paymentvoucherpdf')->name('paymentvoucherpdf');
    Route::get('/paymentvoucher/lhpv/{payment}', 'PaymentVoucherController@lhpaymentvoucherpdf')->name('lhpaymentvoucherpdf');
    Route::post('/paymentvoucher/pdftoprinter', 'PaymentVoucherController@pdftoprinter')->name('paymentvoucher.pdftoprinter');
    Route::post('/paymentvoucher/cancelpayment', 'PaymentVoucherController@cancelpayment')->name('paymentvoucher.cancelpayment');
    Route::get('/paymentvoucher/cancelindex', 'PaymentVoucherController@cancelindex')->name('paymentvoucher.cancelindex');
    # CREDIT NOTE
    Route::get('/creditnote', 'CreditNoteController@index')->name('creditnote.index');
    Route::put('/creditnote/{creditnote}', 'CreditNoteController@update')->name('creditnote.update');
    Route::patch('/creditnote/{creditnote}', 'CreditNoteController@update')->name('creditnote.update');
    Route::post('/creditnote', 'CreditNoteController@store')->name('creditnote.store');
    Route::get('/creditnote/edit', 'CreditNoteController@edit')->name('creditnote.edit');
    Route::get('/creditnote/checkcust', 'CreditNoteController@checkcust')->name('creditnote.checkcust');
    Route::post('/creditnote/checkcust', 'CreditNoteController@checkcustcn')->name('creditnote.checkcustcn');
    Route::get('/creditnote/checkcn', 'CreditNoteController@checkcn')->name('creditnote.checkcn');
    Route::post('/creditnote/checkcn', 'CreditNoteController@checkcndet')->name('creditnote.checkcndet');
    Route::get('/creditnote/cn/{creditnote}', 'CreditNoteController@cnvoucherpdf')->name('cnvoucherpdf');
    Route::get('/creditnote/lhcn/{creditnote}', 'CreditNoteController@lhcnvoucherpdf')->name('lhcnvoucherpdf');
    Route::post('/creditnote/pdftoprinter', 'CreditNoteController@pdftoprinter')->name('creditnote.pdftoprinter');
    # PURCHASE ORDER
    Route::get('/purchaseorder', 'PurchaseOrderController@index')->name('purchaseorder.index');
    Route::put('/purchaseorder/{purchaseorder}', 'PurchaseOrderController@update')->name('purchaseorder.update');
    Route::patch('/purchaseorder/{purchaseorder}', 'PurchaseOrderController@update')->name('purchaseorder.update');
    Route::post('/purchaseorder', 'PurchaseOrderController@store')->name('purchaseorder.store');
    Route::get('/purchaseorder/edit', 'PurchaseOrderController@edit')->name('purchaseorder.edit');
    Route::get('/purchaseorder/checksupp', 'PurchaseOrderController@checksupp')->name('purchaseorder.checksupp');
    Route::post('/purchaseorder/checksupp', 'PurchaseOrderController@checksupppo')->name('purchaseorder.checksupppo');
    Route::get('/purchaseorder/checkpo', 'PurchaseOrderController@checkpo')->name('purchaseorder.checkpo');
    Route::post('/purchaseorder/checkpo', 'PurchaseOrderController@checkpodet')->name('purchaseorder.checkpodet');
    Route::get('/purchaseorder/po/{purchaseorder}', 'PurchaseOrderController@popdf')->name('popdf');
    Route::get('/purchaseorder/lhpo/{purchaseorder}', 'PurchaseOrderController@lhpopdf')->name('lhpopdf');
    Route::post('/purchaseorder/pdftoprinter', 'PurchaseOrderController@pdftoprinter')->name('purchaseorder.pdftoprinter');

    # Bankdoc
    Route::get('/bankdocs', 'BankdocController@index')->name('bankdoc.index');
    Route::put('/bankdocs/{bankdoc}', 'BankdocController@update')->name('bankdoc.update');
    Route::patch('/bankdocs/{bankdoc}', 'BankdocController@update')->name('bankdoc.update');
    Route::post('/bankdocs', 'BankdocController@store')->name('bankdoc.store');
    Route::get('/bankdocs/edit', 'BankdocController@edit')->name('bankdoc.edit');

    Route::put('/profile/{profile}', 'ProfileController@update')->name('profile.update');
    Route::patch('/profile/{profile}', 'ProfileController@update')->name('profile.update');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    // Report
    Route::get('/report/staffservice','ReportStaffServiceController@index')->name('report.staffservice');
    Route::post('/report/staffservice','ReportStaffServiceController@reportpdf')->name('report.staffservice');
    Route::get('/report/outstanding', 'ReportOutstandingController@index')->name('report.outstanding');
    Route::post('/report/outstanding', 'ReportOutstandingController@reportpdf')->name('report.outstanding');
    Route::get('/report/receipt', 'ReportReceiptController@index')->name('report.receipt');
    Route::post('/report/receipt', 'ReportReceiptController@reportpdf')->name('report.receipt');
    Route::get('/report/sales', 'ReportSalesController@index')->name('report.sales');
    Route::post('/report/sales', 'ReportSalesController@reportpdf')->name('report.sales');
    Route::get('/report/sticker', 'ReportStickerController@index')->name('report.sticker');
    Route::post('/report/sticker', 'ReportStickerController@reportpdf')->name('report.sticker');
    Route::get('/report/salesexportlhdn', 'ReportSalesExportLHDNController@index')->name('report.salesexportlhdn');
    Route::post('/report/salesexportlhdn', 'ReportSalesExportLHDNController@reportexcel')->name('report.salesexportlhdn');
    Route::get('/report/servicemain', 'ReportServiceMainController@index')->name('report.servicemain');
    Route::post('/report/servicemain', 'ReportServiceMainController@reportpdf')->name('report.servicemain');
    Route::get('/report/filemanage', 'ReportFileManageController@index')->name('report.filemanage');
    Route::post('/report/pdftoprinter', 'ReportController@pdftoprinter')->name('report.pdftoprinter');
    Route::get('/report/cancelsales', 'ReportCancelSalesController@index')->name('report.cancelsales');
    Route::post('/report/cancelsales', 'ReportCancelSalesController@reportpdf')->name('report.cancelsales');
    Route::get('/report/creditnote', 'ReportCreditNoteController@index')->name('report.creditnote');
    Route::post('/report/creditnote', 'ReportCreditNoteController@reportpdf')->name('report.creditnote');
    Route::get('/report/filemanagegetfolderfile', 'ReportFileManageController@getfolderfile')->name('report.getfolderfile');
    Route::get('/report/filemanagegetnewtree', 'ReportFileManageController@getnewtree')->name('report.getnewtree');
});
