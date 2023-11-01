<?php

declare(strict_types=1);

namespace Domains\Application\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FrontendController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('index');
    }
}
