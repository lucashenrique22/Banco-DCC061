<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the investments.
     */
    public function index()
    {
        $investments = Investment::all();
        return view('investments.index', compact('investments'));
    }
}
