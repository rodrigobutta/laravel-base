<div class="row">
    <div class="col-md-12">


      <div class="box box-primary22 box-solid2">
          <div class="box-header with-border">
              <h3 class="box-title">Propiedades</h3>
              <div class="box-tools pull-right">

              </div>
          </div>
          <div class="box-body">

              <div class="form-group">
                  <label for="mail_subject" class="col-sm-2 control-label">Asunto</label>
                  <div class="col-sm-10">
                      <input type="text" id="mail_subject" name="mail_subject" value="{{$item->mail_subject}}" class="form-control" placeholder="" autofocus style="width: 100%;"/>
                  </div>
              </div>

          </div>

      </div>


    </div>

    {{-- <div class="col-md-6">

        <div class="box box-primary22 box-solid2">
            <div class="box-header with-border">
                <h3 class="box-title">Archivos</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">

                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach($item->uploads as $u)

                        <tr>

                            <td>
                                {{$u->name}}
                            </td>
                        </tr>

                    @endforeach

                  </tbody>
                </table>

            </div>
            <div class="box-footer">

                {!! Form::open(['name' => 'upload_file_form', 'url' => route('api.upload.file'), 'method' => 'post', 'pjax-container222', 'class' => 'form-horizontal']) !!}

                    {{ Form::hidden('campaign_id', $item->id) }}
                    {{ Form::hidden('folder', 'mails') }}

                    <div class="fields-group">

                        <div class="form-group">
                            <label for="social_title" class="col-sm-2 control-label">Título</label>
                            <div class="col-sm-10">
                                <input type="file" name="upload_file[]" multiple class="form-control" />
                            </div>
                        </div>

                    </div>

                    <input class="btn btn-default" type="submit" value="Upload" />

                {!! Form::close() !!}

            </div>
        </div>

    </div> --}}


</div>





{!! Form::open(['name' => 'upload_file_form', 'url' => route('api.upload.file'), 'method' => 'post', 'class' => 'hidden']) !!}
    <input type="file" name="upload_file" class="form-control" />
{!! Form::close() !!}


<div class="box box-primary22 box-solid2">
    <div class="box-header with-border">
        <h3 class="box-title">Cuerpo</h3>
        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="box-body">

        <div id="email_editor"></div>

    </div>

</div>


<div class="box box-primary22 box-solid2">
    <div class="box-footer ">
        <div class="pull-right">
            <input type="button" class="btn btn-primary " id="btn_save" value="Guardar"/>
            <a href="{{route('events.manage', ['itemId'=>$item->id])}}" class="btn btn-default">Cerrar</a>
        </div>
    </div>
</div>


<script type="text/javascript" data-exec-on-popstate>

    var currentEditorBookmark;
    var currentEditor;

    // function uploadFile(){


    //         console.log('subiendo')

    //         var form = $('form[name="upload_file_form"]');

    //         var formData = new FormData($(this)[0]);

    //         $.ajax({
    //             url: form.attr('action'),
    //             type: 'POST',
    //             contentType: false,
    //             data: formData,
    //             success: function (data) {
    //                 console.log(data)
    //             },
    //             cache: false,
    //             processData: false
    //         });


    // }



    $(function(){


        // $('form[name="upload_file_form"]').on('submit',function(e){
        //     e.preventDefault();
        //     console.log('subiendo')

        //     var form = $(this);

        //     var formData = new FormData($(this)[0]);

        //     $.ajax({
        //         url: form.attr('action'),
        //         type: 'POST',
        //         contentType: false,
        //         data: formData,
        //         success: function (data) {
        //             console.log(data)
        //         },
        //         cache: false,
        //         processData: false
        //     });

        // })



        $('#btn_save').on('click',function(){

            var mail_code = $AEE.getEditorCode();
            var mail_html = $AEE.getHtmlCode({conditions:false});
            var mail_subject = $('input[name="mail_subject"]').val();

            $.ajax({
                method: 'post',
                url: '{{route('campaigns.template.save')}}' ,
                data: {
                    _method:'post',
                    _token:LA.token,
                    id: {{$item->id}},
                    mail_code: mail_code,
                    mail_html: mail_html,
                    mail_subject: mail_subject
                },
                success: function (data) {
                    // $.pjax.reload('#pjax-container');

                    if (typeof data === 'object') {
                        if (data.status) {
                            swal(data.message, '', 'success');
                        } else {
                            swal(data.message, '', 'error');
                        }
                    }
                }
            });


        })


        $AEE.baseDir('/vendor/tmp/living-maileditor/dist').imageUploadApiUrl('{{route('campaigns.template.upload')}}').layoutReady(function(){


            $AEE.systemFields({
                @foreach($item->uploads as $u)
                    '<a href="{{$u->url}}">{{$u->name}}</a>': '{{$u->name}}',
                @endforeach
            });


            @if($item->destinationLeadlist)

                $AEE.customFields({
                   @foreach($item->destinationLeadlist->getFields() as $f)
                       "%recipient.{{$f->id_name}}%": "{{$f->title}}",
                   @endforeach
                });

            @else

                $AEE.customFields({
                    @foreach($item->userlists as $u)
                        @foreach($u->getFields() as $f)
                            "%recipient.{{$f->slug}}%": "{{$f->title}}",
                        @endforeach
                    @endforeach
                });

            @endif


            $AEE.setEditorCode('{!!addslashes($item->mail_code)!!}')

            // $AEE.buttons.saveAndExitButton.text($A.translate('Download'));
            // $AEE.imagePicker.d.buttons.gallery.click(function(){

            //     $AEE.imagePicker.d.dialogs.gallery.open();

            // });
            // $AEE.imagePicker.d.inputs.upload.click(function(){

            //     $AEE.imagePicker.d.inputs.upload.enable();

            // });

            // volar esto cuando sepa apra que sirve
            var xhrs = [];
            $AEE.inputs.dropFiles.input().fileupload({
                beforeSend:function(xhr, data) {
                    if(typeof $AA.token().get() === 'undefined'){
                        $AEE.afterLogin = function(){
                            for(var i = 0; i < xhrs.length; i++){
                                xhrs[i][0].setRequestHeader('Authorization', 'Bearer ' + $AA.token().get());
                                xhrs[i][1].submit();
                            }
                        };
                        xhrs.push([xhr, data]);
                        $AEE.dialogs.loginDialog.open();
                        return false;
                    }
                    xhr.setRequestHeader('Authorization', 'Bearer ' + $AA.token().get());
                }
            });


        }).init();


        $AEE.open(250);


    });


</script>