# База автомобилей для Laravel

Данный пакет позволяет удобно использовать базу данных автомобилей в ваших проектах, реализовывать поисковые подсказки, привязку автомобиля к вашим моделям и т.д.

В пакет входит только пример структуры базы, сама база автомобилей не входит в пакет, а приобретается отдельно на сайте https://auto.basebuy.ru/.

На данный момент пакет **не поддерживает** характеристики автомобилей и REST API базы данных транспортных средств Basebuy.ru

## Сожержание
* Установка
    * Импорт базы
* Использование

## Установка
Вы можете установить данный пакет с помощью oomposer:

```
composer require bigperson/auto-base-buy
```

Далее необходимо зарегистровать новый сервис-провайдер в config/app.php:

```php
...
'providers' => [
    ...
     Bigperson\AutoBaseBuy\AutoBaseBuyServiceProvider::class,
],
...
```

### Ипорт базы автомобилей
Сначала необходимо создать необходимые таблицы в базе данных, для этого импортируйте файлы миграций из пакета используя artisan:

```
 php artisan vendor:publish --tag=migrations --provider=Bigperson\AutoBaseBuy\AutoBaseBuyServiceProvider
```
После чего необходимо применить миграции:
```
php artisan migrate
```

Далее необходимо импортировать seeds:

```
 php artisan vendor:publish --tag=seeds --provider=Bigperson\AutoBaseBuy\AutoBaseBuyServiceProvider
```

И перегененрировать autoload.php: `composer dump-autoload`

В database/csv/* создадутся csv файлы для иморта. Их необходимо будет заменить на оригинальные, после покупки на https://auto.basebuy.ru/.

Далее необходимо применить seeds:
```
php artisan db:seed --class=AutoBusyBuySeeder
```

## Использование

Использовать пакет достаточно просто. Вы можете вызывать модели в контроллерах:
```php
namespace App\Http\Controllers;

use Bigperson\AutoBaseBuy\Models\CarMark;

class Controller
{
    protected function show($id){

        $mark = CarMark::findOrFail($id);
        
    }
}
```

Связывать свои модели с автомобилями по марке, модели, серии, и т.д., предварительно конечно нужно определиться с типом связи и создать необходимые таблицы или столбцы в таблицах ваших моделей:

```php
namespace App;

use Bigperson\AutoBaseBuy\Models\CarModification;

class User extends Model
{
     public function car()
     {
         return $this->belongsTo(CarModification::class, 'id_car_modification');
     }
}
```

Также вы можете можете переопределить модели и расширить их, например добавив аксессор:
```php
namespace App;

use Bigperson\AutoBaseBuy\Models\CarModification as BaseCarModification;

class CarModification extends BaseCarModification
{
    /**
     * Получить полное название автомобиля, включая марку, модель, годы выпуска, серию
     * @return string
     */
    public function getFullNameAttribute()
    {
        $string = $this->carModel->carMark->name;
        $string .= ' '.$this->carModel->name;
        $string .= ' '.$this->carSerie->name;
        $string .= ' '.$this->carSerie->carGeneration->name;
        $string .= ' ('.$this->carSerie->carGeneration->year_begin.'-'.$this->carSerie->carGeneration->year_end.')';
        $string .= ' '.$this->name;

        return $string;
    }
}
```


##Лицензия

Данный пакет (не включая базу данных) является открытым кодом под лицензией [MIT license](https://opensource.org/licenses/MIT).

