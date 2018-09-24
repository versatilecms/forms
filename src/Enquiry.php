<?php

namespace Versatile\Forms;

use Versatile\Core\Models\BaseModel;

class Enquiry extends BaseModel
{
    protected $fillable = [
        'form_id',
        'data',
        'mailto',
        'ip_address',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function setMailToAttribute($value)
    {
        $this->attributes['mailto'] = serialize($value);
    }

    public function getMailToAttribute($value)
    {
        return unserialize($value);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = serialize($value);
    }

    public function getDataAttribute($value)
    {
        return unserialize($value);
    }
}
