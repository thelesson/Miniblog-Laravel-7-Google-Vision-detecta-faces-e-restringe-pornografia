<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Events\SettingUpdated;

use Jahondust\ModelLog\Traits\ModelLogging;

class Setting extends Model
{
    use ModelLogging;
    protected $table = 'settings';

    protected $guarded = [];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'updating' => SettingUpdated::class,
    ];
}
