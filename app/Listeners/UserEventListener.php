<?php

namespace App\Listeners;

use App\Notifications\ResetPasswordSuccessful;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class UserEventListener implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
       
    }

    
  public static function onRegistered(Registered $event): void
  {
    if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
      $event->user->sendEmailVerificationNotification();
    }
  }

  public static function onPasswordReset(PasswordReset $event): void
  {
    $event->user->notify(new ResetPasswordSuccessful());
  }

  public function subscribe()
  {
    return [
      Registered::class => 'onRegistered',
      PasswordReset::class => 'onPasswordReset',
    ];
  }
}
