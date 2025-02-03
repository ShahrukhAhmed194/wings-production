<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" data-arp-injected="true">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width">
      <title>{{$settings_g['title'] ?? env('APP_NAME')}}</title>
      <style>
         html, body,
         a, span, div[style*="margin: 16px 0"] {
         border: 0 !important;
         margin: 0 !important;
         outline: 0 !important;
         padding: 0 !important;
         text-decoration: none !important;
         }
         a, span,
         td, th {
         -webkit-font-smoothing: antialiased !important;
         -moz-osx-font-smoothing: grayscale !important;
         }
         /**
         * # Delink
         * - Classes for overriding clients which creates links out of things like
         *   emails, addresses, phone numbers, etc.
         **/
         span.st-Delink a {
         color: #525f7f !important;
         text-decoration: none !important;
         }
         /** Modifier: preheader */
         span.st-Delink.st-Delink--preheader a {
         color: white !important;
         text-decoration: none !important;
         }
         /** */
         /** Modifier: title */
         span.st-Delink.st-Delink--title a {
         color: #32325d !important;
         text-decoration: none !important;
         }
         /** */
         /** Modifier: footer */
         span.st-Delink.st-Delink--footer a {
         color: #8898aa !important;
         text-decoration: none !important;
         }
         /** */
         /**
         * # Header
         **/
         table.st-Header td.st-Header-background div.st-Header-area {
         height: 76px !important;
         width: 600px !important;
         background-repeat: no-repeat !important;
         background-size: 600px 76px !important;
         }
         table.st-Header td.st-Header-logo div.st-Header-area {
         height: 21px !important;
         width: 49px !important;
         background-repeat: no-repeat !important;
         background-size: 49px 21px !important;
         }
         table.st-Header td.st-Header-logo.st-Header-logo--atlasAzlo div.st-Header-area {
         height: 21px !important;
         width: 216px !important;
         background-repeat: no-repeat !important;
         background-size: 216px 21px !important;
         }
         /**
         * # Retina
         * - Targets high density displays and devices smaller than 768px.
         *
         * ! For mobile specific styling, see `# Mobile`.
         **/
         @media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi), all and (max-width: 768px) {
         /**
         * # Target
         * - Hides images in these devices to display the larger version as a
         *   background image instead.
         **/
         /** Modifier: mobile */
         body[override] div.st-Target.st-Target--mobile img {
         display: none !important;
         margin: 0 !important;
         max-height: 0 !important;
         min-height: 0 !important;
         mso-hide: all !important;
         padding: 0 !important;
         font-size: 0 !important;
         line-height: 0 !important;
         }
         /** */
         /**
         * # Header
         **/
         body[override] table.st-Header td.st-Header-background div.st-Header-area {
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2017-08-21/header/Header-background.png') !important;
         }
         /** Modifier: white */
         body[override] table.st-Header.st-Header--white td.st-Header-background div.st-Header-area {
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2017-08-21/header/Header-background--white.png') !important;
         }
         /** */
         /** Modifier: simplified */
         body[override] table.st-Header.st-Header--simplified td.st-Header-logo div.st-Header-area {
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2017-08-21/header/Header-logo.png') !important;
         }
         /** */
         /** Modifier: simplified + atlasAzlo */
         body[override] table.st-Header.st-Header--simplified td.st-Header-logo.st-Header-logo--atlasAzlo div.st-Header-area {
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2018-05-02/header/Header-logo--atlasAzlo.png') !important;
         }
         /** */
         }
         /**
         * # Mobile
         * - This affects emails views in clients less than 600px wide.
         **/
         @media all and (max-width: 600px) {
         /**
         * # Wrapper
         **/
         body[override] table.st-Wrapper,
         body[override] table.st-Width.st-Width--mobile {
         min-width: 100% !important;
         width: 100% !important;
         }
         /**
         * # Spacer
         **/
         /** Modifier: gutter */
         body[override] td.st-Spacer.st-Spacer--gutter {
         width: 32px !important;
         }
         /** */
         /** Modifier: kill */
         body[override] td.st-Spacer.st-Spacer--kill {
         width: 0 !important;
         }
         /** */
         /** Modifier: emailEnd */
         body[override] td.st-Spacer.st-Spacer--emailEnd {
         height: 32px !important;
         }
         /** */
         /**
         * # Font
         **/
         /** Modifier: title */
         body[override] td.st-Font.st-Font--title,
         body[override] td.st-Font.st-Font--title span,
         body[override] td.st-Font.st-Font--title a {
         font-size: 28px !important;
         line-height: 36px !important;
         }
         /** */
         /** Modifier: header */
         body[override] td.st-Font.st-Font--header,
         body[override] td.st-Font.st-Font--header span,
         body[override] td.st-Font.st-Font--header a {
         font-size: 24px !important;
         line-height: 32px !important;
         }
         /** */
         /** Modifier: body */
         body[override] td.st-Font.st-Font--body,
         body[override] td.st-Font.st-Font--body span,
         body[override] td.st-Font.st-Font--body a {
         font-size: 18px !important;
         line-height: 28px !important;
         }
         /** */
         /** Modifier: caption */
         body[override] td.st-Font.st-Font--caption,
         body[override] td.st-Font.st-Font--caption span,
         body[override] td.st-Font.st-Font--caption a {
         font-size: 14px !important;
         line-height: 20px !important;
         }
         /** */
         /**
         * # Header
         **/
         body[override] table.st-Header td.st-Header-background div.st-Header-area {
         margin: 0 auto !important;
         width: auto !important;
         background-position: 0 0 !important;
         }
         body[override] table.st-Header td.st-Header-background div.st-Header-area {
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2017-08-21/header/Header-background--mobile.png') !important;
         }
         /** Modifier: white */
         body[override] table.st-Header.st-Header--white td.st-Header-background div.st-Header-area {
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2017-08-21/header/Header-background--white--mobile.png') !important;
         }
         /** */
         /** Modifier: simplified */
         body[override] table.st-Header.st-Header--simplified td.st-Header-logo {
         width: auto !important;
         }
         body[override] table.st-Header.st-Header--simplified td.st-Header-spacing {
         width: 0 !important;
         }
         body[override] table.st-Header.st-Header--simplified td.st-Header-logo div.st-Header-area {
         margin: 0 auto !important;
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2017-08-21/header/Header-logo.png') !important;
         }
         body[override] table.st-Header.st-Header--simplified td.st-Header-logo.st-Header-logo--atlasAzlo div.st-Header-area {
         margin: 0 auto !important;
         background-image: url('https://stripe-images.s3.amazonaws.com/html_emails/2018-05-02/header/Header-logo--atlasAzlo.png') !important;
         }
         /** */
         /**
         * # Divider
         **/
         body[override] table.st-Divider td.st-Spacer.st-Spacer--gutter,
         body[override] tr.st-Divider td.st-Spacer.st-Spacer--gutter {
         background-color: #e6ebf1;
         }
         /**
         * # Blocks
         **/
         body[override] table.st-Blocks table.st-Blocks-inner {
         border-radius: 0 !important;
         }
         body[override] table.st-Blocks table.st-Blocks-inner table.st-Blocks-item td.st-Blocks-item-cell {
         display: block !important;
         }
         /**
         * # Hero Units
         **/
         /* Hides dividers in hero units so that vertical spacing remains consistent */
         body[override] table.st-Hero-Container td.st-Spacer--divider {
         display: none !important;
         margin: 0 !important;
         max-height: 0 !important;
         min-height: 0 !important;
         mso-hide: all !important;
         padding: 0 !important;
         font-size: 0 !important;
         line-height: 0 !important;
         }
         body[override] table.st-Hero-Responsive {
         margin: 16px auto !important;
         }
         /**
         * # Button
         **/
         body[override] table.st-Button {
         margin: 0 auto !important;
         width: 100% !important;
         }
         body[override] table.st-Button td.st-Button-area,
         body[override] table.st-Button td.st-Button-area a.st-Button-link,
         body[override] table.st-Button td.st-Button-area span.st-Button-internal {
         height: 44px !important;
         line-height: 44px !important;
         font-size: 18px !important;
         vertical-align: middle !important;
         }
         }
         @media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi), all and (max-width: 768px) {
         /**
         * # mobile image
         **/
         body[override] div.st-Target.st-Target--mobile img {
         display: none !important;
         margin: 0 !important;
         max-height: 0 !important;
         min-height: 0 !important;
         mso-hide: all !important;
         padding: 0 !important;
         font-size: 0 !important;
         line-height: 0 !important;
         }
         /**
         * # document-list-item image
         **/
         body[override] div.st-Icon.st-Icon--document {
         background-image: url('https://stripe-images.s3.amazonaws.com/notifications/icons/document--16--regular.png') !important;
         }
         }
      </style>
   </head>
   <body class="st-Email" bgcolor="f6f9fc" style="border: 0; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; min-width: 100%; width: 100%;" override="fix">
      <!-- Background -->
      <table class="st-Background" bgcolor="f6f9fc" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 0; margin: 0; padding: 0;">
         <tbody>
            <tr>
               <td style="border: 0; margin: 0; padding: 0;">
                  <!-- Wrapper -->
                  <table class="st-Wrapper" align="center" bgcolor="ffffff" border="0" cellpadding="0" cellspacing="0" width="600" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; margin: 0 auto; min-width: 600px;">
                     <tbody>
                        <tr>
                           <td style="border: 0; margin: 0; padding: 0;">
                              <table class="st-Preheader st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                    <tr>
                                        <td align="center" height="0" style="border: 0; margin: 0; padding: 0; color: #ffffff; display: none !important; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all !important; opacity: 0; overflow: hidden; visibility: hidden;">
                                          <span class="st-Delink st-Delink--preheader" style="color: #ffffff; text-decoration: none;">
                                              <img src="{{$settings_g['logo'] ?? ''}}" alt="" height="50"/><br>
                                              <!-- Prevents elements showing up in email client preheader text -->
                                             ‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;
                                              <!-- /Prevents elements showing up in email client preheader text -->
                                          </span>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td align="center" height="0" style="border: 0; margin: 0; padding: 0; color: #ffffff; display: none !important; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all !important; opacity: 0; overflow: hidden; visibility: hidden;">
                                          <span class="st-Delink st-Delink--preheader" style="color: #ffffff; text-decoration: none;">

                                             Receipt from {{ env('APP_NAME') }} Amount Due BDT{{$payment_details['amount']}}
                                             <!-- Prevents elements showing up in email client preheader text -->
                                             ‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;
                                             <!-- /Prevents elements showing up in email client preheader text -->
                                          </span>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Copy st-Copy--caption st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                     <tr>
                                         <td class="Content Title-copy Font Font--title" align="center" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;width: 472px;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #32325d;font-size: 24px;line-height: 32px;">
                                             <img src="{{$settings_g['logo'] ?? ''}}" alt="" height="50"/><br>
                                         </td>
                                     </tr>
                                    <tr>
                                       <td class="Content Title-copy Font Font--title" align="center" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;width: 472px;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #32325d;font-size: 24px;line-height: 32px;">
                                           Receipt from <span dir="ltr">{{$settings_g['title'] ?? env('APP_NAME')}}</span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>

                              @if(isset($payment_details['id']))
                              <table class="st-Copy st-Copy--caption st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                <tbody>
                                  <tr>
                                    <td class="Content Title-copy Font Font--title" align="center" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;width: 472px;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #8898aa;font-size: 15px;line-height: 18px;">
                                      Transaction No #{{$payment_details['id']}}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                      <div class="st-Spacer st-Spacer--filler"> </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              @endif

                              <table class="st-Copy st-Copy--caption st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Spacer st-Spacer--standalone st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td height="20" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Copy st-Copy--standalone st-Copy--caption" border="0" cellpadding="0" cellspacing="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td class="st-Font st-Font--caption" style="border: 0; margin: 0; padding: 0; color: #8898aa; font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif; font-size: 12px; font-weight: bold; line-height: 16px; text-transform: uppercase;">
                                       </td>
                                       <td width="64" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                       <td class="DataBlocks-item" valign="top" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;">
                                          <table style="border: 0;border-collapse: collapse;margin: 0;padding: 0;">
                                             <tbody>
                                                <tr>
                                                   <td class="Font Font--caption Font--uppercase Font--mute Font--noWrap" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #8898aa;font-size: 12px;line-height: 16px;white-space: nowrap;font-weight: bold;text-transform: uppercase;">
                                                      Amount Due
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td class="Font Font--body Font--noWrap" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #525f7f;font-size: 15px;line-height: 24px;white-space: nowrap;">
                                                      BDT{{$payment_details['amount']}}
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td width="20" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                       <td class="DataBlocks-item" valign="top" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;">
                                          <table style="border: 0;border-collapse: collapse;margin: 0;padding: 0;">
                                             <tbody>
                                                <tr>
                                                   <td class="Font Font--caption Font--uppercase Font--mute Font--noWrap" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #8898aa;font-size: 12px;line-height: 16px;white-space: nowrap;font-weight: bold;text-transform: uppercase;">
                                                    DATE PAID
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td class="Font Font--body Font--noWrap" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #525f7f;font-size: 15px;line-height: 24px;white-space: nowrap;">
                                                    {{-- $payment_details['date'] --}}
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td width="20" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Spacer st-Spacer--standalone st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td height="32" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Copy st-Copy--caption st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td class="st-Font st-Font--caption" style="border: 0; margin: 0; padding: 0; color: #8898aa; font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif; font-size: 12px; line-height: 16px; text-transform: uppercase;">
                                          <span class="st-Delink" style="border: 0; margin: 0; padding: 0; font-weight: bold;">
                                          Summary
                                          </span>
                                       </td>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Blocks st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--stacked" colspan="3" height="4" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--kill" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td style="border: 0; margin: 0; padding: 0;">
                                          <table class="st-Blocks-inner" bgcolor="f6f9fc" border="0" cellpadding="0" cellspacing="0" style="border-radius: 5px;" width="100%">
                                             <tbody>
                                                <tr>
                                                   <td style="border: 0; margin: 0; padding: 0;">
                                                      <table class="st-Blocks-item" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                         <tbody>
                                                            <tr>
                                                               <td class="st-Spacer st-Spacer--blocksItemEnds" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                                                  <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="16">
                                                                  <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                                               </td>
                                                               <td class="st-Blocks-item-cell st-Font st-Font--body" style="border: 0; margin: 0; padding: 0; color: #525F7f; font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif; font-size: 16px; line-height: 24px;">
                                                                  <table style="padding-left: 5px; padding-right:5px;" width="100%">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>
                                                                           </td>
                                                                        </tr>

                                                                        @foreach ($payment_details['fees'] as $fee)
                                                                            <tr>
                                                                            <td class="Table-description Font Font--body" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #525f7f;font-size: 15px;line-height: 24px; width: 100%; ">
                                                                                {{$fee['name']}}
                                                                            </td>
                                                                            <td class="Spacer Table-gap" width="8" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                                                            <td class="Table-amount Font Font--body" align="right" valign="top" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #525f7f;font-size: 15px;line-height: 24px;">
                                                                                BDT{{$fee['amount']}}
                                                                            </td>
                                                                            </tr>
                                                                        @endforeach

                                                                        <tr>
                                                                           <td class="Table-divider Spacer" colspan="3" height="6" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td class="Table-divider Spacer" colspan="3" height="6" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td class="Spacer" bgcolor="e6ebf1" colspan="3" height="1" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td class="Table-divider Spacer" colspan="3" height="8" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td class="Table-description Font Font--body" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #525f7f;font-size: 15px;line-height: 24px; width: 100%; ">
                                                                              <strong>Amount Due</strong>
                                                                           </td>
                                                                           <td class="Spacer Table-gap" width="8" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                                                           <td class="Table-amount Font Font--body" align="right" valign="top" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #525f7f;font-size: 15px;line-height: 24px;">
                                                                              <strong>BDT{{$payment_details['amount']}}</strong>
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td class="Table-divider Spacer" colspan="3" height="6" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                               <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="16">
                                                                  <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td class="st-Spacer st-Spacer--blocksItemEnds" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                                                  <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td class="st-Spacer st-Spacer--kill" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--stacked" colspan="3" height="16" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Divider st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--divider" colspan="3" height="20" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td bgcolor="#e6ebf1" height="1" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--divider" colspan="3" height="31" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Copy st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                    @if($payment_details['custom_text'])
                                    <tr>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td style="border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif; font-size: 16px; line-height: 24px;border-bottom: 1px solid #ddd;">
                                        <p>{!! $payment_details['custom_text'] !!}‌</p>
                                       </td>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    @endif

                                    <tr>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td style="border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, &#39;Segoe UI&#39;, Roboto, &#39;Helvetica Neue&#39;, Ubuntu, sans-serif; font-size: 16px; line-height: 24px;padding-top: 18px;">
                                          If you have any questions, contact us at <a style="border: 0; margin: 0; padding: 0; color: #556cd6 !important; text-decoration: none;" href="mailto:{{isset($settings_g['email']) ? $settings_g['email']:''}}">{{ isset($settings_g['email']) ? $settings_g['email']:'' }}</a> or call at <a style="border: 0; margin: 0; padding: 0; color: #556cd6 !important; text-decoration: none;" href="tel:{{isset($settings_g['mobile_number']) ? $settings_g['mobile_number']:''}}">{{isset($settings_g['mobile_number']) ? $settings_g['mobile_number']:''}}</a>.
                                       </td>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="st-Divider st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
                                 <tbody>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--divider" colspan="3" height="20" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td bgcolor="#e6ebf1" height="1" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                       <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="st-Spacer st-Spacer--divider" colspan="3" height="31" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
                                          <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="Section Divider Divider--small" width="100%" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;">
                                 <tbody>
                                    <tr>
                                       <td class="Spacer Spacer--divider" height="20" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="Section Divider Divider--small" width="100%" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;">
                                 <tbody>
                                    <tr>
                                       <td class="Spacer Spacer--divider" height="20" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table class="Section Section--last Divider Divider--large" width="100%" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                                 <tbody>
                                    <tr>
                                       <td class="Spacer Spacer--divider" height="64" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!-- /Wrapper -->
               </td>
            </tr>
            <tr>
               <td class="st-Spacer st-Spacer--emailEnd" height="64" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
                  <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
               </td>
            </tr>
         </tbody>
      </table>
      <!-- /Background -->
   </body>
</html>
