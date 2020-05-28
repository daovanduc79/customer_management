<?php

namespace App\Http\Controllers;

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

        return view('customers.list', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->dob = $request->dob;
        $customer->email = $request->email;

        $customer->save();
        session()->flash('success','thêm mới thành công!!!');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = $this->customers->findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = $this->customers->findOrFail($id);
        $customer->name = $request->name;
        $customer->dob = $request->dob;
        $customer->email = $request->email;

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
}
