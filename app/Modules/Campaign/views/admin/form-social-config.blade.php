
{!! Form::open(['url' => route('campaigns.config.social.save'), 'method' => 'post', 'pjax-container', 'class' => 'form-horizontal']) !!}

    <input type="hidden" name="campaign_id" value="{{$item->id}}"/>

    @if($item->event_id!=0)
        <div class="form-group">
            <label class="col-sm-2 control-label">Campaña</label>
            <div class="col-sm-10 text-primary" style="padding-top: 7px;">
               {{$item->form->name}} > {{$item->name}}
            </div>
        </div>
    @endif

    <div class="fields-group">

        <div class="form-group">
            <label for="social_title" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" id="social_title" name="social_title" value="{{$item->social_title}}" class="form-control" placeholder="" autofocus style="width: 100%;"/>
            </div>
        </div>

        <div class="form-group">
            <label for="social_description" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
                <textarea name="social_description" class="form-control" rows="5" placeholder="">{{$item->social_description}}</textarea>
            </div>
        </div>

    </div>

{!! Form::close() !!}

<script data-exec-on-popstate>

    console.log('Subscript executed..');

    $(function () {

    });

</script>