<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td>
     <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
       <tr>
         <td align="center" bgcolor="#70bbd9" >
          <img src="{{env('APP_URL')}}/storage/admin/{!!$form->cover_image!!}" alt="{!!$form->name!!}" width="600" height="180" style="display: block;" >
         </td>
       </tr>
       <tr>
         <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;font-size: 16px; font-family: Arial">

                  Hola <strong>{{$name}}</strong>,<br>
                  Tu suscripción a la charla está confirmada.<br><br>
                  Te esperamos el próximo 22 de Noviembre, a las 09:00 Horas en Rodizio Costanera.<br><br>
                  Podés descargar la agenda del evento en el siguiente <a href="http://eventos.maquiel.com.ar/storage/admin/files/agenda_evento_22_noviembre.pdf" target="_blank">link</a>

         </td>
       </tr>
       <tr>
         <td align="center" bgcolor="#70bbd9" >
          <img src="{{env('APP_URL')}}/storage/admin/{!!$form->footer_image!!}" alt="{!!$form->name!!}" width="600" height="106" style="display: block;" >
         </td>
       </tr>
       {{-- <tr>
         <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
           <table border="1" cellpadding="0" cellspacing="0" width="100%">
             <td width="75%">
             asdjksakdjakldjaskjaskjskajdkajksdjakljdl
             </td>
             <td align="right">
              <table border="0" cellpadding="0" cellspacing="0">
               <tr>
                <td>
                 <a href="http://www.twitter.com/">
                  <img src="images/tw.gif" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                 </a>
                </td>
                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                <td>
                 <a href="http://www.twitter.com/">
                  <img src="images/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                 </a>
                </td>
               </tr>
              </table>
             </td>
           </table>
         </td>
       </tr> --}}
     </table>
   </td>
  </tr>
 </table>
</body>
</html>