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
            margin: 180px 25px 30px 10px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        header {
            position: fixed;
            top: -150px;
            left: 0px;
            right: 0px;
            height: 150px;
        }
        footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            height: 30px;
        }
        div.col{
            float:left;
            font-size: 10px;
            padding:5px;
            height:28px;
        }
        div.colheader{
            float:left;
            font-size: 9px;
            padding:5px;
            border-top: 1px solid;
            font-weight: bold;
            border-bottom: 1px solid;
        }
        div.col0{
            width:20px;
        }
        div.col1{
            width:150px;
        }
        div.col2{
            width:60px;
        }
        div.col3{
            width:60px;
        }
        div.col4{
            width:60px;
        }
        div.col5{
            width:100px;
        }
        div.col6{
            width:40;
        }
        div.fclear{
            clear:both;
        }
        div.invheader{
            font-size: x-small;
        }
        div.moneyconvert{
            font-size: x-small;
        }
        div.page-break{ page-break-after: always; }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
<script type="text/php">
     @php
            if (isset($pdf)) {
                $text = " Page {PAGE_NUM} of {PAGE_COUNT}";
                $font = null;
                $size = 11;
                $color = array(0,0,0);
                $word_space = 0.0;  //  default
                $char_space = 0.0;  //  default
                $angle = 0.0;   //  default
                //$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
                $x = 530;
                $y = 90;
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }
     @endphp
</script>
<!-- Define header and footer blocks before your content -->
<header>
    <img style='width:20px; position:fixed; right:160; top:-85;' src="{{storage_path('imgs/whatsapp.png')}}">
    <div class="invheader">
        <div class="text-center">
            <b style="font-size:19px;font-weight:bold;">BRIGHT-WIN TECHNOLOGY (M) SDN BHD</b>
            <i style="font-size:11px;">(456842-H)</i>
        </div>
        <div class="text-center" style="font-size:10px;">
            21-1A JALAN PERDANA 4/8 TAMAN PANDAN PERDANA 55300 KUALA LUMPUR<br>
            Tel : 03-92824788, 012-2083761 &nbsp;&nbsp;&nbsp; Support Line : 016-2163761 <br>
            URL : www.brightwin.com  &nbsp;&nbsp;&nbsp; Email : pychan@brightwin.com &nbsp;
        </div>
        <div class="text-center">
            <h2 style="font-family: 'arialbold'; padding:0;">
                CUSTOMER LIST
            </h2>
        </div>

    </div>
    <div>
        <div class="colheader col0"><br>#</div>
        <div class="colheader col1">CUSTOMER <br>NAME</div>
        <div class="colheader col2"><br>AREA</div>
        <div class="colheader col3">CUSTOMER <br>CODE</div>
        <div class="colheader col4">REGISTRATION <br>NO</div>
        <div class="colheader col4">REGISTRATION <br>NO 2</div>
        <div class="colheader col5">CONTACT <br>PERSON</div>
        <div class="colheader col4"><br>PHONE 1</div>
        <div class="colheader col4"><br>PHONE 2</div>
        <div class="colheader col4"><br>STATUS</div>
        <div class="fclear"></div>
    </div>
</header>

<footer>

</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    @php
        $ilop=0;
    @endphp
    @foreach($data as $i => $rows)
        <div>
            <div class="col col0">{{($i+1)}}.</div>
            <div class="col col1">{{$rows->companyname}}</div>
            <div class="col col2">{{$rows->description}}</div>
            <div class="col col3">{{$rows->companycode}}</div>
            <div class="col col4">{{$rows->registrationno}}</div>
            <div class="col col4">{{$rows->registrationno2}}</div>
            <div class="col col5">{{$rows->contactperson}}</div>
            <div class="col col4">{{$rows->phoneno1}}</div>
            <div class="col col4">{{$rows->phoneno2}}</div>
            <div class="col col6">{{(($rows->status=="1")?"ACTIVE":"NOT ACTIVE")}}</div>
            <div class="fclear"></div>
        </div>
        @php
            $ilop++;
        @endphp
        @if($ilop%20==0 && $ilop>0)
            <div class="page-break"></div>
        @endif
    @endforeach
</main>
</body>
</html>
