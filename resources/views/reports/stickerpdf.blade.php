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
                margin: 15px 10px 5px 20px;
            }
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            div{
                font-size: 15px;
                font-weight: 500;
            }
            div.ltrhead{
                height: 145px;
            }
            div.pagebreak{
                page-break-after: always;
            }
            div.smallfont{
				font-size: 12px;
			}
        </style>
    </head>
    <body>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            @for($pc=0;$pc<$copies;$pc++)
            @foreach($data as $il => $rowdata)
            <!--<div class="ltrhead {{(( (count($data)-1)>$il)?'pagebreak':'') }}">-->
            <div class="ltrhead">
                <div>{{$rowdata->code}}</div>
                <div class="{{ ((strlen($rowdata->name)>38)?'smallfont':'') }}">{{$rowdata->name}}</div>
                <div>{{$rowdata->addr1}}</div>
                <div>{{$rowdata->addr2}}</div>
                <div>{{$rowdata->addr3}}</div>
                <div>{{$rowdata->addr4}}</div>                
            </div>
            @endforeach
            @endfor
        </main>
    </body>
</html>