<?php

namespace App\Http\Controllers;

use App\CardWork;
use App\CardWorkDetail;
use App\Category;
use App\Project;
use App\Inventory;
use App\Process;
use App\Customer;
use App\Material;
use App\Component;
use Illuminate\Http\Request;
use DB;

class CardWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cardworks = DB::table('card_works')
            ->join('categories', 'card_works.category_id', '=', 'categories.id')
            ->join('inventories', 'card_works.inventory_id', '=', 'inventories.id')
            ->join('processes', 'card_works.process_id', '=', 'processes.id')
            ->join('customers', 'card_works.customer_id', '=', 'customers.id')
            ->join('projects', 'card_works.project_id', '=', 'projects.id')
            ->select('card_works.id', 'card_works.po_number', 'categories.name AS category', 'inventories.name AS inventory', 'processes.name AS proccess', 'customers.name AS customer', 'projects.code AS project')
            ->get();

        return view('cardworks.index', compact('cardworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $inventories = Inventory::pluck('name', 'id');
        $processes = Process::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        $projects = Project::pluck('code', 'id');

        return view('cardworks.create', compact('categories', 'inventories', 'processes', 'customers', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'date' => 'required|date_format:d/m/Y',
            'category' => 'required|string',
            'po_number' => 'required|string',
            'inventory' => 'required|string',
            'process' => 'required|string',
            'customer' => 'required|string',
            'project' => 'required|string'
        ]);

        try {
            // ubah format tanggal
            $request->date = str_replace('/', '-', $request->date);
            $request->date = date('Y-m-d', strtotime($request->date));

            $cardworks = CardWork::firstOrCreate([
                'date' => $request->date,
                'category_id' => $request->category,
                'po_number' => $request->po_number,
                'inventory_id' => $request->inventory,
                'process_id' => $request->process,
                'customer_id' => $request->customer,
                'project_id' => $request->project,
                'user_id' => \Auth::user()->id
            ]);

            return redirect()->route('cardwork.index')->with(['success' => 'Kartu Kerja: ' . $cardworks->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function show(CardWork $cardWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('name', 'id');
        $inventories = Inventory::pluck('name', 'id');
        $processes = Process::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        $projects = Project::pluck('code', 'id');
        $cardworks = CardWork::findOrFail($id);

        $cardworks->date = date('d/m/Y', strtotime($cardworks->date));

        return view('cardworks.edit', compact('categories', 'inventories', 'processes', 'customers', 'projects', 'cardworks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'date' => 'required|date_format:d/m/Y',
            'category' => 'required|string',
            'po_number' => 'required|string',
            'inventory' => 'required|string',
            'process' => 'required|string',
            'customer' => 'required|string',
            'project' => 'required|string'
        ]);

        try {
            //select data berdasarkan id
            $cardworks = Cardwork::findOrFail($id);

            // ubah format tanggal
            $request->date = str_replace('/', '-', $request->date);
            $request->date = date('Y-m-d', strtotime($request->date));

            //update data
            $cardworks->update([
                'date' => $request->date,
                'category_id' => $request->category,
                'po_number' => $request->po_number,
                'inventory_id' => $request->inventory,
                'process_id' => $request->process,
                'customer_id' => $request->customer,
                'project_id' => $request->project,
                'user_id' => \Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('cardwork.index'))->with(['success' => 'Kartu Kerja diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cardworks = CardWork::findOrFail($id);
        $cardworks->delete();
        return redirect()->back()->with(['success' => "Kartu Kerja telah dihapus!"]);
    }

    public function detail($id)
    {
        $cardwork_details = DB::table('card_work_details')
            ->join('card_works', 'card_work_details.card_work_id', '=', 'card_works.id')
            ->join('components', 'card_work_details.component_id', '=', 'components.id')
            ->join('materials', 'card_work_details.material_id', '=', 'materials.id')
            ->select('card_works.id', 'components.name AS component', 'materials.name AS material', 'dimension', 'problem', 'solution', 'total_hours', 'qty', 'weight')
            ->where('card_work_id', $id)
            ->get();

        $cardworks = array('id' => $id);
        $components = Component::pluck('name', 'id');
        $materials = Material::pluck('name', 'id');

        return view('cardworks.detail', compact('cardworks', 'cardwork_details', 'components', 'materials'));
    }

    public function storeDetail(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'component' => 'required|integer',
            'material' => 'required|integer',
            'dimension' => 'required|string',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'total_hours' => 'required|integer',
            'qty' => 'required|integer',
            'weight' => 'required|integer'
        ]);

        try {
            $cardworks = CardWork::findOrFail($id);

            $cardwork_details = $cardworks->cardWorkDetails()->create([
                'component_id' => $request->component,
                'material_id' => $request->material,
                'dimension' => $request->dimension,
                'problem' => $request->problem,
                'solution' => $request->solution,
                'total_hours' => $request->total_hours,
                'qty' => $request->qty,
                'weight' => $request->weight
            ]);

            return redirect()->route('cardwork.detail', $id)->with(['success' => 'Detail Kartu Kerja ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroyDetail($id)
    {
        $card_work_details = CardWorkDetail::findOrFail($id);
        $card_work_details->delete();
        return redirect()->back()->with(['success' => "Detail Kartu Kerja telah dihapus!"]);
    }
}