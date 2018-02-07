
<dl class="dl-horizontal">
      <dt>Campaña</dt><dd>{{$item->name}}</dd>
      <dt>Destinatarios</dt><dd>{{ $item->getDestinaionCount() }}</dd>
</dl>

<a href="#" class="btn btn-default btn-send-test"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Enviando Prueba">Enviar Prueba</a>
<a href="#" class="btn btn-primary btn-send"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Enviando">Enviar Campaña</a>




<script data-exec-on-popstate>

    console.log('Subscript executed..');



    $(function () {


        $('.btn-send-test').on('click', function(e){
            e.preventDefault;

            $that = $(this);

            swal({
              title: "Envio de Prueba",
              text: "Ingresá la casilla de correo donde enviar el mail de prueba",
              type: "input",
              showCancelButton: true,
              closeOnConfirm: false,
              animation: "slide-from-top",
              inputPlaceholder: "prueba@prueba.com"
            },
            function(inputValue){
              if (inputValue === false) return false;

              if (inputValue === "") {
                swal.showInputError("Es necesario al menos un E-mail de destino de la prueba");
                return false
              }

              $that.button('loading');

              $.ajax({
                  method: 'post',
                  url: '{{route('campaigns.process.test',['itemId' => $item->id])}}',
                  data: {
                      _token:LA.token,
                      email: inputValue,
                      action: 'test'
                  },
                  success: function (data) {

                      $that.button('reset');

                      console.log(data)

                      swal("Prueba Enviada!", "Por favor, verificá la casilla " + inputValue, "success");

                  }
              });


            });





        });


        $('.btn-send').on('click', function(e){
            e.preventDefault;


            $that = $(this);

            $that.button('loading');

            swal({
                title: "Estas seguro de enviar la campaña?",
                text: "Una vez hecho, esta acción no va a poder cancelarse.",
                type: "warning",
                showCancelButton: true,
                // confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Si, estoy seguro!',
                cancelButtonText: "No, cancelalo!",
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true,
                animation: "slide-from-top",
            },
            function(isConfirm){

                if (isConfirm) {



                    $.ajax({
                        method: 'post',
                        url: '{{route('campaigns.process',['itemId' => $item->id])}}',
                        data: {
                            _token:LA.token,
                            // email: inputValue,
                            action: 'full'
                        },
                        success: function (data) {

                            $that.button('reset');

                            console.log(data)

                            swal("Campaña Enviada!", "Se enviaron " + data.sentcnt + " correos", "success");

                        }
                    });


                    // swal({
                    //     title: 'Shortlisted!',
                    //     text: 'Candidates are successfully shortlisted!',
                    //     type: 'success'
                    // }, function() {
                    //     form.submit();
                    // });

                } else {
                    $that.button('reset');
                    swal("Envio cancelado", "Siempre es bueno revisar todo una segunda vez.", "error");
                }



            });




        });





    });



</script>