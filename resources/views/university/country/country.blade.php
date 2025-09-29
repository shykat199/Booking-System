@extends('layouts.app')
@section('page-title','Country List')
@push('style')
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Country List</h2>
                    <button class="btn btn-primary mt-3" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm">Create New Country +</button>
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
    <!-- Edit Blog Modal -->
    <div class="modal fade bd-example-modal-lg" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="editBlogForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="editBlogModalLabel">Update Country</h3>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body dark-modal">
                        <div class="mb-3 modal-padding-space">
                            <label for="blogName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="blogName" name="name" required>
                        </div>
                        <div class="mb-3 modal-padding-space">
                            <label for="blogStatus" class="form-label">Status</label>
                            <select class="form-select" id="blogStatus" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" id="mySmallCreateModalLabel" tabindex="-1" role="dialog" aria-labelledby="mySmallCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="mySmallCreateModalLabel">New Country</h3>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <form id="mySmallCreateModalLabel" method="post" action="{{route('save-country')}}">
                        @csrf
                        <div class="modal-body dark-modal">
                            <div class="mb-3 modal-padding-space">
                                <label for="blogName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="blogName" name="name" required>
                            </div>
                            <div class="mb-3 modal-padding-space">
                                <label for="blogStatus" class="form-label">Status</label>
                                <select class="form-select" id="blogStatus" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
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
                    url: '{{ route("country") }}',
                    type: 'GET',
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status',orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at',orderable: false, searchable: false},
                    {data: 'action', name: 'action',orderable: false, searchable: false},
                ],
                "columnDefs":[
                    {
                        targets: 1,
                        render: function(data, type, row, meta){
                            return row.name
                        }
                    },
                    {
                        targets: 2,
                        render: function(data, type, row, meta){
                            if (row.status == 1) {
                                return '<span class="badge bg-success">Active</span>';
                            } else {
                                return '<span class="badge bg-danger">Inactive</span>';
                            }
                        }
                    },
                    {
                        targets: 3,
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
                const url = button.getAttribute('data-url');
                const name = button.getAttribute('data-name');
                const status = button.getAttribute('data-status');

                // Populate the form
                const form = document.getElementById('editBlogForm');
                form.action = url;
                document.getElementById('blogName').value = name;
                document.getElementById('blogStatus').value = status;
            });
        });

    </script>


@endpush
