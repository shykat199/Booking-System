@extends('university.layouts.app')
@push('university.style')
    <style>
        mark {
            background-color: #ffea00; /* bright yellow */
            color: #000; /* black text for contrast */
            padding: 0 3px;
            border-radius: 3px; /* rounded edges */
            font-weight: bold;
        }

    </style>
@endpush
@section('university-content')

    <div class="col-lg-9">
        <div class="university-grid" id="universityGrid">
            @forelse ($universities as $university)
               @include('university.partials.university_cards_search',['university'=>$university])
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> No universities found.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
@push('university.script')

@endpush
