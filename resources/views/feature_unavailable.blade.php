<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Fitur Belum Tersedia') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="text-center">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Fitur Belum Tersedia</h4>
                <p>Mohon maaf, fitur yang Anda akses saat ini belum tersedia..</p>
                <hr>
                <p class="mb-0">Silakan kembali nanti atau hubungi tim pengembang jika Anda memiliki pertanyaan lebih lanjut.</p>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
