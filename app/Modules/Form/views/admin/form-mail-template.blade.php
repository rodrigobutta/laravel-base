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
</div>

{!! Form::open(['name' => 'upload_file_form', 'url' => route('api.upload.file'), 'method' => 'post', 'class' => 'hidden']) !!}
    <input type="file" name="upload_file" class="form-control" />
{!! Form::close() !!}

<div class="box box-primary22 box-solid2">
    <div class="box-header with-border">
        <h3 class="box-title">Cuerpo</h3>
    </div>
    <div class="box-body">
        <div id="email_editor"></div>
    </div>
</div>

<div class="box box-primary22 box-solid2">
    <div class="box-footer ">
        <div class="pull-right">
            <input type="button" class="btn btn-primary " id="btn_save" value="Guardar"/>
            <a href="{{route('events.manage', ['itemId'=>$item->event_id])}}" class="btn btn-default reload">Cerrar</a>
        </div>
    </div>
</div>


<script type="text/javascript" data-exec-on-popstate>

    var currentEditorBookmark;
    var currentEditor;
    var mailCta = '%recipient.cta%';
    // var mailPixel = '%recipient.pixel%';

    $(function(){

        $('#btn_save').on('click',function(){

            var mail_code = $AEE.getEditorCode();
            var mail_html = $AEE.getHtmlCode({conditions:false});
            var mail_subject = $('input[name="mail_subject"]').val();

            $.ajax({
                method: 'post',
                url: '{{route('forms.template.save')}}' ,
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


        $AEE.baseDir('/vendor/tmp/living-maileditor/dist').imageUploadApiUrl('{{route('forms.template.upload')}}').layoutReady(function(){

            $AEE.customFields({
               @foreach($item->getFields() as $f)
                   "%recipient.{{$f->id_name}}%": "{{$f->title}}",
               @endforeach
            });

            $AEE.setEditorCode('{!!addslashes($item->mail_code)!!}')

        }).init();

        $AEE.open(250);

    });


</script>