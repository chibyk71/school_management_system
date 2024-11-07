<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class EmailVerificationPromptController extends Controller
{
  /**
   * Display the email verification prompt.
   */
  public function __invoke(Request $request): RedirectResponse|Response
  {
    return $request->user()->hasVerifiedEmail()
      ? redirect()->intended(route('home'))
      : Inertia::render('VerifyEmail')->withViewData([
        'title' => 'Email Verification',
        'metaDesc' => 'Kindly verify your email to access your dashboard. Remember to check your spam mail, if you can\'t find our mail in your inbox',
        'ogUrl' => route('home'),
        'canonical' => route('home'),
      ]);
  }
}
