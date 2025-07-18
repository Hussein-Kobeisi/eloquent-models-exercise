<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;


class AgentController extends Controller
{
    function getAllAgents(){
        $agents = withoutGlobalScope(ActiveScope::class)->get();
        $names = [];

        foreach($agents as $a){
            $names[] = $a->name;
            $names[] ="<br>";
        }

        return json_encode($names);
    }

    function getActiveAgents(){
        $agents = Agent::withoutGlobalScope(ActiveScope::class)->where('active', 1)->orderBy('name')->limit(10)->get();

        return json_encode($agents);
    }

    function tryFresh($name){
        $agent = Agent::withoutGlobalScope(ActiveScope::class)->first();
        $agent-> name = $name;
        $agent -> fresh();

        $agent->clean = !$agent->isDirty();
        if(!$agent->clean)
            $agent->prev_name =  $agent->getOriginal('name');

        return json_encode($agent);

    }

    function tryRefresh($name){
        $agent = Agent::withoutGlobalScope(ActiveScope::class)->first();
        $agent-> name = $name;
        $agent -> refresh();

        return json_encode($agent);

    }

    function getRejectActiveAgents(){
        $agents = Agent::withoutGlobalScope(ActiveScope::class)->get();
        $agents = $agents->reject(
            fn($a) => $a->active
        );

        return json_encode($agents);
    }

    function chunkUpdateActive(){
        Agent::withoutGlobalScope(ActiveScope::class)->chunk(10, function ($agents) {foreach($agents as $a){
            $a->active = !$a->active;
            $a->save();
        }});

        $agents = Agent::withoutGlobalScope(ActiveScope::class)->limit(20)->get();

        return json_encode($agents);
    }

    function lazyUpdateActive(){
        foreach (Agent::withoutGlobalScope(ActiveScope::class)->lazy() as $a) {
            $a->update(['active' => !$a->active]);
        }

        $agents = Agent::withoutGlobalScope(ActiveScope::class)->limit(20)->get();

        return json_encode($agents);
    }
}
