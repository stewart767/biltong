@extends('layouts.app')

@section('title', 'Delivery Addresses | COY BILTONG')

@section('content')

<div class="bg-[#171717] text-white py-10 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-white">Delivery Addresses</h1>
        <p class="text-xs text-stone-300 mt-1">Manage your home, office and safari shipment destinations.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ showAddModal: false }">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-4 shadow-xs space-y-1">
                <a href="{{ route('account.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-stone-500"></i>
                    <span>Dashboard Overview</span>
                </a>
                <a href="{{ route('account.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="package" class="w-4 h-4 text-stone-500"></i>
                    <span>My Orders</span>
                </a>
                <a href="{{ route('account.addresses') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold bg-[#171717] text-white">
                    <i data-lucide="map-pin" class="w-4 h-4 text-[#B77B3B]"></i>
                    <span>Delivery Addresses</span>
                </a>
                <a href="{{ route('account.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="user" class="w-4 h-4 text-stone-500"></i>
                    <span>Account Profile</span>
                </a>
            </div>
        </div>

        <!-- Addresses Content (9 cols) -->
        <div class="lg:col-span-9 space-y-6">
            
            <div class="flex items-center justify-between pb-2">
                <h3 class="font-display font-bold text-xl text-[#171717]">Saved Locations</h3>
                <button type="button" @click="showAddModal = true" class="px-4 py-2 bg-[#171717] hover:bg-[#B77B3B] text-white rounded-xl text-xs font-bold uppercase tracking-wider transition flex items-center gap-1.5 shadow-xs">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                    <span>Add New Address</span>
                </button>
            </div>

            @if($addresses->isEmpty())
                <div class="bg-white p-12 rounded-3xl border border-[#ECE2D2] text-center text-xs text-stone-500">
                    <i data-lucide="map-pin-off" class="w-10 h-10 mx-auto mb-2 text-stone-300"></i>
                    <p class="font-bold text-sm text-[#171717]">No saved delivery addresses</p>
                    <p class="mt-1">Add an address to speed up your checkout process.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($addresses as $addr)
                        <div class="bg-white p-6 rounded-3xl border {{ $addr->is_default ? 'border-[#B77B3B] ring-1 ring-[#B77B3B]/30' : 'border-[#ECE2D2]' }} shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-sm text-[#171717]">{{ $addr->label }}</span>
                                    @if($addr->is_default)
                                        <span class="px-2 py-0.5 bg-[#B77B3B] text-white rounded text-[10px] font-bold">Default</span>
                                    @endif
                                </div>
                                <p class="text-xs font-bold text-stone-700 mt-2">{{ $addr->recipient_name }} ({{ $addr->phone }})</p>
                                <p class="text-xs text-stone-600 mt-1">{{ $addr->address_line }}</p>
                                <p class="text-xs text-stone-400">{{ $addr->area }}, {{ $addr->city }}</p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-[#ECE2D2] flex items-center justify-between text-xs">
                                @if(!$addr->is_default)
                                    <form action="{{ route('account.addresses.default', $addr->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-bold text-[#B77B3B] hover:underline">Set as Default</button>
                                    </form>
                                @else
                                    <span class="text-[11px] text-emerald-700 font-semibold">Primary Address</span>
                                @endif

                                <form action="{{ route('account.addresses.destroy', $addr->id) }}" method="POST" onsubmit="return confirm('Remove this address?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-stone-400 hover:text-red-600 transition">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    </div>

    <!-- Modal to Add New Address -->
    <div x-show="showAddModal" 
         x-transition 
         class="fixed inset-0 z-50 bg-[#171717]/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.away="showAddModal = false" class="bg-white w-full max-w-lg rounded-3xl p-8 shadow-2xl border border-[#ECE2D2] relative">
            <button @click="showAddModal = false" class="absolute top-6 right-6 text-stone-400 hover:text-stone-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <h3 class="font-display font-bold text-xl text-[#171717] mb-4">Add Delivery Location</h3>

            <form action="{{ route('account.addresses.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Label (e.g. Home, Office)</label>
                        <input type="text" name="label" required placeholder="Home" class="w-full px-3 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Recipient Name</label>
                        <input type="text" name="recipient_name" required value="{{ Auth::user()->name }}" class="w-full px-3 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Phone Number</label>
                        <input type="text" name="phone" required value="{{ Auth::user()->phone }}" class="w-full px-3 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase mb-1">City</label>
                        <input type="text" name="city" required value="Dar es Salaam" class="w-full px-3 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Area / Neighborhood</label>
                    <input type="text" name="area" required placeholder="e.g. Masaki, Mikocheni..." class="w-full px-3 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Street Address / Landmark</label>
                    <input type="text" name="address_line" required placeholder="e.g. Plot 15 Chole Road" class="w-full px-3 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs">
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_default" value="1" id="is_default_new" class="w-4 h-4 text-[#B77B3B] rounded">
                    <label for="is_default_new" class="text-xs text-stone-600">Set as primary default address</label>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="showAddModal = false" class="px-4 py-2.5 text-xs text-stone-600 font-bold hover:bg-stone-100 rounded-xl">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-[#171717] hover:bg-[#B77B3B] text-white rounded-xl text-xs font-bold uppercase transition">Save Address</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
