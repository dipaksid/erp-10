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
                margin: 220px 25px 10px 35px;
            }
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            header {
                position: fixed;
                top: -170px;
                left: 0px;
                right: 0px;
                height: 180px;
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
                font-size: x-small;
                padding:5px;
            }
            div.colheader{
                float:left;
                font-size: x-small;
                padding:5px;
                border-top: 1px solid; 
                font-weight: bold;
                border-bottom: 1px solid; 
            }
            div.col1{
                width:100px;
            }
            div.col2{
                width:440px;
            }
            div.col3{
                width:100px;
            }
            div.col4{
                width:80px;
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
			.text-danger{
				color:red;
				font-weight:bold;
			}
        </style>
    </head>
    <body>
        <script type="text/php">
            if (isset($pdf)) {
                $x = 270;
                $y = 760;
                $text = " Page {PAGE_NUM} of {PAGE_COUNT}";
                $font = null;
                $size = 11;
                $color = array(0,0,0);
                $word_space = 0.0;  //  default
                $char_space = 0.0;  //  default
                $angle = 0.0;   //  default
                //$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
                $x = 530;
                $y = 120;
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }
        </script>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img style='width:20px; position:fixed; right:160; top:-98;' src="{{storage_path('imgs/whatsapp.png')}}">
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
                        SERIALIZATION CATEGORY REPORT
                    </h2>
                </div>
                <div>
                    <div style="width:610px;">
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;">Serialization Category</div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:14px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;"><b>{{$cateshow}}&nbsp;</b></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>

            <div class="colheader col1">SERIAL NO</div>
            <div class="colheader col2">CUSTOMER NAME</div>
            <div class="colheader col3">DATE CREATED</div>
            <div class="colheader col4">STATUS</div>
            <div class="fclear"></div>
        </header>

        <footer>
            
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            @php
            $karea = "";
            $ilop=0;
			$nppg=31;
			$kserial="";
            @endphp
			@if($data->count()>0)
            @foreach($data as $i => $rows)
                @if($ilop>=$nppg)
                    <div class="page-break"></div>
					@php $ilop=0; @endphp
                @endif
                @if($karea=="" || $karea!=$rows->categorycode)
                <div>
                    <div class="col col1">{{$rows->categorycode}}</div>
                    <div class="col col2"></div>
                    <div class="col col3"></div>
                    <div class="fclear"></div>
                </div>
                    @php $ilop++; @endphp
                <hr>
                    @php $ilop++; @endphp
					@if($ilop>=$nppg)
						<div class="page-break"></div>
						@php $ilop=0; @endphp
					@endif
                @endif
				@if($kserial!="" && ($rows->serial_no-$kserial)<10 && ($rows->serial_no-$kserial)>1 )
					@for($dd=1;$dd<($rows->serial_no-$kserial);$dd++ )
						<div>
							<div class="col col1 text-danger">{{($kserial+$dd)}}</div>
							<div class="col col2 text-danger">CANCELLED</div>
							<div class="col col3"></div>
							<div class="col col4"></div>
							<div class="fclear"></div>
						</div>
						@php $ilop++; @endphp
						@if($ilop>=$nppg)
							<div class="page-break"></div>
							@php $ilop=0; @endphp
						@endif
					@endfor
				@endif
                <div>
                    <div class="col col1">{{$rows->serial_no}}</div>
                    <div class="col col2">{{$rows->companyname}}</div>
                    <div class="col col3">{{$rows->createdat}}</div>
                    <div class="col col4">{{$rows->active}}</div>
                    <div class="fclear"></div>
                </div>
                @php
                    $karea = $rows->categorycode;
					$kserial = $rows->serial_no;
					$ilop++;
                @endphp
            @endforeach
			@endif
			
        </main>
    </body>
</html>