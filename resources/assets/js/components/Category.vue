<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Categorías
                <button type="button" @click="openModal('category','add')" class="btn btn-secondary" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criteria">
                              <option value="code">Código</option>
                              <option value="name">Nombre</option>
                              <option value="description">Descripción</option>
                            </select>
                            <input type="text" v-model="search" @keyup.enter="categoryList(1,search,criteria)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="categoryList(1,search,criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in arrayCategory" :key="category.id">
                            <td>
                                <button type="button" @click="openModal('category','update',category)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="category.active">
                                    <button type="button" class="btn btn-danger btn-sm" @click="disableCategory(category.id)">
                                         <i class="icon-trash"></i>
                                    </button>
                                </template>
                                 <template v-else>
                                    <button type="button" class="btn btn-info btn-sm" @click="enableCategory(category.id)">
                                         <i class="icon-bell"></i>
                                    </button>
                                </template>
                                
                            </td>
                            <td v-text="category.code"></td>
                            <td v-text="category.name"></td>
                            <td v-text="category.description"></td>
                            <div v-if="category.active">
                                <span class="badge badge-success">Activo</span>
                            </div>
                            <div v-else>
                                <span class="badge badge-danger">Desactivado</span>
                            </div>
                            
                        </tr>
                        
                    </tbody>
                </table>
                </div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page>1">
                            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page-1,search,criteria)">Ant</a>
                        </li>
                        <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active':'']">
                            <a class="page-link" href="#" @click.prevent="changePage(page,search,criteria)" v-text="page"></a>
                        </li>

                        <li class="page-item"  v-if="pagination.current_page<pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page+1,search,criteria)">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade"  tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titleModal"></h4>
                    <button type="button" class="close" @click="cerrarModdal()" aria-label="Close">
                      <span aria-hidden="true" >×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Código</label>
                            <div class="col-md-9">
                                <input type="text" v-model="code" class="form-control" placeholder="Código de la categoría">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="name" class="form-control" placeholder="Nombre de categoría">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="email" v-model="description" class="form-control" placeholder="ingrese descripcion">
                            </div>
                        </div>

                        <div v-show="errorCategoria" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModdal()" >Cerrar</button>
                    <button type="button" class="btn btn-primary" v-if="typeAction==1" @click="addCategory()">Guardar</button>
                    <button type="button" class="btn btn-primary" v-if="typeAction==2" @click="updateCategory()">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->

    <!-- Fin del modal Eliminar -->
    
</main>
</template>

<script>
    export default {
        data(){
            return{
                code:'',
                name:'',
                description:'',
                active:1,
                arrayCategory:[],
                modal:0,
                titleModal:'',
                typeAction:0,
                errorCategoria:0,
                errorMostrarMsjCategoria:[],
                category_id:0,
                pagination:{
                    'total':0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
                },
                offset:3,
                criteria:'name',
                search:'',
            }
        },
        computed:{
            isActived:function(){
                return this.pagination.current_page;
            },
            pagesNumber:function(){
                if (!this.pagination.to) {
                    return[];
                }
                var from =this.pagination.current_page-this.offset;
                if (from<1) {
                    from=1;
                }
                var to=from+(this.offset*2);
                if (to>=this.pagination.last_page) {
                    to=this.pagination.last_page;  
                }
                var pagesArray=[];
                while (from<=to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },

        },
        methods:{

            categoryList(page,search,criteria){
                let me=this;
                var url='/category?page='+page+'&search='+search+'&criteria='+criteria;
                axios.get(url).then(function(response){
                    var response_data=response.data;
                    me.arrayCategory=response_data.category.data;
                    me.pagination=response_data.pagination;
                }).catch(function(error){
                    console.log(error);
                });

            },
            changePage(page,search,criteria){
                let me=this;
                //actualiza la pagina actual
                me.pagination.current_page=page;
                //envia la peticion para visualizar la data de esa pagina
                me.categoryList(page,search,criteria);
            },
            addCategory(){
               
                let me=this;
                axios.post('/category/store',{
                    'code':this.code,
                    'name':this.name,
                    'description':this.description,
                    'active':this.active,
                }).then(function(response){
                    toastr.success("Categoria Agregada Correctamente"); 
                    me.cerrarModdal();
                    me.categoryList(1,'','name');
                   
                }).catch(function(error){
                    console.log(error)
                });
            },
            updateCategory(){
                 
                let me=this;
                axios.put('/category/update',{

                    'code':this.code,
                    'name':this.name,
                    'description':this.description,
                    'active':this.active,
                    'id':this.category_id,
                }).then(function(response){
                    toastr.info("Categoria Actualizada Correctamente");
                    me.cerrarModdal();
                    me.categoryList(1,'','name');
                }).catch(function(error){
                    console.log(error)
                });
            },
            openModal(model,action,data=[]){
                switch(model){
                    case "category":
                    {
                        switch(action){
                            case 'add':
                            {
                                this.modal=1;
                                this.titleModal='Registrar Categoria';
                                this.name='';
                                this.code='';
                                this.description='';   
                                this.typeAction=1;                  
                                break;
                            }
                            case 'update':
                            {
                                this.modal=1;
                                this.titleModal='Actualizar Categoria';
                                this.typeAction=2;
                                this.code=data['code'];
                                this.name=data['name'];
                                this.description=data['description'];
                                this.category_id=data['id'];
                                break;

                            }
                        }
                    }
                }
            },
            cerrarModdal(){
                this.modal=0;
                this.titleModal='';
                this.name='';
                this.description='';
                this.category_id=0;
                this.code='';

            },
            disableCategory(id){
                swal({
                        title: 'Estas seguro de desactivar esta categoría?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        reverseButtons: true
                        }).then((result) => {
                        if (result.value) {
                            let me=this;
                            axios.put('/category/disable',{
                                'id':id
                            }).then(function(response){
                                
                                me.categoryList(1,'','name');
                                swal(
                                'Desactivado!',
                                'El registro ha sido desactivado',
                                'success'
                                )
                            }).catch(function(error){
                                console.log(error)
                            });
                        
                        } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                        ) {
                        
                        }
                 })
            
            },
            enableCategory(id){
                 swal({
                        title: 'Estas seguro de activar esta categoría?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        reverseButtons: true
                        }).then((result) => {
                        if (result.value) {
                            let me=this;
                            axios.put('/category/enable',{
                                'id':id
                            }).then(function(response){
                                
                                me.categoryList(1,'','name');
                                swal(
                                'Activado!',
                                'El registro ha sido Activado',
                                'success'
                                )
                            }).catch(function(error){
                                console.log(error)
                            });
                        
                        } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                        ) {
                        
                        }
                 })
            },
            validarCategoria(){
                this.errorCategoria=0
                this.errorMostrarMsjCategoria=[];

                if (!this.name) {
                    this.errorMostrarMsjCategoria.push("el nombre de la categoria no puede estar vacio.")
                }
                if (this.errorMostrarMsjCategoria.length) {
                    this.errorCategoria=1;
                }
                return this.errorCategoria;
            },
        },
        mounted() {
            this.categoryList(1,this.search,this.criteria);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;    
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;

    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>