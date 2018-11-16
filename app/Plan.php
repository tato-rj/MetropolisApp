<?php

namespace App;

class Plan extends Metropolis
{
    public function memberships()
    {
    	return $this->hasMany(Membership::class);
    }

    public function getDisplayNameAttribute()
    {
        return 'Plano ' . ucfirst($this->type_pt) . ' ' . ucfirst($this->name_pt);
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
    		case 'weekly':
    			return $prefix ? 'nessa semana' : 'semana';
    			break;
    		
    		case 'monthly':
    			return $prefix ? 'nesse mês' : 'mês';
    			break;
    		
    		default:
    			return $prefix ? 'hoje' : 'dia';
    			break;
    	}
    }

    public function renewsAt($date = null)
    {
        $starts_at = $date ?? now();

        switch ($this->name) {
            case 'weekly':
                return $starts_at->copy()->addWeek()->setTime(office()->day_ends_at,0,0);
                break;
            
            case 'monthly':
                return $starts_at->copy()->addMonth()->setTime(office()->day_ends_at,0,0);
                break;
            
            default:
                return $starts_at->copy()->setTime(office()->day_ends_at,0,0);
                break;
        }
    }
}
