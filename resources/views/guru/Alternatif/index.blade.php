@extends('layouts.base')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Daftar Alternatif</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Alternatif</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

           

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-list-check me-2"></i> Data Alternatif</h4>
                </div>
                <div class="card-body p-3">
                    @if($alternatifs->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle " id="dataTable">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatifs as $alt)
                                        <tr>
                                            <td>{{ $alt->kode }}</td>
                                            <td>{{ $alt->nama }}</td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mb-0">Belum ada data alternatif.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
