<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>{!!$title!!}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td>
     <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
       <tr>
         <td align="center" bgcolor="#70bbd9" >
          <img src="{!!$topimage!!}" alt="" width="600" height="180" style="display: block;" >
         </td>
       </tr>
       <tr>
         <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;font-size: 16px; font-family: Arial">

            {!!$content!!}

            <a href="{{$url}}" target="_blank">Formulario</a>

            <img src="%recipient.pixel%" alt="" >


            <a href="%recipient.cta%" target="_blank">Ir al Formulario</a>

         </td>
       </tr>
       <tr>
         <td align="center" bgcolor="#70bbd9" >
          <img src="{!!$bottomimage!!}" alt="" width="600" height="106" style="display: block;" >
         </td>
       </tr>
     </table>
   </td>
  </tr>
 </table>
</body>
</html>