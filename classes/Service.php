<?php

class Service {

    public $available = false;
    protected $type;
    private $price;


    //  constructor
    public function __construct()
    {
        $this->available = true;
    }

    public function __destruct()
    {
    }

    public static function all(){
        return  [
            ['name' => 'Consultation','price' => 500, 'days' => ['Sun', 'Mon'] ],
            ['name' => 'Training','price' => 200, 'days' => ['Tues', 'Wed'] ],
            ['name' => 'Design','price' => 100, 'days' => ['Thu', 'Fri'] ],
            ['name' => 'Coding','price' => 1000, 'days' => ['Sat', 'Fri'] ],
        ];
    }

    public function price($price){

        if($this->taxRate > 0){
            return $price + ($price * $this->taxRate);
        }

        return $price;

    }

}