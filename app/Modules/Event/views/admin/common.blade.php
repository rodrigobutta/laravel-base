<div class="modal fade" id="modal_form">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">asd
        </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer text-right">
        <button type="button" class="btn btn-primary">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {


        // editable default disabled
        // var defaults = {
        //     disabled: true,
        //     // mode: 'inline',
        //     // toggle: 'manual',
        //     // showbuttons: false,
        //     // onblur: 'ignore',
        //     // inputclass: 'input-large',
        //     // savenochange: true,
        //     // success: function () {
        //     //     return false;
        //     // }
        // };
        // $.extend($.fn.editable.defaults, defaults);

        // necesito boton fuera del form del view porque esta en el modal
        $('#modal_form button.btn-primary').on('click',function(){
            $('#modal_form form').submit();
        });




        $('.btn-new-event').on('click', function(e){
            e.preventDefault();

            $('#modal_form').livingDialog({
                url: '{{ route('events.partials.create') }}',
                open: {
                    type:'GET',
                    predata: function(el) {
                        // var data = {}
                        //     data.id = el.closest('.item').attr('data-id')
                        // return data
                    }
                },
                error: function(when, that, xhr, data) {
                    console.log('livingdialog error')
                    console.log(when)
                },
                submited:function(data,response){
                    console.log('dialog form submited')
                    // console.log(data)
                    // console.log(response)

                    toastr.success("Evento creado");

                    document.location = response.route;

                },
                closed:function(that){
                    console.log('dialog closed')

                }
            });


        });





        $('.btn-new-campaign').on('click', function(e){
            e.preventDefault();

            var url = '{{ route('campaigns.create', ['eventId' => 'xxx', 'typeId' => 'yyy']) }}';
                url = url.replace('xxx',$(this).attr('data-event-id'));
                url = url.replace('yyy',$(this).attr('data-type-id'));


            $('#modal_form').livingDialog({
                url:url,
                open: {
                    type:'GET',
                    predata: function(el) {
                        // var data = {}
                        //     data.id = el.closest('.item').attr('data-id')
                        // return data
                    }
                },
                error: function(when, that, xhr, data) {
                    console.log('livingdialog error')
                    console.log(when)
                },
                submited:function(data,response){
                    console.log('dialog form submited')

                    console.log(data)

                    toastr.success("Campaña creada");

                    document.location = response.route;

                   // var url = '{{ route('events.manage', ['itemId' => $item->id]) }}';
                   // console.log(url)
                   // document.location = url;


                },
                closed:function(that){
                    console.log('dialog closed')

                }
            });


        });



        $('.btn-campaign-config').on('click', function(e){
            e.preventDefault();

            var url = '{{ route('campaigns.config', ['itemId' => 'xxx']) }}';
                url = url.replace('xxx',$(this).attr('data-id'));

            $('#modal_form').livingDialog({
                url:url,
                open: {
                    type:'GET',
                    predata: function(el) {
                    }
                },
                error: function(when, that, xhr, data) {
                    console.log('livingdialog error')
                    console.log(when)
                },
                submited:function(data,response){
                    console.log('dialog form submited')
                    console.log(data)
                    toastr.success("Campaña configurada");
                    document.location = response.route;
                },
                closed:function(that){
                    console.log('dialog closed')
                }
            });


        });




        $('.btn-campaign-process').on('click', function(e){
            e.preventDefault();

            var url = '{{ route('campaigns.process', ['itemId' => 'xxx']) }}';
                url = url.replace('xxx',$(this).attr('data-id'));


            $('#modal_form').livingDialog({
                hideButtons: true,
                url:url,
                open: {
                    type:'GET',
                    predata: function(el) {
                    }
                },
                error: function(when, that, xhr, data) {
                    console.log('livingdialog error')
                    console.log(when)
                },
                submited:function(data,response){
                    console.log('dialog form submited')
                    console.log(data)
                    toastr.success("Campaña creada");
                    document.location = response.route;
                },
                closed:function(that){
                    console.log('dialog closed')
                }
            });


        });



        $('.btn-campaign-edit').on('click', function(e){
            e.preventDefault();

            var url = '{{ route('campaigns.edit', ['itemId' => 'xxx']) }}';
                url = url.replace('xxx',$(this).attr('data-id'));


            $('#modal_form').livingDialog({
                url:url,
                open: {
                    type:'GET',
                    predata: function(el) {
                        // var data = {}
                        //     data.id = el.closest('.item').attr('data-id')
                        // return data
                    }
                },
                error: function(when, that, xhr, data) {
                    console.log('livingdialog error')
                    console.log(when)
                },
                submited:function(data,response){
                    console.log('dialog form submited')

                    console.log(data)

                    toastr.success("Campaña creada");

                    document.location = response.route;

                   // var url = '{{ route('events.manage', ['itemId' => $item->id]) }}';
                   // console.log(url)
                   // document.location = url;


                },
                closed:function(that){
                    console.log('dialog closed')

                }
            });


        });







    });

</script>