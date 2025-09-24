@extends('layouts.app')
@section('page-title','Blog List')
@push('style')
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Blog List</h2>
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th style="width: 450px">Image</th>
                                    <th>Status</th>
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

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src="" id="modalImage" class="img-fluid w-100" alt="Blog Image">
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
                    url: '{{ route("blog") }}',
                    type: 'GET',
                    {{--data: function (d) {--}}
                    {{--    d.role = `{{ request()->get('role') }}`;--}}
                    {{--}--}}
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description',orderable: false, searchable: false},
                    {data: 'images', name: 'images',orderable: false, searchable: false},
                    {data: 'status', name: 'status',orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at',orderable: false, searchable: false},
                    {data: 'action', name: 'action',orderable: false, searchable: false},
                ],
                "columnDefs":[
                    {
                        targets: 1,
                        render: function(data, type, row, meta){
                            return row.user.name
                        }
                    },

                    {
                        targets: 5,
                        render: function(data, type, row, meta){
                            let status = '';
                            if(type === 'display'){
                                if (row.status == '{{ACTIVE_STATUS}}') {
                                    status = '<span class="badge bg-success">Active</span>';
                                } else if (row == '{{INACTIVE_STATUS}}') {
                                    status = '<span class="badge bg-info">Inactive</span>';
                                } else {
                                    status = '<span class="badge bg-danger">Delete</span>';
                                }
                            }
                            return status;
                        }
                    },
                    {
                        targets: 6,
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
        document.addEventListener('click', function(e){
            if(e.target.classList.contains('blog-thumb')){
                const src = e.target.getAttribute('data-src');
                document.getElementById('modalImage').src = src;
            }
        });
    </script>
@endpush
