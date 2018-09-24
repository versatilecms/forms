<?php

namespace Versatile\Forms\Actions;

use Versatile\Core\Components\Actions\AbstractAction;

class ViewEnquiriesAction extends AbstractAction
{
    public function getTitle()
    {
        return 'View Enquiries';
    }

    public function getCodename()
    {
        return 'view-enquiries';
    }

    public function getIcon()
    {
        return 'versatile-eye';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-warning pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('versatile.enquiries.index', [
            'key' => 'id',
            'filter' => 'contains',
            's' => $this->data->{$this->data->getKeyName()}
        ]);
    }
}
