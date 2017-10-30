<div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-share-alt-square"></i>

              <h3 class="box-title">Campos Completados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                @foreach($fields as $field)
                    <dt>{{$field->title}}</dt>
                    <dd>{{$field->value}}</dd>
                @endforeach
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Usuario unificado</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                @foreach($userfields as $field)
                    <dt>{{$field->title}}</dt>
                    <dd>{{$field->value}}</dd>
                @endforeach
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div>