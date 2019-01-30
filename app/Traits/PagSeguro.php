<?php

namespace App\Traits;

trait PagSeguro
{
	protected $statusArray = [
        0 => 'Processando o pedido',
		1 => 'Aguardando pagamento', 
		2 => 'Em análise',
		3 => 'Paga',
		4 => 'Disponível',
		5 => 'Em disputa',
		6 => 'Devolvida',
		7 => 'Cancelada',
		8 => 'Debitado',
		9 => 'Retenção temporária'
	];

	protected $confirmedStatusArray = [3, 4, 8];
	protected $waitingStatusArray = [0, 1, 2, 5];
	protected $cancelledStatusArray = [6, 7, 9];

    public function scopeByReference($query, $reference)
    {
        return $query->where('reference', $reference);
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('transaction_code', $code);
    }

    public function getStatusAttribute()
    {
        if (array_key_exists($this->status_id, $this->statusArray))
            return $this->statusArray[$this->status_id];

        return 'Status não disponível';
    }

    public function getStatusForUserAttribute()
    {
    	if (! array_key_exists($this->status_id, $this->statusArray))
    		return 'Status não disponível';

        if (in_array($this->status_id, $this->confirmedStatusArray))
            return 'Confirmado';
        
        if (in_array($this->status_id, $this->waitingStatusArray))
            return $this->statusArray[$this->status_id];

        if (in_array($this->status_id, $this->cancelledStatusArray))
            return 'Cancelado';
    }

    public function getStatusColorAttribute()
    {
        if ($this->statusForUser == 'Confirmado')
            return 'green';

        if ($this->statusForUser == 'Cancelado')
            return 'danger';

        return 'warning';        
    }

    public function setStatus($status_id)
    {
        $this->update([
            'status_id' => $status_id,
            'verified_at' => now()
        ]);

        return $this;
    }

    public function setTransactionCode($code)
    {
        $this->update(['transaction_code' => $code]);

        return $this;
    }
}
