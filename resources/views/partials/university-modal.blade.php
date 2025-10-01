<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="university-modal-wrapper" style="background:#f8f9fa;font-family:Arial,Helvetica,sans-serif;">

    <!-- Hero Section -->
    <div class="modal-hero" style="height:350px;position:relative;">
        <div class="hero-bg" style="position:absolute;top:0;left:0;right:0;bottom:0;background:url('{{ $university->image ? asset('images/universities/' . $university->image) : asset('assets/default-university.jpg') }}') no-repeat center/cover;"></div>
        <div class="hero-overlay" style="position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(135deg,rgba(99,102,241,0.95),rgba(168,85,247,0.95));"></div>

        <div class="hero-content" style="height:100%;display:flex;align-items:center;position:relative;z-index:2;">
            <div style="padding:3rem 1.5rem;">
                <div style="display:flex;align-items:center;gap:2rem;">
                    <div>
                        <div class="logo-wrapper" style="position:relative;width:140px;height:140px;">
                            <img src="{{ $university->logo ? asset('images/universities/' . $university->logo) : asset('assets/default-university.jpg') }}"
                                 alt="{{$university->name}}"
                                 style="width:140px;height:140px;border-radius:24px;object-fit:cover;background:#fff;padding:12px;box-shadow:0 20px 60px rgba(0,0,0,.3);border:4px solid rgba(255,255,255,.9);position:relative;z-index:2;">
                            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:160px;height:160px;background:radial-gradient(circle,rgba(255,255,255,.4),transparent 70%);border-radius:50%;"></div>
                        </div>
                    </div>
                    <div style="color:#fff;">
                        <h1 style="font-size:2.5rem;font-weight:800;margin:0;text-shadow:0 4px 12px rgba(0,0,0,0.2);">{{$university->name}}</h1>
                        <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:16px;">
                            <span style="background:rgba(255,255,255,0.25);backdrop-filter:blur(10px);padding:10px 18px;border-radius:50px;font-size:14px;font-weight:600;display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(255,255,255,0.3);">
                                <i class="fas fa-map-marker-alt"></i> {{$university->city->name}}, {{$university->country->name}}
                            </span>
                            <span style="background:rgba(255,255,255,0.25);backdrop-filter:blur(10px);padding:10px 18px;border-radius:50px;font-size:14px;font-weight:600;display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(255,255,255,0.3);">
                                <i class="fas fa-id-card"></i> CRICOS: {{$university->cricos ?? 'N/A'}}
                            </span>
                            <span style="background:rgba(255,255,255,0.25);backdrop-filter:blur(10px);padding:10px 18px;border-radius:50px;font-size:14px;font-weight:600;display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(255,255,255,0.3);">
                                <i class="fas fa-building"></i> {{$university->campus_count}} Campuses
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="position:absolute;bottom:-1px;left:0;width:100%;overflow:hidden;line-height:0;z-index:3;">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width:100%;height:60px;">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#f8f9fa"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div style="padding:40px 0;">
        <div style="padding:0 1.5rem;">

            <!-- Stats -->
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:24px;margin-top:-60px;z-index:5;position:relative;">
                <div style="background:#fff;border-radius:20px;padding:28px;display:flex;align-items:center;gap:20px;box-shadow:0 8px 30px rgba(0,0,0,0.08);">
                    <div style="width:70px;height:70px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;color:#fff;background:linear-gradient(135deg,#6366f1,#8b5cf6);">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <div style="font-size:32px;font-weight:800;color:#1f2937;">{{$university->study_areas_count ?? 0}}</div>
                        <div style="font-size:13px;color:#6b7280;font-weight:600;text-transform:uppercase;">Study Areas</div>
                    </div>
                </div>
                <div style="background:#fff;border-radius:20px;padding:28px;display:flex;align-items:center;gap:20px;box-shadow:0 8px 30px rgba(0,0,0,0.08);">
                    <div style="width:70px;height:70px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;color:#fff;background:linear-gradient(135deg,#10b981,#059669);">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div>
                        <div style="font-size:32px;font-weight:800;color:#1f2937;">{{$availableProgramCount}}</div>
                        <div style="font-size:13px;color:#6b7280;font-weight:600;text-transform:uppercase;">Programs Available</div>
                    </div>
                </div>
                <div style="background:#fff;border-radius:20px;padding:28px;display:flex;align-items:center;gap:20px;box-shadow:0 8px 30px rgba(0,0,0,0.08);">
                    <div style="width:70px;height:70px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;color:#fff;background:linear-gradient(135deg,#f59e0b,#d97706);">
                        <i class="fas fa-university"></i>
                    </div>
                    <div>
                        <div style="font-size:32px;font-weight:800;color:#1f2937;">{{$university->campus_count}}</div>
                        <div style="font-size:13px;color:#6b7280;font-weight:600;text-transform:uppercase;">Global Campuses</div>
                    </div>
                </div>
                <div style="background:#fff;border-radius:20px;padding:28px;display:flex;align-items:center;gap:20px;box-shadow:0 8px 30px rgba(0,0,0,0.08);">
                    <div style="width:70px;height:70px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;color:#fff;background:linear-gradient(135deg,#3b82f6,#2563eb);">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <div>
                        <div style="font-size:18px;font-weight:700;color:#1f2937;">{{$university->country->name}}</div>
                        <div style="font-size:13px;color:#6b7280;font-weight:600;text-transform:uppercase;">Location</div>
                    </div>
                </div>
            </div>

            <!-- About -->
            <div style="background:#fff;border-radius:24px;padding:40px;box-shadow:0 4px 20px rgba(0,0,0,0.06);margin:30px 0;">
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:32px;">
                    <div style="width:50px;height:50px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 style="font-size:26px;font-weight:800;color:#1f2937;margin:0;">About the University</h3>
                    <div style="flex:1;height:3px;background:linear-gradient(90deg,#e5e7eb,transparent);border-radius:2px;"></div>
                </div>
                <p style="font-size:16px;line-height:1.8;color:#4b5563;margin:0;">{!! $university->description !!}</p>
            </div>

            <!-- Programs -->
            <div style="background:#fff;border-radius:24px;padding:40px;box-shadow:0 4px 20px rgba(0,0,0,0.06);margin:30px 0;">
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:32px;">
                    <div style="width:50px;height:50px;background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <h3 style="font-size:26px;font-weight:800;color:#1f2937;margin:0;">Programs & Study Areas</h3>
                    <div style="flex:1;height:3px;background:linear-gradient(90deg,#e5e7eb,transparent);border-radius:2px;"></div>
                </div>

                <div>
                    @forelse($universityPrograms as $key => $program)
                        <div style="border:1px solid #e5e7eb;border-radius:16px;margin-bottom:20px;overflow:hidden;">
                            <div onclick="toggleArea(this)" style="cursor:pointer;background:#f9fafb;padding:20px;display:flex;align-items:center;justify-content:space-between;{{$key==0?'font-weight:700;':''}}">
                                <div style="display:flex;align-items:center;gap:16px;">
                                    <div style="width:50px;height:50px;background:#eef2ff;color:#6366f1;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin:0;font-size:18px;font-weight:700;color:#1f2937;">{{$program->name}}</h4>
                                        <p style="margin:0;font-size:14px;color:#6b7280;">{{$program->study_areas_count}} programs available</p>
                                    </div>
                                </div>
                                <div><i class="fas fa-chevron-down"></i></div>
                            </div>

                            <div style="{{$key==0?'display:block;':'display:none;'}}padding:20px;background:#fff;">
                                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
                                    @forelse($program->studyAreas as $pKey => $studyItem)
                                        <div style="border:1px solid #e5e7eb;border-radius:16px;padding:20px;display:flex;flex-direction:column;gap:12px;box-shadow:0 2px 6px rgba(0,0,0,.05);">
                                            <div style="display:flex;align-items:center;gap:12px;">
                                                <div style="width:40px;height:40px;background:#e0f2fe;color:#0284c7;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;">
                                                    <i class="fas fa-certificate"></i>
                                                </div>
                                                <div>
                                                    <h5 style="margin:0;font-size:16px;font-weight:700;color:#1f2937;">{{$studyItem->name}}</h5>
                                                    <span style="font-size:12px;background:#d1fae5;color:#047857;padding:2px 8px;border-radius:8px;">Undergraduate</span>
                                                </div>
                                            </div>
                                            <div style="display:flex;flex-wrap:wrap;gap:12px;font-size:14px;color:#374151;">
                                                <div><i class="fas fa-clock"></i> {{$program->duration ?? 'N/A'}} Years</div>
                                                <div><i class="fas fa-dollar-sign"></i> $35,000/year</div>
                                                <div><i class="fas fa-calendar-alt"></i> Feb, Jul, Nov</div>
                                            </div>
                                            <button style="margin-top:auto;align-self:flex-start;padding:10px 16px;background:#6366f1;color:#fff;border:none;border-radius:8px;cursor:pointer;font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;">
                                                View Details <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    @empty
                                        <div style="grid-column:1/-1;text-align:center;color:#6b7280;padding:20px;">
                                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                                            <p>No programs available in this study area.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center;color:#6b7280;padding:40px;">
                            <i class="fas fa-university fa-3x mb-3"></i>
                            <p>No programs found for this university.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Actions -->
            <div style="display:flex;flex-wrap:wrap;gap:16px;justify-content:center;margin-top:40px;">
                <button style="padding:14px 28px;border:none;border-radius:12px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;font-weight:600;font-size:15px;display:flex;align-items:center;gap:10px;cursor:pointer;box-shadow:0 6px 16px rgba(99,102,241,.3);">
                    <i class="fas fa-paper-plane"></i> Apply Now
                </button>
                <button style="padding:14px 28px;border:none;border-radius:12px;background:linear-gradient(135deg,#10b981,#059669);color:#fff;font-weight:600;font-size:15px;display:flex;align-items:center;gap:10px;cursor:pointer;box-shadow:0 6px 16px rgba(16,185,129,.3);">
                    <i class="fas fa-download"></i> Download Brochure
                </button>
                <button style="padding:14px 28px;border:none;border-radius:12px;background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;font-weight:600;font-size:15px;display:flex;align-items:center;gap:10px;cursor:pointer;box-shadow:0 6px 16px rgba(245,158,11,.3);">
                    <i class="fas fa-envelope"></i> Contact University
                </button>
            </div>
        </div>
    </div>
</div>

