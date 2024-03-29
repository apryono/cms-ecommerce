<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style type="text/css">
            .container{
                background-color: #f4f4f4;
                font-family: arial;
                max-width: 650px;
                margin: 0 auto;
                width: 100%;
                height: 100%;
                padding: 15px;
            }
            .header{
                position: relative;
                margin-bottom: 15px;
            }
            .header img{
                height: 50px;
                width: auto;
            }
            .header h5{
                display: inline-block;
                margin: 0;
                position: absolute;
                right: 0;
                top: 15px;
                font-weight: normal;
                color: #646464;
            }
            .body{
                background-color: #ffffff;
                padding: 15px;
                border-bottom: 3px solid #0e8ce4;
            }
            .body p{
                font-size: 12px;
            }
            .body a{
                color: #0e8ce4;
            }
            .content{
                background-color: #f4f4f4;
                padding: 15px;
                border-top: 3px solid #0e8ce4;
            }
            .content h5{
                font-size: 14px;
            }
            .content table{
                font-size: 12px;
                width: 100%;
            }
            .content table tr td{
                padding: 3px 0px;
                padding-right: 5px;
            }
            .content .button-red{
                background-color: #0e8ce4;
                color: #ffffff;
                padding: 10px;
                text-decoration: none;
                display: block;
                width: 50%;
                margin: 0 auto;
                margin-top: 20px;
                font-weight: bold;
            }
            .content .button-red:hover{
                background-color: #a90f0f;
            }
            .body h4{
                background-color: #f4f4f4;
                padding: 15px;
                margin-bottom: 5px;
            }
            .body h6 {
                font-size: 9px;
            }
            .text-right{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="{{ AppConfiguration::assetPortalDomain()->value }}/{{ AppConfiguration::logoPath()->value }}/{{ AppConfiguration::headerLogo()->logo }}">
            </div>
            <div class="body">
                @yield('content')
                <p>
                    Connect with us! Follow PortaNusa di Facebook, Instagram atau Twitter sekarang juga.
                </p>
                <p>Butuh bantuan? </p>
                <table>
                    <tr>
                        <td><img src="{{ AppConfiguration::cmsDomain()->value }}/images/mail/phone.png" style="height: 16px;"/></td>
                        <td>+38 068 005 3570</td>
                    </tr>
                    <tr>
                        <td><img src="{{ AppConfiguration::cmsDomain()->value }}/images/mail/mail.png" style="height: 16px;"/></td>
                        <td><a href="mailto:portanusa@gmail.com" style="color: #000;text-decoration: none">portanusa@gmail.com</a></td>
                    </tr>
                </table>
                <p>
                    Kami senantiasa mengutamakan kenyamanan anda menggunakan <a href="https://portanusa.com">portanusa.com</a>. Sampaikan kritik dan saran anda untuk kami, agar kami dapat memberikan pelayanan terbaik bagi Anda semua.
                </p>
                <p>
                    Salam hangat,<br/>
                    <a href="https://portanusa.com" target="_blank">portanusa.com</a>
                </p>
                <h6><i>Mohon untuk tidak membalas karena email ini dikirimkan secara otomatis oleh sistem. Tambahkan portanusa@gmail.com ke daftar kontak Anda agar tidak masuk ke dalam daftar spam!</i></h6>
            </div>
        </div>
    </body>
</html>