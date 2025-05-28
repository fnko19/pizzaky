<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use App\Models\pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{
    public function index()
    {
        // Get orders associated with the currently logged-in user only
        $user = Auth::user();
        
        // No need to check if user is logged in since we have auth middleware
        
        // Get all orders from the user and paginate with 5 orders per page
        // Note: We're now including 'batal' and 'Selesai' orders as requested
        $orders = $user->pesanan()
                     ->with(['detailPesanan.pizza', 'pembayaran', 'detailMakananLains.makananLain', 'detailPizzaPanjangs.pizzaPanjang'])
                     ->orderBy('created_at', 'desc')
                     ->paginate(5);
        
        if ($orders->isEmpty()) {
            return view('filament.pages.status_pesanan', [
                'hasOrder' => false
            ]);
        }
        
        return view('filament.pages.status_pesanan', [
            'hasOrder' => true,
            'user' => $user,
            'orders' => $orders
        ]);
    }
    
    public function uploadPaymentProof(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'payment_proof' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Find the order
        $order = pesanan::findOrFail($id);
        
        // Check if the order belongs to the authenticated user
        if ($order->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }
        
        // Get or create payment record
        $payment = $order->pembayaran ?? new pembayaran(['pesanan_id' => $order->id]);
        
        // Set the payment method to 'Transfer' if not already set
        if (!$payment->id || !$payment->metode_bayar) {
            $payment->metode_bayar = 'Transfer';
        }
        
        // Store the file
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/payment_proofs', $filename);
            
            // Update payment record - set to pending as per PRD requirements
            $payment->file_path = 'storage/payment_proofs/' . $filename;
            // In our database, 'Menunggu Dikonfirmasi' maps to 'pending' in the PRD
            $payment->status_bayar = 'Menunggu Dikonfirmasi';
            $payment->save();
        }
        
        return redirect()->route('status_pesanan')->with('success', 'Bukti pembayaran berhasil diunggah');
    }
    
    public function cancelOrder(Request $request, $id)
    {
        // Find the order
        $order = pesanan::findOrFail($id);
        
        // Check if the order belongs to the authenticated user
        if ($order->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }
        
        // Check if payment status is confirmed
        if ($order->pembayaran && $order->pembayaran->getStatusDisplay() === 'terkonfirmasi') {
            return redirect()->back()->with('error', 'Pesanan dengan pembayaran yang sudah dikonfirmasi tidak dapat dibatalkan');
        }
        
        // Use our new cancel() method which properly sets status and note
        $order->cancel();
        
        return redirect()->route('status_pesanan')->with('success', 'Pesanan berhasil dibatalkan');
    }
    
    public function confirmReceipt(Request $request, $id)
    {
        // Find the order
        $order = pesanan::findOrFail($id);
        
        // Check if the order belongs to the authenticated user
        if ($order->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }
        
        // Check if order status is in delivery
        if ($order->status_pesanan !== 'Sedang Dikirim') {
            return redirect()->back()->with('error', 'Hanya pesanan yang sedang dalam pengiriman yang dapat dikonfirmasi penerimaan');
        }
        
        // Update order status to received
        $order->status_pesanan = 'Selesai';
        $order->save();
        
        return redirect()->route('status_pesanan')->with('success', 'Pesanan telah dikonfirmasi diterima');
    }
}
