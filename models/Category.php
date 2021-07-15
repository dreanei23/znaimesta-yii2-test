<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Room;

class Category extends ActiveRecord
{

    public $count_free_rooms;

    public function getRooms()
    {
        return $this->hasMany(Room::class, ['category_id' => 'id']);
    }
}
