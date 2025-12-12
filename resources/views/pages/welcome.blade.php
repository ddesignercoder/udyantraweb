@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-[var(--color-input-bg)] py-12 px-4 sm:px-6 lg:px-8">
   <span class="hidden lg:block text-sm font-bold text-[#00AAD9]">
                            Hi, {{ session('user_name', 'Creator') }}
    </span>
</div>
@endsection