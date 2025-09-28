<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PFEC Global - Study Abroad</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #ff6b35;
            --secondary-orange: #ff8c42;
            --dark-orange: #e55a2b;
            --primary-purple: #5a4fcf;
            --light-purple: #9c88ff;
            --light-black: #383737;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .navbar-brand img {
            height: 35px;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #333;
            margin-right: 1rem;
            position: relative;
        }

        .navbar-nav .nav-link i {
            color: var(--primary-orange);
        }

        .navbar-nav .nav-link:after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: 5px;
            font-size: 12px;
        }

        .btn-orange {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-orange:hover {
            background-color: var(--dark-orange);
            border-color: var(--dark-orange);
            color: white;
        }

        .search-icon {
            background: none;
            border: none;
            color: var(--primary-orange);
            font-size: 18px;
            margin-right: 15px;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-purple) 0%, #6b5ce7 50%, var(--light-purple) 100%);
            color: white;
            padding: 80px 0 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            border-radius: 20px;
            top: 20%;
            left: 10%;
            transform: rotate(-15deg);
        }

        .hero-section::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
            border-radius: 15px;
            top: 30%;
            right: 15%;
            transform: rotate(25deg);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .search-container {
            background: white;
            border-radius: 50px;
            padding: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            align-items: center;
        }

        .search-input {
            border: none;
            outline: none;
            padding: 15px 20px;
            flex: 1;
            font-size: 16px;
            color: #666;
        }

        .search-input::placeholder {
            color: #999;
        }

        .country-dropdown {
            border: none;
            outline: none;
            padding: 15px 20px;
            background: none;
            color: #666;
            border-left: 1px solid #eee;
            cursor: pointer;
            position: relative;
        }

        .search-btn {
            background: var(--primary-orange);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            cursor: pointer;
            margin-right: 5px;
        }

        .main-content {
            padding: 40px 0;
        }

        .filter-sidebar {
            background: white;
            border-radius: 12px;
            padding: 25px;
            height: fit-content;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .filter-section {
            margin-bottom: 25px;
        }

        .filter-section h6 {
            font-weight: 600;
            margin-bottom: 15px;
            color: #666;
            cursor: pointer;
            position: relative;
        }

        .filter-section h6:after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 0;
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .filter-section.collapsed h6:after {
            transform: rotate(-90deg);
        }

        .filter-options {
            max-height: 200px;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .filter-options.collapse:not(.show) {
            max-height: 0;
            overflow: hidden;
        }

        .filter-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .filter-option input[type="checkbox"] {
            margin-right: 10px;
            accent-color: var(--primary-orange);
        }

        .filter-option label {
            cursor: pointer;
            font-size: 14px;
            color: #666;
        }

        .university-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .university-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            padding: 15px;
        }

        .university-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .university-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            position: relative;
            overflow: hidden;
        }

        .university-logo {
            position: absolute;
            top: 15px;
            left: 15px;
            background: white;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .university-details {
            padding: 15px;
            text-align: left;
        }

        .university-name {
            font-size: 1rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: var(--primary-orange);
        }

        .university-name:hover {
            color: var(--dark-orange);
        }

        .university-info {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            font-size: 0.85rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            white-space: nowrap;
            color: #555;
        }

        .info-item i {
            margin-right: 6px;
            font-size: 0.9rem;
            color: #444;
        }

        .footer {
            background-color: #ffffff;
            color: white;
            padding: 50px 0 20px 0;
        }

        .footer h5 {
            color: var(--primary-orange);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer a {
            color: #383737;
            text-decoration: none;
            margin-bottom: 8px;
            display: block;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-orange);
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons h6 {
            color: var(--primary-orange);
            margin-bottom: 15px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: var(--primary-orange);
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .social-icons a:hover {
            background-color: var(--dark-orange);
            color: white;
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid #34495e;
            padding-top: 20px;
            margin-top: 30px;
        }

        .footer-bottom p {
            margin: 0;
            color: #383737;
        }

        .footer-links {
            text-align: right;
        }

        .footer-links a {
            color: #383737;
            margin-left: 20px;
            display: inline;
        }

        .navbar-nav .dropdown-toggle::after {
            display: none !important;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .search-container {
                flex-direction: column;
                border-radius: 12px;
                padding: 20px;
            }

            .search-input, .country-dropdown {
                width: 100%;
                margin-bottom: 15px;
                border-left: none;
                border-bottom: 1px solid #eee;
            }

            .search-btn {
                width: 100%;
                border-radius: 8px;
                margin: 0;
            }

            .footer-links {
                text-align: center;
                margin-top: 20px;
            }

            .footer-links a {
                display: block;
                margin: 5px 0;
            }
        }

        @media (max-width: 992px) {
            .university-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 cards on tablet */
            }
        }

        @media (max-width: 576px) {
            .university-grid {
                grid-template-columns: 1fr; /* 1 card on mobile */
            }
            .university-name {
                font-size: 0.95rem;
            }
            .info-item {
                font-size: 0.85rem;
            }
        }

    </style>
</head>
<body style="background: #ffffff">
<!-- Navigation -->
@include('university.layouts.nav-bar')

<!-- Hero Section -->
@include('university.layouts.hero-section')

<!-- Main Content -->
<section class="main-content">
    <div class="container">
        <div class="row">
            <!-- Filter Sidebar -->
            @include('university.filter-sidebar')

            <!-- University Grid -->
            <div class="col-lg-9">
                <div class="university-grid">
                    <div class="university-card" data-country="australia" style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s, transform 0.5s;">
                        <div class="university-image" style="background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%)">
                            <div class="university-logo d-flex align-items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" width="50" height="50"
                                     alt="Deakin University Logo"
                                     class="me-2 rounded-circle logo-img">
                                <span>DEAKIN UNIVERSITY</span>
                            </div>


                        </div>
                        <div class="university-details">
                            <h6 class="university-name">Deakin University &gt;</h6>
                            <div class="university-info">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Australia
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    UG &amp; PG Programs
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-university"></i>
                                    5 Campuses Worldwide
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="university-card" data-country="australia" style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s, transform 0.5s;">
                        <div class="university-image" style="background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%)">
                            <div class="university-logo d-flex align-items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" width="50" height="50"
                                     alt="Deakin University Logo"
                                     class="me-2 rounded-circle logo-img">
                                <span>DEAKIN UNIVERSITY</span>
                            </div>


                        </div>
                        <div class="university-details">
                            <h6 class="university-name">Deakin University &gt;</h6>
                            <div class="university-info">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Australia
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    UG &amp; PG Programs
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-university"></i>
                                    5 Campuses Worldwide
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="university-card" data-country="australia" style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s, transform 0.5s;">
                        <div class="university-image" style="background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%)">
                            <div class="university-logo d-flex align-items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" width="50" height="50"
                                     alt="Deakin University Logo"
                                     class="me-2 rounded-circle logo-img">
                                <span>DEAKIN UNIVERSITY</span>
                            </div>


                        </div>
                        <div class="university-details">
                            <h6 class="university-name">Deakin University &gt;</h6>
                            <div class="university-info">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Australia
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    UG &amp; PG Programs
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-university"></i>
                                    5 Campuses Worldwide
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="university-card" data-country="australia" style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s, transform 0.5s;">
                        <div class="university-image" style="background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%)">
                            <div class="university-logo d-flex align-items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" width="50" height="50"
                                     alt="Deakin University Logo"
                                     class="me-2 rounded-circle logo-img">
                                <span>DEAKIN UNIVERSITY</span>
                            </div>


                        </div>
                        <div class="university-details">
                            <h6 class="university-name">Deakin University &gt;</h6>
                            <div class="university-info">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Australia
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    UG &amp; PG Programs
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-university"></i>
                                    5 Campuses Worldwide
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('university.contact-us')

<!-- Footer -->
@include('university.layouts.footer')

<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript -->
<script>
    // University data
    const universities = [
        {
            name: "Deakin University",
            country: "australia",
            logo: "DEAKIN UNIVERSITY",
            icon: "fas fa-graduation-cap",
            programs: "UG & PG Programs",
            campuses: "5 Campuses Worldwide",
            gradient: "linear-gradient(45deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%)"
        },
        {
            name: "The University of Sydney",
            country: "australia",
            logo: "THE UNIVERSITY OF SYDNEY",
            icon: "fas fa-star",
            programs: "UG & PG Programs",
            campuses: "11 Campuses",
            gradient: "linear-gradient(45deg, #fa709a 0%, #fee140 100%)"
        },
        {
            name: "University of Oxford",
            country: "uk",
            logo: "UNIVERSITY OF OXFORD",
            icon: "fas fa-crown",
            programs: "UG & PG Programs",
            campuses: "Historic Colleges",
            gradient: "linear-gradient(45deg, #a8edea 0%, #fed6e3 100%)"
        },
        {
            name: "Cambridge University",
            country: "uk",
            logo: "CAMBRIDGE UNIVERSITY",
            icon: "fas fa-graduation-cap",
            programs: "UG & PG Programs",
            campuses: "31 Colleges",
            gradient: "linear-gradient(45deg, #d299c2 0%, #fef9d7 100%)"
        },
        {
            name: "Harvard University",
            country: "usa",
            logo: "HARVARD UNIVERSITY",
            icon: "fas fa-university",
            programs: "UG & PG Programs",
            campuses: "Main Campus",
            gradient: "linear-gradient(45deg, #89f7fe 0%, #66a6ff 100%)"
        }
    ];

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

        // Country checkboxes
        countryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', filterByCheckboxes);
        });

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

    // Filter by checkboxes
    function filterByCheckboxes() {
        const checkedCountries = Array.from(countryCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        let filteredUniversities = universities;

        if (checkedCountries.length > 0) {
            filteredUniversities = filteredUniversities.filter(uni =>
                checkedCountries.includes(uni.country)
            );
        }

        renderUniversities(filteredUniversities);
        showResultsCount(filteredUniversities.length);
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

    // Form validation for consultation booking
    document.querySelector('.btn-orange').addEventListener('click', function(e) {
        e.preventDefault();

        // Simple booking form simulation
        const userConfirmed = confirm('Would you like to book a free consultation? This will redirect you to our booking page.');

        if (userConfirmed) {
            alert('Thank you for your interest! You would normally be redirected to our booking system.');
        }
    });

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
</body>
</html>
