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
                width:70px;
            }
            div.col2{
                width:60px;
            }
            div.col3{
                width:60px;
            }
            div.col4{
                width:420px;
            }
            div.col5{
                width:230px;
            }
            div.col6{
                width:90px;
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
            <img style='width:20px; position:fixed; right:160; top:-97;' src="{{public_path('img/whatsapp.png')}}">
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
                        CANCEL SALES REPORT
                    </h2>
                </div>
                <div>
                    <div style="width:610px;">
                        <div style="float:left;width:120px;">
                            <div style="padding:2px;font-size:12px;">Cancel Date From </div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:12px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:12px;"><b>{{$request->input('datfr')}}&nbsp;</b></div>
                        </div>
                        <div style="float:left;width:120px;">
                            <div style="padding:2px;font-size:12px;">Cancel Date To</div>
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
                        <div class="fclear"></div>
                    </div>
                </div>
            </div>
			<div>
				<div class="colheader col1">CANCEL DATE</div>
				<div class="colheader col2">SALES DATE</div>
				<div class="colheader col3">SALES CODE</div>
				<div class="colheader col4">CUSTOMER NAME</div>
				<!--<div class="colheader col5">SALES DESCRIPTION</div>-->
				<div class="colheader col6">SALES AMOUNT</div>
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
				@if($kdate=="" || $kdate!=substr($rows->canceldate,3))
					@if($kdate!="")
						<div>
							<div class="col col1"></div>
							<div class="col col2"></div>
							<div class="col col3"></div>
							<div class="col col4" style="text-align:right;"><b>Sub Total {{$kdate}}:</b></div>
							<!--<div class="col col5"><b>Sub Total {{$kdate}}:</b></div>-->
							<div class="col col6" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["sal_amt"],2)}}</b></div>
							<div class="fclear"></div>
						</div>
						@php $ilop++; @endphp
						@if($ilop%27==0 && $ilop>0)
							<div class="page-break"></div>
						@endif
					@endif
					<div>
						<div class="col col1" style="border-bottom: solid 1px;"><b>{{substr($rows->canceldate,3)}}</b></div>
						<div class="col col2" style="border-bottom: solid 1px;"> &nbsp;</div>
						<div class="col col3" style="border-bottom: solid 1px;"> &nbsp;</div>
						<div class="col col4" style="border-bottom: solid 1px;"> &nbsp;</div>
						<!--<div class="col col5"><b>Sub Total {{$kdate}}:</b></div>-->
						<div class="col col6" style="border-bottom: solid 1px;"> &nbsp;</div>
						<div class="fclear"></div>
					</div>
				@endif
				<div>
					<div class="col col1">{{$rows->canceldate}}</div>
					<div class="col col2">{{$rows->date}}</div>
					<div class="col col3">{{$rows->salesinvoicecode}}</div>
					<div class="col col4">{{$rows->name}}</div>
					<!--<div class="col col5" style="font-size:9px;">{{substr($rows->description,0,100)}}</div>-->
					<div class="col col6">{{number_format($rows->sal_amt,2)}}</div>
					<div class="fclear"></div>
				</div>
				@php
					$kdate = substr($rows->canceldate,3);
					$sum[$kdate]["sal_amt"] = (isset($sum[$kdate]["sal_amt"]))?$sum[$kdate]["sal_amt"]+$rows->sal_amt:$rows->sal_amt;
					$totsum["sal_amt"]+=$rows->sal_amt;
					$ilop++;
				@endphp
				@if($ilop%27==0 && $ilop>0)
					<div class="page-break"></div>
				@endif
            @endforeach
			@if($kdate!="")
			<div>
				<div class="col col1"></div>
				<div class="col col2"></div>
				<div class="col col3"></div>
				<div class="col col4" style="text-align:right;"><b>Sub Total {{$kdate}}:</b></div>
				<!--<div class="col col5"><b>Sub Total {{$kdate}}:</b></div>-->
				<div class="col col6" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["sal_amt"],2)}}</b></div>
				<div class="fclear"></div>
			</div>
			@endif
			<div>
				<div class="col col1"></div>
				<div class="col col2"></div>
				<div class="col col3"></div>
				<div class="col col4" style="text-align:right;"><b>Grand Total:</b></div>
				<!--<div class="col col5"><b>Grand Total:</b></div>-->
				<div class="col col6" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["sal_amt"],2)}}</b></div>
				<div class="fclear"></div>
			</div>
        </main>
    </body>
</html>
