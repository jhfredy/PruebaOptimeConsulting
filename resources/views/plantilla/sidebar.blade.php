<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
            </li>
            <li class="nav-title">
                Mantenimiento
            </li>
            <li @click="menu=0" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-blind"></i>Prueba</a>
            </li>
           
            <li @click="menu=1" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-book-open"></i>Categorias</span></a>
            </li>
            <li @click="menu=2" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-cart-plus"></i>Productos</span></a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>