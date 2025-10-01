<section class="contact-us py-5 mt-5" style="background-color: #e0e0e0;">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Side: Text + Features -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="fw-bold">Contact Us Section</h3>
                <p>Few Lines of text goes here Few Lines of text goes here Few Lines of text goes here</p>

                <h6 class="fw-bold mt-4">Why Choose Us</h6>
                <ul class="list-unstyled mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-crown me-2 text-orange"></i>
                        FREE End-to-End Assistance
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-crown me-2 text-orange"></i>
                        FREE End-to-End Assistance
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-crown me-2 text-orange"></i>
                        FREE End-to-End Assistance
                    </li>
                </ul>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="col-lg-6">
                <div class="card shadow-sm p-4 rounded-3">
                    <form id="contactUsForm">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email ID" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="query" required>
                                <option selected disabled>I would like to know more about</option>
                                <option value="Study Abroad">Study Abroad</option>
                                <option value="Scholarships">Scholarships</option>
                                <option value="Test Preparation">Test Preparation</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="cf-turnstile"
                            data-sitekey="{{config('app.cloud_flare_site_key')}}"
                            data-theme="light"
                            data-size="normal"
                            data-callback="onSuccess"
                        ></div>

                        <button type="submit" id="sendQueryBtn">
                            Send Query
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@push('university.script')

    <script>
        document.getElementById('contactUsForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            let valid = true;

            form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
            form.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('is-invalid'));

            const name = form.name.value.trim();
            const email = form.email.value.trim();
            const phone = form.phone.value.trim();
            const query = form.query.value;

            if (name === '') {
                valid = false;
                form.name.classList.add('is-invalid');
                form.name.nextElementSibling.textContent = 'Full Name is required';
            }
            if (email === '') {
                valid = false;
                form.email.classList.add('is-invalid');
                form.email.nextElementSibling.textContent = 'Email is required';
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                valid = false;
                form.email.classList.add('is-invalid');
                form.email.nextElementSibling.textContent = 'Enter a valid email';
            }
            if (phone === '') {
                valid = false;
                form.phone.classList.add('is-invalid');
                form.phone.nextElementSibling.textContent = 'Phone Number is required';
            } else if (!/^[0-9+\-() ]{6,20}$/.test(phone)) {
                valid = false;
                form.phone.classList.add('is-invalid');
                form.phone.nextElementSibling.textContent = 'Enter a valid phone number';
            }
            if (!query) {
                valid = false;
                form.query.classList.add('is-invalid');
                form.query.nextElementSibling.textContent = 'Please select an option';
            }

            if (!valid) return;

            const formData = new FormData(form);
            fetch("{{ route('university.send-query') }}", {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        form.reset();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.message || 'Query sent successfully!',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message || 'Something went wrong!'
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                });
        });
    </script>
@endpush
