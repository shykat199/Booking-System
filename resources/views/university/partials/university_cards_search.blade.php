<div class="university-card-wrapper">
    <div class="university-card" data-id="{{ getFormatted($university, 'id') }}"
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
                    {!! getCountryName($university) !!}
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

<!-- University Details Modal -->
<div class="modal fade" id="universityModal" tabindex="-1" aria-labelledby="universityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="universityModalLabel">University Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">

                <div id="modalLoader" class="d-flex justify-content-center align-items-center" style="height: 300px;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div id="universityModalContent" class="d-none p-4">

                </div>
            </div>
        </div>
    </div>
</div>
