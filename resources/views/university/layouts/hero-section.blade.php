<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Explore Top Universities Abroad</h1>
<<<<<<< HEAD
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
=======
            <form method="get" action="{{route('university.home')}}">
                <div class="search-container">
                    <i class="fas fa-search" style="color: #999; margin-left: 20px;"></i>
                    <input type="text" name="q" class="search-input" placeholder="Search Universities, Courses" id="universitySearch" value="{{ request('q') ?? '' }}">
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
            </form>
>>>>>>> 767dad89759f212545bf68a3618d015122b5327f
        </div>
    </div>
</section>
