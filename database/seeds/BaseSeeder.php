<?php
//la clase Faker\Factory es laque nos permite crear nuevos fakers o datos ficticios.
use Faker\Factory as Faker;

// la clase Faker\Generator es la que llama al método Faker::create() del Faker\Factory.
use Faker\Generator;
use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder{

	protected function createMultiple($total, array $customValues = array())
    {
        for ($i = 1; $i <= $total; $i++) {
            $this->create($customValues);
        }
    }

    abstract public function getModel();
    abstract public function getDummyData(Generator $faker, array $customValues = array());

    protected function create(array $customValues = array())
    {
    	$values = $this->getDummyData(Faker::create(), $customValues);

    	//los valores que obtengo tienen como prioridad los $customValues enviados, sobre los datos de faker.
    	$values = array_merge($values, $customValues);

    	return $this->getModel()->create($values);
    }

    protected function createFrom($seeder, array $customValues = array())
    {
    	$seeder = new $seeder;
    	return $seeder->create($customValues);
    }

}