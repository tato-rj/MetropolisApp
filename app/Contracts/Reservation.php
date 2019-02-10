<?php

namespace App\Contracts;

interface Reservation
{
    public function scopeByReference($query, $reference);
    public function scopeByCode($query, $code);
    public function getStatusAttribute();
    public function getStatusForUserAttribute();
    public function getStatusColorAttribute();
    public function setStatus($status_id);
    public function setTransactionCode($code);
    public function getOwnerIdAttribute();
}
