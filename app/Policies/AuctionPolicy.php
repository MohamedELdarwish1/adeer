<?php

namespace App\Policies;

use App\Models\Auction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuctionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Auction $auction): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Auction $auction): bool
    {
        // Check if the auction is active

        if (!$auction->is_active ) {
            return false; // Auction is not active, user cannot bid
        }




        return true; // User is allowed to bid
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Auction $auction): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Auction $auction): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Auction $auction): bool
    {
        //
    }
}
