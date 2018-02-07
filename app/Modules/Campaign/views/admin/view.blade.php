
    <dl class="dl-horizontal">
        <dt>Campaña</dt>
        <dd>{{$item->name}}</dd>
        <dt>Tipo</dt>
        <dd>{{$item->type->name}}</dd>
        <dt>Código</dt>
        <dd>{{$item->slug}}</dd>
        @if($item->type->social_title)
            <dt>Título</dt>
            <dd>{{$item->type->social_title}}</dd>
        @endif
        @if($item->type->social_description)
            <dt>Contenido</dt>
            <dd>{{$item->type->social_description}}</dd>
        @endif
    </dl>


<script data-exec-on-popstate>

    console.log('Subscript executed..');

    $(function () {

    });

</script>