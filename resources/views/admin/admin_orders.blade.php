@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0">Panel Kelola Pesanan Masuk 🗃️</h2>
        <span class="badge bg-dark p-2">Total: {{ $orders->count() }} Transaksi</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="card p-5 text-center text-muted border-0 shadow-sm">
            <h5>Belum ada pesanan masuk dari pembeli, bro.</h5>
        </div>
    @else
        <div class="card border-0 shadow-sm table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr class="small">
                        <th>Nota / Pelanggan</th>
                        <th>Rincian Parfum</th>
                        <th>Total Bayar</th>
                        <th class="text-center">Bukti Transfer</th>
                        <th>Status Saat Ini</th>
                        <th class="text-center">Aksi Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <span class="fw-bold text-danger d-block">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <small class="text-dark d-block">👤 {{ $order->name }}</small>
                            <small class="text-muted" style="font-size: 11px;">📞 {{ $order->phone }}</small>
                        </td>
                        <td>
                            <ul class="list-unstyled m-0 p-0 small">
                                @foreach($order->items as $item)
                                    <li>📦 {{ $item->product->name }} (x{{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                            <small class="text-muted d-block mt-1 text-truncate" style="max-width: 250px;" title="{{ $order->address }}">📍 {{ $order->address }}</small>
                        </td>
                        <td class="fw-bold text-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($order->payment_proof)
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                                    🖼️ Lihat Bukti
                                </a>
                            @else
                                <span class="text-danger small">Tidak Ada</span>
                            @endif
                        </td>
                        <td>
                            @if($order->status === 'pending')
                                <span class="badge bg-warning text-dark">⏳ Pending</span>
                            @elseif($order->status === 'approved')
                                <span class="badge bg-primary">📦 Diproses</span>
                            @elseif($order->status === 'completed')
                                <span class="badge bg-success">✅ Selesai</span>
                            @else
                                <span class="badge bg-danger">❌ Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <!-- Form Perubahan Status Cepat -->
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex gap-1 justify-content-center">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" style="width: 120px;" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>📦 Approve</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Selesai</option>
                                    <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>❌ Tolak</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection