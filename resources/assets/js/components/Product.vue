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
                <i class="fa fa-align-justify"></i> Productos
                <button type="button" @click="openModal('product','add')" class="btn btn-secondary" >
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
                              <option value="brand">Marca</option>
                              <option value="price">Precio</option>
                            </select>
                            <input type="text" v-model="search" @keyup.enter="productList(1,search,criteria)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="productList(1,search,criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in arrayProduct" :key="product.id">
                            <td>
                                <button type="button" @click="openModal('product','update',product)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                    <button type="button" class="btn btn-info btn-sm" @click="deleteProduct(product.id)">
                                         <i class="icon-trash"></i>
                                    </button>
                                
                                
                            </td>
                            <td v-text="product.code"></td>
                            <td v-text="product.name"></td>
                            <td v-text="product.category_name"></td>
                            <td v-text="product.description"></td>
                            <td v-text="product.brand"></td>
                            <td v-text="product.price"></td>
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
                            <label class="col-md-3 form-control-label" for="text-input">Categoría</label>
                            <div class="col-md-9">
                                <multiselect v-model="category" label="name" placeholder="Seleccione una categoría" :options="arrayCategory" :searchable="true" :allow-empty="false">
                                </multiselect>
                            </div>
                        </div>
                    <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Código</label>
                            <div class="col-md-9">
                                <input name="code" type="text" v-model="code" class="form-control" placeholder="Código de la categoría" v-validate="'required'">
                                <span v-if="errorProduct" class=" help-block">
                                    <strong>{{ errorProduct.code }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="name" class="form-control" placeholder="Nombre de categoría">
                                <span v-if="errorProduct" class=" help-block">
                                    <strong>{{ errorProduct.name }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="text" v-model="description" class="form-control" placeholder="ingrese descripcion">
                                <span v-if="errorProduct" class=" help-block">
                                    <strong>{{ errorProduct.description }}</strong>
                                </span>
                            </div>
                        </div>

                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModdal()" >Cerrar</button>
                    <button type="button" class="btn btn-primary" v-if="typeAction==1" @click="addProduct()">Guardar</button>
                    <button type="button" class="btn btn-primary" v-if="typeAction==2" @click="updateProduct()">Actualizar</button>
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
import VeeValidate from 'vee-validate';
import Multiselect from 'vue-multiselect';
Vue.use(VeeValidate);
    export default {
        components:{Multiselect},
        data(){
            return{
                product_id:0,
                code:'',
                name:'',
                category_name:'',
                category:[],
                description:'',
                brand:'',
                price:0,
                active:1,
                arrayCategory:[],
                arrayProduct:[],
                modal:0,
                titleModal:'',
                typeAction:0,
                errorProduct:{},
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

            productList(page,search,criteria){
                let me=this;
                var url='/product?page='+page+'&search='+search+'&criteria='+criteria;
                axios.get(url).then(function(response){
                    var response_data=response.data;
                    me.arrayProduct=response_data.product.data;
                    me.pagination=response_data.pagination;
                }).catch(error=>{
                    console.log(error);
                });

            },
            selectCategory(){
                let me=this;
                var url = '/category/selectCategory';
                axios.get(url).then(function(response){
                    var response_data=response.data;
                    me.arrayCategory=response_data.category;

                });
            },
            changePage(page,search,criteria){
                let me=this;
                //actualiza la pagina actual
                me.pagination.current_page=page;
                //envia la peticion para visualizar la data de esa pagina
                me.productList(page,search,criteria);
            },
            addProduct(){
               
                let me=this;
                axios.post('/product/store',{
                    'code':this.code,
                    'name':this.name,
                    'description':this.description,
                    'brand':this.brand,
                    'price':this.price,
                    'category_id':this.category_id,
                }).then(function(response){
                    toastr.success("Producto Agregada Correctamente"); 
                    me.cerrarModdal();
                    me.productList(1,'','name');
                   
                }).catch(error=>{this.errorProduct=error.response.data.errors});
            },
            updateProduct(){
                 
                let me=this;
                axios.put('/product/update',{
                    'code':this.code,
                    'name':this.name,
                    'description':this.description,
                    'brand':this.brand,
                    'price':this.price,
                    'category_id':this.category_id,
                    'id':this.product_id,
                }).then(function(response){
                    toastr.info("Categoria Actualizada Correctamente");
                    me.cerrarModdal();
                    me.productList(1,'','name');
                }).catch(error=>{this.errorProduct=error.response.data.errors});
            },
            openModal(model,action,data=[]){
                switch(model){
                    case "product":
                    {
                        switch(action){
                            case 'add':
                            {
                                this.modal=1;
                                this.titleModal='Registrar Categoria';
                                this.name='';
                                this.category_name='';
                                this.code='';
                                this.description=''; 
                                this.brand='';
                                this.price=0;  
                                this.typeAction=1; 
                                this.errorProduct={};                 
                                break;
                            }
                            case 'update':
                            {
                                this.modal=1;
                                this.titleModal='Actualizar Categoria';
                                this.typeAction=2;
                                this.brand=data['brand'];
                                this.price=data['price']; 
                                this.code=data['code'];
                                this.name=data['name'];
                                this.description=data['description'];
                                this.category_id=data['category_id'];
                                this.product_id=data['id'];
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
                this.category_name='';
                this.code='';
                this.description=''; 
                this.brand='';
                this.price=0;  
                this.typeAction=1; 
                this.errorProduct={}; 

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
                                
                                me.productList(1,'','name');
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
                                
                                me.productList(1,'','name');
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
            
        },
        mounted() {
            this.productList(1,this.search,this.criteria);
            this.selectCategory();
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