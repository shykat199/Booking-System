<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Explore Top Universities Abroad</h1>
            <div class="search-container">
                <i class="fas fa-search" style="color: #999; margin-left: 20px;"></i>
                <input type="text" class="search-input" placeholder="Search Universities, Courses" id="universitySearch">
                <select class="country-dropdown" id="countryFilter">
                    <option value="">Choose Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
                <button class="search-btn" id="searchBtn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</section>
