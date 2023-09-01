<html>
<head>
    <style>
        /** Define the margins of your page **/
        .images {
            height: 50;
            margin: 0 auto;
            overflow: hidden;
            width: 100;
            top:180px;
            position:relative;
        }
        .images2 {
            height: 150;
            margin: 0 auto;
            overflow: hidden;
            width: 100;
            top:100px;
            position:relative;
        }
        /** Define the margins of your page **/
        @page {
            margin: 180px 25px 175px 35px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table {

            border-collapse: collapse;
        }
        table th {

            font-size:10px;
            background-color:yellow;
            color: red;
            border: 1px solid black;
        }
        table td {

            font-size:12px;
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
            bottom: -240px;
            left: -55px;
            right: -25px;
            height: 320px;
        }
        header{
            background-image: url("{{ URL::to('/') }}/company/{{$compid}}/bwheader.jpg");
            background-repeat: no-repeat;
        }
        footer{
            background-image: url("{{ URL::to('/') }}/company/{{$compid}}/bwfooter.jpg");
            background-repeat: no-repeat!important;


        }


        div.fcol{
            float:left;
            padding:5px 5px 0px 5px !important;
        }
        div.col{
            float:left;
            font-size: 12px;
            padding:1px 5px 0px 5px;
        }
        div.colheader{
            float:left;
            font-size: 15px;
            padding:5px;
            font-weight: bold;

        }
        div.colheader2{
            float:right;
            font-size: 15px;
            padding:5px;
            font-weight: bold;

        }
        div.col1{
            width:38px;
        }
        div.col2{
            width:425px;
        }
        div.col2 p {
            padding: 0;
            margin: 0;
        }
        div.col3{
            width:22px;
            text-align: center;
        }
        div.col4{
            width:62px;
            text-align: left;
        }
        div.col5{
            width:72px;
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
            margin-bottom:30px;
            margin-left:35px;
            margin-right:25px;
        }
        div.moneyconvert{
            font-size: x-small;
        }
        .std_siz{
            font-size:14px;
        }
        div.page-break{ page-break-after: always; }
        div.page-break-before{ page-break-before: always; }

        div.nosplit {
            page-break-inside: avoid;
        }

    </style>
</head>
<body>
<script type="text/php">
          if (isset($pdf)) {
            $x = 510;
              $y = 190;
              $text = "";
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
                <img src="{{ URL::to('/') }}/company/{{$compid}}/bwheaderqr.jpg" style="position:absolute; top:22; left:527; width:70px;"/>
            @endif
            <div style="width:100%;">
                <div style="width:100%;">
                    <div style="padding:2px;font-size:11px; color:purple;"><b>Staff Name : {{$leaveform->staff_name }}&nbsp;</b> </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div style="width:100%;">
                <div style="width:100%;">
                    <div style="padding:2px;font-size:11px; color:purple;"><b>Leave Date : {{$leaveform->leave_dat_frm}}&nbsp; {{($leaveform->leave_dat_frm!=$leaveform->leave_dat_to)?"- ".$leaveform->leave_dat_to:""}}</b> </div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
        <br>
        <div style="width:100%;">
            <div style="width:100%;">
                <div style="padding:2px;font-size:11px; color:purple;"><b>Upload Image</b></div>
            </div>
        </div>
    </div>
</header>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <div class="">
    @if(isset($imgs) && is_array($imgs) && count($imgs) > 0)
        @foreach($imgs as $key => $imgrow)
            <img  src="{{ URL::to('/') }}/leave_form/{{$leaveform->doc_no}}/{{$imgrow}}" style="height:670px; margin-top:3px;"/><br>
        @endforeach
    @endif
    </div>

</main>

</body>
</html>
