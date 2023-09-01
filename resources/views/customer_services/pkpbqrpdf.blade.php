<html>
<head>
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 130px 25px 10px 35px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        .center {
            text-align: center;
        }
        .content{
            margin-top: 10px;
            padding:50px;
            font-size:50px;
            text-align: center;
        }
    </style>
</head>
<body>
<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <div class="center">
        <img src="{!! $qrcode !!}">
    </div>
    <div class="content">
        Sila IMBAS kod QR di atas untuk isikan maklumat peribadi anda sebelum masuk ke kedai kami.<br><br>
        Terima kasih.
    </div>
</main>
</body>
</html>
