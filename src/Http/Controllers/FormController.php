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
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions()
    {
        return [
            ViewEnquiriesAction::class
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function create(Request $request)
    {
        Versatile::canOrFail('add_forms');

        $dataTypeSlug = $this->getDataTypeSlug($request);
        $dataType = $this->getDataType($dataTypeSlug);

        return view('versatile-forms::forms.edit-add', [
            'dataType' => $dataType,
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

        $dataTypeSlug = $this->getDataTypeSlug($request);
        $dataType = $this->getDataType($dataTypeSlug);

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
                'required' => 1,
                'order' => $order,
            ])->save();

            $order++;
        }

        return redirect()
            ->route('versatile.forms.edit', ['id' => $form->id])
            ->with([
                'message' => __('versatile::generic.successfully_added_new') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        Versatile::canOrFail('edit_forms');

        $form = Form::findOrFail($id);
        $dataTypeSlug = $this->getDataTypeSlug($request);
        $dataType = $this->getDataType($dataTypeSlug);

        return view('versatile-forms::forms.edit-add', [
            'dataType' => $dataType,
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

        $dataTypeSlug = $this->getDataTypeSlug($request);
        $dataType = $this->getDataType($dataTypeSlug);
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
                'message' => __('versatile::generic.successfully_updated') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }
}
