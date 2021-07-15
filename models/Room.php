<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Category;
use app\models\Booking;

class Room extends ActiveRecord
{

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getBooking()
    {
        return $this->hasMany(Booking::class, ['room_id' => 'id']);
    }

}
