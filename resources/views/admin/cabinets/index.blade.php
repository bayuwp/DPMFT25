@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-purple-800">Daftar Cabinets</h2>
        <a href="{{ route('admin.cabinets.create') }}"
           class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            + Tambah Cabinet
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-purple-600 text-white text-left">
                    <th class="px-4 py-2">Nama Cabinet</th>
                    <th class="px-4 py-2">Slug</th>
                    <th class="px-4 py-2">Logo</th>
                    <th class="px-4 py-2">Fungsionaris</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cabinets as $cabinet)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $cabinet->nama_cabinet }}</td>
                    <td class="px-4 py-2">{{ $cabinet->slug }}</td>
                    <td class="px-4 py-2">
                        @if($cabinet->logo_cabinet)
                            <img src="{{ asset('storage/'.$cabinet->logo_cabinet) }}"
                                 alt="Logo" class="h-10">
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if($cabinet->foto_fungsionaris)
                            <img src="{{ asset('storage/'.$cabinet->foto_fungsionaris) }}"
                                 alt="Foto" class="h-10">
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.cabinets.edit', $cabinet->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                           Edit
                        </a>
                        <form action="{{ route('admin.cabinets.destroy', $cabinet->id) }}"
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data cabinet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $cabinets->links() }}
    </div>
</div>
@endsection
