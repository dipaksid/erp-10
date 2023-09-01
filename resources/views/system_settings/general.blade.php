<div id="general" class="tab-pane active">
    <div class="row form-group">
        <div class="col-3">
            <label for="srvchgsendnotify">Customer service - allow to send notification: </label>
            <div class="custom-control custom-switch">
                <input type="hidden" name="srvchgsendnotify" value="{{ $systemSettings->first()->srvchgsendnotify }}">
                <input type="checkbox" class="custom-control-input enterseq" onclick="js_click(this)" {{ (($systemSettings->first()->srvchgsendnotify=="Y")?"checked='checked'":"") }} name="csrvchgsendnotify" id="srvchgsendnotify">
                <label class="custom-control-label enterseq" for="srvchgsendnotify"></label>
            </div>
        </div>
        <div class="col-3">
            <label for="allinvdvylh">Invoice & Delivery & Purchase - allow to use letterhead: </label>
            <div class="custom-control custom-switch">
                <input type="hidden" name="allinvdvylh" value="{{ $systemSettings->first()->allinvdvylh }}">
                <input type="checkbox" class="custom-control-input enterseq" onclick="js_click(this)" {{ (($systemSettings->first()->allinvdvylh=="Y")?"checked='checked'":"") }} name="callinvdvylh" id="allinvdvylh">
                <label class="custom-control-label enterseq" for="allinvdvylh"></label>
            </div>
        </div>
        <div class="col-3">
            <label for="allcnlh">Credit Note - allow to use letterhead: </label>
            <div class="custom-control custom-switch">
                <input type="hidden" name="allcnlh" value="{{ $systemSettings->first()->allcnlh }}">
                <input type="checkbox" class="custom-control-input enterseq" onclick="js_click(this)" {{ (($systemSettings->first()->allcnlh=="Y")?"checked='checked'":"") }} name="callcnlh" id="allcnlh">
                <label class="custom-control-label enterseq" for="allcnlh"></label>
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label for="emailsender">Email sender :</label>
            <input type="text" seq="1" class="form-control enterseq" max-length="100" name="emailsender" value="{{ $systemSettings->first()->emailsender }}" />
        </div>
        <div class="col-3">
            <label for="invoiceprinter">Invoice Printer</label>
            <input type="text" seq="2" class="form-control enterseq" max-length="100" name="invoiceprinter" value="{{ $systemSettings->first()->invoiceprinter }}" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label for="poprinter">Credit Note Printer :</label>
            <input type="text" seq="3" class="form-control enterseq" max-length="100" name="poprinter" value="{{ $systemSettings->first()->poprinter }}" />
        </div>
        <div class="col-3">
            <label for="receiptprinter">Receipt Printer:</label>
            <input type="text" seq="4" class="form-control enterseq" max-length="100" name="receiptprinter" value="{{ $systemSettings->first()->receiptprinter }}" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label for="paymentprinter">Payment Voucher Printer:</label>
            <input type="text" seq="5" class="form-control enterseq" max-length="100" name="paymentprinter" value="{{ $systemSettings->first()->paymentprinter }}" />
        </div>
        <div class="col-3">
            <label for="creditnoteprinter">Purchase Order Printer:</label>
            <input type="text" seq="6" class="form-control enterseq" max-length="100" name="creditnoteprinter" value="{{ $systemSettings->first()->creditnoteprinter }}" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label for="reportprinter">Report Printer:</label>
            <input type="text" seq="7" class="form-control enterseq" max-length="100" name="reportprinter" value="{{ $systemSettings->first()->reportprinter }}" />
        </div>
        <div class="col-3">
            <label for="stickerprinter">Sticker Printer:</label>
            <input type="text" seq="8" class="form-control enterseq" max-length="100" name="stickerprinter" value="{{ $systemSettings->first()->stickerprinter }}" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label for="reportprinter">Pagination row per page:</label>
            <input type="text" seq="7" class="form-control enterseq" max-length="100" name="paginate_page" value="{{ $systemSettings->first()->paginate_page }}" />
        </div>
    </div>
</div>
