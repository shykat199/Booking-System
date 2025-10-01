<div class="col-lg-3">
    <div class="filter-sidebar">
        <h5 class="filter-title">Filter Options</h5>

        <div class="filter-section">
            <h6 data-bs-toggle="collapse" data-bs-target="#studyAreaSorting">Sorting</h6>
            <div class="filter-options collapse" id="studyAreaSorting">
                <div class="filter-option">
                    <input class="form-check-input" type="radio" name="sortOption" id="sortNameAsc" value="name_asc">
                    <label class="form-check-label ms-2" for="sortNameAsc">Name (A–Z)</label>
                </div>
                <div class="filter-option">
                    <input class="form-check-input" type="radio" name="sortOption" id="sortNameDesc" value="name_desc">
                    <label class="form-check-label ms-2" for="sortNameDesc">Name (Z–A)</label>
                </div>
                <div class="filter-option">
                    <input class="form-check-input" type="radio" name="sortOption" id="sortCountryAsc" value="country_asc">
                    <label class="form-check-label ms-2" for="sortCountryAsc">Country (A–Z)</label>
                </div>
                <div class="filter-option">
                    <input class="form-check-input" type="radio" name="sortOption" id="sortCountryDesc" value="country_desc">
                    <label class="form-check-label ms-2" for="sortCountryDesc">Country (Z–A)</label>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <h6 data-bs-toggle="collapse" data-bs-target="#countriesFilter">Countries</h6>
            <div class="filter-options collapse show" id="countriesFilter">
                @foreach($countries as $country)
                    <div class="filter-option">
                        <input type="checkbox" class="country-checkbox" id="country-{{$country->id}}" value="{{$country->id}}">
                        <label for="country-{{$country->id}}">{{$country->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="filter-section">
            <h6 data-bs-toggle="collapse" data-bs-target="#studyAreaFilter">Study Area</h6>
            <div class="filter-options collapse" id="studyAreaFilter">
                <div class="filter-option">
                    <input type="checkbox" id="engineering" value="engineering">
                    <label for="engineering">Engineering</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="business" value="business">
                    <label for="business">Business</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="medicine" value="medicine">
                    <label for="medicine">Medicine</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="arts" value="arts">
                    <label for="arts">Arts</label>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <h6 data-bs-toggle="collapse" data-bs-target="#studyLevelFilter">Study Level</h6>
            <div class="filter-options collapse" id="studyLevelFilter">
                <div class="filter-option">
                    <input type="checkbox" id="undergraduate" value="undergraduate">
                    <label for="undergraduate">Undergraduate</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="graduate" value="graduate">
                    <label for="graduate">Graduate</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="phd" value="phd">
                    <label for="phd">PhD</label>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <h6 data-bs-toggle="collapse" data-bs-target="#testPrepFilter">Test Prep</h6>
            <div class="filter-options collapse" id="testPrepFilter">
                <div class="filter-option">
                    <input type="checkbox" id="ielts" value="ielts">
                    <label for="ielts">IELTS</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="toefl" value="toefl">
                    <label for="toefl">TOEFL</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="gre" value="gre">
                    <label for="gre">GRE</label>
                </div>
            </div>
        </div>
    </div>
</div>
@push('university.script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const universityGrid = document.getElementById('universityGrid');
            const loader = document.getElementById('filterLoader');
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            let offset = 0;
            let selectedCountries = [];
            let selectedSort = null;

            function fetchFilteredUniversities() {
                loader.style.display = 'flex';

                const params = new URLSearchParams();
                params.append('offset', offset);

                selectedCountries.forEach(id => params.append('countries[]', id));

                if (selectedSort) {
                    params.append('sort', selectedSort);
                }

                fetch(`{{ route('university.filter') }}?${params.toString()}`)
                    .then(res => res.json())
                    .then(data => {
                        universityGrid.innerHTML = data.html;
                        loader.style.display = 'none';
                        loadMoreBtn.style.display = 'none';
                    })
                    .catch(err => {
                        console.error(err);
                        loader.style.display = 'none';
                    });
            }

            // Country filter change
            document.querySelectorAll('.country-checkbox').forEach(cb => {
                cb.addEventListener('change', function() {
                    selectedCountries = Array.from(document.querySelectorAll('.country-checkbox:checked'))
                        .map(el => el.value);
                    offset = 0; // reset
                    fetchFilteredUniversities();
                });
            });

            // Sorting radio change
            document.querySelectorAll('input[name="sortOption"]').forEach(rb => {
                rb.addEventListener('change', function() {
                    selectedSort = this.value; // save selected radio value
                    offset = 0; // reset
                    fetchFilteredUniversities();
                });
            });
        });
    </script>
@endpush
