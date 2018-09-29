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
     * Informs if DataType will be loaded from the database or setup
     *
     * @var bool
     */
    protected $dataTypeFromDatabase = false;

    public function setup()
    {
        $this->bread->setName('inputs');
        $this->bread->setSlug ('inputs');

        $this->bread->setDisplayNameSingular(__('versatile::seeders.data_types.input.singular'));
        $this->bread->setDisplayNamePlural(__('versatile::seeders.data_types.input.plural'));

        $this->bread->setIcon('versatile-documentation');
        $this->bread->setModel(FormInput::class);

        $this->bread->addDataRows([
            [
                'field' => 'id',
                'type' => 'number',
                'display_name' => 'ID',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'form_id',
                'type' => 'number',
                'display_name' => 'form_id',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'label',
                'type' => 'text',
                'display_name' => 'label',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'class',
                'type' => 'text',
                'display_name' => 'class',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'type',
                'type' => 'text',
                'display_name' => 'type',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'options',
                'type' => 'text',
                'display_name' => 'options',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'required',
                'type' => 'text',
                'display_name' => 'required',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'order',
                'type' => 'text',
                'display_name' => 'order',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'created_at',
                'type' => 'text',
                'display_name' => 'created_at',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'updated_at',
                'type' => 'text',
                'display_name' => 'updated_at',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],
        ]);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Versatile::canOrFail('add_inputs');

        $form = Form::findOrFail($request->input('form_id'));

        $form->inputs()->create($request->all())->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_added_new') . " {$this->bread->display_name_singular}",
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

        $formInput->fill($request->all());
        $formInput->required = $request->has('required');
        $formInput->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_updated') . " {$this->bread->display_name_singular}",
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

        $formInput->delete();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_deleted') . " {$this->bread->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }
}
