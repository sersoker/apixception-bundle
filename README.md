# Pccomponentes Apixception bundle

Esta librería es una pequeña ayuda para solucionar el renderizado de las excepciones que llegan al controlador, integrándolo con Symfony framework v4, en una aplicación de tipo API.
Las respuestas serán en formato JSON ( ``Symfony\Component\HttpFoundation\JsonResponse``).

## Instalación

 1. Descarga e instala el vendor usando [composer](https://getcomposer.org/).
```bash
$ composer require pccomponentes/apixception-bundle
```
2. Añadir el bundle en ``config\bundles.php``. Por ejemplo:
```bash
<?php  
  
return [  
 Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],  
  Pccomponentes\Apixception\ApixceptionBundle::class => ['all' => true]  
];
```
4. Configura el bundle con las excepciones la renderización que desees aplicar. Para ello, crea un archivo con nombre ``apixception.yml`` en la ruta ``config/packages``. Por ejemplo:
```yaml
apixception:  
  - exception: Pccomponentes\Apixception\Core\Exception\InvalidArgumentException  
    transformer: Pccomponentes\Apixception\Core\Transformer\SerializableTransformer  
    http_code: 400  
  - exception: Pccomponentes\Apixception\Core\Exception\NotFoundException  
    transformer: Pccomponentes\Apixception\Core\Transformer\SerializableTransformer  
    http_code: 404  
  - exception: Pccomponentes\Apixception\Core\Exception\ExistsException  
    transformer: Pccomponentes\Apixception\Core\Transformer\SerializableTransformer  
    http_code: 409  
  - exception: Pccomponentes\Apixception\Core\Exception\LogicException  
    transformer: Pccomponentes\Apixception\Core\Transformer\SerializableTransformer  
    http_code: 409  
  - exception: Pccomponentes\Apixception\Core\Exception\SerializableException  
    transformer: Pccomponentes\Apixception\Core\Transformer\SerializableTransformer  
    http_code: 412  
  - exception: \Throwable  
    transformer: Pccomponentes\Apixception\Core\Transformer\NoSerializableTransformer  
    http_code: 500
```

## Configuración

Este archivo debe contener un listado de reglas. Cada regla debe tener:

 - ``exception``: Nombre de la clase o interface, namespace incluído, que cumple con la excepción se quiere controlar.
 - ``http_code``: Código http del response.
 - ``transformer``: Clase que renderizará la excepción, namespace incluído.

## Creación de un transformer
Aunque la aplicación proporciona un par de transformadores básicos, y algún tipo de excepción genérica, se permite la adición de nuevas excepciones y transformadores.
Las excepción sólo deben ser del tipo ``\Throwable``. Y los transformes son clases que deben heredar de la clase ``Pccomponentes\Apixception\Core\Transformer\ExceptionTransformer``: Por cuestiones de simplicidad, no se permite usar inyecciones de dependencias, así que el constructor de esta clase debe estar vacío, ya que se instanciará sin argumentos mediante programación reflexiva.

Un ejemplo de un transformador propio sería:
```php
<?php
namespace MyApp\Transformers;

use Pccomponentes\Apixception\Core\Transformer\ExceptionTransformer;

class CustomTransformer extends ExceptionTransformer
{
	public function transform(\Throwable $exception): array
	{
		return [
			'exception' => get_class($exception),
			'message' => $exception->getMessage()
		];
	}
}

```
Si llega una interfaz personalizada, con métodos propios, puedes usarlos; aunque asegúrate en la configuración de que a tu transformador sólo le llegarán excepciones de ese tipo personalizado.

## Transformadores disponibles
La librería proporciona dos transformadores que puedes usar en cualquier momento.
 - ``Pccomponentes\Apixception\Core\Transformer\NoSerializableTransformer`` : Este transformador es capaz de renderizar cualquier tipo de excepción. En la respuesta meterá un objeto json con las propiedades  ``exception`` con el nombre de la excepción, y ``message``, con el mensaje de la excepción.
 - ``Pccomponentes\Apixception\Core\Transformer\SerializableTransformer``: Este transformador será capaz de renderizar cualquier excepción que implemente la interfaz ``Pccomponentes\Apixception\Core\Exception\SerializableException``, que obliga a implementar ``public function serialice(): array;``  El array que devuelva dicho método, será lo que se incluya en la respuesta.

## Excepciones
Como se ha comentado anteriormente, esta librería acepta excepciones de todo tipo. Pero además se proporciona una serie de excepciones genéricas que puedes usar.
 - Interfaz ``Pccomponentes\Apixception\Core\Exception\SerializableException``
 - Clase ``Pccomponentes\Apixception\Core\Exception\InvalidArgumentException``
 - Clase abstracta ``Pccomponentes\Apixception\Core\Exception\NotFoundException``
 - Clase abstracta ``Pccomponentes\Apixception\Core\Exception\ExistsException``
 - Clase abstracta ``Pccomponentes\Apixception\Core\Exception\LogicException``