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
<script>
    function toggleArea(header) {
        header.classList.toggle('active');
        const body = header.nextElementSibling;
        body.classList.toggle('show');
    }

    function initUniversityCard(){
        document.addEventListener('DOMContentLoaded', function () {
            const universityGrid = document.getElementById('universityGrid');
            const modal = new bootstrap.Modal(document.getElementById('universityModal'));
            const loader = document.getElementById('modalLoader');
            const modalContent = document.getElementById('universityModalContent');

            // ✅ Event delegation
            universityGrid.addEventListener('click', function (e) {
                const card = e.target.closest('.university-card');
                if (!card) return;

                const universityId = card.dataset.id;
                console.log(universityId, 'universityId');

                modal.show();
                loader.classList.remove('d-none');
                modalContent.classList.add('d-none');
                modalContent.innerHTML = '';

                // Fetch university details
                fetch(`/university/university-details/${universityId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        loader.classList.add('d-none');
                        modalContent.classList.remove('d-none');
                        modalContent.innerHTML = html;
                    })
                    .catch(error => {
                        loader.classList.add('d-none');
                        modalContent.classList.remove('d-none');
                        modalContent.innerHTML = `<p class="text-danger">Failed to load data. Please try again.</p>`;
                        console.error('Fetch error:', error);
                    });
            });
        });
    }

    initUniversityCard()
</script>
@endpush
