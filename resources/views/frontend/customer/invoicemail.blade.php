

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Order confirmation </title>
    <meta name="robots" content="noindex,nofollow" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0;" />
    <style type="text/css">
      @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);
      body { margin: 0; padding: 0; background: #e1e1e1; }
      div, p, a, li, td { -webkit-text-size-adjust: none; }
      .ReadMsgBody { width: 100%; background-color: #ffffff; }
      .ExternalClass { width: 100%; background-color: #ffffff; }
      body { width: 100%; height: 100%; background-color: #e1e1e1; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
      html { width: 100%; }
      p { padding: 0 !important; margin-top: 0 !important; margin-right: 0 !important; margin-bottom: 0 !important; margin-left: 0 !important; }
      .visibleMobile { display: none; }
      .hiddenMobile { display: block; }

      @media only screen and (max-width: 600px) {
      body { width: auto !important; }
      table[class=fullTable] { width: 96% !important; clear: both; }
      table[class=fullPadding] { width: 85% !important; clear: both; }
      table[class=col] { width: 45% !important; }
      .erase { display: none; }
      }

      @media only screen and (max-width: 420px) {
      table[class=fullTable] { width: 100% !important; clear: both; }
      table[class=fullPadding] { width: 85% !important; clear: both; }
      table[class=col] { width: 100% !important; clear: both; }
      table[class=col] td { text-align: left !important; }
      .erase { display: none; font-size: 0; max-height: 0; line-height: 0; padding: 0; }
      .visibleMobile { display: block !important; }
      .hiddenMobile { display: none !important; }
      }
    </style>
</head>
<body>
<!-- Header -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      <td>
        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
          <tr class="hiddenMobile">
            <td height="40"></td>
          </tr>
          <tr class="visibleMobile">
            <td height="30"></td>
          </tr>

          <tr>
            <td>
              <table width="480" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                <tbody>
                  <tr>
                    <td>
                      <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                        <tbody>
                          <tr>
                            <td align="left"> <img src="https://i.postimg.cc/g2MRQjLG/hunt-showdown6756-logowik-com.webp" width="32" height="32" alt="logo" border="0" /></td>
                          </tr>
                          <tr class="hiddenMobile">
                            <td height="40"></td>
                          </tr>
                          <tr class="visibleMobile">
                            <td height="20"></td>
                          </tr>
                          <tr>
                            <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                              Hello, {{ App\Models\Billing::where('order_id', $order_id)->first()->fname }} {{ App\Models\Billing::where('order_id', $order_id)->first()->lname }}
                              <br> Thank you for shopping from our store and for your order.
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table width="220" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                        <tbody>
                          <tr class="visibleMobile">
                            <td height="20"></td>
                          </tr>
                          <tr>
                            <td height="5"></td>
                          </tr>
                          <tr>
                            <td style="font-size: 21px; color: #ff0000; letter-spacing: -1px; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;">
                              Invoice
                            </td>
                          </tr>
                          <tr>
                          <tr class="hiddenMobile">
                            <td height="50"></td>
                          </tr>
                          <tr class="visibleMobile">
                            <td height="20"></td>
                          </tr>
                          <tr>
                            <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: right;">
                              <small>ORDER</small> {{ $order_id}}<br />
                              <small>{{ App\Models\Billing::where('order_id', $order_id)->first()->created_at->format('d-M-Y') }}</small>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!-- /Header -->
  <!-- Order Details -->
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
      <tr>
        <td>
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
            <tbody>
              <tr>
              <tr class="hiddenMobile">
                <td height="60"></td>
              </tr>
              <tr class="visibleMobile">
                <td height="40"></td>
              </tr>
              <tr>
                <td>
                  <table width="480" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                    <tbody>
                      <tr>
                        <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;" width="52%" align="left">
                          Item
                        </th>
                        <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;" align="left">
                          <small>Price</small>
                        </th>
                        <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;" align="center">
                          Quantity
                        </th>
                        <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;" align="right">
                          Subtotal
                        </th>
                      </tr>
                      <tr>
                        <td height="1" style="background: #bebebe;" colspan="4"></td>
                      </tr>
                      <tr>
                        <td height="10" colspan="4"></td>
                      </tr>
                      @foreach (App\Models\OrderProduct::where('order_id', $order_id)->get() as $product)
                      <tr>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 18px;  vertical-align: top; padding:10px 0;" class="article">
                          {{ $product->rel_to_product->product_name }}
                        </td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;"><small>&#2547; {{ $product->rel_to_product->after_discount }}</small></td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="center">{{ $product->quantity }}</td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="right">&#2547; {{ $product->rel_to_product->after_discount*$product->quantity }}</td>
                      </tr>
                      <tr>
                        <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="20"></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- /Order Details -->
  <!-- Total -->
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
      <tr>
        <td>
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
            <tbody>
              <tr>
                <td>

                  <!-- Table Total -->
                  <table width="480" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                    <tbody>
                      <tr>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                          Subtotal
                        </td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;" width="80">
                          {{ App\Models\Order::where('order_id', $order_id)->first()->sub_total }}
                        </td>
                      </tr>
                      <tr>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                          Charge
                        </td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                          {{ App\Models\Order::where('order_id', $order_id)->first()->charge }}
                        </td>
                      </tr>
                      <tr>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                          Discount
                        </td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                          {{ App\Models\Order::where('order_id', $order_id)->first()->discount }}
                        </td>
                      </tr>
                      <tr>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                          <strong>Grand Total (Incl.Tax)</strong>
                        </td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                          <strong>{{ App\Models\Order::where('order_id', $order_id)->first()->total }}</strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- /Table Total -->

                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- /Total -->
  <!-- Information -->
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
      <tr>
        <td>
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
            <tbody>
              <tr>
              <tr class="hiddenMobile">
                <td height="60"></td>
              </tr>
              <tr class="visibleMobile">
                <td height="40"></td>
              </tr>
              <tr>
                <td>
                  <table width="480" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                    <tbody>
                      <tr>
                        <td>
                          <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                            <tbody>
                              <tr>
                                <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                  <strong>BILLING INFORMATION</strong>
                                </td>
                              </tr>
                              <tr>
                                <td width="100%" height="10"></td>
                              </tr>
                              <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                  {{ App\Models\Billing::where('order_id', $order_id)->first()->fname }} {{ App\Models\Billing::where('order_id', $order_id)->first()->lname }}<br> {{ App\Models\Billing::where('order_id', $order_id)->first()->address }}<br> {{ App\Models\City::where('id', App\Models\Billing::where('order_id', $order_id)->first()->city_id)->first()->name }}<br> {{ App\Models\Billing::where('order_id', $order_id)->first()->zip }}, {{ App\Models\Country::where('id', App\Models\Billing::where('order_id', $order_id)->first()->country_id)->first()->name }}<br> T: {{ App\Models\Billing::where('order_id', $order_id)->first()->phone }}
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          @if (App\Models\Shipping::where('order_id', $order_id)->count() == 0)
                          @else
                          <table width="220" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                            <tbody>
                              <tr class="visibleMobile">
                                <td height="20"></td>
                              </tr>
                              <tr>
                                <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                  <strong>SHIPPING INFORMATION</strong>
                                </td>
                              </tr>
                              <tr>
                                <td width="100%" height="10"></td>
                              </tr>
                              <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                  {{ App\Models\Shipping::where('order_id', $order_id)->first()->fname }} {{ App\Models\Shipping::where('order_id', $order_id)->first()->lname }}<br>
                                  {{ App\Models\Shipping::where('order_id', $order_id)->first()->address }}<br> {{ App\Models\City::where('id', App\Models\Shipping::where('order_id', $order_id)->first()->city_id)->first()->name }}<br> {{ App\Models\Shipping::where('order_id', $order_id)->first()->zip }}, {{ App\Models\Country::where('id', App\Models\Shipping::where('order_id', $order_id)->first()->country_id)->first()->name }}<br> T: {{ App\Models\Shipping::where('order_id', $order_id)->first()->phone }}
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- /Information -->
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">

    <tr>
      <td>
        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
          <tr>
            <td>
              <table width="480" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                <tbody>
                  <tr>
                    <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                      Have a nice day.
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr class="spacer">
            <td height="50"></td>
          </tr>

        </table>
      </td>
    </tr>
    <tr>
      <td height="20"></td>
    </tr>
  </table>
</body>
</html>

