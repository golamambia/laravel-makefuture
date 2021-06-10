@php
$order_status_array = unserialize(Order_Status_Array);
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>{{config('site.title')}}</title>

 
  <!-- <link rel="stylesheet" href="{{ asset("/frontend/custom/style.css") }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset("/frontend/custom/mainstyle.css") }}" type="text/css" /> -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css" media="screen">
    @font-face {
      font-family: 'RobotoRegular';
      src: url('{{ asset("/frontend/fonts/Roboto-Regular.ttf") }}')  format('truetype');
    }
    @font-face {
      font-family: 'RobotoBold';
      src: url('{{ asset("/frontend/fonts/Roboto-Bold.ttf") }}')  format('truetype');
    }
    *{padding:0;margin:0;text-decoration:none;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}

    ul{list-style: none !important;}
    :focus{outline:0 none}
    a:focus{outline:0 none}
    a img{border:none}
    a{text-decoration:none}
    a:hover{text-decoration:none!important}

    .btn{white-space:normal;}
    .btn-info.focus, .btn-info:focus{box-shadow: none;}

    img,a,input,textarea,select{-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-tap-highlight-color:transparent}
    input,textarea,select{-webkit-border-radius:0;border-radius:0;-webkit-appearance:none}

    ::-moz-selection{background-color:#000;color:#fff}
    ::selection{background-color:#000;color:#fff}

    body {
      background: #fff; font-family:'RobotoRegular', sans-serif!important; color: #666;padding: 50px 85px;
    }
    table{width: 100%;}
    table th{padding: 10px 0;}
    table th, table td{border: 0!important; padding: 10px 0;}
    footer {
      position: fixed; 
      bottom: 0; 
      left: 0px; 
      right: 0px;
      height: 50px; 
      text-align: center;
    }

    table thead.header tr td{
        text-align: right;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: row-reverse;
    }

    a{transition: all .3s ease-in-out;}
    .footer a:hover{color: #595959!important;}

    a:hover{color: #000!important;text-decoration: underline!important;}

    table { border-collapse: collapse; }


  </style>

</head>
<body>

  <main style="max-width: 650px;margin: 0 auto;width: 100%;">
        <table style="margin-bottom:0px;">
            <thead class="header">
                <tr>
                    <td style="text-align: right;">
                        
                    <div style="float: right;">
                        <a href="{{ url('/') }}">
                            <img src="{!! ( config('site.logo') && File::exists(public_path('uploads/'.config('site.logo'))) ) ? asset('/uploads/'.config('site.logo')) : asset('/frontend/images/logo.png') !!}" alt="Anoview Logo" style="width: 200px;">
                        </a>
                    </div>
                    <div style="text-align: left; font-size: 11px; line-height: 10px;color: #595959; width: 60%;">
                        {!! $proofreader->first_name !!} {!! trim($proofreader->last_name)!=''?substr(trim($proofreader->last_name), 0,1).'.':'' !!}<br>
                        c/o Anoview, Kemp House,<br>
                        152-160 City Road, London, EC1V 2NX<br>
                        <strong>Phone:</strong> 0330 1333 997 <strong>Email:</strong> <a href="mailto:help@anoview.com" style="color: #595959;">help@anoview.com</a>
                    </div>
                        
                    </td>
                </tr>
            </thead>
        </table>


        <table style="margin-bottom: 25px;">
            <thead>
                <tr>
                    <th style="text-align: left;color: #000;font-size: 25px; font-weight: 600;font-family:'RobotoRegular';">INVOICE</th>
                </tr>
            </thead>
        </table>

        <table style="background-color: #577188;  color: #fff;">
            <thead>
                <tr>
                    
                    <th style="text-align: left;font-size: 16px;font-weight: 400;padding-left: 12px;padding-top: 10px;padding-bottom: 10px;">ORDER NO. {!! get_orderID($order->id) !!}</th>
                    
                    
                    <th style="text-align: right; font-size: 16px;font-weight: 400;padding-top: 10px;padding-bottom: 10px;padding-right: 12px;">{!! date_convert($order->created_at,3) !!} </th>
                    
                </tr>
            </thead>
        </table>


        <table style="margin-bottom: 40px;">
            <tbody>
                <tr>
                    <td style="border-bottom: 2px solid #577188!important;width: 20%;text-align: left;color: #577188;font-size: 11px;padding-bottom: 5px; padding-top: 40px;padding-left: 12px;text-transform: uppercase;">To</td>
                    <td style="border-bottom: 2px solid #577188!important;width: 35%;text-align: left; color: #577188;font-size: 11px;padding-bottom: 5px; padding-top: 40px;text-transform: uppercase;">Email</td>
                    <td style="border-bottom: 2px solid #577188!important;width: 45%;text-align: left;color: #577188;font-size: 11px;padding-bottom: 5px; padding-top: 40px;padding-right: 12px;text-transform: uppercase;">Address</td>
                </tr>
               
                <tr>
                    <td style="color: #595959;font-size: 11px;vertical-align: sub;padding-left: 12px;line-height: 15px;font-weight: 400;">{{$order->billing_first_name}} {{$order->billing_last_name}}</td>
                    <td style="color: #595959;font-size: 11px;vertical-align: sub;line-height: 15px;font-weight: 400;">{{$order->billing_email}}</td>
                    <td style="color: #595959;font-size: 11px;vertical-align: sub;padding-right: 12px;line-height: 15px;font-weight: 400;">
                        {!! $user->address_1!=''?''.$user->address_1.'<br>':'' !!}
                        {!! $user->address_2!=''?''.$user->address_2.'<br>':'' !!}
                        {!! $user->city!=''?''.$user->city.'':'' !!}
                        {!! $user->city!='' && $user->province!=''?', ':'' !!}
                        {!! $user->province!=''?''.$user->province:'' !!}
                        {!! $user->city!='' || $user->province!=''?' – ':'' !!}
                        {!! $user->postcode!=''?''.$user->postcode:'' !!}
                    </td>
                </tr>
            </tbody>
        </table>


        <table>
            <thead  style=" padding: 0 25px;background-color: #577188;  color: #fff;border-bottom: 4px solid #F2F2F2;">
                <tr>
                    <th style="width: 50%; text-align: left;color: #fff;font-size: 12px;font-weight: 400;padding-left: 25px;text-transform: uppercase;">DESCRIPTION</th>
                    <th style="width: 25%; text-align: right;color: #fff;font-size: 12px;font-weight: 400;text-transform: uppercase;">WORD COUNT</th>
                    <th style="width: 25%; text-align: right;color: #fff;font-size: 12px;font-weight: 400;padding-right: 25px;text-transform: uppercase;">PRICE</th>
                </tr>
            </thead>
        </table>

        <table style="margin-top: 20px;">    
            <tbody>

                <tr style="">
                    <td style="border-top: 2px solid #d4d2d2;border-bottom: 2px solid #d4d2d2;width:50%;font-size: 10px;padding-left: 10px;vertical-align: sub;font-weight: 400;">Proofreading of document titled “{!! get_file_name($order->upload_file,'F') !!}”</td>
                    <td style="border-top: 2px solid #d4d2d2;border-bottom: 2px solid #d4d2d2;width: 25%;text-align: right;font-size: 10px;vertical-align: sub;font-weight: 400;">{{$order->no_of_word}}</td>
                    <td style="border-top: 2px solid #d4d2d2;border-bottom: 2px solid #d4d2d2;width: 25%;text-align: right;font-size: 10px;padding-right: 10px;vertical-align: sub;font-weight: 400;">{!!$currency_with_icon_array[$order->currency]!!} {!! number_format($order->total_amount,2) !!}</td>
                </tr>
            </tbody>   


            
        </table>

        <table style=" width: 50%; text-align: left; margin-left: auto;">
            <tbody>
                <tr style="">
                    <td style="border-bottom: 3px solid #d4d2d2;text-align: left;padding-left: 10px;color: #577188;font-weight: 600;font-size: 12px;">TOTAL PAID</td>
                    <td style="border-bottom: 3px solid #d4d2d2;text-align: right;padding-right: 10px;color: #577188;font-weight: 600;font-size: 12px;">{!!$currency_with_icon_array[$order->currency]!!} {!! $order->payment_status=='1'?number_format($order->total_amount,2):0 !!}</td>
                </tr>

                <tr style="">
                    <td style="border-bottom: 3px solid #d4d2d2;text-align: left;padding-left: 10px;color: #577188;font-size: 12px;">TOTAL DUE</td>
                    <td style="border-bottom: 3px solid #d4d2d2;text-align: right;padding-right: 10px;color: #577188;font-size: 12px;">{!!$currency_with_icon_array[$order->currency]!!} {!! $order->payment_status=='1'?0: number_format($order->total_amount,2) !!}</td>
                </tr>
            </tbody>
        </table>

        <div class="height" style="width: 100%; height: 100px;"></div>

        <table style="margin-bottom: 70px;">
            <tbody style="">
                <tr>
                    <td style="text-align: center;color: #595959;font-size: 12px;">Thanks for your order!</td>
                </tr>
            </tbody>
        </table>

        <table style="background-color: #f2f2f2;" class="footer">
            <tbody>
                <tr>
                    <th style="text-align: left;color: #002b4c;padding-bottom: 0;padding: 8px 10px;font-size:10px;">Support</th>
                </tr>
                <tr>    
                    <td style="text-align: left;color: #002b4c;font-weight: 400;padding: 1px 10px;padding-bottom: 25px;font-size:10px">Should you require support please visit <a href="{!! url(get_field_value('pages', 'slug', 'id', 3)) !!}" style="text-decoration:underline; color: #002b4c;">anoview.com/help</a> or email <a href="mailto:help@anoview.com" style="text-decoration:underline; color: #002b4c;">help@anoview.com</a>.</td>
                </tr>

                <tr>
                    <th style="text-align: left;color: #002b4c;padding-bottom: 0;padding: 8px 10px;font-size:10px;">Terms and conditions</th>
                </tr>
                <tr>
                    <td style="text-align: left; color: #002b4c;font-weight: 400;padding: 1px 10px;padding-bottom: 25px;font-size:10px!important;">This is an invoice issued by {!! $proofreader->first_name !!} {!! trim($proofreader->last_name)!=''?substr(trim($proofreader->last_name), 0,1).'.':'' !!} for services arranged through Anoview as disclosed agent. For terms and conditions please visit <a href="{!! get_field_value('pages', 'slug', 'id', 7)!=''?url(get_field_value('pages', 'slug', 'id', 7)):url('terms') !!}" style="text-decoration: underline;color: #002b4c;">anoview.com/terms</a> and for Anoview’s data privacy policy please visit <a href="{!! url(get_field_value('pages', 'slug', 'id', 6)) !!}" style="text-decoration:underline; color: #002b4c;">anoview.com/privacy-policy</a>.</td>
                </tr>
            </tbody>
        </table>
    </main>

</body>
</html>