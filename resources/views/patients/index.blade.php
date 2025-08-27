<x-app-layout>
    <!-- Add DataTables CSS -->
    <x-slot name="styles">
        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    </x-slot>

    <style>
        .bg-falls {
            background: url('{{ asset('images/hagimit-bg.jpg') }}');
            background-size: cover;
            min-height: 100vh;
            position: relative;
        }

        .bg-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }

        .content-wrapper {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.9); /* Light semi-transparent container */
            border-radius: 10px;
            padding: 2rem;
        }

        .btn-color {
            background-color: #7CAD3E;
            color: white;
        }

        .patient-photo {
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }

        .patient-photo:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .no-photo-placeholder {
            transition: all 0.2s ease-in-out;
        }

        .no-photo-placeholder:hover {
            background-color: #e9ecef;
            border-color: #7CAD3E;
        }

        /* Image Modal Styles */
        .image-modal .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .image-modal .modal-header {
            background-color: #7CAD3E;
            color: white;
            border-bottom: none;
            border-radius: 15px 15px 0 0;
        }

        .image-modal .modal-body {
            padding: 0;
            text-align: center;
        }

        .image-modal .modal-body img {
            max-width: 100%;
            height: auto;
            border-radius: 0 0 15px 15px;
        }

        .image-modal .btn-close {
            filter: invert(1) brightness(100);
        }
    </style>

    <div class="bg-falls pt-20">
        <div class="bg-overlay"></div>

        <div class="container-xl content-wrapper">
            <div class="row justify-content-end mb-4">
                <div class="col-2">
                    <a href="{{ route('patients.create') }}"
                       class="btn bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full mt-2 text-base w-full transition-colors duration-300">
                        Create Patient
                    </a>
                </div>
            </div>

            <table id="patientsTable" class="table table-bordered table-hover bg-white text-dark">
                <thead class="thead-light">
                    <tr>
                        <th width="10%">Photo</th>
                        <th width="15%">First Name</th>
                        <th width="15%">Last Name</th>
                        <th width="40%">Diabetes Status</th>
                        <th width="15%">Created At</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                        @php
                            // Convert UTC time to Philippine time (UTC+8)
                            $philippineTime = $patient->created_at->setTimezone('Asia/Manila');
                        @endphp
                        <tr>
                            <td class="text-center">
                                @if($patient->image_path)
                                    <img src="{{ $patient->image_path }}" alt="Patient Photo"
                                         class="patient-photo"
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%; border: 2px solid #7CAD3E;"
                                         onclick="viewPatientImage('{{ $patient->image_path }}', '{{ $patient->first_name }} {{ $patient->last_name }}')"
                                         title="Click to view larger image">
                                @else
                                    <div class="no-photo-placeholder" style="width: 60px; height: 60px; border-radius: 50%; background-color: #f8f9fa; border: 2px dashed #dee2e6; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                        <i class="fas fa-user text-muted" style="font-size: 24px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $patient->first_name }}</td>
                            <td>{{ $patient->last_name }}</td>
                            <td>{{ $patient->diabetes_status ?? 'Pending' }}</td>
                            <td data-order="{{ $patient->created_at->timestamp }}">
                                <small class="text-muted">{{ $philippineTime->format('M d, Y') }}</small><br>
                                <small>{{ $philippineTime->format('h:i A') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-color btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Image View Modal -->
    <div class="modal fade image-modal" id="imageViewModal" tabindex="-1" aria-labelledby="imageViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageViewModalLabel">Patient Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalPatientImage" src="" alt="Patient Photo">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#patientsTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: false,
                    order: [[4, 'desc']], // Sort by Created column (index 4) in descending order (most recent first)
                    columnDefs: [
                        {
                            targets: 0, // Photo column
                            orderable: false, // Disable sorting on photo column
                            searchable: false
                        },
                        {
                            targets: 4, // Created column
                            type: 'html-num-fmt', // DataTables will use data-order attribute for sorting
                            searchable: true // Allow searching within dates
                        },
                        {
                            targets: 5, // Actions column
                            orderable: false, // Disable sorting on actions column
                            searchable: false
                        }
                    ],
                    language: {
                        emptyTable: "No patients found",
                        zeroRecords: "No matching patients found"
                    }
                });
                $("#patientsTable_length").hide();
            });

            // Function to view patient image in modal
            function viewPatientImage(imagePath, patientName) {
                // Set the modal title with patient name
                document.getElementById('imageViewModalLabel').textContent = `Photo of ${patientName}`;

                // Set the image source
                document.getElementById('modalPatientImage').src = imagePath;

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('imageViewModal'));
                modal.show();
            }
        </script>
    @endpush
</x-app-layout>
