@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white border border-stone-200 rounded-xl p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-stone-900 mb-6">Add New Eatery</h1>

        <form action="{{ route('eateries.store') }}" method="POST">
            @csrf
            @include('eateries._form')

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="bg-emerald-700 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-800">
                    Save Eatery
                </button>
                <a href="{{ route('eateries.index') }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection