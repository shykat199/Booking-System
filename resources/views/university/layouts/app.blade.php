<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PFEC Global - Study Abroad</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/university.css')}}" media="screen"/>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?compat=recaptcha" async defer></script>

    @stack('university.style')

</head>
<body style="background: #ffffff">
<!-- Navigation -->
@include('university.layouts.nav-bar')

<!-- Hero Section -->
@include('university.layouts.hero-section')

<!-- Main Content -->
<section class="main-content">
    <div class="container">
        <div class="row position-relative">
            <!-- Filter Sidebar -->
            @include('university.filter-sidebar')

           @section('university-content')

           @show

        </div>

        <div id="filterLoader">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</section>

@include('university.contact-us')

<!-- Footer -->
@include('university.layouts.footer')

<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JavaScript -->
<script>

    // DOM Elements
    const universityGrid = document.getElementById('universityGrid');
    const searchInput = document.getElementById('universitySearch');
    const countryFilter = document.getElementById('countryFilter');
    const searchBtn = document.getElementById('searchBtn');
    const countryCheckboxes = document.querySelectorAll('#countriesFilter input[type="checkbox"]');

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {

        setupEventListeners();
        setupFilterToggle();
    });

    // Setup event listeners
    function setupEventListeners() {
        // Search functionality
        searchBtn.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Country filter dropdown
        countryFilter.addEventListener('change', filterByCountry);

        // University name click
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('university-name')) {
                alert(`More details about ${e.target.textContent.replace(' >', '')}`);
            }
        });
    }

    // Setup filter toggle functionality
    function setupFilterToggle() {
        const filterHeaders = document.querySelectorAll('.filter-section h6');

        filterHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const filterSection = this.parentElement;
                filterSection.classList.toggle('collapsed');
            });
        });
    }

    // Perform search
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCountry = countryFilter.value;

        let filteredUniversities = universities;

        // Filter by search term
        if (searchTerm) {
            filteredUniversities = filteredUniversities.filter(uni =>
                uni.name.toLowerCase().includes(searchTerm) ||
                uni.country.toLowerCase().includes(searchTerm) ||
                uni.programs.toLowerCase().includes(searchTerm)
            );
        }

        // Filter by country dropdown
        if (selectedCountry) {
            filteredUniversities = filteredUniversities.filter(uni =>
                uni.country === selectedCountry
            );
        }

        renderUniversities(filteredUniversities);

        // Show results count
        showResultsCount(filteredUniversities.length);
    }

    // Filter by country dropdown
    function filterByCountry() {
        performSearch();
    }


    // Show results count
    function showResultsCount(count) {
        // Remove existing results count
        const existingCount = document.querySelector('.results-count');
        if (existingCount) {
            existingCount.remove();
        }

        // Add new results count
        const resultsCount = document.createElement('div');
        resultsCount.className = 'results-count mb-3';
        resultsCount.innerHTML = `<p class="text-muted">Showing ${count} universities</p>`;

        const gridContainer = universityGrid.parentElement;
        gridContainer.insertBefore(resultsCount, universityGrid);
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Mobile search toggle
    const searchToggle = document.getElementById('searchToggle');
    if (searchToggle) {
        searchToggle.addEventListener('click', function() {
            // Scroll to hero section search
            document.querySelector('.hero-section').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    // Lazy loading simulation for university images
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '50px'
    };

    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const card = entry.target;
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe university cards for animation
    function observeCards() {
        document.querySelectorAll('.university-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            imageObserver.observe(card);
        });
    }

    // Add loading animation
    function showLoading() {
        universityGrid.innerHTML = '<div class="text-center p-5"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><p class="mt-2">Loading universities...</p></div>';
    }

    // Social media link handlers
    document.querySelectorAll('.social-icons a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const platform = this.querySelector('i').classList[1].split('-')[1];
            alert(`This would open ${platform.charAt(0).toUpperCase() + platform.slice(1)} in a new window.`);
        });
    });

    // Footer link handlers
    document.querySelectorAll('.footer a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.getAttribute('href') || this.getAttribute('href') === '#') {
                e.preventDefault();
                alert(`This would navigate to: ${this.textContent}`);
            }
        });
    });

    console.log('PFEC Global website loaded successfully!');
</script>
@stack('university.script')
</body>
</html>
