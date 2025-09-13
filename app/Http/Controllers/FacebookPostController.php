<?php

namespace App\Http\Controllers;

use App\Services\FacebookService;
use Illuminate\Http\Request;

class FacebookPostController extends Controller
{
    protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    public function showForm()
    {
        $pageInfo = $this->facebookService->getPageInfo();
        return view('facebook.post-form', compact('pageInfo'));
    }

    public function postToPage(Request $request)
    {
        
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $result = $this->facebookService->postToPage($request->message);

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', 'Error: ' . $result['error']);
    }
}