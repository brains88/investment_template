<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\Withdrawal;

class TransferController extends Controller
{
    //

    public function GetUsertransfers()
    {
        $transfers = Transfer::with(['sentTransfers', 'receivedTransfers'])
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Adjust pagination as needed
        return view('admin.transfer', compact('transfers'));
    }

    // Delete a transfer
    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);
        $transfer->delete();

        return redirect()->route('admin.transfer')->with('success', 'Transfer deleted successfully.');
    }

}
