<div class="row ">
    <div class="col-md-12">

       <div class="box box-default">
           <div class="box-header with-border">
               <h3 class="box-title">Seleccione el proyecto a administrar</h3>
           </div>
           <div class="box-body">

                <div class="table-responsive">
                     <table class="table table-striped">

                         @foreach($items as $item)
                         <tr>
                             <td><a href="{{ route('events.manage',[ 'itemId' => $item->id ]) }}">{{ $item->name }}</a></td>
                         </tr>
                         @endforeach
                     </table>
                </div>

           </div>
           <div class="box-footer">
                <a href="#" class="btn btn-success btn-new-event">Nuevo</a>
           </div>
       </div>


    </div>

</div>




<script type="text/javascript">

    console.log('>>>> navigator.blade.php scripts running')


    $(document).ready(function() {



    });

</script>
