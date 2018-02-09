
{!! Form::open(['url' => route('campaigns.save'), 'method' => 'post', 'pjax-container', 'class' => 'form-horizontal']) !!}

    <input type="hidden" name="campaign_id" value="{{$item->id}}"/>
    <input type="hidden" name="event_id" value="{{$item->event_id}}"/>
    <input type="hidden" name="type_id" value="{{$item->type_id}}"/>


    <h3>Propiedades</h3>
    <p>El nombre de la campaña se usa de forma interna para identificar a la campaña dentro del administrador y el <strong>código</strong> es lapalabra que se utilizará en los links para identificar el origen de los mismos con la campaña</p>

    <div class="fields-group">

        <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" id="name" name="name" value="{{$item->name}}" class="form-control name" placeholder="" autofocus style="width: 100%;"/>
            </div>
        </div>

        @if($item->id!=0)

            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Código</label>
                <div class="col-sm-8">
                    <input type="text" id="slug" name="slug" value="{{$item->slug}}" class="form-control" placeholder="" autofocus style="width: 100%;"/>
                </div>
            </div>

        @endif

    </div>

    <h3>Origen</h3>
    <p>Seleccione desde donde se van a tomar las personas a enviar. El origen puede ser una lista de conversiones previas en el evento o bien, una lista de usuarios unificados. (no ambas)</p>

    <div class="form-group">
        <label for="destination_leadlist_id" class="col-sm-4 control-label">Lista</label>
        <div class="col-sm-8">
            <select class="form-control destination_leadlist_id" style="width: 100%;" name="destination_leadlist_id">
                <option value="">- ninguna -</option>
                @if($item->destinationLeadlist)
                    <option value="{{$item->destinationLeadlist->id}}" selected>{{$item->destinationLeadlist->fullname}}</option>
                @endif
                @foreach($item->event->leadlists as $l)

                    @if($item->destination_leadlist_id!=$l->id && !$l->isTest())
                        <option value="{{$l->id}}">{{$l->fullname}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="userlists" class="col-sm-4 control-label">Listas de Usuario</label>
        <div class="col-sm-8">
            <select class="form-control userlists" style="width: 100%;" name="userlists[]" multiple="multiple" >
                @foreach($item->userlists as $u)
                    <option value="{{$u->id}}" selected>{{$u->name}}</option>
                @endforeach
                @foreach(getUserlists()->diff($item->userlists) as $u)
                    <option value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <h3>Destino</h3>
    <p>Este elemento es opcional, ya que puede haber E-mails que tengan un CTA hacia un formulario o bien, pueden ser sólo informativos, en cuyo caso este campo deberá quedar vacio</p>

    <div class="form-group">
        <label for="type_id" class="col-sm-4 control-label">Formulario</label>
        <div class="col-sm-8">
            <select class="form-control form_id" style="width: 100%;" name="form_id">
                <option value="">- ninguno -</option>
                @if($item->form)
                    <option value="{{$item->form->id}}" selected>{{$item->getForm()->name}}</option>
                @endif
                @foreach($forms as $form)
                    @if($item->form_id!=$form->id)
                        <option value="{{$form->id}}">{{$form->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

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


        $(".userlists").select2({
            allowClear: true,
            placeholder: ""
        });


    }

</script>