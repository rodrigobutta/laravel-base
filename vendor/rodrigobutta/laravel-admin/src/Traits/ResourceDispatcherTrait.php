<?php

namespace RodrigoButta\Admin\Traits;

use Illuminate\Support\Facades\Input;

trait ResourceDispatcherTrait
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $this->form()->update($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->form()->destroy($id)) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $data = Input::all();

        // TODO cambiar esta logica. Analizo los parametros de entrada del POST (store) y determino si debe actuar el form por elemento unico o bien el grid por multiple como un sort
        if(isset($data["_sortable"])){
            return $this->grid()->store();
        }
        else{
            return $this->form()->store();
        }


    }
}
