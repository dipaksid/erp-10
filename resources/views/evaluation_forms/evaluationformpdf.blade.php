<html>
<head>
    <style>
        .td_1 {
            text-align:: left;
            width: 68%;
            margin-left: 5px !important;
        }

        .td_2 {
            text-align: center;
            width: 10%;
            font-weight: bold;
        }

        .td_3 {
            text-align: center;
            width: 10%;
        }

        .td_4 {
            text-align: center;
            width: 10%;
        }

        .total-num1 {
            margin-right: 3px !important;
        }

        .total-num2 {
            margin-right: 15px !important;
        }

        .bp-rating {
            position: relative;
            display: inline;
        }

        .slash0 {
            height: 36px;
            width: 0px;
            transform: skew(-59deg) translate(12px, 7px);
            border: solid 1px black;
            display: inline-block;
        }

        .slash {
            height: 29px;
            width: 0px;
            transform: skew(-65deg) translate(12px, 5px);
            border: solid 1px black;
            display: inline-block;
        }

        td.linetd:after {
            content: "";
            display: block;
            width: 100%;
            height: 1px;
            background-color: black;


        }

        .line {
            width: 100%;
            height: 0;
            border-bottom: 1px solid #111;
            float: left;
            margin: 0;
            position: absolute;
            z-index: 0;
            top: 50%;
            left: 0
        }

        /** Define the margins of your page **/
        .images {
            height: 50;
            margin: 0 auto;
            overflow: hidden;
            width: 100;
            top: 180px;
            position: relative;
        }

        .images2 {
            height: 50;
            margin: 0 auto;
            overflow: hidden;
            width: 100;
            top: 180px;
            position: relative;
        }

        /** Define the margins of your page **/
        @page {
            margin: 170px 25px 25px 35px;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {

            border-collapse: collapse;
        }

        table th {

            font-size: 10px;
            border: 1px solid black;
        }

        table td {
            font-size: 11.5px;
        }

        header {
            position: fixed;
            top: -180px;
            left: -35px;
            right: -25px;
            height: 160px;

        }

        main {
            z-index: 1 !important;
        }

        footer {
            position: fixed;
            bottom: -90px;
            left: -55px;
            right: -25px;
            height: 320px;

        }

        header {
            background-image: url("{{ URL::to('/') }}/company/{{$compid}}/bwheader.jpg");
            background-repeat: no-repeat;
        }

        footer {
            background-image: url("{{ URL::to('/') }}/company/{{$compid}}/bwfooter.jpg");
            background-repeat: no-repeat !important;


        }


        div.fcol {
            float: left;
            padding: 5px 5px 0px 5px !important;
        }

        div.col {
            float: left;
            font-size: 12px;
            padding: 1px 5px 0px 5px;
        }

        div.colheader {
            float: left;
            font-size: 15px;
            padding: 5px;
            font-weight: bold;

        }

        div.colheader2 {
            float: right;
            font-size: 15px;
            padding: 5px;
            font-weight: bold;

        }

        div.col1 {
            width: 38px;
        }

        div.col2 {
            width: 425px;
        }

        div.col2 p {
            padding: 0;
            margin: 0;
        }

        div.col3 {
            width: 22px;
            text-align: center;
        }

        div.col4 {
            width: 62px;
            text-align: left;
        }

        div.col5 {
            width: 72px;
            text-align: right;
        }

        div.fclear {
            clear: both;
        }

        div.invheader {
            margin-top: 115px;
            margin-left: 35px;
            margin-right: 25px;
            font-size: x-small;
        }

        div.invfooter {
            margin-bottom: 30px;
            margin-left: 35px;
            margin-right: 25px;
        }

        div.moneyconvert {
            font-size: x-small;
        }

        .std_siz {
            font-size: 14px;
        }

        div.page-break {
            page-break-after: always;
        }

        div.page-break-before {
            page-break-before: always;
        }

        div.nosplit {
            page-break-inside: avoid;
        }

        .rectangle {
            height: 15px;
            width: 50px;
            border: 1px solid;
        }

        .pixelart {
            width: 1px;
            height: 1px;
            transform: scale(20);
            background: transparent;
            box-shadow: 27px 0px white, 26px 1px white, 25px 2px white, 24px 3px white, 23px 4px white, 22px 5px white, 21px 6px white, 20px 7px white, 19px 8px white, 18px 9px white, 17px 10px white, 16px 11px white, 15px 12px white, 14px 13px white, 13px 14px white, 12px 15px white, 11px 16px white, 10px 17px white, 9px 18px white, 8px 19px white, 7px 20px white, 6px 21px white, 5px 22px white, 4px 23px white, 3px 24px white, 2px 25px white, 1px 26px white, 0px 27px white;
        }
    </style>
</head>
<body>
<script type="text/php">
          if (isset($pdf)) {
              $x = 570;
              $y = 113;
              $text = " {PAGE_NUM}/{PAGE_COUNT}";
              $font = null;
              $size = 11;
              $color = array(0,0,0);
              $word_space = 0.0;  //  default
              $char_space = 0.0;  //  default
              $angle = 0.0;   //  default
              $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);

              $w = $pdf->get_width();
              $h = $pdf->get_height();

          //    $pdf->image(public_path('sw_chop/softwareservice_signature.png'),312, 600,200, 70);
          }


</script>

<!-- Define header and footer blocks before your content -->
<header>

    <div class="invheader">
        <br>
        <div>
            @if(file_exists(public_path("/company/".$compid."/bwheaderqr.jpg")))
                <img src="{{ URL::to('/') }}/company/{{$compid}}/bwheaderqr.jpg"
                     style="position:absolute; top:22; left:527; width:70px;"/>
            @endif
            <div style="width:100%;">
                <div style="width:100%;">
                    <div>&nbsp;</div>
                    <!--  <div style="padding:2px;font-size:15px; color:green;"><b>PERFORMANCE APPRAISAL FORM - {{$evaluationform->form_title}}</b></div> -->
                </div>
                <div style="clear:both;"></div>
            </div>

        </div>
        <br>
        <div style="width:100%;">
            <div style="width:100%;">
                <div></div>
            </div>
        </div>
        <div style="width:100%;">
            <div style="width:100%;">
                <div style="padding:2px;font-size:15px; color:green;"><b>PERFORMANCE APPRAISAL FORM
                        - {{$evaluationform->form_title}}</b></div>
            </div>
        </div>
    </div>
</header>

<footer>


</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <div class="">
        <div style="width:610px; margin-top:20px;">

            <div style="float:left;width:60px;">
                <div style="padding:2px;font-size:14px;">
                    <div class="rectangle"></div>
                </div>
            </div>

            <div style="float:left;width:150px;">

                <div style="padding:2px;font-size:14px;">Annual Review</div>
            </div>

            <div style="float:left;width:60px;">
                <div style="padding:2px;font-size:14px;">
                    <div class="rectangle"></div>
                </div>
            </div>

            <div style="float:left;width:150px;">
                <div style="padding:2px;font-size:14px; ">Confirmation</div>
            </div>

            <div style="float:left;width:60px;">
                <div style="padding:2px;font-size:14px;">
                    <div class="rectangle"></div>
                </div>
            </div>
            <div style="float:left;width:150px;">
                <div style="padding:2px;font-size:14px;">Promotion</div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div style="margin-top:10px;margin-bottom:20px;">
        <table class="table table-striped" style="width:100%" border="1">
            <tr>
                <td style="border-bottom-style:none;">Employee's Name: <span id="employee_name"></span></td>
                <td style='border-bottom-style:none;'>Designation: <span id="designation"></span</td>
            </tr>
            <tr>
                <td style='border-right:solid 1px; border-top:none;'><br>Staff Code: <span id="staff_code"><br>&nbsp;
                </td>
                <td style='border-top:none;'>&nbsp;</td>
            </tr>

            <tr>
                <td>Department: <span id="department"></span><br>&nbsp;</td>
                <td>Date Joined: <span id="date_join"></span><br>&nbsp;</td>
            </tr>
            <tr>
                <td>Currently Salary: RM <span id="currently_salary"></span><br>&nbsp;</td>
                <td>Last Increment Amount: RM <span id="last_increment"></span><br>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">Review Period: <span id="review_period"></span><br>&nbsp;</td>
            </tr>
        </table>
    </div>
    <div style="margin-top:-5px;">
        <span style="color:#00337C;">Rating Standard Scale - Eeach Of The Attributes Below Carry 10 Points</span>
        <div style="width:610px; color:#00337C; margin-top:-10px;">
            <div style="float:left;width:320px;">
                <ul style="list-style-type: square">
                    <li>9 - 10 points (Very Good Performance)</li>
                    <li>6 - 8 points (Good Performance)</li>
                </ul>
            </div>
            <div style="float:left;width:50px;">
                <div>&nbsp;</div>
            </div>
            <div style="float:left;width:320px;">
                <ul style="list-style-type: square">
                    <li>3 - 5 points (Satisfactorily)</li>
                    <li>0 - 2 points (Needs Improvement)</li>
                </ul>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div style="margin-bottom:10px; font-size:13px;"><b>&nbsp; PART I - PLEASE CHECK YOUR RATING FOR EACH OF THE
            ATTRIBUTES BELOW:</b></div>
    <div>

        <table class="table table-striped" style="width:100%;" border="1">
            <tr>
                <th style="width:80%;margin-left:5px!important; font-size:13px; ">Performance Attributes /
                    Competencies<br></th>
                <th style="width:10%; text-align:center; font-size:13px;">(A) Own <br>Rating</th>
                <th style="width:10%; text-align:center; font-size:13px;">(B) HOD <br>Rating</th>
            </tr>

            <tbody>
            @php $num=0; @endphp
            @foreach($evaluationform_row as $key => $row)

                @php

                    $space = '';

                    $txtcolor = '';

                  $num++;
                @endphp
                <tr class="border-right">
                    <td style="text-align:left;  margin-left:5px!important;">
                        <b>{{$row['form_title']}}</b><br>- {{$row['form_detail']}}</td>
                    <td class="linetd1">
                        <table style="font-size:13px; text-align:right;width:100%;">
                            <tr>
                                <td rowspan="2"><span class="total-nums1"></span><span style="margin-right:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </td>
                                <td rowspan="2"><span class="slash0"></span><span class="total-num2">{{$row['max_rating']}}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="linetd1">
                        <table style="font-size:13px; text-align:right;width:100%;">
                            <tr colspan="2">
                                <td rowspan="2"><span class="total-nums2"></span><span style="margin-right:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </td>
                                <td rowspan="2"><span class="slash0"></span><span class="total-num2">{{$row['max_rating']}}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th style="text-align:center; font-size:13px; margin-left:350px!important;">TOTAL RATING</th>
                <th style="text-align:center; font-size:13px;">
                    <table style="font-size:15px; text-align:right;">
                        <tr>
                            <td><span class="total-num1"></span><span style="margin-right:25px;">&nbsp;&nbsp;</span>
                            </td>
                            <td><span class="slash"></span><span class="total-num2">100</span></td>
                        </tr>
                    </table>
                </th>
                <th>
                    <table style="font-size:15px; text-align:right;">
                        <tr>
                            <td><span class="total-num1"></span><span style="margin-right:25px;">&nbsp;&nbsp;</span>
                            </td>
                            <td><span class="slash"></span><span class="total-num2">100</span></td>
                        </tr>
                    </table>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
    <div style="margin-bottom:10px; margin-top:10px; font-size:13px;"><b> PART II - OVERALL PERFORMANCE RATING (PLEASE
            <span style="font-family: DejaVu Sans, sans-serif; font-size:15px;">✔</span> IN THE RELEVANT BOX)</b></div>

    <div>
        <table class="table table-striped" style="width:100%" border="1">
            <tr class="border-right">
                <td class="td_1"><b>80 points and above - Very Good Performance <br>
                        <li style="margin-left:20px; font-weight: normal;">Consistently exceeds job requirements
                            throughout the review period.
                        </li></td>
                <td class="td_2">GRADE<br>A</td>
                <td class="td_3 right"></td>
                <td class="td_4 right"></td>
            </tr>
            <tr class="border-right">
                <td class="td_1"><b>60 - 79 - Good Performance <br>
                        <li style="margin-left:20px; font-weight: normal">Frequently exceeds job requirements throughout
                            the review period.
                        </li></td>
                <td class="td_2">GRADE<br>B</td>
                <td class="td_3 right"></td>
                <td class="td_4 right"></td>
            </tr>
            <tr class="border-right">
                <td class="td_1"><b>41 - 59 points - Satisfactorily <br>
                        <li style="margin-left:20px; font-weight: normal">Able to perform the job duties satisfactority
                            throughout the review period.
                        </li></td>
                <td class="td_2">GRADE<br>C</td>
                <td class="td_3 right"></td>
                <td class="td_4 right"></td>
            </tr>
            <tr class="border-right">
                <td class="td_1"><b>Below 40 points - Need Improvement <br>
                        <li style="margin-left:20px; font-weight: normal">Occasionally fails to meet job requirements;
                            performance must improve to meet expectations.
                        </li></td>
                <td class="td_2">GRADE<br>D</td>
                <td class="td_3 right"></td>
                <td class="td_4 right"></td>
            </tr>
        </table>
    </div>
    <div>
        <div style="margin-bottom:10px; margin-top:20px; font-size:13px;"><b> Performance Achieved </b></div>
        <table class="table table-striped" style="width:100%" border="1">
            <tr class="border-right">
                <td style="text-align:left; width:50%; margin-left:5px!important;"><b>Target Achieved (B x 100%) :</td>
                <td style="text-align:left; width:50%;margin-left:5px!important;">Staff Performance Mark (A x 100%) :
                </td>
            </tr>
        </table>
    </div>
    <div>
        <div style="margin-bottom:10px; margin-top:20px; font-size:13px;"><b>Staff Comments: (Advantages, disadvantages
                and area of improvement)</b></div>
        <div style="width:100%">
            <div style="padding:2px;font-size:14px;  border-bottom: 1px solid black;"><b>&nbsp;</b></div>
        </div>
        <div style="width:100%">
            <div style="padding:2px;font-size:14px;  border-bottom: 1px solid black;"><b>&nbsp;</b></div>
        </div>
        <div style="width:100%">
            <div style="padding:2px;font-size:14px;  border-bottom: 1px solid black;"><b>&nbsp;</b></div>
        </div>
    </div>
    <div style="margin-bottom:20px; margin-top:20px; font-size:13px;">
        <div style="width:610px;">

            <div style="float:left;width:270px;">
                <div style="padding:2px;font-size:14px;font-weight:bold;">Suggestion on type of Training Course:</div>
            </div>

            <div style="float:left;width:485px;">
                <div style="padding:2px;font-size:14px;  border-bottom: 1px solid black;"><b>&nbsp;</b></div>
            </div>
        </div>
    </div>
    <br><br>
    <div style="margin-top:5px;">
        <div style="margin-bottom:0px; font-size:13px;"><b> Recommendations for increment:</b></div>
        <div>
            <table class="table table-striped" style="width:100%; font-size:20px;" border="1">
                <tr>
                    <td style="width:50%; margin-left:5px!important; text-align:left;font-size:15px;"><br>Current Basic
                        Salary: RM <br>&nbsp;
                    </td>
                    <td style="width:50%; margin-left:5px!important; text-align:left;font-size:15px;"><br>Proposed
                        Increment: RM <br>&nbsp;
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="margin-top:25px;">
        <div style="width:610px;">

            <div style="float:left;width:280px;">
                <div style="padding:2px;font-size:14px;">Staff:</div>
            </div>


            <div style="float:left;width:280px;">
                <div style="padding:2px;font-size:14px;">Rater/Review By HOD:</div>
            </div>


            <div style="float:left;width:280px;">
                <div style="padding:2px;font-size:14px;">Review By CEO:</div>
            </div>

            <div style="clear:both;"></div>
        </div>
    </div>
    <div style="margin-top:35px;">
        <div style="width:610px;">

            <div style="float:left;width:160px;">
                <div style="padding:2px;font-size:14px;  border-bottom: 1px dashed black;"><b>&nbsp;</b></div>
            </div>
            <div style="float:left;width:120px;">
                &nbsp;
            </div>

            <div style="float:left;width:160px;">
                <div style="padding:2px;font-size:14px;  border-bottom: 1px dashed black;"><b>&nbsp;</b></div>
            </div>

            <div style="float:left;width:120px;">
                &nbsp;
            </div>
            <div style="float:left;width:160px;">
                <div style="padding:2px;font-size:14px;  border-bottom: 1px dashed black;"><b>&nbsp;</b></div>
            </div>

            <div style="clear:both;"></div>
        </div>
    </div>
    <div>
        <div style="width:610px;">

            <div style="float:left;width:160px;">
                <div style="padding:2px;font-size:14px;">Date:</div>
            </div>
            <div style="float:left;width:120px;">
                &nbsp;
            </div>

            <div style="float:left;width:160px;">
                <div style="padding:2px;font-size:14px;">Date:</div>
            </div>

            <div style="float:left;width:120px;">
                &nbsp;
            </div>
            <div style="float:left;width:160px;">
                <div style="padding:2px;font-size:14px;">Date:</div>
            </div>

            <div style="clear:both;"></div>
        </div>
    </div>
    <div style="margin-top:30px;">
        <table class="table table-striped" style="width:100%" border="1">
            <thead>
            <tr>
                <th style="text-align:left; margin-left:5px!important; font-size:17px;" colspan="2">For Internal Use:
                </th>
            </tr>
            </thead>
            <tbody style="font-size:15px!important;">
            <tr>
                <td style="border-bottom-style:none;">Approved Increment: <span id="approved_increment"></span></td>
                <td style='border-bottom-style:none;'>Approved By: <span id="approved_by"></span></td>
            </tr>
            <tr>
                <td style='border-right:solid 1px; border-top:none;'><br>Effective Date: <br>&nbsp;</td>
                <td style='border-top:none;'>&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>
