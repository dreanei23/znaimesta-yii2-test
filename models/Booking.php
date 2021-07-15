<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Category;

class Booking extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'client_name' => 'ФИО',
            'client_email' => 'E-mail',
            'arrival_date' => 'Дата заезда',
            'departure_date' => 'Дата выезда'
        ];
    }

	public function rules()
	{
		return [
			[['client_name', 'client_email', 'arrival_date', 'departure_date'], 'required', 'message' => 'Обязательно для заполнения'],
            ['room_id', 'safe'],
            ['client_email', 'email', 'message' => 'Неверный формат']
		];
	}
}
