<div class="min-h-screen bg-base-300 flex flex-col lg:flex-row">
     <!--MENU-->
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
                <a href="index.php?controller=Admin&action=index" class="hover:bg-base-100 py-3">
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
                <a href="index.php?controller=Admin&action=orders" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Pedidos
                </a>
            </li>
            <li>
                <a href="index.php?controller=Admin&action=users" class="active bg-primary/10 text-primary font-bold py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Usuarios
                </a>
            </li>
        </ul>
    </div>

    <main class="flex-1 p-4 lg:p-8">
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold">Gestión de Usuarios</h2>
            <p class="opacity-60">Control de acceso y roles del sistema.</p>
        </div>

        <div class="bg-base-200 p-4 rounded-2xl mb-8 flex flex-col md:flex-row gap-4 items-end">
            <form action="index.php" method="GET" class="contents">
                <input type="hidden" name="controller" value="Admin">
                <input type="hidden" name="action" value="users">
                
                <div class="form-control w-full">
                    <label class="label"><span class="label-text">Buscar Email</span></label>
                    <input type="text" name="email" placeholder="usuario@ejemplo.com" value="<?= $_GET['email'] ?? '' ?>" class="input input-bordered bg-base-100">
                </div>

                <div class="form-control w-full md:w-48">
                    <label class="label"><span class="label-text">Rol</span></label>
                    <select name="role" class="select select-bordered bg-base-100">
                        <option value="">Todos</option>
                        <option value="admin" <?= (isset($_GET['role']) && $_GET['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= (isset($_GET['role']) && $_GET['role'] == 'user') ? 'selected' : '' ?>>Usuario</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="index.php?controller=Admin&action=users" class="btn btn-ghost">Limpiar</a>
            </form>
        </div>

        <div class="bg-base-100 rounded-3xl shadow-xl overflow-hidden">
            <table class="table w-full">
                <thead>
                    <tr class="bg-base-200">
                        <th>ID</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr class="hover:bg-base-200/50">
                        <td>#<?= $u->id ?></td>
                        <td class="font-bold"><?= $u->mail ?></td>
                        <td>
                            <div class="badge <?= $u->role == 'admin' ? 'badge-secondary' : 'badge-ghost' ?> uppercase text-[10px] font-bold">
                                <?= $u->role ?>
                            </div>
                        </td>
                        <td class="text-right flex justify-end gap-2">
                            <button onclick="openEditModal(<?= htmlspecialchars(json_encode($u)) ?>)" class="btn btn-square btn-sm btn-info btn-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </button>
                            <a href="index.php?controller=Admin&action=deleteUser&id=<?= $u->id ?>" 
                               onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario? Esta acción no se puede deshacer.')" 
                               class="btn btn-square btn-sm btn-error btn-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<input type="checkbox" id="modal-user" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Editar Usuario</h3>
        <form action="index.php?controller=Admin&action=saveUser" method="POST" onsubmit="return confirm('¿Confirmas los cambios en este usuario?')">
            <input type="hidden" name="id" id="edit-id">
            
            <div class="form-control mb-4">
                <label class="label"><span class="label-text">Correo Electrónico</span></label>
                <input type="email" name="email" id="edit-email" class="input input-bordered" required>
            </div>

            <div class="form-control mb-4">
                <label class="label"><span class="label-text">Rol</span></label>
                <select name="role" id="edit-role" class="select select-bordered">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="collapse collapse-arrow bg-base-200 border border-base-300 rounded-box">
                <input type="checkbox" /> 
                <div class="collapse-title text-sm font-medium">¿Cambiar Contraseña? (Opcional)</div>
                <div class="collapse-content"> 
                    <input type="password" name="password" placeholder="Nueva contraseña" class="input input-bordered w-full">
                </div>
            </div>

            <div class="modal-action">
                <label for="modal-user" class="btn btn-ghost">Cancelar</label>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(user) {
    document.getElementById('edit-id').value = user.id;
    document.getElementById('edit-email').value = user.mail;
    document.getElementById('edit-role').value = user.role;
    document.getElementById('modal-user').checked = true;
}
</script>