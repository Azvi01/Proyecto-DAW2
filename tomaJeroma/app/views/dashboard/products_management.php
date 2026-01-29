<script>
    function prepareModal() {
        document.getElementById('form-id').value = '';
        document.getElementById('modal-title').innerText = 'Añadir Nuevo Producto';
        document.querySelector('form').reset();
    }

    function fillModal(p) {
        document.getElementById('modal-title').innerText = 'Editar Producto #' + p.id;
        document.getElementById('form-id').value = p.id;
        document.getElementById('form-name').value = p.name;
        document.getElementById('form-fab').value = p.fabricante;
        document.getElementById('form-desc').value = p.description;
        document.getElementById('form-price').value = p.base_price;
        document.getElementById('form-stock').value = p.stock;
        document.getElementById('form-cat').value = p.category_id;
        document.getElementById('form-cat').value = p.category_id;
    }
</script>

<div class="min-h-screen bg-base-300 flex flex-col lg:flex-row">

    <?php if (Session::get('error')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.getElementById("errorModal").showModal();
            });
        </script>
        <div>
            <dialog id="errorModal" class="modal text-xl">
                <div class="modal-box p-5">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                            ✕
                        </button>
                    </form>
                    <?= Session::get('error') ?>
                    <?php Session::delete('error'); ?>
                </div>
            </dialog>
        </div>
    <?php endif; ?>

    <div class="lg:w-72 bg-base-200 border-r border-base-100 p-6 flex flex-col gap-8">
        <div class="flex items-center gap-3 px-2">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary/20">
                TJ
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight">TomaJeroma</h1>
                <p class="text-[10px] uppercase tracking-widest opacity-50 font-bold">Panel Admin</p>
            </div>
        </div>

        <ul class="menu p-0 gap-2">
            <li>
                <a href="index.php?controller=Admin&action=index" class="active bg-primary/10 text-primary font-bold py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Inicio
                </a>
            </li>
            <li>
                <a href="index.php?controller=Admin&action=products" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Productos
                </a>
            </li>
            <li>
                <a href="index.php?controller=Pedido&action=listAll" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Pedidos
                </a>
            </li>
            <li>
                <a href="#" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Usuarios
                </a>
            </li>
        </ul>
    </div>

    <main class="flex-1 p-8 lg:p-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-white">Gestión de Productos</h2>
                <p class="text-sm opacity-50">Administra el inventario y precios de tu tienda</p>
            </div>
            <label for="modal-producto" class="btn btn-primary shadow-lg shadow-primary/20" onclick="prepareModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Añadir nuevo producto
            </label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="md:col-span-2">
                <form action="index.php?controller=Admin&action=search" method="post">
                    <input type="text" placeholder="Buscar por nombre o SKU..." class="input input-bordered w-full bg-base-200 border-base-100 focus:border-primary" name="buscar" required />
                </form>
            </div>
            <select class="select select-bordered bg-base-200 border-base-100">
                <option disabled selected>Categoría</option>
            </select>
            <select class="select select-bordered bg-base-200 border-base-100">
                <option disabled selected>Estado de Stock</option>
                <option>En Stock</option>
                <option>Poco Stock</option>
                <option>Agotado</option>
            </select>
        </div>

        <div class="bg-base-200 rounded-3xl shadow-xl overflow-hidden border border-base-100">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-base-100/50">
                        <tr class="text-slate-400 uppercase text-xs">
                            <th class="py-4">Producto</th>
                            <th>Fabricante</th>
                            <th>Precio Base</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-100">
                        <?php if (isset($error)): ?>
                            <tr>
                                <td colspan="6" class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-4 opacity-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-xl font-bold"><?= $error ?></span>
                                        <a href="index.php?controller=Admin&action=products" class="btn btn-outline btn-sm mt-2">Ver todos los productos</a>
                                    </div>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($productos as $p):
                                $stock = $p->getStockProduct();
                            ?>
                                <tr class="hover:bg-base-100/30 transition-colors">
                                    <td class="py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="avatar">
                                                <div class="mask mask-squircle w-12 h-12 bg-white">
                                                    <img src="<?= $p->getImgProduct() ?>" alt="<?= $p->getNameProduct() ?>" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold text-white"><?= $p->getNameProduct() ?></div>
                                                <div class="text-xs opacity-50">ID: #<?= $p->getIdProduct() ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="opacity-70"><?= $p->getFabricProduct() ?></td>
                                    <td class="font-bold"><?= number_format($p->getBasePriceProduct(), 2) ?> €</td>
                                    <td class="font-mono text-sm"><?= $stock ?> uds</td>
                                    <td>
                                        <?php if ($stock <= 0): ?>
                                            <span class="badge badge-error badge-outline font-bold text-[10px]">AGOTADO</span>
                                        <?php elseif ($stock < 10): ?>
                                            <span class="badge badge-warning badge-outline font-bold text-[10px]">POCO STOCK</span>
                                        <?php else: ?>
                                            <span class="badge badge-success badge-outline font-bold text-[10px]">ACTIVO</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <div class="flex justify-end gap-2">
                                            <label for="modal-producto"
                                                class="btn btn-square btn-ghost btn-sm text-info hover:bg-info/20"
                                                onclick='fillModal(<?= json_encode($p) ?>)'>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </label>

                                            <a href="index.php?controller=Admin&action=deleteProduct&id=<?= $p->getIdProduct() ?>"
                                                class="btn btn-square btn-ghost btn-sm text-error hover:bg-error/20"
                                                onclick="return confirm('¿Seguro que quieres eliminar este producto?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<input type="checkbox" id="modal-producto" class="modal-toggle" />
<div class="modal">
    <div class="modal-box bg-base-200 max-w-2xl">
        <h3 class="font-bold text-lg mb-6 text-white" id="modal-title">Gestión de Producto</h3>
        <form action="index.php?controller=Admin&action=saveProduct" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id" id="form-id">

            <div class="grid grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label"><span class="label-text">Nombre</span></label>
                    <input type="text" name="name" id="form-name" class="input input-bordered bg-base-300" required pattern=".*\S.*" title="El nombre no puede estar vacío">
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text">Fabricante</span></label>
                    <input type="text" name="fabricante" id="form-fab" class="input input-bordered bg-base-300" required pattern=".*\S.*">
                </div>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text">Descripción</span></label>
                <textarea name="description" id="form-desc" class="textarea textarea-bordered bg-base-300" required></textarea>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="form-control">
                    <label class="label"><span class="label-text">Precio Base</span></label>
                    <input type="number" step="0.01" min="0.01" name="price" id="form-price" class="input input-bordered bg-base-300" required>
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text">Stock</span></label>
                    <input type="number" min="0" name="stock" id="form-stock" class="input input-bordered bg-base-300" required>
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text">Categoría</span></label>
                    <select class="select select-bordered bg-base-200 border-base-100" name="category_id" id="form-cat" required>
                        <option value="" disabled selected>Selecciona...</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat->getId() ?>"><?= $cat->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Imagen del Producto</span>
                    <span class="label-text-alt text-error">* Requerido para nuevos</span>
                </label>
                <input type="file" name="img" id="form-img" class="file-input file-input-bordered file-input-primary w-full bg-base-300" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <div class="modal-action">
                <label for="modal-producto" class="btn btn-ghost">Cancelar</label>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>