<!-- Tugas Pertemuan 5 -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Demo Badge Stok</h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-card>
                <h3 class="text-lg font-semibold mb-4">
                    status stok produk
                </h3>

                <div class="space-y-4">
                    <div>
                        <p class="mb-1">Produk A <x-badge status="Aman" /></p>
                    </div>
                    <div>
                        <p class="mb-1">Produk B <x-badge status="Menipis" /></p>
                    </div>
                    <div>
                        <p class="mb-1">Produk C <x-badge status="Habis" /></p>
                    </div>

                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
<!-- =================  -->
