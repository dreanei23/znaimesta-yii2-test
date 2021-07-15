<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Room;
use app\models\Booking;
use app\models\Category;
use Yii;
use yii\helpers\ArrayHelper;

class BookingController extends Controller
{


    public function actionIndex()
    {
        
        $booking = new Booking();

        if ($booking->load(Yii::$app->request->get())) {
            
            //делаем подзапрос
            $subBooking = Booking::find()
                        ->select(['booking.room_id'])
                        ->where(['between', 'booking.arrival_date', $booking->arrival_date, $booking->departure_date])
                        ->orWhere(['between', 'booking.departure_date', $booking->arrival_date, $booking->departure_date]);

            //делаем основной запрос
            $rooms = Room::find()
                ->with('category')
                ->joinWith('booking')
                ->where(['not in', 'room.id', $subBooking]);

            if (!empty(Yii::$app->request->get()['category_id'])) {
                $rooms = $rooms->andWhere(['category_id' => Yii::$app->request->get()['category_id']]);
            }

            $rooms = $rooms->all();

            //получим категории и кол-во свободных комнат
            $categories = Category::find()
                        ->select(['category.*, COUNT(category.id) as count_free_rooms'])
                        ->joinWith('rooms')
                        ->where(['not in', 'room.id', $subBooking])
                        ->groupBy('category.id')
                        ->all();

            // echo "<pre>"; var_dump($categories);exit;

            return $this->render('index', compact('booking', 'rooms', 'categories'));
        } else {
            
            return $this->render('index', compact('booking'));
        }
        
    }

    public function actionBook($id)
    {
        $booking = new Booking();

        $room = Room::findOne($id);

        if ($booking->load(Yii::$app->request->post()) && $booking->save()) {
            Yii::$app->session->setFlash('success', 'Комната забронирована! Номер брони: <b>' . $booking->id . "</b>");
            return $this->redirect(['booking/index']);
        } else {
            return $this->render('book', compact('room', 'booking'));
        }
        return $this->render('book');
    }
}