<div class="min-h-screen bg-base-300 flex flex-col lg:flex-row">
    
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Inicio
                </a>
            </li>
            <li>
                <a href="index.php?controller=Admin&action=products" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    Productos
                </a>
            </li>
            <li>
                <a href="index.php?controller=Pedido&action=listAll" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Pedidos
                </a>
            </li>
            <li>
                <a href="#" class="hover:bg-base-100 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    Usuarios
                </a>
            </li>
        </ul>
    </div>

    <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-black tracking-tight">Panel de Administración</h2>
            <div class="avatar placeholder">
                <div class="bg-neutral text-neutral-content rounded-full w-12 border-2 border-primary">
                    <span>AD</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="stats shadow bg-base-200 border border-base-100">
                <div class="stat">
                    <div class="stat-title text-secondary font-bold uppercase text-xs tracking-widest">Ventas Totales</div>
                    <div class="stat-value text-primary mt-2"><?= number_format($data['ventasTotales'], 2) ?> €</div>
                    <div class="stat-desc mt-2 text-success font-semibold">↑ 12% este mes</div>
                </div>
            </div>

            <div class="stats shadow bg-base-200 border border-base-100">
                <div class="stat">
                    <div class="stat-title text-secondary font-bold uppercase text-xs tracking-widest">Nuevos Pedidos</div>
                    <div class="stat-value text-secondary mt-2"><?= $data['totalPedidos'] ?></div>
                    <div class="stat-desc mt-2 opacity-50">Pedidos registrados en total</div>
                </div>
            </div>
        </div>

        <div class="bg-base-200 rounded-3xl shadow-xl overflow-hidden border border-base-100">
            <div class="p-6 flex justify-between items-center border-b border-base-300">
                <h3 class="text-xl font-bold">Resumen de Movimientos</h3>
                <button class="btn btn-ghost btn-sm">Ver todo</button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-base-300/50">
                        <tr>
                            <th class="text-xs uppercase opacity-50">ID Pedido</th>
                            <th class="text-xs uppercase opacity-50">Fecha</th>
                            <th class="text-xs uppercase opacity-50 text-center">Estado</th>
                            <th class="text-xs uppercase opacity-50 text-right">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['pedidosRecientes'] as $p): ?>
                        <tr class="hover:bg-base-100/50 transition-colors">
                            <td class="font-mono font-bold text-primary">#<?= $p->id ?></td>
                            <td class="opacity-70"><?= date('d/m/Y H:i', strtotime($p->order_date)) ?></td>
                            <td class="text-center">
                                <?php if($p->status == 'paid'): ?>
                                    <div class="badge badge-success badge-sm font-bold p-3">PAGADO</div>
                                <?php else: ?>
                                    <div class="badge badge-warning badge-sm font-bold p-3 text-white">PENDIENTE</div>
                                <?php endif; ?>
                            </td>
                            <td class="text-right font-black text-lg"><?= number_format($p->total, 2) ?> €</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>