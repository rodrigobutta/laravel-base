<?php

namespace RodrigoButta\Admin\Grid\Displayers;

use RodrigoButta\Admin\Admin;

class Orderable extends AbstractDisplayer
{
    public function display()
    {
        if (!trait_exists('\Spatie\EloquentSortable\SortableTrait')) {
            throw new \Exception('To use orderable grid, please install package [spatie/eloquent-sortable] first.');
        }

        Admin::script($this->script());

        return <<<EOT

<div class="btn-group">
    <button type="button" class="btn btn-xs btn-info grid-row-orderable" data-id="{$this->getKey()}" data-direction="1">
        <i class="fa fa-caret-up fa-fw"></i>
    </button>
    <button type="button" class="btn btn-xs btn-default grid-row-orderable" data-id="{$this->getKey()}" data-direction="0">
        <i class="fa fa-caret-down fa-fw"></i>
    </button>

    <button type="button" class="btn btn-xs btn-default grid-sortable" data-sort="{$this->value}" data-id="{$this->getKey()}">
        <i class="fa fa-sort"></i>
    </button>
</div>

EOT;
    }

    protected function script()
    {
        return <<<EOT

            $('.grid-row-orderable').on('click', function() {

                var key = $(this).data('id');
                var direction = $(this).data('direction');

                $.post('{$this->getResource()}/' + key, {
                        _method:'PUT',
                        _token:LA.token,
                        _orderable:direction
                    }, function(data){
                    if (data.status) {
                        $.pjax.reload('#pjax-container');
                        toastr.success(data.message);
                    }
                });

            });


            $( "table.table > tbody" ).sortable( {
                update: function( event, ui ) {

                    var ids = [];
                    var sorts = [];

                    $(this).children().each(function(index) {
                        ids.push(  parseInt( $(this).find('.grid-sortable').attr('data-id')  ) );
                        sorts.push(  parseInt( $(this).find('.grid-sortable').attr('data-sort')  ) );
                    });

                    console.log(ids);
                    console.log(sorts);

                    var min = sorts.reduce(function(a, b) {
                        return Math.min(a, b);
                    });

                    console.log(min);

                    $.post('{$this->getResource()}/sort', {
                            _method:'POST',
                            _token:LA.token,
                            _sortable:true,
                            min:min,
                            ids: ids
                    }, function(data){

                        if (data.status) {
                            $.pjax.reload('#pjax-container');
                            toastr.success(data.message);
                        }

                    });

                }
            });

EOT;
    }
}
