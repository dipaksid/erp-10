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
                font-size: 10px;
                padding:5px;
                position: relative;
            }
            div.colheader{
                float:left;
                font-size: 9px;
                padding:5px;
                border-top: 1px solid;
                font-weight: bold;
                border-bottom: 1px solid;
                position: -ms-device-fixed;
            }
            div.col1{
                width:70px;
            }
            div.col2{
                width:70px;
            }
            div.col3{
                width:190px;
            }
            div.col4{
                width:105px;
            }
            div.col5{
                width:70px;
                text-align: right;
            }
            div.col6{
                width:90px;
                text-align: right;
            }
            div.col7{
                width:80px;
                text-align: center;
                margin-right: 10px;
                padding-right: 10px;
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
    <div class="container-fluid">
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
                <img style='width:20px; position:fixed; right:152; top:-97;' src="{{ public_path('img/whatsapp.png') }}">
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
                            RECEIPT REPORT
                        </h2>
                    </div>
                    <div>
                        <div style="width:610px;">
                            <div style="float:left;width:150px;">
                                <div style="padding:2px;font-size:14px;">Receive Date From </div>
                            </div>
                            <div style="float:left;width:10px;">
                                <div style="padding:2px;font-size:14px;">:</div>
                            </div>
                            <div style="float:left;width:150px;">
                                <div style="padding:2px;font-size:14px;"><b>{{$request->input('datfr')}}&nbsp;</b></div>
                            </div>
                            <div style="float:left;width:150px;">
                                <div style="padding:2px;font-size:14px;">Receive Date To</div>
                            </div>
                            <div style="float:left;width:10px;">
                                <div style="padding:2px;font-size:14px;">:</div>
                            </div>
                            <div style="float:left;width:150px;">
                                <div style="padding:2px;font-size:14px;"><b>{{$request->input("datto")}}&nbsp;</b></div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </div>

                <div class="colheader col1">RECEIPT DATE</div>
                <div class="colheader col2">RECEIPT CODE</div>
                <div class="colheader col3">CUSTOMER NAME</div>
                <div class="colheader col4">SALES INVOICE</div>
                <div class="colheader col5">CASH AMOUNT</div>
                <div class="colheader col6">CHEQUE AMOUNT</div>
                <div class="colheader col7">TB AMOUNT</div>
                <div class="fclear"></div>
            </header>

            <footer>

            </footer>

            <!-- Wrap the content of your PDF inside a main tag -->
            <main>
                @php
                $kdate = "";
                $sum=array();
                $totsum["cash"]=0;
                $totsum["cheque"]=0;
                $totsum["tb"]=0;
                $ilop=0;
                @endphp
                @foreach($data as $i => $rows)
                    @if($ilop%24==0 && $ilop>0)
                        <div class="page-break"></div>
                    @endif
                    @if($kdate=="" || $kdate!=$rows->date)
                        @if($kdate!="")
                            <div>
                                <div class="col col1"></div>
                                <div class="col col2"></div>
                                <div class="col col4"></div>
                                <div class="col col3"><b>Sub Total {{$kdate}}:</b></div>
                                <div class="col col5" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["cash"],2)}}</b></div>
                                <div class="col col6" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["cheque"],2)}}</b></div>
                                <div class="col col7" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["tb"],2)}}</b></div>
                                <div class="fclear"></div>
                            </div>
                            @php $ilop++; @endphp
                        @endif
                    @endif
                    <div>
                        <div class="col col1">{{$rows->date}}</div>
                        <div class="col col2">{{$rows->receiptcode}}</div>
                        <div class="col col3">{{$rows->name}}</div>
                        <div class="col col4">{{$rows->inv}}</div>
                        <div class="col col5">{{number_format($rows->CASH,2)}}</div>
                        <div class="col col6">{{number_format($rows->CHEQUE,2)}}</div>
                        <div class="col col7">{{number_format($rows->TB,2)}}</div>
                        <div class="fclear"></div>
                    </div>
                    @php
                        $kdate = $rows->date;
                        $sum[$kdate]["cash"] = (isset($sum[$kdate]["cash"]))?$sum[$kdate]["cash"]+$rows->CASH:$rows->CASH;
                        $sum[$kdate]["cheque"] = (isset($sum[$kdate]["cheque"]))?$sum[$kdate]["cheque"]+$rows->CHEQUE:$rows->CHEQUE;
                        $sum[$kdate]["tb"] = (isset($sum[$kdate]["tb"]))?$sum[$kdate]["tb"]+$rows->TB:$rows->TB;
                        $totsum["cash"]+=$rows->CASH;
                        $totsum["cheque"]+=$rows->CHEQUE;
                        $totsum["tb"]+=$rows->TB;
                        $ilop++;
                    @endphp
                @endforeach
                    @if($kdate!="")
                        <div>
                            <div class="col col1"></div>
                            <div class="col col2"></div>
                            <div class="col col4"></div>
                            <div class="col col3"><b>Sub Total {{$kdate}}:</b></div>
                            <div class="col col5" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["cash"],2)}}</b></div>
                            <div class="col col6" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["cheque"],2)}}</b></div>
                            <div class="col col7" style="border-top: solid 1px;"><b>{{number_format($sum[$kdate]["tb"],2)}}</b></div>
                            <div class="fclear"></div>
                        </div>
                    @endif
                    <div>
                        <div class="col col1"></div>
                        <div class="col col2"></div>
                        <div class="col col4"></div>
                        <div class="col col3"><b>Grand Total:</b></div>
                        <div class="col col5" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["cash"],2)}}</b></div>
                        <div class="col col6" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["cheque"],2)}}</b></div>
                        <div class="col col7" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["tb"],2)}}</b></div>
                        <div class="fclear"></div>
                    </div>
                    <div>
                        <div class="col col1"></div>
                        <div class="col col2"></div>
                        <div class="col col4"></div>
                        <div class="col col3"><b>Grand Total Collected:</b></div>
                        <div class="col col5" style="border-top: solid 1px; border-bottom: double 1px;">&nbsp; </div>
                        <div class="col col6" style="border-top: solid 1px; border-bottom: double 1px;">&nbsp; </div>
                        <div class="col col7" style="border-top: solid 1px; border-bottom: double 1px;"><b>{{number_format($totsum["cash"]+$totsum["cheque"]+$totsum["tb"],2)}}</b></div>
                        <div class="fclear"></div>
                    </div>
            </main>
        </div>
    </body>
</html>
