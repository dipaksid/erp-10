<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-money-check"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'ERP10') }}</div>
    </a>
    <!-- Divider -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Account
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('SALES INVOICE')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('salesinvoice.index') }}">
                <i class="fas fa-fw fa-file-invoice"></i>
                <span>Sales Invoice</span></a>
        </li>
    @endcan

    @can('PURCHASE ORDER')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('purchaseorder.index') }}">
                <i class="fas fa-fw fa-store"></i>
                <span>Purchase Order</span></a>
        </li>
    @endcan

    @can('RECEIVE PAYMENT')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('receivepayment.index') }}">
                <i class="fas fa-fw fa-receipt"></i>
                <span>Receive Payments</span></a>
        </li>
    @endcan

    @can('PAYMENT VOUCHER')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('paymentvoucher.index') }}">
                <i class="fas fa-fw fa-money-bill-wave"></i>
                <span>Payment Voucher</span></a>
        </li>
    @endcan

    @can('CREDIT NOTE')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('creditnote.index') }}">
                <i class="fas fa-fw fa-sticky-note"></i>
                <span>Customer Credit Note</span></a>
        </li>
    @endcan

    @can('PRINT CUSTOMER/SUPPLIER STICKER')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('report.sticker') }}">
                <i class="fas fa-fw fa-tags"></i>
                <span>Customer/Supplier Sticker</span>
            </a>
        </li>
    @endcan

    @can('CANCEL SALES INVOICE')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('salesinvoice.cancelindex') }}">
                <i class="fas fa-fw fa-strikethrough"></i>
                <span>Cancel Sales</span>
            </a>
        </li>
    @endcan

    @can('CANCEL PAYMENT VOUCHER')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('paymentvoucher.cancelindex') }}">
                <i class="fas fa-fw fa-strikethrough"></i>
                <span>Cancel Payment</span>
            </a>
        </li>
    @endcan

    @can('BANK DOC')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('bankdoc.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Bank Doc</span>
            </a>
        </li>
    @endcan

    @can('FILE MANAGEMENT REPORT')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('report.filemanage') }}">
                <i class="fas fa-fw fa-server"></i>
                <span>File Management</span>
            </a>
        </li>
    @endcan

    <!-- Nav Item - Report Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
            <i class="fas fa-fw fa-folder"></i>
            <span>Report</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Report:</h6>
                @can('SALES REPORT') <a class="collapse-item" href="{{ route('report.sales') }}">Sales Report</a> @endcan
                @can('RECEIPT REPORT') <a class="collapse-item" href="{{ route('report.receipt') }}">Receipt Report</a> @endcan
                @can('CREDIT NOTE REPORT') <a class="collapse-item" href="{{ route('report.creditnote') }}">Credit Note Report</a> @endcan
                @can('CANCEL SALES REPORT') <a class="collapse-item" href="{{ route('report.cancelsales') }}">Cancel Sales Report</a> @endcan
                @can('OUTSTANDING REPORT') <a class="collapse-item" href="{{ route('report.outstanding') }}">Outstanding Report</a> @endcan
                @can('SERVICE MAINTENANCE REPORT') <a class="collapse-item" href="{{ route('report.servicemain') }}">Service Maintenance <br> Report</a> @endcan
                @can('STAFF SERVICE REPORT') <a class="collapse-item" href="{{ route('report.staffservice') }}">Staff Service <br> Report</a> @endcan
                @can('CUSTOMER SALES DATA EXPORT (LHDN)') <a class="collapse-item" href="{{ route('report.salesexportlhdn') }}">Customer Sales Data<br> Export (LHDN)</a> @endcan
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Maintenance
    </div>

    <!-- Nav Item - Customer -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
            <i class="fas fa-fw fa-users"></i>
            <span>Customers</span>
        </a>
        <div id="collapseCustomer" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('CUSTOMER LIST') <a class="collapse-item" href="{{ route('customers.index') }}">Customers</a>
                @elsecan('ADD CUSTOMER') <a class="collapse-item" href="{{ route('customers.create') }}">Customers</a>
                @endcan
                @can('CUSTOMER GROUP LIST') <a class="collapse-item" href="{{ route('customer-groups.index') }}">Customer Groups</a>
                @elsecan('ADD CUSTOMER GROUP') <a class="collapse-item" href="{{ route('customer-groups.create') }}">Customer Groups</a>
                @endcan
                @can('CUSTOMER SERVICE LIST') <a class="collapse-item" href="{{ route('customer-services.index') }}">Customer Service</a>
                @elsecan('ADD CUSTOMER SERVICE') <a class="collapse-item" href="{{ route('customer-services.create') }}">Customer Service</a>
                @endcan
                @can('PWS PG APP SERVICE LIST') <a class="collapse-item" href="{{ route('customer-pwspg-app.index') }}">PWS PG APP Services</a>
                @elsecan('ADD PWS PG APP SERVICE') <a class="collapse-item" href="{{ route('customer-pwspg-app.create') }}">PWS PG APP Services</a>
                @endcan
                @can('TOTALPAY APP SERVICE LIST') <a class="collapse-item" href="{{ route('totalpayapp.index') }}">Totalpay APP Services</a>
                @elsecan('ADD TOTALPAY APP SERVICE') <a class="collapse-item" href="{{ route('totalpayapp.create') }}">Totalpay APP Services</a>
                @endcan
            </div>
        </div>
    </li>

    <!-- Nav Item - Supplier -->
    @can('SUPPLIER LIST')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier.index') }}">
                <i class="fas fa-fw fa-warehouse"></i>
                <span>Suppliers</span></a>
        </li>
    @elsecan('ADD SUPPLIER')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier.create') }}">
                <i class="fas fa-fw fa-warehouse"></i>
                <span>Suppliers</span></a>
        </li>
    @endcan


    <!-- Nav Item - Stock -->
    @can('STOCK LIST')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('stock.index') }}">
                <i class="fas fa-fw fa-scroll"></i>
                <span>Stock Item</span></a>
        </li>
    @elsecan('ADD STOCK')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('stock.create') }}">
                <i class="fas fa-fw fa-scroll"></i>
                <span>Stock Item</span></a>
        </li>
    @endcan
    <!-- Nav Item - Software Service -->
    @can('SOFTWARE SERVICE LIST')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('softwareservice.index') }}">
                <i class="fas fa-concierge-bell"></i>
                <span>Service - (Soft & Hard)</span></a>
        </li>
    @elsecan('ADD SOFTWARE SERVICE')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('softwareservice.create') }}">
                <i class="fas fa-concierge-bell"></i>
                <span>Software Service</span></a>
        </li>
    @endcan

    @can('LEAVE FORM LIST')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('leaveform.index') }}">
                <i class="fas fa-file"></i>
                <span>Leave Form</span></a>
        </li>
    @elsecan('ADD LEAVE FORM')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('leaveform.create') }}">
                <i class="fas fa-file"></i>
                <span>Leave Form</span></a>
        </li>
    @endcan
    <!-- Nav Item - Maintenance Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaintenance" aria-expanded="true" aria-controls="collapseMaintenance">
            <i class="fas fa-fw fa-folder"></i>
            <span>Maintenance Code</span>
        </a>
        <div id="collapseMaintenance" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Code:</h6>
                @can('AREA LIST') <a class="collapse-item" href="{{ route('areas.index') }}">Area</a> @elsecan('ADD AREA') <a class="collapse-item" href="{{ route('areas.create') }}">Area</a> @endcan
                @can('TERM LIST') <a class="collapse-item" href="{{ route('terms.index') }}">Term</a> @elsecan('ADD TERM') <a class="collapse-item" href="{{ route('terms.create') }}">Term</a> @endcan
                @can('CUSTOMER CATEGORY LIST') <a class="collapse-item" href="{{ route('customercategory.index') }}">Customer Category</a> @elsecan('ADD CUSTOMER CATEGORY') <a class="collapse-item" href="{{ route('customercategory.create') }}">Customer Category</a> @endcan
                @can('BANKS LIST') <a class="collapse-item" href="{{ route('banks.index') }}">Bank</a> @elsecan('ADD BANK') <a class="collapse-item" href="{{ route('banks.create') }}">Bank</a> @endcan
                @can('AGENT LIST') <a class="collapse-item" href="{{ route('agents.index') }}">Agents</a> @elsecan('ADD agents') <a class="collapse-item" href="{{ route('agents.create') }}">Agents</a> @endcan
                @can('STAFF LIST') <a class="collapse-item" href="{{ route('staffs.index') }}">Staff</a> @elsecan('ADD STAFF') <a class="collapse-item" href="{{ route('staffs.create') }}">Staff</a> @endcan
                @can('STOCK CATEGORY LIST') <a class="collapse-item" href="{{ route('stockcategories.index') }}">Stock Category</a> @elsecan('ADD STOCK CATEGORY') <a class="collapse-item" href="{{ route('stockcategories.create') }}">Stock Category</a> @endcan
                @can('UOMS LIST') <a class="collapse-item" href="{{ route('uoms.index') }}">UOMs</a> @elsecan('ADD UOMS') <a class="collapse-item" href="{{ route('uoms.create') }}">UOMs</a> @endcan
                @can('SERVICES ITEM LIST') <a class="collapse-item" href="{{ route('servicesitem.index') }}">Services Item</a> @elsecan('ADD SERVICES ITEM') <a class="collapse-item" href="{{ route('servicesitem.create') }}">Services Item</a> @endcan
                @can('SERVICES RATE PROFILE LIST') <a class="collapse-item" href="{{ route('servicesrate.index') }}">Services Rate Profile</a> @elsecan('ADD SERVICES RATE PROFILE') <a class="collapse-item" href="{{ route('servicesrate.create') }}">Services Rate Profile</a> @endcan
                @can('SOLUTION PROFILE LIST') <a class="collapse-item" href="{{ route('solutionprofile.index') }}">Solution Profile</a> @elsecan('ADD SOLUTION PROFILE') <a class="collapse-item" href="{{ route('solutionprofile.create') }}">Solution Profile</a> @endcan
                @can('TRAINING FORM LIST')<a class="collapse-item" href="{{ route('trainingform.index') }}">Training Form</a>@endcan
                @can('EVALUATION FORM LIST')<a class="collapse-item" href="{{ route('evaluationform.index') }}">Evaluation Form</a>@endcan
            </div>
        </div>
    </li>

    <!-- Nav Item - User C Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsersCog" aria-expanded="true" aria-controls="collapseUsersCog">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Users Control</span>
        </a>
        <div id="collapseUsersCog" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('USER LIST') <a class="collapse-item" href="{{ route('users.index') }}">Users</a> @elsecan('ADD USER') <a class="collapse-item" href="{{ route('user.create') }}">Users</a> @endcan
                @can('ROLE LIST') <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a> @elsecan('ADD ROLE') <a class="collapse-item" href="{{ route('role.create') }}">Roles</a> @endcan
                @can('PERMISSION LIST') <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a> @elsecan('ADD PERMISSION') <a class="collapse-item" href="{{ route('permission.create') }}">Permissions</a> @endcan
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    @can('SYSTEM SETTING')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('system_settings.index') }}">
                <i class="fas fa-fw fa-sticky-note"></i>
                <span>System Setting</span></a>
        </li>
    @endcan

    @can('COMPANY SETTING')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('company_settings.index') }}">
                <i class="fas fa-fw fa-building"></i>
                <span>Company Setting</span></a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
