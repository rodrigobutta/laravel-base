
<style type="text/css">

    body{
        text-align: left !important;
    }

</style>



<div class="row">
    <div class="col-md-6">

        <div class="box box-primary22 box-solid2">
            <div class="box-header with-border">
                <h3 class="box-title">Propiedades</h3>
                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>Tipo</dt>
                    <dd><i class="fa {{$item->type->icon}}"></i>&nbsp;{{$item->type->name}}</dd>
                    <dt>Código</dt>
                    <dd>{{$item->slug}}</dd>
                </dl>
                <hr>
                <dl class="dl-horizontal">
                    <dt>Envios</dt>
                    <dd>{{$item->sentCount()}}<small>Personas a las que le llegó el E-mail.</small></dd>
                    <dt>Lecturas</dt>
                    <dd>{{$item->seenCount()}}<small>Personas que vieron el E-mail.</small></dd>
                    <dt>Visitas</dt>
                    <dd>{{$item->views}}<small>Personas que vieron el formulario.</small></dd>
                    <dt>Conversiones</dt>
                    <dd>{{$item->leadsCount()}}<small>Personas que completaron y enviaron el formulario.</small></dd>
                </dl>

            </div>
           {{--  <div class="box-footer">
                <a href="#" class="btn btn-primary btn-sm btn-edit-event" data-id="{{$item->id}}" data-toggle="tooltip" title="Editar {{$item->name}}">
                    <i class="fa fa-pencil"></i>&nbsp;&nbsp;Editar
                </a>
            </div> --}}
        </div>

    </div>
    <div class="col-md-6">

        <div class="box box-primary22 box-solid2">
            <div class="box-header with-border">
                <h3 class="box-title">{{$item->type->name}}</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                @if($item->mail_subject)
                    <h4><strong>{{$item->mail_subject}}</strong></h4>
                @endif
                <hr>
                @if($item->mail_html)
                    {!!$item->mail_html!!}
                @endif
            </div>
           {{--  <div class="box-footer">
                <a href="#" class="btn btn-primary btn-sm btn-edit-event" data-id="{{$item->id}}" data-toggle="tooltip" title="Editar {{$item->name}}">
                    <i class="fa fa-pencil"></i>&nbsp;&nbsp;Editar
                </a>
            </div> --}}
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="box box-default">

              <div class="box-header with-border">
                    <h3 class="box-title">Envios</h3>


              </div>

              <div class="box-body">

                <div class="list-options-box">
                    <input type="checkbox" class="grid-select-all">
                    <div class="btn-group" style="margin-left: 8px">
                        <a class="btn btn-sm btn-default">Acciones</a>
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" class="grid-batch-remove">Exportar</a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>E-mail</th>
                        <th>Mail Enviado</th>
                        <th>Mail Leido</th>
                        <th>Formulario Visitado</th>
                        <th>Formulario Enviado</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($item->sends as $s)
                        <tr>
                            <td>
                                <input type="checkbox" class="grid-row-checkbox" data-id="{{$s->id}}">
                            </td>
                            <td>{{$s->id}}</td>
                            <td>{{$s->email}}</td>
                            <td>{{$s->created_at}}</td>
                            <td>{{$s->seen_at}}</td>
                            <td>{{$s->cta_at}}</td>
                            <td>{{$s->completed_at}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

             <div class="box-footer ">
                 <div class="pull-right">
                     <input type="button" class="btn btn-primary " id="btn_save" value="Guardar"/>
                     <a href="{{route('events.manage', ['itemId'=>$item->event_id])}}" class="btn btn-default reload">Cerrar</a>
                 </div>
             </div>

        </div>

    </div>
</div>



<script type="text/javascript" data-exec-on-popstate>


    var selectedRows = function () {
        var selected = [];
        $('.grid-row-checkbox:checked').each(function(){
            selected.push($(this).data('id'));
        });

        return selected;
    }


    $(function () {

        $('.grid-row-checkbox').iCheck({checkboxClass:'icheckbox_minimal-blue'}).on('ifChanged', function () {
            if (this.checked) {
                $(this).closest('tr').css('background-color', '#ffffd5');
            } else {
                $(this).closest('tr').css('background-color', '');
            }
        });


        $('.grid-select-all').iCheck({checkboxClass:'icheckbox_minimal-blue'});

        $('.grid-select-all').on('ifChanged', function(event) {
            if (this.checked) {
                $('.grid-row-checkbox').iCheck('check');
            } else {
                $('.grid-row-checkbox').iCheck('uncheck');
            }
        });



        eventBindEditable()




        $('.grid-batch-remove').on('click', function() {

            var ids = selectedRows().join();

            swal({
              title: "¿Eliminar estos elementos?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Confirmar",
              closeOnConfirm: false,
              cancelButtonText: "Cancelar"
            },
            function(){
                $.ajax({
                    method: 'post',
                    url: '{{route('leadlist.batch.removeitem',['itemId' => $item->id])}}',
                    data: {
                        ids: ids,
                        _method:'delete',
                        _token:LA.token,
                    },
                    success: function (data) {

                        console.log(data);

                        $.pjax.reload('#pjax-container');

                        if (typeof data === 'object') {
                            if (data.status) {
                                swal(data.message, '', 'success');
                            } else {
                                swal(data.message, '', 'error');
                            }
                        }
                    }
                });
            });
        });



    });








    function eventBindEditable(){

        // $('.grid-event-editable-name').editable({
        //     url: "{{ route('events.partials.editable.save') }}",
        //     name:"name",
        //     emptytext: 'Sin definir',
        //     // preventSubmit: function(instance, pk, oldValue, newValue) {
        //     //     // interrumpe el submit del valor, pide comentarios y si esta todo ok, sigue

        //     //     var that = $(this);
        //     //     actionslog({
        //     //         id: pk,
        //     //         slug: "event-name-change",
        //     //         before: oldValue,
        //     //         after: newValue
        //     //     },
        //     //     function(){
        //     //         that.editable('resumeSubmit',instance, newValue);
        //     //     },
        //     //     function(){
        //     //         that.editable('cancelSubmit',instance, 'comentario obligatorio');
        //     //     });

        //     // },
        //     success: function(data) {
        //         if (data.status) {
        //            toastr.success(data.message);
        //         }
        //         else{
        //            toastr.error(data.message);
        //         }
        //     },
        //     error: function(data) {
        //         console.log(data)
        //         toastr.error('admin.error');
        //     }
        // });

    }





</script>

