<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;
use App\Models\Agent;

class InteractionController extends Controller
{
    function lastPerAgent() {
        return Interaction::addSelect([
            'last_inter' => Agent::select('name')
            ->where('id', 'interactions.agent_id')
            ->limit(1)
        ])
        ->get();
    }

    function updateOrCreateInteraction(Request $req){
        $inter = Interaction::updateOrCreate(
            ['agent_id' => 0],
            ['response' => $req->ai_resp]
        );

        return $inter;
    }
}
