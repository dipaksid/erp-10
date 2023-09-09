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
                margin: 270px 25px 10px 35px;
            }
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            header {
                position: fixed;
                top: -220px;
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
                width:70px;
            }
            div.col2{
                width:90px;
            }
            div.col3{
                width:300px;
            }
            div.col4{
                width:50px;
            }
            div.col5{
                width:90px;
                text-align: right;
            }
            div.col6{
                width:100px;
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
                $y = 150;
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }
        </script>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img style='width:20px; position:fixed; right:160; top:-135;' src="{{storage_path('imgs/whatsapp.png')}}">
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
                        OUTSTANDING REPORT
                    </h2>
                </div>
                <div>
                    <div style="width:610px;">
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;">Until Date</div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:14px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;"><b>{{$request->input("untildate")}}&nbsp;</b></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="width:610px;">
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;">Customer From </div>
                            <div style="padding:2px;font-size:14px;">Customer To</div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:14px;">:</div>
                            <div style="padding:2px;font-size:14px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;"><b>{{$request->customerfrom_text}}&nbsp;</b></div>
                            <div style="padding:2px;font-size:14px;"><b>{{$request->customerto_text}}&nbsp;</b></div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;">Area From</div>
                            <div style="padding:2px;font-size:14px;">Area To</div>
                        </div>
                        <div style="float:left;width:10px;">
                            <div style="padding:2px;font-size:14px;">:</div>
                            <div style="padding:2px;font-size:14px;">:</div>
                        </div>
                        <div style="float:left;width:150px;">
                            <div style="padding:2px;font-size:14px;"><b>{{$request->input("areafr")}}&nbsp;</b></div>
                            <div style="padding:2px;font-size:14px;">{{$request->input("areato")}}&nbsp;</div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>

            <div class="colheader col1">DATE</div>
            <div class="colheader col2">DOC NO.</div>
            <div class="colheader col3">A/C & NAME</div>
            <div class="colheader col4">TERM</div>
            <div class="colheader col5">AMOUNT</div>
            <div class="colheader col6">OUTSTANDING</div>
            <div class="fclear"></div>
        </header>

        <footer>
            
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            @php
            $kcompid = "";
            $karea = "";
            $sum=array();
            $totsum=0;
            $ilop=0;
			$nppg=27;
            @endphp
			@if($data->count()>0)
            @foreach($data as $i => $rows)
                @if($ilop>=$nppg)
                    <div class="page-break"></div>
					@php $ilop=0; @endphp
                @endif
                @if($karea=="" || $karea!=$rows->areacode)
                    @if($karea!="")
                        <div>
                            <div class="col col1"></div>
                            <div class="col col2"></div>
                            <div class="col col3"></div>
                            <div class="col col4"></div>
                            <div class="col col5"> Total {{$karea}}:</div>
                            <div class="col col6" style="border-top: solid 1px;">{{number_format($sum[$karea][$kcompid],2)}}</div>
                            <div class="fclear"></div>
                        </div>
                        @php $ilop++; @endphp
						@if($ilop>=$nppg)
							<div class="page-break"></div>
							@php $ilop=0; @endphp
						@endif
                    @endif
					@if($kcompid=="" || $kcompid!=$rows->companyid)
						@if($kcompid!="")
                        <div>
                            <div class="col col1"></div>
                            <div class="col col2"></div>
                            <div class="col col3"></div>
                            <div class="col col4"></div>
                            <div class="col col5 text-danger">Total {{$company[$kcompid]["code"]}}:</div>
                            <div class="col col6 text-danger" style="border-top: solid 1px #000;">{{number_format($sum[$kcompid],2)}}</div>
                            <div class="fclear"></div>
                        </div>
						@php $ilop=0; @endphp
						<div class="page-break"></div>
						@endif
					<div>
						<div class="col col1 text-danger">{{$company[$rows->companyid]["code"]}}</div>
						<div class="col col2"></div>
						<div class="col col3 text-danger">{{$company[$rows->companyid]["name"]}}</div>
						<div class="fclear"></div>
					</div>
                    @php $ilop++; @endphp
					@if($ilop>=$nppg)
						<div class="page-break"></div>
						@php $ilop=0; @endphp
					@endif
					@endif
                <div>
                    <div class="col col1">{{$rows->areacode}}</div>
                    <div class="col col2"></div>
                    <div class="col col3">{{$rows->area_desc}}</div>
                    <div class="fclear"></div>
                </div>
                    @php $ilop++; @endphp
                <hr>
                    @php $ilop++; @endphp
					@if($ilop>=$nppg)
						<div class="page-break"></div>
						@php $ilop=0; @endphp
					@endif
				@elseif($kcompid!=$rows->companyid)
					<div>
						<div class="col col1"></div>
						<div class="col col2"></div>
						<div class="col col3"></div>
						<div class="col col4"></div>
						<div class="col col5 text-danger">Total {{$company[$kcompid]["code"]}}:</div>
						<div class="col col6 text-danger" style="border-top: solid 1px #000;">{{number_format($sum[$kcompid],2)}}</div>
						<div class="fclear"></div>
					</div>
					@php $ilop=0; @endphp
					<div class="page-break"></div>
					<div>
						<div class="col col1 text-danger">{{$company[$rows->companyid]["code"]}}</div>
						<div class="col col2"></div>
						<div class="col col3 text-danger">{{$company[$rows->companyid]["name"]}}</div>
						<div class="fclear"></div>
					</div>
                    @php $ilop++; @endphp
					@if($ilop>=$nppg)
						<div class="page-break"></div>
						@php $ilop=0; @endphp
					@endif
                @endif
                <div>
                    <div class="col col1">{{$rows->date}}</div>
                    <div class="col col2">{{$rows->invoiceno}}</div>
                    <div class="col col3">{{$rows->name}}</div>
                    <div class="col col4">{{$rows->term}}</div>
                    <div class="col col5">{{number_format($rows->sal_amt,2)}}</div>
                    <div class="col col6">{{number_format($rows->out_amt,2)}}</div>
                    <div class="fclear"></div>
                </div>
                @php
                    $karea = $rows->areacode;
                    $kcompid = $rows->companyid;
                    $sum[$karea][$kcompid] = (isset($sum[$karea][$kcompid]))?$sum[$karea][$kcompid]+$rows->out_amt:$rows->out_amt;
                    $sum[$kcompid] = (isset($sum[$kcompid]))?$sum[$kcompid]+$rows->out_amt:$rows->out_amt;
                    $totsum+=$rows->out_amt;
                    $ilop++;
                @endphp
            @endforeach
            @if($karea!="")
                <div>
                    <div class="col col1"></div>
                    <div class="col col2"></div>
                    <div class="col col3"></div>
                    <div class="col col4"></div>
                    <div class="col col5">Total {{$karea}}:</div>
                    <div class="col col6" style="border-top: solid 1px;">{{number_format($sum[$karea][$kcompid],2)}}</div>
                    <div class="fclear"></div>
                </div>
            @endif
			@if($kcompid!="")
				<div>
					<div class="col col1"></div>
					<div class="col col2"></div>
					<div class="col col3"></div>
					<div class="col col4"></div>
					<div class="col col5 text-danger">Total {{$company[$kcompid]["code"]}}:</div>
					<div class="col col6 text-danger" style="border-top: solid 1px #000;">{{number_format($sum[$kcompid],2)}}</div>
					<div class="fclear"></div>
				</div>
			@endif
			<div>
				<div class="col col1"></div>
				<div class="col col2"></div>
				<div class="col col3"></div>
				<div class="col col4"></div>
				<div class="col col5">Total:</div>
				<div class="col col6" style="border-top: solid 1px; border-bottom: double 1px;">{{number_format($totsum,2)}}</div>
				<div class="fclear"></div>
			</div>
			@endif
			@if($aucdata->count()>0)	
				@if($data->count()>0)
					<div class="page-break"></div>
				@endif
		  @php
            $kcompid = "";
            $karea = "";
            $sum=array();
            $totsum=0;
            $ilop=0;
			$nppg=18;
            @endphp
			@foreach($aucdata as $i => $rows)
                @if($ilop>=$nppg)
                    <div class="page-break"></div>
					@php $ilop=0; @endphp
                @endif
                @if($karea=="" || $karea!=$rows->areacode)
                    @if($karea!="")
                        <div>
                            <div class="col col1"></div>
                            <div class="col col2"></div>
                            <div class="col col3"></div>
                            <div class="col col4"></div>
                            <div class="col col5"> Total {{$karea}}:</div>
                            <div class="col col6" style="border-top: solid 1px;">{{number_format($sum[$karea][$kcompid],2)}}</div>
                            <div class="fclear"></div>
                        </div>
                        @php $ilop++; @endphp
						@if($ilop>=$nppg)
							<div class="page-break"></div>
							@php $ilop=0; @endphp
						@endif
                    @endif
					@if($kcompid=="" || $kcompid!=$rows->companyid)
						@if($kcompid!="")
                        <div>
                            <div class="col col1"></div>
                            <div class="col col2"></div>
                            <div class="col col3"></div>
                            <div class="col col4"></div>
                            <div class="col col5 text-danger">Total {{$company[$kcompid]["code"]}}:</div>
                            <div class="col col6 text-danger" style="border-top: solid 1px #000;">{{number_format($sum[$kcompid],2)}}</div>
                            <div class="fclear"></div>
                        </div>
						@php $ilop=0; @endphp
						<div class="page-break"></div>
						@endif
					<div>
						<div class="col col1 text-danger">{{$company[$rows->companyid]["code"]}}</div>
						<div class="col col2"></div>
						<div class="col col3 text-danger">{{$company[$rows->companyid]["name"]}}</div>
						<div class="fclear"></div>
					</div>
                    @php $ilop++; @endphp
					@if($ilop>=$nppg)
						<div class="page-break"></div>
						@php $ilop=0; @endphp
					@endif
					@endif
                <div>
                    <div class="col col1">{{$rows->areacode}}</div>
                    <div class="col col2"></div>
                    <div class="col col3">{{$rows->area_desc}}</div>
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
                <div>
                    <div class="col col1">{{$rows->date}}</div>
                    <div class="col col2">{{$rows->invoiceno}}</div>
                    <div class="col col3">{{$rows->name}}</div>
                    <div class="col col4">{{$rows->term}}</div>
                    <div class="col col5">{{number_format($rows->sal_amt,2)}}</div>
                    <div class="col col6">{{number_format($rows->out_amt,2)}}</div>
                    <div class="fclear"></div>
                </div>
                @php
                    $karea = $rows->areacode;
                    $kcompid = $rows->companyid;
                    $sum[$karea][$kcompid] = (isset($sum[$karea][$kcompid]))?$sum[$karea][$kcompid]+$rows->out_amt:$rows->out_amt;
                    $sum[$kcompid] = (isset($sum[$kcompid]))?$sum[$kcompid]+$rows->out_amt:$rows->out_amt;
                    $totsum+=$rows->out_amt;
                    $ilop++;
                @endphp
            @endforeach
			
            @if($karea!="")
                <div>
                    <div class="col col1"></div>
                    <div class="col col2"></div>
                    <div class="col col3"></div>
                    <div class="col col4"></div>
                    <div class="col col5">Total {{$karea}}:</div>
                    <div class="col col6" style="border-top: solid 1px;">{{number_format($sum[$karea][$kcompid],2)}}</div>
                    <div class="fclear"></div>
                </div>
            @endif
			<div>
				<div class="col col1"></div>
				<div class="col col2"></div>
				<div class="col col3"></div>
				<div class="col col4"></div>
				<div class="col col5">Total:</div>
				<div class="col col6" style="border-top: solid 1px; border-bottom: double 1px;">{{number_format($totsum,2)}}</div>
				<div class="fclear"></div>
			</div>

			@endif
        </main>
    </body>
</html>