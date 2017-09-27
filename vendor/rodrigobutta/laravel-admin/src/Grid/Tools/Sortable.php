<?php

namespace RodrigoButta\Admin\Grid\Tools;

use RodrigoButta\Admin\Admin;
use RodrigoButta\Admin\Grid;

class Sortable extends AbstractTool
{
    /**
     * Create a new Export button instance.
     *
     * @param Grid $grid
     */
    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    /**
     * Set up script for export button.
     */
    protected function setUpScripts()
    {
        $resource = $this->grid->resource();


        $script = <<<EOT

        $( "table.table > tbody" ).sortable( {
            update: function( event, ui ) {

                var ids = [];
                var sorts = [];

                $(this).children().each(function(index) {
                    ids.push(  parseInt( $(this).attr('item-id')  ) );
                    sorts.push(  parseInt( $(this).attr('item-sort')  ) );
                });

                var min = sorts.reduce(function(a, b) {
                    return Math.min(a, b);
                });

                // $.post('{$resource}/sort', {
                $.post('{$resource}', {
                        _method:'POST',
                        _token:LA.token,
                        _sortable:true,
                        min:min,
                        ids: ids
                }, function(data){

                    if (data.status) {
                        // $.pjax.reload('#pjax-container'); // no necesito recargar porque se que la posición es la que acabo de dejar
                        toastr.success(data.message);
                    }

                });

            }
        });


EOT;

        Admin::script($script);
    }

    /**
     * Render Sortable.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->grid->isSortable()) {
            return '';
        }

        $this->setUpScripts();

        return <<<EOT

EOT;
    }
}
