# DEMO

## #19  Implementar un sistema de registros

* Se ha implementado un sistema de registros con 4 ficheros.

| file        | description                                             |
|-------------|---------------------------------------------------------|
| dev         | Registro general del framework                          | 
| generator   | Registro del componente que convierte PDF a texto       |
| reader      | Registro del componente que interpreta el texto         |
| http_client | Registro del componente que realiza las peticiones HTTP |

* Los registros se almacenan en formato logstash, que posteriormente son parseados a través de un sistema ELK.

## #20  Implementar un sistema de cache de peticiones HTTP

* Se ha implementado un sistema de caché HTTP, para evitar lanzar continuamente las mismas peticiones y superar así los
  límite de uso.

## #12 Implementar de un módulo de lectura automática de texto

* Hemos implementado una versión inicial de este sistema, que funciona para los modelos de ejemplo.
* Es necesario que ampliar el conjunto de datos de prueba antes de aprobarlo para su utilización en un entorno de
  producción.
