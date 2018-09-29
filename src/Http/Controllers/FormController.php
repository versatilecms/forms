<?php

namespace Versatile\Forms\Http\Controllers;

use Illuminate\Http\Request;
use Versatile\Forms\Actions\ViewEnquiriesAction;
use Versatile\Forms\Form;
use Versatile\Forms\FormInput;
use Versatile\Front\Helpers\Layouts;
use Versatile\Forms\Validators\FormValidators;
use Versatile\Core\Facades\Versatile;
use Versatile\Core\Http\Controllers\BaseController;

class FormController extends BaseController
{
    /**
     * Informs if DataType will be loaded from the database or setup
     *
     * @var bool
     */
    protected $dataTypeFromDatabase = false;

    public function setup()
    {
        $this->bread->setName('forms');
        $this->bread->setSlug ('forms');

        $this->bread->setDisplayNameSingular(__('versatile::seeders.data_types.form.singular'));
        $this->bread->setDisplayNamePlural(__('versatile::seeders.data_types.form.plural'));

        $this->bread->setIcon('versatile-documentation');
        $this->bread->setModel(Form::class);

        $this->bread->addAction(ViewEnquiriesAction::class);

        $this->bread->addDataRows([
            [
                'field' => 'id',
                'type' => 'number',
                'display_name' => 'id',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => []
            ],

            [
                'field' => 'title',
                'type' => 'text',
                'display_name' => 'title',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => []
            ],

            [
                'field' => 'mailto',
                'type' => 'text',
                'display_name' => 'mailto',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => []
            ],

            [
                'field' => 'hook',
                'type' => 'text',
                'display_name' => 'hook',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => []
            ],

            [
                'field' => 'layout',
                'type' => 'text',
                'display_name' => 'layout',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => []
            ],

            [
                'field' => 'email_template',
                'type' => 'text',
                'display_name' => 'email_template',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => []
            ],

            [
                'field' => 'message_success',
                'type' => 'text',
                'display_name' => 'message_success',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => []
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
                'details' => []
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
                'details' => []
            ],
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function create()
    {
        Versatile::canOrFail('add_forms');

        return view('versatile-forms::forms.edit-add', [
            'dataType' => $this->bread,
            'layouts' => Layouts::getLayouts('versatile-forms'),
            'emailTemplates' => Layouts::getLayouts('versatile-forms', 'email-templates'),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Versatile::canOrFail('add_forms');

        if ($request->input('hook')) {
            $validator = FormValidators::validateHook($request);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'message' => __('versatile::json.validation_errors'),
                        'alert-type' => 'error',
                    ]);
            }
        }

        // Create the form
        $form = Form::create($request->all());

        // Create some default inputs
        $inputs = [
            'name' => 'text',
            'email' => 'email',
            'phone' => 'text',
            'message' => 'text_area',
        ];
        $order = 1;
        foreach ($inputs as $key => $value) {
            FormInput::create([
                'form_id' => $form->id,
                'label' => ucwords(str_replace('_', ' ', $key)),
                'type' => $value,
                'required' => true,
                'order' => $order,
            ])->save();

            $order++;
        }

        return redirect()
            ->route('versatile.forms.edit', ['id' => $form->id])
            ->with([
                'message' => __('versatile::generic.successfully_added_new') . " {$this->bread->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        Versatile::canOrFail('read_forms');

        $form = Form::findOrFail($id);

        return view('versatile-forms::forms.edit-add', [
            'form' => $form,
            'layouts' => Layouts::getLayouts('versatile-forms'),
            'emailTemplates' => Layouts::getLayouts('versatile-forms', 'email-templates'),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        Versatile::canOrFail('edit_forms');

        $form = Form::findOrFail($id);

        return view('versatile-forms::forms.edit-add', [
            'dataType' => $this->bread,
            'form' => $form,
            'layouts' => Layouts::getLayouts('versatile-forms'),
            'emailTemplates' => Layouts::getLayouts('versatile-forms', 'email-templates'),
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Versatile::canOrFail('edit_forms');

        $form = Form::findOrFail($id);

        if ($request->input('hook')) {
            $validator = FormValidators::validateHook($request);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'message' => __('versatile::json.validation_errors'),
                        'alert-type' => 'error',
                    ]);
            }
        }

        $form->fill($request->all());
        $form->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_updated') . " {$this->bread->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }
}
