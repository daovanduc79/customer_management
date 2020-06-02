<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customers;

    public function __construct(Customer $customer)
    {
        $this->customers = $customer;
    }

    public function index()
    {
        $customers = $this->customers->all();
        $cities = City::all();

        return view('customers.list', compact('customers','cities'));
    }

    public function create()
    {
        $cities = City::all();
        return view('customers.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->dob = $request->dob;
        $customer->email = $request->email;
        $customer->city_id = $request->city_id;

        $customer->save();
        session()->flash('success','thêm mới thành công!!!');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = $this->customers->findOrFail($id);
        $cities = City::all();

        return view('customers.edit', compact('customer','cities'));
    }

    public function update(Request $request, $id)
    {
        $customer = $this->customers->findOrFail($id);
        $customer->name = $request->name;
        $customer->dob = $request->dob;
        $customer->email = $request->email;
        $customer->city_id = $request->city_id;

        $customer->save();
        session()->flash('success','cập nhật thành công!!!');
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = $this->customers->findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index');

    }

    public function filterByCity(Request $request){
        $idCity = $request->city_id;

        //kiem tra city co ton tai khong
        $cityFilter = City::findOrFail($idCity);

        //lay ra tat ca customer cua cityFiler
        $customers = Customer::where('city_id', $cityFilter->id)->get();
        $totalCustomerFilter = count($customers);
        $cities = City::all();

        return view('customers.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }
}
