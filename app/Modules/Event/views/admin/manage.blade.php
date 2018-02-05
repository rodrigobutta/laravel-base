<div class="row">
    <div class="col-md-6">

        <div class="box box-primary22 box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Propiedades</h3>
                <div class="box-tools pull-right">
                  {{-- <span class="label label-danger">Algun alerta??</span> --}}
                  {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> --}}
                  {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
                </div>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                    <dt>Nombre</dt><dd><a href='#' class='grid-event-editable-name' data-pk='{{ $item->id }}' data-value='{{ $item->name }}'>{{ $item->name }}</a></dd>
                    <dt>Url</dt><dd><a href='#' class='grid-event-editable-slug' data-pk='{{ $item->id }}' data-value='{{ $item->slug }}'>{{ $item->slug }}</a></dd>
                    {{-- <dt>Tipo</dt><dd><a href="#" class="grid-event-editable-type" data-type='select' data-pk='{{ $item->id }}' data-value='{{$item->type_id}}'></a></dd> --}}
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

        <div class="box box-primary22 box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Propiedades</h3>
                <div class="box-tools pull-right">
                  {{-- <span class="label label-danger">Algun alerta??</span> --}}
                  {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> --}}
                  {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
                </div>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">

              </dl>
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

        <div class="box box-warning box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Formularios</h3>
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Listas de Usuarios</th>
                      <th>Visitas</th>
                      <th>Conversiones</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($item->forms as $f)

                          <tr>
                              <td>
                                  <a href="pages/examples/invoice.html">{{$f->name}}</a>
                              </td>
                              <td>
                                @foreach($f->userlists as $l)
                                  <a href="{{route('userlists.edit', ['id' => $l->id])}}"><span class="label label-default">{{$l->name}}</span></a>
                                @endforeach
                              </td>
                              <td>
                                  {{$f->views}}
                              </td>
                              <td>
                                  {{$f->leadsCount()}}
                              </td>
                              <td class="text-right">
                                  <a class="btn btn-default btn-sm btn-flat"  href="{{route('forms.edit', ['formid' => $f->id])}}">Editar</a>
                                  <a class="btn btn-default btn-sm btn-flat reload" href="{{route('forms.schema', ['formid' => $f->id])}}">Configurar</a>
                                  <a class="btn btn-primary btn-sm btn-flat"  href="{{route('forms.view', ['eventSlug' => $f->event->slug, 'formSlug' => $f->slug, 'campaign' => 'test'])}}" target="_blank">Vista Previa</a>
                                  <a href="javascript:void(0);" data-id="{{$f->id}}" class="btn btn-default btn-sm btn-flat form-row-delete">Eliminar</a>
                              </td>

                          </tr>

                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>

              <div class="box-footer clearfix">
                <a href="{{route('forms.create', ['event_id' => $item->id])}}" class="btn btn-default btn-flat"><i class="fa fa-list-alt"></i>&nbsp;Nuevo Formulario</a>
                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Estadísticas</a> --}}
              </div>

        </div>

    </div>

</div>



<div class="row">

    <div class="col-md-12">

        <div class="box box-info box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Campañas</h3>
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Lista de envio</th>
                        <th>Formulario destino</th>
                        {{-- <th>Estado</th> --}}
                        <th>Envios</th>
                        <th>Lecturas</th>
                        <th>Visitas</th>
                        <th>Conversiones</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($item->campaigns as $c)

                          <tr>
                                <td>
                                    <i class="fa {{$c->type->icon}}"></i>&nbsp;{{$c->type->name}}
                                </td>
                              <td>
                                  <a href="pages/examples/invoice.html">{{$c->name}}</a>
                              </td>
                              <td>
                                  <span class="label label-default">{{$c->getDestinaionLeadlist()->fullname}}</span>
                              </td>
                              <td>
                                  <span class="label label-default">{{$c->getForm()->name}}</span>
                              </td>
                              {{-- <td>
                                  <span class="label label-default">Sin determinar</span>
                              </td> --}}
                              <td class="text-center22">
                                  0
                                </td>
                                <td>
                                  0
                              </td>
                                <td>
                                  {{$c->views}}
                              </td>
                                <td>
                                  {{$c->leadsCount()}}
                              </td>
                              <td class="text-right">

                                    @if($c->type_id>1)
                                        <a href="#" class="btn btn-default btn-sm btn-flat btn-campaign-edit" data-id="{{$c->id}}">Editar</a>
                                        <a href="#" class="btn btn-default btn-sm btn-flat btn-campaign-config" data-id="{{$c->id}}">Configurar</a>
                                        <a href="#" class="btn btn-primary btn-sm btn-flat btn-campaign-process" data-id="{{$c->id}}">Enviar</a>
                                    @endif
                              </td>

                          </tr>

                      @endforeach

                    </tbody>
                  </table>
                </div>

              </div>

              <div class="box-footer clearfix">

                <button type="button" class="btn btn-flat btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    Nueva Campaña
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="#" class="btn-new-campaign" data-event-id="{{$item->id}}" data-type-id="2"><i class="fa fa-facebook"></i>&nbsp;Redes Sociales</a></li>
                      <li><a href="#" class="btn-new-campaign" data-event-id="{{$item->id}}" data-type-id="3"><i class="fa fa-envelope"></i>&nbsp;E-mail</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Otro tipo..</a></li>
                    </ul>
              </div>

        </div>

    </div>

</div>








<div class="row">


    <div class="col-md-12">

        <div class="box box-success box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Listas</h3>
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Conversiones</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($item->leadlists as $l)

                            <tr>
                                <td>
                                    <a href="pages/examples/invoice.html"><i class="fa {{$l->type->icon}}"></i>&nbsp;{{$l->fullname}}</a>
                                </td>
                                  <td>
                                    {{$l->leadsCount()}}
                                </td>
                                <td class="text-right">
                                    @if(!$l->isTest())
                                        <a class="btn btn-default btn-sm btn-flat" href="{{route('leadlist.manage', ['itemId' => $l->id])}}">Administrar</a>
                                        <a class="btn btn-primary btn-sm btn-flat" href="{{route('leadlist.export', ['itemId' => $l->id])}}" target="_blank">Exportar</a>
                                    @endif
                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                  </table>
                </div>

              </div>

              <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-default btn-flat pull-left"><i class="fa fa-hand-lizard-o"></i>&nbsp;Nueva lista personalizada</a>
              </div>

        </div>

    </div>

</div>


<script type="text/javascript" data-exec-on-popstate>


    $(function () {

        bindButtons()

        eventBindEditable()


        $('.form-row-delete').unbind('click').click(function() {

            var id = $(this).data('id');

            swal({
              title: "Are you sure to delete this item ?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Confirm",
              closeOnConfirm: false,
              cancelButtonText: "Cancel"
            },
            function(){
                $.ajax({
                    method: 'post',
                    url: '/admin/forms/' + id,
                    data: {
                        _method:'delete',
                        _token:LA.token,
                    },
                    success: function (data) {
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




    function bindButtons(){


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


    }



    function eventBindEditable(){





        $('.grid-event-editable-name').editable({
            url: "{{ route('events.partials.editable.save') }}",
            name:"name",
            emptytext: 'Sin definir',
            // preventSubmit: function(instance, pk, oldValue, newValue) {
            //     // interrumpe el submit del valor, pide comentarios y si esta todo ok, sigue

            //     var that = $(this);
            //     actionslog({
            //         id: pk,
            //         slug: "event-name-change",
            //         before: oldValue,
            //         after: newValue
            //     },
            //     function(){
            //         that.editable('resumeSubmit',instance, newValue);
            //     },
            //     function(){
            //         that.editable('cancelSubmit',instance, 'comentario obligatorio');
            //     });

            // },
            success: function(data) {
                if (data.status) {
                   toastr.success(data.message);
                }
                else{
                   toastr.error(data.message);
                }
            },
            error: function(data) {
                console.log(data)
                toastr.error('admin.error');
            }
        });


        $('.grid-event-editable-slug').editable({
            url: "{{ route('events.partials.editable.save') }}",
            name:"slug",
            emptytext: 'Sin definir',
            preventSubmit: function(instance, pk, oldValue, newValue) {

                newValue = newValue + 'xxx'

                $(this).editable('resumeSubmit',instance, newValue);

            },
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'Este campo es requerido';
                }
                if (/\s/.test(value)) {
                    return 'El campo no puede contener espacios, separar utilizando "-".';
                }
                if (/^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/.test(value)==false) {
                    return 'El campo tiene caracteres invalidos para una URL';
                }
            },
            success: function(data) {
                if (data.status) {
                   toastr.success(data.message);
                }
                else{
                   toastr.error(data.message);
                }
            },
            error: function(data) {
                console.log(data)
                toastr.error('admin.error');
            }
        });




    }





</script>

