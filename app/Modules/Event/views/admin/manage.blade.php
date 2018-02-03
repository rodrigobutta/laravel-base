
<div class="row">


    <div class="col-md-12">

        <div class="box box-warning box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Formularios</h3>

              {{--   <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div> --}}
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      {{-- <th>Código</th> --}}
                      <th>Listas de destino</th>
                      <th>Visitas</th>
                      <th>Registros</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($item->forms as $f)

                          <tr>
                              <td>
                                  <a href="pages/examples/invoice.html">{{$f->name}}</a>
                              </td>
                             {{--  <td>
                                  {{$f->slug}}
                              </td> --}}
                              <td>
                                @foreach($f->userlists as $l)
                                  <a href="{{route('userlists.edit', ['id' => $l->id])}}"><span class="label label-default">{{$l->name}}</span></a>
                                @endforeach
                              </td>
                              <td>
                                  0
                              </td>
                              <td>
                                  0
                              </td>
                              <td>
                                  <a class="btn btn-success btn-sm"  href="{{route('forms.view', ['eventSlug' => $f->event->slug, 'formSlug' => $f->slug, 'campaign' => 'test'])}}" target="_blank">Ver</a>
                                  <a class="btn btn-default btn-sm"  href="{{route('forms.edit', ['formid' => $f->id])}}">Configurar</a>
                                  <a class="btn btn-default btn-sm" href="{{route('forms.schema', ['formid' => $f->id])}}">Campos</a>
                                  <a href="javascript:void(0);" data-id="{{$f->id}}" class="btn btn-default btn-sm form-row-delete">Eliminar</a>
                              </td>

                          </tr>

                      @endforeach

                    </tbody>
                  </table>
                </div>

              </div>

              <div class="box-footer clearfix">
                <a href="{{route('forms.create', ['eventid' => $item->id])}}" class="btn btn-sm btn-warning btn-flat pull-left">Nuevo Formulario</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Estadísticas</a>
              </div>

        </div>

    </div>

</div>



<div class="row">

    <div class="col-md-12">

        <div class="box box-info box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Campañas</h3>

              {{--   <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div> --}}
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      {{-- <th>Tipo</th> --}}
                      {{-- <th>Código</th> --}}
                      <th>Listas a enviar</th>
                      <th>Formulario destino</th>
                      <th>Estado</th>
                      <th>Enviados</th>
                      <th>Leidos</th>
                      <th>Ingresados</th>
                      <th>Registrados</th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($item->campaigns as $c)

                          <tr>
                              <td>
                                  <a href="pages/examples/invoice.html"><i class="fa {{$c->type->icon}}"></i>&nbsp;{{$c->name}}</a>
                              </td>
                             {{--  <td>
                                  <i class="fa {{$c->type->icon}}"></i>&nbsp;{{$c->type->name}}
                              </td> --}}
                              {{-- <td>
                                  {{$c->slug}}
                              </td> --}}
                              <td>
                                @foreach($c->userlists as $l)
                                  <span class="label label-default">{{$l->name}}</span>
                                @endforeach
                              </td>
                              <td>
                                  <span class="label label-warning">{{$c->getForm()->name}}</span>
                              </td>
                              <td>
                                  <span class="label label-primary">Enviada</span>
                              </td>
                              <td class="text-center22">
                                  0
                                </td>
                                <td>
                                  0
                              </td>
                                <td>
                                  0
                              </td>
                                <td>
                                  0
                              </td>

                          </tr>

                      @endforeach

                    </tbody>
                  </table>
                </div>

              </div>

              <div class="box-footer clearfix">
                <a href="{{route('campaigns.create', ['eventid' => $item->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Nueva Campaña</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Estadísticas</a>
              </div>

        </div>

    </div>

</div>





<div class="row">


    <div class="col-md-12">

        <div class="box box-success box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Registros</h3>

              {{--   <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div> --}}
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Campaña responsable</th>
                      <th>Registros</th>
                      <th>Altas de Usuario</th>
                      <th>Actualización de Usuario</th>
                    </tr>
                    </thead>
                    <tbody>

                          <tr>
                              <td>
                                  <a href="pages/examples/invoice.html">xxxxxxx</a>
                              </td>
                              <td>
                                0
                              </td>
                              <td>
                                0
                              </td>
                              <td>
                                0
                              </td>
                          </tr>


                    </tbody>
                  </table>
                </div>

              </div>

              <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-left">Enviar Mail</a>
              </div>

        </div>

    </div>

</div>


<script type="text/javascript" data-exec-on-popstate>


    $(function () {

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



</script>

