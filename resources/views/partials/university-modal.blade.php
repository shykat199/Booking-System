<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .university-modal-wrapper {
        background:#f8f9fa;
        font-family:Arial,Helvetica,sans-serif;
    }

    /* HERO */
    .modal-hero {height:350px;position:relative;}
    .hero-bg {
        position:absolute;top:0;left:0;right:0;bottom:0;
        background:no-repeat center/cover;
    }
    .hero-overlay {
        position:absolute;top:0;left:0;right:0;bottom:0;
        background:linear-gradient(135deg,rgba(99,102,241,0.95),rgba(168,85,247,0.95));
    }
    .hero-content-area {
        height:100%;display:flex;align-items:center;position:relative;z-index:2;
    }
    .hero-inner {padding:3rem 1.5rem;}
    .hero-flex {display:flex;align-items:center;gap:2rem;flex-wrap:wrap;}
    .logo-wrapper {position:relative;width:140px;height:140px;}
    .logo-wrapper img {
        width:140px;height:140px;border-radius:24px;object-fit:cover;
        background:#fff;padding:12px;
        box-shadow:0 20px 60px rgba(0,0,0,.3);
        border:4px solid rgba(255,255,255,.9);
        position:relative;z-index:2;
    }
    .logo-glow {
        position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
        width:160px;height:160px;border-radius:50%;
        background:radial-gradient(circle,rgba(255,255,255,.4),transparent 70%);
    }
    .hero-text {color:#fff;}
    .hero-text h1 {
        font-size:2.5rem;font-weight:800;margin:0;
        text-shadow:0 4px 12px rgba(0,0,0,0.2);
    }
    .hero-tags {
        display:flex;flex-wrap:wrap;gap:12px;margin-top:16px;
    }
    .hero-tags span {
        background:rgba(255,255,255,0.25);
        backdrop-filter:blur(10px);
        padding:10px 18px;border-radius:50px;font-size:14px;font-weight:600;
        display:inline-flex;align-items:center;gap:8px;
        border:1px solid rgba(255,255,255,0.3);
    }
    .hero-wave {position:absolute;bottom:-1px;left:0;width:100%;overflow:hidden;line-height:0;z-index:3;}
    .hero-wave svg {width:100%;height:60px;}

    /* MAIN */
    .modal-main {padding:40px 0;}
    .main-inner {padding:0 1.5rem;}

    /* Stats */
    .stats-grid {
        display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
        gap:24px;margin-top:-60px;z-index:5;position:relative;
    }
    .stat-box {
        background:#fff;border-radius:20px;padding:28px;
        display:flex;align-items:center;gap:20px;
        box-shadow:0 8px 30px rgba(0,0,0,0.08);
    }
    .stat-icon {
        width:70px;height:70px;border-radius:16px;
        display:flex;align-items:center;justify-content:center;
        font-size:28px;color:#fff;
    }
    .stat-box.purple .stat-icon {background:linear-gradient(135deg,#6366f1,#8b5cf6);}
    .stat-box.green .stat-icon {background:linear-gradient(135deg,#10b981,#059669);}
    .stat-box.orange .stat-icon {background:linear-gradient(135deg,#f59e0b,#d97706);}
    .stat-box.blue .stat-icon {background:linear-gradient(135deg,#3b82f6,#2563eb);}
    .stat-value {font-size:32px;font-weight:800;color:#1f2937;}
    .stat-country {font-size:18px;font-weight:700;color:#1f2937;}
    .stat-label {font-size:13px;color:#6b7280;font-weight:600;text-transform:uppercase;}

    /* Cards */
    .content-card {
        background:#fff;border-radius:24px;padding:40px;
        box-shadow:0 4px 20px rgba(0,0,0,0.06);margin:30px 0;
    }
    .card-header {display:flex;align-items:center;gap:16px;margin-bottom:32px;}
    .card-header i {
        width:50px;height:50px;border-radius:12px;
        display:flex;align-items:center;justify-content:center;
        color:#fff;font-size:22px;
    }
    .card-header.purple i {background:linear-gradient(135deg,#6366f1,#8b5cf6);}
    .card-header.green i {background:linear-gradient(135deg,#10b981,#059669);}
    .card-header h3 {font-size:26px;font-weight:800;color:#1f2937;margin:0;}
    .divider {flex:1;height:3px;background:linear-gradient(90deg,#e5e7eb,transparent);border-radius:2px;}

    /* Programs */
    .program-box {border:1px solid #e5e7eb;border-radius:16px;margin-bottom:20px;overflow:hidden;}
    .program-header {
        display: flex;
        justify-content: space-between; /* Push icon to far right */
        align-items: center;
        padding: 12px 15px; /* add right padding */
        cursor: pointer;
    }
    .program-header.active {font-weight:700;}
    .program-info {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1; /* take full remaining space */
        min-width: 0; /* prevents text overflow */
    }
    .program-icon {
        width:50px;height:50px;background:#eef2ff;color:#6366f1;
        border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;
    }

    .program-header i.fas {
        font-size: 14px; /* smaller on mobile */
    }
    .program-body {padding:20px;background:#fff;display:none;}
    .study-grid {display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;}
    .study-box {
        border:1px solid #e5e7eb;border-radius:16px;padding:20px;
        display:flex;flex-direction:column;gap:12px;
        box-shadow:0 2px 6px rgba(0,0,0,.05);
    }
    .study-header {display:flex;align-items:center;gap:12px;}
    .study-icon {
        width:40px;height:40px;background:#e0f2fe;color:#0284c7;
        border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;
    }
    .study-header h5 {margin:0;font-size:16px;font-weight:700;color:#1f2937;}
    .study-tag {font-size:12px;background:#d1fae5;color:#047857;padding:2px 8px;border-radius:8px;}
    .study-meta {display:flex;flex-wrap:wrap;gap:12px;font-size:14px;color:#374151;}
    .no-data {grid-column:1/-1;text-align:center;color:#6b7280;padding:20px;}
    .no-data.large {padding:40px;}
    .btn-primary {
        margin-top:auto;align-self:flex-start;padding:10px 16px;
        background:#6366f1;color:#fff;border:none;border-radius:8px;
        cursor:pointer;font-size:14px;font-weight:600;
        display:flex;align-items:center;gap:8px;
    }

    /* Actions */
    .actions {display:flex;flex-wrap:wrap;gap:16px;justify-content:center;margin-top:40px;}
    .actions button {
        padding:14px 28px;border:none;border-radius:12px;color:#fff;
        font-weight:600;font-size:15px;display:flex;align-items:center;gap:10px;
        cursor:pointer;
    }
    .btn-purple {background:linear-gradient(135deg,#6366f1,#8b5cf6);box-shadow:0 6px 16px rgba(99,102,241,.3);}
    .btn-green {background:linear-gradient(135deg,#10b981,#059669);box-shadow:0 6px 16px rgba(16,185,129,.3);}
    .btn-orange {background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 6px 16px rgba(245,158,11,.3);}

    /* RESPONSIVE */
    @media(max-width:768px){
        .hero-flex {flex-direction:column;text-align:center;}
        .logo-wrapper {margin:auto;}
        .hero-text h1 {font-size:1.8rem;}
        .stats-grid {margin-top:20px;}
        .content-card {padding:20px;}
        .study-grid {grid-template-columns:1fr;}
    }
</style>

<div class="university-modal-wrapper">

    <!-- Hero Section -->
    <div class="modal-hero">
        <div class="hero-bg"
             style="background-image:url('{{ $university->image ? asset('images/' . $university->image) : asset('assets/default-university.jpg') }}')">
        </div>
        <div class="hero-overlay"></div>

        <div class="hero-content-area">
            <div class="hero-inner">
                <div class="hero-flex">
                    <div>
                        <div class="logo-wrapper">
                            <img src="{{ $university->logo ? asset('images/' . $university->logo) : asset('assets/default-university.jpg') }}"
                                 alt="{{$university->name}}">
                            <div class="logo-glow"></div>
                        </div>
                    </div>
                    <div class="hero-text">
                        <h1>{{$university->name}}</h1>
                        <div class="hero-tags">
                            <span><i class="fas fa-map-marker-alt"></i> {{$university->city->name}}, {{$university->country->name}}</span>
                            <span><i class="fas fa-id-card"></i> CRICOS: {{$university->cricos ?? 'N/A'}}</span>
                            <span><i class="fas fa-building"></i> {{$university->campus_count}} Campuses</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="modal-main">
        <div class="main-inner">

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-box purple">
                    <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div>
                        <div class="stat-value">{{$university->study_areas_count ?? 0}}</div>
                        <div class="stat-label">Study Areas</div>
                    </div>
                </div>
                <div class="stat-box green">
                    <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                    <div>
                        <div class="stat-value">{{$availableProgramCount}}</div>
                        <div class="stat-label">Programs Available</div>
                    </div>
                </div>
                <div class="stat-box orange">
                    <div class="stat-icon"><i class="fas fa-university"></i></div>
                    <div>
                        <div class="stat-value">{{$university->campus_count}}</div>
                        <div class="stat-label">Global Campuses</div>
                    </div>
                </div>
                <div class="stat-box blue">
                    <div class="stat-icon"><i class="fas fa-globe-americas"></i></div>
                    <div>
                        <div class="stat-country">{{$university->country->name}}</div>
                        <div class="stat-label">Location</div>
                    </div>
                </div>
            </div>

            <!-- About -->
            <div class="content-card">
                <div class="card-header purple">
                    <i class="fas fa-info-circle"></i>
                    <h3>About the University</h3>
                    <div class="divider"></div>
                </div>
                <p>{!! $university->description !!}</p>
            </div>

            <!-- Programs -->
            <div class="content-card">
                <div class="card-header green">
                    <i class="fas fa-book-reader"></i>
                    <h3>Programs & Study Areas</h3>
                    <div class="divider"></div>
                </div>

                <div>
                    @forelse($universityPrograms as $key => $program)
                        <div class="program-box">
                            <div class="program-header {{$key==0?'active':''}}" onclick="toggleArea(this)">
                                <div class="program-info">
                                    <div class="program-icon"><i class="fas fa-laptop-code"></i></div>
                                    <div>
                                        <h4>{{$program->name}}</h4>
                                        <p>{{$program->study_areas_count}} programs available</p>
                                    </div>
                                </div>
                                <div><i class="fas fa-chevron-down"></i></div>
                            </div>

                            <div class="program-body" style="{{$key==0?'display:block;':''}}">
                                <div class="study-grid">
                                    @forelse($program->studyAreas as $pKey => $studyItem)
                                        <div class="study-box">
                                            <div class="study-header">
                                                <div class="study-icon"><i class="fas fa-certificate"></i></div>
                                                <div>
                                                    <h5>{{$studyItem->name}}</h5>
                                                    <span class="study-tag">Undergraduate</span>
                                                </div>
                                            </div>
                                            <div class="study-meta">
                                                <div><i class="fas fa-clock"></i> {{$program->duration ?? 'N/A'}} Years</div>
                                                <div><i class="fas fa-dollar-sign"></i> $35,000/year</div>
                                                <div><i class="fas fa-calendar-alt"></i> Feb, Jul, Nov</div>
                                            </div>
                                            <button class="btn-primary">
                                                View Details <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    @empty
                                        <div class="no-data">
                                            <i class="fas fa-info-circle fa-2x"></i>
                                            <p>No programs available in this study area.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-data large">
                            <i class="fas fa-university fa-3x"></i>
                            <p>No programs found for this university.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <button class="btn-purple"><i class="fas fa-paper-plane"></i> Apply Now</button>
                <button class="btn-green"><i class="fas fa-download"></i> Download Brochure</button>
                <button class="btn-orange"><i class="fas fa-envelope"></i> Contact University</button>
            </div>
        </div>
    </div>
</div>

