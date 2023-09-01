<!-- Modal -->
<div class="modal fade" id="modalLoading" role="dialog">
    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>In progress.....</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalErrorMsg" role="dialog">
    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <span class="errormsg"></span>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="servicesModal" tabindex="-1" role="dialog" aria-labelledby="servicesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="servicesModalLabel">Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="custservices">
                    <input type="hidden" name="serviceid">
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="amount">Period Type:</label>
                            <select class="form-control" name="contract_typ">
                                <option value="">-- Selection --</option>
                                <option value="1">Yearly</option>
                                <option value="2">Monthly</option>
                                <option value="3">Bi-Monthly</option>
                                <option value="4">Half Yearly</option>
                                <option value="5">Quarterly</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" name="amount" onKeyPress="return js_validate_amt_dec(event);">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="inc_hw">Include Hardware [Y/N]: </label>
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="inc_hw">
                                <input type="checkbox" class="custom-control-input enterseq" name="cinc_hw" id="cinc_hw">
                                <label class="custom-control-label enterseq" for="inc_hw"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="pay_before">Pay Before Service[Y/N]</label>
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="pay_before">
                                <input type="checkbox" class="custom-control-input enterseq" name="cpay_before" id="cpay_before">
                                <label class="custom-control-label enterseq" for="pay_before"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="start_date">Start Date: </label>
                            <input type="text" class="form-control" name="start_date">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="end_date">End Date:</label>
                            <input type="text" class="form-control" name="end_date">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="service_date">Service Pay Date:</label>
                            <input type="text" class="form-control" name="service_date">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="soft_license">Software License Per PC:</label>
                            <input type="number" class="form-control" name="soft_license">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="vpnaddress">VPN Address:</label>
                            <input type="text" class="form-control" name="vpnaddress">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="active">Active [Y/N]</label>
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="active">
                                <input type="checkbox" class="custom-control-input enterseq" name="cactive" id="cactive">
                                <label class="custom-control-label enterseq" for="active"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveServices">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="serializationModal" tabindex="-1" role="dialog" aria-labelledby="serializationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serializationModalLabel">Serialization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="fileupload">CFG File Upload:</label>
                            <input type="file" class="form-control" name="fileupload">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="customername">Group Name:</label>
                            <input type="text" class="form-control" name="customername" readOnly="readOnly">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="serial_no">Serial Number: <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="serial_no" value="{{$customer_group->serial_no}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="exp_dat">Expire Date: <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="exp_dat" value="{{$customer_group->exp_dat}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="agentid">Agent: <span style="color:red;">*</span>:</label>
                            <select class="form-control agentAutoSelect overflow-ellipsis" name="agentid"  placeholder="Agent search..." data-url="{{ action('App\Http\Controllers\CustomerGroupsController@agentlist') }}" autocomplete="off"></select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="soft_lic">Software License: <span style="color:red;">*</span>:</label>
                            <input type="text" class="form-control" name="soft_lic" value="{{$customer_group->soft_lic}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="curpassword">Current password:</label>
                            <input type="text" class="form-control" name="curpassword" value="{{$customer_group->cfgpassword}}" readOnly="readOnly">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="newpassword">New password:</label>
                            <input type="text" class="form-control" name="newpassword" value="{{$customer_group->cfgpassword}}" readOnly="readOnly">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveSerial">Save</button>
            </div>
        </div>
    </div>
</div>
