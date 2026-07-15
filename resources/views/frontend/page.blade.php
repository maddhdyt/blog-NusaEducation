@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="card p-8 max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold mb-4">{{ $page->title }}</h1>

            <div class="prose prose-lg max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
