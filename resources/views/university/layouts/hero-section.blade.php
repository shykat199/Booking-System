<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Explore Top Universities Abroad</h1>
            <form method="get" action="{{route('university.home')}}">
                <div class="search-container search-bar">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" name="q" placeholder="Search Universities, Courses"
                               id="universitySearch" value="{{ request('q') ?? '' }}">
                    </div>
                    <select class="country-dropdown" name="country" id="countryFilter">
                        <option value="">Choose Country</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" {{request('country') == $country->id ? 'selected':''}}>{{$country->name}}</option>
                        @endforeach
                    </select>
                    <button class="search-btn" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
