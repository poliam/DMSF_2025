<x-app-layout>

<div class="bg-cover" style="background-image: url('{{ asset('background/hagimit-bg.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container py-4">
        <!-- Form Container with Border and Shadow -->
        <div class="card shadow-lg p-4 border">
            <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Hidden input for image path -->
                <input type="hidden" name="image_path" id="image_path" value="{{ old('image_path', $patient->image_path) }}">

                <legend>Patient Identifying Record</legend>
                <hr>

                <!-- First Row: Personal Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="reference_number">Reference Number</label>
                        <div class="d-flex gap-2">
                            <!-- Reference Number (numeric part) - Read-only -->
                            <input type="text" class="form-control @error('reference_number') is-invalid @enderror"
                                name="reference_number" id="reference_number"
                                value="{{ old('reference_number', $numericPart) }}" maxlength="5" placeholder="00001" readonly>

                            <!-- Reference Number Suffix (alphabetic part) - Read-only -->
                            <input type="text" class="form-control @error('reference_number_suffix') is-invalid @enderror"
                                name="reference_number_suffix" id="reference_number_suffix"
                                value="{{ old('reference_number_suffix', $suffixPart) }}" maxlength="3" placeholder="ABC" readonly>
                        </div>
                        @error('reference_number')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                        @error('reference_number_suffix')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name', $patient->last_name) }}" required>
                            @error('last_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name', $patient->first_name) }}" required>
                            @error('first_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" value="{{ old('middle_name', $patient->middle_name) }}">
                            @error('middle_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Image Preview Section -->
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <div id="image-preview-section" class="{{ $patient->image_path ? '' : 'd-none' }}">
                            <label class="form-label">Current Patient Photo</label>
                            <div class="d-flex justify-content-center align-items-center gap-3">
                                <img id="form-image-preview" src="{{ asset($patient->image_path) }}" alt="Patient Photo" 
                                     style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 3px solid #7CAD3E;">
                                <button type="button" id="remove-image-btn" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i> Remove Image
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birth_date">Birthdate</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date', $patient->birth_date) }}" required>
                            @error('birth_date')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control" id="age" value="{{ $patient->age }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sex</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender', $patient->gender) == 'Male' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender', $patient->gender) == 'Female' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            @error('gender')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <legend>Address</legend>
                <hr>

                <!-- Address Fields -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" id="street" value="{{ old('street', $patient->street) }}" required>
                            @error('street')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brgy_address">Brgy Address</label>
                            <select class="form-control @error('brgy_address') is-invalid @enderror" name="brgy_address" id="brgy_address" required>
                                <option value="">Select Barangay</option>
                                <option value="Sitio Balite, Brgy Marilog, Davao City" {{ old('brgy_address', $patient->brgy_address) == 'Sitio Balite, Brgy Marilog, Davao City' ? 'selected' : '' }}>Sitio Balite, Brgy Marilog, Davao City</option>
                                <option value="Brgy Cogon, Babak District, IGACOS" {{ old('brgy_address', $patient->brgy_address) == 'Brgy Cogon, Babak District, IGACOS' ? 'selected' : '' }}>Brgy Cogon, Babak District, IGACOS</option>
                                <option value="other" {{ old('brgy_address', $patient->brgy_address) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('brgy_address')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control mt-2" name="brgy_address_other" id="brgy_address_other" placeholder="If Other, specify" style="display:none;">
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_landmark">Address Landmark</label>
                            <input type="text" class="form-control @error('address_landmark') is-invalid @enderror" name="address_landmark" id="address_landmark" value="{{ old('address_landmark', $patient->address_landmark) }}">
                            @error('address_landmark')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation', $patient->occupation) }}">
                            @error('occupation')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <legend>Other Information</legend>
                <hr>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="highest_educational_attainment">Highest Educational Attainment</label>
                            <select class="form-control @error('highest_educational_attainment') is-invalid @enderror" name="highest_educational_attainment" id="highest_educational_attainment" required>
                                <option value="">Select</option>
                                <option value="No formal education" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'No formal education' ? 'selected' : '' }}>No formal education</option>
                                <option value="Elementary level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Elementary level' ? 'selected' : '' }}>Elementary level</option>
                                <option value="Elementary graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Elementary graduate' ? 'selected' : '' }}>Elementary graduate</option>
                                <option value="Junior HS level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Junior HS level' ? 'selected' : '' }}>Junior HS level</option>
                                <option value="Junior HS graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Junior HS graduate' ? 'selected' : '' }}>Junior HS graduate</option>
                                <option value="Senior HS level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Senior HS level' ? 'selected' : '' }}>Senior HS level</option>
                                <option value="Senior HS graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Senior HS graduate' ? 'selected' : '' }}>Senior HS graduate</option>
                                <option value="Vocational course" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Vocational course' ? 'selected' : '' }}>Vocational course</option>
                                <option value="College level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'College level' ? 'selected' : '' }}>College level</option>
                                <option value="College graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'College graduate' ? 'selected' : '' }}>College graduate</option>
                                <option value="Doctoral level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Doctoral level' ? 'selected' : '' }}>Doctoral level</option>
                                <option value="Postdoctoral level" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Postdoctoral level' ? 'selected' : '' }}>Postdoctoral level</option>
                                <option value="Postdoctoral graduate" {{ old('highest_educational_attainment', $patient->highest_educational_attainment) == 'Postdoctoral graduate' ? 'selected' : '' }}>Postdoctoral graduate</option>
                            </select>
                            @error('highest_educational_attainment')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marital_status">Marital Status</label>
                            <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" id="marital_status" required>
                                <option value="">Select</option>
                                <option value="Married" {{ old('marital_status', $patient->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Live-in" {{ old('marital_status', $patient->marital_status) == 'Live-in' ? 'selected' : '' }}>Live-in</option>
                                <option value="Separated" {{ old('marital_status', $patient->marital_status) == 'Separated' ? 'selected' : '' }}>Separated</option>
                                <option value="Single" {{ old('marital_status', $patient->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                            </select>
                            @error('marital_status')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="monthly_household_income">Monthly Household Income (Php)</label>
                            <select class="form-control @error('monthly_household_income') is-invalid @enderror" name="monthly_household_income" id="monthly_household_income" required>
                                <option value="">Select</option>
                                <option value="<10,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '<10,000' ? 'selected' : '' }}>&lt;10,000</option>
                                <option value="10,000-20,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '10,000-20,000' ? 'selected' : '' }}>10,000-20,000</option>
                                <option value="20,000-40,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '20,000-40,000' ? 'selected' : '' }}>20,000-40,000</option>
                                <option value="40,000-70,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '40,000-70,000' ? 'selected' : '' }}>40,000-70,000</option>
                                <option value="70,000-100,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '70,000-100,000' ? 'selected' : '' }}>70,000-100,000</option>
                                <option value=">100,000" {{ old('monthly_household_income', $patient->monthly_household_income) == '>100,000' ? 'selected' : '' }}>>&nbsp;100,000</option>
                            </select>
                            @error('monthly_household_income')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religion">Religion</label>
                            <select class="form-control @error('religion') is-invalid @enderror" name="religion" id="religion" required>
                                <option value="">Select</option>
                                <option value="Christian" {{ old('religion', $patient->religion) == 'Christian' ? 'selected' : '' }}>Christian</option>
                                <option value="Muslim" {{ old('religion', $patient->religion) == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                <option value="Other" {{ old('religion', $patient->religion) == 'Other' ? 'selected' : '' }}>Other</option>
                                <option value="None" {{ old('religion', $patient->religion) == 'None' ? 'selected' : '' }}>None</option>
                            </select>
                            @error('religion')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button href="{{ route('patients.show', $patient->id) }}" class="bg-blue-500 hover:bg-red-500 text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">Cancel</button>
                    <button type="button" id="capture-image-btn" class="bg-[#1A5D77] hover:bg-[#7CAD3E] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300 me-2">
                        <i class="fas fa-camera"></i> {{ $patient->image_path ? 'Change Photo' : 'Capture Photo' }}
                    </button>
                    <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">Update Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Camera Modal -->
<div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cameraModalLabel">Capture Patient Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <div id="camera-container" class="mb-3">
                        <video id="camera-preview" autoplay playsinline style="width: 100%; max-width: 500px; height: auto; border-radius: 8px;"></video>
                        <div id="camera-controls" class="mt-3">
                            <button type="button" id="start-camera-btn" class="btn btn-primary">
                                <i class="fas fa-camera"></i> Start Camera
                            </button>
                        </div>
                    </div>
                    
                    <div id="captured-image-container" class="mb-3" style="display: none;">
                        <img id="captured-image" style="width: 100%; max-width: 500px; height: auto; border-radius: 8px;">
                        <div class="mt-3">
                            <button type="button" id="retake-btn" class="btn btn-secondary me-2">
                                <i class="fas fa-redo"></i> Retake
                            </button>
                            <button type="button" id="save-image-btn" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Photo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <style>
        .btn-updt {
            background-color: #7CAD3E; /* Green */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 16px;
        }
        .btn-updt:hover {
            background-color: #1A5D77; /* Darker blue on hover */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Camera Modal Styles */
        .modal-content {
            border-radius: 15px;
        }
        
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        
        #camera-preview, #captured-image {
            border: 2px solid #dee2e6;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .btn {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        /* Image Preview Styles */
        .patient-photo {
            transition: transform 0.2s ease-in-out;
        }
        
        .patient-photo:hover {
            transform: scale(1.1);
        }
        
        .no-photo-placeholder {
            background-color: #f8f9fa;
            border: 2px dashed #dee2e6;
            color: #6c757d;
            transition: all 0.2s ease-in-out;
        }
        
        .no-photo-placeholder:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-calculate age from birthdate
        document.getElementById('birth_date').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('age').value = isNaN(age) ? '' : age;
        });
        
        // Show/hide other barangay field
        document.getElementById('brgy_address').addEventListener('change', function() {
            document.getElementById('brgy_address_other').style.display = this.value === 'other' ? 'block' : 'none';
        });

        // Camera functionality
        let stream = null;
        let capturedImageData = null;

        // Capture image button click
        document.getElementById('capture-image-btn').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('cameraModal'));
            modal.show();
        });

        // Start camera button click
        document.getElementById('start-camera-btn').addEventListener('click', async function() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        width: { ideal: 1280 },
                        height: { ideal: 720 },
                        facingMode: 'user'
                    } 
                });
                
                const video = document.getElementById('camera-preview');
                video.srcObject = stream;
                
                // Show camera controls
                document.getElementById('camera-controls').innerHTML = `
                    <button type="button" id="capture-btn" class="btn btn-warning">
                        <i class="fas fa-camera"></i> Capture Photo
                    </button>
                `;
                
                // Add capture button event listener
                document.getElementById('capture-btn').addEventListener('click', capturePhoto);
                
            } catch (error) {
                console.error('Error accessing camera:', error);
                let errorMessage = 'Unable to access camera.';
                
                if (error.name === 'NotAllowedError') {
                    errorMessage = 'Camera access denied. Please allow camera access and try again.';
                } else if (error.name === 'NotFoundError') {
                    errorMessage = 'No camera found on this device.';
                } else if (error.name === 'NotSupportedError') {
                    errorMessage = 'Camera not supported on this device.';
                }
                
                alert(errorMessage);
            }
        });

        // Capture photo
        function capturePhoto() {
            const video = document.getElementById('camera-preview');
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            capturedImageData = canvas.toDataURL('image/jpeg', 0.8);
            
            // Stop camera stream
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            
            // Show captured image
            document.getElementById('captured-image').src = capturedImageData;
            document.getElementById('camera-container').style.display = 'none';
            document.getElementById('captured-image-container').style.display = 'block';
        }

        // Retake button click
        document.getElementById('retake-btn').addEventListener('click', function() {
            document.getElementById('captured-image-container').style.display = 'none';
            document.getElementById('camera-container').style.display = 'block';
            document.getElementById('camera-controls').innerHTML = `
                <button type="button" id="start-camera-btn" class="btn btn-primary">
                    <i class="fas fa-camera"></i> Start Camera
                </button>
            `;
            
            // Re-add start camera event listener
            document.getElementById('start-camera-btn').addEventListener('click', async function() {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ 
                        video: { 
                            width: { ideal: 1280 },
                            height: { ideal: 720 },
                            facingMode: 'user'
                        } 
                    });
                    
                    const video = document.getElementById('camera-preview');
                    video.srcObject = stream;
                    
                    // Show camera controls
                    document.getElementById('camera-controls').innerHTML = `
                        <button type="button" id="capture-btn" class="btn btn-warning">
                            <i class="fas fa-camera"></i> Capture Photo
                        </button>
                    `;
                    
                    // Add capture button event listener
                    document.getElementById('capture-btn').addEventListener('click', capturePhoto);
                    
                } catch (error) {
                    console.error('Error accessing camera:', error);
                    let errorMessage = 'Unable to access camera.';
                    
                    if (error.name === 'NotAllowedError') {
                        errorMessage = 'Camera access denied. Please allow camera access and try again.';
                    } else if (error.name === 'NotFoundError') {
                        errorMessage = 'No camera found on this device.';
                    } else if (error.name === 'NotSupportedError') {
                        errorMessage = 'Camera not supported on this device.';
                    }
                    
                    alert(errorMessage);
                }
            });
            
            capturedImageData = null;
        });

        // Save image button click
        document.getElementById('save-image-btn').addEventListener('click', function() {
            if (capturedImageData) {
                document.getElementById('image_path').value = capturedImageData;
                
                // Update form preview
                const previewImg = document.getElementById('form-image-preview');
                previewImg.src = capturedImageData;
                
                // Show image preview section
                document.getElementById('image-preview-section').classList.remove('d-none');
                
                // Update capture button text and style
                const captureBtn = document.getElementById('capture-image-btn');
                captureBtn.innerHTML = '<i class="fas fa-camera"></i> Change Photo';
                captureBtn.classList.remove('bg-[#1A5D77]', 'hover:bg-[#7CAD3E]');
                captureBtn.classList.add('bg-[#7CAD3E]', 'hover:bg-[#1A5D77]');
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('cameraModal'));
                modal.hide();
            }
        });

        // Remove image button click
        document.getElementById('remove-image-btn').addEventListener('click', function() {
            document.getElementById('image_path').value = '';
            document.getElementById('form-image-preview').src = '';
            document.getElementById('image-preview-section').classList.add('d-none');
            
            // Reset capture button
            const captureBtn = document.getElementById('capture-image-btn');
            captureBtn.innerHTML = '<i class="fas fa-camera"></i> Capture Photo';
            captureBtn.classList.remove('bg-[#7CAD3E]', 'hover:bg-[#1A5D77]');
            captureBtn.classList.add('bg-[#1A5D77]', 'hover:bg-[#7CAD3E]');
        });

        // Modal hidden event - cleanup
        document.getElementById('cameraModal').addEventListener('hidden.bs.modal', function() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            
            // Reset modal state
            document.getElementById('captured-image-container').style.display = 'none';
            document.getElementById('camera-container').style.display = 'block';
            document.getElementById('camera-controls').innerHTML = `
                <button type="button" id="start-camera-btn" class="btn btn-primary">
                    <i class="fas fa-camera"></i> Start Camera
                </button>
            `;
            
            capturedImageData = null;
        });
    </script>
</x-app-layout>
