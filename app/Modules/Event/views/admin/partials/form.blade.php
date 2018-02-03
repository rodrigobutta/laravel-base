
{!! Form::open(['url' => route('events.partials.save'), 'method' => 'post', 'class' => 'form-horizontal']) !!}

    {{-- <div class="box-body"> --}}

        <div class="fields-group">

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" id="name" name="name" value="" class="form-control name" placeholder="" autofocus style="width: 100%;"/>
                    </div>
                </div>
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