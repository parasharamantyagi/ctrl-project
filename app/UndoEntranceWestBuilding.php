<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UndoEntranceWestBuilding extends Eloquent
{
    protected $collection = 'undo_entrance_west_buildings';
	protected $fillable = [
        'user_id', 'entrance_west_building_id','on_mode_color_1', 'on_mode_color_2', 'on_mode_align_text','is_copy','sequence_name','sequence_text',
		'off_sequence_text','sequence_key','off_mode_color_1', 'off_mode_color_2', 'off_mode_align_text',
		'led_motor_config','on_mode_image','off_mode_image','sequence_number','button_title'
    ];
	
	
}
