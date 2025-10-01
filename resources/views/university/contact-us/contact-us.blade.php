@extends('layouts.app')
@section('page-title','Contact List')
@push('style')
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Contact Us List</h2>
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Query</th>
                                    <th>Created At</th>
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
                    url: '{{ route("contact-us-list") }}',
                    type: 'GET',
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'query', name: 'query'},
                    {data: 'created_at', name: 'created_at',orderable: false, searchable: false},
                ],
                "columnDefs":[
                    {
                        targets: 5,
                        render: function(data, type, row, meta){
                            let dateTime = '';
                            if(type === 'display'){
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
                const country_id = button.getAttribute('data-country');
                const url = button.getAttribute('data-url');
                const name = button.getAttribute('data-name');
                const status = button.getAttribute('data-status');

                // Populate the form
                const form = document.getElementById('editBlogForm');
                form.action = url;
                document.getElementById('blogName').value = name;
                document.getElementById('countryId').value = country_id;
                document.getElementById('blogStatus').value = status;
            });
        });

    </script>


@endpush
