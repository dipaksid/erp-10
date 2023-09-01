<div id="sms" class="tab-pane fade">
    <div class="row form-group">
        <div class="col-3">
            <label for="reportprinter">SMS username:</label>
            <input type="text" seq="12" class="form-control enterseq" name="sms_username" value="{{ $systemSettings->first()->sms_username }}" />
        </div>
        <div class="col-3">
            <label for="reportprinter">SMS password:</label>
            <input type="text" seq="13" class="form-control enterseq" name="sms_password" value="{{ $systemSettings->first()->sms_password }}" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label for="reportprinter">SMS company name:</label>
            <input type="text" seq="14" class="form-control enterseq" name="sms_company_name" value="{{ $systemSettings->first()->sms_company_name }}" />
        </div>
        <div class="col-3">
            <label for="sms_active">SMS - Status: </label>
            <div class="custom-control custom-switch">
                <input type="hidden" name="sms_actives" value="{{ $systemSettings->first()->sms_active }}">
                <input type="checkbox" class="custom-control-input enterseq" onclick="js_click(this)" {{ (($systemSettings->first()->sms_active=="Y")?"checked='checked'":"") }} name="sms_active" id="sms_active">
                <label class="custom-control-label enterseq" for="sms_active"></label>
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-6">
            <label for="reportprinter">SMS Content:</label>
            <input type="text" seq="15" maxlength="255" class="form-control enterseq" name="sms_content" value="{{ $systemSettings->first()->sms_content }}" />
        </div>
    </div>
</div>
