
{!! Form::open(['url' => route('campaigns.config.save'), 'method' => 'post', 'pjax-container', 'class' => 'form-horizontal']) !!}

    <input type="hidden" name="campaign_id" value="{{$item->id}}"/>




    <div class="fields-group">

        <div class="form-group">
            <label class="col-sm-2 control-label">Campaña</label>
            <div class="col-sm-10 text-primary">
               {{$item->form->name}} > {{$item->name}}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Lista de destino</label>
            <div class="col-sm-10 text-primary">
               {{$item->getDestinaionLeadlist()->fullname }}
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">Campos disponibles</label>
            <div class="col-sm-10 text-primary">

               <ul class="list-unstyled">
                   @foreach($item->getDestinaionLeadlist()->getFields() as $f)
                       <li data-id="{{$f->id_name}}">{{$f->title}}&nbsp;&rArr;&nbsp;<code>%recipient.{{$f->id_name}}%</code></li>
                   @endforeach

               </ul>

            </div>
        </div>



        <div class="form-group">
            <label for="social_title" class="col-sm-2 control-label">Asunto del Mail</label>
            <div class="col-sm-10">
                <input type="text" id="social_title" name="social_title" value="{{$item->social_title}}" class="form-control" placeholder="" autofocus style="width: 100%;"/>
            </div>
        </div>

        <div class="form-group">
            <label for="social_description" class="col-sm-2 control-label">Cuerpo del Mail</label>
            <div class="col-sm-10">
                <textarea name="social_description" class="form-control" rows="5" placeholder="">{{$item->social_description}}</textarea>
            </div>
        </div>

    </div>

{!! Form::close() !!}

<script data-exec-on-popstate>

    console.log('Subscript executed..');

    $(function () {

        $('textarea[name="social_description"]').ckeditor();

    });

</script>