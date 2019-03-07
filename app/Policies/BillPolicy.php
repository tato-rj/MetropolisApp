<?php

namespace App\Policies;

use App\{User, Bill, Admin};
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the bill.
     *
     * @param  \App\User  $user
     * @param  \App\Bill  $bill
     * @return mixed
     */
    public function view(User $user, Bill $bill)
    {
        //
    }

    /**
     * Determine whether the user can create bills.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the bill.
     *
     * @param  \App\User  $user
     * @param  \App\Bill  $bill
     * @return mixed
     */
    public function update(User $user, Bill $bill)
    {
        //
    }

    /**
     * Determine whether the user can delete the bill.
     *
     * @param  \App\User  $user
     * @param  \App\Bill  $bill
     * @return mixed
     */
    public function delete(Admin $admin, Bill $bill)
    {
        return is_null($bill->verified_at);
    }

    /**
     * Determine whether the user can restore the bill.
     *
     * @param  \App\User  $user
     * @param  \App\Bill  $bill
     * @return mixed
     */
    public function restore(User $user, Bill $bill)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the bill.
     *
     * @param  \App\User  $user
     * @param  \App\Bill  $bill
     * @return mixed
     */
    public function forceDelete(User $user, Bill $bill)
    {
        //
    }
}
