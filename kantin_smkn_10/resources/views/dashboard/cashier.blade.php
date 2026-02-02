@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-cash-register"></i> Dashboard Kasir</h1>
        </div>
    </div>

    <!-- Quick Order Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pesanan Cepat</h5>
                </div>
                <div class="card-body">
                    @livewire('quick-order-form')
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Penjualan Hari Ini</h6>
                            <h3 class="card-text">Rp {{ number_format($todaySales, 0, ',', '.') }}</h3>
                        </div>
                        <i class="fas fa-money-bill-wave fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Pesanan Hari Ini</h6>
                            <h3 class="card-text">{{ $todayOrders }}</h3>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Pesanan Diproses</h6>
                            <h3 class="card-text">{{ $processingOrders }}</h3>
                        </div>
                        <i class="fas fa-clock fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Pesanan Selesai</h6>
                            <h3 class="card-text">{{ $completedOrders }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Transaksi Terakhir</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>Pesanan</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_code }}</td>
                                    <td>{{ $transaction->order->order_code }}</td>
                                    <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($transaction->payment_method) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->status_badge }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $transaction->created_at->format('H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('cashier.quick-order') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-bolt"></i> Pesan Cepat
                        </a>
                        <a href="{{ route('cashier.orders.index') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-list"></i> Kelola Pesanan
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-info btn-lg">
                            <i class="fas fa-box"></i> Lihat Produk
                        </a>
                        <button class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#closeDayModal">
                            <i class="fas fa-door-closed"></i> Tutup Hari
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Close Day Modal -->
<div class="modal fade" id="closeDayModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tutup Hari</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('cashier.close-day') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Total penjualan hari ini: <strong>Rp {{ number_format($todaySales, 0, ',', '.') }}</strong></p>
                    <p>Total pesanan hari ini: <strong>{{ $todayOrders }} pesanan</strong></p>
                    <div class="mb-3">
                        <label for="closing_notes" class="form-label">Catatan Penutupan</label>
                        <textarea class="form-control" id="closing_notes" name="closing_notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection