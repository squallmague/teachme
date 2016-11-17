<?php
//la clase Faker\Factory es laque nos permite crear nuevos fakers o datos ficticios.
use Faker\Factory as Faker;
use Faker\Generator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder{

	protected static $pool = array();

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

    	return $this->addToPool($this->getModel()->create($values));
    }

    protected function createFrom($seeder, array $customValues = array())
    {
    	$seeder = new $seeder;
    	return $seeder->create($customValues);
    }

    protected function getRandom($model)
    {
    	//primero se verifica que el modelo y la colección existan, si no se le envía un mensaje al programador.
    	if (! $this->collectionExist($model))
    	{
    		throw new Exception("the $model collection does not exist");
    		
    	}

    	//con el método random disponible en la colección podemos traer un ítem aleatorio.
    	return static::$pool[$model]->random();
    }

    private function addToPool($entity)
    {
    	//usamos las clase de php ReflectionClass y le pasamos la clase como argumento
    	$reflection = new ReflectionClass($entity);
    	//luego llamamos al método getShortName() para obtener el nombre de la clase sin el namespace completo.
    	$class = $reflection->getShortName();

    	//compruebo si ya hay una colección para la clase
    	if (! $this->collectionExist($class))
    	{
    		//si no hay,la creo como una colección de elocuent utilizando el objeto Collection de laravel.
    		//este objeto permite trabajar con la colección como si fuera un array pero con unos métodos adicionales.
    		static::$pool[$class] = new Collection();
    	}

    	//despues de tener nuestra coleccion se llama al metodo add() para agregar cada una de las nuevas entidades que vayamos registrando con los seeders
    	static::$pool[$class]->add($entity);

    	return $entity;
    }

    //creamos esta clase ya que la comprobación se usa tanto en el método getRandom() como en el método addToPool()
    private function collectionExist($class)
    {
        return isset(static::$pool[$class]);
    }

}