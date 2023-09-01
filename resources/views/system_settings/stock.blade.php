<div id="stock" class="tab-pane fade">
    <div class="row form-group">
        <div class="col-3">
            <label for="reportprinter">Opening Year:</label>
            <input type="text" seq="21" class="form-control enterseq" max-length="100" name="opening_year" value="{{$systemSettings->first()->opening_year}}" />
        </div>
        <div class="col-3">
            <label for="reportprinter">Max Upload photo:</label>
            <input type="text" seq="22" class="form-control enterseq" max-length="100" name="upload_photo_limit" value="{{$systemSettings->first()->upload_photo_limit}}" />
        </div>
    </div>
</div>
