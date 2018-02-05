
<div class="row">


    <div class="col-md-12">

        <div class="box box-default box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Conversiones</h3>
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Base Unificada</th>

                      @foreach($fields as $field)
                        <th data-key="{{$field->id_name}}">{{$field->title}}</th>
                      @endforeach
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($item->leads as $l)
                          <?php
                              $tmp = $l->getFieldsArray();
                          ?>

                          <tr>
                              <td>
                                  {{$l->created_at}}
                              </td>
                              <td>
                                  {{$l->user_id}}
                              </td>
                                @foreach($fields as $field)
                                  <td>{{$tmp[$field->id_name]}}</td>
                                @endforeach
                              <td>
                                  {{-- <a class="btn btn-default btn-sm btn-flat"  href="{{route('forms.edit', ['formid' => $f->id])}}">Ver</a> --}}
                                  <a href="javascript:void(0);" data-id="{{$l->id}}" class="btn btn-default btn-sm btn-flat list-row-delete">Remover</a>
                              </td>

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


    $(function () {




        eventBindEditable()


        $('.list-row-delete').unbind('click').click(function() {

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

