
{!! Form::open(['url' => route('leadlist.edit.save'), 'method' => 'post', 'pjax-container', 'class' => 'form-horizontal']) !!}

    <input type="hidden" name="item_id" value="{{$item->id}}"/>

    <div class="fields-group">

        <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" id="name" name="name" value="{{$item->name}}" class="form-control name" placeholder="" autofocus style="width: 100%;"/>
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-4 control-label">Descripción</label>
            <div class="col-sm-8">
                <textarea class="form-control" name="description"  value="{{$item->description}}">{{$item->description}}</textarea>
            </div>



        </div>

    </div>

{!! Form::close() !!}

<script data-exec-on-popstate>

    console.log('Subscript executed..');

    $(function () {




    });



</script>