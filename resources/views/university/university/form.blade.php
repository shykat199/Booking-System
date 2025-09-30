@extends('layouts.app')
@section('page-title','University Action')
@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <style>
        .img-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .img-preview img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .existing-image:hover .delete-image {
            display: block;
        }

    </style>
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2> {{isset($blog) ? 'Update '. \Illuminate\Support\Str::limit($blog->title,20,'...')  : 'Create New University'}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="universityForm" action="{{ isset($university) ? route('update-university', $university->id) : route('save-university') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($university))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="country_id" class="form-label">Country</label>
                                        <select id="country_id" name="country_id" class="form-control select2">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ old('country_id', $university->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="error-country_id"></span>
                                        @error('country_id')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="city_id" class="form-label">City</label>
                                        <select id="city_id" name="city_id" class="form-control select2">
                                            <option value="">Select City</option>
                                            @if(isset($cities) && old('country_id', $university->country_id ?? false))
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" {{ old('city_id', $university->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="text-danger" id="error-city_id"></span>
                                        @error('city_id')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">University Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Enter University Name"
                                               value="{{ old('name', $university->name ?? '') }}">
                                        <span class="text-danger" id="error-name"></span>
                                        @error('name')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="cricos" class="form-label">CRICOS</label>
                                        <input type="text" id="cricos" name="cricos" class="form-control"
                                               placeholder="Enter CRICOS"
                                               value="{{ old('cricos', $university->cricos ?? '') }}">
                                        <span class="text-danger" id="error-cricos"></span>
                                        @error('cricos')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="campus_count" class="form-label">Campus Count</label>
                                        <input type="number" id="campus_count" name="campus_count" class="form-control"
                                               placeholder="Enter number of campuses"
                                               value="{{ old('campus_count', $university->campus_count ?? '') }}">
                                        <span class="text-danger" id="error-campus_count"></span>
                                        @error('campus_count')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="1" {{ old('status', $university->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $university->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <span class="text-danger" id="error-status"></span>
                                        @error('status')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="3"
                                          placeholder="Enter description">{{ old('description', $university->description ?? '') }}</textarea>
                                <span class="text-danger" id="error-description"></span>
                                @error('description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control" accept="image/*" onchange="previewImage(event, 'logoPreview')">
                                @if(isset($university->logo))
                                    <img src="{{ asset('storage/' . $university->logo) }}" id="logoPreview" class="mt-2" style="max-height:100px; display:block;">
                                @else
                                    <img id="logoPreview" class="mt-2 d-none" style="max-height:100px;">
                                @endif
                                <span class="text-danger" id="error-logo"></span>
                                @error('logo')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Main Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event, 'imagePreview')">
                                @if(isset($university->image))
                                    <img src="{{ asset('storage/' . $university->image) }}" id="imagePreview" class="mt-2" style="max-height:150px; display:block;">
                                @else
                                    <img id="imagePreview" class="mt-2 d-none" style="max-height:150px;">
                                @endif
                                <span class="text-danger" id="error-image"></span>
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="row mb-2">
                                <label for="study_area" class="form-label">Study Area</label>
                                @if(isset($university) && !empty($university))
                                    <div id="groups-wrapper">
                                        @foreach($studyAreas as $key => $area)
                                            <div class="group border p-3 mb-3" data-group-index="{{ $key }}">
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Program</label>
                                                        <select name="groups[{{ $key }}][select][]" class="form-control program-select">
                                                            <option value="">Select Program</option>
                                                            @foreach($programs as $program)
                                                                <option value="{{ $program->id }}" {{ $area->program_id == $program->id ? 'selected' : '' }}>
                                                                    {{ $program->name }} | {{ $program->duration }} Year
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-8 course-items-wrapper">
                                                        <label class="form-label">Course Item</label>
                                                        @php
                                                            $courses = explode('<||>', $area->courses);
                                                        @endphp

                                                        @foreach($courses as $c_key => $course)
                                                            <div class="row mb-2 align-items-center course-item-row">
                                                                <div class="col">
                                                                    <input type="text" name="groups[{{ $key }}][input][]" class="form-control" value="{{ $course }}" placeholder="Course Item">
                                                                </div>
                                                                <div class="col-auto">
                                                                    <button type="button" class="btn btn-danger remove-input">Remove</button>
                                                                    @if($c_key == 0)
                                                                        <button type="button" class="btn btn-success add-input">+ Add Input</button>
                                                                    @else
                                                                        <div style="width: 185px"></div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div id="groups-wrapper">
                                        <div class="group border p-3 mb-3" data-group-index="0">
                                            <div class="row align-items-center mb-2">
                                                <div class="col-md-4">
                                                    <label for="program" class="form-label">Program</label>
                                                    <select name="groups[0][select][]" class="form-control">
                                                        <option value="">Select Program</option>
                                                        @foreach($programs as $program)
                                                            <option value="{{$program->id}}">{{$program->name }} | {{$program->duration . ' Year' }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('groups.0.select.0'))
                                                        <span class="text-danger">{{ $errors->first('groups.0.select.0') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="course_item" class="form-label">Course Item</label>
                                                    <input type="text" name="groups[0][input][]" class="form-control" placeholder="Course Item">
                                                    @if ($errors->has('groups.0.input.0'))
                                                        <span class="text-danger">{{ $errors->first('groups.0.input.0') }}</span>
                                                    @endif

                                                </div>
                                                <div class="col-md-2 mt-4">
                                                    <button type="button" class="btn btn-success add-input">+ Add Input</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <button type="button" id="add-group" class="btn btn-primary mt-2">+ Add More Group</button>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">{{ isset($university) ? 'Update' : 'Create' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script>
        function previewImage(event, previewId) {
            const input = event.target;
            const preview = document.getElementById(previewId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            $('#description').summernote({
                placeholder: 'Write your description here...',
                tabsize: 2,
                height: 150
            });
        });

        $(document).ready(function () {
            $('#country_id').on('change', function () {
                let countryId = $(this).val();
                let citySelect = $('#city_id');

                citySelect.empty().append('<option value="">Loading...</option>');

                if (countryId) {
                    $.ajax({
                        url: "{{ url('/get-cities') }}/" + countryId,
                        type: "GET",
                        success: function (response) {
                            citySelect.empty().append('<option value="">Select City</option>');
                            $.each(response, function (key, city) {
                                citySelect.append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                        },
                        error: function () {
                            citySelect.empty().append('<option value="">Error loading cities</option>');
                        }
                    });
                } else {
                    citySelect.empty().append('<option value="">Select City</option>');
                }
            });
        });
    </script>
    <<script>
        $(document).ready(function () {
            let groupIndex = 0;

            // Store all programs in JS
            const allPrograms = @json($programs);

            function getAvailablePrograms() {
                let selectedPrograms = [];
                $('.program-select').each(function () {
                    if ($(this).val()) selectedPrograms.push($(this).val());
                });

                return allPrograms.filter(p => !selectedPrograms.includes(p.id.toString()));
            }

            // Add input inside a group
            $(document).on('click', '.add-input', function () {
                let group = $(this).closest('.group');
                let gIndex = group.data('group-index');

                let newRow = $(`
            <div class="row align-items-center mb-2">
                <div class="col-md-4">

                </div>
                <div class="col-md-6">
                    <input type="text" name="groups[${gIndex}][input][]" class="form-control" placeholder="Course Item">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-input">Remove</button>
                </div>
            </div>
        `);

                group.append(newRow);
                renderProgramOptions(newRow.find('.program-select'));
            });

            // Remove input row
            $(document).on('click', '.remove-input', function () {
                $(this).closest('.row').remove();
            });

            // Add more group
            $('#add-group').click(function () {
                groupIndex++;
                let newGroup = $(`
        <div class="group border p-3 mb-3" data-group-index="${groupIndex}">
            <div class="row align-items-center mb-2">
                <div class="col-md-4">
                    <label class="form-label">Program</label>
                    <select name="groups[${groupIndex}][select][]" class="form-control program-select">
                        <option value="">Select Program</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Course Item</label>
                    <input type="text" name="groups[${groupIndex}][input][]" class="form-control" placeholder="Course Item">
                </div>
                <div class="col-md-2 mt-4">
                    <button type="button" class="btn btn-success add-input">+ Add Input</button>
                </div>
            </div>
        </div>
    `);

                $('#groups-wrapper').append(newGroup);

                let select = newGroup.find('.program-select');
                @foreach($programs as $program)
                select.append(`<option value="{{ $program->id }}">{{ $program->name }} | {{ $program->duration }} Year</option>`);
                @endforeach
            });

            // Update dropdowns when selection changes
            $(document).on('change', '.program-select', function () {
                $('.program-select').each(function () {
                    renderProgramOptions($(this), $(this).val());
                });
            });

            // Initial render for first select
            $('.program-select').each(function () {
                renderProgramOptions($(this), $(this).val());
            });
        });
    </script>
@endpush

