<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Container;

class ContainerType extends Model
{
	protected $table = 'container_type';

	public function containers()
    {
        return $this->belongsTo(Container::class, 'container_type', 'id');
    }

}
