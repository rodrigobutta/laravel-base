
<div class="row">


    <div class="col-md-12">

        <div class="box box-default">

              <div class="box-header">
                  <span>
                      <input type="checkbox" class="grid-select-all">
                      <div class="btn-group" style="margin-left: 8px">
                          <a class="btn btn-sm btn-default">Para los elementos seleccionados</a>
                          <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="#" class="grid-batch-remove">Eliminar</a></li>
                          </ul>
                      </div>
                  </span>

              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                    <th></th>
                      <th>Fecha</th>
                      @foreach($fields as $field)
                        <th data-key="{{$field->id_name}}">{{$field->title}}</th>
                      @endforeach
                      <th>Base Unificada</th>
                      {{-- <th></th> --}}
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($item->leads as $l)
                          <?php
                              $tmp = $l->getFieldsArray();
                          ?>

                          <tr>
                            <td>

                                <input type="checkbox" class="grid-row-checkbox" data-id="{{$l->id}}">

                            </td>
                              <td>
                                  {{$l->created_at}}
                              </td>

                                @foreach($fields as $field)
                                  <td>{{$tmp[$field->id_name]}}</td>
                                @endforeach
                                <td>
                                    @if($l->user)
                                        <a href="{{route('user.manage',["itemId"=>$l->user->id])}}">{{$l->user->name}}</a>
                                    @endif
                                </td>
                              {{-- <td>
                                  <a href="javascript:void(0);" data-id="{{$l->id}}" class="btn btn-default btn-sm btn-flat list-row-delete">Remover</a>
                              </td> --}}

                          </tr>

                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>

              <div class="box-footer clearfix">
                {{-- <a href="{{route('forms.create', ['event_id' => $item->id])}}" class="btn btn-default btn-flat"><i class="fa fa-list-alt"></i>&nbsp;Exportar</a> --}}
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

