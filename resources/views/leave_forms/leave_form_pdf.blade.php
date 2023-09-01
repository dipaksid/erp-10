<html>
<head>
    <style>
        /** Define the margins of your page **/
        @font-face {
            font-family: 'arialbold';
            font-style: normal;
            font-weight: bold;
            src: url({{ storage_path('fonts/arial-black.ttf') }}) format("truetype");
        }
        @page {
            size: a5 landscape;
            margin: 282px 25px 120px 35px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        header {
            position: fixed;
            top: -282px;
            left: -35px;
            right: -25px;
            height: 160px;
        }
        footer {
            position: fixed;
            bottom: -120px;
            left: -35px;
            right: -25px;
            height: 120px;
        }
        div.col{
            float:left;
            font-size: x-small;
            padding:5px;
            border-bottom: 1px solid;
        }
        div.colheader{
            float:left;
            font-size: x-small;
            padding:5px;
            border-top: 1px solid;
            font-weight: bold;
        }
        div.col1{
            width:40px;
        }
        div.col2{
            width:100px;
        }
        div.col3{
            width:100px;
            text-align: left;
        }
        div.col4{
            width:252px;
            text-align: left;
        }
        div.col5{
            width:92px;
            text-align: right;
        }
        div.col6{
            width:92px;
            text-align: right;
        }
        div.fclear{
            clear:both;
        }
        div.invheader{
            margin-top:115px;
            margin-left:35px;
            margin-right:25px;
            font-size: x-small;
        }
        div.invfooter{
            margin-top:10px;
            margin-bottom:30px;
            margin-left:35px;
            margin-right:25px;
        }
        div.moneyconvert{
            font-size: x-small;
        }
        div.page-break{ page-break-after: always; }
        .text-center{
            text-align: center;
        }
        header{
            background-image: url("{{ URL::to('/') }}/company/{{$compid}}/bwheader.jpg");
            background-repeat: no-repeat;
        }
        footer{

            background-position: 0px -120px 0px 0px;
            background-repeat: no-repeat;
        }
        body{

            background-position: -35px 29px 0px 0px;
            background-repeat: no-repeat;
        }
        .rectangle {
            height: 15px;
            width: 30px;
            border: 1px solid;
        }
    </style>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<header>

    <div class="invheader">
        @if(file_exists(public_path("/company/".$compid."/bwheaderqr.jpg")))
            <img src="{{ URL::to('/') }}/company/{{$compid}}/bwheaderqr.jpg" style="position:absolute; top:22; left:527; width:70px;"/>
        @endif
        <div class="text-center">
            <h2 style="font-family: 'arialbold'; padding:0; margin-top:10px;">
                LEAVE FORM
            </h2>
        </div>
        <div>
            @php
                $leave_typ1 = '';
                $leave_typ2 = '';
                $leave_typ3 = '';
                $leave_typ4= '';
                $leave_typ5 = '';
                $leave_typ6 = '';
                $form_status = '';
                $form_status2 = '';
                if($leaveform->leave_typ=='Annual'){
                  $leave_typ1 = '&nbsp;✔';
                }
                if($leaveform->leave_typ=='M.C'){
                  $leave_typ2 = '&nbsp;✔';
                }
                if($leaveform->leave_typ=='No Pay'){
                  $leave_typ3 = '&nbsp;✔';
                }
                if($leaveform->leave_typ=='Marriage'){
                  $leave_typ4 = '&nbsp;✔';
                }
                if($leaveform->leave_typ=='Maternity'){
                  $leave_typ5 = '&nbsp;✔';
                }
                if($leaveform->leave_typ=='Emergency'){
                  $leave_typ6 = '&nbsp;✔';
                }
                if($leaveform->status==1){
                  $form_status = '&nbsp;✔';
                }
                if($leaveform->status==0){
                  $form_status2 = '&nbsp;✔';
                }
            @endphp
            <div style="float:left;width:100px; font-size:12px; font-weight:bold;">
                <div style="padding:2px;">Staff Name </div>

            </div>
            <div style="float:left;width:10px; font-size:12px;">
                <div style="padding:2px;"> : </div>
            </div>
            <div style="float:left;width:200px;font-size: 10px;">
                <div style="padding:2px;font-weight:bold; border-bottom: 1px solid black;">
                    {{$leaveform->staff_name}}
                </div>
            </div>
            <div style="float:left;width:90px;font-size:12px;font-weight:bold;">
                <div>
                    <div style="padding:2px;">Designation</div>
                </div>
            </div>
            <div style="float:left;width:10px;font-size:12px;">
                <div style="padding:2px;">:</div>

            </div>
            <div style="float:left;width:200px;font-size:12px;">
                <div style="padding:2px;font-weight:bold;border-bottom: 1px solid black;"><b>{{$leaveform->designation}}</b></div>
            </div>
            <div class="fclear"></div>

            <!--- type of leave -------------------------------------------------------------->
            <div>&nbsp;</div>
            <div style="float:left;width:100px; font-size:12px; font-weight:bold;">
                <div style="padding:2px;">Type of leave </div>

            </div>
            <div style="float:left;width:10px; font-size:12px;">
                <div style="padding:2px;"> : </div>

            </div>
            <div style="float:left;width:50px;font-size: 10px;">
                <div style="padding:2px;">
                    Annual
                </div>
                <div style="padding:2px;">
                    M.C.
                </div>
                <div style="padding:2px;">
                    No pay
                </div>
            </div>
            <div style="float:left;width:150px;font-size:12px;font-weight:bold;">
                <div>
                    <div class="rectangle"><span style="font-family: DejaVu Sans, sans-serif; font-size:15px; margin-top:20px!important;">{{$leave_typ1}}</span></div>
                </div>
                <div>
                    <div class="rectangle"><span style="font-family: DejaVu Sans, sans-serif; font-size:15px; margin-top:-20px!important;">{{$leave_typ2}}</span></div>
                </div>
                <div>
                    <div class="rectangle"><span style="font-family: DejaVu Sans, sans-serif; font-size:15px; margin-top:-20px!important;">{{$leave_typ3}}</span></div>
                </div>
            </div>
            <div style="float:left;width:70px;font-size:12px;">
                <div style="padding:2px;">Marriage</div>
                <div style="padding:2px;">Maternity</div>
                <div style="padding:2px;">Emergency</div>
            </div>
            <div style="float:left;width:200px;font-size:12px;">
                <div class="rectangle"><span style="font-family: DejaVu Sans, sans-serif; font-size:15px; margin-top:-20px!important;">{{$leave_typ4}}</span></div>
                <div class="rectangle"><span style="font-family: DejaVu Sans, sans-serif; font-size:15px; margin-top:-20px!important;">{{$leave_typ5}}</span></div>
                <div class="rectangle"><span style="font-family: DejaVu Sans, sans-serif; font-size:15px; margin-top:-20px!important;">{{$leave_typ6}}</span></div>
            </div>

            <!-------------------------------------------------------------------------------->
            <br><br><br><br><br>
            <div style="float:left;width:120px; font-size:12px; font-weight:bold;">
                <div style="padding:2px;">Duration of leave </div>

            </div>
            <div style="float:left;width:10px; font-size:12px;">
                <div style="padding:2px;"> : </div>
            </div>
            <div style="float:left;width:100px;font-size: 10px;">
                <div style="padding:2px; text-align:center; border-bottom: 1px solid black;">
                    {{$leaveform->leave_duration}}
                </div>
            </div>
            <div style="float:left;width:75px;font-size:12px;">
                <div>
                    <div style="padding:2px;">days</div>
                </div>
            </div>
            <div style="float:left;width:70px;font-size:12px;">
                <div style="padding:2px;">Date:(from)</div>

            </div>
            <div style="float:left;width:80px;font-size:12px;">
                <div style="padding:2px;font-weight:bold;border-bottom: 1px solid black;"><b>{{$leaveform->leave_dat_frm}}</b></div>
            </div>
            <div style="float:left;width:10px;font-size:12px;">
                &nbsp;
            </div>
            <div style="float:left;width:30px;font-size:12px;">
                <div style="padding:2px;">(to) </div>
            </div>
            <div style="float:left;width:80px;font-size:12px;">
                <div style="padding:2px;font-weight:bold;border-bottom: 1px solid black;"><b>{{$leaveform->leave_dat_to}}</b></div>
            </div>
            <div class="fclear"></div>
            <br><br><br>
            @php
                $arr_length = strlen($leaveform->leave_reason);
                $reason_txt = '&nbsp;';
                $reason_txt2 = '&nbsp;';
                if($arr_length>50){
                  $arr_reason =  str_split($leaveform->leave_reason,50);
                  $reason_txt = $arr_reason[0];
                  $reason_txt2 = $arr_reason[1];
                } else {
                  $reason_txt = $leaveform->leave_reason;
                  $reason_txt2 = '&nbsp;';
                }
                if(!empty($leaveform->approved_dat)){
                  $approved_dat = $leaveform->approved_dat;
                } else {
                  $approved_dat = '&nbsp;';
                }
                if(!empty($leaveform->approved_by)){
                  $approved_by = $leaveform->approved_by;
                } else {
                  $approved_by = '&nbsp;';
                }
            @endphp
            <div style="float:left;width:120px; font-size:12px; font-weight:bold;">
                <div style="padding:2px;">Reason of leave: </div>
            </div>
            <div style="float:left;width:550px; font-size:12px; font-weight:bold; border-bottom: 1px solid black;">
                {{$reason_txt}}
            </div>
            <br><br>
            <div style="float:left;width:120px; font-size:12px; font-weight:bold;">
                <div style="padding:2px;">&nbsp;</div>
            </div>
            <div style="float:left;width:550px; font-size:12px; font-weight:bold; border-bottom: 1px solid black;">
                {{$reason_txt2}}
            </div>

        </div>

    </div>
</header>

<footer>
    <div class="invfooter">
        <hr style="border:0.1px solid; padding:0; margin:3px 0;">
        <br>
        <div style="float:left;width:150px; font-size:12px; text-align: left; font-weight:bold; border-bottom: 1px solid black;">
            <div style="padding:2px;">{{$leaveform->staff_name}} </div>
        </div>
        <div style="float:left;width:150px;font-size: 10px;">
            <div style="padding:2px;">
                &nbsp;
            </div>
        </div>
        <div style="float:left;width:80px;font-size:12px;font-weight:bold;">
            <div>
                <div style="padding:2px;">Approved</div>
            </div>
        </div>
        <div style="float:left;width:150px;font-size:12px;">
            <div class="rectangle"> <span style="font-family: DejaVu Sans, sans-serif; font-size:15px;">{{$form_status}}</span></div>
        </div>
        <div style="float:left;width:150px; font-size:12px; text-align: left;font-weight:bold; border-bottom: 1px solid black;">
            <div style="padding:2px;">{{$approved_by}} </div>
        </div>
        <div class="fclear"></div>
        <div style="float:left;width:150px; font-size:12px; text-align:left; font-weight:bold;">
            <div style="padding:2px;">Applicant Signatory</div>
        </div>

        <div style="float:left;width:150px;font-size: 10px;">
            <div style="padding:2px;">
                &nbsp;
            </div>
        </div>
        <div style="float:left;width:80px;font-size:12px;font-weight:bold;">
            <div>
                <div style="padding:2px;">Rejected</div>
            </div>
        </div>
        <div style="float:left;width:150px;font-size:12px;">
            <div class="rectangle"><span style="font-family: DejaVu Sans, sans-serif; font-size:15px; margin-top:-20px!important;">{{$form_status2}}</span></div>
        </div>
        <div style="float:left;width:150px; font-size:12px; text-align: left; font-weight:bold;">
            <div style="padding:2px;">Authorised signatory</div>
        </div>
        <div class="fclear"></div>
        <div style="float:left;width:150px; font-size:12px; text-align: left; font-weight:bold;">
            <div style="padding:2px;">Date: {{$leaveform->applied_dat}}</div>
        </div>

        <div style="float:left;width:150px;font-size: 10px;">
            <div style="padding:2px;">
                &nbsp;
            </div>
        </div>
        <div style="float:left;width:80px;font-size:12px;font-weight:bold;">
            <div>

            </div>
        </div>
        <div style="float:left;width:150px;font-size:12px;">

        </div>
        <div style="float:left;width:150px; font-size:12px; text-align: left; font-weight:bold;">
            <div style="padding:2px;">Date: {{$approved_dat}}</div>
        </div>
    </div>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>

</main>
</body>
</html>
