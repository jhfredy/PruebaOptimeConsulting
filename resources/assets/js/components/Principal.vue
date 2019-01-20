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
                    <p><strong>Realizar un Crud de Productos</strong></p>
                    <p style="text-align:justify">La idea es realizar dos CRUD (create, read, update, delete) uno de productos y y el otro de categoría de productos en PHP, utilizando el Framework Symfony en su versión 2.8 o superior (Symfony 3.x o 4.x preferiblemente). Manejar la Base de Datos en Mysql o en SQLite. Además apreciamos que nos envíen el código usando un repositorio de Github.</p>
                    <p><strong>Por favor no usar los comandos de symfony de creación de crud para efectos de este ejercicio.</strong></p>
                    <p style="text-align:justify">Datos de los productos: id (entero), codigo (string), nombre (string), descripcion (string), marca (string), categoría (relación con la categoría de productos), precio  (float).
                    Datos de las categorías de productos: id  (entero), codigo (string), nombre (string), descripcion (string), activo (booleano).</p>
                    <br>
                    <div class="row" style="text-align:justify;">
                        <div class="col-md-6">
                    <p>Validaciones de los Productos:</p>

                        <ul>
                        <li><strong>Todos los campos son obligatorios.</strong></li>
                        <li>El nombre y el código no pueden repetirse.</li>
                        <li>El código no puede contener caracteres especiales ni espacios</li>
                        <li>El código debe tener mínimo 4 caracteres y máximo 10.</li>
                        <li>El nombre debe contener mínimo 4 caracteres.</li>
                        <li>El precio debe ser un número válido.</li>
                    </ul>
                        </div>
                        <div class="col-md-6">
                            <p>Validaciones de las Categorías de productos:</p>
                    <ul>
                        <li><strong>Todos los campos son obligatorios.</strong></li>
                        <li>El nombre y el código no pueden repetirse.</li>
                        <li>El código no puede contener caracteres especiales ni espacios.</li>
                        <li>El nombre debe contener mínimo 2 caracteres.</li>
                    </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>La aplicación debe Permitir:</p>
                            <ul>
                                <li>Listar productos, solo mostrar los productos de categorías de producto activas. (Paginar los productos es un Plus o Adicional).</li>
                                <li>Filtrar productos.</li>
                                <li>Ordenar por columna (Opcional, es un plus).</li>
                                <li>Crear Productos (Solo deben poder seleccionarse categorías activas al crear productos).</li>
                                <li>Editar Productos  (Solo deben poder seleccionarse categorías activas al editar productos).</li>
                                <li>Eliminar Productos (El usuario debe confirmar esta acción, es decir, se le debe preguntar al usuario si está seguro de que desea eliminar el producto).</li>
                                <li>Listar Categorías de productos.</li>
                                <li>Crear Categoría de Producto.</li>
                                <li>Editar Categoría de Producto.</li>
                                <li>Acción de Activar Categoría de Producto.</li>
                                <li>Acción de Desactivar Categoría de Producto.Trabajar con bootstrap css o cualquier otro. </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Adicionalmente (No es requerido) sería interesante contar con los siguientes Test:</p> 
                            <ul>
                                <li>Crear tests (unitarios o de integracion) para los servicios que creen.</li>
                                <li> Crear tests (unitarios o integración) de las validaciones de las entidades.</li>
                            </ul>
                        </div>
                        
                    </div>
                   
                   
                <div class="row col-md-12">
                 <p><strong>Notas: </strong></p>   

                   <p> Manejar el código y base de datos en ingles, las pantallas en español.
                    La idea es que nos puedas estar enviando esto para el domingo al medio día.</p>

                    </div>
                    
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
