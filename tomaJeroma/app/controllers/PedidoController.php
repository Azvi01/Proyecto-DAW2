<?php
require_once '../app/models/PedidoRepository.php';
require_once '../app/models/ProductsRepository.php';

class PedidoController
{

    public function checkout()
    {
        if (!Session::get('UserToken')) {
            header("Location: index.php?controller=Login&action=index");
            exit;
        }
        $userId = JWTToken::rescueUserId(Session::get('UserToken'));
        $carrito = Session::get('Carrito');
        if (empty($carrito)) {
            header("Location: index.php?controller=Cart&action=index");
            exit;
        }

        try {
            $repoPedidos = new PedidosRepository();
            $repoProducts = new ProductsRepository();

            $total = 0;
            foreach ($carrito as $id => $item) {
                $p = $repoProducts->getProduct($id);
                $total += ($p->getFinalPrice() * $item['cantidad']);
            }

            $res = $repoPedidos->save($userId, $total, $carrito, $repoProducts);

            if ($res) {
                Session::delete('Carrito');
                Session::set("error", "Compra realizada con exito.");
                header("Location: index.php");
                exit;
            }
        } catch (Exception $e) {
            Session::set("error", $e->getMessage());
            header("Location: index.php");
            exit;
        }
    }
}
