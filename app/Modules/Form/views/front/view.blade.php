@extends('front/master/index')

@section('title')
    {!! $title !!}
@overwrite

@section('meta')
    <meta name="description" content="{!! $description !!}">
    <meta property="og:title" content="{!! $title !!}"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:description" content="{!! $description !!}"/>
    <meta property="og:image" content="{{ URL::to('/') }}/storage/admin/{!!$item->cover_image!!}"/>
@overwrite



@section('content')


@section('head')

    <style type="text/css">

        body {
            @if($schema->addon_background)
                background-color: {!!$schema->addon_background!!} !important;
            @endif
        }

        label, input, button, select, textarea {

            @if($schema->font_size)
                font-size: {{$schema->font_size}}px !important;

            @endif

            @if($schema->font_family)
                font-family: {!!$schema->font_family!!} !important;
            @endif

        }

        label, input, select, textarea {

            @if($schema->font_color)
                color: {!!$schema->font_color!!} !important;
            @endif

        }


    </style>

@endsection




<div class="cover" style="--background-image:url('/storage/admin/{!!$item->cover_image!!}')">

    <div class="container">

        <div class="row">
{{--             <div class="col-md-2 ">

            </div> --}}
            <div class="col-md-12">
                <img class="cover-image" src="/storage/admin/{!!$item->cover_image!!}">
                <br>
            </div>
        </div>
    </div>

</div>

<div class="container" style="padding-top: 50px;padding-bottom: 50px;">

    <div class="row">
        <div class="col-md-12">

            <div class="form-wrapper">
                <form method="POST" class="form-inline22 {!! $schema->label_orientation !!}" id="form">

                    @if($send)
                        <input type="hidden" name="send_id" value="{{$send->id}}" />
                    @endif

                    @foreach($fields as $field)

                        <div class="form-group {!! $schema->corner_style !!} control-group">

                            <label class="control-label" for="{{$field->id_name}}">{{$field->title}}{!! $field->is_required ? ' <span class="required">*</span>' : '' !!}</label>

                            <div class="controls">

                            @if ($field->type == 'text' || $field->type == 'email')
                                <input type="text" name="{{$field->id_name}}" id="{{$field->id_name}}" placeholder="{{$field->placeholder}}" class="form-control {!! $schema->input_size !!}">
                            @elseif ($field->type == 'phone')
                                <input type="text" name="{{$field->id_name}}" id="{{$field->id_name}}" placeholder="{{$field->placeholder}}" class="form-control {!! $schema->input_size !!} phone">
                            @elseif ($field->type == 'textarea')
                                <textarea name="{{$field->id_name}}" id="{{$field->id_name}}" placeholder="{{$field->placeholder}}" rows="8" class="form-control {!! $schema->input_size !!} span5"></textarea>
                            @elseif ($field->type == 'select')
                                <select name="{{$field->id_name}}" id="{{$field->id_name}}" class="form-control {!! $schema->input_size !!}">
                                    <option value="" selected=""></option>
                                    {{-- al ser userfield, tengo valores de tabla que son id, name, title, en vez del texto comun en choice --}}
                                    @if (isset($field->nature) && $field->nature == 'userfield')
                                        @foreach($field->choices as $choice)
                                            <option value="{{ $choice->id }}">{{ $choice->title }}</option>
                                        @endforeach
                                    @else
                                        @foreach($field->choices as $choice)
                                            <option value="{{ $choice->choice }}">{{ $choice->choice }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @endif

                            </div>

                        </div>

                    @endforeach

                    <div class="form-group form-actions">
                        <button type="submit" class="btn {!!$schema->button_style!!} {!! $schema->button_size !!}">{{ $schema->submit_text or "Aceptar" }}</button>
                        {{-- <button type="reset" class="btn">Cancelar</button> --}}
                    </div>

                </form>
            </div>

        </div>
    </div>


</div>
{{--
<footer>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                Evento organizado por <strong><a href="http://www.maquiel.com.ar" target="_blank">Maquiel</a></strong>.
            </div>
        </div>

    </div>

</footer>
 --}}


 <div class="footer" style="--background-image:url('/storage/admin/{!!$item->footer_image!!}')">

     <div class="container">

         <div class="row">
             <div class="col-md-12">
                 <img class="footer-image" src="/storage/admin/{!!$item->footer_image!!}">
                 <br>
             </div>
         </div>

     </div>

 </div>




    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p>Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> --}}


@endsection


@section('extra-js')


    <script>


        $(document).ready(function () {


            // $('.phone').mask('(0000) 0000-0000').attr('placeholder','(0000) 0000-0000');

            $('.phone').attr('placeholder','característica + teléfono');


            // var options =  {
            //   onKeyPress: function(cep, e, field, options) {
            //     var masks = ['(000) 0000-0000', '(0000) 0000-0000'];
            //     var mask = (cep.length>14) ? masks[1] : masks[0];

            //     console.log(cep.length)

            //     $('.phone').mask(mask, options);
            // }};


            // var options =  {
            //   onKeyPress: function(cep, e, field, options) {
            //     var masks = ['(0000) 0000-0000', '(000) 0000-0000'];

            //     var car = cep.slice(1, 4);

            //     // console.log(car)

            //     var mask = ''
            //     if(cep.slice(1, 4)=='011'){
            //         mask =
            //     }

            //     var mask = (car=='011') ? masks[1] : masks[0];

            //     $('.phone').mask(mask, options);
            // }};

            // $('.phone').mask('(000) 0000-0000', options);




            $('#form').validate({
                rules: {

                    @foreach($fields as $field)

                        {{$field->id_name}}: {

                            @if ($field->is_required)
                                required: true,
                            @endif

                            @if ($field->type=='email')
                                email: true,
                            @endif
                        },

                    @endforeach

                    // name: {
                    //     minlength: 2,
                    //     required: true
                    // },
                    //email: {
                    //     required: true,
                    //     email: true
                    // },
                    //     email: {
                    //     required: true,
                    //     email: true
                    // },
                    // subject: {

                    //     required: true
                    // }
                },
                highlight: function (element) {
                    $(element).closest('.control-group').removeClass('success').addClass('error');
                },
                success: function (element) {
                    element.text('OK!').addClass('valid')
                        .closest('.control-group').removeClass('error').addClass('success');
                },
                submitHandler: function(form) {


                    swal({
                      title: '{!!$item->confirm_title!!}',
                      html: '{!!$item->confirm_content!!}',
                      confirmButtonText: '{!!$item->confirm_button_ok!!}',
                      cancelButtonText: '{!!$item->confirm_button_cancel!!}',
                      showCancelButton: {!! ($item->confirm_button_cancel!='')?'true':'false'!!},
                      showLoaderOnConfirm: true,
                      closeOnCancel: true,
                      allowOutsideClick: true,
                      preConfirm: function () {
                        return new Promise(function (resolve, reject) {


                                $(form).ajaxSubmit({
                                    // data: function() {
                                    //   return $(this).serialize();
                                    // },
                                    // hideInvalid: function(input) {
                                    //   $(input).closest('.form-group').removeClass('has-warning');
                                    // },
                                    loader: '.form-loader',
                                    message: '.form-message',
                                    messageErrorClasses: 'message-error',
                                    messageSuccessClasses: 'message-success',
                                    // method: function() {
                                    //   return $(this).attr('method');
                                    // },
                                    // showInvalid: function(input) {
                                    //   $(input).closest('.form-group').addClass('has-warning');
                                    // },
                                    // url: function() {
                                    //   return $(this).attr('action');
                                    // },
                                    // after: function(response) {
                                    // },
                                    // before: function() {
                                    // },
                                    error: function(response) {
                                        console.log(response)
                                        reject('Error al enviar formulario')
                                     },
                                    success: function(response) {
                                        console.log(response)

                                        if (typeof response === 'object') {
                                            if (response.status=='success') {
                                                resolve(response)
                                            } else {
                                                reject(response.message)
                                            }
                                        }

                                     }
                                });


                        })
                      },
                      allowOutsideClick: false
                    }).then(function (response) {

                        swal({
                            type: 'success',
                            title: response.message,
                            html: response.content,
                            confirmButtonText: '{!!$item->success_button_ok!!}',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnConfirm: false, //It does close the popup when I click on close button
                            closeOnCancel: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(function () {

                            var url = '{!!$item->success_button_ok_action!!}';
                            if(url!=''){
                                window.location = url;
                            }
                            else{
                                document.getElementById("form").reset();
                            }

                        })

                    })


                }
            });

        });


    </script>

@endsection

