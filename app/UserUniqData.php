<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserUniqData extends Eloquent
{
    protected $collection = 'user_uniq_datas';
	protected $fillable = [
        'user_id','vehicle_id','on_mode_color_2','off_mode_color_2','button_title'
    ];
	
	
}
