@extends('university.layouts.app')

@section('university-content')

    <div class="col-lg-9">
        <div class="university-grid">
            @forelse ($universities as $university)
                <div class="university-card" data-country="{{ strtolower($university->country->name) }}"
                     style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s, transform 0.5s;">

                    <div class="university-image"
                         style="background-image: url('{{ $university->image ? asset('images/universities/' . $university->image) : asset('assets/default-university.jpg') }}');
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;">
                        <div class="university-logo d-flex align-items-center">
                            <img src="{{ $university->logo ? asset('images/universities/' . $university->logo) : asset('assets/default-university.jpg') }}"
                                 width="50" height="50"
                                 alt="{{ $university->name }} Logo"
                                 class="me-2 rounded-circle logo-img">
                            <span>{{ $university->name }}</span>
                        </div>
                    </div>

                    <div class="university-details">
                        <h6 class="university-name">{{ $university->name }}</h6>
                        <div class="university-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $university->country->name }}
                            </div>
                            <div class="info-item">
                                <i class="fas fa-id-badge"></i>
                                {{ $university->cricos ?? 'N/A' }}
                            </div>
                            <div class="info-item">
                                <i class="fas fa-university"></i>
                                {{ $university->campus_count }} Campuses Worldwide
                            </div>
                        </div>
                    </div>
                </div>
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
