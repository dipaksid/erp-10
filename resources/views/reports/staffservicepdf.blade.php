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
                width:65px;
            }
            td.col2{
                width:55px;
            }
            td.col_percent_head{
                width:45px;
            }
            td.col_percent{
                width:40px;
            }
            td.col_percent2{
                width:45px;
            }
            td.col_percent3{
              width:40px;
            }
            td.col22{
              width:40px;
            }
            td.cols2{
                width:75px;
            }
            td.col3{
                width:150px;
            }
            td.col4{
                width:79px;
            }
            td.col5{
                width:50px;
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
        @php
        $getpg = $npage-1;
        @endphp
				<b style="font-size:19px;font-weight:bold;">BRIGHT-WIN TECHNOLOGY (M) SDN BHD</b>
				<i style="font-size:7px;">(456842-H)</i><br>
				<span style="font-size:9px;">21-1A JALAN PERDANA 4/8 TAMAN PANDAN PERDANA 55300 KUALA LUMPUR </span><br>
				<span style="font-size:9px;">Tel : 03-92824788, 012-2083761 &nbsp;&nbsp;&nbsp; Support Line : 016-2163761</span><img style="width:12px; position:fixed; right:160; top:-97;" src="{{ public_path('img/whatsapp.png') }}" /><br>
				<span style="font-size:9px;">URL : www.brightwin.com  &nbsp;&nbsp;&nbsp; Email : pychan@brightwin.com &nbsp;</span> <br><br>
				<b style="font-size:16px;font-weight:bold;">
					STAFF SERVICE ({{($type==1)?"DETAILS":"SUMMARY"}}) ANALYSIS REPORT <br>{{$request->input("datfr")}} - {{$request->input("datto")}}
				</b>
			</div>
			<div>
        @if($type == 2)
          Staff :
          @php $staff_list = ''; @endphp
          @foreach($gettotal as $skey => $staff_namk)
                @php
                  $staff_list .= ' '.$staff_namk['name'].' ,';
                @endphp
          @endforeach
                {{substr_replace($staff_list ,"", -1)}}
         @endif
			</div>

        @if($type == 2)
			<table cellpadding="3">
				<thead>
					<tr>
            <td class="colheader cols2"></td>
    				<td class="colheader col_percent_head" align ="right">1 - 7</td>
            <td class="colheader col_percent"></td>
            <td class="colheader col_percent_head" align ="right">8 - 15</td>
            <td class="colheader col_percent"></td>
            <td class="colheader col_percent_head" align ="right">16 - 24</td>
            <td class="colheader col_percent"></td>
            <td class="colheader col_percent_head" align ="right">25 - 31</td>
            <td class="colheader col_percent"></td>
            <td class="colheader col_percent_head" align ="right">TOTAL</td>
            <td class="colheader col_percent"></td>

					</tr>
				</thead>
			</table>
      @else
      	<table cellpadding="3">
          <thead>

            <tr>
            <td class="colheader col2" align ="left">JOB DATE</td>
            <td class="colheader col2" align ="left">JOB NO</td>
            <td class="colheader col2" align ="left">SERVICE DATE</td>
            <td class="colheader col2" align ="left">SERVICE TYPE</td>
            <td class="colheader col2" align ="left">DATE SOLVED</td>
            <td class="colheader col3" align ="left">CUSTOMER</td>
            <td class="colheader col5" align="right">NO. OF<br>DAYS</td>
            <td class="colheader col1" align="right">OUTSTANDING</td>
          </tr>
          </thead>
        </table>
            @endif
        </header>

        <footer>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>

          <table cellpadding="3">
            @if($type == 1)
            @php $get_usr = ''; @endphp

            @foreach($request->input('staff') as $skey => $staff_nam)

            @php

                $get_usr = $staff_nam;

                $total = 0;
                $numb=0;
            @endphp


                @foreach($data as $i => $iservice)
                  @php
                  //$assigned = json_decode($iservice->assigned_user,true);

                  @endphp

                  	@if($iservice->closed_by == $staff_nam)

                      @php
                        $numb++;
                        $service_type = '';
                        $close_date = '';
                        if($iservice->servicetype == 1){
                          $service_type = 'Service';
                        }
                        if($iservice->servicetype == 2){
                          $service_type = 'Installation';
                        }
                        if($iservice->servicetype == 3){
                          $service_type = 'Training';
                        }

                        if($iservice->close_date != ""){
                          $close_date = date('d/m/Y',strtotime($iservice->close_date));
                        } else {
                          $close_date = '';
                        }

                        $fdate = $iservice->servicedate;
                        $tdate = date('Y-m-d');
                        $datetime1 = new DateTime($fdate);
                        $datetime2 = new DateTime($tdate);
                        $interval = $datetime1->diff($datetime2);
                        if($iservice->status == 2){
                          $days = $interval->format('%a');
                        } else {
                          $fdate1 = $iservice->servicedate;
                          $tdate2 = $iservice->close_date;
                          $datetimes1 = new DateTime($fdate1);
                          $datetimes2 = new DateTime($tdate2);
                          $interval2 = $datetimes1->diff($datetimes2);
                          $days = $interval2->format('%a');
                        }
                        if($iservice->close_date != ''){
                          $outstanding = '';
                          $style_color = '';
                        } else {
                          $style_color = 'text-danger';
                          $outstanding = '*';
                        }
                        $total++;
                      @endphp
                      @if($numb == 1)
                      <tr>
                        <td class="col col1">
                        <b style="font-size:8px;font-weight:bold;">{{$staff_nam}}</b></td>
                      </tr>
                      @endif
                    <tr class="{{$style_color}}">
						<td class="col col2" align ="left">{{date('d/m/Y',strtotime($iservice->created_at))}}</td>
						<td class="col col2" align ="left">{{$iservice->job_no}}</td>
                        <td class="col col2" align ="left">{{date('d/m/Y',strtotime($iservice->servicedate))}}</td>
                        <td class="col col2" align ="left">{!!(($iservice->servicetype == 2)?$iservice->categorycode."<br>":"")!!}{{$service_type}} {{ (($iservice->servicetype == 2 && $iservice->customerservicerelated()->where('servicetype',2)->whereDate("servicedate","<",date("Y-m-d",strtotime($iservice->servicedate)))->first()==null ) ?"*":"") }}</td>
                        <td class="col col2" align ="left">{{$close_date}}</td>
                        <td class="col col3" align ="left">@if($iservice->customertype=='1')
															{{$iservice->customer()->first()->companyname}}
															@elseif($iservice->customertype=='2')
															{{$iservice->customergroup()->first()->description}}
															@endif
															 </td>
                        <td class="col col5" align="right">{{$days}}</td>
                        <td class="col col1" align="right">{{$outstanding}}</td>
            				</tr>
                    @endif

                @endforeach
                @if($total != 0)




                <tfoot>

                  <tr>
                  <td class="colheader col4">{{$staff_nam}}</td>
                  <td class="colheader col4" align ="center"></td>
                  <td class="colheader col4" align ="center"></td>
                  <td class="colheader col4" align ="center"></td>

                  <td class="colheader col5" align ="center"></td>
                  @php
                  $job = 'Job: ';
                  $tes = 0;

                  foreach($gettotal as $tkey => $totalget){
                    if($totalget['name'] == $staff_nam){
                      $jobtotal = $totalget['total'];
                    }
                  }

                  if(count($last_usr) > 0){
                    foreach($last_usr as $lkey => $lst){

                        if($lst['name'] == $staff_nam && $lst['num'] == $total && $getpg == $lkey){
                          $tes++;

                          $job = '';
                          $jobtotal = '';

                          array_shift($last_usr);
                        }
                    }

                  }
                  @endphp
                  <td class="colheader col2" align ="right">{{$job}}</td>
                  <td class="colheader col2" align ="right">{{$jobtotal}}</td>

                  <td class="colheader col2"></td>
                </tr>
              </tfoot>
                @endif
              @endforeach
            </table>
            @else
            <table cellpadding="3">
              @php
                $no_calls1 = 0;
                $no_calls2 = 0;
                $no_calls3 = 0;
                $no_calls4 = 0;
                $no_calls_total = 0;

                $solved1 = 0;
                $solved2 = 0;
                $solved3 = 0;
                $solved4 = 0;
                $solved_total = 0;

                $outstanding1 = 0;
                $outstanding2 = 0;
                $outstanding3 = 0;
                $outstanding4 = 0;
                $outstanding_total = 0;

                foreach($data as $i => $iservice){
                  if(date('d',strtotime($iservice->servicedate)) >= 1 && date('d',strtotime($iservice->servicedate)) <= 7){
                    $no_calls1= $no_calls1+1;
                  }
                  if(date('d',strtotime($iservice->servicedate)) >= 8 && date('d',strtotime($iservice->servicedate)) <= 15){

                    $no_calls2++;
                  }
                  if(date('d',strtotime($iservice->servicedate)) >= 16 && date('d',strtotime($iservice->servicedate)) <= 24){
                    $no_calls3++;
                  }
                  if(date('d',strtotime($iservice->servicedate)) >= 25 && date('d',strtotime($iservice->servicedate)) <= 31){
                    $no_calls4++;
                  }

                  if($iservice->status == 1){
                    if(date('d',strtotime($iservice->servicedate)) >= 1 && date('d',strtotime($iservice->servicedate)) <= 7){
                      $solved1++;
                    }
                    if(date('d',strtotime($iservice->servicedate)) >= 8 && date('d',strtotime($iservice->servicedate)) <= 15){
                      $solved2++;
                    }
                    if(date('d',strtotime($iservice->servicedate)) >= 16 && date('d',strtotime($iservice->servicedate)) <= 24){
                      $solved3++;
                    }
                    if(date('d',strtotime($iservice->servicedate)) >= 25 && date('d',strtotime($iservice->servicedate)) <= 31){
                      $solved4++;
                    }
                  }


                }
                $outstanding1 = $no_calls1 - $solved1;
                $outstanding2 = $no_calls2 - $solved2;
                $outstanding3 = $no_calls3 - $solved3;
                $outstanding4 = $no_calls4 - $solved4;
                $no_calls_total = $no_calls1 + $no_calls2 + $no_calls3 + $no_calls4;
                if($no_calls_total != 0){
                  $no_calls_percentage1 = ($no_calls1/$no_calls_total)*100;
                  $no_calls_percentage2 = ($no_calls2/$no_calls_total)*100;
                  $no_calls_percentage3 = ($no_calls3/$no_calls_total)*100;
                  $no_calls_percentage4 = ($no_calls4/$no_calls_total)*100;
                } else {
                  $no_calls_percentage1 = 0;
                  $no_calls_percentage2 = 0;
                  $no_calls_percentage3 = 0;
                  $no_calls_percentage4 = 0;
                }

                $solved_total = $solved1 + $solved2 + $solved3 + $solved4;
                if($solved_total == 0){
                  $solved_percentage1 = 0;
                } else {
                    $solved_percentage1 = ($solved1/$solved_total)*100;
                }
                if($solved_total == 0){
                  $solved_percentage2 = 0;
                } else {
                  $solved_percentage2 = ($solved2/$solved_total)*100;
                }

                if($solved_total == 0){
                  $solved_percentage3 = 0;
                } else {
                    $solved_percentage3 = ($solved3/$solved_total)*100;
                }

                if($solved_total == 0){
                  $solved_percentage4 = 0;
                } else {
                  $solved_percentage4 = ($solved4/$solved_total)*100;
                }

                $outstanding_total = $outstanding1 + $outstanding2 + $outstanding3 + $outstanding4;
                if($no_calls1 == 0){
                  $outstanding_percentage1 = 0;
                } else {
                  $outstanding_percentage1 = ( ($no_calls1 - $solved1) / $no_calls1 )*100;
                }
                if($no_calls2 == 0){
                  $outstanding_percentage2 = 0;
                } else {
                  $outstanding_percentage2 = ( ($no_calls2 - $solved2) / $no_calls2 )*100;
                }
                if($no_calls3 == 0){
                  $outstanding_percentage3 = 0;
                } else {
                  $outstanding_percentage3 = ( ($no_calls3 - $solved3) / $no_calls3 )*100;
                }
                if($no_calls4 == 0){
                  $outstanding_percentage4 = 0;
                } else {
                  $outstanding_percentage4 = ( ($no_calls4 - $solved4) / $no_calls4 )*100;
                }

              @endphp
            <tr>
                <td class="col cols2"><b>NO. OF CALLS</b></td>
                <td class="col col_percent" align ="right">{{$no_calls1}}</td>
                <td class="col col_percent3" align ="left">({{round($no_calls_percentage2)}}%)</td>
                <td class="col col_percent2" align ="right">{{$no_calls2}}</td>
                <td class="col col_percent3" align ="left">({{round($no_calls_percentage2)}}%)</td>
                <td class="col col_percent2" align ="right">{{$no_calls3}}</td>
                <td class="col col_percent3" align ="left">({{round($no_calls_percentage3)}}%)</td>
                <td class="col col_percent2" align ="right">{{$no_calls4}}</td>
                <td class="col col_percent3" align ="left">({{round($no_calls_percentage4)}}%)</td>
                <td class="col col_percent2" align ="right">{{$no_calls_total}}</td>
                <td class="col col_percent3" align ="left">(100%)</td>
            </tr>
            <tr>
                <td class="col cols2"><b>SOLVED CALLS</b></td>
                <td class="col col_percent" align ="right">{{$solved1}}</td>
                <td class="col col_percent3" align ="left">({{round($solved_percentage1)}}%)</td>
                <td class="col col_percent2" align ="right">{{$solved2}}</td>
                <td class="col col_percent3" align ="left">({{round($solved_percentage2)}}%)</td>
                <td class="col col_percent2" align ="right">{{$solved3}}</td>
                <td class="col col_percent3" align ="left">({{round($solved_percentage3)}}%)</td>
                <td class="col col_percent2" align ="right">{{$solved4}}</td>
                <td class="col col_percent3" align ="left">({{round($solved_percentage4)}}%)</td>
                <td class="col col_percent2" align ="right">{{$solved_total}}</td>
                <td class="col col_percent3" align ="left">(100%)</td>
            </tr>
            <tr>
                <td class="col cols2"><b>OUTSTANDING</b></td>
                <td class="col col_percent" align ="right">{{$outstanding1}}</td>
                <td class="col col_percent3" align ="left">({{round($outstanding_percentage1)}}%)</td>
                <td class="col col_percent2" align ="right">{{$outstanding2}}</td>
                <td class="col col_percent3" align ="left">({{round($outstanding_percentage2)}}%)</td>
                <td class="col col_percent2" align ="right">{{$outstanding3}}</td>
                <td class="col col_percent3" align ="left">({{round($outstanding_percentage3)}}%)</td>
                <td class="col col_percent2" align ="right">{{$outstanding4}}</td>
                <td class="col col_percent3" align ="left">({{round($outstanding_percentage4)}}%)</td>
                <td class="col col_percent2" align ="right">{{$outstanding_total}}</td>
                <td class="col col_percent3" align ="left">(100%)</td>
            </tr>
          </table>
            @endif
        </main>
    </body>
</html>
