@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white border border-[#EAD8C0] border-t-4 border-t-[#23120B] rounded-2xl p-6 sm:p-8 shadow-sm">
        <h1 class="text-2xl font-black text-[#23120B] mb-6">Add New Eatery</h1>

        <form action="{{ route('eateries.store') }}" method="POST">
            @csrf
            @include('eateries._form')

            <div class="mt-6 flex items-center gap-3">
                <button type="submit"
                        class="bg-amber-500 text-[#23120B] px-5 py-2.5 rounded-xl text-sm font-extrabold hover:bg-amber-400 transition cursor-pointer">
                    Save Eatery
                </button>
                <a href="{{ route('eateries.index') }}" class="text-sm font-bold text-[#5C341E] hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection