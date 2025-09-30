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
            <div class="text-center mt-4">
                <button id="loadMoreBtn" class="btn btn-orange">
                    <span class="btn-text">Load More</span>
                    <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
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
    </script>

@endpush
