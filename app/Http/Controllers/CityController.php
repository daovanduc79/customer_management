<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $cities;

    public function __construct(City $cities)
    {
        $this->cities = $cities;
    }

    public function index()
    {
        $cities = $this->cities->all();
        return view('cities.list', compact('cities'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $cities = new City();
        $cities->name = $request->name;
        $cities->save();
        $message = 'them moi thanh cong!!';
        session()->flash('success', $message);

        return redirect()->route('cities.index');
    }

    public function edit($id)
    {
        $city = $this->cities->findOrFail($id);

        return view('cities.edit', compact('city'));
    }

    public function update($id, Request $request)
    {
        $city = $this->cities->findOrFail($id);
        $city->name = $request->name;
        $city->save();

        $message = 'cap nhat thanh cong!!';
        session()->flash('success', $message);

        return redirect()->route('cities.index');
    }

    public function destroy($id)
    {
        $city = $this->cities->findOrFail($id);

        $city->customers()->delete();
        $city->delete();

        return redirect()->route('cities.index');
    }
}
