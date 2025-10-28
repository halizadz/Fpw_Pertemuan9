<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource with search and pagination
     */
    public function index(Request $request)
{
    $query = Product::query();

    // Fitur Search
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('product_name', 'like', '%' . $search . '%')
              ->orWhere('information', 'like', '%' . $search . '%')
              ->orWhere('producer', 'like', '%' . $search . '%');
        });
    }

    // Fitur Sorting
    $sortField = $request->get('sort', 'id'); // Default sort by id
    $sortDirection = $request->get('direction', 'asc'); // Default ascending
    
    // Validasi kolom yang boleh di-sort (untuk keamanan)
    $allowedSorts = ['product_name', 'unit', 'type', 'information', 'qty', 'producer'];
    if (in_array($sortField, $allowedSorts)) {
        $query->orderBy($sortField, $sortDirection);
    } else {
        $query->orderBy('id', 'asc'); // Fallback ke default
    }
    
    $products = $query->paginate(10); // Ubah jadi 10 per page
    
    return view("master-data.product-master.index-product", compact('products'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data.product-master.create-product");
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    try {
        // Validasi input data
        $validasi_data = $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'information' => 'nullable|string',
            'qty' => 'required|integer|min:0',
            'producer' => 'required|string|max:255',
        ]);

        // Proses simpan data
        Product::create($validasi_data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('product-index')
                       ->with('success', '✅ Product berhasil ditambahkan!');
                       
    } catch (\Exception $e) {
        // Jika terjadi error, redirect dengan pesan error
        return redirect()->route('product-index')
                       ->with('error', '❌ Gagal menambahkan product: ' . $e->getMessage());
    }
}


    /**
     * Display the specified product detail
     */
    public function show(string $id)
    {
        // Mengambil detail produk berdasarkan ID
        $product = Product::findOrFail($id);
        
        return view("master-data.product-master.detail-product", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    try {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'information' => 'nullable|string',
            'qty' => 'required|integer|min:1',
            'producer' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'product_name' => $request->product_name,
            'unit' => $request->unit,
            'type' => $request->type,
            'information' => $request->information,
            'qty' => $request->qty,
            'producer' => $request->producer,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('product-index')
                       ->with('success', '✅ Product berhasil diupdate!');
                       
    } catch (\Exception $e) {
        // Jika terjadi error, redirect dengan pesan error
        return redirect()->route('product-index')
                       ->with('error', '❌ Gagal mengupdate product: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product-index')->with('success', 'Product deleted successfully');
    }
}