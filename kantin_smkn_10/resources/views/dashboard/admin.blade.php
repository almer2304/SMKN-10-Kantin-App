@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Pendapatan</h6>
                            <h3 class="card-text">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
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
                            <h6 class="card-title">Total Pesanan</h6>
                            <h3 class="card-text">{{ $totalOrders }}</h3>
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
                            <h6 class="card-title">Total Produk</h6>
                            <h3 class="card-text">{{ $totalProducts }}</h3>
                        </div>
                        <i class="fas fa-box fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Pengguna</h6>
                            <h3 class="card-text">{{ $totalUsers }}</h3>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sales Chart -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Statistik Penjualan 7 Hari Terakhir</h5>
                </div>
                <div class="card-body">
                    @livewire('sales-chart')
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($recentOrders as $order)
                        <a href="{{ route('orders.show', $order) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $order->order_code }}</h6>
                                <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            <span class="badge bg-{{ $order->status_badge }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('products.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('categories.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-tags"></i> Tambah Kategori
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-info w-100">
                                <i class="fas fa-list"></i> Kelola Pesanan
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.users') }}" class="btn btn-warning w-100">
                                <i class="fas fa-users-cog"></i> Kelola Pengguna
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection