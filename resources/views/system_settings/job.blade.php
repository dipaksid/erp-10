<div id="job" class="tab-pane fade">
    <div class="row form-group">
        <input type="hidden" name="id" value="{{ $systemSettings->first()->id }}">
        <div class="col-3">
            <label for="jobrefreshtime">Job Refresh Timeframe in Seconds:</label>
            <input type="number" seq="9" class="form-control enterseq"  name="jobrefreshtime" value="{{ $systemSettings->first()->jobrefreshtime }}"/>
        </div>

        <div class="col-3">
            <label for="jobnotifyday">Job notify over no. of Days:</label>
            <input type="number" seq="10" class="form-control enterseq" name="jobnotifyday" value="{{ $systemSettings->first()->jobnotifyday }}" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label for="reportprinter">Job File Upload Size Limit (????MB):</label>
            <input type="number" seq="11" class="form-control enterseq" name="uploadfilelimit" value="{{ $systemSettings->first()->uploadfilelimit }}" />
        </div>
    </div>
</div>
