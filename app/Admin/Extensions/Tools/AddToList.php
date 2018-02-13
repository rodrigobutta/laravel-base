<?php

namespace App\Admin\Extensions\Tools;

use RodrigoButta\Admin\Grid\Tools\BatchAction;

class AddToList extends BatchAction
{
    protected $action;

    public function __construct($action = 1)
    {
        $this->action = $action;
    }

    public function script()
    {
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {



    const {value: country} = await swal({
      title: 'Select Ukraine',
      input: 'select',
      inputOptions: {
        'SRB': 'Serbia',
        'UKR': 'Ukraine',
        'HRV': 'Croatia'
      },
      inputPlaceholder: 'Select country',
      showCancelButton: true,
      inputValidator: (value) => {
        return new Promise((resolve) => {
          if (value === 'UKR') {
            resolve()
          } else {
            resolve('You need to select Ukraine :)')
          }
        })
      }
    })

    if (country) {
      swal('You selected: ' + country)


          $.ajax({
              method: 'post',
              url: '{$this->resource}/release',
              data: {
                  _method:'put',
                  _token:LA.token,
                  ids: selectedRows(),
                  action: {$this->action}
              },
              success: function (data) {
                  $.pjax.reload('#pjax-container');


                  if (typeof data === 'object') {
                      if (data.status) {
                          swal(data.message, '', 'success');
                      } else {
                          swal(data.message, '', 'error');
                      }
                  }

              }
          });

    }




});

EOT;

    }
}