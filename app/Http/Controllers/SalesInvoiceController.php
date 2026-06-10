<?php

namespace App\Http\Controllers;

use App\Models\SalesInvoice;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = SalesInvoice::with(['customer', 'harvest'])->latest()->get();

        return view('placeholder', [
            'title' => 'Quản lý bán hàng',
            'description' => 'Xem danh sách hóa đơn bán tôm, thông tin khách hàng/thương lái thu mua. Ghi nhận tình trạng công nợ gối đầu và lịch sử thanh toán hóa đơn.',
            'features' => [
                'Tạo hóa đơn bán hàng: liên kết với đợt thu hoạch, tự động tính tổng tiền',
                'Quản lý trạng thái thanh toán (đã thanh toán / chưa / nợ gối đầu)',
                'Ghi nhận lịch sử trả nợ theo từng hóa đơn bán hàng'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0h6"></path></svg>',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:100|unique:sales_invoices,invoice_number',
            'customer_id' => 'required|exists:customers,id',
            'harvest_id' => 'required|exists:harvests,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:paid,unpaid',
        ]);

        $invoice = SalesInvoice::create($validated);

        // Update customer debt if unpaid
        if ($invoice->status === 'unpaid') {
            $unpaidAmount = $invoice->total_amount - $invoice->paid_amount;
            if ($unpaidAmount > 0) {
                $invoice->customer->increment('debt', $unpaidAmount);
            }
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Tạo hóa đơn bán hàng',
            'description' => "Đã tạo hóa đơn mới: {$invoice->invoice_number} cho khách hàng {$invoice->customer->name} (Tổng tiền: " . number_format($invoice->total_amount) . "đ)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Tạo hóa đơn bán hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
