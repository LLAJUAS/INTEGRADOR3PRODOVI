<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function mostrarVista()
    {
        return view('CHATBOT'); // Asegúrate de que la vista esté en resources/views/CHATBOT.blade.php
    }
}
