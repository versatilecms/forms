<?php

namespace Versatile\Forms\Http\Controllers;

use Versatile\Forms\Form;
use Illuminate\Http\Request;
use Versatile\Forms\FormInput;
use Versatile\Core\Facades\Versatile;
use Versatile\Core\Http\Controllers\BaseController;

class InputController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Versatile::canOrFail('add_inputs');

        $dataType = $this->getDataType($request);
        $form = Form::findOrFail($request->input('form_id'));

        $form->inputs()->create($request->all())->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_added_new') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Versatile::canOrFail('edit_inputs');

        $formInput = FormInput::findOrFail($id);
        $dataType = $this->getDataType($request);

        $formInput->fill($request->all());
        $formInput->required = $request->has('required');
        $formInput->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_updated') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        Versatile::canOrFail('delete_inputs');

        $formInput = FormInput::findOrFail($id);
        $dataType = $this->getDataType($request);

        $formInput->delete();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_deleted') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /**
     * POST - Put inputs into order
     *
     * @param \Illuminate\Http\Request $request
     */
    public function order(Request $request)
    {
        $inputOrder = json_decode($request->input('order'));

        foreach ($inputOrder as $index => $item) {
            $input = FormInput::findOrFail($item->id);
            $input->order = $index + 1;
            $input->save();
        }
    }
}
