<div class="modal fade" id="agregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="agregarProducto">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="categoria">Categoría</label>
                            <select class="form-control" id="categoria" v-model="producto.categoria" @change="getSubcategorias(producto.categoria)" required>
                                <option value="" disabled selected>Seleccione una categoría</option>
                                <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                                    @{{ categoria.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subcategoria">Subcategoría</label>
                            <select class="form-control" id="subcategoria" v-model="producto.subcategoria" required>
                                <option value="" disabled selected>Seleccione una subcategoría</option>
                                <option v-for="subcategoria in subcategorias" :key="subcategoria.id" :value="subcategoria.id">
                                    @{{ subcategoria.nombre }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" v-model="producto.nombre" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control-file" id="imagen" v-model="producto.imagen">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" v-model="producto.descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" v-model="producto.cantidad" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="costo">Costo</label>
                            <input type="number" class="form-control" id="costo" v-model="producto.costo" required>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>