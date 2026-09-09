<div class="row mb-4">
    <!-- WIDGET TOTAL KUNJUNGAN -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm p-3 bg-primary text-white rounded-4">
            <small class="text-white-50 fw-bold">Total Kunjungan Web</small>
            <h3 class="fw-bold my-1">{{ number_format($totalVisitors) }}</h3>
            <small class="small">👁️ Kali diakses</small>
        </div>
    </div>

    <!-- WIDGET PENGUNJUNG UNIK -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm p-3 bg-info text-white rounded-4">
            <small class="text-white-50 fw-bold">Pengunjung Unik (IP)</small>
            <h3 class="fw-bold my-1">{{ number_format($uniqueVisitors) }}</h3>
            <small class="small">👤 Orang berbeda</small>
        </div>
    </div>

    <!-- WIDGET KUNJUNGAN HARI INI -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm p-3 bg-success text-white rounded-4">
            <small class="text-white-50 fw-bold">Kunjungan Hari Ini</small>
            <h3 class="fw-bold my-1">{{ number_format($todayVisitors) }}</h3>
            <small class="small">📈 Akses hari ini</small>
        </div>
    </div>
</div>