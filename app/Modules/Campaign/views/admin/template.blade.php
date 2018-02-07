
{{-- {!! Form::open(['url' => route('campaigns.template'), 'method' => 'post', 'pjax-container', 'class' => 'form-horizontal']) !!} --}}

    {{-- <input type="hidden" name="id" value="{{$item->id}}"/> --}}
    {{-- <input type="hidden" name="social_description" value="{{$item->social_description}}"/> --}}


    <div id="email_editor"></div>


    <input type="button" class="btn btn-primary pull-right" id="btn_save" value="Guardar"/>


{{-- {!! Form::close() !!} --}}

<script type="text/javascript" data-exec-on-popstate>


    $(function(){


        $('#btn_save').on('click',function(){

            var html = $AEE.save();

            $.ajax({
                method: 'post',
                url: '{{route('campaigns.template')}}' ,
                data: {
                    _method:'post',
                    _token:LA.token,
                    id: {{$item->id}},
                    html: html
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


        $AEE.baseDir('/vendor/tmp/living-maileditor/dist').layoutReady(function(){


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