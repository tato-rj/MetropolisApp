<?php

namespace App;

class Plan extends Metropolis
{
    protected $appends = ['formattedFee'];
    protected $withCount = ['memberships'];
    
    public function memberships()
    {
    	return $this->hasMany(Membership::class);
    }

    public function getFormattedFeeAttribute()
    {
        return number_format(($this->fee /100), 2, '.', '');
    }

    public function getDisplayNameAttribute()
    {
        return 'Plano ' . ucfirst($this->type) . ' ' . ucfirst($this->name);
    }

    public function getTypeEnAttribute()
    {
        switch ($this->name) {
            case 'semanal':
                return 'WEEKLY';
                break;
            
            case 'mensal':
                return 'MONTHLY';
                break;
            
            default:
                return 'QUARTERLY';
                break;
        }
    }

    public function bonusSpacesArray()
    {
        return collect(explode(',', $this->bonus_spaces))->flatten();
    }

    public function bonusSpacesText()
    {
        $spaces = [];
        
        foreach ($this->bonusSpacesArray() as $space) {
            array_push($spaces, Space::find($space)->name);
        }

        return implode(' ou na ', $spaces);
    }

    public function cycle($prefix = false)
    {
    	switch ($this->name) {
    		case 'semanal':
    			return $prefix ? 'nessa semana' : 'semana';
    			break;
    		
    		case 'mensal':
    			return $prefix ? 'nesse mês' : 'mês';
    			break;
    		
    		default:
    			return $prefix ? 'nesse trimestre' : 'trimestre';
    			break;
    	}
    }

    public function renewsAt($date = null)
    {
        $starts_at = $date ?? now();

        switch ($this->name) {
            case 'semanal':
                return $starts_at->copy()->addWeek()->setTime(office()->day_ends_at,0,0);
                break;
            
            case 'mensal':
                return $starts_at->copy()->addMonth()->setTime(office()->day_ends_at,0,0);
                break;
            
            default:
                return $starts_at->copy()->addMonths(3)->setTime(office()->day_ends_at,0,0);
                break;
        }
    }
}
