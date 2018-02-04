
{!! Form::open(['url' => route('campaigns.save'), 'method' => 'post', 'pjax-container', 'class' => 'form-horizontal']) !!}

    <input type="hidden" name="campaign_id" value="{{$item->id}}"/>
    <input type="hidden" name="event_id" value="{{$item->event_id}}"/>
    <input type="hidden" name="type_id" value="{{$item->type_id}}"/>

    {{-- <div class="box-body"> --}}
        @if($item->event_id!=0)
            <div class="form-group">
                <label class="col-sm-2 control-label">Dentro de</label>
                <div class="col-sm-10 text-primary" style="padding-top: 7px;">
                   {{$item->event->name}}
                </div>
            </div>
        @endif

        <div class="form-group">
            <label class="col-sm-2 control-label">Tipo</label>
            <div class="col-sm-10 text-primary" style="padding-top: 7px;">
               {{$item->type->name}}
            </div>
        </div>

        <div class="fields-group">

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    {{-- <div class="input-group"> --}}
                        {{-- <span class="input-group-addon"><i class="fa fa-pencil"></i></span> --}}
                        <input type="text" id="name" name="name" value="{{$item->name}}" class="form-control name" placeholder="" autofocus style="width: 100%;"/>
                    {{-- </div> --}}
                </div>
            </div>


            @if($item->id!=0)
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        {{-- <div class="input-group"> --}}
                            {{-- <span class="input-group-addon"><i class="fa fa-pencil"></i></span> --}}
                            <input type="text" id="slug" name="slug" value="{{$item->slug}}" class="form-control" placeholder="" autofocus style="width: 100%;"/>
                        {{-- </div> --}}
                    </div>
                </div>

            @endif



            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" rows="5" placeholder="Entrada Description">{{$item->description}}</textarea>
                </div>
            </div>



        </div>

        <div class="form-group">
            <label for="type_id" class="col-sm-2 control-label">Formulario de destino</label>
            <div class="col-sm-10">
                <select class="form-control form_id" style="width: 100%;" name="form_id">
                    <option value="{{$item->getForm()->id}}" selected>{{$item->getForm()->name}}</option>
                    @foreach($forms as $form)
                        @if($item->form_id!=$form->id)
                            <option value="{{$form->id}}">{{$form->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

   {{--  </div>

    <div class="box-footer">


        <div class="2">

        </div>
        <div class="8">

            <div class="btn-group pull-right">
                <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Enviar">Enviar</button>
            </div>

        </div>

    </div>
 --}}
{!! Form::close() !!}

<script data-exec-on-popstate>

    console.log('Subscript executed..');

    $(function () {

        $('input[name="name"]').keypress(function(e){
              // if(e.keyCode==13){
              //   $(this).closest('form').submit();
              // }
        }).focus();




       fieldComponents();


    });



    function fieldComponents(){



    }

</script>