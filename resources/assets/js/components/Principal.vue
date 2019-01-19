<template>
    <main  class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    
    <div class="container-fluid">
        <div class="card">
            <div>
                <i class="fa fa-align-justify"></i> Principal
            </div>
            <div class="card-body">
                <div class="row">
                    <p>
                    Realizar un Crud de Productos

                    La idea es realizar dos CRUD (create, read, update, delete) uno de productos y y el otro de categoría de productos en PHP, utilizando el Framework Symfony en su versión 2.8 o superior (Symfony 3.x o 4.x preferiblemente). Manejar la Base de Datos en Mysql o en SQLite. Además apreciamos que nos envíen el código usando un repositorio de Github.

                    Por favor no usar los comandos de symfony de creación de crud para efectos de este ejercicio.

                    Datos de los productos: id (entero), codigo (string), nombre (string), descripcion (string), marca (string), categoría (relación con la categoría de productos), precio  (float).
                    Datos de las categorías de productos: id  (entero), codigo (string), nombre (string), descripcion (string), activo (booleano).

                    Validaciones de los Productos:
                    Todos los campos son obligatorios.
                    El nombre y el código no pueden repetirse.
                    El código no puede contener caracteres especiales ni espacios
                    El código debe tener mínimo 4 caracteres y máximo 10.
                    El nombre debe contener mínimo 4 caracteres.
                    El precio debe ser un número válido.

                    Validaciones de las Categorías de productos:
                    Todos los campos son obligatorios.
                    El nombre y el codigo no pueden repetirse.
                    El código no puede contener caracteres especiales ni espacios.
                    El nombre debe contener mínimo 2 caracteres.

                    La aplicación debe Permitir:
                    Listar productos, solo mostrar los productos de categorías de producto activas. (Paginar los productos es un Plus o Adicional).
                    Filtrar productos.
                    Ordenar por columna (Opcional, es un plus).
                    Crear Productos (Solo deben poder seleccionarse categorías activas al crear productos).
                    Editar Productos  (Solo deben poder seleccionarse categorías activas al editar productos).
                    Eliminar Productos (El usuario debe confirmar esta acción, es decir, se le debe preguntar al usuario si está seguro de que desea eliminar el producto).
                    Listar Categorías de productos.
                    Crear Categoría de Producto.
                    Editar Categoría de Producto.
                    Acción de Activar Categoría de Producto.
                    Acción de Desactivar Categoría de Producto.Trabajar con bootstrap css o cualquier otro. 

                    Adicionalmente (No es requerido) sería interesante contar con los siguientes Test:

                    Crear tests (unitarios o de integracion) para los servicios que creen.
                    Crear tests (unitarios o integración) de las validaciones de las entidades.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </main>
</template>
<script>
export default {
    mounted(){
        console.log('Component mounted.')
    }
}
</script>
