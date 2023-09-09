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
                margin: 210px 25px 30px 35px;
            }
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            header {
                position: fixed;
                top: -180px;
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
                font-size: 10px;
                padding:5px;
            }
            div.colheader{
                float:left;
                font-size: 9px;
                padding:5px;
                border-top: 1px solid; 
                font-weight: bold;
                border-bottom: 1px solid; 
            }
            div.col1{
                width:60px;
            }
            div.col2{
                width:60px;
            }
            div.col3{
                width:200px;
            }
            div.col4{
                width:300px;
            }
            div.col5{
                width:90px;
                text-align: right;
            }
            div.col6{
                width:320px;
            }
            div.col7{
                text-align: right;
                width:100px;
            }
            div.col8{
                width:300px;
                text-align: right;
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
                        SALES ({{($request->input('det_sum')=="S")?"SUMMARY":"DETAIL"}}) REPORT
                    </h2>
                </div>
                <div>
                    <div style="width:610px;">
                        <div style="float:left;width:120px;">
                            <div style="padding:2px;font-size:12px;">Sales Date From </div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:12px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:12px;"><b>{{$request->input('datfr')}}&nbsp;</b></div>
                        </div>
                        <div style="float:left;width:120px;">
                            <div style="padding:2px;font-size:12px;">Sales Date To</div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:12px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:12px;"><b>{{$request->input("datto")}}&nbsp;</b></div>
                        </div>
                        <div class="fclear"></div>
                    </div>
                   
                    <div style="width:610px;">
                        <div style="float:left;width:120px;">
                            <div style="padding:2px;font-size:12px;">Area Code </div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:12px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:12px;"><b>{{($request->input('area')!="")?$request->input('area'):"ALL"}}&nbsp;</b></div>
                        </div>
                        <div style="float:left;width:120px;">
                            <div style="padding:2px;font-size:12px;">Options</div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:12px;">:</div>
                        </div>
                        <div style="float:left;width:200px;">
                            <div style="padding:2px;font-size:12px;"><b>{{($request->input("rptoption")=="1")?"Normal":(($request->input("rptoption")=="2")?"Deduct Credit Note Nett":"Deduct Credit Note Within Year")}}&nbsp;</b></div>
                        </div>
                        <div class="fclear"></div>
                    </div>
                </div>
            </div>
			<div>
				@if($request->input('det_sum')=="S")
				<div class="colheader col6">PERIOD</div>
				<div class="colheader col7">TOTAL SALES</div>
				<div class="colheader col8">TOTAL SALES AMOUNT (RM)</div>
				@else
				<div class="colheader col1">SALES DATE</div>
				<div class="colheader col2">SALES CODE</div>
				<div class="colheader col3">CUSTOMER NAME</div>
				<div class="colheader col4">SALES DESCRIPTION</div>
				<div class="colheader col5">SALES AMOUNT</div>
				@endif
				<div class="fclear"></div>
			</div>
        </header>

        <footer>
            
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            @php
            $kdate = "";
            $sum=array();
            $totsum["sal_amt"]=0;
            $totsum["sal_qty"]=0;
            $ilop=0;
			$periodbil=0;
			$periodamt=0;
            @endphp
            @foreach($data as $i => $rows)
				@if($request->input('det_sum')=="S")
					@if($kdate!=$rows->period)
						@if($kdate!="")
							<div>
								<div class="col col6">{{$kdate}}</div>
								<div class="col col7">{{$periodbil}}</div>
								<div class="col col8">{{number_format($periodamt,2)}}</div>
								<div class="fclear"></div>
							</div>
							@php
								$periodbil=0;
								$periodamt=0;
								$ilop++;
							@endphp
							@if($ilop%27==0 && $ilop>0)
								<div class="page-break"></div>
							@endif
						@endif
					@endif
					@php
						$kdate = $rows->period;
						if($rows->cancelled_at==""){
							$periodbil++;
							$periodamt+=$rows->sal_amt;
							$totsum["sal_amt"]+=$rows->sal_amt;
							$totsum["sal_qty"]++;;
						}
					@endphp
				@else
					@if($kdate=="" || $kdate!=$rows->date)
						@if($kdate!="")
							<div>
								<div class="col col1"></div>
								<div class="col col2"></div>
								<div class="col col3"></div>
								<div class="col col4"><b>Sub Total {{$kdate}}:</b></div>
								<div class="col col5" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["sal_amt"],2)}}</b></div>
								<div class="fclear"></div>
							</div>
							@php $ilop++; @endphp
							@if($ilop%27==0 && $ilop>0)
								<div class="page-break"></div>
							@endif
						@endif
					@endif
					<div>
						<div class="col col1">{{$rows->date}}</div>
						<div class="col col2">{{$rows->salesinvoicecode}}</div>
						<div class="col col3">{{$rows->name}}</div>
						<div class="col col4" style="font-size:9px;">{{substr($rows->description,0,100)}}</div>
						@if($rows->cancelled_at=="")
						<div class="col col5">{{number_format($rows->sal_amt,2)}}</div>
						@else
						<div class="col col5">Cancelled</div>
						@endif
						<div class="fclear"></div>
					</div>
					@php
						$kdate = $rows->date;
						if($rows->cancelled_at==""){
							$sum[$kdate]["sal_amt"] = (isset($sum[$kdate]["sal_amt"]))?$sum[$kdate]["sal_amt"]+$rows->sal_amt:$rows->sal_amt;
							$totsum["sal_amt"]+=$rows->sal_amt;
						}
						$ilop++;
					@endphp
					@if($ilop%27==0 && $ilop>0)
						<div class="page-break"></div>
					@endif
				@endif
            @endforeach
            @if($request->input('det_sum')=="D")
				@if($kdate!="")
                <div>
                    <div class="col col1"></div>
                    <div class="col col2"></div>
                    <div class="col col3"></div>
                    <div class="col col4"><b>Sub Total {{$kdate}}:</b></div>
                    <div class="col col5" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["sal_amt"],2)}}</b></div>
                    <div class="fclear"></div>
                </div>
				@endif
                <div>
                    <div class="col col1"></div>
                    <div class="col col2"></div>
                    <div class="col col3"></div>
                    <div class="col col4"><b>Grand Total:</b></div>
                    <div class="col col5" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["sal_amt"],2)}}</b></div>
                    <div class="fclear"></div>
                </div>
                <div>
                    <div class="col col1"></div>
                    <div class="col col2"></div>
                    <div class="col col3"></div>
                    <div class="col col4"><b>Grand Total Collected:</b></div>
                    <div class="col col5" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["sal_amt"],2)}}</b></div>
                    <div class="fclear"></div>
                </div>
			@else
				@if($kdate!="")
					<div>
						<div class="col col6">{{$kdate}}</div>
						<div class="col col7">{{$periodbil}}</div>
						<div class="col col8">{{number_format($periodamt,2)}}</div>
						<div class="fclear"></div>
					</div>
					@php
					$periodbil=0;
					$periodamt=0;
					$ilop++;
					@endphp
					@if($ilop%27==0 && $ilop>0)
						<div class="page-break"></div>
					@endif
				@endif
				 <div>
                    <div class="col col6"><b>Grand Total:</b></div>
                    <div class="col col7" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["sal_qty"],0)}}</b></div>
                    <div class="col col8" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["sal_amt"],2)}}</b></div>
                    <div class="fclear"></div>
                </div>
            @endif
        </main>
    </body>
</html>