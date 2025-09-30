<div class="university-card-wrapper">
    <div class="university-card"
         data-country="{{ strtolower(getCountryName($university)) }}"
         style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s, transform 0.5s;">

        <div class="university-image"
             style="background-image: url('{{ getValue($university, 'image') ? asset('images/universities/' . getValue($university, 'image')) : asset('assets/default-university.jpg') }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;">
            <div class="university-logo d-flex align-items-center">
                <img src="{{ getValue($university, 'logo') ? asset('images/universities/' . getValue($university, 'logo')) : asset('assets/default-university.jpg') }}"
                     width="50" height="50"
                     alt="{{ getFormatted($university, 'name') }} Logo"
                     class="me-2 rounded-circle logo-img">
                <span>{!! getFormatted($university, 'name') !!}</span>
            </div>
        </div>

        <div class="university-details">
            <h6 class="university-name">{!! getFormatted($university, 'name') !!}</h6>
            <div class="university-info">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    {!! getFormatted($university, 'country') ?? getCountryName($university) !!}
                </div>
                <div class="info-item">
                    <i class="fas fa-id-badge"></i>
                    {{ getValue($university, 'cricos') ?? 'N/A' }}
                </div>
                <div class="info-item">
                    <i class="fas fa-university"></i>
                    {{ getValue($university, 'campus_count') ?? 0 }} Campuses Worldwide
                </div>
            </div>
        </div>
    </div>
</div>
