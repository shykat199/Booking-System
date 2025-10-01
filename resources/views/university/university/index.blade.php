@extends('layouts.app')
@section('page-title','University List')
@push('style')
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>University List</h2>
                    <a href="{{route('create-university')}}" class="btn btn-primary mt-3" type="button">Create New University +</a>
                </div>

            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Campus Count</th>
                                    <th>Logo</th>
                                    <th>status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                order: [[0, 'desc']],
                ajax: {
                    url: '{{ route("university") }}',
                    type: 'GET',
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'country', name: 'country.name'},
                    {data: 'city', name: 'city.name'},
                    {data: 'campus_count', name: 'campus_count'},
                    {data: 'logo', name: 'logo',orderable: false, searchable: false},
                    {data: 'status', name: 'status',orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at',orderable: false, searchable: false},
                    {data: 'action', name: 'action',orderable: false, searchable: false},
                ],
                "columnDefs": [
                    {
                        targets: 1,
                        render: function (data, type, row, meta) {
                            return row.name
                        }
                    },
                    {
                        targets: 2,
                        render: function (data, type, row, meta) {
                            return row.country.name
                        }
                    },
                    {
                        targets: 3,
                        render: function (data, type, row, meta) {
                            return row.city.name
                        }
                    },
                    {
                        targets: 4,
                        render: function (data, type, row, meta) {
                            return row.campus_count
                        }
                    },
                    {
                        targets: 6,
                        render: function (data, type, row, meta) {
                            if (row.status == 1) {
                                return '<span class="badge bg-success">Active</span>';
                            } else {
                                return '<span class="badge bg-danger">Inactive</span>';
                            }
                        }
                    },
                    {
                        targets: 7,
                        render: function (data, type, row, meta) {
                            let dateTime = '';
                            if (type === 'display') {
                                dateTime = moment(row.created_at).format('DD-MMM-YYYY');
                            }
                            return dateTime;
                        }
                    },
                ]
            });
        });

        $(function() {
            showSwal = function(type,url) {
                'use strict';
                if (type === 'passing-parameter-execute-cancel') {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger me-2'
                        },
                        buttonsStyling: false,
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'me-2',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {

                            window.location.href = url;
                            // swalWithBootstrapButtons.fire(
                            //     'Deleted!',
                            //     'Your file has been deleted.',
                            //     'success'
                            // ).then(() => {
                            //     window.location.href = url;
                            // });

                        } else if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                            )
                        }
                    })
                }
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.querySelector('.bd-example-modal-lg');

            modalElement.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;

                // Extract info from data attributes
                const url = button.getAttribute('data-url');
                const duration = button.getAttribute('data-duration');
                const name = button.getAttribute('data-name');
                const status = button.getAttribute('data-status');

                // Populate the form
                const form = document.getElementById('editBlogForm');
                form.action = url;
                document.getElementById('blogName').value = name;
                document.getElementById('duration').value = duration;
                document.getElementById('blogStatus').value = status;
            });
        });

    </script>


@endpush
