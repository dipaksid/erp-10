<html>
    <head>
        <style type="css/text">
            /** Define the margins of your page **/

            @font-face {
                font-family: 'arialbold';
                font-style: normal;
                font-weight: bold;
                src: url({{ storage_path('fonts/arial-black.ttf') }}) format("truetype");
            }
            @page {
                margin: 110px 25px 10px 35px;
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
				font-size: x-small;
            }
            footer {
                position: fixed; 
                bottom: -10px; 
                left: 0px; 
                right: 0px;
                height: 10px; 
            }
            td.col{
                float:left;
                font-size: 7.5px;
                padding:5px;
            }
            td.colheader{
                font-size: 7.5px;
				font-weight: bold;
				border-top-style: 0.3px;
				border-bottom-style: 0.3px;
            }
            td.col1{
                width:60px;
            }
            td.col2{
                width:60px;
            }
            td.col3{
                width:350px;
            }
            td.col4{
                width:200px;
            }
            td.col5{
                width:80px;
                text-align: right;
            }
            td.col6{
                width:200px;
            }
            td.col7{
                text-align: right;
                width:130px;
            }
            td.col8{
                width:220px;
                text-align: right;
            }
            td.col9{
                width:260px;
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
			table{
				
			}
			.text-danger{
				color:red;
			}
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
			<div class="text-center">
				<b style="font-size:19px;font-weight:bold;">{{$company[$data[0]->companyid]->companyname}}</b>
				<i style="font-size:7px;">{{$company[$data[0]->companyid]->registrationno}} ({{$company[$data[0]->companyid]->registrationno2}})</i><br>
				<span style="font-size:9px;">{{$company[$data[0]->companyid]->address1." ".$company[$data[0]->companyid]->address2." ".$company[$data[0]->companyid]->address3." ".$company[$data[0]->companyid]->address4}}</span><br>
				<span style="font-size:9px;">Tel : 03-92824788, 012-2083761 &nbsp;&nbsp;&nbsp; Support Line : 016-2163761</span> <img style="width:12px; position:fixed; right:160; top:-97;" src="{{storage_path('imgs/whatsapp.png')}}"><br>
				<span style="font-size:9px;">URL : www.brightwin.com  &nbsp;&nbsp;&nbsp; Email : pychan@brightwin.com &nbsp;</span> <br><br>
				<b style="font-size:16px;font-weight:bold;">
					SALES ({{($request->input('det_sum')=="S")?"SUMMARY":"DETAIL"}}) REPORT
				</b>
			</div>
			<div>
				<table>
					<tr>
						<td style="padding:2px;font-size:10px;width:100px;">Sales Date From </td>
						<td style="padding:2px;font-size:10px;width:10px;">:</td>
						<td style="padding:2px;font-size:10px;width:150px;"><b>{{$request->input('datfr')}}&nbsp;</b></td>
						<td style="padding:2px;font-size:10px;width:100px;">Sales Date To</td>
						<td style="padding:2px;font-size:10px;width:10px;">:</td>
						<td style="padding:2px;font-size:10px;width:100px;"><b>{{$request->input("datto")}}&nbsp;</b></td>
						<td style="padding:2px;font-size:10px;width:100px;"><b>Page {{$npage}} of {{$totpage}}&nbsp;</b></td>
					</tr>
					<tr>
						<td style="padding:2px;font-size:10px;width:100px;">Area Code </td>
						<td style="padding:2px;font-size:10px;width:10px;">:</td>
						<td style="padding:2px;font-size:10px;width:150px;"><b>{{($request->input('area')!="")?$request->input('area'):"ALL"}}&nbsp;</b></td>
						<td style="padding:2px;font-size:10px;width:100px;">Options</td>
						<td style="padding:2px;font-size:10px;width:10px;">:</td>
						<td style="padding:2px;font-size:10px;width:170px;"><b>{{($request->input("rptoption")=="1")?"Normal":(($request->input("rptoption")=="2")?"Deduct Credit Note Nett":"Deduct Credit Note Within Year")}}&nbsp;</b></td>
					</tr>
				</table>
			</div>
			<table cellpadding="3">
				<thead>
					<tr>
				@if($request->input('det_sum')=="S")
				<td class="colheader col4">Company</td>
				<td class="colheader col2">PERIOD</td>
				<td class="colheader col7">TOTAL SALES</td>
				<td class="colheader col7">TOTAL SALES AMOUNT (RM)</td>
				@else
				<td class="colheader col1">SALES DATE</td>
				<td class="colheader col2">SALES CODE</td>
				<td class="colheader col3">CUSTOMER NAME</td>
				<td class="colheader col5">SALES AMOUNT</td>
				@endif
					</tr>
				</thead>
			</table>
        </header>

        <footer>
            
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            @php
            $kdate = "";
            $kcomp = "";
            $ilop=0;
			$periodbil=0;
			$periodamt=0;
            @endphp
			<table cellpadding="3">
            @foreach($data as $i => $rows)
				@if($request->input('det_sum')=="S")
					@if($kdate!=$rows->period || $kcomp!=$rows->companyid)
						@if($kdate!="")
							<tr>
								<td class="col col4">{{$company[$kcomp]->companyname}}</td>
								<td class="col col2">{{$kdate}}</td>
								<td class="col col7">{{$periodbil}}</td>
								<td class="col col7">{{number_format($periodamt,2)}}</td>
							</tr>
							@php
								$periodbil=0;
								$periodamt=0;
								$ilop++;
							@endphp
						@endif
					@endif
					@php
						$kdate = $rows->period;
						$kcomp = $rows->companyid;
						if($rows->cancelled_at==""){
							$periodbil++;
							$periodamt+=$rows->sal_amt;
						}
					@endphp
				@else
					@if($kdate=="" || $kdate!=$rows->date)
						@if($kdate!="")
							<tr>
								<td class="col col1"></td>
								<td class="col col2"></td>
								<td class="col col3 text-danger"><b>Sub Total {{$kdate}}:</b></td>
								<td class="col col5 text-danger" style="border-top-style: 0.3px; "><b>{{number_format($sum[$rows->companyid][$kdate]["sal_amt"],2)}}</b></td>
							</tr>
							@php $ilop++; @endphp
						@endif
					@endif
					
					<tr>
						<td class="col col1">{{$rows->date}}</td>
						<td class="col col2">{{$rows->salesinvoicecode}}</td>
						<td class="col col3">{{$rows->name}}</td>
						@if($rows->cancelled_at=="")
						<td class="col col5">{{number_format($rows->sal_amt,2)}}</td>
						@else
						<td class="col col5 text-danger">Cancelled</td>
						@endif
					</tr>
					@php
						$kdate = $rows->date;
						$kcomp = $rows->companyid;
						$ilop++;
					@endphp
				@endif
            @endforeach
			@if($bcompg && $request->input('det_sum')=="D")
				<tr>
					<td class="col col1"></td>
					<td class="col col2"></td>
					<td class="col col3 text-danger"><b>Sub Total {{$rows->date}}:</b></td>
					<td class="col col5 text-danger" style="border-top-style: 0.3px; "><b>{{number_format($sum[$rows->companyid][$rows->date]["sal_amt"],2)}}</b></td>
				</tr>
				<tr>
					<td class="col col1"></td>
					<td class="col col2"></td>
					<td class="col col3 text-danger"><b>{{$company[$rows->companyid]->companyname}} Total :</b></td>
					<td class="col col5 text-danger" style="border-top-style: 0.3px; "><b>{{number_format($sum2[$rows->companyid]["sal_amt"],2)}}</b></td>
				</tr>
				@php $ilop++; @endphp
			@endif
			@if($finalpage)
				@if($request->input('det_sum')=="D")
					@if($kdate!="")
					<tr>
						<td class="col col1"></td>
						<td class="col col2"></td>
						<td class="col col3 text-danger"><b>Sub Total {{$kdate}}:</b></td>
						<td class="col col5 text-danger" style="border-top-style: 0.3px; "><b>{{number_format($sum[$rows->companyid][$kdate]["sal_amt"],2)}}</b></td>
					</tr>
					@endif
					<tr>
						<td class="col col1"></td>
						<td class="col col2"></td>
						<td class="col col3 text-danger"><b>{{$company[$rows->companyid]->companyname}} Total :</b></td>
						<td class="col col5 text-danger" style="border-top-style: 0.3px; "><b>{{number_format($sum2[$rows->companyid]["sal_amt"],2)}}</b></td>
					</tr>
					<tr>
						<td class="col col1"></td>
						<td class="col col2"></td>
						<td class="col col3 text-danger"><b>Grand Total:</b></td>
						<td class="col col5 text-danger" style="border-top-style: 0.3px; border-bottom-style: double 0.3px;"><b>{{number_format($totsum["sal_amt"],2)}}</b></td>
					</tr>
				@else
					@if($kdate!="")
						<tr>
							<td class="col col4">{{$company[$rows->companyid]->companyname}}</td>
							<td class="col col2">{{$kdate}}</td>
							<td class="col col7">{{$periodbil}}</td>
							<td class="col col7">{{number_format($periodamt,2)}}</td>
						</tr>
						@php
						$periodbil=0;
						$periodamt=0;
						$ilop++;
						@endphp
					@endif
					<tr>
						<td class="col col9 text-danger"><b>Grand Total:</b></td>
						<td class="col col7 text-danger" style="border-top-style: 0.3px; border-bottom-style: double 0.3px;"><b>{{number_format($totsum["sal_qty"],0)}}</b></td>
						<td class="col col7 text-danger" style="border-top-style: 0.3px; border-bottom-style: double 0.3px;"><b>{{number_format($totsum["sal_amt"],2)}}</b></td>
					</tr>
				@endif
			@endif
			</table>
        </main>
    </body>
</html>