
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


<div class="box box-primary22 box-solid2">
    <div class="box-header with-border">
        <h3 class="box-title">Cuerpo</h3>
        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="box-body">


        <ul class="list-unstyled">

             @if($item->destinationLeadlist)

                @foreach($item->destinationLeadlist->getFields() as $f)
                    <li data-id="{{$f->id_name}}">{{$f->title}}&nbsp;&rArr;&nbsp;<code>%recipient.{{$f->id_name}}%</code></li>
                @endforeach

             @else

                 @foreach($item->userlists as $u)
                     @foreach($u->getFields() as $f)
                         <li data-id="{{$f->slug}}">{{$f->title}}&nbsp;&rArr;&nbsp;<code>%recipient.{{$f->slug}}%</code></li>
                     @endforeach
                 @endforeach

             @endif


        </ul>


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


    $(function(){





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

            $AEE.setEditorCode('{!!$item->mail_code!!}')

            // $AEE.buttons.saveAndExitButton.text($A.translate('Download'));
            $AEE.imagePicker.d.buttons.gallery.click(function(){

                $AEE.imagePicker.d.dialogs.gallery.open();

            });
            $AEE.imagePicker.d.inputs.upload.click(function(){

                $AEE.imagePicker.d.inputs.upload.enable();

            });

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