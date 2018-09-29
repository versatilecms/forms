<?php

namespace Versatile\Forms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Versatile\Forms\Form;
use Versatile\Forms\Enquiry;
use Versatile\Forms\Mail\Enquiry as EnquiryMailable;
use Versatile\Front\Helpers\ClassEvents;
use Versatile\Core\Facades\Versatile;
use Versatile\Core\Http\Controllers\BaseController;

class EnquiryController extends BaseController
{
    /**
     * Informs if DataType will be loaded from the database or setup
     *
     * @var bool
     */
    protected $dataTypeFromDatabase = false;

    public function setup()
    {
        $this->bread->setName('enquiries');
        $this->bread->setSlug('enquiries');

        $this->bread->setDisplayNameSingular(__('versatile::seeders.data_types.enquiry.singular'));
        $this->bread->setDisplayNamePlural(__('versatile::seeders.data_types.enquiry.plural'));

        $this->bread->setIcon('versatile-mail');
        $this->bread->setModel(Enquiry::class);

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
                'display_name' => 'Form ID',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'data',
                'type' => 'text',
                'display_name' => 'Data',
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'mailto',
                'type' => 'text',
                'display_name' => 'Mailto',
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'ip_address',
                'type' => 'text',
                'display_name' => 'IP Address',
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
                'display_name' => 'Created At',
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
                'display_name' => 'Updated At',
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create()
    {
        Versatile::canOrFail('add_enquiries');

        return view('versatile-forms::enquiries.edit-add', [
            'dataType' => $this->bread,
        ]);
    }

    /**
     * This submit method is triggered by any front-end forms generated
     * with a shortcode - when a user submits the form it will dynamically
     * trigger a series of events that are associated with this specific form.
     *
     * Woah-ho-ho it's magic! Ya'know... never believe it ain't so.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submit(Request $request)
    {
        $form = Form::findOrFail($request->id);
        $formData = $request->except(['_token', 'id', 'g-recaptcha-response']);

        // Check if reCAPTCHA is on & verify
        if (setting('admin.google_recaptcha_site_key')) {
            $this->verifyCaptcha($request);
        }

        // Execute the hook
        if ($form->hook) {
            ClassEvents::executeClass($form->hook, $formData);
        }

        // The recipients
        if (empty($form->mailto)) {
            $form->mailto = !empty(setting('forms.default_to_email'))
                ? setting('forms.default_to_email')
                : 'contact@example.com';
        }

        // The from address
        $form->mailfrom = !empty(setting('forms.default_from_email'))
            ? setting('forms.default_from_email')
            : 'contact@example.com';

        // The from name (eg. site address)
        $form->mailfromname = !empty(setting('site.title'))
            ? setting('site.title')
            : 'Website';

        // Save the enquiry to the DB
        $enquiry = Enquiry::create([
            'form_id' => $form->id,
            'data' => $formData,
            'mailto' => $form->mailto,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
        ])->save();

        // Debug/Preview the email
        // return (new EnquiryMailable($form, $formData))->render();

        // Send the email
        Mail::to(array_map('trim', explode(',', $form->mailto)))
            ->send(new EnquiryMailable($form, $formData));

        return redirect()
            ->back()
            ->with('success', $form->message_success);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        Versatile::canOrFail('read_enquiries');

        $enquiry = Enquiry::findOrFail($id);

        return view('versatile-forms::enquiries.view', [
            'dataType' => $this->bread,
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        Versatile::canOrFail('edit_enquiries');

        $enquiry = Enquiry::findOrFail($id);

        return view('versatile-forms::enquiries.edit-add', [
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Versatile::canOrFail('edit_enquiries');

        $dataType = $this->bread;

        return redirect('versatile-forms::enquiries.index')
            ->with([
                'message' => __('versatile::generic.successfully_updated') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /**
     * Verify the reCAPTCHA response with Google
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function verifyCaptcha(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $guzzleRequest = new \GuzzleHttp\Psr7\Request('POST', 'https://www.google.com/recaptcha/api/siteverify');
        $response = $client->send($guzzleRequest, [
            'secret' => setting('admin.google_recaptcha_secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ]);

        if ($response->getStatusCode() !== 200) {
            return redirect()
                ->back()
                ->with('error', 'Unable to validate Google reCAPTCHA');
        }
    }
}
