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
                margin: 220px 25px 30px 35px;
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
                font-size: 8px;
                padding:5px;
            }
            div.colheader{
                float:left;
                font-size: 8px;
                padding:5px;
                border-top: 1px solid; 
                font-weight: bold;
                border-bottom: 1px solid; 
            }
            div.col1{
                width:50px;
            }
            div.col2{
                width:220px;
            }
            div.col3{
                width:50px;
                text-align: center;
            }
            div.col4{
                width:50px;
                text-align: center;
            }
            div.col5{
                width:50px;
                text-align: center;
            }
            div.col6{
                width:50px;
                text-align: center;
            }
            div.col7{
                width:40px;
                text-align: center;
            }
            div.col8{
                width:50px;
                text-align: center;
            }
            div.col9{
                width:50px;
                text-align: center;
            }
            div.col10{
                width:50px;
                text-align: right;
            }
            div.fclear{
                clear:both;
            }
            div.invheader{
                font-size: x-small;
            }
            div.page-break{ page-break-after: always; } 
            .text-center{
                text-align: center;
            }
			div.hdr {
				color:red;
				font-weight:bold;
				font-size:12px;
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
            <img style='width:20px; position:fixed; right:160; top:-97;' src="{{storage_path('imgs/whatsapp.png')}}">
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
                        SERVICE MAINTENANCE REPORT
                    </h2>
                </div>
                <div>
                   
                    <div style="width:610px;">
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;">PERIOD</div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:14px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;"><b>{{$request->input('period')}}&nbsp;</b></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>

            <div class="colheader col1"><br>SERVICE</div>
            <div class="colheader col2"><br>CUSTOMER</div>
            <div class="colheader col3">INCLUDE HARDWARE</div>
            <div class="colheader col4">CONTRACT TYPE</div>
            <div class="colheader col5">PAY BEFORE</div>
            <div class="colheader col6">SERVICE DATE</div>
            <div class="colheader col7">END DATE</div>
            <div class="colheader col8">INVOICE DATE</div>
            <div class="colheader col9">INVOICE<br> NO</div>
            <div class="colheader col10"><br>AMOUNT(MYR)</div>
            <div class="fclear"></div>
        </header>

        <footer>
            
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            @php
            $karea = "";
            $sum=array();
            $totsum=0;
            $ilop=0;
            @endphp
            @foreach($data as $i => $rows)
				@if( $request->input("inc_inv")=="Y" || ($request->input("inc_inv")=="N" && $rows->salesinvoicedate=="") )
					@if($karea=="" || $karea!=$rows->areacode)
						@if($karea!="")
							<div>
								<div class="col col1"></div>
								<div class="col col2"></div>
								<div class="col col3"></div>
								<div class="col col4"></div>
								<div class="col col5"></div>
								<div class="col col6"></div>
								<div class="col col7"></div>
								<div class="col col8"></div>
								<div class="col col9">Total {{$karea}}:</div>
								<div class="col col10" style="border-top: solid 1px;">{{number_format($sum[$karea],2)}}</div>
								<div class="fclear"></div>
							</div>
							@php $ilop++; @endphp
							@if($ilop%36==0 && $ilop>0)
								<div class="page-break"></div>
							@endif
						@endif
					<div>
						<div class="col col1 hdr">{{$rows->areacode}}</div>
						<div class="col col2 hdr">{{$rows->area_desc}}</div>
						<div class="col col3"></div>
						<div class="fclear"></div>
					</div>
						@php $ilop++; @endphp
						@if($ilop%36==0 && $ilop>0)
							<div class="page-break"></div>
						@endif
					<hr>
						@php $ilop++; @endphp
						@if($ilop%36==0 && $ilop>0)
							<div class="page-break"></div>
						@endif
					@endif
					<div>
						<div class="col col1">{{$rows->categorycode}}</div>
						<div class="col col2">{{$rows->companyname}}</div>
						<div class="col col3">{{$rows->inc_hw}}</div>
						<div class="col col4">{{$rows->contract}}</div>
						<div class="col col5">{{$rows->pay_before}}</div>
						<div class="col col6">{{$rows->service_date}}</div>
						<div class="col col7">{{$rows->end_date1}}</div>
						<div class="col col8">{{$rows->salesinvoicedate}}</div>
						<div class="col col9">{{$rows->salesinvoicecode}}</div>
						<div class="col col10">{{number_format($rows->amount,2)}}</div>
						<div class="fclear"></div>
					</div>
					@php
						$karea = $rows->areacode;
						$sum[$karea] = (isset($sum[$karea]))?$sum[$karea]+$rows->amount:$rows->amount;
						$totsum+=$rows->amount;
						$ilop++;
					@endphp
					@if($ilop%36==0 && $ilop>0)
						<div class="page-break"></div>
					@endif
				@endif
            @endforeach
            @if($karea!="")
                <div>
                    <div class="col col1"></div>
                    <div class="col col2"></div>
                    <div class="col col3"></div>
                    <div class="col col4"></div>
                    <div class="col col5"></div>
                    <div class="col col6"></div>
					<div class="col col7"></div>
					<div class="col col8"></div>
                    <div class="col col9">Total {{$karea}}:</div>
                    <div class="col col10" style="border-top: solid 1px;">{{number_format($sum[$karea],2)}}</div>
                    <div class="fclear"></div>
                </div>
            @endif

			<div>
				<div class="col col1"></div>
				<div class="col col2"></div>
				<div class="col col3"></div>
				<div class="col col4"></div>
				<div class="col col5"></div>
				<div class="col col6"></div>
				<div class="col col7"></div>
				<div class="col col8"></div>
				<div class="col col9">Total:</div>
				<div class="col col10" style="border-top: solid 1px; border-bottom: double 1px;">{{number_format($totsum,2)}}</div>
				<div class="fclear"></div>
			</div>
        </main>
    </body>
</html>