<?php
class Pedido {
    public $id;
    public $user_id;
    public $order_date;
    public $status;
    public $total;

    public function getId() { return $this->id; }
    public function getUserId() { return $this->user_id; }
    public function getDate() { return $this->order_date; }
    public function getStatus() { return $this->status; }
    public function getTotal() { return $this->total; }

    // Método para mostrar el estado con un badge de DaisyUI
    public function getStatusBadge() {
        switch ($this->status) {
            case 'paid': return '<span class="badge badge-success">Pagado</span>';
            case 'pending': return '<span class="badge badge-warning">Pendiente</span>';
            default: return '<span class="badge">' . $this->status . '</span>';
        }
    }
}
?>