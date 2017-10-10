@extends('front/master/index')
{{--
@section('meta')

    <meta name="description" content="{!! $item->getDescription() !!}">
    <meta name="keywords" content="{!! $item->getKeywords() !!}">

    <meta property="og:title" content="{!! str_replace('"', '', strip_tags($item->title)) !!} - {!! siteSettings('siteName') !!}"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:description" content="{!! str_replace('"', '', $item->getOgDescription()) !!}"/>
    <meta property="og:image" content="{{ $item->getOgImage() }}"/>

@overwrite --}}

@section('content')


<div class="form-loader">
  LOADERRRR
</div>
<div class="form-message"></div>


    <div class="hero-unit">
         <h1>{{$item->name}}</h1>
        </br>
        <form method="POST" action="{!!route('form.view',['formslug'=>$item->slug])!!}" class="form-horizontal" id="form">
           {{--  {{ csrf_field() }}
            <meta name="csrf-token" content="{{ csrf_token() }}">
 --}}

{{--
            {!! var_dump($fields) !!} --}}

            @foreach($fields as $field)

                <div class="control-group">
                    <label class="control-label" for="{{$field->id_name}}">{{$field->title}}{!! $field->is_required ? ' <span class="required">*</span>' : '' !!}</label>
                    <div class="controls">


                    @if ($field->type == 'text' || $field->type == 'email')

                        <input type="text" name="{{$field->id_name}}" id="{{$field->id_name}}" placeholder="{{$field->placeholder}}">

                    @elseif ($field->type == 'textarea')

                        <textarea name="{{$field->id_name}}" id="{{$field->id_name}}" placeholder="{{$field->placeholder}}" rows="8" class="span5"></textarea>

                    @elseif ($field->type == 'select')

                        <select name="{{$field->id_name}}" id="{{$field->id_name}}" >
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



            <div class="form-actions">
                <button type="submit" class="btn btn-success">Aceptar</button>
                <button type="reset" class="btn">Cancelar</button>
            </div>

        </form>
    </div>




@endsection


@section('extra-js')


    {!! HTML::script('/vendor/front/jquery.mockjax.min.js') !!}
    {!! HTML::script('/vendor/front/jquery.validate.min.js') !!}
    {!! HTML::script('/vendor/front/additional-methods.js') !!}
    {!! HTML::script('/vendor/front/jquery.form.js') !!}


    <script>

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });


        $(document).ready(function () {


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

                        after: function(response) {
                            console.log(response)
                         },
                        before: function() {

                        },
                        error: function(response) {
                            console.log(response)
                         },
                        success: function(response) {
                            console.log(response)
                         }
                    });


                }
            });

        });


    </script>

@endsection

