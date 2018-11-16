<?php

namespace App\Traits;

use App\{Space, Event};

trait HasBonus
{
    public function useBonus(Event $event, $duration)
    {
        if (! $this->bonusesLeft($event->space))
            return null;

        $bonusesLeft = $this->bonusesLeft($event->space);

        return $this->bonuses()->create([
            'plan_id' => $this->membership->plan->id,
            'event_id' => $event->id,
            'duration' => $duration >= $bonusesLeft ? $bonusesLeft : $duration
        ]);
    }

    public function bonusesLeft(Space $space = null)
    {
        if (! $this->membership()->exists())
            return null;

        if ($space && ! $this->membership->plan->bonusSpacesArray()->contains($space->id))
            return null;

        return $this->membership->plan->bonus_limit - $this->bonuses->sum('duration');
    }

    public function bonusNotice()
    {
        if (! $this->membership()->exists())
            return 'Gostaria de ter acesso integral à nossa workstation? <a href="/planos" class="link-red">Escolha um dos nossos planos</a>';

        if (! $this->bonusesLeft())
            return '<span class="text-teal mr-2"><strong>BÔNUS</strong></span>Você já usou todas as horas de bônus '.$this->membership->plan->cycle(true);

        return '<span class="text-teal mr-2"><strong>BÔNUS</strong></span>Você tem <strong>'
                .$this->bonusesLeft().' '.trans_choice('words.horas', $this->bonusesLeft())
                .'</strong> na '.$this->membership->plan->bonusSpacesText().' para usar '
                .$this->membership->plan->cycle(true);
    }
}