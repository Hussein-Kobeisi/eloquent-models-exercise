<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;


class AgentController extends Controller
{
    function getAllAgents(){
        $agents = Agent::all();
        $names = [];

        foreach($agents as $a){
            $names[] = $a->name;
            $names[] ="<br>";
        }

        return json_encode($names);
    }

    function getActiveAgents(){
        $agents = Agent::where('active', 1)->orderBy('name')->limit(10)->get();

        return json_encode($agents);
    }

    function tryFresh($name){
        $agent = Agent::first();
        $agent-> name = $name;
        $agent -> fresh();

        return json_encode($agent);

    }

    function tryRefresh($name){
        $agent = Agent::first();
        $agent-> name = $name;
        $agent -> refresh();

        return json_encode($agent);

    }

    function getRejectActiveAgents(){
        $agents = Agent::all();
        $agents = $agents->reject(
            fn($a) => $a->active
        );

        return json_encode($agents);
    }

    function chunkUpdateActive(){
        Agent::chunk(10, function ($agents) {foreach($agents as $a){
            $a->active = !$a->active;
            $a->save();
        }});

        $agents = Agent::limit(20)->get();

        return json_encode($agents);
    }

    function lazyUpdateActive(){
        foreach (Agent::lazy() as $a) {
            $a->update(['active' => !$a->active]);
        }

        $agents = Agent::limit(20)->get();

        return json_encode($agents);
    }
}
