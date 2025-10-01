@extends('university.layouts.app')

@section('university-content')

    <div class="col-lg-9">
        <div class="university-grid" id="universityGrid">
            @forelse ($universities as $university)
               @include('university.partials.university_cards',['university'=>$university])
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> No universities found.
                    </div>
                </div>
            @endforelse
        </div>
        @if($universities->count() > 0)
            <div style="text-align:center; margin:1.5rem 0;">
                <button id="loadMoreBtn"
                        style="
            font-family: Poppins, sans-serif;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.5;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: #e55a2b;
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            justify-content: center;  /* center content horizontally */
            align-items: center;      /* center content vertically */
            gap: 8px;
            box-shadow: 0 6px 16px rgba(99,102,241,.3);
            transition: all 0.3s ease;
            min-width: 200px;
        "
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(99,102,241,.35)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 16px rgba(99,102,241,.3)';"
                >
                    <span class="btn-text">Load More</span>
                    <span class="spinner-border spinner-border-sm d-none"
                          style="width:16px; height:16px; border-width:2px; border-color:#fff transparent transparent transparent;"
                          role="status" aria-hidden="true"
                    ></span>
                </button>
            </div>
        @endif

    </div>
@endsection
@push('university.script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const universityGrid = document.getElementById('universityGrid');
            let offset = {{ $universities->count() }};
            const total = {{ $total }};

            loadMoreBtn.addEventListener('click', function() {
                const spinner = this.querySelector('.spinner-border');
                spinner.classList.remove('d-none');

                fetch(`{{ route('university.loadMore') }}?offset=${offset}`)
                    .then(res => res.json())
                    .then(data => {
                        universityGrid.insertAdjacentHTML('beforeend', data.html);
                        offset += 10;

                        if (data.allLoaded) {
                            loadMoreBtn.style.display = 'none';
                        }

                        spinner.classList.add('d-none');
                        initUniversityCard();
                    })
                    .catch(err => {
                        console.error(err);
                        spinner.classList.add('d-none');
                    });
            });

            if (offset >= total) {
                loadMoreBtn.style.display = 'none';
            }
        });

        function toggleArea(header) {
            const body = header.nextElementSibling;
            const icon = header.querySelector('.area-toggle i');

            // Toggle active class on header
            header.classList.toggle('active');

            if (body.classList.contains('d-none')) {
                body.classList.remove('d-none');
                body.classList.add('d-block');
                if (icon) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            } else if (body.classList.contains('d-block')) {
                body.classList.remove('d-block');
                body.classList.add('d-none');
                if (icon) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            } else {
                body.classList.add('d-block');
                if (icon) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            }
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
