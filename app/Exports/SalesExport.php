<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(protected $start, protected $end) {}
 
    public function collection(): Enumerable
    {
        return Transaction::with('user')
            ->whereBetween('created_at', [$this->start, $this->end])
            ->latest()
            ->get();
    }
 
    public function headings(): array
    {
        return ['No. Invoice', 'Tanggal', 'Kasir', 'Total', 'Bayar', 'Kembalian'];
    }
 
    public function map($transaction): array
    {
        return [
            $transaction->invoice_number,
            $transaction->created_at->format('d-m-Y H:i'),
            $transaction->user->name,
            $transaction->total,
            $transaction->pay,
            $transaction->change,
        ];
    }
}


