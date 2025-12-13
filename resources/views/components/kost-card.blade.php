@props(['kost'])

<div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
    <img src="{{ $kost->photos->first()?->path ?? asset('img/no-image.jpg') }}"
         class="h-48 w-full object-cover">

    <div class="p-4 space-y-2">
        <h3 class="font-semibold text-lg">{{ $kost->name }}</h3>
        <p class="text-sm text-gray-500">{{ $kost->city }}</p>

        <div class="flex items-center justify-between">
            <span class="text-primary font-bold">
                Rp {{ number_format($kost->price) }}/bulan
            </span>

            <span class="text-yellow-500 text-sm">
                ★ {{ number_format($kost->average_rating ?? 0, 1) }}
            </span>
        </div>

        <a href="{{ route('kost.show', $kost) }}"
           class="block text-center bg-primary text-white py-2 rounded-lg mt-2">
            Lihat Detail
        </a>
    </div>
</div>
