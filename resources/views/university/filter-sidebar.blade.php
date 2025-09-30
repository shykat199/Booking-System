<div class="col-lg-3">
    <div class="filter-sidebar">
        <h5 class="filter-title">Filter Options</h5>

        <div class="filter-section">
            <h6 data-bs-toggle="collapse" data-bs-target="#countriesFilter">Countries</h6>
            <div class="filter-options collapse show" id="countriesFilter">
                @foreach($countries as $country)
                    <div class="filter-option">
                        <input type="checkbox" id="{{$country->id}}" value="{{$country->id}}">
                        <label for="{{$country->id}}">{{$country->name}}</label>
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
