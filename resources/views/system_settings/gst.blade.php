<div id="gst" class="tab-pane fade">
    <div class="row form-group">
        <div class="col-3">
            <label for="reportprinter">Allow GST:</label>
            <select seq="16" class="form-control enterseq" id="allow_gst" name="allow_gst">
                <option {{ (($systemSettings->first()->allow_gst=="Y")?"selected":"") }} value="Y">YES</option>
                <option {{ (($systemSettings->first()->allow_gst=="N")?"selected":"") }} value="N">No</option>
            </select>
        </div>
        <div class="col-3">
            <label for="reportprinter">GST Calculate On Total:</label>
            <select seq="17" class="form-control enterseq" id="gst_calculate_total" name="gst_calculate_total">
                <option {{ (($systemSettings->first()->gst_calculate_total=="Y")?"selected":"") }} value="Y">YES</option>
                <option {{ (($systemSettings->first()->gst_calculate_total=="N")?"selected":"") }} value="N">No</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12">
            <label for="reportprinter">GST Rate:</label>
        </div>
        <div class="col-12">
            <table class="table">
                <thead class="thead-light">
                <tr class="row">
                    <th class="col-sm-3"><input type='text' name='effectivedate_from' id="effectivedate_from" seq="18" class="form-control enterseq"></th>
                    <th class="col-sm-3"><input type='text' name='effectivedate_to' seq="19" id="effectivedate_to" class="form-control enterseq"></th>
                    <th class="col-sm-3"><input type='text' name='rate' seq="20" id="rate" class="form-control enterseq"></th>
                    <th class="col-sm-1"><input type='hidden' name="en_amount" class="form-control text-right readonly" readOnly></th>
                    <th class="col-sm-1"><input type='hidden' name="en_netamount" class="form-control text-right readonly" readOnly></th>
                    <th scope="col" class="editnum"></th>
                    <th class="col canceledit"> </th>
                </tr>
                <tr class="row">
                    <th class="col-sm-3">Effective Date From</th>
                    <th class="col-sm-3">Effective Date To</th>
                    <th class="col-sm-3">Rate (%)</th>
                    <th class="col-sm-3">Action</th>
                </tr>
                </thead>
                <tbody id="bodyitem">
                @php
                    $num=0;
                @endphp
                @foreach($gst as $key => $value)
                    @php $num++; @endphp
                    <tr class="row" id="inputFormRow">
                        <td class="col-sm-3"><input type="text" onkeydown="if (event.keyCode == 13)js_dateformat(this)" class="form-control enterseq" name="d_effectivedate_from[]" value="{{date('d/m/Y',strtotime($value->effectivedate_from))}}" ></td>
                        <td class="col-sm-3"><input type="text" onkeydown="if (event.keyCode == 13)js_dateformat(this)" class="form-control enterseq" name="d_effectivedate_to[]" value="{{date('d/m/Y',strtotime($value->effectivedate_to))}}" ></td>
                        <td class="col-sm-3"><input type="text" class="form-control enterseq" name="d_rate[]" value="{{number_format((float)$value->rate, 2, '.', '')}}" ></td>
                        <td class="col-sm-3"><button type="button" class="btn btn-warning btn-xs fas fa-trash" id="removeRow"></button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
