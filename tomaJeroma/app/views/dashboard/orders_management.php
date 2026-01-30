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
                <a href="index.php?controller=Admin&action=orders" class="active bg-primary/10 text-primary font-bold py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Pedidos
                </a>
            </li>
            <li>
                <a href="index.php?controller=Admin&action=users" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Usuarios
                </a>
            </li>
        </ul>
    </div>

    <main class="flex-1 p-4 lg:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight">Gestión de Pedidos</h2>
                <p class="text-base-content/60">Visualiza y filtra las ventas de la tienda.</p>
            </div>
        </div>

        <div class="bg-base-200 p-4 rounded-2xl mb-8 shadow-sm border border-base-100">
            <form action="index.php" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <input type="hidden" name="controller" value="Admin">
                <input type="hidden" name="action" value="orders">

                <div class="form-control w-full md:w-80">
                    <label class="label"><span class="label-text font-bold">Buscar por ID de Cliente</span></label>
                    <div class="relative">
                        <input type="number" name="clientId" placeholder="Ej: 12"
                            value="<?= $searchId ?? '' ?>"
                            class="input input-bordered w-full bg-base-100 border-none focus:ring-2 focus:ring-primary/30" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-8">Buscar</button>
                <a href="index.php?controller=Admin&action=orders" class="btn btn-ghost">Limpiar</a>
            </form>
        </div>

        <div class="bg-base-100 rounded-3xl shadow-xl overflow-hidden border border-base-200">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-base-200/50">
                        <tr class="text-base-content/70 uppercase text-xs">
                            <th class="py-4">ID Pedido</th>
                            <th>Cliente (Email)</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-10 opacity-50">No se encontraron pedidos.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $o): ?>
                                <tr class="hover:bg-base-200/40 transition-colors">
                                    <td class="font-bold text-primary">#<?= $o->id ?></td>
                                    <td>
                                        <div class="flex flex-col">
                                            <span class="font-medium text-sm">ID: <?= $o->user_id ?></span>
                                            <span class="text-xs opacity-50"><?= $o->user_email ?></span>
                                        </div>
                                    </td>
                                    <td class="text-sm"><?= date('d/m/Y H:i', strtotime($o->order_date)) ?></td>
                                    <td>
                                        <?php
                                        $statusClass = $o->status == 'paid' ? 'badge-success' : 'badge-warning';
                                        $statusText = $o->status == 'paid' ? 'Pagado' : 'Pendiente';
                                        ?>
                                        <div class="badge <?= $statusClass ?> badge-outline font-bold text-[10px] uppercase p-3">
                                            <?= $statusText ?>
                                        </div>
                                    </td>
                                    <td class="text-right font-mono font-bold text-lg">
                                        <?= number_format($o->total, 2) ?> €
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>