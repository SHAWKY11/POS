<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function index()
    {
        $clients=Client::all();
        return view('dashboard.clients.index',compact('clients'));

    } //end of index

    
    public function create()
    {
        return view('dashboard.clients.create');

    }//end of create

    
    public function store(Request $request,Client $client)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required|unique:clients,phone',
            'address'=>'required'
        ]);

        $client->create($request->all());
        return redirect('clients');

    }//end of store

    
    public function show(Client $client)
    {
        //
    }//end of show

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));

    }//end of edit

    
    public function update(Request $request, Client $client)
    {
        
        $request->validate([
            'name'=>'required',
            'phone'=>'required|unique:clients,phone',
            'address'=>'required'
        ]);

        $client->update($request->all());
        return redirect('clients');

    }//end of update

    
    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', __('added_successfully'));
        return redirect('clients');
    }//end of destroy
}
